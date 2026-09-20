<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
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

Route::get('/kontakt', function () {
    return view('pages.contact');
});

Route::get('/versand', function () {
    return view('pages.shipping');
});

Route::get('/rueckgabe', function () {
    return view('pages.returns');
});

Route::get('/faq', function () {
    return view('pages.faq');
});

// Mandatory German Legal Pages (Telemediengesetz / DSGVO / BGB)
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
Route::get('/shop', function () {
    return view('pages.shop');
});

Route::get('/kollektion', function () {
    return view('pages.shop');
});

// Single Product Detail Pages
Route::get('/shop/maison-leather-tote', function () {
    return view('pages.product-detail');
});

// Cart Pages
Route::get('/warenkorb', function () {
    return view('pages.cart');
});

Route::get('/cart', function () {
    return view('pages.cart');
});



