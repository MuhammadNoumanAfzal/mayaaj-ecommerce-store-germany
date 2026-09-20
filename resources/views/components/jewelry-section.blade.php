<section class="relative overflow-hidden bg-[#0c0605] py-16 lg:py-24 text-white border-b border-[#d8b45a]/30">
    <!-- Ambient Radial Glows -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_50%,rgba(216,180,90,0.14),transparent_70%)]"></div>
    <div class="pointer-events-none absolute -top-24 -right-24 h-80 w-80 rounded-full bg-[#78000b]/30 blur-[100px] animate-float-slow"></div>

    <div class="luxury-container relative z-10">
        <!-- Header -->
        <div class="flex flex-col gap-4 border-b border-[#d8b45a]/20 pb-6 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/40 bg-black/50 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#d8b45a] backdrop-blur-md">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#d8b45a] animate-pulse"></span>
                    <span data-i18n-de="EXKLUSIVER SCHMUCK & CHRONOGRAPHEN" data-i18n-en="EXCLUSIVE JEWELRY & CHRONOGRAPHS">EXKLUSIVER SCHMUCK & CHRONOGRAPHEN</span>
                </div>
                <h2 class="mt-3 font-display text-3xl font-medium leading-tight text-[#fffaf0] sm:text-4xl lg:text-5xl" data-i18n-de="Schmuck & Edle Zeitmesser" data-i18n-en="Jewelry & Fine Timepieces">
                    Schmuck & Edle Zeitmesser
                </h2>
            </div>
            <p class="max-w-md text-xs leading-relaxed text-[#e4d9cc]/80 sm:text-sm font-light" data-i18n-de="Handgefertigte Schmuckschatullen aus feinstem Vollleder und präzisionsgefertigte Damen- & Herrenuhren." data-i18n-en="Handcrafted leather jewelry cases and precision-engineered luxury timepieces.">
                Handgefertigte Schmuckschatullen aus feinstem Vollleder und präzisionsgefertigte Damen- & Herrenuhren.
            </p>
        </div>

        <!-- Jewelry & Watch Cards Grid -->
        <div class="mt-10 grid gap-8 md:grid-cols-3">
            
            <!-- Item 1: Maison Chronograph Watch -->
            <div class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#d8b45a]/30 bg-[#160b09] shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)]">
                <div class="relative h-64 overflow-hidden bg-black/40">
                    <img src="/product_watch.png" alt="Maison Chronograph Watch" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-widest text-white shadow-md">CHRONOGRAPH</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10 flex flex-col gap-2 opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                        <button onclick="openWishlistModal()" type="button" class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-black/80 text-[#d8b45a] transition hover:bg-[#78000b] hover:text-white cursor-pointer">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#d8b45a]">AUTOMATIKUHR</p>
                        <h3 class="mt-1.5 font-display text-xl font-medium text-[#fffaf0] group-hover:text-[#d8b45a] transition-colors" data-i18n-de="Maison Chronograph Automatik" data-i18n-en="Maison Chronograph Automatic">
                            Maison Chronograph Automatik
                        </h3>
                        <p class="mt-2 text-xs text-[#e4d9cc]/70 leading-relaxed font-light" data-i18n-de="Schweizer Uhrwerk, Saphirglas & Armband aus toskanischem Vollleder." data-i18n-en="Swiss movement, sapphire glass & Tuscan leather strap.">
                            Schweizer Uhrwerk, Saphirglas & Armband aus toskanischem Vollleder.
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-[#d8b45a]/20 pt-4">
                        <span class="text-lg font-bold text-[#ffd45a]">EUR 590</span>
                        <button onclick="quickAddToCart('Maison Chronograph Automatik', 'EUR 590')" type="button" class="inline-flex items-center gap-2 rounded-sm bg-[#d8b45a] px-4 py-2 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#120807] transition hover:bg-[#ffd45a] cursor-pointer shadow-md active:scale-95">
                            <span data-i18n-de="IN WARENKORB" data-i18n-en="ADD TO CART">IN WARENKORB</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 2: Leather Jewelry Trunk Case -->
            <div class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#d8b45a]/30 bg-[#160b09] shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)]">
                <div class="relative h-64 overflow-hidden bg-black/40">
                    <img src="/accessories.png" alt="Leather Jewelry Case" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-widest text-white shadow-md">SCHMUCKSCHATULLE</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10 flex flex-col gap-2 opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                        <button onclick="openWishlistModal()" type="button" class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-black/80 text-[#d8b45a] transition hover:bg-[#78000b] hover:text-white cursor-pointer">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#d8b45a]">LEDER ETUI</p>
                        <h3 class="mt-1.5 font-display text-xl font-medium text-[#fffaf0] group-hover:text-[#d8b45a] transition-colors" data-i18n-de="Bespoke Schmuckschatulle" data-i18n-en="Bespoke Jewelry Trunk Case">
                            Bespoke Schmuckschatulle
                        </h3>
                        <p class="mt-2 text-xs text-[#e4d9cc]/70 leading-relaxed font-light" data-i18n-de="Samtgefütterter Reisekoffer mit Zahlenschloss für Ringe & Ketten." data-i18n-en="Velvet-lined travel case with combination lock for rings & necklaces.">
                            Samtgefütterter Reisekoffer mit Zahlenschloss für Ringe & Ketten.
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-[#d8b45a]/20 pt-4">
                        <span class="text-lg font-bold text-[#ffd45a]">EUR 195</span>
                        <button onclick="quickAddToCart('Bespoke Schmuckschatulle', 'EUR 195')" type="button" class="inline-flex items-center gap-2 rounded-sm bg-[#d8b45a] px-4 py-2 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#120807] transition hover:bg-[#ffd45a] cursor-pointer shadow-md active:scale-95">
                            <span data-i18n-de="IN WARENKORB" data-i18n-en="ADD TO CART">IN WARENKORB</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 3: 24k Gold Monogram Key Ring & Bracelet -->
            <div class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#d8b45a]/30 bg-[#160b09] shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)]">
                <div class="relative h-64 overflow-hidden bg-black/40">
                    <img src="/productKeychain.png" alt="24k Gold Leather Bracelet" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    <div class="absolute top-3 left-3 z-10">
                        <span class="rounded-sm bg-[#78000b] px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-widest text-white shadow-md">ARMBAND</span>
                    </div>
                    <div class="absolute top-3 right-3 z-10 flex flex-col gap-2 opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                        <button onclick="openWishlistModal()" type="button" class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d8b45a]/40 bg-black/80 text-[#d8b45a] transition hover:bg-[#78000b] hover:text-white cursor-pointer">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <p class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#d8b45a]">LUXUS SCHMUCK</p>
                        <h3 class="mt-1.5 font-display text-xl font-medium text-[#fffaf0] group-hover:text-[#d8b45a] transition-colors" data-i18n-de="Geflochtenes Lederarmband 24k Gold" data-i18n-en="Braided Leather Bracelet 24k Gold">
                            Geflochtenes Lederarmband 24k Gold
                        </h3>
                        <p class="mt-2 text-xs text-[#e4d9cc]/70 leading-relaxed font-light" data-i18n-de="Handgeflochtenes Nappaleder mit vergoldetem Magnetverschluss." data-i18n-en="Hand-braided nappa leather with gold-plated magnetic clasp.">
                            Handgeflochtenes Nappaleder mit vergoldetem Magnetverschluss.
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-[#d8b45a]/20 pt-4">
                        <span class="text-lg font-bold text-[#ffd45a]">EUR 89</span>
                        <button onclick="quickAddToCart('Geflochtenes Lederarmband 24k Gold', 'EUR 89')" type="button" class="inline-flex items-center gap-2 rounded-sm bg-[#d8b45a] px-4 py-2 text-[0.62rem] font-bold uppercase tracking-[0.16em] text-[#120807] transition hover:bg-[#ffd45a] cursor-pointer shadow-md active:scale-95">
                            <span data-i18n-de="IN WARENKORB" data-i18n-en="ADD TO CART">IN WARENKORB</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
