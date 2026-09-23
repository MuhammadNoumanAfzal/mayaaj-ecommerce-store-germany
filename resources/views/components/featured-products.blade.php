@php
    $products = [
        [
            'name_de' => 'Maison Leder Handtasche',
            'name_en' => 'Maison Grand Leather Tote',
            'category_de' => 'Leder Taschen',
            'category_en' => 'Leather Bags',
            'badge' => 'BESTSELLER',
            'rating' => 5,
            'price' => 'EUR 289',
            'original_price' => 'EUR 340',
            'image' => '/productbag.png',
            'position' => 'center center',
        ],
        [
            'name_de' => 'Leder Geldbörse Premium',
            'name_en' => 'Bespoke Zip Leather Wallet',
            'category_de' => 'Geldbörsen & Etuis',
            'category_en' => 'Wallets & Cardholders',
            'badge' => 'NEU',
            'rating' => 5,
            'price' => 'EUR 129',
            'original_price' => 'EUR 149',
            'image' => '/productwallet.png',
            'position' => 'center center',
        ],
        [
            'name_de' => 'Executive Schlüsselanhänger',
            'name_en' => 'Executive Leather Key Ring',
            'category_de' => 'Luxus Accessoires',
            'category_en' => 'Luxury Accessories',
            'badge' => 'LIMITED',
            'rating' => 5,
            'price' => 'EUR 59',
            'original_price' => null,
            'image' => '/productKeychain.png',
            'position' => 'center center',
        ],
        [
            'name_de' => 'Royal Golf Executive Carry',
            'name_en' => 'Royal Executive Golf Carry',
            'category_de' => 'Golf & Sport',
            'category_en' => 'Golf & Lifestyle',
            'badge' => 'LUXURY',
            'rating' => 5,
            'price' => 'EUR 450',
            'original_price' => 'EUR 490',
            'image' => '/productgolf.png',
            'position' => 'center center',
        ],
    ];
@endphp

