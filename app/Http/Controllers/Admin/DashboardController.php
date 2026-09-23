<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contactMessagesCount = ContactMessage::count();
        $contactMessagesThisMonth = ContactMessage::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $ordersCount = Order::count();
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $productsCount = Product::count();
        $productsThisMonth = Product::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $customersCount = Customer::count();
        $customersThisMonth = Customer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $recentOrders = Order::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'contactMessagesCount',
            'contactMessagesThisMonth',
            'ordersCount',
            'ordersThisMonth',
            'productsCount',
            'productsThisMonth',
            'customersCount',
            'customersThisMonth',
            'recentOrders',
            'recentMessages'
        ));
    }
}
