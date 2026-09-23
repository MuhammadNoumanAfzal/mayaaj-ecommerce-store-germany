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
        
        <!-- Card 1: Contact Messages -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Kontakt Anfragen" data-i18n-en="Contact Messages">Kontakt Anfragen</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-indigo flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">{{ $contactMessagesCount }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: {{ $contactMessagesThisMonth }}" data-i18n-en="This month: {{ $contactMessagesThisMonth }}">Diesen Monat: {{ $contactMessagesThisMonth }}</span>
                <span class="rounded-full badge-soft-active font-extrabold px-2.5 py-0.5 text-[0.68rem]">Live DB</span>
            </div>
        </div>

        <!-- Card 2: Orders & Prepayments -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-emerald flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">{{ $ordersCount }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: {{ $ordersThisMonth }}" data-i18n-en="This month: {{ $ordersThisMonth }}">Diesen Monat: {{ $ordersThisMonth }}</span>
                <span class="rounded-full badge-soft-indigo font-extrabold px-2.5 py-0.5 text-[0.68rem]">Live DB</span>
            </div>
        </div>

        <!-- Card 3: Products Catalog -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Katalog Produkte" data-i18n-en="Catalog Products">Katalog Produkte</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-amber flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">{{ $productsCount }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: {{ $productsThisMonth }}" data-i18n-en="This month: {{ $productsThisMonth }}">Diesen Monat: {{ $productsThisMonth }}</span>
                <span class="rounded-full badge-soft-pending font-extrabold px-2.5 py-0.5 text-[0.68rem]">Live DB</span>
            </div>
        </div>

        <!-- Card 4: Customers -->
        <div class="exec-card p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500" data-i18n-de="Aktive Kunden" data-i18n-en="Active Customers">Aktive Kunden</span>
                    <div class="h-11 w-11 rounded-2xl stat-badge-rose flex items-center justify-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">{{ $customersCount }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium" data-i18n-de="Diesen Monat: {{ $customersThisMonth }}" data-i18n-en="This month: {{ $customersThisMonth }}">Diesen Monat: {{ $customersThisMonth }}</span>
                <span class="rounded-full badge-soft-rose font-extrabold px-2.5 py-0.5 text-[0.68rem]">Live DB</span>
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

            <!-- Orders Table -->
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
                        @forelse($recentOrders as $order)
                        <tr class="exec-table-row">
                            <td class="p-3.5 font-mono text-indigo-600 font-bold">{{ $order->order_number }}</td>
                            <td class="p-3.5 font-bold text-slate-900">{{ $order->customer_name }}</td>
                            <td class="p-3.5 text-slate-600">
                                @if($order->payment_method === 'vorkasse')
                                    🏛️ Banküberweisung (Vorkasse)
                                @elseif($order->payment_method === 'paypal')
                                    🅿️ PayPal Express
                                @else
                                    💳 Kreditkarte
                                @endif
                            </td>
                            <td class="p-3.5 font-bold text-slate-900">EUR {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                            <td class="p-3.5">
                                @if($order->status === 'pending')
                                    <span class="rounded-full badge-soft-pending px-2.5 py-1 text-[0.62rem] font-bold uppercase" data-i18n-de="Warte auf Zahlung" data-i18n-en="Awaiting Payment">Warte auf Zahlung</span>
                                @elseif($order->status === 'delivered' || $order->payment_status === 'paid')
                                    <span class="rounded-full badge-soft-active px-2.5 py-1 text-[0.62rem] font-bold uppercase">{{ $order->status }}</span>
                                @else
                                    <span class="rounded-full badge-soft-indigo px-2.5 py-1 text-[0.62rem] font-bold uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right">
                                <a href="{{ route('admin.orders') }}" class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer shadow-2xs" data-i18n-de="Details" data-i18n-en="Details">Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 font-medium">
                                <div class="flex flex-col items-center justify-center space-y-1 py-3">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    <p class="text-xs text-slate-500 font-semibold" data-i18n-de="Noch keine Bestellungen im System" data-i18n-en="No orders in the system yet">Noch keine Bestellungen im System</p>
                                    <p class="text-[0.7rem] text-slate-400" data-i18n-de="Neue Kundenbestellungen werden hier automatisch in Echtzeit angezeigt." data-i18n-en="New customer orders will automatically appear here in real-time.">Neue Kundenbestellungen werden hier automatisch in Echtzeit angezeigt.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Recent Contact Messages Section -->
            <div class="pt-4 border-t border-slate-100 space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-xs text-slate-800 tracking-tight uppercase" data-i18n-de="Neueste Kontaktanfragen" data-i18n-en="Recent Contact Inquiries">Neueste Kontaktanfragen</h3>
                    <a href="{{ route('admin.messages') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline" data-i18n-de="Alle Nachrichten →" data-i18n-en="All Messages →">Alle Nachrichten →</a>
                </div>
                <div class="overflow-x-auto border border-slate-100 rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="exec-table-head">
                            <tr>
                                <th class="p-3" data-i18n-de="Ticket-ID" data-i18n-en="Ticket ID">Ticket-ID</th>
                                <th class="p-3" data-i18n-de="Absender" data-i18n-en="Sender">Absender</th>
                                <th class="p-3" data-i18n-de="Betreff" data-i18n-en="Subject">Betreff</th>
                                <th class="p-3" data-i18n-de="Datum" data-i18n-en="Date">Datum</th>
                                <th class="p-3 text-right" data-i18n-de="Aktion" data-i18n-en="Action">Aktion</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            @forelse($recentMessages as $msg)
                            <tr class="exec-table-row">
                                <td class="p-3 font-mono text-emerald-600 font-bold">MSG-{{ str_pad($msg->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="p-3 font-bold text-slate-900">{{ $msg->name }} <span class="text-slate-400 font-normal">({{ $msg->email }})</span></td>
                                <td class="p-3 text-slate-700 truncate max-w-[200px]">{{ $msg->subject }}</td>
                                <td class="p-3 text-slate-500">{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 px-2.5 py-1 text-[0.7rem] font-semibold transition cursor-pointer shadow-2xs" data-i18n-de="Ansehen" data-i18n-en="View">Ansehen</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-slate-400 font-medium">
                                    <p class="text-xs text-slate-500" data-i18n-de="Keine Kontaktanfragen vorhanden." data-i18n-en="No contact inquiries yet.">Keine Kontaktanfragen vorhanden.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
