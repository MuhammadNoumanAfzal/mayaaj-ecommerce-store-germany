<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnung {{ $order->order_number }} — MEHAAJ Luxury Atelier</title>
    <link rel="icon" type="image/png" href="/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f5f3ef;
            color: #1c1917;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .font-serif-luxury {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        .font-mono-luxury {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Screen only toolbar styling */
        @media screen {
            .screen-toolbar {
                position: sticky;
                top: 0;
                z-index: 100;
            }
            .invoice-sheet {
                box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 0 1px 1px rgba(0, 0, 0, 0.05);
            }
        }

        /* Print Specific Strict Overrides */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .screen-toolbar {
                display: none !important;
            }
            .invoice-sheet {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                max-width: 100% !important;
                margin: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<body class="min-h-screen py-0 sm:py-8 flex flex-col items-center">

    <!-- Top Floating Toolbar (Hidden during print) -->
    <div class="screen-toolbar w-full max-w-4xl px-4 py-3 mb-4 flex items-center justify-between bg-stone-900/90 backdrop-blur-md rounded-2xl text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span data-i18n-en="Back to Order #{{ $order->order_number }}" data-i18n-de="Zurück zu Bestellung #{{ $order->order_number }}">Back to Order #{{ $order->order_number }}</span>
            </a>
            <span class="text-stone-400 text-xs hidden sm:inline" data-i18n-en="• Official Tax Invoice" data-i18n-de="• Offizielle Handelsrechnung">• Official Tax Invoice</span>
        </div>

        <div class="flex items-center gap-2">
            <!-- Language Toggle Pill -->
            <div class="flex items-center rounded-xl bg-white/10 p-1 border border-white/10 text-xs" aria-label="Language selector">
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-black uppercase transition" type="button" data-language-option="en" onclick="applyLanguage('en')">EN</button>
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-black uppercase transition" type="button" data-language-option="de" onclick="applyLanguage('de')">DE</button>
            </div>

            <a href="{{ route('admin.orders.packing-slip', $order->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                <span data-i18n-en="Packing Slip" data-i18n-de="Lieferschein">Packing Slip</span>
            </a>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-gradient-to-r from-[#964B42] to-[#b35e53] hover:brightness-110 text-white text-xs font-bold transition shadow-md cursor-pointer">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                <span data-i18n-en="Print Invoice (Ctrl+P)" data-i18n-de="Rechnung Drucken (Strg+P)">Print Invoice (Ctrl+P)</span>
            </button>
        </div>
    </div>

    <!-- Official A4 Luxury Printable Invoice Document -->
    <div class="invoice-sheet w-full max-w-[210mm] bg-white rounded-none sm:rounded-2xl p-8 sm:p-12 text-stone-900 border border-stone-200/80 relative">
        
        <!-- Header: Company Logo & Atelier Info -->
        <div class="flex flex-col sm:flex-row justify-between items-start pb-8 border-b-2 border-stone-900 gap-6">
            
            <!-- Left: Brand Logo & Title -->
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <img src="/logo.png" alt="MEHAAJ Logo" class="h-14 w-auto object-contain">
                    <div>
                        <div class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-wider text-stone-900 uppercase leading-none">
                            MEHAAJ <span class="text-[#964B42]">ATELIER</span>
                        </div>
                        <p class="text-[0.62rem] font-bold tracking-[0.25em] text-[#964B42] uppercase mt-1" data-i18n-en="HAUTE COUTURE & LUXURY MANUFACTURE" data-i18n-de="HAUTE COUTURE & LUXUS-MANUFAKTUR">
                            HAUTE COUTURE & LUXURY MANUFACTURE
                        </p>
                    </div>
                </div>
                
                <p class="text-[0.68rem] text-stone-500 font-medium pt-1 leading-relaxed">
                    MEHAAJ E-Commerce GmbH • Maximilianstraße 28 • D-80539 München<br>
                    USt-IdNr.: DE 391 048 291 • Amtsgericht München HRB 88201 B<br>
                    Tel: +49 (0) 89 2109 4400 • E-Mail: atelier@mehaaj.de • Web: www.mehaaj.de
                </p>
            </div>

            <!-- Right: Invoice Metadata Pill -->
            <div class="text-right sm:text-right w-full sm:w-auto">
                <div class="inline-block bg-[#F8F5EF] p-4 rounded-xl border border-stone-300/80 text-right space-y-1 min-w-[200px]">
                    <span class="block text-xs font-black tracking-widest text-[#964B42] uppercase" data-i18n-en="TAX INVOICE" data-i18n-de="RECHNUNG">TAX INVOICE</span>
                    <p class="text-base font-mono-luxury font-black text-stone-900 leading-tight">
                        #{{ $order->order_number }}
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Date:" data-i18n-de="Datum:">Date:</span> <strong class="text-stone-800">{{ $order->created_at->format('d.m.Y') }}</strong>
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Delivery:" data-i18n-de="Lieferung:">Delivery:</span> <strong class="text-stone-800">{{ $order->created_at->format('d.m.Y') }}</strong>
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Payment:" data-i18n-de="Zahlung:">Payment:</span> <strong class="uppercase text-stone-800">{{ str_replace('_', ' ', $order->payment_method) }}</strong>
                    </p>
                </div>

                <!-- Payment Verification Stamp -->
                <div class="mt-2 text-right">
                    @if($order->payment_status === 'paid')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.62rem] font-black uppercase tracking-wider bg-emerald-100 text-emerald-900 border border-emerald-300" data-i18n-en="✓ PAID (VERIFIED)" data-i18n-de="✓ BEZAHLT / PAYMENT VERIFIED">
                            ✓ PAID (VERIFIED)
                        </span>
                    @elseif($order->payment_status === 'refunded')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.62rem] font-black uppercase tracking-wider bg-rose-100 text-rose-900 border border-rose-300" data-i18n-en="REFUNDED" data-i18n-de="ERSTATTET / REFUNDED">
                            REFUNDED
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.62rem] font-black uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-300" data-i18n-en="⏳ UNPAID / AWAITING WIRE" data-i18n-de="⏳ OFFEN / AWAITING WIRE">
                            ⏳ UNPAID / AWAITING WIRE
                        </span>
                    @endif
                </div>
            </div>

        </div>

        <!-- Address Header Block (DIN 5008 Address Window Format) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 py-7 border-b border-stone-200">
            
            <!-- Recipient Billing & Shipping Address -->
            <div>
                <p class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-400 mb-1" data-i18n-en="BILLING & SHIPPING ADDRESS:" data-i18n-de="RECHNUNGS- & LIEFERADRESSE:">
                    BILLING & SHIPPING ADDRESS:
                </p>
                <div class="text-xs space-y-0.5 text-stone-800 font-medium">
                    <p class="font-bold text-sm text-stone-900">{{ $order->customer_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->postal_code }} {{ $order->city }}</p>
                    <p class="font-bold uppercase tracking-wider text-stone-700">{{ $order->country ?? 'Deutschland' }}</p>
                    <div class="pt-2 text-[0.68rem] text-stone-500">
                        <span>E-Mail: {{ $order->customer_email }}</span>
                        @if($order->customer_phone)
                            <span class="ml-2">• Tel: {{ $order->customer_phone }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Atelier Order Notes / Gift Message -->
            <div class="bg-[#FBF6F4] p-4 rounded-xl border border-stone-200/80 text-xs space-y-1.5">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#964B42] block" data-i18n-en="ORDER NOTE & ATELIER INSTRUCTIONS:" data-i18n-de="BESTELLNOTIZ & ATELIER-INSTRUKTION:">
                    ORDER NOTE & ATELIER INSTRUCTIONS:
                </span>
                <p class="text-stone-700 italic">
                    "{{ $order->notes ?? 'Standard Signature Presentation — White-glove packaging with silk dust bag and wax seal certificate.' }}"
                </p>
                <p class="text-[0.65rem] text-stone-400 pt-1 font-medium">
                    <span data-i18n-en="Logistics Partner:" data-i18n-de="Versanddienstleister:">Logistics Partner:</span> <strong>DHL Express Germany (GoGreen Climate Neutral)</strong>
                </p>
            </div>

        </div>

        <!-- Itemized Order Table -->
        <div class="py-6">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b-2 border-stone-900 text-[0.65rem] font-black uppercase tracking-wider text-stone-800">
                        <th class="py-2.5 w-10 text-center">POS</th>
                        <th class="py-2.5" data-i18n-en="ITEM / DESCRIPTION" data-i18n-de="ARTIKEL / BESCHREIBUNG">ITEM / DESCRIPTION</th>
                        <th class="py-2.5 w-24 text-center">SKU</th>
                        <th class="py-2.5 w-20 text-center" data-i18n-en="QTY" data-i18n-de="MENGE">QTY</th>
                        <th class="py-2.5 w-28 text-right" data-i18n-en="UNIT PRICE" data-i18n-de="EINZELPREIS">UNIT PRICE</th>
                        <th class="py-2.5 w-28 text-right" data-i18n-en="TOTAL" data-i18n-de="GESAMTBETRAG">TOTAL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @foreach($order->items as $idx => $item)
                        <tr>
                            <td class="py-3 text-center text-stone-400 font-mono-luxury font-bold">
                                {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-3 pr-4">
                                <p class="font-bold text-stone-900 text-xs">{{ $item->product_name }}</p>
                                <p class="text-[0.65rem] text-stone-500" data-i18n-en="Haute Couture Atelier Selection • 100% Authentic" data-i18n-de="Haute Couture Atelier Selection • Reines Naturmaterial">Haute Couture Atelier Selection • 100% Authentic</p>
                            </td>
                            <td class="py-3 text-center font-mono-luxury text-[0.68rem] text-stone-500">
                                {{ $item->product?->sku ?? 'MHJ-LUX-' . $item->id }}
                            </td>
                            <td class="py-3 text-center font-bold text-stone-800">
                                {{ $item->quantity }}
                            </td>
                            <td class="py-3 text-right font-mono-luxury font-semibold text-stone-700">
                                €{{ number_format($item->unit_price, 2) }}
                            </td>
                            <td class="py-3 text-right font-mono-luxury font-bold text-stone-900">
                                €{{ number_format($item->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals & Tax Calculation Breakdown -->
        @php
            $netAmount = (float)$order->total_amount / 1.19;
            $vatAmount = (float)$order->total_amount - $netAmount;
        @endphp
        <div class="border-t-2 border-stone-900 pt-4 flex flex-col sm:flex-row justify-between items-start gap-6">
            
            <!-- Bank Wire Details (Vorkasse / Überweisung) -->
            <div class="text-[0.68rem] space-y-1 bg-stone-50 p-4 rounded-xl border border-stone-200 max-w-sm w-full">
                <span class="font-bold text-xs uppercase tracking-wider text-[#964B42] block" data-i18n-en="BANK TRANSFER DETAILS (COMMERZBANK AG):" data-i18n-de="BANKVERBINDUNG (COMMERZBANK AG):">
                    BANK TRANSFER DETAILS (COMMERZBANK AG):
                </span>
                <p><span class="text-stone-500" data-i18n-en="Account Holder:" data-i18n-de="Kontoinhaber:">Account Holder:</span> <strong>MEHAAJ E-Commerce GmbH</strong></p>
                <p><span class="text-stone-500">IBAN:</span> <strong class="font-mono-luxury text-stone-900">DE89 3704 0044 0532 0130 00</strong></p>
                <p><span class="text-stone-500">BIC:</span> <strong class="font-mono-luxury">COBADEFFXXX</strong></p>
                <p><span class="text-stone-500" data-i18n-en="Payment Reference:" data-i18n-de="Verwendungszweck:">Payment Reference:</span> <strong class="font-mono-luxury text-[#964B42] bg-rose-50 px-1 py-0.5 rounded">{{ $order->order_number }}</strong></p>
            </div>

            <!-- Calculation Box -->
            <div class="w-full sm:w-72 space-y-2 text-xs">
                <div class="flex justify-between text-stone-600">
                    <span data-i18n-en="Net Subtotal:" data-i18n-de="Nettobetrag:">Net Subtotal:</span>
                    <span class="font-mono-luxury font-semibold">€{{ number_format($netAmount, 2) }}</span>
                </div>
                <div class="flex justify-between text-stone-600">
                    <span data-i18n-en="plus 19% VAT (MwSt.):" data-i18n-de="zzgl. 19% MwSt.:">plus 19% VAT (MwSt.):</span>
                    <span class="font-mono-luxury font-semibold">€{{ number_format($vatAmount, 2) }}</span>
                </div>
                <div class="flex justify-between text-stone-600">
                    <span data-i18n-en="Shipping & Packaging:" data-i18n-de="Versand & Verpackung:">Shipping & Packaging:</span>
                    <span class="text-emerald-700 font-bold uppercase text-[0.68rem]" data-i18n-en="FREE" data-i18n-de="KOSTENFREI">FREE</span>
                </div>
                <div class="pt-2 border-t-2 border-stone-900 flex justify-between items-baseline text-base font-black text-stone-900">
                    <span data-i18n-en="TOTAL AMOUNT (EUR):" data-i18n-de="GESAMTBETRAG (EUR):">TOTAL AMOUNT (EUR):</span>
                    <span class="font-mono-luxury text-lg text-[#964B42]">€{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

        </div>

        <!-- Quality & Legal Footer -->
        <div class="mt-12 pt-6 border-t border-stone-200 text-[0.62rem] text-stone-500 leading-relaxed text-center space-y-1">
            <p data-i18n-en="Thank you for your order with MEHAAJ Luxury Atelier. Each garment is crafted with the highest precision and inspected for quality." data-i18n-de="Vielen Dank für Ihre Bestellung bei MEHAAJ Luxury Atelier. Jedes Kleidungsstück wurde von erfahrenen Meisterschneidern mit größter Sorgfalt gefertigt und qualitätsgeprüft.">
                Thank you for your order with MEHAAJ Luxury Atelier. Each garment is crafted with the highest precision and inspected for quality.
            </p>
            <p data-i18n-en="Invoice payable upon receipt without deductions. Right of return within 14 days per terms. Jurisdiction is Munich, Germany." data-i18n-de="Rechnungsbetrag ist fällig ohne Abzug. Reklamationen und Widerruf gemäß unseren AGB innerhalb von 14 Tagen. Gerichtsstand und Erfüllungsort ist München, Deutschland.">
                Invoice payable upon receipt without deductions. Right of return within 14 days per terms. Jurisdiction is Munich, Germany.
            </p>
            <p class="font-serif-luxury text-stone-400 italic pt-1">
                MEHAAJ Luxury Atelier • Munich • Paris • Berlin
            </p>
        </div>

    </div>

    <!-- Client-side persistent translation logic -->
    <script>
        function applyLanguage(lang) {
            if (!lang) lang = 'en';
            try { localStorage.setItem('mehaaj_admin_lang', lang); } catch(e){}
            document.cookie = 'mehaaj_admin_lang=' + lang + ';path=/';
            document.documentElement.lang = lang;

            document.querySelectorAll('[data-language-option]').forEach(btn => {
                if (btn.getAttribute('data-language-option') === lang) {
                    btn.className = 'cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-black uppercase transition bg-[#964B42] text-white shadow-xs';
                } else {
                    btn.className = 'cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-bold uppercase transition text-stone-300 hover:text-white';
                }
            });

            document.querySelectorAll('[data-i18n-' + lang + ']').forEach(el => {
                const text = el.getAttribute('data-i18n-' + lang);
                if (text !== null) {
                    el.innerText = text;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('mehaaj_admin_lang') || 'en';
            applyLanguage(savedLang);
        });
    </script>

    @if(request('autoprint'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => window.print(), 300);
        });
    </script>
    @endif
</body>
</html>
