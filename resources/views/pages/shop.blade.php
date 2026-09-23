@extends('layouts.app')
@section('title', 'Kollektion & Shop - MEHAAJ Luxury Leather')

@section('content')
<div class="pt-20 bg-[#faf7f2] min-h-screen">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <span class="text-[#1c1210] font-medium" data-i18n-de="Kollektion" data-i18n-en="Collection">Kollektion</span>
        </div>
    </nav>

    <!-- Header Collection Banner -->
    <section class="relative overflow-hidden bg-white py-10 lg:py-14 border-b border-[#e6decb]">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_0%,rgba(216,180,90,0.08),transparent_70%)]"></div>
        <div class="luxury-container relative z-10">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                        <span data-i18n-de="DIE MESTERKOLLEKTION" data-i18n-en="THE MASTER COLLECTION">DIE MEISTERKOLLEKTION</span>
                    </div>
                    <h1 class="mt-3 font-display text-3xl font-medium leading-tight text-[#1c1210] sm:text-4xl lg:text-5xl" data-i18n-de="Alle Produkte" data-i18n-en="All Products">
                        Alle Produkte
                    </h1>
                </div>
                <p class="max-w-md text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-de="Entdecken Sie unsere vollständige Selektion aus edelsten Vollleder-Kreationen, deutsches Design und zeitlose Meisterwerke." data-i18n-en="Discover our complete selection of finest full-grain leather creations, German design, and timeless masterpieces.">
                    Entdecken Sie unsere vollständige Selektion aus edelsten Vollleder-Kreationen, deutsches Design und zeitlose Meisterwerke.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Catalog & Filtering Layout -->
    <section class="py-8 lg:py-12">
        <div class="luxury-container">

            <!-- Control Bar (Filter Toggle, Items Count, Sort, Grid/List Switch) -->
            <div class="mb-8 flex flex-col gap-4 border-b border-[#e6decb] pb-5 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile Filter Toggle Button -->
                    <button
                        type="button"
                        onclick="toggleMobileFilter()"
                        class="inline-flex items-center gap-2 rounded border border-[#e6decb] bg-white px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#1c1210] shadow-xs transition hover:border-[#78000b] hover:text-[#78000b] lg:hidden cursor-pointer"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                        </svg>
                        <span data-i18n-de="FILTER" data-i18n-en="FILTER">FILTER</span>
                    </button>

                    <p class="text-xs text-[#685c54]">
                        <span id="product-count" class="font-bold text-[#1c1210]">8</span> 
                        <span data-i18n-de="Meisterwerke gefunden" data-i18n-en="Masterpieces found">Meisterwerke gefunden</span>
                    </p>
                </div>

                <div class="flex items-center justify-between gap-4 md:justify-end">
                    <!-- Sort Dropdown -->
                    <div class="flex items-center gap-2">
                        <label for="sort-select" class="text-xs font-bold uppercase tracking-wider text-[#685c54] whitespace-nowrap" data-i18n-de="Sortieren:" data-i18n-en="Sort by:">
                            Sortieren:
                        </label>
                        <select
                            id="sort-select"
                            onchange="sortProducts()"
                            class="rounded border border-[#e6decb] bg-white px-3 py-2 text-xs font-medium text-[#1c1210] shadow-xs transition focus:border-[#78000b] focus:outline-none cursor-pointer"
                        >
                            <option value="featured" data-i18n-de="Beliebtheit" data-i18n-en="Featured">Beliebtheit</option>
                            <option value="price-low" data-i18n-de="Preis: Aufsteigend" data-i18n-en="Price: Low to High">Preis: Aufsteigend</option>
                            <option value="price-high" data-i18n-de="Preis: Absteigend" data-i18n-en="Price: High to Low">Preis: Absteigend</option>
                            <option value="newest" data-i18n-de="Neuheiten" data-i18n-en="Newest Arrivals">Neuheiten</option>
                        </select>
                    </div>

                    <!-- Grid vs List View Switcher -->
                    <div class="hidden sm:flex items-center rounded border border-[#e6decb] bg-white p-1 shadow-xs">
                        <button
                            type="button"
                            id="grid-view-btn"
                            onclick="setViewMode('grid')"
                            class="active-view p-1.5 rounded text-[#78000b] bg-[#78000b]/10 transition cursor-pointer"
                            title="Grid View"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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

            <div class="grid gap-8 lg:grid-cols-12">

                <!-- Sidebar Filters Column (3 cols) -->
                <aside id="filter-sidebar" class="lg:col-span-3 hidden lg:block space-y-6">
                    <div class="rounded-md border border-[#e6decb] bg-white p-5 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3">
                            <h2 class="font-display text-lg font-medium text-[#1c1210]" data-i18n-de="Filter" data-i18n-en="Filters">Filter</h2>
                            <button type="button" onclick="resetFilters()" class="text-[0.65rem] font-bold uppercase tracking-wider text-[#78000b] hover:underline cursor-pointer" data-i18n-de="ZURÜCKSETZEN" data-i18n-en="RESET">ZURÜCKSETZEN</button>
                        </div>

                        <!-- Category & Subcategory Filter from Database -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-3" data-i18n-de="Kategorie & Unterkategorie" data-i18n-en="Category & Subcategory">Kategorie & Unterkategorie</h3>
                            <div class="space-y-3 text-xs text-[#5c4f46]">
                                @forelse($globalCategories ?? [] as $category)
                                    <div class="space-y-1.5 border-b border-[#f2ebdc] pb-2 last:border-none">
                                        <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] font-bold text-[#1c1210] transition">
                                            <input type="checkbox" value="{{ $category->slug }}" onchange="applyFilters()" class="category-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                            <span>{{ $category->name }}</span>
                                        </label>
                                        @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                                            <div class="ml-4 space-y-1 border-l-2 border-[#d8b45a]/30 pl-2.5 pt-0.5">
                                                @foreach($category->activeSubcategories as $subcat)
                                                    <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] text-[0.72rem] text-[#685c54] transition">
                                                        <input type="checkbox" value="{{ $subcat->slug }}" onchange="applyFilters()" class="subcategory-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                                        <span>{{ $subcat->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] transition">
                                        <input type="checkbox" value="bags" onchange="applyFilters()" class="category-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                        <span data-i18n-de="Leder Taschen" data-i18n-en="Leather Bags">Leder Taschen</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] transition">
                                        <input type="checkbox" value="wallets" onchange="applyFilters()" class="category-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                        <span data-i18n-de="Geldbörsen & Etuis" data-i18n-en="Wallets & Cardholders">Geldbörsen & Etuis</span>
                                    </label>
                                @endforelse
                            </div>
                        </div>

                        <!-- Leather Type Filter -->
                        <div class="border-t border-[#f2ebdc] pt-5">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-3" data-i18n-de="Lederqualität" data-i18n-en="Leather Type">Lederqualität</h3>
                            <div class="space-y-2 text-xs text-[#5c4f46]">
                                <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] transition">
                                    <input type="checkbox" value="full-grain" onchange="applyFilters()" class="leather-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                    <span data-i18n-de="Italienisches Vollleder" data-i18n-en="Italian Full Grain">Italienisches Vollleder</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] transition">
                                    <input type="checkbox" value="saffiano" onchange="applyFilters()" class="leather-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                    <span data-i18n-de="Saffiano Struktur" data-i18n-en="Saffiano Texture">Saffiano Struktur</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer hover:text-[#78000b] transition">
                                    <input type="checkbox" value="nappa" onchange="applyFilters()" class="leather-filter rounded border-[#e6decb] text-[#78000b] focus:ring-0">
                                    <span data-i18n-de="Weiches Nappa Leder" data-i18n-en="Soft Nappa Leather">Weiches Nappa Leder</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="border-t border-[#f2ebdc] pt-5">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-3" data-i18n-de="Maximaler Preis" data-i18n-en="Max Price">Maximaler Preis</h3>
                            <input
                                type="range"
                                id="price-range"
                                min="50"
                                max="700"
                                step="10"
                                value="700"
                                oninput="updatePriceLabel(this.value); applyFilters();"
                                class="w-full accent-[#78000b] cursor-pointer"
                            >
                            <div class="mt-2 flex items-center justify-between text-xs text-[#685c54]">
                                <span>EUR 50</span>
                                <span id="price-max-display" class="font-bold text-[#1c1210]">EUR 700</span>
                            </div>
                        </div>

                    </div>
                </aside>

                <!-- Product Grid Catalog (9 cols) -->
                <main class="lg:col-span-9">
                    <div id="product-container" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="accessories"
                            data-leather="full-grain"
                            data-price="590"
                            data-name="Maison Chronograph Watch"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="card-img-wrap relative h-60 w-full overflow-hidden bg-[#f7f4ee] transition-all duration-300">
                                <img src="/product_watch.png" alt="Maison Chronograph Watch" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-md animate-pulse">LUXURY</span>
                                </div>
                                <div class="absolute right-3 top-3 z-10 flex flex-col gap-2 opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                                    <button class="flex h-8 w-8 items-center justify-center rounded-full border border-[#e6decb] bg-white text-[#78000b] shadow-md transition hover:bg-[#78000b] hover:text-white cursor-pointer" type="button" onclick="openWishlistModal()" aria-label="Add to wishlist">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body-wrap p-5 flex flex-col justify-between flex-1 bg-white">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Uhren & Lifestyle" data-i18n-en="Watches & Lifestyle">Uhren & Lifestyle</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Maison Chronograph Uhr" data-i18n-en="Maison Chronograph Watch">
                                        Maison Chronograph Uhr
                                    </h3>
                                    <p class="mt-2 text-xs text-[#685c54] font-light leading-relaxed hidden card-desc" data-i18n-de="Schweizer Automatik-Chronograph mit Saphirglas & Lederband." data-i18n-en="Swiss automatic chronograph with sapphire glass & leather strap.">Schweizer Automatik-Chronograph mit Saphirglas & Lederband.</p>
                                </div>
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 590</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 650</span>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Leder Geldbörse Premium" data-i18n-en="Bespoke Zip Leather Wallet">
                                        Leder Geldbörse Premium
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 129</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 149</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 3 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="accessories"
                            data-leather="full-grain"
                            data-price="59"
                            data-name="Executive Leather Key Ring"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/productKeychain.png" alt="Executive Leather Key Ring" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">LIMITED</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Luxus Accessoires" data-i18n-en="Luxury Accessories">Luxus Accessoires</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Executive Schlüsselanhänger" data-i18n-en="Executive Leather Key Ring">
                                        Executive Schlüsselanhänger
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 59</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 4 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="golf"
                            data-leather="full-grain"
                            data-price="450"
                            data-name="Royal Executive Golf Carry"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/productgolf.png" alt="Royal Executive Golf Carry" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">LUXURY</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Golf & Lifestyle" data-i18n-en="Golf & Lifestyle">Golf & Lifestyle</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Royal Golf Executive Carry" data-i18n-en="Royal Executive Golf Carry">
                                        Royal Golf Executive Carry
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 450</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 490</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 5 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="accessories"
                            data-leather="nappa"
                            data-price="249"
                            data-name="Aurelia Satin Evening Dress"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/product_dress.png" alt="Aurelia Satin Evening Dress" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">NEU</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Damen Eleganz" data-i18n-en="Women Elegance">Damen Eleganz</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Aurelia Satin Abendkleid" data-i18n-en="Aurelia Satin Evening Dress">
                                        Aurelia Satin Abendkleid
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 249</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 299</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 6 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="accessories"
                            data-leather="full-grain"
                            data-price="480"
                            data-name="Noir Tailored Coat"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/product_coat.png" alt="Noir Tailored Coat" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">BESTSELLER</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Herren Garderobe" data-i18n-en="Men Outerwear">Herren Garderobe</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Noir Maßmantel" data-i18n-en="Noir Tailored Coat">
                                        Noir Maßmantel
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 480</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 550</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 7 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="bags"
                            data-leather="saffiano"
                            data-price="340"
                            data-name="Champagne Leather Bag"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/product_bag_red.png" alt="Champagne Leather Bag" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">LIMITED</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Leder Taschen" data-i18n-en="Leather Bags">Leder Taschen</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Champagner Lederhandtasche" data-i18n-en="Champagne Leather Bag">
                                        Champagner Lederhandtasche
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 340</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 390</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                        <!-- Product Item 8 -->
                        <article
                            class="product-card animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer"
                            data-category="accessories"
                            data-leather="full-grain"
                            data-price="590"
                            data-name="Maison Chronograph Watch"
                        >
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-60 overflow-hidden bg-[#f7f4ee]">
                                <img src="/product_watch.png" alt="Maison Chronograph Watch" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                <div class="absolute left-3 top-3 z-10">
                                    <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-sm">LUXURY</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-de="Uhren & Lifestyle" data-i18n-en="Watches & Lifestyle">Uhren & Lifestyle</p>
                                        <div class="flex text-[#d8b45a] text-[0.65rem] tracking-wider">★ ★ ★ ★ ★</div>
                                    </div>
                                    <h3 class="mt-2 font-display text-lg font-medium leading-[1.3] text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300" data-i18n-de="Maison Chronograph Uhr" data-i18n-en="Maison Chronograph Watch">
                                        Maison Chronograph Uhr
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#1c1210]">EUR 590</span>
                                        <span class="text-[0.65rem] text-[#8a7c74] line-through">EUR 650</span>
                                    </div>
                                    <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-white shadow-sm transition-all duration-300 hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>

                    </div>
                </main>

            </div>
        </div>
    </section>

    <!-- Client side script for Filtering, Sorting & View toggle -->
    <script>
        function applyFilters() {
            const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked')).map(el => el.value);
            const selectedLeathers = Array.from(document.querySelectorAll('.leather-filter:checked')).map(el => el.value);
            const maxPrice = parseFloat(document.getElementById('price-range').value);

            const cards = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const leather = card.getAttribute('data-leather');
                const price = parseFloat(card.getAttribute('data-price'));

                const matchCategory = selectedCategories.length === 0 || selectedCategories.includes(category);
                const matchLeather = selectedLeathers.length === 0 || selectedLeathers.includes(leather);
                const matchPrice = price <= maxPrice;

                if (matchCategory && matchLeather && matchPrice) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            document.getElementById('product-count').innerText = visibleCount;
        }

        function updatePriceLabel(val) {
            document.getElementById('price-max-display').innerText = 'EUR ' + val;
        }

        function resetFilters() {
            document.querySelectorAll('.category-filter').forEach(el => el.checked = false);
            document.querySelectorAll('.leather-filter').forEach(el => el.checked = false);
            document.getElementById('price-range').value = 700;
            updatePriceLabel(700);
            applyFilters();
        }

        function sortProducts() {
            const val = document.getElementById('sort-select').value;
            const container = document.getElementById('product-container');
            const cards = Array.from(container.children);

            cards.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));

                if (val === 'price-low') return priceA - priceB;
                if (val === 'price-high') return priceB - priceA;
                return 0;
            });

            cards.forEach(card => container.appendChild(card));
        }

        function setViewMode(mode) {
            const container = document.getElementById('product-container');
            const gridBtn = document.getElementById('grid-view-btn');
            const listBtn = document.getElementById('list-view-btn');

            if (mode === 'list') {
                container.classList.remove('sm:grid-cols-2', 'lg:grid-cols-3');
                container.classList.add('grid-cols-1');
                gridBtn.classList.remove('text-[#78000b]', 'bg-[#78000b]/10');
                gridBtn.classList.add('text-[#685c54]');
                listBtn.classList.add('text-[#78000b]', 'bg-[#78000b]/10');
                listBtn.classList.remove('text-[#685c54]');
            } else {
                container.classList.remove('grid-cols-1');
                container.classList.add('sm:grid-cols-2', 'lg:grid-cols-3');
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
