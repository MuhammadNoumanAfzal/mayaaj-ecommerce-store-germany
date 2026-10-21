@extends('layouts.app')
@section('title', 'Heritage & Leather History | MEHAAJ® Official Luxury Maison')
@section('meta_description', 'Discover the 50,000-year history of master leathercraft, global tannery provenance, and the founding philosophy of MEHAAJ. Luxury In Your Pocket.')
@section('canonical', url('/about'))

@section('content')
<div class="bg-[#faf7f2] text-[#1c1210] min-h-screen selection:bg-[#78000b] selection:text-white">

    <!-- ========================================================================= -->
    <!-- 1. CINEMATIC EDITORIAL HERO: 50,000 YEARS OF LEATHER HISTORY -->
    <!-- ========================================================================= -->
    <section class="relative overflow-hidden bg-[#0a0505] text-white border-b border-[#d8b45a]/30 pt-10 pb-14 sm:py-16 lg:py-20">
        
        <!-- Full-Bleed Atmospheric Background with Vignette -->
        <div class="absolute inset-0 z-0">
            <img 
                src="/craftsmanship_hero.png" 
                alt="MEHAAJ Atelier Craftsmanship" 
                class="w-full h-full object-cover object-center opacity-30 scale-105 transition-transform duration-1000 ease-out"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-[#0a0505] via-[#0a0505]/85 to-[#0a0505]/70"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_20%_40%,rgba(120,0,11,0.4),transparent_70%)]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0505] via-transparent to-[#0a0505]/60"></div>
        </div>

        <div class="luxury-container relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Column (7 cols): Editorial Typography & Heritage Manifesto -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Eyebrow Pill -->
                    <div class="inline-flex items-center gap-2.5 rounded-full border border-[#d8b45a]/50 bg-black/60 px-4 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a] shadow-[0_0_25px_rgba(216,180,90,0.25)] backdrop-blur-md">
                        <span class="h-2 w-2 rounded-full bg-[#d8b45a] animate-ping"></span>
                        <span data-i18n-en="A 50,000-YEAR HUMAN HERITAGE • MAISON MEHAAJ" data-i18n-de="50.000 JAHRE LEDER-GESCHICHTE • MAISON MEHAAJ">A 50,000-YEAR HUMAN HERITAGE • MAISON MEHAAJ</span>
                    </div>

                    <!-- Main Display Title -->
                    <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-normal leading-[1.06] text-white tracking-tight">
                        <span data-i18n-en="The Eternal Soul of Leather." data-i18n-de="Die ewige Seele des Leders.">The Eternal Soul of Leather.</span><br>
                        <span class="bg-gradient-to-r from-[#d8b45a] via-[#ffd45a] to-[#e8c872] bg-clip-text text-transparent italic font-serif" data-i18n-en="Luxury In Your Pocket." data-i18n-de="Luxus in Ihrer Tasche.">Luxury In Your Pocket.</span>
                    </h1>

                    <!-- Poetic Narrative Translation of Urdu Notes -->
                    <p class="text-xs sm:text-sm lg:text-[0.95rem] leading-relaxed text-[#f2e9dc]/90 font-light max-w-2xl" data-i18n-en="From humanity's earliest mastery of vegetable tanning fifty millennia ago to sovereign royal robes and modern Haute Maroquinerie. Explore how Mehaaj unites timeless ancient lore with uncompromising European precision and master handcraft." data-i18n-de="Von den ersten Meistergerbungen vor 50.000 Jahren über königliche Prunkgewänder bis zur zeitlosen Haute Maroquinerie. Entdecken Sie, wie Mehaaj antike Handwerkskunst mit europäischer Präzision vereint.">
                        From humanity's earliest mastery of vegetable tanning fifty millennia ago to sovereign royal robes and modern Haute Maroquinerie. Explore how Mehaaj unites timeless ancient lore with uncompromising European precision and master handcraft.
                    </p>

                    <!-- Interactive CTAs -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="#leather-chronicle" class="inline-flex items-center gap-2.5 rounded-full bg-[#78000b] px-7 py-3.5 text-xs font-bold uppercase tracking-[0.2em] text-white shadow-[0_10px_30px_rgba(120,0,11,0.5)] hover:bg-[#a00010] hover:shadow-[0_12px_35px_rgba(120,0,11,0.7)] transition duration-300">
                            <span data-i18n-en="Explore The Chronicle" data-i18n-de="Chronik Entdecken">Explore The Chronicle</span>
                            <span>↓</span>
                        </a>
                        <button type="button" onclick="openVipTourModal()" class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/60 bg-black/40 px-6 py-3.5 text-xs font-bold uppercase tracking-[0.2em] text-[#d8b45a] backdrop-blur-md hover:bg-[#d8b45a] hover:text-[#0a0403] transition duration-300 cursor-pointer">
                            <span data-i18n-en="Book Private Consultation" data-i18n-de="Private Beratung Buchen">Book Private Consultation</span>
                        </button>
                    </div>

                </div>

                <!-- Right Column (5 cols): Framed Artisan Showcase with Golden Hallmarks -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        
                        <!-- Glowing Arch Frame -->
                        <div class="relative rounded-2xl overflow-hidden border border-[#d8b45a]/50 bg-black/50 p-2 shadow-[0_25px_60px_rgba(0,0,0,0.8)] backdrop-blur-md group">
                            <div class="relative h-80 sm:h-96 w-full overflow-hidden rounded-xl">
                                <img 
                                    src="/craftsmanship_detail.png" 
                                    alt="Master Leather Artisan Hand-Stitching" 
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                                <!-- Top Floating Seal -->
                                <div class="absolute top-4 left-4 rounded-full border border-white/20 bg-black/70 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-wider text-[#ffd45a] backdrop-blur-md flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#ffd45a] animate-pulse"></span>
                                    <span>LWG GOLD TANNERIES</span>
                                </div>

                                <!-- Bottom Overlay Badge -->
                                <div class="absolute bottom-4 inset-x-4 rounded-xl border border-white/15 bg-black/80 p-3.5 backdrop-blur-lg">
                                    <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#ffd45a] block mb-0.5">MAISON CREED</span>
                                    <p class="font-serif italic text-white/95 text-xs leading-relaxed">
                                        “Days and weeks of human devotion in every stitch, embarking on a long journey to your pocket.”
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Integrated Heritage Metrics Strip along bottom of Hero -->
            <div class="mt-14 pt-8 border-t border-white/15 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="border-l-2 border-[#d8b45a] pl-4">
                    <span class="block font-display text-2xl sm:text-3xl font-bold text-[#ffd45a]">50,000+</span>
                    <span class="text-[0.65rem] uppercase tracking-wider text-white/70 block mt-0.5" data-i18n-en="Years of Human Leather Lore" data-i18n-de="Jahre Menschliche Gerbkunst">Years of Human Leather Lore</span>
                </div>
                <div class="border-l-2 border-[#78000b] pl-4">
                    <span class="block font-display text-2xl sm:text-3xl font-bold text-white">#2 Global</span>
                    <span class="text-[0.65rem] uppercase tracking-wider text-white/70 block mt-0.5" data-i18n-en="World Leather Legacy (after Italy)" data-i18n-de="Weltweites Gerbe-Erbe (nach Italien)">World Leather Legacy (after Italy)</span>
                </div>
                <div class="border-l-2 border-[#d8b45a] pl-4">
                    <span class="block font-display text-2xl sm:text-3xl font-bold text-[#ffd45a]">LWG Gold</span>
                    <span class="text-[0.65rem] uppercase tracking-wider text-white/70 block mt-0.5" data-i18n-en="Certified European Tanneries" data-i18n-de="Zertifizierte Gerbereien">Certified European Tanneries</span>
                </div>
                <div class="border-l-2 border-[#78000b] pl-4">
                    <span class="block font-display text-2xl sm:text-3xl font-bold text-white">Est. 2026</span>
                    <span class="text-[0.65rem] uppercase tracking-wider text-white/70 block mt-0.5" data-i18n-en="Maison Founding Vision" data-i18n-de="Gründungsvision der Maison">Maison Founding Vision</span>
                </div>
            </div>

        </div>

    </section>


    <!-- ========================================================================= -->
    <!-- 2. SPLIT-SCREEN CHRONICLE: LEATHER HISTORY & DYNAMIC PRODUCT SLIDER -->
    <!-- ========================================================================= -->
    <section class="py-14 sm:py-20 lg:py-24 bg-[#faf7f2] relative" id="leather-chronicle">
        <div class="luxury-container">
            
            <!-- Section Header -->
            <div class="mb-12 max-w-3xl">
                <p class="text-[0.68rem] font-bold uppercase tracking-[0.24em] text-[#78000b]" data-i18n-en="HISTORICAL CHRONICLE & ARTISAN PROVENANCE" data-i18n-de="HISTORISCHE CHRONIK & MEISTERLICHE HERKUNFT">HISTORICAL CHRONICLE & ARTISAN PROVENANCE</p>
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-normal text-[#1c1210] mt-1.5" data-i18n-en="How Fifty Millennia of Craft Reside in Your Pocket" data-i18n-de="Wie fünfzig Jahrtausende Handwerk in Ihrer Tasche ruhen">
                    How Fifty Millennia of Craft Reside in Your Pocket
                </h2>
                <div class="h-0.5 w-16 bg-[#d8b45a] mt-3"></div>
            </div>

            <!-- Splitscreen Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                
                <!-- Left Column (7 Cols): The 4 Illustrated Historical Chapters (Translated from Urdu) -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- Chapter 1: 50,000 BC - The First Shield & Royal Luxury -->
                    <div class="rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                        <span class="absolute top-4 right-6 font-display text-5xl font-bold text-[#f2eade] select-none pointer-events-none">01</span>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-display font-bold text-sm">
                                I
                            </span>
                            <div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-en="ORIGINS & ROYAL EMBLEMS" data-i18n-de="URSPRÜNGE & KÖNIGLICHE SYMBOLE">ORIGINS & ROYAL EMBLEMS</span>
                                <h3 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]" data-i18n-en="The 50,000-Year Legacy: From Shield to Crown" data-i18n-de="50.000 Jahre Tradition: Vom Schutzschild zur Krone">
                                    The 50,000-Year Legacy: From Shield to Crown
                                </h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#5c4f46] leading-relaxed font-light mb-4" data-i18n-en="The history of leather spans nearly 50,000 years. Early humans first utilized raw animal hides for essential survival. As master tanning was discovered, the hide was transformed into a supple, remarkably strong, and virtually indestructible material that protected mankind through punishing winters and blistering heat across millennia." data-i18n-de="Die Geschichte des Leders reicht fast 50.000 Jahre zurück. Zunächst nutzten die frühen Menschen rohe Tierfelle zum Schutz. Mit der Entdeckung der Gerbkunst wurde Leder zu einem geschmeidigen, unzerstörbaren Material, das die Menschheit durch eisige Winter und glühende Hitze schützte.">
                            The history of leather spans nearly 50,000 years. Early humans first utilized raw animal hides for essential survival. As master tanning was discovered, the hide was transformed into a supple, remarkably strong, and virtually indestructible material that protected mankind through punishing winters and blistering heat across millennia.
                        </p>

                        <div class="rounded-xl border border-[#f0e7d8] bg-[#faf7f2] p-4 text-xs text-[#1c1210] space-y-2">
                            <div class="flex items-start gap-2.5">
                                <span class="text-[#78000b] font-bold text-sm">👑</span>
                                <p class="leading-relaxed" data-i18n-en="Leather quickly transcended survival to become the ultimate emblem of nobility. Sovereign royal robes, gold-adorned footwear, and ornate travel coffers were master-crafted from it. Today, it remains the paramount international symbol of luxury—commanding haute maroquinerie, fine horological straps, sartorial jackets, and automotive interiors." data-i18n-de="Leder wandelte sich schnell zum Statussymbol des Adels: Königliche Prunkgewänder, mit Blattgold verzierte Reitstiefel und kostbare Reisetruhen wurden daraus gefertigt. Auch heute steht Leder für zeitlosen Luxus in Haute Maroquinerie und Meisteruhren.">
                                    Leather quickly transcended survival to become the ultimate emblem of nobility. Sovereign royal robes, gold-adorned footwear, and ornate travel coffers were master-crafted from it. Today, it remains the paramount international symbol of luxury—commanding haute maroquinerie, fine horological straps, sartorial jackets, and automotive interiors.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter 2: The Terroir of Unrivaled Strength - Bovine & Buffalo Hides -->
                    <div class="rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                        <span class="absolute top-4 right-6 font-display text-5xl font-bold text-[#f2eade] select-none pointer-events-none">02</span>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-display font-bold text-sm">
                                II
                            </span>
                            <div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-en="ANATOMY OF STRENGTH" data-i18n-de="ANATOMIE DER STÄRKE">ANATOMIE DER STÄRKE</span>
                                <h3 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]" data-i18n-en="The World's Most Resilient Hides: Buffalo & Cowhide" data-i18n-de="Die widerstandsfähigsten Leder der Welt: Büffel & Rind">
                                    The World's Most Resilient Hides: Buffalo & Cowhide
                                </h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#5c4f46] leading-relaxed font-light mb-4" data-i18n-en="Among connoisseurs, full-grain water buffalo and bovine cowhide are celebrated as the strongest leather fibers on earth. Their high-density grain structure makes them irreplaceable for heirloom travel bags, diplomatic briefcases, and master footwear that withstand decades of rigorous use without compromising their sculptural poise." data-i18n-de="Unter Kennern gelten Vollnarben-Wasserbüffel und Premium-Rindleder als die stärksten Lederfasern der Welt. Ihre dichte Faserstruktur macht sie unersetzlich für zeitlose Reisetaschen und edle Aktentaschen, die Generationen überdauern.">
                            Among connoisseurs, full-grain water buffalo and bovine cowhide are celebrated as the strongest leather fibers on earth. Their high-density grain structure makes them irreplaceable for heirloom travel bags, diplomatic briefcases, and master footwear that withstand decades of rigorous use without compromising their sculptural poise.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="rounded-lg border border-[#f0e7d8] bg-[#faf7f2] p-3">
                                <span class="font-bold text-[#78000b] block mb-0.5" data-i18n-en="Sheep & Goat Nappa" data-i18n-de="Schaf- & Ziegen-Nappa">Sheep & Goat Nappa</span>
                                <span class="text-[#685c54] text-[0.7rem]" data-i18n-en="Silky, featherlight touch perfected for soft linings, fine pocket cardholders, and bespoke gloves." data-i18n-de="Seidig-weiche Haptik, perfekt für Innenfutter, edle Kartenetuis und zarte Handschuhe.">Silky, featherlight touch perfected for soft linings, fine pocket cardholders, and bespoke gloves.</span>
                            </div>
                            <div class="rounded-lg border border-[#f0e7d8] bg-[#faf7f2] p-3">
                                <span class="font-bold text-[#78000b] block mb-0.5" data-i18n-en="Coastal Rare Exotics" data-i18n-de="Seltene Küstenleder">Coastal Rare Exotics</span>
                                <span class="text-[#685c54] text-[0.7rem]" data-i18n-en="Rare grain textures sourced along coastal maritime artisanal hubs, sought-after for limited bespoke editions." data-i18n-de="Seltene Ledersorten maritimer Küstengebiete, hochgeschätzt für exklusive limitierte Sammlerstücke.">Rare grain textures sourced along coastal maritime artisanal hubs, sought-after for limited bespoke editions.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter 3: Tannery Alchemy - Crazy Horse, Pull-Up & LWG Certification -->
                    <div class="rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                        <span class="absolute top-4 right-6 font-display text-5xl font-bold text-[#f2eade] select-none pointer-events-none">03</span>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-display font-bold text-sm">
                                III
                            </span>
                            <div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-en="TANNERY ALCHEMY & GLOBAL STANDARDS" data-i18n-de="GERBEREIKUNST & GLOBALE STANDARDS">GERBEREIKUNST & GLOBALE STANDARDS</span>
                                <h3 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]" data-i18n-en="Crazy Horse, Pull-Up & LWG European Certified Tanneries" data-i18n-de="Crazy Horse, Pull-Up & LWG-Zertifizierte Gerbereien">
                                    Crazy Horse, Pull-Up & LWG European Certified Tanneries
                                </h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#5c4f46] leading-relaxed font-light mb-4" data-i18n-en="Centuries of tanning refinement in Sialkot and Karachi have earned international prestige, standing second only to Italy in worldwide leather tanning renown. Equipped with gold-rated Leather Working Group (LWG) environmental certifications, these master tanneries produce leathers to exacting European luxury standards for the world's most distinguished fashion houses." data-i18n-de="Jahrhundertealte Gerbtraditionen in Sialkot und Karachi genießen Weltruf und rangieren direkt nach Italien. Ausgestattet mit LWG-Zertifizierungen (Leather Working Group) erfüllen diese Meistergerbereien höchste europäische Umwelt- und Qualitätsstandards.">
                            Centuries of tanning refinement in Sialkot and Karachi have earned international prestige, standing second only to Italy in worldwide leather tanning renown. Equipped with gold-rated Leather Working Group (LWG) environmental certifications, these master tanneries produce leathers to exacting European luxury standards for the world's most distinguished fashion houses.
                        </p>

                        <!-- Leather Finish Highlights -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="border-l-2 border-[#d8b45a] pl-3 py-1">
                                <h4 class="font-bold text-[#1c1210]" data-i18n-en="Crazy Horse Full-Grain:" data-i18n-de="Crazy Horse Vollleder:">Crazy Horse Full-Grain:</h4>
                                <p class="text-[0.72rem] text-[#685c54]" data-i18n-en="Infused with natural organic waxes and oils. It self-heals scratches and evolves an opulent, living vintage patina that grows more mesmerizing with every year." data-i18n-de="Mit natürlichen Wachsen und Ölen veredelt. Kratzer heilen durch Polieren von selbst aus und entwickeln eine atemberaubende Patina.">Infused with natural organic waxes and oils. It self-heals scratches and evolves an opulent, living vintage patina that grows more mesmerizing with every year.</p>
                            </div>
                            <div class="border-l-2 border-[#78000b] pl-3 py-1">
                                <h4 class="font-bold text-[#1c1210]" data-i18n-en="Pull-Up Aniline Leather:" data-i18n-de="Pull-Up Anilinleder:">Pull-Up Aniline Leather:</h4>
                                <p class="text-[0.72rem] text-[#685c54]" data-i18n-en="Features a dramatic two-tone chromatic shift when folded or handled, revealing rich lighter tones underneath its supple exterior." data-i18n-de="Zeigt beim Biegen faszinierende zweifarbige Farbwechsel und offenbart eine samtig-weiche, lebendige Tiefe.">Features a dramatic two-tone chromatic shift when folded or handled, revealing rich lighter tones underneath its supple exterior.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter 4: Maison MEHAAJ 2026 - Human Devotion & Luxury In Your Pocket -->
                    <div class="rounded-2xl border border-[#d8b45a]/50 bg-gradient-to-br from-white via-[#faf7f2] to-[#f4ebe1] p-6 sm:p-8 shadow-md relative overflow-hidden">
                        <span class="absolute top-4 right-6 font-display text-5xl font-bold text-[#ebdcc9] select-none pointer-events-none">04</span>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#d8b45a] text-[#120807] font-display font-bold text-sm">
                                IV
                            </span>
                            <div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-[0.18em] text-[#78000b]" data-i18n-en="THE 2026 FOUNDING CONVICTION" data-i18n-de="DIE GRÜNDUNGSVISION 2026">THE 2026 FOUNDING CONVICTION</span>
                                <h3 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]" data-i18n-en="Maison MEHAAJ: Love, Handcraft & The Long Journey" data-i18n-de="Maison MEHAAJ: Hingabe, Handwerk & Die weite Reise">
                                    Maison MEHAAJ: Love, Handcraft & The Long Journey
                                </h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#5c4f46] leading-relaxed font-light mb-4" data-i18n-en="While MEHAAJ as an official maison is established in 2026, the concept behind it has been refined over decades. We are driven by a steadfast vision: to intertwine 50,000 years of leather history with present-day European sophistication. We design each piece around human emotion, personal aspirations, and the tactile romance of heirloom materials." data-i18n-de="Obwohl MEHAAJ im Jahr 2026 offiziell gegründet wird, reift die Vision dahinter seit Jahrzehnten: 50.000 Jahre Ledergeschichte mit moderner europäischer Raffinesse zu verbinden. Jedes Meisterstück entsteht im Einklang mit menschlichen Emotionen und zeitlosem Wert.">
                            While MEHAAJ as an official maison is established in 2026, the concept behind it has been refined over decades. We are driven by a steadfast vision: to intertwine 50,000 years of leather history with present-day European sophistication. We design each piece around human emotion, personal aspirations, and the tactile romance of heirloom materials.
                        </p>

                        <div class="border-t border-[#e2d8c3] pt-4 mt-4 space-y-3 text-xs text-[#1c1210]">
                            <div class="flex items-start gap-3">
                                <span class="text-[#78000b] text-base">🤲</span>
                                <p class="leading-relaxed" data-i18n-en="Behind our digital window stands the true heartbeat of Mehaaj: master artisans who dedicate days and weeks of meticulous handwork—cutting, saddle-stitching, burnishing, and sculpting each creation with genuine devotion. Each piece then undertakes a long, deliberate journey to reach your destination, crafted to be cherished by you and your loved ones for a lifetime." data-i18n-de="Hinter unserem digitalen Schaufenster schlägt das wahre Herz von Mehaaj: Meisterhandwerker, die Tage und Wochen in reiner Handarbeit verbringen – Schneiden, Sattelnähte, Kantenversiegelung und Polieren mit vollendeter Hingabe. Jedes Stück unternimmt eine weite Reise, um Generationen zu begleiten.">
                                    Behind our digital window stands the true heartbeat of Mehaaj: master artisans who dedicate days and weeks of meticulous handwork—cutting, saddle-stitching, burnishing, and sculpting each creation with genuine devotion. Each piece then undertakes a long, deliberate journey to reach your destination, crafted to be cherished by you and your loved ones for a lifetime.
                                </p>
                            </div>

                            <div class="mt-4 rounded-xl border border-[#d8b45a]/60 bg-white p-4 text-center">
                                <p class="text-[0.62rem] uppercase tracking-[0.2em] text-[#78000b] font-bold" data-i18n-en="OUR GUIDING MAISON SLOGAN" data-i18n-de="UNSER MAISON LEITMOTIV">OUR GUIDING MAISON SLOGAN</p>
                                <p class="font-display text-2xl sm:text-3xl text-[#1c1210] font-normal italic mt-1 text-center" data-i18n-en="“Luxury In Your Pocket.”" data-i18n-de="„Luxus in Ihrer Tasche.“">
                                    “Luxury In Your Pocket.”
                                </p>
                                <p class="text-[0.68rem] text-[#8a7c74] mt-1" data-i18n-en="Crafted with gratitude, devotion, and uncompromising European excellence." data-i18n-de="Gefertigt mit Dankbarkeit, Hingabe und kompromissloser europäischer Exzellenz.">Crafted with gratitude, devotion, and uncompromising European excellence.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column (5 Cols): Interactive Synchronized Leather Showcase Slider -->
                <div class="lg:col-span-5 sticky top-24 space-y-5">
                    
                    <div class="rounded-2xl border border-[#d8b45a]/50 bg-[#120807] p-5 sm:p-6 text-white shadow-2xl relative overflow-hidden">
                        
                        <!-- Header of Showcase -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4 mb-4">
                            <div>
                                <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#ffd45a]" data-i18n-en="LIVE LEATHER GALLERY" data-i18n-de="LIVE-LEDER-GALERIE">LIVE LEATHER GALLERY</span>
                                <h4 class="font-display text-lg font-medium text-white" data-i18n-en="The Masterpiece Showcase" data-i18n-de="Die Meisterstück-Galerie">The Masterpiece Showcase</h4>
                            </div>

                            <!-- Slider Navigation Arrows -->
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="prevAboutSlide()" class="h-8 w-8 rounded-full border border-white/20 bg-white/10 text-white hover:bg-[#d8b45a] hover:text-[#120807] flex items-center justify-center transition cursor-pointer" aria-label="Previous Leather Creation">
                                    ‹
                                </button>
                                <button type="button" onclick="nextAboutSlide()" class="h-8 w-8 rounded-full border border-white/20 bg-white/10 text-white hover:bg-[#d8b45a] hover:text-[#120807] flex items-center justify-center transition cursor-pointer" aria-label="Next Leather Creation">
                                    ›
                                </button>
                            </div>
                        </div>

                        <!-- Dynamic Interactive Slides Container -->
                        <div id="about-slider-container" class="relative min-h-[480px]">
                            
                            <!-- Slide 1: Grand Atelier Weekender (Crazy Horse & Bovine Full-Grain) -->
                            <div class="about-slide transition-all duration-700 ease-out" data-slide-index="0">
                                <div class="relative overflow-hidden rounded-xl border border-white/15 bg-black/40 group mb-4">
                                    <img src="/storage/products/grand-atelier-leather-weekender.jpg" alt="Grand Atelier Leather Weekender" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute top-3 left-3 rounded-full bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-md">
                                        50,000-Yr Travel Heritage
                                    </div>
                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/85 px-3 py-1 text-xs font-bold text-[#ffd45a] border border-[#ffd45a]/40">
                                        EUR 420,00
                                    </div>
                                </div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#ffd45a]">FULL-GRAIN TUSCAN BOVINE</span>
                                <h5 class="font-display text-xl font-medium text-white mt-0.5">Grand Atelier Leather Weekender</h5>
                                <p class="text-xs text-white/75 font-light mt-1.5 leading-relaxed">
                                    Tanned with natural mimosa bark and hand-buffed for heavy travel endurance. Designed to gain rich character with every journey.
                                </p>
                                <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/10">
                                    <span class="text-[0.65rem] text-white/50">LWG Gold Certified Tannery</span>
                                    <a href="/shop/grand-atelier-leather-weekender" class="inline-flex items-center gap-1.5 rounded-full bg-[#d8b45a] px-4 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                        <span data-i18n-en="View Piece" data-i18n-de="Details ansehen">View Piece</span> →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 2: Chancellor Diplomatic Briefcase (Indestructible Water Buffalo) -->
                            <div class="about-slide hidden transition-all duration-700 ease-out" data-slide-index="1">
                                <div class="relative overflow-hidden rounded-xl border border-white/15 bg-black/40 group mb-4">
                                    <img src="/storage/products/chancellor-diplomatic-briefcase.jpg" alt="Chancellor Diplomatic Briefcase" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute top-3 left-3 rounded-full bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-md">
                                        Water Buffalo Hide
                                    </div>
                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/85 px-3 py-1 text-xs font-bold text-[#ffd45a] border border-[#ffd45a]/40">
                                        EUR 480,00
                                    </div>
                                </div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#ffd45a]">SUPREME TENSILE DENSITY</span>
                                <h5 class="font-display text-xl font-medium text-white mt-0.5">Chancellor Diplomatic Briefcase</h5>
                                <p class="text-xs text-white/75 font-light mt-1.5 leading-relaxed">
                                    Water buffalo grain with dual combination locks and solid brass hardware. Built for heads of state and generational heirloom status.
                                </p>
                                <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/10">
                                    <span class="text-[0.65rem] text-white/50">Hand-Stitched Gussets</span>
                                    <a href="/shop/chancellor-diplomatic-briefcase" class="inline-flex items-center gap-1.5 rounded-full bg-[#d8b45a] px-4 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                        <span data-i18n-en="View Piece" data-i18n-de="Details ansehen">View Piece</span> →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 3: Classic Full-Grain Bifold (Crazy Horse & Living Patina) -->
                            <div class="about-slide hidden transition-all duration-700 ease-out" data-slide-index="2">
                                <div class="relative overflow-hidden rounded-xl border border-white/15 bg-black/40 group mb-4">
                                    <img src="/storage/products/wallet-open-detail.jpg" alt="Classic Full-Grain Bifold Wallet" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute top-3 left-3 rounded-full bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-md">
                                        Luxury In Your Pocket
                                    </div>
                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/85 px-3 py-1 text-xs font-bold text-[#ffd45a] border border-[#ffd45a]/40">
                                        EUR 89,00
                                    </div>
                                </div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#ffd45a]">CRAZY HORSE & WAX INFUSION</span>
                                <h5 class="font-display text-xl font-medium text-white mt-0.5">Classic Full-Grain Bifold</h5>
                                <p class="text-xs text-white/75 font-light mt-1.5 leading-relaxed">
                                    Hot-stuffed with carnauba waxes and oils. Fits seamlessly into your breast pocket, deepening to a rich amber luster over time.
                                </p>
                                <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/10">
                                    <span class="text-[0.65rem] text-white/50">RFID Shielded Interior</span>
                                    <a href="/shop/classic-full-grain-bifold-wallet" class="inline-flex items-center gap-1.5 rounded-full bg-[#d8b45a] px-4 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                        <span data-i18n-en="View Piece" data-i18n-de="Details ansehen">View Piece</span> →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 4: Aurelia Structured City Tote (Architectural Calfskin) -->
                            <div class="about-slide hidden transition-all duration-700 ease-out" data-slide-index="3">
                                <div class="relative overflow-hidden rounded-xl border border-white/15 bg-black/40 group mb-4">
                                    <img src="/storage/products/tote-interior-detail.jpg" alt="Aurelia Structured City Tote" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute top-3 left-3 rounded-full bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-md">
                                        Supple Calf Nappa
                                    </div>
                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/85 px-3 py-1 text-xs font-bold text-[#ffd45a] border border-[#ffd45a]/40">
                                        EUR 345,00
                                    </div>
                                </div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#ffd45a]">ARCHITECTURAL SILHOUETTE</span>
                                <h5 class="font-display text-xl font-medium text-white mt-0.5">Aurelia Structured City Tote</h5>
                                <p class="text-xs text-white/75 font-light mt-1.5 leading-relaxed">
                                    Fine-grain calfskin paired with suede interior compartments and hand-beveled edges sealed with 4 coats of lacquer.
                                </p>
                                <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/10">
                                    <span class="text-[0.65rem] text-white/50">24k Gold-Dipped Accents</span>
                                    <a href="/shop/aurelia-structured-city-tote" class="inline-flex items-center gap-1.5 rounded-full bg-[#d8b45a] px-4 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                        <span data-i18n-en="View Piece" data-i18n-de="Details ansehen">View Piece</span> →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 5: Grand Royal Tourbillon (Precision Horlogerie & Hand-Stitched Strap) -->
                            <div class="about-slide hidden transition-all duration-700 ease-out" data-slide-index="4">
                                <div class="relative overflow-hidden rounded-xl border border-white/15 bg-black/40 group mb-4">
                                    <img src="/storage/products/watch-wrist-detail.jpg" alt="Grand Royal Tourbillon Automatic" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute top-3 left-3 rounded-full bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-md">
                                        Haute Horlogerie
                                    </div>
                                    <div class="absolute bottom-3 right-3 rounded-full bg-black/85 px-3 py-1 text-xs font-bold text-[#ffd45a] border border-[#ffd45a]/40">
                                        EUR 690,00
                                    </div>
                                </div>
                                <span class="text-[0.62rem] font-bold uppercase tracking-widest text-[#ffd45a]">ALLIGATOR-GRAIN CALFSKIN</span>
                                <h5 class="font-display text-xl font-medium text-white mt-0.5">Grand Royal Tourbillon Automatic</h5>
                                <p class="text-xs text-white/75 font-light mt-1.5 leading-relaxed">
                                    Open-heart mechanical movement framed in sapphire glass, matched with an artisan hand-stitched leather wristband.
                                </p>
                                <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/10">
                                    <span class="text-[0.65rem] text-white/50">Swiss Movement Architecture</span>
                                    <a href="/shop/grand-royal-tourbillon-automatic" class="inline-flex items-center gap-1.5 rounded-full bg-[#d8b45a] px-4 py-1.5 text-[0.68rem] font-bold uppercase tracking-wider text-[#120807] hover:bg-[#ffd45a] transition">
                                        <span data-i18n-en="View Piece" data-i18n-de="Details ansehen">View Piece</span> →
                                    </a>
                                </div>
                            </div>

                        </div>

                        <!-- Slide Indicators / Pagination Dots -->
                        <div class="flex items-center justify-center gap-2 pt-4 border-t border-white/10">
                            <button type="button" onclick="setAboutSlide(0)" class="about-dot h-1.5 w-7 rounded-full bg-[#d8b45a] transition-all cursor-pointer" aria-label="Slide 1"></button>
                            <button type="button" onclick="setAboutSlide(1)" class="about-dot h-1.5 w-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all cursor-pointer" aria-label="Slide 2"></button>
                            <button type="button" onclick="setAboutSlide(2)" class="about-dot h-1.5 w-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all cursor-pointer" aria-label="Slide 3"></button>
                            <button type="button" onclick="setAboutSlide(3)" class="about-dot h-1.5 w-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all cursor-pointer" aria-label="Slide 4"></button>
                            <button type="button" onclick="setAboutSlide(4)" class="about-dot h-1.5 w-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all cursor-pointer" aria-label="Slide 5"></button>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================================= -->
    <!-- 3. THE SIX PILLARS OF LEATHER (VISUAL TACTILE GALLERY WITH PHOTOGRAPHY) -->
    <!-- ========================================================================= -->
    <section class="py-16 sm:py-24 bg-[#0a0505] text-white relative border-y border-[#d8b45a]/30 overflow-hidden">
        
        <!-- Ambient Radial Glow -->
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_30%,rgba(120,0,11,0.35),transparent_75%)]"></div>

        <div class="luxury-container relative z-10">
            
            <div class="max-w-3xl mx-auto text-center space-y-3 mb-14">
                <span class="text-[0.65rem] font-bold uppercase tracking-[0.26em] text-[#ffd45a]" data-i18n-en="CURATED LEATHER TAXONOMY" data-i18n-de="KURATIERTE LEDER-TAXONOMIE">CURATED LEATHER TAXONOMY</span>
                <h2 class="font-display text-3xl sm:text-5xl font-normal text-white" data-i18n-en="The Six Pillars of Maison Leathercraft" data-i18n-de="Die sechs Säulen der Maison Lederkunst">
                    The Six Pillars of Maison Leathercraft
                </h2>
                <div class="h-0.5 w-16 bg-[#d8b45a] mx-auto mt-2"></div>
                <p class="text-xs sm:text-sm text-white/70 max-w-xl mx-auto font-light leading-relaxed pt-2" data-i18n-en="As documented in our master heritage notes: explore each hide's distinct grain density, tactile temper, and timeless aging characteristics." data-i18n-de="Wie in unseren Meister-Notizen dokumentiert: Entdecken Sie die Faserstruktur, Haptik und Patina-Entwicklung jedes exklusiven Leders.">
                    As documented in our master heritage notes: explore each hide's distinct grain density, tactile temper, and timeless aging characteristics.
                </p>
            </div>

            <!-- 6 Visual Illustrated Leather Cards with Actual Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- Card 1: Cowhide Leather -->
                <div class="group relative rounded-2xl overflow-hidden border border-white/15 bg-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/grand-atelier-leather-weekender.jpg" alt="Cowhide Leather" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-white/20 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            01 • BOVINE
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#78000b] px-2.5 py-0.5 text-[0.58rem] font-bold text-white uppercase tracking-wider">
                            Full-Grain
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Cowhide Leather</h3>
                        <p class="text-xs text-white/70 leading-relaxed font-light">
                            Light, supple, and exceptionally tear-resistant. Conditioned with organic beeswax and oils, it ripens gracefully into an amber, lustrous glow.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Tempering: <strong class="text-white">Medium Firm</strong></span>
                            <span class="text-[#ffd45a] font-bold">10/10 Longevity</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Pull-Up Leather -->
                <div class="group relative rounded-2xl overflow-hidden border border-white/15 bg-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/atelier-leather-zip-portfolio.jpg" alt="Pull-Up Leather" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-white/20 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            02 • ANILINE
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#78000b] px-2.5 py-0.5 text-[0.58rem] font-bold text-white uppercase tracking-wider">
                            Two-Tone
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Pull-Up Leather</h3>
                        <p class="text-xs text-white/70 leading-relaxed font-light">
                            Saturated with liquid oils and translucent dyes. When folded or handled, migrating oils reveal lighter tones underneath, creating a living chromatic burst.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Effect: <strong class="text-white">Color Migration</strong></span>
                            <span class="text-[#ffd45a] font-bold">Silky Waxy Grip</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Crazy Horse Leather -->
                <div class="group relative rounded-2xl overflow-hidden border border-[#d8b45a]/60 bg-gradient-to-b from-[#78000b]/30 to-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1 ring-1 ring-[#d8b45a]/25">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/wallet-open-detail.jpg" alt="Crazy Horse Leather" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-[#ffd45a]/40 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            03 • SIGNATURE
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#ffd45a] px-2.5 py-0.5 text-[0.58rem] font-bold text-[#120807] uppercase tracking-wider">
                            Living Patina
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Crazy Horse Leather</h3>
                        <p class="text-xs text-white/75 leading-relaxed font-light">
                            Top full-grain hide treated with hot carnauba wax. Scratches rub out naturally under palm warmth, maturing into a storied vintage aesthetic.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Feature: <strong class="text-[#ffd45a]">Self-Healing</strong></span>
                            <span class="text-[#ffd45a] font-bold">Lifetime Patina</span>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Water Buffalo Leather -->
                <div class="group relative rounded-2xl overflow-hidden border border-white/15 bg-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/briefcase-detail.jpg" alt="Buffalo Leather" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-white/20 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            04 • INDESTRUCTIBLE
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#78000b] px-2.5 py-0.5 text-[0.58rem] font-bold text-white uppercase tracking-wider">
                            High Density
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Buffalo Leather</h3>
                        <p class="text-xs text-white/70 leading-relaxed font-light">
                            World-renowned as the toughest hide in existence. Prominent dermal grain resists puncture and heavy friction for generational briefcase and luggage integrity.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Density: <strong class="text-white">3x Standard Hide</strong></span>
                            <span class="text-[#ffd45a] font-bold">Armor Strength</span>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Sheep & Lamb Nappa -->
                <div class="group relative rounded-2xl overflow-hidden border border-white/15 bg-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/tote-interior-detail.jpg" alt="Sheep & Lamb Nappa" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-white/20 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            05 • SOFT TOUCH
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#78000b] px-2.5 py-0.5 text-[0.58rem] font-bold text-white uppercase tracking-wider">
                            Silky Nappa
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Sheep & Lamb Nappa</h3>
                        <p class="text-xs text-white/70 leading-relaxed font-light">
                            Velvety, pliable, and cashmere-soft. Ideal for delicate pocket wallet linings, cardholder gussets, and tactile accessories that feel sublime against the skin.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Weight: <strong class="text-white">Featherlight</strong></span>
                            <span class="text-[#ffd45a] font-bold">Cashmere Soft</span>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Hair-On & Coastal Exotic -->
                <div class="group relative rounded-2xl overflow-hidden border border-white/15 bg-[#140b0b] shadow-xl hover:border-[#ffd45a] transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="/storage/products/watch-wrist-detail.jpg" alt="Hair-On & Coastal Exotic" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#140b0b] via-[#140b0b]/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 rounded-full bg-black/75 border border-white/20 px-3 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase tracking-wider backdrop-blur-sm">
                            06 • EXOTIC
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-[#d8b45a] px-2.5 py-0.5 text-[0.58rem] font-bold text-[#120807] uppercase tracking-wider">
                            Bespoke
                        </span>
                    </div>
                    <div class="p-6 pt-2 space-y-3">
                        <h3 class="font-display text-2xl font-medium text-white group-hover:text-[#ffd45a] transition">Coastal & Exotic Grain</h3>
                        <p class="text-xs text-white/70 leading-relaxed font-light">
                            Curated strictly in limited allocations along maritime artisan trading posts. Crafted for bespoke horological straps and private commissions.
                        </p>
                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[0.68rem] text-white/60">
                            <span>Availability: <strong class="text-white">Strict Allocation</strong></span>
                            <span class="text-[#ffd45a] font-bold">Collector Rank</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ========================================================================= -->
    <!-- 4. BOTTOM INTERACTIVE CATALOG MARQUEE CAROUSEL -->
    <!-- ========================================================================= -->
    <section class="py-14 sm:py-20 bg-[#faf7f2] overflow-hidden border-b border-[#e2d8c3]">
        <div class="luxury-container mb-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <span class="text-[0.65rem] font-bold uppercase tracking-[0.22em] text-[#78000b]" data-i18n-en="CURATED CATALOG SHOWCASE" data-i18n-de="MEISTERWERK-KATALOG">CURATED CATALOG SHOWCASE</span>
                    <h3 class="font-display text-2xl sm:text-4xl font-normal text-[#1c1210] mt-1" data-i18n-en="Discover Creations Born From This Heritage" data-i18n-de="Entdecken Sie Kreationen dieses Erbes">
                        Discover Creations Born From This Heritage
                    </h3>
                </div>
                
                <!-- Carousel Controls & Link -->
                <div class="flex items-center gap-3">
                    <button type="button" onclick="scrollMarquee(-300)" class="h-9 w-9 rounded-full border border-[#d8b45a]/50 bg-white text-[#1c1210] hover:bg-[#78000b] hover:text-white hover:border-[#78000b] flex items-center justify-center transition shadow-xs cursor-pointer" aria-label="Scroll left">
                        ←
                    </button>
                    <button type="button" onclick="scrollMarquee(300)" class="h-9 w-9 rounded-full border border-[#d8b45a]/50 bg-white text-[#1c1210] hover:bg-[#78000b] hover:text-white hover:border-[#78000b] flex items-center justify-center transition shadow-xs cursor-pointer" aria-label="Scroll right">
                        →
                    </button>
                    <a href="{{ route('shop') }}" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#78000b] hover:underline ml-2">
                        <span data-i18n-en="All 54 Pieces" data-i18n-de="Alle 54 Stücke">All 54 Pieces</span> →
                    </a>
                </div>
            </div>
        </div>

        <!-- Horizontal Smooth Scrollable Showcase Strip -->
        <div id="marquee-scroll-container" class="flex gap-6 overflow-x-auto px-4 sm:px-8 lg:px-12 pb-6 scrollbar-none scroll-smooth" style="scrollbar-width: none;">
            
            <!-- Item 1: Seine Saddle Bag -->
            <a href="/shop/seine-saddle-leather-bag" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/seine-saddle-leather-bag.png" alt="Seine Saddle Leather Bag" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Bovine Full-Grain</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">Artisan Saddle Leather</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Seine Saddle Leather Bag</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 310,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

            <!-- Item 2: Palais Monogram Weekender -->
            <a href="/shop/palais-monogram-weekender-tote" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/palais-monogram-weekender-tote.png" alt="Palais Monogram Weekender Tote" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Pull-Up Leather</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">Travel & Luggage</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Palais Monogram Weekender</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 390,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

            <!-- Item 3: Classic Full-Grain Bifold -->
            <a href="/shop/classic-full-grain-bifold-wallet" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/classic-full-grain-bifold-wallet.png" alt="Classic Full-Grain Bifold Wallet" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Crazy Horse Finish</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">Pocket Luxury</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Classic Full-Grain Bifold</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 89,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

            <!-- Item 4: Verona Soft Pebbled Tote -->
            <a href="/shop/verona-soft-pebbled-tote" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/verona-soft-pebbled-tote.png" alt="Verona Soft Pebbled Tote" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Pebbled Nappa</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">City Tote</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Verona Soft Pebbled Tote</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 330,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

            <!-- Item 5: Atelier Leather Zip Portfolio -->
            <a href="/shop/atelier-leather-zip-portfolio" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/atelier-leather-zip-portfolio.jpg" alt="Atelier Leather Zip Portfolio" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Buffalo Grain</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">Executive Portfolio</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Atelier Zip Portfolio</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 260,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

            <!-- Item 6: Monaco Passport Set -->
            <a href="/shop/monaco-passport-luggage-tag-set" class="shrink-0 w-72 rounded-2xl border border-[#e6decb] bg-white p-4 shadow-sm hover:shadow-xl hover:border-[#78000b]/50 transition-all duration-300 group">
                <div class="h-56 w-full rounded-xl overflow-hidden bg-[#faf7f2] mb-3 relative">
                    <img src="/storage/products/monaco-passport-luggage-tag-set.jpg" alt="Monaco Passport Luggage Tag Set" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-108">
                    <span class="absolute top-2.5 left-2.5 rounded-full bg-black/75 px-2.5 py-0.5 text-[0.6rem] font-bold text-[#ffd45a] uppercase">Calfskin Duo</span>
                </div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b]">Travel Accessories</span>
                <h4 class="font-display text-base font-medium text-[#1c1210] truncate group-hover:text-[#78000b] transition">Monaco Passport Set</h4>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#f0e7d8]">
                    <span class="font-bold text-sm text-[#1c1210]">EUR 145,00</span>
                    <span class="text-xs font-bold text-[#78000b] group-hover:translate-x-1 transition-transform">View →</span>
                </div>
            </a>

        </div>
    </section>


    <!-- ========================================================================= -->
    <!-- 5. THE MAISON INVITATION & VIP TOUR MODAL CTA -->
    <!-- ========================================================================= -->
    <section class="py-20 sm:py-28 bg-[#0a0505] text-white text-center relative overflow-hidden">
        
        <!-- Background Imagery with Radial Vignette -->
        <div class="absolute inset-0 z-0">
            <img src="/craftsmanship_detail.png" alt="Leather Details" class="w-full h-full object-cover opacity-20 filter blur-xs">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_70%_at_50%_50%,rgba(120,0,11,0.55),rgba(10,5,5,0.95))]"></div>
        </div>

        <div class="luxury-container relative z-10 max-w-3xl mx-auto space-y-6">
            
            <div class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/50 bg-black/60 px-4 py-1 text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a] backdrop-blur-md">
                <span>✦</span>
                <span data-i18n-en="A LIFETIME PROMISE • EST. 2026" data-i18n-de="EIN LEBENSLANGES VERSPRECHEN • EST. 2026">A LIFETIME PROMISE • EST. 2026</span>
                <span>✦</span>
            </div>

            <h2 class="font-display text-4xl sm:text-6xl lg:text-7xl font-normal text-white leading-tight" data-i18n-en="Carry 50,000 Years of Mastery." data-i18n-de="Tragen Sie 50.000 Jahre Meisterkunst.">
                Carry 50,000 Years of Mastery.
            </h2>
            
            <p class="text-xs sm:text-sm lg:text-base text-[#e4d9cc]/90 max-w-xl mx-auto leading-relaxed font-light" data-i18n-en="Experience the weight, the tactile resonance, and the aroma of certified full-grain European leather. Handcrafted for you and those you love." data-i18n-de="Erleben Sie das Gewicht, die Haptik und das Aroma von zertifiziertem europäischem Vollleder. Handgefertigt für Sie und Ihre Lieben.">
                Experience the weight, the tactile resonance, and the aroma of certified full-grain European leather. Handcrafted for you and those you love.
            </p>

            <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 rounded-full bg-[#78000b] px-8 py-4 text-xs font-bold uppercase tracking-[0.22em] text-white shadow-[0_12px_35px_rgba(120,0,11,0.6)] hover:bg-[#a00010] hover:shadow-[0_15px_45px_rgba(120,0,11,0.8)] transition duration-300">
                    <span data-i18n-en="Explore The Boutique" data-i18n-de="Boutique Entdecken">Explore The Boutique</span> →
                </a>
                <button type="button" onclick="openVipTourModal()" class="inline-flex items-center gap-2 rounded-full border border-[#d8b45a]/60 bg-black/50 px-7 py-4 text-xs font-bold uppercase tracking-[0.22em] text-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#0a0403] transition duration-300 cursor-pointer backdrop-blur-md">
                    <span data-i18n-en="Book Private Consultation" data-i18n-de="Private Beratung Buchen">Book Private Consultation</span>
                </button>
            </div>
            
        </div>
    </section>

</div>

<!-- ========================================================================= -->
<!-- SLIDER JAVASCRIPT & VIP TOUR MODAL CONTROLLER -->
<!-- ========================================================================= -->
<script>
    // Masterpiece Slider Engine (Auto-rotate + manual controls)
    let currentAboutSlide = 0;
    const totalAboutSlides = 5;
    let aboutSlideInterval = null;

    function setAboutSlide(index) {
        currentAboutSlide = (index + totalAboutSlides) % totalAboutSlides;
        const slides = document.querySelectorAll('.about-slide');
        const dots = document.querySelectorAll('.about-dot');

        slides.forEach((slide, idx) => {
            if (idx === currentAboutSlide) {
                slide.classList.remove('hidden');
                slide.classList.add('block');
                setTimeout(() => {
                    slide.style.opacity = '1';
                }, 20);
            } else {
                slide.style.opacity = '0';
                slide.classList.add('hidden');
                slide.classList.remove('block');
            }
        });

        dots.forEach((dot, idx) => {
            if (idx === currentAboutSlide) {
                dot.className = 'about-dot h-1.5 w-7 rounded-full bg-[#d8b45a] transition-all cursor-pointer shadow-[0_0_8px_rgba(216,180,90,0.6)]';
            } else {
                dot.className = 'about-dot h-1.5 w-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all cursor-pointer';
            }
        });
    }

    function nextAboutSlide() {
        setAboutSlide(currentAboutSlide + 1);
        resetAboutSlideInterval();
    }

    function prevAboutSlide() {
        setAboutSlide(currentAboutSlide - 1);
        resetAboutSlideInterval();
    }

    function resetAboutSlideInterval() {
        clearInterval(aboutSlideInterval);
        aboutSlideInterval = setInterval(() => {
            setAboutSlide(currentAboutSlide + 1);
        }, 5500);
    }

    function scrollMarquee(amount) {
        const container = document.getElementById('marquee-scroll-container');
        if (container) {
            container.scrollBy({ left: amount, behavior: 'smooth' });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        setAboutSlide(0);
        resetAboutSlideInterval();

        const sliderCard = document.querySelector('#about-slider-container')?.parentElement;
        if (sliderCard) {
            sliderCard.addEventListener('mouseenter', () => clearInterval(aboutSlideInterval));
            sliderCard.addEventListener('mouseleave', () => resetAboutSlideInterval());
        }
    });

    // VIP Atelier Tour Modal Function
    function openVipTourModal() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const swalInstance = window.LuxurySwal || (typeof Swal !== 'undefined' ? Swal : null);
        
        if (!swalInstance) {
            alert(isEn ? 'Please contact our concierge at concierge@mehaaj.com' : 'Bitte kontaktieren Sie unseren Concierge unter concierge@mehaaj.com');
            return;
        }

        swalInstance.fire({
            title: isEn ? 'Private Salon Consultation 👑' : 'Private Salon-Konsultation 👑',
            html: `
                <div class="text-left space-y-3 mt-3 text-xs">
                    <p class="text-neutral-600">${isEn ? 'Reserve your private appointment with our master leather consultant:' : 'Buchen Sie Ihren exklusiven Beratungstermin mit unserem Leder-Experten:'}</p>
                    <input id="tour-name" class="w-full h-10 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" placeholder="${isEn ? 'Your Full Name' : 'Ihr vollständiger Name'}" type="text">
                    <input id="tour-email" class="w-full h-10 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" placeholder="${isEn ? 'Your Email Address' : 'Ihre E-Mail-Adresse'}" type="email">
                    <input id="tour-date" class="w-full h-10 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" type="date">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: isEn ? 'Request Invitation' : 'Einladung anfragen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            preConfirm: () => {
                const name = document.getElementById('tour-name').value;
                const email = document.getElementById('tour-email').value;
                if (!name || !email) {
                    Swal.showValidationMessage(isEn ? 'Please fill in Name and Email' : 'Bitte Name und E-Mail ausfüllen');
                }
                return { name: name, email: email };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                swalInstance.fire({
                    icon: 'success',
                    title: isEn ? 'Consultation Request Received! 🍾' : 'Anfrage Erhalten! 🍾',
                    text: isEn 
                        ? 'Thank you, ' + result.value.name + '. Our VIP Concierge will confirm your private salon date within 12 hours.'
                        : 'Vielen Dank, ' + result.value.name + '. Unser Concierge-Team wird Ihren Termin binnen 12 Stunden bestätigen.',
                    confirmButtonText: isEn ? 'Understood' : 'Verstanden'
                });
            }
        });
    }
</script>
@endsection
