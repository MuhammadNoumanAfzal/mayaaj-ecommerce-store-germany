@extends('layouts.admin')
@section('title', 'VIP Customers - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Customers</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamt Kunden:" data-i18n-en="Total Customers:">Total Customers:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ count($customers) }}</span>
        </div>
    </div>

    <!-- Main Customers Executive Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-xs overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Clean White Card Header with Terracotta Add Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-stone-900 tracking-tight flex items-center gap-2.5" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span data-i18n-de="VIP Kundenstamm Übersichtsleiste" data-i18n-en="VIP Customers Directory">VIP Customers Directory</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie exklusive Kundenprofile, VIP-Tiers und Bestellhistorie." data-i18n-en="Manage exclusive customer profiles, VIP tiers and order history.">Manage exclusive customer profiles, VIP tiers and order history.</p>
            </div>
            
            <a href="{{ route('admin.customers.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="VIP Kunde Hinzufügen" data-i18n-en="Add VIP Customer">Add VIP Customer</span>
            </a>
        </div>

        <!-- Table Filters & Controls Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-700">
                
                <!-- Tier Filter & Search Form -->
                <form action="{{ route('admin.customers') }}" method="GET" class="flex flex-wrap items-center gap-2.5 w-full sm:flex-1 sm:max-w-xl">
                    <select name="vip_tier" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-800 outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="" data-i18n-de="Alle VIP Tiers" data-i18n-en="All VIP Tiers">All VIP Tiers</option>
                        <option value="platinum" {{ request('vip_tier') === 'platinum' ? 'selected' : '' }}>Platinum VIP</option>
                        <option value="gold" {{ request('vip_tier') === 'gold' ? 'selected' : '' }}>Gold VIP</option>
                        <option value="silver" {{ request('vip_tier') === 'silver' ? 'selected' : '' }}>Silver VIP</option>
                        <option value="regular" {{ request('vip_tier') === 'regular' ? 'selected' : '' }}>Standard</option>
                    </select>

                    <div class="relative flex-1 min-w-[200px]">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search customer by name, email or city..."
                            data-i18n-placeholder-de="Kunde nach Name, E-Mail oder Stadt suchen..."
                            data-i18n-placeholder-en="Search customer by name, email or city..."
                            class="h-10 w-full pl-10 pr-4 rounded-xl border border-stone-200 bg-white text-xs font-medium text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs placeholder:text-stone-400"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search') || request('vip_tier'))
                        <a href="{{ route('admin.customers') }}" class="btn-exec-secondary px-3.5 py-2 rounded-xl text-xs transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-stone-600 font-bold" data-i18n-de="Zeige" data-i18n-en="Show">Show</span>
                    <select class="h-9 px-3 rounded-xl border border-stone-200 bg-white text-stone-900 font-semibold outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-stone-600 font-bold" data-i18n-de="Einträge" data-i18n-en="entries">entries</span>
                </div>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-4 px-6 font-black" data-i18n-de="Kunde" data-i18n-en="Customer">Customer</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="VIP Status" data-i18n-en="VIP Tier">VIP Tier</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Stadt / Land" data-i18n-en="Location">Location</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Bestellungen" data-i18n-en="Orders">Orders</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Gesamtumsatz" data-i18n-en="Total Spent">Total Spent</th>
                        <th class="py-4 px-6 font-black text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($customers as $customer)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80">
                            <!-- Customer Details -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-xl bg-stone-900 text-white flex items-center justify-center font-bold text-xs shadow-2xs">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <span class="font-extrabold text-stone-900 text-sm tracking-tight block">
                                            {{ $customer->name }}
                                        </span>
                                        <span class="text-[0.68rem] text-stone-400">{{ $customer->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- VIP Tier Badge -->
                            <td class="py-4 px-6">
                                @if($customer->vip_tier === 'platinum')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-stone-900 text-amber-300 border border-amber-400/40 shadow-2xs">
                                        <span>👑</span> Platinum VIP
                                    </span>
                                @elseif($customer->vip_tier === 'gold')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                                        <span>⭐</span> Gold VIP
                                    </span>
                                @elseif($customer->vip_tier === 'silver')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-stone-100 text-stone-700 border border-stone-200">
                                        <span>✨</span> Silver VIP
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-stone-100 text-stone-600">
                                        Standard
                                    </span>
                                @endif
                            </td>

                            <!-- Location -->
                            <td class="py-4 px-6 text-stone-600 font-medium">
                                <div>{{ $customer->city ?? 'N/A' }}</div>
                                <div class="text-[0.68rem] text-stone-400">{{ $customer->country ?? 'DE' }}</div>
                            </td>

                            <!-- Orders Count -->
                            <td class="py-4 px-6 font-bold text-stone-900">
                                {{ $customer->total_orders ?? 0 }} <span class="text-stone-400 font-normal" data-i18n-de="Bestellungen" data-i18n-en="Orders">Orders</span>
                            </td>

                            <!-- Total Spent -->
                            <td class="py-4 px-6 font-extrabold text-saltora-terracotta text-sm">
                                €{{ number_format($customer->total_spent ?? 0, 2) }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.customers.edit', $customer->id) }}"
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCustomer({{ $customer->id }}, '{{ addslashes($customer->name) }}')"
                                        class="btn-exec-danger rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
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
                            <td colspan="6" class="py-12 px-6 text-center text-stone-500 text-xs">
                                <p class="text-base font-bold text-stone-700 mb-1" data-i18n-de="Keine Kunden gefunden" data-i18n-en="No customers found">No customers found</p>
                                <p data-i18n-de="Erstellen Sie Ihr erstes VIP-Kundenprofil über den Button oben." data-i18n-en="Create your first VIP customer profile using the button above.">Create your first VIP customer profile using the button above.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
    function confirmDeleteCustomer(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Customer?' : 'Kunde löschen?',
            text: isEn 
                ? `Are you sure you want to delete "${name}"?` 
                : `Möchten Sie "${name}" wirklich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-customer-form-' + id).submit();
            }
        });
    }
</script>
@endsection
