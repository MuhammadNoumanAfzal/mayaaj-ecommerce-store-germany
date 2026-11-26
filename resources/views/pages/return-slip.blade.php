<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rücksendeetikett / Return Slip — {{ $returnRequest->return_number }}</title>
    <link rel="icon" type="image/png" href="/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Libre+Barcode+128+Text&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm 12mm 15mm;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f5f3ef;
            color: #1c1917;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .barcode-font {
            font-family: 'Libre Barcode 128 Text', cursive;
            font-size: 3rem;
            line-height: 1;
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
        }
    </style>
</head>
<body class="min-h-screen py-0 sm:py-8 flex flex-col items-center">

    <!-- Top Floating Toolbar -->
    <div class="screen-toolbar w-full max-w-4xl px-4 py-3 mb-4 flex items-center justify-between bg-stone-900/90 backdrop-blur-md rounded-2xl text-white shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('returns.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                <span>Zurück zum Retourenportal</span>
            </a>
            <span class="text-stone-400 text-xs hidden sm:inline">• RMA Rücksendebeleg</span>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-xl bg-gradient-to-r from-[#964B42] to-[#b35e53] hover:brightness-110 text-white text-xs font-bold transition shadow-md cursor-pointer">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                <span>Rücksendebeleg Drucken (Strg+P)</span>
            </button>
        </div>
    </div>

    <!-- Official A4 Printable Return Slip (Rücksendeetikett) -->
    <div class="slip-sheet w-full max-w-[210mm] bg-white rounded-none sm:rounded-2xl p-8 sm:p-12 text-stone-900 border border-stone-200/80 relative space-y-8">
        
        <!-- Header: Brand Logo & Title -->
        <div class="flex flex-col sm:flex-row justify-between items-start pb-6 border-b-2 border-stone-900 gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <img src="/logo.png" alt="MEHAAJ Logo" class="h-12 w-auto object-contain">
                    <div>
                        <div class="font-serif-luxury text-2xl font-bold tracking-wider text-stone-900 uppercase leading-none">
                            MEHAAJ <span class="text-[#964B42]">ATELIER</span>
                        </div>
                        <p class="text-[0.62rem] font-bold tracking-[0.25em] text-[#964B42] uppercase mt-1">
                            OFFIZIELLER RÜCKSENDEBELEG (RMA RETURN SLIP)
                        </p>
                    </div>
                </div>
            </div>

            <!-- RMA Details Pill -->
            <div class="text-right">
                <div class="inline-block bg-[#F8F5EF] p-3.5 rounded-xl border border-stone-300 text-right space-y-0.5 min-w-[220px]">
                    <span class="block text-[0.65rem] font-black tracking-widest text-[#964B42] uppercase">RMA-NUMMER</span>
                    <p class="text-lg font-mono-luxury font-black text-stone-900 leading-tight">
                        {{ $returnRequest->return_number }}
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        Bestellnummer: <strong class="text-stone-800">#{{ $returnRequest->order->order_number }}</strong>
                    </p>
                    <p class="text-[0.68rem] text-stone-500 font-medium">
                        Datum: <strong class="text-stone-800">{{ $returnRequest->created_at->format('d.m.Y H:i') }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- RMA Barcode Section (Scannable at Logistics Centre) -->
        <div class="bg-stone-50 p-6 rounded-xl border border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
            <div>
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#964B42] block">Logistik-Scan-Barcode (RMA-ID)</span>
                <span class="font-mono font-bold text-sm text-stone-800">*{{ $returnRequest->return_number }}*</span>
                <p class="text-xs text-stone-500 mt-1">
                    Bei Wareneingang in unserem Atelier wird dieser Barcode gescannt, um die Rückerstattung sofort freizugeben.
                </p>
            </div>
            
            <!-- Visual Barcode Graphic -->
            <div class="barcode-font text-stone-900 px-4 py-1 bg-white border border-stone-300 rounded shadow-xs select-none">
                {{ $returnRequest->return_number }}
            </div>
        </div>

        <!-- Address Section: Absender (Customer) vs Empfänger (Atelier Retourenzentrum) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <!-- Absender / Customer -->
            <div class="p-4 rounded-xl border border-stone-200 bg-white space-y-1 text-xs">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-400 block mb-2">ABSENDER (KUNDE)</span>
                <p class="font-bold text-stone-900 text-sm">{{ $returnRequest->customer_name }}</p>
                <p class="text-stone-700">{{ $returnRequest->order->shipping_address }}</p>
                <p class="text-stone-700">{{ $returnRequest->order->postal_code }} {{ $returnRequest->order->city }}</p>
                <p class="text-stone-700 font-semibold">{{ $returnRequest->order->country ?? 'Deutschland' }}</p>
                <p class="text-stone-500 pt-2 text-[0.68rem]">E-Mail: {{ $returnRequest->customer_email }}</p>
            </div>

            <!-- Empfänger / Atelier Logistics Return Destination -->
            <div class="p-4 rounded-xl border-2 border-stone-900 bg-[#FBF6F4] space-y-1 text-xs">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#964B42] block mb-2">EMPFÄNGER (RETOURENZENTRUM)</span>
                <p class="font-extrabold text-stone-900 text-sm">MEHAAJ Atelier & Logistikzentrum</p>
                <p class="text-stone-800">Abteilung: Retourenmanagement & RMA</p>
                <p class="text-stone-800">Goethestraße 42</p>
                <p class="text-stone-900 font-bold">D-60313 Frankfurt am Main</p>
                <p class="text-stone-900 font-bold uppercase">Deutschland (Germany)</p>
            </div>

        </div>

        <!-- Returned Items Itemized List -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-900 mb-3">
                Retournierte Positionen & Artikel
            </h3>
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b-2 border-stone-900 text-[0.65rem] font-black uppercase tracking-wider text-stone-800">
                        <th class="py-2.5 w-10 text-center">POS</th>
                        <th class="py-2.5">ARTIKEL / BESCHREIBUNG</th>
                        <th class="py-2.5 w-20 text-center">MENGE</th>
                        <th class="py-2.5 w-28 text-right">EINZELPREIS</th>
                        <th class="py-2.5 w-28 text-right">BETRAG</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @foreach($returnRequest->items as $idx => $it)
                        <tr>
                            <td class="py-3 text-center text-stone-400 font-mono-luxury font-bold">
                                {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-3 pr-4">
                                <p class="font-bold text-stone-900">{{ $it->product->name ?? 'Atelier Creation' }}</p>
                                <p class="text-[0.65rem] text-stone-500">Grund: {{ $returnRequest->reason_label }}</p>
                            </td>
                            <td class="py-3 text-center font-bold text-stone-800">
                                {{ $it->quantity }}x
                            </td>
                            <td class="py-3 text-right font-mono-luxury font-semibold text-stone-700">
                                €{{ number_format($it->unit_price, 2, ',', '.') }}
                            </td>
                            <td class="py-3 text-right font-mono-luxury font-bold text-stone-900">
                                €{{ number_format($it->total_price, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-stone-900">
                        <td colspan="4" class="py-3 text-right font-bold text-xs uppercase text-stone-700">
                            Zu erstattender Gesamtbetrag:
                        </td>
                        <td class="py-3 text-right font-mono-luxury font-black text-sm text-[#964B42]">
                            €{{ number_format($returnRequest->refund_amount, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($returnRequest->customer_notes)
            <div class="bg-stone-50 p-4 rounded-xl border border-stone-200 text-xs">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-stone-500 block mb-1">KUNDENNOTIZ:</span>
                <p class="text-stone-800 italic">"{{ $returnRequest->customer_notes }}"</p>
            </div>
        @endif

        <!-- Instructions for the Customer -->
        <div class="rounded-xl border border-dashed border-stone-300 p-5 bg-stone-50/50 space-y-3">
            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 flex items-center gap-2">
                <span>📦</span>
                <span>Anleitung zur Rücksendung in 3 einfachen Schritten</span>
            </h4>
            <ol class="list-decimal list-inside text-xs text-stone-600 space-y-1.5 leading-relaxed">
                <li><strong>Ware sicher einpacken:</strong> Bitte legen Sie den ungetragenen Artikel in der Originalverpackung (inkl. Schutzhülle und Etiketten) in das Paket.</li>
                <li><strong>Rücksendebeleg beilegen:</strong> Legen Sie diesen ausgedruckten Beleg mit in das Rücksendepaket.</li>
                <li><strong>Paket aufgeben:</strong> Bringen Sie das Paket zu einer beliebigen DHL- oder Hermes-Filiale und adressieren Sie es an unser Retourenzentrum in Frankfurt am Main.</li>
            </ol>
            <p class="text-[0.68rem] text-stone-500 pt-1">
                Nach Eingang und kurzer Qualitätsprüfung in unserem Atelier wird die Rückerstattung unverzüglich auf Ihre ursprüngliche Zahlungsart veranlasst.
            </p>
        </div>

        <!-- Footer -->
        <div class="pt-6 border-t border-stone-200 text-center text-[0.62rem] text-stone-400 space-y-0.5">
            <p>MEHAAJ E-Commerce GmbH • USt-IdNr.: DE 328 991 421 • Retourenabteilung Frankfurt am Main</p>
            <p>Kundenservice & Fragen zum Widerruf: widerruf@mehaaj.de • Tel: +49 (0) 89 2109 4400</p>
        </div>

    </div>

</body>
</html>
