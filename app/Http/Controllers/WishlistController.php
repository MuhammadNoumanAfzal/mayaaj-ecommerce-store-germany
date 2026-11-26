<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    /**
     * Display the luxury Wishlist page.
     */
    public function index(Request $request)
    {
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        $wishlistItems = Wishlist::getItemsForSession($sessionId, $customerId);

        // Curated recommendations if wishlist is low or empty
        $recommendedProducts = Product::where('status', 'active')
            ->whereNotIn('id', $wishlistItems->pluck('product_id')->toArray())
            ->inRandomOrder()
            ->take(4)
            ->get();

        $activeCurrency = Currency::getUserCurrency();

        return view('pages.wishlist', compact('wishlistItems', 'recommendedProducts', 'activeCurrency'));
    }

    /**
     * Toggle a product in wishlist (AJAX).
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = (int) $request->input('product_id');
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        $result = Wishlist::toggle($productId, $sessionId, $customerId);
        $product = Product::find($productId);

        $isDe = app()->getLocale() === 'de' || session('locale') === 'de';

        if ($result['action'] === 'added') {
            $msg = $isDe
                ? "„{$product->name}“ wurde auf Ihren Merkzettel gesetzt."
                : "“{$product->name}” has been saved to your atelier wishlist.";
        } else {
            $msg = $isDe
                ? "„{$product->name}“ wurde vom Merkzettel entfernt."
                : "“{$product->name}” was removed from your wishlist.";
        }

        return response()->json([
            'success'       => true,
            'action'        => $result['action'],
            'is_wishlisted' => $result['is_wishlisted'],
            'count'         => $result['count'],
            'product_id'    => $productId,
            'message'       => $msg,
        ]);
    }

    /**
     * Move a single wishlist item to the Shopping Bag.
     */
    public function moveToBag(Request $request, Product $product)
    {
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        // Add to Cart
        $cart = session()->get('cart', []);
        $itemKey = (string) $product->id;
        $effectivePrice = ($product->sale_price && $product->sale_price < $product->price)
            ? (float) $product->sale_price
            : (float) $product->price;

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['qty'] += 1;
        } else {
            $cart[$itemKey] = [
                'item_key'  => $itemKey,
                'id'        => $product->id,
                'name'      => $product->name,
                'variation' => null,
                'price'     => $effectivePrice,
                'image_url' => $product->image_url,
                'slug'      => $product->slug,
                'qty'       => 1,
                'sku'       => $product->sku ?? ('MHJ-' . $product->id),
            ];
        }

        session()->put('cart', $cart);

        // Remove from wishlist
        Wishlist::where('product_id', $product->id)
            ->where(function ($q) use ($sessionId, $customerId) {
                $q->where('session_id', $sessionId);
                if ($customerId) $q->orWhere('customer_id', $customerId);
            })
            ->delete();

        $newCount = Wishlist::countForSession($sessionId, $customerId);
        $cartCount = array_sum(array_column($cart, 'qty'));

        $isDe = app()->getLocale() === 'de' || session('locale') === 'de';
        $msg = $isDe
            ? "„{$product->name}“ wurde in Ihre Einkaufstasche gelegt."
            : "“{$product->name}” has been moved to your shopping bag.";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'        => true,
                'wishlist_count' => $newCount,
                'cart_count'     => $cartCount,
                'message'        => $msg,
            ]);
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Move ALL wishlist items to Shopping Bag.
     */
    public function moveAllToBag(Request $request)
    {
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        $items = Wishlist::getItemsForSession($sessionId, $customerId);

        if ($items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Ihr Merkzettel ist leer.',
            ], 422);
        }

        $cart = session()->get('cart', []);

        foreach ($items as $item) {
            $prod = $item->product;
            if (!$prod) continue;

            $itemKey = (string) $prod->id;
            $price = ($prod->sale_price && $prod->sale_price < $prod->price)
                ? (float) $prod->sale_price
                : (float) $prod->price;

            if (isset($cart[$itemKey])) {
                $cart[$itemKey]['qty'] += 1;
            } else {
                $cart[$itemKey] = [
                    'item_key'  => $itemKey,
                    'id'        => $prod->id,
                    'name'      => $prod->name,
                    'variation' => null,
                    'price'     => $price,
                    'image_url' => $prod->image_url,
                    'slug'      => $prod->slug,
                    'qty'       => 1,
                    'sku'       => $prod->sku ?? ('MHJ-' . $prod->id),
                ];
            }
        }

        session()->put('cart', $cart);

        // Clear wishlist
        Wishlist::where('session_id', $sessionId)
            ->orWhere(function ($q) use ($customerId) {
                if ($customerId) $q->where('customer_id', $customerId);
            })
            ->delete();

        $cartCount = array_sum(array_column($cart, 'qty'));

        $isDe = app()->getLocale() === 'de' || session('locale') === 'de';
        $msg = $isDe
            ? 'Alle Favoriten wurden erfolgreich in Ihre Einkaufstasche übertragen.'
            : 'All saved creations have been moved to your shopping bag.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'        => true,
                'wishlist_count' => 0,
                'cart_count'     => $cartCount,
                'message'        => $msg,
            ]);
        }

        return redirect()->route('cart.index')->with('success', $msg);
    }

    /**
     * Remove an item from wishlist.
     */
    public function destroy(Request $request, Product $product)
    {
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        Wishlist::where('product_id', $product->id)
            ->where(function ($q) use ($sessionId, $customerId) {
                $q->where('session_id', $sessionId);
                if ($customerId) $q->orWhere('customer_id', $customerId);
            })
            ->delete();

        $newCount = Wishlist::countForSession($sessionId, $customerId);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count'   => $newCount,
                'message' => 'Entfernt.',
            ]);
        }

        return redirect()->back()->with('success', 'Artikel entfernt.');
    }

    /**
     * Synchronize guest localStorage array of product IDs into session/DB.
     */
    public function sync(Request $request)
    {
        $productIds = $request->input('product_ids', []);
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        if (is_array($productIds)) {
            foreach ($productIds as $pId) {
                if (Product::where('id', $pId)->exists()) {
                    Wishlist::firstOrCreate(
                        ['session_id' => $sessionId, 'product_id' => (int)$pId],
                        ['customer_id' => $customerId]
                    );
                }
            }
        }

        $allIds = Wishlist::where('session_id', $sessionId)->pluck('product_id')->toArray();

        return response()->json([
            'success' => true,
            'count'   => count($allIds),
            'ids'     => $allIds,
        ]);
    }
}