<section class="relative overflow-hidden bg-[#ffffff] py-12 text-[#1f1614] sm:py-14 lg:py-16 border-b border-[#e6decb]" aria-labelledby="featured-products-heading">
    <!-- Ambient Background Light Accent -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(216,180,90,0.08),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        <!-- Light Section Header -->
        <div class="flex flex-col gap-4 border-b border-[#e6decb] pb-6 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-de="EXKLUSIVE SELEKTION" data-i18n-en="EXCLUSIVE SELECTION">EXKLUSIVE SELEKTION</span>
                </div>
                <h2 id="featured-products-heading" class="mt-3 font-display text-3xl font-medium leading-tight text-[#1c1210] sm:text-4xl lg:text-5xl" data-i18n-de="Ausgewählte Stücke" data-i18n-en="Featured Pieces">
                    Ausgewählte Stücke
                </h2>
            </div>
            <p class="max-w-md text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-de="Eine handverlesene Kollektion unserer beliebtesten Meisterwerke für zeitlose Eleganz." data-i18n-en="A handpicked collection of our most coveted masterpieces for timeless elegance.">
                Eine handverlesene Kollektion unserer beliebtesten Meisterwerke für zeitlose Eleganz.
            </p>
        </div>

        <!-- Dynamic Light Product Cards Grid -->
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $displayProducts = (isset($globalFeaturedProducts) && $globalFeaturedProducts->count() > 0)
                    ? $globalFeaturedProducts
                    : collect($products);
            @endphp

            @foreach ($displayProducts as $prod)
                @php
                    $pName = is_object($prod) ? $prod->name : $prod['name_de'];
                    $pSlug = is_object($prod) ? $prod->slug : 'maison-leather-tote';
                    $pCat = is_object($prod) ? ($prod->category->name ?? 'Exklusiv') : $prod['category_de'];
                    $pImg = is_object($prod) ? $prod->image_url : $prod['image'];
                    $pPrice = is_object($prod) ? 'EUR ' . number_format($prod->price, 2, ',', '.') : $prod['price'];
                    $pSalePrice = is_object($prod) && $prod->sale_price ? 'EUR ' . number_format($prod->sale_price, 2, ',', '.') : (is_array($prod) ? ($prod['original_price'] ?? null) : null);
                    $pBadge = is_object($prod) ? ($prod->is_featured ? 'EXKLUSIV' : '') : ($prod['badge'] ?? '');
                @endphp
                <article class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-[0_6px_25px_rgba(0,0,0,0.05)] transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] outline-none focus:outline-none focus:ring-0 cursor-pointer">
                    
                    <!-- Top Gold Line Shimmer -->
                    <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b] transition-transform duration-500 group-hover:scale-x-100"></div>

                    <!-- Image Container -->
                    <div class="relative h-60 overflow-hidden bg-[#f7f4ee] sm:h-64">
                        <a href="/shop/{{ $pSlug }}" class="block h-full w-full">
                            <img
                                src="{{ $pImg }}"
                                alt="{{ $pName }}"
                                class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108"
                                loading="lazy"
                            >
                        </a>

                        <!-- Top Left Badge -->
                        @if(!empty($pBadge))
                            <div class="absolute left-3 top-3 z-10 pointer-events-none">
                                <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-md animate-pulse">
                                    {{ $pBadge }}
                                </span>
                            </div>
                        @endif

                        <!-- Floating Action Icons (Wishlist & Quick View) -->
                        <div class="absolute right-3 top-3 z-10 flex flex-col gap-2 opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                            <button onclick="openWishlistModal()" class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-white/90 text-[#78000b] shadow-md transition hover:bg-[#78000b] hover:text-white cursor-pointer" type="button" aria-label="Add to wishlist">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <a href="/shop/{{ $pSlug }}" class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-white/90 text-[#1c1210] shadow-md transition hover:bg-[#d8b45a] hover:text-[#1c1210] cursor-pointer" aria-label="View Product">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="11" cy="11" r="6.5" />
                                    <path d="m16 16 4 4" stroke-linecap="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Details Area -->
                    <div class="p-5 flex flex-col justify-between flex-1 bg-white">
                        <div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[0.6rem] font-bold uppercase tracking-[0.18em] text-[#78000b]">
                                    {{ $pCat }}
                                </p>
                                <!-- Star Rating -->
                                <div class="flex items-center text-[#d8b45a] text-[0.65rem] tracking-wider" aria-label="5 stars">
                                    ★ ★ ★ ★ ★
                                </div>
                            </div>

                            <a href="/shop/{{ $pSlug }}" class="block">
                                <h3 class="mt-2.5 min-h-[2.8rem] font-display text-lg font-medium leading-[1.3] text-[#1c1210] transition-colors duration-300 group-hover:text-[#78000b]">
                                    {{ $pName }}
                                </h3>
                            </a>
                        </div>

                        <!-- Price & Add to Cart -->
                        <div class="mt-4 flex items-center justify-between gap-2 border-t border-[#f2ebdc] pt-4">
                            <div class="flex flex-col">
                                <span class="text-base font-bold text-[#1c1210]">{{ $pPrice }}</span>
                                @if(!empty($pSalePrice))
                                    <span class="text-[0.65rem] text-[#8a7c74] line-through">{{ $pSalePrice }}</span>
                                @endif
                            </div>

                            @php
                                $pId = is_object($prod) ? $prod->id : 1;
                            @endphp
                            <button onclick="quickAddToCart({{ $pId }}, 1)" class="group/btn inline-flex items-center justify-center gap-1.5 rounded-sm bg-[#d8b45a] px-3.5 py-2.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-[#120807] shadow-sm transition-all duration-300 hover:bg-[#ffd45a] hover:shadow-[0_4px_20px_rgba(216,180,90,0.4)] active:scale-95 cursor-pointer" type="button">
                                <span data-i18n-de="IN WARENKORB" data-i18n-en="ADD TO CART">IN WARENKORB</span>
                                <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover/btn:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
