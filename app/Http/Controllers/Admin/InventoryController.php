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

        // Search filter (Name or SKU)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
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

        // Sorting
        $sortBy = $request->input('sort', 'stock_asc');
        if ($sortBy === 'stock_asc') {
            $query->orderBy('stock', 'asc');
        } elseif ($sortBy === 'stock_desc') {
            $query->orderBy('stock', 'desc');
        } elseif ($sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(15)->withQueryString();

        // Calculate KPI Metrics across entire inventory
        $totalProducts = Product::count();
        $totalUnits = (int) Product::sum('stock');
        $lowStockCount = Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $outOfStockCount = Product::where('stock', '<=', 0)->count();
        
        $totalValuation = Product::all()->sum(function ($p) {
            return ($p->sale_price ?? $p->price) * max(0, (int)$p->stock);
        });

        $categories = Category::orderBy('name')->get();

        return view('admin.inventory.index', compact(
            'products',
            'categories',
            'totalProducts',
            'totalUnits',
            'lowStockCount',
            'outOfStockCount',
            'totalValuation',
            'filter'
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
