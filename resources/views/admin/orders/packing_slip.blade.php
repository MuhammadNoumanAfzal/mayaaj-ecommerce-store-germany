<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lieferschein {{ $order->order_number }} — MEHAAJ Luxury Atelier</title>
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

        @media screen {
            .screen-toolbar {
                position: sticky;
                top: 0;
                z-index: 100;
            }
            .slip-sheet {
                box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 0 1px 1px rgba(0, 0, 0, 0.05);
            }
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .screen-toolbar {
                display: none !important;
            }
            .slip-sheet {
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
                <span data-i18n-en="Order #{{ $order->order_number }}" data-i18n-de="Bestellung #{{ $order->order_number }}">Order #{{ $order->order_number }}</span>
            </a>
            <span class="text-stone-400 text-xs hidden sm:inline" data-i18n-en="• Warehouse Packing Slip & Dispatch Note" data-i18n-de="• Lager-Lieferschein & Warenbegleitschein">• Warehouse Packing Slip & Dispatch Note</span>
        </div>

        <div class="flex items-center gap-2">
            <!-- Language Toggle Pill -->
            <div class="flex items-center rounded-xl bg-white/10 p-1 border border-white/10 text-xs" aria-label="Language selector">
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-black uppercase transition" type="button" data-language-option="en" onclick="applyLanguage('en')">EN</button>
                <button class="cursor-pointer rounded-lg px-2.5 py-1 text-[0.68rem] font-black uppercase transition" type="button" data-language-option="de" onclick="applyLanguage('de')">DE</button>
            </div>

            <a href="{{ route('admin.orders.invoice', $order->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                <span data-i18n-en="Tax Invoice" data-i18n-de="Handelsrechnung">Tax Invoice</span>
            </a>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-gradient-to-r from-stone-800 to-stone-700 hover:brightness-110 text-white text-xs font-bold transition shadow-md cursor-pointer">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                <span data-i18n-en="Print Packing Slip (Ctrl+P)" data-i18n-de="Lieferschein Drucken (Strg+P)">Print Packing Slip (Ctrl+P)</span>
            </button>
        </div>
    </div>

    <!-- Official A4 Luxury Packing Slip Document -->
    <div class="slip-sheet w-full max-w-[210mm] bg-white rounded-none sm:rounded-2xl p-8 sm:p-12 text-stone-900 border border-stone-200/80 relative">
        
        <!-- Header: Company Logo & Lieferschein Meta -->
        <div class="flex flex-col sm:flex-row justify-between items-start pb-8 border-b-2 border-stone-900 gap-6">
            
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <img src="/logo.png" alt="MEHAAJ Logo" class="h-14 w-auto object-contain">
                    <div>
                        <div class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-wider text-stone-900 uppercase leading-none">
                            MEHAAJ <span class="text-[#964B42]">ATELIER</span>
                        </div>
                        <p class="text-[0.62rem] font-bold tracking-[0.25em] text-[#964B42] uppercase mt-1" data-i18n-en="LOGISTICS & FULFILLMENT CENTER" data-i18n-de="LOGISTIK- & WARENVERSANDZENTRUM">
                            LOGISTICS & FULFILLMENT CENTER
                        </p>
                    </div>
                </div>
                
                <p class="text-[0.68rem] text-stone-500 font-medium pt-1">
                    MEHAAJ E-Commerce GmbH • Maximilianstraße 28 • D-80539 München<br>
                    <span data-i18n-en="Logistics Support:" data-i18n-de="Logistik-Hotline:">Logistics Support:</span> +49 (0) 89 2109 4410 • dispatch@mehaaj.de
                </p>
            </div>

            <!-- Packing Slip Meta -->
            <div class="text-right w-full sm:w-auto">
                <div class="inline-block bg-[#F8F5EF] p-4 rounded-xl border border-stone-300 text-right space-y-1 min-w-[210px]">
                    <span class="block text-xs font-black tracking-widest text-stone-800 uppercase" data-i18n-en="PACKING SLIP / DISPATCH NOTE" data-i18n-de="LIEFERSCHEIN">PACKING SLIP / DISPATCH NOTE</span>
                    <p class="text-base font-mono-luxury font-black text-[#964B42] leading-tight">
                        LS-{{ $order->order_number }}
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Order Ref:" data-i18n-de="Bestell-Nr.:">Order Ref:</span> <strong class="text-stone-800">{{ $order->order_number }}</strong>
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Dispatch Date:" data-i18n-de="Versanddatum:">Dispatch Date:</span> <strong class="text-stone-800">{{ date('d.m.Y') }}</strong>
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        <span data-i18n-en="Carrier:" data-i18n-de="Versandart:">Carrier:</span> <strong class="text-stone-800">DHL Express Climate-Neutral</strong>
                    </p>
                </div>
            </div>

        </div>

        <!-- Consignee Address Box & Packaging Instructions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 py-7 border-b border-stone-200">
            
            <!-- Recipient Shipping Address -->
            <div>
                <p class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-400 mb-1" data-i18n-en="CONSIGNEE / SHIP TO:" data-i18n-de="EMPFÄNGER & LIEFERADRESSE:">
                    CONSIGNEE / SHIP TO:
                </p>
                <div class="text-xs space-y-0.5 text-stone-800 font-medium">
                    <p class="font-bold text-sm text-stone-900">{{ $order->customer_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->postal_code }} {{ $order->city }}</p>
                    <p class="font-bold uppercase tracking-wider text-stone-700">{{ $order->country ?? 'Deutschland' }}</p>
                    <div class="pt-2 text-[0.68rem] text-stone-500">
                        <span data-i18n-en="Courier Contact:" data-i18n-de="Tel für Kurier:">Courier Contact:</span> {{ $order->customer_phone ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <!-- Signature Presentation Packing Checklist -->
            <div class="bg-amber-50/50 p-4 rounded-xl border border-amber-200 text-xs space-y-2">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-amber-900 block" data-i18n-en="QUALITY ASSURANCE & ATELIER PACKAGING:" data-i18n-de="ATELIER-VERPACKUNGSRICHTLINIEN:">
                    QUALITY ASSURANCE & ATELIER PACKAGING:
                </span>
                <ul class="text-[0.68rem] text-amber-950 space-y-1">
                    <li class="flex items-center gap-1.5">
                        <span class="text-amber-700">✓</span> <span data-i18n-en="White-glove inspection & fabric examination" data-i18n-de="Weiße Stoffhandschuhe bei der Qualitätskontrolle">White-glove inspection & fabric examination</span>
                    </li>
                    <li class="flex items-center gap-1.5">
                        <span class="text-amber-700">✓</span> <span data-i18n-en="Signature silk tissue wrapping with embossed seal" data-i18n-de="Signature Seidenpapier mit MEHAAJ Prägesiegel">Signature silk tissue wrapping with embossed seal</span>
                    </li>
                    <li class="flex items-center gap-1.5">
                        <span class="text-amber-700">✓</span> <span data-i18n-en="Satin ribbon & Certificate of Authenticity enclosed" data-i18n-de="Satinschleife & Echtheits-Zertifikat beigelegt">Satin ribbon & Certificate of Authenticity enclosed</span>
                    </li>
                    <li class="flex items-center gap-1.5">
                        <span class="text-amber-700">✓</span> <span data-i18n-en="Luxury atelier garment dust bag included" data-i18n-de="Luxus-Staubbeutel für jedes Kleidungsstück">Luxury atelier garment dust bag included</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Warehouse Items Checklist Table -->
        <div class="py-6">
            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-900 mb-2" data-i18n-en="DISPATCH CHECKLIST & GOODS LIST:" data-i18n-de="PACKLISTE & WARENVERZEICHNIS:">
                DISPATCH CHECKLIST & GOODS LIST:
            </h3>

            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b-2 border-stone-900 text-[0.65rem] font-black uppercase tracking-wider text-stone-800 bg-stone-50">
                        <th class="py-2.5 px-3 w-14 text-center">CHECK</th>
                        <th class="py-2.5 px-2" data-i18n-en="ITEM / DESCRIPTION" data-i18n-de="ARTIKEL / BESCHREIBUNG">ITEM / DESCRIPTION</th>
                        <th class="py-2.5 px-2 w-32 text-center">SKU</th>
                        <th class="py-2.5 px-2 w-20 text-center" data-i18n-en="ORDERED" data-i18n-de="BESTELLT">ORDERED</th>
                        <th class="py-2.5 px-3 w-24 text-center" data-i18n-en="PACKED" data-i18n-de="GEPACKT">PACKED</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @foreach($order->items as $idx => $item)
                        <tr class="hover:bg-stone-50/50">
                            <td class="py-3 px-3 text-center">
                                <div class="w-5 h-5 mx-auto rounded border-2 border-stone-400 flex items-center justify-center font-bold text-xs text-stone-400">
                                </div>
                            </td>
                            <td class="py-3 px-2">
                                <p class="font-bold text-stone-900 text-xs">{{ $item->product_name }}</p>
                                <p class="text-[0.65rem] text-stone-500" data-i18n-en="Haute Couture Atelier Garment" data-i18n-de="Haute Couture Atelier Gewand">Haute Couture Atelier Garment</p>
                            </td>
                            <td class="py-3 px-2 text-center font-mono-luxury text-[0.68rem] text-stone-600 font-bold">
                                {{ $item->product?->sku ?? 'MHJ-' . $item->id }}
                            </td>
                            <td class="py-3 px-2 text-center font-bold text-sm text-stone-900">
                                {{ $item->quantity }}
                            </td>
                            <td class="py-3 px-3 text-center font-mono-luxury text-stone-400">
                                [ &nbsp; {{ $item->quantity }} &nbsp; ]
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Inspector Sign-off Block -->
        <div class="mt-8 pt-6 border-t-2 border-stone-900 grid grid-cols-1 sm:grid-cols-2 gap-8 text-xs">
            <div>
                <p class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-500 mb-6" data-i18n-en="QUALITY CHECKED & PACKED BY:" data-i18n-de="QUALITÄTSPRÜFUNG & GEPACKT DURCH:">
                    QUALITY CHECKED & PACKED BY:
                </p>
                <div class="border-b border-stone-400 pb-1 flex justify-between text-stone-600 font-mono-luxury text-[0.7rem]">
                    <span data-i18n-en="Signature: _________________________" data-i18n-de="Unterschrift: _________________________">Signature: _________________________</span>
                </div>
            </div>

            <div>
                <p class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-500 mb-6" data-i18n-en="DATE & DISPATCH STAMP:" data-i18n-de="DATUM & WARENAUSGANGSSTEMPEL:">
                    DATE & DISPATCH STAMP:
                </p>
                <div class="border-b border-stone-400 pb-1 flex justify-between text-stone-600 font-mono-luxury text-[0.7rem]">
                    <span data-i18n-en="Stamp: MEHAAJ Atelier Logistics" data-i18n-de="Stempel: MEHAAJ Atelier Logistik">Stamp: MEHAAJ Atelier Logistics</span>
                    <span><span data-i18n-en="Date:" data-i18n-de="Datum:">Date:</span> {{ date('d.m.Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 pt-6 border-t border-stone-200 text-[0.62rem] text-stone-500 leading-relaxed text-center">
            <p data-i18n-en="Official dispatch note of MEHAAJ Luxury Atelier Logistics. In case of damaged or incomplete shipments, contact dispatch@mehaaj.de." data-i18n-de="Dies ist ein offizieller Lieferschein der MEHAAJ Luxury Atelier Logistik. Bei Unvollständigkeit oder Transportschäden bitte sofort an dispatch@mehaaj.de melden.">
                Official dispatch note of MEHAAJ Luxury Atelier Logistics. In case of damaged or incomplete shipments, contact dispatch@mehaaj.de.
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
