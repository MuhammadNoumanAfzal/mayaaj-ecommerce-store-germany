<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Primary SEO Meta Tags -->
        <title>@yield('title', 'MEHAAJ® Official Maison | Luxury Fashion, Leather Craft & Haute Horlogerie')</title>
        <meta name="description" content="@yield('meta_description', 'MEHAAJ® Official Maison - Timeless Luxury, Master-Crafted Leather Goods & Fine Timepieces. Handcrafted in Europe with premium materials.')">
        <meta name="keywords" content="@yield('meta_keywords', 'luxury fashion, leather bags, handcrafted jewelry, swiss chronographs, designer accessories, Mehaaj maison, european luxury')">
        <meta name="author" content="MEHAAJ Official Maison">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <link rel="canonical" href="@yield('canonical', url()->current())">

        <!-- Open Graph / Facebook / WhatsApp -->
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:site_name" content="MEHAAJ® Official Maison">
        <meta property="og:title" content="@yield('title', 'MEHAAJ® Official Maison | Luxury Fashion, Leather Craft & Haute Horlogerie')">
        <meta property="og:description" content="@yield('meta_description', 'Discover MEHAAJ: Haute Maroquinerie, genuine Italian leather bags, Swiss-inspired precision chronographs, and curated European fashion.')">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="@yield('og_image', asset('hero_luxury.png'))">
        <meta property="og:locale" content="en_US">
        <meta property="og:locale:alternate" content="de_DE">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', 'MEHAAJ® Official Maison | Luxury Fashion, Leather Craft & Haute Horlogerie')">
        <meta name="twitter:description" content="@yield('meta_description', 'Discover MEHAAJ: Haute Maroquinerie, genuine Italian leather bags, Swiss-inspired precision chronographs, and curated European fashion.')">
        <meta name="twitter:image" content="@yield('og_image', asset('hero_luxury.png'))">

        <!-- JSON-LD Structured Data (Schema.org) -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "Organization",
                    "@id": "{{ url('/') }}#organization",
                    "name": "MEHAAJ",
                    "url": "{{ url('/') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('logo.png') }}"
                    }
                },
                {
                    "@type": "WebSite",
                    "@id": "{{ url('/') }}#website",
                    "url": "{{ url('/') }}",
                    "name": "MEHAAJ Official Maison",
                    "publisher": {
                        "@id": "{{ url('/') }}#organization"
                    },
                    "potentialAction": {
                        "@type": "SearchAction",
                        "target": "{{ url('/shop') }}?search={search_term_string}",
                        "query-input": "required name=search_term_string"
                    }
                },
                {
                    "@type": "WebPage",
                    "@id": "{{ url()->current() }}#webpage",
                    "url": "{{ url()->current() }}",
                    "name": "@yield('title', 'MEHAAJ® Official Maison | Luxury Fashion, Leather Craft & Haute Horlogerie')",
                    "isPartOf": {
                        "@id": "{{ url('/') }}#website"
                    },
                    "description": "@yield('meta_description', 'Discover MEHAAJ: Haute Maroquinerie, genuine Italian leather bags, Swiss-inspired precision chronographs, and curated European fashion.')",
                    "inLanguage": "en"
                }
            ]
        }
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600|inter:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html {
                overflow-x: clip;
            }
            body {
                overflow-x: clip;
                width: 100%;
                position: relative;
            }
        </style>
    </head>
    <body class="w-full bg-[#faf7f2] text-[#1c1210] antialiased selection:bg-[#78000b] selection:text-white">
        <x-navbar />

        <main class="w-full">
            @yield('content')
        </main>

        <x-footer />
        <x-cart-drawer />

        <!-- Global Slide-Over Wishlist Drawer -->
        <div id="wishlist-drawer-backdrop" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-md transition-opacity duration-300 opacity-0 pointer-events-none cursor-pointer" onclick="closeWishlistDrawer()"></div>

        <div id="wishlist-drawer-panel" class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-white shadow-2xl transition-all duration-500 translate-x-full invisible pointer-events-none border-l border-[#e6decb] flex flex-col justify-between overflow-hidden">
            <!-- Wishlist Header -->
            <div class="border-b border-[#e6decb] bg-[#faf7f2] p-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-[#78000b]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/>
                        </svg>
                        <h2 class="font-display text-lg font-medium text-[#1c1210]">
                            <span data-i18n-en="Your Wishlist" data-i18n-de="Ihre Wunschliste">Your Wishlist</span>
                            <span id="wishlist-drawer-count" class="text-xs text-[#78000b] font-bold ml-1">(0)</span>
                        </h2>
                    </div>
                    <button type="button" onclick="closeWishlistDrawer()" class="h-8 w-8 flex items-center justify-center rounded-full text-[#1c1210] hover:bg-[#78000b] hover:text-white transition-all duration-300 hover:rotate-90 cursor-pointer" aria-label="Close wishlist">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Wishlist Body: Items List -->
            <div id="wishlist-items-container" class="flex-1 overflow-y-auto p-5 divide-y divide-[#f2ebdc] space-y-4">
                <!-- Rendered dynamically via JavaScript -->
            </div>

            <!-- Wishlist Footer -->
            <div class="border-t border-[#e6decb] bg-[#faf7f2] p-5 flex items-center justify-between">
                <button type="button" onclick="clearWishlist()" class="text-xs font-semibold text-[#8a7c74] hover:text-[#78000b] transition" data-i18n-en="Clear Wishlist" data-i18n-de="Wunschliste leeren">Clear Wishlist</button>
                <a href="/shop" onclick="closeWishlistDrawer()" class="rounded bg-[#78000b] px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow hover:bg-[#5a0309] transition" data-i18n-en="Explore Shop" data-i18n-de="Shop entdecken">Explore Shop</a>
            </div>
        </div>

        <!-- Global Quick View Modal -->
        <div id="quick-view-backdrop" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none cursor-pointer" onclick="closeQuickViewModal()"></div>

        <div id="quick-view-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none opacity-0 transition-all duration-300 scale-95">
            <div class="relative w-full max-w-2xl bg-white rounded-md border border-[#d8b45a]/50 shadow-2xl overflow-hidden pointer-events-auto max-h-[90vh] flex flex-col md:flex-row">
                <!-- Close Button -->
                <button type="button" onclick="closeQuickViewModal()" class="absolute right-3 top-3 z-20 h-8 w-8 flex items-center justify-center rounded-full bg-black/60 text-white hover:bg-[#78000b] transition cursor-pointer shadow-md" aria-label="Close Quick View">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>

                <!-- Product Image -->
                <div class="md:w-1/2 bg-[#f7f4ee] relative min-h-[240px] md:min-h-[380px] flex items-center justify-center overflow-hidden">
                    <img id="qv-img" src="" alt="Product" class="h-full w-full object-cover">
                    <span id="qv-badge" class="absolute left-3 top-3 rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-luxury text-white shadow-md">EXKLUSIV</span>
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 p-6 flex flex-col justify-between overflow-y-auto">
                    <div>
                        <p id="qv-category" class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]"></p>
                        <h3 id="qv-title" class="font-display text-xl sm:text-2xl font-medium text-[#1c1210] mt-1"></h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-[#d8b45a] text-sm">★★★★★</span>
                            <span class="text-xs text-[#8a7c74]">5.0 (Client Rating)</span>
                        </div>
                        <div class="mt-3 flex items-baseline gap-2">
                            <span id="qv-price" class="text-xl font-bold text-[#1c1210]"></span>
                            <span id="qv-sale-price" class="text-xs text-[#8a7c74] line-through"></span>
                        </div>
                        <p id="qv-desc" class="mt-3 text-xs leading-relaxed text-[#685c54] font-light"></p>
                        
                        <div class="mt-4 pt-3 border-t border-[#f2ebdc] text-[0.68rem] text-[#8a7c74] space-y-1">
                            <p>✓ <span data-i18n-en="Complimentary Luxury Packaging" data-i18n-de="Kostenlose Luxus-Geschenkverpackung">Complimentary Luxury Packaging</span></p>
                            <p>✓ <span data-i18n-en="Insured DHL Express Shipping" data-i18n-de="Versicherter DHL Express Versand">Insured DHL Express Shipping</span></p>
                            <p>✓ <span data-i18n-en="Certificate of Authenticity" data-i18n-de="Echtheitszertifikat inklusive">Certificate of Authenticity</span></p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-[#f2ebdc] space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center border border-[#e6decb] rounded bg-[#faf7f2]">
                                <button type="button" onclick="decrementQvQty()" class="px-3 py-1.5 text-sm hover:bg-[#e6decb] font-bold text-[#1c1210] cursor-pointer">-</button>
                                <span id="qv-qty" class="px-3 py-1.5 text-xs font-bold text-[#1c1210]">1</span>
                                <button type="button" onclick="incrementQvQty()" class="px-3 py-1.5 text-sm hover:bg-[#e6decb] font-bold text-[#1c1210] cursor-pointer">+</button>
                            </div>
                            <button id="qv-add-btn" type="button" onclick="addQuickViewToCart()" class="flex-1 rounded bg-[#d8b45a] px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition shadow cursor-pointer font-bold">
                                <span data-i18n-en="Add to Cart" data-i18n-de="In den Warenkorb">Add to Cart</span>
                            </button>
                        </div>
                        <a id="qv-view-link" href="#" class="block text-center text-xs font-bold text-[#78000b] hover:underline" data-i18n-en="View Full Masterpiece Details →" data-i18n-de="Vollständige Produktdetails ansehen →">View Full Masterpiece Details →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- SweetAlert2 Library & Luxury Theme Mixins -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Global SweetAlert2 Luxury Theme Mixins
            const LuxurySwal = Swal.mixin({
                background: '#faf7f2',
                color: '#1c1210',
                confirmButtonColor: '#78000b',
                cancelButtonColor: '#685c54',
                customClass: {
                    popup: 'border border-[#d8b45a]/40 shadow-2xl rounded-md font-sans',
                    title: 'font-display text-2xl text-[#1c1210]',
                    confirmButton: 'px-5 py-2.5 rounded text-xs font-bold uppercase tracking-wider shadow-md hover:bg-[#5a0309] cursor-pointer',
                    cancelButton: 'px-5 py-2.5 rounded text-xs font-bold uppercase tracking-wider cursor-pointer'
                }
            });

            const LuxuryToast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#1c1210',
                color: '#fffaf0',
                customClass: {
                    popup: 'border border-[#d8b45a]/50 rounded shadow-xl text-xs font-sans'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            // ==========================================
            // 1. CLIENT-SIDE & SERVER-SYNC BILINGUAL LANGUAGE ENGINE
            // ==========================================
            window.getCurrentLang = function() {
                const matchLocale = document.cookie.match(/(?:^|;\s*)locale=([^;]+)/);
                const matchMehaaj = document.cookie.match(/(?:^|;\s*)mehaaj_lang=([^;]+)/);
                const cookieLocale = (matchLocale ? matchLocale[1] : null) || (matchMehaaj ? matchMehaaj[1] : null);
                return localStorage.getItem('mehaaj_lang') || cookieLocale || '{{ app()->getLocale() ?: "en" }}';
            };

            function setSiteLanguage(lang, syncServer = true) {
                if (lang !== 'en' && lang !== 'de') lang = 'en';
                localStorage.setItem('mehaaj_lang', lang);
                document.cookie = 'locale=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
                document.cookie = 'mehaaj_lang=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
                document.cookie = 'mehaaj_admin_lang=' + lang + ';path=/;max-age=31536000;SameSite=Lax';
                document.documentElement.setAttribute('lang', lang);

                // Asynchronously sync with Laravel backend session
                if (syncServer) {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    fetch('/lang/' + lang, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token || '',
                            'Accept': 'application/json'
                        }
                    }).catch(() => {});
                }

                // Update all elements with data-i18n attributes
                document.querySelectorAll('[data-i18n-en], [data-i18n-de]').forEach(el => {
                    const translation = el.getAttribute('data-i18n-' + lang);
                    if (translation !== null && translation !== '') {
                        if (el.getAttribute('data-i18n-html') === 'true' || translation.includes('<')) {
                            el.innerHTML = translation;
                        } else if (el.children.length === 0) {
                            el.textContent = translation;
                        } else {
                            // Find direct text node if present
                            let textNode = null;
                            for (let node of el.childNodes) {
                                if (node.nodeType === Node.TEXT_NODE && node.textContent.trim().length > 0) {
                                    textNode = node;
                                    break;
                                }
                            }
                            if (textNode) {
                                textNode.textContent = translation;
                            } else {
                                const targetSpan = el.querySelector('span:not([class*="badge"]):not([class*="count"]):not([class*="icon"])');
                                if (targetSpan && !targetSpan.hasAttribute('data-i18n-en')) {
                                    targetSpan.textContent = translation;
                                } else {
                                    el.textContent = translation;
                                }
                            }
                        }
                    }
                });

                // Update all input placeholders with data-i18n-placeholder attributes
                document.querySelectorAll('[data-i18n-placeholder-en], [data-i18n-placeholder-de]').forEach(el => {
                    const ph = el.getAttribute('data-i18n-placeholder-' + lang);
                    if (ph) {
                        el.placeholder = ph;
                    }
                });

                // Update titles and aria-labels
                document.querySelectorAll('[data-i18n-title-en], [data-i18n-title-de]').forEach(el => {
                    const t = el.getAttribute('data-i18n-title-' + lang);
                    if (t) el.title = t;
                });

                document.querySelectorAll('[data-i18n-aria-en], [data-i18n-aria-de]').forEach(el => {
                    const a = el.getAttribute('data-i18n-aria-' + lang);
                    if (a) el.setAttribute('aria-label', a);
                });

                // Update Navbar Buttons Active State
                ['en', 'de'].forEach(l => {
                    const btn = document.getElementById('lang-btn-' + l);
                    const btnMob = document.getElementById('lang-btn-mobile-' + l);
                    const isActive = (l === lang);

                    if (btn) {
                        btn.className = isActive 
                            ? 'px-2 py-0.5 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a] font-bold shadow-xs'
                            : 'px-2 py-0.5 rounded-full transition cursor-pointer text-white/80 hover:text-white font-medium';
                    }
                    if (btnMob) {
                        btnMob.className = isActive
                            ? 'px-3 py-1 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a] font-bold shadow-xs'
                            : 'px-3 py-1 rounded-full transition cursor-pointer text-white/80 hover:text-white font-medium';
                    }
                });

                // Dispatch event so subcomponents can react
                window.dispatchEvent(new CustomEvent('siteLanguageChanged', { detail: { lang: lang } }));
            }

            // ==========================================
            // 2. WISHLIST ENGINE (localStorage + Drawer)
            // ==========================================
            function getWishlist() {
                try {
                    return JSON.parse(localStorage.getItem('mehaaj_wishlist') || '[]');
                } catch(e) {
                    return [];
                }
            }

            function saveWishlist(items) {
                localStorage.setItem('mehaaj_wishlist', JSON.stringify(items));
                updateWishlistBadges();
            }

            function updateWishlistBadges() {
                const list = getWishlist();
                const count = list.length;
                document.querySelectorAll('.wishlist-badge-count').forEach(el => {
                    el.textContent = count;
                });
                const drawerCount = document.getElementById('wishlist-drawer-count');
                if (drawerCount) drawerCount.textContent = `(${count})`;

                // Update active state on heart buttons
                document.querySelectorAll('[data-wishlist-btn-id]').forEach(btn => {
                    const id = btn.getAttribute('data-wishlist-btn-id');
                    const exists = list.some(item => item.id == id);
                    if (exists) {
                        btn.classList.add('text-[#78000b]', 'fill-current');
                        btn.classList.remove('text-neutral-700');
                    } else {
                        btn.classList.remove('text-[#78000b]', 'fill-current');
                    }
                });
            }

            function toggleWishlistProduct(product, btnEl) {
                const isEn = getCurrentLang() === 'en';
                let list = getWishlist();
                const idx = list.findIndex(item => item.id == product.id);

                if (idx > -1) {
                    list.splice(idx, 1);
                    saveWishlist(list);
                    LuxuryToast.fire({
                        icon: 'info',
                        title: (product.name || 'Product') + ' ' + (isEn ? 'removed from wishlist' : 'von der Wunschliste entfernt')
                    });
                } else {
                    list.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image,
                        category: product.category,
                        slug: product.slug
                    });
                    saveWishlist(list);
                    LuxuryToast.fire({
                        icon: 'success',
                        title: (product.name || 'Product') + ' ' + (isEn ? 'added to your wishlist! ❤️' : 'zur Wunschliste hinzugefügt! ❤️')
                    });
                }
                renderWishlistDrawer();
            }

            function openWishlistDrawer() {
                renderWishlistDrawer();
                const backdrop = document.getElementById('wishlist-drawer-backdrop');
                const panel = document.getElementById('wishlist-drawer-panel');
                if (backdrop) {
                    backdrop.classList.remove('opacity-0', 'pointer-events-none');
                    backdrop.classList.add('opacity-100');
                }
                if (panel) {
                    panel.classList.remove('translate-x-full', 'invisible', 'pointer-events-none');
                    panel.classList.add('translate-x-0');
                }
                document.body.style.overflow = 'hidden';
            }

            function closeWishlistDrawer() {
                const backdrop = document.getElementById('wishlist-drawer-backdrop');
                const panel = document.getElementById('wishlist-drawer-panel');
                if (backdrop) {
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0', 'pointer-events-none');
                }
                if (panel) {
                    panel.classList.remove('translate-x-0');
                    panel.classList.add('translate-x-full', 'invisible', 'pointer-events-none');
                }
                document.body.style.overflow = '';
            }

            function renderWishlistDrawer() {
                const container = document.getElementById('wishlist-items-container');
                if (!container) return;

                const list = getWishlist();
                const isEn = getCurrentLang() === 'en';

                if (list.length === 0) {
                    container.innerHTML = `
                        <div class="py-16 text-center space-y-3">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="font-display text-lg font-medium text-[#1c1210]">${isEn ? 'Your Wishlist is Empty' : 'Ihre Wunschliste ist leer'}</h3>
                            <p class="text-xs text-[#8a7c74] max-w-xs mx-auto leading-relaxed">
                                ${isEn ? 'Discover our curated selection of luxury masterpieces and save your favorites here.' : 'Entdecken Sie unsere Meisterwerke und speichern Sie Ihre Favoriten hier.'}
                            </p>
                            <a href="/shop" onclick="closeWishlistDrawer()" class="inline-block mt-2 rounded bg-[#d8b45a] px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                ${isEn ? 'Browse Collection' : 'Kollektion ansehen'}
                            </a>
                        </div>
                    `;
                    return;
                }

                let html = '';
                list.forEach(item => {
                    html += `
                        <div class="flex items-center gap-4 py-3">
                            <a href="/shop/${item.slug || ''}" class="h-16 w-16 shrink-0 overflow-hidden rounded bg-[#f7f4ee] border border-[#e6decb]">
                                <img src="${item.image || '/productbag.png'}" alt="${item.name}" class="h-full w-full object-cover">
                            </a>
                            <div class="flex-1 min-w-0">
                                <p class="text-[0.6rem] font-bold uppercase tracking-wider text-[#78000b] truncate">${item.category || 'Luxury'}</p>
                                <a href="/shop/${item.slug || ''}" class="font-display text-sm font-medium text-[#1c1210] hover:text-[#78000b] transition truncate block">${item.name}</a>
                                <p class="text-xs font-bold text-[#1c1210] mt-0.5">${item.price}</p>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <button onclick="quickAddToCart(${item.id}, 1); removeWishlistItem(${item.id});" class="rounded bg-[#d8b45a] px-2.5 py-1 text-[0.62rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition" title="${isEn ? 'Move to Cart' : 'In den Warenkorb'}">
                                    + Cart
                                </button>
                                <button onclick="removeWishlistItem(${item.id})" class="text-[#8a7c74] hover:text-[#78000b] transition p-1" title="${isEn ? 'Remove' : 'Entfernen'}">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18m-2 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            }

            function removeWishlistItem(id) {
                const isEn = getCurrentLang() === 'en';
                let list = getWishlist();
                list = list.filter(item => item.id != id);
                saveWishlist(list);
                renderWishlistDrawer();
                LuxuryToast.fire({
                    icon: 'info',
                    title: isEn ? 'Item removed from wishlist' : 'Artikel aus der Wunschliste entfernt'
                });
            }

            function clearWishlist() {
                const isEn = getCurrentLang() === 'en';
                LuxurySwal.fire({
                    title: isEn ? 'Clear Wishlist?' : 'Wunschliste leeren?',
                    text: isEn ? 'Are you sure you want to remove all saved items?' : 'Möchten Sie wirklich alle gespeicherten Artikel entfernen?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: isEn ? 'Yes, clear all' : 'Ja, alle leeren',
                    cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
                }).then(result => {
                    if (result.isConfirmed) {
                        saveWishlist([]);
                        renderWishlistDrawer();
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'Wishlist has been cleared' : 'Wunschliste wurde geleert'
                        });
                    }
                });
            }

            // ==========================================
            // 3. QUICK VIEW MODAL ENGINE
            // ==========================================
            let currentQvProduct = null;
            let currentQvQty = 1;

            function openQuickViewModal(product) {
                currentQvProduct = product;
                currentQvQty = 1;
                const isEn = getCurrentLang() === 'en';

                document.getElementById('qv-img').src = product.image || '/productbag.png';
                document.getElementById('qv-category').textContent = product.category || (isEn ? 'HAUTE CREATION' : 'HAUTE KREATION');
                document.getElementById('qv-title').textContent = product.name || '';
                document.getElementById('qv-price').textContent = product.price || '';
                
                const saleEl = document.getElementById('qv-sale-price');
                if (product.sale_price) {
                    saleEl.textContent = product.sale_price;
                    saleEl.classList.remove('hidden');
                } else {
                    saleEl.classList.add('hidden');
                }

                document.getElementById('qv-desc').textContent = product.description || (isEn 
                    ? 'Handcrafted with peerless European mastery. Utilizing genuine premium materials, saddle stitching, and refined finishes designed for timeless connoisseurship.' 
                    : 'Handgefertigt mit unvergleichlicher europäischer Meisterleistung. Unter Verwendung edelster Materialien und vollendeter Handwerkskunst.');

                document.getElementById('qv-qty').textContent = currentQvQty;
                document.getElementById('qv-view-link').href = '/shop/' + (product.slug || '');

                const backdrop = document.getElementById('quick-view-backdrop');
                const modal = document.getElementById('quick-view-modal');
                if (backdrop) {
                    backdrop.classList.remove('opacity-0', 'pointer-events-none');
                    backdrop.classList.add('opacity-100');
                }
                if (modal) {
                    modal.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'scale-100');
                }
                document.body.style.overflow = 'hidden';
            }

            function closeQuickViewModal() {
                const backdrop = document.getElementById('quick-view-backdrop');
                const modal = document.getElementById('quick-view-modal');
                if (backdrop) {
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0', 'pointer-events-none');
                }
                if (modal) {
                    modal.classList.remove('opacity-100', 'scale-100');
                    modal.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
                document.body.style.overflow = '';
            }

            function incrementQvQty() {
                currentQvQty++;
                document.getElementById('qv-qty').textContent = currentQvQty;
            }

            function decrementQvQty() {
                if (currentQvQty > 1) {
                    currentQvQty--;
                    document.getElementById('qv-qty').textContent = currentQvQty;
                }
            }

            function addQuickViewToCart() {
                if (!currentQvProduct) return;
                quickAddToCart(currentQvProduct.id, currentQvQty);
                closeQuickViewModal();
            }

            // ==========================================
            // 4. BILINGUAL SWEETALERTS & GLOBAL ACTIONS
            // ==========================================
            function openAccountModal() {
                const isEn = getCurrentLang() === 'en';
                LuxurySwal.fire({
                    title: isEn ? 'MEHAAJ VIP Portal 👑' : 'MEHAAJ VIP Portal 👑',
                    html: `
                        <div class="text-left space-y-3 mt-2 text-xs">
                            <p class="text-neutral-600">${isEn ? 'Log in to your exclusive customer account:' : 'Melden Sie sich mit Ihrem exklusiven Kundenkonto an:'}</p>
                            <input id="swal-input-email" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'Email Address' : 'E-Mail-Adresse'}" type="email">
                            <input id="swal-input-pass" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'Password' : 'Passwort'}" type="password">
                        </div>
                    `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: isEn ? 'Log In' : 'Anmelden',
                    cancelButtonText: isEn ? 'Close' : 'Schließen',
                    preConfirm: () => {
                        const email = document.getElementById('swal-input-email').value;
                        if (!email) {
                            Swal.showValidationMessage(isEn ? 'Please enter your email address' : 'Bitte geben Sie Ihre E-Mail ein');
                        }
                        return { email: email };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'Successfully logged in as ' + result.value.email : 'Erfolgreich angemeldet als ' + result.value.email
                        });
                    }
                });
            }

            function quickAddToCart(productId, qty = 1) {
                const isEn = getCurrentLang() === 'en';
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId, quantity: qty })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        LuxuryToast.fire({
                            icon: 'success',
                            title: (data.added_product || 'Product') + ' ' + (isEn ? 'added to cart! 🛍️' : 'in den Warenkorb gelegt! 🛍️')
                        });
                        if (typeof fetchAndUpdateCartDrawer === 'function') {
                            fetchAndUpdateCartDrawer();
                        }
                        if (typeof openCartDrawer === 'function') {
                            openCartDrawer();
                        }
                    } else {
                        LuxuryToast.fire({
                            icon: 'error',
                            title: data.message || (isEn ? 'Error adding to cart' : 'Fehler beim Hinzufügen zum Warenkorb')
                        });
                    }
                })
                .catch(err => {
                    console.error('Add to cart error:', err);
                    LuxuryToast.fire({
                        icon: 'error',
                        title: isEn ? 'Network error occurred' : 'Netzwerkfehler aufgetreten'
                    });
                });
            }

            // On DOM Ready, initialize language & wishlist badges
            document.addEventListener('DOMContentLoaded', () => {
                const initialLang = getCurrentLang();
                setSiteLanguage(initialLang);
                updateWishlistBadges();
            });
        </script>
    </body>
</html>
