@extends('layouts.app')
@section('title', 'Maison Grand Leather Tote - MEHAAJ Luxury Leather')

@section('content')
<div class="pt-20">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <a href="#" class="hover:text-[#78000b] transition" data-i18n-de="Kollektion" data-i18n-en="Collection">Kollektion</a>
            <span>/</span>
            <a href="#" class="hover:text-[#78000b] transition" data-i18n-de="Leder Taschen" data-i18n-en="Leather Bags">Leder Taschen</a>
            <span>/</span>
            <span class="text-[#1c1210] font-medium">Maison Grand Leather Tote</span>
        </div>
    </nav>

    <!-- Main Product Showcase Section -->
    <section class="bg-white py-10 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Interactive Product Gallery (7 cols) -->
                <div class="lg:col-span-7 flex flex-col gap-4">
                    <!-- Main Image Display -->
                    <div class="relative overflow-hidden rounded-md border border-[#e6decb] bg-[#f7f4ee] shadow-sm group">
                        <!-- Top Gold Line Shimmer -->
                        <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                        <!-- Top Left Badge -->
                        <div class="absolute left-4 top-4 z-10">
                            <span class="rounded-sm bg-[#78000b] px-3 py-1 text-[0.6rem] font-bold uppercase tracking-luxury text-white shadow-md animate-pulse" data-i18n-de="BESTSELLER" data-i18n-en="BESTSELLER">
                                BESTSELLER
                            </span>
                        </div>

                        <img
                            id="main-product-image"
                            src="/productbag.png"
                            alt="Maison Grand Leather Tote"
                            class="h-[380px] sm:h-[480px] lg:h-[540px] w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 cursor-zoom-in"
                        >

                        <div class="absolute right-4 bottom-4 z-10 flex items-center gap-1.5 rounded bg-white/90 px-3 py-1.5 text-[0.65rem] font-bold text-[#1c1210] backdrop-blur border border-[#e6decb] shadow-sm transition duration-300 group-hover:bg-[#78000b] group-hover:text-white">
                            <svg class="h-3.5 w-3.5 text-[#78000b] group-hover:text-white transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                            <span data-i18n-de="ZOOMEN" data-i18n-en="ZOOM">ZOOMEN</span>
                        </div>
                    </div>

                    <!-- Thumbnails Carousel -->
                    <div class="grid grid-cols-3 gap-3">
                        <button
                            type="button"
                            onclick="switchProductImage('/productbag.png', this)"
                            class="gallery-thumb active-thumb group relative overflow-hidden rounded border-2 border-[#78000b] bg-[#f7f4ee] p-1 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-md cursor-pointer"
                        >
                            <img src="/productbag.png" alt="Front View" class="h-20 w-full object-cover rounded-sm transition-transform duration-300 group-hover:scale-110">
                        </button>

                        <button
                            type="button"
                            onclick="switchProductImage('/tote_interior.png', this)"
                            class="gallery-thumb group relative overflow-hidden rounded border-2 border-[#e6decb] bg-[#f7f4ee] p-1 transition-all duration-300 hover:border-[#78000b] hover:scale-105 shadow-sm hover:shadow-md cursor-pointer"
                        >
                            <img src="/tote_interior.png" alt="Interior View" class="h-20 w-full object-cover rounded-sm transition-transform duration-300 group-hover:scale-110">
                        </button>

                        <button
                            type="button"
                            onclick="switchProductImage('/tote_hardware.png', this)"
                            class="gallery-thumb group relative overflow-hidden rounded border-2 border-[#e6decb] bg-[#f7f4ee] p-1 transition-all duration-300 hover:border-[#78000b] hover:scale-105 shadow-sm hover:shadow-md cursor-pointer"
                        >
                            <img src="/tote_hardware.png" alt="Hardware Detail" class="h-20 w-full object-cover rounded-sm transition-transform duration-300 group-hover:scale-110">
                        </button>
                    </div>
                </div>

                <!-- Right Column: Product Buy Box & Details (5 cols) -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <!-- Category & Rating -->
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="LEDER TASCHEN" data-i18n-en="LEATHER BAGS">
                                LEDER TASCHEN
                            </span>
                            <div class="flex items-center gap-1.5 text-xs text-[#685c54]">
                                <div class="flex text-[#d8b45a] text-sm tracking-wider">★ ★ ★ ★ ★</div>
                                <span class="font-medium text-[#1c1210]">4.9</span>
                                <a href="#reviews" class="text-xs text-[#685c54] underline hover:text-[#78000b] transition cursor-pointer">(48)</a>
                            </div>
                        </div>

                        <!-- Product Title -->
                        <h1 class="mt-2 font-display text-3xl font-medium leading-tight text-[#1c1210] sm:text-4xl" data-i18n-de="Maison Grand Leder Handtasche" data-i18n-en="Maison Grand Leather Tote">
                            Maison Grand Leder Handtasche
                        </h1>

                        <!-- Pricing & German VAT Legal Notice -->
                        <div class="mt-4 border-b border-[#f2ebdc] pb-4">
                            <div class="flex items-baseline gap-3">
                                <span class="font-display text-3xl font-bold text-[#1c1210]">EUR 289,00</span>
                                <span class="text-sm text-[#8a7c74] line-through">EUR 340,00</span>
                                <span class="rounded bg-[#78000b]/10 px-2 py-0.5 text-xs font-bold text-[#78000b] animate-pulse">-15%</span>
                            </div>

                            <p class="mt-1 text-[0.7rem] text-[#685c54]">
                                <span data-i18n-de="inkl. MwSt." data-i18n-en="incl. VAT">inkl. MwSt.</span>, 
                                <a href="/versand" class="underline hover:text-[#78000b] transition cursor-pointer" data-i18n-de="zzgl. Versandkosten" data-i18n-en="plus shipping costs">zzgl. Versandkosten</a>
                            </p>

                            <!-- Delivery Status Badge -->
                            <div class="mt-3 flex items-center gap-2 text-xs text-[#2e683a] bg-[#2e683a]/8 px-3 py-1.5 rounded-sm border border-[#2e683a]/20 w-fit shadow-xs">
                                <span class="h-2 w-2 rounded-full bg-[#2e683a] animate-pulse"></span>
                                <span class="font-medium" data-i18n-de="Auf Lager – In 1–3 Werktagen bei Ihnen (Gratis Versand in DE)" data-i18n-en="In Stock – Delivery in 1–3 working days (Free DE Shipping)">
                                    Auf Lager – In 1–3 Werktagen bei Ihnen (Gratis Versand in DE)
                                </span>
                            </div>
                        </div>

                        <!-- Color Selector -->
                        <div class="mt-6">
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210]">
                                <span data-i18n-de="Farbe:" data-i18n-en="Color:">Farbe:</span>
                                <span id="selected-color-name" class="font-normal normal-case text-[#685c54] ml-1">Cognac Braun</span>
                            </label>
                            <div class="mt-2.5 flex items-center gap-3">
                                <button
                                    type="button"
                                    onclick="selectColor('Cognac Braun', this)"
                                    class="color-btn active-color h-9 w-9 rounded-full bg-[#8c4b27] border-2 border-[#78000b] ring-2 ring-offset-2 ring-[#78000b] transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer shadow-sm"
                                    title="Cognac Braun"
                                ></button>
                                <button
                                    type="button"
                                    onclick="selectColor('Nachtschwarz', this)"
                                    class="color-btn h-9 w-9 rounded-full bg-[#1a1817] border-2 border-transparent hover:border-[#78000b] transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer shadow-sm"
                                    title="Nachtschwarz"
                                ></button>
                                <button
                                    type="button"
                                    onclick="selectColor('Espresso Dunkelbraun', this)"
                                    class="color-btn h-9 w-9 rounded-full bg-[#3b2318] border-2 border-transparent hover:border-[#78000b] transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer shadow-sm"
                                    title="Espresso Dunkelbraun"
                                ></button>
                            </div>
                        </div>

                        <!-- Quantity Selector & Action CTA Buttons -->
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <!-- Quantity counter -->
                            <div class="flex h-12 items-center rounded border border-[#e6decb] bg-[#faf7f2] px-2 w-32 justify-between shadow-xs">
                                <button type="button" onclick="adjustQty(-1)" class="h-8 w-8 flex items-center justify-center font-bold text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer">-</button>
                                <span id="qty-count" class="font-bold text-sm text-[#1c1210]">1</span>
                                <button type="button" onclick="adjustQty(1)" class="h-8 w-8 flex items-center justify-center font-bold text-[#1c1210] hover:text-[#78000b] transition active:scale-90 cursor-pointer">+</button>
                            </div>

                            <!-- Add to Cart CTA -->
                            <button
                                type="button"
                                id="add-to-cart-btn"
                                onclick="triggerAddToCartAnimation()"
                                class="group/btn flex-1 flex h-12 items-center justify-center gap-2 rounded bg-[#78000b] px-6 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl active:scale-95 cursor-pointer"
                            >
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover/btn:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round" />
                                    <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round" />
                                </svg>
                                <span id="add-cart-label" data-i18n-de="IN DEN WARENKORB" data-i18n-en="ADD TO CART">IN DEN WARENKORB</span>
                            </button>

                            <!-- Wishlist button -->
                            <button
                                type="button"
                                class="h-12 w-12 flex items-center justify-center rounded border border-[#e6decb] bg-white text-[#78000b] shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:scale-105 active:scale-95 cursor-pointer"
                                title="Add to wishlist"
                            >
                                <svg class="h-5 w-5 transition duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <!-- Trust Features List -->
                        <div class="mt-8 grid grid-cols-3 gap-3 border-t border-[#f2ebdc] pt-6 text-center text-[0.68rem] text-[#5c4f46]">
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="100% Vollleder" data-i18n-en="100% Full Grain">100% Vollleder</span>
                            </div>
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="2 Jahre Garantie" data-i18n-en="2-Year Warranty">2 Jahre Garantie</span>
                            </div>
                            <div class="group flex flex-col items-center gap-1.5 p-3 bg-[#faf7f2] rounded border border-[#e6decb]/60 transition-all duration-300 hover:-translate-y-1 hover:border-[#78000b]/30 hover:shadow-md cursor-pointer">
                                <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="1" y="3" width="15" height="13"/>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                    <circle cx="5.5" cy="18.5" r="2.5"/>
                                    <circle cx="18.5" cy="18.5" r="2.5"/>
                                </svg>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="30 Tage Retoure" data-i18n-en="30-Day Returns">30 Tage Retoure</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Product Details & Leather Care Accordion Section -->
    <section class="bg-[#faf7f2] py-12 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container max-w-4xl">
            <div class="text-center mb-8">
                <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="PRODUKTSPEZIFIKATIONEN" data-i18n-en="PRODUCT SPECIFICATIONS">PRODUKTSPEZIFIKATIONEN</span>
                <h2 class="mt-2 font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Details, Material & Pflege" data-i18n-en="Details, Material & Care">
                    Details, Material & Pflege
                </h2>
            </div>

            <div class="divide-y divide-[#e6decb] rounded-md border border-[#e6decb] bg-white shadow-sm overflow-hidden">

                <!-- Accordion Item 1: Abmessungen & Details -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Abmessungen & Ausstattung" data-i18n-en="Dimensions & Features">Abmessungen & Ausstattung</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content hidden px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <ul class="list-disc pl-5 space-y-1.5 text-xs sm:text-sm">
                            <li data-i18n-de="Höhe: 32 cm | Breite: 42 cm | Tiefe: 15 cm" data-i18n-en="Height: 32 cm | Width: 42 cm | Depth: 15 cm">Höhe: 32 cm | Breite: 42 cm | Tiefe: 15 cm</li>
                            <li data-i18n-de="Passend für Laptops bis zu 15 Zoll (z. B. MacBook Pro 16&quot;)" data-i18n-en="Fits laptops up to 15 inches (e.g. MacBook Pro 16&quot;)">Passend für Laptops bis zu 15 Zoll (z. B. MacBook Pro 16")</li>
                            <li data-i18n-de="Innentasche mit Reißverschluss für Wertsachen & 2 Steckfächer" data-i18n-en="Zipped interior pocket for valuables & 2 slip pockets">Innentasche mit Reißverschluss für Wertsachen & 2 Steckfächer</li>
                            <li data-i18n-de="Verstärkter Boden mit 4 Schutzfüßen aus Messing" data-i18n-en="Reinforced base with 4 brass protective feet">Verstärkter Boden mit 4 Schutzfüßen aus Messing</li>
                            <li data-i18n-de="Gewicht: ca. 1.100 g" data-i18n-en="Weight: approx. 1,100 g">Gewicht: ca. 1.100 g</li>
                        </ul>
                    </div>
                </div>

                <!-- Accordion Item 2: Material & Herkunft -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Material & Italienische Gerbung" data-i18n-en="Material & Italian Tanning">Material & Italienische Gerbung</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content hidden px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <p class="text-xs sm:text-sm leading-relaxed" data-i18n-de="Unsere Maison Grand Tote wird aus 100% pflanzlich gegerbtem italienischem Vollleder in der Toskana gefertigt. Es zeichnet sich durch seine samtige Haptik, natürliche Narbung und bemerkenswerte Langlebigkeit aus." data-i18n-en="Our Maison Grand Tote is crafted from 100% vegetable-tanned Italian full-grain leather in Tuscany. It features a velvety touch, natural grain, and remarkable durability.">
                            Unsere Maison Grand Tote wird aus 100% pflanzlich gegerbtem italienischem Vollleder in der Toskana gefertigt. Es zeichnet sich durch seine samtige Haptik, natürliche Narbung und bemerkenswerte Langlebigkeit aus.
                        </p>
                    </div>
                </div>

                <!-- Accordion Item 3: Lederpflege -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Lederpflege & Patina-Garantie" data-i18n-en="Leather Care & Patina Guarantee">Lederpflege & Patina-Garantie</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content hidden px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <p class="text-xs sm:text-sm leading-relaxed" data-i18n-de="Echtes Vollleder entwickelt im Laufe der Zeit eine wunderschöne, individuelle Patina. Wir empfehlen, die Tasche alle 3-6 Monate mit einem hochwertigen neutralen Lederbalsam zu pflegen und vor extremer Nässe zu schützen." data-i18n-en="Genuine full-grain leather develops a beautiful, unique patina over time. We recommend treating the bag every 3-6 months with a high-quality neutral leather balsam and protecting it from extreme moisture.">
                            Echtes Vollleder entwickelt im Laufe der Zeit eine wunderschöne, individuelle Patina. Wir empfehlen, die Tasche alle 3-6 Monate mit einem hochwertigen neutralen Lederbalsam zu pflegen und vor extremer Nässe zu schützen.
                        </p>
                    </div>
                </div>

                <!-- Accordion Item 4: Versand & Retoure -->
                <div class="group">
                    <button type="button" onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-lg font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Versand & Kostenlose Retoure in DE" data-i18n-en="Shipping & Free Returns in DE">Versand & Kostenlose Retoure in DE</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="accordion-content hidden px-5 pb-6 text-sm text-[#5c4f46] space-y-3">
                        <p class="text-xs sm:text-sm leading-relaxed" data-i18n-de="Der Versand erfolgt versichert via DHL Express. Innerhalb Deutschlands ist der Versand ab 150 € kostenlos. Sie können den Artikel 30 Tage lang ohne Angabe von Gründen kostenfrei zurücksenden." data-i18n-en="Shipping is insured via DHL Express. Free shipping within Germany on orders over €150. You may return the item free of charge within 30 days.">
                            Der Versand erfolgt versichert via DHL Express. Innerhalb Deutschlands ist der Versand ab 150 € kostenlos. Sie können den Artikel 30 Tage lang ohne Angabe von Gründen kostenfrei zurücksenden.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section id="reviews" class="bg-white py-12 lg:py-16 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#e6decb] pb-6">
                <div>
                    <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="KUNDENBEWERTUNGEN" data-i18n-en="CUSTOMER REVIEWS">KUNDENBEWERTUNGEN</span>
                    <h2 class="mt-2 font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Erfahrungen unserer Kunden" data-i18n-en="Verified Customer Experiences">
                        Erfahrungen unserer Kunden
                    </h2>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-3">
                    <div class="text-right">
                        <p class="font-display text-2xl font-bold text-[#1c1210]">4.9 / 5.0</p>
                        <p class="text-xs text-[#685c54]" data-i18n-de="Basierend auf 48 Bewertungen" data-i18n-en="Based on 48 reviews">Basierend auf 48 Bewertungen</p>
                    </div>
                    <div class="flex text-[#d8b45a] text-lg">★ ★ ★ ★ ★</div>
                </div>
            </div>

            <!-- Review Cards Grid -->
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <div class="group relative overflow-hidden rounded-md border border-[#e6decb] bg-[#faf7f2] p-6 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b]/30 hover:bg-white hover:shadow-lg cursor-pointer">
                    <div class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex text-[#d8b45a] text-xs tracking-wider">★ ★ ★ ★ ★</div>
                        <span class="text-[0.65rem] text-[#8a7c74]">12. Aug 2026</span>
                    </div>
                    <h3 class="font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition duration-300">"Erstklassiges Leder & schnelle Lieferung"</h3>
                    <p class="mt-2 text-xs leading-relaxed text-[#5c4f46]" data-i18n-de="Die Tasche riecht herrlich nach echtem Leder. Die Verarbeitung der Nähte ist makellos. Perfekt für das Büro und Reisen!" data-i18n-en="The bag smells wonderfully of genuine leather. The stitching is flawless. Perfect for office and travel!">
                        Die Tasche riecht herrlich nach echtem Leder. Die Verarbeitung der Nähte ist makellos. Perfekt für das Büro und Reisen!
                    </p>
                    <p class="mt-4 text-[0.7rem] font-bold text-[#1c1210]">— Maximilian S., München <span class="text-[#2e683a] font-normal">(Geprüfter Käufer)</span></p>
                </div>

                <div class="group relative overflow-hidden rounded-md border border-[#e6decb] bg-[#faf7f2] p-6 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b]/30 hover:bg-white hover:shadow-lg cursor-pointer">
                    <div class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex text-[#d8b45a] text-xs tracking-wider">★ ★ ★ ★ ★</div>
                        <span class="text-[0.65rem] text-[#8a7c74]">28. Jul 2026</span>
                    </div>
                    <h3 class="font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition duration-300">"Ein echter Blickfang"</h3>
                    <p class="mt-2 text-xs leading-relaxed text-[#5c4f46]" data-i18n-de="Ich habe schon viele Komplimente für diese Tasche erhalten. Das Cognac-Braun sieht extrem edel aus." data-i18n-en="I've received so many compliments on this bag. The cognac brown looks extremely sophisticated.">
                        Ich habe schon viele Komplimente für diese Tasche erhalten. Das Cognac-Braun sieht extrem edel aus.
                    </p>
                    <p class="mt-4 text-[0.7rem] font-bold text-[#1c1210]">— Victoria V., Hamburg <span class="text-[#2e683a] font-normal">(Geprüfter Käufer)</span></p>
                </div>

                <div class="group relative overflow-hidden rounded-md border border-[#e6decb] bg-[#faf7f2] p-6 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b]/30 hover:bg-white hover:shadow-lg cursor-pointer">
                    <div class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex text-[#d8b45a] text-xs tracking-wider">★ ★ ★ ★ ★</div>
                        <span class="text-[0.65rem] text-[#8a7c74]">04. Jun 2026</span>
                    </div>
                    <h3 class="font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition duration-300">"Schneller Versand, edle Verpackung"</h3>
                    <p class="mt-2 text-xs leading-relaxed text-[#5c4f46]" data-i18n-de="War am nächsten Tag da. Die Box und der Staubbeutel fühlten sich sehr luxuriös an. Absolut empfehlenswert." data-i18n-en="Arrived the next day. The box and dust bag felt very luxurious. Highly recommended.">
                        War am nächsten Tag da. Die Box und der Staubbeutel fühlten sich sehr luxuriös an. Absolut empfehlenswert.
                    </p>
                    <p class="mt-4 text-[0.7rem] font-bold text-[#1c1210]">— Dr. Florian H., Frankfurt <span class="text-[#2e683a] font-normal">(Geprüfter Käufer)</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Cross-Sell Section -->
    <section class="bg-[#faf7f2] py-12 lg:py-16">
        <div class="luxury-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#e6decb] pb-6">
                <div>
                    <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="PASSENDE ACCESSOIRES" data-i18n-en="MATCHING ACCESSORIES">PASSENDE ACCESSOIRES</span>
                    <h2 class="mt-2 font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Das könnte Ihnen auch gefallen" data-i18n-en="You May Also Like">
                        Das könnte Ihnen auch gefallen
                    </h2>
                </div>
            </div>

            <!-- Related Products Cards -->
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <article class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-sm transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <!-- Top Gold Line Shimmer -->
                    <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                    <div class="relative h-56 overflow-hidden bg-[#f7f4ee]">
                        <img src="/productwallet.png" alt="Bespoke Zip Leather Wallet" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    </div>
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[0.58rem] font-bold uppercase tracking-[0.18em] text-[#78000b]">Geldbörsen</span>
                            <h3 class="mt-1 font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300">Leder Geldbörse Premium</h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-3">
                            <span class="font-bold text-base text-[#1c1210]">EUR 129</span>
                            <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-xs transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                        </div>
                    </div>
                </article>

                <article class="animate-shine-sweep group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-sm transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] cursor-pointer">
                    <!-- Top Gold Line Shimmer -->
                    <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                    <div class="relative h-56 overflow-hidden bg-[#f7f4ee]">
                        <img src="/productKeychain.png" alt="Executive Leather Key Ring" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    </div>
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[0.58rem] font-bold uppercase tracking-[0.18em] text-[#78000b]">Accessoires</span>
                            <h3 class="mt-1 font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300">Executive Schlüsselanhänger</h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-3">
                            <span class="font-bold text-base text-[#1c1210]">EUR 59</span>
                            <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-xs transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                        </div>
                    </div>
                </article>

                <article class="group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white shadow-sm transition-all duration-500 hover:-translate-y-1.5 hover:border-[#78000b]/40 hover:shadow-xl cursor-pointer sm:col-span-2 lg:col-span-1">
                    <!-- Top Gold Line Shimmer -->
                    <div class="absolute inset-x-0 top-0 z-20 h-1 origin-left scale-x-0 bg-[#d8b45a] transition-transform duration-500 group-hover:scale-x-100"></div>

                    <div class="relative h-56 overflow-hidden bg-[#f7f4ee]">
                        <img src="/productgolf.png" alt="Royal Executive Golf Carry" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108">
                    </div>
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[0.58rem] font-bold uppercase tracking-[0.18em] text-[#78000b]">Golf & Lifestyle</span>
                            <h3 class="mt-1 font-display text-base font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors duration-300">Royal Golf Executive Carry</h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between border-t border-[#f2ebdc] pt-3">
                            <span class="font-bold text-base text-[#1c1210]">EUR 450</span>
                            <a href="/shop/maison-leather-tote" class="inline-flex items-center gap-1 rounded bg-[#78000b] px-3 py-1.5 text-[0.6rem] font-bold uppercase tracking-wider text-white shadow-xs transition hover:bg-[#5a0309] cursor-pointer" data-i18n-de="ANSEHEN" data-i18n-en="VIEW">ANSEHEN</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Page Specific Vanilla JS Scripts -->
    <script>
        function switchProductImage(src, btnElement) {
            document.getElementById('main-product-image').src = src;
            document.querySelectorAll('.gallery-thumb').forEach(el => {
                el.classList.remove('border-[#78000b]', 'active-thumb');
                el.classList.add('border-[#e6decb]');
            });
            btnElement.classList.remove('border-[#e6decb]');
            btnElement.classList.add('border-[#78000b]', 'active-thumb');
        }

        function selectColor(colorName, btnElement) {
            document.getElementById('selected-color-name').innerText = colorName;
            document.querySelectorAll('.color-btn').forEach(el => {
                el.classList.remove('border-[#78000b]', 'ring-2', 'ring-offset-2', 'ring-[#78000b]');
                el.classList.add('border-transparent');
            });
            btnElement.classList.remove('border-transparent');
            btnElement.classList.add('border-[#78000b]', 'ring-2', 'ring-offset-2', 'ring-[#78000b]');
        }

        function adjustQty(change) {
            const countEl = document.getElementById('qty-count');
            let count = parseInt(countEl.innerText) + change;
            if (count < 1) count = 1;
            if (count > 10) count = 10;
            countEl.innerText = count;
        }

        function toggleAccordion(btn) {
            const content = btn.nextElementSibling;
            const svg = btn.querySelector('svg');
            const isHidden = content.classList.contains('hidden');
            
            if (isHidden) {
                content.classList.remove('hidden');
                svg.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                svg.classList.remove('rotate-180');
            }
        }

        function triggerAddToCartAnimation() {
            const btn = document.getElementById('add-to-cart-btn');
            const label = document.getElementById('add-cart-label');
            const originalText = label.innerText;
            
            btn.classList.add('bg-[#2e683a]');
            btn.classList.remove('bg-[#78000b]');
            label.innerText = 'IN DEN WARENKORB GELEGT ✓';
            
            LuxuryToast.fire({
                icon: 'success',
                title: 'Maison Grand Leather Tote in den Warenkorb gelegt! 🛍️'
            });

            setTimeout(() => {
                btn.classList.remove('bg-[#2e683a]');
                btn.classList.add('bg-[#78000b]');
                label.innerText = originalText;
                openCartDrawer();
            }, 1200);
        }
    </script>
</div>
@endsection


