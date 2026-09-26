<header class="fixed inset-x-0 top-0 z-50 bg-transparent text-white transition-all duration-500" data-site-header>
    <nav class="flex h-16 w-full items-center gap-5 px-5 sm:px-7 lg:h-[4.8rem] lg:px-8" aria-label="Main navigation">
        <button class="inline-flex h-11 w-11 cursor-pointer items-center justify-center rounded-sm border border-[#d8b45a]/55 bg-[#d8b45a]/10 text-white transition hover:border-[#d8b45a] hover:bg-[#78000b] hover:text-white shadow-sm" type="button" onclick="toggleMobileMenu()" aria-controls="mobile-menu" aria-expanded="false" aria-label="Open menu">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                <path d="M3.5 6.5h17M3.5 12h17M3.5 17.5h17" stroke-linecap="round" />
            </svg>
        </button>

        <a href="/" class="flex shrink-0 items-center" aria-label="MEHAAJ home">
            <img src="/logo.png" alt="MEHAAJ" class="h-11 w-auto max-w-[148px] object-contain lg:h-12 lg:max-w-[170px]">
        </a>

        <div class="hidden items-center gap-7 text-[0.72rem] font-bold uppercase tracking-[0.12em] text-white/90 lg:flex xl:gap-9">
            @forelse($globalCategories ?? [] as $category)
                <div class="relative group py-2">
                    <a class="inline-flex items-center gap-1.5 transition hover:text-[#d8b45a]" href="/shop?category={{ $category->slug }}">
                        <span>{{ $category->name }}</span>
                        @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                            <svg class="h-3 w-3 text-[#d8b45a]/80 group-hover:rotate-180 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        @endif
                    </a>

                    @if($category->activeSubcategories && $category->activeSubcategories->count() > 0)
                        <div class="absolute left-0 top-full hidden group-hover:block min-w-[210px] rounded-md border border-[#d8b45a]/40 bg-[#0d0605]/95 p-3 shadow-2xl backdrop-blur-md z-50">
                            <div class="text-[0.58rem] font-bold uppercase tracking-widest text-[#d8b45a]/70 px-3 pb-2 border-b border-[#d8b45a]/15 mb-1">
                                {{ $category->name }}
                            </div>
                            <div class="space-y-1">
                                @foreach($category->activeSubcategories as $subcat)
                                    <a href="/shop?category={{ $category->slug }}&subcategory={{ $subcat->slug }}" class="block px-3 py-1.5 text-[0.68rem] font-semibold text-[#e4d9cc] hover:text-[#d8b45a] hover:bg-white/10 rounded transition">
                                        {{ $subcat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <a class="transition hover:text-[#d8b45a]" href="/shop" data-i18n-de="Kollektion & Shop" data-i18n-en="Collection & Shop">Kollektion & Shop</a>
            @endforelse
            <a class="transition hover:text-[#d8b45a]" href="/ueber-uns" data-i18n-de="Manufaktur" data-i18n-en="Atelier">Manufaktur</a>
        </div>

        <form class="ml-auto hidden min-w-[220px] max-w-[360px] flex-1 items-center border-b border-[#d8b45a]/65 pb-1 text-white lg:flex" action="/shop" method="get">
            <label class="sr-only" for="site-search" data-i18n-de="Suche" data-i18n-en="Search">Suche</label>
            <input
                id="site-search"
                name="search"
                class="h-9 w-full bg-transparent text-[0.72rem] font-bold uppercase tracking-[0.08em] text-[#fffaf0] outline-none placeholder:text-[#fffaf0] placeholder:opacity-100"
                type="search"
                placeholder="Suche"
                data-i18n-placeholder-de="Suche"
                data-i18n-placeholder-en="Search"
            >
            <button class="inline-flex h-9 w-9 cursor-pointer items-center justify-center text-white transition hover:text-[#d8b45a]" type="submit" aria-label="Search">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <circle cx="11" cy="11" r="6.5" />
                    <path d="m16 16 4 4" stroke-linecap="round" />
                </svg>
            </button>
        </form>

        <div class="hidden items-center gap-5 text-[0.72rem] font-bold uppercase tracking-[0.04em] text-white lg:flex xl:gap-6">
            <!-- Google Translate Dropdown Widget -->
            <div id="google_translate_element" class="inline-block"></div>

            <button class="inline-flex cursor-pointer items-center gap-2 transition hover:text-[#d8b45a]" type="button" onclick="openAccountModal()" aria-label="My account">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" />
                    <path d="M5.5 20c1.1-3.4 3.3-5.1 6.5-5.1s5.4 1.7 6.5 5.1" stroke-linecap="round" />
                </svg>
                <span data-i18n-de="Mein Konto" data-i18n-en="My Account">Mein Konto</span>
            </button>

            <button class="inline-flex cursor-pointer items-center gap-2 transition hover:text-[#d8b45a]" type="button" onclick="openWishlistModal()" aria-label="Wishlist">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                </svg>
                <span data-i18n-de="Wunschliste" data-i18n-en="Wishlist">Wunschliste</span>
            </button>

            <button class="relative inline-flex cursor-pointer items-center gap-2 transition hover:text-[#d8b45a]" type="button" onclick="openCartDrawer()" aria-label="Shopping cart">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                </svg>
                <span data-i18n-de="Warenkorb" data-i18n-en="Shopping Cart">Warenkorb</span>
                <span class="cart-badge-count absolute -right-3 -top-2 flex h-4 w-4 items-center justify-center rounded-full bg-[#d8b45a] text-[0.58rem] font-bold text-[#120807]">{{ count(session('cart', [])) }}</span>
            </button>
        </div>

        <button class="relative ml-auto inline-flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-[#78000b] text-white shadow-md transition hover:bg-[#5a0309] lg:hidden" type="button" onclick="openCartDrawer()" aria-label="Open cart">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
            </svg>
            <span class="cart-badge-count absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-[#d8b45a] text-[0.58rem] font-bold text-[#120807]">{{ count(session('cart', [])) }}</span>
        </button>
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

            <!-- Mobile Google Translate Widget -->
            <div class="mt-4 flex items-center justify-between rounded-lg border border-[#d8b45a]/30 bg-[#170b09] p-2.5">
                <span class="text-xs font-bold uppercase tracking-wider text-[#d8b45a]">Sprache / Language:</span>
                <div id="google_translate_element_mobile"></div>
            </div>

            <!-- Mobile Search Bar -->
            <form class="mt-5 flex items-center rounded-sm border border-[#d8b45a]/35 bg-[#170b09] px-3.5 py-2.5 text-white" action="/shop" method="get">
                <input id="mobile-site-search" name="search" class="w-full bg-transparent text-xs font-medium uppercase tracking-[0.1em] text-[#fffaf0] outline-none placeholder:text-[#e4d9cc]/40" type="search" placeholder="Suche in Mehaaj..." data-i18n-placeholder-de="Suche in Mehaaj..." data-i18n-placeholder-en="Search in Mehaaj...">
                <button type="submit" class="text-[#d8b45a] hover:text-white" aria-label="Search">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4 4" stroke-linecap="round"/></svg>
                </button>
            </form>

            <!-- Navigation Links Grid with Dynamic Database Categories & Subcategories -->
            <nav class="mt-4 grid divide-y divide-[#d8b45a]/12 text-sm uppercase" aria-label="Mobile Menu Navigation">
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

