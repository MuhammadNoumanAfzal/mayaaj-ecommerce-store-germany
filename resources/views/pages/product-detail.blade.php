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
                <a href="{{ route('home') }}" class="hover:text-[#78000b] transition">Home</a>
                <span class="text-[#c7baa7]">/</span>
                <a href="{{ route('shop') }}" class="hover:text-[#78000b] transition">Shop</a>
                @if($product->category)
                    <span class="text-[#c7baa7]">/</span>
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-[#78000b] transition">
                        {{ $product->category->name }}
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
                                <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.56rem] font-bold uppercase tracking-[0.16em] text-white shadow-xs">
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
                            <span class="hidden sm:inline-block rounded-full bg-black/60 backdrop-blur-md px-2.5 py-0.5 text-[0.56rem] uppercase tracking-wider text-white/90">
                                Hover to Zoom
                            </span>
                            <button
                                type="button"
                                onclick="openFullscreenLightbox()"
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-white/95 text-[#78000b] backdrop-blur-md border border-[#d8b45a]/60 shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white cursor-pointer"
                                aria-label="Fullscreen zoom"
                                title="Fullscreen Gallery"
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
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                                {{ $product->category->name ?? 'HAUTE MAROQUINERIE' }}
                            </span>

                            <div class="flex items-center gap-1.5 text-xs text-[#685c54]">
                                <span class="text-[#d8b45a] tracking-wider text-[0.7rem]">★★★★★</span>
                                <span class="font-bold text-[#1c1210]">4.9</span>
                                <span class="text-[#8a7c74] text-[0.65rem]">(48 reviews)</span>
                            </div>
                        </div>

                        <!-- Product Title -->
                        <h1 class="mt-2.5 font-display text-2xl sm:text-3xl font-medium leading-tight text-[#1c1210] tracking-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- SKU & Stock -->
                        <div class="mt-2 flex items-center gap-2 text-xs text-[#685c54]">
                            <span>SKU: <strong id="product-sku-display" class="font-mono text-[#1c1210]">{{ $firstVar['sku'] ?? ($product->sku ?? 'MHJ-' . $product->id) }}</strong></span>
                            <span class="text-[#c7baa7]">•</span>
                            <span class="inline-flex items-center gap-1.5 font-semibold text-[#2e683a] text-xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#2e683a] animate-pulse"></span>
                                <span>In Stock • Dispatches via DHL Express</span>
                            </span>
                        </div>

                        <!-- Clean Price Display -->
                        <div class="mt-3.5 flex items-baseline gap-3">
                            <span id="product-price-display" class="font-sans text-2xl sm:text-3xl font-bold text-[#1c1210]">
                                €{{ number_format($effectivePrice, 2, '.', ',') }}
                            </span>
                            @if($hasDiscount)
                                <span class="text-sm text-[#8a7c74] line-through font-mono">
                                    €{{ number_format($product->price, 2, '.', ',') }}
                                </span>
                                <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.62rem] font-bold uppercase tracking-wider text-white">
                                    SAVE €{{ number_format($product->price - $product->sale_price, 2, '.', ',') }}
                                </span>
                            @endif
                        </div>

                        <!-- Interactive Real-Image Color Variations -->
                        <div class="mt-4 pt-3.5 border-t border-[#f0e7d8]">
                            <div class="flex items-center justify-between mb-2 text-xs">
                                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210]">
                                    Finish: <strong id="active-variation-name" class="text-[#78000b]">{{ $firstVar['name'] ?? 'Cognac Havana' }}</strong>
                                </span>
                                <span class="text-[0.62rem] text-[#8a7c74] uppercase">Tuscan Leather</span>
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
                            <button
                                type="button"
                                data-wishlist-btn-id="{{ $product->id }}"
                                onclick="toggleWishlistProduct(JSON.parse(this.dataset.product), this)"
                                data-product="{{ $prodPayload }}"
                                class="h-11 w-11 flex items-center justify-center rounded-lg border border-[#d9cebc] bg-[#faf8f5] text-[#78000b] shadow-2xs transition-all duration-200 hover:bg-[#78000b] hover:text-white cursor-pointer shrink-0"
                                title="Save to Wishlist"
                                aria-label="Wishlist"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- 3 Compact Inline Trust Badges (No giant boxes!) -->
                        <div class="mt-5 grid grid-cols-3 gap-2 border-t border-[#f0e7d8] pt-4 text-center text-[0.62rem] text-[#5c4f46]">
                            <div class="flex flex-col items-center gap-0.5">
                                <span class="font-bold text-[#1c1210]">100% Full-Grain</span>
                                <span class="text-[0.58rem] text-[#8a7c74]">Tuscan Tannery</span>
                            </div>
                            <div class="flex flex-col items-center gap-0.5 border-x border-[#dfd6c4]">
                                <span class="font-bold text-[#1c1210]">2-Year Warranty</span>
                                <span class="text-[0.58rem] text-[#8a7c74]">Atelier Care</span>
                            </div>
                            <div class="flex flex-col items-center gap-0.5">
                                <span class="font-bold text-[#1c1210]">Free DHL Express</span>
                                <span class="text-[0.58rem] text-[#8a7c74]">1–3 Days Insured</span>
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
                        {{ $tab['title'] ?? 'Tab ' . ($tIdx + 1) }}
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

    <!-- Curated Recommendations Grid -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-8 sm:py-10">
            <div class="w-full max-w-[1180px] mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between border-b border-[#dfd6c4] pb-2.5 mb-5">
                    <h2 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]">
                        You May Also Admire
                    </h2>
                    <a href="{{ route('shop') }}" class="text-xs font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007]">
                        View Collection →
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
                                <p class="text-[0.6rem] font-bold uppercase tracking-wider text-[#78000b] truncate">{{ $rel->category->name ?? 'Luxury' }}</p>
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
            <button type="button" onclick="lightboxZoom(0.25)" class="h-7 w-7 flex items-center justify-center rounded-full bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-sm font-bold" title="Zoom in">+</button>
            <button type="button" onclick="lightboxZoom(-0.25)" class="h-7 w-7 flex items-center justify-center rounded-full bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-sm font-bold" title="Zoom out">-</button>
            <button type="button" onclick="resetLightboxZoom()" class="px-2 py-0.5 rounded bg-white/20 hover:bg-white hover:text-black transition cursor-pointer text-[0.65rem] uppercase">Reset</button>
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

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('fullscreen-lightbox');
            if (modal && !modal.classList.contains('hidden')) {
                if (e.key === 'Escape') closeFullscreenLightbox();
                if (e.key === 'ArrowRight') navigateLightbox(1);
                if (e.key === 'ArrowLeft') navigateLightbox(-1);
            }
        });
    })();
</script>
@endsection
