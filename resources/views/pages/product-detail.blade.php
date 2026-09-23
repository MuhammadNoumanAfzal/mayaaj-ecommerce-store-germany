@extends('layouts.app')
@section('title', ($product->name ?? 'Produkt Details') . ' - MEHAAJ Luxury Leather')

@section('content')
<div class="pt-20">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <a href="/shop" class="hover:text-[#78000b] transition" data-i18n-de="Kollektion" data-i18n-en="Collection">Kollektion</a>
            <span>/</span>
            @if($product->category)
                <a href="/shop?category={{ $product->category->slug }}" class="hover:text-[#78000b] transition">{{ $product->category->name }}</a>
                <span>/</span>
            @endif
            <span class="text-[#1c1210] font-medium">{{ $product->name }}</span>
        </div>
    </nav>

    <!-- Main Product Showcase Section -->
    <section class="bg-white py-10 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Interactive Product Gallery (7 cols) -->
                <div class="lg:col-span-7 flex flex-col gap-4">
                    <!-- Main Image Display -->
                    <div class="relative overflow-hidden rounded-md border border-[#e6decb] bg-[#f7f4ee] shadow-sm group">
                        <!-- Top Gold Line Shimmer -->
                        <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                        <!-- Top Left Badge -->
                        @if($product->is_featured)
                            <div class="absolute left-4 top-4 z-10">
                                <span class="rounded-sm bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-luxury text-white shadow-md animate-pulse">
                                    BESTSELLER
                                </span>
                            </div>
                        @endif

                        <img
                            id="main-product-image"
                            src="{{ $product->image_url }}"
                            alt="{{ $product->name }}"
                            class="h-[380px] sm:h-[480px] lg:h-[540px] w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 cursor-zoom-in"
                        >

                        <div class="absolute right-4 bottom-4 z-10 flex items-center gap-1.5 rounded bg-white/90 px-3 py-1.5 text-[0.65rem] font-bold text-[#1c1210] backdrop-blur border border-[#e6decb] shadow-sm transition duration-300 group-hover:bg-[#78000b] group-hover:text-white">
                            <svg class="h-3.5 w-3.5 text-[#78000b] group-hover:text-white transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                            <span data-i18n-de="ZOOMEN" data-i18n-en="ZOOM">ZOOMEN</span>
                        </div>
                    </div>

                    <!-- Gallery Thumbnails (Main Image & Extra Images) -->
                    <div class="grid grid-cols-4 gap-3">
                        <button
                            type="button"
                            onclick="switchProductImage('{{ $product->image_url }}', this)"
                            class="gallery-thumb active-thumb group relative overflow-hidden rounded border-2 border-[#78000b] bg-[#f7f4ee] p-1 transition-all duration-300 hover:scale-105 shadow-sm cursor-pointer"
                        >
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-20 w-full object-cover rounded-sm transition-transform duration-300 group-hover:scale-110">
                        </button>

                        @if(!empty($product->gallery_images) && is_array($product->gallery_images))
                            @foreach($product->gallery_images as $gImg)
                                <button
                                    type="button"
                                    onclick="switchProductImage('{{ asset('storage/' . $gImg) }}', this)"
                                    class="gallery-thumb group relative overflow-hidden rounded border-2 border-[#e6decb] bg-[#f7f4ee] p-1 transition-all duration-300 hover:border-[#78000b] hover:scale-105 shadow-sm cursor-pointer"
                                >
                                    <img src="{{ asset('storage/' . $gImg) }}" alt="Detail View" class="h-20 w-full object-cover rounded-sm transition-transform duration-300 group-hover:scale-110">
                                </button>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Right Column: Product Buy Box & Details (5 cols) -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <!-- Category & Rating -->
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                                {{ $product->category->name ?? 'MEHAAJ LUXURY' }}
                            </span>
                            <div class="flex items-center gap-1.5 text-xs text-[#685c54]">
                                <div class="flex text-[#d8b45a] text-sm tracking-wider">★ ★ ★ ★ ★</div>
                                <span class="font-medium text-[#1c1210]">4.9</span>
                                <a href="#reviews" class="text-xs text-[#685c54] underline hover:text-[#78000b] transition cursor-pointer">(48)</a>
                            </div>
                        </div>

                        <!-- Product Title -->
                        <h1 class="mt-2 font-display text-3xl font-medium leading-tight text-[#1c1210] sm:text-4xl">
                            {{ $product->name }}
                        </h1>

                        <!-- SKU & Stock status -->
                        <div class="mt-1 flex items-center gap-3 text-xs text-[#685c54]">
                            <span>SKU: <strong class="font-mono text-[#1c1210]">{{ $product->sku }}</strong></span>
                            <span>•</span>
                            <span class="text-[#2e683a] font-bold">✓ Auf Lager ({{ $product->stock }} Stück)</span>
                        </div>

                        <!-- Pricing & German VAT Legal Notice -->
                        <div class="mt-4 border-b border-[#f2ebdc] pb-4">
                            <div class="flex items-baseline gap-3">
                                <span class="font-display text-3xl font-bold text-[#1c1210]">EUR {{ number_format($product->price, 2, ',', '.') }}</span>
                                @if($product->sale_price)
                                    <span class="text-sm text-[#8a7c74] line-through">EUR {{ number_format($product->sale_price, 2, ',', '.') }}</span>
                                    <span class="rounded bg-[#78000b]/10 px-2 py-0.5 text-xs font-bold text-[#78000b]">ANGEBOT</span>
                                @endif
                            </div>

                            <p class="mt-1 text-[0.7rem] text-[#685c54]">
                                <span data-i18n-de="inkl. MwSt." data-i18n-en="incl. VAT">inkl. MwSt.</span>, 
                                <a href="/versand" class="underline hover:text-[#78000b] transition cursor-pointer" data-i18n-de="zzgl. Versandkosten" data-i18n-en="plus shipping costs">zzgl. Versandkosten</a>
                            </p>

                            <!-- Delivery Status Badge -->
                            <div class="mt-3 flex items-center gap-2 text-xs text-[#2e683a] bg-[#2e683a]/8 px-3 py-1.5 rounded-sm border border-[#2e683a]/20 w-fit shadow-xs">
                                <span class="h-2 w-2 rounded-full bg-[#2e683a] animate-pulse"></span>
                                <span class="font-medium" data-i18n-de="Auf Lager – In 1–3 Werktagen bei Ihnen (Gratis DHL Versand in DE)" data-i18n-en="In Stock – Delivery in 1–3 working days (Free DHL Shipping in DE)">
                                    Auf Lager – In 1–3 Werktagen bei Ihnen (Gratis DHL Versand in DE)
                                </span>
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="mt-5 text-xs sm:text-sm text-[#5c4f46] leading-relaxed">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Quantity Selector & Action CTA Buttons -->
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <!-- Quantity counter -->
                            <div class="flex h-12 items-center rounded border border-[#e6decb] bg-[#faf7f2] px-2 w-32 justify-between shadow-xs">
                                <button type="button" onclick="adjustQty(-1)" class="h-8 w-8 flex items-center justify-center font-bold text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer">-</button>
                                <span id="qty-count" class="font-bold text-sm text-[#1c1210]">1</span>
                                <button type="button" onclick="adjustQty(1)" class="h-8 w-8 flex items-center justify-center font-bold text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer">+</button>
                            </div>

                            <!-- Add to Cart CTA -->
                            <button
                                type="button"
                                id="add-to-cart-btn"
                                onclick="triggerAddToCartAnimation({{ $product->id }})"
                                class="group/btn flex-1 flex h-12 items-center justify-center gap-2 rounded bg-[#78000b] px-6 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl active:scale-95 cursor-pointer"
                            >
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover/btn:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                                </svg>
                                <span id="add-cart-label" data-i18n-de="IN DEN WARENKORB" data-i18n-en="ADD TO CART">IN DEN WARENKORB</span>
                            </button>

                            <!-- Wishlist button -->
                            <button
                                type="button"
                                onclick="openWishlistModal()"
                                class="h-12 w-12 flex items-center justify-center rounded border border-[#e6decb] bg-white text-[#78000b] shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:scale-105 active:scale-95 cursor-pointer"
                                title="Add to wishlist"
                            >
                                <svg class="h-5 w-5 transition duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <!-- Trust Features List -->
                        <div class="mt-8 grid grid-cols-3 gap-3 border-t border-[#f2ebdc] pt-6 text-center text-[0.68rem] text-[#5c4f46]">
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="100% Vollleder" data-i18n-en="100% Full Grain">100% Vollleder</span>
                            </div>
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="2 Jahre Garantie" data-i18n-en="2-Year Warranty">2 Jahre Garantie</span>
                            </div>
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="1" y="3" width="15" height="13"/>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                    <circle cx="5.5" cy="18.5" r="2.5"/>
                                    <circle cx="18.5" cy="18.5" r="2.5"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="30 Tage Retoure" data-i18n-en="30-Day Returns">30 Tage Retoure</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Product Details & Craftsmanship Section -->
    <section class="bg-[#faf7f2] py-12 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container max-w-4xl">
            <div class="text-center mb-8">
                <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="MANUFAKTUR & CRAFTSMANSHIP" data-i18n-en="MANUFACTURING & CRAFTSMANSHIP">MANUFAKTUR & CRAFTSMANSHIP</span>
                <h2 class="mt-2 font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Details, Material & Herkunft" data-i18n-en="Details, Material & Origin">
                    Details, Material & Herkunft
                </h2>
            </div>

            <div class="divide-y divide-[#e6decb] rounded-md border border-[#e6decb] bg-white shadow-sm overflow-hidden">

                <!-- Accordion Item 1: Feinsattler Kunst -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span>Handwerkskunst & Details</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <p class="text-xs sm:text-sm leading-relaxed">
                            {{ $product->craftsmanship ?? 'Handgefertigt aus erstklassigem Vollleder mit vergoldeten Beschlägen und robuster Nahtführung.' }}
                        </p>
                    </div>
                </div>

                <!-- Accordion Item 2: Versand & Retoure -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Versand & Kostenlose Retoure in DE" data-i18n-en="Shipping & Free Returns in DE">Versand & Kostenlose Retoure in DE</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content hidden px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <p class="text-xs sm:text-sm leading-relaxed" data-i18n-de="Der Versand erfolgt versichert via DHL Express. Innerhalb Deutschlands ist der Versand kostenlos. Sie können den Artikel 30 Tage lang kostenfrei zurücksenden." data-i18n-en="Shipping is insured via DHL Express. Free shipping within Germany. You may return the item free of charge within 30 days.">
                            Der Versand erfolgt versichert via DHL Express. Innerhalb Deutschlands ist der Versand kostenlos. Sie können den Artikel 30 Tage lang kostenfrei zurücksenden.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Products Cross-Sell Section -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="bg-[#faf7f2] py-12 lg:py-16">
            <div class="luxury-container">
                <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#e6decb] pb-6">
                    <div>
                        <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="ÄHNLICHE MEISTERWERKE" data-i18n-en="SIMILAR MASTERPIECES">ÄHNLICHE MEISTERWERKE</span>
                        <h2 class="mt-2 font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Das könnte Ihnen auch gefallen" data-i18n-en="You May Also Like">
                            Das könnte Ihnen auch gefallen
                        </h2>
                    </div>
                </div>

                <!-- Related Products Cards Grid -->
                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($relatedProducts as $rel)
                        <article class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-sm transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                            <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                            <div class="relative h-56 overflow-hidden bg-[#f7f4ee]">
                                <a href="{{ route('shop.show', $rel->slug) }}" class="block h-full w-full">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                                </a>
                            </div>
                            <div class="p-5 flex flex-col justify-between flex-1">
                                <div>
                                    <span class="text-[0.58rem] font-bold uppercase tracking-[0.18em] text-[#78000b]">{{ $rel->category->name ?? 'MEHAAJ' }}</span>
                                    <a href="{{ route('shop.show', $rel->slug) }}" class="block">
                                        <h3 class="mt-1 font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300">{{ $rel->name }}</h3>
                                    </a>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-3">
                                    <span class="font-bold text-base text-[#1c1210]">EUR {{ number_format($rel->price, 2, ',', '.') }}</span>
                                    <a href="{{ route('shop.show', $rel->slug) }}" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-xs transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Page Specific Vanilla JS Scripts -->
    <script>
        function switchProductImage(src, btnElement) {
            document.getElementById('main-product-image').src = src;
            document.querySelectorAll('.gallery-thumb').forEach(el => {
                el.classList.remove('border-[#78000b]', 'active-thumb');
                el.classList.add('border-[#e6decb]');
            });
            btnElement.classList.remove('border-[#e6decb]');
            btnElement.classList.add('border-[#78000b]', 'active-thumb');
        }

        function adjustQty(change) {
            const countEl = document.getElementById('qty-count');
            let count = parseInt(countEl.innerText) + change;
            if (count < 1) count = 1;
            if (count > 10) count = 10;
            countEl.innerText = count;
        }

        function toggleAccordion(btn) {
            const content = btn.nextElementSibling;
            const svg = btn.querySelector('svg');
            const isHidden = content.classList.contains('hidden');
            
            if (isHidden) {
                content.classList.remove('hidden');
                svg.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                svg.classList.remove('rotate-180');
            }
        }

        function triggerAddToCartAnimation(productId) {
            const countEl = document.getElementById('qty-count');
            const qty = countEl ? parseInt(countEl.innerText) : 1;
            quickAddToCart(productId, qty);
        }
    </script>
</div>
@endsection
