@php
    $isHome = request()->routeIs('home') || request()->is('/');
    $cartCount = count(session('cart', []));
@endphp

<!-- Luxury Maison Header: Transparent at top of Home Hero, transitions to colorful Atelier Burgundy & Gold on scroll -->
<header 
    id="main-site-header" 
    class="site-luxury-header sticky top-0 z-50 w-full border-0 border-none transition-all duration-500 ease-in-out {{ $isHome ? 'header-transparent' : 'header-colorful' }}" 
    data-is-home="{{ $isHome ? '1' : '0' }}"
    data-site-header
>
    <!-- Soft top scrim layer for flawless text contrast when transparent over hero images -->
    <div class="pointer-events-none absolute inset-0 z-0 bg-gradient-to-b from-black/55 via-black/20 to-transparent opacity-100 transition-opacity duration-500" id="header-scrim-layer"></div>

    <nav class="relative z-10 mx-auto flex h-16 w-full max-w-[1600px] items-center justify-between px-3 sm:px-5 lg:h-[4.75rem] lg:px-6 xl:px-8 2xl:px-10 text-white" aria-label="Main Maison navigation">
        
        <!-- Left: Brand Logo & Mobile Toggle -->
        <div class="flex items-center gap-2.5 sm:gap-3.5 shrink-0">
            <!-- Mobile Menu Toggle Button (Visible on mobile & tablet) -->
            <button 
                type="button" 
                id="mobile-nav-toggle-btn"
                onclick="toggleMobileNavDrawer()" 
                class="lg:hidden flex h-9 w-9 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white hover:bg-white/20 transition-all duration-200 cursor-pointer shadow-2xs backdrop-blur-xs" 
                aria-label="Toggle navigation menu"
                aria-expanded="false"
            >
                <svg id="mobile-toggle-icon-bars" class="h-4.5 w-4.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
                <svg id="mobile-toggle-icon-close" class="hidden h-4.5 w-4.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

            <!-- Brand Maison Logo -->
            <a href="{{ route('home') }}" class="group flex shrink-0 items-center transition-transform hover:scale-105 duration-300" aria-label="MEHAAJ Official Home">
                <img 
                    src="{{ asset('logo.png') }}" 
                    alt="MEHAAJ" 
                    class="h-8.5 w-auto max-w-[125px] object-contain sm:h-9.5 sm:max-w-[145px] lg:h-10 lg:max-w-[155px] xl:h-11 xl:max-w-[165px] brightness-110 drop-shadow-[0_2px_12px_rgba(0,0,0,0.85)] transition-all duration-300 group-hover:brightness-125"
                >
            </a>
        </div>

        <!-- Center: Essential Luxury Navigation Links (Strictly Single Line) -->
        <div class="hidden lg:flex items-center gap-3 xl:gap-5 2xl:gap-7 whitespace-nowrap shrink-0 flex-nowrap">
            <!-- Kollektion / Collection -->
            <a 
                href="{{ route('shop') }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span data-i18n-en="Collection" data-i18n-de="Kollektion">Kollektion</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Handtaschen / Handbags -->
            <a 
                href="{{ route('shop', ['category' => 'handbags']) }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span data-i18n-en="Handbags" data-i18n-de="Handtaschen">Handtaschen</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Weekender & Travel -->
            <a 
                href="{{ route('shop', ['category' => 'travel-luggage']) }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span data-i18n-en="Weekender" data-i18n-de="Reisetaschen">Reisetaschen</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Aktentaschen / Briefcases -->
            <a 
                href="{{ route('shop', ['category' => 'briefcases']) }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span data-i18n-en="Briefcases" data-i18n-de="Aktentaschen">Aktentaschen</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Uhren & Schmuck / Watches & Jewelry -->
            <a 
                href="{{ route('shop', ['category' => 'watches-jewelry']) }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span class="whitespace-nowrap" data-i18n-en="Watches & Jewelry" data-i18n-de="Uhren & Schmuck">Uhren & Schmuck</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Heritage & Leather History / About Us -->
            <a 
                href="{{ route('about') }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span class="whitespace-nowrap" data-i18n-en="Heritage & Lore" data-i18n-de="Über Uns">Über Uns</span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>

            <!-- Client Reviews / Bewertungen -->
            <a 
                href="{{ route('reviews.index') }}" 
                class="group relative inline-flex items-center py-2 text-[0.67rem] xl:text-[0.73rem] 2xl:text-[0.76rem] font-semibold uppercase tracking-[0.12em] xl:tracking-[0.15em] text-white/95 hover:text-[#ffd45a] transition-colors duration-200 drop-shadow-sm whitespace-nowrap shrink-0"
            >
                <span class="whitespace-nowrap flex items-center gap-1">
                    <span class="text-[#ffd45a] text-[0.65rem]">★</span>
                    <span data-i18n-en="Reviews" data-i18n-de="Bewertungen">Bewertungen</span>
                </span>
                <span class="absolute bottom-0 left-0 h-[2px] w-full scale-x-0 rounded-full bg-[#ffd45a] transition-transform duration-300 ease-out group-hover:scale-x-100 origin-center shadow-[0_0_8px_rgba(255,212,90,0.8)]"></span>
            </a>
        </div>

        <!-- Right Side: Live Search, Atelier Concierge, Language & Cart -->
        <div class="flex items-center gap-1.5 sm:gap-2.5 lg:gap-3 shrink-0 whitespace-nowrap">
            
            <!-- Live Search Trigger Button -->
            <button 
                type="button" 
                onclick="openLiveSearchModal()" 
                class="group flex items-center gap-1.5 sm:gap-2 rounded-full border border-white/20 bg-white/10 px-2.5 py-1.5 sm:px-3 sm:py-2 text-xs text-white/95 hover:bg-white/20 hover:border-[#ffd45a]/70 hover:text-[#ffd45a] transition-all duration-300 cursor-pointer shadow-2xs backdrop-blur-xs shrink-0 whitespace-nowrap" 
                aria-label="Open Search Catalog"
                title="Search (Ctrl + K)"
            >
                <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-[#ffd45a] transition-transform group-hover:scale-110 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <span class="hidden sm:inline text-[0.66rem] font-semibold uppercase tracking-wider whitespace-nowrap" data-i18n-en="Search" data-i18n-de="Suche">Suche</span>
                <kbd class="hidden 2xl:inline-flex items-center rounded border border-white/20 bg-black/25 px-1.5 py-0.5 text-[0.56rem] font-mono font-bold text-white/80">⌘K</kbd>
            </button>

            <!-- Language Switcher Pill (EN | DE) -->
            <div class="inline-flex items-center rounded-full border border-white/25 bg-black/35 p-0.5 text-[0.62rem] font-bold shadow-2xs backdrop-blur-md">
                <button 
                    type="button" 
                    onclick="setSiteLanguage('en')" 
                    id="lang-btn-en" 
                    class="px-2.5 py-1 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a] font-bold shadow-2xs"
                >EN</button>
                <button 
                    type="button" 
                    onclick="setSiteLanguage('de')" 
                    id="lang-btn-de" 
                    class="px-2.5 py-1 rounded-full transition cursor-pointer text-white/80 hover:text-white font-semibold"
                >DE</button>
            </div>

            <!-- Shopping Bag Drawer Trigger Button -->
            <button 
                type="button" 
                onclick="openCartDrawer()" 
                class="group relative flex h-9 w-9 sm:h-10 sm:w-10 items-center justify-center rounded-full border border-white/25 bg-white/10 text-white hover:bg-[#d8b45a] hover:text-[#120807] hover:border-[#d8b45a] transition-all duration-300 cursor-pointer shadow-2xs backdrop-blur-xs" 
                aria-label="Open Shopping Bag"
            >
                <svg class="h-4.5 w-4.5 sm:h-5 sm:w-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" stroke-linejoin="round"/>
                    <path d="M3 6h18"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
                <span class="cart-badge-count absolute -top-1 -right-1 flex h-4.5 min-w-4.5 items-center justify-center rounded-full bg-[#78000b] px-1 text-[0.6rem] font-black text-white shadow-sm ring-2 ring-[#ffd45a]">
                    {{ $cartCount }}
                </span>
            </button>
        </div>
    </nav>

    <!-- Mobile Navigation Drawer (Slide Down Accordion for mobile devices) -->
    <div 
        id="mobile-nav-drawer" 
        class="hidden lg:hidden border-t border-[#d8b45a]/25 bg-gradient-to-b from-[#4d0107]/98 via-[#66010a]/98 to-[#4d0107]/98 px-5 py-6 text-white shadow-2xl backdrop-blur-xl transition-all duration-300"
    >
        <!-- Mobile Search Bar -->
        <div class="mb-5">
            <button 
                type="button" 
                onclick="openLiveSearchModal(); toggleMobileNavDrawer();" 
                class="w-full flex items-center justify-between rounded-xl border border-white/20 bg-black/25 px-4 py-2.5 text-xs text-white/80 hover:border-[#ffd45a] transition"
            >
                <div class="flex items-center gap-2.5">
                    <svg class="h-4 w-4 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <span data-i18n-en="Search luxury collection..." data-i18n-de="Luxus-Kollektion durchsuchen...">Luxus-Kollektion durchsuchen...</span>
                </div>
                <span class="text-[0.62rem] text-[#ffd45a] uppercase font-bold tracking-wider">Ctrl + K</span>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col divide-y divide-white/10 text-sm font-semibold tracking-wider">
            <a href="{{ route('shop') }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Full Collection" data-i18n-de="Gesamte Kollektion">Gesamte Kollektion</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('shop', ['category' => 'handbags']) }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Handbags & Totes" data-i18n-de="Handtaschen & Totes">Handtaschen & Totes</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('shop', ['category' => 'travel-luggage']) }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Weekender & Travel Bags" data-i18n-de="Reisetaschen & Weekender">Reisetaschen & Weekender</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('shop', ['category' => 'briefcases']) }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Executive Briefcases" data-i18n-de="Aktentaschen">Aktentaschen</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('shop', ['category' => 'watches-jewelry']) }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Watches & Haute Horlogerie" data-i18n-de="Uhren & Haute Horlogerie">Uhren & Haute Horlogerie</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span data-i18n-en="Heritage & Leather Lore" data-i18n-de="Leder-Erbe & Über Uns">Leder-Erbe & Über Uns</span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
            <a href="{{ route('reviews.index') }}" class="flex items-center justify-between py-3 text-white hover:text-[#ffd45a] transition">
                <span class="flex items-center gap-1.5">
                    <span class="text-[#ffd45a]">★</span>
                    <span data-i18n-en="Client Reviews & Guestbook" data-i18n-de="Kundenbewertungen & Gästebuch">Kundenbewertungen & Gästebuch</span>
                </span>
                <span class="text-[#ffd45a] text-xs">→</span>
            </a>
        </div>

        <!-- Mobile Language Selector & Shopping Bag -->
        <div class="mt-6 pt-4 border-t border-white/15 space-y-3">
            <div class="flex items-center justify-between px-1">
                <span class="text-xs text-white/75 font-semibold uppercase tracking-wider" data-i18n-en="Language / Sprache:" data-i18n-de="Sprache / Language:">Sprache / Language:</span>
                <div class="inline-flex items-center rounded-full border border-white/25 bg-black/40 p-0.5 text-xs font-bold shadow-xs backdrop-blur-md">
                    <button 
                        type="button" 
                        onclick="setSiteLanguage('en')" 
                        id="lang-btn-mobile-en" 
                        class="px-3 py-1 rounded-full transition cursor-pointer text-[#120807] bg-[#d8b45a] font-bold shadow-xs"
                    >EN</button>
                    <button 
                        type="button" 
                        onclick="setSiteLanguage('de')" 
                        id="lang-btn-mobile-de" 
                        class="px-3 py-1 rounded-full transition cursor-pointer text-white/80 hover:text-white font-medium"
                    >DE</button>
                </div>
            </div>

            <button 
                type="button" 
                onclick="openCartDrawer(); toggleMobileNavDrawer();" 
                class="w-full flex items-center justify-center gap-2 rounded-lg bg-[#d8b45a] py-2.5 text-xs font-bold uppercase tracking-widest text-[#120807] hover:bg-[#ffd45a] transition cursor-pointer"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                    <path d="M3 6h18"/>
                </svg>
                <span data-i18n-en="Open Shopping Bag" data-i18n-de="Warenkorb Öffnen">Warenkorb Öffnen</span>
                <span>(<span class="cart-badge-count">{{ $cartCount }}</span>)</span>
            </button>
        </div>
    </div>
