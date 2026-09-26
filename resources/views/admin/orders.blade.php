@extends('layouts.admin')
@section('title', 'Bestellungen & Vorkasse - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">
        <span data-i18n-de="MEHAAJ E-Commerce Atelier" data-i18n-en="MEHAAJ E-Commerce Atelier">MEHAAJ E-Commerce Atelier</span> 
        <span class="mx-1.5 opacity-60 font-mono">></span> 
        <span class="text-slate-900 dark:text-white font-bold" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
    </div>

    <!-- Header Banner -->
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between border-b border-slate-200 dark:border-slate-800 pb-5">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/60 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#2563eb] dark:text-[#60a5fa]">
                <span data-i18n-de="BESTELLUNGS-VERWALTUNG" data-i18n-en="ORDER MANAGEMENT">BESTELLUNGS-VERWALTUNG</span>
            </div>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 dark:text-white" data-i18n-de="Bestellungen & Vorkasse-Prüfung" data-i18n-en="Orders & Prepayment Verification">Bestellungen & Vorkasse-Prüfung</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1" data-i18n-de="Überprüfen Sie eingehende Banküberweisungen (IBAN DE89 3704 0044 0532 0130 00) & geben Sie DHL Express Sendungen frei." data-i18n-en="Verify incoming bank wire transfers (IBAN DE89 3704 0044 0532 0130 00) and release DHL Express shipments.">Überprüfen Sie eingehende Banküberweisungen (IBAN DE89 3704 0044 0532 0130 00) & geben Sie DHL Express Sendungen frei.</p>
        </div>

        <button type="button" onclick="const isEn=(window.__mehaaj_lang||localStorage.getItem('mehaaj_admin_lang'))==='en'; LuxuryToast.fire({icon: 'success', title: isEn ? 'Bank Deposits Synchronized ✓' : 'Banküberweisungen Synchronisiert ✓'})" class="rounded-xl bg-[#22c55e] px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-md hover:bg-emerald-700 transition flex items-center gap-2 cursor-pointer">
            <span data-i18n-de="🔄 Bankeingänge Synchronisieren" data-i18n-en="🔄 Sync Bank Deposits">🔄 Bankeingänge Synchronisieren</span>
        </button>
    </div>

    <!-- Orders Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2 text-xs border-b border-slate-200 dark:border-slate-800 pb-4">
        <button class="rounded-full bg-[#2563eb] px-4 py-1.5 font-bold text-white shadow-sm" data-i18n-de="Alle (142)" data-i18n-en="All (142)">Alle (142)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-amber-600 dark:text-amber-400" data-i18n-de="🏛️ Vorkasse Offen (38)" data-i18n-en="🏛️ Prepayment Pending (38)">🏛️ Vorkasse Offen (38)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-slate-700 dark:text-slate-300" data-i18n-de="Bezahlt & Bereit für DHL (84)" data-i18n-en="Paid & Ready for DHL (84)">Bezahlt & Bereit für DHL (84)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-slate-700 dark:text-slate-300" data-i18n-de="Versendet (20)" data-i18n-en="Shipped (20)">Versendet (20)</button>
    </div>

    <!-- Orders Table -->
    <div class="admin-card rounded-2xl border p-6 shadow-sm space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head uppercase text-[0.65rem] font-bold tracking-wider">
                    <tr>
                        <th class="p-3" data-i18n-de="Order Ref" data-i18n-en="Order Ref">Order Ref</th>
                        <th class="p-3" data-i18n-de="Datum" data-i18n-en="Date">Datum</th>
                        <th class="p-3" data-i18n-de="Kunde / Lieferadresse" data-i18n-en="Customer / Delivery Address">Kunde / Lieferadresse</th>
                        <th class="p-3" data-i18n-de="Zahlungsmittel" data-i18n-en="Payment Method">Zahlungsmittel</th>
                        <th class="p-3" data-i18n-de="Betrag" data-i18n-en="Amount">Betrag</th>
                        <th class="p-3" data-i18n-de="Zahlungsstatus" data-i18n-en="Payment Status">Zahlungsstatus</th>
                        <th class="p-3 text-right" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80 font-medium">
                    <tr class="admin-table-row transition">
                        <td class="p-3 font-mono text-[#2563eb] font-bold">MHJ-2026-8942</td>
                        <td class="p-3">20. Sep 2026</td>
                        <td class="p-3">
                            <p class="font-bold text-slate-900 dark:text-white">Maximilian Mustermann</p>
                            <p class="text-[0.65rem] text-slate-500 dark:text-slate-400">Königsallee 42, 40212 Düsseldorf</p>
                        </td>
                        <td class="p-3" data-i18n-de="🏛️ Vorkasse / Überweisung" data-i18n-en="🏛️ Prepayment / Bank Wire">🏛️ Vorkasse / Überweisung</td>
                        <td class="p-3 font-bold text-slate-900 dark:text-white">EUR 418,00</td>
                        <td class="p-3">
                            <span class="rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 px-2.5 py-1 text-[0.62rem] font-bold uppercase" data-i18n-de="Warte auf Überweisung" data-i18n-en="Awaiting Bank Transfer">Warte auf Überweisung</span>
                        </td>
                        <td class="p-3 text-right space-x-1">
                            <button type="button" onclick="const isEn=(window.__mehaaj_lang||localStorage.getItem('mehaaj_admin_lang'))==='en'; LuxurySwal.fire({icon: 'success', title: isEn ? 'Payment marked as received! 💶' : 'Zahlung als Empfangen markiert! 💶', text: isEn ? 'DHL Express label generated.' : 'DHL Express Label wird jetzt generiert.'})" class="rounded-lg bg-[#22c55e] hover:bg-emerald-700 px-2.5 py-1 text-[0.6rem] font-bold text-white cursor-pointer shadow-sm" data-i18n-de="Zahlung Freigeben" data-i18n-en="Approve Payment">Zahlung Freigeben</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
