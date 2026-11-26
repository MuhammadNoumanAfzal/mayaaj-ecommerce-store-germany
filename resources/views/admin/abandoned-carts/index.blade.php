@extends('layouts.admin')
@section('title', 'Abandoned Cart Tracking & Recovery - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 High-Level Executive Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
        
        <!-- 1. Lost Revenue (Unrecovered Pipeline) -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-rose-700 uppercase tracking-wider block" data-i18n-de="Entgangener Umsatz" data-i18n-en="Lost Revenue">Lost Revenue</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">EUR {{ number_format($stats['lost_revenue'], 2, ',', '.') }}</span>
                <span class="text-[0.62rem] text-rose-600 font-medium">Offene Warenkörbe</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 2. Recovered Revenue -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Geretteter Umsatz" data-i18n-en="Recovered Revenue">Recovered Revenue</span>
                <span class="font-extrabold text-2xl text-emerald-800 tracking-tight leading-none block">EUR {{ number_format($stats['recovered_revenue'], 2, ',', '.') }}</span>
                <span class="text-[0.62rem] text-emerald-600 font-medium">Durch Kampagnen</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 3. Recovery Rate (%) -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-purple-700 uppercase tracking-wider block" data-i18n-de="Wiederherstellungsquote" data-i18n-en="Recovery Rate">Recovery Rate</span>
                <span class="font-extrabold text-2xl text-purple-900 tracking-tight leading-none block">{{ $stats['recovery_rate'] }}%</span>
                <span class="text-[0.62rem] text-purple-600 font-medium">Erfolgreich reaktiviert</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
        </div>

        <!-- 4. Uncontacted Carts -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Offene Reaktivierungen" data-i18n-en="Pending Contact">Pending Contact</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $stats['pending_count'] }}</span>
                <span class="text-[0.62rem] text-amber-600 font-medium">Sofort kontaktieren</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
        </div>

    </div>

    <!-- Main Card Container -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header Section -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span data-i18n-de="Verlassene Warenkörbe & Rückgewinnung" data-i18n-en="Abandoned Cart Tracking & Recovery">Abandoned Cart Tracking & Recovery</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Überwachen Sie Kundenabbrüche, senden Sie 1-Klick-Reaktivierungslinks und stellen Sie entgangenen Umsatz wieder her." data-i18n-en="Monitor checkout drop-offs, dispatch 1-click restore links, and recapture lost revenue.">
                    Monitor checkout drop-offs, dispatch 1-click restore links, and recapture lost revenue.
                </p>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="px-6 py-3.5 bg-stone-50/70 border-b border-stone-200/70">
            <form method="GET" action="{{ route('admin.abandoned-carts') }}" class="flex flex-col md:flex-row items-center justify-between gap-3">
                <div class="relative w-full md:w-80">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Kunde, E-Mail oder Telefon..."
                        data-i18n-placeholder-de="Kunde, E-Mail oder Telefon..."
                        data-i18n-placeholder-en="Customer, email or phone..."
                        class="w-full text-xs rounded-xl border border-stone-200 bg-white py-2 pl-9 pr-3 text-stone-900 focus:border-saltora-terracotta focus:ring-1 focus:ring-saltora-terracotta focus:outline-none transition shadow-2xs"
                    >
                    <svg class="h-4 w-4 text-stone-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <select name="status" onchange="this.form.submit()" class="text-xs rounded-xl border border-stone-200 bg-white py-2 px-3 text-stone-800 focus:border-saltora-terracotta focus:outline-none transition shadow-2xs font-medium">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Alle Status (All Status)</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Ausstehend (Pending)</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>📩 Kontaktiert (Contacted)</option>
                        <option value="recovered" {{ request('status') === 'recovered' ? 'selected' : '' }}>✅ Wiederhergestellt (Recovered)</option>
                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>⚠️ Abgelaufen (Expired)</option>
                    </select>

                    @if(request('q') || (request('status') && request('status') !== 'all'))
                        <a href="{{ route('admin.abandoned-carts') }}" class="p-2 text-stone-500 hover:text-stone-800 bg-white border border-stone-200 rounded-xl text-xs transition flex items-center justify-center">
                            ✕ Filter zurücksetzen
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Abandoned Carts Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-stone-200 bg-stone-50/60 text-stone-500 font-bold uppercase tracking-wider text-[0.62rem]">
                        <th class="px-5 py-3">Kunde & Kontaktdaten</th>
                        <th class="px-5 py-3">Warenkorbinhalt</th>
                        <th class="px-5 py-3">Warenwert</th>
                        <th class="px-5 py-3">Abbruchzeitpunkt</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Rückgewinnungs-Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 bg-white">
                    @forelse($abandonedCarts as $cart)
                        <tr class="hover:bg-stone-50/80 transition-colors duration-150" id="cart-row-{{ $cart->id }}">
                            
                            <!-- 1. Customer & Contact -->
                            <td class="px-5 py-4">
                                <div class="font-bold text-stone-900 text-xs">
                                    {{ $cart->customer_name ?: 'Anonymer Gastbesucher' }}
                                    @if($cart->customer_id)
                                        <span class="ml-1.5 inline-flex items-center px-1.5 py-0.5 rounded text-[0.58rem] font-extrabold uppercase bg-amber-50 text-amber-700 border border-amber-200">Konto</span>
                                    @endif
                                </div>
                                <div class="space-y-0.5 mt-1 text-[0.68rem] text-stone-500 font-medium">
                                    @if($cart->customer_email)
                                        <div class="flex items-center gap-1.5">
                                            <span>✉️</span>
                                            <a href="mailto:{{ $cart->customer_email }}" class="text-stone-700 hover:text-saltora-terracotta underline">{{ $cart->customer_email }}</a>
                                        </div>
                                    @endif
                                    @if($cart->customer_phone)
                                        <div class="flex items-center gap-1.5">
                                            <span>📞</span>
                                            <a href="tel:{{ $cart->customer_phone }}" class="text-stone-700 hover:text-saltora-terracotta">{{ $cart->customer_phone }}</a>
                                        </div>
                                    @endif
                                    @if(!$cart->customer_email && !$cart->customer_phone)
                                        <span class="text-stone-400 italic">Keine Kontaktdaten erfasst</span>
                                    @endif
                                </div>
                            </td>

                            <!-- 2. Cart Items Breakdown -->
                            <td class="px-5 py-4 max-w-xs">
                                <div class="space-y-1">
                                    @if(is_array($cart->cart_items) && count($cart->cart_items) > 0)
                                        @foreach(array_slice($cart->cart_items, 0, 2) as $item)
                                            <div class="flex items-center gap-2 text-[0.68rem] text-stone-700">
                                                <span class="font-bold text-stone-900 bg-stone-100 rounded px-1.5 py-0.5 text-[0.6rem]">{{ $item['qty'] ?? 1 }}x</span>
                                                <span class="truncate max-w-[170px]" title="{{ $item['name'] ?? '' }}">{{ $item['name'] ?? 'Artikel' }}</span>
                                                <span class="text-stone-400 text-[0.62rem]">({{ number_format((float)($item['price'] ?? 0), 2, ',', '.') }} €)</span>
                                            </div>
                                        @endforeach
                                        @if(count($cart->cart_items) > 2)
                                            <span class="text-[0.62rem] text-stone-400 font-bold block">+ {{ count($cart->cart_items) - 2 }} weitere Artikel</span>
                                        @endif
                                    @else
                                        <span class="text-stone-400 italic text-[0.68rem]">Keine Positionen</span>
                                    @endif
                                </div>
                            </td>

                            <!-- 3. Cart Total Value -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="font-extrabold text-sm text-stone-900">
                                    EUR {{ number_format($cart->cart_total, 2, ',', '.') }}
                                </div>
                                <span class="text-[0.62rem] text-stone-400">{{ $cart->item_count }} Artikel</span>
                            </td>

                            <!-- 4. Time Since Abandonment -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1.5 text-stone-700 text-xs font-medium">
                                    <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ $cart->created_at->diffForHumans() }}</span>
                                </div>
                                <span class="text-[0.62rem] text-stone-400 block mt-0.5">{{ $cart->created_at->format('d.m.Y H:i') }}</span>
                            </td>

                            <!-- 5. Recovery Status Badge -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($cart->recovery_status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Ausstehend
                                    </span>
                                @elseif($cart->recovery_status === 'contacted')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                        Kontaktiert
                                    </span>
                                    @if($cart->last_contacted_at)
                                        <span class="block text-[0.58rem] text-stone-400 mt-0.5">{{ $cart->last_contacted_at->diffForHumans() }}</span>
                                    @endif
                                @elseif($cart->recovery_status === 'recovered')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Wiederhergestellt
                                    </span>
                                    @if($cart->recovered_at)
                                        <span class="block text-[0.58rem] text-emerald-600 mt-0.5">{{ $cart->recovered_at->diffForHumans() }}</span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-stone-100 text-stone-600 border border-stone-200">
                                        Abgelaufen
                                    </span>
                                @endif
                            </td>

                            <!-- 6. Recovery Actions -->
                            <td class="px-5 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    <!-- WhatsApp Direct Recovery -->
                                    @if($cart->whatsapp_link)
                                        <a 
                                            href="{{ $cart->whatsapp_link }}" 
                                            target="_blank" 
                                            onclick="markAsContacted({{ $cart->id }})"
                                            title="Direkte WhatsApp-Nachricht mit Warenkorblink senden" 
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition shadow-2xs"
                                        >
                                            <span>💬</span>
                                            <span class="hidden xl:inline">WhatsApp</span>
                                        </a>
                                    @endif

                                    <!-- Send Recovery Email -->
                                    @if($cart->customer_email)
                                        <button 
                                            type="button" 
                                            onclick="sendRecoveryEmail({{ $cart->id }}, this)" 
                                            title="Reaktivierungs-E-Mail senden" 
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-saltora-blush/80 hover:bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 text-xs font-bold transition shadow-2xs cursor-pointer"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            <span class="hidden xl:inline">E-Mail</span>
                                        </button>
                                    @endif

                                    <!-- Copy 1-Click Recovery Link -->
                                    <button 
                                        type="button" 
                                        onclick="copyRecoveryLink('{{ $cart->recovery_url }}')" 
                                        title="1-Klick-Wiederherstellungslink kopieren" 
                                        class="p-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-600 transition shadow-2xs cursor-pointer"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>

                                    <!-- Status Dropdown Toggle -->
                                    <select onchange="updateStatus({{ $cart->id }}, this.value)" class="text-[0.65rem] font-bold rounded-lg border border-stone-200 bg-white py-1 px-1.5 text-stone-700 focus:outline-none cursor-pointer">
                                        <option value="pending" {{ $cart->recovery_status === 'pending' ? 'selected' : '' }}>⏳ Ausstehend</option>
                                        <option value="contacted" {{ $cart->recovery_status === 'contacted' ? 'selected' : '' }}>📩 Kontaktiert</option>
                                        <option value="recovered" {{ $cart->recovery_status === 'recovered' ? 'selected' : '' }}>✅ Gerettet</option>
                                        <option value="expired" {{ $cart->recovery_status === 'expired' ? 'selected' : '' }}>⚠️ Abgelaufen</option>
                                    </select>

                                    <!-- Delete Cart -->
                                    <form method="POST" action="{{ route('admin.abandoned-carts.destroy', $cart->id) }}" onsubmit="return confirm('Möchten Sie diesen Eintrag wirklich löschen?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Löschen" class="p-1.5 text-stone-400 hover:text-rose-600 transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-stone-500">
                                <div class="max-w-xs mx-auto space-y-2">
                                    <svg class="w-10 h-10 text-stone-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <h3 class="font-bold text-stone-800 text-sm">Keine verlassenen Warenkörbe gefunden</h3>
                                    <p class="text-xs text-stone-400">Aktuell liegen keine unfertigen Bestellvorgänge vor oder alle Suchkriterien wurden erfüllt.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($abandonedCarts->hasPages())
            <div class="px-6 py-4 bg-stone-50 border-t border-stone-200">
                {{ $abandonedCarts->links() }}
            </div>
        @endif

    </div>

</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // Copy 1-Click Recovery Link
    window.copyRecoveryLink = function(url) {
        navigator.clipboard.writeText(url).then(() => {
            if (window.LuxuryToast) {
                LuxuryToast.fire({ icon: 'success', title: '1-Klick-Link in die Zwischenablage kopiert!' });
            } else {
                alert('1-Klick-Link kopiert: ' + url);
            }
        });
    };

    // Mark as Contacted
    window.markAsContacted = function(cartId) {
        fetch(`/admin/abandoned-carts/${cartId}/mark-contacted`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        }).catch(err => console.error(err));
    };

    // Send Recovery Email
    window.sendRecoveryEmail = function(cartId, btnEl) {
        const origHtml = btnEl.innerHTML;
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="animate-pulse">Senden...</span>';

        fetch(`/admin/abandoned-carts/${cartId}/send-email`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            btnEl.disabled = false;
            btnEl.innerHTML = origHtml;
            if (data.success) {
                if (window.LuxuryToast) {
                    LuxuryToast.fire({ icon: 'success', title: data.message });
                } else {
                    alert(data.message);
                }
                setTimeout(() => window.location.reload(), 1200);
            } else {
                if (window.LuxurySwal) {
                    LuxurySwal.fire({ icon: 'error', title: 'Fehler', text: data.message });
                } else {
                    alert(data.message);
                }
            }
        })
        .catch(err => {
            btnEl.disabled = false;
            btnEl.innerHTML = origHtml;
            console.error(err);
        });
    };

    // Update Status
    window.updateStatus = function(cartId, status) {
        fetch(`/admin/abandoned-carts/${cartId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (window.LuxuryToast) {
                    LuxuryToast.fire({ icon: 'success', title: data.message });
                }
                setTimeout(() => window.location.reload(), 800);
            }
        })
        .catch(err => console.error(err));
    };
</script>
@endsection
