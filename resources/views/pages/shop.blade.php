@extends('layouts.app')
@section('title', 'Kollektion & Shop | MEHAAJ® Official Luxury Atelier')
@section('meta_description', 'Entdecken Sie die vollständige MEHAAJ Meisterkollektion: Handgefertigte Luxus-Ledertaschen, italienisches Vollleder, Schweizer Chronographen und exklusive Accessoires.')
@section('canonical', route('shop'))

@section('content')
@php
    $categoriesList = $shopCategories ?? $globalCategories ?? collect();
    $activeCategorySlugs = (array) request('category', []);
    $activeSubcategorySlugs = (array) request('subcategory', []);
    $currentMinPrice = request('min_price', $dbMinPrice ?? 0);
    $currentMaxPrice = request('max_price', $dbMaxPrice ?? 1000);
    $hasActiveFilters = request('category') || request('subcategory') || request('search') || request('min_price') || (request('max_price') && request('max_price') < $dbMaxPrice) || request('featured') || request('in_stock');
@endphp

<div class="bg-[#f8f5ef] min-h-screen text-[#1c1210]">

    <!-- Clean Breadcrumb & Top Bar -->
    <div class="border-b border-[#dfd6c4] bg-[#f4efe5] py-2 text-xs">
        <div class="w-full max-w-[1600px] mx-auto px-4 sm:px-6 flex items-center justify-between gap-4">
            <nav class="flex items-center gap-2 text-[0.7rem] text-[#6b5f56] truncate">
                <a href="{{ route('home') }}" class="hover:text-[#78000b] transition">Home</a>
                <span class="text-[#c7baa7]">/</span>
                <span class="text-[#1c1210] font-semibold">Shop & Collection</span>
                @if(request('category'))
                    <span class="text-[#c7baa7]">/</span>
                    <span class="text-[#78000b] font-medium capitalize">{{ is_array(request('category')) ? implode(', ', request('category')) : request('category') }}</span>
                @endif
            </nav>

            <span class="text-[0.68rem] text-[#8a7c74] hidden sm:inline">
                <strong>{{ $products->total() }}</strong> <span data-i18n-en="Bespoke Creations" data-i18n-de="Meisterwerke">Bespoke Creations</span>
            </span>
        </div>
    </div>

    <!-- Category Pills Strip (Horizontal Scroll with Clean Indicators) -->
    <div class="border-b border-[#dfd6c4] bg-white py-2.5 shadow-2xs">
        <div class="w-full max-w-[1600px] mx-auto px-4 sm:px-6 flex items-center justify-between gap-4">
            <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-0.5 max-w-full">
                <a
                    href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']))) }}"
                    class="shrink-0 rounded-full px-3.5 py-1 text-xs font-semibold tracking-wide transition cursor-pointer {{ empty($activeCategorySlugs) ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] text-[#685c54] border border-[#dfd6c4] hover:border-[#78000b] hover:text-[#78000b]' }}"
                >
                    <span data-i18n-en="All Creations" data-i18n-de="Alle Kreationen">All Creations</span>
                </a>
                @foreach($categoriesList as $quickCat)
                    @php
                        $isActive = in_array($quickCat->slug, $activeCategorySlugs);
                        $catCount = $quickCat->products_count ?? ($quickCat->products ? $quickCat->products->count() : 0);
                    @endphp
                    <a
                        href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']), ['category' => $quickCat->slug])) }}"
                        class="shrink-0 rounded-full px-3.5 py-1 text-xs font-semibold tracking-wide transition cursor-pointer flex items-center gap-1.5 {{ $isActive ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] text-[#685c54] border border-[#dfd6c4] hover:border-[#d8b45a] hover:text-[#1c1210]' }}"
                    >
                        <span>{{ $quickCat->name }}</span>
                        @if($catCount > 0)
                            <span class="text-[0.62rem] opacity-75 font-mono">({{ $catCount }})</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Dynamic Subcategory Pills Bar (Shows when category is selected) -->
    @if(!empty($activeCategorySlugs))
        @php
            $firstCatSlug = is_array($activeCategorySlugs) ? $activeCategorySlugs[0] : $activeCategorySlugs;
            $selectedCategory = $categoriesList->firstWhere('slug', $firstCatSlug);
        @endphp
        @if($selectedCategory && $selectedCategory->activeSubcategories && $selectedCategory->activeSubcategories->count() > 0)
            <div class="border-b border-[#dfd6c4] bg-[#f7f2e9] py-2 text-xs">
                <div class="w-full max-w-[1600px] mx-auto px-4 sm:px-6 flex items-center gap-2 overflow-x-auto no-scrollbar">
                    <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#78000b] shrink-0">
                        Subcategory:
                    </span>
                    <a
                        href="{{ route('shop', array_merge(request()->except(['subcategory', 'page']), ['category' => $firstCatSlug])) }}"
                        class="shrink-0 rounded-full px-3 py-1 text-[0.65rem] font-bold tracking-wide transition cursor-pointer {{ empty($activeSubcategorySlugs) ? 'bg-[#78000b] text-white shadow-xs' : 'bg-white text-[#685c54] border border-[#dfd6c4] hover:border-[#78000b]' }}"
                    >
                        All {{ $selectedCategory->name }}
                    </a>
                    @foreach($selectedCategory->activeSubcategories as $subcat)
                        @php
                            $isSubActive = in_array($subcat->slug, $activeSubcategorySlugs);
                            $subCount = $subcat->products_count ?? ($subcat->products ? $subcat->products->count() : 0);
                        @endphp
                        <a
                            href="{{ route('shop', array_merge(request()->except(['page']), ['category' => $firstCatSlug, 'subcategory' => $subcat->slug])) }}"
                            class="shrink-0 rounded-full px-3 py-1 text-[0.65rem] font-bold tracking-wide transition cursor-pointer flex items-center gap-1 {{ $isSubActive ? 'bg-[#d8b45a] text-[#120807] shadow-xs' : 'bg-white text-[#685c54] border border-[#dfd6c4] hover:border-[#d8b45a]' }}"
                        >
                            <span>{{ $subcat->name }}</span>
                            @if($subCount > 0)
                                <span class="text-[0.58rem] opacity-75 font-mono">({{ $subCount }})</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    <!-- Main Catalog & Filtering Layout -->
    <section class="py-4 sm:py-6">
        <div class="w-full max-w-[1600px] mx-auto px-4 sm:px-6">

            <!-- Control Bar (Filters Trigger, Items Count, Sort, Grid/List Switch) -->
            <div class="mb-4 flex flex-col gap-3 border-b border-[#dfd6c4] pb-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-3">
                    <!-- Mobile Filter Toggle Button -->
                    <button
                        type="button"
                        onclick="toggleMobileFilter()"
                        class="inline-flex items-center gap-2 rounded-lg border border-[#dfd6c4] bg-white px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-[#1c1210] shadow-2xs transition hover:border-[#78000b] hover:text-[#78000b] lg:hidden cursor-pointer"
                        aria-label="Toggle filters"
                    >
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                        </svg>
                        <span>Filter</span>
                        @if($hasActiveFilters)
                            <span class="h-2 w-2 rounded-full bg-[#78000b]"></span>
                        @endif
                    </button>

                    <p class="text-xs text-[#685c54]">
                        <span class="font-bold text-[#1c1210]">{{ $products->total() }}</span> 
                        <span data-i18n-en="creations found" data-i18n-de="Meisterwerke gefunden">creations found</span>
                        @if($products->lastPage() > 1)
                            <span class="text-[#8a7c74]">({{ $products->firstItem() }}–{{ $products->lastItem() }})</span>
                        @endif
                    </p>
                </div>

                <div class="flex items-center justify-between gap-3 md:justify-end">
                    <!-- Sort Dropdown -->
                    <div class="flex items-center gap-2">
                        <label for="sort-select" class="text-[0.68rem] font-bold uppercase tracking-wider text-[#685c54] whitespace-nowrap cursor-pointer">
                            Sort:
                        </label>
                        <select
                            id="sort-select"
                            onchange="handleSortChange(this.value)"
                            class="rounded-lg border border-[#dfd6c4] bg-white px-3 py-1.5 text-xs font-medium text-[#1c1210] shadow-2xs transition hover:border-[#d8b45a] focus:border-[#78000b] focus:outline-none cursor-pointer"
                        >
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>

                    <!-- Grid vs List View Switcher -->
                    <div class="hidden sm:flex items-center rounded-lg border border-[#dfd6c4] bg-white p-0.5 shadow-2xs">
                        <button
                            type="button"
                            id="grid-view-btn"
                            onclick="setViewMode('grid')"
                            class="p-1.5 rounded text-[#78000b] bg-[#78000b]/10 transition cursor-pointer"
                            title="Grid View"
                            aria-label="Grid View"
                        >
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                        </button>
                        <button
                            type="button"
                            id="list-view-btn"
                            onclick="setViewMode('list')"
                            class="p-1.5 rounded text-[#685c54] hover:text-[#78000b] transition cursor-pointer"
                            title="List View"
                            aria-label="List View"
                        >
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"/>
                                <line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/>
                                <line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/>
                                <line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Filter Chips (if any filter is applied) -->
            @if($hasActiveFilters)
                <div class="mb-4 flex flex-wrap items-center gap-2 rounded-xl border border-[#dfd6c4] bg-white p-2.5 shadow-2xs">
                    <span class="text-[0.68rem] font-bold uppercase tracking-wider text-[#685c54]">Active Filters:</span>

                    @if(request('search'))
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-2.5 py-0.5 text-xs text-[#78000b]">
                            <span>Search: "{{ request('search') }}"</span>
                            <a href="{{ route('shop', array_merge(request()->except(['search', 'page']))) }}" class="font-bold hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    @if(request('category'))
                        @foreach((array) request('category') as $catSlug)
                            @php
                                $catObj = $categoriesList->firstWhere('slug', $catSlug);
                            @endphp
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                                <span>{{ $catObj->name ?? $catSlug }}</span>
                                <a href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                            </span>
                        @endforeach
                    @endif

                    @if(request('subcategory'))
                        @foreach((array) request('subcategory') as $subSlug)
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                                <span>Subcategory: {{ $subSlug }}</span>
                                <a href="{{ route('shop', array_merge(request()->except(['subcategory', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                            </span>
                        @endforeach
                    @endif

                    @if(request('min_price'))
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                            <span>Min: €{{ request('min_price') }}</span>
                            <a href="{{ route('shop', array_merge(request()->except(['min_price', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    @if(request('max_price') && request('max_price') < $dbMaxPrice)
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                            <span>Max: €{{ request('max_price') }}</span>
                            <a href="{{ route('shop', array_merge(request()->except(['max_price', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    @if(request('featured'))
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#78000b]/30 bg-[#78000b]/10 px-2.5 py-0.5 text-xs text-[#78000b] font-semibold">
                            <span>Atelier Bestsellers</span>
                            <a href="{{ route('shop', array_merge(request()->except(['featured', 'page']))) }}" class="font-bold hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    @if(request('in_stock'))
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#2e683a]/30 bg-[#2e683a]/10 px-2.5 py-0.5 text-xs text-[#2e683a] font-semibold">
                            <span>In Stock Only</span>
                            <a href="{{ route('shop', array_merge(request()->except(['in_stock', 'page']))) }}" class="font-bold hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    <a href="{{ route('shop') }}" class="ml-auto text-xs font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007] cursor-pointer">
                        Clear All Filters
                    </a>
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-12 lg:items-start">

                <!-- Modern Pixel-Perfect Filter Sidebar (3 cols on lg) -->
                <aside id="filter-sidebar" class="lg:col-span-3 hidden lg:block space-y-4">
                    <form action="{{ route('shop') }}" method="GET" id="shop-filter-form" class="sticky top-20 max-h-[calc(100vh-6rem)] overflow-y-auto overscroll-contain scrollbar-thin rounded-xl border border-[#dfd6c4] bg-white p-5 shadow-2xs space-y-5">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Filter Header -->
                        <div class="flex items-center justify-between border-b border-[#f0e7d8] pb-3">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                                </svg>
                                <h2 class="font-display text-sm font-semibold uppercase tracking-wider text-[#1c1210]">Filters</h2>
                            </div>
                            <a href="{{ route('shop') }}" class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007] transition cursor-pointer">Reset All</a>
                        </div>

                        <!-- 1. Categories Accordion -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210]">Categories</h3>
                                <span class="text-[0.62rem] text-[#8a7c74] font-mono">{{ $categoriesList->count() }} collections</span>
                            </div>

                            <div class="space-y-1.5 text-xs text-[#5c4f46] max-h-72 overflow-y-auto pr-1 scrollbar-thin">
                                @forelse($categoriesList as $category)
                                    @php
                                        $catChecked = in_array($category->slug, $activeCategorySlugs);
                                        $pCount = $category->products_count ?? ($category->products ? $category->products->count() : 0);
                                    @endphp
                                    <div class="rounded-lg border border-transparent p-1 transition hover:bg-[#faf7f2]">
                                        <label class="flex items-center justify-between gap-2 cursor-pointer select-none">
                                            <span class="flex items-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    name="category[]"
                                                    value="{{ $category->slug }}"
                                                    {{ $catChecked ? 'checked' : '' }}
                                                    class="h-3.5 w-3.5 rounded border-[#d9cebc] text-[#78000b] focus:ring-[#78000b]/20 cursor-pointer accent-[#78000b]"
                                                >
                                                <span class="font-medium text-[#1c1210] {{ $catChecked ? 'text-[#78000b] font-bold' : '' }}">{{ $category->name }}</span>
                                            </span>
                                            <span class="rounded-full bg-[#f4efe5] px-2 py-0.5 text-[0.6rem] font-mono text-[#685c54]">{{ $pCount }}</span>
                                        </label>

                                        <!-- Indented Subcategories -->
                                        @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                                            <div class="mt-1 ml-5 space-y-1 border-l-2 border-[#d8b45a]/30 pl-2.5 pt-0.5">
                                                @foreach($category->activeSubcategories as $subcat)
                                                    @php
                                                        $subChecked = in_array($subcat->slug, $activeSubcategorySlugs);
                                                        $subPCount = $subcat->products_count ?? ($subcat->products ? $subcat->products->count() : 0);
                                                    @endphp
                                                    <label class="flex items-center justify-between gap-2 cursor-pointer text-[0.68rem] text-[#685c54] hover:text-[#78000b] transition select-none">
                                                        <span class="flex items-center gap-1.5">
                                                            <input
                                                                type="checkbox"
                                                                name="subcategory[]"
                                                                value="{{ $subcat->slug }}"
                                                                {{ $subChecked ? 'checked' : '' }}
                                                                class="h-3 w-3 rounded border-[#d9cebc] text-[#78000b] focus:ring-[#78000b]/20 cursor-pointer accent-[#78000b]"
                                                            >
                                                            <span class="{{ $subChecked ? 'text-[#78000b] font-semibold' : '' }}">{{ $subcat->name }}</span>
                                                        </span>
                                                        <span class="text-[0.58rem] font-mono text-[#8a7c74]">({{ $subPCount }})</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-xs text-[#8a7c74]">No categories found.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- 2. Price Range Filter -->
                        <div class="border-t border-[#f0e7d8] pt-3.5 space-y-2.5">
                            <div class="flex items-center justify-between">
                                <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210]">Price Range</h3>
                                <span class="text-[0.62rem] font-mono text-[#78000b] font-bold" id="price-range-label">
                                    €{{ $currentMinPrice }} – €{{ $currentMaxPrice }}
                                </span>
                            </div>

                            <!-- Min / Max Numeric Inputs -->
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center rounded-lg border border-[#dfd6c4] bg-[#faf8f5] px-2 py-1">
                                    <span class="text-xs text-[#8a7c74] mr-1">€</span>
                                    <input
                                        type="number"
                                        name="min_price"
                                        id="input-min-price"
                                        min="{{ $dbMinPrice ?? 0 }}"
                                        max="{{ $dbMaxPrice ?? 1000 }}"
                                        value="{{ request('min_price', $dbMinPrice ?? 0) }}"
                                        placeholder="Min"
                                        class="w-full text-xs bg-transparent text-[#1c1210] focus:outline-none font-mono"
                                        oninput="syncPriceDisplay()"
                                    >
                                </div>
                                <div class="flex items-center rounded-lg border border-[#dfd6c4] bg-[#faf8f5] px-2 py-1">
                                    <span class="text-xs text-[#8a7c74] mr-1">€</span>
                                    <input
                                        type="number"
                                        name="max_price"
                                        id="input-max-price"
                                        min="{{ $dbMinPrice ?? 0 }}"
                                        max="{{ $dbMaxPrice ?? 1000 }}"
                                        value="{{ request('max_price', $dbMaxPrice ?? 1000) }}"
                                        placeholder="Max"
                                        class="w-full text-xs bg-transparent text-[#1c1210] focus:outline-none font-mono"
                                        oninput="syncPriceDisplay()"
                                    >
                                </div>
                            </div>

                            <!-- Quick Price Chips -->
                            <div class="flex flex-wrap gap-1.5 pt-1">
                                <button
                                    type="button"
                                    onclick="setPricePreset(0, 200)"
                                    class="rounded-full border border-[#dfd6c4] bg-[#faf8f5] px-2.5 py-0.5 text-[0.62rem] text-[#685c54] hover:border-[#78000b] hover:text-[#78000b] transition cursor-pointer"
                                >
                                    &lt; €200
                                </button>
                                <button
                                    type="button"
                                    onclick="setPricePreset(200, 500)"
                                    class="rounded-full border border-[#dfd6c4] bg-[#faf8f5] px-2.5 py-0.5 text-[0.62rem] text-[#685c54] hover:border-[#78000b] hover:text-[#78000b] transition cursor-pointer"
                                >
                                    €200–€500
                                </button>
                                <button
                                    type="button"
                                    onclick="setPricePreset(500, {{ $dbMaxPrice ?? 1000 }})"
                                    class="rounded-full border border-[#dfd6c4] bg-[#faf8f5] px-2.5 py-0.5 text-[0.62rem] text-[#685c54] hover:border-[#78000b] hover:text-[#78000b] transition cursor-pointer"
                                >
                                    €500+
                                </button>
                            </div>
                        </div>

                        <!-- 3. Availability & Features -->
                        <div class="border-t border-[#f0e7d8] pt-3.5 space-y-2">
                            <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210]">Curation</h3>

                            <label class="flex items-center gap-2 cursor-pointer text-xs text-[#5c4f46] select-none hover:text-[#78000b]">
                                <input
                                    type="checkbox"
                                    name="featured"
                                    value="1"
                                    {{ request('featured') ? 'checked' : '' }}
                                    class="h-3.5 w-3.5 rounded border-[#d9cebc] text-[#78000b] focus:ring-[#78000b]/20 cursor-pointer accent-[#78000b]"
                                >
                                <span>Atelier Bestsellers Only</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer text-xs text-[#5c4f46] select-none hover:text-[#78000b]">
                                <input
                                    type="checkbox"
                                    name="in_stock"
                                    value="1"
                                    {{ request('in_stock') ? 'checked' : '' }}
                                    class="h-3.5 w-3.5 rounded border-[#d9cebc] text-[#78000b] focus:ring-[#78000b]/20 cursor-pointer accent-[#78000b]"
                                >
                                <span>In Stock (Dispatches 24h)</span>
                            </label>
                        </div>

                        <!-- Apply Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="animate-shine-sweep w-full flex items-center justify-center gap-2 rounded-lg bg-[#78000b] py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-md hover:bg-[#500007] active:scale-98 transition cursor-pointer"
                            >
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span>Apply Filters</span>
                            </button>
                        </div>

                        <!-- Atelier Trust Badge -->
                        <div class="rounded-lg border border-[#dfd6c4] bg-[#faf8f5] p-2.5 text-center">
                            <p class="text-[0.58rem] font-bold uppercase tracking-[0.16em] text-[#78000b]">100% Genuine Full-Grain</p>
                            <p class="mt-0.5 text-[0.62rem] text-[#685c54]">Tuscan Atelier Tannery & Insured DHL Express</p>
                        </div>
                    </form>
                </aside>

                <!-- Product Grid Catalog (9 cols on lg) -->
                <main class="lg:col-span-9">
                    <div id="product-container" class="grid gap-4 sm:gap-5 grid-cols-2 md:grid-cols-3">
                        @forelse($products as $index => $product)
                            @php
                                $pName = $product->name;
                                $pSlug = $product->slug;
                                $pCat = $product->category->name ?? 'Haute Maroquinerie';
                                $pImg = $product->image_url;
                                $pHoverImg = $product->hover_image_url ?? $pImg;
                                $pPrice = '€' . number_format($product->price, 2, '.', ',');
                                $pSalePrice = ($product->sale_price && $product->sale_price < $product->price) ? '€' . number_format($product->sale_price, 2, '.', ',') : null;
                                $hasDiscount = ($product->sale_price && $product->sale_price < $product->price);
                                $discountPercent = $hasDiscount ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                                $detailUrl = route('shop.show', $pSlug);
                                $prodPayload = htmlspecialchars(json_encode([
                                    'id' => $product->id,
                                    'name' => $pName,
                                    'price' => $pPrice,
                                    'sale_price' => $pSalePrice,
                                    'image' => $pImg,
                                    'category' => $pCat,
                                    'slug' => $pSlug,
                                    'description' => $product->description,
                                ]), ENT_QUOTES, 'UTF-8');
                            @endphp

                            <!-- Pixel-Perfect Luxury Product Card with Dual Hover Reveal & Two Action Buttons -->
                            <article
                                data-url="{{ $detailUrl }}"
                                onclick="if (!event.target.closest('button, a')) { window.location.assign(this.dataset.url); }"
                                class="product-card group relative flex flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-white shadow-[0_4px_16px_rgba(28,18,16,0.05)] hover:shadow-[0_12px_32px_rgba(120,0,11,0.14)] hover:border-[#d8b45a] transition-all duration-300 ease-out hover:-translate-y-1.5 cursor-pointer select-none"
                            >
                                <!-- Top Shimmer Gold Accent Line on Hover -->
                                <div class="pointer-events-none absolute inset-x-0 top-0 z-30 h-1 origin-left scale-x-0 bg-gradient-to-r from-[#78000b] via-[#ffd45a] to-[#78000b] transition-transform duration-500 group-hover:scale-x-100"></div>

                                <!-- Visual Media Container: Dual Image Hover Swap & Soft Zoom -->
                                <div class="card-img-wrap relative w-full aspect-square overflow-hidden bg-[#f5f1e8] border-b border-[#ebdccb]" style="min-height: 220px;">
                                    <!-- Primary Product Photo -->
                                    <img
                                        src="{{ $pImg }}"
                                        alt="{{ $pName }}"
                                        class="absolute inset-0 h-full w-full object-cover transition-all duration-500 ease-out group-hover:scale-106 {{ $pHoverImg !== $pImg ? 'group-hover:opacity-0' : '' }}"
                                        loading="lazy"
                                    >

                                    @if($pHoverImg && $pHoverImg !== $pImg)
                                        <!-- Secondary Product Photo (Reveals smoothly on Hover) -->
                                        <img
                                            src="{{ $pHoverImg }}"
                                            alt="{{ $pName }} Detail"
                                            class="absolute inset-0 h-full w-full object-cover opacity-0 transition-all duration-500 ease-out group-hover:opacity-100 group-hover:scale-106"
                                            loading="lazy"
                                        >
                                        <!-- Hover Alternate View Pill -->
                                        <div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 py-1 text-center bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <span class="text-[0.58rem] font-bold uppercase tracking-[0.16em] text-white/90 drop-shadow">Alternate View</span>
                                        </div>
                                    @endif

                                    <!-- Top Atelier / Sale Badges -->
                                    <div class="absolute left-2.5 top-2.5 z-20 flex flex-col gap-1 pointer-events-none">
                                        @if($product->is_featured)
                                            <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.55rem] font-bold uppercase tracking-[0.16em] text-white shadow-xs">
                                                Atelier
                                            </span>
                                        @endif
                                        @if($hasDiscount)
                                            <span class="rounded bg-[#d8b45a] px-2 py-0.5 text-[0.55rem] font-bold uppercase tracking-[0.16em] text-[#120807] shadow-xs font-mono">
                                                -{{ $discountPercent }}%
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Floating Wishlist Heart Button -->
                                    <div class="absolute right-2.5 top-2.5 z-30">
                                        <button
                                            type="button"
                                            data-wishlist-btn-id="{{ $product->id }}"
                                            onclick="event.stopPropagation(); toggleWishlistProduct(JSON.parse(this.dataset.product), this)"
                                            data-product="{{ $prodPayload }}"
                                            class="flex h-7 w-7 items-center justify-center rounded-full border border-[#d8b45a]/50 bg-white/95 text-[#78000b] backdrop-blur-md shadow-xs transition hover:bg-[#78000b] hover:text-white cursor-pointer"
                                            aria-label="Save to Wishlist"
                                            title="Save to Wishlist"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Content & Details Area -->
                                <div class="card-body-wrap p-3 sm:p-4 flex flex-col justify-between flex-1 bg-white">
                                    <div>
                                        <!-- Category & Star Rating -->
                                        <div class="flex items-center justify-between gap-1 text-[0.62rem]">
                                            <span class="font-bold uppercase tracking-[0.14em] text-[#78000b] truncate max-w-[70%]">
                                                {{ $pCat }}
                                            </span>
                                            <span class="text-[#d8b45a] font-serif tracking-widest text-[0.65rem] shrink-0" aria-label="5 stars">
                                                ★★★★★
                                            </span>
                                        </div>

                                        <!-- Title -->
                                        <a href="{{ $detailUrl }}" class="block mt-1">
                                            <h3 class="font-display text-sm sm:text-base font-medium leading-snug text-[#1c1210] line-clamp-1 transition-colors duration-300 group-hover:text-[#78000b]">
                                                {{ $pName }}
                                            </h3>
                                        </a>

                                        <!-- Description snippet (visible in List View) -->
                                        <p class="card-desc hidden text-xs text-[#685c54] mt-1.5 line-clamp-2 leading-relaxed">
                                            {{ strip_tags($product->description ?? 'Exquisite European handcrafted atelier leather creation.') }}
                                        </p>
                                    </div>

                                    <!-- Price Row -->
                                    <div class="mt-2.5 flex items-baseline gap-2">
                                        <span class="font-sans text-sm sm:text-base font-bold text-[#1c1210]">
                                            {{ $pPrice }}
                                        </span>
                                        @if(!empty($pSalePrice))
                                            <span class="text-xs text-[#8a7c74] line-through font-normal">
                                                {{ $pSalePrice }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Two Action Buttons: Details & Add to Cart (Like Home Page) -->
                                    <div class="mt-3 pt-3 border-t border-[#f2ebdc] grid grid-cols-2 gap-2">
                                        <!-- View Detail Link -->
                                        <a
                                            href="{{ $detailUrl }}"
                                            class="inline-flex items-center justify-center rounded-md border border-[#dfd6c4] bg-[#faf8f5] px-2 py-2 text-[0.62rem] font-bold uppercase tracking-wider text-[#1c1210] hover:border-[#78000b] hover:bg-[#78000b] hover:text-white transition-all duration-300 shadow-2xs text-center cursor-pointer"
                                        >
                                            <span data-i18n-en="Details" data-i18n-de="Details">Details</span>
                                        </a>

                                        <!-- Add to Cart Button -->
                                        <button
                                            type="button"
                                            onclick="event.stopPropagation(); quickAddToCart({{ $product->id }}, 1)"
                                            class="inline-flex items-center justify-center gap-1 rounded-md bg-[#d8b45a] px-2 py-2 text-[0.62rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] hover:shadow-[0_4px_16px_rgba(216,180,90,0.4)] active:scale-95 transition-all duration-300 shadow-2xs cursor-pointer font-sans"
                                        >
                                            <svg class="h-3 w-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                                                <line x1="3" y1="6" x2="21" y2="6"/>
                                                <path d="M16 10a4 4 0 01-8 0"/>
                                            </svg>
                                            <span data-i18n-en="+ Cart" data-i18n-de="+ Korb">+ Cart</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full py-16 px-6 text-center bg-white rounded-xl border border-[#dfd6c4] space-y-3 shadow-2xs">
                                <svg class="mx-auto h-12 w-12 text-[#78000b]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <h3 class="font-display text-lg text-[#1c1210]">No creations match your filter criteria</h3>
                                <p class="text-xs text-[#685c54] max-w-md mx-auto">
                                    Try adjusting your price range, clearing selected categories, or viewing the complete collection.
                                </p>
                                <div class="pt-2">
                                    <a href="{{ route('shop') }}" class="inline-flex items-center justify-center rounded-lg bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white transition hover:bg-[#500007] cursor-pointer shadow-xs">
                                        Reset All Filters
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Luxury Pagination -->
                    @if($products->hasPages())
                        <div class="mt-8 flex flex-col items-center justify-between gap-3 border-t border-[#dfd6c4] pt-4 sm:flex-row">
                            <p class="text-xs text-[#685c54]">
                                Showing <span class="font-bold text-[#1c1210]">{{ $products->firstItem() }}</span> to <span class="font-bold text-[#1c1210]">{{ $products->lastItem() }}</span> of <span class="font-bold text-[#1c1210]">{{ $products->total() }}</span> creations
                            </p>

                            <div class="flex items-center gap-1.5">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-[#dfd6c4] bg-white/50 text-[#c7baa7] cursor-not-allowed">
                                        ‹
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-[#dfd6c4] bg-white text-[#1c1210] shadow-2xs transition hover:border-[#78000b] hover:text-[#78000b] cursor-pointer" rel="prev">
                                        ‹
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <span class="inline-flex h-8 min-w-8 items-center justify-center rounded-lg border border-[#78000b] bg-[#78000b] px-2.5 text-xs font-bold text-white shadow-2xs">
                                            {{ $page }}
                                        </span>
                                    @elseif ($page == 1 || $page == $products->lastPage() || abs($page - $products->currentPage()) <= 1)
                                        <a href="{{ $url }}" class="inline-flex h-8 min-w-8 items-center justify-center rounded-lg border border-[#dfd6c4] bg-white px-2.5 text-xs font-medium text-[#1c1210] shadow-2xs transition hover:border-[#d8b45a] hover:text-[#78000b] cursor-pointer">
                                            {{ $page }}
                                        </a>
                                    @elseif (abs($page - $products->currentPage()) == 2)
                                        <span class="inline-flex h-8 w-5 items-center justify-center text-xs text-[#8a7c74]">...</span>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-[#dfd6c4] bg-white text-[#1c1210] shadow-2xs transition hover:border-[#78000b] hover:text-[#78000b] cursor-pointer" rel="next">
                                        ›
                                    </a>
                                @else
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-[#dfd6c4] bg-white/50 text-[#c7baa7] cursor-not-allowed">
                                        ›
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </main>

            </div>
        </div>
    </section>

    <!-- Mobile Filter Off-Canvas Slide Drawer -->
    <div id="mobile-filter-drawer" class="fixed inset-0 z-50 hidden transition-opacity duration-300">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="toggleMobileFilter()"></div>

        <!-- Drawer Content -->
        <div class="absolute inset-y-0 left-0 w-full max-w-xs bg-white p-5 flex flex-col justify-between shadow-2xl overflow-y-auto">
            <div>
                <div class="flex items-center justify-between border-b border-[#dfd6c4] pb-3 mb-4">
                    <h2 class="font-display text-base font-semibold text-[#1c1210]">Filters & Curation</h2>
                    <button type="button" onclick="toggleMobileFilter()" class="h-8 w-8 flex items-center justify-center rounded-full bg-[#f4efe5] text-[#1c1210] hover:bg-[#78000b] hover:text-white transition cursor-pointer">
                        ✕
                    </button>
                </div>

                <div id="mobile-filter-form-clone">
                    <!-- Cloned dynamic content or direct mobile form triggers -->
                    <p class="text-xs text-[#685c54] mb-3">Adjust your preferences and click Apply.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-[#dfd6c4] flex gap-2">
                <a href="{{ route('shop') }}" class="flex-1 py-2 text-center text-xs font-bold uppercase rounded-lg border border-[#dfd6c4] text-[#1c1210]">
                    Reset
                </a>
                <button type="button" onclick="document.getElementById('shop-filter-form').submit()" class="flex-1 py-2 text-center text-xs font-bold uppercase rounded-lg bg-[#78000b] text-white">
                    Apply
                </button>
            </div>
        </div>
    </div>

    <!-- Client-Side Scripts for Filter, Sort, View Modes & Presets -->
    <script>
        function syncPriceDisplay() {
            const min = document.getElementById('input-min-price').value || 0;
            const max = document.getElementById('input-max-price').value || {{ $dbMaxPrice ?? 1000 }};
            const label = document.getElementById('price-range-label');
            if (label) {
                label.innerText = '€' + min + ' – €' + max;
            }
        }

        function setPricePreset(min, max) {
            const minInput = document.getElementById('input-min-price');
            const maxInput = document.getElementById('input-max-price');
            if (minInput) minInput.value = min;
            if (maxInput) maxInput.value = max;
            syncPriceDisplay();
            document.getElementById('shop-filter-form').submit();
        }

        function handleSortChange(sortVal) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortVal);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }

        function setViewMode(mode) {
            const container = document.getElementById('product-container');
            const gridBtn = document.getElementById('grid-view-btn');
            const listBtn = document.getElementById('list-view-btn');
            if (!container) return;
            const cards = container.querySelectorAll('.product-card');

            if (mode === 'list') {
                container.classList.remove('grid-cols-2', 'md:grid-cols-3');
                container.classList.add('grid-cols-1');
                cards.forEach(card => {
                    card.classList.add('md:flex-row');
                    const imgWrap = card.querySelector('.card-img-wrap');
                    if (imgWrap) {
                        imgWrap.classList.add('md:w-64', 'md:h-auto', 'shrink-0');
                    }
                    const desc = card.querySelector('.card-desc');
                    if (desc) desc.classList.remove('hidden');
                });
                gridBtn.classList.remove('text-[#78000b]', 'bg-[#78000b]/10');
                gridBtn.classList.add('text-[#685c54]');
                listBtn.classList.add('text-[#78000b]', 'bg-[#78000b]/10');
                listBtn.classList.remove('text-[#685c54]');
                localStorage.setItem('mehaaj_shop_view', 'list');
            } else {
                container.classList.remove('grid-cols-1');
                container.classList.add('grid-cols-2', 'md:grid-cols-3');
                cards.forEach(card => {
                    card.classList.remove('md:flex-row');
                    const imgWrap = card.querySelector('.card-img-wrap');
                    if (imgWrap) {
                        imgWrap.classList.remove('md:w-64', 'md:h-auto', 'shrink-0');
                    }
                    const desc = card.querySelector('.card-desc');
                    if (desc) desc.classList.add('hidden');
                });
                gridBtn.classList.add('text-[#78000b]', 'bg-[#78000b]/10');
                gridBtn.classList.remove('text-[#685c54]');
                listBtn.classList.remove('text-[#78000b]', 'bg-[#78000b]/10');
                listBtn.classList.add('text-[#685c54]');
                localStorage.setItem('mehaaj_shop_view', 'grid');
            }
        }

        function toggleMobileFilter() {
            const drawer = document.getElementById('mobile-filter-drawer');
            if (drawer) {
                drawer.classList.toggle('hidden');
            }
        }

        // Restore user view preference
        document.addEventListener('DOMContentLoaded', () => {
            const savedView = localStorage.getItem('mehaaj_shop_view');
            if (savedView === 'list') {
                setViewMode('list');
            }
        });
    </script>
</div>
@endsection
