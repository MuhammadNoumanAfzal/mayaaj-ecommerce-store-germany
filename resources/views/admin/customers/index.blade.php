@extends('layouts.admin')
@section('title', 'VIP Kundenstamm - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-100 flex items-center justify-between">
        <div>
            <span data-i18n-de="MEHAAJ Admin Dashboard" data-i18n-en="MEHAAJ Admin Dashboard">MEHAAJ Admin Dashboard</span> 
            <span class="mx-1.5 text-slate-400 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium">
            <span data-i18n-de="Gesamt Kunden:" data-i18n-en="Total Customers:">Gesamt Kunden:</span> <span class="text-[#194AA2] font-bold">{{ count($customers) }}</span>
        </div>
    </div>

    <!-- Main Customers Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-lg text-slate-900 tracking-tight" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</h2>
                <p class="text-xs text-slate-500 font-medium" data-i18n-de="Verwalten Sie exklusive Kundenprofile und Status" data-i18n-en="Manage exclusive customer profiles and tiers">Verwalten Sie exklusive Kundenprofile und Status</p>
            </div>
            
            <a href="{{ route('admin.customers.create') }}" class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-xs font-bold transition shadow-xs flex items-center gap-1.5 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="VIP Kunde Hinzufügen" data-i18n-en="Add VIP Customer">VIP Kunde Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-indigo-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Tier Filter & Search Form -->
                <form action="{{ route('admin.customers') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <select name="vip_tier" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle VIP Tiers" data-i18n-en="All VIP Tiers">Alle VIP Tiers</option>
                        <option value="platinum" {{ request('vip_tier') === 'platinum' ? 'selected' : '' }}>Platinum VIP</option>
                        <option value="gold" {{ request('vip_tier') === 'gold' ? 'selected' : '' }}>Gold VIP</option>
                        <option value="silver" {{ request('vip_tier') === 'silver' ? 'selected' : '' }}>Silver VIP</option>
                        <option value="regular" {{ request('vip_tier') === 'regular' ? 'selected' : '' }}>Standard</option>
                    </select>

                    <span data-i18n-de="Suche:" data-i18n-en="Search:">Suche:</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Kunde suchen..."
                        data-i18n-placeholder-de="Kunde suchen..."
                        data-i18n-placeholder-en="Search customer..."
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-indigo-500 w-full sm:w-48 shadow-2xs"
                    >
                    @if(request('search') || request('vip_tier'))
                        <a href="{{ route('admin.customers') }}" class="text-xs text-rose-500 hover:underline" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-200 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-200 text-xs">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Kunden Name & E-Mail" data-i18n-en="Customer Name & Email">Kunden Name & E-Mail</th>
                            <th class="p-3.5" data-i18n-de="Telefon & Stadt" data-i18n-en="Phone & City">Telefon & Stadt</th>
                            <th class="p-3.5" data-i18n-de="VIP Tier Status" data-i18n-en="VIP Tier Status">VIP Tier Status</th>
                            <th class="p-3.5" data-i18n-de="Gesamtumsatz (€)" data-i18n-en="Total Spent (€)">Gesamtumsatz (€)</th>
                            <th class="p-3.5" data-i18n-de="Bestellungen" data-i18n-en="Orders">Bestellungen</th>
                            <th class="p-3.5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($customers as $customer)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 font-bold text-slate-900 text-sm">
                                    {{ $customer->name }}
                                    <span class="block text-[0.68rem] text-slate-500 font-normal">{{ $customer->email }}</span>
                                </td>
                                <td class="p-3.5 text-slate-600">
                                    <p>{{ $customer->phone ?? '— Keine Nummer —' }}</p>
                                    <p class="text-[0.68rem] text-slate-400">{{ $customer->city ?? 'Deutschland' }}</p>
                                </td>
                                <td class="p-3.5">
                                    @if($customer->vip_tier === 'platinum')
                                        <span class="rounded-lg bg-slate-900 text-amber-300 border border-amber-300/30 px-2.5 py-1 text-[0.65rem] font-extrabold uppercase shadow-2xs">
                                            💎 Platinum VIP
                                        </span>
                                    @elseif($customer->vip_tier === 'gold')
                                        <span class="rounded-lg bg-amber-500 text-white px-2.5 py-1 text-[0.65rem] font-extrabold uppercase shadow-2xs">
                                            🏆 Gold VIP
                                        </span>
                                    @elseif($customer->vip_tier === 'silver')
                                        <span class="rounded-lg bg-slate-400 text-white px-2.5 py-1 text-[0.65rem] font-bold uppercase shadow-2xs">
                                            🥈 Silver VIP
                                        </span>
                                    @else
                                        <span class="rounded-lg bg-slate-100 text-slate-700 px-2.5 py-1 text-[0.65rem] font-bold uppercase">
                                            Standard
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5 font-extrabold text-emerald-700 text-sm">
                                    €{{ number_format($customer->total_spent, 2, ',', '.') }}
                                </td>
                                <td class="p-3.5">
                                    <span class="rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 px-2.5 py-1 text-[0.65rem] font-bold">
                                        {{ $customer->total_orders }} Käufe
                                    </span>
                                </td>
                                <td class="p-3.5">
                                    @if($customer->status === 'active')
                                        <span class="rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="rounded-full bg-slate-100 text-slate-600 px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Inaktiv" data-i18n-en="Inactive">Inaktiv</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Soft Pill Button -->
                                        <a 
                                            href="{{ route('admin.customers.edit', $customer->id) }}"
                                            class="rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Bearbeiten
                                        </a>

                                        <!-- Delete Soft Pill Button -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteCustomer({{ $customer->id }}, '{{ addslashes($customer->name) }}')"
                                            class="rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Löschen
                                        </button>

                                        <form id="delete-customer-form-{{ $customer->id }}" action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400 text-xs">
                                    <p class="text-base font-bold text-slate-600 mb-1" data-i18n-de="Keine Kunden gefunden" data-i18n-en="No customers found">Keine Kunden gefunden</p>
                                    <p data-i18n-de="Legen Sie Kundenkonten über den Button oben an." data-i18n-en="Create customer accounts using the button above.">Legen Sie Kundenkonten über den Button oben an.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script>
    function confirmDeleteCustomer(id, name) {
        LuxurySwal.fire({
            title: 'Kundenkonto löschen?',
            text: `Möchten Sie das Kundenkonto von "${name}" wirklich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ja, Konto löschen',
            cancelButtonText: 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-customer-form-' + id).submit();
            }
        });
    }
</script>
@endsection
