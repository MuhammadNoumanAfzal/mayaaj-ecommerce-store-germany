@extends('layouts.app')
@section('title', 'Order Tracking & Courier Logistics | MEHAAJ® Official')
@section('meta_description', 'Track your luxury MEHAAJ parcel in real time with insured DHL Express and courier delivery tracking.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] text-[#1c1210] py-8 sm:py-12">
    <div class="luxury-container max-w-4xl mx-auto px-4 sm:px-6">

        <!-- Breadcrumb Navigation -->
        <nav class="mb-5 flex items-center gap-2 text-xs text-[#685c54]">
            <a href="{{ url('/') }}" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span class="text-[#c5baaa]">/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-de="Sendungsverfolgung" data-i18n-en="Order Tracking">Sendungsverfolgung</span>
        </nav>

        <!-- Header Banner -->
        <div class="mb-8 text-center space-y-2 border-b border-[#e6decb] pb-6">
            <span class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#78000b]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                <span data-i18n-de="MEHAAJ KURIER & LOGISTIK" data-i18n-en="MEHAAJ COURIER & LOGISTICS">MEHAAJ KURIER & LOGISTIK</span>
            </span>
            <h1 class="font-display text-2xl sm:text-3xl font-medium tracking-tight text-[#1c1210]" data-i18n-de="Sendung & Bestellstatus Verfolgen" data-i18n-en="Track Your Order & Parcel">
                Sendung & Bestellstatus Verfolgen
            </h1>
            <p class="text-xs text-[#685c54] max-w-md mx-auto" data-i18n-de="Geben Sie Ihre Bestellnummer und E-Mail-Adresse ein, um den aktuellen Status und die Sendungsnummer Ihres versicherten Pakets einzusehen." data-i18n-en="Enter your order number and email address to view live courier tracking and fulfillment status.">
                Geben Sie Ihre Bestellnummer und E-Mail-Adresse ein, um den aktuellen Status und die Sendungsnummer Ihres versicherten Pakets einzusehen.
            </p>
        </div>

        @if(session('error'))
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs font-semibold text-rose-800 flex items-center gap-2.5 shadow-2xs">
                <span>⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Order Lookup Form -->
        <div class="mb-8 rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-2xs">
            <form method="POST" action="{{ route('order.track.lookup') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-end">
                @csrf
                <div class="sm:col-span-5">
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="Bestellnummer *" data-i18n-en="Order Number *">
                        Bestellnummer *
                    </label>
                    <input 
                        type="text" 
                        name="order_number" 
                        required 
                        value="{{ old('order_number', $orderNumber ?? '') }}" 
                        placeholder="z. B. MHJ-2026-1049" 
                        class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] font-mono focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                    >
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1" data-i18n-de="E-Mail-Adresse *" data-i18n-en="Email Address *">
                        E-Mail-Adresse *
                    </label>
                    <input 
                        type="email" 
                        name="customer_email" 
                        required 
                        value="{{ old('customer_email', $email ?? '') }}" 
                        placeholder="ihre.email@beispiel.de" 
                        class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                    >
                </div>

                <div class="sm:col-span-3">
                    <button 
                        type="submit" 
                        class="w-full h-[38px] rounded-xl bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.12em] transition-all shadow-md active:scale-95 cursor-pointer flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span data-i18n-de="Verfolgen" data-i18n-en="Track">Verfolgen</span>
                    </button>
                </div>
            </form>
        </div>

        @if(isset($order) && $order)
            <!-- Live Order Tracking Results -->
            <div class="space-y-6">

                <!-- Main Order Card -->
                <div class="rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm space-y-6">
                    
                    <!-- Card Top Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-[#f2ebdc] pb-4 gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="font-display text-xl font-bold text-[#1c1210]">Bestellung #{{ $order->order_number }}</h2>
                                @if($order->status === 'delivered')
                                    <span class="rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 text-[0.65rem] font-bold">Zugestellt</span>
                                @elseif($order->status === 'shipped')
                                    <span class="rounded-full bg-blue-50 text-blue-700 border border-blue-200 px-2.5 py-0.5 text-[0.65rem] font-bold">Unterwegs</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="rounded-full bg-rose-50 text-rose-700 border border-rose-200 px-2.5 py-0.5 text-[0.65rem] font-bold">Storniert</span>
                                @else
                                    <span class="rounded-full bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-0.5 text-[0.65rem] font-bold">In Vorbereitung</span>
                                @endif
                            </div>
                            <p class="text-xs text-[#685c54] mt-0.5">Aufgegeben am {{ $order->created_at->format('d. F Y, H:i') }} Uhr</p>
                        </div>

                        <div class="text-right">
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8a7c74] block">Gesamtbetrag</span>
                            <span class="font-display text-xl font-bold text-[#78000b]">EUR {{ number_format($order->total_amount, 2, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- 5-Step Visual Status Timeline -->
                    @php $step = $order->timeline_step; @endphp
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#685c54] mb-4">Sendungsfortschritt</h3>
                        
                        <div class="relative flex items-center justify-between">
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-[#f0e8dc] w-full z-0"></div>
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-[#78000b] transition-all duration-500 z-0" style="width: {{ $step >= 5 ? 100 : ($step >= 3 ? 66 : ($step >= 2 ? 33 : 10)) }}%;"></div>

                            <!-- 1. Placed -->
                            <div class="relative z-10 text-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mx-auto {{ $step >= 1 ? 'bg-[#78000b] text-white shadow-md' : 'bg-[#e6decb] text-[#685c54]' }}">
                                    ✓
                                </div>
                                <span class="block text-[0.65rem] font-bold mt-1.5 text-[#1c1210]">Eingegangen</span>
                                <span class="block text-[0.58rem] text-[#8a7c74]">{{ $order->created_at->format('d.m. H:i') }}</span>
                            </div>

                            <!-- 2. Paid / Verified -->
                            <div class="relative z-10 text-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mx-auto {{ $step >= 2 ? 'bg-[#78000b] text-white shadow-md' : 'bg-[#e6decb] text-[#685c54]' }}">
                                    {{ $step >= 2 ? '✓' : '2' }}
                                </div>
                                <span class="block text-[0.65rem] font-bold mt-1.5 text-[#1c1210]">Bestätigt</span>
                                <span class="block text-[0.58rem] text-[#8a7c74]">{{ $order->payment_status === 'paid' ? 'Bezahlt' : 'Nachnahme/Vorkasse' }}</span>
                            </div>

                            <!-- 3. Dispatched / Shipped -->
                            <div class="relative z-10 text-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mx-auto {{ $step >= 3 ? 'bg-[#78000b] text-white shadow-md' : 'bg-[#e6decb] text-[#685c54]' }}">
                                    {{ $step >= 3 ? '✓' : '3' }}
                                </div>
                                <span class="block text-[0.65rem] font-bold mt-1.5 text-[#1c1210]">Versendet</span>
                                <span class="block text-[0.58rem] text-[#8a7c74]">{{ $order->dispatched_at ? $order->dispatched_at->format('d.m. H:i') : 'In Vorbereitung' }}</span>
                            </div>

                            <!-- 4. Delivered -->
                            <div class="relative z-10 text-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mx-auto {{ $step >= 5 ? 'bg-[#2e683a] text-white shadow-md' : 'bg-[#e6decb] text-[#685c54]' }}">
                                    {{ $step >= 5 ? '✓' : '4' }}
                                </div>
                                <span class="block text-[0.65rem] font-bold mt-1.5 text-[#1c1210]">Zugestellt</span>
                                <span class="block text-[0.58rem] text-[#8a7c74]">{{ $order->delivered_at ? $order->delivered_at->format('d.m. H:i') : 'Erwartet' }}</span>
                            </div>

                        </div>
                    </div>

                    <!-- Courier Tracking Action Box -->
                    @if($order->tracking_number)
                        <div class="rounded-xl border-2 border-[#78000b]/20 bg-[#faf7f2] p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#78000b] block">Versicherter Kurierdienst</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-base font-bold text-[#1c1210]">🚚 {{ $order->courier_name ?: 'DHL Express' }}</span>
                                    <span class="font-mono text-xs font-bold bg-white border border-[#e6decb] px-2 py-0.5 rounded text-[#78000b]">{{ $order->tracking_number }}</span>
                                </div>
                                <p class="text-[0.68rem] text-[#685c54]">
                                    Ihr Paket wurde an den Logistikpartner übergeben und befindet sich im Zustellnetzwerk.
                                </p>
                            </div>

                            @if($order->generated_tracking_url)
                                <a 
                                    href="{{ $order->generated_tracking_url }}" 
                                    target="_blank" 
                                    class="rounded-xl bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.12em] px-5 py-2.5 transition-all shadow-md active:scale-95 cursor-pointer shrink-0 flex items-center gap-2"
                                >
                                    <span>Sendung Live Verfolgen</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-4 text-xs text-[#685c54] flex items-center gap-3">
                            <span class="text-lg">📦</span>
                            <div>
                                <b class="text-[#1c1210]">Paketierung im Gange:</b> Ihre Bestellung wird sorgfältig in unserer Manufaktur geprüft und für den versicherten Versand verpackt. Sobald das Paket an den Kurier übergeben wurde, erscheint hier Ihre Live-Tracking-Nummer.
                            </div>
                        </div>
                    @endif

                    <!-- Two Columns: Shipping Address & Order Items -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 pt-4 border-t border-[#f2ebdc]">
                        
                        <!-- Delivery Address (5 Cols) -->
                        <div class="md:col-span-5 space-y-2 text-xs text-[#685c54]">
                            <h4 class="font-bold text-[#1c1210] uppercase tracking-wider text-[0.68rem]">Lieferadresse & Empfänger</h4>
                            <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-3.5 space-y-1">
                                <p class="font-bold text-[#1c1210]">{{ $order->customer_name }}</p>
                                <p>{{ $order->shipping_address }}</p>
                                <p>{{ $order->postal_code }} {{ $order->city }}</p>
                                <p>{{ $order->country }}</p>
                                <p class="text-[0.68rem] text-[#8a7c74] pt-1">E-Mail: {{ $order->customer_email }}</p>
                                @if($order->customer_phone)
                                    <p class="text-[0.68rem] text-[#8a7c74]">Telefon: {{ $order->customer_phone }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Order Line Items (7 Cols) -->
                        <div class="md:col-span-7 space-y-2 text-xs">
                            <h4 class="font-bold text-[#1c1210] uppercase tracking-wider text-[0.68rem]">Enthaltene Positionen ({{ $order->items->count() }})</h4>
                            <div class="rounded-xl border border-[#e6decb] divide-y divide-[#f2ebdc] overflow-hidden">
                                @foreach($order->items as $item)
                                    <div class="p-3 bg-[#faf7f2] flex items-center justify-between gap-3">
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-[#1c1210] truncate">{{ $item->product_name }}</p>
                                            <p class="text-[0.68rem] text-[#8a7c74]">{{ $item->quantity }}x à EUR {{ number_format($item->unit_price, 2, ',', '.') }}</p>
                                        </div>
                                        <div class="font-bold text-xs text-[#1c1210] shrink-0">
                                            EUR {{ number_format($item->subtotal, 2, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        @endif

    </div>
</div>
@endsection
