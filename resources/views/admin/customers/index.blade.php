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

    <!-- Main Customers Card matching Screenshot 3 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) with Lime Green Add Button (#84cc16) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <h2 class="font-extrabold text-lg text-white tracking-wide" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</h2>
            
            <a href="{{ route('admin.customers.create') }}" class="rounded-full btn-lime-save text-white px-5 py-2 text-xs font-extrabold transition shadow-md flex items-center gap-1.5 cursor-pointer" style="background-color: #84cc16 !important; color: #ffffff !important;">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="VIP Kunde Hinzufügen" data-i18n-en="Add VIP Customer">VIP Kunde Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-[#194AA2]">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Tier Filter & Search Form -->
                <form action="{{ route('admin.customers') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <select name="vip_tier" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-[#194AA2]">
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
                        placeholder=""
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-[#194AA2] w-full sm:w-48 shadow-2xs"
                    >
                    @if(request('search') || request('vip_tier'))
                        <a href="{{ route('admin.customers') }}" class="text-xs text-red-500 hover:underline">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-200 text-xs">
                        <tr>
                            <th class="p-3.5">Kunden Name & E-Mail</th>
                            <th class="p-3.5">Telefon & Stadt</th>
                            <th class="p-3.5">VIP Tier Status</th>
                            <th class="p-3.5">Gesamtumsatz (€)</th>
                            <th class="p-3.5">Bestellungen</th>
                            <th class="p-3.5">Status</th>
                            <th class="p-3.5 text-center">Aktionen</th>
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
                                        <span class="rounded bg-gradient-to-r from-slate-700 to-slate-900 text-amber-300 border border-amber-300/30 px-2.5 py-1 text-[0.65rem] font-extrabold uppercase shadow-2xs">
                                            💎 Platinum VIP
                                        </span>
                                    @elseif($customer->vip_tier === 'gold')
                                        <span class="rounded bg-amber-500 text-white px-2.5 py-1 text-[0.65rem] font-extrabold uppercase shadow-2xs">
                                            🏆 Gold VIP
                                        </span>
                                    @elseif($customer->vip_tier === 'silver')
                                        <span class="rounded bg-slate-400 text-white px-2.5 py-1 text-[0.65rem] font-bold uppercase shadow-2xs">
                                            🥈 Silver VIP
                                        </span>
                                    @else
                                        <span class="rounded bg-slate-200 text-slate-700 px-2.5 py-1 text-[0.65rem] font-bold uppercase">
                                            Standard
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5 font-extrabold text-emerald-700 text-sm">
                                    €{{ number_format($customer->total_spent, 2, ',', '.') }}
                                </td>
                                <td class="p-3.5">
                                    <span class="rounded-full bg-blue-50 text-[#194AA2] border border-blue-200 px-2.5 py-1 text-[0.65rem] font-bold">
                                        {{ $customer->total_orders }} Käufe
                                    </span>
                                </td>
                                <td class="p-3.5">
                                    @if($customer->status === 'active')
                                        <span class="rounded-full bg-emerald-100 text-emerald-800 px-3 py-1 text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="rounded-full bg-slate-100 text-slate-600 px-3 py-1 text-[0.65rem] font-bold uppercase">Inaktiv</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Pill Button matching Screenshot 3 -->
                                        <a 
                                            href="{{ route('admin.customers.edit', $customer->id) }}"
                                            class="rounded-full text-white px-4 py-1.5 text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1"
                                            style="background-color: #0d2352 !important; color: #ffffff !important;"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Edit
                                        </a>

                                        <!-- Delete Pill Button matching Screenshot 3 -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteCustomer({{ $customer->id }}, '{{ addslashes($customer->name) }}')"
                                            class="rounded-full text-white px-4 py-1.5 text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1"
                                            style="background-color: #dc2626 !important; color: #ffffff !important;"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Delete
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
