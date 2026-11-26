@extends('layouts.app')
@section('title', 'Widerrufsrecht & Retouren-Portal | MEHAAJ® Official')
@section('meta_description', 'Gesetzliches 14-Tage Widerrufsrecht und bequeme Online-Retourenabwicklung für Ihre MEHAAJ Atelier-Bestellung.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] text-[#1c1210] py-8 sm:py-12">
    <div class="luxury-container max-w-4xl mx-auto px-4 sm:px-6">

        <!-- Breadcrumb Navigation -->
        <nav class="mb-5 flex items-center gap-2 text-xs text-[#685c54]">
            <a href="{{ url('/') }}" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span class="text-[#c5baaa]">/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-de="Retouren & Widerruf" data-i18n-en="Returns & RMA">Retouren & Widerruf</span>
        </nav>

        <!-- Header Banner -->
        <div class="mb-8 text-center space-y-2 border-b border-[#e6decb] pb-6">
            <span class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.22em] text-[#78000b]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                <span data-i18n-de="GESETZLICHES WIDERRUFSRECHT (§ 355 BGB)" data-i18n-en="STATUTORY 14-DAY RIGHT OF RETURN (§ 355 BGB)">GESETZLICHES WIDERRUFSRECHT (§ 355 BGB)</span>
            </span>
            <h1 class="font-display text-2xl sm:text-3xl font-medium tracking-tight text-[#1c1210]" data-i18n-de="Retoure & Widerruf Online Anmelden" data-i18n-en="Register Your Return & RMA Online">
                Retoure & Widerruf Online Anmelden
            </h1>
            <p class="text-xs text-[#685c54] max-w-lg mx-auto" data-i18n-de="Sie können Ihre Bestellung innerhalb der 14-tägigen gesetzlichen Widerrufsfrist ab Erhalt kostenfrei und unkompliziert retournieren. Geben Sie dazu einfach Ihre Bestelldaten ein." data-i18n-en="Return items conveniently within the statutory 14-day cancellation window. Enter your order details below to generate your printable return slip.">
                Sie können Ihre Bestellung innerhalb der 14-tägigen gesetzlichen Widerrufsfrist ab Erhalt kostenfrei und unkompliziert retournieren. Geben Sie dazu einfach Ihre Bestelldaten ein.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center gap-2.5 shadow-2xs">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error') || (isset($error) && $error))
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs font-semibold text-rose-800 flex items-center gap-2.5 shadow-2xs">
                <span>⚠️</span>
                <span>{{ session('error') ?? $error }}</span>
            </div>
        @endif

        <!-- Order Lookup Form -->
        <div class="mb-8 rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-2xs">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#1c1210] mb-4 flex items-center gap-2">
                <span>🔍</span>
                <span data-i18n-de="Schritt 1: Bestellung aufrufen" data-i18n-en="Step 1: Locate Order">Schritt 1: Bestellung aufrufen</span>
            </h2>

            <form method="GET" action="{{ route('returns.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 sm:gap-4 items-end">
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
                        name="email" 
                        required 
                        value="{{ old('email', $email ?? '') }}" 
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
                        <span data-i18n-de="Prüfen" data-i18n-en="Verify">Prüfen</span>
                    </button>
                </div>
            </form>
        </div>

        @if(isset($order) && $order && !isset($error))
            <!-- Step 2: Return Items & Reason Form -->
            <form method="POST" action="{{ route('returns.store') }}" enctype="multipart/form-data" class="space-y-6" id="returnForm">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="customer_name" value="{{ $order->customer_name }}">
                <input type="hidden" name="customer_email" value="{{ $order->customer_email }}">

                <div class="rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-sm space-y-6">
                    
                    <!-- Eligibility Badge Header -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-[#f2ebdc] pb-4 gap-3">
                        <div>
                            <span class="text-xs text-[#8a7c74]">Bestellung gefunden:</span>
                            <h3 class="font-display text-lg font-bold text-[#1c1210]">Bestellung #{{ $order->order_number }}</h3>
                            <p class="text-xs text-[#685c54]">Aufgegeben am {{ $order->created_at->format('d.m.Y') }}</p>
                        </div>
                        
                        <!-- 14-Day Statutory Countdown Pill -->
                        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-right">
                            <span class="text-[0.62rem] font-bold uppercase tracking-wider text-emerald-800 block">Gesetzliche Frist</span>
                            <span class="text-xs font-bold text-emerald-900 flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-600 animate-pulse"></span>
                                Noch {{ $daysRemaining ?? 14 }} Tage für Widerruf gültig
                            </span>
                        </div>
                    </div>

                    <!-- Step 2 Title -->
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-[#1c1210] mb-1">
                            Schritt 2: Zu retournierende Artikel wählen
                        </h4>
                        <p class="text-xs text-[#685c54]">
                            Wählen Sie die Positionen aus, die Sie an unser Atelier zurücksenden möchten:
                        </p>
                    </div>

                    <!-- Order Items Selection Table -->
                    <div class="rounded-xl border border-[#e6decb] overflow-hidden divide-y divide-[#f2ebdc]">
                        @foreach($order->items as $idx => $item)
                            <div class="p-4 bg-[#faf7f2]/50 hover:bg-[#faf7f2] transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <input 
                                        type="checkbox" 
                                        id="item_check_{{ $item->id }}" 
                                        name="selected_items[]" 
                                        value="{{ $item->product_id }}"
                                        class="h-4 w-4 rounded text-[#78000b] border-[#c5baaa] focus:ring-[#78000b] cursor-pointer item-checkbox"
                                        data-product-id="{{ $item->product_id }}"
                                        data-max-qty="{{ $item->quantity }}"
                                        data-price="{{ $item->unit_price }}"
                                        onchange="updateReturnSummary()"
                                    >
                                    <div>
                                        <label for="item_check_{{ $item->id }}" class="font-bold text-xs text-[#1c1210] cursor-pointer">
                                            {{ $item->product_name }}
                                        </label>
                                        <p class="text-[0.68rem] text-[#8a7c74]">
                                            Gekaufte Menge: {{ $item->quantity }}x • Einzelpreis: EUR {{ number_format($item->unit_price, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 self-end sm:self-center">
                                    <div class="flex items-center gap-1.5">
                                        <label class="text-[0.68rem] text-[#685c54]">Menge:</label>
                                        <select 
                                            name="items_qty[{{ $item->product_id }}]" 
                                            id="qty_{{ $item->product_id }}"
                                            disabled
                                            class="rounded-lg border border-[#e6decb] bg-white px-2 py-1 text-xs text-[#1c1210] font-bold focus:border-[#78000b] focus:outline-none disabled:opacity-40"
                                            onchange="updateReturnSummary()"
                                        >
                                            @for($q = 1; $q <= $item->quantity; $q++)
                                                <option value="{{ $q }}" {{ $q == $item->quantity ? 'selected' : '' }}>{{ $q }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="w-24 text-right font-bold text-xs text-[#78000b]">
                                        EUR {{ number_format($item->subtotal, 2, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Hidden actual item fields container generated dynamically -->
                    <div id="hiddenItemsContainer"></div>

                    <!-- Step 3: Return Reason & Details -->
                    <div class="pt-4 border-t border-[#f2ebdc] space-y-4">
                        <div>
                            <h4 class="text-sm font-bold uppercase tracking-wider text-[#1c1210] mb-1">
                                Schritt 3: Grund des Widerrufs & Anmerkungen
                            </h4>
                            <p class="text-xs text-[#685c54]">
                                Helfen Sie uns, unsere Passform und Atelier-Qualität stetig zu optimieren:
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1">
                                    Rückgabegrund *
                                </label>
                                <select 
                                    name="reason" 
                                    required 
                                    class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                                >
                                    <option value="changed_mind">14-Tage Widerruf / Meinungsänderung (§ 355 BGB)</option>
                                    <option value="wrong_size">Falsche Größe / Passform zu weit oder eng</option>
                                    <option value="not_as_pictured">Artikel weicht von Farbdarstellung / Foto ab</option>
                                    <option value="defect">Beschädigung / Verarbeitungsfehler</option>
                                    <option value="other">Sonstiger Grund</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1">
                                    Foto bei Mangel / Beschädigung (Optional)
                                </label>
                                <input 
                                    type="file" 
                                    name="photo" 
                                    accept="image/*" 
                                    class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3 py-2 text-xs text-[#685c54] file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[0.68rem] file:font-bold file:bg-[#78000b] file:text-white hover:file:bg-[#5a0309] cursor-pointer"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#1c1210] mb-1">
                                Zusätzliche Mitteilung an unser Atelier (Optional)
                            </label>
                            <textarea 
                                name="customer_notes" 
                                rows="3" 
                                placeholder="z. B. Umtausch in Größe M gewünscht, etc." 
                                class="w-full rounded-xl border border-[#e6decb] bg-[#faf7f2] px-3.5 py-2.5 text-xs text-[#1c1210] focus:border-[#78000b] focus:bg-white focus:outline-none transition shadow-2xs"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Step 4: Refund Summary & Submit -->
                    <div class="pt-4 border-t border-[#f2ebdc] flex flex-col sm:flex-row items-center justify-between gap-4 bg-[#faf7f2] p-5 rounded-xl border border-[#e6decb]">
                        <div>
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8a7c74] block">Errechneter Erstattungsbetrag</span>
                            <span class="font-display text-2xl font-bold text-[#78000b]" id="totalRefundDisplay">EUR 0,00</span>
                            <p class="text-[0.62rem] text-[#685c54] mt-0.5">Wird nach Prüfung auf die ursprüngliche Zahlungsart erstattet.</p>
                        </div>

                        <button 
                            type="submit" 
                            id="submitReturnBtn"
                            disabled
                            class="w-full sm:w-auto px-7 py-3 rounded-xl bg-[#78000b] hover:bg-[#5a0309] disabled:bg-[#c5baaa] text-white text-xs font-bold uppercase tracking-[0.14em] transition-all shadow-md active:scale-95 cursor-pointer disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <span>Rücksendeetikett Erstellen</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>

                </div>
            </form>

            <script>
                function updateReturnSummary() {
                    const checkboxes = document.querySelectorAll('.item-checkbox');
                    const hiddenContainer = document.getElementById('hiddenItemsContainer');
                    const submitBtn = document.getElementById('submitReturnBtn');
                    const totalDisplay = document.getElementById('totalRefundDisplay');
                    
                    hiddenContainer.innerHTML = '';
                    let totalRefund = 0;
                    let selectedCount = 0;

                    checkboxes.forEach((cb, index) => {
                        const productId = cb.getAttribute('data-product-id');
                        const price = parseFloat(cb.getAttribute('data-price')) || 0;
                        const qtySelect = document.getElementById('qty_' + productId);

                        if (cb.checked) {
                            qtySelect.disabled = false;
                            const qty = parseInt(qtySelect.value) || 1;
                            totalRefund += (price * qty);
                            selectedCount++;

                            // Inject items[idx][product_id] and items[idx][quantity]
                            const prodInput = document.createElement('input');
                            prodInput.type = 'hidden';
                            prodInput.name = `items[${selectedCount - 1}][product_id]`;
                            prodInput.value = productId;
                            hiddenContainer.appendChild(prodInput);

                            const qtyInput = document.createElement('input');
                            qtyInput.type = 'hidden';
                            qtyInput.name = `items[${selectedCount - 1}][quantity]`;
                            qtyInput.value = qty;
                            hiddenContainer.appendChild(qtyInput);
                        } else {
                            qtySelect.disabled = true;
                        }
                    });

                    totalDisplay.innerText = 'EUR ' + totalRefund.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    
                    if (selectedCount > 0) {
                        submitBtn.disabled = false;
                    } else {
                        submitBtn.disabled = true;
                    }
                }
            </script>
        @endif

        <!-- Legal Disclaimer Note -->
        <div class="mt-8 rounded-xl border border-[#e6decb] bg-white p-5 text-xs text-[#685c54] space-y-2 leading-relaxed">
            <h4 class="font-bold text-[#1c1210] uppercase tracking-wider text-[0.68rem] flex items-center gap-1.5">
                <span>⚖️</span>
                <span>Widerrufsbelehrung & Bedingungen (§ 355 BGB)</span>
            </h4>
            <p>
                Sie haben das Recht, binnen 14 Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt 14 Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter die Ware in Besitz genommen haben.
            </p>
            <p>
                Um Ihr Widerrufsrecht auszuüben, drucken Sie nach der Registrierung das Rücksendeetikett aus und legen es dem Paket bei. Die Rücksendeadresse lautet:
                <br><strong class="text-[#1c1210]">MEHAAJ Atelier & Logistikzentrum, Goethestraße 42, 60313 Frankfurt am Main, Deutschland</strong>.
            </p>
        </div>

    </div>
</div>
@endsection
