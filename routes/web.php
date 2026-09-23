<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\AdminAuthMiddleware;

use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('home');
});

// Customer Care & Service Pages
Route::get('/ueber-uns', function () {
    return view('pages.about');
});

Route::get('/about', function () {
    return view('pages.about');
});

use App\Http\Controllers\ContactController;

Route::get('/kontakt', [ContactController::class, 'show'])->name('contact');
Route::post('/kontakt', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/versand', function () {
    return view('pages.shipping');
});

Route::get('/rueckgabe', function () {
    return view('pages.returns');
});

Route::get('/faq', function () {
    return view('pages.faq');
});

// Mandatory German Legal Pages
Route::get('/impressum', function () {
    return view('pages.impressum');
});

Route::get('/datenschutz', function () {
    return view('pages.privacy');
});

Route::get('/agb', function () {
    return view('pages.agb');
});

// Shop Catalog & Collection Pages
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/kollektion', [ShopController::class, 'index'])->name('kollektion');

// Single Product Detail Pages (Dynamic Slug)
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Dynamic Cart & Customer Checkout Routes
use App\Http\Controllers\CartController;

Route::get('/warenkorb', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| Admin Portal Routes (Authentication, Categories & Subcategories)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Auth Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware([AdminAuthMiddleware::class])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Categories CRUD Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
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

        // Orders & Invoices CRUD Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

        // VIP Customers CRUD Routes
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

        // Store Settings Routes
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Customer Contact Inquiries / Messages Routes
        Route::get('/messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages');
        Route::get('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
        Route::put('/messages/{message}/status', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateStatus'])->name('messages.update-status');
        Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});
