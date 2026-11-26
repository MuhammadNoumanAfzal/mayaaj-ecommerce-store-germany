<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\AdminAuthMiddleware;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Shop Catalog & Collection Pages
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop-catalog', [ShopController::class, 'index'])->name('shop.index');
Route::get('/kollektion', [ShopController::class, 'index'])->name('kollektion');
Route::get('/collection', [ShopController::class, 'index'])->name('collection');
Route::get('/search/live', [ShopController::class, 'liveSearch'])->name('search.live');

// Single Product Detail Pages (Dynamic Slug)
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('products.detail');

// Category & Subcategory Direct Routes
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('category.show');
Route::get('/category/{catSlug}/{subcatSlug}', [ShopController::class, 'subcategory'])->name('subcategory.show');

// Shopping Bag & Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/warenkorb', [CartController::class, 'index'])->name('cart.de');
Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/add-bundle', [CartController::class, 'addBundle'])->name('cart.add-bundle');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove-coupon');

// Curated Deals & Bundles Public Routes
Route::get('/deals', [ShopController::class, 'deals'])->name('deals');
Route::get('/angebote', [ShopController::class, 'deals'])->name('deals.de');

// Abandoned Cart Real-Time Tracking & 1-Click Recovery
Route::post('/cart/track-abandonment', [CartController::class, 'trackAbandonment'])->name('cart.track-abandonment');
Route::get('/cart/recover/{token}', [CartController::class, 'recoverCart'])->name('cart.recover');

// Customer Order Logistics & Courier Tracking Lookup
Route::get('/order/track', [ShopController::class, 'trackOrder'])->name('order.track');
Route::get('/bestellung-verfolgen', [ShopController::class, 'trackOrder'])->name('order.track.de');
Route::post('/order/track', [ShopController::class, 'lookupOrder'])->name('order.track.lookup');

// Dedicated Checkout Page Routes
Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.index');
Route::get('/kasse', [CartController::class, 'checkoutPage'])->name('checkout.de');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/contact', function () {
    return redirect('/');
})->name('contact');

// Maison Heritage & About Page Routes
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::get('/ueber-uns', function () { return view('pages.about'); })->name('about.de');

Route::get('/impressum', function() { return view('pages.impressum'); })->name('impressum');
Route::get('/datenschutz', function() { return view('pages.privacy'); })->name('privacy');
Route::get('/agb', function() { return view('pages.agb'); })->name('agb');
Route::get('/versand', function() { return view('pages.shipping'); })->name('shipping');
Route::get('/rueckgabe', function() { return view('pages.returns'); })->name('returns');

// Maison Client Reviews & Patron Testimonials
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/bewertungen', [ReviewController::class, 'index'])->name('reviews.de');
Route::get('/kundenbewertungen', [ReviewController::class, 'index'])->name('reviews.de2');

// Global Frontend & System Language Switcher Route
Route::match(['get', 'post'], '/lang/{locale}', function ($locale, \Illuminate\Http\Request $request) {
    if (!in_array($locale, ['en', 'de'])) {
        $locale = 'en';
    }
    session(['locale' => $locale]);
    cookie()->queue(cookie()->make('locale', $locale, 60 * 24 * 365));
    cookie()->queue(cookie()->make('mehaaj_lang', $locale, 60 * 24 * 365));
    cookie()->queue(cookie()->make('mehaaj_admin_lang', $locale, 60 * 24 * 365));
    app()->setLocale($locale);
    if ($request->wantsJson() || $request->ajax()) {
        return response()->json(['success' => true, 'locale' => $locale]);
    }
    return redirect()->back();
})->name('site.lang');

