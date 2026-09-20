<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MEHAAJ Admin Control Center')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', sans-serif;
        }

        /* Executive Dark Header & Sidebar Theme (Guaranteed Fallback) */
        header.admin-executive-header {
            background-color: #0f172a !important;
            color: #ffffff !important;
            border-bottom: 1px solid #1e293b !important;
        }

        aside.admin-executive-sidebar {
            background-color: #0f172a !important;
            color: #cbd5e1 !important;
            border-right: 1px solid #1e293b !important;
        }

        .admin-nav-item {
            color: #cbd5e1 !important;
            transition: all 0.2s ease-in-out;
        }

        .admin-nav-item:hover {
            background-color: #1e293b !important;
            color: #ffffff !important;
        }

        .admin-nav-item-active {
            background-color: rgba(99, 102, 241, 0.2) !important;
            color: #818cf8 !important;
            border-left: 4px solid #6366f1 !important;
            font-weight: 700 !important;
        }

        .admin-nav-subitem {
            color: #94a3b8 !important;
        }

        .admin-nav-subitem:hover {
            background-color: #1e293b !important;
            color: #ffffff !important;
        }

        .admin-nav-subitem-active {
            background-color: rgba(99, 102, 241, 0.25) !important;
            color: #818cf8 !important;
            font-weight: 700 !important;
        }

        .admin-hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%) !important;
            color: #ffffff !important;
            border: 1px solid #1e293b !important;
        }

        .admin-input-dark {
            background-color: #1e293b !important;
            color: #ffffff !important;
            border: 1px solid #334155 !important;
        }

        .admin-input-dark::placeholder {
            color: #94a3b8 !important;
        }

        .card-navy-header {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .btn-lime-save {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }

        .btn-blue-back {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            border: 1px solid #e2e8f0 !important;
        }

        .admin-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            color: #0f172a !important;
            border-radius: 1rem !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .admin-table-head {
            background-color: #f8fafc !important;
            color: #64748b !important;
        }

        .admin-table-row:hover {
            background-color: #f8fafc !important;
        }
    </style>

    <!-- Global Early Language Hydration Script (Zero Flash) -->
    <script>
        (function() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            }
            const savedLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'de';
            window.__mehaaj_lang = savedLang;
        })();
    </script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col selection:bg-indigo-600 selection:text-white bg-slate-50 text-slate-900">

    <!-- Top Sleek Executive Dark Slate Header Bar (#0f172a) -->
    <header class="admin-executive-header fixed top-0 inset-x-0 z-50 h-16 shadow-md flex items-center justify-between px-4 sm:px-6" style="background-color: #0f172a !important; color: #ffffff !important; border-bottom: 1px solid #1e293b !important;">
        
        <!-- Header Left: Mobile Hamburger & Logo -->
        <div class="flex items-center gap-3">
            <!-- Mobile Menu Toggle Hamburger Button -->
            <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-2 rounded-xl text-slate-300 cursor-pointer transition focus:outline-none" style="background-color: #1e293b !important;" aria-label="Toggle Navigation">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl flex items-center justify-center font-black text-white shadow-md" style="background: linear-gradient(135deg, #6366f1, #4f46e5) !important;">
                    M
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="font-black tracking-wider text-sm sm:text-base leading-none block uppercase" style="color: #ffffff !important;">
                        MEHAAJ <span style="color: #818cf8 !important; font-weight: 800;">ADMIN</span>
                    </a>
                    <span class="text-[0.6rem] font-bold tracking-widest uppercase leading-tight hidden sm:block" style="color: #94a3b8 !important;">EXECUTIVE CONTROL CENTER</span>
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
                    class="admin-input-dark w-full h-9 rounded-xl px-4 pl-10 text-xs outline-none transition-all shadow-inner"
                    style="background-color: #1e293b !important; color: #ffffff !important; border: 1px solid #334155 !important;"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-2.5 opacity-80" style="color: #94a3b8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
        </div>

        <!-- Header Right Actions: View Website, Language & Avatar -->
        <div class="flex items-center gap-2 sm:gap-3 text-xs">
            
            <!-- View Live Website Pill Button -->
            <a href="/" target="_blank" class="hidden sm:flex items-center gap-2 rounded-xl px-3.5 py-1.5 text-xs font-semibold transition cursor-pointer shadow-xs" style="background-color: #1e293b !important; color: #e2e8f0 !important; border: 1px solid #334155 !important;">
                <svg class="h-3.5 w-3.5" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                <span data-i18n-de="Website Ansehen" data-i18n-en="View Website">Website Ansehen</span>
            </a>

            <!-- Language Toggle Pill (DE / EN Persistent) -->
            <div class="flex items-center rounded-xl p-1 shadow-inner" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;" aria-label="Language selector">
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="de">DE</button>
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="en">EN</button>
            </div>

            <!-- Admin Avatar Circle -->
            <div class="h-9 w-9 rounded-xl flex items-center justify-center font-bold text-xs shadow-xs" style="background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border: 1px solid rgba(99, 102, 241, 0.4) !important;" title="Super Admin">
                MH
            </div>

        </div>
    </header>

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-xs hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Sidebar & Main Body Wrapper -->
    <div class="flex flex-1 pt-16">

        <!-- Left Dark Slate Executive Sidebar (#0f172a) -->
        <aside id="admin-sidebar" class="admin-executive-sidebar fixed top-16 bottom-0 left-0 z-40 w-64 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-lg" style="background-color: #0f172a !important; color: #cbd5e1 !important; border-right: 1px solid #1e293b !important;">
            <div class="p-3.5 space-y-3 overflow-y-auto flex-1">
                
                <!-- Section Header Box -->
                <div class="px-3.5 py-2 rounded-xl text-[0.65rem] font-bold uppercase tracking-wider" style="background-color: #1e293b !important; border: 1px solid #334155 !important; color: #94a3b8 !important;">
                    <span data-i18n-de="HAUPTNAVIGATION" data-i18n-en="MAIN NAVIGATION">HAUPTNAVIGATION</span>
                </div>

                <!-- Admin Navigation List -->
                <nav class="space-y-1.5 text-xs font-semibold">
                    
                    <!-- Dashboard Overview -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                            <span data-i18n-de="Dashboard" data-i18n-en="Dashboard">Dashboard</span>
                        </div>
                    </a>

                    <!-- Collapsible Categories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('categories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.categories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.categories*') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                                <span data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</span>
                            </div>
                            <svg id="categories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.categories*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="categories-menu" class="{{ request()->routeIs('admin.categories*') ? 'block' : 'hidden' }} pl-3 space-y-1 py-1.5 rounded-xl" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;">
                            <a href="{{ route('admin.categories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories') && !request()->routeIs('admin.categories.create') && !request()->routeIs('admin.categories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.categories') && !request()->routeIs('admin.categories.create') && !request()->routeIs('admin.categories.edit') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kategorien Übersicht" data-i18n-en="View Categories">Kategorien Übersicht</span>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.categories.create') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Kategorie Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Subcategories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('subcategories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.subcategories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.subcategories*') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2z"/></svg>
                                <span data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Unterkategorien</span>
                            </div>
                            <svg id="subcategories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.subcategories*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="subcategories-menu" class="{{ request()->routeIs('admin.subcategories*') ? 'block' : 'hidden' }} pl-3 space-y-1 py-1.5 rounded-xl" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;">
                            <a href="{{ route('admin.subcategories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories') && !request()->routeIs('admin.subcategories.create') && !request()->routeIs('admin.subcategories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.subcategories') && !request()->routeIs('admin.subcategories.create') && !request()->routeIs('admin.subcategories.edit') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Unterkategorien Übersicht" data-i18n-en="View Subcategories">Unterkategorien Übersicht</span>
                            </a>
                            <a href="{{ route('admin.subcategories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.subcategories.create') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Unterkategorie Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Products Catalog Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('products-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.products*') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.products*') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span data-i18n-de="Produkte Katalog" data-i18n-en="Products Catalog">Produkte Katalog</span>
                            </div>
                            <svg id="products-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.products*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="products-menu" class="{{ request()->routeIs('admin.products*') ? 'block' : 'hidden' }} pl-3 space-y-1 py-1.5 rounded-xl" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;">
                            <a href="{{ route('admin.products') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Produkte Übersicht" data-i18n-en="View Products">Produkte Übersicht</span>
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.products.create') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Produkt Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Orders & Invoices Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('orders-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.orders*') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.orders*') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                <span data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
                            </div>
                            <svg id="orders-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.orders*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="orders-menu" class="{{ request()->routeIs('admin.orders*') ? 'block' : 'hidden' }} pl-3 space-y-1 py-1.5 rounded-xl" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;">
                            <a href="{{ route('admin.orders') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.orders') && !request('payment_method') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.orders') && !request('payment_method') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Bestellungen Übersicht" data-i18n-en="View Orders">Bestellungen Übersicht</span>
                            </a>
                            <a href="{{ route('admin.orders', ['payment_method' => 'vorkasse']) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request('payment_method') === 'vorkasse' ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request('payment_method') === 'vorkasse' ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Vorkasse & Rechnungen" data-i18n-en="Prepayment & Invoices">Vorkasse & Rechnungen</span>
                            </a>
                        </div>
                    </div>
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Bestellungen Übersicht" data-i18n-en="View Orders">Bestellungen Übersicht</span>
                            </a>
                            <a href="{{ route('admin.orders', ['payment_method' => 'vorkasse']) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all {{ request('payment_method') === 'vorkasse' ? 'text-indigo-400 font-bold bg-indigo-500/15 rounded-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-lg' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Vorkasse & Rechnungen" data-i18n-en="Prepayment & Invoices">Vorkasse & Rechnungen</span>
                            </a>
                        </div>
                                <!-- Collapsible VIP Customers Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('customers-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.customers*') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.customers*') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <span data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</span>
                            </div>
                            <svg id="customers-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.customers*') ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="customers-menu" class="{{ request()->routeIs('admin.customers*') ? 'block' : 'hidden' }} pl-3 space-y-1 py-1.5 rounded-xl" style="background-color: #090d16 !important; border: 1px solid #1e293b !important;">
                            <a href="{{ route('admin.customers') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers') && !request()->routeIs('admin.customers.create') && !request()->routeIs('admin.customers.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.customers') && !request()->routeIs('admin.customers.create') && !request()->routeIs('admin.customers.edit') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kunden Übersicht" data-i18n-en="View Customers">Kunden Übersicht</span>
                            </a>
                            <a href="{{ route('admin.customers.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem' }}" style="{{ request()->routeIs('admin.customers.create') ? 'color: #818cf8 !important; font-weight: 700 !important;' : 'color: #94a3b8 !important;' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kunde Hinzufügen" data-i18n-en="Add Customer">Kunde Hinzufügen</span>
                            </a>
                        </div>
                    </div>

                    <!-- Store Settings -->
                    <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.settings') ? 'admin-nav-item-active' : 'admin-nav-item' }}" style="{{ request()->routeIs('admin.settings') ? 'background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border-left: 4px solid #6366f1 !important;' : 'color: #cbd5e1 !important;' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            <span data-i18n-de="Store Einstellungen" data-i18n-en="Store Settings">Store Einstellungen</span>
                        </div>
                        <span class="text-xs" style="color: #64748b !important;">›</span>
                    </a>

                </nav>
            </div>

            <!-- Sidebar Bottom User Bar -->
            <div class="p-3.5 flex items-center justify-between text-xs" style="background-color: #090d16 !important; border-top: 1px solid #1e293b !important;">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-xl flex items-center justify-center font-bold text-xs shadow-xs" style="background-color: rgba(99, 102, 241, 0.2) !important; color: #818cf8 !important; border: 1px solid rgba(99, 102, 241, 0.4) !important;">
                        MH
                    </div>
                    <div>
                        <p class="font-bold truncate max-w-[110px]" style="color: #f8fafc !important;">{{ session('admin_name', 'MEHAAJ Admin') }}</p>
                        <p class="text-[0.62rem] font-semibold" style="color: #818cf8 !important;">Super Admin</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="transition cursor-pointer p-1.5 rounded-lg" style="color: #94a3b8 !important;" title="Abmelden / Logout">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </button>
            </div>
        </aside>

        <!-- Main Dynamic Content Area (Soft Slate Neutral #f1f5f9) -->
        <div class="flex-1 lg:ml-64 min-h-[calc(100vh-4rem)] p-4 sm:p-6 lg:p-8 flex flex-col justify-between transition-all duration-300" style="background-color: #f1f5f9 !important;">
            
            <main class="space-y-6 flex-1">
                @yield('admin-content')
            </main>

            <!-- Admin Footer -->
            <footer class="mt-8 border-t border-slate-200/80 pt-4 flex flex-col sm:flex-row items-center justify-between text-[0.7rem] text-slate-500 font-medium gap-2 text-center sm:text-left">
                <p>© {{ date('Y') }} MEHAAJ Luxury Atelier — Executive Control Center</p>
                <p>Designed for MEHAAJ E-Commerce Store</p>
            </footer>

        </div>

    </div>

    <!-- Internationalization (DE / EN) Persistent Global Translation Engine JS -->
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

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
        }

        function applyLanguage(lang) {
            if (!lang) lang = 'de';
            
            // Persist globally across tabs and page reloads via localStorage & Cookie
            try {
                localStorage.setItem('mehaaj_admin_lang', lang);
            } catch(e){}
            setCookie('mehaaj_admin_lang', lang, 365);
            window.__mehaaj_lang = lang;
            document.documentElement.lang = lang;

            // Update Language toggle button active states in Header
            document.querySelectorAll('[data-language-option]').forEach(btn => {
                const optLang = btn.getAttribute('data-language-option');
                if (optLang === lang) {
                    btn.className = 'cursor-pointer rounded-lg px-2.5 py-1 text-[0.62rem] font-black uppercase transition bg-amber-500 text-slate-950 shadow-xs ring-2 ring-amber-400/40';
                } else {
                    btn.className = 'cursor-pointer rounded-lg px-2.5 py-1 text-[0.62rem] font-bold uppercase transition text-slate-400 hover:text-white hover:bg-slate-800';
                }
            });

            // Translate all elements with data-i18n-de and data-i18n-en
            document.querySelectorAll('[data-i18n-' + lang + ']').forEach(el => {
                const text = el.getAttribute('data-i18n-' + lang);
                if (text !== null) {
                    el.innerText = text;
                }
            });

            // Translate placeholders
            document.querySelectorAll('[data-i18n-placeholder-' + lang + ']').forEach(el => {
                const ph = el.getAttribute('data-i18n-placeholder-' + lang);
                if (ph !== null) {
                    el.placeholder = ph;
                }
            });
        }

        // Cross-tab real-time persistence sync!
        window.addEventListener('storage', function(e) {
            if (e.key === 'mehaaj_admin_lang' && e.newValue) {
                applyLanguage(e.newValue);
            }
        });

        // Apply immediately and setup click listeners
        const currentLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'de';

        document.addEventListener('DOMContentLoaded', function() {
            applyLanguage(currentLang);

            document.querySelectorAll('[data-language-option]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const lang = this.getAttribute('data-language-option');
                    applyLanguage(lang);
                });
            });
        });

        // Run again on window load to ensure late-rendering components are translated
        window.addEventListener('load', function() {
            applyLanguage(localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'de');
        });
    </script>
</body>
</html>
