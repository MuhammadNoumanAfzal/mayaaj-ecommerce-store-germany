@extends('layouts.admin')
@section('title', 'Balance Sheet (Bilanz) — MEHAAJ Atelier')

@section('admin-styles')
<style>
@media print {
    .screen-only {
        display: none !important;
    }
    .print-only {
        display: block !important;
    }
    body {
        background: #ffffff !important;
        color: #1c1917 !important;
    }
    .bg-white {
        background: #ffffff !important;
    }
    .border-stone-200 {
        border-color: #e7e5e4 !important;
    }
    .shadow-sm, .shadow-md, .shadow-2xs {
        box-shadow: none !important;
    }
    .page-break-avoid {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
}
@media screen {
    .print-only {
        display: none !important;
    }
}
</style>
@endsection

@section('admin-content')
<div class="space-y-6 max-w-full overflow-hidden">

    <!-- Official Printable Document Header (Company Logo & Letterhead) -->
    <div class="print-only mb-6 pb-4 border-b-2 border-stone-900">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <img src="/logo.png" alt="MEHAAJ Logo" class="h-16 w-auto object-contain">
                <div>
                    <h1 class="font-serif text-2xl font-black tracking-wider text-stone-900 uppercase">MEHAAJ LUXURY ATELIER</h1>
                    <p class="text-[9pt] text-stone-600 font-medium">MEHAAJ Handelsgesellschaft mbH • Goetheplatz 7, 60313 Frankfurt am Main</p>
                    <p class="text-[8pt] text-stone-500">USt-IdNr.: DE 349 881 294 • HRB 128492 Amtsgericht Frankfurt am Main • atelier@mehaaj.com</p>
                </div>
            </div>
            <div class="text-right">
                <span class="inline-block px-2.5 py-1 text-[8pt] font-black uppercase tracking-wider bg-stone-900 text-white rounded">CONFIDENTIAL • BALANCE SHEET</span>
                <p class="text-xs font-mono font-bold text-stone-800 mt-1.5">DOC REF: BIL-{{ $asOfDate->format('Ymd') }}-{{ strtoupper(substr(md5($asOfDate->timestamp), 0, 4)) }}</p>
                <p class="text-[8.5pt] text-stone-600 font-medium mt-0.5">As of: {{ $asOfDate->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mt-4 pt-3 border-t border-stone-200 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-serif font-black text-stone-900 uppercase">Official Balance Sheet (Bilanz nach HGB § 266)</h2>
                <p class="text-xs text-stone-600 font-medium">Accounting Framework: German Commercial Code (HGB) / Dual-Entry Statement of Financial Position</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-2 py-0.5 rounded text-[8pt] font-extrabold uppercase {{ $isBalanced ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300' }}">
                    {{ $isBalanced ? 'BALANCED: AKTIVA = PASSIVA' : 'UNBALANCED: ACTION REQUIRED' }}
                </span>
                <p class="text-[8pt] text-stone-500 mt-0.5">Total: €{{ number_format($totalAssets, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Executive Header Banner (Pink-Salt Terracotta Theme) -->
    <div class="screen-only rounded-2xl p-5 sm:p-7 bg-gradient-to-r from-[#964B42] via-[#853E36] to-[#6d3029] shadow-sm text-white relative overflow-hidden">
        <!-- Luxury ambient watermark -->
        <div class="absolute -right-8 -bottom-10 opacity-10 pointer-events-none">
            <svg class="w-64 h-64 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v18M3 9l9-6 9 6M3 9l9 6 9-6M3 9v6l9 6 9-6V9"/></svg>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M3 9l9-6 9 6M3 9l9 6 9-6M3 9v6l9 6 9-6V9"/></svg>
                    <span data-i18n-en="STATEMENT OF FINANCIAL POSITION" data-i18n-de="BILANZ & VERMÖGENSAUFSTELLUNG">STATEMENT OF FINANCIAL POSITION</span>
                </div>
                <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Executive Balance Sheet (Bilanz)" data-i18n-de="Executive Bilanz nach HGB">
                    Executive Balance Sheet (Bilanz)
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl leading-relaxed" data-i18n-en="Statement of atelier assets, liabilities, and owner equity as of reporting date according to standard accounting principles." data-i18n-de="Gegenüberstellung von Vermögen (Aktiva), Fremdkapital (Verbindlichkeiten) und Eigenkapital (Passiva).">
                    Statement of atelier assets, liabilities, and owner equity as of reporting date according to standard accounting principles.
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs text-rose-200">
                    <span class="inline-block w-2 h-2 rounded-full {{ $isBalanced ? 'bg-emerald-400' : 'bg-amber-400' }}"></span>
                    <span class="font-bold text-white">As of: {{ $asOfDate->format('d M Y') }}</span>
                    <span>• Fundamental Identity: Assets = Liabilities + Equity</span>
                </div>
            </div>

            <!-- Top Action Controls -->
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('admin.finance.profit-loss') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/20 px-3.5 py-2.5 text-xs font-bold transition shadow-xs">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <span data-i18n-en="Profit & Loss" data-i18n-de="Zur GuV">Profit & Loss</span>
                </a>

                <a href="{{ route('admin.finance.expenses') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/20 px-3.5 py-2.5 text-xs font-bold transition shadow-xs">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span data-i18n-en="Expenses" data-i18n-de="Ausgaben">Expenses</span>
                </a>

                <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-xl bg-white text-[#964B42] hover:bg-rose-50 px-4 py-2.5 text-xs font-bold uppercase tracking-wider transition shadow-md cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span data-i18n-en="Print Bilanz" data-i18n-de="Drucken / PDF">Print Bilanz</span>
                </button>
            </div>
        </div>

        <!-- As Of Date Filter Form -->
        <div class="mt-6 pt-4 border-t border-white/20 flex flex-wrap items-center justify-between gap-3 text-xs">
            <form action="{{ route('admin.finance.balance-sheet') }}" method="GET" class="flex items-center gap-2">
                <label class="font-bold text-rose-100 uppercase tracking-wider text-[0.68rem]" data-i18n-en="Reporting Date:" data-i18n-de="Stichtag:">Reporting Date:</label>
                <input type="date" name="as_of_date" value="{{ $asOfDate->format('Y-m-d') }}" class="px-3 py-1.5 rounded-xl bg-white text-stone-900 text-xs font-semibold border-none shadow-sm">
                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-stone-900 font-bold transition shadow-xs" data-i18n-en="Update Statement" data-i18n-de="Bilanz Aktualisieren">
                    Update Statement
                </button>
            </form>

            <!-- Verification Status Pill -->
            <div class="flex items-center gap-2">
                @if($isBalanced)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-200 border border-emerald-400/40 text-xs font-bold" data-i18n-en="100% PERFECTLY BALANCED (HGB VERIFIED)" data-i18n-de="100% AUSGEGLICHEN (HGB KONFORM)">
                        <svg class="w-3.5 h-3.5 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>100% PERFECTLY BALANCED (HGB VERIFIED)</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-200 border border-amber-400/40 text-xs font-bold" data-i18n-en="VARIANCE MONITORED" data-i18n-de="DIFFERENZ WIRD ÜBERWACHT">
                        <span>VARIANCE MONITORED</span>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Executive Accounting Equation Banner (Visual Proof of Balance) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-5 shadow-xs">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center items-center divide-y md:divide-y-0 md:divide-x divide-stone-200">
            
            <!-- 1. Total Assets -->
            <div class="p-2">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400 block" data-i18n-en="TOTAL ASSETS (AKTIVA)" data-i18n-de="GESAMTAKTIWA (VERMÖGEN)">TOTAL ASSETS (AKTIVA)</span>
                <span class="text-2xl sm:text-3xl font-serif font-black text-blue-900 block mt-1">
                    €{{ number_format($totalAssets, 2) }}
                </span>
                <span class="text-[0.65rem] text-stone-500 font-medium">Resources Owned by Atelier</span>
            </div>

            <!-- Equal Sign & Liabilities -->
            <div class="p-2">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400 block" data-i18n-en="TOTAL LIABILITIES (FREMDKAPITAL)" data-i18n-de="VERBINDLICHKEITEN (SCHULDEN)">TOTAL LIABILITIES (FREMDKAPITAL)</span>
                <span class="text-2xl sm:text-3xl font-serif font-black text-rose-900 block mt-1">
                    €{{ number_format($totalLiabilities, 2) }}
                </span>
                <span class="text-[0.65rem] text-stone-500 font-medium">Obligations to Suppliers & Lenders</span>
            </div>

            <!-- Plus Equity -->
            <div class="p-2">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400 block" data-i18n-en="TOTAL OWNER'S EQUITY (EIGENKAPITAL)" data-i18n-de="EIGENKAPITAL (NETTOVERMÖGEN)">TOTAL OWNER'S EQUITY (EIGENKAPITAL)</span>
                <span class="text-2xl sm:text-3xl font-serif font-black text-emerald-900 block mt-1">
                    €{{ number_format($totalEquity, 2) }}
                </span>
                <span class="text-[0.65rem] text-stone-500 font-medium">Net Atelier Worth & Retained Profits</span>
            </div>
        </div>
    </div>

    <!-- Classical Two-Column Balance Sheet (Aktiva on Left, Passiva on Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        
        <!-- ================= LEFT COLUMN: ASSETS (AKTIVA) ================= -->
        <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
            
            <div class="p-4 sm:p-5 bg-blue-50/40 border-b border-[#E5DED5] flex items-center justify-between">
                <div>
                    <h2 class="font-serif font-bold text-base text-blue-950 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-md bg-blue-700 text-white flex items-center justify-center text-xs font-sans">A</span>
                        <span data-i18n-en="AKTIVA — ASSETS" data-i18n-de="AKTIVA — VERMÖGENSWERTE">AKTIVA — ASSETS</span>
                    </h2>
                    <p class="text-xs text-blue-700">What MEHAAJ Atelier owns and controls</p>
                </div>
                <span class="text-xs font-mono font-black text-blue-900 px-2.5 py-1 rounded-full bg-blue-100">
                    €{{ number_format($totalAssets, 2) }}
                </span>
            </div>

            <div class="p-4 sm:p-6 space-y-6 text-xs">
                
                <!-- A.1 Current Assets (Umlaufvermögen) -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-stone-200">
                        <span class="font-bold text-xs uppercase tracking-wider text-stone-800">
                            I. CURRENT ASSETS (UMLAUFVERMÖGEN)
                        </span>
                        <span class="font-mono font-bold text-stone-900">
                            €{{ number_format($totalCurrentAssets, 2) }}
                        </span>
                    </div>

                    <div class="space-y-2 pl-3 border-l-2 border-blue-200 font-sans">
                        
                        <!-- Liquid Cash & Bank -->
                        <div class="flex items-center justify-between py-1 group">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">1. Cash & Bank Balances (Flüssige Mittel)</p>
                                <p class="text-[0.65rem] text-stone-400">Deutsche Bank Commercial + Atelier Showroom Vault</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($totalLiquidCash, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('cash_bank', 'Commercial Bank Account', {{ $cashInBank }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Balance">Edit</button>
                            </div>
                        </div>

                        <!-- Trade Accounts Receivable -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">2. Accounts Receivable (Forderungen aus Lieferungen)</p>
                                <p class="text-[0.65rem] text-stone-400">Pending customer orders awaiting wire transfer clearance</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($accountsReceivable, 2) }}</span>
                            </div>
                        </div>

                        <!-- Merchandise Inventory Asset Value -->
                        <div class="flex items-center justify-between py-1 bg-amber-50/40 p-2 rounded-xl border border-amber-200/60">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-amber-950">3. Merchandise Inventory Valuation (Warenvorrat)</p>
                                <p class="text-[0.65rem] text-amber-800">{{ $totalStockUnits }} Luxury Garments in Stock evaluated at Cost Price</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono font-black text-amber-900">€{{ number_format($inventoryValuation, 2) }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- A.2 Non-Current Assets (Anlagevermögen) -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between pb-2 border-b border-stone-200">
                        <span class="font-bold text-xs uppercase tracking-wider text-stone-800">
                            II. NON-CURRENT ASSETS (ANLAGEVERMÖGEN)
                        </span>
                        <span class="font-mono font-bold text-stone-900">
                            €{{ number_format($totalNonCurrentAssets, 2) }}
                        </span>
                    </div>

                    <div class="space-y-2 pl-3 border-l-2 border-indigo-200 font-sans">
                        
                        <!-- Machinery & Equipment -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">1. Precision Machinery & Equipment (Maschinen)</p>
                                <p class="text-[0.65rem] text-stone-400">Swiss & Japanese embroidery, stitching and finishing machinery</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($machineryEquipment, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('machinery_equipment', 'Machinery & Equipment Valuation', {{ $machineryEquipment }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Valuation">Edit</button>
                            </div>
                        </div>

                        <!-- Showroom Architecture & Fixtures -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">2. Showroom Fixtures & Fittings (Geschäftsausstattung)</p>
                                <p class="text-[0.65rem] text-stone-400">Boutique architecture, brass racks, mirrors and marble displays</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($showroomFixtures, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('showroom_fixtures', 'Showroom Fixtures Valuation', {{ $showroomFixtures }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Valuation">Edit</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TOTAL ASSETS FOOTER -->
                <div class="pt-4 border-t-2 border-blue-400 flex items-center justify-between text-sm font-bold bg-blue-50/30 p-3 rounded-xl">
                    <span class="font-serif text-blue-950 uppercase tracking-wider">TOTAL ASSETS (SUMME AKTIVA)</span>
                    <span class="font-mono text-base font-black text-blue-950">€{{ number_format($totalAssets, 2) }}</span>
                </div>

            </div>
        </div>

        <!-- ================= RIGHT COLUMN: LIABILITIES & EQUITY (PASSIVA) ================= -->
        <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
            
            <div class="p-4 sm:p-5 bg-rose-50/40 border-b border-[#E5DED5] flex items-center justify-between">
                <div>
                    <h2 class="font-serif font-bold text-base text-rose-950 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-md bg-rose-700 text-white flex items-center justify-center text-xs font-sans">P</span>
                        <span data-i18n-en="PASSIVA — LIABILITIES & EQUITY" data-i18n-de="PASSIVA — VERBINDLICHKEITEN & EIGENKAPITAL">PASSIVA — LIABILITIES & EQUITY</span>
                    </h2>
                    <p class="text-xs text-rose-700">What MEHAAJ Atelier owes to third parties and partners</p>
                </div>
                <span class="text-xs font-mono font-black text-rose-900 px-2.5 py-1 rounded-full bg-rose-100">
                    €{{ number_format($totalLiabilitiesAndEquity, 2) }}
                </span>
            </div>

            <div class="p-4 sm:p-6 space-y-6 text-xs">
                
                <!-- P.1 Current Liabilities (Kurzfristiges Fremdkapital) -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-stone-200">
                        <span class="font-bold text-xs uppercase tracking-wider text-stone-800">
                            I. CURRENT LIABILITIES (KURZFRISTIGE VERBINDLICHKEITEN)
                        </span>
                        <span class="font-mono font-bold text-stone-900">
                            €{{ number_format($totalCurrentLiabilities, 2) }}
                        </span>
                    </div>

                    <div class="space-y-2 pl-3 border-l-2 border-rose-200 font-sans">
                        
                        <!-- Trade Payables -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">1. Trade Accounts Payable (Lieferantenverbindlichkeiten)</p>
                                <p class="text-[0.65rem] text-stone-400">Outstanding textile mill and luxury raw material supplier invoices</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($accountsPayable, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('accounts_payable', 'Trade Payables Balance', {{ $accountsPayable }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Payables">Edit</button>
                            </div>
                        </div>

                        <!-- VAT Payable (Umsatzsteuer) -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">2. Sales Tax / VAT Payable (Umsatzsteuer 19%)</p>
                                <p class="text-[0.65rem] text-stone-400">German MwSt collected on customer sales to remit to Finanzamt</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($vatPayable, 2) }}</span>
                            </div>
                        </div>

                        <!-- Customer Deposits & Pre-orders -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">3. Customer Pre-Orders (Erhaltene Anzahlungen)</p>
                                <p class="text-[0.65rem] text-stone-400">Unfulfilled bespoke orders paid by client</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($customerPreorders, 2) }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- P.2 Long-Term Liabilities (Langfristige Verbindlichkeiten) -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between pb-2 border-b border-stone-200">
                        <span class="font-bold text-xs uppercase tracking-wider text-stone-800">
                            II. LONG-TERM LIABILITIES (LANGFRISTIGE VERBINDLICHKEITEN)
                        </span>
                        <span class="font-mono font-bold text-stone-900">
                            €{{ number_format($totalLongTermLiabilities, 2) }}
                        </span>
                    </div>

                    <div class="space-y-2 pl-3 border-l-2 border-amber-200 font-sans">
                        
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">1. Commercial Credit & Bank Facility (Bankdarlehen)</p>
                                <p class="text-[0.65rem] text-stone-400">KfW Atelier Expansion & Modernization Facility</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($commercialCredit, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('commercial_credit', 'Commercial Credit Facility', {{ $commercialCredit }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Debt">Edit</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- P.3 Owner's Equity (Eigenkapital) -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between pb-2 border-b border-stone-200">
                        <span class="font-bold text-xs uppercase tracking-wider text-emerald-800">
                            III. OWNER'S EQUITY (EIGENKAPITAL)
                        </span>
                        <span class="font-mono font-bold text-emerald-900">
                            €{{ number_format($totalEquity, 2) }}
                        </span>
                    </div>

                    <div class="space-y-2 pl-3 border-l-2 border-emerald-300 font-sans">
                        
                        <!-- Initial Capital -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">1. Founding Partner Capital (Gezeichnetes Kapital)</p>
                                <p class="text-[0.65rem] text-stone-400">Initial paid-in equity committed to the brand</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="font-mono font-bold text-stone-900">€{{ number_format($initialEquityCapital, 2) }}</span>
                                <button type="button" onclick="openEditAccountModal('owner_capital', 'Paid-In Equity Capital', {{ $initialEquityCapital }})" class="text-stone-400 hover:text-[#964B42] text-[0.65rem] underline cursor-pointer" title="Adjust Capital">Edit</button>
                            </div>
                        </div>

                        <!-- Retained Earnings -->
                        <div class="flex items-center justify-between py-1">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-800">2. Retained Earnings (Gewinnrücklagen / Bilanzgewinn)</p>
                                <p class="text-[0.65rem] text-stone-400">Cumulative net earnings reinvested into the atelier</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono font-bold {{ $accumulatedNetEarnings >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                                    €{{ number_format($accumulatedNetEarnings, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Balancing Reserve -->
                        @if(abs($balancingReserve) > 0)
                        <div class="flex items-center justify-between py-1 bg-stone-50 p-2 rounded-xl">
                            <div class="min-w-0 pr-2">
                                <p class="font-semibold text-stone-700">3. Statutory Balancing Reserve (Ausgleichsrücklage)</p>
                                <p class="text-[0.65rem] text-stone-400">Accounting adjustment maintaining dual-entry identity</p>
                            </div>
                            <div class="shrink-0">
                                <span class="font-mono text-stone-700">€{{ number_format($balancingReserve, 2) }}</span>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <!-- TOTAL LIABILITIES & EQUITY FOOTER -->
                <div class="pt-4 border-t-2 border-rose-400 flex items-center justify-between text-sm font-bold bg-rose-50/30 p-3 rounded-xl">
                    <span class="font-serif text-rose-950 uppercase tracking-wider">TOTAL LIABILITIES & EQUITY (SUMME PASSIVA)</span>
                    <span class="font-mono text-base font-black text-rose-950">€{{ number_format($totalLiabilitiesAndEquity, 2) }}</span>
                </div>

            </div>
        </div>

    </div>

    <!-- Financial Health & Working Capital Ratios Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-5 shadow-xs">
        <h3 class="font-serif font-bold text-base text-stone-900 mb-4" data-i18n-en="Key Liquidity & Financial Solvency Ratios" data-i18n-de="Liquiditäts- und Solvenzkennzahlen">
            Key Liquidity & Financial Solvency Ratios
        </h3>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            
            <!-- Working Capital -->
            <div class="bg-stone-50 rounded-xl p-3.5 border border-stone-200">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 block">Working Capital</span>
                <span class="text-lg font-serif font-black text-stone-900 block mt-1">€{{ number_format($workingCapital, 2) }}</span>
                <span class="text-[0.62rem] text-stone-500">Current Assets minus Current Debt</span>
            </div>

            <!-- Current Ratio -->
            <div class="bg-stone-50 rounded-xl p-3.5 border border-stone-200">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 block">Current Ratio (Liquidität)</span>
                <span class="text-lg font-serif font-black text-emerald-800 block mt-1">{{ $currentRatio }}x</span>
                <span class="text-[0.62rem] text-emerald-700">Target > 1.5x (Safe Buffer)</span>
            </div>

            <!-- Debt to Equity -->
            <div class="bg-stone-50 rounded-xl p-3.5 border border-stone-200">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 block">Debt-to-Equity Ratio</span>
                <span class="text-lg font-serif font-black text-blue-900 block mt-1">{{ $debtToEquityRatio }}%</span>
                <span class="text-[0.62rem] text-stone-500">Gearing / Verschuldungsgrad</span>
            </div>

            <!-- Inventory Asset Share -->
            <div class="bg-stone-50 rounded-xl p-3.5 border border-stone-200">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 block">Inventory / Asset Ratio</span>
                <span class="text-lg font-serif font-black text-amber-900 block mt-1">
                    {{ $totalAssets > 0 ? round(($inventoryValuation / $totalAssets) * 100, 1) : 0 }}%
                </span>
                <span class="text-[0.62rem] text-stone-500">Share of Stock in Total Assets</span>
            </div>

        </div>
    </div>

    <!-- Executive Print Sign-Off Block -->
    <div class="print-only mt-10 pt-6 border-t-2 border-stone-800 page-break-avoid">
        <div class="grid grid-cols-3 gap-6 text-[9pt]">
            <div>
                <p class="font-bold text-stone-700 uppercase tracking-wider text-[8pt]" data-i18n-en="Balance Sheet Prepared By:" data-i18n-de="Bilanz erstellt durch:">Balance Sheet Prepared By:</p>
                <div class="mt-8 border-b border-stone-400 pb-1">
                    <p class="font-bold text-stone-900">{{ auth()->user()->name ?? 'Executive Accounting' }}</p>
                </div>
                <p class="text-[7.5pt] text-stone-500 mt-1" data-i18n-en="Chief Accountant / Controller" data-i18n-de="Hauptbuchhaltung / Bilanzbuchhalter">Chief Accountant / Controller</p>
            </div>

            <div>
                <p class="font-bold text-stone-700 uppercase tracking-wider text-[8pt]" data-i18n-en="Audited & Approved By:" data-i18n-de="Geprüft & Freigegeben durch:">Audited & Approved By:</p>
                <div class="mt-8 border-b border-stone-400 pb-1">
                    <p class="font-serif italic text-stone-900 font-bold">MEHAAJ Geschäftsführung</p>
                </div>
                <p class="text-[7.5pt] text-stone-500 mt-1" data-i18n-en="Managing Director / Authorized Representative" data-i18n-de="Geschäftsführung / Vertretungsberechtigt">Managing Director / Authorized Representative</p>
            </div>

            <div>
                <p class="font-bold text-stone-700 uppercase tracking-wider text-[8pt]" data-i18n-en="Atelier Stamp / Seal:" data-i18n-de="Atelier-Stempel / Siegel:">Atelier Stamp / Seal:</p>
                <div class="mt-2 h-16 border border-dashed border-stone-300 rounded flex items-center justify-center text-stone-400 text-[8pt] uppercase tracking-wider">
                    [ Official Corporate Seal ]
                </div>
            </div>
        </div>
        <p class="mt-4 text-center text-[7.5pt] text-stone-400" data-i18n-en="MEHAAJ Luxury Atelier • Certified Dual-Entry Balance Sheet • Standard Financial Ratio Assessment" data-i18n-de="MEHAAJ Luxury Atelier • Amtliche Bilanzaufstellung nach HGB • Kennzahlenanalyse">MEHAAJ Luxury Atelier • Certified Dual-Entry Balance Sheet • Standard Financial Ratio Assessment</p>
    </div>

</div>

<!-- Edit Balance Account Modal -->
<div id="editAccountModal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-md overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        <div class="p-4 sm:p-5 bg-[#FBF6F4] border-b border-stone-200 flex items-center justify-between">
            <h3 class="font-serif font-bold text-base text-stone-900" id="modalAccountTitle">Adjust Balance Account</h3>
            <button type="button" onclick="closeEditAccountModal()" class="text-stone-400 hover:text-stone-700">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form id="editAccountForm" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" id="editAccountCode" name="code">

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Account Balance (€)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-xs font-bold text-stone-400">€</span>
                    <input type="number" step="0.01" id="editAccountBalance" name="balance" required class="w-full pl-8 pr-3 py-2.5 rounded-xl border border-stone-300 text-xs font-mono font-bold text-stone-900 focus:outline-none focus:border-[#964B42]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Adjustment Notes</label>
                <textarea id="editAccountNotes" name="notes" rows="2" placeholder="Reason for balance update / reconciliation..." class="w-full p-2.5 rounded-xl border border-stone-300 text-xs text-stone-900 focus:outline-none focus:border-[#964B42]"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-stone-200">
                <button type="button" onclick="closeEditAccountModal()" class="px-4 py-2 rounded-xl text-xs font-semibold bg-stone-100 hover:bg-stone-200 text-stone-700 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm">
                    Save Balance
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditAccountModal(code, title, currentBalance) {
        document.getElementById('modalAccountTitle').textContent = `Adjust ${title}`;
        document.getElementById('editAccountCode').value = code;
        document.getElementById('editAccountBalance').value = currentBalance;
        
        const form = document.getElementById('editAccountForm');
        form.action = `/admin/finance/balance-accounts/${code}`;

        document.getElementById('editAccountModal').classList.remove('hidden');
    }

    function closeEditAccountModal() {
        document.getElementById('editAccountModal').classList.add('hidden');
    }
</script>
@endsection
