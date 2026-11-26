@extends('layouts.app')

@php
    $effectivePrice = ($product->sale_price && $product->sale_price < $product->price) ? $product->sale_price : $product->price;
    $hasDiscount = ($product->sale_price && $product->sale_price < $product->price);
    $discountPercent = $hasDiscount ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
    $cleanDesc = strip_tags($product->description ?? 'Exquisite MEHAAJ atelier creation crafted from vegetable-tanned full-grain leather with hand-burnished edges.');

    // Build curated unique image list for gallery
    $allImages = collect([$product->image_url]);
    if (!empty($product->gallery_images) && is_array($product->gallery_images)) {
        foreach ($product->gallery_images as $gImg) {
            $imgUrl = str_starts_with($gImg, 'http') ? $gImg : asset('storage/' . $gImg);
            if (!$allImages->contains($imgUrl)) {
                $allImages->push($imgUrl);
            }
        }
    }

    $variationsList = !empty($product->variations) && is_array($product->variations) && count($product->variations) > 0
        ? $product->variations
        : [
            ['name' => 'Cognac Havana', 'color' => '#874c26', 'sku' => ($product->sku ?? 'MHJ') . '-CGN', 'price' => $effectivePrice, 'image' => $product->image_url],
            ['name' => 'Obsidian Noir', 'color' => '#14100e', 'sku' => ($product->sku ?? 'MHJ') . '-BLK', 'price' => $effectivePrice, 'image' => $product->image_url],
        ];

    $firstVar = $variationsList[0] ?? ['name' => 'Standard', 'sku' => $product->sku ?? 'MHJ-' . $product->id];

    // Clean tabs
    $cleanTabs = !empty($product->accordion_tabs) && is_array($product->accordion_tabs) && count($product->accordion_tabs) > 0
        ? $product->accordion_tabs
        : [
            ['title' => 'Description & Craft', 'content' => $product->description ?: 'Handcrafted in our European atelier using vegetable-tanned full-grain leather. Finished with hand-beveled edges, waxed linen saddle stitching, and solid brass hardware designed to age with an exquisite personal patina over decades of use.'],
            ['title' => 'Materials & Details', 'content' => '100% full-grain calfskin leather sourced from Santa Croce sull\'Arno, Tuscany. Chrome-free vegetable tanning. Premium microfiber lining. Scratch-resistant solid metal fittings with protective lacquer.'],
            ['title' => 'Shipping & Guarantee', 'content' => 'Complimentary insured DHL Express courier dispatch with real-time tracking (1–3 business days). Arrives in a MEHAAJ magnetic luxury gift box with dust bag. Includes 30-day effortless returns and a 2-year atelier craftsmanship warranty.'],
        ];
@endphp

@section('title', ($product->name ?? 'Meisterstück') . ' | MEHAAJ® Haute Maroquinerie')
@section('meta_description', Str::limit($cleanDesc, 155))
@section('canonical', route('shop.show', $product->slug))
@section('og_image', $product->image_url)
@section('og_type', 'product')

@push('seo')
    <!-- OpenGraph & Social Meta Product Specifics -->
    <meta property="product:price:amount" content="{{ number_format($effectivePrice, 2, '.', '') }}">
    <meta property="product:price:currency" content="EUR">
    <meta property="product:availability" content="{{ $product->stock > 0 ? 'in stock' : 'out of stock' }}">
    <meta property="product:condition" content="new">
    <meta property="product:brand" content="MEHAAJ">
    <meta property="product:retailer_item_id" content="{{ $product->sku ?? ('MHJ-' . $product->id) }}">

    <!-- Google SEO Schema.org JSON-LD (Product, Offer, AggregateRating, BreadcrumbList) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Product",
                "@id": "{{ route('shop.show', $product->slug) }}#product",
                "name": {{ json_encode($product->name) }},
                "url": "{{ route('shop.show', $product->slug) }}",
                "image": {{ json_encode($allImages->toArray()) }},
                "description": {{ json_encode($cleanDesc) }},
                "sku": "{{ $product->sku ?? ('MHJ-' . $product->id) }}",
                "mpn": "{{ $product->sku ?? ('MHJ-' . $product->id) }}",
                "brand": {
                    "@type": "Brand",
                    "name": "MEHAAJ"
                },
                "manufacturer": {
                    "@type": "Organization",
                    "name": "MEHAAJ Official Maison"
                },
                "offers": {
                    "@type": "Offer",
                    "url": "{{ route('shop.show', $product->slug) }}",
                    "priceCurrency": "EUR",
                    "price": "{{ number_format($effectivePrice, 2, '.', '') }}",
                    "priceValidUntil": "2027-12-31",
                    "itemCondition": "https://schema.org/NewCondition",
                    "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
                    "seller": {
                        "@type": "Organization",
                        "name": "MEHAAJ Official Maison"
                    }
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "{{ $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '5.0' }}",
                    "reviewCount": "{{ max(1, $approvedReviews->count()) }}",
                    "bestRating": "5",
                    "worstRating": "1"
                }
            },
            {
                "@type": "BreadcrumbList",
                "@id": "{{ route('shop.show', $product->slug) }}#breadcrumb",
                "itemListElement": [
                    {
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Maison Home",
                        "item": "{{ url('/') }}"
                    },
                    {
                        "@type": "ListItem",
                        "position": 2,
                        "name": {{ json_encode($product->category->name ?? 'Collection') }},
                        "item": "{{ route('shop', ['category' => $product->category->slug ?? 'all']) }}"
                    },
                    {
                        "@type": "ListItem",
                        "position": 3,
                        "name": {{ json_encode($product->name) }},
                        "item": "{{ route('shop.show', $product->slug) }}"
                    }
                ]
            }
        ]
    }
    </script>
@endpush

@php
    $catTranslations = [
        'luxury-handbags' => 'Luxus-Handtaschen',
        'leather-wallets' => 'Leder-Geldbörsen',
        'travel-luggage' => 'Reisegepäck',
        'executive-briefcases' => 'Business-Aktentaschen',
        'luxury-jewelry-watches' => 'Schmuck & Uhren',
        'golf-collection' => 'Golf-Kollektion',
        'signature-keychains' => 'Schlüsselanhänger',
    ];

    $tabTranslations = [
        'Description & Craft' => 'Beschreibung & Handwerk',
        'Materials & Details' => 'Materialien & Details',
        'Shipping & Guarantee' => 'Versand & Garantie',
    ];
@endphp

@section('content')
<style>
    .zoom-container {
        position: relative;
        overflow: hidden;
        cursor: crosshair;
    }
    .zoom-container img#main-product-image {
        transition: transform 0.12s ease-out;
        will-change: transform;
    }
    .thumb-btn.active-thumb {
        border-color: #78000b !important;
        box-shadow: 0 0 0 2px rgba(120, 0, 11, 0.35);
        opacity: 1 !important;
    }
    .var-pill.active-var {
        border-color: #78000b !important;
        background-color: #f5eee4 !important;
        box-shadow: 0 0 0 2px rgba(120, 0, 11, 0.25);
    }
    .detail-tab.active-tab {
        color: #78000b !important;
        border-bottom-color: #78000b !important;
        font-weight: 700 !important;
    }
</style>

