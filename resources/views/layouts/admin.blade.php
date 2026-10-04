<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F8F5EF] text-stone-800">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MEHAAJ Admin Control Center')</title>
    <link rel="icon" type="image/png" href="/logo.png">

    <!-- Fonts: Cormorant Garamond, Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Icons, Chart.js & SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Early Language Hydration Script (Zero-Flash, English as Default) -->
    <script>
        (function() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            }
            const savedLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en';
            window.__mehaaj_lang = savedLang;
            document.documentElement.lang = savedLang;
        })();
    </script>

    <!-- SweetAlert2 Pink-Salt Theme Configuration -->
    <script>
        window.LuxurySwal = Swal.mixin({
            background: '#ffffff',
            color: '#1c1917',
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            customClass: {
                popup: 'rounded-2xl shadow-2xl border border-stone-200 font-sans',
                title: 'font-bold text-lg text-stone-900',
                confirmButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-[#964B42]/20 cursor-pointer',
                cancelButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider cursor-pointer'
            }
        });

        window.LuxuryToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3200,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1c1917',
            iconColor: '#964B42',
            customClass: {
                popup: 'border border-stone-200 rounded-xl shadow-xl text-xs font-sans font-bold'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                LuxuryToast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const isEn = (window.__mehaaj_lang || 'en') === 'en';
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Error' : 'Fehler',
                    text: @json(session('error'))
                });
            });
        </script>
    @endif

    @if(session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                LuxuryToast.fire({
                    icon: 'info',
                    title: @json(session('info'))
                });
            });
        </script>
    @endif

    <style>
        body {
            background-color: #F8F5EF !important;
            color: #292524 !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Hide Default Native Scrollbars */
        .admin-executive-sidebar,
        .admin-executive-sidebar * {
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        .admin-executive-sidebar::-webkit-scrollbar,
        .admin-executive-sidebar *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Form Labels & Readability */
        label, form label {
            color: #292524 !important;
            font-weight: 700 !important;
        }

        /* Header & Sidebar Styles matching Pink-Salt */
        header.admin-executive-header {
            background-color: #ffffff !important;
            color: #1C1917 !important;
            border-bottom: 1px solid #E5DED5 !important;
        }

        aside.admin-executive-sidebar {
            background-color: #ffffff !important;
            color: #292524 !important;
            border-right: 1px solid #E5DED5 !important;
        }

        .admin-nav-item {
            color: #66605B !important;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
            border-radius: 0.75rem;
        }

        .admin-nav-item:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
        }

        .admin-nav-item-active {
            background-color: #F4E8E5 !important;
            color: #964B42 !important;
            font-weight: 700 !important;
            border-radius: 0.75rem;
        }

        .admin-nav-subitem {
            color: #66605B !important;
            font-weight: 500;
        }

        .admin-nav-subitem:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
        }

        .admin-nav-subitem-active {
            background-color: #F4E8E5 !important;
            color: #964B42 !important;
            font-weight: 700 !important;
        }

        /* Pink-Salt Buttons & Inputs */
        .btn-exec-primary {
            background-color: #964B42 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border: none !important;
            box-shadow: 0 4px 14px rgba(150, 75, 66, 0.25) !important;
            transition: all 0.2s ease;
        }

        .btn-exec-primary:hover {
            background-color: #803D35 !important;
            color: #ffffff !important;
            box-shadow: 0 6px 18px rgba(150, 75, 66, 0.35) !important;
            transform: translateY(-1px);
        }

        .btn-exec-secondary {
            background-color: #ffffff !important;
            color: #292524 !important;
            border: 1px solid #E5DED5 !important;
            font-weight: 700 !important;
            transition: all 0.2s ease;
        }

        .btn-exec-secondary:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
            border-color: #964B42 !important;
        }

        .btn-exec-danger {
            background-color: #FFF1F2 !important;
            color: #BE123C !important;
            border: 1px solid #FECDD3 !important;
            font-weight: 700 !important;
            transition: all 0.2s ease;
        }

        .btn-exec-danger:hover {
            background-color: #FFE4E6 !important;
            color: #9F1239 !important;
        }

        .exec-input, form input[type="text"], form input[type="number"], form input[type="email"], form input[type="password"], form select, form textarea {
            background-color: #FBF6F4 !important;
            color: #292524 !important;
            border: 1px solid #E5DED5 !important;
            font-weight: 500 !important;
        }

        .exec-input:focus, form input:focus, form select:focus, form textarea:focus {
            background-color: #ffffff !important;
            border-color: #964B42 !important;
            box-shadow: 0 0 0 3px rgba(150, 75, 66, 0.15) !important;
        }

        /* Pink-Salt Card Style */
        .exec-card {
            background-color: #ffffff !important;
            border: 1px solid #E5DED5 !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 4px 20px -2px rgba(28, 25, 23, 0.05) !important;
            color: #292524 !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .exec-card:hover {
            box-shadow: 0 10px 25px -3px rgba(28, 25, 23, 0.08) !important;
            border-color: #D4C9BD !important;
        }

        /* Table Styling */
        .exec-table-head, table thead tr {
            background-color: #F8F5EF !important;
            color: #292524 !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            font-size: 0.725rem !important;
            border-bottom: 2px solid #E5DED5 !important;
        }

        .exec-table-head th, table thead th {
            color: #292524 !important;
            font-weight: 800 !important;
            padding-top: 0.85rem !important;
            padding-bottom: 0.85rem !important;
        }

        .exec-table-row, table tbody tr {
            transition: background-color 0.15s ease-in-out !important;
            border-bottom: 1px solid #E5DED5 !important;
            color: #292524 !important;
        }

        .exec-table-row:hover, table tbody tr:hover {
            background-color: #FBF6F4 !important;
        }

        /* Badges */
        .badge-active {
            background-color: #ECFDF5 !important;
            color: #047857 !important;
            border: 1px solid #A7F3D0 !important;
            font-weight: 700 !important;
        }

        .badge-pending {
            background-color: #FFFBEB !important;
            color: #B45309 !important;
            border: 1px solid #FDE68A !important;
            font-weight: 700 !important;
        }

        .badge-draft {
            background-color: #F5F5F4 !important;
            color: #78716C !important;
            border: 1px solid #E7E5E4 !important;
            font-weight: 700 !important;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col bg-[#F8F5EF] text-stone-800">

    <!-- Top Executive Header Bar (Clean White & Warm Stone) -->
    <header class="admin-executive-header fixed top-0 inset-x-0 z-50 h-16 bg-white border-b border-[#E5DED5] shadow-2xs flex items-center justify-between px-4 sm:px-6">
        
        <!-- Header Left: Mobile Hamburger & Brand Logo -->
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-2 rounded-xl text-stone-600 cursor-pointer transition hover:bg-stone-100 focus:outline-none" aria-label="Toggle Navigation">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <!-- Brand Logo with Pink-Salt Terracotta & Amber Gradient -->
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-[#964B42] to-[#d4a373] p-0.5 shadow-md shadow-[#964B42]/20">
                    <div class="w-full h-full bg-white rounded-[9px] flex items-center justify-center font-bold text-xs text-[#964B42]">
                        <img src="/logo.png" alt="MEHAAJ Logo" class="w-5 h-5 object-contain" onerror="this.remove();">
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="font-serif text-base sm:text-lg font-bold tracking-wider text-stone-900 block leading-none">
                        MEHAAJ <span class="text-saltora-terracotta font-black">ATELIER</span>
                    </a>
                    <span class="text-[0.62rem] font-bold tracking-widest uppercase text-saltora-terracotta leading-tight hidden sm:block">ECOMMERCE ADMIN</span>
                </div>
            </div>
        </div>

        <!-- Header Center: Global Search Input -->
        <div class="hidden md:flex items-center flex-1 max-w-lg mx-6">
            <div class="relative w-full">
                <input
                    id="admin-search-input"
                    type="text"
                    placeholder="Search products, orders, customers..."
                    data-i18n-placeholder-de="Suche nach Produkten, Bestellungen, Kunden..."
                    data-i18n-placeholder-en="Search products, orders, customers..."
                    class="w-full h-10 rounded-full bg-stone-50 border border-stone-200 px-4 pl-10 text-xs text-stone-800 outline-none transition-all placeholder:text-stone-400 focus:bg-white focus:ring-2 focus:ring-saltora-terracotta/20 focus:border-saltora-terracotta"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
        </div>

        <!-- Header Right Actions: View Website, Language, Add Product & Avatar -->
        <div class="flex items-center gap-2 sm:gap-3 text-xs">
            
            <!-- Add Product Button (Pink-Salt Styled) -->
            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-1.5 rounded-full bg-saltora-terracotta hover:bg-saltora-terracotta-dark text-white px-4 py-2 text-xs font-bold transition shadow-xs shadow-saltora-terracotta/20">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span data-i18n-de="+ Produkt" data-i18n-en="+ Add Product">+ Add Product</span>
            </a>

            <!-- View Live Website Button -->
            <a href="/" target="_blank" class="hidden sm:flex items-center gap-1.5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-700 px-3.5 py-2 text-xs font-semibold transition border border-stone-200">
                <svg class="h-3.5 w-3.5 text-stone-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                <span data-i18n-de="Live Store" data-i18n-en="View Live Store">View Live Store</span>
            </a>

            <!-- Language Toggle Pill (Default: EN) -->
            <div class="flex items-center rounded-full bg-stone-100 p-1 border border-stone-200" aria-label="Language selector">
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="en">EN</button>
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="de">DE</button>
            </div>

            <!-- Admin Avatar Circle -->
            <div class="h-9 w-9 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold text-xs shadow-xs" title="Super Admin">
                MH
            </div>

        </div>
    </header>

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 z-30 bg-stone-900/60 backdrop-blur-xs hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Sidebar & Main Body Wrapper -->
    <div class="flex flex-1 pt-16">

        <!-- Left Executive Sidebar (Clean White & Pink-Salt Terracotta Theme) -->
        <aside id="admin-sidebar" class="admin-executive-sidebar fixed top-16 bottom-0 left-0 z-40 w-64 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 bg-white border-r border-[#E5DED5]">
            <div class="p-3.5 space-y-3 overflow-y-auto no-scrollbar flex-1">
                
                <!-- Admin Navigation List -->
                <nav class="space-y-1 text-xs font-semibold">
                    
                    <!-- Dashboard Overview -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.dashboard') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                            <span data-i18n-de="Dashboard Übersicht" data-i18n-en="Dashboard Overview">Dashboard Overview</span>
                        </div>
                    </a>

                    <!-- Collapsible Categories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('categories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.categories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.categories*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                                <span data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</span>
                            </div>
                            <svg id="categories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.categories*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="categories-menu" class="{{ request()->routeIs('admin.categories*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.categories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories') && !request()->routeIs('admin.categories.create') && !request()->routeIs('admin.categories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kategorien Übersicht" data-i18n-en="View Categories">View Categories</span>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Subcategories Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('subcategories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.subcategories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.subcategories*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2z"/></svg>
                                <span data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Subcategories</span>
                            </div>
                            <svg id="subcategories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.subcategories*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="subcategories-menu" class="{{ request()->routeIs('admin.subcategories*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.subcategories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories') && !request()->routeIs('admin.subcategories.create') && !request()->routeIs('admin.subcategories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Unterkategorien Übersicht" data-i18n-en="View Subcategories">View Subcategories</span>
                            </a>
                            <a href="{{ route('admin.subcategories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Add Subcategory</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Products Catalog Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('products-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.products*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.products*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span data-i18n-de="Produkte Katalog" data-i18n-en="Product Catalog">Product Catalog</span>
                            </div>
                            <svg id="products-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.products*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="products-menu" class="{{ request()->routeIs('admin.products*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.products') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Produkte Übersicht" data-i18n-en="View Products">View Products</span>
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Add Product</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Orders Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('orders-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.orders*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.orders*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                <span data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Bulk Orders">Bulk Orders</span>
                            </div>
                            <svg id="orders-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.orders*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="orders-menu" class="{{ request()->routeIs('admin.orders*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.orders') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.orders') && !request('payment_method') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Bestellungen Übersicht" data-i18n-en="View Orders">View Orders</span>
                            </a>
                            <a href="{{ route('admin.orders', ['payment_method' => 'vorkasse']) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request('payment_method') === 'vorkasse' ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Vorkasse & Rechnungen" data-i18n-en="Prepayments & Invoices">Prepayments & Invoices</span>
                            </a>
                        </div>
                    </div>

                    <!-- Customer Contact Inquiries / Messages -->
                    <a href="{{ route('admin.messages') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.messages*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.messages*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                            <span data-i18n-de="Kundenanfragen" data-i18n-en="Customer Messages">Customer Messages</span>
                        </div>
                        @php
                            $unreadMsgCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                        @endphp
                        @if($unreadMsgCount > 0)
                            <span class="rounded-full bg-saltora-blush border border-saltora-terracotta/30 px-2 py-0.5 text-[0.6rem] font-bold text-saltora-terracotta">{{ $unreadMsgCount }} New</span>
                        @endif
                    </a>

                    <!-- Collapsible VIP Customers Dropdown -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('customers-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.customers*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.customers*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <span data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Customers</span>
                            </div>
                            <svg id="customers-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.customers*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="customers-menu" class="{{ request()->routeIs('admin.customers*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.customers') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers') && !request()->routeIs('admin.customers.create') && !request()->routeIs('admin.customers.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-de="Kunden Übersicht" data-i18n-en="View Customers">View Customers</span>
                            </a>
                            <a href="{{ route('admin.customers.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kunde Hinzufügen" data-i18n-en="Add Customer">Add Customer</span>
                            </a>
                        </div>
                    </div>

                    <!-- Store Settings -->
                    <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.settings') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.settings') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            <span data-i18n-de="Store Einstellungen" data-i18n-en="Store Settings">Store Settings</span>
                        </div>
                    </a>

                </nav>
            </div>

            <!-- Sidebar Bottom User Profile Card with SweetAlert Sign Out -->
            <div class="p-3.5 border-t border-stone-200">
                <div class="flex items-center justify-between p-2 rounded-xl bg-stone-50 border border-stone-200/80">
                    <div class="flex items-center gap-2.5 overflow-hidden">
                        <div class="h-8 w-8 shrink-0 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold text-xs shadow-2xs">
                            MH
                        </div>
                        <div class="truncate">
                            <p class="font-bold text-xs text-stone-800 truncate leading-tight">{{ session('admin_name', 'MEHAAJ Admin') }}</p>
                            <p class="text-[0.62rem] text-stone-400 font-medium truncate">admin@mehaaj.de</p>
                        </div>
                    </div>

                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="button" onclick="confirmSignOut()" class="transition cursor-pointer p-1.5 rounded-lg text-stone-400 hover:text-saltora-terracotta hover:bg-saltora-blush-light" title="Sign Out">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Dynamic Content Area (#F8F5EF Pink-Salt Ambient Background) -->
        <div class="flex-1 lg:ml-64 min-h-[calc(100vh-4rem)] p-4 sm:p-6 lg:p-8 pb-16 flex flex-col justify-between transition-all duration-300 bg-[#F8F5EF]">
            
            <main class="space-y-6 flex-1 pb-20">
                @yield('admin-content')
            </main>

            <!-- Admin Footer -->
            <footer class="mt-8 border-t border-stone-200/80 pt-4 flex flex-col sm:flex-row items-center justify-between text-[0.7rem] text-stone-500 font-medium gap-2 text-center sm:text-left">
                <p>© {{ date('Y') }} MEHAAJ Luxury Atelier — Executive Control Center</p>
                <p>Designed for MEHAAJ E-Commerce Store</p>
            </footer>

        </div>

    </div>

    <!-- Internationalization (EN / DE) Global Persistent Translation Engine -->
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
            if (!lang) lang = 'en';
            
            // Persist globally across tabs and page reloads via localStorage & Cookie
            try {
                localStorage.setItem('mehaaj_admin_lang', lang);
            } catch(e){}
            setCookie('mehaaj_admin_lang', lang, 365);
            setCookie('locale', lang, 365);
            window.__mehaaj_lang = lang;
            document.documentElement.lang = lang;

            // Update Language toggle button active states in Header
            document.querySelectorAll('[data-language-option]').forEach(btn => {
                const optLang = btn.getAttribute('data-language-option');
                if (optLang === lang) {
                    btn.className = 'cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-black uppercase transition bg-saltora-terracotta text-white shadow-2xs';
                } else {
                    btn.className = 'cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition text-stone-600 hover:text-stone-900';
                }
            });

            // Translate all elements with data-i18n-de and data-i18n-en safely
            document.querySelectorAll('[data-i18n-' + lang + ']').forEach(el => {
                const text = el.getAttribute('data-i18n-' + lang);
                if (text === null) return;

                const childWithI18n = el.querySelector('[data-i18n-' + lang + ']');
                if (childWithI18n) return;

                let textNode = null;
                for (let child of el.childNodes) {
                    if (child.nodeType === Node.TEXT_NODE && child.textContent.trim().length > 0) {
                        textNode = child;
                        break;
                    }
                }

                if (textNode && el.children.length > 0) {
                    textNode.textContent = text;
                } else if (el.children.length === 0) {
                    el.innerText = text;
                } else {
                    const spanTarget = el.querySelector('span');
                    if (spanTarget) {
                        spanTarget.innerText = text;
                    } else {
                        el.innerText = text;
                    }
                }
            });

            // Translate placeholders
            document.querySelectorAll('[data-i18n-placeholder-' + lang + ']').forEach(el => {
                const ph = el.getAttribute('data-i18n-placeholder-' + lang);
                if (ph !== null) {
                    el.placeholder = ph;
                }
            });

            // Translate tooltips and titles
            document.querySelectorAll('[data-i18n-title-' + lang + ']').forEach(el => {
                const title = el.getAttribute('data-i18n-title-' + lang);
                if (title !== null) {
                    el.title = title;
                }
            });

            // Notify backend asynchronously to synchronize Laravel session locale
            try {
                fetch(`/admin/lang/${lang}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).catch(() => {});
            } catch(e) {}
        }

        // Cross-tab real-time persistence sync
        window.addEventListener('storage', function(e) {
            if (e.key === 'mehaaj_admin_lang' && e.newValue) {
                applyLanguage(e.newValue);
            }
        });

        // Apply immediately and setup click listeners
        const initialLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en';

        document.addEventListener('DOMContentLoaded', function() {
            applyLanguage(initialLang);

            document.querySelectorAll('[data-language-option]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const lang = this.getAttribute('data-language-option');
                    applyLanguage(lang);
                });
            });
        });

        window.addEventListener('load', function() {
            applyLanguage(localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en');
        });

        // Pink-Salt SweetAlert Logout Modal
        function confirmSignOut() {
            const isEn = (window.__mehaaj_lang || 'en') === 'en';
            Swal.fire({
                title: isEn ? 'Sign Out?' : 'Abmelden?',
                text: isEn ? 'Are you sure you want to end your admin session?' : 'Möchten Sie Ihre Admin-Sitzung wirklich beenden?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#964B42',
                cancelButtonColor: '#64748b',
                confirmButtonText: isEn ? '<i class="fa-solid fa-right-from-bracket mr-1.5"></i> Yes, Sign Out' : '<i class="fa-solid fa-right-from-bracket mr-1.5"></i> Ja, Abmelden',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
                reverseButtons: true,
                background: '#ffffff',
                color: '#1c1917',
                customClass: {
                    popup: 'rounded-2xl shadow-2xl border border-stone-200',
                    confirmButton: 'rounded-xl px-4 py-2.5 font-semibold text-xs shadow-md shadow-[#964B42]/20',
                    cancelButton: 'rounded-xl px-4 py-2.5 font-semibold text-xs'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: isEn ? 'Signing Out...' : 'Abmeldung läuft...',
                        text: isEn ? 'Ending admin session securely.' : 'Admin-Sitzung wird sicher beendet.',
                        icon: 'success',
                        timer: 800,
                        showConfirmButton: false,
                        background: '#ffffff',
                        color: '#1c1917',
                        iconColor: '#964B42',
                        timerProgressBar: true
                    }).then(() => {
                        document.getElementById('admin-logout-form').submit();
                    });
                }
            });
        }
    </script>
</body>
</html>
