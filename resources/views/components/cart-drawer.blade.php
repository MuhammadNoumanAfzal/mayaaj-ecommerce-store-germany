<!-- Global Slide-Over Cart Drawer Component -->
<div id="cart-drawer-backdrop" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-md transition-opacity duration-500 opacity-0 pointer-events-none cursor-pointer" onclick="closeCartDrawer()"></div>

<div id="cart-drawer-panel" class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-white shadow-2xl transition-transform duration-500 translate-x-full border-l border-[#e6decb] flex flex-col justify-between overflow-hidden">
    
    <!-- Drawer Header -->
    <div class="border-b border-[#e6decb] bg-[#faf7f2] p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                </svg>
                <h2 class="font-display text-lg font-medium text-[#1c1210]">
                    <span data-i18n-de="Ihr Warenkorb" data-i18n-en="Your Cart">Ihr Warenkorb</span> 
                    <span id="drawer-item-count" class="text-xs text-[#78000b] font-bold ml-1">(2)</span>
                </h2>
            </div>
            <button type="button" onclick="closeCartDrawer()" class="h-8 w-8 flex items-center justify-center rounded-full text-[#1c1210] hover:bg-[#78000b] hover:text-white transition-all duration-300 hover:rotate-90 cursor-pointer" aria-label="Close cart">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Free German Shipping Progress Bar -->
        <div class="mt-4 rounded border border-[#e6decb] bg-white p-3.5 shadow-xs">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="font-bold text-[#1c1210]" id="shipping-progress-text" data-i18n-de="Gratis Versand freigeschaltet! 🎉" data-i18n-en="Free Shipping Unlocked! 🎉">
                    Gratis Versand freigeschaltet! 🎉
                </span>
                <span class="text-[0.68rem] text-[#78000b] font-bold animate-pulse">100%</span>
            </div>
            <div class="h-2 w-full overflow-hidden rounded-full bg-[#f2ebdc]">
                <div id="shipping-progress-bar" class="h-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b] transition-all duration-500" style="width: 100%;"></div>
            </div>
            <p class="mt-1 text-[0.65rem] text-[#685c54]" data-i18n-de="Kostenloser DHL Express Versand innerhalb Deutschlands ab 150 €" data-i18n-en="Free DHL Express shipping within Germany over €150">
                Kostenloser DHL Express Versand innerhalb Deutschlands ab 150 €
            </p>
        </div>
    </div>

    <!-- Drawer Body: Cart Items List -->
    <div class="flex-1 overflow-y-auto p-5 divide-y divide-[#f2ebdc] space-y-4">

        <!-- Item 1 -->
        <div class="cart-drawer-item pt-4 first:pt-0 flex gap-4 items-center group/item transition-all duration-300 p-2 rounded hover:bg-[#faf7f2]/80">
            <img src="/productbag.png" alt="Maison Grand Leather Tote" class="h-20 w-20 rounded border border-[#e6decb] object-cover bg-[#f7f4ee] transition-transform duration-500 group-hover/item:scale-105">
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-display text-sm font-medium text-[#1c1210] truncate group-hover/item:text-[#78000b] transition">Maison Grand Leather Tote</h3>
                    <button type="button" onclick="removeDrawerItem(this, 289)" class="text-[#8a7c74] hover:text-[#78000b] transition-transform hover:scale-110 cursor-pointer" title="Remove item">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
                <p class="text-[0.68rem] text-[#685c54] mt-0.5">Farbe: Cognac Braun</p>
                
                <div class="mt-2 flex items-center justify-between">
                    <div class="flex h-7 items-center rounded border border-[#e6decb] bg-white px-1 w-20 justify-between text-xs shadow-xs">
                        <button type="button" onclick="updateDrawerQty(this, -1, 289)" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">-</button>
                        <span class="qty-num font-bold text-[#1c1210]">1</span>
                        <button type="button" onclick="updateDrawerQty(this, 1, 289)" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">+</button>
                    </div>
                    <span class="font-bold text-sm text-[#1c1210]">EUR 289,00</span>
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="cart-drawer-item pt-4 flex gap-4 items-center group/item transition-all duration-300 p-2 rounded hover:bg-[#faf7f2]/80">
            <img src="/productwallet.png" alt="Bespoke Zip Leather Wallet" class="h-20 w-20 rounded border border-[#e6decb] object-cover bg-[#f7f4ee] transition-transform duration-500 group-hover/item:scale-105">
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-display text-sm font-medium text-[#1c1210] truncate group-hover/item:text-[#78000b] transition">Bespoke Zip Leather Wallet</h3>
                    <button type="button" onclick="removeDrawerItem(this, 129)" class="text-[#8a7c74] hover:text-[#78000b] transition-transform hover:scale-110 cursor-pointer" title="Remove item">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
                <p class="text-[0.68rem] text-[#685c54] mt-0.5">Farbe: Nachtschwarz</p>

                <div class="mt-2 flex items-center justify-between">
                    <div class="flex h-7 items-center rounded border border-[#e6decb] bg-white px-1 w-20 justify-between text-xs shadow-xs">
                        <button type="button" onclick="updateDrawerQty(this, -1, 129)" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">-</button>
                        <span class="qty-num font-bold text-[#1c1210]">1</span>
                        <button type="button" onclick="updateDrawerQty(this, 1, 129)" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">+</button>
                    </div>
                    <span class="font-bold text-sm text-[#1c1210]">EUR 129,00</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Drawer Footer: Voucher, Summary & Express Checkout -->
    <div class="border-t border-[#e6decb] bg-[#faf7f2] p-5 space-y-4">

        <!-- Voucher Code Input -->
        <div class="flex gap-2">
            <input
                type="text"
                id="drawer-voucher-input"
                placeholder="Gutscheincode (z.B. MEHAAJ10)"
                class="flex-1 rounded border border-[#e6decb] bg-white px-3 py-1.5 text-xs text-[#1c1210] placeholder-[#8a7c74] focus:border-[#78000b] focus:outline-none shadow-xs"
            >
            <button
                type="button"
                onclick="applyDrawerVoucher()"
                class="rounded bg-[#1c1210] px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-wider text-white transition-all duration-300 hover:bg-[#78000b] hover:shadow-md cursor-pointer active:scale-95"
                data-i18n-de="EINLÖSEN"
                data-i18n-en="APPLY"
            >
                EINLÖSEN
            </button>
        </div>
        <p id="voucher-message" class="hidden text-[0.65rem] font-bold text-[#2e683a] animate-pulse">Gutscheincode MEHAAJ10 angewendet (-10%) ✓</p>

        <!-- Summary Cost Breakdown -->
        <div class="space-y-1.5 text-xs text-[#5c4f46]">
            <div class="flex justify-between">
                <span data-i18n-de="Zwischensumme" data-i18n-en="Subtotal">Zwischensumme</span>
                <span id="drawer-subtotal" class="font-bold text-[#1c1210]">EUR 418,00</span>
            </div>
            <div class="flex justify-between text-[0.68rem] text-[#685c54]">
                <span data-i18n-de="inkl. 19% MwSt." data-i18n-en="incl. 19% VAT">inkl. 19% MwSt.</span>
                <span id="drawer-vat">EUR 66,74</span>
            </div>
            <div class="flex justify-between">
                <span data-i18n-de="Versand (DHL Express)" data-i18n-en="Shipping (DHL Express)">Versand (DHL Express)</span>
                <span class="font-bold text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
            </div>
            <div class="flex justify-between text-base font-bold text-[#1c1210] border-t border-[#e6decb] pt-2">
                <span data-i18n-de="Gesamtsumme" data-i18n-en="Total">Gesamtsumme</span>
                <span id="drawer-total" class="text-[#78000b]">EUR 418,00</span>
            </div>
        </div>

        <!-- Checkout Buttons -->
        <div class="space-y-2">
            <a
                href="/warenkorb"
                class="group/btn flex w-full h-11 items-center justify-center gap-2 rounded bg-[#78000b] px-4 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl cursor-pointer"
            >
                <span data-i18n-de="ZUR KASSE GEHEN" data-i18n-en="PROCEED TO CHECKOUT">ZUR KASSE GEHEN</span>
                <svg class="h-4 w-4 transition-transform duration-300 group-hover/btn:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <!-- Express Checkout Payment Badges -->
            <div class="grid grid-cols-3 gap-2 pt-1">
                <button type="button" onclick="triggerExpressPayment('PayPal Express Checkout')" class="h-8 rounded bg-[#ffc439] hover:bg-[#f2b82e] flex items-center justify-center text-xs font-bold text-[#003087] transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer shadow-xs" title="PayPal Express">
                    <i>PayPal</i>
                </button>
                <button type="button" onclick="triggerExpressPayment('Klarna Pay Later')" class="h-8 rounded bg-[#ffb3c7] hover:bg-[#f29ebb] flex items-center justify-center text-xs font-bold text-[#111111] transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer shadow-xs" title="Klarna">
                    Klarna.
                </button>
                <button type="button" onclick="triggerExpressPayment('Apple Pay')" class="h-8 rounded bg-black hover:bg-neutral-800 flex items-center justify-center text-xs font-bold text-white transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer shadow-xs" title="Apple Pay">
                     Pay
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Global JavaScript State Manager for Cart Drawer with SweetAlert2 Integration -->
<script>
    let cartDrawerTotal = 418.00;

    function openCartDrawer() {
        const backdrop = document.getElementById('cart-drawer-backdrop');
        const panel = document.getElementById('cart-drawer-panel');
        backdrop.classList.remove('pointer-events-none', 'opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('translate-x-full');
    }

    function closeCartDrawer() {
        const backdrop = document.getElementById('cart-drawer-backdrop');
        const panel = document.getElementById('cart-drawer-panel');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0', 'pointer-events-none');
        panel.classList.add('translate-x-full');
    }

    function updateDrawerQty(btn, change, price) {
        const itemContainer = btn.closest('.cart-drawer-item');
        const qtyEl = itemContainer.querySelector('.qty-num');
        let currentQty = parseInt(qtyEl.innerText) + change;
        if (currentQty < 1) currentQty = 1;
        qtyEl.innerText = currentQty;

        recalculateCartTotal();
    }

    function removeDrawerItem(btn, price) {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Remove Item?' : 'Artikel entfernen?',
            text: isEn ? 'Are you sure you want to remove this item from your shopping cart?' : 'Möchten Sie diesen Artikel wirklich aus Ihrem Warenkorb entfernen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: isEn ? 'Yes, remove' : 'Ja, entfernen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                const itemContainer = btn.closest('.cart-drawer-item');
                itemContainer.remove();
                recalculateCartTotal();
                LuxuryToast.fire({
                    icon: 'success',
                    title: isEn ? 'Item removed from shopping cart' : 'Artikel aus dem Warenkorb entfernt'
                });
            }
        });
    }

    function recalculateCartTotal() {
        let total = 0;
        let count = 0;

        document.querySelectorAll('.cart-drawer-item').forEach(item => {
            const qty = parseInt(item.querySelector('.qty-num').innerText);
            count += qty;
            if (item.innerText.includes('289')) total += 289 * qty;
            if (item.innerText.includes('129')) total += 129 * qty;
        });

        cartDrawerTotal = total;
        document.getElementById('drawer-item-count').innerText = '(' + count + ')';
        document.getElementById('drawer-subtotal').innerText = 'EUR ' + total.toFixed(2).replace('.', ',');
        document.getElementById('drawer-vat').innerText = 'EUR ' + (total * 0.19).toFixed(2).replace('.', ',');
        document.getElementById('drawer-total').innerText = 'EUR ' + total.toFixed(2).replace('.', ',');
    }

    function applyDrawerVoucher() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const input = document.getElementById('drawer-voucher-input').value.trim();
        const msg = document.getElementById('voucher-message');
        if (input.toUpperCase() === 'MEHAAJ10') {
            msg.classList.remove('hidden');
            cartDrawerTotal = cartDrawerTotal * 0.9;
            document.getElementById('drawer-total').innerText = 'EUR ' + cartDrawerTotal.toFixed(2).replace('.', ',');
            LuxurySwal.fire({
                icon: 'success',
                title: isEn ? 'Voucher Code Applied! 🎉' : 'Gutscheincode Eingelöst! 🎉',
                text: isEn ? 'You have received a 10% discount on your order.' : 'Ihnen wurden 10% Rabatt auf Ihre gesamte Bestellung gutgeschrieben.',
                confirmButtonText: isEn ? 'Wonderful' : 'Wunderbar'
            });
        } else {
            LuxurySwal.fire({
                icon: 'error',
                title: isEn ? 'Invalid Code' : 'Ungültiger Code',
                text: isEn ? 'The voucher code entered is not valid. Please try: MEHAAJ10' : 'Der eingegebene Gutscheincode ist nicht gültig. Bitte versuchen Sie: MEHAAJ10',
                confirmButtonText: isEn ? 'Try Again' : 'Erneut versuchen'
            });
        }
    }

    function triggerExpressPayment(provider) {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        LuxurySwal.fire({
            icon: 'info',
            title: provider,
            text: isEn 
                ? 'Connecting to ' + provider + '. Redirecting to secure express checkout...' 
                : 'Verbindung zu ' + provider + ' wird hergestellt. Sie werden zur sicheren Express-Zahlung weitergeleitet...',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    }
</script>
