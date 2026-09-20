@extends('layouts.app')
@section('title', 'Impressum / Imprint - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="RECHTLICHE ANGABEN" data-i18n-en="LEGAL IMPRINT">RECHTLICHE ANGABEN</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Impressum" data-i18n-en="Imprint">
                Impressum
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Anbieterkennzeichnung gemäß § 5 TMG (Telemediengesetz) & Digital Services Act (DSA)." data-i18n-en="Provider identification according to § 5 TMG (Telemedia Act) & Digital Services Act (DSA).">
                Anbieterkennzeichnung gemäß § 5 TMG (Telemediengesetz) & Digital Services Act (DSA).
            </p>
        </div>

        <div class="mt-10 space-y-8 text-xs sm:text-sm text-[#5a4e47]">
            <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm space-y-6">
                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="Angaben gemäß § 5 TMG" data-i18n-en="Information according to § 5 TMG">Angaben gemäß § 5 TMG</h2>
                    <p class="mt-2 font-bold text-[#1c1210]">MEHAAJ GmbH</p>
                    <p>Königsallee 42</p>
                    <p data-i18n-de="40212 Düsseldorf, Deutschland" data-i18n-en="40212 Düsseldorf, Germany">40212 Düsseldorf, Deutschland</p>
                </div>

                <div>
                    <h3 class="font-bold text-[#1c1210]" data-i18n-de="Vertreten durch:" data-i18n-en="Represented by:">Vertreten durch:</h3>
                    <p data-i18n-de="Geschäftsführung: Nouman & Team" data-i18n-en="Managing Director: Nouman & Team">Geschäftsführung: Nouman & Team</p>
                </div>

                <div>
                    <h3 class="font-bold text-[#1c1210]" data-i18n-de="Kontakt:" data-i18n-en="Contact:">Kontakt:</h3>
                    <p data-i18n-de="Telefon: +49 (0) 800 634225" data-i18n-en="Phone: +49 (0) 800 634225">Telefon: +49 (0) 800 634225</p>
                    <p>E-Mail: impressum@mehaaj.de / support@mehaaj.de</p>
                    <p>Website: www.mehaaj.de</p>
                </div>

                <div>
                    <h3 class="font-bold text-[#1c1210]" data-i18n-de="Registereintrag:" data-i18n-en="Commercial Register:">Registereintrag:</h3>
                    <p data-i18n-de="Eintragung im Handelsregister." data-i18n-en="Registered in the Commercial Register.">Eintragung im Handelsregister.</p>
                    <p data-i18n-de="Registergericht: Amtsgericht Düsseldorf" data-i18n-en="Registration Court: District Court Düsseldorf">Registergericht: Amtsgericht Düsseldorf</p>
                    <p data-i18n-de="Registernummer: HRB 98765" data-i18n-en="Registration Number: HRB 98765">Registernummer: HRB 98765</p>
                </div>

                <div>
                    <h3 class="font-bold text-[#1c1210]" data-i18n-de="Umsatzsteuer-ID:" data-i18n-en="VAT Identification Number:">Umsatzsteuer-ID:</h3>
                    <p data-i18n-de="Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz:" data-i18n-en="VAT Identification Number according to § 27 a German VAT Act:">Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz:</p>
                    <p class="font-mono font-bold text-[#78000b]">DE 312 456 789</p>
                </div>

                <div class="border-t border-[#e6decb] pt-4">
                    <h3 class="font-bold text-[#1c1210]" data-i18n-de="EU-Streitschlichtung / Verbraucherstreitbeilegung" data-i18n-en="EU Dispute Resolution / Consumer Dispute Resolution">EU-Streitschlichtung / Verbraucherstreitbeilegung</h3>
                    <p class="mt-1 leading-relaxed" data-i18n-de="Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: https://ec.europa.eu/consumers/odr/. Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen." data-i18n-en="The European Commission provides an online dispute resolution (ODR) platform: https://ec.europa.eu/consumers/odr/. We are neither obliged nor willing to participate in dispute resolution proceedings before a consumer arbitration board.">
                        Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener" class="text-[#78000b] underline">https://ec.europa.eu/consumers/odr/</a>.<br>
                        Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
