@extends('layouts.app')
@section('title', 'Kontakt & Support - MEHAAJ Luxury Leather')

@section('content')
<div class="pt-20 bg-[#faf7f2] min-h-screen text-[#1c1210]">

    <!-- Breadcrumb Navigation -->
    <nav class="bg-[#faf7f2] border-b border-[#e6decb] py-3 text-xs text-[#685c54]">
        <div class="luxury-container flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span>/</span>
            <span class="text-[#1c1210] font-medium" data-i18n-de="Kontakt & Support" data-i18n-en="Contact & Support">Kontakt & Support</span>
        </div>
    </nav>

    <!-- Sub-page Hero Banner Header -->
    <section class="relative overflow-hidden bg-white py-12 lg:py-16 border-b border-[#e6decb]">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(216,180,90,0.08),transparent_70%)]"></div>
        <div class="luxury-container relative z-10">
            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                        <span data-i18n-de="KUNDENSERVICE & CONCIERGE" data-i18n-en="CUSTOMER CARE & CONCIERGE">KUNDENSERVICE & CONCIERGE</span>
                    </div>
                    <h1 class="mt-3 font-display text-4xl font-medium leading-tight text-[#1c1210] sm:text-5xl lg:text-6xl" data-i18n-de="Kontakt & Manufaktur Service" data-i18n-en="Contact & Atelier Support">
                        Kontakt & Manufaktur Service
                    </h1>
                </div>
                <p class="max-w-md text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-de="Wir stehen Ihnen persönlich für maßgeschneiderte Beratung, Bestellstatus, Lederpflege & Sonderanfertigungen zur Verfügung." data-i18n-en="We are personally at your service for bespoke consultations, order status updates, leather care, and custom crafted items.">
                    Wir stehen Ihnen persönlich für maßgeschneiderte Beratung, Bestellstatus, Lederpflege & Sonderanfertigungen zur Verfügung.
                </p>
            </div>
        </div>
    </section>

    <!-- Quick Direct Contact Channels Cards Grid -->
    <section class="py-8 bg-[#faf7f2] border-b border-[#e6decb]">
        <div class="luxury-container">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                
                <!-- Channel 1: E-Mail -->
                <div class="rounded-md border border-[#e6decb] bg-white p-5 shadow-xs transition duration-300 hover:-translate-y-1 hover:border-[#78000b]/30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="E-Mail Support" data-i18n-en="Email Support">E-Mail Support</h3>
                            <p class="text-[0.68rem] text-[#685c54]">24h Express Response</p>
                        </div>
                    </div>
                    <a href="mailto:support@mehaaj.de" class="text-xs font-bold text-[#78000b] hover:underline">support@mehaaj.de</a>
                </div>

                <!-- Channel 2: Hotline -->
                <div class="rounded-md border border-[#e6decb] bg-white p-5 shadow-xs transition duration-300 hover:-translate-y-1 hover:border-[#78000b]/30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="Telefon Hotline" data-i18n-en="Phone Hotline">Telefon Hotline</h3>
                            <p class="text-[0.68rem] text-[#685c54]">Mo–Fr: 09:00 – 18:00 Uhr</p>
                        </div>
                    </div>
                    <a href="tel:+49800634225" class="text-xs font-bold text-[#78000b] hover:underline">+49 (0) 800 634225</a>
                </div>

                <!-- Channel 3: Flagship Boutique -->
                <div class="rounded-md border border-[#e6decb] bg-white p-5 shadow-xs transition duration-300 hover:-translate-y-1 hover:border-[#78000b]/30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="Flagship Atelier" data-i18n-en="Flagship Atelier">Flagship Atelier</h3>
                            <p class="text-[0.68rem] text-[#685c54]">Königsallee 42, Düsseldorf</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#1c1210]">40212 Düsseldorf 🇩🇪</span>
                </div>

                <!-- Channel 4: Hours -->
                <div class="rounded-md border border-[#e6decb] bg-white p-5 shadow-xs transition duration-300 hover:-translate-y-1 hover:border-[#78000b]/30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display text-sm font-bold text-[#1c1210]" data-i18n-de="Öffnungszeiten" data-i18n-en="Opening Hours">Öffnungszeiten</h3>
                            <p class="text-[0.68rem] text-[#685c54]">Boutique & Showroom</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#1c1210]">Mo – Sa: 10:00 – 19:00 Uhr</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Main Contact Form & Location Section -->
    <section class="py-12 lg:py-16">
        <div class="luxury-container">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-start">

                <!-- Left Column: Interactive Contact Form (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-10 shadow-md">
                        <div class="border-b border-[#f2ebdc] pb-5 mb-6">
                            <h2 class="font-display text-2xl font-medium text-[#1c1210] sm:text-3xl" data-i18n-de="Nachricht an die Manufaktur Senden" data-i18n-en="Send Message to Atelier">
                                Nachricht an die Manufaktur Senden
                            </h2>
                            <p class="text-xs text-[#685c54] mt-1" data-i18n-de="Füllen Sie das Formular aus. Unser VIP-Service wird Ihr Anliegen umgehend bearbeiten." data-i18n-en="Fill out the form below. Our VIP concierge will attend to your request promptly.">
                                Füllen Sie das Formular aus. Unser VIP-Service wird Ihr Anliegen umgehend bearbeiten.
                            </p>
                        </div>

                        <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-5">
                            
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
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
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
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                    >
                                </div>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="phone" data-i18n-de="Telefonnummer (Für Rückruf)" data-i18n-en="Phone Number (Optional)">
                                        Telefonnummer (Für Rückruf)
                                    </label>
                                    <input
                                        id="phone"
                                        type="tel"
                                        placeholder="+49 170 1234567"
                                        data-i18n-placeholder-de="+49 170 1234567"
                                        data-i18n-placeholder-en="+44 7911 123456"
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
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
                                        class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1c1210] mb-1.5" for="subject" data-i18n-de="Betreff / Thema" data-i18n-en="Subject / Topic">
                                    Betreff / Thema
                                </label>
                                <select
                                    id="subject"
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs cursor-pointer"
                                >
                                    <option value="Allgemeine Anfrage">Allgemeine Anfrage</option>
                                    <option value="Bestellstatus & DHL Express Lieferung">Bestellstatus & DHL Express Lieferung</option>
                                    <option value="Retoure & Reklamation">Retoure & Reklamation</option>
                                    <option value="Manufaktur & Sonderanfertigung">Manufaktur & Sonderanfertigung (Bespoke)</option>
                                    <option value="VIP Kundenservice & Pflegehinweise">VIP Kundenservice & Pflegehinweise</option>
                                </select>
                            </div>

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
                                    class="w-full rounded border border-[#e6decb] bg-[#faf7f2] p-3.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none shadow-xs"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="w-full sm:w-auto inline-flex h-12 items-center justify-center gap-2 rounded bg-[#78000b] px-8 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl active:scale-95 cursor-pointer"
                            >
                                <span data-i18n-de="NACHRICHT ABSENDEN" data-i18n-en="SEND MESSAGE">NACHRICHT ABSENDEN</span>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Flagship Atelier Showcase & Location Card (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div class="rounded-md border border-[#d8b45a]/50 bg-gradient-to-br from-white via-[#faf7f2] to-[#f7f2e6] p-6 sm:p-8 shadow-md space-y-6">
                        <div class="border-b border-[#d8b45a]/30 pb-4">
                            <span class="rounded bg-[#78000b] px-2.5 py-0.5 text-[0.62rem] font-bold text-white uppercase tracking-wider">FLAGSHIP STORE</span>
                            <h3 class="mt-2 font-display text-2xl font-bold text-[#1c1210]" data-i18n-de="MEHAAJ Düsseldorf Boutique" data-i18n-en="MEHAAJ Düsseldorf Boutique">
                                MEHAAJ Düsseldorf Boutique
                            </h3>
                            <p class="text-xs text-[#685c54] mt-1" data-i18n-de="Besuchen Sie unseren exklusiven Showroom auf der Königsallee." data-i18n-en="Visit our exclusive showroom on Düsseldorf's iconic Königsallee.">
                                Besuchen Sie unseren exklusiven Showroom auf der Königsallee.
                            </p>
                        </div>

                        <!-- Address Info Box -->
                        <div class="space-y-3 text-xs text-[#5c4f46]">
                            <div class="flex items-start gap-3">
                                <span class="text-base">📍</span>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Königsallee 42, 3. OG</p>
                                    <p class="text-[0.72rem] text-[#685c54]">40212 Düsseldorf, Deutschland</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="text-base">⏱️</span>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Öffnungszeiten</p>
                                    <p class="text-[0.72rem] text-[#685c54]">Montag – Samstag: 10:00 – 19:00 Uhr</p>
                                    <p class="text-[0.68rem] text-[#78000b] font-semibold">Private Termine nach Vereinbarung</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="text-base">☕</span>
                                <div>
                                    <p class="font-bold text-[#1c1210]">Personal Concierge Service</p>
                                    <p class="text-[0.72rem] text-[#685c54]">Genießen Sie privaten Espresso & Champagner-Empfang bei Ihrem Besuch.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Atelier Showcase Visual Card -->
                        <div class="relative overflow-hidden rounded-md border border-[#e6decb] bg-[#1c1210] p-6 text-white text-center space-y-3 shadow-inner">
                            <span class="text-2xl">🏛️</span>
                            <h4 class="font-display text-lg font-medium text-[#d8b45a]">Maßanfertigung & Personalisierung</h4>
                            <p class="text-[0.72rem] text-[#e4d9cc]/80 leading-relaxed">
                                Initialen-Prägung in 24k Goldfolie, maßgeschneiderte Lederfarben und feine Einzelstücke direkt aus unserer deutschen Manufaktur.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</div>

<!-- Client-side AJAX Contact Submission Script with SweetAlert2 Integration -->
<script>
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

        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        LuxurySwal.fire({
            title: isEn ? 'Sending Message...' : 'Nachricht wird übermittelt...',
            text: isEn ? 'Connecting to MEHAAJ concierge...' : 'Verbindung zur MEHAAJ Manufaktur wird hergestellt...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

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
            if (data.success) {
                LuxurySwal.fire({
                    icon: 'success',
                    title: isEn ? 'Message Received! ✉️' : 'Nachricht Erhalten! ✉️',
                    html: `
                        <div class="text-left space-y-3 mt-2 text-xs">
                            <p class="text-neutral-700 font-medium">
                                ${isEn 
                                    ? `Thank you <b>${name}</b>! Your message has been safely received.` 
                                    : `Vielen Dank <b>${name}</b>! Ihre Anfrage wurde in unserem System registriert.`}
                            </p>
                            
                            <div class="rounded border border-[#d8b45a] bg-white p-3 space-y-1">
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
                    text: data.message || 'Fehler beim Senden der Nachricht.'
                });
            }
        })
        .catch(err => {
            console.error('Contact submit error:', err);
            LuxurySwal.fire({
                icon: 'error',
                title: isEn ? 'Error' : 'Fehler',
                text: 'Netzwerkfehler beim Senden der Nachricht.'
            });
        });
    }
</script>
@endsection
