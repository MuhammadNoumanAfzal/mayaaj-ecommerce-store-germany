<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display the executive inventory management dashboard.
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

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Subcategory filter
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->input('subcategory_id'));
        }

        // Stock status filter tab
        $filter = $request->input('filter', 'all');
        if ($filter === 'low_stock') {
            $query->where('stock', '<=', 5)->where('stock', '>', 0);
        } elseif ($filter === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        } elseif ($filter === 'in_stock') {
            $query->where('stock', '>', 5);
        }

        // Dynamic Sorting
        $sortBy = $request->input('sort', 'stock_asc');
        switch ($sortBy) {
            case 'stock_desc':
                $query->orderBy('stock', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'stock_asc':
            default:
                $query->orderBy('stock', 'asc');
                break;
        }

        // Consistent 10 per page pagination with query string
        $products = $query->paginate(10)->withQueryString();

        // Calculate KPI Metrics across entire inventory
        $totalProducts = Product::count();
        $totalUnits = (int) Product::sum('stock');
        $inStockCount = Product::where('stock', '>', 5)->count();
        $lowStockCount = Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $outOfStockCount = Product::where('stock', '<=', 0)->count();
        
        $totalValuation = Product::all()->sum(function ($p) {
            return ($p->sale_price ?? $p->price) * max(0, (int)$p->stock);
        });

        // Categories & Subcategories with counts
        $categories = Category::withCount('products')->orderBy('name')->get();
        $subcategories = \App\Models\Subcategory::withCount('products')->orderBy('name')->get();

        // Autocomplete live suggestion data (zero-latency instant search)
        $allProductsForSuggestions = Product::select('id', 'name', 'slug', 'sku', 'price', 'sale_price', 'stock', 'status', 'category_id', 'image')
            ->with('category:id,name')
            ->orderBy('stock', 'asc')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'sku' => $p->sku,
                    'slug' => $p->slug,
                    'price' => (float)($p->sale_price ?? $p->price),
                    'stock' => (int)$p->stock,
                    'category' => $p->category->name ?? 'Unassigned',
                    'image_url' => $p->image ? asset('storage/' . $p->image) : null,
                ];
            });

        return view('admin.inventory.index', compact(
            'products',
            'categories',
            'subcategories',
            'totalProducts',
            'totalUnits',
            'inStockCount',
            'lowStockCount',
            'outOfStockCount',
            'totalValuation',
            'filter',
            'allProductsForSuggestions'
        ));
    }

    /**
     * Quickly update product stock via inline AJAX or form submit.
     */
    public function updateStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
            'variant_index' => 'nullable|integer',
            'variant_stock' => 'nullable|integer|min:0',
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        // If updating a specific variation's stock
        if ($request->has('variant_index') && $request->filled('variant_stock')) {
            $idx = (int)$request->input('variant_index');
            $vStock = (int)$request->input('variant_stock');
            
            $vars = $product->variations ?? [];
            if (isset($vars[$idx])) {
                $vars[$idx]['stock'] = $vStock;
                $product->variations = $vars;
            }
        }

        $product->stock = (int)$request->input('stock');
        $product->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lagerbestand erfolgreich aktualisiert / Stock updated successfully',
                'product_id' => $product->id,
                'new_stock' => $product->stock,
                'stock_status' => $product->stock > 5 ? 'in_stock' : ($product->stock > 0 ? 'low_stock' : 'out_of_stock')
            ]);
        }

        return redirect()->back()->with('success', 'Stock updated successfully!');
    }
}
