@extends('layouts.admin')
@section('title', 'Bestellungen & Vorkasse - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3.5 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-normal" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">Bestellungen & Vorkasse</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium flex items-center gap-1.5">
            <span data-i18n-de="Gesamt Bestellungen:" data-i18n-en="Total Orders:">Gesamt Bestellungen:</span> 
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/60">{{ count($orders) }}</span>
        </div>
    </div>

    <!-- Main Orders Card -->
    <div class="exec-card rounded-2xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
        
        <!-- Clean White Card Header -->
        <div class="px-6 py-4.5 bg-white border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-base text-slate-900 tracking-tight flex items-center gap-2" data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Orders & Prepayments">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Bestellungen & Vorkasse
                </h2>
                <p class="text-xs text-slate-500 font-normal mt-0.5" data-i18n-de="Verwalten Sie Kundenbestellungen, Vorkasse-Überweisungen und Rechnungen." data-i18n-en="Manage customer orders, bank prepayments and invoices.">Verwalten Sie Kundenbestellungen, Vorkasse-Überweisungen und Rechnungen.</p>
            </div>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2 w-full lg:w-auto">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-indigo-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Filters & Search Form -->
                <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full lg:w-auto">
                    <!-- Payment Method Filter -->
                    <select name="payment_method" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle Zahlungsarten" data-i18n-en="All Payment Methods">Alle Zahlungsarten</option>
                        <option value="vorkasse" {{ request('payment_method') === 'vorkasse' ? 'selected' : '' }}>Vorkasse (Überweisung)</option>
                        <option value="credit_card" {{ request('payment_method') === 'credit_card' ? 'selected' : '' }}>Kreditkarte</option>
                        <option value="paypal" {{ request('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                    </select>

                    <!-- Order Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle Bestellstatus" data-i18n-en="All Order Statuses">Alle Bestellstatus</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Ausstehend (Offen)</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>In Bearbeitung</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Versendet</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Zugestellt</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Storniert</option>
                    </select>

                    <!-- Search Input -->
                    <span data-i18n-de="Suche:" data-i18n-en="Search:">Suche:</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Bestell-Nr, Kunde, E-Mail..."
                        data-i18n-placeholder-de="Bestell-Nr, Kunde, E-Mail..."
                        data-i18n-placeholder-en="Order #, customer, email..."
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-indigo-500 w-full sm:w-48 shadow-2xs"
                    >
                    @if(request('search') || request('payment_method') || request('status'))
                        <a href="{{ route('admin.orders') }}" class="text-xs text-rose-500 hover:underline" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-200/80 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="exec-table-head bg-slate-50/90 text-slate-700 font-bold border-b border-slate-200 text-xs">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Bestell-Nr. & Datum" data-i18n-en="Order # & Date">Bestell-Nr. & Datum</th>
                            <th class="p-3.5" data-i18n-de="Kunde & Lieferadresse" data-i18n-en="Customer & Address">Kunde & Lieferadresse</th>
                            <th class="p-3.5" data-i18n-de="Zahlungsart" data-i18n-en="Payment Method">Zahlungsart</th>
                            <th class="p-3.5" data-i18n-de="Zahlungsstatus" data-i18n-en="Payment Status">Zahlungsstatus</th>
                            <th class="p-3.5" data-i18n-de="Gesamtsumme (€)" data-i18n-en="Total Amount (€)">Gesamtsumme (€)</th>
                            <th class="p-3.5" data-i18n-de="Bestellstatus" data-i18n-en="Order Status">Bestellstatus</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($orders as $order)
                            <tr class="exec-table-row hover:bg-slate-50/80 transition">
                                <td class="p-3.5">
                                    <p class="font-bold text-slate-900 text-sm font-mono">{{ $order->order_number }}</p>
                                    <p class="text-[0.68rem] text-slate-400 font-mono">{{ $order->created_at->format('d.m.Y H:i') }} Uhr</p>
                                </td>
                                <td class="p-3.5">
                                    <p class="font-bold text-slate-900 text-xs">{{ $order->customer_name }}</p>
                                    <p class="text-[0.68rem] text-slate-500">{{ $order->customer_email }}</p>
                                    <p class="text-[0.65rem] text-slate-400 truncate max-w-xs">{{ $order->shipping_address }}, {{ $order->postal_code }} {{ $order->city }}</p>
                                </td>
                                <td class="p-3.5">
                                    @if($order->payment_method === 'vorkasse')
                                        <span class="badge-soft-amber px-2.5 py-1 text-[0.65rem] font-bold rounded-lg uppercase">
                                            🏦 Vorkasse
                                        </span>
                                    @elseif($order->payment_method === 'credit_card')
                                        <span class="badge-soft-indigo px-2.5 py-1 text-[0.65rem] font-bold rounded-lg uppercase">
                                            💳 Kreditkarte
                                        </span>
                                    @else
                                        <span class="badge-soft-indigo px-2.5 py-1 text-[0.65rem] font-bold rounded-lg uppercase">
                                            🅿️ PayPal
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($order->payment_status === 'paid')
                                        <span class="badge-soft-emerald px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Bezahlt ✓</span>
                                    @elseif($order->payment_status === 'pending')
                                        <span class="badge-soft-amber px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Offen (Vorkasse)</span>
                                    @else
                                        <span class="badge-soft-rose px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Erstattet</span>
                                    @endif
                                </td>
                                <td class="p-3.5 font-bold text-slate-900 text-sm">
                                    €{{ number_format($order->total_amount, 2, ',', '.') }}
                                </td>
                                <td class="p-3.5">
                                    @if($order->status === 'delivered')
                                        <span class="badge-soft-emerald px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Zugestellt</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="badge-soft-indigo px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Versendet</span>
                                    @elseif($order->status === 'processing')
                                        <span class="badge-soft-indigo px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">In Bearbeitung</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge-soft-rose px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Storniert</span>
                                    @else
                                        <span class="badge-soft-amber px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase">Offen</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View / Invoice Button -->
                                        <a 
                                            href="{{ route('admin.orders.show', $order->id) }}"
                                            class="rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Rechnung / Details"
                                            data-i18n-en="Invoice / Details"
                                        >
                                            Rechnung / Details
                                        </a>

                                        <!-- Delete Button matching Screenshot 3 -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteOrder({{ $order->id }}, '{{ addslashes($order->order_number) }}')"
                                            class="rounded-full text-white px-3 py-1.5 text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1"
                                            style="background-color: #dc2626 !important; color: #ffffff !important;"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Delete
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
                                <td colspan="7" class="p-8 text-center text-slate-400 text-xs">
                                    <p class="text-base font-bold text-slate-600 mb-1" data-i18n-de="Keine Bestellungen gefunden" data-i18n-en="No orders found">Keine Bestellungen gefunden</p>
                                    <p data-i18n-de="Es liegen derzeit keine Bestellungen oder Vorkasse-Eingänge vor." data-i18n-en="There are currently no orders or prepayments.">Es liegen derzeit keine Bestellungen oder Vorkasse-Eingänge vor.</p>
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
