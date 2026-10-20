@extends('layouts.app')
@section('title', 'Shopping Bag | MEHAAJ® Official Maison')
@section('meta_description', 'Review your selected master-crafted luxury leather goods and precision timepieces. Proceed to secure checkout.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] text-[#1c1210] py-6 sm:py-10">

    <div class="luxury-container">

        <!-- Breadcrumb Navigation -->
        <nav class="mb-5 flex items-center gap-2 text-xs text-[#685c54]">
            <a href="{{ url('/') }}" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span class="text-[#c5baaa]">/</span>
            <a href="{{ route('shop') }}" class="hover:text-[#78000b] transition" data-i18n-de="Kollektion" data-i18n-en="Collection">Kollektion</a>
            <span class="text-[#c5baaa]">/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-de="Warenkorb" data-i18n-en="Shopping Bag">Warenkorb</span>
        </nav>

        <!-- Compact Page Title Banner -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3 border-b border-[#e6decb] pb-4">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-de="MEHAAJ MAISON ATELIER" data-i18n-en="MEHAAJ MAISON ATELIER">MEHAAJ MAISON ATELIER</span>
                </div>
                <h1 class="mt-1 font-display text-2xl sm:text-3xl font-medium tracking-tight text-[#1c1210]" data-i18n-de="Ihr Warenkorb" data-i18n-en="Your Shopping Bag">
                    Ihr Warenkorb
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <span class="rounded-full border border-[#e6decb] bg-white px-3.5 py-1.5 text-xs font-semibold text-[#1c1210] shadow-2xs">
                    <span data-i18n-de="Artikel im Korb:" data-i18n-en="Bag Count:">Artikel im Korb:</span>
                    <span id="page-item-count-badge" class="font-bold text-[#78000b] ml-1">{{ $count ?? count($cart ?? []) }}</span>
                </span>
            </div>
        </div>

        <!-- Main Cart Grid: 8 Cols Items / 4 Cols Summary -->
        <div class="grid gap-6 lg:grid-cols-12 lg:items-start">

            <!-- LEFT COLUMN: Selected Items (8 Cols) -->
            <div class="lg:col-span-8 space-y-4">
                
                <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs">
                    
                    <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3 mb-2">
                        <h2 class="font-display text-lg font-medium text-[#1c1210]" data-i18n-de="Gewählte Artikel" data-i18n-en="Selected Pieces">
                            Gewählte Artikel
                        </h2>
                        <span class="text-xs text-[#685c54]" id="page-item-counter-pill">
                            {{ $count ?? count($cart ?? []) }} {{ ($count ?? count($cart ?? [])) === 1 ? 'Artikel' : 'Artikel' }}
                        </span>
                    </div>

                    <!-- Items Header Labels -->
                    <div class="hidden sm:grid grid-cols-12 text-[0.65rem] font-bold uppercase tracking-wider text-[#8a7c74] border-b border-[#f2ebdc] py-2.5">
                        <span class="col-span-6" data-i18n-de="Produkt" data-i18n-en="Product">Produkt</span>
                        <span class="col-span-2 text-center" data-i18n-de="Preis" data-i18n-en="Price">Preis</span>
                        <span class="col-span-2 text-center" data-i18n-de="Anzahl" data-i18n-en="Qty">Anzahl</span>
                        <span class="col-span-2 text-right" data-i18n-de="Gesamt" data-i18n-en="Total">Gesamt</span>
                    </div>

                    <!-- Cart Item Rows List -->
                    <div id="page-cart-items-wrapper" class="divide-y divide-[#f2ebdc]">
                        @forelse($cart ?? [] as $key => $item)
                            @php
                                $itemKey = $item['item_key'] ?? $key ?? $item['id'];
                                $imgSrc = $item['image_url'] ?? '/productbag.png';
                                $unitPrice = (float) ($item['price'] ?? 0);
                                $qty = (int) ($item['qty'] ?? 1);
                                $lineTotal = $unitPrice * $qty;
                            @endphp
                            <div class="cart-item-row group py-4 transition-all duration-300 hover:bg-[#faf7f2]/40 rounded-lg px-1 sm:px-2" id="cart-row-{{ $itemKey }}" data-item-key="{{ $itemKey }}">
                                <div class="flex flex-col sm:grid sm:grid-cols-12 sm:items-center gap-3">
                                    
                                    <!-- Product Info -->
                                    <div class="sm:col-span-6 flex items-center gap-3.5">
                                        <a href="{{ !empty($item['slug']) ? url('/shop/' . $item['slug']) : url('/shop') }}" class="shrink-0 overflow-hidden rounded-lg border border-[#e6decb] bg-[#f7f4ee]">
                                            <img src="{{ $imgSrc }}" alt="{{ $item['name'] }}" class="h-18 w-18 sm:h-20 sm:w-20 object-cover transition-transform duration-300 group-hover:scale-105">
                                        </a>
                                        <div class="min-w-0 flex-1">
                                            <a href="{{ !empty($item['slug']) ? url('/shop/' . $item['slug']) : url('/shop') }}" class="font-display text-base font-medium text-[#1c1210] hover:text-[#78000b] transition block truncate">
                                                {{ $item['name'] }}
                                            </a>
                                            @if(!empty($item['variation']))
                                                <div class="mt-0.5">
                                                    <span class="inline-flex items-center gap-1 rounded bg-[#faf7f2] border border-[#e6decb] px-2 py-0.5 text-[0.6rem] font-semibold text-[#78000b]">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                                                        {{ $item['variation'] }}
                                                    </span>
                                                </div>
                                            @endif
                                            <p class="text-[0.65rem] text-[#8a7c74] mt-0.5">SKU: {{ $item['sku'] ?? 'MHJ-MANUFAKTUR' }}</p>
                                        </div>
                                    </div>

                                    <!-- Unit Price -->
                                    <div class="hidden sm:block sm:col-span-2 text-center text-xs font-semibold text-[#685c54]">
                                        EUR {{ number_format($unitPrice, 2, ',', '.') }}
                                    </div>

                                    <!-- Quantity Stepper -->
                                    <div class="sm:col-span-2 flex items-center justify-between sm:justify-center">
                                        <span class="sm:hidden text-xs text-[#8a7c74]" data-i18n-de="Anzahl:" data-i18n-en="Qty:">Anzahl:</span>
                                        <div class="flex h-8 items-center rounded-lg border border-[#e6decb] bg-white px-1.5 w-24 justify-between text-xs shadow-2xs">
                                            <button type="button" onclick="updateItemQuantity('{{ $itemKey }}', {{ $qty - 1 }})" class="w-6 h-6 flex items-center justify-center rounded text-sm font-bold text-[#685c54] hover:bg-[#78000b] hover:text-white transition active:scale-90 cursor-pointer">-</button>
                                            <span class="qty-display font-bold text-xs text-[#1c1210]">{{ $qty }}</span>
                                            <button type="button" onclick="updateItemQuantity('{{ $itemKey }}', {{ $qty + 1 }})" class="w-6 h-6 flex items-center justify-center rounded text-sm font-bold text-[#685c54] hover:bg-[#78000b] hover:text-white transition active:scale-90 cursor-pointer">+</button>
                                        </div>
                                    </div>

                                    <!-- Total & Delete -->
                                    <div class="sm:col-span-2 flex items-center justify-between sm:justify-end gap-3">
                                        <div class="text-right">
                                            <span class="text-xs text-[#8a7c74] sm:hidden block" data-i18n-de="Gesamt:" data-i18n-en="Total:">Gesamt:</span>
                                            <span class="font-bold text-sm text-[#1c1210] item-line-total">EUR {{ number_format($lineTotal, 2, ',', '.') }}</span>
                                        </div>
                                        <button type="button" onclick="removeItemFromCart('{{ $itemKey }}')" class="h-7 w-7 flex items-center justify-center rounded-full text-[#8a7c74] hover:bg-[#78000b]/10 hover:text-[#78000b] transition-all cursor-pointer" title="Remove item">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center space-y-3" id="empty-cart-state">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#faf7f2] border border-[#e6decb]">
                                    <svg class="h-8 w-8 text-[#8a7c74]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" stroke-linejoin="round"/>
                                        <path d="M3 6h18"/>
                                        <path d="M16 10a4 4 0 0 1-8 0"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Ihr Warenkorb ist derzeit leer" data-i18n-en="Your Shopping Bag is Empty">
                                    Ihr Warenkorb ist derzeit leer
                                </h3>
                                <p class="text-xs text-[#685c54] max-w-sm mx-auto" data-i18n-de="Entdecken Sie unsere Kollektion handgefertigter Ledertaschen und edler Zeitmesser." data-i18n-en="Discover our handcrafted leather bags, bespoke accessories, and fine timepieces.">
                                    Entdecken Sie unsere Kollektion handgefertigter Ledertaschen und edler Zeitmesser.
                                </p>
                                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-sm hover:bg-[#5a0309] transition">
                                    <span data-i18n-de="Kollektion Entdecken" data-i18n-en="Explore Collections">Kollektion Entdecken</span>
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Cart Action Buttons Footer -->
                    <div class="flex flex-wrap items-center justify-between gap-3 pt-5 border-t border-[#f2ebdc] mt-3">
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-[#685c54] hover:text-[#78000b] transition">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                            <span data-i18n-de="Weiter einkaufen" data-i18n-en="Continue Shopping">Weiter einkaufen</span>
                        </a>

                        <a href="{{ route('checkout.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-sm hover:bg-[#5a0309] hover:shadow-md transition active:scale-95">
                            <span data-i18n-de="ZUR KASSE GEHEN" data-i18n-en="PROCEED TO CHECKOUT">ZUR KASSE GEHEN</span>
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                    </div>

                </div>

                <!-- Slim Trust Reassurance Strip -->
                <div class="flex flex-wrap items-center justify-between gap-3 rounded-lg border border-[#e6decb] bg-white px-4 py-2.5 text-[0.68rem] text-[#685c54] shadow-2xs">
                    <span class="flex items-center gap-1.5">
                        <span class="text-[#d8b45a]">✦</span>
                        <span data-i18n-de="Italienisches Vollnarbenleder & Meisterhandwerk" data-i18n-en="Italian Full-Grain Leather & Master Craft">Italienisches Vollnarbenleder & Meisterhandwerk</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="text-[#2e683a]">✓</span>
                        <span data-i18n-de="Versicherter DHL Express Versand inklusive" data-i18n-en="Insured DHL Express Courier Included">Versicherter DHL Express Versand inklusive</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="text-[#78000b]">🛡️</span>
                        <span data-i18n-de="30 Tage Rückgaberecht" data-i18n-en="30-Day Maison Return Guarantee">30 Tage Rückgaberecht</span>
                    </span>
                </div>

            </div>

            <!-- RIGHT COLUMN: Sticky Order Summary (4 Cols) -->
            <div class="lg:col-span-4 space-y-4">
                <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs sticky top-24 space-y-4">
                    
                    <div class="border-b border-[#f2ebdc] pb-3">
                        <h3 class="font-display text-lg font-medium text-[#1c1210]" data-i18n-de="Bestellübersicht" data-i18n-en="Order Summary">
                            Bestellübersicht
                        </h3>
                        <p class="text-[0.68rem] text-[#8a7c74]" data-i18n-de="Preise inkl. gesetzlicher Mehrwertsteuer" data-i18n-en="All prices include statutory VAT">
                            Preise inkl. gesetzlicher Mehrwertsteuer
                        </p>
                    </div>

                    <!-- Voucher Box -->
                    <div>
                        <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Gutscheincode" data-i18n-en="Voucher Code">Gutscheincode</label>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                id="page-voucher-input"
                                placeholder="MEHAAJ10"
                                class="flex-1 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-1.5 text-xs text-[#1c1210] uppercase placeholder-[#8a7c74] focus:border-[#78000b] focus:bg-white focus:outline-none"
                            >
                            <button
                                type="button"
                                onclick="applyPageVoucher()"
                                class="rounded-lg bg-[#1c1210] px-3.5 py-1.5 text-[0.62rem] font-bold uppercase tracking-wider text-white hover:bg-[#78000b] transition cursor-pointer"
                                data-i18n-de="EINLÖSEN"
                                data-i18n-en="APPLY"
                            >
                                EINLÖSEN
                            </button>
                        </div>
                        <p id="page-voucher-success" class="hidden text-[0.65rem] font-bold text-[#2e683a] mt-1.5" data-i18n-de="Gutschein MEHAAJ10 (-10%) angewendet! ✓" data-i18n-en="Voucher MEHAAJ10 (-10%) applied! ✓">
                            Gutschein MEHAAJ10 (-10%) angewendet! ✓
                        </p>
                    </div>

                    <!-- Cost Breakdown Rows -->
                    <div class="space-y-2.5 text-xs text-[#5c4f46] border-t border-[#f2ebdc] pt-3.5">
                        
                        <div class="flex justify-between items-center">
                            <span data-i18n-de="Zwischensumme" data-i18n-en="Subtotal">Zwischensumme</span>
                            <span id="page-subtotal-display" class="font-bold text-[#1c1210]">EUR {{ number_format($subtotal ?? 0, 2, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center text-[0.7rem] text-[#685c54]">
                            <span data-i18n-de="Enthaltene 19% MwSt." data-i18n-en="Included 19% VAT">Enthaltene 19% MwSt.</span>
                            <span id="page-vat-display">EUR {{ number_format($vat ?? 0, 2, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span data-i18n-de="Versicherter Expressversand" data-i18n-en="Insured Express Courier">Versicherter Expressversand</span>
                            <span class="font-bold text-[#1c1210]" data-i18n-de="Inklusive" data-i18n-en="Complimentary">Inklusive</span>
                        </div>

                        <div id="voucher-discount-row" class="hidden justify-between items-center text-[#2e683a] font-bold">
                            <span>MEHAAJ VIP (-10%)</span>
                            <span id="voucher-discount-val">- EUR 0,00</span>
                        </div>

                        <div class="flex justify-between items-baseline text-base font-bold text-[#1c1210] border-t border-[#e6decb] pt-3">
                            <span data-i18n-de="Gesamtsumme" data-i18n-en="Total Amount">Gesamtsumme</span>
                            <span id="page-total-display" class="font-display text-xl font-bold text-[#78000b]">
                                EUR {{ number_format($total ?? 0, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Proceed to Dedicated Checkout Page Button -->
                    <a
                        href="{{ route('checkout.index') }}"
                        class="w-full flex h-11 items-center justify-center gap-2 rounded-lg bg-[#78000b] px-4 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-sm hover:bg-[#5a0309] hover:shadow-md transition active:scale-95 cursor-pointer"
                    >
                        <span data-i18n-de="ZUR KASSE GEHEN" data-i18n-en="PROCEED TO CHECKOUT">ZUR KASSE GEHEN</span>
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>

                    <!-- Available Payment Badges Note -->
                    <div class="pt-2 text-center text-[0.65rem] text-[#685c54] border-t border-[#f2ebdc]">
                        <p class="font-semibold text-[#1c1210] mb-1" data-i18n-de="Verfügbare Zahlungsarten an der Kasse:" data-i18n-en="Available Payment Options at Checkout:">
                            Verfügbare Zahlungsarten an der Kasse:
                        </p>
                        <div class="flex items-center justify-center gap-3 text-[#1c1210] font-medium">
                            <span class="inline-flex items-center gap-1">💵 <span data-i18n-de="Nachnahme (COD)" data-i18n-en="Cash on Delivery (COD)">Nachnahme (COD)</span></span>
                            <span>•</span>
                            <span class="inline-flex items-center gap-1">🏛️ <span data-i18n-de="Banküberweisung (Vorkasse)" data-i18n-en="Bank Transfer (Prepayment)">Banküberweisung (Vorkasse)</span></span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- Interactive Cart Page JavaScript -->
<script>
    let rawPageTotal = {{ (float) ($total ?? 0) }};
    let isPageVoucherApplied = false;

    function updateItemQuantity(itemKey, newQty) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (newQty <= 0) {
            removeItemFromCart(itemKey);
            return;
        }

        fetch(window.mehaajUrl('/cart/update'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ item_key: itemKey, product_id: itemKey, quantity: newQty })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const row = document.getElementById('cart-row-' + itemKey);
                if (row) {
                    const qtyEl = row.querySelector('.qty-display');
                    if (qtyEl) qtyEl.innerText = newQty;

                    const minusBtn = row.querySelector('button:first-of-type');
                    const plusBtn = row.querySelector('button:last-of-type');
                    if (minusBtn) minusBtn.setAttribute('onclick', `updateItemQuantity('${itemKey}', ${newQty - 1})`);
                    if (plusBtn) plusBtn.setAttribute('onclick', `updateItemQuantity('${itemKey}', ${newQty + 1})`);

                    const currentItem = data.cart.find(it => (it.item_key === itemKey || it.id == itemKey));
                    if (currentItem) {
                        const lineTotalEl = row.querySelector('.item-line-total');
                        if (lineTotalEl) {
                            lineTotalEl.innerText = 'EUR ' + (currentItem.price * currentItem.qty).toFixed(2).replace('.', ',');
                        }
                    }
                }

                syncPageTotals(data);

                if (typeof renderCartDrawerContent === 'function') {
                    renderCartDrawerContent(data);
                }
            }
        })
        .catch(err => {
            console.error('Update quantity error:', err);
        });
    }

    function removeItemFromCart(itemKey) {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

        LuxurySwal.fire({
            title: isEn ? 'Remove Item?' : 'Artikel entfernen?',
            text: isEn ? 'Are you sure you want to remove this piece from your bag?' : 'Möchten Sie diesen Artikel wirklich aus Ihrem Warenkorb entfernen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: isEn ? 'Yes, remove' : 'Ja, entfernen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch(window.mehaajUrl('/cart/remove'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ item_key: itemKey, product_id: itemKey })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById('cart-row-' + itemKey);
                        if (row) {
                            row.classList.add('opacity-0', 'scale-95');
                            setTimeout(() => {
                                row.remove();
                                if (!data.cart || data.cart.length === 0) {
                                    showEmptyCartState();
                                }
                            }, 250);
                        }

                        syncPageTotals(data);

                        if (typeof renderCartDrawerContent === 'function') {
                            renderCartDrawerContent(data);
                        }

                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'Item removed from bag' : 'Artikel aus dem Warenkorb entfernt'
                        });
                    }
                });
            }
        });
    }

    function syncPageTotals(data) {
        rawPageTotal = data.total;
        
        const badge = document.getElementById('page-item-count-badge');
        const pill = document.getElementById('page-item-counter-pill');
        if (badge) badge.innerText = data.count;
        if (pill) pill.innerText = data.count + ' ' + (data.count === 1 ? 'Artikel' : 'Artikel');

        if (document.getElementById('page-subtotal-display')) {
            document.getElementById('page-subtotal-display').innerText = data.formatted_subtotal;
        }
        if (document.getElementById('page-vat-display')) {
            document.getElementById('page-vat-display').innerText = data.formatted_vat;
        }

        let finalTotal = isPageVoucherApplied ? rawPageTotal * 0.9 : rawPageTotal;
        if (document.getElementById('page-total-display')) {
            document.getElementById('page-total-display').innerText = 'EUR ' + finalTotal.toFixed(2).replace('.', ',');
        }

        if (isPageVoucherApplied) {
            const discountAmount = rawPageTotal * 0.1;
            const discountRow = document.getElementById('voucher-discount-row');
            const discountVal = document.getElementById('voucher-discount-val');
            if (discountRow) discountRow.classList.remove('hidden'), discountRow.classList.add('flex');
            if (discountVal) discountVal.innerText = '- EUR ' + discountAmount.toFixed(2).replace('.', ',');
        }

        document.querySelectorAll('.cart-badge-count').forEach(b => {
            b.innerText = data.count;
        });
    }

    function showEmptyCartState() {
        const wrapper = document.getElementById('page-cart-items-wrapper');
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        if (wrapper) {
            wrapper.innerHTML = `
                <div class="py-12 text-center space-y-3" id="empty-cart-state">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#faf7f2] border border-[#e6decb]">
                        <svg class="h-8 w-8 text-[#8a7c74]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" stroke-linejoin="round"/>
                            <path d="M3 6h18"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-medium text-[#1c1210]">
                        ${isEn ? 'Your Shopping Bag is Empty' : 'Ihr Warenkorb ist derzeit leer'}
                    </h3>
                    <p class="text-xs text-[#685c54] max-w-sm mx-auto">
                        ${isEn ? 'Discover our handcrafted leather bags, bespoke accessories, and fine timepieces.' : 'Entdecken Sie unsere Kollektion handgefertigter Ledertaschen und edler Zeitmesser.'}
                    </p>
                    <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-sm hover:bg-[#5a0309] transition">
                        <span>${isEn ? 'Explore Collections' : 'Kollektion Entdecken'}</span>
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                </div>
            `;
        }
    }

    function applyPageVoucher() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const input = document.getElementById('page-voucher-input').value.trim();
        const successMsg = document.getElementById('page-voucher-success');

        if (rawPageTotal <= 0) {
            LuxurySwal.fire({
                icon: 'warning',
                title: isEn ? 'Cart is Empty' : 'Warenkorb ist leer',
                text: isEn ? 'Please add products before redeeming a promo voucher.' : 'Bitte fügen Sie Produkte hinzu, bevor Sie einen Gutschein einlösen.',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (input.toUpperCase() === 'MEHAAJ10') {
            isPageVoucherApplied = true;
            if (successMsg) successMsg.classList.remove('hidden');

            const discountAmount = rawPageTotal * 0.1;
            const discountedTotal = rawPageTotal * 0.9;

            const discountRow = document.getElementById('voucher-discount-row');
            const discountVal = document.getElementById('voucher-discount-val');
            if (discountRow) discountRow.classList.remove('hidden'), discountRow.classList.add('flex');
            if (discountVal) discountVal.innerText = '- EUR ' + discountAmount.toFixed(2).replace('.', ',');

            if (document.getElementById('page-total-display')) {
                document.getElementById('page-total-display').innerText = 'EUR ' + discountedTotal.toFixed(2).replace('.', ',');
            }

            LuxurySwal.fire({
                icon: 'success',
                title: isEn ? 'VIP Voucher Applied! 🎉' : 'VIP-Gutscheincode Eingelöst! 🎉',
                text: isEn ? 'A 10% discount has been applied to your order.' : 'Ihnen wurden 10% Rabatt auf Ihre Bestellung gutgeschrieben.',
                confirmButtonText: isEn ? 'Wonderful' : 'Wunderbar'
            });
        } else {
            LuxurySwal.fire({
                icon: 'error',
                title: isEn ? 'Invalid Voucher' : 'Ungültiger Code',
                text: isEn ? 'The voucher entered is not valid. Try: MEHAAJ10' : 'Der Gutscheincode ist ungültig. Versuchen Sie: MEHAAJ10',
                confirmButtonText: isEn ? 'Try Again' : 'Erneut versuchen'
            });
        }
    }
</script>
@endsection
