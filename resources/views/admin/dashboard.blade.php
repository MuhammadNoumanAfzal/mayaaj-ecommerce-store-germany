@extends('layouts.admin')
@section('title', 'MEHAAJ Admin Intelligence Dashboard')

@section('admin-content')
<div class="space-y-6">

    <!-- White Breadcrumb Capsule Container -->
    <div class="bg-white rounded-xl shadow-xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-100 flex items-center justify-between">
        <div>
            <span data-i18n-de="MEHAAJ E-Commerce Atelier" data-i18n-en="MEHAAJ E-Commerce Atelier">MEHAAJ E-Commerce Atelier</span> 
            <span class="mx-1.5 text-slate-400 font-mono">></span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Dashboard" data-i18n-en="Dashboard">Dashboard</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium">
            System Status: <span class="text-emerald-600 font-bold">Online ✓</span>
        </div>
    </div>

    <!-- Executive Hero Intelligence Welcome Panel (White Theme with Emerald Accents) -->
    <div class="rounded-2xl p-7 shadow-xs relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6" style="background-color: #ffffff !important; color: #0f172a !important; border: 1px solid #e2e8f0 !important;">
        <!-- Ambient Background Glow Circle -->
        <div class="pointer-events-none absolute -right-16 -bottom-16 h-64 w-64 rounded-full blur-2xl" style="background-color: rgba(16, 185, 129, 0.08) !important;"></div>
        
        <div class="relative z-10 space-y-2">
            <p class="text-[0.68rem] font-bold uppercase tracking-[0.2em]" style="color: #059669 !important;" data-i18n-de="MEHAAJ Atelier | Admin Intelligence Panel" data-i18n-en="MEHAAJ Atelier | Admin Intelligence Panel">MEHAAJ Atelier | Admin Intelligence Panel</p>
            <h1 class="font-black text-2xl sm:text-3xl tracking-tight" style="color: #0f172a !important;">
                <span data-i18n-de="Willkommen zurück, Admin" data-i18n-en="Welcome back, Admin">Willkommen zurück, Admin</span>
            </h1>
            <div class="pt-1">
                <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-medium shadow-2xs" style="background-color: #ecfdf5 !important; color: #047857 !important; border: 1px solid #a7f3d0 !important;">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span data-i18n-de="Ihre Live-Betriebsübersicht ist auf dem neuesten Stand" data-i18n-en="Your live operations summary is updated now">Ihre Live-Betriebsübersicht ist auf dem neuesten Stand</span>
                </span>
            </div>
        </div>

        <!-- Date Pill -->
        <div class="relative z-10">
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold shadow-2xs" style="background-color: #ffffff !important; color: #334155 !important; border: 1px solid #e2e8f0 !important;">
                <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span>{{ date('D, d M Y') }}</span>
            </span>
        </div>
    </div>

    <!-- 4 Stat Metric Cards (Executive Card Design with SVG Gradient Badges) -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        
        <!-- Card 1: Contact Messages / Sales -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Kontakt Anfragen" data-i18n-en="Contact Messages">Kontakt Anfragen</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-indigo flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">26</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: 2" data-i18n-en="This month: 2">Diesen Monat: 2</span>
                <span class="rounded-full badge-soft-active font-extrabold px-2.5 py-0.5 text-[0.68rem]">+100%</span>
            </div>
        </div>

        <!-- Card 2: Consultations / Orders -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Beratungstermine" data-i18n-en="Consultations">Beratungstermine</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-emerald flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">1</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: 0" data-i18n-en="This month: 0">Diesen Monat: 0</span>
                <span class="rounded-full badge-soft-indigo font-extrabold px-2.5 py-0.5 text-[0.68rem]">+8%</span>
            </div>
        </div>

        <!-- Card 3: Event Reservations / Products -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Event Reservierungen" data-i18n-en="Event Reservations">Event Reservierungen</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-amber flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">2</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: 0" data-i18n-en="This month: 0">Diesen Monat: 0</span>
                <span class="rounded-full badge-soft-pending font-extrabold px-2.5 py-0.5 text-[0.68rem]">+12%</span>
            </div>
        </div>

        <!-- Card 4: Published Content / VIP Customers -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Aktive Kunden" data-i18n-en="Active Customers">Aktive Kunden</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-rose flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">2</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: 0" data-i18n-en="This month: 0">Diesen Monat: 0</span>
                <span class="rounded-full badge-soft-rose font-extrabold px-2.5 py-0.5 text-[0.68rem]">+25%</span>
            </div>
        </div>

    </div>

    <!-- 2-Column Main Bottom Grid (Inquiries Trend & Quality Snapshot) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left Column: Inquiries Trend (8 Cols) -->
        <div class="lg:col-span-8 exec-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Eingehende Bestellungen & Anfragen" data-i18n-en="Recent Inquiries & Orders">Eingehende Bestellungen & Anfragen</h2>
                    <p class="text-xs text-slate-500 mt-0.5" data-i18n-de="Übersicht aller Kontakte, Bestellungen und Vorkasse-Eingänge" data-i18n-en="Overview of contacts, orders and bank prepayments">Übersicht aller Kontakte, Bestellungen und Vorkasse-Eingänge</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 hover:underline" data-i18n-de="Alle Anzeigen →" data-i18n-en="View All →">Alle Anzeigen →</a>
            </div>

            <!-- Orders & Inquiries Table -->
            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="exec-table-head">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Bestell-Nr." data-i18n-en="Order Ref">Bestell-Nr.</th>
                            <th class="p-3.5" data-i18n-de="Kunde" data-i18n-en="Customer">Kunde</th>
                            <th class="p-3.5" data-i18n-de="Zahlungsart" data-i18n-en="Payment">Zahlungsart</th>
                            <th class="p-3.5" data-i18n-de="Betrag" data-i18n-en="Amount">Betrag</th>
                            <th class="p-3.5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                            <th class="p-3.5 text-right" data-i18n-de="Aktion" data-i18n-en="Action">Aktion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        <tr class="exec-table-row">
                            <td class="p-3.5 font-mono text-indigo-600 font-bold">MHJ-2026-8942</td>
                            <td class="p-3.5 font-bold text-slate-900">Maximilian Mustermann</td>
                            <td class="p-3.5 text-slate-600">🏛️ Banküberweisung (Vorkasse)</td>
                            <td class="p-3.5 font-bold text-slate-900">EUR 418,00</td>
                            <td class="p-3.5">
                                <span class="rounded-full badge-soft-pending px-2.5 py-1 text-[0.62rem] font-bold uppercase" data-i18n-de="Warte auf Zahlung" data-i18n-en="Awaiting Payment">Warte auf Zahlung</span>
                            </td>
                            <td class="p-3.5 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-8942'})" class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer shadow-2xs" data-i18n-de="Details" data-i18n-en="Details">Details</button>
                            </td>
                        </tr>

                        <tr class="exec-table-row">
                            <td class="p-3.5 font-mono text-indigo-600 font-bold">MHJ-2026-7819</td>
                            <td class="p-3.5 font-bold text-slate-900">Victoria von Berg</td>
                            <td class="p-3.5 text-slate-600">💳 Kreditkarte (Visa)</td>
                            <td class="p-3.5 font-bold text-slate-900">EUR 590,00</td>
                            <td class="p-3.5">
                                <span class="rounded-full badge-soft-active px-2.5 py-1 text-[0.62rem] font-bold uppercase" data-i18n-de="Bezahlt & Versendet" data-i18n-en="Paid & Shipped">Bezahlt & Versendet</span>
                            </td>
                            <td class="p-3.5 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-7819'})" class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer shadow-2xs" data-i18n-de="Details" data-i18n-en="Details">Details</button>
                            </td>
                        </tr>

                        <tr class="exec-table-row">
                            <td class="p-3.5 font-mono text-indigo-600 font-bold">MHJ-2026-6540</td>
                            <td class="p-3.5 font-bold text-slate-900">Dr. Florian Hoffmann</td>
                            <td class="p-3.5 text-slate-600">🅿️ PayPal Express</td>
                            <td class="p-3.5 font-bold text-slate-900">EUR 129,00</td>
                            <td class="p-3.5">
                                <span class="rounded-full badge-soft-active px-2.5 py-1 text-[0.62rem] font-bold uppercase" data-i18n-de="Bezahlt" data-i18n-en="Paid">Bezahlt</span>
                            </td>
                            <td class="p-3.5 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-6540'})" class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer shadow-2xs" data-i18n-de="Details" data-i18n-en="Details">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bottom Trend Dots Legend -->
            <div class="pt-3 flex items-center justify-center gap-6 text-xs text-slate-600 font-semibold border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-500"></span>
                    <span data-i18n-de="Kontakte" data-i18n-en="Contacts">Kontakte</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                    <span data-i18n-de="Beratungen" data-i18n-en="Consultations">Beratungen</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                    <span data-i18n-de="Reservierungen" data-i18n-en="Reservations">Reservierungen</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Quality Snapshot (4 Cols) -->
        <div class="lg:col-span-4 exec-card p-6 space-y-6 flex flex-col justify-between">
            <div>
                <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Qualitäts-Übersicht" data-i18n-en="Quality Snapshot">Qualitäts-Übersicht</h2>
                <p class="text-xs text-slate-500 mt-0.5" data-i18n-de="Operationalität und Systemgesundheit" data-i18n-en="Operational quality and content health">Operationalität und Systemgesundheit</p>

                <div class="mt-6 space-y-5">
                    <!-- Progress Item 1 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700" data-i18n-de="Bestellabwicklungs-Quote" data-i18n-en="Order Fulfillment Rate">Bestellabwicklungs-Quote</span>
                            <span class="text-emerald-600">98%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-emerald-500 w-[98%] shadow-xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 2 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700" data-i18n-de="Zahlungs-Freigaben (Vorkasse)" data-i18n-en="Prepayment Approvals">Zahlungs-Freigaben (Vorkasse)</span>
                            <span class="text-indigo-600">92%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-indigo-500 w-[92%] shadow-xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 3 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700" data-i18n-de="Kunden-Zufriedenheit" data-i18n-en="Customer Satisfaction">Kunden-Zufriedenheit</span>
                            <span class="text-amber-600">96%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-amber-500 w-[96%] shadow-xs"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Direct Action Card -->
            <div class="p-4 rounded-xl border border-indigo-100 flex items-center justify-between" style="background-color: #f5f3ff !important;">
                <div>
                    <p class="font-extrabold text-xs text-indigo-900" data-i18n-de="System-Einstellungen" data-i18n-en="System Settings">System-Einstellungen</p>
                    <p class="text-[0.68rem] text-indigo-700 font-medium" data-i18n-de="Zahlungs-IBAN & Shop konfigurieren" data-i18n-en="Configure payment IBAN & store settings">Zahlungs-IBAN & Shop konfigurieren</p>
                </div>
                <a href="{{ route('admin.settings') }}" class="rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 text-xs font-bold transition cursor-pointer shadow-xs" data-i18n-de="Öffnen" data-i18n-en="Open">Öffnen</a>
            </div>
        </div>

    </div>

</div>
@endsection
