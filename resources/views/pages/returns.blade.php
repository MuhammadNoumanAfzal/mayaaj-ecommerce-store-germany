@extends('layouts.app')
@section('title', 'Rückgabe & Widerrufsbelehrung / Returns - MEHAAJ')
@section('content')
<div class="bg-[#faf7f2] pt-24 pb-16 text-[#1c1210] min-h-screen">
    <div class="luxury-container max-w-4xl">
        <div class="border-b border-[#e6decb] pb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span data-i18n-de="VERBRAUCHERRECHTE" data-i18n-en="CONSUMER RIGHTS">VERBRAUCHERRECHTE</span>
            </div>
            <h1 class="mt-3 font-display text-4xl font-medium text-[#1c1210] sm:text-5xl" data-i18n-de="Rückgabe & Widerrufsrecht" data-i18n-en="Returns & Cancellation Right">
                Rückgabe & Widerrufsrecht
            </h1>
            <p class="mt-2 text-sm text-[#685c54]" data-i18n-de="Gesetzliche Widerrufsbelehrung gemäß § 312g BGB sowie Informationen zum Rückgabeprozess." data-i18n-en="Statutory cancellation policy pursuant to German Civil Code (§ 312g BGB) and return guidelines.">
                Gesetzliche Widerrufsbelehrung gemäß § 312g BGB sowie Informationen zum Rückgabeprozess.
            </p>
        </div>

        <div class="mt-10 space-y-8 text-xs sm:text-sm text-[#5a4e47]">
            <div class="rounded-md border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm">
                <h2 class="font-display text-2xl font-medium text-[#78000b]" data-i18n-de="Widerrufsbelehrung" data-i18n-en="Right of Cancellation Policy">Widerrufsbelehrung</h2>
                <div class="mt-4 space-y-4 leading-relaxed">
                    <p class="font-semibold text-[#1c1210]" data-i18n-de="Widerrufsrecht" data-i18n-en="Statutory Cancellation Right">Widerrufsrecht</p>
                    <p data-i18n-de="Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat." data-i18n-en="You have the right to cancel this contract within fourteen days without giving any reason. The cancellation period is fourteen days from the day on which you or a third party named by you who is not the carrier took possession of the goods.">
                        Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat.
                    </p>
                    <p data-i18n-de="Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, E-Mail: support@mehaaj.de, Telefon: +49 (0) 800 634225) mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief oder E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren." data-i18n-en="To exercise your right of cancellation, you must inform us (MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, Email: support@mehaaj.de, Phone: +49 (0) 800 634225) of your decision to cancel this contract by means of a clear declaration (e.g. letter sent by post or email).">
                        Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf, E-Mail: support@mehaaj.de, Telefon: +49 (0) 800 634225) mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief oder E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.
                    </p>

                    <p class="font-semibold text-[#1c1210] pt-2" data-i18n-de="Folgen des Widerrufs" data-i18n-en="Consequences of Cancellation">Folgen des Widerrufs</p>
                    <p data-i18n-de="Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschließlich der Lieferkosten, unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist." data-i18n-en="If you cancel this contract, we shall reimburse to you all payments received from you, including delivery costs, without undue delay and at the latest within fourteen days from the day on which we received notification of your cancellation of this contract.">
                        Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschließlich der Lieferkosten, unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist.
                    </p>
                </div>
            </div>

            <div class="rounded-md border border-[#e6decb] bg-white p-6 shadow-sm">
                <h2 class="font-display text-2xl font-medium text-[#1c1210]" data-i18n-de="Muster-Widerrufsformular" data-i18n-en="Standard Cancellation Form Template">Muster-Widerrufsformular</h2>
                <p class="mt-2 text-xs text-[#8c7c72]" data-i18n-de="Wenn Sie den Vertrag widerrufen wollen, können Sie dieses Formular ausfüllen und an uns zurücksenden:" data-i18n-en="If you wish to cancel the contract, you may complete and return this form:">Wenn Sie den Vertrag widerrufen wollen, können Sie dieses Formular ausfüllen und an uns zurücksenden:</p>
                
                <div class="mt-4 rounded-sm border border-[#e6decb] bg-[#faf7f2] p-4 font-mono text-[0.72rem] text-[#3d332d] space-y-2">
                    <p data-i18n-de="An: MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf (E-Mail: support@mehaaj.de)" data-i18n-en="To: MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf (Email: support@mehaaj.de)">An: MEHAAJ GmbH, Königsallee 42, 40212 Düsseldorf (E-Mail: support@mehaaj.de)</p>
                    <p data-i18n-de="Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der folgenden Waren (*):" data-i18n-en="I/We (*) hereby give notice that I/We (*) cancel my/our (*) contract of sale for the following goods (*):">Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der folgenden Waren (*):</p>
                    <p data-i18n-de="Bestellt am (*)/erhalten am (*): ______________________" data-i18n-en="Ordered on (*)/received on (*): ______________________">Bestellt am (*)/erhalten am (*): ______________________</p>
                    <p data-i18n-de="Name des/der Verbraucher(s): ______________________" data-i18n-en="Name of consumer(s): ______________________">Name des/der Verbraucher(s): ______________________</p>
                    <p data-i18n-de="Anschrift des/der Verbraucher(s): ______________________" data-i18n-en="Address of consumer(s): ______________________">Anschrift des/der Verbraucher(s): ______________________</p>
                    <p data-i18n-de="Datum / Unterschrift (nur bei Mitteilung auf Papier): ______________________" data-i18n-en="Date / Signature (only if notified on paper): ______________________">Datum / Unterschrift (nur bei Mitteilung auf Papier): ______________________</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
