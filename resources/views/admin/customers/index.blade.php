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
                                    @php
                                        $custModalData = [
                                            'id' => $customer->id,
                                            'name' => $customer->name,
                                            'email' => $customer->email,
                                            'phone' => $customer->phone ?? '',
                                            'address' => $customer->address ?? '',
                                            'city' => $customer->city ?? '',
                                            'postal_code' => $customer->postal_code ?? '',
                                            'country' => $customer->country ?? 'DE',
                                            'vip_tier' => $customer->vip_tier ?? 'standard',
                                            'total_spent' => (float)($customer->total_spent ?? 0),
                                            'total_orders' => (int)($customer->total_orders ?? 0),
                                            'status' => $customer->status ?? 'active',
                                            'created_at' => $customer->created_at ? $customer->created_at->format('M d, Y') : 'N/A',
                                            'edit_url' => route('admin.customers.edit', $customer->id),
                                        ];
                                    @endphp

                                    <!-- View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewCustomerModal(@json($custModalData))'
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Customer Profile"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

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

<!-- Customer Quick View Executive Modal -->
<div id="view-customer-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop-luxury hidden transition-all duration-300" onclick="closeViewCustomerModal()">
    <div class="relative w-full max-w-lg bg-white rounded-2xl border border-stone-200/90 shadow-2xl overflow-hidden border-t-4 border-t-saltora-terracotta" onclick="event.stopPropagation()">
        
        <!-- Modal Top Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-sm shadow-2xs border border-saltora-terracotta/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-stone-900 text-sm tracking-tight" data-i18n-de="Kunden-Profil" data-i18n-en="Client Profile">Client Profile</h3>
                    <p class="text-[0.68rem] text-stone-400 font-mono" id="cust-view-id">ID: #0</p>
                </div>
            </div>
            <button type="button" onclick="closeViewCustomerModal()" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 text-xs max-h-[75vh] modal-scroll-clean">
            
            <!-- Customer Avatar & VIP Tier Banner -->
            <div class="flex items-center gap-4 p-4 rounded-xl bg-stone-50/70 border border-stone-200/70">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#964B42] to-[#803D35] text-white flex items-center justify-center font-serif font-black text-xl shadow-md shrink-0" id="cust-view-avatar">
                    C
                </div>

                <div class="space-y-1 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="cust-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="cust-view-status-badge"></span>
                    </div>

                    <div class="flex items-center gap-2 pt-0.5">
                        <span id="cust-view-tier-badge"></span>
                        <span class="text-[0.68rem] text-stone-400 font-medium">Joined: <span id="cust-view-joined" class="text-stone-600 font-semibold"></span></span>
                    </div>
                </div>
            </div>

            <!-- Spending & Orders Metrics -->
            <div class="grid grid-cols-3 gap-2.5">
                <div class="p-3 rounded-xl bg-saltora-blush/40 border border-saltora-terracotta/15 text-center">
                    <span class="text-[0.62rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Gesamtumsatz" data-i18n-en="Lifetime Spent">Lifetime Spent</span>
                    <span id="cust-view-total-spent" class="font-extrabold text-sm text-saltora-terracotta mt-0.5 block font-mono">€0.00</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80 text-center">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Bestellungen" data-i18n-en="Total Orders">Total Orders</span>
                    <span id="cust-view-total-orders" class="font-extrabold text-sm text-stone-900 mt-0.5 block font-mono">0</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80 text-center">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Ø Bestellwert" data-i18n-en="Avg Order">Avg Order</span>
                    <span id="cust-view-avg-order" class="font-extrabold text-sm text-stone-900 mt-0.5 block font-mono">€0.00</span>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 space-y-2.5">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-400" data-i18n-de="Kontaktdaten" data-i18n-en="Contact Information">Contact Information</label>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-0.5">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a id="cust-view-email" href="#" class="font-semibold text-stone-800 hover:text-saltora-terracotta transition truncate"></a>
                    </div>

                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a id="cust-view-phone" href="#" class="font-semibold text-stone-800 hover:text-saltora-terracotta transition truncate"></a>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 space-y-1.5">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-400" data-i18n-de="Liefer- / Rechnungsadresse" data-i18n-en="Billing & Shipping Address">Billing & Shipping Address</label>
                <div class="flex items-start gap-2 pt-0.5">
                    <svg class="w-4 h-4 text-stone-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <div id="cust-view-address" class="text-stone-700 font-medium leading-relaxed"></div>
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-end gap-2">
            <button type="button" onclick="closeViewCustomerModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer shadow-2xs" data-i18n-de="Schließen" data-i18n-en="Close">Close</button>
            <a id="cust-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs">
                <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span data-i18n-de="Bearbeiten" data-i18n-en="Edit Customer">Edit Customer</span>
            </a>
        </div>

    </div>
