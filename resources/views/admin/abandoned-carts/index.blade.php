@extends('layouts.admin')
@section('title', 'Abandoned Carts - MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- 4 High-Level Clean KPI Cards (Pink-Salt Atelier Palette) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
        
        <!-- 1. Lost Revenue -->
        <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1 transition hover:shadow-xs">
            <span class="text-[0.65rem] font-bold text-rose-900 uppercase tracking-wider block" data-i18n-de="Entgangener Umsatz" data-i18n-en="Lost Revenue">Lost Revenue</span>
            <div class="text-2xl font-black text-[#78000b]">
                €{{ number_format($stats['lost_revenue'], 2, '.', ',') }}
            </div>
            <span class="text-[0.62rem] text-rose-700 font-medium block" data-i18n-de="Offene Warenkörbe" data-i18n-en="Unrecovered Carts">Unrecovered Carts</span>
        </div>

        <!-- 2. Recovered Revenue -->
        <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1 transition hover:shadow-xs">
            <span class="text-[0.65rem] font-bold text-emerald-900 uppercase tracking-wider block" data-i18n-de="Geretteter Umsatz" data-i18n-en="Recovered Revenue">Recovered Revenue</span>
            <div class="text-2xl font-black text-[#065f46]">
                €{{ number_format($stats['recovered_revenue'], 2, '.', ',') }}
            </div>
            <span class="text-[0.62rem] text-emerald-700 font-medium block" data-i18n-de="Erfolgreich gerettet" data-i18n-en="Successfully Recovered">Successfully Recovered</span>
        </div>

        <!-- 3. Recovery Rate (%) -->
        <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1 transition hover:shadow-xs">
            <span class="text-[0.65rem] font-bold text-purple-900 uppercase tracking-wider block" data-i18n-de="Rückgewinnungsquote" data-i18n-en="Recovery Rate">Recovery Rate</span>
            <div class="text-2xl font-black text-purple-900">
                {{ $stats['recovery_rate'] }}%
            </div>
            <span class="text-[0.62rem] text-purple-700 font-medium block" data-i18n-de="Erfolgreich reaktiviert" data-i18n-en="Successfully Reactivated">Successfully Reactivated</span>
        </div>

        <!-- 4. Pending Contact -->
        <div class="bg-gradient-to-br from-[#faf7f2] to-white rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1 transition hover:shadow-xs">
            <span class="text-[0.65rem] font-bold text-amber-900 uppercase tracking-wider block" data-i18n-de="Ausstehende Kontakte" data-i18n-en="Pending Contact">Pending Contact</span>
            <div class="text-2xl font-black text-[#1c1210]">
                {{ $stats['pending_count'] }}
            </div>
            <span class="text-[0.62rem] text-amber-800 font-medium block" data-i18n-de="Bereit zur Reaktivierung" data-i18n-en="Ready to Reactivate">Ready to Reactivate</span>
        </div>

    </div>

    <!-- Main Card Container -->
    <div class="relative bg-white rounded-3xl border border-[#ebdccb] shadow-xs overflow-hidden">
        <!-- Top Luxury Accent Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Header Section -->
        <div class="px-5 sm:px-6 py-5 border-b border-[#f1e6da] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-6">
            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-[#78000b]"></span>
                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#78000b]" data-i18n-de="WARENKORB-RÜCKGEWINNUNG" data-i18n-en="CART RECOVERY ENGINE">CART RECOVERY ENGINE</span>
                </div>
                <h1 class="font-serif text-2xl font-bold text-[#1c1210] tracking-tight mt-1" data-i18n-de="Verlassene Warenkörbe & Rückgewinnung" data-i18n-en="Abandoned Cart Tracking & Recovery">
                    Abandoned Cart Tracking & Recovery
                </h1>
                <p class="text-xs text-stone-600 font-medium mt-0.5" data-i18n-de="Überwachen Sie Kundenabbrüche, senden Sie 1-Klick-Reaktivierungslinks und stellen Sie entgangenen Umsatz wieder her." data-i18n-en="Monitor checkout drop-offs, dispatch 1-click restore links, and recapture lost revenue.">
                    Monitor checkout drop-offs, dispatch 1-click restore links, and recapture lost revenue.
                </p>
            </div>

            <!-- Total Counter Badge -->
            <div class="flex items-center gap-2 shrink-0">
                <span class="rounded-xl border border-[#ebdccb] bg-[#faf7f2] px-3.5 py-2 text-xs font-bold text-[#1c1210] shadow-2xs inline-flex items-center gap-1.5">
                    <span data-i18n-de="Warenkörbe gesamt:" data-i18n-en="Total Carts:">Total Carts:</span>
                    <strong class="text-[#78000b] font-mono text-sm">{{ $stats['total_carts'] }}</strong>
                </span>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="px-5 sm:px-6 py-3.5 bg-[#faf7f2]/60 border-b border-[#ebdccb]">
            <form method="GET" action="{{ route('admin.abandoned-carts') }}" class="flex flex-col md:flex-row items-center justify-between gap-3">
                <div class="relative w-full md:w-80">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Search by customer, email or phone..."
                        data-i18n-placeholder-de="Nach Kunde, E-Mail oder Telefon suchen..."
                        data-i18n-placeholder-en="Search by customer, email or phone..."
                        class="w-full text-xs rounded-xl border border-[#ebdccb] bg-white py-2 pl-9 pr-3 text-[#1c1210] focus:border-[#78000b] focus:outline-none transition shadow-2xs"
                    >
                    <svg class="h-4 w-4 text-stone-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <select name="status" onchange="this.form.submit()" class="text-xs rounded-xl border border-[#ebdccb] bg-white py-2 px-3 text-[#1c1210] focus:border-[#78000b] focus:outline-none transition shadow-2xs font-medium cursor-pointer">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }} data-i18n-de="Alle Status" data-i18n-en="All Status">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }} data-i18n-de="Ausstehend" data-i18n-en="Pending">Pending</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }} data-i18n-de="Kontaktiert" data-i18n-en="Contacted">Contacted</option>
                        <option value="recovered" {{ request('status') === 'recovered' ? 'selected' : '' }} data-i18n-de="Wiederhergestellt" data-i18n-en="Recovered">Recovered</option>
                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }} data-i18n-de="Abgelaufen" data-i18n-en="Expired">Expired</option>
                    </select>

                    @if(request('q') || (request('status') && request('status') !== 'all'))
                        <a href="{{ route('admin.abandoned-carts') }}" class="h-8 px-3 text-xs font-bold text-stone-600 hover:text-rose-600 bg-white border border-[#ebdccb] hover:border-rose-200 rounded-xl transition shadow-2xs inline-flex items-center gap-1 cursor-pointer" title="Reset Filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Abandoned Carts Table (Zero Horizontal Scrollbar, Single-Line, Fluid) -->
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs table-auto">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Kunde" data-i18n-en="Customer">Customer</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Warenkorb" data-i18n-en="Cart Items">Cart Items</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Warenwert" data-i18n-en="Value">Value</th>
                        <th class="py-3 px-4 font-black text-center w-32" data-i18n-de="Abbruchdatum" data-i18n-en="Abandoned">Abandoned</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-4 font-black text-center w-40" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($abandonedCarts as $cart)
                        @php
                            $cartModalData = [
                                'id' => $cart->id,
                                'customer_name' => $cart->customer_name ?: 'Guest Visitor',
                                'customer_email' => $cart->customer_email,
                                'customer_phone' => $cart->customer_phone,
                                'has_account' => (bool)$cart->customer_id,
                                'cart_items' => $cart->cart_items ?? [],
                                'item_count' => $cart->item_count,
                                'cart_total' => number_format((float)$cart->cart_total, 2, '.', ','),
                                'recovery_status' => $cart->recovery_status,
                                'recovery_url' => $cart->recovery_url,
                                'whatsapp_link' => $cart->whatsapp_link,
                                'abandoned_at' => $cart->created_at->format('d.m.Y H:i'),
                                'abandoned_relative' => $cart->created_at->diffForHumans(),
                                'last_contacted_at' => $cart->last_contacted_at ? $cart->last_contacted_at->format('d.m.Y H:i') : null,
                                'recovered_at' => $cart->recovered_at ? $cart->recovered_at->format('d.m.Y H:i') : null,
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="cart-row-{{ $cart->id }}">
                            
                            <!-- Index -->
                            <td class="py-3.5 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($abandonedCarts->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 1. Customer Name (Clean Single Line) -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-1.5 cursor-pointer hover:text-[#78000b] transition" onclick='openCartDetailModal(@json($cartModalData))'>
                                    <span class="font-bold text-[#1c1210]">
                                        {{ $cart->customer_name ?: ($cart->customer_email ?: 'Guest Visitor') }}
                                    </span>
                                    @if($cart->customer_id)
                                        <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[0.58rem] font-extrabold uppercase bg-amber-50 text-amber-800 border border-amber-200">VIP</span>
                                    @endif
                                </div>
                            </td>

                            <!-- 2. Cart Items Count (Single Line Pill) -->
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#FAF7F2] text-[#78000b] border border-[#ebdccb] shadow-2xs cursor-pointer hover:bg-[#ebdccb]/40 transition" onclick='openCartDetailModal(@json($cartModalData))' title="View items">
                                    {{ $cart->item_count }} <span data-i18n-de="Artikel" data-i18n-en="Items">Items</span>
                                </span>
                            </td>

                            <!-- 3. Cart Value (Single Line Bold) -->
                            <td class="py-3.5 px-3 text-center font-mono font-bold text-[#78000b] text-xs whitespace-nowrap">
                                €{{ number_format($cart->cart_total, 2, '.', ',') }}
                            </td>

                            <!-- 4. Abandoned On (Single Line Clean Date) -->
                            <td class="py-3.5 px-4 text-center font-mono text-stone-600 text-xs whitespace-nowrap">
                                {{ $cart->created_at->format('d.m.Y H:i') }}
                            </td>

                            <!-- 5. Recovery Status Badge (Clean Single Line) -->
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                @if($cart->recovery_status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span data-i18n-de="Ausstehend" data-i18n-en="Pending">Pending</span>
                                    </span>
                                @elseif($cart->recovery_status === 'contacted')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                        <span data-i18n-de="Kontaktiert" data-i18n-en="Contacted">Contacted</span>
                                    </span>
                                @elseif($cart->recovery_status === 'recovered')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Gerettet" data-i18n-en="Recovered">Recovered</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-stone-100 text-stone-700 border border-stone-200">
                                        <span data-i18n-de="Abgelaufen" data-i18n-en="Expired">Expired</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 6. Actions (Details + WhatsApp / Email + Delete) -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    
                                    <!-- View Details Button -->
                                    <button 
                                        type="button" 
                                        onclick='openCartDetailModal(@json($cartModalData))'
                                        class="h-7 px-2 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95" 
                                        title="View Cart Details"
                                        data-i18n-title-de="Details ansehen"
                                        data-i18n-title-en="View Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Details" data-i18n-en="Details">Details</span>
                                    </button>

                                    <!-- Quick WhatsApp Direct (if available) -->
                                    @if($cart->whatsapp_link)
                                        <a 
                                            href="{{ $cart->whatsapp_link }}" 
                                            target="_blank" 
                                            onclick="markAsContacted({{ $cart->id }})"
                                            title="WhatsApp" 
                                            class="h-7 px-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        >
                                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            <span>WA</span>
                                        </a>
                                    @endif

                                    <!-- Delete Cart -->
                                    <button 
                                        type="button" 
                                        onclick="confirmDeleteCart({{ $cart->id }})" 
                                        title="Delete" 
                                        class="h-7 w-7 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition shadow-2xs inline-flex items-center justify-center cursor-pointer active:scale-95"
                                        data-i18n-title-de="Löschen"
                                        data-i18n-title-en="Delete"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>

                                    <form id="delete-cart-form-{{ $cart->id }}" method="POST" action="{{ route('admin.abandoned-carts.destroy', $cart->id) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-500 text-xs">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div class="w-12 h-12 rounded-2xl bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#78000b] shadow-2xs">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <p class="font-serif text-base font-bold text-[#1c1210] mt-1" data-i18n-de="Keine verlassenen Warenkörbe gefunden" data-i18n-en="No abandoned carts found">
                                        No abandoned carts found
                                    </p>
                                    <p class="text-xs text-stone-500 max-w-sm" data-i18n-de="Aktuell liegen keine unfertigen Bestellvorgänge vor." data-i18n-en="No pending abandoned checkouts currently detected.">
                                        No pending abandoned checkouts currently detected.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($abandonedCarts->hasPages())
            <div class="px-5 py-4 border-t border-[#ebdccb] bg-[#faf7f2]/60 flex items-center justify-between">
                {{ $abandonedCarts->links() }}
            </div>
        @endif

    </div>

</div>

<!-- Luxury Abandoned Cart Detail & Recovery Modal -->
<div 
    id="cart-detail-modal" 
    class="fixed inset-0 flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.78) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important; margin: 0 !important;" 
    onclick="closeCartDetailModal()"
>
    <div 
        class="relative w-full bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden my-auto transform transition-all" 
        style="max-width: 680px !important; width: 100% !important; background: #ffffff !important; border-radius: 1.5rem !important; border: 1px solid #ebdccb !important; box-shadow: 0 25px 50px -12px rgba(120, 0, 11, 0.25) !important;"
        onclick="event.stopPropagation()"
    >
        <!-- Gold & Wine Top Accent Strip -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Modal Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-bottom: 1px solid #ebdccb;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 34px; height: 34px; border-radius: 0.65rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: linear-gradient(135deg, #78000b 0%, #4a0207 100%); color: #d8b45a; border: 1px solid rgba(216, 180, 90, 0.45); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <svg style="width: 16px; height: 16px; color: #d8b45a;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h3 style="font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.15rem; font-weight: 700; color: #1c1210; line-height: 1.2; margin: 0;" data-i18n-de="Verlassener Warenkorb Details" data-i18n-en="Abandoned Cart Details">Abandoned Cart Details</h3>
                    <p style="font-size: 0.65rem; color: #8a7267; font-family: monospace; margin: 0; line-height: 1;" id="modal-cart-id">Cart #0</p>
                </div>
            </div>
            <button type="button" onclick="closeCartDetailModal()" style="width: 28px; height: 28px; border-radius: 0.65rem; background: #ffffff; color: #6b7280; border: 1px solid #ebdccb; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" title="Close" data-i18n-title-de="Schließen" data-i18n-title-en="Close">
                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div style="padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem; max-height: 75vh; overflow-y: auto;">
            
            <!-- Customer Contact & Status Summary Card -->
            <div style="padding: 0.85rem; border-radius: 0.85rem; background: #FAF8F5; border: 1px solid #ebdccb; display: flex; flex-direction: column; gap: 0.5rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                    <div>
                        <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em;" data-i18n-de="Kunde & Kontakt" data-i18n-en="Customer Contact">Customer Contact</span>
                        <h4 id="modal-customer-name" style="font-size: 0.95rem; font-weight: 700; color: #1c1210; margin: 0.15rem 0 0 0;"></h4>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span id="modal-status-pill"></span>
                        <span id="modal-account-pill" class="hidden" style="display: inline-flex; align-items: center; padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.6rem; font-weight: 800; background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">VIP ACCOUNT</span>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap; padding-top: 0.4rem; border-top: 1px solid #f1e6da; font-size: 0.72rem;">
                    <div id="modal-email-wrap" class="flex items-center gap-1.5 text-stone-700">
                        <svg class="w-3.5 h-3.5 text-[#78000b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a id="modal-customer-email" href="#" class="font-mono hover:text-[#78000b] underline"></a>
                    </div>
                    <div id="modal-phone-wrap" class="flex items-center gap-1.5 text-stone-700">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <a id="modal-customer-phone" href="#" class="font-mono hover:text-emerald-700"></a>
                    </div>
                </div>
            </div>

            <!-- Cart Items Breakdown List -->
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.35rem; border-bottom: 1px solid #f1e6da; margin-bottom: 0.5rem;">
                    <span style="font-size: 0.65rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em;" data-i18n-de="Warenkorb Positionen" data-i18n-en="Cart Items Breakdown">Cart Items Breakdown</span>
                    <span id="modal-cart-count" style="font-size: 0.65rem; font-weight: 700; color: #78000b; background: #FAF7F2; padding: 0.15rem 0.45rem; border-radius: 9999px; border: 1px solid #ebdccb;">0 Items</span>
                </div>

                <div id="modal-items-list" style="border-radius: 0.85rem; background: #ffffff; border: 1px solid #ebdccb; overflow: hidden; max-height: 200px; overflow-y: auto;">
                    <!-- Dynamically populated via JS -->
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.65rem 0.85rem; border-radius: 0.75rem; background: linear-gradient(135deg, #FAF8F5, #ffffff); border: 1px solid #ebdccb; margin-top: 0.5rem;">
                    <span style="font-size: 0.75rem; font-weight: 700; color: #1c1210;" data-i18n-de="Warenkorb Gesamtwert" data-i18n-en="Cart Total Value">Cart Total Value</span>
                    <span id="modal-cart-total" style="font-size: 1.1rem; font-weight: 900; color: #78000b; font-family: monospace;">€0.00</span>
                </div>
            </div>

            <!-- Recovery Actions Bar (Inside Modal) -->
            <div style="padding: 0.85rem; border-radius: 0.85rem; background: #FAF8F5; border: 1px solid #ebdccb; display: flex; flex-direction: column; gap: 0.65rem;">
                <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em;" data-i18n-de="Rückgewinnungs-Aktionen" data-i18n-en="Recovery Actions">Recovery Actions</span>
                
                <div style="display: flex; items-center; gap: 0.5rem; flex-wrap: wrap;">
                    <!-- WhatsApp Direct Button -->
                    <a id="modal-wa-btn" href="#" target="_blank" onclick="markCurrentContacted()" class="h-8 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>WhatsApp Concierge</span>
                    </a>

                    <!-- Send Email Button -->
                    <button id="modal-email-btn" type="button" onclick="sendCurrentRecoveryEmail(this)" class="h-8 px-3 rounded-xl bg-white hover:bg-rose-50 text-[#78000b] border border-[#ebdccb] text-xs font-bold transition shadow-2xs inline-flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[#78000b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span data-i18n-de="E-Mail senden" data-i18n-en="Send Email">Send Email</span>
                    </button>

                    <!-- Copy Recovery Link Button -->
                    <button type="button" onclick="copyCurrentRecoveryLink()" class="h-8 px-3 rounded-xl bg-white hover:bg-stone-100 text-stone-700 border border-[#ebdccb] text-xs font-bold transition shadow-2xs inline-flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span data-i18n-de="Link kopieren" data-i18n-en="Copy 1-Click Link">Copy 1-Click Link</span>
                    </button>

                    <!-- Status Changer -->
                    <select id="modal-status-select" onchange="updateCurrentStatus(this.value)" class="h-8 px-2.5 rounded-xl border border-[#ebdccb] bg-white text-xs font-bold text-stone-800 focus:outline-none cursor-pointer">
                        <option value="pending" data-i18n-de="Ausstehend" data-i18n-en="Pending">Pending</option>
                        <option value="contacted" data-i18n-de="Kontaktiert" data-i18n-en="Contacted">Contacted</option>
                        <option value="recovered" data-i18n-de="Gerettet" data-i18n-en="Recovered">Recovered</option>
                        <option value="expired" data-i18n-de="Abgelaufen" data-i18n-en="Expired">Expired</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div style="display: flex; align-items: center; justify-content: flex-end; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-top: 1px solid #ebdccb; gap: 0.75rem;">
            <button type="button" onclick="closeCartDetailModal()" class="btn-exec-secondary" style="border-radius: 0.75rem; padding: 0.45rem 1.25rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                <span data-i18n-de="Schließen" data-i18n-en="Close">Close</span>
            </button>
        </div>

    </div>
</div>

<!-- Scripts for Abandoned Cart Management & Modals -->
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    let currentModalCart = null;

    function ensureModalTeleported(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }
    }

    function openCartDetailModal(data) {
        currentModalCart = data;
        ensureModalTeleported('cart-detail-modal');
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('modal-cart-id').textContent = 'Cart #' + data.id + ' • Abandoned ' + data.abandoned_relative;
        document.getElementById('modal-customer-name').textContent = data.customer_name;
        
        const emailWrap = document.getElementById('modal-email-wrap');
        const emailEl = document.getElementById('modal-customer-email');
        if (data.customer_email) {
            emailEl.textContent = data.customer_email;
            emailEl.href = 'mailto:' + data.customer_email;
            emailWrap.classList.remove('hidden');
        } else {
            emailWrap.classList.add('hidden');
        }

        const phoneWrap = document.getElementById('modal-phone-wrap');
        const phoneEl = document.getElementById('modal-customer-phone');
        if (data.customer_phone) {
            phoneEl.textContent = data.customer_phone;
            phoneEl.href = 'tel:' + data.customer_phone;
            phoneWrap.classList.remove('hidden');
        } else {
            phoneWrap.classList.add('hidden');
        }

        const accountPill = document.getElementById('modal-account-pill');
        if (data.has_account) {
            accountPill.classList.remove('hidden');
        } else {
            accountPill.classList.add('hidden');
        }

        // Status pill
        const statusPill = document.getElementById('modal-status-pill');
        let statusHtml = '';
        if (data.recovery_status === 'pending') {
            statusHtml = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #fffbeb; color: #92400e; border: 1px solid #fde68a;"><span style="width: 6px; height: 6px; border-radius: 9999px; background: #d97706;"></span>${isEn ? 'Pending' : 'Ausstehend'}</span>`;
        } else if (data.recovery_status === 'contacted') {
            statusHtml = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;"><span style="width: 6px; height: 6px; border-radius: 9999px; background: #3b82f6;"></span>${isEn ? 'Contacted' : 'Kontaktiert'}</span>`;
        } else if (data.recovery_status === 'recovered') {
            statusHtml = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;"><span style="width: 6px; height: 6px; border-radius: 9999px; background: #059669;"></span>${isEn ? 'Recovered' : 'Gerettet'}</span>`;
        } else {
            statusHtml = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb;">${isEn ? 'Expired' : 'Abgelaufen'}</span>`;
        }
        statusPill.innerHTML = statusHtml;

        // Render Cart Items
        const itemsList = document.getElementById('modal-items-list');
        itemsList.innerHTML = '';
        if (data.cart_items && Array.isArray(data.cart_items) && data.cart_items.length > 0) {
            data.cart_items.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.style.cssText = 'display: flex; align-items: center; justify-content: space-between; padding: 0.55rem 0.75rem; border-bottom: 1px solid #f1e6da; gap: 0.75rem; background: #ffffff;';
                itemDiv.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 0.65rem; min-width: 0; flex: 1;">
                        <span style="font-weight: 800; font-size: 0.65rem; background: #FAF7F2; border: 1px solid #ebdccb; color: #78000b; border-radius: 0.35rem; padding: 0.15rem 0.4rem;">${item.qty || 1}x</span>
                        <div style="min-width: 0; flex: 1;">
                            <span style="font-weight: 700; font-size: 0.75rem; color: #1c1210; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">${item.name || 'Product Item'}</span>
                        </div>
                    </div>
                    <div style="text-align: right; flex-shrink: 0;">
                        <span style="font-weight: 800; font-size: 0.75rem; color: #78000b; font-family: monospace;">€${parseFloat(item.price || 0).toFixed(2)}</span>
                    </div>
                `;
                itemsList.appendChild(itemDiv);
            });
        } else {
            itemsList.innerHTML = `<div style="padding: 1rem; text-align: center; color: #8a7267; font-size: 0.75rem;">${isEn ? 'No items recorded in this session' : 'Keine Positionen erfasst'}</div>`;
        }

        document.getElementById('modal-cart-count').textContent = data.item_count + (isEn ? ' Items' : ' Artikel');
        document.getElementById('modal-cart-total').textContent = '€' + data.cart_total;

        // Modal Action buttons
        const waBtn = document.getElementById('modal-wa-btn');
        if (data.whatsapp_link) {
            waBtn.href = data.whatsapp_link;
            waBtn.classList.remove('hidden');
        } else {
            waBtn.classList.add('hidden');
        }

        const emailBtn = document.getElementById('modal-email-btn');
        if (data.customer_email) {
            emailBtn.classList.remove('hidden');
        } else {
            emailBtn.classList.add('hidden');
        }

        const statusSelect = document.getElementById('modal-status-select');
        statusSelect.value = data.recovery_status;

        // Open modal
        document.documentElement.classList.add('modal-open');
        document.body.classList.add('modal-open');
        document.getElementById('cart-detail-modal').classList.remove('hidden');
    }

    function closeCartDetailModal() {
        document.documentElement.classList.remove('modal-open');
        document.body.classList.remove('modal-open');
        const modal = document.getElementById('cart-detail-modal');
        if (modal) modal.classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCartDetailModal();
        }
    });

    function copyCurrentRecoveryLink() {
        if (!currentModalCart) return;
        copyRecoveryLink(currentModalCart.recovery_url);
    }

    function copyRecoveryLink(url) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        navigator.clipboard.writeText(url).then(() => {
            if (window.LuxuryToast) {
                LuxuryToast.fire({ icon: 'success', title: isEn ? '1-Click Recovery Link copied to clipboard!' : '1-Klick-Link in die Zwischenablage kopiert!' });
            } else {
                alert('Copied link: ' + url);
            }
        });
    }

    function markCurrentContacted() {
        if (!currentModalCart) return;
        markAsContacted(currentModalCart.id);
    }

    function markAsContacted(cartId) {
        fetch(`/admin/abandoned-carts/${cartId}/mark-contacted`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        }).catch(err => console.error(err));
    }

    function sendCurrentRecoveryEmail(btnEl) {
        if (!currentModalCart) return;
        sendRecoveryEmail(currentModalCart.id, btnEl);
    }

    function sendRecoveryEmail(cartId, btnEl) {
        const origHtml = btnEl.innerHTML;
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        btnEl.disabled = true;
        btnEl.innerHTML = `<span class="animate-pulse">${isEn ? 'Sending...' : 'Senden...'}</span>`;

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
                    LuxuryToast.fire({ icon: 'success', title: isEn ? 'Recovery email dispatched successfully!' : data.message });
                }
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (window.LuxurySwal) {
                    LuxurySwal.fire({ icon: 'error', title: isEn ? 'Error' : 'Fehler', text: data.message });
                }
            }
        })
        .catch(err => {
            btnEl.disabled = false;
            btnEl.innerHTML = origHtml;
            console.error(err);
        });
    }

    function updateCurrentStatus(status) {
        if (!currentModalCart) return;
        updateStatus(currentModalCart.id, status);
    }

    function updateStatus(cartId, status) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
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
                    LuxuryToast.fire({ icon: 'success', title: isEn ? 'Status updated successfully' : data.message });
                }
                setTimeout(() => window.location.reload(), 800);
            }
        })
        .catch(err => console.error(err));
    }

    function confirmDeleteCart(id) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Abandoned Cart?' : 'Warenkorb löschen?',
            text: isEn ? 'Are you sure you want to remove this abandoned cart record?' : 'Möchten Sie diesen verlassenen Warenkorb wirklich unwiderruflich löschen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#78000b',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-cart-form-' + id).submit();
            }
        });
    }

    // Re-apply language on load and ensure modal is teleported to body root
    document.addEventListener('DOMContentLoaded', function() {
        ensureModalTeleported('cart-detail-modal');
        const currentLang = localStorage.getItem('mehaaj_admin_lang') || 'en';
        if (typeof applyLanguage === 'function') {
            applyLanguage(currentLang);
        }
    });
</script>
@endsection