</header>

<!-- ========================================================================= -->
<!-- LIVE SEARCH OVERLAY MODAL ("nd serching") -->
<!-- ========================================================================= -->
<div 
    id="live-search-modal" 
    class="fixed inset-0 z-[100] hidden items-start justify-center pt-16 sm:pt-24 px-4 bg-black/80 backdrop-blur-md transition-opacity duration-300"
    role="dialog"
    aria-modal="true"
    aria-label="Product Search"
>
    <!-- Modal Card Container -->
    <div 
        class="w-full max-w-2xl rounded-2xl bg-[#130b0a] border border-[#d8b45a]/45 shadow-[0_25px_70px_rgba(0,0,0,0.85)] overflow-hidden flex flex-col max-h-[85vh] animate-in fade-in zoom-in-95 duration-200"
        onclick="event.stopPropagation()"
    >
        <!-- Modal Search Header & Input Bar -->
        <div class="relative border-b border-[#d8b45a]/25 bg-[#1b0e0d] p-4 sm:p-5">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#d8b45a]/15 text-[#ffd45a] border border-[#d8b45a]/30">
                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>

                <div class="relative flex-1">
                    <input 
                        type="text" 
                        id="live-search-input" 
                        class="w-full bg-transparent text-sm sm:text-base font-medium text-white placeholder-white/45 focus:outline-none"
                        placeholder="Search handbags, leather goods, chronographs..."
                        data-i18n-placeholder-en="Search handbags, leather goods, chronographs..."
                        data-i18n-placeholder-de="Handtaschen, Lederwaren, Uhren suchen..."
                        autocomplete="off"
                        autofocus
                    >
                </div>

                <!-- Clear Input Button -->
                <button 
                    type="button" 
                    id="live-search-clear-btn" 
                    onclick="clearLiveSearchInput()" 
                    class="hidden text-white/50 hover:text-white transition p-1"
                    title="Clear"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>

                <!-- Close Modal Button -->
                <button 
                    type="button" 
                    onclick="closeLiveSearchModal()" 
                    class="flex h-8 w-8 items-center justify-center rounded-full border border-white/20 bg-white/5 text-white/70 hover:bg-[#78000b] hover:text-white hover:border-[#78000b] transition-all cursor-pointer"
                    aria-label="Close search"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            <!-- Quick Suggestion Recommendation Chips -->
            <div class="mt-3.5 flex items-center gap-1.5 flex-wrap text-[0.68rem] text-white/60">
                <span class="text-white/40 font-semibold" data-i18n-en="Popular:" data-i18n-de="Beliebt:">Beliebt:</span>
                <button type="button" onclick="setLiveSearchQuery('Tote')" class="rounded-full bg-white/5 border border-white/10 px-2.5 py-0.5 text-white/80 hover:bg-[#d8b45a]/20 hover:text-[#ffd45a] hover:border-[#ffd45a]/40 transition">Tote</button>
                <button type="button" onclick="setLiveSearchQuery('Weekender')" class="rounded-full bg-white/5 border border-white/10 px-2.5 py-0.5 text-white/80 hover:bg-[#d8b45a]/20 hover:text-[#ffd45a] hover:border-[#ffd45a]/40 transition">Weekender</button>
                <button type="button" onclick="setLiveSearchQuery('Briefcase')" class="rounded-full bg-white/5 border border-white/10 px-2.5 py-0.5 text-white/80 hover:bg-[#d8b45a]/20 hover:text-[#ffd45a] hover:border-[#ffd45a]/40 transition">Briefcase</button>
                <button type="button" onclick="setLiveSearchQuery('Tourbillon')" class="rounded-full bg-white/5 border border-white/10 px-2.5 py-0.5 text-white/80 hover:bg-[#d8b45a]/20 hover:text-[#ffd45a] hover:border-[#ffd45a]/40 transition">Tourbillon</button>
                <button type="button" onclick="setLiveSearchQuery('Wallet')" class="rounded-full bg-white/5 border border-white/10 px-2.5 py-0.5 text-white/80 hover:bg-[#d8b45a]/20 hover:text-[#ffd45a] hover:border-[#ffd45a]/40 transition">Portemonnaie</button>
            </div>
        </div>

        <!-- Live Results Container -->
        <div id="live-search-results" class="flex-1 overflow-y-auto p-4 sm:p-5 divide-y divide-white/10">
            <!-- Initial State Greeting -->
            <div id="live-search-placeholder" class="py-10 text-center space-y-2.5">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#d8b45a]/10 text-[#ffd45a]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
                <h4 class="font-display text-base text-white font-medium" data-i18n-en="Explore Mehaaj Creations" data-i18n-de="Mehaaj Kreationen entdecken">Mehaaj Kreationen entdecken</h4>
                <p class="text-xs text-white/55 max-w-sm mx-auto" data-i18n-en="Type 2 or more characters to explore master-crafted leather bags, timepieces, and accessories." data-i18n-de="Geben Sie 2 oder mehr Zeichen ein, um handgefertigte Ledertaschen, Uhren und Accessoires zu entdecken.">
                    Geben Sie 2 oder mehr Zeichen ein, um handgefertigte Ledertaschen, Uhren und Accessoires zu entdecken.
                </p>
            </div>

            <!-- Loading Spinner -->
            <div id="live-search-spinner" class="hidden py-10 text-center">
                <div class="inline-block h-7 w-7 animate-spin rounded-full border-2 border-solid border-[#ffd45a] border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"></div>
                <p class="mt-2 text-xs text-white/60 animate-pulse" data-i18n-en="Searching atelier catalog..." data-i18n-de="Atelier-Katalog wird durchsucht...">Atelier-Katalog wird durchsucht...</p>
            </div>

            <!-- Empty State -->
            <div id="live-search-empty" class="hidden py-10 text-center space-y-3">
                <p class="text-sm font-medium text-white/80" data-i18n-en="No matching creations found" data-i18n-de="Keine passenden Meisterwerke gefunden">Keine passenden Meisterwerke gefunden</p>
                <p class="text-xs text-white/50 max-w-xs mx-auto" data-i18n-en="Please try different keywords or browse our full online boutique." data-i18n-de="Bitte versuchen Sie andere Begriffe oder stöbern Sie in unserer Kollektion.">
                    Bitte versuchen Sie andere Begriffe oder stöbern Sie in unserer Kollektion.
                </p>
                <a href="{{ route('shop') }}" onclick="closeLiveSearchModal()" class="inline-block mt-2 rounded-full bg-[#d8b45a] px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                    <span data-i18n-en="Browse Full Catalog" data-i18n-de="Gesamten Katalog ansehen">Gesamten Katalog ansehen</span>
                </a>
            </div>

            <!-- Dynamically Populated Results List -->
            <div id="live-search-items-list" class="space-y-2"></div>
        </div>

        <!-- Modal Footer with All Results Link -->
        <div id="live-search-footer" class="hidden border-t border-[#d8b45a]/25 bg-[#170c0c] px-5 py-3 sm:flex items-center justify-between text-xs">
            <span id="live-search-count-text" class="text-white/60 text-[0.72rem]"></span>
            <a 
                id="live-search-view-all-link" 
                href="{{ route('shop') }}" 
                onclick="closeLiveSearchModal()" 
                class="inline-flex items-center gap-1.5 text-[#ffd45a] hover:underline font-semibold text-[0.72rem] uppercase tracking-wider"
            >
                <span data-i18n-en="View all results in Shop" data-i18n-de="Alle Ergebnisse im Shop anzeigen">Alle Ergebnisse im Shop anzeigen</span>
                <span>→</span>
            </a>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- NAVBAR & LIVE SEARCH INTERACTION SCRIPT -->
