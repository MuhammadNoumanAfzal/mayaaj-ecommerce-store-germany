@extends('layouts.app')
@section('title', 'Secure Checkout | MEHAAJ® Official Maison')
@section('meta_description', 'Complete your luxury order securely. Choose Cash on Delivery or Manual Bank Transfer with complimentary insured courier dispatch.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] text-[#1c1210] py-6 sm:py-10">

    <div class="luxury-container">

        <!-- Breadcrumb Navigation -->
        <nav class="mb-5 flex items-center gap-2 text-xs text-[#685c54]">
            <a href="{{ url('/') }}" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span class="text-[#c5baaa]">/</span>
            <a href="{{ route('cart.index') }}" class="hover:text-[#78000b] transition" data-i18n-de="Warenkorb" data-i18n-en="Shopping Bag">Warenkorb</a>
            <span class="text-[#c5baaa]">/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-de="Kasse & Zahlung" data-i18n-en="Checkout">Kasse & Zahlung</span>
        </nav>

        <!-- Compact Page Title Banner -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3 border-b border-[#e6decb] pb-4">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-de="MEHAAJ MAISON ATELIER" data-i18n-en="MEHAAJ MAISON ATELIER">MEHAAJ MAISON ATELIER</span>
                </div>
                <h1 class="mt-1 font-display text-2xl sm:text-3xl font-medium tracking-tight text-[#1c1210]" data-i18n-de="Sichere Kasse" data-i18n-en="Secure Checkout">
                    Sichere Kasse
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full border border-[#2e683a]/30 bg-[#2e683a]/10 px-3.5 py-1.5 text-xs font-semibold text-[#2e683a]">
                    <span>🔒</span>
                    <span data-i18n-de="256-Bit SSL Verschlüsselt" data-i18n-en="256-Bit SSL Encrypted">256-Bit SSL Verschlüsselt</span>
                </span>
            </div>
        </div>

        @if(empty($cart))
            <!-- Empty Cart Warning Screen -->
            <div class="rounded-xl border border-[#e6decb] bg-white p-10 text-center space-y-4 max-w-lg mx-auto">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#faf7f2] border border-[#e6decb]">
                    <svg class="h-7 w-7 text-[#8a7c74]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" stroke-linejoin="round"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <h2 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Ihr Warenkorb ist leer" data-i18n-en="Your Bag is Empty">
                    Ihr Warenkorb ist leer
                </h2>
                <p class="text-xs text-[#685c54]" data-i18n-de="Bitte fügen Sie zuerst Produkte zum Warenkorb hinzu, bevor Sie zur Kasse gehen." data-i18n-en="Please add items to your shopping bag before proceeding to checkout.">
                    Bitte fügen Sie zuerst Produkte zum Warenkorb hinzu, bevor Sie zur Kasse gehen.
                </p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#78000b] px-5 py-2.5 text-xs font-bold uppercase tracking-[0.14em] text-white hover:bg-[#5a0309] transition">
                    <span data-i18n-de="Kollektion ansehen" data-i18n-en="Explore Collection">Kollektion ansehen</span>
                </a>
            </div>
        @else

            <!-- Two-Column Checkout Layout -->
            <div class="grid gap-6 lg:grid-cols-12 lg:items-start">

                <!-- LEFT COLUMN: Delivery Details & Payment Selection (7 Cols) -->
                <div class="lg:col-span-7 space-y-5">
                    
                    <form id="checkout-form" class="space-y-5">
                        
                        <!-- 1. Customer & Delivery Address Card -->
                        <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs space-y-4">
                            
                            <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#78000b] text-white text-xs font-bold">1</span>
                                    <h3 class="font-display text-base sm:text-lg font-medium text-[#1c1210]" data-i18n-de="Lieferadresse & Kontaktdaten" data-i18n-en="Shipping Address & Contact">
                                        Lieferadresse & Kontaktdaten
                                    </h3>
                                </div>
                                <span class="text-[0.68rem] text-[#2e683a] font-medium" data-i18n-de="Versicherter Expressversand" data-i18n-en="Insured Express Dispatch">Versicherter Expressversand</span>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Vorname *" data-i18n-en="First Name *">Vorname *</label>
                                    <input type="text" id="ship-first-name" required placeholder="Maximilian" data-i18n-placeholder-de="Maximilian" data-i18n-placeholder-en="Maximilian" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Nachname *" data-i18n-en="Last Name *">Nachname *</label>
                                    <input type="text" id="ship-last-name" required placeholder="Mustermann" data-i18n-placeholder-de="Mustermann" data-i18n-placeholder-en="Doe" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="E-Mail-Adresse *" data-i18n-en="Email Address *">E-Mail-Adresse *</label>
                                    <input type="email" id="ship-email" required placeholder="maximilian@beispiel.de" data-i18n-placeholder-de="maximilian@beispiel.de" data-i18n-placeholder-en="john.doe@example.com" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Telefonnummer *" data-i18n-en="Phone Number *">Telefonnummer *</label>
                                    <input type="tel" id="ship-phone" required placeholder="+49 151 23456789" data-i18n-placeholder-de="+49 151 23456789" data-i18n-placeholder-en="+1 (555) 019-2834" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Straße und Hausnummer *" data-i18n-en="Street Address & Number *">Straße und Hausnummer *</label>
                                    <input type="text" id="ship-street" required placeholder="Königsallee 42" data-i18n-placeholder-de="Königsallee 42" data-i18n-placeholder-en="742 Evergreen Terrace" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Postleitzahl *" data-i18n-en="Postal Code *">Postleitzahl *</label>
                                    <input type="text" id="ship-plz" required placeholder="40212" data-i18n-placeholder-de="40212" data-i18n-placeholder-en="10001" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Stadt *" data-i18n-en="City *">Stadt *</label>
                                    <input type="text" id="ship-city" required placeholder="Düsseldorf" data-i18n-placeholder-de="Düsseldorf" data-i18n-placeholder-en="New York" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Land *" data-i18n-en="Country *">Land *</label>
                                    <select id="ship-country" class="w-full rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition">
                                        <option value="Deutschland" selected data-i18n-en="Germany (Deutschland)" data-i18n-de="Deutschland (Germany)">Deutschland (Germany)</option>
                                        <option value="Österreich" data-i18n-en="Austria (Österreich)" data-i18n-de="Österreich (Austria)">Österreich (Austria)</option>
                                        <option value="Schweiz" data-i18n-en="Switzerland (Schweiz)" data-i18n-de="Schweiz (Switzerland)">Schweiz (Switzerland)</option>
                                        <option value="Frankreich" data-i18n-en="France (Frankreich)" data-i18n-de="Frankreich (France)">Frankreich (France)</option>
                                        <option value="Italien" data-i18n-en="Italy (Italien)" data-i18n-de="Italien (Italy)">Italien (Italy)</option>
                                        <option value="Vereinigtes Königreich" data-i18n-en="United Kingdom" data-i18n-de="Vereinigtes Königreich (UK)">United Kingdom</option>
                                        <option value="USA" data-i18n-en="United States" data-i18n-de="Vereinigte Staaten (USA)">United States</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- 2. Payment Method Card (ONLY COD & Manual Bank Transfer) -->
                        <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs space-y-4">
                            
                            <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#78000b] text-white text-xs font-bold">2</span>
                                    <h3 class="font-display text-base sm:text-lg font-medium text-[#1c1210]" data-i18n-de="Zahlungsmethode" data-i18n-en="Payment Method">
                                        Zahlungsmethode
                                    </h3>
                                </div>
                                <span class="text-[0.68rem] text-[#685c54]" data-i18n-de="2 sichere Zahlungsarten" data-i18n-en="2 secure payment methods">2 sichere Zahlungsarten</span>
                            </div>

                            <div class="space-y-3">
                                
                                <!-- Option 1: Cash on Delivery (COD) -->
                                <label class="payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border-2 border-[#78000b] bg-[#faf7f2] cursor-pointer transition shadow-2xs" id="label-method-cod">
                                    <input type="radio" name="checkout_payment_method" value="cod" checked class="mt-0.5 text-[#78000b] focus:ring-[#78000b]" onchange="updatePaymentMethod(this)">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-xs text-[#1c1210] flex items-center gap-1.5">
                                                <span>💵</span>
                                                <span data-i18n-de="Barzahlung bei Lieferung (Nachnahme / COD)" data-i18n-en="Cash on Delivery (COD)">Barzahlung bei Lieferung (Nachnahme / COD)</span>
                                            </span>
                                            <span class="rounded bg-[#2e683a]/10 px-2 py-0.5 text-[0.6rem] font-bold text-[#2e683a]" data-i18n-de="Beliebt" data-i18n-en="Popular">Beliebt</span>
                                        </div>
                                        <p class="text-[0.68rem] text-[#685c54] mt-1" data-i18n-de="Bezahlen Sie sicher und bequem direkt beim DHL Express Kurier bei Übergabe Ihres Pakets." data-i18n-en="Pay conveniently in cash or card directly to the courier upon delivery of your parcel.">
                                            Bezahlen Sie sicher und bequem direkt beim DHL Express Kurier bei Übergabe Ihres Pakets.
                                        </p>
                                    </div>
                                </label>

                                <!-- Option 2: Manual Bank Transfer (Vorkasse) -->
                                <label class="payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border border-[#e6decb] bg-white cursor-pointer transition hover:border-[#78000b]" id="label-method-bank">
                                    <input type="radio" name="checkout_payment_method" value="vorkasse" class="mt-0.5 text-[#78000b] focus:ring-[#78000b]" onchange="updatePaymentMethod(this)">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-xs text-[#1c1210] flex items-center gap-1.5">
                                                <span>🏛️</span>
                                                <span data-i18n-de="Manuelle Banküberweisung (Vorkasse)" data-i18n-en="Manual Bank Transfer (Prepayment)">Manuelle Banküberweisung (Vorkasse)</span>
                                            </span>
                                            <span class="rounded bg-[#faf7f2] border border-[#e6decb] px-2 py-0.5 text-[0.6rem] font-medium text-[#685c54]">Maison Bank</span>
                                        </div>
                                        <p class="text-[0.68rem] text-[#685c54] mt-1" data-i18n-de="Überweisen Sie direkt an unser deutsches Bankkonto. Versand erfolgt sofort nach Zahlungseingang." data-i18n-en="Transfer directly to our official German bank account. Dispatched immediately upon receipt.">
                                            Überweisen Sie direkt an unser deutsches Bankkonto. Versand erfolgt sofort nach Zahlungseingang.
                                        </p>

                                        <!-- Bank Account Info Accordion (Visible when Bank Transfer is selected) -->
                                        <div id="bank-transfer-info-box" class="hidden mt-3 rounded-lg border border-[#d8b45a]/50 bg-[#faf7f2] p-3 text-xs space-y-1.5">
                                            <div class="flex items-center justify-between">
                                                <span class="font-bold text-[#78000b]" data-i18n-de="Bankverbindung:" data-i18n-en="Bank Details:">Bankverbindung:</span>
                                                <span class="text-[0.65rem] text-[#2e683a] font-bold">Deutsche Bank AG Frankfurt</span>
                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-2 text-[0.7rem]">
                                                <div>
                                                    <span class="text-[#8a7c74]">IBAN:</span> 
                                                    <span class="font-mono font-bold text-[#1c1210]">DE89 3704 0044 0532 0130 00</span>
                                                </div>
                                                <div>
                                                    <span class="text-[#8a7c74]">BIC:</span> 
                                                    <span class="font-mono font-bold text-[#1c1210]">DABA DE FF XXX</span>
                                                </div>
                                            </div>
                                            <div class="pt-1 flex items-center justify-between">
                                                <span class="text-[0.62rem] text-[#8a7c74]" data-i18n-de="Verwendungszweck wird bei Bestellung generiert" data-i18n-en="Reference number generated upon placement">Verwendungszweck wird bei Bestellung generiert</span>
                                                <button type="button" onclick="copyIban()" class="text-[0.62rem] font-bold text-[#78000b] hover:underline cursor-pointer" data-i18n-de="📋 IBAN kopieren" data-i18n-en="📋 Copy IBAN">
                                                    📋 IBAN kopieren
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </label>

                            </div>

                        </div>

                        <!-- 3. Legal Agreement & Order Submit Button -->
                        <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs space-y-4">
                            
                            <label class="flex items-start gap-3 cursor-pointer text-xs text-[#685c54]">
                                <input type="checkbox" id="terms-agree-check" checked class="mt-0.5 rounded text-[#78000b] focus:ring-[#78000b]">
                                <span class="leading-relaxed" data-i18n-de="Ich habe die Allgemeinen Geschäftsbedingungen (AGB) und die Widerrufsbelehrung der MEHAAJ Maison gelesen und akzeptiere diese." data-i18n-en="I have read and accept the Terms & Conditions and Cancellation Policy of MEHAAJ Maison.">
                                    Ich habe die Allgemeinen Geschäftsbedingungen (AGB) und die Widerrufsbelehrung der MEHAAJ Maison gelesen und akzeptiere diese.
                                </span>
                            </label>

                            <button
                                type="button"
                                id="submit-checkout-btn"
                                onclick="submitCheckoutOrder()"
                                class="w-full flex h-12 items-center justify-center gap-2 rounded-lg bg-[#78000b] px-5 text-xs sm:text-sm font-bold uppercase tracking-[0.16em] text-white shadow-md hover:bg-[#5a0309] hover:shadow-lg transition-all active:scale-98 cursor-pointer ring-4 ring-[#78000b]/20"
                            >
                                <span id="submit-btn-label" data-i18n-de="JETZT ZAHLUNGSPFLICHTIG BESTELLEN 🔒" data-i18n-en="PLACE BINDING ORDER NOW 🔒">
                                    JETZT ZAHLUNGSPFLICHTIG BESTELLEN 🔒
                                </span>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <p class="text-center text-[0.65rem] text-[#8a7c74]" data-i18n-de="Nach Absenden erhalten Sie eine Bestätigungs-E-Mail mit allen Auftragsdetails." data-i18n-en="You will receive an immediate confirmation email containing your order details.">
                                Nach Absenden erhalten Sie eine Bestätigungs-E-Mail mit allen Auftragsdetails.
                            </p>

                        </div>

                    </form>

                </div>

                <!-- RIGHT COLUMN: Order Review Summary (5 Cols, Sticky) -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="rounded-xl border border-[#e6decb] bg-white p-5 sm:p-6 shadow-2xs sticky top-24 space-y-4">
                        
                        <div class="flex items-center justify-between border-b border-[#f2ebdc] pb-3">
                            <h3 class="font-display text-base sm:text-lg font-medium text-[#1c1210]" data-i18n-de="Bestellübersicht" data-i18n-en="Order Summary">
                                Bestellübersicht
                            </h3>
                            <a href="{{ route('cart.index') }}" class="text-[0.68rem] text-[#78000b] font-bold hover:underline" data-i18n-de="Korb bearbeiten" data-i18n-en="Edit Bag">
                                Korb bearbeiten
                            </a>
                        </div>

                        <!-- Mini Cart Items List -->
                        <div class="max-h-64 overflow-y-auto divide-y divide-[#f2ebdc] pr-1">
                            @foreach($cart as $item)
                                @php
                                    $imgSrc = $item['image_url'] ?? '/productbag.png';
                                    $price = (float) ($item['price'] ?? 0);
                                    $qty = (int) ($item['qty'] ?? 1);
                                @endphp
                                <div class="py-2.5 flex items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <img src="{{ $imgSrc }}" alt="{{ $item['name'] }}" class="h-12 w-12 rounded border border-[#e6decb] object-cover shrink-0">
                                        <div class="min-w-0">
                                            <p class="font-medium text-[#1c1210] truncate">{{ $item['name'] }}</p>
                                            @if(!empty($item['variation']))
                                                <p class="text-[0.62rem] text-[#78000b]">{{ $item['variation'] }}</p>
                                            @endif
                                            <p class="text-[0.65rem] text-[#8a7c74]">{{ $qty }} × EUR {{ number_format($price, 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-[#1c1210] shrink-0">
                                        EUR {{ number_format($price * $qty, 2, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Voucher Box (Optional) -->
                        <div class="border-t border-[#f2ebdc] pt-3">
                            <label class="block text-[0.65rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Gutscheincode" data-i18n-en="Promo Code">Gutscheincode</label>
                            <div class="flex gap-2">
                                <input
                                    type="text"
                                    id="checkout-voucher-input"
                                    placeholder="MEHAAJ10"
                                    class="flex-1 rounded-lg border border-[#e6decb] bg-[#faf7f2] px-3 py-1.5 text-xs text-[#1c1210] uppercase placeholder-[#8a7c74] focus:border-[#78000b] focus:bg-white focus:outline-none"
                                >
                                <button
                                    type="button"
                                    onclick="applyCheckoutVoucher()"
                                    class="rounded-lg bg-[#1c1210] px-3 py-1.5 text-[0.62rem] font-bold uppercase tracking-wider text-white hover:bg-[#78000b] transition cursor-pointer"
                                    data-i18n-de="EINLÖSEN"
                                    data-i18n-en="APPLY"
                                >
                                    EINLÖSEN
                                </button>
                            </div>
                            <p id="checkout-voucher-msg" class="hidden text-[0.65rem] font-bold text-[#2e683a] mt-1" data-i18n-de="Gutschein MEHAAJ10 (-10%) aktiviert! ✓" data-i18n-en="Voucher MEHAAJ10 (-10%) applied! ✓">
                                Gutschein MEHAAJ10 (-10%) aktiviert! ✓
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-2 text-xs text-[#5c4f46] border-t border-[#f2ebdc] pt-3">
                            
                            <div class="flex justify-between items-center">
                                <span data-i18n-de="Zwischensumme" data-i18n-en="Subtotal">Zwischensumme</span>
                                <span id="co-subtotal" class="font-bold text-[#1c1210]">EUR {{ number_format($subtotal ?? 0, 2, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center text-[0.7rem] text-[#685c54]">
                                <span data-i18n-de="Enthaltene 19% MwSt." data-i18n-en="Included 19% VAT">Enthaltene 19% MwSt.</span>
                                <span id="co-vat">EUR {{ number_format($vat ?? 0, 2, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span data-i18n-de="Versicherter Expressversand" data-i18n-en="Insured Express Delivery">Versicherter Expressversand</span>
                                <span class="font-bold text-[#1c1210]" data-i18n-de="Inklusive" data-i18n-en="Complimentary">Inklusive</span>
                            </div>

                            <div id="co-discount-row" class="hidden justify-between items-center text-[#2e683a] font-bold">
                                <span>MEHAAJ VIP (-10%)</span>
                                <span id="co-discount-val">- EUR 0,00</span>
                            </div>

                            <div class="flex justify-between items-baseline text-base font-bold text-[#1c1210] border-t border-[#e6decb] pt-3">
                                <span data-i18n-de="Gesamtsumme" data-i18n-en="Total Amount">Gesamtsumme</span>
                                <span id="co-total" class="font-display text-xl font-bold text-[#78000b]">
                                    EUR {{ number_format($total ?? 0, 2, ',', '.') }}
                                </span>
                            </div>

                        </div>

                        <!-- Atelier Reassurance Badge -->
                        <div class="rounded-lg bg-[#faf7f2] p-3 text-center text-[0.65rem] text-[#685c54] border border-[#e6decb] space-y-1">
                            <p class="font-bold text-[#1c1210]">MEHAAJ Atelier Garantie</p>
                            <p data-i18n-de="30 Tage Rückgaberecht • DHL Express Kurier • Vollversicherung" data-i18n-en="30-Day Returns • DHL Express Courier • Fully Insured">
                                30 Tage Rückgaberecht • DHL Express Kurier • Vollversicherung
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        @endif

    </div>

</div>

<!-- Checkout Page Script -->
<script>
    let rawCheckoutTotal = {{ (float) ($total ?? 0) }};
    let isCheckoutVoucherApplied = false;

    function updatePaymentMethod(radio) {
        const codCard = document.getElementById('label-method-cod');
        const bankCard = document.getElementById('label-method-bank');
        const bankInfo = document.getElementById('bank-transfer-info-box');

        if (radio.value === 'cod') {
            codCard.className = 'payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border-2 border-[#78000b] bg-[#faf7f2] cursor-pointer transition shadow-2xs';
            bankCard.className = 'payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border border-[#e6decb] bg-white cursor-pointer transition hover:border-[#78000b]';
            if (bankInfo) bankInfo.classList.add('hidden');
        } else {
            bankCard.className = 'payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border-2 border-[#78000b] bg-[#faf7f2] cursor-pointer transition shadow-2xs';
            codCard.className = 'payment-radio-card group flex items-start gap-3.5 p-3.5 rounded-xl border border-[#e6decb] bg-white cursor-pointer transition hover:border-[#78000b]';
            if (bankInfo) bankInfo.classList.remove('hidden');
        }
    }

    function copyIban() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        navigator.clipboard.writeText('DE89 3704 0044 0532 0130 00').then(() => {
            LuxuryToast.fire({
                icon: 'success',
                title: isEn ? 'IBAN copied to clipboard! 📋' : 'IBAN kopiert! 📋'
            });
        });
    }

    function applyCheckoutVoucher() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const code = document.getElementById('checkout-voucher-input').value.trim();
        const msg = document.getElementById('checkout-voucher-msg');

        if (code.toUpperCase() === 'MEHAAJ10') {
            isCheckoutVoucherApplied = true;
            if (msg) msg.classList.remove('hidden');

            const discount = rawCheckoutTotal * 0.1;
            const discounted = rawCheckoutTotal * 0.9;

            const row = document.getElementById('co-discount-row');
            const val = document.getElementById('co-discount-val');
            if (row) row.classList.remove('hidden'), row.classList.add('flex');
            if (val) val.innerText = '- EUR ' + discount.toFixed(2).replace('.', ',');

            document.getElementById('co-total').innerText = 'EUR ' + discounted.toFixed(2).replace('.', ',');

            LuxuryToast.fire({
                icon: 'success',
                title: isEn ? 'Voucher applied (-10%)! 🎉' : 'Gutschein eingelöst (-10%)! 🎉'
            });
        } else {
            LuxuryToast.fire({
                icon: 'error',
                title: isEn ? 'Invalid Code. Try MEHAAJ10' : 'Ungültiger Code. Versuchen Sie: MEHAAJ10'
            });
        }
    }

    function submitCheckoutOrder() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

        // Check Terms
        const terms = document.getElementById('terms-agree-check');
        if (terms && !terms.checked) {
            LuxurySwal.fire({
                icon: 'warning',
                title: isEn ? 'Terms & Conditions' : 'AGB Bestätigung',
                text: isEn ? 'Please accept the Terms & Conditions to proceed.' : 'Bitte bestätigen Sie die AGB, um fortzufahren.',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Validate Input fields
        const firstName = document.getElementById('ship-first-name')?.value.trim();
        const lastName = document.getElementById('ship-last-name')?.value.trim();
        const email = document.getElementById('ship-email')?.value.trim();
        const phone = document.getElementById('ship-phone')?.value.trim();
        const street = document.getElementById('ship-street')?.value.trim();
        const plz = document.getElementById('ship-plz')?.value.trim();
        const city = document.getElementById('ship-city')?.value.trim();
        const country = document.getElementById('ship-country')?.value || 'Deutschland';
        const paymentMethod = document.querySelector('input[name="checkout_payment_method"]:checked')?.value || 'cod';
        const voucher = document.getElementById('checkout-voucher-input')?.value.trim();

        if (!firstName || !lastName || !email || !phone || !street || !plz || !city) {
            LuxurySwal.fire({
                icon: 'warning',
                title: isEn ? 'Incomplete Details' : 'Unvollständige Angaben',
                text: isEn 
                    ? 'Please fill in all required shipping address fields before placing your order.' 
                    : 'Bitte füllen Sie alle erforderlichen Felder der Lieferadresse aus.',
                confirmButtonText: isEn ? 'OK' : 'Verstanden'
            });
            return;
        }

        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        LuxurySwal.fire({
            title: isEn ? 'Processing Order...' : 'Bestellung wird verarbeitet...',
            text: isEn ? 'Registering your order with Maison Mehaaj...' : 'Ihre Bestellung wird im System registriert...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(window.mehaajUrl('/cart/checkout'), {
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
                payment_method: paymentMethod,
                voucher_code: voucher
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Order Error' : 'Bestellfehler',
                    text: data.message || (isEn ? 'Could not complete order.' : 'Bestellung konnte nicht abgeschlossen werden.'),
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Success Modal with instructions for COD vs Bank Transfer
            if (paymentMethod === 'cod') {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Order Confirmed! 🎉' : 'Bestellung Erfolgreich! 🎉',
                    html: `
                        <div class="text-left space-y-3 mt-3 text-xs text-[#1c1210]">
                            <p>
                                ${isEn 
                                    ? `Thank you <b>${data.customer_name}</b>! Your order <b>${data.order_number}</b> has been placed successfully.` 
                                    : `Vielen Dank <b>${data.customer_name}</b>! Ihre Bestellung <b>${data.order_number}</b> wurde erfolgreich aufgegeben.`}
                            </p>
                            
                            <div class="rounded-xl border border-[#2e683a] bg-[#2e683a]/8 p-3 space-y-1">
                                <p class="text-[0.65rem] font-bold text-[#2e683a] uppercase tracking-wider">${isEn ? 'Payment: Cash on Delivery (COD)' : 'Zahlungsart: Barzahlung bei Lieferung (Nachnahme)'}</p>
                                <p>${isEn ? 'Amount Due upon Delivery:' : 'Zu zahlender Gesamtbetrag:'} <b class="text-[#78000b]">${data.formatted_total}</b></p>
                                <p class="text-[0.68rem] text-[#685c54]">${isEn ? 'Please keep cash or card ready for the DHL Express courier upon arrival.' : 'Bitte halten Sie den Betrag bei Übergabe durch den DHL Express Kurier bereit.'}</p>
                            </div>

                            <p class="text-[0.68rem] text-[#685c54]">
                                ${isEn 
                                    ? `Confirmation sent to <b>${data.customer_email}</b>. Delivery to: ${street}, ${plz} ${city} (${country}).` 
                                    : `Bestellbestätigung wurde an <b>${data.customer_email}</b> gesendet. Lieferung an: ${street}, ${plz} ${city} (${country}).`}
                            </p>
                        </div>
                    `,
                    confirmButtonText: isEn ? 'Return Home' : 'Zur Startseite'
                }).then(() => {
                    window.location.href = window.mehaajUrl('/');
                });
            } else {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Order Received! 🎉' : 'Bestellung Eingegangen! 🎉',
                    html: `
                        <div class="text-left space-y-3 mt-3 text-xs text-[#1c1210]">
                            <p>
                                ${isEn 
                                    ? `Thank you <b>${data.customer_name}</b>! Your order <b>${data.order_number}</b> has been placed.` 
                                    : `Vielen Dank <b>${data.customer_name}</b>! Ihre Bestellung <b>${data.order_number}</b> wurde registriert.`}
                            </p>
                            
                            <div class="rounded-xl border border-[#d8b45a] bg-white p-3 space-y-1.5 shadow-2xs">
                                <p class="text-[0.65rem] font-bold text-[#78000b] uppercase tracking-wider">${isEn ? 'Bank Transfer Details (Prepayment)' : 'Zahlungsanweisung (Manuelle Überweisung / Vorkasse)'}</p>
                                <p><b>${isEn ? 'Reference Number:' : 'Verwendungszweck:'}</b> <span class="font-mono text-[#78000b] font-bold">${data.order_number}</span></p>
                                <p><b>${isEn ? 'Bank:' : 'Bank:'}</b> ${data.bank_name || 'Deutsche Bank AG Frankfurt'}</p>
                                <p><b>IBAN:</b> <span class="font-mono font-bold">${data.iban}</span></p>
                                <p><b>BIC:</b> <span class="font-mono">${data.bic}</span></p>
                                <p><b>${isEn ? 'Total Amount:' : 'Gesamtbetrag:'}</b> <span class="font-bold text-[#78000b]">${data.formatted_total}</span></p>
                            </div>

                            <p class="text-[0.68rem] text-[#685c54]">
                                ${isEn 
                                    ? `Confirmation sent to <b>${data.customer_email}</b>. Delivery to: ${street}, ${plz} ${city} (${country}).` 
                                    : `Bestellbestätigung wurde an <b>${data.customer_email}</b> gesendet. Lieferung an: ${street}, ${plz} ${city} (${country}).`}
                            </p>
                        </div>
                    `,
                    confirmButtonText: isEn ? '📋 Copy IBAN & Finish' : '📋 IBAN Kopieren & Abschließen',
                    showCancelButton: true,
                    cancelButtonText: isEn ? 'Return Home' : 'Zur Startseite'
                }).then((res) => {
                    if (res.isConfirmed) {
                        navigator.clipboard.writeText(data.iban);
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'IBAN copied to clipboard!' : 'IBAN in die Zwischenablage kopiert!'
                        });
                    }
                    setTimeout(() => {
                        window.location.href = window.mehaajUrl('/');
                    }, 1000);
                });
            }
        })
        .catch(err => {
            console.error('Checkout error:', err);
            LuxurySwal.fire({
                icon: 'error',
                title: isEn ? 'Network Error' : 'Netzwerkfehler',
                text: isEn ? 'An error occurred while transmitting your order.' : 'Ein Fehler ist beim Übermitteln der Bestellung aufgetreten.'
            });
        });
    }
</script>
@endsection
