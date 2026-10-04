@extends('layouts.app')

@section('title', 'Kontakt & VIP Concierge Atelier Düsseldorf | MEHAAJ® Deutsche Haute Maroquinerie')
@section('meta_description', 'Kontaktieren Sie das MEHAAJ Maison & Concierge Atelier auf der Königsallee Düsseldorf. Persönliche Beratung, Maßanfertigung & Express Support. Mo–Sa 10–19 Uhr.')
@section('canonical', route('contact'))

@section('content')
<!-- Schema.org ContactPage & LocalBusiness Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ContactPage",
      "@id": "{{ route('contact') }}#webpage",
      "url": "{{ route('contact') }}",
      "name": "Kontakt & Concierge Service | MEHAAJ Official Maison",
      "description": "Treten Sie mit dem MEHAAJ Kundenservice und unserer Düsseldorfer Manufaktur in Kontakt für exklusive Beratung, Bestellstatus und Maßanfertigungen."
    },
    {
      "@type": "LocalBusiness",
      "@id": "{{ url('/') }}#boutique",
      "name": "MEHAAJ Flagship Boutique & Atelier",
      "image": "{{ asset('craftsmanship_hero.png') }}",
      "telephone": "+49 800 634225",
      "email": "support@mehaaj.de",
      "priceRange": "€€€€",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Königsallee 42, 3. OG",
        "addressLocality": "Düsseldorf",
        "postalCode": "40212",
        "addressCountry": "DE"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          "opens": "10:00",
          "closes": "19:00"
        }
      ]
    }
  ]
}
</script>

