<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReturnRequest;
use App\Models\ReturnItem;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display the self-service Returns & Widerrufsrecht Portal.
     */
    public function index(Request $request)
    {
        $order = null;
        $orderNumber = $request->query('order_number');
        $email = $request->query('email');
        $error = null;
        $daysRemaining = null;

        if ($orderNumber && $email) {
            $order = Order::with(['items.product'])->where('order_number', trim($orderNumber))
                ->where('customer_email', trim($email))
                ->first();

            if (!$order) {
                $error = 'Bestellung mit dieser Bestellnummer und E-Mail-Adresse wurde nicht gefunden (Order not found).';
            } elseif ($order->status === 'cancelled') {
                $error = 'Diese Bestellung wurde storniert und kann nicht zurückgegeben werden (Cancelled order).';
            } else {
                $daysSinceOrder = now()->diffInDays($order->created_at);
                if ($daysSinceOrder > 14) {
                    $error = "Die gesetzliche 14-tägige Widerrufsfrist für diese Bestellung ist vor " . ($daysSinceOrder - 14) . " Tagen abgelaufen.";
                } else {
                    $daysRemaining = 14 - $daysSinceOrder;
                }
            }
        }

        return view('pages.returns-portal', compact('order', 'orderNumber', 'email', 'error', 'daysRemaining'));
    }

    /**
     * Store a new Return Request (RMA).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'customer_name'  => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'reason'         => 'required|in:wrong_size,defect,changed_mind,not_as_pictured,other',
            'customer_notes' => 'nullable|string|max:1000',
            'items'          => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'photo'          => 'nullable|image|max:5120', // 5MB
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Double-check 14-day window
        if (now()->diffInDays($order->created_at) > 14) {
            return redirect()->back()->with('error', 'Die gesetzliche 14-Tage Widerrufsfrist ist abgelaufen.');
        }

        // Upload proof photo if present
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('returns', 'public');
        }

        $returnNumber = ReturnRequest::generateReturnNumber();

        // Calculate expected refund amount
        $refundAmount = 0.00;
        foreach ($validated['items'] as $it) {
            $orderItem = $order->items->firstWhere('product_id', $it['product_id']);
            $unitPrice = $orderItem ? (float)$orderItem->price : 0.00;
            $refundAmount += ($unitPrice * (int)$it['quantity']);
        }

        $returnRequest = ReturnRequest::create([
            'order_id'       => $order->id,
            'return_number'  => $returnNumber,
            'customer_name'  => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'status'         => 'pending',
            'reason'         => $validated['reason'],
            'customer_notes' => $validated['customer_notes'] ?? null,
            'refund_amount'  => $refundAmount,
            'photo_path'     => $photoPath,
        ]);

        // Save Return Items
        foreach ($validated['items'] as $it) {
            $orderItem = $order->items->firstWhere('product_id', $it['product_id']);
            $unitPrice = $orderItem ? (float)$orderItem->price : 0.00;

            ReturnItem::create([
                'return_request_id' => $returnRequest->id,
                'order_item_id'     => $orderItem?->id,
                'product_id'        => $it['product_id'],
                'quantity'          => (int)$it['quantity'],
                'unit_price'        => $unitPrice,
            ]);
        }

        return redirect()->route('returns.slip', $returnRequest->return_number)
            ->with('success', 'Ihr Widerrufsantrag wurde erfolgreich registriert. Bitte drucken Sie das Rücksendeetikett aus.');
    }

    /**
     * Display printable Return Slip (Rücksendeetikett / RMA).
     */
    public function returnSlip(string $returnNumber)
    {
        $returnRequest = ReturnRequest::with(['order', 'items.product'])
            ->where('return_number', $returnNumber)
            ->firstOrFail();

        return view('pages.return-slip', compact('returnRequest'));
    }
}