</div>

<script>
    function openViewCustomerModal(data) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('cust-view-id').textContent = 'ID: #' + data.id;
        document.getElementById('cust-view-name').textContent = data.name;
        document.getElementById('cust-view-joined').textContent = data.created_at;

        // Avatar letter
        const firstLetter = (data.name || 'C').charAt(0).toUpperCase();
        document.getElementById('cust-view-avatar').textContent = firstLetter;

        // Status badge
        const badgeEl = document.getElementById('cust-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-active';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-draft';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span><span>${isEn ? 'Inactive' : 'Inaktiv'}</span>`;
        }

        // VIP Tier badge
        const tierEl = document.getElementById('cust-view-tier-badge');
        if (data.vip_tier === 'platinum') {
            tierEl.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-black bg-stone-900 text-amber-300 border border-amber-400/40 shadow-xs';
            tierEl.innerHTML = '👑 Platinum VIP';
        } else if (data.vip_tier === 'gold') {
            tierEl.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs';
            tierEl.innerHTML = '⭐ Gold VIP';
        } else if (data.vip_tier === 'silver') {
            tierEl.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-stone-100 text-stone-700 border border-stone-200';
            tierEl.innerHTML = '✨ Silver VIP';
        } else {
            tierEl.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-[0.68rem] font-medium bg-stone-100 text-stone-600';
            tierEl.innerHTML = 'Standard Client';
        }

        // Spending & Orders
        document.getElementById('cust-view-total-spent').textContent = '€' + (data.total_spent || 0).toFixed(2);
        document.getElementById('cust-view-total-orders').textContent = data.total_orders || 0;
        const avg = data.total_orders > 0 ? (data.total_spent / data.total_orders) : 0;
        document.getElementById('cust-view-avg-order').textContent = '€' + avg.toFixed(2);

        // Contact
        const emailEl = document.getElementById('cust-view-email');
        emailEl.textContent = data.email;
        emailEl.href = 'mailto:' + data.email;

        const phoneEl = document.getElementById('cust-view-phone');
        if (data.phone && data.phone.trim()) {
            phoneEl.textContent = data.phone;
            phoneEl.href = 'tel:' + data.phone;
        } else {
            phoneEl.textContent = 'N/A';
            phoneEl.removeAttribute('href');
        }

        // Address
        const addrEl = document.getElementById('cust-view-address');
        const parts = [];
        if (data.address) parts.push(data.address);
        if (data.postal_code || data.city) parts.push(`${data.postal_code || ''} ${data.city || ''}`.trim());
        if (data.country) parts.push(data.country);

        if (parts.length > 0) {
            addrEl.innerHTML = parts.join('<br>');
        } else {
            addrEl.innerHTML = `<span class="italic text-stone-400">${isEn ? 'No address on file.' : 'Keine Adresse hinterlegt.'}</span>`;
        }

        // Edit link
        document.getElementById('cust-view-edit-btn').href = data.edit_url;

        // Show modal
        document.body.classList.add('overflow-hidden');
        document.getElementById('view-customer-modal').classList.remove('hidden');
    }

    function closeViewCustomerModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('view-customer-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewCustomerModal();
        }
    });

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
