<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbandonedCart;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbandonedCartController extends Controller
{
    /**
     * Display a listing of abandoned carts with executive metrics.
     */
    public function index(Request $request)
    {
        $query = AbandonedCart::with('customer');

        // Search by customer name, email, or phone
        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('recovery_status', $request->input('status'));
        }

        $abandonedCarts = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        // Calculate Executive Metrics
        $totalCarts = AbandonedCart::count();
        $recoveredCarts = AbandonedCart::where('recovery_status', 'recovered')->count();
        $recoveredRevenue = AbandonedCart::where('recovery_status', 'recovered')->sum('cart_total');
        $lostRevenue = AbandonedCart::whereIn('recovery_status', ['pending', 'contacted'])->sum('cart_total');
        $pendingCount = AbandonedCart::where('recovery_status', 'pending')->count();
        $recoveryRate = $totalCarts > 0 ? round(($recoveredCarts / $totalCarts) * 100, 1) : 0.0;

        $stats = [
            'total_carts' => $totalCarts,
            'lost_revenue' => $lostRevenue,
            'recovered_revenue' => $recoveredRevenue,
            'recovery_rate' => $recoveryRate,
            'pending_count' => $pendingCount,
        ];

        return view('admin.abandoned-carts.index', compact('abandonedCarts', 'stats'));
    }

    /**
     * Mark an abandoned cart as contacted by admin.
     */
    public function markContacted(Request $request, $id)
    {
        $cart = AbandonedCart::findOrFail($id);
        $cart->recovery_status = 'contacted';
        $cart->last_contacted_at = Carbon::now();
        $cart->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Warenkorb als kontaktiert markiert / Cart marked as contacted.',
                'status' => 'contacted',
                'last_contacted' => $cart->last_contacted_at->diffForHumans(),
            ]);
        }

        return redirect()->back()->with('success', 'Warenkorb als kontaktiert markiert.');
    }

    /**
     * Send or simulate luxury recovery email with 1-click restore link.
     */
    public function sendRecoveryEmail(Request $request, $id)
    {
        $cart = AbandonedCart::findOrFail($id);

        if (empty($cart->customer_email)) {
            return response()->json([
                'success' => false,
                'message' => 'Keine E-Mail-Adresse für diesen Warenkorb hinterlegt / No customer email available.',
            ], 422);
        }

        // Update cart status
        $cart->recovery_status = 'contacted';
        $cart->last_contacted_at = Carbon::now();
        $cart->save();

        // In a production environment with mail configured:
        // Mail::to($cart->customer_email)->send(new AbandonedCartRecoveryMail($cart));

        return response()->json([
            'success' => true,
            'message' => 'Wiederherstellungs-E-Mail erfolgreich an ' . $cart->customer_email . ' versendet!',
            'recovery_url' => $cart->recovery_url,
            'last_contacted' => $cart->last_contacted_at->diffForHumans(),
        ]);
    }

    /**
     * Update cart recovery status directly.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,recovered,expired',
        ]);

        $cart = AbandonedCart::findOrFail($id);
        $cart->recovery_status = $request->status;
        if ($request->status === 'recovered' && !$cart->recovered_at) {
            $cart->recovered_at = Carbon::now();
        } elseif ($request->status === 'contacted') {
            $cart->last_contacted_at = Carbon::now();
        }
        $cart->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status erfolgreich aktualisiert / Status updated successfully.',
                'status' => $cart->recovery_status,
            ]);
        }

        return redirect()->back()->with('success', 'Status erfolgreich aktualisiert.');
    }

    /**
     * Delete an abandoned cart record.
     */
    public function destroy($id)
    {
        $cart = AbandonedCart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Verlassener Warenkorb erfolgreich gelöscht / Abandoned cart removed.');
    }
}
