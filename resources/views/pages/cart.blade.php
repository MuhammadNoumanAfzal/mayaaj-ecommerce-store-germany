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

    <!-- Multi-Step Checkout Wizard Section -->
    <section class="py-8 lg:py-12" id="checkout-wizard-section">
        <div class="luxury-container">

            <!-- STEP PROGRESS INDICATOR HEADER BAR -->
            <div class="mb-10 rounded-xl border border-[#e6decb] bg-white p-6 shadow-md">
                <div class="relative flex items-center justify-between max-w-4xl mx-auto">
                    
                    <!-- Progress Bar Track Line -->
                    <div class="absolute top-1/2 left-0 right-0 h-1 bg-[#f2ebdc] -translate-y-1/2 z-0"></div>
                    <!-- Active Progress Line -->
                    <div id="wizard-progress-line" class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b] -translate-y-1/2 z-0 transition-all duration-500" style="width: 0%;"></div>

                    <!-- Step 1: Cart Items -->
                    <button type="button" onclick="goToStep(1)" id="step-nav-1" class="relative z-10 flex flex-col items-center gap-2 group cursor-pointer">
                        <div id="step-badge-1" class="h-11 w-11 rounded-full bg-[#78000b] text-white flex items-center justify-center font-bold text-sm shadow-lg border-2 border-white transition-all duration-300 ring-4 ring-[#78000b]/20">
                            1
                        </div>
                        <div class="text-center">
                            <span class="block text-xs font-bold text-[#1c1210] group-hover:text-[#78000b] transition" data-i18n-de="Warenkorb" data-i18n-en="Cart">Warenkorb</span>
                            <span class="hidden sm:block text-[0.68rem] text-[#685c54]" data-i18n-de="Artikel wählen" data-i18n-en="Select items">Artikel wählen</span>
                        </div>
                    </button>

                    <!-- Step 2: Shipping Address -->
                    <button type="button" onclick="goToStep(2)" id="step-nav-2" class="relative z-10 flex flex-col items-center gap-2 group cursor-pointer">
                        <div id="step-badge-2" class="h-11 w-11 rounded-full bg-[#faf7f2] text-[#8a7c74] flex items-center justify-center font-bold text-sm shadow-sm border-2 border-[#e6decb] transition-all duration-300">
                            2
                        </div>
                        <div class="text-center">
                            <span class="block text-xs font-bold text-[#685c54] group-hover:text-[#78000b] transition" data-i18n-de="Lieferadresse" data-i18n-en="Address">Lieferadresse</span>
                            <span class="hidden sm:block text-[0.68rem] text-[#8a7c74]" data-i18n-de="Kontaktdaten" data-i18n-en="Contact info">Kontaktdaten</span>
                        </div>
                    </button>

                    <!-- Step 3: Payment & Shipping -->
                    <button type="button" onclick="goToStep(3)" id="step-nav-3" class="relative z-10 flex flex-col items-center gap-2 group cursor-pointer">
                        <div id="step-badge-3" class="h-11 w-11 rounded-full bg-[#faf7f2] text-[#8a7c74] flex items-center justify-center font-bold text-sm shadow-sm border-2 border-[#e6decb] transition-all duration-300">
                            3
                        </div>
                        <div class="text-center">
                            <span class="block text-xs font-bold text-[#685c54] group-hover:text-[#78000b] transition" data-i18n-de="Zahlung" data-i18n-en="Payment">Zahlung</span>
                            <span class="hidden sm:block text-[0.68rem] text-[#8a7c74]" data-i18n-de="Versand & Bank" data-i18n-en="Carrier & Bank">Versand & Bank</span>
                        </div>
                    </button>

                    <!-- Step 4: Final Confirmation -->
                    <button type="button" onclick="goToStep(4)" id="step-nav-4" class="relative z-10 flex flex-col items-center gap-2 group cursor-pointer">
                        <div id="step-badge-4" class="h-11 w-11 rounded-full bg-[#faf7f2] text-[#8a7c74] flex items-center justify-center font-bold text-sm shadow-sm border-2 border-[#e6decb] transition-all duration-300">
                            4
                        </div>
                        <div class="text-center">
                            <span class="block text-xs font-bold text-[#685c54] group-hover:text-[#78000b] transition" data-i18n-de="Bestätigung" data-i18n-en="Review">Bestätigung</span>
                            <span class="hidden sm:block text-[0.68rem] text-[#8a7c74]" data-i18n-de="Bestellung prüfen" data-i18n-en="Final Check">Bestellung prüfen</span>
                        </div>
                    </button>

                </div>
            </div>

            <!-- MAIN GRID CONTENT (Left: Wizard Panels, Right: Order Summary Sidebar) -->
            <div class="grid gap-8 lg:grid-cols-12 lg:items-start">

                <!-- LEFT COLUMN: MULTI-STEP PANELS (8 COLS) -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- ========================================== -->
                    <!-- STEP 1 PANEL: CART ITEMS & SELECTION -->
                    <!-- ========================================== -->
                    <div id="wizard-panel-1" class="wizard-step-panel transition-all duration-500 opacity-100 block">
                        <div class="rounded-xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-md space-y-6">
                            <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🛍️</span>
                                    <div>
                                        <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="1. Gewählte Luxus-Artikel" data-i18n-en="1. Selected Luxury Items">
                                            1. Gewählte Luxus-Artikel
                                        </h2>
                                        <p class="text-xs text-[#685c54]" data-i18n-de="Überprüfen Sie Ihre ausgewählten Produkte und Mengen." data-i18n-en="Review your selected products and quantities.">
                                            Überprüfen Sie Ihre ausgewählten Produkte und Mengen.
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs text-[#78000b] font-bold bg-[#78000b]/10 px-3 py-1 rounded-full" id="page-item-count">
                                    {{ $count ?? count($cart ?? []) }} {{ ($count ?? count($cart ?? [])) === 1 ? 'Artikel' : 'Artikel' }}
                                </span>
                            </div>

                            <!-- Table Header -->
                            <div class="hidden sm:grid grid-cols-12 text-xs font-bold uppercase tracking-wider text-[#685c54] border-b border-[#f2ebdc] pb-3">
                                <span class="col-span-6" data-i18n-de="Produkt" data-i18n-en="Product">Produkt</span>
                                <span class="col-span-3 text-center" data-i18n-de="Anzahl" data-i18n-en="Quantity">Anzahl</span>
                                <span class="col-span-3 text-right" data-i18n-de="Gesamt" data-i18n-en="Total">Gesamt</span>
                            </div>

                            <!-- Dynamic Items List -->
                            <div id="page-cart-items-wrapper" class="divide-y divide-[#f2ebdc]">
                                @forelse($cart ?? [] as $item)
                                    <div class="cart-page-item sm:grid sm:grid-cols-12 items-center gap-4 py-4 space-y-3 sm:space-y-0 hover:bg-[#faf7f2]/60 rounded-lg p-2 transition" data-product-id="{{ $item['id'] }}">
                                        <div class="sm:col-span-6 flex items-center gap-4">
                                            <img src="{{ $item['image_url'] ?? '/productbag.png' }}" alt="{{ $item['name'] }}" class="h-20 w-20 rounded-lg border border-[#e6decb] object-cover bg-[#f7f4ee] shadow-xs">
                                            <div>
                                                <h3 class="font-display text-base font-medium text-[#1c1210]">{{ $item['name'] }}</h3>
                                                <p class="text-xs text-[#685c54]">SKU: {{ $item['sku'] ?? 'MHJ-MANUFAKTUR' }}</p>
                                                <p class="text-xs text-[#78000b] font-bold mt-1">EUR {{ number_format($item['price'], 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3 flex items-center justify-between sm:justify-center">
                                            <div class="flex h-8 items-center rounded border border-[#e6decb] bg-white px-2 w-24 justify-between text-xs shadow-xs">
                                                <button type="button" onclick="updatePageQty({{ $item['id'] }}, {{ $item['qty'] - 1 }})" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer transition active:scale-90">-</button>
                                                <span class="qty-page font-bold text-[#1c1210]">{{ $item['qty'] }}</span>
                                                <button type="button" onclick="updatePageQty({{ $item['id'] }}, {{ $item['qty'] + 1 }})" class="w-6 text-center font-bold hover:text-[#78000b] cursor-pointer transition active:scale-90">+</button>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3 flex items-center justify-between sm:justify-end gap-3">
                                            <span class="font-bold text-base text-[#1c1210] item-total">EUR {{ number_format($item['price'] * $item['qty'], 2, ',', '.') }}</span>
                                            <button type="button" onclick="removePageItem({{ $item['id'] }})" class="text-[#8a7c74] hover:text-[#78000b] transition-transform hover:scale-110 cursor-pointer" title="Remove item">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-12 text-center space-y-4">
                                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#faf7f2] border border-[#e6decb]">
                                            <svg class="h-8 w-8 text-[#8a7c74]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M6.5 8.5h11l1 11h-13l1-11Z" stroke-linejoin="round"/>
                                                <path d="M9 8.5a3 3 0 0 1 6 0" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <p class="font-display text-lg font-medium text-[#1c1210]">Ihr Warenkorb ist derzeit leer.</p>
                                        <a href="/shop" class="inline-flex items-center justify-center rounded bg-[#78000b] px-6 py-3 text-xs font-bold uppercase tracking-wider text-white hover:bg-[#5a0309] transition shadow-md">
                                            Kollektion Entdecken & Einkaufen
                                        </a>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Step 1 Actions Navigation -->
                            <div class="flex items-center justify-between pt-6 border-t border-[#f2ebdc]">
                                <a href="/shop" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#685c54] hover:text-[#78000b] transition">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                                    <span data-i18n-de="Einkauf fortsetzen" data-i18n-en="Continue Shopping">Einkauf fortsetzen</span>
                                </a>

                                <button type="button" onclick="goToStep(2)" class="inline-flex items-center gap-2 rounded bg-[#78000b] px-6 py-3 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-xl transition-all duration-300 cursor-pointer active:scale-95">
                                    <span data-i18n-de="WEITER ZUR LIEFERADRESSE" data-i18n-en="PROCEED TO SHIPPING">WEITER ZUR LIEFERADRESSE</span>
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- STEP 2 PANEL: SHIPPING ADDRESS & CONTACT -->
                    <!-- ========================================== -->
                    <div id="wizard-panel-2" class="wizard-step-panel transition-all duration-500 opacity-0 hidden">
                        <div class="rounded-xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-md space-y-6">
                            <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-4">
                                <span class="text-2xl">📍</span>
                                <div>
                                    <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="2. Lieferadresse & Kontaktdaten" data-i18n-en="2. Shipping Address & Contact Info">
                                        2. Lieferadresse & Kontaktdaten
                                    </h2>
                                    <p class="text-xs text-[#685c54]" data-i18n-de="Bitte geben Sie Ihre Daten für den DHL Express Versand ein." data-i18n-en="Please enter your address for DHL Express delivery.">
                                        Bitte geben Sie Ihre Daten für den DHL Express Versand ein.
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
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Nachname *" data-i18n-en="Last Name *">Nachname *</label>
                                    <input
                                        type="text"
                                        id="ship-last-name"
                                        required
                                        placeholder="Mustermann"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="E-Mail-Adresse *" data-i18n-en="Email Address *">E-Mail-Adresse *</label>
                                    <input
                                        type="email"
                                        id="ship-email"
                                        required
                                        placeholder="maximilian@beispiel.de"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Telefonnummer *" data-i18n-en="Phone Number *">Telefonnummer *</label>
                                    <input
                                        type="tel"
                                        id="ship-phone"
                                        required
                                        placeholder="+49 170 1234567"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Straße & Hausnummer *" data-i18n-en="Street Address & House No. *">Straße & Hausnummer *</label>
                                    <input
                                        type="text"
                                        id="ship-street"
                                        required
                                        placeholder="Königsallee 42, 3. OG"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Postleitzahl (PLZ) *" data-i18n-en="Postal Code (PLZ) *">Postleitzahl (PLZ) *</label>
                                    <input
                                        type="text"
                                        id="ship-plz"
                                        required
                                        placeholder="40212"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Stadt / Ort *" data-i18n-en="City *">Stadt / Ort *</label>
                                    <input
                                        type="text"
                                        id="ship-city"
                                        required
                                        placeholder="Düsseldorf"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs transition"
                                    >
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" data-i18n-de="Land *" data-i18n-en="Country *">Land *</label>
                                    <select
                                        id="ship-country"
                                        class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs cursor-pointer"
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

                            <!-- Step 2 Actions Navigation -->
                            <div class="flex items-center justify-between pt-6 border-t border-[#f2ebdc]">
                                <button type="button" onclick="goToStep(1)" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#685c54] hover:text-[#78000b] transition cursor-pointer">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                                    <span data-i18n-de="ZURÜCK ZUM WARENKORB" data-i18n-en="BACK TO CART">ZURÜCK ZUM WARENKORB</span>
                                </button>

                                <button type="button" onclick="validateAndGoToStep3()" class="inline-flex items-center gap-2 rounded bg-[#78000b] px-6 py-3 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-xl transition-all duration-300 cursor-pointer active:scale-95">
                                    <span data-i18n-de="WEITER ZUR ZAHLUNGSART" data-i18n-en="PROCEED TO PAYMENT">WEITER ZUR ZAHLUNGSART</span>
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- STEP 3 PANEL: SHIPPING METHOD & PAYMENT -->
                    <!-- ========================================== -->
                    <div id="wizard-panel-3" class="wizard-step-panel transition-all duration-500 opacity-0 hidden">
                        <div class="rounded-xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-md space-y-8">
                            
                            <!-- 3.1 SHIPPING METHOD -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-3">
                                    <span class="text-2xl">🚚</span>
                                    <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="3. Versandart Wählen" data-i18n-en="3. Select Shipping Method">
                                        3. Versandart Wählen
                                    </h2>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <!-- Option 1: Standard Express -->
                                    <label class="relative flex cursor-pointer rounded-xl border-2 border-[#78000b] bg-[#faf7f2] p-4 shadow-xs transition hover:border-[#78000b]">
                                        <input type="radio" name="shipping-method" value="express" checked class="mt-0.5 text-[#78000b] focus:ring-[#78000b]">
                                        <div class="ml-3">
                                            <span class="block text-xs font-bold text-[#1c1210]" data-i18n-de="DHL Express Standard" data-i18n-en="DHL Express Standard">DHL Express Standard</span>
                                            <span class="block text-[0.68rem] text-[#685c54] mt-0.5" data-i18n-de="Lieferung in 1-2 Werktagen" data-i18n-en="Delivery in 1-2 business days">Lieferung in 1-2 Werktagen</span>
                                            <span class="inline-block mt-2 font-bold text-xs text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
                                        </div>
                                    </label>

                                    <!-- Option 2: GoGreen Premium -->
                                    <label class="relative flex cursor-pointer rounded-xl border border-[#e6decb] bg-white p-4 shadow-xs transition hover:border-[#78000b]">
                                        <input type="radio" name="shipping-method" value="gogreen" class="mt-0.5 text-[#78000b] focus:ring-[#78000b]">
                                        <div class="ml-3">
                                            <span class="block text-xs font-bold text-[#1c1210]" data-i18n-de="DHL GoGreen Climate Neutral 🌿" data-i18n-en="DHL GoGreen Climate Neutral 🌿">DHL GoGreen Climate Neutral 🌿</span>
                                            <span class="block text-[0.68rem] text-[#685c54] mt-0.5" data-i18n-de="Inkl. Luxus-Geschenkbox & Seide" data-i18n-en="Incl. Luxury Gift Box & Silk">Inkl. Luxus-Geschenkbox & Seide</span>
                                            <span class="inline-block mt-2 font-bold text-xs text-[#78000b]">EUR 4,90</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- 3.2 PAYMENT METHOD SELECTION -->
                            <div class="space-y-6 pt-4 border-t border-[#f2ebdc]">
                                <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-3">
                                    <span class="text-2xl">💳</span>
                                    <div>
                                        <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Zahlungsart & Banküberweisung" data-i18n-en="Payment Method & Bank Details">
                                            Zahlungsart & Banküberweisung
                                        </h2>
                                        <p class="text-xs text-[#685c54]" data-i18n-de="Wählen Sie Ihre bevorzugte Zahlungsmethode." data-i18n-en="Choose your preferred payment method.">
                                            Wählen Sie Ihre bevorzugte Zahlungsmethode.
                                        </p>
                                    </div>
                                </div>

                                <!-- Payment Method Tabs -->
                                <div class="grid grid-cols-3 gap-2 border-b border-[#e6decb] pb-4">
                                    <button
                                        type="button"
                                        id="tab-btn-bank"
                                        onclick="switchPaymentTab('bank')"
                                        class="flex items-center justify-center gap-2 rounded-lg border-2 border-[#78000b] bg-[#78000b] px-3 py-3 text-xs font-bold text-white shadow-md cursor-pointer transition"
                                    >
                                        <span>🏛️</span>
                                        <span data-i18n-de="Banküberweisung" data-i18n-en="Bank Transfer">Banküberweisung</span>
                                    </button>

                                    <button
                                        type="button"
                                        id="tab-btn-card"
                                        onclick="switchPaymentTab('card')"
                                        class="flex items-center justify-center gap-2 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-3 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition"
                                    >
                                        <span>💳</span>
                                        <span data-i18n-de="Kreditkarte" data-i18n-en="Credit Card">Kreditkarte</span>
                                    </button>

                                    <button
                                        type="button"
                                        id="tab-btn-paypal"
                                        onclick="switchPaymentTab('paypal')"
                                        class="flex items-center justify-center gap-2 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-3 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition"
                                    >
                                        <span>🅿️</span>
                                        <span>PayPal / Klarna</span>
                                    </button>
                                </div>

                                <!-- TAB CONTENT 1: BANK TRANSFER (VORKASSE) FORM -->
                                <div id="payment-content-bank" class="space-y-5">
                                    
                                    <!-- Official Bank Details Display Box -->
                                    <div class="rounded-xl border border-[#d8b45a]/60 bg-gradient-to-br from-[#faf7f2] via-[#f7f2e6] to-[#faf7f2] p-5 shadow-xs relative overflow-hidden">
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

                                            <div class="sm:col-span-2 flex items-center justify-between rounded-lg border border-[#d8b45a]/40 bg-white p-3 shadow-xs">
                                                <div>
                                                    <p class="text-[0.65rem] text-[#78000b] font-bold uppercase tracking-wider" data-i18n-de="IBAN für Überweisung" data-i18n-en="IBAN for Transfer">IBAN für Überweisung</p>
                                                    <p id="bank-iban-code" class="font-mono text-sm font-bold text-[#1c1210] tracking-wider mt-0.5">DE89 3704 0044 0532 0130 00</p>
                                                </div>
                                                <button
                                                    type="button"
                                                    onclick="copyIbanToClipboard()"
                                                    class="rounded-md bg-[#78000b]/10 hover:bg-[#78000b] hover:text-white px-3 py-1.5 text-xs font-bold text-[#78000b] transition cursor-pointer flex items-center gap-1.5"
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
                                                <p id="bank-order-ref" class="font-mono font-bold text-[#78000b] mt-0.5">Wird beim Auschecken generiert</p>
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
                                                    class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"
                                                >
                                            </div>

                                            <div>
                                                <label class="block text-[0.7rem] font-bold text-[#685c54] mb-1" data-i18n-de="Ihre IBAN / Bank (Für Zuordnung)" data-i18n-en="Your IBAN / Bank (For matching)">Ihre IBAN / Bank (Für Zuordnung)</label>
                                                <input
                                                    type="text"
                                                    id="payer-iban"
                                                    placeholder="DE89 XXXX XXXX XXXX XXXX XX"
                                                    class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none"
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
                                    <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-5 text-xs space-y-3">
                                        <div>
                                            <label class="block font-bold text-[#1c1210] mb-1" data-i18n-de="Kartennummer" data-i18n-en="Card Number">Kartennummer</label>
                                            <input type="text" placeholder="4532 •••• •••• 8921" class="w-full rounded-lg border border-[#e6decb] bg-white p-2.5 text-xs">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block font-bold text-[#1c1210] mb-1">Ablaufdatum</label>
                                                <input type="text" placeholder="MM/YY" class="w-full rounded-lg border border-[#e6decb] bg-white p-2.5 text-xs">
                                            </div>
                                            <div>
                                                <label class="block font-bold text-[#1c1210] mb-1">CVC / CWW</label>
                                                <input type="text" placeholder="352" class="w-full rounded-lg border border-[#e6decb] bg-white p-2.5 text-xs">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB CONTENT 3: PAYPAL (Hidden by default) -->
                                <div id="payment-content-paypal" class="hidden space-y-4">
                                    <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-6 text-center text-xs space-y-3">
                                        <p class="font-bold text-[#1c1210]" data-i18n-de="Sie werden nach der Bestellung zu PayPal / Klarna weitergeleitet." data-i18n-en="You will be redirected to PayPal / Klarna after placing your order.">
                                            Sie werden nach der Bestellung zu PayPal / Klarna weitergeleitet.
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <!-- Step 3 Actions Navigation -->
                            <div class="flex items-center justify-between pt-6 border-t border-[#f2ebdc]">
                                <button type="button" onclick="goToStep(2)" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#685c54] hover:text-[#78000b] transition cursor-pointer">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                                    <span data-i18n-de="ZURÜCK ZUR ADRESSE" data-i18n-en="BACK TO ADDRESS">ZURÜCK ZUR ADRESSE</span>
                                </button>

                                <button type="button" onclick="goToStep(4)" class="inline-flex items-center gap-2 rounded bg-[#78000b] px-6 py-3 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-xl transition-all duration-300 cursor-pointer active:scale-95">
                                    <span data-i18n-de="WEITER ZUR BESTÄTIGUNG" data-i18n-en="REVIEW ORDER">WEITER ZUR BESTÄTIGUNG</span>
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- STEP 4 PANEL: FINAL SUMMARY & ORDER SUBMISSION -->
                    <!-- ========================================== -->
                    <div id="wizard-panel-4" class="wizard-step-panel transition-all duration-500 opacity-0 hidden">
                        <div class="rounded-xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-md space-y-6">
                            
                            <div class="flex items-center gap-3 border-b border-[#f2ebdc] pb-4">
                                <span class="text-2xl">✨</span>
                                <div>
                                    <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="4. Bestellübersicht & Abschluss" data-i18n-en="4. Final Order Review">
                                        4. Bestellübersicht & Abschluss
                                    </h2>
                                    <p class="text-xs text-[#685c54]" data-i18n-de="Bitte überprüfen Sie alle Angaben vor dem verbindlichen Kauf." data-i18n-en="Please verify all information before placing your order.">
                                        Bitte überprüfen Sie alle Angaben vor dem verbindlichen Kauf.
                                    </p>
                                </div>
                            </div>

                            <!-- Summary Recaps Grid -->
                            <div class="grid gap-4 sm:grid-cols-2">
                                
                                <!-- Customer & Address Recap Card -->
                                <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-4 text-xs space-y-2">
                                    <div class="flex items-center justify-between border-b border-[#e6decb] pb-2">
                                        <span class="font-bold text-[#1c1210] uppercase tracking-wider" data-i18n-de="Lieferadresse" data-i18n-en="Shipping Address">Lieferadresse</span>
                                        <button type="button" onclick="goToStep(2)" class="text-[#78000b] font-bold hover:underline cursor-pointer" data-i18n-de="Bearbeiten" data-i18n-en="Edit">Bearbeiten</button>
                                    </div>
                                    <p id="summary-recap-name" class="font-bold text-[#1c1210]">-</p>
                                    <p id="summary-recap-street" class="text-[#685c54]">-</p>
                                    <p id="summary-recap-city" class="text-[#685c54]">-</p>
                                    <p id="summary-recap-contact" class="text-[#685c54] pt-1 text-[0.68rem]">-</p>
                                </div>

                                <!-- Shipping & Payment Method Recap Card -->
                                <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-4 text-xs space-y-2">
                                    <div class="flex items-center justify-between border-b border-[#e6decb] pb-2">
                                        <span class="font-bold text-[#1c1210] uppercase tracking-wider" data-i18n-de="Zahlung & Versand" data-i18n-en="Payment & Carrier">Zahlung & Versand</span>
                                        <button type="button" onclick="goToStep(3)" class="text-[#78000b] font-bold hover:underline cursor-pointer" data-i18n-de="Bearbeiten" data-i18n-en="Edit">Bearbeiten</button>
                                    </div>
                                    <div>
                                        <span class="text-[0.65rem] text-[#685c54] uppercase block">Zahlungsmethode:</span>
                                        <span id="summary-recap-payment" class="font-bold text-[#78000b]">🏛️ Banküberweisung (Vorkasse)</span>
                                    </div>
                                    <div>
                                        <span class="text-[0.65rem] text-[#685c54] uppercase block">Versanddienstleister:</span>
                                        <span id="summary-recap-shipping" class="font-bold text-[#2e683a]">🚚 DHL Express Standard (Kostenlos)</span>
                                    </div>
                                </div>

                            </div>

                            <!-- Final Terms Checkbox -->
                            <div class="rounded-xl border border-[#d8b45a]/50 bg-[#f7f2e6]/50 p-4 text-xs space-y-2">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" id="terms-agree-check" checked class="mt-0.5 rounded text-[#78000b] focus:ring-[#78000b]">
                                    <span class="text-[#5c4f46]" data-i18n-de="Ich habe die Allgemeinen Geschäftsbedingungen (AGB) und die Widerrufsbelehrung gelesen und erkläre mich ausdrücklich damit einverstanden." data-i18n-en="I have read and agree to the Terms & Conditions and Cancellation Policy.">
                                        Ich habe die Allgemeinen Geschäftsbedingungen (AGB) und die Widerrufsbelehrung gelesen und erkläre mich ausdrücklich damit einverstanden.
                                    </span>
                                </label>
                            </div>

                            <!-- Big Main CTA Button -->
                            <button
                                type="button"
                                onclick="triggerPageCheckout()"
                                class="w-full flex h-14 items-center justify-center gap-3 rounded-xl bg-[#78000b] px-6 text-xs font-bold uppercase tracking-[0.18em] text-white shadow-xl transition-all duration-300 hover:bg-[#5a0309] hover:shadow-2xl active:scale-95 cursor-pointer ring-4 ring-[#78000b]/20"
                            >
                                <span id="checkout-cta-text" data-i18n-de="JETZT ZAHLUNGSPFLICHTIG BESTELLEN 🔒" data-i18n-en="PLACE BINDING ORDER NOW 🔒">JETZT ZAHLUNGSPFLICHTIG BESTELLEN 🔒</span>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <!-- Step 4 Actions Navigation -->
                            <div class="flex items-center justify-between pt-4 border-t border-[#f2ebdc]">
                                <button type="button" onclick="goToStep(3)" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#685c54] hover:text-[#78000b] transition cursor-pointer">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                                    <span data-i18n-de="ZURÜCK ZUR ZAHLUNGSART" data-i18n-en="BACK TO PAYMENT">ZURÜCK ZUR ZAHLUNGSART</span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: ORDER SUMMARY SIDEBAR (4 COLS) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="rounded-xl border border-[#e6decb] bg-white p-6 shadow-md space-y-5 sticky top-24">
                        <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3">
                            <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Bestellübersicht" data-i18n-en="Order Summary">
                                Bestellübersicht
                            </h2>
                            <span id="wizard-sidebar-step-tag" class="text-[0.62rem] font-bold uppercase tracking-wider bg-[#faf7f2] text-[#78000b] border border-[#e6decb] px-2.5 py-1 rounded-full">
                                Schritt 1 / 4
                            </span>
                        </div>

                        <!-- Voucher Input -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-2" data-i18n-de="Gutscheincode" data-i18n-en="Promo Code">Gutscheincode</label>
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    id="page-voucher-input"
                                    placeholder="MEHAAJ10"
                                    class="flex-1 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:outline-none shadow-xs"
                                >
                                <button type="button" onclick="applyPageVoucher()" class="rounded-lg bg-[#78000b] px-4 py-2 text-xs font-bold uppercase tracking-wider text-white hover:bg-[#5a0309] transition cursor-pointer" data-i18n-de="EINLÖSEN" data-i18n-en="APPLY">EINLÖSEN</button>
                            </div>
                            <p id="page-voucher-success" class="hidden text-[0.65rem] font-bold text-[#2e683a] mt-1.5" data-i18n-de="Gutschein MEHAAJ10 (-10%) angewendet! ✓" data-i18n-en="Voucher MEHAAJ10 (-10%) applied! ✓">Gutschein MEHAAJ10 (-10%) angewendet! ✓</p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-2.5 text-xs text-[#5c4f46] border-t border-[#f2ebdc] pt-4">
                            <div class="flex justify-between">
                                <span data-i18n-de="Zwischensumme" data-i18n-en="Subtotal">Zwischensumme</span>
                                <span id="page-subtotal" class="font-bold text-[#1c1210]">EUR {{ number_format($subtotal ?? 0, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-[0.7rem] text-[#685c54]">
                                <span data-i18n-de="inkl. 19% MwSt." data-i18n-en="incl. 19% VAT">inkl. 19% MwSt.</span>
                                <span id="page-vat">EUR {{ number_format($vat ?? 0, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span data-i18n-de="Versand (DHL Express)" data-i18n-en="Shipping (DHL Express)">Versand (DHL Express)</span>
                                <span class="font-bold text-[#2e683a]" data-i18n-de="KOSTENLOS" data-i18n-en="FREE">KOSTENLOS</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-[#1c1210] border-t border-[#e6decb] pt-3">
                                <span data-i18n-de="Gesamtsumme" data-i18n-en="Total">Gesamtsumme</span>
                                <span id="page-total" class="text-[#78000b]">EUR {{ number_format($total ?? 0, 2, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Selected Payment Method Badge -->
                        <div class="rounded-lg bg-[#faf7f2] border border-[#e6decb] p-3 text-center text-xs">
                            <span class="text-[0.65rem] text-[#685c54] uppercase tracking-wider block" data-i18n-de="Zahlungsmethode" data-i18n-en="Payment Method">Zahlungsmethode</span>
                            <span id="selected-payment-display" class="font-bold text-[#78000b]" data-i18n-de="🏛️ Vorkasse / Banküberweisung" data-i18n-en="🏛️ Bank Transfer / Prepayment">
                                🏛️ Vorkasse / Banküberweisung
                            </span>
                        </div>

                        <!-- Trust Badges -->
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

    <!-- Page Specific Multi-Step Checkout JS Logic -->
    <script>
        let currentStep = 1;
        let selectedPaymentTab = 'vorkasse';

        function goToStep(step) {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

            // Validate Step 2 before moving forward to Step 3 or 4
            if (step > 2 && currentStep === 2) {
                if (!validateStep2(isEn)) return;
            }

            currentStep = step;

            // Update Progress Line Width (0%, 33%, 66%, 100%)
            const progressPct = ((step - 1) / 3) * 100;
            document.getElementById('wizard-progress-line').style.width = progressPct + '%';

            // Update Step Header Badges & Styling
            for (let i = 1; i <= 4; i++) {
                const badge = document.getElementById('step-badge-' + i);
                if (i < step) {
                    // Completed Steps
                    badge.className = 'h-11 w-11 rounded-full bg-[#2e683a] text-white flex items-center justify-center font-bold text-sm shadow-md border-2 border-white transition-all duration-300';
                    badge.innerHTML = '✓';
                } else if (i === step) {
                    // Active Current Step
                    badge.className = 'h-11 w-11 rounded-full bg-[#78000b] text-white flex items-center justify-center font-bold text-sm shadow-lg border-2 border-white ring-4 ring-[#78000b]/20 transition-all duration-300';
                    badge.innerHTML = i;
                } else {
                    // Upcoming Steps
                    badge.className = 'h-11 w-11 rounded-full bg-[#faf7f2] text-[#8a7c74] flex items-center justify-center font-bold text-sm shadow-sm border-2 border-[#e6decb] transition-all duration-300';
                    badge.innerHTML = i;
                }
            }

            // Update Step Panels Visibility with smooth transitions
            for (let i = 1; i <= 4; i++) {
                const panel = document.getElementById('wizard-panel-' + i);
                if (i === step) {
                    panel.classList.remove('hidden');
                    setTimeout(() => {
                        panel.classList.remove('opacity-0');
                        panel.classList.add('opacity-100');
                    }, 50);
                } else {
                    panel.classList.add('opacity-0');
                    panel.classList.remove('opacity-100');
                    panel.classList.add('hidden');
                }
            }

            // Update Sidebar Step Tag
            const sidebarTag = document.getElementById('wizard-sidebar-step-tag');
            if (sidebarTag) {
                sidebarTag.innerText = isEn ? `Step ${step} / 4` : `Schritt ${step} / 4`;
            }

            // Populate Step 4 Summary if moving to Step 4
            if (step === 4) {
                populateStep4Recap();
            }

            // Scroll smooth to top of wizard section
            document.getElementById('checkout-wizard-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function validateStep2(isEn) {
            const firstName = document.getElementById('ship-first-name').value.trim();
            const lastName = document.getElementById('ship-last-name').value.trim();
            const email = document.getElementById('ship-email').value.trim();
            const phone = document.getElementById('ship-phone').value.trim();
            const street = document.getElementById('ship-street').value.trim();
            const plz = document.getElementById('ship-plz').value.trim();
            const city = document.getElementById('ship-city').value.trim();

            if (!firstName || !lastName || !email || !phone || !street || !plz || !city) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: isEn ? 'Missing Shipping Data' : 'Unvollständige Lieferadresse',
                    text: isEn 
                        ? 'Please fill out all required shipping address fields before proceeding.' 
                        : 'Bitte füllen Sie alle erforderlichen Felder der Lieferadresse aus.',
                    confirmButtonText: isEn ? 'OK' : 'Verstanden'
                });
                return false;
            }
            return true;
        }

        function validateAndGoToStep3() {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            if (validateStep2(isEn)) {
                goToStep(3);
            }
        }

        function populateStep4Recap() {
            const firstName = document.getElementById('ship-first-name').value.trim();
            const lastName = document.getElementById('ship-last-name').value.trim();
            const email = document.getElementById('ship-email').value.trim();
            const phone = document.getElementById('ship-phone').value.trim();
            const street = document.getElementById('ship-street').value.trim();
            const plz = document.getElementById('ship-plz').value.trim();
            const city = document.getElementById('ship-city').value.trim();
            const country = document.getElementById('ship-country').value;

            document.getElementById('summary-recap-name').innerText = `${firstName} ${lastName}`;
            document.getElementById('summary-recap-street').innerText = street;
            document.getElementById('summary-recap-city').innerText = `${plz} ${city}, ${country}`;
            document.getElementById('summary-recap-contact').innerText = `✉️ ${email} | 📞 ${phone}`;

            const displayEl = document.getElementById('selected-payment-display');
            document.getElementById('summary-recap-payment').innerText = displayEl ? displayEl.innerText : '🏛️ Banküberweisung (Vorkasse)';
        }

        function switchPaymentTab(tab) {
            selectedPaymentTab = tab === 'bank' ? 'vorkasse' : tab;

            const bankBtn = document.getElementById('tab-btn-bank');
            const cardBtn = document.getElementById('tab-btn-card');
            const paypalBtn = document.getElementById('tab-btn-paypal');

            const bankContent = document.getElementById('payment-content-bank');
            const cardContent = document.getElementById('payment-content-card');
            const paypalContent = document.getElementById('payment-content-paypal');

            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            const displayEl = document.getElementById('selected-payment-display');

            [bankBtn, cardBtn, paypalBtn].forEach(btn => {
                btn.className = 'flex items-center justify-center gap-2 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-3 text-xs font-bold text-[#1c1210] hover:border-[#78000b] cursor-pointer transition';
            });

            bankContent.classList.add('hidden');
            cardContent.classList.add('hidden');
            paypalContent.classList.add('hidden');

            if (tab === 'bank' || tab === 'vorkasse') {
                bankBtn.className = 'flex items-center justify-center gap-2 rounded-lg border-2 border-[#78000b] bg-[#78000b] px-3 py-3 text-xs font-bold text-white shadow-md cursor-pointer transition';
                bankContent.classList.remove('hidden');
                displayEl.innerText = isEn ? '🏛️ Bank Transfer / Prepayment' : '🏛️ Vorkasse / Banküberweisung';
            } else if (tab === 'card') {
                cardBtn.className = 'flex items-center justify-center gap-2 rounded-lg border-2 border-[#78000b] bg-[#78000b] px-3 py-3 text-xs font-bold text-white shadow-md cursor-pointer transition';
                cardContent.classList.remove('hidden');
                displayEl.innerText = isEn ? '💳 Credit Card (Visa/MC)' : '💳 Kreditkarte (Visa/MC)';
            } else {
                paypalBtn.className = 'flex items-center justify-center gap-2 rounded-lg border-2 border-[#78000b] bg-[#78000b] px-3 py-3 text-xs font-bold text-white shadow-md cursor-pointer transition';
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

        function updatePageQty(productId, newQty) {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId, quantity: newQty })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function removePageItem(productId) {
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
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    fetch('/cart/remove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
                }
            });
        }

        function applyPageVoucher() {
            const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
            const input = document.getElementById('page-voucher-input').value.trim();
            const msg = document.getElementById('page-voucher-success');

            if (input.toUpperCase() === 'MEHAAJ10') {
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

            // Terms agreement validation
            const termsCheck = document.getElementById('terms-agree-check');
            if (termsCheck && !termsCheck.checked) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: isEn ? 'Terms & Conditions' : 'AGB Bestätigung',
                    text: isEn 
                        ? 'Please accept the Terms & Conditions before placing your order.' 
                        : 'Bitte bestätigen Sie die AGB, um Ihre Bestellung abzuschließen.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Shipping Form Fields
            const firstName = document.getElementById('ship-first-name').value.trim();
            const lastName = document.getElementById('ship-last-name').value.trim();
            const email = document.getElementById('ship-email').value.trim();
            const phone = document.getElementById('ship-phone').value.trim();
            const street = document.getElementById('ship-street').value.trim();
            const plz = document.getElementById('ship-plz').value.trim();
            const city = document.getElementById('ship-city').value.trim();
            const country = document.getElementById('ship-country').value;
            const payerName = document.getElementById('payer-name')?.value.trim();
            const payerIban = document.getElementById('payer-iban')?.value.trim();
            const voucherCode = document.getElementById('page-voucher-input')?.value.trim();

            if (!firstName || !lastName || !email || !phone || !street || !plz || !city) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: isEn ? 'Missing Shipping Data' : 'Unvollständige Lieferadresse',
                    text: isEn 
                        ? 'Please fill out all required shipping address fields (First Name, Last Name, Email, Phone, Street, Zip, City).' 
                        : 'Bitte füllen Sie alle erforderlichen Felder der Lieferadresse aus (Vorname, Nachname, E-Mail, Telefon, Straße, PLZ, Stadt).',
                    confirmButtonText: isEn ? 'Complete Form' : 'Formular Vervollständigen'
                }).then(() => {
                    goToStep(2);
                });
                return;
            }

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            LuxurySwal.fire({
                title: isEn ? 'Processing Order...' : 'Bestellung wird verarbeitet...',
                text: isEn ? 'Please wait while your order is securely saved.' : 'Bitte warten Sie, während Ihre Bestellung gespeichert wird.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token || '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    phone: phone,
                    street: street,
                    postal_code: plz,
                    city: city,
                    country: country,
                    payment_method: selectedPaymentTab,
                    payer_name: payerName,
                    payer_iban: payerIban,
                    voucher_code: voucherCode
                })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    LuxurySwal.fire({
                        icon: 'error',
                        title: isEn ? 'Order Error' : 'Bestellfehler',
                        text: data.message || 'Fehler beim Erstellen der Bestellung.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Order Saved Successfully in Database!
                if (data.payment_method === 'vorkasse' || selectedPaymentTab === 'vorkasse') {
                    LuxurySwal.fire({
                        icon: 'success',
                        title: isEn ? 'Order Placed! 🎉' : 'Bestellung Erfolgreich! 🎉',
                        html: `
                            <div class="text-left space-y-3 mt-3 text-xs">
                                <p class="text-neutral-700 font-medium">
                                    ${isEn 
                                        ? `Thank you <b>${data.customer_name}</b>! Your order <b>${data.order_number}</b> has been received and saved.` 
                                        : `Vielen Dank <b>${data.customer_name}</b>! Ihre Bestellung <b>${data.order_number}</b> wurde erfolgreich im System registriert.`}
                                </p>
                                
                                <div class="rounded-lg border border-[#d8b45a] bg-white p-3 space-y-1.5 shadow-xs">
                                    <p class="text-[0.65rem] font-bold text-[#78000b] uppercase tracking-wider">${isEn ? 'Payment Instructions (Bank Transfer / Vorkasse)' : 'Zahlungsanweisung (Banküberweisung / Vorkasse)'}</p>
                                    <p><b>${isEn ? 'Order Reference:' : 'Verwendungszweck:'}</b> <span class="font-mono text-[#78000b] font-bold">${data.order_number}</span></p>
                                    <p><b>${isEn ? 'Payee:' : 'Empfänger:'}</b> ${data.bank_name || 'MEHAAJ Luxury Leather GmbH'}</p>
                                    <p><b>IBAN:</b> <span class="font-mono font-bold">${data.iban}</span></p>
                                    <p><b>BIC:</b> <span class="font-mono">${data.bic}</span></p>
                                    <p><b>${isEn ? 'Total Amount:' : 'Gesamtbetrag:'}</b> <span class="font-bold text-[#78000b]">${data.formatted_total}</span></p>
                                </div>

                                <p class="text-[0.68rem] text-neutral-500">
                                    ${isEn 
                                        ? `Confirmation details sent to <b>${data.customer_email}</b>. Delivery to: ${street}, ${plz} ${city} (${country}).` 
                                        : `Bestellbestätigung wurde an <b>${data.customer_email}</b> gesendet. Lieferung an: ${street}, ${plz} ${city} (${country}).`}
                                </p>
                            </div>
                        `,
                        confirmButtonText: isEn ? '📋 Copy IBAN & Finish' : '📋 IBAN Kopieren & Abschließen',
                        showCancelButton: true,
                        cancelButtonText: isEn ? 'Close' : 'Schließen'
                    }).then((res) => {
                        if (res.isConfirmed) {
                            navigator.clipboard.writeText(data.iban);
                            LuxuryToast.fire({
                                icon: 'success',
                                title: isEn ? 'IBAN copied! Order confirmed.' : 'IBAN kopiert! Bestellung bestätigt.'
                            });
                        }
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    });
                } else {
                    LuxurySwal.fire({
                        icon: 'success',
                        title: isEn ? 'Order Completed! 🎉' : 'Bestellung Erfolgreich! 🎉',
                        text: isEn 
                            ? 'Thank you for your order at MEHAAJ. Your order number is ' + data.order_number 
                            : 'Vielen Dank für Ihren Einkauf bei MEHAAJ. Ihre Bestellnummer lautet ' + data.order_number + '.',
                        confirmButtonText: isEn ? 'Return Home' : 'Zur Startseite'
                    }).then(() => {
                        window.location.href = '/';
                    });
                }
            })
            .catch(err => {
                console.error('Checkout error:', err);
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Error' : 'Fehler',
                    text: 'Netzwerkfehler beim Verarbeiten der Bestellung.'
                });
            });
        }
    </script>

</div>
@endsection