<div class="bg-[#f8f5ef] text-[#1c1210] min-h-screen">

    <!-- Clean Breadcrumb Strip -->
    <div class="border-b border-[#dfd6c4] bg-[#f4efe5] py-2 text-xs">
        <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6 flex items-center justify-between gap-4">
            <nav class="flex items-center gap-2 text-[0.7rem] text-[#6b5f56] truncate">
                <a href="{{ route('home') }}" class="hover:text-[#78000b] transition"><span data-i18n-en="Home" data-i18n-de="Startseite">Home</span></a>
                <span class="text-[#c7baa7]">/</span>
                <a href="{{ route('shop') }}" class="hover:text-[#78000b] transition"><span data-i18n-en="Shop" data-i18n-de="Boutique">Shop</span></a>
                @if($product->category)
                    <span class="text-[#c7baa7]">/</span>
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-[#78000b] transition">
                        <span data-i18n-en="{{ $product->category->name }}" data-i18n-de="{{ $catTranslations[$product->category->slug] ?? $product->category->name }}">{{ $product->category->name }}</span>
                    </a>
                @endif
                @if($product->subcategory)
                    <span class="text-[#c7baa7]">/</span>
                    <a href="{{ route('shop', ['category' => $product->category->slug ?? '', 'subcategory' => $product->subcategory->slug]) }}" class="hover:text-[#78000b] transition">
                        <span>{{ $product->subcategory->name }}</span>
                    </a>
                @endif
                <span class="text-[#c7baa7] hidden sm:inline">/</span>
                <span class="text-[#1c1210] font-semibold truncate hidden sm:inline max-w-xs">{{ $product->name }}</span>
            </nav>

            <a href="{{ route('shop') }}" class="text-[0.68rem] font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007] transition shrink-0">
                ← <span data-i18n-en="Back to Shop" data-i18n-de="Zurück zur Boutique">Back to Shop</span>
            </a>
        </div>
    </div>

    <!-- Product Hero Showcase: Balanced & Compact Layout -->
    <section class="py-5 sm:py-7 border-b border-[#dfd6c4]">
        <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
            <div class="grid gap-6 lg:gap-8 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Compact Image Gallery (5 cols on lg) -->
                <div class="lg:col-span-5 flex flex-col gap-2.5">
                    <!-- Main Image Display Container (Strictly Capped Height) -->
                    <div class="relative overflow-hidden rounded-xl border border-[#d9cebc] bg-[#faf7f2] shadow-[0_4px_20px_rgba(28,18,16,0.06)] group">
                        <!-- Top Gold Shimmer Border -->
                        <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-gradient-to-r from-[#78000b] via-[#ffd45a] to-[#78000b] transition-transform duration-500 group-hover:scale-x-100"></div>

                        <!-- Top Badges -->
                        <div class="absolute left-3 top-3 z-20 flex flex-col gap-1.5 pointer-events-none">
                            @if($product->is_featured)
                                <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.56rem] font-bold uppercase tracking-[0.16em] text-white shadow-xs" data-i18n-en="Atelier" data-i18n-de="Atelier">
                                    Atelier
                                </span>
                            @endif
                            @if($hasDiscount)
                                <span class="rounded bg-[#d8b45a] px-2 py-0.5 text-[0.56rem] font-bold uppercase tracking-[0.16em] text-[#120807] shadow-xs font-mono">
                                    -{{ $discountPercent }}%
                                </span>
                            @endif
                        </div>

                        <!-- Main Image with Compact Height & Smooth Cursor Lens Zoom -->
                        <div
                            id="zoom-lens-container"
                            class="zoom-container relative w-full h-[320px] sm:h-[350px] lg:h-[380px] flex items-center justify-center overflow-hidden select-none bg-[#f5f0e8]"
                            onmousemove="handleImageZoom(event)"
                            onmouseleave="resetImageZoom()"
                            onclick="openFullscreenLightbox()"
                        >
                            <img
                                id="main-product-image"
                                src="{{ $allImages[0] }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover origin-center transition-opacity duration-200"
                                fetchpriority="high"
                            >
                        </div>

                        <!-- Fullscreen Trigger Button -->
                        <div class="absolute right-3 bottom-3 z-20 flex items-center gap-2">
                            <span class="hidden sm:inline-block rounded-full bg-black/60 backdrop-blur-md px-2.5 py-0.5 text-[0.56rem] uppercase tracking-wider text-white/90" data-i18n-en="Hover to Zoom" data-i18n-de="Zeigen zum Zoomen">
                                Hover to Zoom
                            </span>
                            <button
                                type="button"
                                onclick="openFullscreenLightbox()"
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-white/95 text-[#78000b] backdrop-blur-md border border-[#d8b45a]/60 shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white cursor-pointer"
                                aria-label="Fullscreen zoom"
                                title="Fullscreen Gallery"
                                data-i18n-title-en="Fullscreen Gallery"
                                data-i18n-title-de="Vollbild-Galerie"
                                data-i18n-aria-en="Fullscreen zoom"
                                data-i18n-aria-de="Vollbild-Zoom"
                            >
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Clean Thumbnail Row: Compact 58px Size -->
                    @if($allImages->count() > 1)
                        <div class="flex items-center gap-2 overflow-x-auto pt-0.5 pb-0.5 scrollbar-none" id="gallery-thumbs-row">
                            @foreach($allImages as $index => $imgSrc)
                                <button
                                    type="button"
                                    onclick="switchMainImage('{{ $imgSrc }}', this, {{ $index }})"
                                    class="thumb-btn relative shrink-0 overflow-hidden rounded-lg border-2 transition-all duration-200 hover:opacity-100 cursor-pointer bg-[#f5f0e8] {{ $index === 0 ? 'active-thumb border-[#78000b]' : 'border-[#d9cebc] opacity-75 hover:border-[#78000b]' }}"
                                    style="width: 58px; height: 58px;"
                                    data-thumb-index="{{ $index }}"
                                    aria-label="Photo {{ $index + 1 }}"
                                >
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }} thumb {{ $index + 1 }}" class="h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Column: Product Info & Buy Box (7 cols on lg) -->
                <div class="lg:col-span-7 flex flex-col justify-between rounded-xl border border-[#d9cebc] bg-white p-5 sm:p-6 shadow-[0_4px_20px_rgba(28,18,16,0.04)]">
                    <div>
                        <!-- Category Eyebrow & Social Proof -->
                        <div class="flex items-center justify-between gap-3 border-b border-[#f0e7d8] pb-2.5">
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b] flex items-center flex-wrap gap-1">
                                @if($product->category)
                                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:underline hover:text-[#500007] transition" data-i18n-en="{{ $product->category->name }}" data-i18n-de="{{ $catTranslations[$product->category->slug] ?? $product->category->name }}">{{ $product->category->name }}</a>
                                    @if($product->subcategory)
                                        <span class="text-[#c7baa7] font-normal">/</span>
                                        <a href="{{ route('shop', ['category' => $product->category->slug, 'subcategory' => $product->subcategory->slug]) }}" class="text-[#8a7c74] hover:text-[#78000b] hover:underline transition">{{ $product->subcategory->name }}</a>
                                    @endif
                                @else
                                    <span data-i18n-en="HAUTE MAROQUINERIE" data-i18n-de="HAUTE MAROQUINERIE">HAUTE MAROQUINERIE</span>
                                @endif
                            </span>

                            @php
                                $approvedReviewsList = $approvedReviews ?? collect();
                                $reviewCount = $approvedReviewsList->count();
                                $avgRating = $reviewCount > 0 ? round($approvedReviewsList->avg('rating'), 1) : 5.0;
                            @endphp
                            <a href="#reviews-section" class="flex items-center gap-1.5 text-xs text-[#685c54] hover:text-[#78000b] transition">
                                <span class="text-[#d8b45a] tracking-wider text-[0.7rem]">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                                    @endfor
                                </span>
                                <span class="font-bold text-[#1c1210]">{{ number_format($avgRating, 1) }}</span>
                                <span class="text-[#8a7c74] text-[0.65rem]">({{ $reviewCount }} <span data-i18n-en="reviews" data-i18n-de="Bewertungen">reviews</span>)</span>
                            </a>
                        </div>

                        <!-- Product Title -->
                        <h1 class="mt-2.5 font-display text-2xl sm:text-3xl font-medium leading-tight text-[#1c1210] tracking-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- SKU & Stock -->
                        <div class="mt-2 flex items-center gap-2 text-xs text-[#685c54]">
                            <span>SKU: <strong id="product-sku-display" class="font-mono text-[#1c1210]">{{ $firstVar['sku'] ?? ($product->sku ?? 'MHJ-' . $product->id) }}</strong></span>
                            <span class="text-[#c7baa7]">•</span>
                            @if($product->stock > 0)
                                <span id="product-stock-badge" class="inline-flex items-center gap-1.5 font-semibold text-[#2e683a] text-xs">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#2e683a] animate-pulse"></span>
                                    <span data-i18n-en="In Stock • Dispatches via DHL Express" data-i18n-de="Auf Lager • Versand per DHL Express">In Stock • Dispatches via DHL Express</span>
                                </span>
                            @else
                                <span id="product-stock-badge" class="inline-flex items-center gap-1.5 font-semibold text-[#b45309] text-xs">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#b45309]"></span>
                                    <span data-i18n-en="Sold Out • Join Atelier Waitlist" data-i18n-de="Derzeit vergriffen • Auf Warteliste vormerken">Sold Out • Join Atelier Waitlist</span>
                                </span>
                            @endif
                        </div>

                        <!-- Clean Price Display -->
                        @php
                            $currConv = currency_convert($effectivePrice);
                            $currCode = session('currency', 'EUR');
                        @endphp
                        <div class="mt-3.5 flex items-baseline gap-3 flex-wrap">
                            <span id="product-price-display" class="font-sans text-2xl sm:text-3xl font-bold text-[#1c1210]">
                                {{ $currConv['formatted'] }}
                            </span>
                            @if($currCode !== 'EUR')
                                <span class="text-xs text-[#8a7c74] font-mono">
                                    (ca. €{{ number_format($effectivePrice, 2, '.', ',') }})
                                </span>
                            @endif
                            @if($hasDiscount)
                                <span class="text-sm text-[#8a7c74] line-through font-mono">
                                    {{ currency_format($product->price) }}
                                </span>
                                <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.62rem] font-bold uppercase tracking-wider text-white">
                                    <span data-i18n-en="SAVE" data-i18n-de="SPAREN">SAVE</span> {{ currency_format($product->price - $product->sale_price) }}
                                </span>
                            @endif
                        </div>

                        <!-- Interactive Real-Image Color Variations -->
                        <div class="mt-4 pt-3.5 border-t border-[#f0e7d8]">
                            <div class="flex items-center justify-between mb-2 text-xs">
                                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210]">
                                    <span data-i18n-en="Finish:" data-i18n-de="Ausführung:">Finish:</span> <strong id="active-variation-name" class="text-[#78000b]">{{ $firstVar['name'] ?? 'Cognac Havana' }}</strong>
                                </span>
                                <span class="text-[0.62rem] text-[#8a7c74] uppercase" data-i18n-en="Tuscan Leather" data-i18n-de="Toskanisches Leder">Tuscan Leather</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-2" id="variations-container">
                                @foreach($variationsList as $vIdx => $vItem)
                                    @php
                                        $vName = $vItem['name'] ?? 'Standard';
                                        $vColor = $vItem['color'] ?? '#874c26';
                                        $vSku = $vItem['sku'] ?? ($product->sku . '-' . $vIdx);
                                        $vPrice = !empty($vItem['price']) ? (float)$vItem['price'] : $effectivePrice;
                                        $vImg = !empty($vItem['image']) ? (str_starts_with($vItem['image'], 'http') ? $vItem['image'] : asset('storage/' . $vItem['image'])) : $product->image_url;
                                        $isFirst = ($vIdx === 0);
                                    @endphp
                                    <button
                                        type="button"
                                        onclick="selectColorVariation('{{ addslashes($vName) }}', '{{ $vSku }}', {{ $vPrice }}, '{{ $vImg }}', this)"
                                        class="var-pill group relative flex items-center gap-2 rounded-full border px-3 py-1.5 transition-all duration-200 cursor-pointer shadow-2xs {{ $isFirst ? 'active-var border-[#78000b]' : 'border-[#d9cebc] bg-[#faf8f5] hover:border-[#78000b]' }}"
                                        data-name="{{ $vName }}"
                                        data-sku="{{ $vSku }}"
                                    >
                                        <span class="h-3.5 w-3.5 rounded-full ring-1 ring-black/20 shrink-0" style="background-color: {{ $vColor }};"></span>
                                        <span class="text-xs font-medium text-[#1c1210]">{{ $vName }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quantity Selector & Action CTA Buttons -->
                        <div class="mt-5 flex flex-col gap-2.5 sm:flex-row sm:items-center">
                            <!-- Quantity Counter -->
                            <div class="flex h-11 items-center rounded-lg border border-[#d9cebc] bg-[#faf7f2] px-3 w-28 justify-between shadow-2xs">
                                <button type="button" onclick="adjustProductQty(-1)" class="h-7 w-7 flex items-center justify-center font-bold text-sm text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer" aria-label="Decrease quantity">-</button>
                                <span id="qty-count-display" class="font-bold text-xs text-[#1c1210]">1</span>
                                <button type="button" onclick="adjustProductQty(1)" class="h-7 w-7 flex items-center justify-center font-bold text-sm text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer" aria-label="Increase quantity">+</button>
                            </div>

                            @if($product->stock > 0)
                                <!-- Primary Add to Cart Button -->
                                <button
                                    type="button"
                                    id="add-to-cart-primary"
                                    onclick="submitAddToCart()"
                                    class="animate-shine-sweep group/btn flex-1 flex h-11 items-center justify-center gap-2 rounded-lg bg-[#78000b] px-5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md transition-all duration-200 hover:bg-[#500007] hover:shadow-lg active:scale-98 cursor-pointer"
                                >
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                                        <line x1="3" y1="6" x2="21" y2="6"/>
                                        <path d="M16 10a4 4 0 01-8 0"/>
                                    </svg>
                                    <span data-i18n-en="ADD TO CART" data-i18n-de="IN DEN WARENKORB">ADD TO CART</span>
                                </button>
                            @else
                                <!-- Sold Out - Notify When Available Button -->
                                <button
                                    type="button"
                                    id="waitlist-trigger-btn"
                                    onclick="openWaitlistModal()"
                                    class="flex-1 flex h-11 items-center justify-center gap-2 rounded-lg bg-[#1c1210] px-5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md transition-all duration-200 hover:bg-[#382622] hover:shadow-lg active:scale-98 cursor-pointer border border-[#d8b45a]/40"
                                >
                                    <svg class="h-4 w-4 text-[#d8b45a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <span data-i18n-en="Sold Out – Notify When Available" data-i18n-de="Ausverkauft – Benachrichtigen">Ausverkauft – Benachrichtigen</span>
                                </button>
                            @endif

                            <!-- Wishlist Toggle Button -->
                            @php
                                $prodPayload = htmlspecialchars(json_encode([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => '€' . number_format($effectivePrice, 2, '.', ','),
                                    'sale_price' => $hasDiscount ? '€' . number_format($product->sale_price, 2, '.', ',') : null,
                                    'image' => $product->image_url,
                                    'category' => $product->category->name ?? 'Luxury',
                                    'slug' => $product->slug,
                                ]), ENT_QUOTES, 'UTF-8');
                            @endphp
                            @php
                                $isFav = in_array($product->id, $wishlistProductIds ?? []);
                            @endphp
                            <button
                                type="button"
                                data-wishlist-btn-id="{{ $product->id }}"
                                onclick="window.toggleWishlist({{ $product->id }}, this); toggleWishlistProduct(JSON.parse(this.dataset.product), this);"
                                data-product="{{ $prodPayload }}"
                                class="h-11 w-11 flex items-center justify-center rounded-lg border border-[#d9cebc] bg-[#faf8f5] {{ $isFav ? 'text-[#78000b] bg-[#78000b]/10' : 'text-[#78000b]' }} shadow-2xs transition-all duration-200 hover:bg-[#78000b] hover:text-white cursor-pointer shrink-0"
                                title="Save to Wishlist"
                                aria-label="Wishlist"
                                data-i18n-title-en="Save to Wishlist"
                                data-i18n-title-de="Auf Wunschliste speichern"
                                data-i18n-aria-en="Wishlist"
                                data-i18n-aria-de="Wunschliste"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- 3 Compact Inline Trust Badges (No giant boxes!) -->
                        <div class="mt-5 grid grid-cols-3 gap-2 border-t border-[#f0e7d8] pt-4 text-center text-[0.62rem] text-[#5c4f46]">
                            <div class="flex flex-col items-center gap-0.5">
                                <span class="font-bold text-[#1c1210]" data-i18n-en="100% Full-Grain" data-i18n-de="100% Vollnarbenleder">100% Full-Grain</span>
                                <span class="text-[0.58rem] text-[#8a7c74]" data-i18n-en="Tuscan Tannery" data-i18n-de="Toskanische Gerberei">Tuscan Tannery</span>
                            </div>
                            <div class="flex flex-col items-center gap-0.5 border-x border-[#dfd6c4]">
                                <span class="font-bold text-[#1c1210]" data-i18n-en="2-Year Warranty" data-i18n-de="2 Jahre Garantie">2-Year Warranty</span>
                                <span class="text-[0.58rem] text-[#8a7c74]" data-i18n-en="Atelier Care" data-i18n-de="Atelier-Pflege">Atelier Care</span>
                            </div>
                            <div class="flex flex-col items-center gap-0.5">
                                <span class="font-bold text-[#1c1210]" data-i18n-en="Free DHL Express" data-i18n-de="Gratis DHL Express">Free DHL Express</span>
                                <span class="text-[0.58rem] text-[#8a7c74]" data-i18n-en="1–3 Days Insured" data-i18n-de="1–3 Tage versichert">1–3 Days Insured</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Clean, Non-Clumsy Tabs Section (No Horizontal Scrollbars!) -->
    <section class="py-8 sm:py-10 border-b border-[#dfd6c4]">
        <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
            <!-- Sleek Tab Switcher Bar -->
            <div class="flex items-center justify-center border-b border-[#dfd6c4] gap-6 sm:gap-10 pb-0.5">
                @foreach($cleanTabs as $tIdx => $tab)
                    <button
                        type="button"
                        onclick="switchDetailTab({{ $tIdx }})"
                        class="detail-tab pb-3 text-xs sm:text-sm uppercase tracking-wider text-[#685c54] border-b-2 border-transparent transition-all duration-200 hover:text-[#78000b] cursor-pointer {{ $tIdx === 0 ? 'active-tab' : '' }}"
                        data-tab-index="{{ $tIdx }}"
                    >
                        <span data-i18n-en="{{ $tab['title'] ?? 'Tab ' . ($tIdx + 1) }}" data-i18n-de="{{ $tabTranslations[$tab['title'] ?? ''] ?? ($tab['title'] ?? 'Tab ' . ($tIdx + 1)) }}">
                            {{ $tab['title'] ?? 'Tab ' . ($tIdx + 1) }}
                        </span>
                    </button>
                @endforeach
            </div>

            <!-- Tab Content (Airy, Minimalist & Readable) -->
            <div class="mt-5 rounded-xl border border-[#d9cebc] bg-white p-5 sm:p-7 shadow-[0_2px_12px_rgba(28,18,16,0.03)]">
                @foreach($cleanTabs as $tIdx => $tab)
                    <div id="detail-panel-{{ $tIdx }}" class="tab-panel {{ $tIdx === 0 ? 'block' : 'hidden' }} space-y-3">
                        <p class="text-xs sm:text-sm text-[#5c4f46] leading-relaxed max-w-3xl">
                            {!! $tab['content'] ?? '' !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Curated "Frequently Bought Together" / "Bundle & Save" Section -->
    @if(isset($activeDeal) && $activeDeal && $activeDeal->products->count() >= 2)
        <section class="py-8 sm:py-10 border-b border-[#dfd6c4] bg-[#faf7f2]">
            <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
                
                <div class="rounded-2xl border border-[#d9cebc] bg-white p-6 sm:p-8 shadow-xs">
                    
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#f2ebdc] pb-4 mb-6">
                        <div>
                            <div class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#78000b]">
                                <span>{{ $activeDeal->formatted_badge }}</span>
                            </div>
                            <h2 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210] mt-0.5" data-i18n-en="Frequently Paired Together" data-i18n-de="Häufig zusammen gekauft">
                                Häufig zusammen gekauft
                            </h2>
                        </div>
                        @if($activeDeal->savings_amount > 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span>Sparen Sie {{ number_format($activeDeal->savings_amount, 2, ',', '.') }} € als Set</span>
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                        
                        <!-- Left: Bundled Items Cards (8 Cols) -->
                        <div class="lg:col-span-8 flex flex-wrap sm:flex-nowrap items-center gap-3">
                            @foreach($activeDeal->products as $bundleP)
                                <div class="flex-1 min-w-[200px] p-3.5 rounded-xl border {{ $bundleP->id === $product->id ? 'border-[#78000b] bg-[#fbf6f4]' : 'border-[#e6decb] bg-[#faf7f2]' }} flex items-center gap-3">
                                    <img src="{{ $bundleP->image_url }}" alt="{{ $bundleP->name }}" class="w-16 h-16 rounded-lg border border-[#e6decb] object-cover bg-white shrink-0 shadow-2xs">
                                    <div class="flex-1 min-w-0">
                                        @if($bundleP->id === $product->id)
                                            <span class="text-[0.58rem] font-bold uppercase tracking-wider text-[#78000b] block">Dieser Artikel</span>
                                        @endif
                                        <h3 class="font-display text-xs font-medium text-[#1c1210] truncate">{{ $bundleP->name }}</h3>
                                        <div class="mt-1 flex items-baseline gap-1.5">
                                            <span class="text-xs font-bold text-[#1c1210]">
                                                {{ number_format(($bundleP->sale_price ?: $bundleP->price), 2, ',', '.') }} €
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if(!$loop->last)
                                    <div class="h-8 w-8 rounded-full bg-[#1c1210] text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        +
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Right: Price & 1-Click Buy (4 Cols) -->
                        <div class="lg:col-span-4 rounded-xl border border-[#e6decb] bg-[#faf7f2] p-5 space-y-3">
                            <div>
                                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#685c54] block">Set-Vorzugspreis</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="font-display text-2xl font-bold text-[#78000b]">
                                        EUR {{ number_format($activeDeal->bundle_price, 2, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-[#8a7c74] line-through">
                                        EUR {{ number_format($activeDeal->regular_total, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <button
                                type="button"
                                onclick="addCuratedBundleToBag({{ $activeDeal->id }}, this)"
                                class="w-full h-11 flex items-center justify-center gap-2 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-md transition-all active:scale-95 cursor-pointer"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span data-i18n-en="ADD BUNDLE TO BAG" data-i18n-de="SET IN DEN WARENKORB">SET IN DEN WARENKORB</span>
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </section>
    @endif

    <!-- Maison Client Reviews & Testimonials Section -->
    <section id="reviews-section" class="py-10 sm:py-14 border-t border-[#dfd6c4] bg-[#faf7f2]/50">
        <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#dfd6c4] pb-5 mb-8">
                <div>
                    <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-en="CLIENT EXPERIENCES" data-i18n-de="KUNDENERFAHRUNGEN">KUNDENERFAHRUNGEN</span>
                    <h2 class="font-display text-2xl sm:text-3xl font-medium text-[#1c1210] mt-1" data-i18n-en="Patron Reviews & Atelier Impressions" data-i18n-de="Kundenbewertungen & Atelier-Eindrücke">
                        Kundenbewertungen & Atelier-Eindrücke
                    </h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="text-[#d8b45a] text-lg">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= round($avgRating) ? '★' : '☆' }}
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-[#1c1210]">{{ number_format($avgRating, 1) }} / 5.0</span>
                        <span class="text-xs text-[#8a7c74]">({{ $reviewCount }})</span>
                    </div>
                    <button
                        type="button"
                        onclick="toggleReviewForm()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-sm transition active:scale-95 cursor-pointer"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        <span data-i18n-en="WRITE A REVIEW" data-i18n-de="BEWERTUNG SCHREIBEN">BEWERTUNG SCHREIBEN</span>
                    </button>
                </div>
            </div>

            <!-- Review Submission Drawer -->
            <div id="review-submission-drawer" class="hidden mb-10 overflow-hidden rounded-2xl border border-[#d9cebc] bg-white p-6 sm:p-8 shadow-sm">
                <div class="max-w-2xl mx-auto">
                    <div class="flex items-center justify-between border-b border-[#f0e7d8] pb-3 mb-6">
                        <div>
                            <h3 class="font-display text-lg font-medium text-[#1c1210]" data-i18n-en="Share Your Atelier Experience" data-i18n-de="Teilen Sie Ihre Atelier-Erfahrung">
                                Teilen Sie Ihre Atelier-Erfahrung
                            </h3>
                            <p class="text-xs text-[#8a7c74] mt-0.5" data-i18n-en="Your verified feedback helps fellow connoisseurs appreciate our craftsmanship." data-i18n-de="Ihr Feedback hilft Kennern, unsere Handwerkskunst wertzuschätzen.">
                                Ihr Feedback hilft Kennern, unsere Handwerkskunst wertzuschätzen.
                            </p>
                        </div>
                        <button type="button" onclick="toggleReviewForm()" class="text-[#8a7c74] hover:text-[#1c1210] p-1 text-sm">✕</button>
                    </div>

                    <form id="product-review-form" onsubmit="submitProductReview(event)" class="space-y-4">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Rating Picker -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1.5" data-i18n-en="YOUR RATING" data-i18n-de="IHRE BEWERTUNG">IHRE BEWERTUNG</label>
                            <div class="flex items-center gap-2" id="star-rating-selector">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setFormRating({{ $i }})" class="star-btn text-2xl text-[#d8b45a] hover:scale-110 transition cursor-pointer" data-star="{{ $i }}">★</button>
                                @endfor
                                <input type="hidden" name="rating" id="review-form-rating" value="5">
                                <span id="rating-label" class="text-xs font-semibold text-[#78000b] ml-2">5 Sterne (Hervorragend)</span>
                            </div>
                        </div>

                        <!-- Name & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1" data-i18n-en="YOUR NAME *" data-i18n-de="IHR NAME *">IHR NAME *</label>
                                <input type="text" name="customer_name" required placeholder="z. B. Dr. Heinrich von Kleist" class="w-full h-10 px-3 rounded-lg border border-[#d9cebc] text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1" data-i18n-en="EMAIL ADDRESS *" data-i18n-de="E-MAIL-ADRESSE *">E-MAIL-ADRESSE *</label>
                                <input type="email" name="customer_email" required placeholder="heinrich@adelsbrief.de" class="w-full h-10 px-3 rounded-lg border border-[#d9cebc] text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none">
                            </div>
                        </div>

                        <!-- Location & Title -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1" data-i18n-en="LOCATION (OPTIONAL)" data-i18n-de="STANDORT / STADT">STANDORT / STADT</label>
                                <input type="text" name="location" placeholder="z. B. Frankfurt am Main, DE" class="w-full h-10 px-3 rounded-lg border border-[#d9cebc] text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1" data-i18n-en="REVIEW HEADLINE" data-i18n-de="ÜBERSCHRIFT">ÜBERSCHRIFT</label>
                                <input type="text" name="title" placeholder="z. B. Vollendete Handwerkskunst" class="w-full h-10 px-3 rounded-lg border border-[#d9cebc] text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none">
                            </div>
                        </div>

                        <!-- Review Text -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#685c54] mb-1" data-i18n-en="YOUR REVIEW *" data-i18n-de="IHRE REZENSION *">IHRE REZENSION *</label>
                            <textarea name="comment" rows="4" required placeholder="Beschreiben Sie die Lederqualität, Verarbeitung, Tragekomfort..." class="w-full p-3 rounded-lg border border-[#d9cebc] text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"></textarea>
                        </div>

                        <div id="review-form-alert" class="hidden text-xs p-3 rounded-lg"></div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <button type="button" onclick="toggleReviewForm()" class="px-4 py-2 text-xs font-semibold text-[#8a7c74] hover:text-[#1c1210]">Abbrechen</button>
                            <button type="submit" id="review-submit-btn" class="h-10 px-6 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-md transition active:scale-95 cursor-pointer">
                                Rezension Einreichen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reviews List Grid -->
            @if($approvedReviewsList->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($approvedReviewsList as $rev)
                        <div class="flex flex-col justify-between rounded-xl border border-[#d9cebc] bg-white p-5 shadow-2xs hover:border-[#d8b45a] transition-all">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <div class="text-[#d8b45a] text-sm tracking-wider">
                                        @for($s = 1; $s <= 5; $s++)
                                            {{ $s <= $rev->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                    @if($rev->is_verified)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-semibold bg-[#2e683a]/10 text-[#2e683a] border border-[#2e683a]/20">
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            <span data-i18n-en="Verified Buyer" data-i18n-de="Verifizierter Käufer">Verifizierter Käufer</span>
                                        </span>
                                    @endif
                                </div>

                                @if($rev->title)
                                    <h4 class="font-display text-sm font-semibold text-[#1c1210] mb-1.5">{{ $rev->title }}</h4>
                                @endif

                                <p class="text-xs text-[#5c4e46] leading-relaxed line-clamp-4">{{ $rev->comment }}</p>
                            </div>

                            <div class="pt-4 mt-4 border-t border-[#f0e7d8] flex items-center justify-between text-[0.68rem] text-[#8a7c74]">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-5 h-5 rounded-full bg-[#f0e7d8] text-[#78000b] flex items-center justify-center font-bold text-[0.6rem]">
                                        {{ strtoupper(substr($rev->customer_name, 0, 1)) }}
                                    </span>
                                    <span class="font-semibold text-[#1c1210]">{{ $rev->customer_name }}</span>
                                    @if($rev->location)
                                        <span class="text-[#c7baa7]">•</span>
                                        <span>{{ $rev->location }}</span>
                                    @endif
                                </div>
                                <span>{{ $rev->created_at ? $rev->created_at->format('d. M Y') : 'Kürzlich' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-[#d9cebc] bg-white p-8 text-center max-w-md mx-auto">
                    <div class="w-12 h-12 rounded-full bg-[#faf7f2] border border-[#d9cebc] flex items-center justify-center mx-auto mb-3 text-[#d8b45a] text-xl">★</div>
                    <h3 class="font-display text-base font-medium text-[#1c1210]" data-i18n-en="Be the first to review" data-i18n-de="Seien Sie der Erste, der bewertet">
                        Seien Sie der Erste, der bewertet
                    </h3>
                    <p class="text-xs text-[#8a7c74] mt-1 mb-4" data-i18n-en="Share your atelier impressions with fellow patrons." data-i18n-de="Teilen Sie Ihre Eindrücke mit anderen Kennern des Hauses.">
                        Teilen Sie Ihre Eindrücke mit anderen Kennern des Hauses.
                    </p>
                    <button type="button" onclick="toggleReviewForm()" class="px-4 py-2 rounded-lg bg-[#78000b] text-white text-xs font-bold uppercase tracking-wider shadow-sm hover:bg-[#5a0309] transition">
                        Erste Bewertung Verfassen
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Curated Recommendations Grid -->

    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-8 sm:py-10">
            <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between border-b border-[#dfd6c4] pb-2.5 mb-5">
                    <h2 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]" data-i18n-en="You May Also Admire" data-i18n-de="Das könnte Ihnen auch gefallen">
                        You May Also Admire
                    </h2>
                    <a href="{{ route('shop') }}" class="text-xs font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007]">
                        <span data-i18n-en="View Collection →" data-i18n-de="Zur Kollektion →">View Collection →</span>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                    @foreach($relatedProducts as $rel)
                        @php
                            $relImg = $rel->image_url;
                            $relHoverImg = $rel->hover_image_url ?? $relImg;
                            $relPrice = '€' . number_format($rel->price, 2, '.', ',');
                            $relUrl = route('shop.show', $rel->slug);
                        @endphp
                        <article
                            onclick="window.location.assign('{{ $relUrl }}')"
                            class="group relative flex flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-white shadow-2xs hover:shadow-md hover:border-[#d8b45a] transition-all duration-300 cursor-pointer"
                        >
                            <div class="relative aspect-square overflow-hidden bg-[#f5f1e8] border-b border-[#ebdccb]">
                                <img src="{{ $relImg }}" alt="{{ $rel->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-106 {{ $relHoverImg !== $relImg ? 'group-hover:opacity-0' : '' }}" loading="lazy">
                                @if($relHoverImg && $relHoverImg !== $relImg)
                                    <img src="{{ $relHoverImg }}" alt="{{ $rel->name }} angle" class="absolute inset-0 h-full w-full object-cover opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:scale-106" loading="lazy">
                                @endif
                            </div>
                            <div class="p-3 flex flex-col justify-between flex-1">
                                <p class="text-[0.6rem] font-bold uppercase tracking-wider text-[#78000b] truncate">
                                    <span data-i18n-en="{{ $rel->category->name ?? 'Luxury' }}" data-i18n-de="{{ $catTranslations[$rel->category->slug ?? ''] ?? ($rel->category->name ?? 'Luxury') }}">
                                        {{ $rel->category->name ?? 'Luxury' }}
                                    </span>
                                </p>
                                <h3 class="font-display text-xs sm:text-sm font-medium text-[#1c1210] group-hover:text-[#78000b] transition truncate mt-0.5">{{ $rel->name }}</h3>
                                <p class="font-sans text-xs sm:text-sm font-bold text-[#1c1210] mt-1.5">{{ $relPrice }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>

<!-- Fullscreen Lightbox Modal -->
<div id="fullscreen-lightbox" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex flex-col justify-between p-4 transition-opacity duration-300">
    <div class="flex items-center justify-between text-white pb-2 border-b border-white/20">
        <span class="font-display text-base text-white">{{ $product->name }}</span>
        <div class="flex items-center gap-2">
            <button type="button" onclick="lightboxZoom(0.25)" class="h-7 w-7 flex items-center justify-center rounded-full bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-sm font-bold" title="Zoom in" data-i18n-title-en="Zoom in" data-i18n-title-de="Vergrößern">+</button>
            <button type="button" onclick="lightboxZoom(-0.25)" class="h-7 w-7 flex items-center justify-center rounded-full bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-sm font-bold" title="Zoom out" data-i18n-title-en="Zoom out" data-i18n-title-de="Verkleinern">-</button>
            <button type="button" onclick="resetLightboxZoom()" class="px-2 py-0.5 rounded bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-[0.65rem] uppercase">
                <span data-i18n-en="Reset" data-i18n-de="Zurücksetzen">Reset</span>
            </button>
            <button type="button" onclick="closeFullscreenLightbox()" class="h-7 w-7 flex items-center justify-center rounded-full bg-[#78000b] text-white transition cursor-pointer ml-2">✕</button>
        </div>
    </div>

    <div class="relative flex-1 flex items-center justify-center overflow-hidden my-2 select-none">
        <img id="lightbox-active-img" src="{{ $allImages[0] }}" alt="{{ $product->name }}" class="max-h-[82vh] max-w-[90vw] object-contain transition-transform duration-150">
        @if($allImages->count() > 1)
            <button type="button" onclick="navigateLightbox(-1)" class="absolute left-2 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 hover:bg-[#78000b] text-white transition cursor-pointer text-xl">‹</button>
            <button type="button" onclick="navigateLightbox(1)" class="absolute right-2 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 hover:bg-[#78000b] text-white transition cursor-pointer text-xl">›</button>
        @endif
    </div>

    @if($allImages->count() > 1)
        <div class="flex items-center justify-center gap-2 overflow-x-auto pt-2 border-t border-white/20">
            @foreach($allImages as $idx => $img)
                <button type="button" onclick="setLightboxImage('{{ $img }}', {{ $idx }})" class="h-12 w-12 rounded overflow-hidden border-2 border-white/40 hover:border-[#d8b45a] transition cursor-pointer" style="width: 48px; height: 48px;">
                    <img src="{{ $img }}" alt="thumb" class="h-full w-full object-cover">
                </button>
            @endforeach
        </div>
    @endif
</div>

<script>
    (function() {
        const galleryImages = @json($allImages);
        let currentImageIndex = 0;
        let lightboxCurrentScale = 1;
        let currentQty = 1;
        let selectedVariation = "{{ addslashes($firstVar['name'] ?? 'Cognac Havana') }}";
        const productId = {{ $product->id }};

        // 1. Smooth Lens Zoom on Mouse Move
        window.handleImageZoom = function(e) {
            const container = document.getElementById('zoom-lens-container');
            const img = document.getElementById('main-product-image');
            if (!container || !img) return;

            const rect = container.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = 'scale(2)';
        };

        window.resetImageZoom = function() {
            const img = document.getElementById('main-product-image');
            if (img) img.style.transform = 'scale(1)';
        };

        // 2. Thumbnail Switcher
        window.switchMainImage = function(src, el, idx) {
            const img = document.getElementById('main-product-image');
            if (img) {
                img.style.opacity = '0.3';
                setTimeout(() => {
                    img.src = src;
                    img.style.opacity = '1';
                }, 100);
            }
            currentImageIndex = idx;

            document.querySelectorAll('.thumb-btn').forEach(btn => {
                btn.classList.remove('active-thumb', 'border-[#78000b]');
                btn.classList.add('border-[#d9cebc]');
            });
            if (el) {
                el.classList.add('active-thumb', 'border-[#78000b]');
                el.classList.remove('border-[#d9cebc]');
            }
        };

        // 3. Real-Image Variation Switcher
        window.selectColorVariation = function(name, sku, price, imageSrc, el) {
            selectedVariation = name;

            const nameEl = document.getElementById('active-variation-name');
            const skuEl = document.getElementById('product-sku-display');
            if (nameEl) nameEl.textContent = name;
            if (skuEl) skuEl.textContent = sku;

            const waitlistVarName = document.getElementById('modalWaitlistVarName');
            const waitlistVarInput = document.getElementById('waitlistFormVarInput');
            if (waitlistVarName) waitlistVarName.textContent = name;
            if (waitlistVarInput) waitlistVarInput.value = name;

            if (price) {
                const priceEl = document.getElementById('product-price-display');
                if (priceEl) priceEl.textContent = '€' + price.toFixed(2);
            }

            // Immediately switch main photo to this variation's image!
            if (imageSrc) {
                const mainImg = document.getElementById('main-product-image');
                if (mainImg) {
                    mainImg.style.opacity = '0.3';
                    setTimeout(() => {
                        mainImg.src = imageSrc;
                        mainImg.style.opacity = '1';
                    }, 100);
                }
            }

            document.querySelectorAll('.var-pill').forEach(btn => {
                btn.classList.remove('active-var', 'border-[#78000b]');
                btn.classList.add('border-[#d9cebc]', 'bg-[#faf8f5]');
            });
            if (el) {
                el.classList.add('active-var', 'border-[#78000b]');
                el.classList.remove('border-[#d9cebc]', 'bg-[#faf8f5]');
            }
        };

        // 4. Quantity Adjust
        window.adjustProductQty = function(delta) {
            currentQty = Math.max(1, currentQty + delta);
            const countEl = document.getElementById('qty-count-display');
            if (countEl) countEl.textContent = currentQty;
        };

        // 5. Clean Tab Switcher
        window.switchDetailTab = function(tabIdx) {
            document.querySelectorAll('.detail-tab').forEach(btn => {
                btn.classList.remove('active-tab');
            });
            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            });

            const activeBtn = document.querySelector(`.detail-tab[data-tab-index="${tabIdx}"]`);
            const activePanel = document.getElementById(`detail-panel-${tabIdx}`);

            if (activeBtn) activeBtn.classList.add('active-tab');
            if (activePanel) {
                activePanel.classList.remove('hidden');
                activePanel.classList.add('block');
            }
        };

        // 6. Lightbox Fullscreen
        window.openFullscreenLightbox = function() {
            const modal = document.getElementById('fullscreen-lightbox');
            const activeImg = document.getElementById('lightbox-active-img');
            if (!modal) return;
            activeImg.src = galleryImages[currentImageIndex] || galleryImages[0];
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            resetLightboxZoom();
        };

        window.closeFullscreenLightbox = function() {
            const modal = document.getElementById('fullscreen-lightbox');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        };

        window.navigateLightbox = function(direction) {
            currentImageIndex += direction;
            if (currentImageIndex < 0) currentImageIndex = galleryImages.length - 1;
            if (currentImageIndex >= galleryImages.length) currentImageIndex = 0;
            setLightboxImage(galleryImages[currentImageIndex], currentImageIndex);
        };

        window.setLightboxImage = function(src, idx) {
            currentImageIndex = idx;
            const img = document.getElementById('lightbox-active-img');
            if (img) img.src = src;
            resetLightboxZoom();
        };

        window.lightboxZoom = function(delta) {
            const img = document.getElementById('lightbox-active-img');
            if (!img) return;
            lightboxCurrentScale = Math.max(0.6, Math.min(3.5, lightboxCurrentScale + delta));
            img.style.transform = `scale(${lightboxCurrentScale})`;
        };

        window.resetLightboxZoom = function() {
            lightboxCurrentScale = 1;
            const img = document.getElementById('lightbox-active-img');
            if (img) img.style.transform = 'scale(1)';
        };

        // 7. Add to Cart
        window.submitAddToCart = function() {
            if (typeof quickAddToCart === 'function') {
                quickAddToCart(productId, currentQty, selectedVariation);
            }
        };

        // 8. Add Curated Bundle to Bag
        window.addCuratedBundleToBag = function(dealId, btnEl) {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const origText = btnEl.innerHTML;
            btnEl.disabled = true;
            btnEl.innerHTML = '<span class="animate-pulse">Wird hinzugefügt...</span>';

            fetch(window.mehaajUrl ? window.mehaajUrl('/cart/add-bundle') : '/cart/add-bundle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ deal_id: dealId })
            })
            .then(res => res.json())
            .then(data => {
                btnEl.disabled = false;
                btnEl.innerHTML = origText;
                if (data.success) {
                    if (typeof openCartDrawer === 'function') {
                        openCartDrawer();
                        if (typeof fetchAndUpdateCartDrawer === 'function') fetchAndUpdateCartDrawer(false);
                    }
                    if (window.LuxuryToast) {
                        window.LuxuryToast.fire({ icon: 'success', title: data.message });
                    } else {
                        alert(data.message);
                    }
                } else {
                    if (window.LuxurySwal) {
                        window.LuxurySwal.fire({ icon: 'error', title: 'Bundle Error', text: data.message });
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(err => {
                btnEl.disabled = false;
                btnEl.innerHTML = origText;
                console.error('Bundle error:', err);
            });
        };

        // 9. Client Review Handlers
        window.toggleReviewForm = function() {
            const drawer = document.getElementById('review-submission-drawer');
            if (!drawer) return;
            drawer.classList.toggle('hidden');
            if (!drawer.classList.contains('hidden')) {
                drawer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        };

        window.setFormRating = function(score) {
            const ratingInput = document.getElementById('review-form-rating');
            const ratingLabel = document.getElementById('rating-label');
            if (ratingInput) ratingInput.value = score;

            const labels = {
                5: '5 Sterne (Hervorragend)',
                4: '4 Sterne (Sehr gut)',
                3: '3 Sterne (Gut)',
                2: '2 Sterne (Ausbaufähig)',
                1: '1 Stern (Unzureichend)'
            };
            if (ratingLabel) ratingLabel.textContent = labels[score] || (score + ' Sterne');

            document.querySelectorAll('#star-rating-selector .star-btn').forEach(btn => {
                const s = parseInt(btn.getAttribute('data-star'));
                btn.textContent = s <= score ? '★' : '☆';
            });
        };

        window.submitProductReview = function(e) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = document.getElementById('review-submit-btn');
            const alertBox = document.getElementById('review-form-alert');
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const origText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="animate-pulse">Wird übermittelt...</span>';

            const formData = new FormData(form);

            fetch('{{ route("reviews.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token || '',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;

                if (data.success) {
                    form.reset();
                    if (alertBox) {
                        alertBox.className = 'text-xs p-3 rounded-lg bg-[#2e683a]/10 text-[#2e683a] border border-[#2e683a]/20 block';
                        alertBox.textContent = data.message;
                    }
                    if (window.LuxuryToast) {
                        window.LuxuryToast.fire({ icon: 'success', title: data.message });
                    }
                    setTimeout(() => {
                        window.toggleReviewForm();
                    }, 2500);
                } else {
                    if (alertBox) {
                        alertBox.className = 'text-xs p-3 rounded-lg bg-[#78000b]/10 text-[#78000b] border border-[#78000b]/20 block';
                        alertBox.textContent = data.message || 'Ein Fehler ist aufgetreten.';
                    }
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
                console.error('Review submit error:', err);
                if (alertBox) {
                    alertBox.className = 'text-xs p-3 rounded-lg bg-[#78000b]/10 text-[#78000b] border border-[#78000b]/20 block';
                    alertBox.textContent = 'Verbindung fehlgeschlagen. Bitte versuchen Sie es erneut.';
                }
            });
        };

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('fullscreen-lightbox');
            if (modal && !modal.classList.contains('hidden')) {
                if (e.key === 'Escape') closeFullscreenLightbox();
                if (e.key === 'ArrowRight') navigateLightbox(1);
                if (e.key === 'ArrowLeft') navigateLightbox(-1);
            }
            const wModal = document.getElementById('waitlistModal');
            if (wModal && !wModal.classList.contains('hidden')) {
                if (e.key === 'Escape') closeWaitlistModal();
            }
        });

        // 6. Atelier Waitlist Modal Handling
        window.openWaitlistModal = function() {
            const modal = document.getElementById('waitlistModal');
            if (modal) modal.classList.remove('hidden');
        };

        window.closeWaitlistModal = function() {
            const modal = document.getElementById('waitlistModal');
            if (modal) modal.classList.add('hidden');
        };

        window.submitWaitlistForm = function(e) {
            e.preventDefault();
            const form = document.getElementById('waitlistForm');
            const submitBtn = document.getElementById('waitlistSubmitBtn');
            const origHtml = submitBtn.innerHTML;

            const email = document.getElementById('waitlistEmailInput').value;
            const name = document.getElementById('waitlistNameInput').value;
            const varName = document.getElementById('waitlistFormVarInput').value;
            const productId = {{ $product->id }};

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="inline-block animate-spin mr-2">⟳</span> Bitte warten...';

            fetch('{{ route("stock-notifications.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    variation_name: varName,
                    customer_email: email,
                    customer_name: name
                })
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origHtml;
                if (data.success) {
                    closeWaitlistModal();
                    if (window.LuxurySwal) {
                        LuxurySwal.fire({
                            icon: 'success',
                            title: 'Warteliste bestätigt',
                            text: data.message
                        });
                    } else if (window.LuxuryToast) {
                        LuxuryToast.fire({ icon: 'success', title: data.message });
                    } else {
                        alert(data.message);
                    }
                    form.reset();
                } else {
                    alert(data.message || 'Ein Fehler ist aufgetreten.');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origHtml;
                console.error('Waitlist error:', err);
                alert('Verbindung zum Server fehlgeschlagen.');
            });
        };
    })();
</script>

<!-- Luxury Atelier Waitlist Modal -->
<div id="waitlistModal" class="fixed inset-0 z-50 hidden bg-[#1c1210]/70 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-[#e6decb] relative space-y-5">
        <button type="button" onclick="closeWaitlistModal()" class="absolute top-4 right-4 text-[#8a7c74] hover:text-[#1c1210] text-xl font-bold cursor-pointer">✕</button>

        <!-- Modal Header -->
        <div class="space-y-1 text-center pr-6">
            <span class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                <span data-i18n-en="ATELIER PRIORITÄTS-WARTELISTE" data-i18n-de="ATELIER PRIORITÄTS-WARTELISTE">ATELIER PRIORITÄTS-WARTELISTE</span>
            </span>
            <h3 class="font-display text-xl font-bold text-[#1c1210]" data-i18n-en="Notify When Available" data-i18n-de="Benachrichtigen, wenn verfügbar">
                Benachrichtigen, wenn verfügbar
            </h3>
            <p class="text-xs text-[#685c54]" data-i18n-en="Join our private priority waitlist. You will receive an exclusive alert as soon as this handcrafted creation is restocked." data-i18n-de="Tragen Sie sich auf unsere exklusive Prioritäts-Warteliste ein. Wir benachrichtigen Sie diskret per E-Mail, sobald neue Stücke vollendet sind.">
                Tragen Sie sich auf unsere exklusive Prioritäts-Warteliste ein. Wir benachrichtigen Sie diskret per E-Mail, sobald neue Stücke vollendet sind.
            </p>
        </div>

        <!-- Product Preview Box -->
        <div class="flex items-center gap-3 bg-[#faf7f2] p-3 rounded-xl border border-[#e6decb]">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover border border-[#e6decb] shrink-0">
            <div class="min-w-0 flex-1">
                <h4 class="font-bold text-xs text-[#1c1210] truncate">{{ $product->name }}</h4>
                <p class="text-[0.68rem] text-[#8a7c74]">
                    <span data-i18n-en="Selection:" data-i18n-de="Ausführung:">Ausführung:</span> <span id="modalWaitlistVarName" class="font-bold text-[#78000b]">{{ $firstVar['name'] ?? 'Standard' }}</span>
                </p>
                <p class="text-xs font-bold text-[#1c1210] font-mono mt-0.5">€{{ number_format($effectivePrice, 2, '.', ',') }}</p>
            </div>
        </div>

        <!-- Waitlist Form -->
        <form id="waitlistForm" onsubmit="submitWaitlistForm(event)" class="space-y-3.5">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="variation_name" id="waitlistFormVarInput" value="{{ $firstVar['name'] ?? '' }}">

            <div>
                <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-en="Your Name (Optional)" data-i18n-de="Ihr Name (Optional)">
                    Ihr Name (Optional)
                </label>
                <input 
                    type="text" 
                    name="customer_name" 
                    id="waitlistNameInput"
                    placeholder="z. B. Dr. Maximilian von Weber" 
                    class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                >
            </div>

            <div>
                <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-en="Email Address *" data-i18n-de="E-Mail-Adresse *">
                    E-Mail-Adresse *
                </label>
                <input 
                    type="email" 
                    name="customer_email" 
                    id="waitlistEmailInput"
                    required 
                    placeholder="ihre.email@beispiel.de" 
                    class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                >
            </div>

            <p class="text-[0.62rem] text-[#8a7c74] leading-relaxed" data-i18n-en="No spam. Only a one-time restock notification. Unsubscribe anytime." data-i18n-de="Kein Spam. Ausschließlich eine einmalige Benachrichtigung bei Wiederverfügbarkeit.">
                Kein Spam. Ausschließlich eine einmalige Benachrichtigung bei Wiederverfügbarkeit.
            </p>

            <button 
                type="submit" 
                id="waitlistSubmitBtn"
                class="w-full h-11 rounded-xl bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] transition-all shadow-md active:scale-98 cursor-pointer flex items-center justify-center gap-2"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span data-i18n-en="Notify Me" data-i18n-de="Auf Warteliste setzen">Auf Warteliste setzen</span>
            </button>
        </form>
    </div>
</div>
@endsection
