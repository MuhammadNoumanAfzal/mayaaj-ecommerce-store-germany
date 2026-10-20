@php
    $featuredList = (isset($globalFeaturedProducts) && $globalFeaturedProducts->count() > 0)
        ? $globalFeaturedProducts
        : \App\Models\Product::where('status', 'active')->where('is_featured', true)->with(['category', 'subcategory'])->take(8)->get();
@endphp

@if($featuredList->count() > 0)
<section class="relative overflow-hidden bg-gradient-to-b from-[#f3ece2] via-[#f7f4ee] to-[#f4efe6] py-6 sm:py-8 lg:py-10 border-b border-[#dfd6c4] text-[#1c1210]" aria-labelledby="featured-products-heading">
    <!-- Ambient Warm Golden Glow -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_0%,rgba(216,180,90,0.12),transparent_70%)]"></div>

    <div class="w-full max-w-[1800px] mx-auto px-3 sm:px-5 lg:px-7 relative z-10">
        <!-- Compact Elegant Section Header -->
        <div class="flex flex-row items-center justify-between gap-3 border-b border-[#dfd6c4] pb-2 sm:pb-2.5 reveal-on-scroll">
            <div class="flex items-center gap-3">
                <h2 id="featured-products-heading" class="font-display text-xl sm:text-2xl lg:text-3xl font-medium leading-none text-[#1c1210] tracking-tight" data-i18n-en="Featured Masterpieces" data-i18n-de="Ausgewählte Meisterwerke">
                    Featured Masterpieces
                </h2>
                <span class="hidden sm:inline-block text-[0.68rem] uppercase font-bold tracking-[0.2em] text-[#8c6b2d] bg-[#d8b45a]/15 px-2.5 py-0.5 rounded-full border border-[#d8b45a]/30">
                    Maison Selection
                </span>
            </div>

            <!-- View All in Shop Link -->
            <a href="{{ route('shop') }}" class="group inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#78000b] hover:text-[#500007] transition-all">
                <span data-i18n-en="Explore All Creations" data-i18n-de="Alle Kreationen entdecken">Explore All Creations</span>
                <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Luxury Product Grid with Dual-Image Hover Animation -->
        <div class="mt-4 sm:mt-5 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 reveal-on-scroll reveal-delay-100">
            @foreach ($featuredList as $prod)
                @php
                    $pName = $prod->name;
                    $pSlug = $prod->slug;
                    $pCat = $prod->category->name ?? 'Haute Maroquinerie';
                    $pImg = $prod->image_url;
                    $pHoverImg = $prod->hover_image_url ?? $pImg;
                    $pPrice = '€' . number_format($prod->price, 2, '.', ',');
                    $pSalePrice = $prod->sale_price ? '€' . number_format($prod->sale_price, 2, '.', ',') : null;
                    $detailUrl = route('shop.show', $pSlug);
                    $prodPayload = htmlspecialchars(json_encode([
                        'id' => $prod->id,
                        'name' => $pName,
                        'price' => $pPrice,
                        'sale_price' => $pSalePrice,
                        'image' => $pImg,
                        'category' => $pCat,
                        'slug' => $pSlug,
                        'description' => $prod->description ?? null,
                    ]), ENT_QUOTES, 'UTF-8');
                @endphp
                <article
                    data-url="{{ $detailUrl }}"
                    onclick="if (!event.target.closest('button, a')) { window.location.assign(this.dataset.url); }"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-white shadow-[0_4px_16px_rgba(28,18,16,0.06)] hover:shadow-[0_12px_32px_rgba(120,0,11,0.14)] hover:border-[#d8b45a] transition-all duration-400 ease-out hover:-translate-y-1.5 cursor-pointer select-none"
                >
                    <!-- Top Shimmer Gold Accent Line on Hover -->
                    <div class="pointer-events-none absolute inset-x-0 top-0 z-30 h-1 origin-left scale-x-0 bg-gradient-to-r from-[#78000b] via-[#ffd45a] to-[#78000b] transition-transform duration-500 group-hover:scale-x-100"></div>

                    <!-- Visual Media Container: Dual Image Hover Swap & Soft Zoom -->
                    <div class="relative aspect-square sm:aspect-[4/4.2] overflow-hidden bg-[#f5f1e8] border-b border-[#ebdccb]">
                        <!-- Primary Product Photo -->
                        <img
                            src="{{ $pImg }}"
                            alt="{{ $pName }}"
                            class="absolute inset-0 h-full w-full object-cover transition-all duration-600 ease-out group-hover:scale-108 {{ $pHoverImg !== $pImg ? 'group-hover:opacity-0' : '' }}"
                            loading="lazy"
                        >

                        @if($pHoverImg && $pHoverImg !== $pImg)
                            <!-- Secondary Product Photo (Reveals on Hover) -->
                            <img
                                src="{{ $pHoverImg }}"
                                alt="{{ $pName }} Detail"
                                class="absolute inset-0 h-full w-full object-cover opacity-0 transition-all duration-600 ease-out group-hover:opacity-100 group-hover:scale-108"
                                loading="lazy"
                            >
                        @endif

                        <!-- Floating Badges: Bestseller / Exclusive -->
                        <div class="pointer-events-none absolute top-2.5 left-2.5 z-20 flex flex-col gap-1">
                            @if($prod->sale_price)
                                <span class="rounded bg-[#78000b] px-2 py-0.5 text-[0.58rem] font-bold uppercase tracking-wider text-white shadow-xs">
                                    Special Offer
                                </span>
                            @else
                                <span class="rounded bg-[#120807]/85 backdrop-blur-md px-2 py-0.5 text-[0.58rem] font-bold uppercase tracking-wider text-[#ffd45a] border border-[#d8b45a]/40 shadow-xs">
                                    Atelier
                                </span>
                            @endif
                        </div>

                        <!-- Top-Right Floating Wishlist & Quick Actions -->
                        <div class="absolute top-2.5 right-2.5 z-20 flex flex-col gap-1.5">
                            <button
                                type="button"
                                data-wishlist-btn-id="{{ $prod->id }}"
                                onclick="event.stopPropagation(); toggleWishlistProduct(JSON.parse(this.dataset.product), this)"
                                data-product="{{ $prodPayload }}"
                                class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-full border border-[#d8b45a]/50 bg-white/95 text-neutral-700 shadow-md transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:scale-110 cursor-pointer"
                                aria-label="Add to wishlist"
                                title="Wishlist"
                            >
                                <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                                </svg>
                            </button>
                            <button
                                type="button"
                                onclick="event.stopPropagation(); openQuickViewModal(JSON.parse(this.dataset.product))"
                                data-product="{{ $prodPayload }}"
                                class="hidden sm:flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/50 bg-white/95 text-[#1c1210] shadow-md transition-all duration-300 hover:bg-[#d8b45a] hover:text-[#1c1210] hover:scale-110 cursor-pointer"
                                aria-label="Quick View"
                                title="Quick View"
                            >
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="6.5" />
                                    <path d="m16 16 4 4" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>

                        <!-- Hover Visual Banner -->
                        <div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 py-1 text-center bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.16em] text-white/90 drop-shadow">Alternate View</span>
                        </div>
                    </div>

                    <!-- Product Content & Details Area -->
                    <div class="p-3 sm:p-4 flex flex-col justify-between flex-1 bg-white">
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

                        <!-- Two Action Buttons: Details & Add to Cart -->
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
                                onclick="event.stopPropagation(); quickAddToCart({{ $prod->id }}, 1)"
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
            @endforeach
        </div>
    </div>
</section>
@endif
