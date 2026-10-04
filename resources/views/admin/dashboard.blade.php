@extends('layouts.admin')
@section('title', 'Admin Dashboard - MAYAJ Luxury Atelier')

@section('admin-content')
<div class="space-y-8">

    <!-- Hero Header Banner (Terracotta Elegance) -->
    <div class="rounded-2xl p-6 sm:p-8 bg-gradient-to-r from-[#964B42] via-[#8B423A] to-[#803D35] flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-sm text-white">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                <svg class="h-3.5 w-3.5 text-rose-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span data-i18n-en="ATELIER EXECUTIVE OVERVIEW" data-i18n-de="ATELIER EXECUTIVE ÜBERSICHT">ATELIER EXECUTIVE OVERVIEW</span>
            </div>
            <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Executive Atelier Control Center" data-i18n-de="Executive Atelier Kontrollzentrum">
                Executive Atelier Control Center
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl" data-i18n-en="Real-time sales velocity, catalogue performance, and customer concierge analytics." data-i18n-de="Echtzeit-Umsatzgeschwindigkeiten, Katalog-Performance und Kunden-Concierge Analysen.">
                Real-time sales velocity, catalogue performance, and customer concierge analytics.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[130px]">
                <span class="block text-2xl font-bold font-serif text-white">€{{ number_format($totalRevenue, 0, '.', ',') }}</span>
                <span class="text-[0.68rem] font-semibold text-rose-200 uppercase tracking-wider" data-i18n-en="Total Revenue" data-i18n-de="Gesamtumsatz">Total Revenue</span>
            </div>
            <a href="{{ route('admin.products.create') }}" class="h-11 px-5 rounded-xl text-xs font-semibold flex items-center gap-2 bg-white text-[#964B42] hover:bg-stone-50 transition shadow-sm cursor-pointer whitespace-nowrap">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-en="New Product" data-i18n-de="Neues Produkt">New Product</span>
            </a>
        </div>
    </div>

    <!-- Top Key Metrics Cards (4-Column) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Card 1: TOTAL PRODUCTS -->
        <div class="bg-white rounded-2xl p-5 border border-stone-200/90 shadow-2xs flex flex-col justify-between hover:shadow-md hover:border-[#964B42]/30 transition duration-300 group">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="TOTAL PRODUCTS" data-i18n-de="GESAMT PRODUKTE">TOTAL PRODUCTS</span>
                    <div class="h-10 w-10 rounded-xl bg-[#964B42]/10 text-[#964B42] flex items-center justify-center border border-[#964B42]/20 transition-transform group-hover:scale-105">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black font-serif text-stone-900 tracking-tight">{{ $productsCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-semibold text-[#964B42]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#964B42]"></span>
                <span>{{ $productsThisMonth }} <span data-i18n-en="Active in Store" data-i18n-de="Aktiv im Store">Active in Store</span></span>
            </div>
        </div>

        <!-- Card 2: STORE ORDERS -->
        <div class="bg-white rounded-2xl p-5 border border-stone-200/90 shadow-2xs flex flex-col justify-between hover:shadow-md hover:border-[#964B42]/30 transition duration-300 group">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="STORE ORDERS" data-i18n-de="BESTELLUNGEN">STORE ORDERS</span>
                    <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-200/80 transition-transform group-hover:scale-105">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black font-serif text-stone-900 tracking-tight">{{ $ordersCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-semibold text-amber-700">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                <span>{{ $ordersThisMonth }} <span data-i18n-en="Processed this month" data-i18n-de="Diesen Monat verarbeitet">Processed this month</span></span>
            </div>
        </div>

        <!-- Card 3: CUSTOMER INQUIRIES -->
        <div class="bg-white rounded-2xl p-5 border border-stone-200/90 shadow-2xs flex flex-col justify-between hover:shadow-md hover:border-[#964B42]/30 transition duration-300 group">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="CLIENT INQUIRIES" data-i18n-de="KUNDENANFRAGEN">CLIENT INQUIRIES</span>
                    <div class="h-10 w-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-200/80 transition-transform group-hover:scale-105">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black font-serif text-stone-900 tracking-tight">{{ $contactMessagesCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-semibold text-rose-700">
                <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                <span>{{ $contactMessagesThisMonth }} <span data-i18n-en="Active concierge tickets" data-i18n-de="Aktive Concierge-Tickets">Active concierge tickets</span></span>
            </div>
        </div>

        <!-- Card 4: VIP CUSTOMERS -->
        <div class="bg-white rounded-2xl p-5 border border-stone-200/90 shadow-2xs flex flex-col justify-between hover:shadow-md hover:border-[#964B42]/30 transition duration-300 group">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="VIP CLIENTS" data-i18n-de="VIP KUNDEN">VIP CLIENTS</span>
                    <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-200/80 transition-transform group-hover:scale-105">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black font-serif text-stone-900 tracking-tight">{{ $customersCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-semibold text-emerald-700">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                <span data-i18n-en="Registered VIP Profiles" data-i18n-de="Registrierte VIP-Profile">Registered VIP Profiles</span>
            </div>
        </div>

    </div>

    <!-- Middle Grid Section (Luxury Analytics Charts) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left 8-Cols: Sales Revenue & Order Trajectory Chart -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 sm:p-7 border border-stone-200/90 shadow-xs flex flex-col justify-between space-y-5">
            <div>
                <!-- Chart Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-stone-100 pb-5">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-[#964B42]"></span>
                            <h2 class="font-serif text-lg font-bold text-stone-900 tracking-tight" data-i18n-en="Atelier Revenue & Sales Trajectory" data-i18n-de="Atelier Umsatzvolumen & Bestellungen">
                                Atelier Revenue & Sales Trajectory
                            </h2>
                        </div>
                        <p class="text-xs text-stone-400 mt-1" data-i18n-en="Monthly revenue momentum (€) coupled with order volume & client demand." data-i18n-de="Monatliche Umsatzdynamik (€) kombiniert mit Bestellvolumen & Kundenanfragen.">
                            Monthly revenue momentum (€) coupled with order volume & client demand.
                        </p>
                    </div>

                    <!-- Custom Interactive Legend -->
                    <div class="flex items-center gap-4 text-xs font-semibold">
                        <div class="flex items-center gap-1.5">
                            <span class="h-3 w-3 rounded-full bg-gradient-to-r from-[#964B42] to-[#803D35] shadow-xs"></span>
                            <span class="text-stone-700" data-i18n-en="Revenue (€)" data-i18n-de="Umsatz (€)">Revenue (€)</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="h-3 w-3 rounded-md bg-[#E07A5F] shadow-xs"></span>
                            <span class="text-stone-700" data-i18n-en="Orders Volume" data-i18n-de="Bestellungen">Orders Volume</span>
                        </div>
                        <span class="rounded-lg bg-[#F8F5EF] px-3 py-1 text-[0.68rem] font-mono text-stone-600 font-bold border border-[#E5DED5]">
                            2026 YTD
                        </span>
                    </div>
                </div>

                <!-- Sub-bar Highlights -->
                <div class="grid grid-cols-3 gap-3 my-4 py-3 px-4 bg-[#FBF6F4] rounded-xl border border-[#E5DED5]/60 text-xs">
                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Annual Run Rate" data-i18n-de="Jahres-Umsatzrate">Annual Run Rate</p>
                        <p class="font-serif font-bold text-stone-900 text-sm mt-0.5">€{{ number_format(array_sum($monthlyRevenue), 0, '.', ',') }}</p>
                    </div>
                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Peak Month" data-i18n-de="Spitzenmonat">Peak Month</p>
                        <p class="font-serif font-bold text-[#964B42] text-sm mt-0.5">Dec (€{{ number_format(max($monthlyRevenue), 0, '.', ',') }})</p>
                    </div>
                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Total Orders" data-i18n-de="Bestellungen">Total Orders</p>
                        <p class="font-serif font-bold text-stone-900 text-sm mt-0.5">{{ array_sum($monthlyOrders) }} units</p>
                    </div>
                </div>

                <!-- Canvas Chart Area -->
                <div class="h-72 w-full relative pt-2">
                    <canvas id="monthlyVolumeChart"></canvas>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-stone-400 pt-3 border-t border-stone-100">
                <span data-i18n-en="Data synced in real-time with verified shop orders." data-i18n-de="Echtzeit-Synchronisation mit Shop-Bestellungen.">Data synced in real-time with verified shop orders.</span>
                <span class="font-mono text-[0.68rem] text-stone-500 font-bold">12 MONTH TREND</span>
            </div>
        </div>

        <!-- Right 4-Cols: Category Portfolio & Demand Share Donut Chart -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-6 sm:p-7 border border-stone-200/90 shadow-xs flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between border-b border-stone-100 pb-5">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-[#E07A5F]"></span>
                            <h2 class="font-serif text-lg font-bold text-stone-900 tracking-tight" data-i18n-en="Category Portfolio Share" data-i18n-de="Kategorie-Portfolio Anteil">
                                Category Portfolio Share
                            </h2>
                        </div>
                        <p class="text-xs text-stone-400 mt-1" data-i18n-en="Inventory & collection distribution by category" data-i18n-de="Kollektionsverteilung nach Kategorien">
                            Inventory & collection distribution by category
                        </p>
                    </div>
                </div>

                <!-- Donut Chart Container with Center Badge -->
                <div class="relative my-4 flex items-center justify-center">
                    <div class="h-56 w-56 relative flex items-center justify-center">
                        <canvas id="categoryShareChart"></canvas>
                        <!-- Interactive Center Label -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span id="donutCenterCount" class="text-3xl font-black font-serif text-stone-900">{{ array_sum($categoryData) }}</span>
                            <span id="donutCenterLabel" class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider" data-i18n-en="Total Items" data-i18n-de="Gesamt Artikel">Total Items</span>
                        </div>
                    </div>
                </div>

                <!-- Custom Luxury Legend List -->
                <div class="space-y-2.5 pt-2">
                    @php
                        $palette = ['#964B42', '#B85D52', '#E07A5F', '#D4A373', '#7F3B34', '#A8655E'];
                        $totalCatSum = max(1, array_sum($categoryData));
                    @endphp
                    @foreach($categoryLabels as $idx => $label)
                        @php
                            $val = $categoryData[$idx] ?? 0;
                            $pct = round(($val / $totalCatSum) * 100);
                            $color = $palette[$idx % count($palette)];
                        @endphp
                        <div class="flex items-center justify-between text-xs py-1 px-2.5 rounded-lg hover:bg-[#FBF6F4] transition duration-150">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full shrink-0" style="background-color: {{ $color }};"></span>
                                <span class="font-semibold text-stone-700 truncate max-w-[150px]">{{ $label }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-stone-400 text-[0.68rem]">{{ $val }} items</span>
                                <span class="font-bold text-stone-900 text-xs w-9 text-right">{{ $pct }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs font-semibold text-stone-500">
                <span data-i18n-en="Atelier Collection Status" data-i18n-de="Atelier Kollektionsstatus">Atelier Collection Status</span>
                <span class="text-[#964B42] font-bold" data-i18n-en="Balanced Mix" data-i18n-de="Ausgewogener Mix">Balanced Mix</span>
            </div>
        </div>

    </div>

    <!-- Bottom Grid Section (Recent Store Orders Table & Recent Customer Inquiries) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left 8-Cols: Recent Store Orders Table -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 sm:p-7 border border-stone-200/90 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                <div>
                    <h2 class="font-serif text-base font-bold text-stone-900 tracking-tight" data-i18n-en="Recent Store Orders" data-i18n-de="Aktuelle Shop-Bestellungen">Recent Store Orders</h2>
                    <p class="text-xs text-stone-400 mt-0.5" data-i18n-en="Latest customer orders processed through the checkout" data-i18n-de="Neueste Bestellungen und Anfragen von Käufern">Latest customer orders processed through the checkout</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#964B42] hover:text-[#803D35] hover:underline" data-i18n-en="View All Orders →" data-i18n-de="Alle Bestellungen ansehen →">View All Orders →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                            <th class="py-3 px-4" data-i18n-en="ORDER #" data-i18n-de="BESTELLUNG #">ORDER #</th>
                            <th class="py-3 px-4" data-i18n-en="CUSTOMER" data-i18n-de="KUNDE">CUSTOMER</th>
                            <th class="py-3 px-4" data-i18n-en="AMOUNT" data-i18n-de="BETRAG">AMOUNT</th>
                            <th class="py-3 px-4" data-i18n-en="PAYMENT" data-i18n-de="ZAHLUNG">PAYMENT</th>
                            <th class="py-3 px-4" data-i18n-en="STATUS" data-i18n-de="STATUS">STATUS</th>
                            <th class="py-3 px-4 text-right" data-i18n-en="ACTION" data-i18n-de="AKTION">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5DED5] font-medium">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-[#FBF6F4] transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-[#964B42]">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="hover:underline">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-stone-900">{{ $order->customer_name }}</p>
                                    <p class="text-[0.68rem] text-stone-400">{{ $order->customer_email }}</p>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-stone-900">
                                    €{{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wider {{ $order->payment_method === 'vorkasse' ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-800' }}">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($order->status === 'paid' || $order->status === 'delivered')
                                        <span class="inline-flex items-center gap-1 text-[0.68rem] font-bold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                            <span data-i18n-en="Completed" data-i18n-de="Abgeschlossen">Completed</span>
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="inline-flex items-center gap-1 text-[0.68rem] font-bold text-rose-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                            <span data-i18n-en="Cancelled" data-i18n-de="Storniert">Cancelled</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-[0.68rem] font-bold text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                            <span data-i18n-en="Pending" data-i18n-de="Ausstehend">Pending</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-[#F8F5EF] text-stone-600 border border-[#E5DED5] hover:bg-[#964B42] hover:text-white transition shadow-2xs">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-stone-400 text-xs" data-i18n-en="No recent store orders yet." data-i18n-de="Bisher keine Bestellungen vorhanden.">
                                    No recent store orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right 4-Cols: Recent Messages & Quick Concierge -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-6 sm:p-7 border border-stone-200/90 shadow-xs flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                    <div>
                        <h2 class="font-serif text-base font-bold text-stone-900 tracking-tight" data-i18n-en="Client Concierge Inquiries" data-i18n-de="Kundenanfragen (Concierge)">Client Concierge Inquiries</h2>
                        <p class="text-xs text-stone-400 mt-0.5" data-i18n-en="Unread messages requiring review" data-i18n-de="Eingehende Nachrichten & Feedback">Unread messages requiring review</p>
                    </div>
                    <a href="{{ route('admin.messages') }}" class="text-xs font-bold text-[#964B42] hover:text-[#803D35] hover:underline" data-i18n-en="All Messages" data-i18n-de="Alle Nachrichten">All Messages</a>
                </div>

                <div class="divide-y divide-stone-100 text-xs">
                    @forelse($recentMessages as $msg)
                        <div class="py-3.5 first:pt-2 last:pb-0">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-bold text-stone-900">{{ $msg->name }}</span>
                                <span class="text-[0.65rem] text-stone-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-stone-600 line-clamp-1 text-[0.72rem]">{{ $msg->subject ?? $msg->message }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-[0.65rem] font-mono text-[#964B42] font-semibold">{{ $msg->email }}</span>
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-[0.68rem] font-bold text-stone-700 hover:text-[#964B42] transition underline">
                                    <span data-i18n-en="Respond →" data-i18n-de="Antworten →">Respond →</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-stone-400 text-xs" data-i18n-en="No incoming concierge inquiries." data-i18n-de="Keine Anfragen vorhanden.">
                            No incoming concierge inquiries.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Action Links -->
            <div class="pt-4 border-t border-stone-100 flex items-center justify-between text-xs font-bold">
                <a href="{{ route('admin.categories') }}" class="text-stone-600 hover:text-[#964B42] transition" data-i18n-en="Manage Categories" data-i18n-de="Kategorien Verwalten">Manage Categories</a>
                <span class="text-stone-300">•</span>
                <a href="{{ route('admin.settings') }}" class="text-stone-600 hover:text-[#964B42] transition" data-i18n-en="Store Settings" data-i18n-de="Einstellungen">Store Settings</a>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js Render Script with Visual Aesthetics & Gradients -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    function initDashboardCharts() {
        if (typeof Chart === 'undefined') {
            setTimeout(initDashboardCharts, 150);
            return;
        }

        // 1. Monthly Revenue & Sales Volume Visual Spline Area + Rounded Column Bar Chart
        const ctxVolume = document.getElementById('monthlyVolumeChart');
        if (ctxVolume && !ctxVolume.getAttribute('data-chart-initialized')) {
            ctxVolume.setAttribute('data-chart-initialized', 'true');
            const ctx = ctxVolume.getContext('2d');
            
            // Build rich vertical linear gradient for the revenue spline fill
            const revenueGradient = ctx.createLinearGradient(0, 0, 0, 260);
            revenueGradient.addColorStop(0, 'rgba(150, 75, 66, 0.42)'); // Terracotta glow
            revenueGradient.addColorStop(0.6, 'rgba(150, 75, 66, 0.12)');
            revenueGradient.addColorStop(1, 'rgba(248, 245, 239, 0.0)'); // Clean fade into canvas

            // Bar Gradient for orders
            const orderBarGradient = ctx.createLinearGradient(0, 0, 0, 260);
            orderBarGradient.addColorStop(0, '#E07A5F');
            orderBarGradient.addColorStop(1, '#964B42');

            new Chart(ctxVolume, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($monthlyMonths) !!},
                    datasets: [
                        {
                            type: 'line',
                            label: 'Revenue (€)',
                            data: {!! json_encode($monthlyRevenue) !!},
                            borderColor: '#964B42',
                            borderWidth: 3,
                            backgroundColor: revenueGradient,
                            fill: true,
                            tension: 0.42,
                            cubicInterpolationMode: 'monotone',
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            pointBackgroundColor: '#964B42',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointHoverBackgroundColor: '#ffffff',
                            pointHoverBorderColor: '#803D35',
                            pointHoverBorderWidth: 3,
                            yAxisID: 'yRevenue',
                            order: 1
                        },
                        {
                            type: 'bar',
                            label: 'Orders Volume',
                            data: {!! json_encode($monthlyOrders) !!},
                            backgroundColor: orderBarGradient,
                            hoverBackgroundColor: '#803D35',
                            borderRadius: 8,
                            borderSkipped: false,
                            barThickness: 16,
                            maxBarThickness: 20,
                            yAxisID: 'yOrders',
                            order: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(28, 25, 23, 0.94)',
                            titleColor: '#F8F5EF',
                            titleFont: { size: 12, weight: '700', family: "'Plus Jakarta Sans', sans-serif" },
                            bodyColor: '#E5DED5',
                            bodyFont: { size: 12, family: "'Plus Jakarta Sans', sans-serif" },
                            padding: 12,
                            cornerRadius: 12,
                            borderColor: 'rgba(150, 75, 66, 0.35)',
                            borderWidth: 1,
                            displayColors: true,
                            boxWidth: 8,
                            boxHeight: 8,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    if (context.dataset.label.includes('Revenue')) {
                                        return ' Revenue: €' + Number(context.raw).toLocaleString('en-US', { minimumFractionDigits: 2 });
                                    }
                                    return ' Orders: ' + context.raw + ' units';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { 
                                color: '#8C847D', 
                                font: { size: 11, weight: '600', family: "'Plus Jakarta Sans', sans-serif" } 
                            }
                        },
                        yRevenue: {
                            type: 'linear',
                            position: 'left',
                            grid: { 
                                color: 'rgba(229, 222, 213, 0.6)', 
                                borderDash: [4, 4] 
                            },
                            ticks: { 
                                color: '#8C847D', 
                                font: { size: 11, weight: '600', family: "'Plus Jakarta Sans', sans-serif" },
                                callback: function(val) {
                                    return '€' + (val >= 1000 ? (val / 1000) + 'k' : val);
                                }
                            }
                        },
                        yOrders: {
                            type: 'linear',
                            position: 'right',
                            grid: { display: false },
                            ticks: { 
                                color: '#E07A5F', 
                                font: { size: 10, weight: '600' },
                                callback: function(val) {
                                    return val + ' pcs';
                                }
                            }
                        }
                    }
                }
            });
        }

        // 2. Category Demand & Share Doughnut with Multi-Segment Harmonious Palette
        const ctxShare = document.getElementById('categoryShareChart');
        if (ctxShare && !ctxShare.getAttribute('data-chart-initialized')) {
            ctxShare.setAttribute('data-chart-initialized', 'true');
            const rawLabels = {!! json_encode($categoryLabels) !!};
            const rawData = {!! json_encode($categoryData) !!};

            const chart = new Chart(ctxShare, {
                type: 'doughnut',
                data: {
                    labels: rawLabels,
                    datasets: [{
                        data: rawData,
                        backgroundColor: [
                            '#964B42', // Terracotta primary
                            '#B85D52', // Warm rust
                            '#E07A5F', // Amber rose
                            '#D4A373', // Champagne tan
                            '#7F3B34', // Deep terracotta crimson
                            '#A8655E'  // Rose clay
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverBorderColor: '#ffffff',
                        hoverOffset: 8,
                        spacing: 3,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(28, 25, 23, 0.94)',
                            titleColor: '#F8F5EF',
                            titleFont: { size: 12, weight: '700' },
                            bodyColor: '#E5DED5',
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 12,
                            borderColor: 'rgba(150, 75, 66, 0.35)',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const pct = Math.round((context.raw / total) * 100);
                                    return ` ${context.label}: ${context.raw} items (${pct}%)`;
                                }
                            }
                        }
                    },
                    onHover: (event, chartElement) => {
                        const countEl = document.getElementById('donutCenterCount');
                        const labelEl = document.getElementById('donutCenterLabel');
                        if (chartElement.length > 0) {
                            const idx = chartElement[0].index;
                            const total = rawData.reduce((a, b) => a + b, 0);
                            const pct = Math.round((rawData[idx] / total) * 100);
                            countEl.textContent = pct + '%';
                            labelEl.textContent = rawLabels[idx];
                        } else {
                            countEl.textContent = rawData.reduce((a, b) => a + b, 0);
                            labelEl.textContent = (window.__mehaaj_lang || localStorage.getItem('mehaaj_admin_lang')) === 'de' ? 'Gesamt Artikel' : 'Total Items';
                        }
                    }
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDashboardCharts);
    } else {
        initDashboardCharts();
    }
</script>
@endsection
