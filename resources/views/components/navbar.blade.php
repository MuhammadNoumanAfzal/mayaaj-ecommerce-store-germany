<header class="sticky top-0 z-50 w-full bg-[#17100e]/95 border-b border-[#e6decb]/15 shadow-[0_4px_25px_rgba(0,0,0,0.18)] backdrop-blur-xl transition-all duration-300" data-site-header>
    <!-- Solid Maison Warm Atelier Navigation Bar (Soft on the eyes) -->
    <nav class="flex h-16 w-full max-w-full items-center gap-3 sm:gap-4 lg:gap-4 xl:gap-6 px-3 sm:px-5 lg:h-[4.6rem] lg:px-6 xl:px-8 bg-transparent text-[#f4ede4]" aria-label="Main navigation">
        <!-- Mobile-Only Hamburger Toggle -->
        <button class="lg:hidden inline-flex h-9 w-9 items-center justify-center rounded-sm text-[#ffd45a] hover:text-white cursor-pointer shrink-0" type="button" onclick="toggleMobileMenu()" aria-label="Open mobile menu">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="20" y2="12"/>
                <line x1="4" y1="18" x2="20" y2="18"/>
            </svg>
        </button>

        <!-- Brand Logo -->
        <a href="/" class="flex shrink-0 items-center" aria-label="MEHAAJ home">
            <img src="/logo.png" alt="MEHAAJ" class="h-9 w-auto max-w-[125px] object-contain sm:h-11 sm:max-w-[150px] lg:h-12 lg:max-w-[160px]">
        </a>

        <!-- Streamlined Desktop Navigation (Does not overflow) -->
        <div class="hidden items-center gap-4 text-[0.72rem] font-bold uppercase tracking-[0.12em] text-white/90 lg:flex xl:gap-6 shrink-0">
            <!-- Collections Mega Dropdown Trigger -->
            <div class="relative group py-2">
                <button type="button" class="inline-flex items-center gap-1.5 transition hover:text-[#d8b45a] cursor-pointer" onclick="toggleMobileMenu()">
                    <span data-i18n-en="Collections" data-i18n-de="Kollektionen">Collections</span>
                    <svg class="h-3.5 w-3.5 text-[#d8b45a] group-hover:rotate-180 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                </button>

                <!-- Elegant Mega Dropdown Menu for Collections (100% Solid Opaque Luxury Maison Finish) -->
                <div class="absolute left-0 top-full hidden group-hover:grid grid-cols-2 gap-3 w-[500px] max-w-[calc(100vw-2rem)] rounded-md border border-[#d8b45a]/60 bg-[#17100e] p-5 shadow-[0_28px_80px_rgba(0,0,0,0.95)] z-[100] transition-all duration-300" style="background-color: #17100e !important;">
                    <div class="col-span-2 flex items-center justify-between border-b border-[#d8b45a]/30 pb-2.5 mb-1">
                        <span class="text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#d8b45a]" data-i18n-en="MAISON ATELIER CATEGORIES" data-i18n-de="MAISON ATELIER KATEGORIEN">MAISON ATELIER CATEGORIES</span>
                        <a href="/shop" class="text-[0.65rem] font-semibold text-[#f5ebd9]/80 hover:text-[#ffd45a] transition" data-i18n-en="View All ({{ count($globalCategories ?? []) }}) →" data-i18n-de="Alle anzeigen ({{ count($globalCategories ?? []) }}) →">View All ({{ count($globalCategories ?? []) }}) →</a>
                    </div>
                    @foreach($globalCategories ?? [] as $category)
                        <div class="group/cat rounded-sm p-2 transition-colors duration-200 hover:bg-[#251512] border border-transparent hover:border-[#d8b45a]/25">
                            <a href="/shop?category={{ $category->slug }}" class="font-display text-sm font-semibold tracking-wide text-[#fffaf0] group-hover/cat:text-[#ffd45a] transition block">
                                {{ $category->name }}
                            </a>
                            @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                                <div class="mt-1 space-y-0.5 pl-2 border-l border-[#d8b45a]/35">
                                    @foreach($category->activeSubcategories->take(2) as $subcat)
                                        <a href="/shop?category={{ $category->slug }}&subcategory={{ $subcat->slug }}" class="block text-[0.66rem] font-normal text-[#e4d9cc]/75 hover:text-white transition">
                                            • {{ $subcat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <a class="transition hover:text-[#d8b45a]" href="/shop" data-i18n-en="Shop All" data-i18n-de="Alle Artikel">Shop All</a>
            <a class="transition hover:text-[#d8b45a]" href="/reviews" data-i18n-en="Reviews" data-i18n-de="Bewertungen">Reviews</a>
            <a class="transition hover:text-[#d8b45a]" href="/ueber-uns" data-i18n-en="Atelier" data-i18n-de="Manufaktur">Atelier</a>
        </div>

        <!-- Search Bar (Responsive Width) -->
        <form class="ml-auto hidden w-32 md:w-36 lg:w-40 xl:w-52 focus-within:w-48 xl:focus-within:w-60 transition-all duration-300 items-center border-b border-[#d8b45a]/65 pb-1 text-white lg:flex" action="/shop" method="get">
            <label class="sr-only" for="site-search" data-i18n-de="Suche" data-i18n-en="Search">Search</label>
            <input
                id="site-search"
                name="search"
                class="h-8 w-full bg-transparent text-[0.72rem] font-bold uppercase tracking-[0.06em] text-[#fffaf0] outline-none placeholder:text-[#fffaf0]/80"
                type="search"
                placeholder="Search..."
                data-i18n-placeholder-de="Suchen..."
                data-i18n-placeholder-en="Search..."
            >
            <button class="inline-flex h-8 w-8 cursor-pointer items-center justify-center text-white transition hover:text-[#d8b45a]" type="submit" aria-label="Search">
                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="6.5" />
                    <path d="m16 16 4 4" stroke-linecap="round" />
                </svg>
            </button>
        </form>

        <div class="hidden items-center gap-3 text-[0.72rem] font-bold uppercase tracking-[0.04em] text-white lg:flex xl:gap-4 shrink-0">
            <!-- Language Switcher Pill (EN | DE) -->
            <div class="inline-flex items-center rounded-full border border-[#d8b45a]/50 bg-[#160b09]/80 p-0.5 text-[0.62rem] font-bold shadow-xs">
                <button type="button" onclick="setSiteLanguage('en')" id="lang-btn-en" class="px-2 py-0.5 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a]">EN</button>
                <button type="button" onclick="setSiteLanguage('de')" id="lang-btn-de" class="px-2 py-0.5 rounded-full transition cursor-pointer text-white/80 hover:text-white">DE</button>
            </div>

            <button class="inline-flex cursor-pointer items-center gap-1.5 transition hover:text-[#d8b45a]" type="button" onclick="openAccountModal()" aria-label="My account">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" />
                    <path d="M5.5 20c1.1-3.4 3.3-5.1 6.5-5.1s5.4 1.7 6.5 5.1" stroke-linecap="round" />
                </svg>
                <span class="hidden 2xl:inline" data-i18n-de="Konto" data-i18n-en="Account">Account</span>
            </button>

            <button class="relative inline-flex cursor-pointer items-center gap-1.5 transition hover:text-[#d8b45a]" type="button" onclick="openWishlistDrawer()" aria-label="Wishlist">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                </svg>
                <span class="hidden xl:inline" data-i18n-de="Wunschliste" data-i18n-en="Wishlist">Wishlist</span>
                <span class="wishlist-badge-count absolute -right-2.5 -top-2 flex h-4 w-4 items-center justify-center rounded-full bg-[#78000b] text-[0.58rem] font-bold text-white shadow-xs">0</span>
            </button>

            <button class="relative inline-flex cursor-pointer items-center gap-1.5 transition hover:text-[#d8b45a]" type="button" onclick="openCartDrawer()" aria-label="Shopping cart">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                </svg>
                <span class="hidden xl:inline" data-i18n-de="Warenkorb" data-i18n-en="Cart">Cart</span>
                <span class="cart-badge-count absolute -right-2.5 -top-2 flex h-4 w-4 items-center justify-center rounded-full bg-[#d8b45a] text-[0.58rem] font-bold text-[#120807]">{{ count(session('cart', [])) }}</span>
            </button>
        </div>

        <!-- Mobile Action Icons (Wishlist & Cart) -->
        <div class="ml-auto flex items-center gap-2 lg:hidden">
            <button class="relative inline-flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-[#d8b45a]/40 bg-[#160b09] text-white shadow-md transition hover:bg-[#78000b]" type="button" onclick="openWishlistDrawer()" aria-label="Wishlist">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                </svg>
                <span class="wishlist-badge-count absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#78000b] text-[0.55rem] font-bold text-white">0</span>
            </button>
            <button class="relative inline-flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-[#78000b] text-white shadow-md transition hover:bg-[#5a0309]" type="button" onclick="openCartDrawer()" aria-label="Open cart">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                </svg>
                <span class="cart-badge-count absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#d8b45a] text-[0.58rem] font-bold text-[#120807]">{{ count(session('cart', [])) }}</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Dark Backdrop -->
    <div id="mobile-menu-backdrop" class="fixed inset-0 z-[55] hidden bg-black/75 backdrop-blur-sm transition-opacity duration-500 cursor-pointer" onclick="toggleMobileMenu()" aria-hidden="true"></div>

    <!-- Luxury Mobile Menu Drawer -->
    <div id="mobile-menu" class="fixed inset-y-0 left-0 z-[60] hidden w-full max-w-[420px] justify-between overflow-y-auto no-scrollbar bg-[#0d0605] border-r border-[#d8b45a]/30 px-6 py-6 text-[#fbf4e8] shadow-[24px_0_80px_rgba(0,0,0,0.85)]">
        <!-- Header Controls -->
        <div class="w-full">
            <div class="flex items-center justify-between pb-6 border-b border-[#d8b45a]/20">
                <a href="/" class="flex items-center" aria-label="MEHAAJ home">
                    <img src="/logo.png" alt="MEHAAJ" class="h-10 w-auto max-w-[140px] object-contain">
                </a>

                <div class="flex items-center gap-3">
                    <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-[#d8b45a]/35 bg-[#d8b45a]/10 text-[#d8b45a] transition hover:bg-[#78000b] hover:text-white" type="button" onclick="openAccountModal()" aria-label="Account">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3.5" /><path d="M5.5 20c1.1-3.4 3.3-5.1 6.5-5.1s5.4 1.7 6.5 5.1" stroke-linecap="round" /></svg>
                    </button>

                    <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-[#d8b45a]/40 bg-[#78000b]/20 text-[#ffd45a] transition hover:bg-[#78000b] hover:text-white" type="button" onclick="toggleMobileMenu()" aria-controls="mobile-menu" aria-expanded="true" aria-label="Close menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Language Switcher Pill -->
            <div class="mt-4 flex items-center justify-between rounded-lg border border-[#d8b45a]/30 bg-[#170b09] p-2.5">
                <span class="text-xs font-bold uppercase tracking-wider text-[#d8b45a]" data-i18n-en="Language / Sprache:" data-i18n-de="Sprache / Language:">Language / Sprache:</span>
                <div class="inline-flex items-center rounded-full border border-[#d8b45a]/50 bg-[#0d0605] p-0.5 text-xs font-bold">
                    <button type="button" onclick="setSiteLanguage('en')" id="lang-btn-mobile-en" class="px-3 py-1 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a]">EN</button>
                    <button type="button" onclick="setSiteLanguage('de')" id="lang-btn-mobile-de" class="px-3 py-1 rounded-full transition cursor-pointer text-white/80 hover:text-white">DE</button>
                </div>
            </div>

            <!-- Mobile Quick Actions (Wishlist & Cart) -->
            <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
                <button type="button" onclick="toggleMobileMenu(); openWishlistDrawer();" class="flex items-center justify-center gap-2 rounded border border-[#d8b45a]/30 bg-[#170b09] py-2 text-[#fbf4e8] hover:border-[#d8b45a]">
                    <svg class="h-4 w-4 text-[#78000b]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                    <span data-i18n-en="Wishlist" data-i18n-de="Wunschliste">Wishlist</span>
                    <span class="wishlist-badge-count text-[0.65rem] font-bold text-[#d8b45a]">(0)</span>
                </button>
                <button type="button" onclick="toggleMobileMenu(); openCartDrawer();" class="flex items-center justify-center gap-2 rounded border border-[#d8b45a]/30 bg-[#170b09] py-2 text-[#fbf4e8] hover:border-[#d8b45a]">
                    <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6.5 8.5h11l1 11h-13l1-11Z"/><path d="M9 8.5a3 3 0 0 1 6 0"/></svg>
                    <span data-i18n-en="Cart" data-i18n-de="Warenkorb">Cart</span>
                    <span class="cart-badge-count text-[0.65rem] font-bold text-[#d8b45a]">({{ count(session('cart', [])) }})</span>
                </button>
            </div>

            <!-- Mobile Search Bar -->
            <form class="mt-4 flex items-center rounded-sm border border-[#d8b45a]/35 bg-[#170b09] px-3.5 py-2.5 text-white" action="/shop" method="get">
                <input id="mobile-site-search" name="search" class="w-full bg-transparent text-xs font-medium uppercase tracking-[0.1em] text-[#fffaf0] outline-none placeholder:text-[#e4d9cc]/40" type="search" placeholder="Search in Mehaaj..." data-i18n-placeholder-de="Suche in Mehaaj..." data-i18n-placeholder-en="Search in Mehaaj...">
                <button type="submit" class="text-[#d8b45a] hover:text-white" aria-label="Search">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4 4" stroke-linecap="round"/></svg>
                </button>
            </form>

            <!-- Navigation Links Grid with Dynamic Database Categories & Subcategories -->
            <nav class="mt-4 grid divide-y divide-[#d8b45a]/12 text-sm uppercase" aria-label="Mobile Menu Navigation">
                <div class="py-3">
                    <a class="group flex items-center justify-between py-1 transition-all duration-300 hover:text-[#d8b45a]" href="/reviews">
                        <div class="flex items-center gap-3">
                            <span class="text-[0.65rem] font-bold text-[#d8b45a]">★</span>
                            <span class="font-display text-lg font-medium" data-i18n-en="Client Reviews" data-i18n-de="Kundenbewertungen">Client Reviews</span>
                        </div>
                        <span class="text-[0.62rem] font-bold px-2 py-0.5 rounded bg-[#d8b45a]/20 text-[#d8b45a]">4.9 / 5</span>
                    </a>
                </div>
                @forelse($globalCategories ?? [] as $index => $category)
                    <div class="py-3">
                        <a class="group flex items-center justify-between py-1 transition-all duration-300 hover:text-[#d8b45a]" href="/shop?category={{ $category->slug }}">
                            <div class="flex items-center gap-3">
                                <span class="text-[0.65rem] font-bold text-[#d8b45a]/60">0{{ $index + 1 }}</span>
                                <span class="font-display text-lg font-medium">{{ $category->name }}</span>
                            </div>
                            <svg class="h-4 w-4 text-[#d8b45a]/50 transition-transform group-hover:translate-x-1 group-hover:text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                            <div class="mt-2 ml-7 pl-3 border-l border-[#d8b45a]/30 space-y-1.5 text-xs">
                                @foreach($category->activeSubcategories as $subcat)
                                    <a href="/shop?category={{ $category->slug }}&subcategory={{ $subcat->slug }}" class="block py-1 text-xs text-[#e4d9cc]/75 hover:text-[#d8b45a] transition">
                                        • {{ $subcat->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <a class="group flex items-center justify-between py-3.5 transition-all duration-300 hover:translate-x-1.5 hover:text-[#d8b45a]" href="/shop">
                        <div class="flex items-center gap-3">
                            <span class="text-[0.65rem] font-bold text-[#d8b45a]/60">01</span>
                            <span class="font-display text-lg font-medium" data-i18n-de="Kollektion & Shop" data-i18n-en="Collection & Shop">Kollektion & Shop</span>
                        </div>
                        <svg class="h-4 w-4 text-[#d8b45a]/50 transition-transform group-hover:translate-x-1 group-hover:text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                @endforelse
                
                <a class="group flex items-center justify-between py-3.5 transition-all duration-300 hover:translate-x-1.5 hover:text-[#d8b45a]" href="/ueber-uns">
                    <div class="flex items-center gap-3">
                        <span class="text-[0.65rem] font-bold text-[#d8b45a]/60">05</span>
                        <span class="font-display text-lg font-medium" data-i18n-de="Manufaktur & Erbe" data-i18n-en="Atelier & Story">Manufaktur & Erbe</span>
                    </div>
                    <svg class="h-4 w-4 text-[#d8b45a]/50 transition-transform group-hover:translate-x-1 group-hover:text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </nav>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileBackdrop = document.getElementById('mobile-menu-backdrop');
        if (!mobileMenu) return;

        const isHidden = mobileMenu.classList.contains('hidden');
        if (isHidden) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex', 'flex-col');
            if (mobileBackdrop) mobileBackdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex', 'flex-col');
            if (mobileBackdrop) mobileBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
</script>

