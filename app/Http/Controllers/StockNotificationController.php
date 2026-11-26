<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockNotification;
use Illuminate\Http\Request;

class StockNotificationController extends Controller
{
    /**
     * Store a new stock restock notification / waitlist subscription.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'variation_name' => 'nullable|string|max:100',
            'customer_email' => 'required|email|max:150',
            'customer_name'  => 'nullable|string|max:150',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if patron is already on the pending waitlist for this specific item & variation
        $existing = StockNotification::where('product_id', $product->id)
            ->where('customer_email', trim($validated['customer_email']))
            ->where('variation_name', $validated['variation_name'] ?? null)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'already_subscribed' => true,
                'message' => 'Sie stehen bereits auf der Prioritäts-Warteliste für dieses Atelier-Unikat. Wir benachrichtigen Sie umgehend per E-Mail, sobald es wieder verfügbar ist.',
                'message_en' => 'You are already on the priority waitlist for this piece. We will notify you immediately once restocked.',
            ]);
        }

        $notification = StockNotification::create([
            'product_id'     => $product->id,
            'variation_name' => $validated['variation_name'] ?? null,
            'customer_email' => trim($validated['customer_email']),
            'customer_name'  => $validated['customer_name'] ?? null,
            'status'         => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'already_subscribed' => false,
            'message' => 'Vielen Dank! Sie wurden erfolgreich auf die exklusive Atelier-Warteliste aufgenommen. Sobald neue Stücke vollendet sind, erhalten Sie eine Benachrichtigung.',
            'message_en' => 'Thank you! You have been added to our private atelier waitlist. You will receive an exclusive alert as soon as this creation is available.',
            'notification' => $notification,
        ]);
    }
}
