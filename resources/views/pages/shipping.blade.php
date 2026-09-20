@extends('layouts.app')
@section('title', 'Versand & Lieferung / Shipping - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="VERSANDINFORMATIONEN" data-i18n-en="SHIPPING INFORMATION">VERSANDINFORMATIONEN</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Versand & Lieferung" data-i18n-en="Shipping & Delivery">
                Versand & Lieferung
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Transparente Versandbedingungen, schnelle Lieferzeiten und klimaneutraler Versand mit DHL GoGreen." data-i18n-en="Transparent shipping conditions, fast delivery times, and climate-neutral shipping with DHL GoGreen.">
                Transparente Versandbedingungen, schnelle Lieferzeiten und klimaneutraler Versand mit DHL GoGreen.
            </p>
        </div>

        <div class="mt-10 space-y-8 text-xs sm:text-sm text-[#5a4e47]">
            <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-sm">
                <h2 class="font-display text-2xl font-medium text-[#1c1210]" data-i18n-de="1. Versandkosten & Lieferzeiten" data-i18n-en="1. Shipping Costs & Delivery Times">1. Versandkosten & Lieferzeiten</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-[#e6decb] text-[#78000b] text-[0.65rem] uppercase tracking-wider">
                                <th class="py-2.5 px-3" data-i18n-de="Zielregion" data-i18n-en="Destination Region">Zielregion</th>
                                <th class="py-2.5 px-3" data-i18n-de="Versanddienstleister" data-i18n-en="Carrier">Versanddienstleister</th>
                                <th class="py-2.5 px-3" data-i18n-de="Lieferzeit" data-i18n-en="Delivery Time">Lieferzeit</th>
                                <th class="py-2.5 px-3" data-i18n-de="Versandkosten" data-i18n-en="Shipping Cost">Versandkosten</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f2ebdc]">
                            <tr>
                                <td class="py-3 px-3 font-semibold text-[#1c1210]" data-i18n-de="Deutschland" data-i18n-en="Germany">Deutschland</td>
                                <td class="py-3 px-3">DHL GoGreen / Hermes</td>
                                <td class="py-3 px-3" data-i18n-de="1–3 Werktage" data-i18n-en="1–3 business days">1–3 Werktage</td>
                                <td class="py-3 px-3 font-bold text-[#78000b]" data-i18n-de="Kostenlos ab 99 € (sonst 4,90 €)" data-i18n-en="Free over €99 (otherwise €4.90)">Kostenlos ab 99 € (sonst 4,90 €)</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3 font-semibold text-[#1c1210]" data-i18n-de="Österreich & Schweiz" data-i18n-en="Austria & Switzerland">Österreich & Schweiz</td>
                                <td class="py-3 px-3">DHL Express / Swiss Post</td>
                                <td class="py-3 px-3" data-i18n-de="2–4 Werktage" data-i18n-en="2–4 business days">2–4 Werktage</td>
                                <td class="py-3 px-3">8,90 €</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-3 font-semibold text-[#1c1210]" data-i18n-de="EU-Ausland" data-i18n-en="Rest of EU">EU-Ausland</td>
                                <td class="py-3 px-3">DHL Premium International</td>
                                <td class="py-3 px-3" data-i18n-de="3–6 Werktage" data-i18n-en="3–6 business days">3–6 Werktage</td>
                                <td class="py-3 px-3">12,90 €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-sm">
                <h2 class="font-display text-2xl font-medium text-[#1c1210]" data-i18n-de="2. Sendungsverfolgung & Versicherung" data-i18n-en="2. Tracking & Insurance">2. Sendungsverfolgung & Versicherung</h2>
                <p class="mt-3 leading-relaxed" data-i18n-de="Jedes Paket wird versichert versendet. Sobald Ihre Bestellung verpackt und an unseren Versandpartner übergeben wurde, erhalten Sie automatisch eine E-Mail mit der persönlichen Tracking-Nummer zur Live-Verfolgung Ihrer Sendung." data-i18n-en="Every package is shipped with full insurance coverage. Once your order is dispatched, you will automatically receive an email containing your tracking link.">
                    Jedes Paket wird versichert versendet. Sobald Ihre Bestellung verpackt und an unseren Versandpartner übergeben wurde, erhalten Sie automatisch eine E-Mail mit der persönlichen Tracking-Nummer zur Live-Verfolgung Ihrer Sendung.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
