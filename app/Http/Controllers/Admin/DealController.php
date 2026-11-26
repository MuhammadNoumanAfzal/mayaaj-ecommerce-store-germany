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

        // Search Filter (EN, DE, badge, slug, or product names)
        $search = trim($request->input('search', $request->input('q', '')));
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_de', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhereHas('products', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Status Filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->active();
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($status === 'flash') {
                $query->active()->whereNotNull('ends_at')->where('ends_at', '>', now());
            } elseif ($status === 'expired') {
                $query->whereNotNull('ends_at')->where('ends_at', '<', now());
            }
        }

        // Discount Type Filter
        if ($request->filled('discount_type')) {
            $type = $request->input('discount_type');
            if (in_array($type, ['percentage_discount', 'fixed_discount', 'bundle_fixed_price'])) {
                $query->where('discount_type', $type);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'order_asc');
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'discount_desc':
                $query->orderBy('discount_value', 'desc');
                break;
            case 'discount_asc':
                $query->orderBy('discount_value', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('title_de', 'asc');
                break;
            case 'order_asc':
            default:
                $query->orderBy('sort_order', 'asc')->latest();
                break;
        }

        // Pagination
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [5, 10, 25, 50])) $perPage = 10;
        $deals = $query->paginate($perPage)->withQueryString();

        // High-level KPI Stats
        $stats = [
            'total' => Deal::count(),
            'active' => Deal::active()->count(),
            'flash' => Deal::active()->whereNotNull('ends_at')->where('ends_at', '>', now())->count(),
            'avg_savings' => Deal::active()->get()->avg(function ($deal) {
                return $deal->savings_amount;
            }) ?? 0,
        ];

        // Autocomplete live suggestion data for zero-latency floating panel
        $allDealsForSuggestions = Deal::select('id', 'title_en', 'title_de', 'slug', 'badge_text', 'discount_type', 'discount_value', 'is_active', 'ends_at')
            ->with(['products:id,name,image,price,sale_price'])
            ->withCount('products')
            ->latest()
            ->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,
                    'title' => $d->title,
                    'title_en' => $d->title_en,
                    'title_de' => $d->title_de,
                    'slug' => $d->slug,
                    'badge_text' => $d->formatted_badge,
                    'discount_type' => $d->discount_type,
                    'discount_value' => (float)$d->discount_value,
                    'regular_total' => (float)$d->regular_total,
                    'bundle_price' => (float)$d->bundle_price,
                    'savings_amount' => (float)$d->savings_amount,
                    'savings_percentage' => (int)$d->savings_percentage,
                    'products_count' => (int)$d->products_count,
                    'is_active' => (bool)$d->is_active,
                    'is_flash' => (bool)$d->is_flash,
                    'first_image' => $d->products->first() ? $d->products->first()->image_url : null,
                ];
            });

        return view('admin.deals.index', compact('deals', 'stats', 'allDealsForSuggestions'));
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

        $message = $deal->is_active 
            ? 'Bundle "' . $deal->title . '" is now LIVE on the storefront.' 
            : 'Bundle "' . $deal->title . '" is now HIDDEN from the storefront.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $deal->is_active,
                'status' => $deal->is_active ? 'active' : 'inactive',
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
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
