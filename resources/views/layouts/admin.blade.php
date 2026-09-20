<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MEHAAJ Admin Control Center')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f0f6ff;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
        }
        .card-navy-header {
            background-color: #0d2352 !important;
            color: #ffffff !important;
        }
        .btn-lime-save {
            background-color: #84cc16 !important;
            color: #ffffff !important;
        }
        .btn-blue-back {
            background-color: #103375 !important;
            color: #ffffff !important;
        }
        .admin-card {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #1e293b !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04) !important;
        }
        .admin-table-head {
            background-color: #f8fafc !important;
            color: #475569 !important;
        }
        .admin-table-row:hover {
            background-color: #f8fafc !important;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col selection:bg-[#194AA2] selection:text-white">

    <!-- Top Full Header Bar (#194AA2 Royal Blue) -->
    <header class="fixed top-0 inset-x-0 z-50 h-16 bg-[#194AA2] text-white shadow-md flex items-center justify-between px-3 sm:px-6">
        
        <!-- Header Left: Mobile Hamburger & Logo -->
        <div class="flex items-center gap-3">
            <!-- Mobile Menu Toggle Hamburger Button -->
            <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 text-white cursor-pointer transition focus:outline-none" aria-label="Toggle Navigation">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <!-- Brand Logo -->
            <div class="flex items-center gap-2.5">
                <div class="h-9 w-9 rounded-xl bg-white/15 border border-white/25 flex items-center justify-center font-bold text-white shadow-inner">
                    M
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="font-extrabold tracking-tight text-white text-sm sm:text-base leading-none block uppercase">
                        MEHAAJ ADMIN
                    </a>
                    <span class="text-[0.58rem] font-bold tracking-wider text-blue-100 uppercase opacity-90 hidden sm:inline-block">ADMIN CONTROL CENTER</span>
                </div>
            </div>
        </div>

        <!-- Header Center: Global Search Input -->
        <div class="hidden md:flex items-center flex-1 max-w-md mx-6">
            <div class="relative w-full">
                <input
                    id="admin-search-input"
                    type="text"
                    placeholder="Suche nach Produkten, Bestellungen, Kunden..."
                    data-i18n-placeholder-de="Suche nach Produkten, Bestellungen, Kunden..."
                    data-i18n-placeholder-en="Search products, orders, customers..."
                    class="w-full h-9 rounded-full bg-white/15 border border-white/20 px-4 pl-10 text-xs text-white placeholder-blue-100 outline-none focus:bg-white/25 transition-all shadow-inner"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-2.5 text-blue-100 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
        </div>

        <!-- Header Right Actions: View Website, Language & Avatar -->
        <div class="flex items-center gap-2 sm:gap-3 text-xs">
            
            <!-- View Live Website Pill Button -->
            <a href="/" target="_blank" class="hidden sm:flex items-center gap-1.5 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/30 px-3.5 py-1.5 text-xs font-semibold transition cursor-pointer shadow-sm">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                <span data-i18n-de="Website Ansehen" data-i18n-en="View Website">Website Ansehen</span>
            </a>

            <!-- Language Toggle Pill (DE / EN) -->
            <div class="flex items-center rounded-full bg-black/25 border border-white/25 p-0.5 shadow-inner" aria-label="Language selector">
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-extrabold uppercase transition" type="button" data-language-option="de">DE</button>
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-extrabold uppercase transition" type="button" data-language-option="en">EN</button>
            </div>

            <!-- Admin Avatar Circle -->
            <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-white/20 border border-white/40 flex items-center justify-center font-bold text-[0.65rem] text-white shadow-sm" title="Super Admin">
                128x128
            </div>

        </div>
    </header>

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 z-30 bg-black/50 backdrop-blur-xs hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Sidebar & Main Body Wrapper -->
    <div class="flex flex-1 pt-16">

        <!-- Left Sidebar (#194AA2 - Same Royal Blue Color as Header) -->
        <aside id="admin-sidebar" class="fixed top-16 bottom-0 left-0 z-40 w-64 bg-[#194AA2] text-white border-r border-white/15 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0">
            <div class="p-3 space-y-3 overflow-y-auto flex-1">
                
                <!-- Section Header Box -->
                <div class="px-3.5 py-2.5 rounded-lg bg-black/20 border border-white/15 text-white text-[0.68rem] font-extrabold uppercase tracking-wider">
                    <span data-i18n-de="HAUPTNAVIGATION" data-i18n-en="MAIN NAVIGATION">HAUPTNAVIGATION</span>
                </div>

                <!-- Admin Navigation List -->
                <nav class="space-y-1 text-xs font-semibold">
                    
                    <!-- Dashboard Overview -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                            <span data-i18n-de="Dashboard" data-i18n-en="Dashboard">Dashboard</span>
                        </div>
                    </a>

                    <!-- Collapsible Categories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('categories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-md {{ request()->routeIs('admin.categories*') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                                <span data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</span>
                            </div>
                            <svg id="categories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.categories*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="categories-menu" class="{{ request()->routeIs('admin.categories*') ? 'block' : 'hidden' }} pl-4 space-y-1 py-1 bg-black/15 rounded-md">
                            <a href="{{ route('admin.categories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.categories') && !request()->routeIs('admin.categories.create') && !request()->routeIs('admin.categories.edit') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kategorien Übersicht" data-i18n-en="View Categories">Kategorien Übersicht</span>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.categories.create') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Kategorie Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Subcategories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('subcategories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-md {{ request()->routeIs('admin.subcategories*') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2z"/></svg>
                                <span data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Unterkategorien</span>
                            </div>
                            <svg id="subcategories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.subcategories*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="subcategories-menu" class="{{ request()->routeIs('admin.subcategories*') ? 'block' : 'hidden' }} pl-4 space-y-1 py-1 bg-black/15 rounded-md">
                            <a href="{{ route('admin.subcategories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.subcategories') && !request()->routeIs('admin.subcategories.create') && !request()->routeIs('admin.subcategories.edit') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Unterkategorien Übersicht" data-i18n-en="View Subcategories">Unterkategorien Übersicht</span>
                            </a>
                            <a href="{{ route('admin.subcategories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.subcategories.create') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Unterkategorie Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Products Catalog Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('products-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-md {{ request()->routeIs('admin.products*') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span data-i18n-de="Produkte Katalog" data-i18n-en="Products Catalog">Produkte Katalog</span>
                            </div>
                            <svg id="products-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.products*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="products-menu" class="{{ request()->routeIs('admin.products*') ? 'block' : 'hidden' }} pl-4 space-y-1 py-1 bg-black/15 rounded-md">
                            <a href="{{ route('admin.products') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Produkte Übersicht" data-i18n-en="View Products">Produkte Übersicht</span>
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.products.create') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Produkt Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Orders & Invoices Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('orders-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-md {{ request()->routeIs('admin.orders*') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                <span data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
                            </div>
                            <svg id="orders-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.orders*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="orders-menu" class="{{ request()->routeIs('admin.orders*') ? 'block' : 'hidden' }} pl-4 space-y-1 py-1 bg-black/15 rounded-md">
                            <a href="{{ route('admin.orders') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.orders') && !request('payment_method') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Bestellungen Übersicht" data-i18n-en="View Orders">Bestellungen Übersicht</span>
                            </a>
                            <a href="{{ route('admin.orders', ['payment_method' => 'vorkasse']) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request('payment_method') === 'vorkasse' ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Vorkasse & Rechnungen" data-i18n-en="Prepayment & Invoices">Vorkasse & Rechnungen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible VIP Customers Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('customers-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-md {{ request()->routeIs('admin.customers*') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <span data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</span>
                            </div>
                            <svg id="customers-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.customers*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="customers-menu" class="{{ request()->routeIs('admin.customers*') ? 'block' : 'hidden' }} pl-4 space-y-1 py-1 bg-black/15 rounded-md">
                            <a href="{{ route('admin.customers') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.customers') && !request()->routeIs('admin.customers.create') && !request()->routeIs('admin.customers.edit') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kunden Übersicht" data-i18n-en="View Customers">Kunden Übersicht</span>
                            </a>
                            <a href="{{ route('admin.customers.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request()->routeIs('admin.customers.create') ? 'text-white font-bold bg-white/10 rounded' : 'text-blue-100/90 hover:text-white hover:bg-white/5 rounded' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kunde Hinzufügen" data-i18n-en="Add Customer">Kunde Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Store Settings -->
                    <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-md {{ request()->routeIs('admin.settings') ? 'bg-[#103375] text-white font-bold border-l-4 border-[#84cc16]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            <span data-i18n-de="Store Einstellungen" data-i18n-en="Store Settings">Store Einstellungen</span>
                        </div>
                        <span class="text-xs text-blue-200/70">›</span>
                    </a>

                </nav>
            </div>

            <!-- Sidebar Bottom User Bar -->
            <div class="bg-black/20 border-t border-white/15 p-3.5 flex items-center justify-between text-xs">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-full bg-white/20 border border-white/40 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                        M
                    </div>
                    <div>
                        <p class="font-bold text-white truncate max-w-[110px]">{{ session('admin_name', 'MEHAAJ Admin') }}</p>
                        <p class="text-[0.6rem] text-blue-100 font-semibold">Super Admin</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-100 hover:text-white transition cursor-pointer p-1" title="Abmelden / Logout">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Dynamic Content Area (#f0f6ff Light Ice Blue) -->
        <div class="flex-1 lg:ml-64 min-h-[calc(100vh-4rem)] bg-[#f0f6ff] p-4 sm:p-6 lg:p-8 flex flex-col justify-between transition-all duration-300">
            
            <main class="space-y-6 flex-1">
                @yield('admin-content')
            </main>

            <!-- Admin Footer -->
            <footer class="mt-8 border-t border-slate-200/80 pt-4 flex flex-col sm:flex-row items-center justify-between text-[0.68rem] text-slate-500 font-medium gap-2 text-center sm:text-left">
                <p>© {{ date('Y') }} MEHAAJ Luxury Atelier — Executive Control Center v3.5</p>
                <p>Designed for MEHAAJ E-Commerce Store</p>
            </footer>

        </div>

    </div>

    <!-- Internationalization (DE / EN) Translation Engine JS -->
    <script>
        function toggleSidebarMenu(menuId) {
            const menu = document.getElementById(menuId);
            const arrow = document.getElementById(menuId + '-arrow');
            if (menu) {
                menu.classList.toggle('hidden');
                if (arrow) {
                    arrow.classList.toggle('rotate-180');
                }
            }
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
            if (backdrop) {
                backdrop.classList.toggle('hidden');
            }
        }

        const i18nDictionary = {
            'de': {
                'Kategorien': 'Kategorien',
                'Categories': 'Kategorien',
                'Kategorien Übersicht': 'Kategorien Übersicht',
                'View Categories': 'Kategorien Übersicht',
                'Kategorie Hinzufügen': 'Kategorie Hinzufügen',
                'Add Category': 'Kategorie Hinzufügen',
                'Zurück zu Kategorien': 'Zurück zu Kategorien',
                'Back to Categories': 'Zurück zu Kategorien',
                'Kategorie Bearbeiten': 'Kategorie Bearbeiten',
                'Edit Category': 'Kategorie Bearbeiten',
                'Unterkategorien': 'Unterkategorien',
                'Subcategories': 'Unterkategorien',
                'Unterkategorien Übersicht': 'Unterkategorien Übersicht',
                'View Subcategories': 'Unterkategorien Übersicht',
                'Unterkategorie Hinzufügen': 'Unterkategorie Hinzufügen',
                'Add Subcategory': 'Unterkategorie Hinzufügen',
                'Zurück zu Unterkategorien': 'Zurück zu Unterkategorien',
                'Back to Subcategories': 'Zurück zu Unterkategorien',
                'Unterkategorie Bearbeiten': 'Unterkategorie Bearbeiten',
                'Edit Subcategory': 'Unterkategorie Bearbeiten',
                'Dashboard': 'Dashboard',
                'Produkte Katalog': 'Produkte Katalog',
                'Products Catalog': 'Produkte Katalog',
                'Bestellungen & Vorkasse': 'Bestellungen & Vorkasse',
                'Orders & Prepayments': 'Bestellungen & Vorkasse',
                'VIP Kundenstamm': 'VIP Kundenstamm',
                'VIP Customers': 'VIP Kundenstamm',
                'Store Einstellungen': 'Store Einstellungen',
                'Store Settings': 'Store Einstellungen',
                'Website Ansehen': 'Website Ansehen',
                'View Website': 'Website Ansehen',
                'Kategorie Name *': 'Kategorie Name *',
                'Category Name *': 'Kategorie Name *',
                'Unterkategorie Name *': 'Unterkategorie Name *',
                'Subcategory Name *': 'Unterkategorie Name *',
                'Hauptkategorie *': 'Hauptkategorie *',
                'Parent Category *': 'Hauptkategorie *',
                'Status *': 'Status *',
                'Aktiv (Öffentlich)': 'Aktiv (Öffentlich)',
                'Active (Public)': 'Aktiv (Öffentlich)',
                'Entwurf (Versteckt)': 'Entwurf (Versteckt)',
                'Draft (Hidden)': 'Entwurf (Versteckt)',
                'Kategorie Logo / Bild': 'Kategorie Logo / Bild',
                'Category Image': 'Kategorie Logo / Bild',
                'Unterkategorie Bild': 'Unterkategorie Bild',
                'Subcategory Image': 'Unterkategorie Bild',
                'Sortierungsreihenfolge': 'Sortierungsreihenfolge',
                'Sort Order': 'Sortierungsreihenfolge',
                'Beschreibung': 'Beschreibung',
                'Description': 'Beschreibung',
                'Kategorie Speichern': 'Kategorie Speichern',
                'Save Category': 'Kategorie Speichern',
                'Unterkategorie Speichern': 'Unterkategorie Speichern',
                'Save Subcategory': 'Unterkategorie Speichern',
                'Änderungen Speichern': 'Änderungen Speichern',
                'Save Changes': 'Änderungen Speichern',
                'Edit': 'Bearbeiten',
                'Delete': 'Löschen',
                'Bearbeiten': 'Bearbeiten',
                'Löschen': 'Löschen',
                'Zeige': 'Zeige',
                'Show': 'Zeige',
                'Einträge': 'Einträge',
                'entries': 'Einträge',
                'Suche:': 'Suche:',
                'Search:': 'Suche:',
                'Alle Hauptkategorien': 'Alle Hauptkategorien',
                'All Categories': 'Alle Hauptkategorien',
                'HAUPTNAVIGATION': 'HAUPTNAVIGATION',
                'MAIN NAVIGATION': 'HAUPTNAVIGATION',
                'MEHAAJ Admin Dashboard': 'MEHAAJ Admin Dashboard',
                'Gesamt:': 'Gesamt:',
                'Total:': 'Gesamt:'
            },
            'en': {
                'Kategorien': 'Categories',
                'Categories': 'Categories',
                'Kategorien Übersicht': 'Categories List',
                'View Categories': 'Categories List',
                'Kategorie Hinzufügen': 'Add Category',
                'Add Category': 'Add Category',
                'Zurück zu Kategorien': 'Back to Categories',
                'Back to Categories': 'Back to Categories',
                'Kategorie Bearbeiten': 'Edit Category',
                'Edit Category': 'Edit Category',
                'Unterkategorien': 'Subcategories',
                'Subcategories': 'Subcategories',
                'Unterkategorien Übersicht': 'Subcategories List',
                'View Subcategories': 'Subcategories List',
                'Unterkategorie Hinzufügen': 'Add Subcategory',
                'Add Subcategory': 'Add Subcategory',
                'Zurück zu Unterkategorien': 'Back to Subcategories',
                'Back to Subcategories': 'Back to Subcategories',
                'Unterkategorie Bearbeiten': 'Edit Subcategory',
                'Edit Subcategory': 'Edit Subcategory',
                'Dashboard': 'Dashboard',
                'Produkte Katalog': 'Products Catalog',
                'Products Catalog': 'Products Catalog',
                'Bestellungen & Vorkasse': 'Orders & Prepayments',
                'Orders & Prepayments': 'Orders & Prepayments',
                'VIP Kundenstamm': 'VIP Customers',
                'VIP Customers': 'VIP Customers',
                'Store Einstellungen': 'Store Settings',
                'Store Settings': 'Store Settings',
                'Website Ansehen': 'View Website',
                'View Website': 'View Website',
                'Kategorie Name *': 'Category Name *',
                'Category Name *': 'Category Name *',
                'Unterkategorie Name *': 'Subcategory Name *',
                'Subcategory Name *': 'Subcategory Name *',
                'Hauptkategorie *': 'Parent Category *',
                'Parent Category *': 'Parent Category *',
                'Status *': 'Status *',
                'Aktiv (Öffentlich)': 'Active (Public)',
                'Active (Public)': 'Active (Public)',
                'Entwurf (Versteckt)': 'Draft (Hidden)',
                'Draft (Hidden)': 'Draft (Hidden)',
                'Kategorie Logo / Bild': 'Category Logo / Image',
                'Category Image': 'Category Logo / Image',
                'Unterkategorie Bild': 'Subcategory Image',
                'Subcategory Image': 'Subcategory Image',
                'Sortierungsreihenfolge': 'Sort Order',
                'Sort Order': 'Sort Order',
                'Beschreibung': 'Description',
                'Description': 'Description',
                'Kategorie Speichern': 'Save Category',
                'Save Category': 'Save Category',
                'Unterkategorie Speichern': 'Save Subcategory',
                'Save Subcategory': 'Save Subcategory',
                'Änderungen Speichern': 'Save Changes',
                'Save Changes': 'Save Changes',
                'Edit': 'Edit',
                'Delete': 'Delete',
                'Bearbeiten': 'Edit',
                'Löschen': 'Delete',
                'Zeige': 'Show',
                'Show': 'Show',
                'Einträge': 'entries',
                'entries': 'entries',
                'Suche:': 'Search:',
                'Search:': 'Search:',
                'Alle Hauptkategorien': 'All Categories',
                'All Categories': 'All Categories',
                'HAUPTNAVIGATION': 'MAIN NAVIGATION',
                'MAIN NAVIGATION': 'MAIN NAVIGATION',
                'MEHAAJ Admin Dashboard': 'MEHAAJ Admin Dashboard',
                'Gesamt:': 'Total:',
                'Total:': 'Total:'
            }
        };

        window.setLanguage = (lang) => {
            const selectedLang = lang === 'en' ? 'en' : 'de';
            localStorage.setItem('mehaaj-admin-lang', selectedLang);

            // Update language toggle pill button active styling
            document.querySelectorAll('[data-language-option]').forEach(btn => {
                const isActive = btn.dataset.languageOption === selectedLang;
                if (isActive) {
                    btn.classList.add('bg-white', 'text-[#194AA2]', 'shadow-sm', 'font-bold');
                    btn.classList.remove('text-white', 'opacity-70');
                } else {
                    btn.classList.remove('bg-white', 'text-[#194AA2]', 'shadow-sm', 'font-bold');
                    btn.classList.add('text-white', 'opacity-70');
                }
            });

            // Translate explicit data-i18n attributes
            document.querySelectorAll('[data-i18n-de]').forEach(el => {
                const targetText = selectedLang === 'de' ? el.dataset.i18nDe : el.dataset.i18nEn;
                if (targetText) {
                    if (el.tagName === 'INPUT' && (el.type === 'submit' || el.type === 'button')) {
                        el.value = targetText;
                    } else {
                        el.textContent = targetText;
                    }
                }
            });

            // Translate placeholders
            document.querySelectorAll('[data-i18n-placeholder-de]').forEach(input => {
                const targetPlaceholder = selectedLang === 'de' ? input.dataset.i18nPlaceholderDe : input.dataset.i18nPlaceholderEn;
                if (targetPlaceholder) {
                    input.placeholder = targetPlaceholder;
                }
            });

            // Fallback translation dictionary for static text nodes
            const dict = i18nDictionary[selectedLang];
            if (dict) {
                const textNodes = [];
                const walk = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
                let n;
                while (n = walk.nextNode()) {
                    const trimmed = n.nodeValue.trim();
                    if (trimmed && dict[trimmed]) {
                        n.nodeValue = n.nodeValue.replace(trimmed, dict[trimmed]);
                    }
                }
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('mehaaj-admin-lang') || 'de';
            window.setLanguage(savedLang);

            document.querySelectorAll('[data-language-option]').forEach(btn => {
                btn.addEventListener('click', () => {
                    window.setLanguage(btn.dataset.languageOption);
                });
            });
        });
    </script>

    <!-- SweetAlert2 CDN Integration -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const LuxurySwal = Swal.mixin({
            background: '#ffffff',
            color: '#1e293b',
            confirmButtonColor: '#194AA2',
            cancelButtonColor: '#64748b',
            customClass: {
                popup: 'rounded-2xl shadow-2xl font-sans border border-slate-200',
                title: 'font-bold text-xl text-slate-900',
                confirmButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider cursor-pointer'
            }
        });

        const LuxuryToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#194AA2',
            color: '#ffffff',
            customClass: {
                popup: 'rounded-xl shadow-xl text-xs font-sans font-semibold'
            }
        });

        @if(session('success'))
            LuxuryToast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))
            LuxuryToast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        @if(session('info'))
            LuxuryToast.fire({
                icon: 'info',
                title: "{{ session('info') }}"
            });
        @endif
    </script>
</body>
</html>