<div class="bg-[#faf7f2] min-h-screen text-[#1c1210]">

    <!-- Cinematic Hero Section (No dead space, matches atelier aesthetic) -->
    <section class="relative overflow-hidden bg-[#0a0403] py-14 sm:py-20 text-white border-b border-[#d8b45a]/30">
        <!-- Ambient Glowing Orbs -->
        <div class="pointer-events-none absolute -top-36 -left-36 h-80 w-80 rounded-full bg-[#78000b]/25 blur-[110px] animate-float-slow"></div>
        <div class="pointer-events-none absolute -bottom-36 -right-36 h-80 w-80 rounded-full bg-[#d8b45a]/15 blur-[120px] animate-float-delayed"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_60%_at_50%_30%,rgba(120,0,11,0.2),transparent_75%)]"></div>

        <div class="luxury-container relative z-10 text-center max-w-3xl">
            <!-- Eyebrow Badge -->
            <div class="hero-anim hero-anim-eyebrow inline-flex items-center gap-2.5 rounded-full border border-[#d8b45a]/40 bg-black/60 px-4 py-1.5 text-[0.65rem] font-bold uppercase tracking-[0.24em] text-[#d8b45a] shadow-[0_0_20px_rgba(216,180,90,0.15)] backdrop-blur-md">
                <span class="h-2 w-2 rounded-full bg-[#d8b45a] animate-ping"></span>
                <span data-i18n-de="PERSÖNLICHER CONCIERGE & ATELIER SERVICE" data-i18n-en="PERSONAL CONCIERGE & ATELIER CARE">PERSÖNLICHER CONCIERGE & ATELIER SERVICE</span>
            </div>

            <!-- Page Title -->
            <h1 class="hero-anim hero-anim-title mt-4 font-display text-3xl sm:text-4xl lg:text-5xl font-medium leading-[1.15] text-[#fffaf0] tracking-tight" data-i18n-de="Wir sind persönlich für Sie da" data-i18n-en="We Are Personally at Your Service">
                Wir sind persönlich für <span class="bg-gradient-to-r from-[#d8b45a] via-[#ffd45a] to-[#d8b45a] bg-clip-text text-transparent underline decoration-[#78000b]/60 decoration-wavy">Sie da</span>
            </h1>

            <!-- Editorial Description -->
            <p class="hero-anim hero-anim-desc mt-4 text-xs sm:text-sm text-[#e4d9cc]/85 leading-relaxed font-light max-w-2xl mx-auto" data-i18n-de="Ob Beratung zu handgefertigten Unikaten, Fragen zum Expressversand oder individuelle Bespoke-Wünsche: Unser Düsseldorfer Atelier betreut Ihr Anliegen mit höchster Sorgfalt." data-i18n-en="Whether inquiring about handcrafted creations, express delivery status, or bespoke commissions: Our Düsseldorf atelier attends to every request with peerless devotion.">
                Ob Beratung zu handgefertigten Unikaten, Fragen zum Expressversand oder individuelle Bespoke-Wünsche: Unser Düsseldorfer Atelier betreut Ihr Anliegen mit höchster Sorgfalt.
            </p>

            <!-- Quick Response Pill -->
            <div class="hero-anim hero-anim-cta mt-6 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-[0.7rem] text-[#e4d9cc] backdrop-blur-md border border-white/10">
                <svg class="h-3.5 w-3.5 text-[#2e683a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span data-i18n-de="Garantierte Antwort innerhalb von 24 Stunden" data-i18n-en="Guaranteed response within 24 hours">Garantierte Antwort innerhalb von 24 Stunden</span>
            </div>
        </div>
    </section>

    <!-- 4 Direct Contact Channels (Staggered Scroll Reveal) -->
    <section class="py-8 sm:py-10 bg-white border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                
                <!-- Channel 1: E-Mail -->
                <a href="mailto:support@mehaaj.de" class="group rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b] hover:shadow-md cursor-pointer block reveal-on-scroll reveal-delay-100">
                    <div class="flex items-center gap-3.5 mb-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition-transform duration-300 group-hover:scale-110">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="E-Mail Support" data-i18n-en="Email Support">E-Mail Support</h3>
                            <p class="text-[0.65rem] text-[#685c54]">24h Express Response</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-[#78000b] group-hover:underline">support@mehaaj.de</p>
                    <span class="text-[0.62rem] text-[#8a7c74] mt-1 block" data-i18n-de="Schreiben Sie uns jederzeit" data-i18n-en="Write to us anytime">Schreiben Sie uns jederzeit</span>
                </a>

                <!-- Channel 2: Hotline -->
                <a href="tel:+49800634225" class="group rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b] hover:shadow-md cursor-pointer block reveal-on-scroll reveal-delay-200">
                    <div class="flex items-center gap-3.5 mb-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition-transform duration-300 group-hover:scale-110">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="Telefon Concierge" data-i18n-en="Phone Concierge">Telefon Concierge</h3>
                            <p class="text-[0.65rem] text-[#685c54]">Mo–Fr: 09:00 – 18:00 Uhr</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-[#78000b] group-hover:underline">+49 (0) 800 634225</p>
                    <span class="text-[0.62rem] text-[#2e683a] font-semibold mt-1 block" data-i18n-de="Kostenlos aus allen Netzen" data-i18n-en="Toll-free from all networks">Kostenlos aus allen Netzen</span>
                </a>

                <!-- Channel 3: Flagship Boutique -->
                <div class="group rounded-md border border-[#e6decb] bg-[#faf7f2] p-5 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#78000b] hover:shadow-md block reveal-on-scroll reveal-delay-300">
                    <div class="flex items-center gap-3.5 mb-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition-transform duration-300 group-hover:scale-110">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="Flagship Atelier" data-i18n-en="Flagship Atelier">Flagship Atelier</h3>
                            <p class="text-[0.65rem] text-[#685c54]">Königsallee 42, 3. OG</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-[#1c1210]">40212 Düsseldorf 🇩🇪</p>
                    <span class="text-[0.62rem] text-[#8a7c74] mt-1 block" data-i18n-de="Showroom & Abholung" data-i18n-en="Showroom & Collection">Showroom & Abholung</span>
                </div>

                <!-- Channel 4: Private Consultation Booking -->
                <button type="button" onclick="openPrivateAppointmentModal()" class="group text-left rounded-md border border-[#d8b45a]/50 bg-gradient-to-br from-white to-[#faf7f2] p-5 shadow-xs transition-all duration-300 hover:-translate-y-1.5 hover:border-[#d8b45a] hover:shadow-[0_10px_25px_rgba(216,180,90,0.2)] cursor-pointer block reveal-on-scroll reveal-delay-400">
                    <div class="flex items-center gap-3.5 mb-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#d8b45a]/15 text-[#1c1210] transition-transform duration-300 group-hover:scale-110">
                            <svg class="h-5 w-5 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="VIP Termin" data-i18n-en="VIP Appointment">VIP Termin</h3>
                            <p class="text-[0.65rem] text-[#685c54]">Private Atelier Session</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-[#78000b] group-hover:underline" data-i18n-de="Termin vereinbaren →" data-i18n-en="Book appointment →">Termin vereinbaren →</p>
                    <span class="text-[0.62rem] text-[#8a7c74] mt-1 block" data-i18n-de="Persönliche Lederberatung" data-i18n-en="Private Leather Consultation">Persönliche Lederberatung</span>
                </button>

            </div>
        </div>
    </section>

    <!-- Main Contact Form & Location Section -->
    <section class="py-12 sm:py-16">
        <div class="luxury-container">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Interactive Contact Form (7 cols on lg) -->
                <div class="lg:col-span-7 reveal-on-scroll">
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-10 shadow-sm relative overflow-hidden">
                        <!-- Top Accent Line -->
                        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

                        <div class="border-b border-[#f2ebdc] pb-5 mb-6">
                            <span class="text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]" data-i18n-de="DIREKTANFRAGE AN DIE MAISON" data-i18n-en="DIRECT INQUIRY TO THE MAISON">DIREKTANFRAGE AN DIE MAISON</span>
                            <h2 class="mt-1 font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-de="Nachricht an die Manufaktur Senden" data-i18n-en="Send Message to Atelier">
                                Nachricht an die Manufaktur Senden
                            </h2>
                            <p class="text-xs text-[#685c54] mt-1.5 leading-relaxed" data-i18n-de="Füllen Sie das Formular aus. Unser VIP-Concierge wird Ihr Anliegen umgehend prüfen und beantworten." data-i18n-en="Fill out the form below. Our VIP concierge will review and attend to your request promptly.">
                                Füllen Sie das Formular aus. Unser VIP-Concierge wird Ihr Anliegen umgehend prüfen und beantworten.
                            </p>
                        </div>

                        <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-5">
                            
                            <!-- Name & Email Fields -->
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="name" data-i18n-de="Ihr Name *" data-i18n-en="Full Name *">
                                        Ihr Name *
                                    </label>
                                    <input
                                        id="name"
                                        type="text"
                                        required
                                        placeholder="z. B. Maximilian Mustermann"
                                        data-i18n-placeholder-de="z. B. Maximilian Mustermann"
                                        data-i18n-placeholder-en="e.g. Alexander Smith"
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="email" data-i18n-de="E-Mail-Adresse *" data-i18n-en="Email Address *">
                                        E-Mail-Adresse *
                                    </label>
                                    <input
                                        id="email"
                                        type="email"
                                        required
                                        placeholder="maximilian@beispiel.de"
                                        data-i18n-placeholder-de="maximilian@beispiel.de"
                                        data-i18n-placeholder-en="alexander@example.com"
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs"
                                    >
                                </div>
                            </div>

                            <!-- Phone & Order Number -->
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="phone" data-i18n-de="Telefonnummer (Für VIP Rückruf)" data-i18n-en="Phone Number (Optional)">
                                        Telefonnummer (Für VIP Rückruf)
                                    </label>
                                    <input
                                        id="phone"
                                        type="tel"
                                        placeholder="+49 170 1234567"
                                        data-i18n-placeholder-de="+49 170 1234567"
                                        data-i18n-placeholder-en="+44 7911 123456"
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="order_number" data-i18n-de="Bestellnummer (Optional)" data-i18n-en="Order Reference (Optional)">
                                        Bestellnummer (Optional)
                                    </label>
                                    <input
                                        id="order_number"
                                        type="text"
                                        placeholder="z. B. MHJ-2026-8942"
                                        data-i18n-placeholder-de="z. B. MHJ-2026-8942"
                                        data-i18n-placeholder-en="e.g. MHJ-2026-8942"
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs font-mono"
                                    >
                                </div>
                            </div>

                            <!-- Subject Selector -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="subject" data-i18n-de="Betreff / Thema" data-i18n-en="Subject / Topic">
                                    Betreff / Thema
                                </label>
                                <select
                                    id="subject"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs cursor-pointer"
                                >
                                    <option value="Allgemeine Anfrage">Allgemeine Anfrage</option>
                                    <option value="Bestellstatus & DHL Express Lieferung">Bestellstatus & DHL Express Lieferung</option>
                                    <option value="Retoure & Reklamation">Retoure & Reklamation (30 Tage kostenfrei)</option>
                                    <option value="Manufaktur & Sonderanfertigung">Manufaktur & Sonderanfertigung (Bespoke)</option>
                                    <option value="VIP Kundenservice & Pflegehinweise">VIP Kundenservice & Lederpflege</option>
                                </select>
                            </div>

                            <!-- Message Textarea -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="message" data-i18n-de="Ihre Nachricht *" data-i18n-en="Your Message *">
                                    Ihre Nachricht *
                                </label>
                                <textarea
                                    id="message"
                                    required
                                    rows="5"
                                    placeholder="Wie können wir Ihnen weiterhelfen? Bitte beschreiben Sie Ihr Anliegen."
                                    data-i18n-placeholder-de="Wie können wir Ihnen weiterhelfen? Bitte beschreiben Sie Ihr Anliegen."
                                    data-i18n-placeholder-en="How can we assist you? Please describe your request."
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] p-3.5 text-xs text-[#1c1210] transition-colors duration-200 focus:border-[#78000b] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#78000b] shadow-2xs leading-relaxed"
                                ></textarea>
                            </div>

                            <!-- Privacy Legal Notice -->
                            <p class="text-[0.68rem] text-[#685c54] leading-relaxed">
                                <span data-i18n-de="Ihre Daten werden vertraulich behandelt und nach SSL 256-Bit Standard verschlüsselt." data-i18n-en="Your data is treated with strict confidentiality and encrypted via SSL 256-bit.">Ihre Daten werden vertraulich behandelt und nach SSL 256-Bit Standard verschlüsselt.</span>
                                <a href="/datenschutz" class="text-[#78000b] underline hover:text-[#5a0309] cursor-pointer" data-i18n-de="Datenschutzerklärung" data-i18n-en="Privacy Policy">Datenschutzerklärung</a>.
                            </p>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                id="submit-btn"
                                class="animate-shine-sweep group inline-flex h-12 items-center justify-center gap-2.5 rounded bg-[#78000b] px-8 text-xs font-bold uppercase tracking-[0.18em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl active:scale-98 cursor-pointer"
                            >
                                <span id="submit-btn-text" data-i18n-de="NACHRICHT ABSENDEN" data-i18n-en="SEND MESSAGE">NACHRICHT ABSENDEN</span>
                                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Flagship Boutique & Location Card (5 cols on lg) -->
                <div class="lg:col-span-5 space-y-6 reveal-on-scroll reveal-delay-200">
                    
                    <!-- Flagship Store Visual Card -->
                    <div class="rounded-md border border-[#d8b45a]/60 bg-gradient-to-br from-white via-[#faf7f2] to-[#f7f2e6] p-6 sm:p-8 shadow-sm space-y-6">
                        <div class="border-b border-[#d8b45a]/30 pb-4">
                            <span class="rounded bg-[#78000b] px-2.5 py-0.5 text-[0.62rem] font-bold text-white uppercase tracking-wider">FLAGSHIP BOUTIQUE</span>
                            <h3 class="mt-2 font-display text-2xl font-bold text-[#1c1210]" data-i18n-de="MEHAAJ Düsseldorf Atelier" data-i18n-en="MEHAAJ Düsseldorf Atelier">
                                MEHAAJ Düsseldorf Atelier
                            </h3>
                            <p class="text-xs text-[#685c54] mt-1" data-i18n-de="Besuchen Sie unseren exklusiven Showroom auf der Königsallee." data-i18n-en="Visit our exclusive showroom on Düsseldorf's iconic Königsallee.">
                                Besuchen Sie unseren exklusiven Showroom auf der Königsallee.
                            </p>
                        </div>

                        <!-- Address Info Box -->
                        <div class="space-y-4 text-xs text-[#5c4f46]">
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Königsallee 42, 3. OG</p>
                                    <p class="text-[0.72rem] text-[#685c54]">40212 Düsseldorf, Deutschland</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Öffnungszeiten</p>
                                    <p class="text-[0.72rem] text-[#685c54]">Montag – Samstag: 10:00 – 19:00 Uhr</p>
                                    <p class="text-[0.68rem] text-[#78000b] font-semibold mt-0.5">Private Abendtermine nach Voranmeldung</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Exklusiver Concierge Empfang</p>
                                    <p class="text-[0.72rem] text-[#685c54]">Genießen Sie privaten Espresso & Champagner bei Ihrem Besuch im Atelier.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bespoke Monogramming Feature Box -->
                        <div class="relative overflow-hidden rounded-md border border-[#e6decb] bg-[#1c1210] p-6 text-white text-center space-y-2.5 shadow-inner">
                            <span class="inline-block text-xl">⚜️</span>
                            <h4 class="font-display text-base sm:text-lg font-medium text-[#d8b45a]">Maßanfertigung & Gold-Prägung</h4>
                            <p class="text-[0.72rem] text-[#e4d9cc]/80 leading-relaxed font-light">
                                Individuelle Initialen-Prägung in 24k Heißfolie, maßgeschneiderte Lederfarben und feine Einzelstücke direkt aus unserer deutschen Manufaktur.
                            </p>
                            <button type="button" onclick="openPrivateAppointmentModal()" class="mt-2 inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#d8b45a] hover:underline cursor-pointer">
                                <span>TERMIN VEREINBAREN</span>
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Quick Help Accordion Section (Reduces support load & boosts SEO) -->
    <section class="bg-white py-12 sm:py-16 border-t border-[#e6decb] reveal-on-scroll">
        <div class="luxury-container max-w-4xl">
            <div class="text-center mb-8">
                <span class="text-[0.62rem] font-bold uppercase tracking-[0.24em] text-[#78000b]" data-i18n-de="HÄUFIG GESTELLTE FRAGEN" data-i18n-en="FREQUENTLY ASKED QUESTIONS">HÄUFIG GESTELLTE FRAGEN</span>
                <h2 class="mt-2 font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-de="Schnelle Antworten des Concierge" data-i18n-en="Quick Concierge Answers">
                    Schnelle Antworten des Concierge
                </h2>
                <div class="mx-auto mt-2 h-0.5 w-12 bg-[#d8b45a]"></div>
            </div>

            <div class="divide-y divide-[#e6decb] rounded-md border border-[#e6decb] bg-[#faf7f2] shadow-xs overflow-hidden">
                
                <!-- FAQ Item 1 -->
                <div class="group">
                    <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-base font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Wie lange dauert der Versand meiner Bestellung?" data-i18n-en="How long does delivery take?">Wie lange dauert der Versand meiner Bestellung?</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-[#5c4f46] leading-relaxed">
                        <p data-i18n-de="Alle vorrätigen Artikel versenden wir versichert via DHL Express innerhalb von 1–3 Werktagen. Bei handgefertigten Sonderanfertigungen (Bespoke) erhalten Sie Ihren Fertigstellungstermin persönlich mitgeteilt." data-i18n-en="All in-stock items are shipped insured via DHL Express within 1–3 business days. For bespoke handcrafted items, you receive a personal production timeline.">
                            Alle vorrätigen Artikel versenden wir versichert via DHL Express innerhalb von 1–3 Werktagen. Bei handgefertigten Sonderanfertigungen (Bespoke) erhalten Sie Ihren Fertigstellungstermin persönlich mitgeteilt.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="group">
                    <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-base font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Wie funktioniert die 30-Tage-Rückgabe?" data-i18n-en="How does the 30-day return policy work?">Wie funktioniert die 30-Tage-Rückgabe?</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-[#5c4f46] leading-relaxed">
                        <p data-i18n-de="Sie können Ihre Kreation innerhalb von 30 Tagen nach Erhalt kostenfrei zurücksenden. Ein vorfrankiertes DHL Retourenetikett liegt jeder Bestellung in der Luxusbox bei." data-i18n-en="You may return your creation free of charge within 30 days of receipt. A prepaid DHL return label is included with every delivery box.">
                            Sie können Ihre Kreation innerhalb von 30 Tagen nach Erhalt kostenfrei zurücksenden. Ein vorfrankiertes DHL Retourenetikett liegt jeder Bestellung in der Luxusbox bei.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="group">
                    <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-5 text-left font-display text-base font-medium text-[#1c1210] hover:text-[#78000b] transition cursor-pointer">
                        <span data-i18n-de="Bieten Sie eine individuelle Gravur oder Initialen-Prägung an?" data-i18n-en="Do you offer custom engraving or monogramming?">Bieten Sie eine individuelle Gravur oder Initialen-Prägung an?</span>
                        <svg class="h-5 w-5 text-[#78000b] transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-[#5c4f46] leading-relaxed">
                        <p data-i18n-de="Ja, wir bieten eine klassische Heißfolienprägung in 24k Echtgold oder Blindprägung für alle Kleinlederwaren und Taschen. Bitte wählen Sie beim Kontaktformular das Thema ‚Manufaktur & Sonderanfertigung‘." data-i18n-en="Yes, we offer classic hot foil stamping in 24k genuine gold or blind embossing for all small leather goods and bags. Select 'Manufaktur & Sonderanfertigung' in the contact form.">
                            Ja, wir bieten eine klassische Heißfolienprägung in 24k Echtgold oder Blindprägung für alle Kleinlederwaren und Taschen. Bitte wählen Sie beim Kontaktformular das Thema ‚Manufaktur & Sonderanfertigung‘.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<!-- Client-side AJAX Contact Submission & Appointment Scripts -->
<script>
    // 1. AJAX Form Submission with Instant Ticket Feedback
    function handleContactSubmit(e) {
        e.preventDefault();
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const orderNumber = document.getElementById('order_number').value.trim();
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value.trim();

        if (!name || !email || !message) {
            LuxurySwal.fire({
                icon: 'warning',
                title: isEn ? 'Missing Information' : 'Unvollständige Angaben',
                text: isEn ? 'Please fill out all required fields (Name, Email, Message).' : 'Bitte füllen Sie alle erforderlichen Felder aus (Name, E-Mail, Nachricht).'
            });
            return;
        }

        const btn = document.getElementById('submit-btn');
        const btnText = document.getElementById('submit-btn-text');
        if (btn) btn.classList.add('opacity-80', 'pointer-events-none');
        if (btnText) btnText.textContent = isEn ? 'SENDING...' : 'WIRD ÜBERMITTELT...';

        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch('{{ route("contact.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
                phone: phone,
                order_number: orderNumber,
                subject: subject,
                message: message
            })
        })
        .then(res => res.json())
        .then(data => {
            if (btn) btn.classList.remove('opacity-80', 'pointer-events-none');
            if (btnText) btnText.textContent = isEn ? 'SEND MESSAGE' : 'NACHRICHT ABSENDEN';

            if (data.success) {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Message Received! ✉️' : 'Nachricht Erhalten! ✉️',
                    html: `
                        <div class="text-left space-y-3 mt-2 text-xs">
                            <p class="text-neutral-700 font-medium">
                                ${isEn 
                                    ? `Thank you <b>${name}</b>! Your inquiry has been registered with our atelier.` 
                                    : `Vielen Dank <b>${name}</b>! Ihre Anfrage wurde in unserem System registriert.`}
                            </p>
                            
                            <div class="rounded border border-[#d8b45a] bg-[#faf7f2] p-3 space-y-1">
                                <p class="text-[0.65rem] font-bold text-[#78000b] uppercase tracking-wider">${isEn ? 'Support Ticket' : 'Support Ticket'}</p>
                                <p><b>Ticket ID:</b> <span class="font-mono text-[#78000b] font-bold">${data.ticket_id}</span></p>
                                <p><b>E-Mail:</b> ${email}</p>
                                <p><b>${isEn ? 'Subject:' : 'Betreff:'}</b> ${subject}</p>
                            </div>

                            <p class="text-[0.68rem] text-neutral-500">
                                ${isEn 
                                    ? `Our concierge will respond to <b>${email}</b> within 24 hours.` 
                                    : `Unser Kundenservice wird sich innerhalb von 24 Stunden unter <b>${email}</b> bei Ihnen melden.`}
                            </p>
                        </div>
                    `,
                    confirmButtonText: isEn ? 'Wonderful' : 'Wunderbar'
                }).then(() => {
                    document.getElementById('contact-form').reset();
                });
            } else {
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Error' : 'Fehler',
                    text: data.message || (isEn ? 'Failed to send message.' : 'Fehler beim Senden der Nachricht.')
                });
            }
        })
        .catch(err => {
            console.error('Contact submit error:', err);
            if (btn) btn.classList.remove('opacity-80', 'pointer-events-none');
            if (btnText) btnText.textContent = isEn ? 'SEND MESSAGE' : 'NACHRICHT ABSENDEN';

            LuxurySwal.fire({
                icon: 'error',
                title: isEn ? 'Error' : 'Fehler',
                text: isEn ? 'Network error while sending message.' : 'Netzwerkfehler beim Senden der Nachricht.'
            });
        });
    }

    // 2. Private Appointment Booking Modal
    function openPrivateAppointmentModal() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';

        if (window.LuxurySwal) {
            LuxurySwal.fire({
                title: isEn ? 'VIP Atelier Appointment 🏛️' : 'VIP Atelier Termin Düsseldorf 🏛️',
                html: `
                    <div class="text-left space-y-3 mt-3 text-xs">
                        <p class="text-neutral-600">
                            ${isEn ? 'Book an exclusive one-on-one session at our Königsallee showroom:' : 'Buchen Sie eine private Beratung in unserem Showroom auf der Königsallee:'}
                        </p>
                        <div>
                            <label class="block font-bold text-neutral-700 mb-1">${isEn ? 'Your Name' : 'Ihr Name'}</label>
                            <input id="swal-app-name" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'e.g. Maximilian S.' : 'z. B. Maximilian S.'}">
                        </div>
                        <div>
                            <label class="block font-bold text-neutral-700 mb-1">${isEn ? 'Preferred Date' : 'Wunschtermin'}</label>
                            <input id="swal-app-date" type="date" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]">
                        </div>
                        <div>
                            <label class="block font-bold text-neutral-700 mb-1">${isEn ? 'Interest Area' : 'Beratungsschwerpunkt'}</label>
                            <select id="swal-app-focus" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]">
                                <option value="Bespoke Bags">${isEn ? 'Bespoke Leather Bags & Briefcases' : 'Maßanfertigung von Ledertaschen & Aktentaschen'}</option>
                                <option value="Swiss Timepieces">${isEn ? 'Swiss Chronographs & Watches' : 'Schweizer Chronographen & Uhren'}</option>
                                <option value="Personal Monogramming">${isEn ? '24k Gold Monogramming Service' : '24k Gold Monogrammierung'}</option>
                            </select>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: isEn ? 'Request Appointment' : 'Termin anfragen',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
                preConfirm: () => {
                    const name = document.getElementById('swal-app-name').value;
                    const date = document.getElementById('swal-app-date').value;
                    if (!name || !date) {
                        Swal.showValidationMessage(isEn ? 'Please provide your name and date' : 'Bitte geben Sie Name und Datum an');
                        return false;
                    }
                    return { name, date };
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    LuxuryToast.fire({
                        icon: 'success',
                        title: isEn ? 'Appointment requested! Our concierge will call you.' : 'Terminanfrage eingegangen! Unser Concierge meldet sich bei Ihnen.'
                    });
                }
            });
        }
    }

    // 3. FAQ Accordion Toggle
    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const svg = btn.querySelector('svg');
        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            content.classList.remove('hidden');
            if (svg) svg.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            if (svg) svg.classList.remove('rotate-180');
        }
    }
</script>
@endsection
