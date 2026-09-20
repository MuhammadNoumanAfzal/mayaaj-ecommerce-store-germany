@extends('layouts.app')
@section('title', 'Brand Heritage & Atelier Handwerkskunst - MEHAAJ Germany')

@section('content')
<div class="pt-20 bg-[#faf7f2] text-[#1c1210] min-h-screen overflow-hidden">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <span class="text-[#1c1210] font-medium" data-i18n-de="Manufaktur & Erbe" data-i18n-en="Atelier & Heritage">Manufaktur & Erbe</span>
        </div>
    </nav>

    <!-- Animated Hero Section: The Soul of MEHAAJ -->
    <section class="relative overflow-hidden bg-[#0a0403] py-24 lg:py-32 text-white border-b border-[#d8b45a]/30">
        <!-- Floating Animated Ambient Orbs -->
        <div class="pointer-events-none absolute -top-40 -left-40 h-96 w-96 rounded-full bg-[#78000b]/30 blur-[120px] animate-float-slow"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-40 h-96 w-96 rounded-full bg-[#d8b45a]/20 blur-[130px] animate-float-delayed"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_60%_at_50%_40%,rgba(120,0,11,0.25),transparent_70%)]"></div>

        <div class="luxury-container relative z-10">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
                
                <!-- Hero Text Block with Stagger Animation -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2.5 rounded-full border border-[#d8b45a]/40 bg-black/60 px-4 py-2 text-[0.68rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a] shadow-[0_0_20px_rgba(216,180,90,0.2)] backdrop-blur-md">
                        <span class="h-2 w-2 rounded-full bg-[#d8b45a] animate-ping"></span>
                        <span data-i18n-de="DEUTSCHE LEDER MANUFAKTUR SEIT 1998" data-i18n-en="GERMAN LEATHER ATELIER SINCE 1998">DEUTSCHE LEDER MANUFAKTUR SEIT 1998</span>
                    </div>

                    <h1 class="font-display text-4xl font-medium leading-[1.12] text-[#fffaf0] sm:text-5xl lg:text-6xl tracking-tight" data-i18n-de="Wo deutsche Präzision auf zeitlose Meisterkunst trifft" data-i18n-en="Where German Precision Meets Timeless Mastercraft">
                        Wo deutsche Präzision auf zeitlose <span class="bg-gradient-to-r from-[#d8b45a] via-[#ffd45a] to-[#d8b45a] bg-clip-text text-transparent underline decoration-[#78000b]/60 decoration-wavy">Meisterkunst</span> trifft
                    </h1>

                    <p class="text-xs leading-relaxed text-[#e4d9cc]/85 sm:text-sm lg:text-base max-w-2xl font-light" data-i18n-de="MEHAAJ verkörpert die Symbiose aus traditionellem deutschen Sattlerhandwerk, nachhaltiger toskanischer Pflanzengerbung und modernem architektonischen Design. Jedes Stück ist ein Unikat fürs Leben." data-i18n-en="MEHAAJ embodies the symbiosis of traditional German saddlery craftsmanship, sustainable Tuscan vegetable tanning, and modern architectural design. Every piece is a lifetime original.">
                        MEHAAJ verkörpert die Symbiose aus traditionellem deutschen Sattlerhandwerk, nachhaltiger toskanischer Pflanzengerbung und modernem architektonischen Design. Jedes Stück ist ein Unikat fürs Leben.
                    </p>

                    <!-- Interactive CTAs -->
                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <button onclick="openVipTourModal()" type="button" class="animate-shine-sweep group inline-flex items-center gap-3 rounded-sm bg-[#78000b] px-8 py-4 text-xs font-bold uppercase tracking-[0.2em] text-white shadow-xl transition-all duration-300 hover:bg-[#5a0309] hover:shadow-[0_10px_35px_rgba(120,0,11,0.6)] cursor-pointer">
                            <span data-i18n-de="ATELIER-FÜHRUNG BUCHEN" data-i18n-en="BOOK ATELIER TOUR">ATELIER-FÜHRUNG BUCHEN</span>
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </button>

                        <a href="/shop" class="inline-flex items-center gap-2 rounded-sm border border-[#d8b45a]/50 bg-black/40 px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] text-[#d8b45a] backdrop-blur-md transition-all duration-300 hover:bg-[#d8b45a] hover:text-[#0a0403] hover:shadow-[0_0_25px_rgba(216,180,90,0.4)]">
                            <span data-i18n-de="KOLLEKTION ENTDECKEN" data-i18n-en="EXPLORE COLLECTION">KOLLEKTION ENTDECKEN</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Interactive Image Frame with Glowing Border & Floating Badge -->
                <div class="lg:col-span-5 relative">
                    <div class="animated-border-gradient p-1 rounded-lg shadow-2xl animate-pulse-glow">
                        <div class="relative overflow-hidden rounded-md bg-[#0a0403] group">
                            <img src="/craftsmanship_hero.png" alt="MEHAAJ Craftsmanship Atelier" class="w-full h-[460px] object-cover transition-transform duration-1000 ease-out group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                            
                            <!-- Floating Badge 1: Atelier Location -->
                            <div class="absolute top-5 right-5 rounded-md border border-[#d8b45a]/40 bg-black/70 px-4 py-2 text-right backdrop-blur-md animate-float-slow">
                                <p class="text-[0.58rem] font-bold uppercase tracking-widest text-[#d8b45a]">MANUFAKTUR</p>
                                <p class="text-xs font-bold text-white">Düsseldorf, Germany</p>
                            </div>

                            <!-- Floating Glass Quote Box -->
                            <div class="absolute bottom-6 left-6 right-6 rounded-md border border-white/20 bg-black/75 p-5 shadow-2xl backdrop-blur-xl">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-bold text-sm shadow-md">
                                        ★
                                    </div>
                                    <div>
                                        <p class="text-[0.62rem] font-bold uppercase tracking-widest text-[#d8b45a]">PRÄZISIONS-HANDWERK</p>
                                        <p class="text-xs text-white/95 font-serif italic mt-0.5">"Über 40 Stunden reine Handarbeit in jedem Maison Meisterstück."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Animated Live Statistics Counter Banner -->
    <section class="border-b border-[#e6decb] bg-white py-12 shadow-xs">
        <div class="luxury-container">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 text-center">
                
                <div class="space-y-1.5 p-4 rounded-md transition duration-300 hover:bg-[#faf7f2]">
                    <p class="font-display text-4xl sm:text-5xl font-bold bg-gradient-to-r from-[#78000b] to-[#5a0309] bg-clip-text text-transparent">100%</p>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-[#1c1210]" data-i18n-de="Italienisches Vollleder" data-i18n-en="Italian Full Grain">Italienisches Vollleder</p>
                    <p class="text-[0.62rem] text-[#8c7c72]" data-i18n-de="Toskanische Pflanzengerbung" data-i18n-en="Tuscan Vegetable Tanned">Toskanische Pflanzengerbung</p>
                </div>

                <div class="space-y-1.5 p-4 rounded-md transition duration-300 hover:bg-[#faf7f2]">
                    <p class="font-display text-4xl sm:text-5xl font-bold bg-gradient-to-r from-[#78000b] to-[#5a0309] bg-clip-text text-transparent">18+</p>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-[#1c1210]" data-i18n-de="Jahre Meister-Erfahrung" data-i18n-en="Years Master Experience">Jahre Meister-Erfahrung</p>
                    <p class="text-[0.62rem] text-[#8c7c72]" data-i18n-de="Feinsattler aus Deutschland" data-i18n-en="Master Saddlers Germany">Feinsattler aus Deutschland</p>
                </div>

                <div class="space-y-1.5 p-4 rounded-md transition duration-300 hover:bg-[#faf7f2]">
                    <p class="font-display text-4xl sm:text-5xl font-bold bg-gradient-to-r from-[#78000b] to-[#5a0309] bg-clip-text text-transparent">0%</p>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-[#1c1210]" data-i18n-de="Plastik & Chemikalien" data-i18n-en="Plastic & Chemicals">Plastik & Chemikalien</p>
                    <p class="text-[0.62rem] text-[#8c7c72]" data-i18n-de="100% Biologisch Abbaubar" data-i18n-en="100% Biodegradable">100% Biologisch Abbaubar</p>
                </div>

                <div class="space-y-1.5 p-4 rounded-md transition duration-300 hover:bg-[#faf7f2]">
                    <p class="font-display text-4xl sm:text-5xl font-bold bg-gradient-to-r from-[#78000b] to-[#5a0309] bg-clip-text text-transparent">25 JAHRE</p>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-[#1c1210]" data-i18n-de="Naht-Garantie" data-i18n-en="Stitch Guarantee">Naht-Garantie</p>
                    <p class="text-[0.62rem] text-[#8c7c72]" data-i18n-de="Unverwüstliche Sattlernaht" data-i18n-en="Indestructible Saddle Stitch">Unverwüstliche Sattlernaht</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 5 Pillars of Master Craftsmanship (Interactive Grid) -->
    <section class="py-20 lg:py-28 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="inline-block rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-4 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#78000b]">
                    UNSER QUALITÄTSVERSPRECHEN
                </span>
                <h2 class="font-display text-3xl font-medium text-[#1c1210] sm:text-4xl lg:text-5xl" data-i18n-de="Die 5 Säulen der MEHAAJ Perfektion" data-i18n-en="The 5 Pillars of MEHAAJ Perfection">
                    Die 5 Säulen der MEHAAJ Perfektion
                </h2>
                <div class="h-1 w-20 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b] mx-auto rounded-full"></div>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                
                <!-- Pillar 1 -->
                <div class="animate-shine-sweep group relative rounded-md border border-[#e6decb] bg-white p-8 shadow-xs transition-all duration-500 hover:-translate-y-2.5 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#78000b]/10 text-[#78000b] mb-6 transition-all duration-500 group-hover:scale-110 group-hover:bg-[#78000b] group-hover:text-white group-hover:shadow-lg">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">SÄULE 01</span>
                    <h3 class="font-display text-2xl font-medium text-[#1c1210] mt-1 group-hover:text-[#78000b] transition-colors" data-i18n-de="Pflanzlich Gerbendes Vollleder" data-i18n-en="Vegetable Tanned Leather">Pflanzlich Gerbendes Vollleder</h3>
                    <p class="mt-3 text-xs leading-relaxed text-[#685c54]" data-i18n-de="Unsere Häute stammen ausschließlich aus zertifizierten toskanischen Gerbereien. Veredelt mit Kastanien- und Eichenextrakten ohne giftiges Chrom." data-i18n-en="Our hides originate exclusively from certified Tuscan tanneries. Refined with chestnut and oak extracts without toxic chromium.">
                        Unsere Häute stammen ausschließlich aus zertifizierten toskanischen Gerbereien. Veredelt mit Kastanien- und Eichenextrakten ohne giftiges Chrom.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="animate-shine-sweep group relative rounded-md border border-[#e6decb] bg-white p-8 shadow-xs transition-all duration-500 hover:-translate-y-2.5 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#78000b]/10 text-[#78000b] mb-6 transition-all duration-500 group-hover:scale-110 group-hover:bg-[#78000b] group-hover:text-white group-hover:shadow-lg">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/></svg>
                    </div>
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">SÄULE 02</span>
                    <h3 class="font-display text-2xl font-medium text-[#1c1210] mt-1 group-hover:text-[#78000b] transition-colors" data-i18n-de="Handgenähte Sattlernaht" data-i18n-en="Hand Saddle Stitching">Handgenähte Sattlernaht</h3>
                    <p class="mt-3 text-xs leading-relaxed text-[#685c54]" data-i18n-de="Im Gegensatz zu Maschinennähten hält die klassische Doppel-Sattlernaht selbst dann bombensicher, wenn ein einzelner Faden beansprucht wird." data-i18n-en="Unlike machine stitches, the classic double saddle stitch remains indestructible even if an individual thread experiences heavy wear.">
                        Im Gegensatz zu Maschinennähten hält die klassische Doppel-Sattlernaht selbst dann bombensicher, wenn ein einzelner Faden beansprucht wird.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="animate-shine-sweep group relative rounded-md border border-[#e6decb] bg-white p-8 shadow-xs transition-all duration-500 hover:-translate-y-2.5 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#78000b]/10 text-[#78000b] mb-6 transition-all duration-500 group-hover:scale-110 group-hover:bg-[#78000b] group-hover:text-white group-hover:shadow-lg">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">SÄULE 03</span>
                    <h3 class="font-display text-2xl font-medium text-[#1c1210] mt-1 group-hover:text-[#78000b] transition-colors" data-i18n-de="7-Fache Kantenversiegelung" data-i18n-en="7-Layer Hand Edge Finishing">7-Fache Kantenversiegelung</h3>
                    <p class="mt-3 text-xs leading-relaxed text-[#685c54]" data-i18n-de="Jede Lederkante wird in sieben aufeinanderfolgenden Schritten geschliffen, poliert und mit biologischem Bienenwachs schützend versiegelt." data-i18n-en="Every leather edge is sanded, hand-polished, and sealed with organic beeswax across seven meticulous consecutive steps.">
                        Jede Lederkante wird in sieben aufeinanderfolgenden Schritten geschliffen, poliert und mit biologischem Bienenwachs schützend versiegelt.
                    </p>
                </div>

            </div>

            <!-- Second Row of Pillars -->
            <div class="grid gap-8 md:grid-cols-2 mt-8 max-w-4xl mx-auto">
                
                <!-- Pillar 4 -->
                <div class="animate-shine-sweep group relative rounded-md border border-[#e6decb] bg-white p-8 shadow-xs transition-all duration-500 hover:-translate-y-2.5 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#78000b]/10 text-[#78000b] mb-6 transition-all duration-500 group-hover:scale-110 group-hover:bg-[#78000b] group-hover:text-white group-hover:shadow-lg">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                    </div>
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">SÄULE 04</span>
                    <h3 class="font-display text-2xl font-medium text-[#1c1210] mt-1 group-hover:text-[#78000b] transition-colors" data-i18n-de="Massive Messing-Hardware (24k Vergoldet)" data-i18n-en="Solid Brass Hardware (24k Gold Plated)">Massive Messing-Hardware (24k Vergoldet)</h3>
                    <p class="mt-3 text-xs leading-relaxed text-[#685c54]" data-i18n-de="Reißverschlüsse und Schnallen werden im Gussverfahren aus schwerem Messing geformt und korrosionsgeschützt galvanisiert." data-i18n-en="Zippers and buckles are cast from solid brass and electroplated for permanent tarnish resistance.">
                        Reißverschlüsse und Schnallen werden im Gussverfahren aus schwerem Messing geformt und korrosionsgeschützt galvanisiert.
                    </p>
                </div>

                <!-- Pillar 5 -->
                <div class="animate-shine-sweep group relative rounded-md border border-[#e6decb] bg-white p-8 shadow-xs transition-all duration-500 hover:-translate-y-2.5 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#78000b]/10 text-[#78000b] mb-6 transition-all duration-500 group-hover:scale-110 group-hover:bg-[#78000b] group-hover:text-white group-hover:shadow-lg">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">SÄULE 05</span>
                    <h3 class="font-display text-2xl font-medium text-[#1c1210] mt-1 group-hover:text-[#78000b] transition-colors" data-i18n-de="Patina mit Charakter" data-i18n-en="Patina with Character">Patina mit Charakter</h3>
                    <p class="mt-3 text-xs leading-relaxed text-[#685c54]" data-i18n-de="Mit jedem Tag und jeder Reise entwickelt das Leder einen edlen Eigenglanz. Ihre Tasche wird mit den Jahren schöner und erzählt Ihre ganz persönliche Geschichte." data-i18n-en="With each day and journey, the leather develops a rich natural sheen. Your bag grows more beautiful with age and tells your unique personal story.">
                        Mit jedem Tag und jeder Reise entwickelt das Leder einen edlen Eigenglanz. Ihre Tasche wird mit den Jahren schöner und erzählt Ihre ganz persönliche Geschichte.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Deep-Dive Interactive Visual Showcase Section -->
    <section class="py-20 lg:py-28 bg-white border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                
                <div class="space-y-6">
                    <span class="rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-4 py-1.5 text-[0.62rem] font-bold uppercase tracking-widest text-[#78000b]">
                        DETAILSTUDIE & MANUFAKTUR
                    </span>
                    
                    <h2 class="font-display text-3xl font-medium text-[#1c1210] sm:text-4xl lg:text-5xl leading-tight" data-i18n-de="Wo Millimeterarbeit über Perfektion entscheidet" data-i18n-en="Where Millimeter Accuracy Defines Perfection">
                        Wo Millimeterarbeit über Perfektion entscheidet
                    </h2>

                    <p class="text-xs leading-relaxed text-[#685c54] sm:text-sm font-light" data-i18n-de="Unsere Feinsattler in Düsseldorf schneiden jede Lederhaut von Hand zu. Nur makellose Zonen des Nackens und der Flanke kommen für unsere Meisterkollektion infrage." data-i18n-en="Our master leather artisans in Düsseldorf hand-cut every single hide. Only flawless sections of the neck and flank qualify for our master collection.">
                        Unsere Feinsattler in Düsseldorf schneiden jede Lederhaut von Hand zu. Nur makellose Zonen des Nackens und der Flanke kommen für unsere Meisterkollektion infrage.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="group flex items-start gap-4 p-5 rounded-md bg-[#faf7f2] border border-[#e6decb] transition-all duration-300 hover:border-[#78000b] hover:shadow-md">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-bold text-xs shadow-md transition-transform duration-300 group-hover:scale-110">✓</div>
                            <div>
                                <h4 class="text-xs font-bold text-[#1c1210] uppercase tracking-wider" data-i18n-de="Individualisierung via Heißfolienprägung" data-i18n-en="Monogram Hot Foil Embossing">Individualisierung via Heißfolienprägung</h4>
                                <p class="text-[0.72rem] text-[#685c54] mt-1" data-i18n-de="Ihre Initialen werden mit 24-karätigem Blattgold oder blinder Tiefenprägung veredelt." data-i18n-en="Your initials are embossed with 24k gold leaf or subtle blind debossing.">Ihre Initialen werden mit 24-karätigem Blattgold oder blinder Tiefenprägung veredelt.</p>
                            </div>
                        </div>

                        <div class="group flex items-start gap-4 p-5 rounded-md bg-[#faf7f2] border border-[#e6decb] transition-all duration-300 hover:border-[#78000b] hover:shadow-md">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#78000b] text-[#ffd45a] font-bold text-xs shadow-md transition-transform duration-300 group-hover:scale-110">✓</div>
                            <div>
                                <h4 class="text-xs font-bold text-[#1c1210] uppercase tracking-wider" data-i18n-de="Nachhaltige Verpackung in Baumwollbeuteln" data-i18n-en="Sustainable Cotton Packaging">Nachhaltige Verpackung in Baumwollbeuteln</h4>
                                <p class="text-[0.72rem] text-[#685c54] mt-1" data-i18n-de="Jedes Produkt erreicht Sie in einem atmungsaktiven Bio-Staubbeutel und edler Geschenkbox." data-i18n-en="Every item arrives safely in a breathable organic dust bag and signature gift box.">Jedes Produkt erreicht Sie in einem atmungsaktiven Bio-Staubbeutel und edler Geschenkbox.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Animated Interactive Image Cards -->
                <div class="grid grid-cols-2 gap-5">
                    <div class="group relative overflow-hidden rounded-md border border-[#e6decb] bg-[#faf7f2] shadow-md">
                        <img src="/craftsmanship_detail.png" alt="Leather Detail Crafting" class="h-72 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                            <p class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">HANDSCHNITT</p>
                            <p class="text-xs font-serif italic">Präzisionsmesser aus Solingen</p>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-md border border-[#e6decb] bg-[#faf7f2] shadow-md mt-6">
                        <img src="/tote_hardware.png" alt="Solid Brass Hardware" class="h-72 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                            <p class="text-[0.6rem] font-bold uppercase tracking-widest text-[#d8b45a]">HARDWARE</p>
                            <p class="text-xs font-serif italic">Massivmessing 24k vergoldet</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Animated Interactive Atelier Tour Booking CTA -->
    <section class="relative overflow-hidden bg-[#0a0403] py-20 lg:py-28 text-white text-center border-t border-[#d8b45a]/30">
        <!-- Floating Glow Effects -->
        <div class="pointer-events-none absolute -bottom-20 left-1/2 -translate-x-1/2 h-80 w-[600px] rounded-full bg-[#78000b]/30 blur-[140px] animate-pulse-glow"></div>

        <div class="luxury-container relative z-10 max-w-3xl space-y-6">
            <span class="inline-block rounded-full border border-[#d8b45a]/40 bg-black/60 px-4 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a] shadow-md backdrop-blur-md">
                EXKLUSIVE MANUFAKTUR-ERFAHRUNG
            </span>

            <h2 class="font-display text-3xl font-medium text-[#fffaf0] sm:text-4xl lg:text-5xl" data-i18n-de="Besuchen Sie unsere Meisterwerkstatt in Düsseldorf" data-i18n-en="Visit Our Düsseldorf Workshop">
                Besuchen Sie unsere Meisterwerkstatt in Düsseldorf
            </h2>

            <p class="text-xs leading-relaxed text-[#e4d9cc]/80 sm:text-sm font-light max-w-2xl mx-auto" data-i18n-de="Erleben Sie die Entstehung Ihres persönlichen Lederstücks hautnah. Vereinbaren Sie eine private VIP-Führung mit unseren Meistersattlern inkl. Champagner-Empfang." data-i18n-en="Experience the creation of your personal leather item firsthand. Schedule a private VIP tour with our master saddlers including champagne reception.">
                Erleben Sie die Entstehung Ihres persönlichen Lederstücks hautnah. Vereinbaren Sie eine private VIP-Führung mit unseren Meistersattlern inkl. Champagner-Empfang.
            </p>
            
            <div class="pt-6">
                <button onclick="openVipTourModal()" type="button" class="animate-shine-sweep inline-flex items-center gap-3 rounded bg-[#78000b] px-9 py-4 text-xs font-bold uppercase tracking-[0.22em] text-white shadow-2xl transition-all duration-300 hover:bg-[#5a0309] hover:shadow-[0_10px_40px_rgba(216,180,90,0.4)] cursor-pointer active:scale-95">
                    <span data-i18n-de="JETZT PRIVATTERMIN ANFRAGEN" data-i18n-en="REQUEST PRIVATE APPOINTMENT">JETZT PRIVATTERMIN ANFRAGEN</span>
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </button>
            </div>
        </div>
    </section>

</div>

<script>
    function openVipTourModal() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'VIP Atelier Tour 👑' : 'VIP Manufaktur-Führung 👑',
            html: `
                <div class="text-left space-y-3 mt-3 text-xs">
                    <p class="text-neutral-600">${isEn ? 'Book your exclusive private tour in our Düsseldorf workshop:' : 'Buchen Sie Ihren exklusiven Einblick in die Düsseldorfer Werkstatt:'}</p>
                    <input id="tour-name" class="w-full h-11 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" placeholder="${isEn ? 'Your Name' : 'Ihr Name'}" type="text">
                    <input id="tour-email" class="w-full h-11 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" placeholder="${isEn ? 'Your Email Address' : 'Ihre E-Mail-Adresse'}" type="email">
                    <input id="tour-date" class="w-full h-11 px-3.5 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b] text-xs font-medium" type="date">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: isEn ? 'Book Appointment' : 'Termin Buchen',
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
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Appointment Request Received! 🍾' : 'Terminanfrage Erhalten! 🍾',
                    text: isEn 
                        ? 'Thank you, ' + result.value.name + '. Our VIP Concierge team will contact you within 12 hours.'
                        : 'Vielen Dank, ' + result.value.name + '. Unser VIP Concierge Team wird sich binnen 12 Stunden bei Ihnen melden.',
                    confirmButtonText: isEn ? 'Wonderful' : 'Wunderbar'
                });
            }
        });
    }
</script>
@endsection
