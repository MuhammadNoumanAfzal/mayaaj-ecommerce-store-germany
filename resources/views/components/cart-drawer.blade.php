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
                    <span id="drawer-item-count" class="text-xs text-[#78000b] font-bold ml-1">({{ count(session('cart', [])) }})</span>
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
                <span id="shipping-progress-pct" class="text-[0.68rem] text-[#78000b] font-bold animate-pulse">100%</span>
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
    <div id="drawer-items-container" class="flex-1 overflow-y-auto p-5 divide-y divide-[#f2ebdc] space-y-4">
        <!-- Rendered dynamically via JavaScript fetchAndUpdateCartDrawer() -->
        <div class="py-12 text-center text-xs text-[#8a7c74]">
            <p class="animate-pulse">Warenkorb wird geladen...</p>
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
                <span id="drawer-subtotal" class="font-bold text-[#1c1210]">EUR 0,00</span>
            </div>
            <div class="flex justify-between text-[0.68rem] text-[#685c54]">
                <span data-i18n-de="inkl. 19% MwSt." data-i18n-en="incl. 19% VAT">inkl. 19% MwSt.</span>
                <span id="drawer-vat">EUR 0,00</span>
            </div>
            <div class="flex justify-between">
                <span data-i18n-de="Versand (DHL Express)" data-i18n-en="Shipping (DHL Express)">Versand (DHL Express)</span>
                <span class="font-bold text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
            </div>
            <div class="flex justify-between text-base font-bold text-[#1c1210] border-t border-[#e6decb] pt-2">
                <span data-i18n-de="Gesamtsumme" data-i18n-en="Total">Gesamtsumme</span>
                <span id="drawer-total" class="text-[#78000b]">EUR 0,00</span>
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

<!-- Global JavaScript State Manager for Dynamic Cart Drawer -->
<script>
    let rawCartTotal = 0;
    let isVoucherApplied = false;

    document.addEventListener('DOMContentLoaded', () => {
        fetchAndUpdateCartDrawer();
    });

    function openCartDrawer() {
        fetchAndUpdateCartDrawer();
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

    function fetchAndUpdateCartDrawer() {
        fetch('/cart/data', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;
            renderCartDrawerContent(data);
        })
        .catch(err => console.error('Cart drawer fetch error:', err));
    }

    function renderCartDrawerContent(data) {
        const container = document.getElementById('drawer-items-container');
        const itemCountEl = document.getElementById('drawer-item-count');
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

        // Update Navbar Badges
        document.querySelectorAll('.cart-badge-count').forEach(badge => {
            badge.innerText = data.count;
        });

        itemCountEl.innerText = '(' + data.count + ')';

        // Render Cart Items
        if (!data.cart || data.cart.length === 0) {
            container.innerHTML = `
                <div class="py-12 text-center space-y-4">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#faf7f2] border border-[#e6decb]">
                        <svg class="h-8 w-8 text-[#8a7c74]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round"/>
                            <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="font-display text-base font-medium text-[#1c1210]">
                        ${isEn ? 'Your cart is currently empty.' : 'Ihr Warenkorb ist derzeit leer.'}
                    </p>
                    <a href="/shop" onclick="closeCartDrawer()" class="inline-flex items-center justify-center rounded bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white hover:bg-[#5a0309] transition">
                        ${isEn ? 'Explore Collection' : 'Kollektion Entdecken'}
                    </a>
                </div>
            `;
        } else {
            let html = '';
            data.cart.forEach(item => {
                const itemTotal = (item.price * item.qty).toFixed(2).replace('.', ',');
                const imgSrc = item.image_url || '/productbag.png';

                html += `
                    <div class="cart-drawer-item pt-4 first:pt-0 flex gap-4 items-center group/item transition-all duration-300 p-2 rounded hover:bg-[#faf7f2]/80">
                        <img src="${imgSrc}" alt="${item.name}" class="h-20 w-20 rounded border border-[#e6decb] object-cover bg-[#f7f4ee] transition-transform duration-500 group-hover/item:scale-105">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-display text-sm font-medium text-[#1c1210] truncate group-hover/item:text-[#78000b] transition">${item.name}</h3>
                                <button type="button" onclick="removeDrawerItem(${item.id})" class="text-[#8a7c74] hover:text-[#78000b] transition-transform hover:scale-110 cursor-pointer" title="Remove item">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-[0.68rem] text-[#685c54] mt-0.5">SKU: ${item.sku || 'MHJ-MANUFAKTUR'}</p>
                            
                            <div class="mt-2 flex items-center justify-between">
                                <div class="flex h-7 items-center rounded border border-[#e6decb] bg-white px-1 w-20 justify-between text-xs shadow-xs">
                                    <button type="button" onclick="updateDrawerQty(${item.id}, ${item.qty - 1})" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">-</button>
                                    <span class="qty-num font-bold text-[#1c1210]">${item.qty}</span>
                                    <button type="button" onclick="updateDrawerQty(${item.id}, ${item.qty + 1})" class="w-5 text-center font-bold hover:text-[#78000b] transition active:scale-90 cursor-pointer">+</button>
                                </div>
                                <span class="font-bold text-sm text-[#1c1210]">EUR ${itemTotal}</span>
                            </div>
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        // Totals & Free Shipping Calculation
        rawCartTotal = data.total;
        document.getElementById('drawer-subtotal').innerText = data.formatted_subtotal;
        document.getElementById('drawer-vat').innerText = data.formatted_vat;

        let finalTotal = isVoucherApplied ? rawCartTotal * 0.9 : rawCartTotal;
        document.getElementById('drawer-total').innerText = 'EUR ' + finalTotal.toFixed(2).replace('.', ',');

        // Shipping progress
        const shippingPct = data.free_shipping_progress || 100;
        const progressBar = document.getElementById('shipping-progress-bar');
        const progressPct = document.getElementById('shipping-progress-pct');
        const progressText = document.getElementById('shipping-progress-text');

        if (progressBar) progressBar.style.width = shippingPct + '%';
        if (progressPct) progressPct.innerText = shippingPct + '%';
        if (progressText) {
            if (shippingPct >= 100) {
                progressText.innerText = isEn ? 'Free Shipping Unlocked! 🎉' : 'Gratis Versand freigeschaltet! 🎉';
            } else {
                const diff = (150 - data.subtotal).toFixed(2).replace('.', ',');
                progressText.innerText = isEn ? `Add EUR ${diff} for Free Shipping!` : `Noch EUR ${diff} bis zum Gratis Versand!`;
            }
        }
    }

    function updateDrawerQty(productId, newQty) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: productId, quantity: newQty })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                renderCartDrawerContent(data);
                if (typeof recalcPageCart === 'function') {
                    recalcPageCart();
                }
            }
        });
    }

    function removeDrawerItem(productId) {
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
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderCartDrawerContent(data);
                        if (typeof recalcPageCart === 'function') {
                            recalcPageCart();
                        }
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'Item removed from shopping cart' : 'Artikel aus dem Warenkorb entfernt'
                        });
                    }
                });
            }
        });
    }

    function applyDrawerVoucher() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const input = document.getElementById('drawer-voucher-input').value.trim();
        const msg = document.getElementById('voucher-message');
        if (input.toUpperCase() === 'MEHAAJ10') {
            isVoucherApplied = true;
            msg.classList.remove('hidden');
            let discounted = rawCartTotal * 0.9;
            document.getElementById('drawer-total').innerText = 'EUR ' + discounted.toFixed(2).replace('.', ',');
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
