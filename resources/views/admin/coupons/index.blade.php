@extends('layouts.admin')
@section('title', 'Coupons & Promos - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Compact Executive KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
        
        <!-- 1. Active Coupons -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Aktive Gutscheine" data-i18n-en="Active Vouchers">Active Vouchers</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $activeCoupons }}</span>
                <span class="text-[0.62rem] text-stone-400 font-medium">von {{ $totalCoupons }} gesamt</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 2. Total Redemptions -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Gesamte Einlösungen" data-i18n-en="Total Redemptions">Total Redemptions</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ number_format($totalRedemptions) }}</span>
                <span class="text-[0.62rem] text-stone-400 font-medium">Kunden-Anwendungen</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-saltora-blush group-hover:text-saltora-terracotta transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
            </div>
        </div>

        <!-- 3. Total Discounts Granted -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-purple-700 uppercase tracking-wider block" data-i18n-de="Gewährter Rabatt" data-i18n-en="Discount Granted">Discount Granted</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ number_format($totalDiscountGiven, 2, ',', '.') }} €</span>
                <span class="text-[0.62rem] text-purple-600 font-medium">Umsatzersparnis</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 4. Expiring in 7 Days -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Läuft bald ab (7 Tage)" data-i18n-en="Expiring (7 Days)">Expiring (7 Days)</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $expiringSoon }}</span>
                <span class="text-[0.62rem] text-amber-600 font-medium">Aktion prüfen</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

    </div>

    <!-- Main Card Container -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Add Voucher Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <span data-i18n-de="Gutscheincodes & Promotions-Engine" data-i18n-en="Coupons & Promotional Engine">Coupons & Promotional Engine</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Erstellen und steuern Sie Rabattcodes, Mindestbestellwerte und Einlösungslimits." data-i18n-en="Create and manage discount codes, minimum order requirements, and redemption limits.">
                    Create and manage discount codes, minimum order requirements, and redemption limits.
                </p>
            </div>
            
            <button type="button" onclick="openCreateCouponModal()" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Gutschein Erstellen" data-i18n-en="Create Voucher">Create Voucher</span>
            </button>
        </div>

        <!-- Filter Toolbar -->
        <div class="p-4 sm:p-5 bg-[#FCFAF7] border-b border-stone-200/80">
            <form action="{{ route('admin.coupons') }}" method="GET" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 text-xs font-semibold text-stone-700">
                
                <!-- Search Box -->
                <div class="relative flex-1 min-w-[260px] max-w-md">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Gutscheincode oder Beschreibung..."
                        class="w-full pl-9 pr-3.5 py-2 rounded-xl bg-white border border-stone-200 focus:outline-none focus:border-saltora-terracotta text-stone-800 text-xs shadow-2xs font-medium"
                    >
                    <svg class="w-4 h-4 text-stone-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <!-- Right Filters -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-xl bg-white border border-stone-200 text-xs font-semibold text-stone-700 focus:outline-none focus:border-saltora-terracotta shadow-2xs cursor-pointer">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Alle Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>✓ Nur Aktive</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>✕ Deaktiviert</option>
                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>⏳ Abgelaufen</option>
                        <option value="exhausted" {{ request('status') === 'exhausted' ? 'selected' : '' }}>🚫 Aufgebraucht</option>
                    </select>

                    <!-- Type Filter -->
                    <select name="type" onchange="this.form.submit()" class="px-3 py-2 rounded-xl bg-white border border-stone-200 text-xs font-semibold text-stone-700 focus:outline-none focus:border-saltora-terracotta shadow-2xs cursor-pointer">
                        <option value="" {{ !request('type') ? 'selected' : '' }}>Alle Rabatt-Typen</option>
                        <option value="percentage" {{ request('type') === 'percentage' ? 'selected' : '' }}>Prozentual (%)</option>
                        <option value="fixed" {{ request('type') === 'fixed' ? 'selected' : '' }}>Fester Betrag (€)</option>
                    </select>

                    @if(request()->anyFilled(['q', 'status', 'type']))
                        <a href="{{ route('admin.coupons') }}" class="px-3 py-2 rounded-xl border border-stone-200 bg-white text-stone-500 hover:text-stone-800 text-xs font-bold transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="exec-table-head bg-[#F8F5EF] border-b border-stone-200 text-stone-700 font-extrabold text-[0.68rem] uppercase tracking-wider">
                        <th class="py-3 px-4">Code & Details</th>
                        <th class="py-3 px-4">Rabatt-Wert</th>
                        <th class="py-3 px-4">Bedingungen</th>
                        <th class="py-3 px-4">Nutzung / Limit</th>
                        <th class="py-3 px-4">Gültigkeit</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                    @forelse($coupons as $coupon)
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            
                            <!-- Code & Description -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-stone-900 text-white font-mono font-bold text-xs tracking-wider shadow-2xs">
                                        {{ $coupon->code }}
                                    </span>
                                    <button type="button" onclick="copyCouponCode('{{ $coupon->code }}')" class="p-1 text-stone-400 hover:text-saltora-terracotta transition" title="Code kopieren">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>
                                @if($coupon->description)
                                    <p class="text-[0.68rem] text-stone-500 mt-1 line-clamp-1">{{ $coupon->description }}</p>
                                @endif
                            </td>

                            <!-- Discount Value -->
                            <td class="py-3.5 px-4">
                                @if($coupon->type === 'percentage')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 font-extrabold text-xs">
                                        -{{ rtrim(rtrim(number_format($coupon->value, 1), '0'), '.') }}%
                                    </span>
                                    @if($coupon->max_discount)
                                        <span class="block text-[0.62rem] text-stone-400 mt-0.5">Max: {{ number_format($coupon->max_discount, 2, ',', '.') }} €</span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-800 border border-purple-200 font-extrabold text-xs">
                                        -{{ number_format($coupon->value, 2, ',', '.') }} €
                                    </span>
                                    <span class="block text-[0.62rem] text-stone-400 mt-0.5">Fester Rabatt</span>
                                @endif
                            </td>

                            <!-- Conditions -->
                            <td class="py-3.5 px-4 text-stone-600">
                                @if($coupon->min_spend > 0)
                                    <div class="flex items-center gap-1 text-[0.7rem] font-bold text-stone-800">
                                        <span>Ab {{ number_format($coupon->min_spend, 2, ',', '.') }} €</span>
                                    </div>
                                    <span class="text-[0.6rem] text-stone-400">Mindestbestellwert</span>
                                @else
                                    <span class="text-[0.7rem] text-stone-400 font-medium">Kein Mindestwert</span>
                                @endif
                            </td>

                            <!-- Usage Bar -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center justify-between text-[0.68rem] font-bold text-stone-700 mb-1">
                                    <span>{{ $coupon->used_count }} {{ $coupon->usage_limit ? '/ ' . $coupon->usage_limit : 'verwendet' }}</span>
                                    @if($coupon->usage_limit)
                                        <span class="text-stone-400 text-[0.62rem]">{{ round(($coupon->used_count / $coupon->usage_limit) * 100) }}%</span>
                                    @else
                                        <span class="text-emerald-600 text-[0.62rem]">Unbegrenzt</span>
                                    @endif
                                </div>
                                <div class="w-28 h-1.5 bg-stone-100 rounded-full overflow-hidden border border-stone-200/50">
                                    @php
                                        $percent = $coupon->usage_limit ? min(100, ($coupon->used_count / $coupon->usage_limit) * 100) : 100;
                                    @endphp
                                    <div class="h-full {{ $coupon->is_limit_reached ? 'bg-rose-500' : 'bg-saltora-terracotta' }} rounded-full" style="width: {{ $percent }}%;"></div>
                                </div>
                            </td>

                            <!-- Validity Window -->
                            <td class="py-3.5 px-4">
                                @if($coupon->expires_at)
                                    <span class="block text-xs font-semibold {{ $coupon->is_expired ? 'text-rose-600 line-through' : 'text-stone-800' }}">
                                        Bis {{ $coupon->expires_at->format('d.m.Y H:i') }}
                                    </span>
                                    <span class="text-[0.62rem] {{ $coupon->is_expired ? 'text-rose-500 font-bold' : 'text-stone-400' }}">
                                        {{ $coupon->is_expired ? 'Abgelaufen' : $coupon->expires_at->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="text-xs text-stone-700 font-semibold">Unbegrenzt gültig</span>
                                    <span class="block text-[0.62rem] text-stone-400">Kein Ablaufdatum</span>
                                @endif
                            </td>

                            <!-- Status Badge & Quick Toggle -->
                            <td class="py-3.5 px-4 text-center">
                                @if(!$coupon->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-stone-100 text-stone-600 border border-stone-200">
                                        Deaktiviert
                                    </span>
                                @elseif($coupon->is_expired)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        Abgelaufen
                                    </span>
                                @elseif($coupon->is_limit_reached)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Aufgebraucht
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Aktiv
                                    </span>
                                @endif

                                <div class="mt-1">
                                    <form action="{{ route('admin.coupons.toggle-status', $coupon) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-[0.62rem] font-bold underline {{ $coupon->is_active ? 'text-stone-400 hover:text-stone-600' : 'text-emerald-600 hover:text-emerald-700' }} cursor-pointer">
                                            {{ $coupon->is_active ? 'Deaktivieren' : 'Aktivieren' }}
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Modal Button -->
                                    <button
                                        type="button"
                                        onclick="openEditCouponModal({{ json_encode($coupon) }})"
                                        class="p-1.5 rounded-lg border border-stone-200 text-stone-600 hover:text-saltora-terracotta hover:border-saltora-terracotta bg-white transition shadow-2xs cursor-pointer"
                                        title="Bearbeiten"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirmDeleteCoupon(event, '{{ $coupon->code }}')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-1.5 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50 hover:text-rose-700 bg-white transition shadow-2xs cursor-pointer"
                                            title="Löschen"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400">
                                <div class="max-w-xs mx-auto space-y-2">
                                    <div class="h-12 w-12 rounded-2xl bg-stone-100 border border-stone-200 text-stone-400 mx-auto flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                    </div>
                                    <p class="font-bold text-stone-700 text-xs">Keine Gutscheincodes gefunden</p>
                                    <p class="text-[0.68rem] text-stone-400">Erstellen Sie Ihren ersten Promo-Gutschein für den Mehaaj Luxury Store.</p>
                                    <button type="button" onclick="openCreateCouponModal()" class="btn-exec-primary rounded-xl px-4 py-2 text-xs transition inline-flex items-center gap-1.5 mt-2">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                        <span>Jetzt Gutschein anlegen</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($coupons->hasPages())
            <div class="px-6 py-4 border-t border-stone-100 bg-[#FCFAF7]">
                {{ $coupons->links() }}
            </div>
        @endif

    </div>

</div>

<!-- CREATE COUPON MODAL -->
<div id="create-coupon-modal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-xl overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#F8F5EF] border-b border-stone-200 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-saltora-terracotta text-white flex items-center justify-center shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-sm text-stone-900">Neuen Gutscheincode anlegen</h3>
                    <p class="text-[0.65rem] text-stone-500 font-medium">Legen Sie Code, Rabattwert und Einlöse-Limits fest.</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateCouponModal()" class="text-stone-400 hover:text-stone-700 transition p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Form Body -->
        <form action="{{ route('admin.coupons.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <!-- Code & Description -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gutscheincode *</label>
                    <input
                        type="text"
                        name="code"
                        id="create_code"
                        required
                        placeholder="z.B. MEHAAJ15"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs uppercase font-mono font-bold tracking-wider"
                    >
                    <span class="text-[0.6rem] text-stone-400">Wird automatisch in Großbuchstaben umgewandelt</span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Interne Beschreibung</label>
                    <input
                        type="text"
                        name="description"
                        placeholder="z.B. VIP Sommer Kampagne 15%"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                </div>
            </div>

            <!-- Type & Value -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-[#FCFAF7] p-3.5 rounded-xl border border-stone-200/80">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Rabatt-Typ *</label>
                    <select name="type" id="create_type" onchange="handleTypeChange('create')" class="exec-input w-full px-3 py-2 rounded-xl text-xs font-semibold cursor-pointer">
                        <option value="percentage">Prozentualer Nachlass (%)</option>
                        <option value="fixed">Fester Euro-Betrag (€)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">
                        <span id="create_value_label">Rabattwert (%) *</span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            name="value"
                            id="create_value"
                            step="0.01"
                            min="0.01"
                            required
                            placeholder="15"
                            class="exec-input w-full px-3.5 py-2 rounded-xl text-xs font-bold"
                        >
                        <span id="create_value_suffix" class="absolute right-3 top-2 text-xs font-extrabold text-stone-400">%</span>
                    </div>
                </div>
            </div>

            <!-- Min Spend & Max Discount -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Mindestbestellwert (€)</label>
                    <input
                        type="number"
                        name="min_spend"
                        step="0.01"
                        min="0"
                        placeholder="0.00 (optional)"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                    <span class="text-[0.6rem] text-stone-400">0 = kein Mindestwert erforderlich</span>
                </div>
                <div id="create_max_discount_container">
                    <label class="block text-xs font-bold text-stone-800 mb-1">Maximaler Rabattdeckel (€)</label>
                    <input
                        type="number"
                        name="max_discount"
                        step="0.01"
                        min="0"
                        placeholder="z.B. 100.00 (optional)"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                    <span class="text-[0.6rem] text-stone-400">Cap für prozentuale Gutscheine</span>
                </div>
            </div>

            <!-- Usage Limit & Date Range -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Einlösungslimit</label>
                    <input
                        type="number"
                        name="usage_limit"
                        min="1"
                        placeholder="Unbegrenzt"
                        class="exec-input w-full px-3 py-2 rounded-xl text-xs"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gültig ab</label>
                    <input
                        type="datetime-local"
                        name="starts_at"
                        class="exec-input w-full px-2.5 py-2 rounded-xl text-xs text-stone-600"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gültig bis</label>
                    <input
                        type="datetime-local"
                        name="expires_at"
                        class="exec-input w-full px-2.5 py-2 rounded-xl text-xs text-stone-600"
                    >
                </div>
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="create_is_active" value="1" checked class="h-4 w-4 rounded text-saltora-terracotta border-stone-300 focus:ring-saltora-terracotta">
                <label for="create_is_active" class="text-xs font-bold text-stone-800 cursor-pointer">Gutscheincode sofort im Shop aktivieren</label>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-stone-200 pt-4 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateCouponModal()" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs">
                    Abbrechen
                </button>
                <button type="submit" class="btn-exec-primary rounded-xl px-5 py-2 text-xs font-bold flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Gutschein Speichern</span>
                </button>
            </div>

        </form>

    </div>
</div>

<!-- EDIT COUPON MODAL -->
<div id="edit-coupon-modal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-xl overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#F8F5EF] border-b border-stone-200 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-stone-900 text-white flex items-center justify-center shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-sm text-stone-900">Gutscheincode bearbeiten</h3>
                    <p class="text-[0.65rem] text-stone-500 font-medium">Passen Sie Konditionen, Limits und Laufzeiten an.</p>
                </div>
            </div>
            <button type="button" onclick="closeEditCouponModal()" class="text-stone-400 hover:text-stone-700 transition p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Form Body -->
        <form id="edit_coupon_form" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <!-- Code & Description -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gutscheincode *</label>
                    <input
                        type="text"
                        name="code"
                        id="edit_code"
                        required
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs uppercase font-mono font-bold tracking-wider"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Interne Beschreibung</label>
                    <input
                        type="text"
                        name="description"
                        id="edit_description"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                </div>
            </div>

            <!-- Type & Value -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-[#FCFAF7] p-3.5 rounded-xl border border-stone-200/80">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Rabatt-Typ *</label>
                    <select name="type" id="edit_type" onchange="handleTypeChange('edit')" class="exec-input w-full px-3 py-2 rounded-xl text-xs font-semibold cursor-pointer">
                        <option value="percentage">Prozentualer Nachlass (%)</option>
                        <option value="fixed">Fester Euro-Betrag (€)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">
                        <span id="edit_value_label">Rabattwert (%) *</span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            name="value"
                            id="edit_value"
                            step="0.01"
                            min="0.01"
                            required
                            class="exec-input w-full px-3.5 py-2 rounded-xl text-xs font-bold"
                        >
                        <span id="edit_value_suffix" class="absolute right-3 top-2 text-xs font-extrabold text-stone-400">%</span>
                    </div>
                </div>
            </div>

            <!-- Min Spend & Max Discount -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Mindestbestellwert (€)</label>
                    <input
                        type="number"
                        name="min_spend"
                        id="edit_min_spend"
                        step="0.01"
                        min="0"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                </div>
                <div id="edit_max_discount_container">
                    <label class="block text-xs font-bold text-stone-800 mb-1">Maximaler Rabattdeckel (€)</label>
                    <input
                        type="number"
                        name="max_discount"
                        id="edit_max_discount"
                        step="0.01"
                        min="0"
                        class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                    >
                </div>
            </div>

            <!-- Usage Limit & Date Range -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Einlösungslimit</label>
                    <input
                        type="number"
                        name="usage_limit"
                        id="edit_usage_limit"
                        min="1"
                        placeholder="Unbegrenzt"
                        class="exec-input w-full px-3 py-2 rounded-xl text-xs"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gültig ab</label>
                    <input
                        type="datetime-local"
                        name="starts_at"
                        id="edit_starts_at"
                        class="exec-input w-full px-2.5 py-2 rounded-xl text-xs text-stone-600"
                    >
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-800 mb-1">Gültig bis</label>
                    <input
                        type="datetime-local"
                        name="expires_at"
                        id="edit_expires_at"
                        class="exec-input w-full px-2.5 py-2 rounded-xl text-xs text-stone-600"
                    >
                </div>
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="edit_is_active" value="1" class="h-4 w-4 rounded text-saltora-terracotta border-stone-300 focus:ring-saltora-terracotta">
                <label for="edit_is_active" class="text-xs font-bold text-stone-800 cursor-pointer">Gutscheincode aktiv im Shop</label>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-stone-200 pt-4 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeEditCouponModal()" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs">
                    Abbrechen
                </button>
                <button type="submit" class="btn-exec-primary rounded-xl px-5 py-2 text-xs font-bold flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Änderungen Speichern</span>
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    function openCreateCouponModal() {
        document.getElementById('create-coupon-modal').classList.remove('hidden');
    }
    function closeCreateCouponModal() {
        document.getElementById('create-coupon-modal').classList.add('hidden');
    }

    function openEditCouponModal(coupon) {
        const form = document.getElementById('edit_coupon_form');
        form.action = `/admin/coupons/${coupon.id}`;

        document.getElementById('edit_code').value = coupon.code;
        document.getElementById('edit_description').value = coupon.description || '';
        document.getElementById('edit_type').value = coupon.type;
        document.getElementById('edit_value').value = coupon.value;
        document.getElementById('edit_min_spend').value = coupon.min_spend > 0 ? coupon.min_spend : '';
        document.getElementById('edit_max_discount').value = coupon.max_discount || '';
        document.getElementById('edit_usage_limit').value = coupon.usage_limit || '';

        // Format dates for datetime-local
        if (coupon.starts_at) {
            document.getElementById('edit_starts_at').value = coupon.starts_at.substring(0, 16);
        } else {
            document.getElementById('edit_starts_at').value = '';
        }
        if (coupon.expires_at) {
            document.getElementById('edit_expires_at').value = coupon.expires_at.substring(0, 16);
        } else {
            document.getElementById('edit_expires_at').value = '';
        }

        document.getElementById('edit_is_active').checked = Boolean(coupon.is_active);

        handleTypeChange('edit');
        document.getElementById('edit-coupon-modal').classList.remove('hidden');
    }

    function closeEditCouponModal() {
        document.getElementById('edit-coupon-modal').classList.add('hidden');
    }

    function handleTypeChange(prefix) {
        const type = document.getElementById(`${prefix}_type`).value;
        const label = document.getElementById(`${prefix}_value_label`);
        const suffix = document.getElementById(`${prefix}_value_suffix`);
        const maxContainer = document.getElementById(`${prefix}_max_discount_container`);

        if (type === 'percentage') {
            label.innerText = 'Rabattwert (%) *';
            suffix.innerText = '%';
            if (maxContainer) maxContainer.classList.remove('hidden');
        } else {
            label.innerText = 'Rabattbetrag (€) *';
            suffix.innerText = '€';
            if (maxContainer) maxContainer.classList.add('hidden');
        }
    }

    function copyCouponCode(code) {
        navigator.clipboard.writeText(code).then(() => {
            if (window.LuxuryToast) {
                LuxuryToast.fire({
                    icon: 'success',
                    title: `Code "${code}" kopiert!`
                });
            } else {
                alert(`Code "${code}" in die Zwischenablage kopiert!`);
            }
        });
    }

    function confirmDeleteCoupon(event, code) {
        event.preventDefault();
        const form = event.target;

        if (window.LuxurySwal) {
            LuxurySwal.fire({
                icon: 'warning',
                title: `Gutschein "${code}" löschen?`,
                text: 'Dieser Gutschein und seine Verwendungsdaten werden dauerhaft entfernt.',
                showCancelButton: true,
                confirmButtonText: 'Ja, löschen',
                cancelButtonText: 'Abbrechen',
                confirmButtonColor: '#be123c'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        } else {
            if (confirm(`Möchten Sie den Gutschein "${code}" wirklich löschen?`)) {
                form.submit();
            }
        }
    }
</script>
@endsection
