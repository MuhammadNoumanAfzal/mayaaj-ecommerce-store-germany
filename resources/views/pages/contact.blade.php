@extends('layouts.app')
@section('title', 'Kontakt & Support - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container">
        <!-- Sub-page Header -->
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="KUNDENSERVICE" data-i18n-en="CUSTOMER CARE">KUNDENSERVICE</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Kontakt & Support" data-i18n-en="Contact & Support">
                Kontakt & Support
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Wir sind persönlich für Sie da. Schreiben Sie uns oder rufen Sie unseren VIP-Kundenservice an." data-i18n-en="We are personally here for you. Write to us or call our VIP customer service.">
                Wir sind persönlich für Sie da. Schreiben Sie uns oder rufen Sie unseren VIP-Kundenservice an.
            </p>
        </div>

        <div class="mt-12 grid gap-12 lg:grid-cols-12">
            <!-- Left: Contact Form -->
            <div class="lg:col-span-7">
                <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm">
                    <h2 class="font-display text-2xl font-medium text-[#1c1210]" data-i18n-de="Nachricht Senden" data-i18n-en="Send Message">Nachricht Senden</h2>
                    
                    <form class="mt-6 grid gap-4" action="#" method="post" onsubmit="handleContactSubmit(event)">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-[#78000b]" for="name" data-i18n-de="Name" data-i18n-en="Full Name">Name</label>
                                <input id="name" type="text" class="mt-1.5 h-11 w-full rounded-sm border border-[#e6decb] bg-[#faf7f2] px-3.5 text-xs outline-none focus:border-[#78000b]" placeholder="Ihr Name" data-i18n-placeholder-de="Ihr Name" data-i18n-placeholder-en="Your Name" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-[#78000b]" for="email" data-i18n-de="E-Mail" data-i18n-en="Email Address">E-Mail</label>
                                <input id="email" type="email" class="mt-1.5 h-11 w-full rounded-sm border border-[#e6decb] bg-[#faf7f2] px-3.5 text-xs outline-none focus:border-[#78000b]" placeholder="ihre@email.de" data-i18n-placeholder-de="ihre@email.de" data-i18n-placeholder-en="your@email.com" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-[#78000b]" for="order" data-i18n-de="Bestellnummer (Optional)" data-i18n-en="Order Number (Optional)">Bestellnummer (Optional)</label>
                            <input id="order" type="text" class="mt-1.5 h-11 w-full rounded-sm border border-[#e6decb] bg-[#faf7f2] px-3.5 text-xs outline-none focus:border-[#78000b]" placeholder="z. B. #MH-98421" data-i18n-placeholder-de="z. B. #MH-98421" data-i18n-placeholder-en="e.g. #MH-98421">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.14em] text-[#78000b]" for="message" data-i18n-de="Ihre Nachricht" data-i18n-en="Your Message">Ihre Nachricht</label>
                            <textarea id="message" rows="5" class="mt-1.5 w-full rounded-sm border border-[#e6decb] bg-[#faf7f2] p-3.5 text-xs outline-none focus:border-[#78000b]" placeholder="Wie können wir Ihnen helfen?" data-i18n-placeholder-de="Wie können wir Ihnen helfen?" data-i18n-placeholder-en="How can we help you?" required></textarea>
                        </div>

                        <button type="submit" class="mt-2 inline-flex items-center justify-center gap-2 rounded-sm bg-[#78000b] px-6 py-3.5 text-xs font-bold uppercase tracking-[0.18em] text-white shadow-md transition hover:bg-[#5a0309] cursor-pointer">
                            <span data-i18n-de="NACHRICHT ABSENDEN" data-i18n-en="SEND MESSAGE">NACHRICHT ABSENDEN</span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Direct Channels -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-sm">
                    <h3 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-de="Direkter Kontakt" data-i18n-en="Direct Channels">Direkter Kontakt</h3>
                    <ul class="mt-4 grid gap-4 text-xs text-[#5a4e47]">
                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#1c1210]" data-i18n-de="E-Mail Support" data-i18n-en="Email Support">E-Mail Support</p>
                                <p>support@mehaaj.de</p>
                                <p class="text-[0.65rem] text-[#8c7c72]" data-i18n-de="Antwort innerhalb von 24h" data-i18n-en="Response within 24h">Antwort innerhalb von 24h</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#1c1210]" data-i18n-de="Telefon Hotline" data-i18n-en="Phone Hotline">Telefon Hotline</p>
                                <p>+49 (0) 800 634225</p>
                                <p class="text-[0.65rem] text-[#8c7c72]" data-i18n-de="Mo–Fr: 09:00 – 18:00 Uhr" data-i18n-en="Mon–Fri: 09:00 – 18:00">Mo–Fr: 09:00 – 18:00 Uhr</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b]">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#1c1210]" data-i18n-de="Firmensitz" data-i18n-en="Headquarters">Firmensitz</p>
                                <p>MEHAAJ GmbH, Königsallee 42</p>
                                <p>40212 Düsseldorf, Deutschland</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handleContactSubmit(e) {
        e.preventDefault();
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
        const name = document.getElementById('name').value;
        LuxurySwal.fire({
            icon: 'success',
            title: isEn ? 'Message Sent! ✉️' : 'Nachricht Gesendet! ✉️',
            text: isEn 
                ? 'Thank you, ' + (name || 'valued customer') + '. We have received your inquiry and will reply within 24 hours.'
                : 'Vielen Dank, ' + (name || 'geschätzter Kunde') + '. Wir haben Ihre Anfrage erhalten und antworten Ihnen innerhalb von 24 Stunden.',
            confirmButtonText: isEn ? 'Very Good' : 'Sehr gut'
        }).then(() => {
            e.target.reset();
        });
    }
</script>
@endsection
