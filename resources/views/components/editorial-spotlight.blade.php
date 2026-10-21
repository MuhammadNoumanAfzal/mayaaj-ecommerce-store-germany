<!-- Bespoke Modern Editorial Spotlight Section (Light Theme) -->
<section class="relative overflow-hidden bg-[#faf7f2] py-16 sm:py-20 lg:py-24 border-b border-[#e6decb]" aria-labelledby="editorial-heading">
    
    <!-- Subtle Warm Ambient Radial Glow -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_20%_20%,rgba(216,180,90,0.08),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        
        <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
            
            <!-- Left Column: Asymmetric Editorial Composition -->
            <div class="lg:col-span-6 relative">
                
                <!-- Main Large Feature Image -->
                <div class="group relative overflow-hidden rounded-2xl border border-[#e6decb] bg-white shadow-xl transition-all duration-700 hover:shadow-2xl">
                    <div class="relative h-[420px] sm:h-[500px] overflow-hidden bg-[#f7f4ee]">
                        <img
                            src="{{ asset('craftsmanship_hero.png') }}"
                            alt="MEHAAJ Leather Master Craftsmanship"
                            class="h-full w-full object-cover object-center transition-transform duration-1000 group-hover:scale-105"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    </div>

                    <!-- Inset Floating Badge (Bottom Left) -->
                    <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between text-white">
                        <div class="flex items-center gap-3">
                            <span class="h-10 w-1 bg-[#d8b45a] rounded-full"></span>
                            <div>
                                <p class="text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#d8b45a]">MAISON MEHAAJ ATELIER</p>
                                <p class="font-display text-lg sm:text-xl font-medium" data-i18n-de="Echtes europäisches Meisterhandwerk" data-i18n-en="Authentic European Mastercraft">
                                    Echtes europäisches Meisterhandwerk
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overlapping Floating Card (Bottom Right) -->
                <div class="absolute -bottom-6 -right-3 sm:-bottom-8 sm:-right-6 hidden sm:flex items-center gap-3.5 rounded-xl border border-[#e6decb] bg-white/95 p-4 shadow-xl backdrop-blur-md transition-transform duration-300 hover:-translate-y-1">
                    <img
                        src="{{ asset('craftsmanship_detail.png') }}"
                        alt="Hand-stitched leather detail"
                        class="h-16 w-16 rounded-lg object-cover border border-[#e6decb]"
                    >
                    <div class="pr-2">
                        <span class="inline-flex items-center gap-1 text-[0.6rem] font-bold uppercase tracking-wider text-[#78000b]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                            <span data-i18n-de="VOLLNARBENLEDER" data-i18n-en="FULL-GRAIN LEATHER">VOLLNARBENLEDER</span>
                        </span>
                        <p class="font-display text-sm font-medium text-[#1c1210]" data-i18n-de="Traditionelle Sattlernaht" data-i18n-en="Traditional Saddle Stitch">Traditionelle Sattlernaht</p>
                        <p class="text-[0.68rem] text-[#685c54]" data-i18n-de="Unverwüstlich & handpoliert" data-i18n-en="Enduring & Hand-Burnished">Unverwüstlich & handpoliert</p>
                    </div>
                </div>

            </div>

            <!-- Right Column: Editorial Narrative & Atelier Metrics -->
            <div class="lg:col-span-6 lg:pl-6 space-y-6">
                
                <!-- Eyebrow Pill -->
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-de="DIE PHILOSOPHIE DER MAISON" data-i18n-en="THE PHILOSOPHY OF THE MAISON">DIE PHILOSOPHIE DER MAISON</span>
                </div>

                <!-- Main Editorial Heading -->
                <h2 id="editorial-heading" class="font-display text-3xl font-medium tracking-tight text-[#1c1210] sm:text-4xl lg:text-5xl leading-tight">
                    <span data-i18n-de="Wo meisterhafte Lederkunst auf zeitlose Ästhetik trifft." data-i18n-en="Where master leather artistry meets timeless aesthetic.">
                        Wo meisterhafte Lederkunst auf zeitlose Ästhetik trifft.
                    </span>
                </h2>

                <p class="text-xs sm:text-sm text-[#685c54] leading-relaxed font-light" data-i18n-de="Jedes Stück aus dem Hause MEHAAJ entsteht in sorgfältiger Handarbeit. Wir verwenden ausschließlich handverlesenes toskanisches Vollnarbenleder, das pflanzlich gegerbt wird und mit den Jahren eine unvergleichliche Patina entwickelt." data-i18n-en="Each piece from MEHAAJ is meticulously handcrafted. We exclusively select Tuscan full-grain leather, organically vegetable-tanned to cultivate an incomparable patina over decades.">
                    Jedes Stück aus dem Hause MEHAAJ entsteht in sorgfältiger Handarbeit. Wir verwenden ausschließlich handverlesenes toskanisches Vollnarbenleder, das pflanzlich gegerbt wird und mit den Jahren eine unvergleichliche Patina entwickelt.
                </p>

                <!-- Metric Highlights Row -->
                <div class="grid grid-cols-3 gap-4 pt-2 border-t border-[#f2ebdc]">
                    <div class="space-y-1">
                        <span class="font-display text-2xl sm:text-3xl font-medium text-[#78000b]">100%</span>
                        <p class="text-[0.68rem] text-[#685c54] leading-tight" data-i18n-de="Toskanisches Vollleder" data-i18n-en="Tuscan Full-Grain">Toskanisches Vollleder</p>
                    </div>
                    <div class="space-y-1">
                        <span class="font-display text-2xl sm:text-3xl font-medium text-[#78000b]">48h</span>
                        <p class="text-[0.68rem] text-[#685c54] leading-tight" data-i18n-de="Reine Handarbeitszeit" data-i18n-en="Artisan Handcraft Time">Reine Handarbeitszeit</p>
                    </div>
                    <div class="space-y-1">
                        <span class="font-display text-2xl sm:text-3xl font-medium text-[#78000b]">Lifetime</span>
                        <p class="text-[0.68rem] text-[#685c54] leading-tight" data-i18n-de="Atelier Nahtgarantie" data-i18n-en="Saddle Stitch Guarantee">Atelier Nahtgarantie</p>
                    </div>
                </div>

                <!-- Call To Action -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a
                        href="{{ route('shop') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#78000b] px-6 py-3.5 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-xl transition-all duration-300 active:scale-95"
                    >
                        <span data-i18n-de="KOLLEKTION ERKUNDEN" data-i18n-en="EXPLORE COLLECTION">KOLLEKTION ERKUNDEN</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>

                    <a
                        href="#brand-footer"
                        class="inline-flex items-center gap-2 rounded-xl border border-[#e6decb] bg-white px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-[#1c1210] hover:border-[#78000b] hover:text-[#78000b] transition shadow-2xs"
                    >
                        <span data-i18n-de="ATELIER CONCIERGE" data-i18n-en="ATELIER CONCIERGE">ATELIER CONCIERGE</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

</section>
