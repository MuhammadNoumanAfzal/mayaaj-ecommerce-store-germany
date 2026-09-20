@extends('layouts.app')
@section('title', 'Datenschutzerklärung / Privacy Policy - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="DSGVO KONFORMITÄT" data-i18n-en="GDPR PRIVACY">DSGVO KONFORMITÄT</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Datenschutzerklärung" data-i18n-en="Privacy Policy">
                Datenschutzerklärung
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Informationen zur Erhebung und Nutzung Ihrer personenbezogenen Daten gemäß DSGVO." data-i18n-en="Information regarding the collection and processing of personal data under GDPR.">
                Informationen zur Erhebung und Nutzung Ihrer personenbezogenen Daten gemäß DSGVO.
            </p>
        </div>

        <div class="mt-10 space-y-6 text-xs sm:text-sm text-[#5a4e47]">
            <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm space-y-5 leading-relaxed">
                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="1. Datenschutz auf einen Blick" data-i18n-en="1. Privacy at a Glance">
                        1. Datenschutz auf einen Blick
                    </h2>
                    <p class="mt-2" data-i18n-de="Der Schutz Ihrer Daten hat für das Haus MEHAAJ höchste Priorität. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können. Wir behandeln Ihre Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften (DSGVO) sowie dieser Datenschutzerklärung." data-i18n-en="Protecting your data is top priority at MEHAAJ. Personal data is any data that can personally identify you. We treat your personal data confidentially and in accordance with statutory data protection regulations (GDPR) and this Privacy Policy.">
                        Der Schutz Ihrer Daten hat für das Haus MEHAAJ höchste Priorität. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können. Wir behandeln Ihre Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften (DSGVO) sowie dieser Datenschutzerklärung.
                    </p>
                </div>

                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="2. Verantwortliche Stelle" data-i18n-en="2. Responsible Data Controller">
                        2. Verantwortliche Stelle
                    </h2>
                    <p class="mt-2" data-i18n-de="Verantwortlich für die Datenverarbeitung auf dieser Website ist: MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, Deutschland, E-Mail: datenschutz@mehaaj.de" data-i18n-en="The data controller responsible for processing data on this website is: MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, Germany, Email: datenschutz@mehaaj.de">
                        Verantwortlich für die Datenverarbeitung auf dieser Website ist:<br>
                        <strong>MEHAAJ GmbH</strong><br>
                        Königsallee 42, 40212 Düsseldorf, Deutschland<br>
                        E-Mail: datenschutz@mehaaj.de
                    </p>
                </div>

                <div>
                    <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="3. Ihre Rechte (Art. 15–21 DSGVO)" data-i18n-en="3. Your Rights (Art. 15–21 GDPR)">
                        3. Ihre Rechte (Art. 15–21 DSGVO)
                    </h2>
                    <p class="mt-2" data-i18n-de="Sie haben jederzeit das Recht auf kostenlose Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empfänger und den Zweck der Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten." data-i18n-en="You have the right at any time to receive free information about your stored personal data, its origin and recipients and the purpose of the data processing, as well as a right to correction, blocking or deletion of this data.">
                        Sie haben jederzeit das Recht auf kostenlose Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empfänger und den Zweck der Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
