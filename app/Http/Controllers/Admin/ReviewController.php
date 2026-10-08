<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of customer reviews with moderation filters.
     */
    public function index(Request $request)
    {
        $query = Review::with('product')->latest();

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Rating Filter
        if ($request->filled('rating')) {
            $query->where('rating', (int)$request->rating);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $reviews = $query->paginate(15)->withQueryString();

        // KPI Statistics
        $totalCount = Review::count();
        $pendingCount = Review::where('status', 'pending')->count();
        $approvedCount = Review::where('status', 'approved')->count();
        $rejectedCount = Review::where('status', 'rejected')->count();
        $avgApprovedRating = $approvedCount > 0 ? round(Review::where('status', 'approved')->avg('rating'), 1) : 5.0;

        return view('admin.reviews.index', compact(
            'reviews',
            'totalCount',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'avgApprovedRating'
        ));
    }

    /**
     * Update the moderation status of a review (approved / rejected / pending).
     */
    public function updateStatus(Request $request, Review $review)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $review->status = $validated['status'];
        if ($validated['status'] === 'approved') {
            $review->is_verified = true;
        }
        $review->save();

        $message = match ($review->status) {
            'approved' => __('admin.review_approved', [], session('locale', 'en')) ?: 'Review approved successfully! It is now live on the store.',
            'rejected' => __('admin.review_rejected', [], session('locale', 'en')) ?: 'Review rejected. It is now hidden from the store.',
            default    => __('admin.review_pending', [], session('locale', 'en')) ?: 'Review status set to pending moderation.',
        };

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $review->status,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove a review from storage.
     */
    public function destroy(Request $request, Review $review)
    {
        $review->delete();

        $message = __('admin.review_deleted', [], session('locale', 'en')) ?: 'Review record deleted successfully! ✓';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
