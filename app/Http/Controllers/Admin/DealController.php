<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DealController extends Controller
{
    /**
     * Display a listing of deals and bundles.
     */
    public function index(Request $request)
    {
        $query = Deal::with('products')->withCount('products');

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_de', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            if ($request->input('status') === 'active') {
                $query->active();
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $deals = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Deal::count(),
            'active' => Deal::active()->count(),
            'flash' => Deal::active()->whereNotNull('ends_at')->count(),
            'avg_savings' => Deal::active()->get()->avg(function ($deal) {
                return $deal->savings_amount;
            }) ?? 0,
        ];

        return view('admin.deals.index', compact('deals', 'stats'));
    }

    /**
     * Show form for creating a new product bundle deal.
     */
    public function create()
    {
        $products = Product::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'price', 'sale_price', 'image', 'sku', 'stock']);

        return view('admin.deals.create', compact('products'));
    }

    /**
     * Store a newly created deal and sync its products.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:150',
            'title_de' => 'required|string|max:150',
            'slug' => 'nullable|string|max:160|unique:deals,slug',
            'badge_text' => 'nullable|string|max:80',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'discount_type' => 'required|in:percentage_discount,fixed_discount,bundle_fixed_price',
            'discount_value' => 'required|numeric|min:0.01',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'products' => 'required|array|min:2',
            'products.*' => 'exists:products,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en'] ?: $validated['title_de']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure unique slug
        $baseSlug = $validated['slug'];
        $count = 1;
        while (Deal::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug . '-' . $count++;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $deal = Deal::create($validated);

        // Sync bundle products
        $syncData = [];
        foreach ($request->input('products', []) as $orderIdx => $productId) {
            $syncData[$productId] = [
                'is_required' => true,
                'sort_order' => $orderIdx,
            ];
        }
        $deal->products()->sync($syncData);

        return redirect()->route('admin.deals')->with('success', 'Produkt-Bundle "' . $deal->title . '" erfolgreich erstellt.');
    }

    /**
     * Show form for editing a deal.
     */
    public function edit(Deal $deal)
    {
        $deal->load('products');

        $products = Product::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'price', 'sale_price', 'image', 'sku', 'stock']);

        $selectedProductIds = $deal->products->pluck('id')->toArray();

        return view('admin.deals.edit', compact('deal', 'products', 'selectedProductIds'));
    }

    /**
     * Update an existing deal.
     */
    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:150',
            'title_de' => 'required|string|max:150',
            'slug' => 'nullable|string|max:160|unique:deals,slug,' . $deal->id,
            'badge_text' => 'nullable|string|max:80',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'discount_type' => 'required|in:percentage_discount,fixed_discount,bundle_fixed_price',
            'discount_value' => 'required|numeric|min:0.01',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'products' => 'required|array|min:2',
            'products.*' => 'exists:products,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en'] ?: $validated['title_de']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $deal->update($validated);

        // Sync bundle products
        $syncData = [];
        foreach ($request->input('products', []) as $orderIdx => $productId) {
            $syncData[$productId] = [
                'is_required' => true,
                'sort_order' => $orderIdx,
            ];
        }
        $deal->products()->sync($syncData);

        return redirect()->route('admin.deals')->with('success', 'Produkt-Bundle "' . $deal->title . '" erfolgreich aktualisiert.');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(Request $request, Deal $deal)
    {
        $deal->is_active = !$deal->is_active;
        $deal->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $deal->is_active,
                'message' => $deal->is_active ? 'Bundle aktiviert.' : 'Bundle deaktiviert.',
            ]);
        }

        return back()->with('success', 'Bundle-Status geändert.');
    }

    /**
     * Delete deal.
     */
    public function destroy(Deal $deal)
    {
        $title = $deal->title;
        $deal->products()->detach();
        $deal->delete();

        return redirect()->route('admin.deals')->with('success', 'Bundle "' . $title . '" gelöscht.');
    }
}
