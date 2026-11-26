@extends('layouts.admin')
@section('title', 'Atelier Warteliste & Restock Demand - MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- Top Header -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-5 sm:p-6 border-t-4 border-t-saltora-terracotta">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-saltora-terracotta">
                    <span class="h-2 w-2 rounded-full bg-saltora-terracotta"></span>
                    <span>BACK-IN-STOCK WAITLIST & RESTOCK DEMAND INTELLIGENCE</span>
                </div>
                <h1 class="text-2xl font-black text-stone-900 tracking-tight mt-1">
                    Atelier Warteliste & Nachfrage-Audit
                </h1>
                <p class="text-xs text-stone-500 font-medium mt-0.5">
                    Überwachen Sie die ungedeckte Kaufnachfrage ausverkaufter Kreationen und benachrichtigen Sie wartende Kunden mit 1 Klick.
                </p>
            </div>

            <!-- Total Requests Badge -->
            <div class="flex items-center gap-2">
                <span class="rounded-xl border border-stone-200 bg-[#faf7f2] px-3.5 py-2 text-xs font-bold text-stone-700">
                    Gesamt Einträge: <strong class="text-saltora-terracotta font-mono">{{ $totalWaitlistCount }}</strong>
                </span>
            </div>
        </div>

        <!-- 4 KPI Metrics Header Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-6 border-t border-stone-100">
            <!-- 1. Latent Unmet Demand Revenue -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-amber-800 block">Latentes Umsatzpotenzial</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-amber-900">€{{ number_format($latentRevenueDemand, 2, ',', '.') }}</span>
                    <span class="text-xs font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">Kaufbereit</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Umsatzwarteschlange ausverkaufter Artikel</p>
            </div>

            <!-- 2. Pending Waiting Patrons -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-rose-800 block">Wartende Kunden (Offen)</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-stone-900">{{ $pendingWaitlistCount }}</span>
                    <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">Wartet auf Restock</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Möchten bei Verfügbarkeit kaufen</p>
            </div>

            <!-- 3. Restock Alerts Dispatched -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-emerald-800 block">Restock-Alerts Versendet</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-emerald-900">{{ $notifiedCount }}</span>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Benachrichtigt</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Erfolgreich reaktivierte Käufer</p>
            </div>

            <!-- 4. Most In-Demand Piece -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-600 block">Top Nachfrage-Artikel</span>
                @php $topDemand = $demandByProduct->first(); @endphp
                <div class="flex items-baseline justify-between">
                    <span class="text-sm font-bold text-stone-900 truncate max-w-[150px]" title="{{ $topDemand?->product?->name }}">
                        {{ $topDemand?->product?->name ?? 'Keine Nachfrage' }}
                    </span>
                    @if($topDemand)
                        <span class="text-xs font-bold text-saltora-terracotta bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">{{ $topDemand->waitlist_count }}x</span>
                    @endif
                </div>
                <p class="text-[0.65rem] text-stone-500">Höchste Dringlichkeit zur Nachproduktion</p>
            </div>
        </div>
    </div>

    <!-- Top In-Demand Pieces Showcase & 1-Click Restock Actions -->
    @if($demandByProduct->isNotEmpty())
        <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                <div>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-stone-900">
                        Top Unikate mit akuter Restock-Nachfrage
                    </h2>
                    <p class="text-xs text-stone-500">
                        Klicken Sie auf "Restock-Alert versenden", sobald neue Stücke am Packtisch oder Lager eingebucht wurden.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($demandByProduct as $dp)
                    @php $p = $dp->product; @endphp
                    @if($p)
                        <div class="rounded-xl border border-stone-200 p-4 bg-[#faf7f2]/50 hover:bg-[#faf7f2] transition space-y-3 flex flex-col justify-between">
                            <div class="flex items-start gap-3">
                                <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="h-16 w-16 rounded-lg object-cover border border-stone-200 shrink-0 bg-white">
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-bold text-xs text-stone-900 truncate" title="{{ $p->name }}">
                                        {{ $p->name }}
                                    </h3>
                                    <p class="text-[0.68rem] text-stone-500 font-mono">SKU: {{ $p->sku }}</p>
                                    <p class="text-xs font-bold text-saltora-terracotta mt-0.5">
                                        €{{ number_format($p->sale_price ?? $p->price, 2, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="pt-2 border-t border-stone-200/60 flex items-center justify-between gap-2">
                                <div class="space-y-0.5">
                                    <span class="text-[0.62rem] font-bold uppercase text-stone-500 block">Warteliste:</span>
                                    <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                        {{ $dp->waitlist_count }} wartende Kunden
                                    </span>
                                </div>

                                <form method="POST" action="{{ route('admin.waitlist.notify', $p->id) }}">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        onclick="return confirm('Möchten Sie wirklich Restock-Benachrichtigungen an alle {{ $dp->waitlist_count }} wartenden Kunden für dieses Produkt versenden?')"
                                        class="px-3 py-1.5 rounded-lg bg-saltora-terracotta hover:brightness-110 text-white text-[0.68rem] font-bold uppercase tracking-wider transition shadow-2xs cursor-pointer flex items-center gap-1.5"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        <span>Alerts senden</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Search & Filter Tabs -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Status Tabs -->
        <div class="flex flex-wrap items-center gap-1.5 w-full sm:w-auto">
            <a href="{{ route('admin.waitlist') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !$status ? 'bg-saltora-terracotta text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Alle Einträge ({{ $totalWaitlistCount }})
            </a>
            <a href="{{ route('admin.waitlist', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Wartend / Offen ({{ $pendingWaitlistCount }})
            </a>
            <a href="{{ route('admin.waitlist', ['status' => 'notified']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'notified' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Benachrichtigt ({{ $notifiedCount }})
            </a>
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ route('admin.waitlist') }}" class="w-full sm:w-72">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="E-Mail, Kunde, Produkt, SKU..." 
                    class="w-full rounded-xl border border-stone-200 bg-stone-50 pl-9 pr-3.5 py-2 text-xs text-stone-800 focus:border-saltora-terracotta focus:bg-white focus:outline-none transition"
                >
                <svg class="w-4 h-4 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>
    </div>

    <!-- Waitlist Subscribers Table -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-[#faf7f2] border-b border-stone-200 text-[0.68rem] font-black uppercase tracking-wider text-stone-700">
                        <th class="py-3 px-4">Kunde / E-Mail</th>
                        <th class="py-3 px-4">Angefragtes Produkt</th>
                        <th class="py-3 px-4">Ausführung / Farbe</th>
                        <th class="py-3 px-4">Einzelpreis</th>
                        <th class="py-3 px-4">Eingetragen am</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($notifications as $notif)
                        @php $badge = $notif->status_badge; @endphp
                        <tr class="hover:bg-stone-50/70 transition">
                            <!-- Customer Info -->
                            <td class="py-3 px-4">
                                <p class="font-bold text-stone-900">{{ $notif->customer_name ?: 'Atelier-Patron' }}</p>
                                <a href="mailto:{{ $notif->customer_email }}" class="text-[0.68rem] text-stone-500 hover:text-saltora-terracotta hover:underline font-mono">
                                    {{ $notif->customer_email }}
                                </a>
                            </td>

                            <!-- Product Info -->
                            <td class="py-3 px-4 max-w-xs">
                                @if($notif->product)
                                    <a href="{{ route('shop.show', $notif->product->slug) }}" target="_blank" class="font-bold text-stone-800 hover:text-saltora-terracotta hover:underline flex items-center gap-2">
                                        <img src="{{ $notif->product->image_url }}" alt="" class="h-8 w-8 rounded object-cover border border-stone-200 shrink-0">
                                        <span class="truncate">{{ $notif->product->name }}</span>
                                    </a>
                                @else
                                    <span class="text-stone-400">Produkt #{{ $notif->product_id }}</span>
                                @endif
                            </td>

                            <!-- Variation -->
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-stone-100 text-stone-700 border border-stone-200">
                                    {{ $notif->variation_name ?: 'Standard Ausführung' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-3 px-4 font-mono font-bold text-stone-900">
                                @if($notif->product)
                                    €{{ number_format($notif->product->sale_price ?? $notif->product->price, 2, ',', '.') }}
                                @else
                                    —
                                @endif
                            </td>

                            <!-- Subscribed Date -->
                            <td class="py-3 px-4 text-stone-500">
                                <span>{{ $notif->created_at->format('d.m.Y H:i') }}</span>
                                @if($notif->notified_at)
                                    <span class="block text-[0.62rem] text-emerald-700 font-semibold">
                                        Benachrichtigt: {{ $notif->notified_at->format('d.m.Y') }}
                                    </span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3 px-4 text-center">
                                <span class="inline-block px-2.5 py-1 rounded-full text-[0.62rem] font-bold border {{ $badge['badge'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-right">
                                <form method="POST" action="{{ route('admin.waitlist.destroy', $notif->id) }}" class="inline" onsubmit="return confirm('Eintrag wirklich entfernen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-stone-400 hover:text-rose-600 transition" title="Löschen">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400 text-xs">
                                <p class="text-2xl mb-2">⏳</p>
                                <p class="font-bold text-stone-700">Keine Wartelisten-Einträge vorhanden</p>
                                <p class="text-[0.65rem] text-stone-400 mt-1">Sobald Kunden sich auf Produktseiten für Benachrichtigungen eintragen, werden sie hier erfasst.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($notifications->hasPages())
            <div class="p-4 border-t border-stone-100">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
