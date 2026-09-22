@extends('layouts.admin')
@section('title', 'Bestellungen & Vorkasse - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-slate-400" data-i18n-de="Gesamt Bestellungen:" data-i18n-en="Total Orders:">Gesamt Bestellungen:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-200/60 shadow-2xs">{{ count($orders) }}</span>
        </div>
    </div>

    <!-- Main Orders Executive Card -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Clean White Card Header -->
        <div class="px-6 py-5 bg-white border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight flex items-center gap-2.5" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Bestellungen & Vorkasse-Prüfung
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Kundenbestellungen, Vorkasse-Überweisungen und Rechnungsdruck." data-i18n-en="Manage customer orders, bank prepayments and invoice printing.">Verwalten Sie Kundenbestellungen, Vorkasse-Überweisungen und Rechnungsdruck.</p>
            </div>
        </div>

        <!-- Table Filters & Controls Toolbar -->
        <div class="p-5 sm:p-6 bg-slate-50/60 border-b border-slate-100 space-y-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2 w-full lg:w-auto">
                    <span class="text-slate-500" data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-xl border border-slate-200 bg-white text-slate-800 font-medium outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-slate-500" data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Filters & Search Form -->
                <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full lg:w-auto">
                    <!-- Payment Method Filter -->
                    <select name="payment_method" onchange="this.form.submit()" class="h-9 px-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs">
                        <option value="" data-i18n-de="Alle Zahlungsarten" data-i18n-en="All Payment Methods">Alle Zahlungsarten</option>
                        <option value="vorkasse" {{ request('payment_method') === 'vorkasse' ? 'selected' : '' }}>Vorkasse (Überweisung)</option>
                        <option value="credit_card" {{ request('payment_method') === 'credit_card' ? 'selected' : '' }}>Kreditkarte</option>
                        <option value="paypal" {{ request('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                    </select>

                    <!-- Order Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="h-9 px-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs">
                        <option value="" data-i18n-de="Alle Bestellstatus" data-i18n-en="All Order Statuses">Alle Bestellstatus</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Ausstehend (Offen)</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>In Bearbeitung</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Versendet</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Zugestellt</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Storniert</option>
                    </select>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-48">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Bestell-Nr, Kunde, E-Mail..."
                            data-i18n-placeholder-de="Bestell-Nr, Kunde, E-Mail..."
                            data-i18n-placeholder-en="Order #, customer, email..."
                            class="h-9 w-full pl-9 pr-4 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs placeholder:text-slate-400"
                        >
                        <svg class="h-4 w-4 absolute left-3 top-2.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search') || request('payment_method') || request('status'))
                        <a href="{{ route('admin.orders') }}" class="px-3 py-2 rounded-xl bg-slate-200/70 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-100/70 text-slate-600 font-extrabold uppercase tracking-wider text-[0.68rem] border-b border-slate-200">
                        <th class="py-3.5 px-5" data-i18n-de="Bestell-Nr. & Datum" data-i18n-en="Order # & Date">Bestell-Nr. & Datum</th>
                        <th class="py-3.5 px-5" data-i18n-de="Kunde & Lieferadresse" data-i18n-en="Customer & Address">Kunde & Lieferadresse</th>
                        <th class="py-3.5 px-5" data-i18n-de="Zahlungsart" data-i18n-en="Payment Method">Zahlungsart</th>
                        <th class="py-3.5 px-5" data-i18n-de="Zahlungsstatus" data-i18n-en="Payment Status">Zahlungsstatus</th>
                        <th class="py-3.5 px-5" data-i18n-de="Gesamtsumme (€)" data-i18n-en="Total Amount (€)">Gesamtsumme (€)</th>
                        <th class="py-3.5 px-5" data-i18n-de="Bestellstatus" data-i18n-en="Order Status">Bestellstatus</th>
                        <th class="py-3.5 px-5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-5">
                                <span class="font-extrabold text-slate-900 text-sm font-mono block">
                                    {{ $order->order_number }}
                                </span>
                                <span class="block text-[0.68rem] text-slate-400 font-mono mt-0.5">{{ $order->created_at->format('d.m.Y H:i') }} Uhr</span>
                            </td>
                            <td class="py-4 px-5">
                                <span class="font-bold text-slate-900 text-xs block">{{ $order->customer_name }}</span>
                                <span class="text-[0.68rem] text-slate-500 block">{{ $order->customer_email }}</span>
                                <span class="text-[0.65rem] text-slate-400 truncate max-w-xs block mt-0.5">{{ $order->shipping_address }}, {{ $order->postal_code }} {{ $order->city }}</span>
                            </td>
                            <td class="py-4 px-5">
                                @if($order->payment_method === 'vorkasse')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[0.65rem] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 uppercase">
                                        🏦 Vorkasse
                                    </span>
                                @elseif($order->payment_method === 'credit_card')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[0.65rem] font-bold rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase">
                                        💳 Kreditkarte
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[0.65rem] font-bold rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase">
                                        🅿️ PayPal
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                @if($order->payment_status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[0.65rem] font-extrabold uppercase">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Bezahlt ✓
                                    </span>
                                @elseif($order->payment_status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[0.65rem] font-extrabold uppercase">
                                        Offen (Vorkasse)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[0.65rem] font-extrabold uppercase">
                                        Erstattet
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 font-extrabold text-slate-900 text-sm">
                                €{{ number_format($order->total_amount, 2, ',', '.') }}
                            </td>
                            <td class="py-4 px-5">
                                @if($order->status === 'delivered')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[0.65rem] font-extrabold uppercase">
                                        Zugestellt
                                    </span>
                                @elseif($order->status === 'shipped')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 text-[0.65rem] font-extrabold uppercase">
                                        Versendet
                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 text-[0.65rem] font-extrabold uppercase">
                                        In Bearbeitung
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[0.65rem] font-extrabold uppercase">
                                        Storniert
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[0.65rem] font-extrabold uppercase">
                                        Offen
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- View / Invoice Button -->
                                    <a 
                                        href="{{ route('admin.orders.show', $order->id) }}"
                                        class="rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200/80 px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                        data-i18n-de="Rechnung / Details"
                                        data-i18n-en="Invoice / Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Rechnung" data-i18n-en="Invoice">Rechnung</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteOrder({{ $order->id }}, '{{ addslashes($order->order_number) }}')"
                                        class="rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/80 px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                        data-i18n-de="Löschen"
                                        data-i18n-en="Delete"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Löschen</span>
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
                            <td colspan="7" class="py-12 px-6 text-center text-slate-500 text-xs">
                                <p class="text-base font-bold text-slate-700 mb-1" data-i18n-de="Keine Bestellungen gefunden" data-i18n-en="No orders found">Keine Bestellungen gefunden</p>
                                <p data-i18n-de="Es liegen derzeit keine Bestellungen oder Vorkasse-Eingänge vor." data-i18n-en="There are currently no orders or prepayments.">Es liegen derzeit keine Bestellungen oder Vorkasse-Eingänge vor.</p>
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
        LuxurySwal.fire({
            title: 'Bestellung löschen?',
            text: `Möchten Sie die Bestellung "${orderNumber}" wirklich unwiderruflich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ja, Bestellung löschen',
            cancelButtonText: 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-order-form-' + id).submit();
            }
        });
    }
</script>
@endsection
