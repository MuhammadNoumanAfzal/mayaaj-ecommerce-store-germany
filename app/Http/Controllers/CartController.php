<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Deal;
use App\Models\AbandonedCart;
use App\Models\Currency;

class CartController extends Controller
{
    private function formatCartPrice(float $amount): string
    {
        return function_exists('currency_format')
            ? currency_format($amount)
            : '€' . number_format($amount, 2, '.', ',');
    }
    /**
     * Display the cart page or return JSON representation of cart.
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'cart' => $cart,
                'count' => $totals['count'],
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['discount'],
                'coupon' => $totals['coupon'],
                'vat' => $totals['vat'],
                'total' => $totals['total'],
                'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
                'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
                'formatted_vat' => $this->formatCartPrice($totals['vat']),
                'formatted_total' => $this->formatCartPrice($totals['total']),
            ]);
        }

        return view('pages.cart', [
            'cart' => $cart,
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'count' => $totals['count'],
        ]);
    }

    /**
     * Display dedicated checkout page.
     */
    public function checkoutPage(Request $request)
    {
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        return view('pages.checkout', [
            'cart' => $cart,
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'count' => $totals['count'],
        ]);
    }

    /**
     * Get JSON data for current session cart.
     */
    public function getCartData()
    {
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|integer',
            'slug' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);
        $product = null;

        if ($request->filled('product_id')) {
            $product = Product::find($request->product_id);
        } elseif ($request->filled('slug')) {
            $product = Product::where('slug', $request->slug)->first();
        }

