<header class="sticky top-0 z-50 w-full transition-all duration-300 border-b border-[#e8dfcf] bg-white/95 backdrop-blur-md shadow-[0_2px_15px_rgba(0,0,0,0.03)]" data-site-header>
    <!-- Clean, Modern Luxury Navigation Bar (Light Theme) -->
    <nav class="flex h-16 w-full max-w-full items-center justify-between px-4 sm:px-6 lg:h-[4.5rem] lg:px-12 text-[#1c1210]" aria-label="Main navigation">
        <!-- Brand Logo -->
        <a href="/" class="flex shrink-0 items-center transition-transform hover:scale-105 duration-200" aria-label="MEHAAJ home">
            <img src="{{ asset('logo.png') }}" alt="MEHAAJ" class="h-9 w-auto max-w-[130px] object-contain sm:h-10 sm:max-w-[150px] lg:h-11 lg:max-w-[160px]">
        </a>

        <!-- Right Side Controls -->
        <div class="flex items-center gap-3 sm:gap-4">
            <!-- Atelier Concierge Anchor Button -->
            <a href="#brand-footer" class="inline-flex items-center gap-1.5 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-4 py-1.5 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#78000b] hover:bg-[#78000b] hover:text-white transition-all duration-300 shadow-xs">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                <span data-i18n-en="ATELIER CONCIERGE" data-i18n-de="ATELIER CONCIERGE">ATELIER CONCIERGE</span>
            </a>

            <!-- Clean Modern Language Switcher Pill (EN | DE) -->
            <div class="inline-flex items-center rounded-full border border-[#d8b45a]/45 bg-[#fbf9f5] p-0.5 text-[0.62rem] font-bold shadow-xs">
                <button type="button" onclick="setSiteLanguage('en')" id="lang-btn-en" class="px-3 py-1 rounded-full transition cursor-pointer text-white bg-[#78000b] font-bold shadow-xs">EN</button>
                <button type="button" onclick="setSiteLanguage('de')" id="lang-btn-de" class="px-3 py-1 rounded-full transition cursor-pointer text-[#685c54] hover:text-[#1c1210] font-semibold">DE</button>
            </div>
        </div>
    </nav>
</header>
