@extends('layouts.app')
@section('title', 'Häufige Fragen & Größenberatung / FAQ - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="HÄUFIGE FRAGEN" data-i18n-en="HELP & FAQ">HÄUFIGE FRAGEN</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Häufige Fragen & Größenberatung" data-i18n-en="FAQ & Size Guide">
                Häufige Fragen & Größenberatung
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Antworten auf die wichtigsten Fragen zu Ihrer Bestellung, Bezahlung, Größen und Lieferung." data-i18n-en="Answers to common questions regarding ordering, payment, sizing, and delivery.">
                Antworten auf die wichtigsten Fragen zu Ihrer Bestellung, Bezahlung, Größen und Lieferung.
            </p>
        </div>

        <div class="mt-10 space-y-4">
            <details class="group rounded-md border border-[#e6decb] bg-white p-5 shadow-sm">
                <summary class="flex cursor-pointer items-center justify-between font-display text-xl font-medium text-[#1c1210] outline-none">
                    <span data-i18n-de="1. Welche Zahlungsmethoden stehen zur Verfügung?" data-i18n-en="1. Which payment methods are accepted?">1. Welche Zahlungsmethoden stehen zur Verfügung?</span>
                    <span class="ml-4 flex h-6 w-6 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition group-open:rotate-180">+</span>
                </summary>
                <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#5a4e47]" data-i18n-de="Wir akzeptieren Klarna Kauf auf Rechnung, Klarna Ratenkauf, PayPal, Kreditkarten (Visa, MasterCard, American Express), Apple Pay und Google Pay." data-i18n-en="We accept Klarna invoice, Klarna pay later, PayPal, credit cards (Visa, MasterCard, American Express), Apple Pay, and Google Pay.">
                    Wir akzeptieren Klarna Kauf auf Rechnung, Klarna Ratenkauf, PayPal, Kreditkarten (Visa, MasterCard, American Express), Apple Pay und Google Pay.
                </p>
            </details>

            <details class="group rounded-md border border-[#e6decb] bg-white p-5 shadow-sm">
                <summary class="flex cursor-pointer items-center justify-between font-display text-xl font-medium text-[#1c1210] outline-none">
                    <span data-i18n-de="2. Wie wähle ich die richtige Konfektionsgröße? (Größenberatung)" data-i18n-en="2. How do I choose the correct size? (Size Guide)">2. Wie wähle ich die richtige Konfektionsgröße? (Größenberatung)</span>
                    <span class="ml-4 flex h-6 w-6 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition group-open:rotate-180">+</span>
                </summary>
                <div class="mt-3 text-xs sm:text-sm leading-relaxed text-[#5a4e47] space-y-2">
                    <p data-i18n-de="Unsere Produkte fallen regulär nach deutschen Konfektionsgrößen (EU Standard) aus. Falls ein Produkt schmal oder im Oversized-Cut geschnitten ist, finden Sie einen Hinweis direkt auf der Produktseite." data-i18n-en="Our garments strictly adhere to standard European / German sizing. Specific fit advice (e.g. slim fit or oversized) is detailed on each product page.">Unsere Produkte fallen regulär nach deutschen Konfektionsgrößen (EU Standard) aus. Falls ein Produkt schmal oder im Oversized-Cut geschnitten ist, finden Sie einen Hinweis direkt auf der Produktseite.</p>
                    <div class="mt-2 overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-[#e6decb]">
                            <thead>
                                <tr class="bg-[#faf7f2] text-[0.65rem] uppercase text-[#78000b]">
                                    <th class="p-2 border border-[#e6decb]" data-i18n-de="EU Größe" data-i18n-en="EU Size">EU Größe</th>
                                    <th class="p-2 border border-[#e6decb]" data-i18n-de="Brustumfang (cm)" data-i18n-en="Bust (cm)">Brustumfang (cm)</th>
                                    <th class="p-2 border border-[#e6decb]" data-i18n-de="Taillenumfang (cm)" data-i18n-en="Waist (cm)">Taillenumfang (cm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="p-2 border border-[#e6decb]">S (36)</td><td class="p-2 border border-[#e6decb]">84–88</td><td class="p-2 border border-[#e6decb]">68–72</td></tr>
                                <tr><td class="p-2 border border-[#e6decb]">M (38)</td><td class="p-2 border border-[#e6decb]">89–93</td><td class="p-2 border border-[#e6decb]">73–77</td></tr>
                                <tr><td class="p-2 border border-[#e6decb]">L (40)</td><td class="p-2 border border-[#e6decb]">94–98</td><td class="p-2 border border-[#e6decb]">78–82</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </details>

            <details class="group rounded-md border border-[#e6decb] bg-white p-5 shadow-sm">
                <summary class="flex cursor-pointer items-center justify-between font-display text-xl font-medium text-[#1c1210] outline-none">
                    <span data-i18n-de="3. Wie funktioniert die Rücksendung?" data-i18n-en="3. How do returns work?">3. Wie funktioniert die Rücksendung?</span>
                    <span class="ml-4 flex h-6 w-6 items-center justify-center rounded-full bg-[#78000b]/10 text-[#78000b] transition group-open:rotate-180">+</span>
                </summary>
                <p class="mt-3 text-xs sm:text-sm leading-relaxed text-[#5a4e47]" data-i18n-de="Sie können Artikel innerhalb von 30 Tagen kostenlos an uns zurückschicken. Nutzen Sie dazu einfach unser digitales Retourenportal oder kontaktieren Sie unseren Kundenservice per E-Mail für Ihr DHL Retourenlabel." data-i18n-en="You can return any item free of charge within 30 days. Simply use our online return portal or contact customer support to receive your DHL return label.">
                    Sie können Artikel innerhalb von 30 Tagen kostenlos an uns zurückschicken. Nutzen Sie dazu einfach unser digitales Retourenportal oder kontaktieren Sie unseren Kundenservice per E-Mail für Ihr DHL Retourenlabel.
                </p>
            </details>
        </div>
    </div>
</div>
@endsection
