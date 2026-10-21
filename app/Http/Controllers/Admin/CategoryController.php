<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with advanced filtering, searching, sorting & pagination.
     */
    public function index(Request $request)
    {
        $query = Category::withCount(['subcategories', 'products'])
            ->with(['subcategories' => function ($q) {
                $q->orderBy('name');
            }]);

        // Search Filter (Name, Slug, Description)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status') && in_array($request->status, ['active', 'draft'])) {
            $query->where('status', $request->status);
        }

        // Dynamic Sorting / Indexing
        $sort = $request->input('sort', 'order_asc');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'products_desc':
                $query->orderBy('products_count', 'desc');
                break;
            case 'subs_desc':
                $query->orderBy('subcategories_count', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'order_asc':
            default:
                $query->orderBy('order_index', 'asc')->orderBy('name', 'asc');
                break;
        }

        // Pagination Per Page (10, 25, 50)
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $categories = $query->paginate($perPage)->withQueryString();

        // Executive KPI Metrics
        $totalCount = Category::count();
        $activeCount = Category::where('status', 'active')->count();
        $draftCount = Category::where('status', 'draft')->count();
        $totalSubcategories = Subcategory::count();
        $totalProducts = Product::whereNotNull('category_id')->count();

        // All categories for zero-latency live search suggestions popup
        $allCategoriesForSuggestions = Category::select('id', 'name', 'slug', 'image', 'status')
            ->withCount('products')
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                    'image_url' => $cat->image ? asset('storage/' . $cat->image) : null,
                    'status' => $cat->status,
                    'products_count' => $cat->products_count ?? 0,
                ];
            });

        return view('admin.categories', compact(
            'categories',
            'totalCount',
            'activeCount',
            'draftCount',
            'totalSubcategories',
            'totalProducts',
            'sort',
            'perPage',
            'allCategoriesForSuggestions'
        ));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $maxOrder = Category::max('order_index') ?? 0;
        $suggestedOrder = $maxOrder + 1;
        return view('admin.categories.create', compact('suggestedOrder'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'slug'        => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string|max:2000',
            'status'      => 'required|in:active,draft',
            'order_index' => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $validated['order_index'] = $validated['order_index'] !== null && $validated['order_index'] !== ''
            ? (int) $validated['order_index'] 
            : 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category = Category::create($validated);

        // Immediate cache purge for real-time frontend reflection
        Cache::forget('mehaaj_active_categories_tree');
        Cache::forget('mehaaj_shop_categories');

        $message = __('admin.category_created', [], session('locale', 'en')) ?: 'Category successfully created and synchronized with storefront! ✓';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'category' => $category,
            ]);
        }

        return redirect()->route('admin.categories')->with('success', $message);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $category->loadCount(['products', 'subcategories']);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug'        => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string|max:2000',
            'status'      => 'required|in:active,draft',
            'order_index' => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $validated['order_index'] = $validated['order_index'] !== null && $validated['order_index'] !== ''
            ? (int) $validated['order_index'] 
            : 0;

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category->update($validated);

        // Immediate cache purge
        Cache::forget('mehaaj_active_categories_tree');
        Cache::forget('mehaaj_shop_categories');

        $message = __('admin.category_updated', [], session('locale', 'en')) ?: 'Category details updated and synchronized with storefront! ✓';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'category' => $category,
            ]);
        }

        return redirect()->route('admin.categories')->with('success', $message);
    }

    /**
     * Toggle status (active/draft) quickly via AJAX or form.
     */
    public function updateStatus(Request $request, Category $category)
    {
        $newStatus = $category->status === 'active' ? 'draft' : 'active';
        $category->status = $newStatus;
        $category->save();

        Cache::forget('mehaaj_active_categories_tree');
        Cache::forget('mehaaj_shop_categories');

        $message = $newStatus === 'active' 
            ? 'Category is now LIVE and active on storefront.' 
            : 'Category is now HIDDEN as draft from storefront.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        $name = $category->name;
        $prodsCount = $category->products()->count();
        $subsCount = $category->subcategories()->count();

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        // Immediate cache purge
        Cache::forget('mehaaj_active_categories_tree');
        Cache::forget('mehaaj_shop_categories');

        $message = __('admin.category_deleted', [], session('locale', 'en')) 
            ?: "Category \"{$name}\" successfully deleted from store.";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'affected_products' => $prodsCount,
                'affected_subcategories' => $subsCount,
            ]);
        }

        return redirect()->route('admin.categories')->with('success', $message);
    }
}
