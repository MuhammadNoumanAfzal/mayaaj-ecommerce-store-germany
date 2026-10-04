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

        // Max Price Filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
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

        $products = $query->paginate(12)->withQueryString();

        [$dbMinPrice, $dbMaxPrice] = \Illuminate\Support\Facades\Cache::remember('mehaaj_shop_price_bounds', 300, function () {
            $bounds = Product::where('status', 'active')
                ->selectRaw('MIN(price) as min_p, MAX(price) as max_p')
                ->first();

            $min = (int) floor($bounds->min_p ?? 0);
            $max = (int) ceil($bounds->max_p ?? 1000);
            return [$min, $max > 0 ? $max : 1000];
        });

        return view('pages.shop', compact('products', 'dbMinPrice', 'dbMaxPrice'));
    }

    /**
     * Display single product detail page.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with(['category', 'subcategory'])
            ->firstOrFail();

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

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }
}
