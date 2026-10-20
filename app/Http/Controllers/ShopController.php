<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the storefront product catalog with search, category filtering & sorting.
     */
    public function index(Request $request)
    {
        $query = Product::where('status', 'active')->with(['category', 'subcategory']);

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category Filter (supports single slug or array of slugs)
        if ($request->filled('category')) {
            $catInput = (array) $request->input('category');
            $query->whereHas('category', function ($q) use ($catInput) {
                $q->whereIn('slug', $catInput);
            });
        }

        // Subcategory Filter (supports single slug or array of slugs)
        if ($request->filled('subcategory')) {
            $subInput = (array) $request->input('subcategory');
            $query->whereHas('subcategory', function ($q) use ($subInput) {
                $q->whereIn('slug', $subInput);
            });
        }

        // Min Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        // Max Price Filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        // Featured / Bestseller filter
        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        // In Stock filter
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        switch ($sort) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        [$dbMinPrice, $dbMaxPrice] = \Illuminate\Support\Facades\Cache::remember('mehaaj_shop_price_bounds', 300, function () {
            $bounds = Product::where('status', 'active')
                ->selectRaw('MIN(price) as min_p, MAX(price) as max_p')
                ->first();

            $min = (int) floor($bounds->min_p ?? 0);
            $max = (int) ceil($bounds->max_p ?? 1000);
            return [$min, $max > 0 ? $max : 1000];
        });

        $shopCategories = Category::where('status', 'active')
            ->withCount(['products' => function ($q) {
                $q->where('status', 'active');
            }])
            ->with(['activeSubcategories' => function ($q) {
                $q->withCount(['products' => function ($sq) {
                    $sq->where('status', 'active');
                }]);
            }])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.shop', compact('products', 'dbMinPrice', 'dbMaxPrice', 'shopCategories'));
    }

    /**
     * Display single product detail page with fallback for category or subcategory slugs.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with(['category', 'subcategory'])
            ->first();

        if (!$product) {
            // Graceful fallback: check if slug belongs to a category
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                return redirect()->route('shop', ['category' => $category->slug]);
            }

            // Graceful fallback: check if slug belongs to a subcategory
            $subcategory = Subcategory::where('slug', $slug)->first();
            if ($subcategory) {
                return redirect()->route('shop', ['subcategory' => $subcategory->slug]);
            }

            abort(404);
        }

        $relatedProducts = Product::where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                if ($product->category_id) {
                    $q->where('category_id', $product->category_id);
                }
            })
            ->with(['category'])
            ->take(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('status', 'active')
                ->where('id', '!=', $product->id)
                ->with(['category'])
                ->take(4)
                ->get();
        }

        $approvedReviews = $product->reviews()->where('status', 'approved')->latest()->get();

        return view('pages.product-detail', compact('product', 'relatedProducts', 'approvedReviews'));
    }

    /**
     * Dedicated Category routing
     */
    public function category($slug)
    {
        return redirect()->route('shop', ['category' => $slug]);
    }

    /**
     * Dedicated Subcategory routing
     */
    public function subcategory($catSlug, $subcatSlug)
    {
        return redirect()->route('shop', ['category' => $catSlug, 'subcategory' => $subcatSlug]);
    }
}
