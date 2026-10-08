@extends('layouts.admin')
@section('title', 'Order ' . $order->order_number . ' - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Top Card Header -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-md overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Header -->
        <div class="px-6 py-4.5 flex flex-wrap items-center justify-between gap-3 border-b border-stone-200 bg-white">
            <div>
                <h2 class="font-extrabold text-base text-stone-900 tracking-wide flex items-center gap-2">
                    <span data-i18n-de="Bestellung & Rechnung" data-i18n-en="Order & Invoice">Order & Invoice</span>
                    <span class="font-mono text-saltora-terracotta font-black">#{{ $order->order_number }}</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium" data-i18n-de="Detaillierte Übersicht, Status-Workflow und druckbare Rechnung." data-i18n-en="Detailed overview, status workflow and printable invoice.">Detailed overview, status workflow and printable invoice.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer" title="Open official A4 Tax Invoice with Company Logo">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span data-i18n-de="Rechnung (PDF/Druck)" data-i18n-en="Print Invoice">Print Invoice</span>
                </a>

                <a href="{{ route('admin.orders.packing-slip', $order->id) }}" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" title="Open warehouse dispatch note / packing slip">
                    <svg class="h-3.5 w-3.5 text-stone-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    <span data-i18n-de="Lieferschein" data-i18n-en="Packing Slip">Packing Slip</span>
                </a>

                <a href="{{ route('admin.orders') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back to Orders">Back to Orders</span>
                </a>
            </div>
        </div>

        <!-- Status Workflow Control Form -->
        <div class="p-6 bg-stone-50/60 border-b border-stone-200">
            <h3 class="font-bold text-stone-900 text-sm mb-3" data-i18n-de="Bestellstatus & Zahlungs-Workflow" data-i18n-en="Order & Payment Status Workflow">Order & Payment Status Workflow</h3>
            
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-stone-700 mb-1" data-i18n-de="Bestellstatus" data-i18n-en="Order Status">Order Status</label>
                    <select name="status" class="w-full h-10 rounded-xl border border-stone-200 bg-white px-3 text-stone-900 font-semibold outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }} data-i18n-de="Offen / Ausstehend" data-i18n-en="Pending">Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }} data-i18n-de="In Bearbeitung" data-i18n-en="Processing">Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }} data-i18n-de="Versendet" data-i18n-en="Shipped">Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }} data-i18n-de="Zugestellt" data-i18n-en="Delivered">Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }} data-i18n-de="Storniert" data-i18n-en="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-stone-700 mb-1" data-i18n-de="Zahlungsstatus" data-i18n-en="Payment Status">Payment Status</label>
                    <select name="payment_status" class="w-full h-10 rounded-xl border border-stone-200 bg-white px-3 text-stone-900 font-semibold outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }} data-i18n-de="Offen (Warte auf Vorkasse)" data-i18n-en="Unpaid (Awaiting payment)">Unpaid (Awaiting payment)</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }} data-i18n-de="Bezahlt (Zahlung bestätigt)" data-i18n-en="Paid (Payment verified)">Paid (Payment verified)</option>
                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }} data-i18n-de="Storniert / Erstattet" data-i18n-en="Refunded">Refunded</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full h-10 rounded-xl btn-exec-primary text-white font-bold text-xs uppercase tracking-wider shadow-md transition cursor-pointer flex items-center justify-center gap-1.5">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span data-i18n-de="Status Aktualisieren" data-i18n-en="Update Status">Update Status</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Printable Invoice Area -->
        <div id="printable-invoice" class="p-8 sm:p-10 space-y-8 bg-white text-stone-800">
            
            <!-- Invoice Header: MEHAAJ Logo & Company Info -->
            <div class="flex flex-col sm:flex-row justify-between items-start border-b border-stone-200 pb-6 gap-6">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-saltora-terracotta to-amber-600 p-0.5 shadow-md shadow-saltora-terracotta/20">
                            <div class="w-full h-full bg-white rounded-[9px] flex items-center justify-center font-bold text-xs text-saltora-terracotta">
                                <img src="/logo.png" alt="MEHAAJ Logo" class="w-6 h-6 object-contain" onerror="this.remove();">
                            </div>
                        </div>
                        <div>
                            <h1 class="font-serif font-bold text-stone-900 text-xl tracking-wider uppercase">MEHAAJ LUXURY ATELIER</h1>
                            <p class="text-[0.65rem] text-saltora-terracotta font-bold uppercase tracking-wider">MANUFAKTUR & ATELIER E-COMMERCE</p>
                        </div>
                    </div>
                    <p class="text-xs text-stone-500 mt-3 font-medium">
                        MEHAAJ E-Commerce GmbH<br>
                        Kurfürstendamm 182, D-10707 Berlin<br>
                        USt-IdNr.: DE 391 048 291 | HRB 88201 B
                    </p>
                </div>

                <!-- Invoice Meta Box -->
                <div class="bg-stone-50 p-4 rounded-xl border border-stone-200 text-right text-xs space-y-1 w-full sm:w-auto shadow-2xs">
                    <p class="font-bold text-stone-900 text-sm" data-i18n-de="RECHNUNG" data-i18n-en="INVOICE">INVOICE</p>
                    <p><span class="text-stone-500" data-i18n-de="Rechnungs-Nr.:" data-i18n-en="Invoice Ref:">Invoice Ref:</span> <strong class="font-mono text-saltora-terracotta">{{ $order->order_number }}</strong></p>
                    <p><span class="text-stone-500" data-i18n-de="Datum:" data-i18n-en="Date:">Date:</span> <strong>{{ $order->created_at->format('d.m.Y') }}</strong></p>
                    <p><span class="text-stone-500" data-i18n-de="Zahlungsart:" data-i18n-en="Payment Method:">Payment Method:</span> <strong class="uppercase text-saltora-terracotta">{{ $order->payment_method }}</strong></p>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                <div class="bg-stone-50/70 p-4 rounded-xl border border-stone-200 space-y-1">
                    <p class="font-bold text-stone-400 uppercase text-[0.68rem] tracking-wider mb-1" data-i18n-de="Rechnungsempfänger & Lieferadresse" data-i18n-en="Bill To & Shipping Address">Bill To & Shipping Address</p>
                    <p class="font-bold text-stone-900 text-sm">{{ $order->customer_name }}</p>
                    <p class="text-stone-700">{{ $order->shipping_address }}</p>
                    <p class="text-stone-700">{{ $order->postal_code }} {{ $order->city }}, {{ $order->country }}</p>
                    <p class="text-stone-500 pt-1">E-Mail: {{ $order->customer_email }}</p>
                    @if($order->customer_phone)
                        <p class="text-stone-500">Tel: {{ $order->customer_phone }}</p>
                    @endif
                </div>

                <!-- Bank Prepayment Information (Vorkasse) -->
                <div class="bg-saltora-blush-light p-4 rounded-xl border border-saltora-terracotta/20 text-xs space-y-1">
                    <p class="font-bold text-saltora-terracotta uppercase text-[0.68rem] tracking-wider mb-1" data-i18n-de="Vorkasse Bankverbindung (MEHAAJ Atelier)" data-i18n-en="Bank Transfer Details (MEHAAJ Atelier)">Bank Transfer Details (MEHAAJ Atelier)</p>
                    <p><span class="text-stone-600" data-i18n-de="Empfänger:" data-i18n-en="Beneficiary:">Beneficiary:</span> <strong>MEHAAJ E-Commerce GmbH</strong></p>
                    <p><span class="text-stone-600" data-i18n-de="Bank:" data-i18n-en="Bank:">Bank:</span> <strong>Commerzbank Berlin</strong></p>
                    <p><span class="text-stone-600">IBAN:</span> <strong class="font-mono text-saltora-terracotta">DE89 3704 0044 0532 0130 00</strong></p>
                    <p><span class="text-stone-600">BIC:</span> <strong class="font-mono">COBADEFFXXX</strong></p>
                    <p><span class="text-stone-600" data-i18n-de="Verwendungszweck:" data-i18n-en="Reference:">Reference:</span> <strong class="font-mono bg-amber-100 text-amber-900 px-1 py-0.5 rounded">{{ $order->order_number }}</strong></p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto border border-stone-200 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="bg-stone-50 text-stone-700 font-bold border-b border-stone-200">
                        <tr>
                            <th class="p-3" data-i18n-de="Position / Artikel" data-i18n-en="Item / Product">Item / Product</th>
                            <th class="p-3 text-right" data-i18n-de="Einzelpreis (€)" data-i18n-en="Unit Price (€)">Unit Price (€)</th>
                            <th class="p-3 text-center" data-i18n-de="Menge" data-i18n-en="Qty">Qty</th>
                            <th class="p-3 text-right" data-i18n-de="Gesamt (€)" data-i18n-en="Subtotal (€)">Subtotal (€)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="p-3">
                                    <p class="font-bold text-stone-900">{{ $item->product_name }}</p>
                                    @if($item->product && $item->product->sku)
                                        <p class="text-[0.68rem] text-stone-400 font-mono">SKU: {{ $item->product->sku }}</p>
                                    @endif
                                </td>
                                <td class="p-3 text-right font-medium">€{{ number_format($item->unit_price, 2) }}</td>
                                <td class="p-3 text-center font-bold">{{ $item->quantity }}</td>
                                <td class="p-3 text-right font-bold text-stone-900">€{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Invoice Totals Calculation -->
            @php
                $netAmount = $order->total_amount / 1.19;
                $vatAmount = $order->total_amount - $netAmount;
            @endphp
            <div class="flex justify-end pt-2">
                <div class="w-full sm:w-72 bg-stone-50 p-4 rounded-xl border border-stone-200 space-y-2 text-xs">
                    <div class="flex justify-between text-stone-600">
                        <span data-i18n-de="Nettobetrag:" data-i18n-en="Net Amount:">Net Amount:</span>
                        <span>€{{ number_format($netAmount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-stone-600">
                        <span data-i18n-de="Inkl. 19% MwSt.:" data-i18n-en="Incl. 19% VAT:">Incl. 19% VAT:</span>
                        <span>€{{ number_format($vatAmount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-stone-600">
                        <span data-i18n-de="Versandkosten:" data-i18n-en="Shipping Cost:">Shipping Cost:</span>
                        <span class="text-emerald-700 font-bold" data-i18n-de="Kostenfrei" data-i18n-en="Free">Free</span>
                    </div>
                    <div class="border-t border-stone-300 pt-2 flex justify-between text-sm font-extrabold text-stone-900">
                        <span data-i18n-de="Gesamtbetrag (€):" data-i18n-en="Total Amount (€):">Total Amount (€):</span>
                        <span class="text-saltora-terracotta">€{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-stone-200 pt-6 text-[0.68rem] text-stone-500 leading-relaxed text-center sm:text-left space-y-1">
                <p data-i18n-de="Vielen Dank für Ihren Einkauf bei MEHAAJ Luxury Atelier. Bei Fragen wenden Sie sich gerne an service@mehaaj.de." data-i18n-en="Thank you for shopping at MEHAAJ Luxury Atelier. For questions contact service@mehaaj.de.">Thank you for shopping at MEHAAJ Luxury Atelier. For questions contact service@mehaaj.de.</p>
                <p data-i18n-de="Es gelten unsere Allgemeinen Geschäftsbedingungen (AGB). Erfüllungsort und Gerichtsstand ist Berlin." data-i18n-en="Our Terms and Conditions apply. Place of performance and jurisdiction is Berlin.">Our Terms and Conditions apply. Place of performance and jurisdiction is Berlin.</p>
            </div>

        </div>

    </div>

</div>

<!-- Print Styles -->
<style>
    @media print {
        body { background-color: #ffffff !important; }
        header, aside, footer, button, a, .border-b.border-stone-200.bg-stone-50\/60 { display: none !important; }
        .flex-1 { margin-left: 0 !important; padding: 0 !important; }
        #printable-invoice { padding: 0 !important; border: none !important; }
    }
</style>
@endsection
