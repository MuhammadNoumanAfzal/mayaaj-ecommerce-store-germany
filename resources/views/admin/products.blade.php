@extends('layouts.admin')
@section('title', 'Product Catalog & Inventory - MEHAAJ Atelier Admin')

@section('admin-styles')
<style>
    /* Full Page Modal Blur & Hide Scrollbars Across All Browsers */
    .modal-scroll-clean {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    .modal-scroll-clean::-webkit-scrollbar,
    #view-product-modal .modal-scroll-clean::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

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
@endsection

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Colorful Executive KPI Metric Cards (Matching Categories & Subcategories, Clickable with Cursor Pointer) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        
        <!-- 1. Total Products -->
        <a href="{{ route('admin.products') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fcf9f5] to-[#f7ece0] rounded-2xl border border-[#ebdccb] p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="View all products">
            <span class="text-[0.68rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Gesamte Produkte" data-i18n-en="Total Products">Total Products</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-[#1c1210] tracking-tight leading-none group-hover:text-[#78000b] transition-colors">{{ $totalCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-5 h-5 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.products', ['status' => 'active']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f2faf5] to-[#e4f7ec] rounded-2xl border border-emerald-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Filter by Active">
            <span class="text-[0.68rem] font-bold text-emerald-800 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-emerald-950 tracking-tight leading-none group-hover:text-emerald-700 transition-colors">{{ $activeCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #059669 0%, #064e3b 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </a>

        <!-- 3. Draft / Inactive -->
        <a href="{{ route('admin.products', ['status' => 'draft']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fdf9f2] to-[#f9edd9] rounded-2xl border border-amber-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Filter by Draft">
            <span class="text-[0.68rem] font-bold text-amber-800 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-amber-950 tracking-tight leading-none group-hover:text-amber-700 transition-colors">{{ $draftCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #d97706 0%, #78350f 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </div>
            </div>
        </a>

        <!-- 4. Low Stock (≤5) -->
        <a href="{{ route('admin.products', ['stock' => 'low']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fff5f5] to-[#fde8e8] rounded-2xl border border-rose-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Filter by Low Stock">
            <span class="text-[0.68rem] font-bold text-rose-800 uppercase tracking-wider block" data-i18n-de="Niedriger Bestand" data-i18n-en="Low Stock (≤5)">Low Stock (≤5)</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-rose-950 tracking-tight leading-none group-hover:text-rose-700 transition-colors">{{ $lowStockCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #e11d48 0%, #881337 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
        </a>

    </div>

    <!-- Main Products Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-xs relative overflow-hidden border-t-4 border-t-[#78000b]">
        
        <!-- Header with Action Button (Clean Luxury Layout matching Categories) -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Produkte Übersicht" data-i18n-en="Products Directory">
                        Products Directory
                    </h2>
                </div>
            </div>
            
            <a href="{{ route('admin.products.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0 active:scale-95">
                <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Neues Produkt" data-i18n-en="Add Product">Add Product</span>
            </a>
        </div>

        <!-- Filter, Sort & Search Toolbar Form (Single-Line Clean Layout matching Subcategories) -->
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-[#faf7f2] via-[#f5ede2] to-[#faf7f2] border-b border-[#ebdccb] relative z-30">
            <form action="{{ route('admin.products') }}" method="GET" id="productsFilterForm" class="flex flex-wrap lg:flex-nowrap items-center gap-2 text-xs font-semibold text-stone-700 w-full">
                
                <!-- Left: Search Box with Live Auto-Suggestions -->
                <div class="relative flex-1 min-w-[200px]">
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
                            class="h-10 w-full pl-9 pr-8 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs placeholder:text-stone-400 placeholder:font-normal transition"
                        >
                        <!-- Search Icon -->
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">
                            <svg class="h-4 w-4 text-[#8a7267]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        
                        <!-- Clear Search Button -->
                        <button 
                            type="button" 
                            id="productSearchClearBtn" 
                            onclick="clearProductSearch()" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 h-5 w-5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-400 hover:text-stone-700 transition flex items-center justify-center text-[0.65rem] cursor-pointer {{ request('search') ? '' : 'hidden' }}"
                            title="Clear search"
                        >✕</button>
                    </div>

                    <!-- Live Floating Suggestions Dropdown -->
                    <div 
                        id="productSuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white rounded-2xl border border-[#ebdccb] shadow-2xl overflow-hidden"
                    >
                        <div class="px-4 py-2 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-[#ebdccb] flex items-center justify-between text-[0.68rem] font-bold text-stone-400 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 text-stone-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                                <span>Suggested Products</span>
                            </span>
                            <span id="prod-suggestions-count-badge" class="font-mono text-stone-500 font-bold"></span>
                        </div>
                        <div id="productSuggestionsList" class="max-h-72 overflow-y-auto divide-y divide-stone-100">
                            <!-- Populated via JavaScript -->
                        </div>
                        <div class="px-4 py-2 bg-[#FAF7F2] border-t border-[#ebdccb] flex items-center justify-between text-[0.68rem] text-stone-500">
                            <span>Click suggestion or press <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">↵ Enter</kbd> to search</span>
                            <span><kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">Esc</kbd></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Sleek, Unified Filter Pills with Leading Icons (In Same Line) -->
                <div class="flex flex-wrap items-center gap-2">
                    
                    <!-- Category Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        <select 
                            name="category_id" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Category: All</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    Category: {{ $cat->name }} ({{ $cat->products_count }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Status: All ({{ $totalCount }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Status: Active ({{ $activeCount }})</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Status: Draft ({{ $draftCount }})</option>
                            <option value="out_of_stock" {{ request('status') === 'out_of_stock' ? 'selected' : '' }}>Status: Out of Stock</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        <select 
                            name="sort" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
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
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Per Page Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        <select 
                            name="per_page" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 / page</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / page</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'category_id', 'subcategory_id', 'status', 'stock', 'sort']))
                        <a href="{{ route('admin.products') }}" class="h-10 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-[#ebdccb] hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5 cursor-pointer" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container (Clean, Modern, Fully Responsive) -->
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-3 font-black" data-i18n-de="Produkt" data-i18n-en="Product">Product</th>
                        <th class="py-3 px-2 font-black text-center w-36" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-3 px-2 font-black text-center w-28" data-i18n-de="Preis" data-i18n-en="Price">Price</th>
                        <th class="py-3 px-2 font-black text-center w-28" data-i18n-de="Lagerbestand" data-i18n-en="Stock">Stock</th>
                        <th class="py-3 px-2 font-black text-center w-24" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-3 font-black text-center w-40" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($products as $product)
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
                                'category_name' => $product->category ? $product->category->name : 'Unassigned',
                                'subcategory_name' => $product->subcategory ? $product->subcategory->name : null,
                                'image_url' => $product->image ? asset('storage/' . $product->image) : null,
                                'gallery_urls' => $galleryUrls,
                                'variations' => is_array($product->variations) ? $product->variations : [],
                                'accordion_tabs' => is_array($product->accordion_tabs) ? $product->accordion_tabs : [],
                                'description' => $product->description ?? '',
                                'craftsmanship' => $product->craftsmanship ?? '',
                                'fulfillment_mode' => $product->fulfillment_mode ?? 'ready_to_ship',
                                'lead_time_days' => $product->lead_time_days ?? null,
                                'delivery_days' => $product->delivery_days ?? null,
                                'allow_engraving' => (bool)($product->allow_engraving ?? false),
                                'engraving_surcharge' => (float)($product->engraving_surcharge ?? 0),
                                'store_url' => route('products.detail', $product->slug),
                                'edit_url' => route('admin.products.edit', $product->id),
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="product-row-{{ $product->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($products->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Product Thumbnail + Title + SKU (Clickable with Cursor Pointer) -->
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-3 cursor-pointer group" onclick='openViewProductModal(@json($productModalData))' title="Click to view product details">
                                    <div class="h-10 w-10 rounded-xl overflow-hidden bg-[#F8F5EF] border border-[#ebdccb] shadow-2xs flex items-center justify-center shrink-0 relative transition-transform duration-200 group-hover:scale-105 group-hover:border-[#78000b]">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                            <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-[#FAF7F2]">
                                                <span class="font-serif font-bold text-[#78000b] text-sm">{{ mb_substr($product->name, 0, 1) }}</span>
                                            </div>
                                        @else
                                            <div class="text-[#78000b] flex items-center justify-center w-full h-full bg-[#FAF7F2] font-serif font-bold text-base">
                                                {{ mb_substr($product->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <span class="font-bold text-[#1c1210] text-sm tracking-tight truncate block group-hover:text-[#78000b] transition-colors cursor-pointer">
                                            {{ $product->name }}
                                        </span>
                                        <span class="text-[0.65rem] text-stone-500 font-mono tracking-tight block">
                                            SKU: {{ $product->sku ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- 3. Category & Subcategory -->
                            <td class="py-3 px-2 text-center">
                                <div class="inline-flex flex-col items-center gap-0.5">
                                    @if($product->category)
                                        <a href="{{ route('admin.products', ['category_id' => $product->category->id]) }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg text-xs font-bold bg-[#FAF7F2] text-[#78000b] border border-[#ebdccb] hover:bg-[#78000b] hover:text-white transition-all shadow-2xs cursor-pointer" title="Filter by {{ $product->category->name }}">
                                            <span>{{ $product->category->name }}</span>
                                        </a>
                                    @else
                                        <span class="text-stone-400 text-xs italic">Unassigned</span>
                                    @endif

                                    @if($product->subcategory)
                                        <span class="text-[0.62rem] text-stone-500 font-medium truncate max-w-[120px] block" title="{{ $product->subcategory->name }}">
                                            › {{ $product->subcategory->name }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- 4. Price & Luxury Sale Price -->
                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                <div class="inline-flex flex-col items-center">
                                    <span class="font-extrabold text-sm text-[#1c1210]">
                                        €{{ number_format($product->price, 2) }}
                                    </span>
                                    @if($product->sale_price)
                                        <div class="flex items-center gap-1 mt-0.5">
                                            <span class="text-[0.65rem] font-bold text-[#78000b]">
                                                €{{ number_format($product->sale_price, 2) }}
                                            </span>
                                            <span class="text-[0.55rem] font-black uppercase px-1 py-0.2 bg-[#78000b]/10 text-[#78000b] rounded">Sale</span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- 5. Stock Level Badge -->
                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-300 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span>{{ $product->stock }} <span data-i18n-de="auf Lager" data-i18n-en="in stock">in stock</span></span>
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span>{{ $product->stock }} <span data-i18n-de="Gering" data-i18n-en="Low stock">Low stock</span></span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-800 border border-rose-300 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        <span data-i18n-de="Ausverkauft" data-i18n-en="Out of stock">Out of stock</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 6. Status Toggle Badge (Clickable with Pointer) -->
                            <td class="py-3 px-2 text-center">
                                <button 
                                    type="button" 
                                    onclick="toggleProductStatus({{ $product->id }}, this)" 
                                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 {{ $product->status === 'active' ? 'bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100' : 'bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100' }}"
                                    title="Click to toggle status (Active / Draft)"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $product->status === 'active' ? 'bg-emerald-600 animate-pulse' : 'bg-amber-500' }}"></span>
                                    <span>{{ $product->status === 'active' ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- 7. Actions (View, Edit, Delete with Cursors) - Sleek, Compact -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <!-- Quick View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewProductModal(@json($productModalData))'
                                        class="h-7 px-2.5 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="View Details"
                                    >
                                        <svg class="h-3 w-3 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="h-7 px-2 rounded-lg border border-blue-200 bg-blue-50/70 text-blue-700 hover:bg-blue-600 hover:text-white hover:border-blue-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Edit Product"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="h-7 px-2 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Delete Product"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Delete</span>
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
                            <td colspan="7" class="py-16 px-6 text-center text-stone-500 text-xs">
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

        <!-- Proper Production Pagination Footer (Matching Categories & Subcategories) -->
        <div class="p-4 sm:p-5 bg-gradient-to-r from-[#faf7f2] via-[#f7eee3] to-[#faf7f2] border-t border-[#ebdccb] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-600">
            <div>
                @if($products->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span> 
                    <strong class="text-stone-900 font-mono">{{ $products->firstItem() }}</strong> 
                    <span data-i18n-de="bis" data-i18n-en="to">to</span> 
                    <strong class="text-stone-900 font-mono">{{ $products->lastItem() }}</strong> 
                    <span data-i18n-de="von" data-i18n-en="of">of</span> 
                    <strong class="text-stone-900 font-mono">{{ $products->total() }}</strong> 
                    <span data-i18n-de="Produkte" data-i18n-en="products">products</span>
                @else
                    <span data-i18n-de="0 Produkte gelistet" data-i18n-en="0 products listed">0 products listed</span>
                @endif
            </div>

            <div>
                {{ $products->links() }}
            </div>
        </div>

    </div>

</div>

<!-- Product Quick View Executive Modal (100% Full Page Blur, Wide Luxury Card, Teleported to Body, Cursor Pointers) -->
<div 
    id="view-product-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.72) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important;" 
    onclick="closeViewProductModal()"
>
    <div 
        class="relative w-full max-w-2xl bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden my-auto transform transition-all" 
        onclick="event.stopPropagation()"
    >
        <!-- Luxury Gold & Wine Top Accent Strip -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Modal Header (Compact) -->
        <div class="px-5 py-3 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 shadow-xs" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div>
                    <h3 class="font-serif text-base font-bold text-[#1c1210] tracking-tight leading-tight">Product Details</h3>
                    <p class="text-[0.65rem] text-stone-500 font-mono" id="prod-view-sku">SKU: ---</p>
                </div>
            </div>
            <button type="button" onclick="closeViewProductModal()" class="w-7 h-7 rounded-lg bg-white hover:bg-stone-100 text-stone-500 hover:text-stone-900 border border-[#ebdccb] transition flex items-center justify-center cursor-pointer text-xs font-bold shadow-2xs active:scale-95" title="Close">
                ✕
            </button>
        </div>

        <!-- Modal Body Content (Compact Height, Hidden Scrollbar) -->
        <div class="p-4 sm:p-5 space-y-3 text-xs max-h-[72vh] overflow-y-auto modal-scroll-clean" style="scrollbar-width: none !important; -ms-overflow-style: none !important;">
            
            <!-- Hero Product Banner: Image + Key Details -->
            <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-gradient-to-r from-[#FAF8F5] via-white to-[#FAF8F5] border border-[#ebdccb]">
                <!-- Main Product Image -->
                <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#FAF7F2] border border-[#ebdccb] shadow-xs shrink-0 flex items-center justify-center">
                    <img id="prod-view-img" src="" alt="Product Image" class="w-full h-full object-cover hidden">
                    <div id="prod-view-no-img" class="text-[#78000b] flex items-center justify-center w-full h-full font-serif font-bold text-xl">
                        <span id="prod-view-letter">P</span>
                    </div>
                </div>

                <div class="space-y-1 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="prod-view-name" class="font-serif font-bold text-lg text-[#1c1210] tracking-tight leading-snug"></h4>
                        <span id="prod-view-status-badge"></span>
                        <span id="prod-view-featured-badge" class="hidden inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-2xs">
                            ★ Featured
                        </span>
                    </div>

                    <!-- Category & Subcategory -->
                    <div class="flex items-center gap-2 text-[0.68rem] text-stone-500 font-medium">
                        <span class="inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            Category: <strong id="prod-view-category" class="text-[#78000b]"></strong>
                        </span>
                        <span id="prod-view-subcat-wrapper" class="hidden inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            Subcat: <strong id="prod-view-subcat" class="text-stone-900"></strong>
                        </span>
                        <span class="inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            ID: <strong id="prod-view-id" class="text-stone-900">#0</strong>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Gallery Thumbnails (if any) -->
            <div id="prod-view-gallery-section" class="hidden space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]" data-i18n-de="Bildergalerie" data-i18n-en="Gallery Photos">Gallery Photos</span>
                <div id="prod-view-gallery" class="flex items-center gap-2 overflow-x-auto pb-1 p-2 rounded-xl bg-[#FAF8F5] border border-[#ebdccb]">
                </div>
            </div>

            <!-- Pricing & Financial Metrics Grid (4-Tile Strip matching Categories) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-[#FAF8F5] to-[#F5ECE1] border border-[#ebdccb]">
                    <span class="text-[0.62rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Regulärer Preis" data-i18n-en="Regular Price">Regular Price</span>
                    <span id="prod-view-regular-price" class="font-extrabold text-sm text-[#1c1210] mt-0.5 block">€0.00</span>
                </div>

                <div class="p-2.5 rounded-xl bg-gradient-to-br from-[#fff5f5] to-[#fde8e8] border border-rose-200/90">
                    <span class="text-[0.62rem] font-bold text-rose-800 uppercase tracking-wider block" data-i18n-de="Angebotspreis" data-i18n-en="Sale Price">Sale Price</span>
                    <span id="prod-view-sale-price" class="font-extrabold text-sm text-[#78000b] mt-0.5 block">N/A</span>
                </div>

                <div class="p-2.5 rounded-xl bg-gradient-to-br from-[#FAF8F5] to-[#F5ECE1] border border-[#ebdccb]">
                    <span class="text-[0.62rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Einkaufspreis" data-i18n-en="Cost Price">Cost Price</span>
                    <span id="prod-view-cost-price" class="font-extrabold text-sm text-stone-700 mt-0.5 block">€0.00</span>
                </div>

                <div class="p-2.5 rounded-xl bg-gradient-to-br from-[#f2faf5] to-[#e4f7ec] border border-emerald-200/90">
                    <span class="text-[0.62rem] font-bold text-emerald-800 uppercase tracking-wider block" data-i18n-de="Marge / Gewinn" data-i18n-en="Gross Margin">Gross Margin</span>
                    <span id="prod-view-margin" class="font-extrabold text-sm text-emerald-900 mt-0.5 block">0%</span>
                </div>
            </div>

            <!-- Inventory Stock Indicator -->
            <div class="p-3 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-[#8a7267] font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Lagerbestand:" data-i18n-en="Inventory Stock:">Inventory Stock:</span>
                    <span id="prod-view-stock-count" class="font-extrabold text-sm text-[#1c1210]">0 units</span>
                </div>
                <div id="prod-view-stock-badge"></div>
            </div>

            <!-- Bespoke Commission & Lead Time (if any) -->
            <div id="prod-view-bespoke-section" class="hidden p-3 rounded-xl bg-gradient-to-br from-[#FAF8F5] to-[#F9EFE4] border border-[#ebdccb] space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-xs text-[#78000b] uppercase tracking-wider" id="prod-view-fulfillment">Made to Order Commission</span>
                    <span id="prod-view-engraving-badge" class="hidden px-2 py-0.5 rounded-md text-[0.65rem] font-bold bg-[#78000b] text-[#d8b45a]">Bespoke Engraving Available</span>
                </div>
                <div class="flex items-center gap-4 text-[0.68rem] text-stone-600 font-medium">
                    <span id="prod-view-lead-time">Lead Time: 5-7 days</span>
                    <span id="prod-view-delivery-days">Delivery: 2-4 days</span>
                </div>
            </div>

            <!-- Variations Finishes (if any) -->
            <div id="prod-view-variations-section" class="hidden space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]" data-i18n-de="Produktvariationen / Ausführungen" data-i18n-en="Product Variations / Finishes">Product Variations / Finishes</span>
                <div id="prod-view-variations" class="flex flex-wrap gap-1.5 p-2.5 rounded-xl bg-[#FAF8F5] border border-[#ebdccb]">
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Product Description</span>
                <div id="prod-view-desc" class="p-2.5 sm:p-3 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] text-stone-700 leading-relaxed text-xs whitespace-pre-line"></div>
            </div>

            <!-- Craftsmanship -->
            <div id="prod-view-craftsmanship-section" class="space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]" data-i18n-de="Handwerk & Material" data-i18n-en="Craftsmanship & Atelier Notes">Craftsmanship & Atelier Notes</span>
                <div id="prod-view-craftsmanship" class="p-2.5 sm:p-3 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] text-stone-700 leading-relaxed text-xs whitespace-pre-line"></div>
            </div>

            <!-- Accordion Tabs (if any) -->
            <div id="prod-view-tabs-section" class="hidden space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]" data-i18n-de="Spezifikationen & Reitertabs" data-i18n-en="Specification Tabs">Specification Tabs</span>
                <div id="prod-view-tabs" class="space-y-1.5">
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions (Compact) -->
        <div class="px-5 py-2.5 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-t border-[#ebdccb] flex items-center justify-between gap-3">
            <a id="prod-view-store-btn" href="#" target="_blank" class="text-xs font-bold text-[#78000b] hover:underline inline-flex items-center gap-1 transition cursor-pointer">
                <span>View in Live Store</span>
                <span>↗</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewProductModal()" class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition cursor-pointer shadow-2xs active:scale-95">
                    Close
                </button>
                <a id="prod-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-3.5 py-1.5 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-md active:scale-95">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Product</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    // Ensure modal is attached directly to document.body so full screen blur is 100% complete
    function ensureModalTeleported(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        ensureModalTeleported('view-product-modal');
    });

    // Dataset for instant autocomplete search suggestions
    const ALL_PRODUCTS = @json($allProductsForSuggestions ?? []);

    const prodSearchInput = document.getElementById('productSearchInput');
    const suggestionsPanel = document.getElementById('productSuggestionsPanel');
    const suggestionsList = document.getElementById('productSuggestionsList');
    const suggestionsCountBadge = document.getElementById('prod-suggestions-count-badge');
    const clearBtn = document.getElementById('productSearchClearBtn');
    const filterForm = document.getElementById('productsFilterForm');
    let selectedSuggestionIndex = -1;

    function clearProductSearch() {
        if (prodSearchInput) {
            prodSearchInput.value = '';
            if (clearBtn) clearBtn.classList.add('hidden');
            if (suggestionsPanel) suggestionsPanel.classList.add('hidden');
            if (filterForm) filterForm.submit();
        }
    }

    if (prodSearchInput && suggestionsPanel && suggestionsList) {
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function highlightMatch(text, query) {
            if (!query) return escapeHtml(text);
            const escapedText = escapeHtml(text);
            const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
            return escapedText.replace(regex, '<span class="bg-[#ebdccb] text-[#78000b] font-black px-0.5 rounded">$1</span>');
        }

        function renderSuggestions(query) {
            const trimmed = query.trim().toLowerCase();
            selectedSuggestionIndex = -1;

            if (clearBtn) {
                if (trimmed) clearBtn.classList.remove('hidden');
                else clearBtn.classList.add('hidden');
            }

            if (!trimmed) {
                suggestionsPanel.classList.add('hidden');
                suggestionsList.innerHTML = '';
                return;
            }

            const matches = ALL_PRODUCTS.filter(p => {
                return (p.name && p.name.toLowerCase().includes(trimmed)) ||
                       (p.sku && p.sku.toLowerCase().includes(trimmed)) ||
                       (p.slug && p.slug.toLowerCase().includes(trimmed)) ||
                       (p.category_name && p.category_name.toLowerCase().includes(trimmed));
            }).slice(0, 6);

            if (matches.length === 0) {
                if (suggestionsCountBadge) suggestionsCountBadge.textContent = '0';
                suggestionsList.innerHTML = `
                    <div class="px-4 py-4 text-xs text-stone-400 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <span>No product matches found for "<strong>${escapeHtml(query)}</strong>"</span>
                    </div>
                `;
                suggestionsPanel.classList.remove('hidden');
                return;
            }

            if (suggestionsCountBadge) suggestionsCountBadge.textContent = matches.length;

            let html = '';
            matches.forEach((p, idx) => {
                const imgHtml = p.image_url 
                    ? `<img src="${p.image_url}" class="h-full w-full object-cover">`
                    : `<span class="font-serif font-bold text-xs text-[#78000b]">${escapeHtml(p.name.charAt(0))}</span>`;
                
                const statusBadge = p.status === 'active'
                    ? `<span class="text-[0.6rem] font-bold text-emerald-800 bg-emerald-50 border border-emerald-300 px-1.5 py-0.5 rounded-full">ACTIVE</span>`
                    : `<span class="text-[0.6rem] font-bold text-amber-800 bg-amber-50 border border-amber-300 px-1.5 py-0.5 rounded-full">DRAFT</span>`;

                const priceDisplay = p.sale_price 
                    ? `<span class="text-[#78000b] font-extrabold">€${p.sale_price.toFixed(2)}</span>`
                    : `<span class="font-extrabold text-[#1c1210]">€${p.price.toFixed(2)}</span>`;

                html += `
                    <div 
                        class="suggestion-item px-3.5 py-2.5 hover:bg-[#FAF7F2] cursor-pointer flex items-center justify-between gap-3 transition" 
                        data-index="${idx}"
                        data-name="${escapeHtml(p.name)}"
                        data-id="${p.id}"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="h-8 w-8 rounded-lg overflow-hidden bg-[#FAF7F2] border border-[#ebdccb] flex items-center justify-center shrink-0">
                                ${imgHtml}
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-bold text-[#1c1210] truncate">
                                    ${highlightMatch(p.name, trimmed)}
                                </div>
                                <div class="text-[0.65rem] text-stone-500 font-medium truncate flex items-center gap-1.5">
                                    <span class="text-[#78000b] font-semibold">${escapeHtml(p.category_name)}</span>
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

            suggestionsList.innerHTML = html;
            suggestionsPanel.classList.remove('hidden');

            suggestionsList.querySelectorAll('.suggestion-item').forEach(item => {
                item.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    prodSearchInput.value = name;
                    suggestionsPanel.classList.add('hidden');
                    filterForm.submit();
                });
            });
        }

        let debounceTimer;
        prodSearchInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                renderSuggestions(e.target.value);
            }, 120);
        });

        prodSearchInput.addEventListener('keydown', function(e) {
            const items = suggestionsList.querySelectorAll('.suggestion-item');
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
                    prodSearchInput.value = name;
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
                    item.classList.add('bg-[#FAF7F2]', 'ring-1', 'ring-[#78000b]/30');
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.classList.remove('bg-[#FAF7F2]', 'ring-1', 'ring-[#78000b]/30');
                }
            });
        }

        document.addEventListener('click', function(e) {
            if (!prodSearchInput.contains(e.target) && !suggestionsPanel.contains(e.target)) {
                suggestionsPanel.classList.add('hidden');
            }
        });
    }

    // Modal Handling with ensureModalTeleported
    function openViewProductModal(data) {
        ensureModalTeleported('view-product-modal');
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('prod-view-name').textContent = data.name;
        document.getElementById('prod-view-sku').textContent = 'SKU: ' + (data.sku || 'N/A');
        document.getElementById('prod-view-category').textContent = data.category_name || 'Unassigned';
        document.getElementById('prod-view-id').textContent = '#' + data.id;
        
        // Subcategory
        const subcatWrap = document.getElementById('prod-view-subcat-wrapper');
        const subcatEl = document.getElementById('prod-view-subcat');
        if (data.subcategory_name) {
            subcatEl.textContent = data.subcategory_name;
            subcatWrap.classList.remove('hidden');
        } else {
            subcatEl.textContent = '';
            subcatWrap.classList.add('hidden');
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
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-300';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'ACTIVE' : 'AKTIV'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-300';
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
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-300"><span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>${isEn ? 'In Stock' : 'Auf Lager'}</span>`;
        } else if (data.stock > 0) {
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-800 border border-amber-300"><span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>${isEn ? 'Low Stock' : 'Geringer Bestand'}</span>`;
        } else {
            stockBadgeEl.innerHTML = `<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-rose-50 text-rose-800 border border-rose-300"><span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>${isEn ? 'Out of Stock' : 'Ausverkauft'}</span>`;
        }

        // Bespoke Section
        const bespokeSec = document.getElementById('prod-view-bespoke-section');
        const fulfillEl = document.getElementById('prod-view-fulfillment');
        const engravBadge = document.getElementById('prod-view-engraving-badge');
        const leadEl = document.getElementById('prod-view-lead-time');
        const delivEl = document.getElementById('prod-view-delivery-days');
        
        if (data.fulfillment_mode === 'made_to_order' || data.allow_engraving || data.lead_time_days || data.delivery_days) {
            bespokeSec.classList.remove('hidden');
            fulfillEl.textContent = data.fulfillment_mode === 'made_to_order' ? 'Bespoke Made to Order' : 'In-Stock Ready to Ship';
            if (data.allow_engraving) {
                engravBadge.classList.remove('hidden');
                engravBadge.textContent = 'Bespoke Personalization' + (data.engraving_surcharge > 0 ? ` (+€${data.engraving_surcharge.toFixed(2)})` : '');
            } else {
                engravBadge.classList.add('hidden');
            }
            leadEl.textContent = data.lead_time_days ? `Crafting Lead Time: ${data.lead_time_days} days` : '';
            delivEl.textContent = data.delivery_days ? `Estimated Delivery: ${data.delivery_days} days` : '';
        } else {
            bespokeSec.classList.add('hidden');
        }

        // Gallery Photos
        const gallerySec = document.getElementById('prod-view-gallery-section');
        const galleryContainer = document.getElementById('prod-view-gallery');
        galleryContainer.innerHTML = '';
        if (data.gallery_urls && data.gallery_urls.length > 0) {
            data.gallery_urls.forEach(url => {
                const imgThumb = document.createElement('img');
                imgThumb.src = url;
                imgThumb.className = 'w-12 h-12 rounded-lg object-cover border border-[#ebdccb] hover:scale-105 transition cursor-pointer shadow-2xs';
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
                pill.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-white border border-[#ebdccb] text-stone-700 shadow-2xs';
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
                tabDiv.className = 'p-2.5 rounded-lg bg-[#FAF8F5] border border-[#ebdccb]';
                tabDiv.innerHTML = `<h5 class="font-bold text-[#1c1210] text-[0.72rem]">${escapeHtml(tab.title || tab.name || 'Tab')}</h5><p class="text-stone-600 text-[0.68rem] mt-0.5">${escapeHtml(tab.content || '')}</p>`;
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
        const modal = document.getElementById('view-product-modal');
        if (modal) modal.classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewProductModal();
        }
    });

    // Toggle Product Status via AJAX
    function toggleProductStatus(productId, buttonElement) {
        const originalHtml = buttonElement.innerHTML;
        buttonElement.disabled = true;
        buttonElement.style.opacity = '0.6';

        fetch(`/admin/products/${productId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            buttonElement.disabled = false;
            buttonElement.style.opacity = '1';

            if (data.success) {
                if (data.status === 'active') {
                    buttonElement.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100';
                    buttonElement.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>Active</span>';
                } else {
                    buttonElement.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100';
                    buttonElement.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>Draft</span>';
                }

                if (window.LuxuryToast) {
                    LuxuryToast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            } else {
                buttonElement.innerHTML = originalHtml;
                if (window.LuxuryToast) {
                    LuxuryToast.fire({
                        icon: 'error',
                        title: data.message || 'Status update failed.'
                    });
                }
            }
        })
        .catch(err => {
            buttonElement.disabled = false;
            buttonElement.style.opacity = '1';
            buttonElement.innerHTML = originalHtml;
            if (window.LuxuryToast) {
                LuxuryToast.fire({
                    icon: 'error',
                    title: 'Server connection error.'
                });
            }
        });
    }

    // Delete confirmation with SweetAlert2
    function confirmDeleteProduct(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        if (window.LuxurySwal) {
            LuxurySwal.fire({
                title: isEn ? 'Delete Product?' : 'Produkt löschen?',
                text: isEn 
                    ? `Are you sure you want to permanently delete "${name}" from your catalog?` 
                    : `Möchten Sie "${name}" wirklich unwiderruflich aus dem Katalog löschen?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-product-form-' + id).submit();
                }
            });
        } else {
            if (confirm(`Are you sure you want to delete ${name}?`)) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        }
    }
</script>
@endsection
