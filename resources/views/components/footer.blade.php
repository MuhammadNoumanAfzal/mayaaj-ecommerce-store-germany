<!-- Compact Luxury Maison Footer (Obsidian & Atelier Burgundy Theme) -->
<footer id="brand-footer" class="relative overflow-hidden bg-[#0d0707] text-[#f4efe8] border-t border-[#d8b45a]/30">

    <!-- Subtle Ambient Luxury Glow -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_35%_at_50%_0%,rgba(120,0,11,0.22),transparent_70%)]"></div>

    <div class="luxury-container relative z-10 py-8 sm:py-10">

        <!-- Top Inline Strip: Logo, Concierge Contact & Heritage Badges (Compact 1-row) -->
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-white/10 pb-6 mb-8">
            <!-- Brand Logo & Motto -->
            <div class="flex items-center gap-3.5">
                <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105 duration-200" aria-label="MEHAAJ Official Home">
                    <img src="{{ asset('logo.png') }}?v={{ file_exists(public_path('logo.png')) ? filemtime(public_path('logo.png')) : 1 }}" alt="MEHAAJ" class="h-8 w-auto object-contain brightness-110 drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
                </a>
                <span class="hidden sm:inline-block h-4 w-[1px] bg-white/20"></span>
                <span class="hidden sm:inline-block text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#d8b45a]" data-i18n-en="Haute Maroquinerie • Est. 2026" data-i18n-de="Haute Maroquinerie • Est. 2026">
                    Haute Maroquinerie • Est. 2026
                </span>
            </div>

            <!-- Concierge Direct Touchpoints -->
            <div class="flex flex-wrap items-center gap-3 text-xs">
                <a href="tel:+496998765430" class="inline-flex items-center gap-1.5 rounded-full border border-white/15 bg-white/5 px-3 py-1 text-[0.68rem] text-white/90 hover:text-[#ffd45a] hover:border-[#ffd45a]/50 hover:bg-white/10 transition">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>+49 (0) 69 9876 5430</span>
                </a>

                <a href="mailto:concierge@mehaaj.com" class="inline-flex items-center gap-1.5 rounded-full border border-white/15 bg-white/5 px-3 py-1 text-[0.68rem] text-white/90 hover:text-[#ffd45a] hover:border-[#ffd45a]/50 hover:bg-white/10 transition">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    <span>concierge@mehaaj.com</span>
                </a>

                <span class="inline-flex items-center gap-1 rounded-full border border-[#d8b45a]/40 bg-[#d8b45a]/10 px-2.5 py-0.5 text-[0.6rem] font-bold uppercase tracking-wider text-[#ffd45a]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#ffd45a] animate-pulse"></span>
                    <span data-i18n-en="Concierge Active" data-i18n-de="Concierge Aktiv">Concierge Aktiv</span>
                </span>
            </div>
        </div>

        <!-- 4 Compact Main Columns -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 pb-8 border-b border-white/10 text-xs">
            
            <!-- Column 1: Atelier Maison -->
            <div class="space-y-2.5">
                <h4 class="font-display text-sm font-semibold uppercase tracking-wider text-white" data-i18n-en="Atelier Mehaaj" data-i18n-de="Atelier Mehaaj">
                    Atelier Mehaaj
                </h4>
                <p class="text-[0.72rem] text-white/65 leading-relaxed font-light" data-i18n-en="European master craftsmanship, Tuscan full-grain leather, and Swiss precision horlogerie." data-i18n-de="Europäische Handwerkskunst, toskanisches Vollleder und Schweizer Uhren-Präzision.">
                    Europäische Handwerkskunst, toskanisches Vollleder und Schweizer Uhren-Präzision.
                </p>
                <div class="pt-1 text-[0.68rem] text-white/50 space-y-1">
                    <p>Goethestraße 28, Frankfurt am Main</p>
                    <p data-i18n-en="Mon–Sat: 09:00–19:00 CET" data-i18n-de="Mo–Sa: 09:00–19:00 Uhr">Mo–Sa: 09:00–19:00 Uhr</p>
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-1 text-[0.68rem] text-[#d8b45a] hover:text-[#ffd45a] font-medium pt-1 transition">
                        <span>›</span> <span data-i18n-en="Our 50,000-Yr Leather Heritage →" data-i18n-de="Unsere 50.000-jährige Leder-Geschichte →">Our 50,000-Yr Leather Heritage →</span>
                    </a>
                    <a href="{{ route('reviews.index') }}" class="inline-flex items-center gap-1 text-[0.68rem] text-[#ffd45a] hover:text-white font-medium pt-0.5 transition">
                        <span>★</span> <span data-i18n-en="Patron Guestbook & Reviews (4.98★) →" data-i18n-de="Kundenbewertungen & Gästebuch (4.98★) →">Patron Guestbook & Reviews (4.98★) →</span>
                    </a>
                </div>
            </div>

            <!-- Column 2: Kollektionen Links -->
            <div class="space-y-2.5">
                <h4 class="font-display text-sm font-semibold uppercase tracking-wider text-white" data-i18n-en="Collections" data-i18n-de="Kollektionen">
                    Kollektionen
                </h4>
                <ul class="space-y-1.5 text-[0.72rem] text-white/70">
                    <li>
                        <a href="{{ route('shop', ['category' => 'luxury-handbags']) }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Handbags & Totes" data-i18n-de="Handtaschen & Totes">
                            <span class="text-[#d8b45a]">›</span> Handtaschen & Totes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop', ['category' => 'travel-luggage']) }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Weekenders & Travel" data-i18n-de="Reisetaschen & Weekender">
                            <span class="text-[#d8b45a]">›</span> Reisetaschen & Weekender
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop', ['category' => 'executive-briefcases']) }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Executive Briefcases" data-i18n-de="Business Aktentaschen">
                            <span class="text-[#d8b45a]">›</span> Business Aktentaschen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop', ['category' => 'luxury-jewelry-watches']) }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Timepieces & Horlogerie" data-i18n-de="Uhren & Chronographen">
                            <span class="text-[#d8b45a]">›</span> Uhren & Chronographen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="All Bespoke Creations" data-i18n-de="Alle Meisterwerke">
                            <span class="text-[#d8b45a]">›</span> Alle Meisterwerke
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Kundenservice & Legal Links -->
            <div class="space-y-2.5">
                <h4 class="font-display text-sm font-semibold uppercase tracking-wider text-white" data-i18n-en="Client Services" data-i18n-de="Kundenservice">
                    Kundenservice
                </h4>
                <ul class="space-y-1.5 text-[0.72rem] text-white/70">
                    <li>
                        <a href="{{ route('cart.index') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Shopping Bag" data-i18n-de="Warenkorb">
                            <span class="text-[#d8b45a]">›</span> Warenkorb
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('checkout.index') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Express Checkout" data-i18n-de="Kasse & Zahlung">
                            <span class="text-[#d8b45a]">›</span> Kasse & Zahlung
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shipping') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="DHL Insured Shipping" data-i18n-de="DHL Expressversand">
                            <span class="text-[#d8b45a]">›</span> DHL Expressversand
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('returns') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="30-Day Return Policy" data-i18n-de="30 Tage Rückgaberecht">
                            <span class="text-[#d8b45a]">›</span> 30 Tage Rückgaberecht
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('impressum') }}" class="hover:text-[#ffd45a] transition flex items-center gap-1" data-i18n-en="Legal Imprint" data-i18n-de="Impressum & AGB">
                            <span class="text-[#d8b45a]">›</span> Impressum & AGB
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Private Circle Mini-Subscription & Socials -->
            <div class="space-y-2.5">
                <h4 class="font-display text-sm font-semibold uppercase tracking-wider text-white" data-i18n-en="Private Circle" data-i18n-de="Private Circle">
                    Private Circle
                </h4>
                <p class="text-[0.72rem] text-white/65 leading-relaxed" data-i18n-en="10% welcome privilege (MEHAAJ10) & private previews." data-i18n-de="10% Willkommensprivileg (Code: MEHAAJ10).">
                    10% Willkommensprivileg (Code: MEHAAJ10).
                </p>

                <!-- Ultra-Clean Mini Newsletter Input -->
                <form class="flex mt-1" onsubmit="event.preventDefault(); LuxuryToast.fire({icon: 'success', title: 'Welcome! Code: MEHAAJ10'}); this.reset();">
                    <input
                        type="email"
                        required
                        placeholder="E-Mail"
                        data-i18n-placeholder-de="Ihre E-Mail"
                        data-i18n-placeholder-en="Your email"
                        class="h-8 w-full rounded-l-md border border-white/20 bg-white/5 px-2.5 text-[0.72rem] text-white placeholder-white/40 focus:border-[#d8b45a] focus:outline-none"
                    >
                    <button
                        type="submit"
                        class="h-8 rounded-r-md bg-[#78000b] px-3 text-[0.62rem] font-bold uppercase tracking-wider text-white hover:bg-[#a00010] transition shrink-0 cursor-pointer"
                        data-i18n-en="Join"
                        data-i18n-de="Beitreten"
                    >
                        Beitreten
                    </button>
                </form>

                <!-- Social Pills -->
                <div class="flex items-center gap-1.5 pt-1 text-[0.65rem]">
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="px-2 py-0.5 rounded border border-white/15 bg-white/5 text-white/70 hover:text-white hover:border-[#ffd45a] transition">Instagram</a>
                    <a href="https://facebook.com" target="_blank" rel="noopener" class="px-2 py-0.5 rounded border border-white/15 bg-white/5 text-white/70 hover:text-white hover:border-[#ffd45a] transition">Facebook</a>
                    <a href="https://pinterest.com" target="_blank" rel="noopener" class="px-2 py-0.5 rounded border border-white/15 bg-white/5 text-white/70 hover:text-white hover:border-[#ffd45a] transition">Pinterest</a>
                </div>
            </div>

        </div>

        <!-- Bottom Row: Payment Methods, Security & Copyright (Compact single-bar) -->
        <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-[0.68rem] text-white/55">
            
            <!-- Left: Payment reassurance chips -->
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1 rounded bg-white/5 border border-white/10 px-2 py-0.5 text-white/80">
                    💵 <span data-i18n-en="Cash on Delivery (COD)" data-i18n-de="Barzahlung bei Lieferung (COD)">Nachnahme (COD)</span>
                </span>
                <span class="inline-flex items-center gap-1 rounded bg-white/5 border border-white/10 px-2 py-0.5 text-white/80">
                    🏛️ <span data-i18n-en="Bank Transfer" data-i18n-de="Banküberweisung">Banküberweisung</span>
                </span>
                <span class="inline-flex items-center gap-1 text-[#2e683a] font-semibold text-[0.65rem]">
                    🔒 SSL 256-Bit
                </span>
            </div>

            <!-- Center: Craftsmanship Authenticity -->
            <div class="text-[#d8b45a] font-semibold flex items-center gap-1.5 text-[0.65rem]">
                <span>✦</span>
                <span data-i18n-en="Handcrafted in Europe • 100% Authenticity Guarantee" data-i18n-de="Handgefertigt in Europa • 100% Echtheitsgarantie">
                    Handgefertigt in Europa • 100% Echtheitsgarantie
                </span>
                <span>✦</span>
            </div>

            <!-- Right: Copyright & Mini Legal Links -->
            <div class="flex items-center gap-3">
                <span>© 2026 MEHAAJ GmbH</span>
                <span>•</span>
                <a href="{{ route('impressum') }}" class="hover:text-white transition" data-i18n-en="Imprint" data-i18n-de="Impressum">Impressum</a>
                <span>•</span>
                <a href="{{ route('privacy') }}" class="hover:text-white transition" data-i18n-en="Privacy" data-i18n-de="Datenschutz">Datenschutz</a>
                <span>•</span>
                <a href="{{ route('agb') }}" class="hover:text-white transition" data-i18n-en="Terms" data-i18n-de="AGB">AGB</a>
            </div>

        </div>

    </div>

</footer>
