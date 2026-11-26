@extends('layouts.admin')
@section('title', 'Order ' . $order->order_number . ' - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-6 max-w-6xl mx-auto pb-12">

    <!-- Top Navigation & Action Bar -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-5 sm:p-6 border-t-4 border-t-saltora-terracotta">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-saltora-terracotta">
                        <span class="h-1.5 w-1.5 rounded-full bg-saltora-terracotta"></span>
                        BESTELLUNG & LOGISTIK
                    </span>
                    <span class="text-xs text-stone-400">• {{ $order->created_at->format('d.m.Y H:i') }} Uhr</span>
                </div>
                <h1 class="font-extrabold text-xl sm:text-2xl text-stone-900 tracking-tight mt-1 flex items-center gap-2.5">
                    <span>Bestellung</span>
                    <span class="font-mono text-saltora-terracotta">#{{ $order->order_number }}</span>
                </h1>
                <p class="text-xs text-stone-500 font-medium mt-0.5">
                    Kunde: <b>{{ $order->customer_name }}</b> ({{ $order->customer_email }})
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer" title="Offizielle A4-Rechnung öffnen">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span>Rechnung (PDF/Druck)</span>
                </a>

                <a href="{{ route('admin.orders.packing-slip', $order->id) }}" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" title="Lieferschein für Packtisch">
                    <svg class="h-4 w-4 text-stone-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    <span>Lieferschein</span>
                </a>

                <a href="{{ route('admin.orders') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span>Zurück</span>
                </a>
            </div>
        </div>

        <!-- Visual Status & Fulfillment Timeline -->
        @php $timelineStep = $order->timeline_step; @endphp
        <div class="mt-8 pt-6 border-t border-stone-100">
            <h3 class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400 mb-5">Auftrags- & Zustell-Fortschritt</h3>
            
            <div class="relative flex items-center justify-between max-w-4xl mx-auto px-4">
                <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-1 bg-stone-100 z-0"></div>
                <div class="absolute left-6 top-1/2 -translate-y-1/2 h-1 bg-saltora-terracotta transition-all duration-500 z-0" style="width: {{ $timelineStep >= 5 ? '92%' : ($timelineStep >= 3 ? '60%' : ($timelineStep >= 2 ? '30%' : '5%')) }};"></div>

                <!-- 1. Placed -->
                <div class="relative z-10 text-center">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-extrabold mx-auto {{ $timelineStep >= 1 ? 'bg-saltora-terracotta text-white shadow-md' : 'bg-stone-200 text-stone-600' }}">
                        ✓
                    </div>
                    <span class="block text-xs font-bold mt-2 text-stone-900">Eingegangen</span>
                    <span class="block text-[0.62rem] text-stone-400">{{ $order->created_at->format('d.m. H:i') }}</span>
                </div>

                <!-- 2. Payment Verified -->
                <div class="relative z-10 text-center">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-extrabold mx-auto {{ $timelineStep >= 2 ? 'bg-saltora-terracotta text-white shadow-md' : 'bg-stone-200 text-stone-600' }}">
                        {{ $timelineStep >= 2 ? '✓' : '2' }}
                    </div>
                    <span class="block text-xs font-bold mt-2 text-stone-900">Zahlung bestätigt</span>
                    <span class="block text-[0.62rem] text-stone-400">
                        @if($order->payment_status === 'paid')
                            Bezahlt (Verifiziert)
                        @elseif($order->payment_method === 'cod')
                            Bar bei Nachnahme
                        @else
                            Warte auf Überweisung
                        @endif
                    </span>
                </div>

                <!-- 3. Dispatched / Shipped -->
                <div class="relative z-10 text-center">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-extrabold mx-auto {{ $timelineStep >= 3 ? 'bg-saltora-terracotta text-white shadow-md' : 'bg-stone-200 text-stone-600' }}">
                        {{ $timelineStep >= 3 ? '✓' : '3' }}
                    </div>
                    <span class="block text-xs font-bold mt-2 text-stone-900">An Kurier übergeben</span>
                    <span class="block text-[0.62rem] text-stone-400">
                        {{ $order->dispatched_at ? $order->dispatched_at->format('d.m. H:i') : ($order->status === 'shipped' ? 'Versendet' : 'Offen') }}
                    </span>
                </div>

                <!-- 4. Delivered -->
                <div class="relative z-10 text-center">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-extrabold mx-auto {{ $timelineStep >= 5 ? 'bg-emerald-600 text-white shadow-md' : 'bg-stone-200 text-stone-600' }}">
                        {{ $timelineStep >= 5 ? '✓' : '4' }}
                    </div>
                    <span class="block text-xs font-bold mt-2 text-stone-900">Zugestellt</span>
                    <span class="block text-[0.62rem] text-stone-400">
                        {{ $order->delivered_at ? $order->delivered_at->format('d.m. H:i') : 'Ausstehend' }}
                    </span>
                </div>

            </div>
        </div>

    </div>

    <!-- Logistics & Payment Actions Grid (2 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- 1. Fulfillment & Courier Dispatch Panel (7 Cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            
            <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center">
                        🚚
                    </div>
                    <div>
                        <h2 class="font-extrabold text-sm text-stone-900">Versand & Kurier-Tracking (Fulfillment)</h2>
                        <p class="text-[0.68rem] text-stone-400">Paketdaten erfassen, automatischen Trackinglink erzeugen & Kunden benachrichtigen</p>
                    </div>
                </div>

                @if($order->tracking_number)
                    <span class="rounded-full bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-0.5 text-[0.62rem] font-bold">
                        Tracking aktiv
                    </span>
                @endif
            </div>

            <form action="{{ route('admin.orders.fulfillment', $order->id) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-stone-700 mb-1">Kurier / Versanddienstleister *</label>
                        <select name="courier_name" id="carrier-select" onchange="previewTrackingLink()" class="w-full rounded-xl border border-stone-200 bg-stone-50/50 py-2 px-3 text-stone-900 font-semibold focus:border-saltora-terracotta focus:bg-white focus:outline-none transition shadow-2xs">
                            <option value="DHL Express" {{ str_contains(strtolower($order->courier_name ?? ''), 'dhl') ? 'selected' : '' }}>DHL Express (GoGreen)</option>
                            <option value="Hermes" {{ str_contains(strtolower($order->courier_name ?? ''), 'hermes') ? 'selected' : '' }}>Hermes Logistik</option>
                            <option value="DPD" {{ str_contains(strtolower($order->courier_name ?? ''), 'dpd') ? 'selected' : '' }}>DPD Deutschland</option>
                            <option value="UPS" {{ str_contains(strtolower($order->courier_name ?? ''), 'ups') ? 'selected' : '' }}>UPS Express</option>
                            <option value="GLS" {{ str_contains(strtolower($order->courier_name ?? ''), 'gls') ? 'selected' : '' }}>GLS Germany</option>
                            <option value="FedEx" {{ str_contains(strtolower($order->courier_name ?? ''), 'fedex') ? 'selected' : '' }}>FedEx</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-stone-700 mb-1">Sendungsnummer (Tracking Code) *</label>
                        <input 
                            type="text" 
                            name="tracking_number" 
                            id="tracking-number-input"
                            value="{{ old('tracking_number', $order->tracking_number) }}" 
                            placeholder="z. B. 00340434161094042898" 
                            required 
                            oninput="previewTrackingLink()"
                            class="w-full rounded-xl border border-stone-200 bg-stone-50/50 py-2 px-3 text-stone-900 font-mono font-bold focus:border-saltora-terracotta focus:bg-white focus:outline-none transition shadow-2xs"
                        >
                    </div>
                </div>

                <!-- Live Auto-Generated Tracking URL Preview -->
                <div class="rounded-xl border border-stone-200 bg-[#faf7f2] p-3 text-[0.68rem] space-y-1">
                    <span class="font-bold text-stone-700 uppercase tracking-wider block">Generierter Tracking-Link:</span>
                    <div class="flex items-center gap-2">
                        <a 
                            id="tracking-link-preview" 
                            href="{{ $order->generated_tracking_url ?: '#' }}" 
                            target="_blank" 
                            class="font-mono text-saltora-terracotta underline truncate max-w-md block hover:brightness-110"
                        >
                            {{ $order->generated_tracking_url ?: 'Geben Sie eine Sendungsnummer ein, um die URL zu erzeugen...' }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-center">
                    <div>
                        <label class="block font-bold text-stone-700 mb-1">Versandzeitpunkt</label>
                        <input 
                            type="datetime-local" 
                            name="dispatched_at" 
                            value="{{ $order->dispatched_at ? $order->dispatched_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i') }}" 
                            class="w-full rounded-xl border border-stone-200 bg-stone-50/50 py-2 px-3 text-stone-800 text-xs focus:border-saltora-terracotta focus:bg-white focus:outline-none transition shadow-2xs"
                        >
                    </div>

                    <div class="pt-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="notify_customer" value="1" checked class="rounded text-saltora-terracotta focus:ring-saltora-terracotta">
                            <span class="font-bold text-stone-800 text-xs">Kunde per E-Mail benachrichtigen</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs font-bold shadow-md transition cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Versand speichern & Tracking aktivieren</span>
                    </button>

                    @if($order->tracking_number && $order->customer_email)
                        <button 
                            type="button" 
                            onclick="sendDispatchEmail({{ $order->id }}, this)" 
                            class="btn-exec-secondary rounded-xl px-4 py-2.5 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer"
                        >
                            <span>✉️</span>
                            <span>E-Mail erneut senden</span>
                        </button>
                    @endif
                </div>
            </form>

        </div>

        <!-- 2. Vorkasse Receipt & Payment Verification (5 Cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            
            <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold">
                        💳
                    </div>
                    <div>
                        <h2 class="font-extrabold text-sm text-stone-900">Zahlungsnachweis (Vorkasse)</h2>
                        <p class="text-[0.68rem] text-stone-400">Banküberweisung / Beleg verifizieren</p>
                    </div>
                </div>

                @if($order->payment_status === 'paid')
                    <span class="rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 text-[0.62rem] font-bold">
                        ✓ Bezahlt
                    </span>
                @else
                    <span class="rounded-full bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-0.5 text-[0.62rem] font-bold">
                        Ausstehend
                    </span>
                @endif
            </div>

            <!-- Upload Receipt Form -->
            <form action="{{ route('admin.orders.upload-receipt', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf
                
                <div>
                    <label class="block font-bold text-stone-700 mb-1">Überweisungsbeleg / Screenshot (PDF, PNG, JPG)</label>
                    <input 
                        type="file" 
                        name="receipt" 
                        required 
                        accept=".pdf,.png,.jpg,.jpeg,.webp" 
                        class="w-full text-xs text-stone-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-stone-100 file:text-stone-700 hover:file:bg-saltora-blush hover:file:text-saltora-terracotta file:cursor-pointer cursor-pointer border border-stone-200 rounded-xl p-1 bg-stone-50"
                    >
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="mark_as_paid" value="1" checked class="rounded text-saltora-terracotta focus:ring-saltora-terracotta">
                        <span class="font-medium text-stone-700 text-xs">Status direkt auf "Bezahlt" setzen</span>
                    </label>

                    <button type="submit" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition shadow-2xs cursor-pointer">
                        Beleg Hochladen
                    </button>
                </div>
            </form>

            <!-- Attached Receipt Preview -->
            @if($order->payment_receipt_path)
                <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50/60 p-3.5 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-emerald-900 flex items-center gap-1.5">
                            <span>📎</span>
                            <span>Hinterlegter Zahlungsbeleg</span>
                        </span>
                        <a href="{{ $order->payment_receipt_path }}" target="_blank" class="text-xs font-bold text-saltora-terracotta hover:underline">
                            Öffnen ↗
                        </a>
                    </div>
                    <p class="text-[0.68rem] text-emerald-700">
                        Der Beleg wurde hochgeladen und ist in der Akte dokumentiert.
                    </p>
                </div>
            @endif

            <!-- Manual Status Toggle Form -->
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="pt-3 border-t border-stone-100 space-y-3 text-xs">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-bold text-stone-700 mb-1">Auftragsstatus</label>
                        <select name="status" class="w-full rounded-xl border border-stone-200 bg-white py-1.5 px-2 text-stone-900 text-xs font-bold">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Offen</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>In Bearbeitung</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Versendet</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Zugestellt</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Storniert</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-stone-700 mb-1">Zahlungsstatus</label>
                        <select name="payment_status" class="w-full rounded-xl border border-stone-200 bg-white py-1.5 px-2 text-stone-900 text-xs font-bold">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Offen</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Bezahlt</option>
                            <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Erstattet</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full btn-exec-secondary rounded-xl py-2 text-xs font-bold transition">
                    Status aktualisieren
                </button>
            </form>

        </div>

    </div>

    <!-- Customer & Items Breakdown Area -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 sm:p-8 space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-stone-200">
            <!-- Customer & Shipping Address -->
            <div class="space-y-2 text-xs text-stone-700">
                <h3 class="font-extrabold text-stone-900 uppercase tracking-wider text-[0.68rem]">Liefer- & Rechnungsanschrift</h3>
                <div class="bg-stone-50 rounded-xl border border-stone-200 p-4 space-y-1">
                    <p class="font-bold text-stone-900 text-sm">{{ $order->customer_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->postal_code }} {{ $order->city }}</p>
                    <p class="font-bold text-stone-800">{{ $order->country }}</p>
                    <div class="pt-2 text-[0.68rem] text-stone-500">
                        <p>E-Mail: <a href="mailto:{{ $order->customer_email }}" class="text-saltora-terracotta underline">{{ $order->customer_email }}</a></p>
                        @if($order->customer_phone)
                            <p>Telefon: <a href="tel:{{ $order->customer_phone }}" class="text-stone-700">{{ $order->customer_phone }}</a></p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notes & Instructions -->
            <div class="space-y-2 text-xs text-stone-700">
                <h3 class="font-extrabold text-stone-900 uppercase tracking-wider text-[0.68rem]">Zahlungsart & interne Notizen</h3>
                <div class="bg-stone-50 rounded-xl border border-stone-200 p-4 space-y-2">
                    <div>
                        <span class="text-[0.62rem] font-bold uppercase text-stone-400 block">Zahlungsweise:</span>
                        <p class="font-bold text-stone-900">
                            {{ $order->payment_method === 'cod' ? 'Barzahlung bei Lieferung (Nachnahme / COD)' : 'Manuelle Banküberweisung (Vorkasse)' }}
                        </p>
                    </div>

                    @if($order->coupon_code)
                        <div>
                            <span class="text-[0.62rem] font-bold uppercase text-stone-400 block">Eingelöster Gutschein:</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[0.65rem] font-mono font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                {{ $order->coupon_code }} (-{{ number_format($order->discount_amount, 2, ',', '.') }} €)
                            </span>
                        </div>
                    @endif

                    @if($order->notes)
                        <div class="pt-1">
                            <span class="text-[0.62rem] font-bold uppercase text-stone-400 block">Kundenhinweis:</span>
                            <p class="text-stone-600 italic">"{{ $order->notes }}"</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div>
            <h3 class="font-extrabold text-stone-900 uppercase tracking-wider text-[0.68rem] mb-3">Bestellte Positionen</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-stone-200 bg-stone-50/60 text-stone-500 font-bold uppercase tracking-wider text-[0.62rem]">
                            <th class="py-2.5 px-3">Artikel</th>
                            <th class="py-2.5 px-3 text-right">Einzelpreis</th>
                            <th class="py-2.5 px-3 text-center">Menge</th>
                            <th class="py-2.5 px-3 text-right">Gesamt</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($order->items as $item)
                            <tr class="hover:bg-stone-50/50">
                                <td class="py-3 px-3">
                                    <div class="font-bold text-stone-900">{{ $item->product_name }}</div>
                                    @if($item->product && $item->product->sku)
                                        <div class="text-[0.62rem] text-stone-400 font-mono">{{ $item->product->sku }}</div>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right">EUR {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                                <td class="py-3 px-3 text-center font-bold">{{ $item->quantity }}</td>
                                <td class="py-3 px-3 text-right font-extrabold text-stone-900">EUR {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totals Breakdown -->
            <div class="flex justify-end pt-4 border-t border-stone-200 mt-4">
                <div class="w-full sm:w-72 bg-stone-50 p-4 rounded-xl border border-stone-200 space-y-2 text-xs">
                    <div class="flex justify-between text-stone-600">
                        <span>Zwischensumme:</span>
                        <span>EUR {{ number_format($order->subtotal ?: $order->total_amount, 2, ',', '.') }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-700 font-bold">
                            <span>Gutscheinrabatt:</span>
                            <span>-EUR {{ number_format($order->discount_amount, 2, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-stone-600">
                        <span>Inkl. 19% MwSt.:</span>
                        <span>EUR {{ number_format(round(($order->total_amount / 1.19) * 0.19, 2), 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-stone-600">
                        <span>Versicherter Versand:</span>
                        <span class="text-emerald-700 font-bold">Kostenfrei (0,00 €)</span>
                    </div>
                    <div class="border-t border-stone-300 pt-2 flex justify-between text-sm font-extrabold text-stone-900">
                        <span>Gesamtbetrag:</span>
                        <span class="text-saltora-terracotta">EUR {{ number_format($order->total_amount, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    // Live Auto-Tracking URL Generator
    function previewTrackingLink() {
        const carrier = document.getElementById('carrier-select')?.value || '';
        const code = document.getElementById('tracking-number-input')?.value.trim() || '';
        const previewEl = document.getElementById('tracking-link-preview');
        if (!previewEl) return;

        if (!code) {
            previewEl.textContent = 'Geben Sie eine Sendungsnummer ein, um die URL zu erzeugen...';
            previewEl.href = '#';
            return;
        }

        let url = '';
        const lower = carrier.toLowerCase();
        if (lower.includes('dhl')) {
            url = `https://www.dhl.de/de/privatkunden/pakete-empfangen/verfolgen.html?piececode=${encodeURIComponent(code)}`;
        } else if (lower.includes('hermes')) {
            url = `https://www.myhermes.de/empfangen/sendungsverfolgung/sendungsdetails#/${encodeURIComponent(code)}`;
        } else if (lower.includes('dpd')) {
            url = `https://tracking.dpd.de/status/de_DE/shipment/${encodeURIComponent(code)}`;
        } else if (lower.includes('ups')) {
            url = `https://www.ups.com/track?tracknum=${encodeURIComponent(code)}`;
        } else if (lower.includes('gls')) {
            url = `https://www.gls-pakete.de/sendungsverfolgung?match=${encodeURIComponent(code)}`;
        } else if (lower.includes('fedex')) {
            url = `https://www.fedex.com/fedextrack/?trknbr=${encodeURIComponent(code)}`;
        } else {
            url = `https://parcelsapp.com/en/tracking/${encodeURIComponent(code)}`;
        }

        previewEl.textContent = url;
        previewEl.href = url;
    }

    // Send Dispatch Email
    function sendDispatchEmail(orderId, btnEl) {
        const origHtml = btnEl.innerHTML;
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="animate-pulse">Senden...</span>';
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(`/admin/orders/${orderId}/send-dispatch-email`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            btnEl.disabled = false;
            btnEl.innerHTML = origHtml;
            if (data.success) {
                if (window.LuxuryToast) {
                    LuxuryToast.fire({ icon: 'success', title: data.message });
                } else {
                    alert(data.message);
                }
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            btnEl.disabled = false;
            btnEl.innerHTML = origHtml;
            console.error(err);
        });
    }
</script>
@endsection
