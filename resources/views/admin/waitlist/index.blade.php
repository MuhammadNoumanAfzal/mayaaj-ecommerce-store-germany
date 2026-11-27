@extends('layouts.admin')
@section('title', 'Waitlist & Demand - MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- Top Luxury Header Card -->
    <div class="relative bg-white rounded-3xl border border-[#ebdccb] shadow-xs p-5 sm:p-6 overflow-hidden">
        <!-- Luxury Accent Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-1">
            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-[#78000b]"></span>
                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#78000b]" data-i18n-de="ATELIER WARTELISTE" data-i18n-en="ATELIER WAITLIST">ATELIER WAITLIST</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#1c1210] tracking-tight mt-1" data-i18n-de="Warteliste & Nachfrage" data-i18n-en="Waitlist & Demand">
                    Waitlist & Demand
                </h1>
                <p class="text-xs text-stone-600 font-medium mt-0.5" data-i18n-de="Kundenanfragen für ausverkaufte Artikel überwachen und Restock-Benachrichtigungen senden." data-i18n-en="Track out-of-stock customer demand and dispatch restock notifications.">
                    Track out-of-stock customer demand and dispatch restock notifications.
                </p>
            </div>

            <!-- Total Counter Badge -->
            <div class="flex items-center gap-2 shrink-0">
                <span class="rounded-xl border border-[#ebdccb] bg-[#faf7f2] px-3.5 py-2 text-xs font-bold text-[#1c1210] shadow-2xs inline-flex items-center gap-1.5">
                    <span data-i18n-de="Einträge:" data-i18n-en="Entries:">Entries:</span>
                    <strong class="text-[#78000b] font-mono text-sm">{{ $totalWaitlistCount }}</strong>
                </span>
            </div>
        </div>

        <!-- 4 Minimal Clean KPI Cards (No extra wording) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4 mt-5 pt-5 border-t border-[#f1e6da]">
            <!-- 1. Latent Revenue -->
            <div class="bg-[#faf7f2]/70 rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-amber-900 block" data-i18n-de="Umsatz-Potenzial" data-i18n-en="Demand Revenue">Demand Revenue</span>
                <div class="text-2xl font-black text-[#1c1210]">
                    €{{ number_format($latentRevenueDemand, 2, '.', ',') }}
                </div>
            </div>

            <!-- 2. Waiting Patrons -->
            <div class="bg-[#faf7f2]/70 rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-rose-900 block" data-i18n-de="Wartende Kunden" data-i18n-en="Waiting Patrons">Waiting Patrons</span>
                <div class="text-2xl font-black text-[#78000b]">
                    {{ $pendingWaitlistCount }}
                </div>
            </div>

            <!-- 3. Alerts Sent -->
            <div class="bg-[#faf7f2]/70 rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-emerald-900 block" data-i18n-de="Alerts Gesendet" data-i18n-en="Alerts Sent">Alerts Sent</span>
                <div class="text-2xl font-black text-[#065f46]">
                    {{ $notifiedCount }}
                </div>
            </div>

            <!-- 4. Top Requested -->
            <div class="bg-[#faf7f2]/70 rounded-2xl p-4 border border-[#ebdccb] shadow-2xs space-y-1">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-700 block" data-i18n-de="Top Nachfrage" data-i18n-en="Top Requested">Top Requested</span>
                @php $topDemand = $demandByProduct->first(); @endphp
                <div class="text-sm font-bold text-[#1c1210] truncate mt-1" title="{{ $topDemand?->product?->name }}">
                    {{ $topDemand?->product?->name ?? 'None' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-3xl border border-[#ebdccb] shadow-xs p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Status Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.waitlist') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer {{ !$status ? 'bg-[#78000b] text-white' : 'bg-[#faf7f2] text-stone-700 hover:bg-[#ebdccb]/40 border border-[#ebdccb]' }}">
                <span data-i18n-de="Alle" data-i18n-en="All">All</span> ({{ $totalWaitlistCount }})
            </a>
            <a href="{{ route('admin.waitlist', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer {{ $status === 'pending' ? 'bg-[#78000b] text-white' : 'bg-[#faf7f2] text-stone-700 hover:bg-[#ebdccb]/40 border border-[#ebdccb]' }}">
                <span data-i18n-de="Wartend" data-i18n-en="Waiting">Waiting</span> ({{ $pendingWaitlistCount }})
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
                        placeholder="Search waitlist..." 
                        data-i18n-placeholder-de="Warteliste durchsuchen..."
                        data-i18n-placeholder-en="Search waitlist..."
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

    <!-- Waitlist Subscribers Table (Clean, Single-Line, Uncluttered) -->
    <div class="bg-white rounded-3xl border border-[#ebdccb] shadow-xs overflow-hidden">
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs table-auto">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Kunde" data-i18n-en="Customer">Customer</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Produkt" data-i18n-en="Product">Product</th>
                        <th class="py-3 px-3 font-black text-center" data-i18n-de="Ausführung" data-i18n-en="Design">Design</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Preis" data-i18n-en="Price">Price</th>
                        <th class="py-3 px-4 font-black text-center w-28" data-i18n-de="Datum" data-i18n-en="Date">Date</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-4 font-black text-center w-36" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($notifications as $notif)
                        @php
                            $modalData = [
                                'id' => $notif->id,
                                'customer_name' => $notif->customer_name ?: 'Atelier Patron',
                                'customer_email' => $notif->customer_email,
                                'product_id' => $notif->product_id,
                                'product_name' => $notif->product?->name ?? ('Product #' . $notif->product_id),
                                'product_sku' => $notif->product?->sku ?? 'N/A',
                                'product_price' => $notif->product ? number_format($notif->product->sale_price ?? $notif->product->price, 2, '.', ',') : '—',
                                'product_image' => $notif->product?->image_url ?? '',
                                'store_url' => $notif->product ? route('shop.show', $notif->product->slug) : '#',
                                'variation' => $notif->variation_name ?: 'Standard Edition',
                                'status' => $notif->status,
                                'created_at' => $notif->created_at->format('d.m.Y H:i'),
                                'notified_at' => $notif->notified_at ? $notif->notified_at->format('d.m.Y H:i') : null,
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="waitlist-row-{{ $notif->id }}">
                            <!-- Index -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($notifications->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 1. Customer (Clean Single Line) -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="font-bold text-[#1c1210] cursor-pointer hover:text-[#78000b] transition" onclick='openWaitlistDetailModal(@json($modalData))' title="{{ $notif->customer_email }}">
                                    {{ $notif->customer_name ?: $notif->customer_email }}
                                </span>
                            </td>

                            <!-- 2. Product (Clean Single Line with Thumbnail) -->
                            <td class="py-3 px-4 max-w-xs whitespace-nowrap">
                                @if($notif->product)
                                    <div class="flex items-center gap-2 cursor-pointer group" onclick='openWaitlistDetailModal(@json($modalData))'>
                                        <img src="{{ $notif->product->image_url }}" alt="{{ $notif->product->name }}" class="h-7 w-7 rounded-md object-cover border border-[#ebdccb] shrink-0 bg-[#FAF7F2]">
                                        <span class="font-bold text-[#1c1210] group-hover:text-[#78000b] group-hover:underline truncate">
                                            {{ $notif->product->name }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-stone-400 font-mono text-xs">Product #{{ $notif->product_id }}</span>
                                @endif
                            </td>

                            <!-- 3. Variation (Clean Single Line Pill) -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-[#FAF7F2] text-stone-700 border border-[#ebdccb]">
                                    {{ $notif->variation_name ?: 'Standard' }}
                                </span>
                            </td>

                            <!-- 4. Price (Single Line) -->
                            <td class="py-3 px-3 text-center font-mono font-bold text-[#78000b] text-xs whitespace-nowrap">
                                @if($notif->product)
                                    €{{ number_format($notif->product->sale_price ?? $notif->product->price, 2, '.', ',') }}
                                @else
                                    —
                                @endif
                            </td>

                            <!-- 5. Date (Single Line) -->
                            <td class="py-3 px-4 text-center font-mono text-stone-600 text-xs whitespace-nowrap">
                                {{ $notif->created_at->format('d.m.Y') }}
                            </td>

                            <!-- 6. Status (Clean Single Line Badge) -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                @if($notif->status === 'notified')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Benachrichtigt" data-i18n-en="Notified">Notified</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                        <span data-i18n-de="Wartend" data-i18n-en="Waiting">Waiting</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 7. Actions (View Modal + Delete) -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- View Details Button -->
                                    <button 
                                        type="button" 
                                        onclick='openWaitlistDetailModal(@json($modalData))'
                                        class="h-7 px-2.5 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95" 
                                        title="View Details"
                                        data-i18n-title-de="Details ansehen"
                                        data-i18n-title-en="View Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Details" data-i18n-en="Details">Details</span>
                                    </button>

                                    <!-- Delete Button -->
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
                                </div>
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
                                    <p class="text-xs text-stone-500 max-w-sm" data-i18n-de="Sobald Kunden sich auf Produktseiten eintragen, erscheinen sie hier." data-i18n-en="When customers subscribe on sold-out products, they will appear here.">
                                        When customers subscribe on sold-out products, they will appear here.
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

<!-- Luxury Waitlist Entry Details Modal -->
<div 
    id="waitlist-detail-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.75) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important;" 
    onclick="closeWaitlistDetailModal()"
>
    <div 
        class="relative w-full bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden my-auto transform transition-all" 
        style="max-width: 620px !important; width: 100% !important; background: #ffffff !important; border-radius: 1.5rem !important; border: 1px solid #ebdccb !important; box-shadow: 0 25px 50px -12px rgba(120, 0, 11, 0.25) !important;"
        onclick="event.stopPropagation()"
    >
        <!-- Gold & Wine Top Accent Strip -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Modal Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-bottom: 1px solid #ebdccb;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 34px; height: 34px; border-radius: 0.65rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: linear-gradient(135deg, #78000b 0%, #4a0207 100%); color: #d8b45a; border: 1px solid rgba(216, 180, 90, 0.45); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <svg style="width: 16px; height: 16px; color: #d8b45a;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h3 style="font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.15rem; font-weight: 700; color: #1c1210; line-height: 1.2; margin: 0;" data-i18n-de="Wartelisten-Eintrag Details" data-i18n-en="Waitlist Entry Details">Waitlist Entry Details</h3>
                    <p style="font-size: 0.65rem; color: #8a7267; font-family: monospace; margin: 0; line-height: 1;" id="modal-waitlist-id">Entry #0</p>
                </div>
            </div>
            <button type="button" onclick="closeWaitlistDetailModal()" style="width: 28px; height: 28px; border-radius: 0.65rem; background: #ffffff; color: #6b7280; border: 1px solid #ebdccb; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" title="Close" data-i18n-title-de="Schließen" data-i18n-title-en="Close">
                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div style="padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem; max-height: 75vh; overflow-y: auto;">
            
            <!-- Customer Information Card -->
            <div style="padding: 0.85rem; border-radius: 0.85rem; background: #FAF8F5; border: 1px solid #ebdccb; display: flex; flex-direction: column; gap: 0.35rem;">
                <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em;" data-i18n-de="Kundeninformation" data-i18n-en="Customer Information">Customer Information</span>
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                    <div>
                        <h4 id="modal-customer-name" style="font-size: 0.95rem; font-weight: 700; color: #1c1210; margin: 0;"></h4>
                        <a id="modal-customer-email" href="#" style="font-size: 0.75rem; color: #78000b; font-family: monospace; text-decoration: underline; margin-top: 0.15rem; display: inline-block;"></a>
                    </div>
                    <span id="modal-status-badge"></span>
                </div>
            </div>

            <!-- Requested Product Card -->
            <div style="padding: 0.85rem; border-radius: 0.85rem; background: #ffffff; border: 1px solid #ebdccb; display: flex; align-items: center; justify-content: space-between; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 0;">
                    <img id="modal-product-image" src="" alt="" style="width: 48px; height: 48px; border-radius: 0.65rem; object-fit: cover; border: 1px solid #ebdccb; background: #FAF7F2; flex-shrink: 0;">
                    <div style="min-width: 0;">
                        <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Angefragtes Produkt" data-i18n-en="Requested Product">Requested Product</span>
                        <h4 id="modal-product-name" style="font-size: 0.85rem; font-weight: 700; color: #1c1210; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></h4>
                        <span style="font-size: 0.65rem; color: #8a7267; font-family: monospace;" id="modal-product-sku">SKU: N/A</span>
                    </div>
                </div>
                <div style="text-align: right; flex-shrink: 0;">
                    <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Einzelpreis" data-i18n-en="Price">Price</span>
                    <span id="modal-product-price" style="font-size: 0.95rem; font-weight: 800; color: #78000b; font-family: monospace;">€0.00</span>
                </div>
            </div>

            <!-- 2-Column Info Grid: Variation & Timestamps -->
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.75rem;">
                <div style="padding: 0.75rem; border-radius: 0.75rem; background: #FAF8F5; border: 1px solid #ebdccb;">
                    <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Ausführung / Edition" data-i18n-en="Design / Edition">Design / Edition</span>
                    <span id="modal-variation" style="font-size: 0.8rem; font-weight: 700; color: #1c1210; display: block; margin-top: 0.2rem;">Standard</span>
                </div>

                <div style="padding: 0.75rem; border-radius: 0.75rem; background: #FAF8F5; border: 1px solid #ebdccb;">
                    <span style="font-size: 0.6rem; font-weight: 800; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Eingetragen am" data-i18n-en="Subscribed On">Subscribed On</span>
                    <span id="modal-created-at" style="font-size: 0.8rem; font-weight: 700; color: #1c1210; font-family: monospace; display: block; margin-top: 0.2rem;"></span>
                </div>
            </div>

            <!-- Notified Status Bar (if already notified) -->
            <div id="modal-notified-banner" class="hidden" style="padding: 0.65rem 0.85rem; border-radius: 0.75rem; background: #ecfdf5; border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: space-between; font-size: 0.7rem; color: #065f46;">
                <div style="display: flex; align-items: center; gap: 0.4rem;">
                    <svg style="width: 14px; height: 14px; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span style="font-weight: 700;" data-i18n-de="Restock-Alert versendet am:" data-i18n-en="Restock Alert dispatched on:">Restock Alert dispatched on:</span>
                </div>
                <span id="modal-notified-at" style="font-family: monospace; font-weight: 800;"></span>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-top: 1px solid #ebdccb; gap: 0.75rem;">
            <a id="modal-store-link" href="#" target="_blank" style="font-size: 0.75rem; font-weight: 700; color: #78000b; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer;">
                <span data-i18n-de="Im Store ansehen" data-i18n-en="View on Storefront">View on Storefront</span>
                <svg style="width: 14px; height: 14px; color: #78000b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>

            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <button type="button" onclick="closeWaitlistDetailModal()" class="btn-exec-secondary" style="border-radius: 0.75rem; padding: 0.45rem 1rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                    <span data-i18n-de="Schließen" data-i18n-en="Close">Close</span>
                </button>

                <div id="modal-dispatch-wrap">
                    <form id="modal-dispatch-form" method="POST" action="" class="inline">
                        @csrf
                        <button type="button" onclick="confirmDispatchFromModal()" class="btn-exec-primary" style="border-radius: 0.75rem; padding: 0.45rem 1rem; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer;">
                            <svg style="width: 14px; height: 14px; color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span data-i18n-de="Alert senden" data-i18n-en="Dispatch Alert">Dispatch Alert</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal & Confirmation Scripts -->
<script>
    let activeModalData = null;

    function openWaitlistDetailModal(data) {
        activeModalData = data;
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('modal-waitlist-id').textContent = 'Entry #' + data.id;
        document.getElementById('modal-customer-name').textContent = data.customer_name;
        
        const emailEl = document.getElementById('modal-customer-email');
        emailEl.textContent = data.customer_email;
        emailEl.href = 'mailto:' + data.customer_email;

        document.getElementById('modal-product-name').textContent = data.product_name;
        document.getElementById('modal-product-sku').textContent = 'SKU: ' + data.product_sku;
        document.getElementById('modal-product-price').textContent = '€' + data.product_price;
        document.getElementById('modal-product-image').src = data.product_image || '';
        document.getElementById('modal-variation').textContent = data.variation;
        document.getElementById('modal-created-at').textContent = data.created_at;
        document.getElementById('modal-store-link').href = data.store_url;

        // Status badge
        const badgeEl = document.getElementById('modal-status-badge');
        if (data.status === 'notified') {
            badgeEl.innerHTML = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;"><span style="width: 6px; height: 6px; border-radius: 9999px; background: #059669;"></span>${isEn ? 'Notified' : 'Benachrichtigt'}</span>`;
        } else {
            badgeEl.innerHTML = `<span style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #fffbeb; color: #92400e; border: 1px solid #fde68a;"><span style="width: 6px; height: 6px; border-radius: 9999px; background: #d97706;"></span>${isEn ? 'Waiting' : 'Wartend'}</span>`;
        }

        // Notified banner & dispatch button
        const notifiedBanner = document.getElementById('modal-notified-banner');
        const notifiedAtEl = document.getElementById('modal-notified-at');
        const dispatchWrap = document.getElementById('modal-dispatch-wrap');
        const dispatchForm = document.getElementById('modal-dispatch-form');

        if (data.status === 'notified' && data.notified_at) {
            notifiedBanner.classList.remove('hidden');
            notifiedAtEl.textContent = data.notified_at;
            dispatchWrap.classList.add('hidden');
        } else {
            notifiedBanner.classList.add('hidden');
            dispatchWrap.classList.remove('hidden');
            dispatchForm.action = `/admin/waitlist/${data.product_id}/notify`;
        }

        document.documentElement.classList.add('modal-open');
        document.body.classList.add('modal-open');
        document.getElementById('waitlist-detail-modal').classList.remove('hidden');
    }

    function closeWaitlistDetailModal() {
        document.documentElement.classList.remove('modal-open');
        document.body.classList.remove('modal-open');
        const modal = document.getElementById('waitlist-detail-modal');
        if (modal) modal.classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeWaitlistDetailModal();
        }
    });

    function confirmDispatchFromModal() {
        if (!activeModalData) return;
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Dispatch Restock Alert?' : 'Restock-Alert versenden?',
            text: isEn 
                ? `Send restock alert for "${activeModalData.product_name}" to ${activeModalData.customer_email}?` 
                : `Restock-Benachrichtigung für "${activeModalData.product_name}" an ${activeModalData.customer_email} senden?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#78000b',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Send Alert' : 'Ja, Alert senden',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('modal-dispatch-form').submit();
            }
        });
    }

    function confirmDeleteWaitlist(id, email) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Waitlist Entry?' : 'Wartelisten-Eintrag löschen?',
            text: isEn ? `Remove waitlist subscription for ${email}?` : `Wartelisten-Abonnement für ${email} entfernen?`,
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

    // Re-apply language on load
    document.addEventListener('DOMContentLoaded', function() {
        const currentLang = localStorage.getItem('mehaaj_admin_lang') || 'en';
        if (typeof applyLanguage === 'function') {
            applyLanguage(currentLang);
        }
    });
</script>
@endsection
