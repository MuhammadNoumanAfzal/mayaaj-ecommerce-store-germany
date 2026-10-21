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
        $query = Review::where('status', 'approved')->with('product');

        // Rating Filter
        if ($request->filled('rating') && in_array((int)$request->rating, [1, 2, 3, 4, 5])) {
            $query->where('rating', (int)$request->rating);
        }

        // Product Filter
        if ($request->filled('product_id')) {
            $query->where('product_id', (int)$request->product_id);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'highest') {
            $query->orderBy('rating', 'desc')->latest();
        } elseif ($sort === 'lowest') {
            $query->orderBy('rating', 'asc')->latest();
        } elseif ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(9)->withQueryString();

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

        return view('pages.reviews', compact('reviews', 'totalCount', 'avgRating', 'ratingCounts', 'products', 'sort'));
    }

    /**
     * Submit a customer review (Ready, workable, and instantly verified).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'  => 'required|string|max:100',
            'customer_email' => 'required|email|max:150',
            'location'       => 'nullable|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'title'          => 'nullable|string|max:150',
            'comment'        => 'required|string|min:5|max:2000',
            'product_id'     => 'nullable|exists:products,id',
        ]);

        $validated['is_verified'] = true;
        $validated['status'] = 'approved';

        $review = Review::create($validated);
        $review->load('product');

        $isDe = session('locale', 'en') === 'de';
        $successMsg = $isDe
            ? 'Vielen Dank! Ihre verifizierte Bewertung wurde erfolgreich in unserem Atelier-Gästebuch veröffentlicht.'
            : 'Thank you! Your verified review has been published directly to our atelier guestbook.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'review'  => $review
            ]);
        }

        return redirect()->back()->with('success', $successMsg);
    }
}
