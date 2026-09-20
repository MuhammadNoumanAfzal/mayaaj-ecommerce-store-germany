@extends('layouts.app')
@section('title', 'AGB / Terms & Conditions - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="VERTRAGSBEDINGUNGEN" data-i18n-en="TERMS OF SALE">VERTRAGSBEDINGUNGEN</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Allgemeine Geschäftsbedingungen (AGB)" data-i18n-en="Terms & Conditions (AGB)">
                Allgemeine Geschäftsbedingungen (AGB)
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Geschäftsbedingungen für Bestellungen im Online-Shop der MEHAAJ GmbH." data-i18n-en="Terms of service and sale for purchases on the MEHAAJ online store.">
                Geschäftsbedingungen für Bestellungen im Online-Shop der MEHAAJ GmbH.
            </p>
        </div>

        <div class="mt-10 space-y-6 text-xs sm:text-sm text-[#5a4e47]">
            <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm space-y-5 leading-relaxed">
                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="§ 1 Geltungsbereich & Vertragspartner" data-i18n-en="§ 1 Scope & Contracting Parties">
                        § 1 Geltungsbereich & Vertragspartner
                    </h2>
                    <p class="mt-2" data-i18n-de="Für alle Bestellungen über unseren Online-Shop gelten die nachfolgenden AGB. Vertragspartner ist die MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf." data-i18n-en="The following Terms & Conditions apply to all orders placed via our online shop. The contracting party is MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, Germany.">
                        Für alle Bestellungen über unseren Online-Shop gelten die nachfolgenden AGB. Vertragspartner ist die MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf.
                    </p>
                </div>

                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="§ 2 Vertragsschluss & Bestellvorgang" data-i18n-en="§ 2 Formation of Contract & Ordering">
                        § 2 Vertragsschluss & Bestellvorgang
                    </h2>
                    <p class="mt-2" data-i18n-de="Die Darstellung der Produkte im Online-Shop stellt kein rechtlich bindendes Angebot, sondern einen unverbindlichen Online-Katalog dar. Durch Anklicken des Buttons 'Kostenpflichtig bestellen' geben Sie eine verbindliche Bestellung ab." data-i18n-en="The presentation of products in the online store does not constitute a legally binding offer, but an invitation to order. By clicking the checkout button, you submit a binding purchase order.">
                        Die Darstellung der Produkte im Online-Shop stellt kein rechtlich bindendes Angebot, sondern einen unverbindlichen Online-Katalog dar. Durch Anklicken des Buttons 'Kostenpflichtig bestellen' geben Sie eine verbindliche Bestellung ab.
                    </p>
                </div>

                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="§ 3 Preise & Versandkosten" data-i18n-en="§ 3 Prices & Shipping Costs">
                        § 3 Preise & Versandkosten
                    </h2>
                    <p class="mt-2" data-i18n-de="Alle angegebenen Preise sind Endpreise inklusive der gesetzlichen deutschen Mehrwertsteuer (MwSt.). Zuzüglich fallen etwaige Versandkosten an, die im Bestellvorgang ausgewiesen werden." data-i18n-en="All prices listed are final prices including German statutory Value Added Tax (VAT). Applicable shipping charges are itemized separately during checkout.">
                        Alle angegebenen Preise sind Endpreise inklusive der gesetzlichen deutschen Mehrwertsteuer (MwSt.). Zuzüglich fallen etwaige Versandkosten an, die im Bestellvorgang ausgewiesen werden.
                    </p>
                </div>

                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="§ 4 Gewährleistung & Haftung" data-i18n-en="§ 4 Warranty & Liability">
                        § 4 Gewährleistung & Haftung
                    </h2>
                    <p class="mt-2" data-i18n-de="Es gelten die gesetzlichen Mängelhaftungsrechte. Bei Fragen zu Gewährleistungsansprüchen kontaktieren Sie unseren Kundenservice unter support@mehaaj.de." data-i18n-en="Statutory warranty rights apply to all purchases. For warranty inquiries, please contact customer support at support@mehaaj.de.">
                        Es gelten die gesetzlichen Mängelhaftungsrechte. Bei Fragen zu Gewährleistungsansprüchen kontaktieren Sie unseren Kundenservice unter support@mehaaj.de.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
