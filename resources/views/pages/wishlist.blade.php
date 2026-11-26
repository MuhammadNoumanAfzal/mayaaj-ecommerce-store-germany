@extends('layouts.app')
@section('title', 'Merkzettel & Gespeicherte Favoriten - MEHAAJ Luxury Atelier')

@section('content')
<main class="min-h-screen bg-[#faf7f2] py-8 sm:py-12 text-[#1c1210]">
    <div class="max-w-[1180px] mx-auto px-4 sm:px-6">

        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-[#8a7c74] mb-6 font-medium">
            <a href="{{ route('home') }}" class="hover:text-[#78000b] transition">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-[#78000b] transition" data-i18n-en="Atelier Shop" data-i18n-de="Atelier Shop">Atelier Shop</a>
            <span>/</span>
            <span class="text-[#78000b] font-semibold" data-i18n-en="Wishlist" data-i18n-de="Merkzettel">Merkzettel</span>
        </nav>

        <!-- Wishlist Header & Actions Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#dfd6c4] pb-6 mb-8">
            <div>
                <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-en="PERSONAL CURATION" data-i18n-de="PERSÖNLICHE AUSWAHL">PERSÖNLICHE AUSWAHL</span>
                <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#1c1210] mt-1" data-i18n-en="Saved Creations & Atelier Wishlist" data-i18n-de="Merkzettel & Gespeicherte Favoriten">
                    Merkzettel & Gespeicherte Favoriten
                </h1>
                <p class="text-xs text-[#685c54] mt-1">
                    <span id="wishlist-header-count" class="font-bold text-[#1c1210]">{{ $wishlistItems->count() }}</span>
                    <span data-i18n-en="exclusive creations saved in your personal salon." data-i18n-de="exklusive Kreationen in Ihrem persönlichen Salon gemerkt.">exklusive Kreationen in Ihrem persönlichen Salon gemerkt.</span>
                </p>
            </div>

            @if($wishlistItems->count() > 0)
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        onclick="moveAllWishlistToBag()"
                        id="move-all-btn"
                        class="h-11 px-5 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-md transition active:scale-95 cursor-pointer flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        <span data-i18n-en="MOVE ALL TO BAG" data-i18n-de="ALLE IN DEN WARENKORB">ALLE IN DEN WARENKORB</span>
                    </button>
                </div>
            @endif
        </div>

        @if($wishlistItems->count() > 0)
            <!-- Wishlist Products Grid -->
            <div id="wishlist-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($wishlistItems as $item)
                    @php
                        $prod = $item->product;
                        if (!$prod) continue;
                        $effPrice = ($prod->sale_price && $prod->sale_price < $prod->price) ? (float)$prod->sale_price : (float)$prod->price;
                        $priceFormatted = currency_format($effPrice);
                        $hasSale = ($prod->sale_price && $prod->sale_price < $prod->price);
                        $currCode = session('currency', 'EUR');
                    @endphp
                    <div id="wishlist-card-{{ $prod->id }}" class="group relative flex flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-white shadow-2xs hover:shadow-md hover:border-[#d8b45a] transition-all duration-300">
                        
                        <!-- Product Visual & Remove Button -->
                        <div class="relative aspect-square overflow-hidden bg-[#f5f1e8] border-b border-[#ebdccb]">
                            <a href="{{ route('shop.show', $prod->slug) }}" class="block h-full w-full">
                                <img
                                    src="{{ $prod->image_url }}"
                                    alt="{{ $prod->name }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                >
                            </a>

                            <!-- Remove from Wishlist Button -->
                            <button
                                type="button"
                                onclick="removeWishlistItem({{ $prod->id }})"
                                class="absolute top-2.5 right-2.5 w-8 h-8 rounded-full bg-white/90 border border-[#d9cebc] text-[#8a7c74] hover:text-[#78000b] hover:bg-white flex items-center justify-center transition shadow-xs cursor-pointer z-10"
                                title="Vom Merkzettel entfernen"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>

                            @if($hasSale)
                                <span class="absolute top-2.5 left-2.5 rounded bg-[#78000b] px-2 py-0.5 text-[0.6rem] font-bold uppercase tracking-wider text-white">
                                    Sale
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 flex flex-col justify-between flex-1">
                            <div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">
                                    {{ $prod->category->name ?? 'Haute Maroquinerie' }}
                                </span>
                                <a href="{{ route('shop.show', $prod->slug) }}" class="block mt-1">
                                    <h3 class="font-display text-sm font-medium text-[#1c1210] group-hover:text-[#78000b] transition line-clamp-1">
                                        {{ $prod->name }}
                                    </h3>
                                </a>

                                <!-- Price Display in Active Currency -->
                                <div class="mt-2 flex items-baseline gap-2 flex-wrap">
                                    <span class="font-sans text-base font-bold text-[#1c1210]">
                                        {{ $priceFormatted }}
                                    </span>
                                    @if($hasSale)
                                        <span class="text-xs text-[#8a7c74] line-through font-mono">
                                            {{ currency_format($prod->price) }}
                                        </span>
                                    @endif
                                    @if($currCode !== 'EUR')
                                        <span class="text-[0.65rem] text-[#8a7c74] font-mono">
                                            (ca. €{{ number_format($effPrice, 2) }})
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-1 flex items-center gap-1.5 text-[0.68rem] text-[#2e683a] font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#2e683a] animate-pulse"></span>
                                    <span data-i18n-en="In Stock • Ready to Dispatch" data-i18n-de="Auf Lager • Versandfertig">Auf Lager • Versandfertig</span>
                                </div>
                            </div>

                            <!-- 1-Click Move to Bag Action -->
                            <div class="mt-4 pt-3 border-t border-[#f0e7d8]">
                                <button
                                    type="button"
                                    onclick="moveSingleToBag({{ $prod->id }}, this)"
                                    class="w-full h-10 rounded-lg bg-[#d8b45a] hover:bg-[#ffd45a] text-[#120807] text-xs font-bold uppercase tracking-[0.12em] transition-all shadow-xs flex items-center justify-center gap-1.5 active:scale-95 cursor-pointer"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                    <span data-i18n-en="IN DEN WARENKORB" data-i18n-de="IN DEN WARENKORB">IN DEN WARENKORB</span>
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Elegant Empty State -->
            <div id="wishlist-empty-state" class="rounded-2xl border border-dashed border-[#d9cebc] bg-white p-10 sm:p-14 text-center max-w-lg mx-auto shadow-2xs">
                <div class="w-16 h-16 rounded-full bg-[#faf7f2] border border-[#d9cebc] flex items-center justify-center mx-auto mb-4 text-[#78000b]">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-en="Your Atelier Wishlist is Empty" data-i18n-de="Ihr Merkzettel ist derzeit leer">
                    Ihr Merkzettel ist derzeit leer
                </h2>
                <p class="text-xs text-[#685c54] mt-2 mb-6 max-w-sm mx-auto leading-relaxed" data-i18n-en="Explore our handcrafted leather goods and luxury timepieces. Save your favorites with the heart icon." data-i18n-de="Entdecken Sie unsere handgefertigten Lederwaren und Uhren. Merken Sie sich Ihre Favoriten mit dem Herz-Symbol.">
                    Entdecken Sie unsere handgefertigten Lederwaren und Uhren. Merken Sie sich Ihre Favoriten mit dem Herz-Symbol.
                </p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-md transition active:scale-95">
                    <span data-i18n-en="DISCOVER THE ATELIER" data-i18n-de="KOLLEKTION ENTDECKEN">KOLLEKTION ENTDECKEN</span>
                    <span>→</span>
                </a>
            </div>
        @endif

        <!-- Curated Recommendations Grid -->
        @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
            <div class="mt-14 pt-10 border-t border-[#dfd6c4]">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-en="RECOMMENDATIONS" data-i18n-de="EMPFEHLUNGEN">EMPFEHLUNGEN</span>
                        <h2 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210] mt-0.5" data-i18n-en="Curated for Connoisseurs" data-i18n-de="Für Kenner Ausgewählt">
                            Für Kenner Ausgewählt
                        </h2>
                    </div>
                    <a href="{{ route('shop') }}" class="text-xs font-bold uppercase tracking-wider text-[#78000b] hover:underline">
                        <span data-i18n-en="View All →" data-i18n-de="Alle ansehen →">Alle ansehen →</span>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($recommendedProducts as $rec)
                        @php
                            $recEffPrice = ($rec->sale_price && $rec->sale_price < $rec->price) ? (float)$rec->sale_price : (float)$rec->price;
                            $recPriceFormatted = currency_format($recEffPrice);
                        @endphp
                        <div class="group relative flex flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-white shadow-2xs hover:border-[#d8b45a] transition">
                            <div class="relative aspect-square overflow-hidden bg-[#f5f1e8]">
                                <a href="{{ route('shop.show', $rec->slug) }}">
                                    <img src="{{ $rec->image_url }}" alt="{{ $rec->name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                </a>
                                <button
                                    type="button"
                                    onclick="event.stopPropagation(); window.toggleWishlist({{ $rec->id }}, this)"
                                    data-wishlist-btn-id="{{ $rec->id }}"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-white/90 border border-[#d9cebc] text-[#78000b] flex items-center justify-center hover:bg-[#78000b] hover:text-white transition cursor-pointer"
                                    title="Save to Wishlist"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                                </button>
                            </div>
                            <div class="p-3">
                                <span class="text-[0.6rem] font-bold uppercase text-[#78000b]">{{ $rec->category->name ?? 'Luxury' }}</span>
                                <a href="{{ route('shop.show', $rec->slug) }}" class="block mt-0.5">
                                    <h4 class="font-display text-xs font-semibold text-[#1c1210] truncate group-hover:text-[#78000b] transition">{{ $rec->name }}</h4>
                                </a>
                                <p class="font-sans text-xs font-bold text-[#1c1210] mt-1">{{ $recPriceFormatted }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</main>

<script>
    function removeWishlistItem(productId) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        fetch('/wishlist/' + productId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const card = document.getElementById('wishlist-card-' + productId);
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        const countEl = document.getElementById('wishlist-header-count');
                        if (countEl) countEl.textContent = data.count;
                        document.querySelectorAll('.wishlist-badge-count').forEach(el => el.textContent = data.count);

                        if (data.count === 0) {
                            window.location.reload();
                        }
                    }, 300);
                }
                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({ icon: 'info', title: 'Artikel vom Merkzettel entfernt.' });
                }
            }
        })
        .catch(err => console.error('Remove error:', err));
    }

    function moveSingleToBag(productId, btnEl) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const origText = btnEl.innerHTML;
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="animate-pulse">Wird übertragen...</span>';

        fetch('/wishlist/' + productId + '/move-to-bag', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            btnEl.disabled = false;
            btnEl.innerHTML = origText;

            if (data.success) {
                const card = document.getElementById('wishlist-card-' + productId);
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        const countEl = document.getElementById('wishlist-header-count');
                        if (countEl) countEl.textContent = data.wishlist_count;
                        document.querySelectorAll('.wishlist-badge-count').forEach(el => el.textContent = data.wishlist_count);
                        document.querySelectorAll('.cart-badge-count').forEach(el => el.textContent = data.cart_count);

                        if (data.wishlist_count === 0) {
                            window.location.reload();
                        }
                    }, 300);
                }

                if (typeof openCartDrawer === 'function') {
                    openCartDrawer();
                    if (typeof fetchAndUpdateCartDrawer === 'function') fetchAndUpdateCartDrawer(false);
                }

                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({ icon: 'success', title: data.message });
                }
            }
        })
        .catch(err => {
            btnEl.disabled = false;
            btnEl.innerHTML = origText;
            console.error('Move to bag error:', err);
        });
    }

    function moveAllWishlistToBag() {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const btn = document.getElementById('move-all-btn');
        if (!btn) return;

        const origText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="animate-pulse">Alle werden übertragen...</span>';

        fetch('{{ route("wishlist.move-all-to-bag") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = origText;

            if (data.success) {
                document.querySelectorAll('.wishlist-badge-count').forEach(el => el.textContent = 0);
                document.querySelectorAll('.cart-badge-count').forEach(el => el.textContent = data.cart_count);

                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({ icon: 'success', title: data.message });
                }

                setTimeout(() => {
                    window.location.href = '{{ route("cart.index") }}';
                }, 1000);
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = origText;
            console.error('Move all error:', err);
        });
    }
</script>
@endsection
