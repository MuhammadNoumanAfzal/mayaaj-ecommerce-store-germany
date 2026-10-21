<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filtering, searching, sorting & pagination.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory']);

        // Search Filter (Name, SKU, Description, Category, Subcategory)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('subcategory', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Subcategory Filter
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->input('subcategory_id'));
        }

        // Status Filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if (in_array($status, ['active', 'draft'])) {
                $query->where('status', $status);
            } elseif ($status === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }

        // Stock Filter
        if ($request->filled('stock')) {
            if ($request->input('stock') === 'low') {
                $query->where('stock', '>', 0)->where('stock', '<=', 5);
            } elseif ($request->input('stock') === 'out') {
                $query->where('stock', '<=', 0);
            }
        }

        // Dynamic Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'stock_asc':
                $query->orderBy('stock', 'asc');
                break;
            case 'stock_desc':
                $query->orderBy('stock', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        // Pagination (10 per page, matching Categories and Subcategories)
        $products = $query->paginate(10)->withQueryString();

        // Categories & Subcategories for filter dropdowns
        $categories = Category::withCount('products')->orderBy('name')->get();
        $subcategories = Subcategory::withCount('products')->orderBy('name')->get();

        // KPI Counts
        $totalCount = Product::count();
        $activeCount = Product::where('status', 'active')->count();
        $draftCount = Product::where('status', 'draft')->count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        // Autocomplete live suggestion data (zero-latency instant search)
        $allProductsForSuggestions = Product::select('id', 'name', 'slug', 'sku', 'price', 'sale_price', 'stock', 'status', 'category_id', 'image')
            ->with('category:id,name')
            ->latest()
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'sku' => $p->sku,
                    'slug' => $p->slug,
                    'price' => (float)$p->price,
                    'sale_price' => $p->sale_price ? (float)$p->sale_price : null,
                    'stock' => (int)$p->stock,
                    'status' => $p->status,
                    'category_name' => $p->category ? $p->category->name : 'Unassigned',
                    'image_url' => $p->image ? asset('storage/' . $p->image) : null,
                ];
            });

        return view('admin.products', compact(
            'products',
            'categories',
            'subcategories',
            'totalCount',
            'activeCount',
            'draftCount',
            'lowStockCount',
            'allProductsForSuggestions'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'craftsmanship' => 'nullable|string',
            'variations' => 'nullable',
            'variations_json' => 'nullable|string',
            'accordion_tabs' => 'nullable',
            'accordion_tabs_json' => 'nullable|string',
            'status' => 'required|in:active,draft',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        $validated['sku'] = $validated['sku'] ?? 'MHJ-' . strtoupper(Str::random(6));
        $validated['is_featured'] = $request->has('is_featured');
        $validated['variations'] = $this->processVariations($request);
        $validated['accordion_tabs'] = $this->processAccordionTabs($request);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', __('admin.product_created'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'craftsmanship' => 'nullable|string',
            'variations' => 'nullable',
            'variations_json' => 'nullable|string',
            'accordion_tabs' => 'nullable',
            'accordion_tabs_json' => 'nullable|string',
            'status' => 'required|in:active,draft',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . $product->id;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['variations'] = $this->processVariations($request);
        $validated['accordion_tabs'] = $this->processAccordionTabs($request);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        if ($request->hasFile('gallery')) {
            if ($product->gallery_images && is_array($product->gallery_images)) {
                foreach ($product->gallery_images as $oldGallery) {
                    if (Storage::disk('public')->exists($oldGallery)) {
                        Storage::disk('public')->delete($oldGallery);
                    }
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', __('admin.product_updated'));
    }

    /**
     * Process product variations from request (JSON or array).
     */
    protected function processVariations(Request $request): ?array
    {
        if ($request->filled('variations_json')) {
            $decoded = json_decode($request->input('variations_json'), true);
            if (is_array($decoded)) {
                $clean = [];
                foreach ($decoded as $v) {
                    if (!empty($v['name'])) {
                        $clean[] = [
                            'name' => trim($v['name']),
                            'color' => $v['color'] ?? '#1c1210',
                            'price' => (!empty($v['price']) && is_numeric($v['price'])) ? (float)$v['price'] : null,
                            'sku' => !empty($v['sku']) ? trim($v['sku']) : null,
                            'stock' => (isset($v['stock']) && is_numeric($v['stock'])) ? (int)$v['stock'] : null,
                        ];
                    }
                }
                return count($clean) > 0 ? $clean : null;
            }
        }

        if ($request->has('variations') && is_array($request->input('variations'))) {
            $clean = [];
            foreach ($request->input('variations') as $v) {
                if (!empty($v['name'])) {
                    $clean[] = [
                        'name' => trim($v['name']),
                        'color' => $v['color'] ?? '#1c1210',
                        'price' => (!empty($v['price']) && is_numeric($v['price'])) ? (float)$v['price'] : null,
                        'sku' => !empty($v['sku']) ? trim($v['sku']) : null,
                        'stock' => (isset($v['stock']) && is_numeric($v['stock'])) ? (int)$v['stock'] : null,
                    ];
                }
            }
            return count($clean) > 0 ? $clean : null;
        }

        return null;
    }

    /**
     * Process accordion / FAQ tabs from request (JSON or array).
     */
    protected function processAccordionTabs(Request $request): ?array
    {
        if ($request->filled('accordion_tabs_json')) {
            $decoded = json_decode($request->input('accordion_tabs_json'), true);
            if (is_array($decoded)) {
                $clean = [];
                foreach ($decoded as $tab) {
                    if (!empty($tab['title'])) {
                        $features = [];
                        if (!empty($tab['features'])) {
                            if (is_array($tab['features'])) {
                                $features = array_values(array_filter(array_map('trim', $tab['features'])));
                            } else {
                                $features = array_values(array_filter(array_map('trim', explode("\n", $tab['features']))));
                            }
                        }
                        $clean[] = [
                            'title' => trim($tab['title']),
                            'dot_color' => $tab['dot_color'] ?? '#78000b',
                            'content' => $tab['content'] ?? '',
                            'features' => $features,
                        ];
                    }
                }
                return count($clean) > 0 ? $clean : null;
            }
        }

        if ($request->has('accordion_tabs') && is_array($request->input('accordion_tabs'))) {
            $clean = [];
            foreach ($request->input('accordion_tabs') as $tab) {
                if (!empty($tab['title'])) {
                    $features = [];
                    if (!empty($tab['features'])) {
                        if (is_array($tab['features'])) {
                            $features = array_values(array_filter(array_map('trim', $tab['features'])));
                        } else {
                            $features = array_values(array_filter(array_map('trim', explode("\n", $tab['features']))));
                        }
                    }
                    $clean[] = [
                        'title' => trim($tab['title']),
                        'dot_color' => $tab['dot_color'] ?? '#78000b',
                        'content' => $tab['content'] ?? '',
                        'features' => $features,
                    ];
                }
            }
            return count($clean) > 0 ? $clean : null;
        }

        return null;
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->gallery_images && is_array($product->gallery_images)) {
            foreach ($product->gallery_images as $oldGallery) {
                if (Storage::disk('public')->exists($oldGallery)) {
                    Storage::disk('public')->delete($oldGallery);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', __('admin.product_deleted'));
    }
}