        // Fallback: If no product found, check if first available product can be used
        if (!$product) {
            $product = Product::first();
        }

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produkt nicht gefunden.',
            ], 404);
        }

        $cart = session()->get('cart', []);
        $variation = $request->input('variation');
        $effectivePrice = ($product->sale_price && $product->sale_price < $product->price) ? (float)$product->sale_price : (float)$product->price;
        $sku = $product->sku ?? ('MHJ-' . $product->id);

        if ($variation && is_array($product->variations)) {
            foreach ($product->variations as $var) {
                if (isset($var['name']) && $var['name'] === $variation) {
                    if (!empty($var['price'])) {
                        $effectivePrice = (float) $var['price'];
                    }
                    if (!empty($var['sku'])) {
                        $sku = $var['sku'];
                    }
                    break;
                }
            }
        }

        $itemKey = $product->id . ($variation ? '_' . \Illuminate\Support\Str::slug($variation) : '');

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['qty'] += $quantity;
        } else {
            $cart[$itemKey] = [
                'item_key' => $itemKey,
                'id' => $product->id,
                'name' => $product->name,
                'variation' => $variation,
                'price' => $effectivePrice,
                'image_url' => $product->image_url,
                'slug' => $product->slug,
                'qty' => $quantity,
                'sku' => $sku,
            ];
        }

        session()->put('cart', $cart);
        $totals = $this->calculateTotals($cart);

        $isEn = app()->getLocale() === 'en';
        $itemDisplay = $product->name . ($variation ? " ({$variation})" : "");
        return response()->json([
            'success' => true,
            'message' => $itemDisplay . ($isEn ? ' has been added to your shopping cart.' : ' wurde zum Warenkorb hinzugefügt.'),
            'added_product' => $itemDisplay,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * Add entire curated product bundle deal to cart with package savings.
     */
    public function addBundle(Request $request)
    {
        $request->validate([
            'deal_id' => 'required|integer|exists:deals,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'integer|exists:products,id',
        ]);

        $deal = Deal::with('products')->findOrFail($request->deal_id);

        if (!$deal->is_active || $deal->is_expired) {
            $isEn = app()->getLocale() === 'en';
            return response()->json([
                'success' => false,
                'message' => $isEn ? 'This deal is no longer active.' : 'Dieses Bundle-Angebot ist leider nicht mehr aktiv.',
            ], 422);
        }

        // Get products to bundle (all products in deal or selected subset)
        $selectedIds = $request->input('product_ids', []);
        $bundleProducts = empty($selectedIds) 
            ? $deal->products 
            : $deal->products->whereIn('id', $selectedIds);

        if ($bundleProducts->count() < 2) {
            $isEn = app()->getLocale() === 'en';
            return response()->json([
                'success' => false,
                'message' => $isEn ? 'Please select at least 2 bundle items.' : 'Bitte wählen Sie mindestens 2 Bundle-Artikel aus.',
            ], 422);
        }

        // Calculate proportional package prices
        $regTotal = 0;
        foreach ($bundleProducts as $p) {
            $regTotal += ($p->sale_price && $p->sale_price < $p->price) ? (float)$p->sale_price : (float)$p->price;
        }

        $bundlePrice = $deal->bundle_price;
        $ratio = ($regTotal > 0) ? ($bundlePrice / $regTotal) : 1;

        $cart = session()->get('cart', []);

        foreach ($bundleProducts as $p) {
            $effectiveReg = ($p->sale_price && $p->sale_price < $p->price) ? (float)$p->sale_price : (float)$p->price;
            $packageItemPrice = round($effectiveReg * $ratio, 2);
            $itemKey = 'bundle_' . $deal->id . '_' . $p->id;

            $cart[$itemKey] = [
                'item_key' => $itemKey,
                'id' => $p->id,
                'name' => $p->name . ' [' . ($deal->badge_text ?: 'BUNDLE') . ']',
                'variation' => 'Curated Duo Set',
                'price' => $packageItemPrice,
                'image_url' => $p->image_url,
                'slug' => $p->slug,
                'qty' => 1,
                'sku' => $p->sku ?? ('MHJ-' . $p->id),
                'is_bundle' => true,
                'bundle_title' => $deal->title,
            ];
        }

        session()->put('cart', $cart);
        $totals = $this->calculateTotals($cart);

        $isEn = app()->getLocale() === 'en';
        $msg = $isEn
            ? "Curated set '{$deal->title}' added to your shopping bag! (Saved {$deal->savings_percentage}%)"
            : "Kuriertes Set '{$deal->title}' zum Warenkorb hinzugefügt! ({$deal->savings_percentage}% gespart)";

        return response()->json([
            'success' => true,
            'message' => $msg,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * Update item quantity in cart.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'item_key' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);

        $itemKey = $request->input('item_key') ?? (string) $request->input('product_id');
        $quantity = (int) $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            if ($quantity <= 0) {
                unset($cart[$itemKey]);
            } else {
                $cart[$itemKey]['qty'] = $quantity;
            }
            session()->put('cart', $cart);
        } elseif ($request->filled('product_id') && isset($cart[$request->input('product_id')])) {
            if ($quantity <= 0) {
                unset($cart[$request->input('product_id')]);
            } else {
                $cart[$request->input('product_id')]['qty'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'item_key' => 'nullable|string',
        ]);

        $itemKey = $request->input('item_key') ?? (string) $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            session()->put('cart', $cart);
        } elseif ($request->filled('product_id') && isset($cart[$request->input('product_id')])) {
            unset($cart[$request->input('product_id')]);
            session()->put('cart', $cart);
        }

        $totals = $this->calculateTotals($cart);

        $isEn = app()->getLocale() === 'en';
        return response()->json([
            'success' => true,
            'message' => $isEn ? 'Item removed from shopping cart.' : 'Artikel aus dem Warenkorb entfernt.',
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'coupon' => $totals['coupon'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * AJAX endpoint: Validate and apply coupon to active cart session.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
        ]);

        $code = strtoupper(trim($request->input('code')));
        $cart = session()->get('cart', []);

        $locale = app()->getLocale();
        $isEn = ($locale === 'en');

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => $isEn ? 'Your cart is empty. Please add products first.' : 'Ihr Warenkorb ist leer. Bitte legen Sie zuerst Artikel in den Warenkorb.',
            ], 422);
        }

        // Calculate subtotal before coupon
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ((float) ($item['price'] ?? 0) * (int) ($item['qty'] ?? 1));
        }

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => $isEn ? "Coupon code '{$code}' does not exist or is invalid." : "Gutscheincode '{$code}' ist ungültig.",
            ], 404);
        }

        $error = null;
        if (!$coupon->validateForCart($subtotal, $error, $locale)) {
            return response()->json([
                'success' => false,
                'message' => $error,
            ], 422);
        }

        $discount = $coupon->calculateDiscount($subtotal);

        // Store in session
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'discount' => $discount,
            'badge' => $coupon->badge_text,
        ]);

        $totals = $this->calculateTotals($cart);

        $successMsg = $isEn
            ? "Voucher code '{$coupon->code}' applied successfully (-{$coupon->badge_text})!"
            : "Gutscheincode '{$coupon->code}' erfolgreich angewendet (-{$coupon->badge_text})!";

        return response()->json([
            'success' => true,
            'message' => $successMsg,
            'coupon' => session('coupon'),
            'subtotal' => $totals['subtotal'],
            'discount' => $totals['discount'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => $this->formatCartPrice($totals['subtotal']),
            'formatted_discount' => '- ' . $this->formatCartPrice($totals['discount']),
            'formatted_vat' => $this->formatCartPrice($totals['vat']),
            'formatted_total' => $this->formatCartPrice($totals['total']),
        ]);
    }

    /**
     * AJAX endpoint: Remove applied coupon from active session.
     */
    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        $isEn = app()->getLocale() === 'en';
        return response()->json([
            'success' => true,
            'message' => $isEn ? 'Voucher removed from order.' : 'Gutscheincode entfernt.',
            'subtotal' => $totals['subtotal'],
            'discount' => 0,
            'coupon' => null,
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
            'formatted_discount' => 'EUR 0,00',
            'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
            'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
        ]);
    }

    /**
     * Process Customer Checkout & Store Order in Database.
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:50',
            'street' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|string|in:cod,cash_on_delivery,vorkasse,bank_transfer,manual_bank_transfer',
            'voucher_code' => 'nullable|string|max:50',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            $isEn = app()->getLocale() === 'en';
            return response()->json([
                'success' => false,
                'message' => $isEn ? 'Your shopping cart is empty. Please add items before checking out.' : 'Ihr Warenkorb ist leer. Bitte fügen Sie Produkte hinzu, bevor Sie auschecken.',
            ], 422);
        }

        $totals = $this->calculateTotals($cart);
        $subtotal = $totals['subtotal'];
        $discountAmount = 0;
        $appliedCoupon = null;

        // Check if voucher was passed or present in session
        $couponCodeInput = trim($request->input('voucher_code') ?? '');
        if (!empty($couponCodeInput)) {
            $appliedCoupon = Coupon::where('code', strtoupper($couponCodeInput))->first();
        } elseif (session()->has('coupon')) {
            $sessionCoupon = session()->get('coupon');
            $appliedCoupon = Coupon::where('code', $sessionCoupon['code'] ?? '')->first();
        }

        $couponError = null;
        if ($appliedCoupon && $appliedCoupon->validateForCart($subtotal, $couponError, app()->getLocale())) {
            $discountAmount = $appliedCoupon->calculateDiscount($subtotal);
            $couponCode = $appliedCoupon->code;
        } else {
            $couponCode = null;
            $discountAmount = 0;
        }

        $totalAmount = max(0, round($subtotal - $discountAmount, 2));

        // Generate unique Order Number
        do {
            $orderNumber = 'MHJ-2026-' . rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        $customerName = trim($request->first_name . ' ' . $request->last_name);
        $rawMethod = strtolower($request->input('payment_method', 'cod'));
        
        if (in_array($rawMethod, ['cod', 'cash_on_delivery'])) {
            $paymentMethod = 'cod';
            $paymentMethodLabel = 'Cash on Delivery (Barzahlung bei Lieferung / Nachnahme)';
            $notes = "Zahlungsart: Barzahlung bei Lieferung (COD / Nachnahme) • Zahlung erfolgt direkt beim Kurier";
        } else {
            $paymentMethod = 'vorkasse';
            $paymentMethodLabel = 'Manual Bank Transfer (Vorkasse)';
            $notes = "Zahlungsart: Manuelle Banküberweisung (Vorkasse) • Ref: " . $orderNumber;
        }

        if ($couponCode && $discountAmount > 0) {
            $notes .= " | Eingelöster Gutschein: " . $couponCode . " (-" . number_format($discountAmount, 2, ',', '.') . " EUR)";
        }

        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $customerName,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'shipping_address' => $request->street,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'coupon_code' => $couponCode,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
            'status' => 'pending',
            'notes' => $notes,
        ]);

        // Create Order Items
        foreach ($cart as $item) {
            $productName = $item['name'] ?? 'Produkt';
            if (!empty($item['variation'])) {
                $productName .= ' (' . $item['variation'] . ')';
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'] ?? null,
                'product_name' => $productName,
                'unit_price' => $item['price'],
                'quantity' => $item['qty'],
                'subtotal' => round($item['price'] * $item['qty'], 2),
            ]);
        }

        // Update or Create Customer Record
        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {
            $customer->total_spent += $totalAmount;
            $customer->total_orders += 1;
            $customer->save();
        } else {
            $customer = Customer::create([
                'name' => $customerName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->street,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'vip_tier' => 'regular',
                'total_spent' => $totalAmount,
                'total_orders' => 1,
                'status' => 'active',
            ]);
        }

        // Record Coupon Usage & Increment Counter
        if ($appliedCoupon && $discountAmount > 0) {
            $appliedCoupon->increment('used_count');
            CouponUsage::create([
                'coupon_id' => $appliedCoupon->id,
                'order_id' => $order->id,
                'customer_id' => $customer ? $customer->id : null,
                'customer_email' => $request->email,
                'discount_amount' => $discountAmount,
            ]);
        }

        // Mark any matching Abandoned Cart as recovered
        try {
            AbandonedCart::where('session_id', session()->getId())
                ->orWhere(function ($q) use ($request) {
                    if (!empty($request->email)) {
                        $q->where('customer_email', $request->email)
                          ->whereIn('recovery_status', ['pending', 'contacted']);
                    }
                })
                ->update([
                    'recovery_status' => 'recovered',
                    'recovered_at' => now(),
                ]);
        } catch (\Exception $e) {
            \Log::error('Abandoned cart recovery status update error: ' . $e->getMessage());
        }

        // Clear Session Cart and Coupon
        session()->forget('cart');
        session()->forget('coupon');

        $isEn = app()->getLocale() === 'en';
        return response()->json([
            'success' => true,
            'message' => $isEn ? 'Order placed successfully! Thank you.' : 'Bestellung erfolgreich aufgegeben! Vielen Dank.',
            'order_number' => $order->order_number,
            'total_amount' => $order->total_amount,
            'formatted_total' => 'EUR ' . number_format($order->total_amount, 2, ',', '.'),
            'customer_name' => $customerName,
            'customer_email' => $order->customer_email,
            'payment_method' => $order->payment_method,
            'iban' => 'DE89 3704 0044 0532 0130 00',
            'bic' => 'DABA DE FF XXX',
            'bank_name' => 'Deutsche Bank AG Frankfurt',
        ]);
    }

    /**
     * Helper to compute subtotal, discount, vat, and total.
     */
    private function calculateTotals(array $cart): array
    {
        $subtotal = 0;
        $count = 0;

        foreach ($cart as $item) {
            $qty = (int) ($item['qty'] ?? 1);
            $price = (float) ($item['price'] ?? 0);
            $subtotal += ($price * $qty);
            $count += $qty;
        }

        $discount = 0;
        $activeCoupon = null;

        if (session()->has('coupon')) {
            $couponSession = session()->get('coupon');
            $couponModel = Coupon::where('code', $couponSession['code'] ?? '')->first();
            $err = null;
            if ($couponModel && $couponModel->validateForCart($subtotal, $err, app()->getLocale())) {
                $discount = $couponModel->calculateDiscount($subtotal);
                $activeCoupon = [
                    'id' => $couponModel->id,
                    'code' => $couponModel->code,
                    'type' => $couponModel->type,
                    'value' => $couponModel->value,
                    'badge' => $couponModel->badge_text,
                    'discount' => $discount,
                ];
                // Keep session updated with fresh discount
                session()->put('coupon', $activeCoupon);
            } else {
                session()->forget('coupon');
            }
        }

        $totalAfterDiscount = max(0, round($subtotal - $discount, 2));
        $vat = round($totalAfterDiscount * 0.19, 2);

        return [
            'count' => $count,
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'coupon' => $activeCoupon,
            'shipping' => 0.00,
            'vat' => $vat,
            'total' => $totalAfterDiscount,
        ];
    }

    /**
     * AJAX endpoint to continuously track cart abandonment when customer fills info
     */
    public function trackAbandonment(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }

        $email = trim($request->input('email', ''));
        $phone = trim($request->input('phone', ''));
        $firstName = trim($request->input('first_name', ''));
        $lastName = trim($request->input('last_name', ''));
        $name = trim($firstName . ' ' . $lastName);

        if (empty($email) && empty($phone) && empty($name)) {
            return response()->json(['success' => false, 'message' => 'No contact information provided']);
        }

        $totals = $this->calculateTotals($cart);
        $sessionId = session()->getId();

        // Check if there is an existing pending/contacted cart for this session or email
        $abandonedCart = AbandonedCart::where('session_id', $sessionId)
            ->whereIn('recovery_status', ['pending', 'contacted'])
            ->first();

        if (!$abandonedCart && !empty($email)) {
            $abandonedCart = AbandonedCart::where('customer_email', $email)
                ->whereIn('recovery_status', ['pending', 'contacted'])
                ->latest()
                ->first();
        }

        $customer = !empty($email) ? Customer::where('email', $email)->first() : null;

        if ($abandonedCart) {
            $abandonedCart->session_id = $sessionId;
            if ($customer) $abandonedCart->customer_id = $customer->id;
            if (!empty($name)) $abandonedCart->customer_name = $name;
            if (!empty($email)) $abandonedCart->customer_email = $email;
            if (!empty($phone)) $abandonedCart->customer_phone = $phone;
            $abandonedCart->cart_items = $cart;
            $abandonedCart->cart_total = $totals['total'];
            $abandonedCart->save();
        } else {
            $abandonedCart = AbandonedCart::create([
                'session_id' => $sessionId,
                'customer_id' => $customer ? $customer->id : null,
                'customer_name' => $name ?: null,
                'customer_email' => $email ?: null,
                'customer_phone' => $phone ?: null,
                'cart_items' => $cart,
                'cart_total' => $totals['total'],
                'recovery_status' => 'pending',
            ]);
        }

        return response()->json([
            'success' => true,
            'tracking_id' => $abandonedCart->id,
            'token' => $abandonedCart->recovery_token,
            'recovery_url' => $abandonedCart->recovery_url,
        ]);
    }

    /**
     * 1-Click Restore Cart Link
     */
    public function recoverCart(Request $request, $token)
    {
        $abandonedCart = AbandonedCart::where('recovery_token', $token)->firstOrFail();

        if (!empty($abandonedCart->cart_items) && is_array($abandonedCart->cart_items)) {
            session()->put('cart', $abandonedCart->cart_items);
        }

        // Save recovered customer contact info into session to pre-fill checkout fields
        session()->put('recovered_customer', [
            'name' => $abandonedCart->customer_name,
            'email' => $abandonedCart->customer_email,
            'phone' => $abandonedCart->customer_phone,
        ]);

        $isEn = app()->getLocale() === 'en';
        $msg = $isEn
            ? 'Your luxury shopping bag has been successfully restored! Please complete your order.'
            : 'Ihr exklusiver Warenkorb wurde erfolgreich wiederhergestellt! Bitte schließen Sie Ihre Bestellung ab.';

        return redirect()->route('checkout.index')->with('recovery_success', $msg);
    }
}
