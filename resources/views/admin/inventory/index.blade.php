@extends('layouts.admin')
@section('title', 'Inventory & Stock Management - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 5 Compact Executive Inventory KPI Summary Cards (Clickable Filter Shortcuts with Cursor Pointer) -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 lg:gap-4">
        
        <!-- 1. Catalog Items -->
        <a href="{{ route('admin.inventory') }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-stone-400 transition-all duration-150 flex items-center justify-between cursor-pointer" title="View all products">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Produkte" data-i18n-en="Catalog Items">Catalog Items</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $totalProducts }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200/80 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-saltora-blush group-hover:text-saltora-terracotta transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </a>

        <!-- 2. Total Stock Units -->
        <div class="bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Gesamtlager" data-i18n-en="Total Units">Total Units</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ number_format($totalUnits) }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 3. In Stock -->
        <a href="{{ route('admin.inventory', ['filter' => 'in_stock']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-emerald-300 transition-all duration-150 flex items-center justify-between cursor-pointer {{ $filter === 'in_stock' ? 'ring-2 ring-emerald-500/30 border-emerald-500' : '' }}" title="Filter by In Stock">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Auf Lager (>5)" data-i18n-en="In Stock (>5)">In Stock (>5)</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $inStockCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
        </a>

        <!-- 4. Low Stock Alerts -->
        <a href="{{ route('admin.inventory', ['filter' => 'low_stock']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-amber-300 transition-all duration-150 flex items-center justify-between cursor-pointer {{ $filter === 'low_stock' ? 'ring-2 ring-amber-500/30 border-amber-500' : '' }}" title="Filter by Low Stock">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Gering (≤ 5)" data-i18n-en="Low Stock (≤ 5)">Low Stock (≤ 5)</span>
                <span class="font-extrabold text-2xl text-amber-600 tracking-tight leading-none block">{{ $lowStockCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-amber-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </a>

        <!-- 5. Out of Stock -->
        <a href="{{ route('admin.inventory', ['filter' => 'out_of_stock']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-rose-300 transition-all duration-150 flex items-center justify-between cursor-pointer col-span-2 lg:col-span-1 {{ $filter === 'out_of_stock' ? 'ring-2 ring-rose-500/30 border-rose-500' : '' }}" title="Filter by Out of Stock">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-rose-700 uppercase tracking-wider block" data-i18n-de="Ausverkauft" data-i18n-en="Out of Stock">Out of Stock</span>
                <span class="font-extrabold text-2xl text-rose-600 tracking-tight leading-none block">{{ $outOfStockCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-rose-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </a>

    </div>

    <!-- Main Inventory Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Title & Total Valuation Pill -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                    <span data-i18n-de="Lagerbestand & Inventar Verwaltung" data-i18n-en="Inventory & Live Stock Control">Inventory & Live Stock Control</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Passen Sie Stückzahlen und Variantenbestände direkt per Schnellbearbeitung an." data-i18n-en="Monitor stock levels, inventory valuations, and adjust item units inline with zero latency.">
                    Monitor stock levels, inventory valuations, and adjust item units inline with zero latency.
                </p>
            </div>

            <!-- Total Valuation Badge -->
            <div class="flex items-center gap-2 shrink-0">
                <div class="px-4 py-2 rounded-xl bg-stone-50 border border-stone-200/80 shadow-2xs flex items-center gap-2.5">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-500" data-i18n-de="Warenwert:" data-i18n-en="Valuation:">Valuation:</span>
                    <span class="font-extrabold text-stone-900 text-sm font-mono">€{{ number_format($totalValuation, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Sleek Search & Filters Toolbar -->
        <div class="p-4 sm:p-5 bg-stone-50/70 border-b border-stone-200/80 relative z-30">
            <form action="{{ route('admin.inventory') }}" method="GET" id="inventoryFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
                
                <!-- Left: Search with Instant Suggestions Dropdown -->
                <div class="relative flex-1 max-w-xl">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="inventorySearchInput"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            placeholder="Search inventory by name, SKU or category..."
                            data-i18n-placeholder-de="Inventar nach Name, SKU oder Kategorie suchen..."
                            data-i18n-placeholder-en="Search inventory by name, SKU or category..."
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
                        id="inventorySuggestionsPanel" 
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

                    <!-- Stock Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="filter" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Stock: All ({{ $totalProducts }})</option>
                            <option value="in_stock" {{ $filter === 'in_stock' ? 'selected' : '' }}>Stock: In Stock (>5) ({{ $inStockCount }})</option>
                            <option value="low_stock" {{ $filter === 'low_stock' ? 'selected' : '' }}>Stock: Low (≤5) ({{ $lowStockCount }})</option>
                            <option value="out_of_stock" {{ $filter === 'out_of_stock' ? 'selected' : '' }}>Stock: Out of Stock ({{ $outOfStockCount }})</option>
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
                            <option value="stock_asc" {{ request('sort', 'stock_asc') === 'stock_asc' ? 'selected' : '' }}>Sort: Lowest Stock First</option>
                            <option value="stock_desc" {{ request('sort') === 'stock_desc' ? 'selected' : '' }}>Sort: Highest Stock First</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Sort: Price (High → Low)</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Sort: Price (Low → High)</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'category_id', 'subcategory_id', 'sort']) || (request('filter') && request('filter') !== 'all'))
                        <a href="{{ route('admin.inventory') }}" class="h-11 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-stone-200/90 hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5" title="Reset all filters">
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
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Produkt & Artikel" data-i18n-en="Product & SKU">Product & SKU</th>
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-3.5 px-4 font-black text-center w-28" data-i18n-de="Preis" data-i18n-en="Price">Price</th>
                        <th class="py-3.5 px-3 font-black text-center w-32" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-4 font-black text-center w-60" data-i18n-de="Schnell-Bestand" data-i18n-en="Live Stock Adjuster">Live Stock Adjuster</th>
                        <th class="py-3.5 px-4 font-black text-center w-36" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($products as $product)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80" id="inventory-row-{{ $product->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center justify-center h-7 w-7 rounded-lg bg-stone-100 font-mono font-bold text-stone-700 text-xs border border-stone-200 shadow-2xs">
                                    {{ $loop->iteration + ($products->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Product Thumbnail + Title + SKU + Swatches -->
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

                                        <!-- Finish Variation Swatch Breakdown -->
                                        @if(!empty($product->variations) && is_array($product->variations))
                                            <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                                @foreach($product->variations as $vIdx => $vItem)
                                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[0.6rem] font-bold bg-stone-100 border border-stone-200/80 text-stone-700 shadow-2xs" title="{{ $vItem['name'] ?? '' }}: {{ $vItem['stock'] ?? 'N/A' }} in stock">
                                                        <span class="h-1.5 w-1.5 rounded-full shrink-0 shadow-2xs" style="background-color: {{ $vItem['color'] ?? '#1c1210' }};"></span>
                                                        <span>{{ $vItem['name'] ?? 'Finish' }}</span>
                                                        @if(isset($vItem['stock']) && is_numeric($vItem['stock']))
                                                            <span class="text-saltora-terracotta ml-0.5">({{ $vItem['stock'] }})</span>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- 3. Category & Subcategory -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="space-y-0.5">
                                    @if($product->category)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs whitespace-nowrap">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-xs text-stone-400 italic">Unassigned</span>
                                    @endif

                                    @if($product->subcategory)
                                        <span class="block text-[0.68rem] text-stone-400 font-medium pl-1 truncate max-w-[150px]">
                                            ↳ {{ $product->subcategory->name }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- 4. Price & Valuation -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div>
                                    <span class="font-extrabold text-stone-900 text-sm">€{{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                                    @if($product->sale_price)
                                        <span class="text-stone-400 line-through text-[0.68rem] ml-1">€{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <span class="text-[0.65rem] text-stone-400 font-mono block">
                                    Val: €{{ number_format(($product->sale_price ?? $product->price) * max(0, (int)$product->stock), 2) }}
                                </span>
                            </td>

                            <!-- 5. Stock Level Badge -->
                            <td class="py-3.5 px-3 text-center whitespace-nowrap" id="stock-badge-cell-{{ $product->id }}">
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

                            <!-- 6. Quick Inline Stock Adjuster -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5 p-1 rounded-xl bg-stone-50 border border-stone-200/80 shadow-2xs">
                                    <!-- Minus Button -->
                                    <button 
                                        type="button" 
                                        onclick="adjustInlineStock({{ $product->id }}, -1)"
                                        class="h-7 w-7 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 flex items-center justify-center font-bold text-stone-700 transition cursor-pointer active:scale-95 text-xs shadow-2xs"
                                        title="Decrease 1"
                                    >−</button>

                                    <!-- Stock Number Input -->
                                    <input 
                                        type="number" 
                                        id="stock-input-{{ $product->id }}" 
                                        min="0"
                                        value="{{ $product->stock }}" 
                                        class="h-7 w-16 rounded-lg text-center font-extrabold text-xs text-stone-900 border border-stone-200/90 bg-white outline-none focus:border-saltora-terracotta focus:ring-1 focus:ring-saltora-terracotta transition shadow-2xs"
                                        onkeydown="if(event.key==='Enter'){ saveInlineStock({{ $product->id }}); }"
                                    >

                                    <!-- Plus Button -->
                                    <button 
                                        type="button" 
                                        onclick="adjustInlineStock({{ $product->id }}, 1)"
                                        class="h-7 w-7 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 flex items-center justify-center font-bold text-stone-700 transition cursor-pointer active:scale-95 text-xs shadow-2xs"
                                        title="Increase 1"
                                    >+</button>

                                    <!-- Save Button -->
                                    <button 
                                        type="button" 
                                        id="save-btn-{{ $product->id }}"
                                        onclick="saveInlineStock({{ $product->id }})"
                                        class="h-7 px-2.5 rounded-lg bg-stone-900 hover:bg-saltora-terracotta text-white font-bold text-[0.68rem] transition flex items-center gap-1 cursor-pointer shadow-2xs shrink-0"
                                        title="Save Stock Count"
                                    >
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </td>

                            <!-- 7. Actions (Detail Modal, Edit, View in Store) -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    
                                    @php
                                        $inventoryModalData = [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'sku' => $product->sku ?? 'N/A',
                                            'price' => (float)$product->price,
                                            'sale_price' => $product->sale_price ? (float)$product->sale_price : null,
                                            'stock' => (int)$product->stock,
                                            'valuation' => ($product->sale_price ?? $product->price) * max(0, (int)$product->stock),
                                            'status' => $product->status,
                                            'category_name' => $product->category ? $product->category->name : 'Unassigned',
                                            'subcategory_name' => $product->subcategory ? $product->subcategory->name : null,
                                            'image_url' => $product->image ? asset('storage/' . $product->image) : null,
                                            'variations' => is_array($product->variations) ? $product->variations : [],
                                            'store_url' => route('shop.show', $product->slug ?? $product->id),
                                            'edit_url' => route('admin.products.edit', $product->id),
                                        ];
                                    @endphp

                                    <!-- Detail Modal Button -->
                                    <button
                                        type="button"
                                        onclick='openInventoryDetailModal(@json($inventoryModalData))'
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Stock Breakdown"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Details" data-i18n-en="Details">Details</span>
                                    </button>

                                    <!-- Edit Link -->
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Edit Product"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- View Live in Store Link -->
                                    <a
                                        href="{{ route('shop.show', $product->slug ?? $product->id) }}"
                                        target="_blank"
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs text-stone-500 hover:text-stone-900"
                                        title="View Live in Store"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-16 px-6 text-center text-stone-500 text-xs">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="h-12 w-12 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Bestände gefunden" data-i18n-en="No inventory items found">No inventory items found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Passen Sie Ihre Filter an oder durchsuchen Sie den Katalog neu." data-i18n-en="Adjust your search filters or clear your selection to view all product inventory.">
                                        Adjust your search filters or clear your selection to view all product inventory.
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.inventory') }}" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs">
                                            <span data-i18n-de="Alle anzeigen" data-i18n-en="View All Stock">View All Stock</span>
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
                    <span data-i18n-de="Produkten" data-i18n-en="products">products</span>
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

<!-- Inventory Quick View Executive Modal (Full-Screen Soft Blur Background Covering Header) -->
<div id="inventory-detail-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden transition-all duration-300" style="z-index: 9999 !important; background-color: rgba(28, 25, 23, 0.15) !important; backdrop-filter: blur(3px) !important; -webkit-backdrop-filter: blur(3px) !important;" onclick="closeInventoryDetailModal()">
    
    <!-- Modal Card Container -->
    <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-stone-200/90 overflow-hidden transform transition-all flex flex-col max-h-[90vh]" onclick="event.stopPropagation()">
        
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-white border-b border-stone-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 flex items-center justify-center shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-base text-stone-900 tracking-tight" id="modal-product-title">Product Stock Dossier</h3>
                    <p class="text-[0.68rem] text-stone-400 font-mono tracking-tight" id="modal-product-sku">SKU: --</p>
                </div>
            </div>

            <button 
                type="button" 
                onclick="closeInventoryDetailModal()" 
                class="h-8 w-8 rounded-lg border border-stone-200 text-stone-400 hover:text-stone-700 hover:bg-stone-50 transition flex items-center justify-center cursor-pointer shadow-2xs"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 overflow-y-auto space-y-5 text-xs text-stone-600">
            
            <!-- Hero Product Strip -->
            <div class="flex items-center gap-4 p-4 rounded-xl bg-[#F8F5EF] border border-stone-200/80">
                <div class="h-16 w-16 rounded-xl overflow-hidden bg-white border border-stone-200 shadow-2xs shrink-0 flex items-center justify-center" id="modal-thumb-wrap">
                    <!-- Image injected via JS -->
                </div>
                <div class="flex-1 min-w-0 space-y-1">
                    <div class="flex items-center gap-2">
                        <span id="modal-cat-badge" class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">Category</span>
                        <span id="modal-stock-badge"></span>
                    </div>
                    <h4 class="font-bold text-stone-900 text-sm truncate" id="modal-product-name">Product Name</h4>
                    <p class="text-stone-500 text-xs font-mono" id="modal-subcat-text"></p>
                </div>
            </div>

            <!-- Key Financial & Stock Breakdown Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Total Units</span>
                    <span class="font-extrabold text-xl text-stone-900 font-mono block mt-0.5" id="modal-total-units">0</span>
                </div>
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Retail Price</span>
                    <span class="font-extrabold text-base text-stone-900 font-mono block mt-1" id="modal-retail-price">€0.00</span>
                </div>
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Sale Price</span>
                    <span class="font-extrabold text-base text-saltora-terracotta font-mono block mt-1" id="modal-sale-price">--</span>
                </div>
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Valuation</span>
                    <span class="font-extrabold text-base text-emerald-700 font-mono block mt-1" id="modal-valuation">€0.00</span>
                </div>
            </div>

            <!-- Finish Variants Breakdown -->
            <div class="space-y-2">
                <h5 class="font-bold text-stone-900 text-xs uppercase tracking-wider flex items-center justify-between">
                    <span>Finish Variations Stock Breakdown</span>
                    <span class="text-[0.65rem] text-stone-400 font-normal font-mono" id="modal-variants-count">0 finishes configured</span>
                </h5>
                <div class="rounded-xl border border-stone-200/80 overflow-hidden" id="modal-variants-wrap">
                    <!-- Variant rows injected via JS -->
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="px-6 py-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-between gap-3 shrink-0">
            <button 
                type="button" 
                onclick="closeInventoryDetailModal()" 
                class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition shadow-2xs"
            >
                Close
            </button>
            <div class="flex items-center gap-2">
                <a 
                    id="modal-store-link" 
                    href="#" 
                    target="_blank" 
                    class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition inline-flex items-center gap-1.5 shadow-2xs text-stone-700"
                >
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View in Store</span>
                </a>
                <a 
                    id="modal-edit-link" 
                    href="#" 
                    class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition inline-flex items-center gap-1.5 shadow-2xs"
                >
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Product</span>
                </a>
            </div>
        </div>

    </div>

</div>

<!-- Instant Live Search & Modal Scripts -->
<script>
    // 1. Live Autocomplete Search Suggestions Engine
    const inventorySuggestions = @json($allProductsForSuggestions ?? []);
    const searchInput = document.getElementById('inventorySearchInput');
    const suggestionsPanel = document.getElementById('inventorySuggestionsPanel');
    let activeSuggestionIndex = -1;

    if (searchInput && suggestionsPanel) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (query.length < 1) {
                suggestionsPanel.classList.add('hidden');
                suggestionsPanel.innerHTML = '';
                return;
            }

            const matches = inventorySuggestions.filter(p => {
                return (p.name && p.name.toLowerCase().includes(query)) ||
                       (p.sku && p.sku.toLowerCase().includes(query)) ||
                       (p.category && p.category.toLowerCase().includes(query));
            }).slice(0, 6);

            if (matches.length === 0) {
                suggestionsPanel.innerHTML = `
                    <div class="px-4 py-3 text-xs text-stone-400 italic text-center">
                        No inventory matching "<strong class="text-stone-600">${escapeHtml(query)}</strong>"
                    </div>
                `;
                suggestionsPanel.classList.remove('hidden');
                return;
            }

            let html = '';
            matches.forEach((p, idx) => {
                const stockBadge = p.stock > 5 
                    ? `<span class="text-[0.62rem] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">${p.stock} in stock</span>`
                    : (p.stock > 0 
                        ? `<span class="text-[0.62rem] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">${p.stock} low stock</span>`
                        : `<span class="text-[0.62rem] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">out of stock</span>`);

                html += `
                    <div 
                        onclick="selectInventorySuggestion('${escapeHtml(p.name)}')" 
                        class="suggestion-item px-4 py-2.5 flex items-center justify-between gap-3 hover:bg-stone-50 cursor-pointer transition ${idx === activeSuggestionIndex ? 'bg-stone-100' : ''}"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="h-8 w-8 rounded-lg overflow-hidden bg-stone-100 border border-stone-200/80 flex items-center justify-center shrink-0">
                                ${p.image_url ? `<img src="${p.image_url}" class="h-full w-full object-cover">` : `<span class="font-bold text-xs text-stone-400">${p.name.charAt(0)}</span>`}
                            </div>
                            <div class="min-w-0">
                                <span class="font-bold text-xs text-stone-900 truncate block">${highlightMatch(p.name, query)}</span>
                                <span class="text-[0.62rem] text-stone-400 font-mono">SKU: ${escapeHtml(p.sku || 'N/A')} • ${escapeHtml(p.category)}</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="font-extrabold text-xs text-stone-900 block">€${p.price.toFixed(2)}</span>
                            ${stockBadge}
                        </div>
                    </div>
                `;
            });

            suggestionsPanel.innerHTML = html;
            suggestionsPanel.classList.remove('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsPanel.contains(e.target)) {
                suggestionsPanel.classList.add('hidden');
            }
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const items = suggestionsPanel.querySelectorAll('.suggestion-item');
            if (items.length === 0 || suggestionsPanel.classList.contains('hidden')) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeSuggestionIndex = (activeSuggestionIndex + 1) % items.length;
                updateSuggestionHighlight(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeSuggestionIndex = (activeSuggestionIndex - 1 + items.length) % items.length;
                updateSuggestionHighlight(items);
            } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
                e.preventDefault();
                items[activeSuggestionIndex].click();
            }
        });
    }

    function updateSuggestionHighlight(items) {
        items.forEach((item, idx) => {
            if (idx === activeSuggestionIndex) {
                item.classList.add('bg-stone-100');
            } else {
                item.classList.remove('bg-stone-100');
            }
        });
    }

    function selectInventorySuggestion(name) {
        if (searchInput) {
            searchInput.value = name;
            suggestionsPanel.classList.add('hidden');
            document.getElementById('inventoryFilterForm').submit();
        }
    }

    function highlightMatch(text, query) {
        if (!text) return '';
        const index = text.toLowerCase().indexOf(query.toLowerCase());
        if (index === -1) return escapeHtml(text);
        return escapeHtml(text.substring(0, index)) + 
               '<mark class="bg-amber-100 text-stone-900 px-0.5 rounded">' + 
               escapeHtml(text.substring(index, index + query.length)) + 
               '</mark>' + 
               escapeHtml(text.substring(index + query.length));
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // 2. Quick View Executive Inventory Detail Modal
    function openInventoryDetailModal(data) {
        document.getElementById('modal-product-title').textContent = data.name || 'Product Dossier';
        document.getElementById('modal-product-sku').textContent = 'SKU: ' + (data.sku || 'N/A');
        document.getElementById('modal-product-name').textContent = data.name || '';
        document.getElementById('modal-cat-badge').textContent = data.category_name || 'Unassigned';
        document.getElementById('modal-subcat-text').textContent = data.subcategory_name ? '↳ ' + data.subcategory_name : '';
        document.getElementById('modal-total-units').textContent = data.stock;
        document.getElementById('modal-retail-price').textContent = '€' + (data.price ? data.price.toFixed(2) : '0.00');
        document.getElementById('modal-sale-price').textContent = data.sale_price ? '€' + data.sale_price.toFixed(2) : 'None';
        document.getElementById('modal-valuation').textContent = '€' + (data.valuation ? data.valuation.toFixed(2) : '0.00');

        // Stock badge
        const stockBadgeWrap = document.getElementById('modal-stock-badge');
        if (data.stock > 5) {
            stockBadgeWrap.innerHTML = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">● In Stock (${data.stock})</span>`;
        } else if (data.stock > 0) {
            stockBadgeWrap.innerHTML = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">● Low Stock (${data.stock})</span>`;
        } else {
            stockBadgeWrap.innerHTML = `<span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-rose-50 text-rose-700 border border-rose-200">● Out of Stock</span>`;
        }

        // Thumb
        const thumbWrap = document.getElementById('modal-thumb-wrap');
        if (data.image_url) {
            thumbWrap.innerHTML = `<img src="${data.image_url}" class="h-full w-full object-cover">`;
        } else {
            thumbWrap.innerHTML = `<span class="font-bold text-xl text-stone-400">${(data.name || 'P').charAt(0)}</span>`;
        }

        // Finish Variations Breakdown
        const variantsWrap = document.getElementById('modal-variants-wrap');
        const variantsCount = document.getElementById('modal-variants-count');
        if (data.variations && data.variations.length > 0) {
            variantsCount.textContent = data.variations.length + ' configured finishes';
            let varHtml = `
                <table class="w-full text-left text-xs divide-y divide-stone-100">
                    <thead class="bg-stone-50 font-bold text-stone-500 uppercase text-[0.65rem]">
                        <tr>
                            <th class="py-2 px-3">Finish / Variant</th>
                            <th class="py-2 px-3 text-center">Color Swatch</th>
                            <th class="py-2 px-3 text-right">Finish Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
            `;
            data.variations.forEach(v => {
                varHtml += `
                    <tr class="hover:bg-stone-50/60">
                        <td class="py-2 px-3 font-bold text-stone-900">${escapeHtml(v.name || 'Finish')}</td>
                        <td class="py-2 px-3 text-center">
                            <span class="inline-block h-3.5 w-3.5 rounded-full shadow-2xs border border-stone-200" style="background-color: ${v.color || '#1c1210'}"></span>
                        </td>
                        <td class="py-2 px-3 text-right font-mono font-bold ${parseInt(v.stock) > 0 ? 'text-stone-900' : 'text-rose-600'}">
                            ${v.stock ?? 'N/A'} units
                        </td>
                    </tr>
                `;
            });
            varHtml += `</tbody></table>`;
            variantsWrap.innerHTML = varHtml;
        } else {
            variantsCount.textContent = 'Standard single configuration';
            variantsWrap.innerHTML = `
                <div class="p-3 text-center text-xs text-stone-400 italic bg-stone-50/50">
                    No individual finish variants configured. Global product stock is ${data.stock} units.
                </div>
            `;
        }

        // Links
        document.getElementById('modal-store-link').href = data.store_url || '#';
        document.getElementById('modal-edit-link').href = data.edit_url || '#';

        // Display modal
        document.getElementById('inventory-detail-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeInventoryDetailModal() {
        document.getElementById('inventory-detail-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // 3. Inline Stock Adjuster Engine (AJAX)
    function adjustInlineStock(productId, delta) {
        const input = document.getElementById('stock-input-' + productId);
        if (!input) return;
        let current = parseInt(input.value) || 0;
        let updated = Math.max(0, current + delta);
        input.value = updated;
    }

    async function saveInlineStock(productId) {
        const input = document.getElementById('stock-input-' + productId);
        const saveBtn = document.getElementById('save-btn-' + productId);
        if (!input || !saveBtn) return;

        const val = parseInt(input.value);
        if (isNaN(val) || val < 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Number',
                text: 'Please enter a valid stock quantity (0 or greater).'
            });
            return;
        }

        const originalBtnHtml = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<svg class="h-3 w-3 animate-spin text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke-width="4" stroke="currentColor" stroke-dasharray="32" stroke-linecap="round"></circle></svg>';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                || '{{ csrf_token() }}';

            const res = await fetch("{{ route('admin.inventory.update-stock') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    stock: val
                })
            });

            const data = await res.json();

            if (data.success) {
                // Update badge cell dynamically
                const badgeCell = document.getElementById('stock-badge-cell-' + productId);
                if (badgeCell) {
                    if (val > 5) {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                <span>${val} in stock</span>
                            </span>
                        `;
                    } else if (val > 0) {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                <span>${val} Low stock</span>
                            </span>
                        `;
                    } else {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 shadow-2xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                <span>Out of stock</span>
                            </span>
                        `;
                    }
                }

                // Show quick success indicator
                saveBtn.classList.remove('bg-stone-900');
                saveBtn.classList.add('bg-emerald-600');
                saveBtn.innerHTML = '<svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>';
                
                setTimeout(() => {
                    saveBtn.classList.remove('bg-emerald-600');
                    saveBtn.classList.add('bg-stone-900');
                    saveBtn.innerHTML = '<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> <span>Save</span>';
                    saveBtn.disabled = false;
                }, 1200);

                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({
                        icon: 'success',
                        title: 'Stock Updated: ' + val + ' units'
                    });
                }
            } else {
                throw new Error(data.message || 'Failed to update stock');
            }
        } catch (err) {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalBtnHtml;
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                text: err.message || 'Could not update stock.'
            });
        }
    }
</script>
@endsection
