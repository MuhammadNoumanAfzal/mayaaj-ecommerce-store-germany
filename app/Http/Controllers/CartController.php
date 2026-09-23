<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;

class CartController extends Controller
{
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
                'vat' => $totals['vat'],
                'total' => $totals['total'],
                'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
                'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
                'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
            ]);
        }

        return view('pages.cart', [
            'cart' => $cart,
            'subtotal' => $totals['subtotal'],
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
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
            'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
            'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
            'free_shipping_progress' => $totals['free_shipping_progress'],
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

        // Fallback: If no product found, check if first available product can be used or return default item
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
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'image_url' => $product->primary_image_url,
                'slug' => $product->slug,
                'qty' => $quantity,
                'sku' => $product->sku ?? 'MHJ-' . $product->id,
            ];
        }

        session()->put('cart', $cart);
        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'message' => $product->name . ' wurde zum Warenkorb hinzugefügt.',
            'added_product' => $product->name,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
            'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
            'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
            'free_shipping_progress' => $totals['free_shipping_progress'],
        ]);
    }

    /**
     * Update item quantity in cart.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['qty'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
            'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
            'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
            'free_shipping_progress' => $totals['free_shipping_progress'],
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        $totals = $this->calculateTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Artikel aus dem Warenkorb entfernt.',
            'cart' => array_values($cart),
            'count' => $totals['count'],
            'subtotal' => $totals['subtotal'],
            'vat' => $totals['vat'],
            'total' => $totals['total'],
            'formatted_subtotal' => 'EUR ' . number_format($totals['subtotal'], 2, ',', '.'),
            'formatted_vat' => 'EUR ' . number_format($totals['vat'], 2, ',', '.'),
            'formatted_total' => 'EUR ' . number_format($totals['total'], 2, ',', '.'),
            'free_shipping_progress' => $totals['free_shipping_progress'],
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
            'payment_method' => 'nullable|string|in:vorkasse,bank_transfer,credit_card,paypal',
            'payer_name' => 'nullable|string|max:150',
            'payer_iban' => 'nullable|string|max:50',
            'voucher_code' => 'nullable|string|max:50',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Ihr Warenkorb ist leer. Bitte fügen Sie Produkte hinzu, bevor Sie auschecken.',
            ], 422);
        }

        $totals = $this->calculateTotals($cart);
        $totalAmount = $totals['total'];

        // Apply voucher discount if valid
        if (strtoupper($request->input('voucher_code')) === 'MEHAAJ10') {
            $totalAmount = round($totalAmount * 0.9, 2);
        }

        // Generate unique Order Number
        do {
            $orderNumber = 'MHJ-2026-' . rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        $customerName = trim($request->first_name . ' ' . $request->last_name);
        $paymentMethod = $request->input('payment_method', 'vorkasse');
        if ($paymentMethod === 'bank_transfer') {
            $paymentMethod = 'vorkasse';
        }

        // Create Order Record
        $notes = null;
        if ($request->filled('payer_name') || $request->filled('payer_iban')) {
            $notes = "Kontoinhaber: " . ($request->payer_name ?? 'N/A') . " | IBAN: " . ($request->payer_iban ?? 'N/A');
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
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending',
            'status' => 'pending',
            'notes' => $notes,
        ]);

        // Create Order Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'] ?? null,
                'product_name' => $item['name'],
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
            Customer::create([
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

        // Clear Session Cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Bestellung erfolgreich aufgegeben! Vielen Dank.',
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
     * Helper to compute subtotal, vat, and total.
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

        $vat = round($subtotal * 0.19, 2);
        $total = round($subtotal, 2);
        $progress = $subtotal > 0 ? min(100, (int) round(($subtotal / 150) * 100)) : 0;

        return [
            'count' => $count,
            'subtotal' => round($subtotal, 2),
            'vat' => $vat,
            'total' => $total,
            'free_shipping_progress' => $progress,
        ];
    }
}
