@if(isset($jewelryProducts) && $jewelryProducts->count() > 0)
<section class="relative overflow-hidden bg-[#0c0605] py-16 lg:py-24 text-white border-b border-[#d8b45a]/30">
    <!-- Ambient Radial Glows -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_50%,rgba(216,180,90,0.14),transparent_70%)]"></div>
    <div class="pointer-events-none absolute -top-24 -right-24 h-80 w-80 rounded-full bg-[#78000b]/30 blur-[100px] animate-float-slow"></div>

    <div class="luxury-container relative z-10">
        <!-- Header -->
        <div class="flex flex-col gap-4 border-b border-[#d8b45a]/20 pb-6 md:flex-row md:items-end md:justify-between reveal-on-scroll">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/40 bg-black/50 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#d8b45a] backdrop-blur-md">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#d8b45a] animate-pulse"></span>
                    <span data-i18n-de="EXKLUSIVER SCHMUCK & CHRONOGRAPHEN" data-i18n-en="EXCLUSIVE JEWELRY & CHRONOGRAPHS">EXCLUSIVE JEWELRY & CHRONOGRAPHS</span>
                </div>
                <h2 class="mt-3 font-display text-3xl font-medium leading-tight text-[#fffaf0] sm:text-4xl lg:text-5xl" data-i18n-de="Schmuck & Edle Zeitmesser" data-i18n-en="Jewelry & Fine Timepieces">
                    Jewelry & Fine Timepieces
                </h2>
            </div>
            <p class="max-w-md text-xs leading-relaxed text-[#e4d9cc]/80 sm:text-sm font-light" data-i18n-de="Handgefertigte Schmuckschatullen aus feinstem Vollleder und präzisionsgefertigte Damen- & Herrenuhren." data-i18n-en="Handcrafted bespoke jewelry and precision-engineered luxury timepieces.">
                Handcrafted bespoke jewelry and precision-engineered luxury timepieces.
            </p>
        </div>

        <!-- Jewelry & Watch Cards Grid -->
        <div class="mt-10 grid gap-8 md:grid-cols-3 reveal-on-scroll reveal-delay-200">
            @foreach($jewelryProducts as $prod)
                @php
                    $prodPayload = htmlspecialchars(json_encode([
                        'id' => $prod->id,
                        'name' => $prod->name,
                        'price' => 'EUR ' . number_format($prod->price, 2, ',', '.'),
                        'sale_price' => $prod->sale_price ? 'EUR ' . number_format($prod->sale_price, 2, ',', '.') : null,
                        'image' => $prod->image_url,
                        'category' => $prod->category->name ?? 'Exklusiv',
                        'slug' => $prod->slug,
                        'description' => $prod->description,
                    ]), ENT_QUOTES, 'UTF-8');
                @endphp
                <div data-url="{{ route('shop.show', $prod->slug) }}" onclick="if (!event.target.closest('button, a')) { window.location.assign(this.dataset.url); }" class="product-card-elevate animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#d8b45a]/30 bg-[#160b09] shadow-2xl cursor-pointer">
                    <div class="relative h-64 overflow-hidden bg-black/40">
                        <a href="{{ route('shop.show', $prod->slug) }}" class="block h-full w-full">
                            <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                        </a>
                        <div class="pointer-events-none absolute top-3 left-3 z-10">
                            <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-widest text-white shadow-md">
                                {{ $prod->category->name ?? 'MEHAAJ' }}
                            </span>
                        </div>
                        <div class="card-floating-actions absolute top-3 right-3 z-30 flex flex-col gap-2">
                            <button
                                type="button"
                                data-wishlist-btn-id="{{ $prod->id }}"
                                onclick="event.stopPropagation(); toggleWishlistProduct(JSON.parse(this.dataset.product), this)"
                                data-product="{{ $prodPayload }}"
                                class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-black/80 text-white transition hover:bg-[#78000b] cursor-pointer"
                                aria-label="Add to wishlist"
                                title="Wishlist"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                            </button>
                            <button
                                type="button"
                                onclick="event.stopPropagation(); openQuickViewModal(JSON.parse(this.dataset.product))"
                                data-product="{{ $prodPayload }}"
                                class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-black/80 text-[#ffd45a] transition hover:bg-[#d8b45a] hover:text-[#120807] cursor-pointer"
                                aria-label="Quick View"
                                title="Quick View"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="6.5" />
                                    <path d="m16 16 4 4" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col justify-between flex-1">
                        <div>
                            <p class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#d8b45a]">{{ $prod->subcategory->name ?? ($prod->category->name ?? 'EXKLUSIV') }}</p>
                            <a href="{{ route('shop.show', $prod->slug) }}">
                                <h3 class="mt-1.5 font-display text-xl font-medium text-[#fffaf0] group-hover:text-[#d8b45a] transition-colors">
                                    {{ $prod->name }}
                                </h3>
                            </a>
                            @if($prod->description)
                                <p class="mt-2 text-xs text-[#e4d9cc]/70 leading-relaxed font-light line-clamp-2">
                                    {{ $prod->description }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-6 flex items-center justify-between border-t border-[#d8b45a]/20 pt-4">
                            <span class="text-lg font-bold text-[#ffd45a]">EUR {{ number_format($prod->price, 2, ',', '.') }}</span>
                            <button onclick="event.stopPropagation(); quickAddToCart({{ $prod->id }}, 1)" type="button" class="inline-flex items-center gap-2 rounded-sm bg-[#d8b45a] px-4 py-2 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#120807] transition hover:bg-[#ffd45a] cursor-pointer shadow-md active:scale-95">
                                <span data-i18n-de="IN WARENKORB" data-i18n-en="ADD TO CART">ADD TO CART</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

