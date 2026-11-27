@extends('layouts.admin')
@section('title', 'Atelier Waitlist & Demand Intelligence - MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- Top Luxury Header Card -->
    <div class="relative bg-white rounded-3xl border border-[#ebdccb] shadow-xs p-5 sm:p-6 overflow-hidden">
        <!-- Luxury Gold & Wine Top Accent Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-1">
            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-[#78000b]"></span>
                    <span class="text-[0.65rem] font-black uppercase tracking-wider text-[#78000b]" data-i18n-de="WARTELISTE & NACHFRAGE-ANALYSE" data-i18n-en="BACK-IN-STOCK WAITLIST & RESTOCK DEMAND INTELLIGENCE">BACK-IN-STOCK WAITLIST & RESTOCK DEMAND INTELLIGENCE</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#1c1210] tracking-tight mt-1" data-i18n-de="Atelier Warteliste & Nachfrage-Audit" data-i18n-en="Atelier Waitlist & Demand Audit">
                    Atelier Waitlist & Demand Audit
                </h1>
                <p class="text-xs text-stone-600 font-medium mt-0.5" data-i18n-de="Überwachen Sie die ungedeckte Kaufnachfrage ausverkaufter Kreationen und benachrichtigen Sie wartende Kunden mit 1 Klick." data-i18n-en="Monitor unmet purchasing demand for sold-out creations and notify waiting patrons with one click.">
                    Monitor unmet purchasing demand for sold-out creations and notify waiting patrons with one click.
                </p>
            </div>

            <!-- Total Requests Badge -->
            <div class="flex items-center gap-2 shrink-0">
                <span class="rounded-xl border border-[#ebdccb] bg-[#faf7f2] px-3.5 py-2 text-xs font-bold text-[#1c1210] shadow-2xs inline-flex items-center gap-1.5">
                    <span data-i18n-de="Gesamt Einträge:" data-i18n-en="Total Entries:">Total Entries:</span>
                    <strong class="text-[#78000b] font-mono text-sm">{{ $totalWaitlistCount }}</strong>
                </span>
            </div>
        </div>

        <!-- 4 KPI Metrics Header Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4 mt-6 pt-6 border-t border-[#f1e6da]">
            <!-- 1. Latent Unmet Demand Revenue -->
            <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1.5 transition hover:shadow-sm">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-amber-900 block" data-i18n-de="LATENTES UMSATZPOTENZIAL" data-i18n-en="LATENT REVENUE POTENTIAL">LATENT REVENUE POTENTIAL</span>
                <div class="flex items-baseline justify-between gap-2">
                    <span class="text-2xl font-black text-[#1c1210]">€{{ number_format($latentRevenueDemand, 2, '.', ',') }}</span>
                    <span class="text-[0.65rem] font-bold text-amber-800 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200 shrink-0" data-i18n-de="Kaufbereit" data-i18n-en="Ready to Buy">Ready to Buy</span>
                </div>
                <p class="text-[0.65rem] text-stone-500" data-i18n-de="Umsatzwarteschlange ausverkaufter Artikel" data-i18n-en="Sales queue for sold-out creations">Sales queue for sold-out creations</p>
            </div>

            <!-- 2. Pending Waiting Patrons -->
            <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1.5 transition hover:shadow-sm">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-rose-900 block" data-i18n-de="WARTENDE KUNDEN (OFFEN)" data-i18n-en="WAITING CUSTOMERS (OPEN)">WAITING CUSTOMERS (OPEN)</span>
                <div class="flex items-baseline justify-between gap-2">
                    <span class="text-2xl font-black text-[#78000b]">{{ $pendingWaitlistCount }}</span>
                    <span class="text-[0.65rem] font-bold text-rose-800 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200 shrink-0" data-i18n-de="Wartet auf Restock" data-i18n-en="Awaiting Restock">Awaiting Restock</span>
                </div>
                <p class="text-[0.65rem] text-stone-500" data-i18n-de="Möchten bei Verfügbarkeit kaufen" data-i18n-en="Ready to order upon restock">Ready to order upon restock</p>
            </div>

            <!-- 3. Restock Alerts Dispatched -->
            <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1.5 transition hover:shadow-sm">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-emerald-900 block" data-i18n-de="RESTOCK-ALERTS VERSENDET" data-i18n-en="RESTOCK ALERTS SENT">RESTOCK ALERTS SENT</span>
                <div class="flex items-baseline justify-between gap-2">
                    <span class="text-2xl font-black text-[#065f46]">{{ $notifiedCount }}</span>
                    <span class="text-[0.65rem] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 shrink-0" data-i18n-de="Benachrichtigt" data-i18n-en="Notified">Notified</span>
                </div>
                <p class="text-[0.65rem] text-stone-500" data-i18n-de="Erfolgreich reaktivierte Käufer" data-i18n-en="Successfully reactivated patrons">Successfully reactivated patrons</p>
            </div>

            <!-- 4. Most In-Demand Piece -->
            <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1.5 transition hover:shadow-sm">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-700 block" data-i18n-de="TOP NACHFRAGE-ARTIKEL" data-i18n-en="TOP IN-DEMAND CREATION">TOP IN-DEMAND CREATION</span>
                @php $topDemand = $demandByProduct->first(); @endphp
                <div class="flex items-baseline justify-between gap-2">
                    <span class="text-sm font-bold text-[#1c1210] truncate max-w-[150px]" title="{{ $topDemand?->product?->name }}">
                        {{ $topDemand?->product?->name ?? 'None' }}
                    </span>
                    @if($topDemand)
                        <span class="text-[0.65rem] font-bold text-[#78000b] bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200 shrink-0">{{ $topDemand->waitlist_count }}x Wait</span>
                    @else
                        <span class="text-[0.65rem] font-bold text-stone-500 bg-stone-100 px-2 py-0.5 rounded-full border border-stone-200 shrink-0" data-i18n-de="Keine" data-i18n-en="None">None</span>
                    @endif
                </div>
                <p class="text-[0.65rem] text-stone-500" data-i18n-de="Höchste Dringlichkeit zur Nachproduktion" data-i18n-en="Highest urgency for replenishment">Highest urgency for replenishment</p>
            </div>
        </div>
    </div>

    <!-- Top In-Demand Pieces Showcase & 1-Click Restock Actions -->
    @if($demandByProduct->isNotEmpty())
        <div class="bg-white rounded-3xl border border-[#ebdccb] shadow-xs p-5 sm:p-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#f1e6da] pb-3.5 gap-2">
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight" data-i18n-de="Kreationen mit akuter Restock-Nachfrage" data-i18n-en="Creations with High Restock Demand">
                        Creations with High Restock Demand
                    </h2>
                    <p class="text-xs text-stone-600 mt-0.5" data-i18n-de="Klicken Sie auf 'Alerts senden', sobald neue Stücke am Packtisch oder Lager eingebucht wurden." data-i18n-en="Click 'Send Restock Alerts' once new inventory has arrived at the packing table or warehouse.">
                        Click 'Send Restock Alerts' once new inventory has arrived at the packing table or warehouse.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($demandByProduct as $dp)
                    @php $p = $dp->product; @endphp
                    @if($p)
                        <div class="rounded-2xl border border-[#ebdccb] p-4 bg-gradient-to-br from-[#faf7f2]/60 to-white hover:bg-[#faf7f2] transition space-y-3 flex flex-col justify-between shadow-2xs">
                            <div class="flex items-start gap-3">
                                <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="h-14 w-14 rounded-xl object-cover border border-[#ebdccb] shrink-0 bg-white">
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-bold text-xs text-[#1c1210] truncate" title="{{ $p->name }}">
                                        {{ $p->name }}
                                    </h3>
                                    <p class="text-[0.65rem] text-stone-500 font-mono mt-0.5">SKU: {{ $p->sku }}</p>
                                    <p class="text-xs font-black text-[#78000b] mt-1 font-mono">
                                        €{{ number_format($p->sale_price ?? $p->price, 2, '.', ',') }}
                                    </p>
                                </div>
                            </div>

                            <div class="pt-2.5 border-t border-[#ebdccb]/70 flex items-center justify-between gap-2">
                                <div class="space-y-0.5">
                                    <span class="text-[0.6rem] font-bold uppercase text-stone-500 block" data-i18n-de="Warteliste:" data-i18n-en="Waitlist:">Waitlist:</span>
                                    <span class="text-xs font-bold text-rose-800 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                        {{ $dp->waitlist_count }} <span data-i18n-de="wartende Kunden" data-i18n-en="waiting patrons">waiting patrons</span>
                                    </span>
                                </div>

                                <button 
                                    type="button" 
                                    onclick="confirmSendRestockAlerts({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $dp->waitlist_count }})"
                                    class="px-3 py-1.5 rounded-xl bg-[#78000b] hover:bg-[#5e0008] text-white text-[0.68rem] font-bold uppercase tracking-wider transition shadow-2xs cursor-pointer flex items-center gap-1.5 active:scale-95"
                                >
                                    <svg class="w-3.5 h-3.5 text-[#d8b45a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span data-i18n-de="Alerts senden" data-i18n-en="Send Alerts">Send Alerts</span>
                                </button>

                                <form id="notify-product-form-{{ $p->id }}" method="POST" action="{{ route('admin.waitlist.notify', $p->id) }}" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-3xl border border-[#ebdccb] shadow-xs p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Status Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.waitlist') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer {{ !$status ? 'bg-[#78000b] text-white' : 'bg-[#faf7f2] text-stone-700 hover:bg-[#ebdccb]/40 border border-[#ebdccb]' }}">
                <span data-i18n-de="Alle Einträge" data-i18n-en="All entries">All entries</span> ({{ $totalWaitlistCount }})
            </a>
            <a href="{{ route('admin.waitlist', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer {{ $status === 'pending' ? 'bg-[#78000b] text-white' : 'bg-[#faf7f2] text-stone-700 hover:bg-[#ebdccb]/40 border border-[#ebdccb]' }}">
                <span data-i18n-de="Wartend / Offen" data-i18n-en="Waiting / Open">Waiting / Open</span> ({{ $pendingWaitlistCount }})
            </a>
            <a href="{{ route('admin.waitlist', ['status' => 'notified']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer {{ $status === 'notified' ? 'bg-[#78000b] text-white' : 'bg-[#faf7f2] text-stone-700 hover:bg-[#ebdccb]/40 border border-[#ebdccb]' }}">
                <span data-i18n-de="Benachrichtigt" data-i18n-en="Notified">Notified</span> ({{ $notifiedCount }})
            </a>
        </div>

        <!-- Search Input & Reset Button -->
        <div class="flex items-center gap-2 w-full md:w-auto">
            <form method="GET" action="{{ route('admin.waitlist') }}" class="w-full sm:w-72">
                @if($status)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search ?? '' }}" 
                        placeholder="Search by email, customer, product, SKU..." 
                        data-i18n-placeholder-de="Nach E-Mail, Kunde, Produkt, SKU suchen..."
                        data-i18n-placeholder-en="Search by email, customer, product, SKU..."
                        class="w-full rounded-xl border border-[#ebdccb] bg-[#faf7f2] pl-9 pr-3.5 py-2 text-xs text-[#1c1210] placeholder-stone-500 focus:border-[#78000b] focus:bg-white focus:outline-none transition"
                    >
                    <svg class="w-4 h-4 text-stone-500 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>

            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.waitlist') }}" class="h-9 px-3 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-[#ebdccb] hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1 cursor-pointer shrink-0" title="Reset all filters">
                    <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Waitlist Subscribers Table -->
    <div class="bg-white rounded-3xl border border-[#ebdccb] shadow-xs overflow-hidden">
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs table-auto">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Kunde / E-Mail" data-i18n-en="Customer / Email">Customer / Email</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Angefragtes Produkt" data-i18n-en="Requested Product">Requested Product</th>
                        <th class="py-3 px-3 font-black text-center" data-i18n-de="Ausführung / Farbe" data-i18n-en="Design / Color">Design / Color</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Einzelpreis" data-i18n-en="Unit Price">Unit Price</th>
                        <th class="py-3 px-4 font-black text-center w-36" data-i18n-de="Eingetragen am" data-i18n-en="Entered On">Entered On</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-4 font-black text-center w-24" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($notifications as $notif)
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="waitlist-row-{{ $notif->id }}">
                            <!-- Index -->
                            <td class="py-3.5 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($notifications->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- Customer Info -->
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-[#1c1210]">{{ $notif->customer_name ?: 'Atelier Patron' }}</p>
                                <a href="mailto:{{ $notif->customer_email }}" class="text-[0.68rem] text-stone-500 hover:text-[#78000b] hover:underline font-mono inline-flex items-center gap-1 transition">
                                    <svg class="w-3 h-3 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span>{{ $notif->customer_email }}</span>
                                </a>
                            </td>

                            <!-- Product Info -->
                            <td class="py-3.5 px-4 max-w-xs">
                                @if($notif->product)
                                    <a href="{{ route('shop.show', $notif->product->slug) }}" target="_blank" class="font-bold text-[#1c1210] hover:text-[#78000b] transition flex items-center gap-2.5 group">
                                        <img src="{{ $notif->product->image_url }}" alt="{{ $notif->product->name }}" class="h-9 w-9 rounded-lg object-cover border border-[#ebdccb] shrink-0 bg-[#FAF7F2]">
                                        <div class="min-w-0">
                                            <span class="truncate block group-hover:underline">{{ $notif->product->name }}</span>
                                            <span class="text-[0.62rem] text-stone-500 font-mono block">SKU: {{ $notif->product->sku }}</span>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-stone-400 font-mono text-xs">Product #{{ $notif->product_id }}</span>
                                @endif
                            </td>

                            <!-- Variation -->
                            <td class="py-3.5 px-3 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-[#FAF7F2] text-[#1c1210] border border-[#ebdccb] shadow-2xs inline-block">
                                    {{ $notif->variation_name ?: 'Standard Edition' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-3.5 px-3 text-center font-mono font-bold text-[#78000b] text-xs">
                                @if($notif->product)
                                    €{{ number_format($notif->product->sale_price ?? $notif->product->price, 2, '.', ',') }}
                                @else
                                    —
                                @endif
                            </td>

                            <!-- Subscribed Date -->
                            <td class="py-3.5 px-4 text-center text-stone-600 text-[0.7rem]">
                                <span class="font-mono block text-[#1c1210] font-semibold">{{ $notif->created_at->format('d.m.Y H:i') }}</span>
                                @if($notif->notified_at)
                                    <span class="block text-[0.62rem] text-emerald-800 font-bold mt-0.5">
                                        <span data-i18n-de="Benachrichtigt:" data-i18n-en="Notified:">Notified:</span> {{ $notif->notified_at->format('d.m.Y') }}
                                    </span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3.5 px-3 text-center">
                                @if($notif->status === 'notified')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.62rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Benachrichtigt" data-i18n-en="Notified">Notified</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.62rem] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                        <span data-i18n-de="Wartend" data-i18n-en="Waiting">Waiting</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-center">
                                <button 
                                    type="button" 
                                    onclick="confirmDeleteWaitlist({{ $notif->id }}, '{{ addslashes($notif->customer_email) }}')"
                                    class="h-7 w-7 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition shadow-2xs inline-flex items-center justify-center cursor-pointer active:scale-95" 
                                    title="Delete"
                                    data-i18n-title-de="Löschen"
                                    data-i18n-title-en="Delete"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>

                                <form id="delete-waitlist-form-{{ $notif->id }}" method="POST" action="{{ route('admin.waitlist.destroy', $notif->id) }}" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-stone-500 text-xs">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div class="w-12 h-12 rounded-2xl bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#78000b] shadow-2xs">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="font-serif text-base font-bold text-[#1c1210] mt-1" data-i18n-de="Keine Wartelisten-Einträge vorhanden" data-i18n-en="No waitlist entries found">
                                        No waitlist entries found
                                    </p>
                                    <p class="text-xs text-stone-500 max-w-sm" data-i18n-de="Sobald Kunden sich auf Produktseiten für Benachrichtigungen eintragen, werden sie hier erfasst." data-i18n-en="When customers subscribe on sold-out product pages, they will appear here automatically.">
                                        When customers subscribe on sold-out product pages, they will appear here automatically.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($notifications->hasPages())
            <div class="px-5 py-4 border-t border-[#ebdccb] bg-[#faf7f2]/60 flex items-center justify-between">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Luxury Confirmation Script for Waitlist Actions -->
<script>
    function confirmDeleteWaitlist(id, email) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Waitlist Entry?' : 'Wartelisten-Eintrag löschen?',
            text: isEn ? `Remove waitlist subscription for ${email}?` : `Wartelisten-Abonnement für ${email} unwiderruflich entfernen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#78000b',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-waitlist-form-' + id);
                if (form) form.submit();
            }
        });
    }

    function confirmSendRestockAlerts(productId, productName, count) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Dispatch Restock Alerts?' : 'Restock-Alerts versenden?',
            text: isEn 
                ? `Send restock notification emails to all ${count} waiting customers for "${productName}"?` 
                : `Möchten Sie wirklich Restock-Benachrichtigungen an alle ${count} wartenden Kunden für "${productName}" versenden?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#78000b',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Dispatch Alerts' : 'Ja, Alerts senden',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('notify-product-form-' + productId);
                if (form) form.submit();
            }
        });
    }

    // Re-apply current language when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        const currentLang = localStorage.getItem('mehaaj_admin_lang') || 'en';
        if (typeof applyLanguage === 'function') {
            applyLanguage(currentLang);
        }
    });
</script>
@endsection
