<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Deal;
use App\Models\AbandonedCart;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle multi-model live search across all admin modules.
     */
    public function search(Request $request)
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json([
                'success' => true,
                'query' => $q,
                'total_results' => 0,
                'results' => [
                    'products' => [],
                    'orders' => [],
                    'customers' => [],
                    'coupons' => [],
                    'deals' => [],
                    'abandoned_carts' => [],
                ]
            ]);
        }

        // 1. Search Products
        $products = Product::where('name', 'like', "%{$q}%")
            ->orWhere('sku', 'like', "%{$q}%")
            ->orWhere('slug', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->take(5)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'title' => $p->name,
                    'subtitle' => 'SKU: ' . ($p->sku ?: '—') . ' • Lager: ' . $p->stock . ' Stk.',
                    'badge' => 'EUR ' . number_format($p->price, 2, ',', '.'),
                    'image' => $p->image_url,
                    'url' => route('admin.products.edit', $p->id),
                    'category' => 'Produkte',
                ];
            });

        // 2. Search Orders
        $orders = Order::where('order_number', 'like', "%{$q}%")
            ->orWhere('customer_name', 'like', "%{$q}%")
            ->orWhere('customer_email', 'like', "%{$q}%")
            ->orWhere('customer_phone', 'like', "%{$q}%")
            ->orWhere('tracking_number', 'like', "%{$q}%")
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($o) {
                return [
                    'id' => $o->id,
                    'title' => 'Bestellung #' . $o->order_number,
                    'subtitle' => $o->customer_name . ' (' . $o->customer_email . ')',
                    'badge' => 'EUR ' . number_format($o->total_amount, 2, ',', '.') . ' • ' . ucfirst($o->status),
                    'badge_status' => $o->status,
                    'url' => route('admin.orders.show', $o->id),
                    'category' => 'Bestellungen',
                ];
            });

        // 3. Search Customers
        $customers = Customer::where('name', 'like', "%{$q}%")
            ->orWhere('email', 'like', "%{$q}%")
            ->orWhere('phone', 'like', "%{$q}%")
            ->take(5)
            ->get()
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'title' => $c->name,
                    'subtitle' => $c->email . ($c->phone ? ' • ' . $c->phone : ''),
                    'badge' => ($c->vip_tier ?: 'VIP') . ' • ' . ($c->total_orders ?? 0) . ' Best.',
                    'url' => route('admin.customers.edit', $c->id),
                    'category' => 'Kunden',
                ];
            });

        // 4. Search Coupons & Promo Codes
        $coupons = Coupon::where('code', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->take(4)
            ->get()
            ->map(function ($cp) {
                return [
                    'id' => $cp->id,
                    'title' => $cp->code,
                    'subtitle' => $cp->description ?: ($cp->type === 'percentage' ? $cp->value . '% Rabatt' : 'EUR ' . $cp->value . ' Rabatt'),
                    'badge' => $cp->is_active ? 'Aktiv (' . $cp->used_count . ' eingelöst)' : 'Inaktiv',
                    'url' => route('admin.coupons', ['q' => $cp->code]),
                    'category' => 'Gutscheine',
                ];
            });

        // 5. Search Deals & Bundles
        $deals = Deal::where('title_en', 'like', "%{$q}%")
            ->orWhere('title_de', 'like', "%{$q}%")
            ->orWhere('badge_text', 'like', "%{$q}%")
            ->take(3)
            ->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,
                    'title' => $d->title_de ?: $d->title_en,
                    'subtitle' => $d->badge_text,
                    'badge' => 'Bundle Deal',
                    'url' => route('admin.deals.edit', $d->id),
                    'category' => 'Deals & Bundles',
                ];
            });

        // 6. Search Abandoned Carts
        $abandonedCarts = AbandonedCart::where('customer_name', 'like', "%{$q}%")
            ->orWhere('customer_email', 'like', "%{$q}%")
            ->orWhere('customer_phone', 'like', "%{$q}%")
            ->take(3)
            ->get()
            ->map(function ($ac) {
                return [
                    'id' => $ac->id,
                    'title' => $ac->customer_name ?: 'Gast-Warenkorb',
                    'subtitle' => $ac->customer_email ?: $ac->customer_phone,
                    'badge' => 'EUR ' . number_format($ac->cart_total, 2, ',', '.') . ' • ' . ucfirst($ac->recovery_status),
                    'url' => route('admin.abandoned-carts', ['q' => $ac->customer_email ?: $ac->customer_name]),
                    'category' => 'Verlassene Warenkörbe',
                ];
            });

        $totalResults = $products->count() + $orders->count() + $customers->count() + $coupons->count() + $deals->count() + $abandonedCarts->count();

        return response()->json([
            'success' => true,
            'query' => $q,
            'total_results' => $totalResults,
            'results' => [
                'products' => $products,
                'orders' => $orders,
                'customers' => $customers,
                'coupons' => $coupons,
                'deals' => $deals,
                'abandoned_carts' => $abandonedCarts,
            ]
        ]);
    }
}
