@extends('layouts.admin')
@section('title', 'Product Catalog Management - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Compact Executive KPI Metric Cards (Clickable Filter Shortcuts with Cursor Pointer) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
        
        <!-- 1. Total Products -->
        <a href="{{ route('admin.products') }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-stone-400 transition-all duration-150 flex items-center justify-between cursor-pointer" title="View all products">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Gesamte Produkte" data-i18n-en="Total Products">Total Products</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $totalCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200/80 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-saltora-blush group-hover:text-saltora-terracotta transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.products', ['status' => 'active']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-emerald-300 transition-all duration-150 flex items-center justify-between cursor-pointer" title="Filter by Active">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $activeCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </a>

        <!-- 3. Draft / Inactive -->
        <a href="{{ route('admin.products', ['status' => 'draft']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-amber-300 transition-all duration-150 flex items-center justify-between cursor-pointer" title="Filter by Draft">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $draftCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50/70 text-amber-700 border border-amber-200/70 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-amber-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </a>

        <!-- 4. Low Stock -->
        <a href="{{ route('admin.products', ['stock' => 'low']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-rose-300 transition-all duration-150 flex items-center justify-between cursor-pointer" title="Filter by Low Stock">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-rose-700 uppercase tracking-wider block" data-i18n-de="Niedriger Bestand" data-i18n-en="Low Stock (≤5)">Low Stock (≤5)</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $lowStockCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-rose-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </a>

    </div>

    <!-- Main Products Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Action Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span data-i18n-de="Produkte Katalog Übersicht" data-i18n-en="Products Directory & Inventory">Products Directory & Inventory</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Ihr gesamtes Luxusproduktsortiment, Preise und Lagerbestände." data-i18n-en="Manage your full luxury product collection, prices, stock levels, and catalog linkages.">
                    Manage your full luxury product collection, prices, stock levels, and catalog linkages.
                </p>
            </div>
            
            <a href="{{ route('admin.products.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Neues Produkt" data-i18n-en="Add Product">Add Product</span>
            </a>
        </div>

        <!-- Sleek Search & Filters Toolbar -->
        <div class="p-4 sm:p-5 bg-stone-50/70 border-b border-stone-200/80 relative z-30">
            <form action="{{ route('admin.products') }}" method="GET" id="productsFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
                
                <!-- Left: Search with Instant Suggestions Dropdown -->
                <div class="relative flex-1 max-w-xl">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="productSearchInput"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            placeholder="Search product by name, SKU or category..."
                            data-i18n-placeholder-de="Produkt nach Name, SKU oder Kategorie suchen..."
                            data-i18n-placeholder-en="Search product by name, SKU or category..."
                            class="h-11 w-full pl-10 pr-9 rounded-xl border border-stone-200/90 bg-white text-xs font-semibold text-stone-900 placeholder:text-stone-400 placeholder:font-normal focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none transition"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-3 top-3.5 text-stone-400 hover:text-stone-600 transition" title="Clear search">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>

                    <!-- Floating Instant Suggestions Panel -->
                    <div 
                        id="productSuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-1.5 bg-white rounded-xl border border-stone-200 shadow-xl overflow-hidden z-50 divide-y divide-stone-100 max-h-80 overflow-y-auto"
                    >
                        <!-- Dynamic items injected via JS -->
                    </div>
                </div>

                <!-- Right: Sleek Filter Pills with Single Clean Chevron -->
                <style>
                    select.filter-select,
                    select.appearance-none {
                        -webkit-appearance: none !important;
                        -moz-appearance: none !important;
                        appearance: none !important;
                        background-image: none !important;
                    }
                    select.filter-select::-ms-expand,
                    select.appearance-none::-ms-expand {
                        display: none !important;
                    }
                </style>
                <div class="flex flex-wrap items-center gap-2.5">
                    
                    <!-- Category Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        <select 
                            name="category_id" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Category: All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    Category: {{ $cat->name }} ({{ $cat->products_count }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Status: All ({{ $totalCount }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Status: Active ({{ $activeCount }})</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Status: Draft ({{ $draftCount }})</option>
                            <option value="out_of_stock" {{ request('status') === 'out_of_stock' ? 'selected' : '' }}>Status: Out of Stock</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        <select 
                            name="sort" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Sort: Price (Low → High)</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Sort: Price (High → Low)</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="stock_asc" {{ request('sort') === 'stock_asc' ? 'selected' : '' }}>Sort: Low Stock First</option>
                            <option value="stock_desc" {{ request('sort') === 'stock_desc' ? 'selected' : '' }}>Sort: High Stock First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Sort: Oldest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'category_id', 'subcategory_id', 'status', 'stock', 'sort']))
                        <a href="{{ route('admin.products') }}" class="h-11 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-stone-200/90 hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container (Clean, Modern, No Horizontal Scroll) -->
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-3.5 px-4 font-black w-14 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Produkt" data-i18n-en="Product">Product</th>
                        <th class="py-3.5 px-3 font-black text-center w-36" data-i18n-de="Lagerbestand" data-i18n-en="Stock">Stock</th>
                        <th class="py-3.5 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-4 font-black text-center w-52" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($products as $product)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80" id="product-row-{{ $product->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center justify-center h-7 w-7 rounded-lg bg-stone-100 font-mono font-bold text-stone-700 text-xs border border-stone-200 shadow-2xs">
                                    {{ $loop->iteration + ($products->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Product Thumbnail + Title + SKU -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-11 w-11 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0 group relative">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                            <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-stone-100 font-display font-bold text-sm text-stone-500">
                                                {{ mb_substr($product->name, 0, 1) }}
                                            </div>
                                        @else
                                            <div class="text-stone-400 flex items-center justify-center w-full h-full bg-stone-100 font-display font-bold text-stone-600 text-sm">
                                                {{ mb_substr($product->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <span class="font-extrabold text-stone-900 text-sm tracking-tight truncate block">
                                            {{ $product->name }}
                                        </span>
                                        <span class="text-[0.65rem] text-stone-400 font-mono tracking-tight block">
                                            SKU: {{ $product->sku ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- 5. Stock Level Badge -->
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        <span>{{ $product->stock }} <span data-i18n-de="auf Lager" data-i18n-en="in stock">in stock</span></span>
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span>{{ $product->stock }} <span data-i18n-de="Gering" data-i18n-en="Low stock">Low stock</span></span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        <span data-i18n-de="Ausverkauft" data-i18n-en="Out of stock">Out of stock</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 6. Status Badge -->
                            <td class="py-3.5 px-3 text-center">
                                @if($product->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        <span data-i18n-de="AKTIV" data-i18n-en="ACTIVE">ACTIVE</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        <span data-i18n-de="ENTWURF" data-i18n-en="DRAFT">DRAFT</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 7. Actions (View, Edit, Delete) -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    
                                    @php
                                        $galleryUrls = [];
                                        if (!empty($product->gallery_images) && is_array($product->gallery_images)) {
                                            foreach ($product->gallery_images as $gImg) {
                                                $galleryUrls[] = asset('storage/' . $gImg);
                                            }
                                        }

                                        $productModalData = [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'slug' => $product->slug,
                                            'sku' => $product->sku ?? 'N/A',
                                            'price' => (float)$product->price,
                                            'sale_price' => $product->sale_price ? (float)$product->sale_price : null,
                                            'cost_price' => $product->cost_price ? (float)$product->cost_price : null,
                                            'stock' => (int)$product->stock,
                                            'status' => $product->status,
                                            'is_featured' => (bool)$product->is_featured,
                                            'category_name' => $product->category ? $product->category->name : 'N/A',
                                            'subcategory_name' => $product->subcategory ? $product->subcategory->name : null,
                                            'image_url' => $product->image ? asset('storage/' . $product->image) : null,
                                            'gallery_urls' => $galleryUrls,
                                            'variations' => is_array($product->variations) ? $product->variations : [],
                                            'accordion_tabs' => is_array($product->accordion_tabs) ? $product->accordion_tabs : [],
                                            'description' => $product->description ?? '',
                                            'craftsmanship' => $product->craftsmanship ?? '',
                                            'store_url' => route('shop.show', $product->slug),
                                            'edit_url' => route('admin.products.edit', $product->id),
                                        ];
                                    @endphp

                                    <!-- View / Detail Modal Button -->
                                    <button
                                        type="button"
                                        onclick='openViewProductModal(@json($productModalData))'
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Product Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Edit Product"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="btn-exec-danger rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Delete Product"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
                                    </button>

                                    <form id="delete-product-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 px-6 text-center text-stone-500 text-xs">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="h-12 w-12 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Produkte gefunden" data-i18n-en="No products found">No products found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Passen Sie Ihre Filter an oder legen Sie ein neues Produkt an." data-i18n-en="Adjust your search filters or add a new luxury product to your catalog.">
                                        Adjust your search filters or add a new luxury product to your catalog.
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.products.create') }}" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs">
                                            <span>+</span> <span data-i18n-de="Neues Produkt Anlegen" data-i18n-en="Create New Product">Create New Product</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Proper Production Pagination Footer -->
        <div class="p-4 sm:p-5 bg-stone-50/70 border-t border-stone-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-600">
            <div>
                @if($products->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span>
                    <strong class="text-stone-900 font-extrabold">{{ $products->firstItem() }}</strong>
                    <span data-i18n-de="bis" data-i18n-en="to">to</span>
                    <strong class="text-stone-900 font-extrabold">{{ $products->lastItem() }}</strong>
                    <span data-i18n-de="von" data-i18n-en="of">of</span>
                    <strong class="text-stone-900 font-extrabold">{{ $products->total() }}</strong>
                    <span data-i18n-de="Produkte" data-i18n-en="products">products</span>
                @else
                    <span data-i18n-de="0 Produkte gelistet" data-i18n-en="0 products listed">0 products listed</span>
                @endif
            </div>

            @if($products->hasPages())
                <div class="pagination-luxury">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>

</div>

<!-- Product Quick View Executive Modal (Full-Screen Soft Blur Background Covering Header) -->
<div id="view-product-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden transition-all duration-300" style="z-index: 9999 !important; background-color: rgba(28, 25, 23, 0.15) !important; backdrop-filter: blur(3px) !important; -webkit-backdrop-filter: blur(3px) !important;" onclick="closeViewProductModal()">
    <div class="relative w-full max-w-2xl bg-white rounded-2xl border border-stone-200/90 shadow-2xl overflow-hidden border-t-4 border-t-saltora-terracotta" onclick="event.stopPropagation()">
        
        <!-- Modal Top Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-sm shadow-2xs border border-saltora-terracotta/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-stone-900 text-sm tracking-tight" data-i18n-de="Produkt-Details" data-i18n-en="Product Details">Product Details</h3>
                    <p class="text-[0.68rem] text-stone-400 font-mono" id="prod-view-sku">SKU: ---</p>
                </div>
            </div>
            <button type="button" onclick="closeViewProductModal()" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 text-xs max-h-[75vh] modal-scroll-clean">
            
            <!-- Hero Product Banner: Image + Key Details -->
            <div class="flex flex-col sm:flex-row items-start gap-4 p-4 rounded-xl bg-stone-50/70 border border-stone-200/70">
                <!-- Main Product Image -->
                <div class="w-24 h-24 min-w-[6rem] min-h-[6rem] max-w-[6rem] max-h-[6rem] rounded-xl overflow-hidden bg-white border border-stone-200 shadow-2xs shrink-0 flex items-center justify-center">
                    <img id="prod-view-img" src="" alt="Product Image" class="w-full h-full object-cover hidden" style="width: 100%; height: 100%; object-fit: cover;">
                    <div id="prod-view-no-img" class="text-stone-400 font-display font-bold text-2xl flex items-center justify-center w-full h-full bg-stone-100">
                        <span id="prod-view-letter">P</span>
                    </div>
                </div>

                <div class="space-y-2 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="prod-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="prod-view-status-badge"></span>
                        <span id="prod-view-featured-badge" class="hidden inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                            ⭐ Featured
                        </span>
                    </div>

                    <!-- Category & Subcategory -->
                    <div class="flex items-center gap-2 text-[0.72rem] text-stone-600 font-medium">
                        <span class="text-stone-400 font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Kategorie:" data-i18n-en="Category:">Category:</span>
                        <span id="prod-view-category" class="font-bold text-stone-800"></span>
                        <span id="prod-view-subcat-divider" class="text-stone-300">›</span>
                        <span id="prod-view-subcat" class="text-stone-500 font-medium"></span>
                    </div>

                    <div class="text-[0.68rem] text-stone-400 font-mono">
                        Slug: <span id="prod-view-slug" class="text-stone-600"></span>
                    </div>
                </div>
            </div>

            <!-- Gallery Thumbnails (if any) -->
            <div id="prod-view-gallery-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Bildergalerie" data-i18n-en="Gallery Photos">Gallery Photos</label>
                <div id="prod-view-gallery" class="flex items-center gap-2 overflow-x-auto pb-1">
                </div>
            </div>

            <!-- Pricing & Financial Metrics Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Regulärer Preis" data-i18n-en="Regular Price">Regular Price</span>
                    <span id="prod-view-regular-price" class="font-extrabold text-sm text-stone-900 mt-0.5 block">€0.00</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Angebotspreis" data-i18n-en="Sale Price">Sale Price</span>
                    <span id="prod-view-sale-price" class="font-extrabold text-sm text-saltora-terracotta mt-0.5 block">N/A</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Einkaufspreis" data-i18n-en="Cost Price">Cost Price</span>
                    <span id="prod-view-cost-price" class="font-extrabold text-sm text-stone-700 mt-0.5 block">€0.00</span>
                </div>

                <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-200/80">
                    <span class="text-[0.62rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Marge / Gewinn" data-i18n-en="Gross Margin">Gross Margin</span>
                    <span id="prod-view-margin" class="font-extrabold text-sm text-emerald-800 mt-0.5 block">0%</span>
                </div>
            </div>

            <!-- Inventory Stock Indicator -->
            <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/80 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-stone-400 font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Lagerbestand:" data-i18n-en="Inventory Stock:">Inventory Stock:</span>
                    <span id="prod-view-stock-count" class="font-extrabold text-sm text-stone-900">0 units</span>
                </div>
                <div id="prod-view-stock-badge"></div>
            </div>

            <!-- Variations Finishes (if any) -->
            <div id="prod-view-variations-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Produktvariationen / Ausführungen" data-i18n-en="Product Variations / Finishes">Product Variations / Finishes</label>
                <div id="prod-view-variations" class="flex flex-wrap gap-2 p-3 rounded-xl bg-stone-50 border border-stone-200/70">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Product Description</label>
                <div id="prod-view-desc" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[50px] whitespace-pre-line"></div>
            </div>

            <!-- Craftsmanship -->
            <div id="prod-view-craftsmanship-section">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Handwerk & Material" data-i18n-en="Craftsmanship & Atelier Notes">Craftsmanship & Atelier Notes</label>
                <div id="prod-view-craftsmanship" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[40px] whitespace-pre-line"></div>
            </div>

            <!-- Accordion Tabs (if any) -->
            <div id="prod-view-tabs-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Spezifikationen & Reitertabs" data-i18n-en="Specification Tabs">Specification Tabs</label>
                <div id="prod-view-tabs" class="space-y-1.5">
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-between gap-3">
            <a id="prod-view-store-btn" href="#" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta">
                <svg class="w-3.5 h-3.5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span data-i18n-de="Im Shop ansehen" data-i18n-en="View in Store">View in Store</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewProductModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer shadow-2xs" data-i18n-de="Schließen" data-i18n-en="Close">Close</button>
                <a id="prod-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span data-i18n-de="Bearbeiten" data-i18n-en="Edit Product">Edit Product</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    // Dataset for instant autocomplete search suggestions
    const ALL_PRODUCTS = @json($allProductsForSuggestions ?? []);

    const searchInput = document.getElementById('productSearchInput');
    const suggestionsPanel = document.getElementById('productSuggestionsPanel');
    const filterForm = document.getElementById('productsFilterForm');
    let selectedSuggestionIndex = -1;

    if (searchInput && suggestionsPanel) {
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function highlightMatch(text, query) {
            if (!query) return escapeHtml(text);
            const escapedText = escapeHtml(text);
            const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
            return escapedText.replace(regex, '<span class="bg-amber-100 text-amber-900 font-black px-0.5 rounded">$1</span>');
        }

        function renderSuggestions(query) {
            const trimmed = query.trim().toLowerCase();
            selectedSuggestionIndex = -1;

            if (!trimmed) {
                suggestionsPanel.classList.add('hidden');
                suggestionsPanel.innerHTML = '';
                return;
            }

            const matches = ALL_PRODUCTS.filter(p => {
                return (p.name && p.name.toLowerCase().includes(trimmed)) ||
                       (p.sku && p.sku.toLowerCase().includes(trimmed)) ||
                       (p.slug && p.slug.toLowerCase().includes(trimmed)) ||
                       (p.category_name && p.category_name.toLowerCase().includes(trimmed));
            }).slice(0, 6);

            if (matches.length === 0) {
                suggestionsPanel.innerHTML = `
                    <div class="px-4 py-3 text-xs text-stone-400 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <span>No product matches found for "<strong>${escapeHtml(query)}</strong>"</span>
                    </div>
                `;
                suggestionsPanel.classList.remove('hidden');
                return;
            }

            let html = `
                <div class="px-3 py-1.5 bg-stone-50 text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 flex items-center justify-between">
                    <span>Quick Suggestions (${matches.length})</span>
                    <span class="text-[0.6rem] text-stone-400">↑↓ Navigate • Enter to Filter</span>
                </div>
            `;

            matches.forEach((p, idx) => {
                const imgHtml = p.image_url 
                    ? `<img src="${p.image_url}" class="h-full w-full object-cover">`
                    : `<span class="font-display font-bold text-xs text-stone-500">${escapeHtml(p.name.charAt(0))}</span>`;
                
                const statusBadge = p.status === 'active'
                    ? `<span class="text-[0.6rem] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded-md">ACTIVE</span>`
                    : `<span class="text-[0.6rem] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-1.5 py-0.5 rounded-md">DRAFT</span>`;

                const priceDisplay = p.sale_price 
                    ? `<span class="text-saltora-terracotta font-extrabold">€${p.sale_price.toFixed(2)}</span>`
                    : `<span class="font-extrabold text-stone-800">€${p.price.toFixed(2)}</span>`;

                html += `
                    <div 
                        class="suggestion-item px-3.5 py-2.5 hover:bg-stone-50 cursor-pointer flex items-center justify-between gap-3 transition" 
                        data-index="${idx}"
                        data-name="${escapeHtml(p.name)}"
                        data-id="${p.id}"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="h-8 w-8 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 flex items-center justify-center shrink-0">
                                ${imgHtml}
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-extrabold text-stone-900 truncate">
                                    ${highlightMatch(p.name, trimmed)}
                                </div>
                                <div class="text-[0.65rem] text-stone-400 font-medium truncate flex items-center gap-1.5">
                                    <span class="text-saltora-terracotta font-semibold">${escapeHtml(p.category_name)}</span>
                                    <span>•</span>
                                    <span class="font-mono">SKU: ${escapeHtml(p.sku)}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="text-xs">
                                ${priceDisplay}
                            </span>
                            ${statusBadge}
                        </div>
                    </div>
                `;
            });

            suggestionsPanel.innerHTML = html;
            suggestionsPanel.classList.remove('hidden');

            // Click handling on suggestions
            suggestionsPanel.querySelectorAll('.suggestion-item').forEach(item => {
                item.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    searchInput.value = name;
                    suggestionsPanel.classList.add('hidden');
                    filterForm.submit();
                });
            });
        }

        let debounceTimer;
        searchInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                renderSuggestions(e.target.value);
            }, 120);
        });

        searchInput.addEventListener('keydown', function(e) {
            const items = suggestionsPanel.querySelectorAll('.suggestion-item');
            if (items.length === 0 || suggestionsPanel.classList.contains('hidden')) {
                return;
            }

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedSuggestionIndex = (selectedSuggestionIndex + 1) % items.length;
                updateSuggestionHighlight(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedSuggestionIndex = (selectedSuggestionIndex - 1 + items.length) % items.length;
                updateSuggestionHighlight(items);
            } else if (e.key === 'Enter') {
                if (selectedSuggestionIndex >= 0 && items[selectedSuggestionIndex]) {
                    e.preventDefault();
                    const name = items[selectedSuggestionIndex].getAttribute('data-name');
                    searchInput.value = name;
                    suggestionsPanel.classList.add('hidden');
                    filterForm.submit();
                }
            } else if (e.key === 'Escape') {
                suggestionsPanel.classList.add('hidden');
            }
        });

        function updateSuggestionHighlight(items) {
            items.forEach((item, idx) => {
                if (idx === selectedSuggestionIndex) {
                    item.classList.add('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.classList.remove('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsPanel.contains(e.target)) {
                suggestionsPanel.classList.add('hidden');
            }
        });
    }

    // Modal Handling
    function openViewProductModal(data) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('prod-view-name').textContent = data.name;
        document.getElementById('prod-view-sku').textContent = 'SKU: ' + (data.sku || 'N/A');
        document.getElementById('prod-view-slug').textContent = '/' + data.slug;
        document.getElementById('prod-view-category').textContent = data.category_name || 'N/A';
        
        // Subcategory
        const subcatEl = document.getElementById('prod-view-subcat');
        const dividerEl = document.getElementById('prod-view-subcat-divider');
        if (data.subcategory_name) {
            subcatEl.textContent = data.subcategory_name;
            subcatEl.classList.remove('hidden');
            dividerEl.classList.remove('hidden');
        } else {
            subcatEl.textContent = '';
            subcatEl.classList.add('hidden');
            dividerEl.classList.add('hidden');
        }

        // Image
        const imgEl = document.getElementById('prod-view-img');
        const noImgEl = document.getElementById('prod-view-no-img');
        const letterEl = document.getElementById('prod-view-letter');
        if (data.image_url) {
            imgEl.src = data.image_url;
            imgEl.classList.remove('hidden');
            noImgEl.classList.add('hidden');
        } else {
            imgEl.src = '';
            imgEl.classList.add('hidden');
            noImgEl.classList.remove('hidden');
            letterEl.textContent = (data.name || 'P').charAt(0);
        }

        // Status Badge
        const badgeEl = document.getElementById('prod-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span><span>${isEn ? 'ACTIVE' : 'AKTIV'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/80';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'DRAFT' : 'ENTWURF'}</span>`;
        }

        // Featured Badge
        const featBadge = document.getElementById('prod-view-featured-badge');
        if (data.is_featured) {
            featBadge.classList.remove('hidden');
        } else {
            featBadge.classList.add('hidden');
        }

        // Prices & Margin
        document.getElementById('prod-view-regular-price').textContent = '€' + (data.price ? data.price.toFixed(2) : '0.00');
        
        const saleEl = document.getElementById('prod-view-sale-price');
        if (data.sale_price) {
            saleEl.textContent = '€' + data.sale_price.toFixed(2);
        } else {
            saleEl.textContent = 'N/A';
        }

        const costEl = document.getElementById('prod-view-cost-price');
        if (data.cost_price) {
            costEl.textContent = '€' + data.cost_price.toFixed(2);
        } else {
            costEl.textContent = 'N/A';
        }

        const marginEl = document.getElementById('prod-view-margin');
        const effectivePrice = data.sale_price || data.price;
        if (data.cost_price && effectivePrice > 0) {
            const margin = ((effectivePrice - data.cost_price) / effectivePrice) * 100;
            marginEl.textContent = margin.toFixed(1) + '%';
        } else {
            marginEl.textContent = '---';
        }

        // Stock Count & Badge
        document.getElementById('prod-view-stock-count').textContent = data.stock + (isEn ? ' units' : ' Einheiten');
        const stockBadgeEl = document.getElementById('prod-view-stock-badge');
        if (data.stock > 5) {
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>${isEn ? 'In Stock' : 'Auf Lager'}</span>`;
        } else if (data.stock > 0) {
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-700 border border-amber-200"><span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>${isEn ? 'Low Stock' : 'Geringer Bestand'}</span>`;
        } else {
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-rose-50 text-rose-700 border border-rose-200"><span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>${isEn ? 'Out of Stock' : 'Ausverkauft'}</span>`;
        }

        // Gallery Photos
        const gallerySec = document.getElementById('prod-view-gallery-section');
        const galleryContainer = document.getElementById('prod-view-gallery');
        galleryContainer.innerHTML = '';
        if (data.gallery_urls && data.gallery_urls.length > 0) {
            data.gallery_urls.forEach(url => {
                const imgThumb = document.createElement('img');
                imgThumb.src = url;
                imgThumb.className = 'w-14 h-14 rounded-lg object-cover border border-stone-200 hover:scale-105 transition cursor-pointer shadow-2xs';
                imgThumb.onclick = () => { imgEl.src = url; };
                galleryContainer.appendChild(imgThumb);
            });
            gallerySec.classList.remove('hidden');
        } else {
            gallerySec.classList.add('hidden');
        }

        // Variations
        const varSec = document.getElementById('prod-view-variations-section');
        const varContainer = document.getElementById('prod-view-variations');
        varContainer.innerHTML = '';
        if (data.variations && data.variations.length > 0) {
            data.variations.forEach(v => {
                const pill = document.createElement('span');
                pill.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-white border border-stone-200 text-stone-700 shadow-2xs';
                pill.textContent = (v.type || 'Finish') + ': ' + (v.value || v.name || JSON.stringify(v));
                varContainer.appendChild(pill);
            });
            varSec.classList.remove('hidden');
        } else {
            varSec.classList.add('hidden');
        }

        // Description
        const descEl = document.getElementById('prod-view-desc');
        if (data.description && data.description.trim()) {
            descEl.textContent = data.description;
            descEl.classList.remove('italic', 'text-stone-400');
        } else {
            descEl.textContent = isEn ? 'No description available for this luxury product.' : 'Keine Beschreibung für dieses Produkt verfügbar.';
            descEl.classList.add('italic', 'text-stone-400');
        }

        // Craftsmanship
        const craftSec = document.getElementById('prod-view-craftsmanship-section');
        const craftEl = document.getElementById('prod-view-craftsmanship');
        if (data.craftsmanship && data.craftsmanship.trim()) {
            craftEl.textContent = data.craftsmanship;
            craftSec.classList.remove('hidden');
        } else {
            craftSec.classList.add('hidden');
        }

        // Specification Tabs
        const tabsSec = document.getElementById('prod-view-tabs-section');
        const tabsContainer = document.getElementById('prod-view-tabs');
        tabsContainer.innerHTML = '';
        if (data.accordion_tabs && data.accordion_tabs.length > 0) {
            data.accordion_tabs.forEach(tab => {
                const tabDiv = document.createElement('div');
                tabDiv.className = 'p-2.5 rounded-lg bg-stone-50 border border-stone-200/80';
                tabDiv.innerHTML = `<h5 class="font-bold text-stone-800 text-[0.72rem]">${escapeHtml(tab.title || tab.name || 'Tab')}</h5><p class="text-stone-600 text-[0.68rem] mt-0.5">${escapeHtml(tab.content || '')}</p>`;
                tabsContainer.appendChild(tabDiv);
            });
            tabsSec.classList.remove('hidden');
        } else {
            tabsSec.classList.add('hidden');
        }

        // Action links
        document.getElementById('prod-view-store-btn').href = data.store_url;
        document.getElementById('prod-view-edit-btn').href = data.edit_url;

        // Show modal
        document.body.classList.add('overflow-hidden');
        document.getElementById('view-product-modal').classList.remove('hidden');
    }

    function closeViewProductModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('view-product-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewProductModal();
        }
    });

    function confirmDeleteProduct(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        Swal.fire({
            title: isEn ? 'Delete Product?' : 'Produkt löschen?',
            text: isEn 
                ? `Are you sure you want to permanently delete "${name}"?` 
                : `Möchten Sie "${name}" wirklich unwiderruflich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl font-bold px-4 py-2',
                cancelButton: 'rounded-xl font-bold px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        });
    }
</script>
@endsection
