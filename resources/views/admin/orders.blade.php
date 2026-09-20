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
                <span>BESTELLUNGS-VERWALTUNG</span>
            </div>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Bestellungen & Vorkasse-Prüfung</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Überprüfen Sie eingehende Banküberweisungen (IBAN `DE89 3704 0044 0532 0130 00`) & geben Sie DHL Express Sendungen frei.</p>
        </div>

        <button type="button" onclick="LuxuryToast.fire({icon: 'success', title: 'Banküberweisungen Synchronisiert ✓'})" class="rounded-xl bg-[#22c55e] px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-md hover:bg-emerald-700 transition flex items-center gap-2 cursor-pointer">
            <span>🔄 Bankeingänge Synchronisieren</span>
        </button>
    </div>

    <!-- Orders Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2 text-xs border-b border-slate-200 dark:border-slate-800 pb-4">
        <button class="rounded-full bg-[#2563eb] px-4 py-1.5 font-bold text-white shadow-sm">Alle (142)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-amber-600 dark:text-amber-400">🏛️ Vorkasse Offen (38)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-slate-700 dark:text-slate-300">Bezahlt & Bereit für DHL (84)</button>
        <button class="rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 px-4 py-1.5 font-bold text-slate-700 dark:text-slate-300">Versendet (20)</button>
    </div>

    <!-- Orders Table -->
    <div class="admin-card rounded-2xl border p-6 shadow-sm space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head uppercase text-[0.65rem] font-bold tracking-wider">
                    <tr>
                        <th class="p-3">Order Ref</th>
                        <th class="p-3">Datum</th>
                        <th class="p-3">Kunde / Lieferadresse</th>
                        <th class="p-3">Zahlungsmittel</th>
                        <th class="p-3">Betrag</th>
                        <th class="p-3">Zahlungsstatus</th>
                        <th class="p-3 text-right">Aktionen</th>
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
                        <td class="p-3">🏛️ Vorkasse / Überweisung</td>
                        <td class="p-3 font-bold text-slate-900 dark:text-white">EUR 418,00</td>
                        <td class="p-3">
                            <span class="rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 px-2.5 py-1 text-[0.62rem] font-bold uppercase">Warte auf Überweisung</span>
                        </td>
                        <td class="p-3 text-right space-x-1">
                            <button type="button" onclick="LuxurySwal.fire({icon: 'success', title: 'Zahlung als Empfangen markiert! 💶', text: 'DHL Express Label wird jetzt generiert.'})" class="rounded-lg bg-[#22c55e] hover:bg-emerald-700 px-2.5 py-1 text-[0.6rem] font-bold text-white cursor-pointer shadow-sm">Zahlung Freigeben</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
