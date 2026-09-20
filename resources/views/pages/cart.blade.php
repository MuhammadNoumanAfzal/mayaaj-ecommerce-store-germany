@extends('layouts.app')
@section('title', 'Warenkorb & Kasse - MEHAAJ Luxury Leather')

@section('content')
<div class="pt-20 bg-[#faf7f2] min-h-screen text-[#1c1210]">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <a href="/shop" class="hover:text-[#78000b] transition" data-i18n-de="Shop" data-i18n-en="Shop">Shop</a>
            <span>/</span>
            <span class="text-[#1c1210] font-medium" data-i18n-de="Warenkorb & Kasse" data-i18n-en="Cart & Checkout">Warenkorb & Kasse</span>
        </div>
    </nav>

    <!-- Header Cart Banner -->
    <section class="bg-white py-8 lg:py-10 border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#78000b]" data-i18n-de="EXKLUSIVE SELEKTION" data-i18n-en="EXCLUSIVE SELECTION">EXKLUSIVE SELEKTION</span>
                    <h1 class="mt-1.5 font-display text-3xl font-medium text-[#1c1210] sm:text-4xl" data-i18n-de="Ihr Warenkorb & Kasse" data-i18n-en="Your Cart & Checkout">
                        Ihr Warenkorb & Kasse
                    </h1>
                </div>
                <!-- Free Shipping Progress Indicator -->
                <div class="rounded border border-[#2e683a]/30 bg-[#2e683a]/8 px-4 py-2.5 text-xs text-[#2e683a] w-fit flex items-center gap-2.5 shadow-xs">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#2e683a] animate-ping"></span>
                    <span data-i18n-de="Gratis DHL Express Versand für diese Bestellung freigeschaltet! 🎉" data-i18n-en="Free DHL Express shipping unlocked for this order! 🎉">
                        Gratis DHL Express Versand für diese Bestellung freigeschaltet! 🎉
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Items & Order Checkout Section -->
    <section class="py-10 lg:py-16">
        <div class="luxury-container">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Items Table, Shipping Form & Bank Transfer Form (8 cols) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- 1. CART ITEMS TABLE CARD -->
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-xs overflow-hidden">
                        <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-4 mb-4">
                            <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="1. Gewählte Luxus-Artikel" data-i18n-en="1. Selected Luxury Items">
                                1. Gewählte Luxus-Artikel
                            </h2>
                            <span class="text-xs text-[#78000b] font-bold" id="page-item-count" data-i18n-de="2 Artikel" data-i18n-en="2 Items">2 Artikel</span>
                        </div>
                        
                        <!-- Table Header -->
                        <div class="hidden sm:grid grid-cols-12 text-xs font-bold uppercase tracking-wider text-[#685c54] border-b border-[#f2ebdc] pb-3 mb-4">
                            <span class="col-span-6" data-i18n-de="Produkt" data-i18n-en="Product">Produkt</span>
                            <span class="col-span-3 text-center" data-i18n-de="Anzahl" data-i18n-en="Quantity">Anzahl</span>
                            <span class="col-span-3 text-right" data-i18n-de="Gesamt" data-i18n-en="Total">Gesamt</span>
                        </div>

                        <!-- Item Row 1 -->
                        <div class="cart-page-item sm:grid sm:grid-cols-12 items-center gap-4 py-4 border-b border-[#f2ebdc] last:border-b-0 space-y-3 sm:space-y-0">
                            <div class="sm:col-span-6 flex items-center gap-4">
                                <img src="/productbag.png" alt="Maison Grand Leather Tote" class="h-20 w-20 rounded border border-[#e6decb] object-cover bg-[#f7f4ee]">
                                <div>
                                    <h3 class="font-display text-base font-medium text-[#1c1210]">Maison Grand Leather Tote</h3>
                                    <p class="text-xs text-[#685c54]">Farbe: Cognac Braun</p>
                                    <p class="text-xs text-[#78000b] font-bold mt-1">EUR 289,00</p>
                                </div>
                            </div>
                            <div class="sm:col-span-3 flex items-center justify-between sm:justify-center">
                                <div class="flex h-8 items-center rounded border border-[#e6decb] bg-[#faf7f2] px-2 w-24 justify-between text-xs">
                                    <button type="button" onclick="updatePageQty(this, -1, 289)" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer">-</button>
                                    <span class="qty-page font-bold text-[#1c1210]">1</span>
                                    <button type="button" onclick="updatePageQty(this, 1, 289)" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer">+</button>
                                </div>
                            </div>
                            <div class="sm:col-span-3 flex items-center justify-between sm:justify-end gap-3">
                                <span class="font-bold text-base text-[#1c1210] item-total">EUR 289,00</span>
                                <button type="button" onclick="removePageItem(this)" class="text-[#8a7c74] hover:text-[#78000b] transition cursor-pointer" title="Remove item">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Item Row 2 -->
                        <div class="cart-page-item sm:grid sm:grid-cols-12 items-center gap-4 py-4 border-b border-[#f2ebdc] last:border-b-0 space-y-3 sm:space-y-0">
                            <div class="sm:col-span-6 flex items-center gap-4">
                                <img src="/productwallet.png" alt="Bespoke Zip Leather Wallet" class="h-20 w-20 rounded border border-[#e6decb] object-cover bg-[#f7f4ee]">
                                <div>
                                    <h3 class="font-display text-base font-medium text-[#1c1210]">Bespoke Zip Leather Wallet</h3>
                                    <p class="text-xs text-[#685c54]">Farbe: Nachtschwarz</p>
                                    <p class="text-xs text-[#78000b] font-bold mt-1">EUR 129,00</p>
                                </div>
                            </div>
                            <div class="sm:col-span-3 flex items-center justify-between sm:justify-center">
                                <div class="flex h-8 items-center rounded border border-[#e6decb] bg-[#faf7f2] px-2 w-24 justify-between text-xs">
                                    <button type="button" onclick="updatePageQty(this, -1, 129)" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer">-</button>
                                    <span class="qty-page font-bold text-[#1c1210]">1</span>
                                    <button type="button" onclick="updatePageQty(this, 1, 129)" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer">+</button>
                                </div>
                            </div>
                            <div class="sm:col-span-3 flex items-center justify-between sm:justify-end gap-3">
                                <span class="font-bold text-base text-[#1c1210] item-total">EUR 129,00</span>
                                <button type="button" onclick="removePageItem(this)" class="text-[#8a7c74] hover:text-[#78000b] transition cursor-pointer" title="Remove item">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>


                    <!-- 2. SHIPPING ADDRESS DATA COLLECTION FORM -->
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-xs space-y-6">
                        <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-4">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#78000b] text-white font-bold text-sm">2</div>
                            <div>
                                <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Lieferadresse & Kontaktdaten" data-i18n-en="Shipping Address & Contact Info">
                                    Lieferadresse & Kontaktdaten
                                </h2>
                                <p class="text-xs text-[#685c54]" data-i18n-de="Bitte geben Sie Ihre vollständige Adresse für die DHL Express Lieferung ein." data-i18n-en="Please enter your full address for DHL Express delivery.">
                                    Bitte geben Sie Ihre vollständige Adresse für die DHL Express Lieferung ein.
                                </p>
                            </div>
                        </div>

                        <form id="shipping-address-form" class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Vorname *" data-i18n-en="First Name *">Vorname *</label>
                                <input
                                    type="text"
                                    id="ship-first-name"
                                    required
                                    placeholder="Maximilian"
                                    data-i18n-placeholder-de="Maximilian"
                                    data-i18n-placeholder-en="Alexander"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Nachname *" data-i18n-en="Last Name *">Nachname *</label>
                                <input
                                    type="text"
                                    id="ship-last-name"
                                    required
                                    placeholder="Mustermann"
                                    data-i18n-placeholder-de="Mustermann"
                                    data-i18n-placeholder-en="Smith"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="E-Mail-Adresse *" data-i18n-en="Email Address *">E-Mail-Adresse *</label>
                                <input
                                    type="email"
                                    id="ship-email"
                                    required
                                    placeholder="maximilian@beispiel.de"
                                    data-i18n-placeholder-de="maximilian@beispiel.de"
                                    data-i18n-placeholder-en="alexander@example.com"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Telefonnummer *" data-i18n-en="Phone Number *">Telefonnummer *</label>
                                <input
                                    type="tel"
                                    id="ship-phone"
                                    required
                                    placeholder="+49 170 1234567"
                                    data-i18n-placeholder-de="+49 170 1234567"
                                    data-i18n-placeholder-en="+44 7911 123456"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Straße & Hausnummer *" data-i18n-en="Street Address & House No. *">Straße & Hausnummer *</label>
                                <input
                                    type="text"
                                    id="ship-street"
                                    required
                                    placeholder="Königsallee 42, 3. OG"
                                    data-i18n-placeholder-de="Königsallee 42, 3. OG"
                                    data-i18n-placeholder-en="10 Downing Street"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Postleitzahl (PLZ) *" data-i18n-en="Postal Code (PLZ) *">Postleitzahl (PLZ) *</label>
                                <input
                                    type="text"
                                    id="ship-plz"
                                    required
                                    placeholder="40212"
                                    data-i18n-placeholder-de="40212"
                                    data-i18n-placeholder-en="SW1A 2AA"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Stadt / Ort *" data-i18n-en="City *">Stadt / Ort *</label>
                                <input
                                    type="text"
                                    id="ship-city"
                                    required
                                    placeholder="Düsseldorf"
                                    data-i18n-placeholder-de="Düsseldorf"
                                    data-i18n-placeholder-en="London"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                >
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Land *" data-i18n-en="Country *">Land *</label>
                                <select
                                    id="ship-country"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs cursor-pointer"
                                >
                                    <option value="Deutschland">Deutschland 🇩🇪</option>
                                    <option value="Österreich">Österreich 🇦🇹</option>
                                    <option value="Schweiz">Schweiz 🇨🇭</option>
                                    <option value="Frankreich">Frankreich 🇫🇷</option>
                                    <option value="Vereinigtes Königreich">Vereinigtes Königreich 🇬🇧</option>
                                    <option value="Vereinigte Staaten">Vereinigte Staaten (USA) 🇺🇸</option>
                                    <option value="Saudi-Arabien">Saudi-Arabien 🇸🇦</option>
                                    <option value="Vereinigte Arabische Emirate">Vereinigte Arabische Emirate 🇦🇪</option>
                                </select>
                            </div>
                        </form>
                    </div>


                    <!-- 3. SHIPPING CARRIER SELECTION -->
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-xs space-y-4">
                        <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#78000b] text-white font-bold text-sm">3</div>
                            <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Versandart Wählen" data-i18n-en="Select Shipping Method">
                                Versandart Wählen
                            </h2>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <!-- Option 1: Standard Express -->
                            <label class="relative flex cursor-pointer rounded-md border-2 border-[#78000b] bg-[#faf7f2] p-4 shadow-xs transition hover:border-[#78000b]">
                                <input type="radio" name="shipping-method" value="express" checked class="mt-0.5 text-[#78000b] focus:ring-[#78000b]">
                                <div class="ml-3">
                                    <span class="block text-xs font-bold text-[#1c1210]" data-i18n-de="DHL Express Standard" data-i18n-en="DHL Express Standard">DHL Express Standard</span>
                                    <span class="block text-[0.68rem] text-[#685c54] mt-0.5" data-i18n-de="Lieferung in 1-2 Werktagen" data-i18n-en="Delivery in 1-2 business days">Lieferung in 1-2 Werktagen</span>
                                    <span class="inline-block mt-2 font-bold text-xs text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
                                </div>
                            </label>

                            <!-- Option 2: GoGreen Premium -->
                            <label class="relative flex cursor-pointer rounded-md border border-[#e6decb] bg-white p-4 shadow-xs transition hover:border-[#78000b]">
                                <input type="radio" name="shipping-method" value="gogreen" class="mt-0.5 text-[#78000b] focus:ring-[#78000b]">
                                <div class="ml-3">
                                    <span class="block text-xs font-bold text-[#1c1210]" data-i18n-de="DHL GoGreen Climate Neutral 🌿" data-i18n-en="DHL GoGreen Climate Neutral 🌿">DHL GoGreen Climate Neutral 🌿</span>
                                    <span class="block text-[0.68rem] text-[#685c54] mt-0.5" data-i18n-de="Inkl. Luxus-Geschenkbox & Seide" data-i18n-en="Incl. Luxury Gift Box & Silk">Inkl. Luxus-Geschenkbox & Seide</span>
                                    <span class="inline-block mt-2 font-bold text-xs text-[#78000b]">EUR 4,90</span>
                                </div>
                            </label>
                        </div>
                    </div>


                    <!-- 4. BANK TRANSFER (VORKASSE) & PAYMENT FORM -->
                    <div class="rounded-md border border-[#d8b45a]/50 bg-white p-6 sm:p-8 shadow-md space-y-6">
                        <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-4">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#78000b] text-white font-bold text-sm">4</div>
                            <div>
                                <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Zahlungsart & Banküberweisung" data-i18n-en="Payment Method & Bank Transfer">
                                    Zahlungsart & Banküberweisung
                                </h2>
                                <p class="text-xs text-[#685c54]" data-i18n-de="Wählen Sie Ihre bevorzugte Zahlungsart. Vorkasse / Banküberweisung wird bevorzugt verarbeitet." data-i18n-en="Choose your payment method. Bank Transfer is processed with priority.">
                                    Wählen Sie Ihre bevorzugte Zahlungsart. Vorkasse / Banküberweisung wird bevorzugt verarbeitet.
                                </p>
                            </div>
                        </div>

                        <!-- Payment Method Tabs -->
                        <div class="grid grid-cols-3 gap-2 border-b border-[#e6decb] pb-4">
                            <button
                                type="button"
                                id="tab-btn-bank"
                                onclick="switchPaymentTab('bank')"
                                class="flex items-center justify-center gap-2 rounded border-2 border-[#78000b] bg-[#78000b] px-3 py-2.5 text-xs font-bold text-white shadow-sm cursor-pointer transition"
                            >
                                <span>🏛️</span>
                                <span data-i18n-de="Banküberweisung (Vorkasse)" data-i18n-en="Bank Transfer (Prepayment)">Banküberweisung (Vorkasse)</span>
                            </button>

                            <button
                                type="button"
                                id="tab-btn-card"
                                onclick="switchPaymentTab('card')"
                                class="flex items-center justify-center gap-2 rounded border border-[#e6decb] bg-[#faf7f2] px-3 py-2.5 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition"
                            >
                                <span>💳</span>
                                <span data-i18n-de="Kreditkarte" data-i18n-en="Credit Card">Kreditkarte</span>
                            </button>

                            <button
                                type="button"
                                id="tab-btn-paypal"
                                onclick="switchPaymentTab('paypal')"
                                class="flex items-center justify-center gap-2 rounded border border-[#e6decb] bg-[#faf7f2] px-3 py-2.5 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition"
                            >
                                <span>🅿️</span>
                                <span>PayPal / Klarna</span>
                            </button>
                        </div>

                        <!-- TAB CONTENT 1: BANK TRANSFER (VORKASSE) FORM -->
                        <div id="payment-content-bank" class="space-y-5">
                            
                            <!-- Official Bank Details Display Box -->
                            <div class="rounded-md border border-[#d8b45a]/60 bg-gradient-to-br from-[#faf7f2] via-[#f7f2e6] to-[#faf7f2] p-5 shadow-xs relative overflow-hidden">
                                <div class="flex items-center justify-between border-b border-[#d8b45a]/30 pb-3 mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base">🏛️</span>
                                        <h3 class="font-display text-base font-bold text-[#1c1210]" data-i18n-de="MEHAAJ Bankverbindung für Überweisung" data-i18n-en="MEHAAJ Official Bank Details">
                                            MEHAAJ Bankverbindung für Überweisung
                                        </h3>
                                    </div>
                                    <span class="rounded bg-[#78000b] px-2.5 py-0.5 text-[0.62rem] font-bold text-white uppercase tracking-wider">Offizielles Konto</span>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2 text-xs">
                                    <div>
                                        <p class="text-[0.68rem] text-[#685c54] font-semibold uppercase tracking-wider" data-i18n-de="Empfänger / Kontoinhaber" data-i18n-en="Payee / Account Holder">Empfänger / Kontoinhaber</p>
                                        <p class="font-bold text-[#1c1210] mt-0.5">MEHAAJ Luxury Leather GmbH</p>
                                    </div>

                                    <div>
                                        <p class="text-[0.68rem] text-[#685c54] font-semibold uppercase tracking-wider" data-i18n-de="Bankinstitut" data-i18n-en="Bank Name">Bankinstitut</p>
                                        <p class="font-bold text-[#1c1210] mt-0.5">Deutsche Bank AG Frankfurt</p>
                                    </div>

                                    <div class="sm:col-span-2 flex items-center justify-between rounded border border-[#d8b45a]/40 bg-white p-3 shadow-xs">
                                        <div>
                                            <p class="text-[0.65rem] text-[#78000b] font-bold uppercase tracking-wider" data-i18n-de="IBAN für Überweisung" data-i18n-en="IBAN for Transfer">IBAN für Überweisung</p>
                                            <p id="bank-iban-code" class="font-mono text-sm font-bold text-[#1c1210] tracking-wider mt-0.5">DE89 3704 0044 0532 0130 00</p>
                                        </div>
                                        <button
                                            type="button"
                                            onclick="copyIbanToClipboard()"
                                            class="rounded bg-[#78000b]/10 hover:bg-[#78000b] hover:text-white px-3 py-1.5 text-xs font-bold text-[#78000b] transition cursor-pointer flex items-center gap-1.5"
                                        >
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                            <span data-i18n-de="Kopieren" data-i18n-en="Copy">Kopieren</span>
                                        </button>
                                    </div>

                                    <div>
                                        <p class="text-[0.68rem] text-[#685c54] font-semibold uppercase tracking-wider">BIC / SWIFT</p>
                                        <p class="font-mono font-bold text-[#1c1210] mt-0.5">DABA DE FF XXX</p>
                                    </div>

                                    <div>
                                        <p class="text-[0.68rem] text-[#78000b] font-semibold uppercase tracking-wider" data-i18n-de="Verwendungszweck (Order ID)" data-i18n-en="Payment Reference (Order ID)">Verwendungszweck (Order ID)</p>
                                        <p id="bank-order-ref" class="font-mono font-bold text-[#78000b] mt-0.5">MHJ-2026-8942</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Bank Form Data Collection -->
                            <div class="space-y-4 pt-2 border-t border-[#f2ebdc]">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-[#1c1210]" data-i18n-de="Angaben zum überweisenden Bankkonto (Optional)" data-i18n-en="Sender Bank Account Details (Optional)">
                                    Angaben zum überweisenden Bankkonto (Optional)
                                </h4>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-[0.7rem] font-bold text-[#685c54] mb-1" data-i18n-de="Name des Kontoinhabers" data-i18n-en="Payer Account Holder Name">Name des Kontoinhabers</label>
                                        <input
                                            type="text"
                                            id="payer-name"
                                            placeholder="z. B. Maximilian Mustermann"
                                            data-i18n-placeholder-de="z. B. Maximilian Mustermann"
                                            data-i18n-placeholder-en="e.g. Alexander Smith"
                                            class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"
                                        >
                                    </div>

                                    <div>
                                        <label class="block text-[0.7rem] font-bold text-[#685c54] mb-1" data-i18n-de="Ihre IBAN / Bank (Für Zuordnung)" data-i18n-en="Your IBAN / Bank (For matching)">Ihre IBAN / Bank (Für Zuordnung)</label>
                                        <input
                                            type="text"
                                            id="payer-iban"
                                            placeholder="DE89 XXXX XXXX XXXX XXXX XX"
                                            class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"
                                        >
                                    </div>
                                </div>

                                <label class="flex items-start gap-2.5 cursor-pointer pt-1">
                                    <input type="checkbox" id="bank-confirm-check" checked class="mt-0.5 rounded text-[#78000b] focus:ring-[#78000b]">
                                    <span class="text-xs text-[#5c4f46]" data-i18n-de="Ich bestätige, dass ich den Betrag innerhalb von 3 Werktagen auf das oben genannte Konto mit dem Verwendungszweck überweisen werde." data-i18n-en="I confirm that I will transfer the total amount within 3 business days using the specified payment reference.">
                                        Ich bestätige, dass ich den Betrag innerhalb von 3 Werktagen auf das oben genannte Konto mit dem Verwendungszweck überweisen werde.
                                    </span>
                                </label>
                            </div>

                        </div>

                        <!-- TAB CONTENT 2: CREDIT CARD FORM (Hidden by default) -->
                        <div id="payment-content-card" class="hidden space-y-4">
                            <div class="rounded border border-[#e6decb] bg-[#faf7f2] p-4 text-xs space-y-3">
                                <div>
                                    <label class="block font-bold text-[#1c1210] mb-1" data-i18n-de="Kartennummer" data-i18n-en="Card Number">Kartennummer</label>
                                    <input type="text" placeholder="4532 •••• •••• 8921" class="w-full rounded border border-[#e6decb] bg-white p-2 text-xs">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block font-bold text-[#1c1210] mb-1">Ablaufdatum</label>
                                        <input type="text" placeholder="MM/YY" class="w-full rounded border border-[#e6decb] bg-white p-2 text-xs">
                                    </div>
                                    <div>
                                        <label class="block font-bold text-[#1c1210] mb-1">CVC / CWW</label>
                                        <input type="text" placeholder="352" class="w-full rounded border border-[#e6decb] bg-white p-2 text-xs">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB CONTENT 3: PAYPAL (Hidden by default) -->
                        <div id="payment-content-paypal" class="hidden space-y-4">
                            <div class="rounded border border-[#e6decb] bg-[#faf7f2] p-6 text-center text-xs space-y-3">
                                <p class="font-bold text-[#1c1210]" data-i18n-de="Sie werden nach Bestellung zu PayPal / Klarna weitergeleitet." data-i18n-en="You will be redirected to PayPal / Klarna after placing your order.">
                                    Sie werden nach Bestellung zu PayPal / Klarna weitergeleitet.
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Continue Shopping Link -->
                    <div class="flex items-center justify-between pt-2">
                        <a href="/shop" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#78000b] hover:underline cursor-pointer">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5m6 6-6-6 6-6"/>
                            </svg>
                            <span data-i18n-de="Einkauf fortsetzen" data-i18n-en="Continue Shopping">Einkauf fortsetzen</span>
                        </a>
                    </div>
                </div>


                <!-- Right Column: Order Summary & Complete Checkout CTA (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-md space-y-5 sticky top-24">
                        <h2 class="font-display text-xl font-medium text-[#1c1210] border-b border-[#f2ebdc] pb-3" data-i18n-de="Bestellübersicht" data-i18n-en="Order Summary">
                            Bestellübersicht
                        </h2>

                        <!-- Voucher Input -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-2" data-i18n-de="Gutscheincode" data-i18n-en="Promo Code">Gutscheincode</label>
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    id="page-voucher-input"
                                    placeholder="MEHAAJ10"
                                    class="flex-1 rounded border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"
                                >
                                <button type="button" onclick="applyPageVoucher()" class="rounded bg-[#78000b] px-4 py-2 text-xs font-bold uppercase tracking-wider text-white hover:bg-[#5a0309] cursor-pointer" data-i18n-de="EINLÖSEN" data-i18n-en="APPLY">EINLÖSEN</button>
                            </div>
                            <p id="page-voucher-success" class="hidden text-[0.65rem] font-bold text-[#2e683a] mt-1.5" data-i18n-de="Gutschein MEHAAJ10 (-10%) angewendet! ✓" data-i18n-en="Voucher MEHAAJ10 (-10%) applied! ✓">Gutschein MEHAAJ10 (-10%) angewendet! ✓</p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-2 text-xs text-[#5c4f46] border-t border-[#f2ebdc] pt-4">
                            <div class="flex justify-between">
                                <span data-i18n-de="Zwischensumme" data-i18n-en="Subtotal">Zwischensumme</span>
                                <span id="page-subtotal" class="font-bold text-[#1c1210]">EUR 418,00</span>
                            </div>
                            <div class="flex justify-between text-[0.7rem] text-[#685c54]">
                                <span data-i18n-de="inkl. 19% MwSt." data-i18n-en="incl. 19% VAT">inkl. 19% MwSt.</span>
                                <span id="page-vat">EUR 66,74</span>
                            </div>
                            <div class="flex justify-between">
                                <span data-i18n-de="Versand (DHL Express)" data-i18n-en="Shipping (DHL Express)">Versand (DHL Express)</span>
                                <span class="font-bold text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-[#1c1210] border-t border-[#e6decb] pt-3">
                                <span data-i18n-de="Gesamtsumme" data-i18n-en="Total">Gesamtsumme</span>
                                <span id="page-total" class="text-[#78000b]">EUR 418,00</span>
                            </div>
                        </div>

                        <!-- Selected Payment Method Badge -->
                        <div class="rounded bg-[#faf7f2] border border-[#e6decb] p-3 text-center text-xs">
                            <span class="text-[0.65rem] text-[#685c54] uppercase tracking-wider block" data-i18n-de="Zahlungsmethode" data-i18n-en="Payment Method">Zahlungsmethode</span>
                            <span id="selected-payment-display" class="font-bold text-[#78000b]" data-i18n-de="🏛️ Vorkasse / Banküberweisung" data-i18n-en="🏛️ Bank Transfer / Prepayment">
                                🏛️ Vorkasse / Banküberweisung
                            </span>
                        </div>

                        <!-- Main Checkout CTA -->
                        <button
                            type="button"
                            onclick="triggerPageCheckout()"
                            class="w-full flex h-14 items-center justify-center gap-2 rounded bg-[#78000b] px-6 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-lg transition-all duration-300 hover:bg-[#5a0309] hover:shadow-2xl active:scale-95 cursor-pointer"
                        >
                            <span id="checkout-cta-text" data-i18n-de="JETZT ZAHLUNGSPFLICHTIG BESTELLEN" data-i18n-en="PLACE BINDING ORDER NOW">JETZT ZAHLUNGSPFLICHTIG BESTELLEN</span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <!-- Trust Icons -->
                        <div class="border-t border-[#f2ebdc] pt-4 grid grid-cols-3 gap-2 text-center text-[0.6rem] text-[#685c54]">
                            <div>🔒 256-Bit SSL</div>
                            <div>🛡️ 30 Tage Retoure</div>
                            <div>🚚 DHL Express</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Page Specific Cart JS with Full Form Validation & Bank Transfer Modal -->
    <script>
        let pageCartTotal = 418.00;
        let selectedPaymentTab = 'bank';
        let currentOrderRef = 'MHJ-2026-' + Math.floor(1000 + Math.random() * 9000);

        document.addEventListener('DOMContentLoaded', () => {
            const refEl = document.getElementById('bank-order-ref');
            if (refEl) refEl.innerText = currentOrderRef;
        });

        function switchPaymentTab(tab) {
            selectedPaymentTab = tab;
            const bankBtn = document.getElementById('tab-btn-bank');
            const cardBtn = document.getElementById('tab-btn-card');
            const paypalBtn = document.getElementById('tab-btn-paypal');

            const bankContent = document.getElementById('payment-content-bank');
            const cardContent = document.getElementById('payment-content-card');
            const paypalContent = document.getElementById('payment-content-paypal');

            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            const displayEl = document.getElementById('selected-payment-display');

            [bankBtn, cardBtn, paypalBtn].forEach(btn => {
                btn.className = 'flex items-center justify-center gap-2 rounded border border-[#e6decb] bg-[#faf7f2] px-3 py-2.5 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition';
            });

            bankContent.classList.add('hidden');
            cardContent.classList.add('hidden');
            paypalContent.classList.add('hidden');

            if (tab === 'bank') {
                bankBtn.className = 'flex items-center justify-center gap-2 rounded border-2 border-[#78000b] bg-[#78000b] px-3 py-2.5 text-xs font-bold text-white shadow-sm cursor-pointer transition';
                bankContent.classList.remove('hidden');
                displayEl.innerText = isEn ? '🏛️ Bank Transfer / Prepayment' : '🏛️ Vorkasse / Banküberweisung';
            } else if (tab === 'card') {
                cardBtn.className = 'flex items-center justify-center gap-2 rounded border-2 border-[#78000b] bg-[#78000b] px-3 py-2.5 text-xs font-bold text-white shadow-sm cursor-pointer transition';
                cardContent.classList.remove('hidden');
                displayEl.innerText = isEn ? '💳 Credit Card (Visa/MC)' : '💳 Kreditkarte (Visa/MC)';
            } else {
                paypalBtn.className = 'flex items-center justify-center gap-2 rounded border-2 border-[#78000b] bg-[#78000b] px-3 py-2.5 text-xs font-bold text-white shadow-sm cursor-pointer transition';
                paypalContent.classList.remove('hidden');
                displayEl.innerText = isEn ? '🅿️ PayPal / Klarna' : '🅿️ PayPal / Klarna';
            }
        }

        function copyIbanToClipboard() {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            navigator.clipboard.writeText('DE89 3704 0044 0532 0130 00').then(() => {
                LuxuryToast.fire({
                    icon: 'success',
                    title: isEn ? 'IBAN copied to clipboard! 📋' : 'IBAN in die Zwischenablage kopiert! 📋'
                });
            });
        }

        function updatePageQty(btn, change, price) {
            const item = btn.closest('.cart-page-item');
            const qtyEl = item.querySelector('.qty-page');
            let qty = parseInt(qtyEl.innerText) + change;
            if (qty < 1) qty = 1;
            qtyEl.innerText = qty;
            item.querySelector('.item-total').innerText = 'EUR ' + (qty * price).toFixed(2).replace('.', ',');

            recalcPageCart();
        }

        function removePageItem(btn) {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            LuxurySwal.fire({
                title: isEn ? 'Remove Item?' : 'Artikel entfernen?',
                text: isEn ? 'Are you sure you want to remove this item?' : 'Möchten Sie diesen Artikel wirklich entfernen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: isEn ? 'Yes, remove' : 'Ja, entfernen',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('.cart-page-item').remove();
                    recalcPageCart();
                    LuxuryToast.fire({
                        icon: 'success',
                        title: isEn ? 'Item removed' : 'Artikel entfernt'
                    });
                }
            });
        }

        function recalcPageCart() {
            let total = 0;
            let itemsCount = document.querySelectorAll('.cart-page-item').length;
            
            document.querySelectorAll('.cart-page-item').forEach(item => {
                const priceText = item.querySelector('.item-total').innerText.replace('EUR ', '').replace(',', '.');
                total += parseFloat(priceText) || 0;
            });

            pageCartTotal = total;
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

            const countEl = document.getElementById('page-item-count');
            if (countEl) countEl.innerText = itemsCount + (isEn ? ' Items' : ' Artikel');

            document.getElementById('page-subtotal').innerText = 'EUR ' + total.toFixed(2).replace('.', ',');
            document.getElementById('page-vat').innerText = 'EUR ' + (total * 0.19).toFixed(2).replace('.', ',');
            document.getElementById('page-total').innerText = 'EUR ' + total.toFixed(2).replace('.', ',');
        }

        function applyPageVoucher() {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            const input = document.getElementById('page-voucher-input').value.trim();
            const msg = document.getElementById('page-voucher-success');

            if (input.toUpperCase() === 'MEHAAJ10') {
                pageCartTotal = pageCartTotal * 0.9;
                document.getElementById('page-total').innerText = 'EUR ' + pageCartTotal.toFixed(2).replace('.', ',');
                msg.classList.remove('hidden');
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Voucher Code Applied! 🎉' : 'Gutscheincode Eingelöst! 🎉',
                    text: isEn ? '10% discount has been successfully applied to your order.' : '10% Rabatt wurden erfolgreich angewendet.',
                    confirmButtonText: isEn ? 'Wonderful' : 'Wunderbar'
                });
            } else {
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Invalid Code' : 'Ungültiger Code',
                    text: isEn ? 'Please try the voucher code: MEHAAJ10' : 'Bitte versuchen Sie den Gutscheincode: MEHAAJ10',
                    confirmButtonText: isEn ? 'Try Again' : 'Erneut versuchen'
                });
            }
        }

        function triggerPageCheckout() {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

            // Shipping Form Validation
            const firstName = document.getElementById('ship-first-name').value.trim();
            const lastName = document.getElementById('ship-last-name').value.trim();
            const email = document.getElementById('ship-email').value.trim();
            const phone = document.getElementById('ship-phone').value.trim();
            const street = document.getElementById('ship-street').value.trim();
            const plz = document.getElementById('ship-plz').value.trim();
            const city = document.getElementById('ship-city').value.trim();
            const country = document.getElementById('ship-country').value;

            if (!firstName || !lastName || !email || !phone || !street || !plz || !city) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: isEn ? 'Missing Shipping Data' : 'Unvollständige Lieferadresse',
                    text: isEn 
                        ? 'Please fill out all required shipping address fields (First Name, Last Name, Email, Phone, Street, Zip, City).' 
                        : 'Bitte füllen Sie alle erforderlichen Felder der Lieferadresse aus (Vorname, Nachname, E-Mail, Telefon, Straße, PLZ, Stadt).',
                    confirmButtonText: isEn ? 'Complete Form' : 'Formular Vervollständigen'
                });
                return;
            }

            // Bank Transfer Order Modal
            if (selectedPaymentTab === 'bank') {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Order Received! 🎉' : 'Bestellung Erfolgreich! 🎉',
                    html: `
                        <div class="text-left space-y-3 mt-3 text-xs">
                            <p class="text-neutral-700 font-medium">
                                ${isEn 
                                    ? `Thank you <b>${firstName} ${lastName}</b>! Your order has been registered.` 
                                    : `Vielen Dank <b>${firstName} ${lastName}</b>! Ihre Bestellung wurde verbindlich entgegengenommen.`}
                            </p>
                            
                            <div class="rounded border border-[#d8b45a] bg-white p-3 space-y-1.5">
                                <p class="text-[0.65rem] font-bold text-[#78000b] uppercase tracking-wider">${isEn ? 'Payment Instructions (Bank Transfer)' : 'Zahlungsanweisung (Banküberweisung)'}</p>
                                <p><b>${isEn ? 'Order Reference:' : 'Verwendungszweck:'}</b> <span class="font-mono text-[#78000b] font-bold">${currentOrderRef}</span></p>
                                <p><b>${isEn ? 'Payee:' : 'Empfänger:'}</b> MEHAAJ Luxury Leather GmbH</p>
                                <p><b>IBAN:</b> <span class="font-mono font-bold">DE89 3704 0044 0532 0130 00</span></p>
                                <p><b>BIC:</b> <span class="font-mono">DABA DE FF XXX</span></p>
                                <p><b>${isEn ? 'Total Amount:' : 'Gesamtbetrag:'}</b> <span class="font-bold text-[#78000b]">EUR ${pageCartTotal.toFixed(2).replace('.', ',')}</span></p>
                            </div>

                            <p class="text-[0.68rem] text-neutral-500">
                                ${isEn 
                                    ? `Confirmation details sent to <b>${email}</b>. Delivery to: ${street}, ${plz} ${city} (${country}).` 
                                    : `Bestellbestätigung wurde an <b>${email}</b> gesendet. Lieferung an: ${street}, ${plz} ${city} (${country}).`}
                            </p>
                        </div>
                    `,
                    confirmButtonText: isEn ? '📋 Copy IBAN & Finish' : '📋 IBAN Kopieren & Abschließen',
                    showCancelButton: true,
                    cancelButtonText: isEn ? 'Close' : 'Schließen'
                }).then((res) => {
                    if (res.isConfirmed) {
                        navigator.clipboard.writeText('DE89 3704 0044 0532 0130 00');
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'IBAN copied! Order confirmed.' : 'IBAN kopiert! Bestellung bestätigt.'
                        });
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1200);
                    }
                });
            } else {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Order Completed! 🎉' : 'Bestellung Erfolgreich! 🎉',
                    text: isEn 
                        ? 'Thank you for your order at MEHAAJ. Your confirmation has been sent to ' + email 
                        : 'Vielen Dank für Ihren Einkauf bei MEHAAJ. Ihre Bestellbestätigung wurde an ' + email + ' gesendet.',
                    confirmButtonText: isEn ? 'Return Home' : 'Zur Startseite'
                }).then(() => {
                    window.location.href = '/';
                });
            }
        }
    </script>

</div>
@endsection
