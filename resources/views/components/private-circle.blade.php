<!-- Maison Private Circle & VIP Club (Light Luxury Theme) -->
<section class="relative overflow-hidden bg-white py-16 sm:py-20 lg:py-24 border-b border-[#e6decb]" aria-labelledby="private-circle-heading">
    
    <div class="luxury-container relative z-10">
        
        <div class="relative overflow-hidden rounded-3xl border border-[#d8b45a]/40 bg-gradient-to-br from-[#fbf9f5] via-[#f7f2e7] to-[#ede3d1] p-8 sm:p-12 lg:p-16 shadow-lg">
            
            <!-- Elegant Gold Ambient Radial Accents -->
            <div class="pointer-events-none absolute -right-20 -top-20 h-80 w-80 rounded-full bg-[radial-gradient(circle,rgba(216,180,90,0.18),transparent_70%)]"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-20 h-80 w-80 rounded-full bg-[radial-gradient(circle,rgba(120,0,11,0.08),transparent_70%)]"></div>
            
            <!-- Top Subtle Shimmer Accent Line -->
            <div class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-transparent via-[#d8b45a]/60 to-transparent"></div>

            <div class="relative z-10 grid gap-10 lg:grid-cols-12 lg:items-center">
                
                <!-- Left Column: Invitation Text & Privilege Perks -->
                <div class="lg:col-span-7 space-y-4">
                    
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/50 bg-white/80 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#78000b] backdrop-blur-md shadow-2xs">
                        <span class="text-[#d8b45a]">◆</span>
                        <span data-i18n-de="MEHAAJ PRIVATE CIRCLE" data-i18n-en="MEHAAJ PRIVATE CIRCLE">MEHAAJ PRIVATE CIRCLE</span>
                    </div>

                    <h2 id="private-circle-heading" class="font-display text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-[#1c1210] leading-tight">
                        <span data-i18n-de="Werden Sie Teil unserer privaten Gemeinschaft." data-i18n-en="Become part of our private circle.">
                            Werden Sie Teil unserer privaten Gemeinschaft.
                        </span>
                    </h2>

                    <p class="text-xs sm:text-sm text-[#685c54] font-light leading-relaxed max-w-xl" data-i18n-de="Genießen Sie exklusiven Vorab-Zugang zu limitierten Leder-Editionen, persönliche Einladungen zu privaten Salon-Präsentationen und ein 10% Willkommensprivileg für Ihre erste Bestellung." data-i18n-en="Enjoy exclusive priority access to limited leather editions, personal invitations to private salon previews, and a 10% welcome privilege on your first order.">
                        Genießen Sie exklusiven Vorab-Zugang zu limitierten Leder-Editionen, persönliche Einladungen zu privaten Salon-Präsentationen und ein 10% Willkommensprivileg für Ihre erste Bestellung.
                    </p>

                    <!-- Feature Perks List -->
                    <div class="pt-2 flex flex-wrap gap-4 text-[0.68rem] font-semibold text-[#1c1210]">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 border border-[#e6decb] px-3 py-1 shadow-2xs">
                            <span class="text-[#2e683a]">✓</span>
                            <span data-i18n-de="10% Willkommensrabatt (Code: MEHAAJ10)" data-i18n-en="10% Welcome Privilege (Code: MEHAAJ10)">10% Willkommensrabatt (Code: MEHAAJ10)</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 border border-[#e6decb] px-3 py-1 shadow-2xs">
                            <span class="text-[#2e683a]">✓</span>
                            <span data-i18n-de="Exklusive Pre-Order Zuteilung" data-i18n-en="Exclusive Pre-Order Allocation">Exklusive Pre-Order Zuteilung</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/90 border border-[#e6decb] px-3 py-1 shadow-2xs">
                            <span class="text-[#2e683a]">✓</span>
                            <span data-i18n-de="Private Salon Einladungen" data-i18n-en="Private Salon Invitations">Private Salon Einladungen</span>
                        </span>
                    </div>

                </div>

                <!-- Right Column: Glassmorphic Light Subscribe Box -->
                <div class="lg:col-span-5">
                    <div class="rounded-2xl border border-[#d8b45a]/40 bg-white/90 p-6 sm:p-8 shadow-xl backdrop-blur-md space-y-4">
                        
                        <div>
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-[#78000b] block mb-1" data-i18n-de="VIP PRIVILEG FREISCHALTEN" data-i18n-en="UNLOCK VIP PRIVILEGE">
                                VIP PRIVILEG FREISCHALTEN
                            </span>
                            <p class="font-display text-lg font-medium text-[#1c1210]" data-i18n-de="Ihre persönliche Einladung" data-i18n-en="Your Personal Invitation">
                                Ihre persönliche Einladung
                            </p>
                        </div>

                        <form class="space-y-3" onsubmit="event.preventDefault(); const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en'; LuxurySwal.fire({icon: 'success', title: isEn ? 'Welcome to the Private Circle!' : 'Willkommen im Private Circle!', text: isEn ? 'Your personal 10% welcome code is: MEHAAJ10. We look forward to welcoming you.' : 'Ihr persönlicher 10% Willkommenscode lautet: MEHAAJ10. Wir freuen uns, Sie begrüßen zu dürfen.', confirmButtonText: isEn ? 'Splendid' : 'Wunderbar'}); this.reset();">
                            <div>
                                <label class="block text-[0.68rem] font-semibold text-[#1c1210] mb-1" data-i18n-de="Ihre E-Mail-Adresse" data-i18n-en="Your Email Address">Ihre E-Mail-Adresse</label>
                                <input
                                    type="email"
                                    required
                                    placeholder="maximilian@beispiel.de"
                                    data-i18n-placeholder-de="maximilian@beispiel.de"
                                    data-i18n-placeholder-en="john.doe@example.com"
                                    class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] placeholder-[#8a7c74] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                                >
                            </div>

                            <button
                                type="submit"
                                class="w-full flex h-11 items-center justify-center gap-2 rounded-xl bg-[#78000b] px-5 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-lg transition-all active:scale-98 cursor-pointer ring-4 ring-[#78000b]/15"
                            >
                                <span data-i18n-de="MITGLIEDSCHAFT BESTÄTIGEN" data-i18n-en="CONFIRM MEMBERSHIP">MITGLIEDSCHAFT BESTÄTIGEN</span>
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                            </button>
                        </form>

                        <p class="text-center text-[0.62rem] text-[#8a7c74]" data-i18n-de="Jederzeit abbestellbar. Vollständiger Datenschutz nach DSGVO garantiert." data-i18n-en="Unsubscribe anytime. Full GDPR data privacy guaranteed.">
                            Jederzeit abbestellbar. Vollständiger Datenschutz nach DSGVO garantiert.
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </div>

</section>
