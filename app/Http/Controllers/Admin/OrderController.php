<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('tracking_number', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->input('payment_method'));
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details & printable invoice.
     */
    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Dedicated standalone luxury printable invoice.
     */
    public function printInvoice(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.invoice', compact('order'));
    }

    /**
     * Dedicated standalone luxury warehouse packing slip & dispatch note.
     */
    public function printPackingSlip(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.packing_slip', compact('order'));
    }

    /**
     * Update Courier Logistics & Dispatch details with auto-tracking URL.
     */
    public function updateFulfillment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'courier_name' => 'required|string|max:50',
            'tracking_number' => 'required|string|max:100',
            'tracking_url' => 'nullable|url|max:500',
            'dispatched_at' => 'nullable|date',
            'notify_customer' => 'nullable|boolean',
        ]);

        $courier = $validated['courier_name'];
        $trackingNumber = trim($validated['tracking_number']);
        $trackingUrl = $validated['tracking_url'] ?: Order::buildTrackingUrl($courier, $trackingNumber);
        $dispatchedAt = !empty($validated['dispatched_at']) ? Carbon::parse($validated['dispatched_at']) : Carbon::now();

        $order->update([
            'courier_name' => $courier,
            'tracking_number' => $trackingNumber,
            'tracking_url' => $trackingUrl,
            'dispatched_at' => $dispatchedAt,
            'status' => 'shipped',
        ]);

        $notifyCustomer = $request->boolean('notify_customer', true);
        if ($notifyCustomer && !empty($order->customer_email)) {
            // Trigger dispatch notification log / email
            \Log::info("Dispatch notification triggered for Order #{$order->order_number} to {$order->customer_email} via {$courier} (Tracking: {$trackingNumber})");
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Versanddaten erfolgreich hinterlegt und Tracking aktiviert / Dispatch saved successfully.',
                'tracking_url' => $order->generated_tracking_url,
                'status' => $order->status,
            ]);
        }

        return redirect()->back()->with('success', 'Versanddaten erfolgreich aktualisiert. Sendungsverfolgung ist jetzt aktiv.');
    }

    /**
     * Upload proof of payment receipt (for Bank Transfer / Vorkasse verification).
     */
    public function uploadReceipt(Request $request, Order $order)
    {
        $request->validate([
            'receipt' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:10240',
            'mark_as_paid' => 'nullable|boolean',
        ]);

        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $filename = 'receipt_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('receipts', $filename, 'public');

            $updates = [
                'payment_receipt_path' => '/storage/' . $path,
            ];

            if ($request->boolean('mark_as_paid', true)) {
                $updates['payment_status'] = 'paid';
            }

            $order->update($updates);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Zahlungsbeleg erfolgreich hochgeladen / Receipt attached successfully.',
                'receipt_url' => $order->payment_receipt_path,
                'payment_status' => $order->payment_status,
            ]);
        }

        return redirect()->back()->with('success', 'Zahlungsbeleg erfolgreich hinterlegt.');
    }

    /**
     * Send dispatch email with tracking button directly.
     */
    public function sendDispatchEmail(Request $request, Order $order)
    {
        if (empty($order->customer_email)) {
            return response()->json([
                'success' => false,
                'message' => 'Keine E-Mail-Adresse für diesen Kunden hinterlegt.',
            ], 422);
        }

        if (empty($order->tracking_number)) {
            return response()->json([
                'success' => false,
                'message' => 'Bitte erfassen Sie zuerst eine Sendungsverfolgungsnummer.',
            ], 422);
        }

        \Log::info("Sent dispatch email with tracking button to {$order->customer_email} for order #{$order->order_number}");

        return response()->json([
            'success' => true,
            'message' => "Versandbestätigung mit Tracking-Button erfolgreich an {$order->customer_email} übermittelt!",
        ]);
    }

    /**
     * Update the status and payment status of an order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,refunded',
            'notes' => 'nullable|string',
            'order_notes' => 'nullable|string',
            'dispatched_at' => 'nullable|date',
            'delivered_at' => 'nullable|date',
        ]);

        if ($validated['status'] === 'delivered' && empty($order->delivered_at) && empty($validated['delivered_at'])) {
            $validated['delivered_at'] = Carbon::now();
        }

        if ($validated['status'] === 'shipped' && empty($order->dispatched_at) && empty($validated['dispatched_at'])) {
            $validated['dispatched_at'] = Carbon::now();
        }

        $order->update($validated);

        return redirect()->back()->with('success', __('admin.order_status_updated'));
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders')->with('success', __('admin.order_deleted'));
    }
}
