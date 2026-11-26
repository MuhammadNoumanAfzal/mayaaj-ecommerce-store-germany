<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display a listing of returns & RMA requests with KPI metrics.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = ReturnRequest::with(['order', 'items.product'])->latest();

        if ($status && in_array($status, ['pending', 'approved', 'received', 'refunded', 'rejected'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $searchTerm = '%' . trim($search) . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('return_number', 'like', $searchTerm)
                  ->orWhere('customer_name', 'like', $searchTerm)
                  ->orWhere('customer_email', 'like', $searchTerm)
                  ->orWhereHas('order', function ($oq) use ($searchTerm) {
                      $oq->where('order_number', 'like', $searchTerm);
                  });
            });
        }

        $returns = $query->paginate(15)->withQueryString();

        // Calculate KPI Metrics
        $totalReturnsCount = ReturnRequest::count();
        $pendingCount      = ReturnRequest::where('status', 'pending')->count();
        $approvedCount     = ReturnRequest::where('status', 'approved')->count();
        $receivedCount     = ReturnRequest::where('status', 'received')->count();
        $refundedCount     = ReturnRequest::where('status', 'refunded')->count();
        $rejectedCount     = ReturnRequest::where('status', 'rejected')->count();
        $totalRefundedSum  = ReturnRequest::where('status', 'refunded')->sum('refund_amount');
        $pendingRefundSum  = ReturnRequest::whereIn('status', ['pending', 'approved', 'received'])->sum('refund_amount');

        return view('admin.returns.index', compact(
            'returns',
            'status',
            'search',
            'totalReturnsCount',
            'pendingCount',
            'approvedCount',
            'receivedCount',
            'refundedCount',
            'rejectedCount',
            'totalRefundedSum',
            'pendingRefundSum'
        ));
    }

    /**
     * Update the moderation status of a return request.
     */
    public function updateStatus(Request $request, ReturnRequest $return)
    {
        $validated = $request->validate([
            'status'        => 'required|in:pending,approved,received,refunded,rejected',
            'admin_notes'   => 'nullable|string|max:1000',
            'refund_amount' => 'nullable|numeric|min:0',
        ]);

        $updates = [
            'status'      => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $return->admin_notes,
        ];

        if (isset($validated['refund_amount'])) {
            $updates['refund_amount'] = (float)$validated['refund_amount'];
        }

        if ($validated['status'] === 'approved' && empty($return->approved_at)) {
            $updates['approved_at'] = Carbon::now();
        }

        if ($validated['status'] === 'refunded' && empty($return->refunded_at)) {
            $updates['refunded_at'] = Carbon::now();
        }

        $return->update($updates);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "RMA-Status für {$return->return_number} erfolgreich auf '{$return->status}' aktualisiert.",
                'return'  => $return,
            ]);
        }

        return redirect()->back()->with('success', "RMA-Status für {$return->return_number} erfolgreich auf '{$return->status}' aktualisiert.");
    }

    /**
     * Remove the specified return request from storage.
     */
    public function destroy(ReturnRequest $return)
    {
        $returnNumber = $return->return_number;
        $return->delete();

        return redirect()->back()->with('success', "Retourenantrag {$returnNumber} wurde gelöscht.");
    }
}
