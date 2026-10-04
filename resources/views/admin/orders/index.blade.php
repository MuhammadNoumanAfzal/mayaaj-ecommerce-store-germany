@extends('layouts.admin')
@section('title', 'Orders & Prepayments - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Bulk Orders & Prepayments">Bulk Orders & Prepayments</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamt Bestellungen:" data-i18n-en="Total Orders:">Total Orders:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ count($orders) }}</span>
        </div>
    </div>

    <!-- Main Orders Executive Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-xs overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Clean White Card Header -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span data-i18n-de="Bestellungen & Vorkasse-Prüfung" data-i18n-en="Orders & Invoices Overview">Orders & Invoices Overview</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Kundenbestellungen, Vorkasse-Überweisungen und Rechnungsdruck." data-i18n-en="Manage customer orders, bank prepayments and invoice printing.">Manage customer orders, bank prepayments and invoice printing.</p>
            </div>
        </div>

        <!-- Table Filters & Controls Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80 space-y-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-700">
                
                <!-- Filters & Search Form -->
                <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-wrap items-center gap-2.5 w-full lg:flex-1 lg:max-w-2xl">
                    <!-- Search Input -->
                    <div class="relative flex-1 min-w-[220px]">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search Order #, customer or email..."
                            data-i18n-placeholder-de="Bestell-Nr, Kunde oder E-Mail suchen..."
                            data-i18n-placeholder-en="Search Order #, customer or email..."
                            class="h-10 w-full pl-10 pr-4 rounded-xl border border-stone-200 bg-white text-xs font-medium text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs placeholder:text-stone-400"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    <!-- Payment Method Filter -->
                    <select name="payment_method" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="" data-i18n-de="Alle Zahlungsarten" data-i18n-en="All Payment Methods">All Payment Methods</option>
                        <option value="vorkasse" {{ request('payment_method') === 'vorkasse' ? 'selected' : '' }}>Vorkasse (Bank Transfer)</option>
                        <option value="credit_card" {{ request('payment_method') === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="paypal" {{ request('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                    </select>

                    <!-- Order Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="" data-i18n-de="Status: Alle" data-i18n-en="Status: All">Status: All</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }} data-i18n-de="Ausstehend" data-i18n-en="Pending">Pending</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }} data-i18n-de="In Bearbeitung" data-i18n-en="Processing">Processing</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }} data-i18n-de="Versendet" data-i18n-en="Shipped">Shipped</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }} data-i18n-de="Zugestellt" data-i18n-en="Delivered">Delivered</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }} data-i18n-de="Storniert" data-i18n-en="Cancelled">Cancelled</option>
                    </select>

                    @if(request('search') || request('payment_method') || request('status'))
                        <a href="{{ route('admin.orders') }}" class="btn-exec-secondary px-3.5 py-2 rounded-xl text-xs transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
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
                        <th class="py-4 px-5 font-black" data-i18n-de="BESTELLUNG #" data-i18n-en="ORDER #">ORDER #</th>
                        <th class="py-4 px-5 font-black" data-i18n-de="KUNDE" data-i18n-en="CUSTOMER">CUSTOMER</th>
                        <th class="py-4 px-5 font-black" data-i18n-de="DATUM" data-i18n-en="DATE">DATE</th>
                        <th class="py-4 px-5 font-black" data-i18n-de="BETRAG" data-i18n-en="TOTAL">TOTAL</th>
                        <th class="py-4 px-5 font-black" data-i18n-de="STATUS" data-i18n-en="STATUS">STATUS</th>
                        <th class="py-4 px-5 font-black" data-i18n-de="ZAHLUNG" data-i18n-en="PAYMENT">PAYMENT</th>
                        <th class="py-4 px-5 font-black text-center" data-i18n-de="AKTIONEN" data-i18n-en="ACTIONS">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($orders as $order)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80">
                            <!-- Order Number -->
                            <td class="py-4 px-5">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="font-extrabold text-saltora-terracotta hover:underline text-sm font-mono block">
                                    {{ $order->order_number }}
                                </a>
                                <span class="text-[0.65rem] text-stone-400 font-bold uppercase tracking-wider">
                                    {{ $order->payment_method === 'vorkasse' ? 'Bank Wire / Vorkasse' : ucfirst($order->payment_method ?? 'Direct') }}
                                </span>
                            </td>

                            <!-- Customer Info -->
                            <td class="py-4 px-5">
                                <div class="font-bold text-stone-900">{{ $order->customer_name }}</div>
                                <div class="text-[0.68rem] text-stone-400">{{ $order->customer_email }}</div>
                                <div class="text-[0.65rem] text-stone-500 font-semibold">{{ $order->city ? $order->city . ', ' : '' }}{{ $order->country ?? 'DE' }}</div>
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-5 text-stone-600 font-medium whitespace-nowrap">
                                <div>{{ $order->created_at->format('d.m.Y') }}</div>
                                <div class="text-[0.68rem] text-stone-400">{{ $order->created_at->format('H:i') }} Uhr</div>
                            </td>

                            <!-- Total -->
                            <td class="py-4 px-5 font-extrabold text-stone-900 text-sm whitespace-nowrap">
                                €{{ number_format($order->total_amount, 2) }}
                            </td>

                            <!-- Order Status Badge -->
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($order->status === 'delivered')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Zugestellt" data-i18n-en="Delivered">Delivered</span>
                                    </span>
                                @elseif($order->status === 'shipped')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-sky-600"></span>
                                        <span data-i18n-de="Versendet" data-i18n-en="Shipped">Shipped</span>
                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                        <span data-i18n-de="In Bearbeitung" data-i18n-en="Processing">Processing</span>
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                        <span data-i18n-de="Storniert" data-i18n-en="Cancelled">Cancelled</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-stone-100 text-stone-700 border border-stone-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span>
                                        <span data-i18n-de="Ausstehend" data-i18n-en="Pending">Pending</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Payment Status Badge -->
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($order->payment_status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[0.65rem] font-extrabold uppercase">
                                        <svg class="h-3 w-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        <span data-i18n-de="Bezahlt" data-i18n-en="Paid">Paid</span>
                                    </span>
                                @elseif($order->payment_status === 'refunded')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-stone-100 text-stone-700 border border-stone-200 text-[0.65rem] font-extrabold uppercase">
                                        <span data-i18n-de="Erstattet" data-i18n-en="Refunded">Refunded</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[0.65rem] font-extrabold uppercase">
                                        <span data-i18n-de="Offen" data-i18n-en="Unpaid">Unpaid</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- View / Invoice Button -->
                                    <a 
                                        href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Rechnung" data-i18n-en="Invoice">Invoice</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteOrder({{ $order->id }}, '{{ addslashes($order->order_number) }}')"
                                        class="btn-exec-danger rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
                                    </button>

                                    <form id="delete-order-form-{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-stone-500 text-xs">
                                <p class="text-base font-bold text-stone-700 mb-1" data-i18n-de="Keine Bestellungen gefunden" data-i18n-en="No orders found">No orders found</p>
                                <p data-i18n-de="Es liegen derzeit keine Bestellungen oder Vorkasse-Eingänge vor." data-i18n-en="There are currently no orders or prepayments recorded.">There are currently no orders or prepayments recorded.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
    function confirmDeleteOrder(id, orderNumber) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Order?' : 'Bestellung löschen?',
            text: isEn ? `Are you sure you want to delete order "${orderNumber}"?` : `Möchten Sie die Bestellung "${orderNumber}" wirklich unwiderruflich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete Order' : 'Ja, Bestellung löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-order-form-' + id).submit();
            }
        });
    }
</script>
@endsection