/*
|--------------------------------------------------------------------------
| Admin Portal Routes (Authentication, Categories & Subcategories)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Root Admin Redirect
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Language Switcher Route
    Route::match(['get', 'post'], '/lang/{locale}', function ($locale, \Illuminate\Http\Request $request) {
        if (!in_array($locale, ['en', 'de'])) {
            $locale = 'en';
        }
        session(['locale' => $locale]);
        cookie()->queue(cookie()->make('mehaaj_admin_lang', $locale, 60 * 24 * 365));
        cookie()->queue(cookie()->make('locale', $locale, 60 * 24 * 365));
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'locale' => $locale]);
        }
        return redirect()->back();
    })->name('lang');

    // Guest Admin Auth Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware([AdminAuthMiddleware::class])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard accessible by all authenticated roles
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/export-csv', [DashboardController::class, 'exportCsv'])->name('dashboard.export-csv');

        // Dynamic Locale Switcher for English / German (Persistent)
        Route::post('/lang/{locale}', function (string $locale) {
            if (in_array($locale, ['en', 'de'])) {
                session(['locale' => $locale, 'mehaaj_admin_lang' => $locale]);
                cookie()->queue('mehaaj_admin_lang', $locale, 60 * 24 * 365);
                cookie()->queue('locale', $locale, 60 * 24 * 365);
                app()->setLocale($locale);
            }
            return response()->json(['success' => true, 'locale' => $locale]);
        })->name('lang.switch');

        // 1. Staff & Role Management (Super Admin Exclusive)
        Route::middleware(['admin.role:super_admin'])->group(function () {
            Route::get('/staff', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('staff');
            Route::post('/staff', [\App\Http\Controllers\Admin\StaffController::class, 'store'])->name('staff.store');
            Route::put('/staff/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'update'])->name('staff.update');
            Route::post('/staff/{staff}/toggle-status', [\App\Http\Controllers\Admin\StaffController::class, 'toggleStatus'])->name('staff.toggle-status');
            Route::delete('/staff/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'destroy'])->name('staff.destroy');

            // Store Settings (Super Admin Exclusive)
            Route::get('/settings', [SettingController::class, 'index'])->name('settings');
            Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        });

        // 2. Catalog & Stock Control (Super Admin, Store Admin & Inventory Manager)
        Route::middleware(['admin.role:super_admin,admin,inventory_manager'])->group(function () {
            // Categories CRUD Routes
            Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
            Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::patch('/categories/{category}/status', [CategoryController::class, 'updateStatus'])->name('categories.update-status');
            Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

            // Subcategories CRUD Routes
            Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
            Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
            Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
            Route::get('/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
            Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
            Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

            // Products CRUD Routes
            Route::get('/products', [ProductController::class, 'index'])->name('products');
            Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('products.store');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

            // Deals & Product Bundles CRUD Routes
            Route::get('/deals', [\App\Http\Controllers\Admin\DealController::class, 'index'])->name('deals');
            Route::get('/deals/create', [\App\Http\Controllers\Admin\DealController::class, 'create'])->name('deals.create');
            Route::post('/deals', [\App\Http\Controllers\Admin\DealController::class, 'store'])->name('deals.store');
            Route::get('/deals/{deal}/edit', [\App\Http\Controllers\Admin\DealController::class, 'edit'])->name('deals.edit');
            Route::put('/deals/{deal}', [\App\Http\Controllers\Admin\DealController::class, 'update'])->name('deals.update');
            Route::post('/deals/{deal}/toggle-status', [\App\Http\Controllers\Admin\DealController::class, 'toggleStatus'])->name('deals.toggle-status');
            Route::delete('/deals/{deal}', [\App\Http\Controllers\Admin\DealController::class, 'destroy'])->name('deals.destroy');

            // Dedicated Inventory & Stock Management Routes
            Route::get('/inventory', [\App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('inventory');
            Route::post('/inventory/update-stock', [\App\Http\Controllers\Admin\InventoryController::class, 'updateStock'])->name('inventory.update-stock');
        });

        // 3. Orders & VIP Customers (Super Admin & Store Admin)
        Route::middleware(['admin.role:super_admin,admin'])->group(function () {
            // Orders & Invoices CRUD Routes
            Route::get('/orders', [OrderController::class, 'index'])->name('orders');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::get('/orders/{order}/invoice', [OrderController::class, 'printInvoice'])->name('orders.invoice');
            Route::get('/orders/{order}/packing-slip', [OrderController::class, 'printPackingSlip'])->name('orders.packing-slip');
            Route::post('/orders/{order}/fulfillment', [OrderController::class, 'updateFulfillment'])->name('orders.fulfillment');
            Route::post('/orders/{order}/upload-receipt', [OrderController::class, 'uploadReceipt'])->name('orders.upload-receipt');
            Route::post('/orders/{order}/send-dispatch-email', [OrderController::class, 'sendDispatchEmail'])->name('orders.send-dispatch-email');
            Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
            Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

            // Abandoned Carts Recovery Engine Routes
            Route::get('/abandoned-carts', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'index'])->name('abandoned-carts');
            Route::post('/abandoned-carts/{id}/send-email', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'sendRecoveryEmail'])->name('abandoned-carts.send-email');
            Route::post('/abandoned-carts/{id}/mark-contacted', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'markContacted'])->name('abandoned-carts.mark-contacted');
            Route::patch('/abandoned-carts/{id}/status', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'updateStatus'])->name('abandoned-carts.update-status');
            Route::delete('/abandoned-carts/{id}', [\App\Http\Controllers\Admin\AbandonedCartController::class, 'destroy'])->name('abandoned-carts.destroy');

            // Coupons & Promotional Engine CRUD Routes
            Route::get('/coupons', [\App\Http\Controllers\Admin\CouponController::class, 'index'])->name('coupons');
            Route::post('/coupons', [\App\Http\Controllers\Admin\CouponController::class, 'store'])->name('coupons.store');
            Route::put('/coupons/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'update'])->name('coupons.update');
            Route::post('/coupons/{coupon}/toggle-status', [\App\Http\Controllers\Admin\CouponController::class, 'toggleStatus'])->name('coupons.toggle-status');
            Route::delete('/coupons/{coupon}', [\App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('coupons.destroy');

            // VIP Customers CRUD Routes
            Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
            Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
            Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
            Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

            // Global Admin Live Search Route
            Route::get('/search', [\App\Http\Controllers\Admin\SearchController::class, 'search'])->name('search');

            // Dedicated E-Commerce Sales & ROI Analytics Dashboard
            Route::get('/analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics');

            // Financial Intelligence & Accounting (Profit & Loss, Balance Sheet, OpEx)
            Route::prefix('finance')->name('finance.')->group(function () {
                Route::get('/profit-loss', [\App\Http\Controllers\Admin\FinanceController::class, 'profitAndLoss'])->name('profit-loss');
                Route::get('/balance-sheet', [\App\Http\Controllers\Admin\FinanceController::class, 'balanceSheet'])->name('balance-sheet');
                Route::get('/expenses', [\App\Http\Controllers\Admin\FinanceController::class, 'expenses'])->name('expenses');
                Route::post('/expenses', [\App\Http\Controllers\Admin\FinanceController::class, 'storeExpense'])->name('expenses.store');
                Route::put('/expenses/{expense}', [\App\Http\Controllers\Admin\FinanceController::class, 'updateExpense'])->name('expenses.update');
                Route::delete('/expenses/{expense}', [\App\Http\Controllers\Admin\FinanceController::class, 'destroyExpense'])->name('expenses.destroy');
                Route::put('/balance-accounts/{account}', [\App\Http\Controllers\Admin\FinanceController::class, 'updateBalanceAccount'])->name('balance-accounts.update');
            });
        });

        // 4. Client Moderation & Inquiries (Super Admin, Store Admin & Review Moderator)
        Route::middleware(['admin.role:super_admin,admin,moderator'])->group(function () {
            // Customer Contact Inquiries / Messages Routes
            Route::get('/messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages');
            Route::get('/messages-index', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
            Route::get('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
            Route::put('/messages/{message}/status', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateStatus'])->name('messages.update-status');
            Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');

            // Customer Reviews & Feedback Moderation Routes
            Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews');
            Route::put('/reviews/{review}/status', [\App\Http\Controllers\Admin\ReviewController::class, 'updateStatus'])->name('reviews.update-status');
            Route::delete('/reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
        });
    });
});


