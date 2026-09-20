@extends('layouts.admin')
@section('title', 'Bestellung ' . $order->order_number . ' - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Top Card Header matching Screenshot 2 design -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Executive Light Header -->
        <div class="px-6 py-4.5 flex items-center justify-between" style="background-color: #ffffff !important; color: #0f172a !important; border-bottom: 1px solid #e2e8f0 !important;">
            <div>
                <h2 class="font-extrabold text-base text-slate-900 tracking-wide flex items-center gap-2">
                    <span data-i18n-de="Bestellung & Rechnung" data-i18n-en="Order & Invoice">Bestellung & Rechnung</span>
                    <span class="font-mono text-indigo-600 font-black">#{{ $order->order_number }}</span>
                </h2>
                <p class="text-xs text-slate-500 font-medium" data-i18n-de="Detaillierte Übersicht, Status-Workflow und druckbare Rechnung." data-i18n-en="Detailed overview, status workflow and printable invoice.">Detaillierte Übersicht, Status-Workflow und druckbare Rechnung.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #334155 !important; border: 1px solid #e2e8f0 !important;">
                    <svg class="h-3.5 w-3.5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span data-i18n-de="Rechnung Drucken" data-i18n-en="Print Invoice">Rechnung Drucken</span>
                </button>

                <a href="{{ route('admin.orders') }}" class="rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #334155 !important; border: 1px solid #e2e8f0 !important;">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück zu Bestellungen" data-i18n-en="Back to Orders">Zurück zu Bestellungen</span>
                </a>
            </div>
        </div>

        <!-- Status Workflow Control Form -->
        <div class="p-6 bg-slate-50 border-b border-slate-200">
            <h3 class="font-bold text-slate-900 text-sm mb-3" data-i18n-de="Bestellstatus & Zahlungs-Workflow" data-i18n-en="Order & Payment Status Workflow">Bestellstatus & Zahlungs-Workflow</h3>
            
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Bestellstatus" data-i18n-en="Order Status">Bestellstatus</label>
                    <select name="status" class="w-full h-10 rounded-xl border border-slate-200 bg-white px-3 text-slate-900 font-semibold outline-none focus:border-[#194AA2]">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Offen / Ausstehend</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>In Bearbeitung</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Versendet</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Zugestellt</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Storniert</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Zahlungsstatus" data-i18n-en="Payment Status">Zahlungsstatus</label>
                    <select name="payment_status" class="w-full h-10 rounded-xl border border-slate-200 bg-white px-3 text-slate-900 font-semibold outline-none focus:border-[#194AA2]">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Offen (Warte auf Vorkasse)</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Bezahlt (Zahlungseingang bestätigt)</option>
                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Storniert / Erstattet</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full h-10 rounded-xl btn-lime-save text-white font-bold text-xs uppercase tracking-wider shadow-sm transition cursor-pointer flex items-center justify-center gap-1.5" style="background-color: #84cc16 !important; color: #ffffff !important;">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span data-i18n-de="Status Aktualisieren" data-i18n-en="Update Status">Status Aktualisieren</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Printable German Legal Invoice Area -->
        <div id="printable-invoice" class="p-8 sm:p-10 space-y-8 bg-white text-slate-800">
            
            <!-- Invoice Header: MEHAAJ Logo & Company Info -->
            <div class="flex flex-col sm:flex-row justify-between items-start border-b border-slate-200 pb-6 gap-6">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-[#194AA2] text-white flex items-center justify-center font-extrabold text-xl shadow-sm">
                            M
                        </div>
                        <div>
                            <h1 class="font-extrabold text-slate-900 text-xl tracking-tight uppercase">MEHAAJ LUXURY ATELIER</h1>
                            <p class="text-[0.65rem] text-slate-400 font-bold uppercase tracking-wider">MANUFAKTUR & ATELIER E-COMMERCE</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-3 font-medium">
                        MEHAAJ E-Commerce GmbH<br>
                        Kurfürstendamm 182, D-10707 Berlin<br>
                        USt-IdNr.: DE 391 048 291 | HRB 88201 B
                    </p>
                </div>

                <!-- Invoice Meta Box -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-right text-xs space-y-1 w-full sm:w-auto">
                    <p class="font-bold text-slate-900 text-sm" data-i18n-de="RECHNUNG / INVOICE" data-i18n-en="INVOICE">RECHNUNG</p>
                    <p><span class="text-slate-500">Rechnungs-Nr.:</span> <strong class="font-mono text-slate-900">{{ $order->order_number }}</strong></p>
                    <p><span class="text-slate-500">Datum:</span> <strong>{{ $order->created_at->format('d.m.Y') }}</strong></p>
                    <p><span class="text-slate-500">Zahlungsart:</span> <strong class="uppercase text-[#194AA2]">{{ $order->payment_method }}</strong></p>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-200 space-y-1">
                    <p class="font-bold text-slate-900 uppercase text-[0.68rem] tracking-wider text-slate-400 mb-1" data-i18n-de="Rechnungsempfänger & Lieferadresse" data-i18n-en="Bill To & Shipping Address">Rechnungsempfänger & Lieferadresse</p>
                    <p class="font-bold text-slate-900 text-sm">{{ $order->customer_name }}</p>
                    <p class="text-slate-700">{{ $order->shipping_address }}</p>
                    <p class="text-slate-700">{{ $order->postal_code }} {{ $order->city }}, {{ $order->country }}</p>
                    <p class="text-slate-500 pt-1">E-Mail: {{ $order->customer_email }}</p>
                    @if($order->customer_phone)
                        <p class="text-slate-500">Tel: {{ $order->customer_phone }}</p>
                    @endif
                </div>

                <!-- Bank Prepayment Information (Vorkasse) -->
                <div class="bg-blue-50/60 p-4 rounded-xl border border-blue-200 text-xs space-y-1">
                    <p class="font-bold text-[#194AA2] uppercase text-[0.68rem] tracking-wider mb-1" data-i18n-de="Vorkasse Bankverbindung (MEHAAJ Atelier)" data-i18n-en="Prepayment Bank Details (MEHAAJ Atelier)">Vorkasse Bankverbindung (MEHAAJ Atelier)</p>
                    <p><span class="text-slate-600">Empfänger:</span> <strong>MEHAAJ E-Commerce GmbH</strong></p>
                    <p><span class="text-slate-600">Bank:</span> <strong>Commerzbank Berlin</strong></p>
                    <p><span class="text-slate-600">IBAN:</span> <strong class="font-mono text-[#194AA2]">DE89 3704 0044 0532 0130 00</strong></p>
                    <p><span class="text-slate-600">BIC:</span> <strong class="font-mono">COBADEFFXXX</strong></p>
                    <p><span class="text-slate-600">Verwendungszweck:</span> <strong class="font-mono bg-amber-200 px-1 py-0.5 rounded text-slate-900">{{ $order->order_number }}</strong></p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto border border-slate-200 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                        <tr>
                            <th class="p-3">Position / Artikel</th>
                            <th class="p-3 text-right">Einzelpreis (€)</th>
                            <th class="p-3 text-center">Menge</th>
                            <th class="p-3 text-right">Gesamt (€)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="p-3">
                                    <p class="font-bold text-slate-900">{{ $item->product_name }}</p>
                                    @if($item->product && $item->product->sku)
                                        <p class="text-[0.68rem] text-slate-400 font-mono">SKU: {{ $item->product->sku }}</p>
                                    @endif
                                </td>
                                <td class="p-3 text-right font-medium">€{{ number_format($item->unit_price, 2, ',', '.') }}</td>
                                <td class="p-3 text-center font-bold">{{ $item->quantity }}</td>
                                <td class="p-3 text-right font-bold text-slate-900">€{{ number_format($item->subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Invoice Totals Calculation (German 19% MwSt.) -->
            @php
                $netAmount = $order->total_amount / 1.19;
                $vatAmount = $order->total_amount - $netAmount;
            @endphp
            <div class="flex justify-end pt-2">
                <div class="w-full sm:w-72 bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span data-i18n-de="Nettobetrag:" data-i18n-en="Net Amount:">Nettobetrag:</span>
                        <span>€{{ number_format($netAmount, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span data-i18n-de="Inkl. 19% MwSt.:" data-i18n-en="Incl. 19% VAT:">Inkl. 19% MwSt.:</span>
                        <span>€{{ number_format($vatAmount, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span data-i18n-de="Versandkosten:" data-i18n-en="Shipping Cost:">Versandkosten:</span>
                        <span class="text-emerald-700 font-bold" data-i18n-de="Kostenfrei" data-i18n-en="Free">Kostenfrei</span>
                    </div>
                    <div class="border-t border-slate-300 pt-2 flex justify-between text-sm font-extrabold text-slate-900">
                        <span data-i18n-de="Gesamtbetrag (€):" data-i18n-en="Total Amount (€):">Gesamtbetrag (€):</span>
                        <span class="text-[#194AA2]">€{{ number_format($order->total_amount, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- German Legal Footer -->
            <div class="border-t border-slate-200 pt-6 text-[0.68rem] text-slate-500 leading-relaxed text-center sm:text-left space-y-1">
                <p>Vielen Dank für Ihren Einkauf bei MEHAAJ Luxury Atelier. Bei Fragen wenden Sie sich gerne an service@mehaaj.de.</p>
                <p>Es gelten unsere Allgemeinen Geschäftsbedingungen (AGB). Erfüllungsort und Gerichtsstand ist Berlin.</p>
            </div>

        </div>

    </div>

</div>

<!-- Print Styles -->
<style>
    @media print {
        body { background-color: #ffffff !important; }
        header, aside, footer, .card-navy-header button, .card-navy-header a, .p-6.bg-slate-50 { display: none !important; }
        .flex-1 { margin-left: 0 !important; padding: 0 !important; }
        #printable-invoice { padding: 0 !important; border: none !important; }
    }
</style>
@endsection
