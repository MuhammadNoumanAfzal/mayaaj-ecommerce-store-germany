<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['components.navbar', 'components.featured-categories', 'components.featured-products', 'components.jewelry-section', 'pages.shop', 'home', 'layouts.app'], function ($view) {
            // Static Request Memoization: Prevents duplicate queries across multiple view composers in a single request
            static $memoizedData = null;

            if ($memoizedData === null) {
                try {
                    $categories = \Illuminate\Support\Facades\Cache::remember('mehaaj_active_categories_tree', 300, function () {
                        return Category::where('status', 'active')
                            ->with(['activeSubcategories'])
                            ->orderBy('order_index')
                            ->get();
                    });

                    $featuredProducts = \Illuminate\Support\Facades\Cache::remember('mehaaj_featured_products', 300, function () {
                        $prods = Product::where('status', 'active')
                            ->where('is_featured', true)
                            ->with(['category', 'subcategory'])
                            ->take(8)
                            ->get();
                        
                        if ($prods->isEmpty()) {
                            $prods = Product::where('status', 'active')
                                ->with(['category', 'subcategory'])
                                ->take(8)
                                ->get();
                        }
                        return $prods;
                    });

                    $jewelryProducts = \Illuminate\Support\Facades\Cache::remember('mehaaj_spotlight_products', 300, function () {
                        return Product::where('status', 'active')
                            ->with(['category', 'subcategory'])
                            ->latest()
                            ->take(3)
                            ->get();
                    });

                    $memoizedData = [
                        'categories' => $categories,
                        'featuredProducts' => $featuredProducts,
                        'jewelryProducts' => $jewelryProducts,
                    ];
                } catch (\Exception $e) {
                    $memoizedData = [
                        'categories' => collect(),
                        'featuredProducts' => collect(),
                        'jewelryProducts' => collect(),
                    ];
                }
            }

            $view->with('globalCategories', $memoizedData['categories']);
            $view->with('globalFeaturedProducts', $memoizedData['featuredProducts']);
            $view->with('jewelryProducts', $memoizedData['jewelryProducts']);
        });
    }
}
