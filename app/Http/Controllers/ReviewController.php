<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display the luxury reviews page.
     */
    public function index(Request $request)
    {
        $query = Review::where('status', 'approved')->latest();

        if ($request->filled('rating')) {
            $query->where('rating', (int)$request->rating);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', (int)$request->product_id);
        }

        $reviews = $query->paginate(9);

        $totalCount = Review::where('status', 'approved')->count();
        $avgRating = $totalCount > 0 ? round(Review::where('status', 'approved')->avg('rating'), 1) : 5.0;

        $ratingCounts = [
            5 => Review::where('status', 'approved')->where('rating', 5)->count(),
            4 => Review::where('status', 'approved')->where('rating', 4)->count(),
            3 => Review::where('status', 'approved')->where('rating', 3)->count(),
            2 => Review::where('status', 'approved')->where('rating', 2)->count(),
            1 => Review::where('status', 'approved')->where('rating', 1)->count(),
        ];

        $products = Product::where('status', 'active')->orderBy('name')->get();

        return view('pages.reviews', compact('reviews', 'totalCount', 'avgRating', 'ratingCounts', 'products'));
    }

    /**
     * Submit a customer review.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:150',
            'location' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:150',
            'comment' => 'required|string|min:10|max:1500',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $validated['is_verified'] = true;
        $validated['status'] = 'approved';

        $review = Review::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('admin.review_submitted', [], session('locale', 'en')) ?: 'Thank you! Your verified review has been submitted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
