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
        View::composer(['components.navbar', 'components.featured-categories', 'components.featured-products', 'pages.shop', 'home', 'layouts.app'], function ($view) {
            try {
                $categories = Category::where('status', 'active')
                    ->with(['activeSubcategories'])
                    ->orderBy('order_index')
                    ->get();
                $view->with('globalCategories', $categories);

                $featuredProducts = Product::where('status', 'active')
                    ->where('is_featured', true)
                    ->with(['category', 'subcategory'])
                    ->take(8)
                    ->get();
                
                if ($featuredProducts->isEmpty()) {
                    $featuredProducts = Product::where('status', 'active')
                        ->with(['category', 'subcategory'])
                        ->take(8)
                        ->get();
                }

                $view->with('globalFeaturedProducts', $featuredProducts);

            } catch (\Exception $e) {
                $view->with('globalCategories', collect());
                $view->with('globalFeaturedProducts', collect());
            }
        });
    }
}