<!-- ========================================================================= -->
<script>
    // 1. DYNAMIC SCROLL CONTROLLER (Transparent on Hero -> Colorful Burgundy on Scroll)
    (function initNavbarScrollController() {
        const header = document.getElementById('main-site-header');
        const scrimLayer = document.getElementById('header-scrim-layer');
        if (!header) return;

        const isHome = header.getAttribute('data-is-home') === '1';

        function updateHeaderScrollState() {
            const scrollY = window.scrollY || window.pageYOffset || 0;
            const isScrolled = scrollY > 25;

            if (!isHome || isScrolled) {
                // Scrolled or Interior Page: Show rich luxury colorful burgundy & gold navbar
                header.classList.remove('header-transparent');
                header.classList.add('header-colorful');
                if (scrimLayer) scrimLayer.style.opacity = '0';
            } else {
                // Top of Home Hero: Pure transparent luxury navbar overlay
                header.classList.add('header-transparent');
                header.classList.remove('header-colorful');
                if (scrimLayer) scrimLayer.style.opacity = '1';
            }
        }

        window.addEventListener('scroll', updateHeaderScrollState, { passive: true });
        // Initial execution on page load
        updateHeaderScrollState();
    })();

    // 2. MOBILE MENU DRAWER CONTROLLER
    function toggleMobileNavDrawer() {
        const drawer = document.getElementById('mobile-nav-drawer');
        const btn = document.getElementById('mobile-nav-toggle-btn');
        const iconBars = document.getElementById('mobile-toggle-icon-bars');
        const iconClose = document.getElementById('mobile-toggle-icon-close');
        if (!drawer) return;

        const isHidden = drawer.classList.contains('hidden');
        if (isHidden) {
            drawer.classList.remove('hidden');
            btn?.setAttribute('aria-expanded', 'true');
            iconBars?.classList.add('hidden');
            iconClose?.classList.remove('hidden');
        } else {
            drawer.classList.add('hidden');
            btn?.setAttribute('aria-expanded', 'false');
            iconBars?.classList.remove('hidden');
            iconClose?.classList.add('hidden');
        }
    }

    // 3. LIVE SEARCH MODAL ENGINE
    let searchDebounceTimer = null;

    function openLiveSearchModal() {
        const modal = document.getElementById('live-search-modal');
        const input = document.getElementById('live-search-input');
        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            if (input) {
                input.focus();
                input.select();
            }
        }, 80);
    }

    function closeLiveSearchModal() {
        const modal = document.getElementById('live-search-modal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Close on clicking backdrop
    document.getElementById('live-search-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLiveSearchModal();
        }
    });

    // Keyboard Shortcuts: Ctrl+K / Cmd+K to open, ESC to close
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            const modal = document.getElementById('live-search-modal');
            if (modal && !modal.classList.contains('hidden')) {
                closeLiveSearchModal();
            } else {
                openLiveSearchModal();
            }
        }
        if (e.key === 'Escape') {
            const modal = document.getElementById('live-search-modal');
            if (modal && !modal.classList.contains('hidden')) {
                closeLiveSearchModal();
            }
        }
    });

    function setLiveSearchQuery(q) {
        const input = document.getElementById('live-search-input');
        if (input) {
            input.value = q;
            triggerLiveSearch(q);
        }
    }

    function clearLiveSearchInput() {
        const input = document.getElementById('live-search-input');
        if (input) {
            input.value = '';
            input.focus();
            resetSearchState();
        }
    }

    function resetSearchState() {
        const clearBtn = document.getElementById('live-search-clear-btn');
        const placeholder = document.getElementById('live-search-placeholder');
        const spinner = document.getElementById('live-search-spinner');
        const empty = document.getElementById('live-search-empty');
        const itemsList = document.getElementById('live-search-items-list');
        const footer = document.getElementById('live-search-footer');

        if (clearBtn) clearBtn.classList.add('hidden');
        if (placeholder) placeholder.classList.remove('hidden');
        if (spinner) spinner.classList.add('hidden');
        if (empty) empty.classList.add('hidden');
        if (itemsList) itemsList.innerHTML = '';
        if (footer) footer.classList.add('hidden');
    }

    const searchInput = document.getElementById('live-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            const clearBtn = document.getElementById('live-search-clear-btn');
            if (clearBtn) {
                clearBtn.classList.toggle('hidden', query.length === 0);
            }

            clearTimeout(searchDebounceTimer);
            if (query.length < 2) {
                resetSearchState();
                return;
            }

            searchDebounceTimer = setTimeout(() => {
                triggerLiveSearch(query);
            }, 250);
        });

        // Enter key navigates to shop with search query
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query.length > 0) {
                    window.location.href = window.mehaajUrl('/shop?search=' + encodeURIComponent(query));
                }
            }
        });
    }

    function triggerLiveSearch(query) {
        const placeholder = document.getElementById('live-search-placeholder');
        const spinner = document.getElementById('live-search-spinner');
        const empty = document.getElementById('live-search-empty');
        const itemsList = document.getElementById('live-search-items-list');
        const footer = document.getElementById('live-search-footer');
        const countText = document.getElementById('live-search-count-text');
        const viewAllLink = document.getElementById('live-search-view-all-link');

        if (placeholder) placeholder.classList.add('hidden');
        if (empty) empty.classList.add('hidden');
        if (spinner) spinner.classList.remove('hidden');

        const searchUrl = window.mehaajUrl('/search/live?q=' + encodeURIComponent(query));

        fetch(searchUrl, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (spinner) spinner.classList.add('hidden');

            if (!data.products || data.products.length === 0) {
                if (empty) empty.classList.remove('hidden');
                if (itemsList) itemsList.innerHTML = '';
                if (footer) footer.classList.add('hidden');
                return;
            }

            if (empty) empty.classList.add('hidden');
            let html = '';

            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            const catTranslations = {
                'luxury-handbags': 'Luxus-Handtaschen',
                'leather-wallets': 'Leder-Geldbörsen',
                'travel-luggage': 'Reisegepäck',
                'executive-briefcases': 'Business-Aktentaschen',
                'luxury-jewelry-watches': 'Schmuck & Uhren',
                'golf-collection': 'Golf-Kollektion',
                'signature-keychains': 'Schlüsselanhänger'
            };

            data.products.forEach(p => {
                const catDisplay = (isEn || !catTranslations[p.category_slug]) ? p.category_name : catTranslations[p.category_slug];
                html += `
                    <a href="${p.url}" class="group flex items-center justify-between gap-3.5 rounded-xl p-2.5 transition-all duration-200 hover:bg-white/10 border border-transparent hover:border-[#d8b45a]/35">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-[#241312] border border-white/15">
                                <img src="${p.image_url}" alt="${p.name}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                            <div class="min-w-0">
                                <span class="inline-block text-[0.62rem] font-bold uppercase tracking-wider text-[#ffd45a] truncate">${catDisplay}</span>
                                <h4 class="font-display text-sm font-medium text-white truncate group-hover:text-[#ffd45a] transition">${p.name}</h4>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-bold text-white">${p.sale_price ? p.sale_price : p.price}</span>
                                    ${p.sale_price ? `<span class="text-[0.68rem] text-white/40 line-through">${p.price}</span>` : ''}
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0 text-white/40 group-hover:text-[#ffd45a] group-hover:translate-x-1 transition-all">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </div>
                    </a>
                `;
            });

            if (itemsList) itemsList.innerHTML = html;
            if (countText) {
                const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
                countText.innerText = data.count + ' ' + (isEn ? 'Creations found' : 'Meisterwerke gefunden');
            }
            if (viewAllLink) {
                viewAllLink.href = window.mehaajUrl('/shop?search=' + encodeURIComponent(query));
            }
            if (footer) footer.classList.remove('hidden');
        })
        .catch(err => {
            console.error('Live search request error:', err);
            if (spinner) spinner.classList.add('hidden');
        });
    }
</script>
