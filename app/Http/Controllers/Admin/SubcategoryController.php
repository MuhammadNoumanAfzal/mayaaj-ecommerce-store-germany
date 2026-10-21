<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of subcategories with filtering, searching, sorting & pagination.
     */
    public function index(Request $request)
    {
        $query = Subcategory::with('category')->withCount('products');

        // Search Filter (Name, Description, Slug, Parent Category)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Parent Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Status Filter
        if ($request->filled('status') && in_array($request->status, ['active', 'draft'])) {
            $query->where('status', $request->status);
        }

        // Dynamic Sorting
        $sort = $request->input('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'products_desc':
                $query->orderBy('products_count', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        // Pagination (10 per page, matching categories)
        $subcategories = $query->paginate(10)->withQueryString();

        // Categories for filter dropdown
        $categories = Category::withCount('subcategories')->orderBy('name')->get();

        // Compact KPI Metrics
        $totalCount = Subcategory::count();
        $activeCount = Subcategory::where('status', 'active')->count();
        $draftCount = Subcategory::where('status', 'draft')->count();

        // Instant autocomplete suggestions dataset
        $allSubcategoriesForSuggestions = Subcategory::select('id', 'name', 'slug', 'image', 'status', 'category_id')
            ->with('category:id,name')
            ->withCount('products')
            ->orderBy('name')
            ->get()
            ->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'name' => $sub->name,
                    'slug' => $sub->slug,
                    'category_name' => $sub->category ? $sub->category->name : 'N/A',
                    'category_id' => $sub->category_id,
                    'image_url' => $sub->image_url,
                    'status' => $sub->status,
                    'products_count' => $sub->products_count,
                ];
            });

        return view('admin.subcategories', compact(
            'subcategories',
            'categories',
            'totalCount',
            'activeCount',
            'draftCount',
            'allSubcategoriesForSuggestions'
        ));
    }

    /**
     * Show the form for creating a new subcategory.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created subcategory in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('subcategories', 'public');
            $validated['image'] = $path;
        }

        Subcategory::create($validated);

        return redirect()->route('admin.subcategories')->with('success', __('admin.subcategory_created'));
    }

    /**
     * Show the form for editing the specified subcategory.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified subcategory in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
                Storage::disk('public')->delete($subcategory->image);
            }

            $path = $request->file('image')->store('subcategories', 'public');
            $validated['image'] = $path;
        }

        $subcategory->update($validated);

        return redirect()->route('admin.subcategories')->with('success', __('admin.subcategory_updated'));
    }

    /**
     * Remove the specified subcategory from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->image && Storage::disk('public')->exists($subcategory->image)) {
            Storage::disk('public')->delete($subcategory->image);
        }

        $subcategory->delete();

        return redirect()->route('admin.subcategories')->with('success', __('admin.subcategory_deleted'));
    }
}
