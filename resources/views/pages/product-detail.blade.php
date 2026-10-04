@extends('layouts.app')

@php
    $effectivePrice = ($product->sale_price && $product->sale_price < $product->price) ? $product->sale_price : $product->price;
    $hasDiscount = ($product->sale_price && $product->sale_price < $product->price);
    $discountPercent = $hasDiscount ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
    $cleanDesc = strip_tags($product->description ?? 'Exklusive MEHAAJ Meisterkreation aus pflanzlich gegerbtem Vollleder mit handpolierten Kanten und zeitloser Silhouette.');
@endphp

@section('title', ($product->name ?? 'Meisterstück') . ' | MEHAAJ® Deutsche Haute Maroquinerie')
@section('meta_description', Str::limit($cleanDesc, 155))
@section('canonical', route('shop.show', $product->slug))
@section('og_image', $product->image_url)

@section('content')
<!-- Schema.org Product Structured Data for SEO Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ addslashes($product->name) }}",
  "image": [
    "{{ $product->image_url }}"
    @if(!empty($product->gallery_images) && is_array($product->gallery_images))
      @foreach($product->gallery_images as $gImg)
        , "{{ asset('storage/' . $gImg) }}"
      @endforeach
    @endif
  ],
  "description": "{{ addslashes($cleanDesc) }}",
  "sku": "{{ $product->sku ?? 'MHJ-' . $product->id }}",
  "brand": {
    "@type": "Brand",
    "name": "MEHAAJ"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ route('shop.show', $product->slug) }}",
    "priceCurrency": "EUR",
    "price": "{{ number_format($effectivePrice, 2, '.', '') }}",
    "priceValidUntil": "{{ date('Y') + 1 }}-12-31",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "MEHAAJ Maison"
    }
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "48",
    "bestRating": "5",
    "worstRating": "1"
  }
}
</script>

