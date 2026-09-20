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

    <!-- Executive Hero Intelligence Welcome Panel -->
    <div class="rounded-2xl p-7 shadow-md relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%) !important; color: #ffffff !important; border: 1px solid #1e293b !important;">
        <!-- Ambient Background Glow Circle -->
        <div class="pointer-events-none absolute -right-16 -bottom-16 h-64 w-64 rounded-full blur-2xl" style="background-color: rgba(99, 102, 241, 0.15) !important;"></div>
        
        <div class="relative z-10 space-y-2">
            <p class="text-[0.68rem] font-bold uppercase tracking-[0.2em]" style="color: #818cf8 !important;" data-i18n-de="MEHAAJ Atelier | Admin Intelligence Panel" data-i18n-en="MEHAAJ Atelier | Admin Intelligence Panel">MEHAAJ Atelier | Admin Intelligence Panel</p>
            <h1 class="font-black text-2xl sm:text-3xl tracking-tight" style="color: #ffffff !important;">
                <span data-i18n-de="Willkommen zurück, Admin" data-i18n-en="Welcome back, Admin">Willkommen zurück, Admin</span>
            </h1>
            <div class="pt-1">
                <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-medium shadow-sm" style="background-color: #1e293b !important; color: #e2e8f0 !important; border: 1px solid #334155 !important;">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span data-i18n-de="Ihre Live-Betriebsübersicht ist auf dem neuesten Stand" data-i18n-en="Your live operations summary is updated now">Ihre Live-Betriebsübersicht ist auf dem neuesten Stand</span>
                </span>
            </div>
        </div>

        <!-- Date Pill -->
        <div class="relative z-10">
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold shadow-md" style="background-color: #1e293b !important; color: #e2e8f0 !important; border: 1px solid #334155 !important;">
                <svg class="h-4 w-4" style="color: #818cf8 !important;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span>{{ date('D, d M Y') }}</span>
            </span>
        </div>
    </div>

    <!-- 4 Stat Metric Cards (Pure White Card, Solid Rounded Icon Blocks & Growth Badges) -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        
        <!-- Card 1: Contact Messages / Sales -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500" data-i18n-de="Contact Messages" data-i18n-en="Contact Messages">Contact Messages</span>
                    <div class="h-12 w-12 rounded-2xl bg-[#3b82f6] text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        💶
                    </div>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">26</p>
            </div>
            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="This month: 2" data-i18n-en="This month: 2">This month: 2</span>
                <span class="rounded-full bg-emerald-100 text-emerald-700 font-bold px-2.5 py-0.5 text-xs">+100%</span>
            </div>
        </div>

        <!-- Card 2: Consultations / Orders -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500" data-i18n-de="Consultations" data-i18n-en="Consultations">Consultations</span>
                    <div class="h-12 w-12 rounded-2xl bg-[#22c55e] text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        📦
                    </div>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">1</p>
            </div>
            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="This month: 0" data-i18n-en="This month: 0">This month: 0</span>
                <span class="rounded-full bg-blue-100 text-blue-700 font-bold px-2.5 py-0.5 text-xs">+8%</span>
            </div>
        </div>

        <!-- Card 3: Event Reservations / Products -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500" data-i18n-de="Event Reservations" data-i18n-en="Event Reservations">Event Reservations</span>
                    <div class="h-12 w-12 rounded-2xl bg-[#f59e0b] text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        🛍️
                    </div>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">2</p>
            </div>
            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="This month: 0" data-i18n-en="This month: 0">This month: 0</span>
                <span class="rounded-full bg-purple-100 text-purple-700 font-bold px-2.5 py-0.5 text-xs">+12%</span>
            </div>
        </div>

        <!-- Card 4: Published Content / VIP Customers -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500" data-i18n-de="Published Content" data-i18n-en="Published Content">Published Content</span>
                    <div class="h-12 w-12 rounded-2xl bg-[#f43f5e] text-white flex items-center justify-center text-xl font-bold shadow-sm">
                        👥
                    </div>
                </div>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">2</p>
            </div>
            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Posts this month: 0" data-i18n-en="Posts this month: 0">Posts this month: 0</span>
                <span class="rounded-full bg-rose-100 text-rose-700 font-bold px-2.5 py-0.5 text-xs">+25%</span>
            </div>
        </div>

    </div>

    <!-- 2-Column Main Bottom Grid (Inquiries Trend & Quality Snapshot) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left Column: Inquiries Trend (8 Cols) -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 shadow-sm border border-slate-100 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="font-bold text-base text-slate-900" data-i18n-de="Inquiries Trend" data-i18n-en="Inquiries Trend">Inquiries Trend</h2>
                    <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Contacts, consultations and reservations over the last 6 months" data-i18n-en="Contacts, consultations and reservations over the last 6 months">Contacts, consultations and reservations over the last 6 months</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#194AA2] hover:underline" data-i18n-de="View All →" data-i18n-en="View All →">View All →</a>
            </div>

            <!-- Orders & Inquiries Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 uppercase text-[0.65rem] font-bold tracking-wider text-slate-500">
                        <tr>
                            <th class="p-3">Order Ref</th>
                            <th class="p-3">Kunde</th>
                            <th class="p-3">Zahlungsart</th>
                            <th class="p-3">Betrag</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Aktion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-3 font-mono text-[#194AA2] font-bold">MHJ-2026-8942</td>
                            <td class="p-3 font-bold text-slate-900">Maximilian Mustermann</td>
                            <td class="p-3 text-slate-600">🏛️ Banküberweisung (Vorkasse)</td>
                            <td class="p-3 font-bold text-slate-900">EUR 418,00</td>
                            <td class="p-3">
                                <span class="rounded-full bg-amber-100 text-amber-800 px-2.5 py-1 text-[0.62rem] font-bold uppercase">Warte auf Zahlung</span>
                            </td>
                            <td class="p-3 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-8942'})" class="rounded-lg bg-[#194AA2] hover:bg-blue-800 px-3 py-1 text-[0.6rem] font-bold text-white cursor-pointer shadow-xs">Details</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-3 font-mono text-[#194AA2] font-bold">MHJ-2026-7819</td>
                            <td class="p-3 font-bold text-slate-900">Victoria von Berg</td>
                            <td class="p-3 text-slate-600">💳 Kreditkarte (Visa)</td>
                            <td class="p-3 font-bold text-slate-900">EUR 590,00</td>
                            <td class="p-3">
                                <span class="rounded-full bg-emerald-100 text-emerald-800 px-2.5 py-1 text-[0.62rem] font-bold uppercase">Bezahlt & Versendet</span>
                            </td>
                            <td class="p-3 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-7819'})" class="rounded-lg bg-[#194AA2] hover:bg-blue-800 px-3 py-1 text-[0.6rem] font-bold text-white cursor-pointer shadow-xs">Details</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-3 font-mono text-[#194AA2] font-bold">MHJ-2026-6540</td>
                            <td class="p-3 font-bold text-slate-900">Dr. Florian Hoffmann</td>
                            <td class="p-3 text-slate-600">🅿️ PayPal Express</td>
                            <td class="p-3 font-bold text-slate-900">EUR 129,00</td>
                            <td class="p-3">
                                <span class="rounded-full bg-emerald-100 text-emerald-800 px-2.5 py-1 text-[0.62rem] font-bold uppercase">Bezahlt</span>
                            </td>
                            <td class="p-3 text-right">
                                <button type="button" onclick="LuxuryToast.fire({icon: 'info', title: 'Bestelldetails MHJ-2026-6540'})" class="rounded-lg bg-[#194AA2] hover:bg-blue-800 px-3 py-1 text-[0.6rem] font-bold text-white cursor-pointer shadow-xs">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bottom Trend Dots Legend -->
            <div class="pt-3 flex items-center justify-center gap-6 text-xs text-slate-600 font-semibold border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#3b82f6]"></span>
                    <span>Contacts</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#22c55e]"></span>
                    <span>Consultations</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#f59e0b]"></span>
                    <span>Reservations</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Quality Snapshot (4 Cols) -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-6 shadow-sm border border-slate-100 space-y-6 flex flex-col justify-between">
            <div>
                <h2 class="font-bold text-base text-slate-900" data-i18n-de="Quality Snapshot" data-i18n-en="Quality Snapshot">Quality Snapshot</h2>
                <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Operational quality and content health" data-i18n-en="Operational quality and content health">Operational quality and content health</p>

                <div class="mt-6 space-y-5">
                    <!-- Progress Item 1 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">Order Fulfillment Rate</span>
                            <span class="text-emerald-600">98%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#22c55e] w-[98%] shadow-xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 2 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">Vorkasse Verification Rate</span>
                            <span class="text-blue-600">95%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#194AA2] w-[95%] shadow-xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 3 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">System & API Health</span>
                            <span class="text-emerald-600">100%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#22c55e] w-[100%] shadow-xs"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 text-xs space-y-1 text-center">
                <p class="font-bold text-slate-800">MEHAAJ Atelier Engine Active</p>
                <p class="text-[0.68rem] text-slate-500">Live SSL 256-bit encryption & Deutsche Bank Vorkasse API connected.</p>
            </div>
        </div>

    </div>

</div>
@endsection
