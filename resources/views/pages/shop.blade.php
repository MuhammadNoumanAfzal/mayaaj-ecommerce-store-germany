@extends('layouts.app')
@section('title', 'Kollektion & Shop | MEHAAJ® Official Luxury Atelier')
@section('meta_description', 'Entdecken Sie die vollständige MEHAAJ Meisterkollektion: Handgefertigte Luxus-Ledertaschen, italienisches Vollleder, Schweizer Chronographen und exklusive Accessoires.')
@section('canonical', route('shop'))

@section('content')
<div class="bg-[#faf7f2] min-h-screen text-[#1c1210]">

    <!-- Sleek Unified Top Header Bar (No dead vertical space) -->
    <div class="border-b border-[#e6decb] bg-white py-2.5 sm:py-3 shadow-xs">
        <div class="luxury-container flex flex-col gap-2.5 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-2.5">
                <nav class="flex items-center gap-1.5 text-[0.7rem] text-[#8a7c74]" aria-label="Breadcrumb">
                    <a href="/" class="hover:text-[#78000b] transition cursor-pointer" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
                    <span class="text-[#c7baa7]">/</span>
                    <span class="text-[#1c1210] font-medium" data-i18n-de="Kollektion" data-i18n-en="Collection">Kollektion</span>
                    @if(request('category'))
                        <span class="text-[#c7baa7]">/</span>
                        @php
                            $activeCat = ($globalCategories ?? collect())->firstWhere('slug', is_array(request('category')) ? request('category')[0] : request('category'));
                        @endphp
                        <span class="text-[#78000b] font-semibold">{{ $activeCat->name ?? (is_array(request('category')) ? implode(', ', request('category')) : request('category')) }}</span>
                    @endif
                </nav>
                <span class="text-[#d8b45a] hidden sm:inline">•</span>
                <h1 class="font-display text-base sm:text-lg font-medium text-[#1c1210] hidden sm:inline" data-i18n-de="Meisterkollektion" data-i18n-en="Master Collection">
                    Meisterkollektion
                </h1>
            </div>

            <!-- Category Pills: Clean horizontal scrolling with NO scrollbar, compact size -->
            <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-0.5 max-w-full">
                <a
                    href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']))) }}"
                    class="shrink-0 rounded-full px-3 py-1 text-[0.68rem] font-semibold tracking-wide transition cursor-pointer {{ !request('category') ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] text-[#685c54] border border-[#e6decb] hover:border-[#78000b] hover:text-[#78000b]' }}"
                >
                    <span data-i18n-de="Alle" data-i18n-en="All">Alle</span>
                </a>
                @foreach($globalCategories ?? [] as $quickCat)
                    @php
                        $isActive = in_array($quickCat->slug, (array) request('category'));
                    @endphp
                    <a
                        href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']), ['category' => $quickCat->slug])) }}"
                        class="shrink-0 rounded-full px-3 py-1 text-[0.68rem] font-semibold tracking-wide transition cursor-pointer {{ $isActive ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] text-[#685c54] border border-[#e6decb] hover:border-[#d8b45a] hover:text-[#1c1210]' }}"
                    >
                        {{ $quickCat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Catalog & Filtering Layout (Tightened spacing) -->
    <section class="py-3 sm:py-4">
        <div class="luxury-container">

            <!-- Control Bar (Filter Toggle, Items Count, Sort, Grid/List Switch) -->
            <div class="mb-4 flex flex-col gap-3 border-b border-[#e6decb] pb-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile Filter Toggle Button -->
                    <button
                        type="button"
                        onclick="toggleMobileFilter()"
                        class="inline-flex items-center gap-2 rounded-md border border-[#e6decb] bg-white px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-[#1c1210] shadow-xs transition hover:border-[#78000b] hover:text-[#78000b] lg:hidden cursor-pointer"
                        aria-label="Toggle filters"
                    >
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                        </svg>
                        <span data-i18n-de="FILTER" data-i18n-en="FILTERS">FILTER</span>
                        @if(request('category') || request('subcategory') || request('search') || request('max_price'))
                            <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                        @endif
                    </button>

                    <p class="text-xs text-[#685c54]">
                        <span class="font-bold text-[#1c1210]">{{ $products->total() }}</span> 
                        <span data-i18n-de="Meisterwerke gefunden" data-i18n-en="Masterpieces found">Meisterwerke gefunden</span>
                        @if($products->lastPage() > 1)
                            <span class="text-[#8a7c74]">({{ $products->firstItem() }}–{{ $products->lastItem() }})</span>
                        @endif
                    </p>
                </div>

                <div class="flex items-center justify-between gap-3 md:justify-end">
                    <!-- Server-Side Sort Dropdown -->
                    <div class="flex items-center gap-2">
                        <label for="sort-select" class="text-[0.7rem] font-bold uppercase tracking-wider text-[#685c54] whitespace-nowrap cursor-pointer" data-i18n-de="Sortieren:" data-i18n-en="Sort by:">
                            Sortieren:
                        </label>
                        <select
                            id="sort-select"
                            onchange="handleSortChange(this.value)"
                            class="rounded border border-[#e6decb] bg-white px-2.5 py-1.5 text-xs font-medium text-[#1c1210] shadow-xs transition hover:border-[#d8b45a] focus:border-[#78000b] focus:outline-none cursor-pointer"
                        >
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }} data-i18n-de="Beliebtheit" data-i18n-en="Featured">Beliebtheit</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }} data-i18n-de="Neuheiten" data-i18n-en="Newest Arrivals">Neuheiten</option>
                            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }} data-i18n-de="Preis: Aufsteigend" data-i18n-en="Price: Low to High">Preis: Aufsteigend</option>
                            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }} data-i18n-de="Preis: Absteigend" data-i18n-en="Price: High to Low">Preis: Absteigend</option>
                        </select>
                    </div>

                    <!-- Grid vs List View Switcher -->
                    <div class="hidden sm:flex items-center rounded border border-[#e6decb] bg-white p-0.5 shadow-xs">
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

            <!-- Active Filters Bar (if any filters applied) -->
            @if(request('category') || request('subcategory') || request('search') || (request('max_price') && request('max_price') < $dbMaxPrice))
                <div class="mb-4 flex flex-wrap items-center gap-2 rounded-md border border-[#e6decb] bg-white p-2.5 shadow-xs">
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#685c54]" data-i18n-de="Aktive Filter:" data-i18n-en="Active Filters:">Aktive Filter:</span>

                    @if(request('search'))
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-2.5 py-0.5 text-xs text-[#78000b]">
                            <span>Suche: "{{ request('search') }}"</span>
                            <a href="{{ route('shop', array_merge(request()->except(['search', 'page']))) }}" class="font-bold hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    @if(request('category'))
                        @foreach((array) request('category') as $catSlug)
                            @php
                                $catObj = ($globalCategories ?? collect())->firstWhere('slug', $catSlug);
                            @endphp
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                                <span>{{ $catObj->name ?? $catSlug }}</span>
                                <a href="{{ route('shop', array_merge(request()->except(['category', 'subcategory', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                            </span>
                        @endforeach
                    @endif

                    @if(request('max_price') && request('max_price') < $dbMaxPrice)
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/40 bg-[#faf7f2] px-2.5 py-0.5 text-xs text-[#1c1210]">
                            <span>bis EUR {{ request('max_price') }}</span>
                            <a href="{{ route('shop', array_merge(request()->except(['max_price', 'page']))) }}" class="font-bold text-[#78000b] hover:text-black cursor-pointer">×</a>
                        </span>
                    @endif

                    <a href="{{ route('shop') }}" class="ml-auto text-xs font-bold uppercase tracking-wider text-[#78000b] hover:underline cursor-pointer" data-i18n-de="ALLE LÖSCHEN" data-i18n-en="CLEAR ALL">
                        ALLE LÖSCHEN
                    </a>
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-12">

                <!-- Sidebar Filters Column (3 cols) -->
                <aside id="filter-sidebar" class="lg:col-span-3 hidden lg:block space-y-4">
                    <form action="{{ route('shop') }}" method="GET" id="shop-filter-form" class="sticky top-24 rounded-md border border-[#e6decb] bg-white p-4 shadow-xs space-y-5">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-2.5">
                            <h2 class="font-display text-base font-medium text-[#1c1210]" data-i18n-de="Filter" data-i18n-en="Filters">Filter</h2>
                            <a href="{{ route('shop') }}" class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b] hover:underline cursor-pointer" data-i18n-de="ZURÜCKSETZEN" data-i18n-en="RESET">ZURÜCKSETZEN</a>
                        </div>

                        <!-- Category & Subcategory Filter from Database -->
                        <div>
                            <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-2.5" data-i18n-de="Kategorie & Unterkategorie" data-i18n-en="Category & Subcategory">Kategorie & Unterkategorie</h3>
                            <div class="space-y-2 text-xs text-[#5c4f46]">
                                @forelse($globalCategories ?? [] as $category)
                                    <div class="space-y-1 border-b border-[#f2ebdc] pb-1.5 last:border-none">
                                        <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] font-medium text-[#1c1210] transition">
                                            <input
                                                type="checkbox"
                                                name="category[]"
                                                value="{{ $category->slug }}"
                                                {{ in_array($category->slug, (array) request('category')) ? 'checked' : '' }}
                                                onchange="document.getElementById('shop-filter-form').submit()"
                                                class="rounded border-[#e6decb] text-[#78000b] focus:ring-0 cursor-pointer"
                                            >
                                            <span>{{ $category->name }}</span>
                                        </label>
                                        @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                                            <div class="ml-4 space-y-1 border-l-2 border-[#d8b45a]/30 pl-2.5 pt-0.5">
                                                @foreach($category->activeSubcategories as $subcat)
                                                    <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] text-[0.7rem] text-[#685c54] transition">
                                                        <input
                                                            type="checkbox"
                                                            name="subcategory[]"
                                                            value="{{ $subcat->slug }}"
                                                            {{ in_array($subcat->slug, (array) request('subcategory')) ? 'checked' : '' }}
                                                            onchange="document.getElementById('shop-filter-form').submit()"
                                                            class="rounded border-[#e6decb] text-[#78000b] focus:ring-0 cursor-pointer"
                                                        >
                                                        <span>{{ $subcat->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-xs text-[#8a7c74]" data-i18n-de="Keine Kategorien vorhanden." data-i18n-en="No categories available.">Keine Kategorien vorhanden.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="border-t border-[#f2ebdc] pt-3.5">
                            <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-2" data-i18n-de="Maximaler Preis" data-i18n-en="Max Price">Maximaler Preis</h3>
                            <input
                                type="range"
                                name="max_price"
                                id="price-range"
                                min="{{ $dbMinPrice ?? 0 }}"
                                max="{{ $dbMaxPrice ?? 1000 }}"
                                step="10"
                                value="{{ request('max_price', $dbMaxPrice ?? 1000) }}"
                                oninput="updatePriceLabel(this.value);"
                                onchange="document.getElementById('shop-filter-form').submit()"
                                class="w-full accent-[#78000b] cursor-pointer"
                            >
                            <div class="mt-1 flex items-center justify-between text-[0.7rem] text-[#685c54]">
                                <span>EUR {{ $dbMinPrice ?? 0 }}</span>
                                <span id="price-max-display" class="font-bold text-[#1c1210]">EUR {{ request('max_price', $dbMaxPrice ?? 1000) }}</span>
                            </div>
                        </div>

                        <!-- Atelier Guarantee Seal -->
                        <div class="rounded border border-[#e6decb] bg-[#faf7f2] p-2.5 text-center">
                            <p class="text-[0.58rem] font-bold uppercase tracking-[0.16em] text-[#78000b]">100% ECHTHEITSGARANTIE</p>
                            <p class="mt-0.5 text-[0.62rem] text-[#685c54]">Zertifiziertes Vollleder & Schweizer Präzision</p>
                        </div>

                    </form>
                </aside>

                <!-- Product Grid Catalog (9 cols) -->
                <main class="lg:col-span-9">
                    <div id="product-container" class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($products as $index => $product)
                            @php
                                $prodPayload = htmlspecialchars(json_encode([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => 'EUR ' . number_format($product->price, 2, ',', '.'),
                                    'sale_price' => ($product->sale_price && $product->sale_price < $product->price) ? 'EUR ' . number_format($product->sale_price, 2, ',', '.') : null,
                                    'image' => $product->image_url,
                                    'category' => $product->category->name ?? 'Exklusiv',
                                    'slug' => $product->slug,
                                    'description' => $product->description,
                                ]), ENT_QUOTES, 'UTF-8');
                                $delayClass = 'reveal-delay-' . ((($index % 3) + 1) * 100);
                            @endphp
                            <!-- Uncluttered Luxury Product Card -->
                            <article
                                class="product-card luxury-card-interactive animate-shine-sweep reveal-on-scroll {{ $delayClass }} group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-1.5 hover:border-[#d8b45a] hover:shadow-[0_12px_30px_rgba(216,180,90,0.18)] cursor-pointer"
                                data-category="{{ $product->category->slug ?? '' }}"
                                data-price="{{ $product->price }}"
                                data-name="{{ $product->name }}"
                            >
                                <!-- Gold Top Border Shimmer -->
                                <div class="absolute inset-x-0 top-0 z-20 h-0.5 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                                <!-- Image Container -->
                                <div class="card-img-wrap relative aspect-[4/3] sm:aspect-square w-full overflow-hidden bg-[#f7f4ee]">
                                    <a href="{{ route('shop.show', $product->slug) }}" class="block h-full w-full">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="lazy">
                                    </a>

                                    @if($product->is_featured)
                                        <div class="absolute left-2.5 top-2.5 z-10 pointer-events-none">
                                            <span class="rounded-xs bg-[#78000b] px-2 py-0.5 text-[0.55rem] font-bold uppercase tracking-luxury text-white shadow-sm">EXKLUSIV</span>
                                        </div>
                                    @endif

                                    <!-- Floating Wishlist Heart -->
                                    <div class="absolute right-2.5 top-2.5 z-10 opacity-0 translate-y-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                                        <button
                                            type="button"
                                            data-wishlist-btn-id="{{ $product->id }}"
                                            onclick="toggleWishlistProduct(JSON.parse(this.dataset.product), this)"
                                            data-product="{{ $prodPayload }}"
                                            class="flex h-7 w-7 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-white/95 text-neutral-700 shadow-sm transition hover:bg-[#78000b] hover:text-white cursor-pointer"
                                            aria-label="Add to wishlist"
                                            title="Wishlist"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Minimal Luxury Card Details -->
                                <div class="card-body-wrap p-3.5 flex flex-col justify-between flex-1 bg-white">
                                    <div>
                                        <p class="text-[0.62rem] font-semibold uppercase tracking-[0.16em] text-[#8a7c74] truncate">
                                            {{ $product->category->name ?? 'Maison Mehaaj' }}
                                        </p>
                                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                            <h3 class="mt-1 font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300 truncate">
                                                {{ $product->name }}
                                            </h3>
                                        </a>
                                    </div>

                                    <!-- Single Clean Action & Price -->
                                    <div class="mt-3 flex items-center justify-between border-t border-[#f5efe4] pt-2.5">
                                        <div class="flex items-baseline gap-1.5">
                                            <span class="text-sm font-bold text-[#1c1210]">
                                                EUR {{ number_format($product->price, 2, ',', '.') }}
                                            </span>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <span class="text-[0.68rem] text-[#8a7c74] line-through">
                                                    EUR {{ number_format($product->sale_price, 2, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>

                                        <button 
                                            onclick="quickAddToCart({{ $product->id }}, 1)" 
                                            class="inline-flex items-center gap-1.5 rounded-sm bg-[#78000b] px-3 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-white shadow-xs transition-all duration-300 hover:bg-[#5a0309] active:scale-95 cursor-pointer" 
                                            type="button" 
                                            title="In den Warenkorb"
                                        >
                                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round"/>
                                                <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round"/>
                                            </svg>
                                            <span data-i18n-de="In den Warenkorb" data-i18n-en="Add to Cart">In den Warenkorb</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full py-12 px-6 text-center bg-white rounded-md border border-[#e6decb] space-y-2">
                                <svg class="mx-auto h-10 w-10 text-[#78000b]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                <h3 class="font-display text-lg text-[#1c1210]" data-i18n-de="Keine Produkte im Katalog gefunden" data-i18n-en="No products found in catalog">Keine Produkte im Katalog gefunden</h3>
                                <p class="text-xs text-[#685c54] max-w-md mx-auto" data-i18n-de="Die ausgewählten Filterkriterien ergaben leider keine Treffer." data-i18n-en="Your filter criteria returned no results.">Die ausgewählten Filterkriterien ergaben leider keine Treffer.</p>
                                <div class="pt-1">
                                    <a href="{{ route('shop') }}" class="inline-flex items-center justify-center rounded-sm bg-[#78000b] px-4 py-2 text-xs font-bold uppercase tracking-wider text-white transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="Alle Filter zurücksetzen" data-i18n-en="Reset All Filters">
                                        Alle Filter zurücksetzen
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Luxury Pagination -->
                    @if($products->hasPages())
                        <div class="mt-8 flex flex-col items-center justify-between gap-3 border-t border-[#e6decb] pt-4 sm:flex-row">
                            <p class="text-xs text-[#685c54]">
                                Zeige <span class="font-bold text-[#1c1210]">{{ $products->firstItem() }}</span> bis <span class="font-bold text-[#1c1210]">{{ $products->lastItem() }}</span> von <span class="font-bold text-[#1c1210]">{{ $products->total() }}</span>
                            </p>

                            <div class="flex items-center gap-1.5">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded border border-[#e6decb] bg-white/50 text-[#c7baa7] cursor-not-allowed">
                                        ‹
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded border border-[#e6decb] bg-white text-[#1c1210] shadow-xs transition hover:border-[#78000b] hover:text-[#78000b] cursor-pointer" rel="prev">
                                        ‹
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <span class="inline-flex h-8 min-w-8 items-center justify-center rounded border border-[#78000b] bg-[#78000b] px-2.5 text-xs font-bold text-white shadow-xs">
                                            {{ $page }}
                                        </span>
                                    @elseif ($page == 1 || $page == $products->lastPage() || abs($page - $products->currentPage()) <= 1)
                                        <a href="{{ $url }}" class="inline-flex h-8 min-w-8 items-center justify-center rounded border border-[#e6decb] bg-white px-2.5 text-xs font-medium text-[#1c1210] shadow-xs transition hover:border-[#d8b45a] hover:text-[#78000b] cursor-pointer">
                                            {{ $page }}
                                        </a>
                                    @elseif (abs($page - $products->currentPage()) == 2)
                                        <span class="inline-flex h-8 w-5 items-center justify-center text-xs text-[#8a7c74]">...</span>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded border border-[#e6decb] bg-white text-[#1c1210] shadow-xs transition hover:border-[#78000b] hover:text-[#78000b] cursor-pointer" rel="next">
                                        ›
                                    </a>
                                @else
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded border border-[#e6decb] bg-white/50 text-[#c7baa7] cursor-not-allowed">
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

    <!-- Schema.org ItemList JSON-LD for Products -->
    @if(isset($products) && $products->count() > 0)
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ItemList",
            "itemListElement": [
                @foreach($products as $i => $item)
                {
                    "@type": "ListItem",
                    "position": {{ $i + 1 }},
                    "item": {
                        "@type": "Product",
                        "name": "{{ addslashes($item->name) }}",
                        "image": "{{ $item->image_url }}",
                        "url": "{{ route('shop.show', $item->slug) }}",
                        "offers": {
                            "@type": "Offer",
                            "priceCurrency": "EUR",
                            "price": "{{ $item->price }}",
                            "availability": "https://schema.org/InStock"
                        }
                    }
                }{{ $loop->last ? '' : ',' }}
                @endforeach
            ]
        }
        </script>
    @endif

    <!-- Client side script for Filtering, Sorting & View toggle -->
    <script>
        function updatePriceLabel(val) {
            document.getElementById('price-max-display').innerText = 'EUR ' + val;
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
            const cards = container.querySelectorAll('.product-card');

            if (mode === 'list') {
                container.classList.remove('sm:grid-cols-2', 'lg:grid-cols-3');
                container.classList.add('grid-cols-1');
                cards.forEach(card => {
                    card.classList.add('md:flex-row');
                    const imgWrap = card.querySelector('.card-img-wrap');
                    if (imgWrap) {
                        imgWrap.classList.remove('w-full', 'aspect-square', 'aspect-[4/3]');
                        imgWrap.classList.add('md:w-60', 'md:h-auto', 'shrink-0');
                    }
                });
                gridBtn.classList.remove('text-[#78000b]', 'bg-[#78000b]/10');
                gridBtn.classList.add('text-[#685c54]');
                listBtn.classList.add('text-[#78000b]', 'bg-[#78000b]/10');
                listBtn.classList.remove('text-[#685c54]');
            } else {
                container.classList.remove('grid-cols-1');
                container.classList.add('sm:grid-cols-2', 'lg:grid-cols-3');
                cards.forEach(card => {
                    card.classList.remove('md:flex-row');
                    const imgWrap = card.querySelector('.card-img-wrap');
                    if (imgWrap) {
                        imgWrap.classList.add('w-full', 'aspect-square');
                        imgWrap.classList.remove('md:w-60', 'md:h-auto', 'shrink-0');
                    }
                });
                gridBtn.classList.add('text-[#78000b]', 'bg-[#78000b]/10');
                gridBtn.classList.remove('text-[#685c54]');
                listBtn.classList.remove('text-[#78000b]', 'bg-[#78000b]/10');
                listBtn.classList.add('text-[#685c54]');
            }
        }

        function toggleMobileFilter() {
            const sidebar = document.getElementById('filter-sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
</div>
@endsection