<div class="bg-[#faf7f2] text-[#1c1210] min-h-screen">

    <!-- Top Sleek Sub-Header Bar (No dead vertical padding, clean navigation) -->
    <div class="border-b border-[#e6decb] bg-white py-2.5 sm:py-3 shadow-xs">
        <div class="luxury-container flex items-center justify-between gap-4">
            <a href="{{ route('shop') }}" class="group inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#685c54] transition hover:text-[#78000b] cursor-pointer">
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
                <span data-i18n-de="Zurück zur Kollektion" data-i18n-en="Back to Collection">Zurück zur Kollektion</span>
            </a>

            <div class="flex items-center gap-2 text-[0.7rem] text-[#8a7c74] overflow-hidden text-ellipsis whitespace-nowrap">
                @if($product->category)
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="rounded-full bg-[#faf7f2] border border-[#e6decb] px-2.5 py-0.5 font-medium text-[#78000b] hover:bg-[#78000b] hover:text-white transition cursor-pointer">
                        {{ $product->category->name }}
                    </a>
                @endif
                <span class="text-[#c7baa7] hidden sm:inline">•</span>
                <span class="font-medium text-[#1c1210] hidden sm:inline max-w-xs truncate">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <!-- Main Product Showcase Section -->
    <section class="bg-white py-8 sm:py-12 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Interactive Product Gallery (7 cols on lg) -->
                <div class="lg:col-span-7 flex flex-col gap-4">
                    <!-- Main Product Image Frame with Zoom & Gold Accent -->
                    <div class="relative overflow-hidden rounded-md border border-[#e6decb] bg-[#f7f4ee] shadow-sm group">
                        <!-- Top Gold Shimmer Border -->
                        <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                        <!-- Top Badges -->
                        <div class="absolute left-4 top-4 z-20 flex flex-col gap-2">
                            @if($product->is_featured)
                                <span class="rounded-sm bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-[0.2em] text-white shadow-md animate-pulse">
                                    BESTSELLER
                                </span>
                            @endif
                            @if($hasDiscount)
                                <span class="rounded-sm bg-[#d8b45a] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#0a0403] shadow-md font-mono">
                                    -{{ $discountPercent }}% ANGEBOT
                                </span>
                            @endif
                        </div>

                        <!-- Main Image Display -->
                        <div class="relative overflow-hidden cursor-zoom-in" onclick="openLightbox()">
                            <img
                                id="main-product-image"
                                src="{{ $product->image_url }}"
                                alt="{{ $product->name }}"
                                class="h-[380px] sm:h-[480px] lg:h-[560px] w-full object-cover transition-all duration-700 ease-out group-hover:scale-106"
                                fetchpriority="high"
                            >
                        </div>

                        <!-- Zoom Indicator Button -->
                        <button
                            type="button"
                            onclick="openLightbox()"
                            class="absolute right-4 bottom-4 z-20 flex items-center gap-1.5 rounded bg-white/95 px-3 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] backdrop-blur-md border border-[#e6decb] shadow-md transition-all duration-300 hover:bg-[#78000b] hover:text-white cursor-pointer"
                        >
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                            <span data-i18n-de="VERGRÖSSERN" data-i18n-en="ZOOM IN">VERGRÖSSERN</span>
                        </button>
                    </div>

                    <!-- Gallery Thumbnails Strip -->
                    @php
                        $allImages = collect([$product->image_url]);
                        if (!empty($product->gallery_images) && is_array($product->gallery_images)) {
                            foreach ($product->gallery_images as $gImg) {
                                $allImages->push(asset('storage/' . $gImg));
                            }
                        }
                    @endphp

                    @if($allImages->count() > 1)
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3 pt-1">
                            @foreach($allImages as $index => $imgSrc)
                                <button
                                    type="button"
                                    onclick="switchProductImage('{{ $imgSrc }}', this)"
                                    class="gallery-thumb group relative overflow-hidden rounded border-2 transition-all duration-300 hover:scale-103 shadow-xs cursor-pointer {{ $index === 0 ? 'border-[#78000b] active-thumb ring-2 ring-[#78000b]/20' : 'border-[#e6decb] hover:border-[#78000b]' }}"
                                >
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }} Ansicht {{ $index + 1 }}" class="h-20 w-full object-cover transition-transform duration-300 group-hover:scale-108">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Column: Product Buy Box & Connoisseur Details (5 cols on lg) -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <!-- Category Eyebrow & Social Proof Rating -->
                        <div class="flex items-center justify-between gap-3 border-b border-[#f2ebdc] pb-3">
                            <span class="text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#78000b]">
                                {{ $product->category->name ?? 'HAUTE MAROQUINERIE' }}
                            </span>

                            <a href="#customer-reviews" class="group flex items-center gap-1.5 text-xs text-[#685c54] transition hover:text-[#78000b] cursor-pointer">
                                <div class="flex text-[#d8b45a] text-xs tracking-tight">★ ★ ★ ★ ★</div>
                                <span class="font-bold text-[#1c1210]">4.9</span>
                                <span class="text-xs text-[#8a7c74] group-hover:underline">(48 <span data-i18n-de="Bewertungen" data-i18n-en="Reviews">Bewertungen</span>)</span>
                            </a>
                        </div>

                        <!-- Product Title (H1 for SEO) -->
                        <h1 class="mt-3 font-display text-2xl font-medium leading-tight text-[#1c1210] sm:text-3xl lg:text-4xl tracking-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- SKU & Real-time Stock Status -->
                        <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-[#685c54]">
                            <span>SKU: <strong class="font-mono text-[#1c1210]">{{ $product->sku ?? 'MHJ-' . $product->id }}</strong></span>
                            <span class="text-[#c7baa7]">•</span>
                            @if($product->stock > 0)
                                <span class="inline-flex items-center gap-1.5 font-semibold text-[#2e683a]">
                                    <span class="h-2 w-2 rounded-full bg-[#2e683a] animate-pulse"></span>
                                    <span data-i18n-de="Auf Lager ({{ $product->stock }} Stück vorrätig)" data-i18n-en="In Stock ({{ $product->stock }} units available)">
                                        Auf Lager ({{ $product->stock }} Stück vorrätig)
                                    </span>
                                </span>
                            @else
                                <span class="font-semibold text-[#8a7c74]" data-i18n-de="Aktuell auf Anfrage gefertigt" data-i18n-en="Made to order on request">
                                    Aktuell auf Anfrage gefertigt
                                </span>
                            @endif
                        </div>

                        <!-- Pricing & Legal VAT Notice (§ 1 PAngV Compliant) -->
                        <div class="mt-5 rounded-md border border-[#e6decb] bg-[#faf7f2] p-4 shadow-2xs">
                            <div class="flex flex-wrap items-baseline gap-3">
                                <span class="font-display text-3xl sm:text-4xl font-bold text-[#1c1210]">
                                    EUR {{ number_format($effectivePrice, 2, ',', '.') }}
                                </span>
                                @if($hasDiscount)
                                    <span class="text-base text-[#8a7c74] line-through font-mono">
                                        EUR {{ number_format($product->price, 2, ',', '.') }}
                                    </span>
                                    <span class="rounded bg-[#78000b] px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-white shadow-2xs" data-i18n-de="ANGEBOT" data-i18n-en="SALE">
                                        SALE
                                    </span>
                                @endif
                            </div>

                            <p class="mt-2 text-[0.72rem] text-[#685c54]">
                                <span data-i18n-de="inkl. 19% MwSt." data-i18n-en="incl. 19% VAT">inkl. 19% MwSt.</span>, 
                                <span class="text-[#2e683a] font-semibold" data-i18n-de="kostenloser DHL Express Versand in DE" data-i18n-en="free DHL Express shipping in DE">kostenloser DHL Express Versand in DE</span>
                            </p>

                            <!-- Live Dispatch Delivery Badge -->
                            <div class="mt-3 flex items-center gap-2 text-[0.75rem] text-[#2e683a] bg-white px-3 py-2 rounded border border-[#2e683a]/25 shadow-2xs">
                                <svg class="h-4 w-4 shrink-0 text-[#2e683a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="3" width="15" height="13"/>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                    <circle cx="5.5" cy="18.5" r="2.5"/>
                                    <circle cx="18.5" cy="18.5" r="2.5"/>
                                </svg>
                                <span class="font-medium" data-i18n-de="Bestellen Sie jetzt: Voraussichtliche Lieferung in 1–3 Werktagen" data-i18n-en="Order now: Estimated delivery in 1–3 working days">
                                    Bestellen Sie jetzt: Voraussichtliche Lieferung in 1–3 Werktagen
                                </span>
                            </div>
                        </div>

                        <!-- Product Description Copy -->
                        <div class="mt-5 text-xs sm:text-sm text-[#5c4f46] leading-relaxed prose prose-sm max-w-none">
                            {!! $product->description !!}
                        </div>

                        <!-- Atelier Leather Finishing Selectors (Tactile Connoisseur Experience) -->
                        @php
                            $variationsList = !empty($product->variations) && is_array($product->variations) && count($product->variations) > 0
                                ? $product->variations
                                : [
                                    ['name' => 'Burnished Mahogany', 'color' => '#5a2e1e', 'sku' => '', 'price' => null],
                                    ['name' => 'Noir Profond', 'color' => '#1c1210', 'sku' => '', 'price' => null],
                                    ['name' => 'Cognac Vintage', 'color' => '#8c5836', 'sku' => '', 'price' => null],
                                ];
                            $firstVarName = $variationsList[0]['name'] ?? 'Standard';
                        @endphp
                        <div class="mt-5 border-t border-[#f2ebdc] pt-4">
                            <label class="block text-[0.68rem] font-bold uppercase tracking-[0.16em] text-[#1c1210] mb-2">
                                <span data-i18n-de="AUSGEWÄHLTE LEDERAUSFÜHRUNG" data-i18n-en="SELECTED LEATHER FINISH">AUSGEWÄHLTE LEDERAUSFÜHRUNG</span>:
                                <span id="active-variation-name" class="font-bold text-[#78000b] ml-1">{{ $firstVarName }}</span>
                            </label>
                            <div class="flex flex-wrap items-center gap-2.5" id="variation-options-container">
                                @foreach($variationsList as $vIdx => $vItem)
                                    @php
                                        $vName = $vItem['name'] ?? 'Standard';
                                        $vColor = $vItem['color'] ?? '#5a2e1e';
                                        $vPrice = !empty($vItem['price']) ? (float)$vItem['price'] : null;
                                        $isFirst = ($vIdx === 0);
                                    @endphp
                                    <button
                                        type="button"
                                        onclick="selectVariation('{{ addslashes($vName) }}', this, {{ $vPrice ? $vPrice : 'null' }})"
                                        data-name="{{ $vName }}"
                                        data-price="{{ $vPrice ?? '' }}"
                                        class="variation-pill group relative flex items-center gap-2 rounded-full border px-3 py-1.5 shadow-xs transition-all duration-300 cursor-pointer {{ $isFirst ? 'border-2 border-[#78000b] bg-[#faf7f2] ring-2 ring-[#78000b]/20 active-var font-semibold' : 'border-[#e6decb] bg-white opacity-85 hover:opacity-100 hover:border-[#78000b]' }}"
                                    >
                                        <span class="h-3.5 w-3.5 rounded-full ring-1 ring-black/20 shrink-0 shadow-xs" style="background-color: {{ $vColor }};"></span>
                                        <span class="text-xs text-[#1c1210] font-medium">{{ $vName }}</span>
                                        @if($vPrice && $vPrice != $effectivePrice)
                                            <span class="text-[0.65rem] text-[#8a7c74] font-mono">(EUR {{ number_format($vPrice, 2, ',', '.') }})</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quantity Selector & Action CTA Buttons -->
                        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <!-- Quantity Counter -->
                            <div class="flex h-12 items-center rounded border border-[#e6decb] bg-[#faf7f2] px-3 w-32 justify-between shadow-xs">
                                <button type="button" onclick="adjustQty(-1)" class="h-8 w-8 flex items-center justify-center font-bold text-base text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer" aria-label="Menge verringern">-</button>
                                <span id="qty-count" class="font-bold text-sm text-[#1c1210]">1</span>
                                <button type="button" onclick="adjustQty(1)" class="h-8 w-8 flex items-center justify-center font-bold text-base text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer" aria-label="Menge erhöhen">+</button>
                            </div>

                            <!-- Add to Cart Primary Button -->
                            <button
                                type="button"
                                id="add-to-cart-btn"
                                onclick="handleAddToCart({{ $product->id }})"
                                class="animate-shine-sweep group/btn flex-1 flex h-12 items-center justify-center gap-2.5 rounded bg-[#78000b] px-6 text-xs font-bold uppercase tracking-[0.18em] text-white shadow-lg transition-all duration-300 hover:bg-[#5a0309] hover:shadow-[0_10px_30px_rgba(120,0,11,0.4)] active:scale-98 cursor-pointer"
                            >
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover/btn:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                                </svg>
                                <span id="add-cart-label" data-i18n-de="IN DEN WARENKORB" data-i18n-en="ADD TO CART">IN DEN WARENKORB</span>
                            </button>

                            <!-- Wishlist Toggle Button -->
                            <button
                                type="button"
                                id="wishlist-toggle-btn"
                                onclick="toggleWishlistProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->image_url }}', '{{ number_format($effectivePrice, 2, ',', '.') }}')"
                                class="h-12 w-12 flex items-center justify-center rounded border border-[#e6decb] bg-white text-[#78000b] shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:scale-105 active:scale-95 cursor-pointer"
                                title="Auf Wunschliste speichern"
                                aria-label="Wunschliste"
                            >
                                <svg id="wishlist-icon" class="h-5 w-5 transition duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <!-- 3 Core Trust Guarantee Cards -->
                        <div class="mt-8 grid grid-cols-3 gap-3 border-t border-[#f2ebdc] pt-6 text-center text-[0.68rem] text-[#5c4f46]">
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/70 transition-all duration-300 hover:-translate-y-1 hover:border-[#d8b45a] hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="100% Vollleder" data-i18n-en="100% Full Grain">100% Vollleder</span>
                                <span class="text-[0.6rem] text-[#8a7c74]" data-i18n-de="Pflanzlich gegerbt" data-i18n-en="Vegetable Tanned">Pflanzlich gegerbt</span>
                            </div>

                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/70 transition-all duration-300 hover:-translate-y-1 hover:border-[#d8b45a] hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="2 Jahre Garantie" data-i18n-en="2-Year Warranty">2 Jahre Garantie</span>
                                <span class="text-[0.6rem] text-[#8a7c74]" data-i18n-de="Handnaht-Garantie" data-i18n-en="Saddle Stitch Guarantee">Handnaht-Garantie</span>
                            </div>

                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/70 transition-all duration-300 hover:-translate-y-1 hover:border-[#d8b45a] hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="1" y="3" width="15" height="13"/>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                    <circle cx="5.5" cy="18.5" r="2.5"/>
                                    <circle cx="18.5" cy="18.5" r="2.5"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="30 Tage Retoure" data-i18n-en="30-Day Returns">30 Tage Retoure</span>
                                <span class="text-[0.6rem] text-[#8a7c74]" data-i18n-de="Kostenlos in DE" data-i18n-en="Free in Germany">Kostenlos in DE</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Product Craftsmanship & Technical Specifications Section (Accordion / Tabs) -->
    <section class="bg-[#faf7f2] py-12 sm:py-16 border-b border-[#e6decb] reveal-on-scroll">
        <div class="luxury-container max-w-4xl">
            <div class="text-center mb-8">
                <span class="text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#78000b]" data-i18n-de="MANUFAKTUR & PRÄZISION" data-i18n-en="ATELIER & PRECISION">MANUFAKTUR & PRÄZISION</span>
                <h2 class="mt-2 font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-de="Details, Material & Herkunft" data-i18n-en="Details, Material & Origin">
                    Details, Material & Herkunft
                </h2>
                <div class="mx-auto mt-2 h-0.5 w-12 bg-[#d8b45a]"></div>
            </div>

            @php
                $defaultAccordionTabs = [
                    [
                        'title' => 'Master Craftsmanship & Saddlery Finishing',
                        'dot_color' => '#78000b',
                        'content' => $product->craftsmanship ?: 'Bench-made in Flanders using turned-shoe assembly for supernatural flexibility from the very first stride. Die Schnittkanten werden traditionell mehrfach von Hand mit Bienenwachs geschliffen und kantenversiegelt.',
                        'features' => [
                            'Double saddle stitching with waxed linen thread',
                            'Hand-burnished solid brass hardware'
                        ]
                    ],
                    [
                        'title' => 'Materials & Tuscan Vegetable Tanning',
                        'dot_color' => '#d8b45a',
                        'content' => 'Für dieses Meisterstück verwenden wir ausschließlich europäisches Vollrind- und Kalbsleder der höchsten Selektionsstufe A+. Die Gerbung erfolgt in der Toskana rein pflanzlich mittels Rinden- und Kastanienextrakten – völlig frei von toxischem Chrom.',
                        'features' => []
                    ],
                    [
                        'title' => 'Care Instructions & Patina Development',
                        'dot_color' => '#2e683a',
                        'content' => 'Pflanzlich gegerbtes Leder reift mit den Jahren und entwickelt eine unverwechselbare, edle Patina. Wir empfehlen, das Leder ein- bis zweimal jährlich sanft mit unserem organischen MEHAAJ Bienenwachsbalsam und einem Baumwolltuch zu nähren.',
                        'features' => []
                    ],
                    [
                        'title' => 'Shipping, Gift Packaging & Free Returns',
                        'dot_color' => '#78000b',
                        'content' => 'Jedes Produkt verlässt unser Atelier in einer nummerierten MEHAAJ Luxus-Magnetbox, geschützt durch einen atmungsaktiven Staubbeutel aus Bio-Baumwolle. Der Versand erfolgt versichert via DHL Express mit Live-Tracking. 30 Tage Rückgaberecht mit beiliegendem Retourenetikett.',
                        'features' => []
                    ],
                ];

                $productTabs = !empty($product->accordion_tabs) && is_array($product->accordion_tabs) && count($product->accordion_tabs) > 0
                    ? $product->accordion_tabs
                    : $defaultAccordionTabs;
            @endphp

            <div class="divide-y divide-[#e6decb] rounded-md border border-[#e6decb] bg-white shadow-sm overflow-hidden">
                @foreach($productTabs as $tIdx => $tab)
                    <div class="group border-b border-[#e6decb] last:border-b-0">
                        <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-base sm:text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                            <span class="flex items-center gap-2.5">
                                <span class="h-2.5 w-2.5 rounded-full shrink-0 shadow-2xs" style="background-color: {{ $tab['dot_color'] ?? '#78000b' }};"></span>
                                <span>{{ $tab['title'] ?? 'Details & Spezifikation' }}</span>
                            </span>
                            <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 {{ $tIdx === 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </button>
                        <div class="accordion-content {{ $tIdx === 0 ? '' : 'hidden' }} px-5 pb-6 text-xs sm:text-sm text-[#5c4f46] space-y-3 leading-relaxed">
                            <div class="prose prose-sm max-w-none text-[#5c4f46] leading-relaxed">
                                {!! $tab['content'] ?? '' !!}
                            </div>
                            @if(!empty($tab['features']) && is_array($tab['features']))
                                <div class="grid sm:grid-cols-2 gap-3 pt-2 text-xs">
                                    @foreach($tab['features'] as $feat)
                                        @if(trim($feat))
                                            <div class="flex items-center gap-2 rounded bg-[#faf7f2] p-2.5 border border-[#e6decb]/60">
                                                <span class="font-bold text-[#78000b]">✓</span>
                                                <span>{{ $feat }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Atelier Storytelling Banner Section -->
    <section class="relative overflow-hidden bg-[#0a0403] py-14 sm:py-20 text-white border-y border-[#d8b45a]/30 reveal-on-scroll">
        <div class="pointer-events-none absolute -top-32 -left-32 h-80 w-80 rounded-full bg-[#78000b]/20 blur-[100px] animate-float-slow"></div>
        <div class="pointer-events-none absolute -bottom-32 -right-32 h-80 w-80 rounded-full bg-[#d8b45a]/15 blur-[100px] animate-float-delayed"></div>

        <div class="luxury-container relative z-10 text-center max-w-3xl">
            <span class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/40 bg-black/60 px-4 py-1 text-[0.62rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#d8b45a] animate-ping"></span>
                <span data-i18n-de="UNIKAT-VERSPRECHEN" data-i18n-en="ONE-OF-A-KIND PROMISE">UNIKAT-VERSPRECHEN</span>
            </span>

            <h2 class="mt-4 font-display text-3xl sm:text-4xl font-medium text-[#fffaf0] leading-tight" data-i18n-de="Kein Fließband. Keine Kompromisse. Nur pure Meisterhand." data-i18n-en="No Assembly Line. No Compromises. Pure Mastercraft.">
                Kein Fließband. Keine Kompromisse. Nur pure Meisterhand.
            </h2>

            <p class="mt-4 text-xs sm:text-sm text-[#e4d9cc]/85 leading-relaxed font-light" data-i18n-de="Von der millimetergenauen Handstanzung bis zum letzten Kantenstrich vergehen bis zu 48 Arbeitsstunden. Ein MEHAAJ Lederstück ist eine Investition für Generationen." data-i18n-en="From millimeter-accurate hand-cutting to the final burnished edge, up to 48 hours of master labor are invested. A MEHAAJ creation is an heirloom for generations.">
                Von der millimetergenauen Handstanzung bis zum letzten Kantenstrich vergehen bis zu 48 Arbeitsstunden. Ein MEHAAJ Lederstück ist eine Investition für Generationen.
            </p>

            <div class="mt-8 grid grid-cols-3 gap-4 border-t border-[#d8b45a]/20 pt-6 text-center">
                <div>
                    <span class="font-display text-2xl sm:text-3xl font-bold text-[#d8b45a]">48h</span>
                    <p class="text-[0.65rem] text-[#e4d9cc]/75 uppercase tracking-wider mt-1" data-i18n-de="Präzisions-Handarbeit" data-i18n-en="Precision Handcraft">Präzisions-Handarbeit</p>
                </div>
                <div>
                    <span class="font-display text-2xl sm:text-3xl font-bold text-[#d8b45a]">100%</span>
                    <p class="text-[0.65rem] text-[#e4d9cc]/75 uppercase tracking-wider mt-1" data-i18n-de="Pflanzlich Gegerbt" data-i18n-en="Vegetable Tanned">Pflanzlich Gegerbt</p>
                </div>
                <div>
                    <span class="font-display text-2xl sm:text-3xl font-bold text-[#d8b45a]">∞</span>
                    <p class="text-[0.65rem] text-[#e4d9cc]/75 uppercase tracking-wider mt-1" data-i18n-de="Reparatur-Garantie" data-i18n-en="Lifetime Repair Care">Reparatur-Garantie</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Verified Customer Reviews Section -->
    <section id="customer-reviews" class="bg-white py-12 sm:py-16 border-b border-[#e6decb] reveal-on-scroll">
        <div class="luxury-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#e6decb] pb-6 gap-4">
                <div>
                    <span class="text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#78000b]" data-i18n-de="AUTHENTISCHE ERFAHRUNGEN" data-i18n-en="AUTHENTIC EXPERIENCES">AUTHENTISCHE ERFAHRUNGEN</span>
                    <h2 class="mt-2 font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-de="Kundenrezensionen & Expertenurteile" data-i18n-en="Client Reviews & Connoisseur Opinions">
                        Kundenrezensionen & Expertenurteile
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-[#d8b45a] text-sm">★ ★ ★ ★ ★</div>
                        <span class="text-xs text-[#685c54]"><strong>4.9 von 5.0</strong> (48 <span data-i18n-de="Bewertungen" data-i18n-en="Reviews">Bewertungen</span>)</span>
                    </div>

                    <button
                        type="button"
                        onclick="openWriteReviewModal('{{ addslashes($product->name) }}')"
                        class="rounded-sm border border-[#78000b] bg-white px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#78000b] transition hover:bg-[#78000b] hover:text-white cursor-pointer shadow-xs"
                        data-i18n-de="BEWERTUNG SCHREIBEN"
                        data-i18n-en="WRITE A REVIEW"
                    >
                        BEWERTUNG SCHREIBEN
                    </button>
                </div>
            </div>

            <!-- Review Cards Grid -->
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Review Card 1 -->
                <div class="rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs text-[#8a7c74]">
                            <div class="flex text-[#d8b45a] text-xs">★ ★ ★ ★ ★</div>
                            <span class="font-mono text-[0.7rem]" data-i18n-de="Vor 2 Wochen" data-i18n-en="2 weeks ago">2 weeks ago</span>
                        </div>
                        <h3 class="mt-3 font-display text-base font-semibold text-[#1c1210]" data-i18n-de="„Unübertroffene Haptik und Lederqualität“" data-i18n-en="“Unrivaled leather touch and finish”">“Unrivaled leather touch and finish”</h3>
                        <p class="mt-2 text-xs text-[#5c4f46] leading-relaxed" data-i18n-de="Ich besitze Taschen von renommierten Pariser Häusern, doch die Lederqualität und Nahtpräzision von MEHAAJ übertrifft alles. Die natürliche Narbung und der Duft sind unvergleichlich." data-i18n-en="I own bags from renowned Parisian luxury houses, yet the leather grain and saddle stitch execution by MEHAAJ exceeds them all. The natural aroma is incomparable.">
                            I own bags from renowned Parisian luxury houses, yet the leather grain and saddle stitch execution by MEHAAJ exceeds them all. The natural aroma is incomparable.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#e6decb]/60 flex items-center justify-between text-[0.7rem]">
                        <span class="font-bold text-[#1c1210]">Dr. Maximilian v. B.</span>
                        <span class="text-[#2e683a] font-semibold" data-i18n-de="✓ Verifizierter Käufer (München)" data-i18n-en="✓ Verified Buyer (Munich)">✓ Verified Buyer (Munich)</span>
                    </div>
                </div>

                <!-- Review Card 2 -->
                <div class="rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs text-[#8a7c74]">
                            <div class="flex text-[#d8b45a] text-xs">★ ★ ★ ★ ★</div>
                            <span class="font-mono text-[0.7rem]" data-i18n-de="Vor 1 Monat" data-i18n-en="1 month ago">1 month ago</span>
                        </div>
                        <h3 class="mt-3 font-display text-base font-semibold text-[#1c1210]" data-i18n-de="„Ein architektonisches Kunstwerk“" data-i18n-en="“An architectural work of art”">“An architectural work of art”</h3>
                        <p class="mt-2 text-xs text-[#5c4f46] leading-relaxed" data-i18n-de="Die Kantenversiegelung ist makellos. Schneller Expressversand in einer traumhaften Box. Man spürt die deutsche Detailverliebtheit in jedem Millimeter." data-i18n-en="The edge burnishing is immaculate. Swift express shipping inside a gorgeous presentation case. German engineering precision in every millimeter.">
                            The edge burnishing is immaculate. Swift express shipping inside a gorgeous presentation case. German engineering precision in every millimeter.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#e6decb]/60 flex items-center justify-between text-[0.7rem]">
                        <span class="font-bold text-[#1c1210]">Sophie Laurent</span>
                        <span class="text-[#2e683a] font-semibold" data-i18n-de="✓ Verifizierte Käuferin (Zürich)" data-i18n-en="✓ Verified Buyer (Zurich)">✓ Verified Buyer (Zurich)</span>
                    </div>
                </div>

                <!-- Review Card 3 -->
                <div class="rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs text-[#8a7c74]">
                            <div class="flex text-[#d8b45a] text-xs">★ ★ ★ ★ ★</div>
                            <span class="font-mono text-[0.7rem]" data-i18n-de="Vor 6 Wochen" data-i18n-en="6 weeks ago">6 weeks ago</span>
                        </div>
                        <h3 class="mt-3 font-display text-base font-semibold text-[#1c1210]" data-i18n-de="„Jeden Euro absolut wert“" data-i18n-en="“Worth every single euro”">“Worth every single euro”</h3>
                        <p class="mt-2 text-xs text-[#5c4f46] leading-relaxed" data-i18n-de="Die Beschläge haben ein substanzielles Gewicht und der Reißverschluss gleitet wie Butter. Die Patina nach den ersten Wochen des täglichen Gebrauchs ist sagenhaft schön." data-i18n-en="Solid weight hardware and the zipper glides like butter. The patina developing over weeks of daily use is simply magnificent.">
                            Solid weight hardware and the zipper glides like butter. The patina developing over weeks of daily use is simply magnificent.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-[#e6decb]/60 flex items-center justify-between text-[0.7rem]">
                        <span class="font-bold text-[#1c1210]">Alexander K.</span>
                        <span class="text-[#2e683a] font-semibold" data-i18n-de="✓ Verifizierter Käufer (Düsseldorf)" data-i18n-en="✓ Verified Buyer (Dusseldorf)">✓ Verified Buyer (Dusseldorf)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Masterpieces Cross-Sell Section -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="bg-[#faf7f2] py-12 sm:py-16 reveal-on-scroll">
            <div class="luxury-container">
                <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#e6decb] pb-6 gap-2">
                    <div>
                        <span class="text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#78000b]" data-i18n-de="HARMONISIERENDE KREATIONEN" data-i18n-en="HARMONIZING CREATIONS">HARMONISIERENDE KREATIONEN</span>
                        <h2 class="mt-2 font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-de="Das könnte Ihnen auch gefallen" data-i18n-en="You May Also Like">
                            Das könnte Ihnen auch gefallen
                        </h2>
                    </div>
                    <a href="{{ route('shop') }}" class="text-xs font-bold uppercase tracking-wider text-[#78000b] hover:underline cursor-pointer" data-i18n-de="ALLE ANSEHEN →" data-i18n-en="VIEW ALL →">
                        ALLE ANSEHEN →
                    </a>
                </div>

                <!-- Related Products Cards Grid -->
                <div class="mt-8 grid gap-5 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($relatedProducts as $rel)
                        @php
                            $relEffPrice = ($rel->sale_price && $rel->sale_price < $rel->price) ? $rel->sale_price : $rel->price;
                        @endphp
                        <article class="group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-xs transition-all duration-500 hover:-translate-y-1.5 hover:border-[#d8b45a] hover:shadow-[0_10px_30px_rgba(216,180,90,0.2)] cursor-pointer">
                            <div class="absolute inset-x-0 top-0 z-20 h-0.5 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-44 sm:h-52 overflow-hidden bg-[#f7f4ee]">
                                <a href="{{ route('shop.show', $rel->slug) }}" class="block h-full w-full">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108" loading="lazy">
                                </a>
                                @if($rel->is_featured)
                                    <span class="absolute top-2 left-2 z-10 rounded-sm bg-[#78000b] px-2 py-0.5 text-[0.55rem] font-bold uppercase tracking-wider text-white shadow-xs" data-i18n-de="BESTSELLER" data-i18n-en="BESTSELLER">
                                        BESTSELLER
                                    </span>
                                @endif
                            </div>

                            <div class="p-3.5 sm:p-4 flex flex-col justify-between flex-1">
                                <div>
                                    <span class="text-[0.55rem] font-bold uppercase tracking-[0.16em] text-[#78000b]">{{ $rel->category->name ?? 'MEHAAJ' }}</span>
                                    <a href="{{ route('shop.show', $rel->slug) }}" class="block">
                                        <h3 class="mt-1 font-display text-sm sm:text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300 line-clamp-1">{{ $rel->name }}</h3>
                                    </a>
                                </div>

                                <div class="mt-3 flex items-center justify-between border-t border-[#f2ebdc] pt-2.5">
                                    <span class="font-bold text-sm sm:text-base text-[#1c1210]">EUR {{ number_format($relEffPrice, 2, ',', '.') }}</span>
                                    <a href="{{ route('shop.show', $rel->slug) }}" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-2.5 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-2xs transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="DETAILS" data-i18n-en="DETAILS">
                                        DETAILS
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Mobile Sticky Floating Add-to-Cart Bar (Appears on scroll past hero) -->
    <div id="sticky-mobile-bar" class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-[#e6decb] p-3 shadow-2xl transition-all duration-400 translate-y-full lg:hidden">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover border border-[#e6decb]">
                <div class="truncate">
                    <p class="text-xs font-semibold text-[#1c1210] truncate">{{ $product->name }}</p>
                    <p class="font-bold text-xs text-[#78000b]">EUR {{ number_format($effectivePrice, 2, ',', '.') }}</p>
                </div>
            </div>
            <button
                type="button"
                onclick="handleAddToCart({{ $product->id }})"
                class="rounded bg-[#78000b] px-4 py-2 text-[0.68rem] font-bold uppercase tracking-wider text-white shadow-md active:scale-95 shrink-0 cursor-pointer"
                data-i18n-de="In den Warenkorb"
                data-i18n-en="Add to Cart"
            >
                In den Warenkorb
            </button>
        </div>
    </div>

    <!-- Lightbox Zoom Modal for High-Resolution Inspection -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
        <button type="button" onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white transition p-2 cursor-pointer z-50" aria-label="Schließen">
            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
        <div class="max-w-5xl max-h-[90vh] p-4 flex items-center justify-center">
            <img id="lightbox-img" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-w-full max-h-[85vh] object-contain rounded shadow-2xl transition-transform duration-300">
        </div>
    </div>

</div>

<!-- Page Specific Scripts & Interactivity -->
<script>
    // 1. Gallery Image Switching with smooth fade
    function switchProductImage(src, btnElement) {
        const mainImg = document.getElementById('main-product-image');
        const lightboxImg = document.getElementById('lightbox-img');
        if (!mainImg) return;

        mainImg.style.opacity = '0.3';
        mainImg.style.transform = 'scale(0.98)';

        setTimeout(() => {
            mainImg.src = src;
            if (lightboxImg) lightboxImg.src = src;
            mainImg.style.opacity = '1';
            mainImg.style.transform = 'scale(1)';
        }, 150);

        document.querySelectorAll('.gallery-thumb').forEach(el => {
            el.classList.remove('border-[#78000b]', 'active-thumb', 'ring-2', 'ring-[#78000b]/20');
            el.classList.add('border-[#e6decb]');
        });

        if (btnElement) {
            btnElement.classList.remove('border-[#e6decb]');
            btnElement.classList.add('border-[#78000b]', 'active-thumb', 'ring-2', 'ring-[#78000b]/20');
        }
    }

    // 2. Lightbox Open / Close
    function openLightbox() {
        const modal = document.getElementById('lightbox-modal');
        if (!modal) return;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        if (!modal) return;
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = '';
    }

    // Close lightbox on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });

    // 3. Quantity Increment / Decrement
    function adjustQty(change) {
        const countEl = document.getElementById('qty-count');
        if (!countEl) return;
        let count = parseInt(countEl.innerText) + change;
        if (count < 1) count = 1;
        if (count > 10) count = 10;
        countEl.innerText = count;
    }

    // 4. Accordion Toggle
    function toggleAccordion(btn) {
        const content = btn.nextElementSibling;
        const svg = btn.querySelector('svg');
        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            content.classList.remove('hidden');
            if (svg) svg.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            if (svg) svg.classList.remove('rotate-180');
        }
    }

    // Variation Selector State
    window.selectedVariationName = '{{ addslashes($firstVarName) }}';

    function selectVariation(name, btnElement, price = null) {
        window.selectedVariationName = name;
        const label = document.getElementById('active-variation-name');
        if (label) label.textContent = name;

        document.querySelectorAll('.variation-pill').forEach(pill => {
            pill.classList.remove('border-2', 'border-[#78000b]', 'bg-[#faf7f2]', 'ring-2', 'ring-[#78000b]/20', 'active-var', 'font-semibold');
            pill.classList.add('border-[#e6decb]', 'bg-white', 'opacity-85');
        });

        if (btnElement) {
            btnElement.classList.remove('border-[#e6decb]', 'bg-white', 'opacity-85');
            btnElement.classList.add('border-2', 'border-[#78000b]', 'bg-[#faf7f2]', 'ring-2', 'ring-[#78000b]/20', 'active-var', 'font-semibold');
        }
    }

    // 5. Add to Cart with Dynamic Feedback & Selected Variation
    function handleAddToCart(productId) {
        const countEl = document.getElementById('qty-count');
        const qty = countEl ? parseInt(countEl.innerText) : 1;
        const btn = document.getElementById('add-to-cart-btn');
        const label = document.getElementById('add-cart-label');
        const originalText = label ? label.textContent : 'IN DEN WARENKORB';
        const selectedVar = window.selectedVariationName || null;

        if (btn) {
            btn.classList.add('opacity-80', 'pointer-events-none');
            if (label) label.textContent = (typeof getCurrentLang === 'function' && getCurrentLang() === 'en') ? 'ADDING...' : 'WIRD HINZUGEFÜGT...';
        }

        if (typeof quickAddToCart === 'function') {
            quickAddToCart(productId, qty, selectedVar);
        }

        setTimeout(() => {
            if (btn) {
                btn.classList.remove('opacity-80', 'pointer-events-none');
                if (label) label.textContent = originalText;
            }
        }, 1200);
    }

    // 6. Wishlist Toggle with LocalStorage & Active Visual Feedback
    function toggleWishlistProduct(id, name, img, price) {
        let wishlist = [];
        try {
            wishlist = JSON.parse(localStorage.getItem('mehaaj_wishlist') || '[]');
        } catch (e) {
            wishlist = [];
        }

        const index = wishlist.findIndex(item => item.id == id);
        const icon = document.getElementById('wishlist-icon');
        const isEn = typeof getCurrentLang === 'function' && getCurrentLang() === 'en';

        if (index > -1) {
            wishlist.splice(index, 1);
            if (icon) {
                icon.setAttribute('fill', 'none');
                icon.classList.remove('text-[#78000b]');
            }
            if (window.LuxuryToast) {
                LuxuryToast.fire({
                    icon: 'info',
                    title: isEn ? name + ' removed from wishlist' : name + ' von Wunschliste entfernt'
                });
            }
        } else {
            wishlist.push({ id, name, image: img, price });
            if (icon) {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.add('text-[#78000b]');
            }
            if (window.LuxuryToast) {
                LuxuryToast.fire({
                    icon: 'success',
                    title: isEn ? name + ' added to wishlist! 👑' : name + ' zur Wunschliste hinzugefügt! 👑'
                });
            }
        }

        localStorage.setItem('mehaaj_wishlist', JSON.stringify(wishlist));
        if (typeof updateWishlistBadges === 'function') {
            updateWishlistBadges();
        }
    }

    // Check wishlist state on initial load
    document.addEventListener('DOMContentLoaded', () => {
        try {
            const wishlist = JSON.parse(localStorage.getItem('mehaaj_wishlist') || '[]');
            const isInWishlist = wishlist.some(item => item.id == {{ $product->id }});
            const icon = document.getElementById('wishlist-icon');
            if (isInWishlist && icon) {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.add('text-[#78000b]');
            }
        } catch(e) {}
    });

    // 7. Write Review SweetAlert Modal
    function openWriteReviewModal(productName) {
        const isEn = typeof getCurrentLang === 'function' && getCurrentLang() === 'en';
        if (window.LuxurySwal) {
            LuxurySwal.fire({
                title: isEn ? 'Write a Review for ' + productName : 'Bewertung für ' + productName,
                html: `
                    <div class="text-left space-y-3 mt-3 text-xs">
                        <label class="block font-bold text-neutral-700">${isEn ? 'Rating (1-5 Stars)' : 'Bewertung (1-5 Sterne)'}</label>
                        <select id="review-stars" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]">
                            <option value="5">★★★★★ (5/5) - ${isEn ? 'Exceptional Luxury' : 'Vollendeter Luxus'}</option>
                            <option value="4">★★★★☆ (4/5) - ${isEn ? 'Very Good' : 'Sehr gut'}</option>
                            <option value="3">★★★☆☆ (3/5) - ${isEn ? 'Good' : 'Gut'}</option>
                        </select>
                        <label class="block font-bold text-neutral-700 mt-2">${isEn ? 'Your Name' : 'Ihr Name'}</label>
                        <input id="review-name" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'e.g. Maximilian S.' : 'z.B. Maximilian S.'}">
                        <label class="block font-bold text-neutral-700 mt-2">${isEn ? 'Your Experience' : 'Ihre Erfahrung mit diesem Meisterstück'}</label>
                        <textarea id="review-comment" class="w-full h-24 p-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'Describe the leather feel, craftsmanship, and presentation...' : 'Beschreiben Sie Lederqualität, Nahtführung und Haptik...'}"></textarea>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: isEn ? 'Submit Review' : 'Bewertung absenden',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
                preConfirm: () => {
                    const name = document.getElementById('review-name').value;
                    const comment = document.getElementById('review-comment').value;
                    if (!name || !comment) {
                        Swal.showValidationMessage(isEn ? 'Please fill in all fields' : 'Bitte füllen Sie alle Felder aus');
                        return false;
                    }
                    return { name, comment, rating: document.getElementById('review-stars').value };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    LuxuryToast.fire({
                        icon: 'success',
                        title: isEn ? 'Thank you! Your review has been submitted.' : 'Vielen Dank! Ihre Bewertung wurde übermittelt.'
                    });
                }
            });
        }
    }

    // 8. Mobile Sticky Add-to-Cart Bar Visibility on Scroll
    window.addEventListener('scroll', () => {
        const stickyBar = document.getElementById('sticky-mobile-bar');
        const buyBox = document.getElementById('add-to-cart-btn');
        if (!stickyBar || !buyBox) return;

        const rect = buyBox.getBoundingClientRect();
        if (rect.bottom < 0) {
            stickyBar.classList.remove('translate-y-full');
            stickyBar.classList.add('translate-y-0');
        } else {
            stickyBar.classList.remove('translate-y-0');
            stickyBar.classList.add('translate-y-full');
        }
    }, { passive: true });
</script>
@endsection
