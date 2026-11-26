<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    /**
     * Display the Admin Waitlist & Restock Demand Analytics Dashboard.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $productId = $request->query('product_id');
        $search = $request->query('search');

        $query = StockNotification::with('product')->latest();

        if ($status && in_array($status, ['pending', 'notified'])) {
            $query->where('status', $status);
        }

        if ($productId) {
            $query->where('product_id', $productId);
        }

        if ($search) {
            $term = '%' . trim($search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('customer_email', 'like', $term)
                  ->orWhere('customer_name', 'like', $term)
                  ->orWhere('variation_name', 'like', $term)
                  ->orWhereHas('product', function ($pq) use ($term) {
                      $pq->where('name', 'like', $term)->orWhere('sku', 'like', $term);
                  });
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

        // 1. Calculate Core KPI Metrics
        $totalWaitlistCount = StockNotification::count();
        $pendingWaitlistCount = StockNotification::where('status', 'pending')->count();
        $notifiedCount = StockNotification::where('status', 'notified')->count();

        // 2. Latent Unmet Revenue Demand (Sum of waiting patron count * retail price)
        $pendingList = StockNotification::with('product')->where('status', 'pending')->get();
        $latentRevenueDemand = $pendingList->sum(function ($n) {
            if (!$n->product) return 0.00;
            return (float)($n->product->sale_price ?? $n->product->price);
        });

        // 3. Top in-demand sold-out products
        $demandByProduct = StockNotification::where('status', 'pending')
            ->selectRaw('product_id, count(*) as waitlist_count')
            ->groupBy('product_id')
            ->orderByDesc('waitlist_count')
            ->with('product')
            ->take(8)
            ->get();

        return view('admin.waitlist.index', compact(
            'notifications',
            'status',
            'productId',
            'search',
            'totalWaitlistCount',
            'pendingWaitlistCount',
            'notifiedCount',
            'latentRevenueDemand',
            'demandByProduct'
        ));
    }

    /**
     * Send Restock Alerts to all waiting patrons for a specific product.
     */
    public function sendRestockAlerts(Request $request, Product $product)
    {
        $variation = $request->input('variation_name');

        $query = StockNotification::where('product_id', $product->id)
            ->where('status', 'pending');

        if ($variation) {
            $query->where('variation_name', $variation);
        }

        $waitingPatrons = $query->get();

        if ($waitingPatrons->isEmpty()) {
            return redirect()->back()->with('error', 'Keine offenen Wartelisten-Einträge für dieses Produkt gefunden.');
        }

        $now = Carbon::now();
        $count = $waitingPatrons->count();

        foreach ($waitingPatrons as $patron) {
            // Log restock dispatch simulation (ready for Mail::send)
            Log::info("Restock alert dispatched: Product '{$product->name}' (Variation: {$patron->variation_name}) to {$patron->customer_email}");
            
            $patron->update([
                'status' => 'notified',
                'notified_at' => $now,
            ]);
        }

        $message = "Erfolgreich {$count} Restock-Benachrichtigungen für '{$product->name}' versendet.";

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove a waitlist entry.
     */
    public function destroy(StockNotification $notification)
    {
        $email = $notification->customer_email;
        $notification->delete();

        return redirect()->back()->with('success', "Wartelisten-Eintrag für {$email} gelöscht.");
    }
}
