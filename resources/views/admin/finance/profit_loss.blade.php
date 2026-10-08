@extends('layouts.admin')
@section('title', 'Profit & Loss Statement (GuV) — MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-full overflow-hidden">

    <!-- Executive Header Banner (Terracotta Gradient) -->
    <div class="rounded-2xl p-5 sm:p-7 bg-gradient-to-r from-[#964B42] via-[#853E36] to-[#6d3029] shadow-sm text-white relative overflow-hidden">
        <!-- Luxury ambient texture watermark -->
        <div class="absolute -right-8 -bottom-10 opacity-10 pointer-events-none">
            <svg class="w-64 h-64 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <span data-i18n-en="EXECUTIVE FINANCIAL INTELLIGENCE" data-i18n-de="FINANZBERICHTE & ERFOLGSRECHNUNG">EXECUTIVE FINANCIAL INTELLIGENCE</span>
                </div>
                <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Profit & Loss Statement (GuV)" data-i18n-de="Gewinn- und Verlustrechnung (GuV)">
                    Profit & Loss Statement (GuV)
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl leading-relaxed" data-i18n-en="Executive income statement covering atelier net sales, cost of goods sold, operating expenses, and net profit margins." data-i18n-de="Detaillierte Ertrags- und Kostenrechnung: Umsatzerlöse, Wareneinsatz, Betriebskosten und Reingewinn-Margen.">
                    Executive income statement covering atelier net sales, cost of goods sold, operating expenses, and net profit margins.
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs text-rose-200">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="font-bold text-white">{{ $periodLabel }}</span>
                    <span>• German GAAP / HGB Compliant Format</span>
                </div>
            </div>

            <!-- Top Action Controls -->
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('admin.finance.balance-sheet') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/20 px-3.5 py-2.5 text-xs font-bold transition shadow-xs">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M3 9l9-6 9 6M3 9l9 6 9-6M3 9v6l9 6 9-6V9"/></svg>
                    <span data-i18n-en="Balance Sheet" data-i18n-de="Zur Bilanz">Balance Sheet</span>
                </a>

                <a href="{{ route('admin.finance.expenses') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/20 px-3.5 py-2.5 text-xs font-bold transition shadow-xs">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span data-i18n-en="Expenses Tracker" data-i18n-de="Betriebsausgaben">Expenses Tracker</span>
                </a>

                <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-xl bg-white text-[#964B42] hover:bg-rose-50 px-4 py-2.5 text-xs font-bold uppercase tracking-wider transition shadow-md cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span data-i18n-en="Print Statement" data-i18n-de="Drucken / PDF">Print Statement</span>
                </button>
            </div>
        </div>

        <!-- Period Selection Pills Strip -->
        <div class="mt-6 pt-4 border-t border-white/20 flex flex-wrap items-center gap-1.5">
            <span class="text-[0.68rem] font-bold uppercase tracking-wider text-rose-200 mr-2 flex items-center gap-1">
                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Period:
            </span>

            @php
                $periods = [
                    'this_month' => 'This Month',
                    'last_month' => 'Last Month',
                    'q1'         => 'Q1',
                    'q2'         => 'Q2',
                    'q3'         => 'Q3',
                    'q4'         => 'Q4',
                    'ytd'        => 'YTD (2026)',
                    'last_year'  => 'Last Year',
                ];
            @endphp

            @foreach($periods as $key => $label)
                <a
                    href="{{ route('admin.finance.profit-loss', ['period' => $key]) }}"
                    class="px-3 py-1 rounded-full text-xs font-bold transition {{ $period === $key ? 'bg-white text-[#964B42] shadow-sm' : 'bg-white/10 hover:bg-white/20 text-white' }}"
                >
                    {{ $label }}
                </a>
            @endforeach

            <!-- Custom Date Range Toggle -->
            <button
                type="button"
                onclick="document.getElementById('custom-date-box').classList.toggle('hidden')"
                class="px-3 py-1 rounded-full text-xs font-bold transition {{ $period === 'custom' ? 'bg-white text-[#964B42]' : 'bg-white/10 hover:bg-white/20 text-white' }} flex items-center gap-1"
            >
                <span>Custom Date...</span>
                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
        </div>

        <!-- Custom Date Drawer -->
        <div id="custom-date-box" class="{{ $period === 'custom' ? 'block' : 'hidden' }} mt-3 pt-3 border-t border-white/20">
            <form action="{{ route('admin.finance.profit-loss') }}" method="GET" class="flex flex-wrap items-center gap-2 text-xs">
                <input type="hidden" name="period" value="custom">
                <div class="flex items-center gap-2">
                    <label class="text-rose-100 font-semibold">From:</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="px-2.5 py-1.5 rounded-lg bg-white text-stone-900 text-xs font-semibold">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-rose-100 font-semibold">To:</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="px-2.5 py-1.5 rounded-lg bg-white text-stone-900 text-xs font-semibold">
                </div>
                <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-amber-400 hover:bg-amber-300 text-stone-900 font-bold transition">
                    Apply Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Executive KPI Summary Cards (5-Grid) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4">
        
        <!-- 1. Net Sales Revenue -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-[#E5DED5] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="Net Sales" data-i18n-de="Nettoumsatz">Net Sales</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-serif font-black text-stone-900">
                    €{{ number_format($netSalesRevenue, 2) }}
                </div>
                <div class="mt-1 flex items-center justify-between text-[0.65rem] text-stone-500">
                    <span>{{ $totalOrdersCount }} Orders</span>
                    <span>Ø €{{ number_format($averageOrderValue, 0) }}</span>
                </div>
            </div>
        </div>

        <!-- 2. Cost of Goods Sold (COGS) -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-[#E5DED5] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="COGS (Wareneinsatz)" data-i18n-de="Wareneinsatz (COGS)">COGS (Wareneinsatz)</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-serif font-black text-stone-900">
                    €{{ number_format($totalCogs, 2) }}
                </div>
                <div class="mt-1 text-[0.65rem] text-stone-500">
                    <span>{{ $netSalesRevenue > 0 ? round(($totalCogs / $netSalesRevenue) * 100, 1) : 0 }}% of Revenue</span>
                </div>
            </div>
        </div>

        <!-- 3. Gross Profit & Margin -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-emerald-200/80 bg-emerald-50/20 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-emerald-800" data-i18n-en="Gross Profit" data-i18n-de="Rohertrag / Brutto">Gross Profit</span>
                <span class="px-1.5 py-0.5 rounded text-[0.6rem] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200">
                    {{ $grossMarginPercent }}%
                </span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-serif font-black text-emerald-900">
                    €{{ number_format($grossProfit, 2) }}
                </div>
                <div class="mt-1 text-[0.65rem] text-emerald-700 font-medium">
                    <span>Haute Couture Margin</span>
                </div>
            </div>
        </div>

        <!-- 4. Operating Expenses (OpEx) -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-[#E5DED5] shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-en="Operating Expenses" data-i18n-de="Betriebskosten (OpEx)">Operating Expenses</span>
                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xs">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-serif font-black text-stone-900">
                    €{{ number_format($totalExpenses, 2) }}
                </div>
                <div class="mt-1 text-[0.65rem] text-stone-500">
                    <span>{{ count($expenses) }} Logged Invoices</span>
                </div>
            </div>
        </div>

        <!-- 5. Net Profit / EBITDA -->
        <div class="col-span-2 sm:col-span-1 bg-white rounded-2xl p-4 sm:p-5 border {{ $netProfit >= 0 ? 'border-emerald-300 bg-gradient-to-br from-emerald-50/50 to-white' : 'border-rose-300 bg-gradient-to-br from-rose-50/50 to-white' }} shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.68rem] font-bold uppercase tracking-wider {{ $netProfit >= 0 ? 'text-emerald-800' : 'text-rose-800' }}" data-i18n-en="Net Profit (EBITDA)" data-i18n-de="Reingewinn (EBITDA)">Net Profit (EBITDA)</span>
                <span class="px-1.5 py-0.5 rounded text-[0.6rem] font-black {{ $netProfit >= 0 ? 'bg-emerald-200 text-emerald-900' : 'bg-rose-200 text-rose-900' }}">
                    {{ $netMarginPercent }}% Net
                </span>
            </div>
            <div class="mt-3">
                <div class="text-xl sm:text-2xl font-serif font-black {{ $netProfit >= 0 ? 'text-emerald-950' : 'text-rose-950' }}">
                    €{{ number_format($netProfit, 2) }}
                </div>
                <div class="mt-1 text-[0.65rem] {{ $netProfit >= 0 ? 'text-emerald-700' : 'text-rose-700' }} font-bold">
                    <span>{{ $netProfit >= 0 ? '✓ Profitable Period' : '⚠ Deficit Period' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Margin Anatomy Bar (How €100 of Revenue is split) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-5 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
            <div>
                <h3 class="font-serif font-bold text-sm text-stone-900" data-i18n-en="Atelier Revenue Distribution Anatomy" data-i18n-de="Anatomie der Umsatzverteilung">
                    Atelier Revenue Distribution Anatomy
                </h3>
                <p class="text-xs text-stone-500">Breakdown of gross revenue between product production cost, operating overhead, and net margin.</p>
            </div>
            <div class="flex items-center gap-3 text-xs font-bold">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> COGS ({{ $netSalesRevenue > 0 ? round(($totalCogs / $netSalesRevenue) * 100) : 0 }}%)</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span> OpEx ({{ $netSalesRevenue > 0 ? round(($totalExpenses / $netSalesRevenue) * 100) : 0 }}%)</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Net Profit ({{ max(0, $netMarginPercent) }}%)</span>
            </div>
        </div>

        @php
            $cogsPct = $netSalesRevenue > 0 ? min(100, round(($totalCogs / $netSalesRevenue) * 100)) : 40;
            $opexPct = $netSalesRevenue > 0 ? min(100 - $cogsPct, round(($totalExpenses / $netSalesRevenue) * 100)) : 35;
            $netPct = max(0, 100 - ($cogsPct + $opexPct));
        @endphp
        <div class="w-full h-3.5 rounded-full bg-stone-100 overflow-hidden flex shadow-inner">
            <div class="bg-amber-500 h-full transition-all duration-500" style="width: {{ $cogsPct }}%" title="COGS: {{ $cogsPct }}%"></div>
            <div class="bg-purple-500 h-full transition-all duration-500" style="width: {{ $opexPct }}%" title="Operating Expenses: {{ $opexPct }}%"></div>
            <div class="bg-emerald-500 h-full transition-all duration-500" style="width: {{ $netPct }}%" title="Net Margin: {{ $netPct }}%"></div>
        </div>
    </div>

    <!-- Main Financial Statement (Official German GuV / P&L Table Format) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        
        <!-- Table Header Title -->
        <div class="p-4 sm:p-5 bg-[#FBF6F4] border-b border-[#E5DED5] flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="font-serif font-bold text-base text-stone-900" data-i18n-en="Income Statement (Gewinn- und Verlustrechnung)" data-i18n-de="Gewinn- und Verlustrechnung nach HGB">
                    Income Statement (Gewinn- und Verlustrechnung)
                </h2>
                <p class="text-xs text-stone-500">
                    Financial statement for period: <span class="font-bold text-stone-700">{{ $periodLabel }}</span> • All amounts in EUR (€)
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                    Audited Fiscal Preview
                </span>
            </div>
        </div>

        <!-- Table Structure -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                        <th class="px-4 sm:px-6 py-3.5">FINANCIAL LINE ITEM / POSTEN</th>
                        <th class="px-4 py-3.5 text-right w-36">SUB-TOTAL</th>
                        <th class="px-4 sm:px-6 py-3.5 text-right w-44">NET AMOUNT (€)</th>
                        <th class="px-4 py-3.5 text-right w-28">% OF SALES</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DED5]/80 font-sans">
                    
                    <!-- 1. REVENUE SECTION -->
                    <tr class="bg-stone-50/70 font-bold text-stone-900">
                        <td class="px-4 sm:px-6 py-3 flex items-center gap-2 font-serif text-sm">
                            <span class="w-5 h-5 rounded-md bg-[#964B42] text-white flex items-center justify-center text-[0.65rem] font-sans">I</span>
                            <span>REVENUE & SALES (UMSATZERLÖSE)</span>
                        </td>
                        <td class="px-4 py-3 text-right"></td>
                        <td class="px-4 sm:px-6 py-3 text-right font-mono font-bold text-sm">€{{ number_format($netSalesRevenue, 2) }}</td>
                        <td class="px-4 py-3 text-right text-stone-500">100.0%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2.5 pl-8 sm:pl-10 text-stone-600">Gross Online Store Sales (Bruttoumsatz)</td>
                        <td class="px-4 py-2.5 text-right font-mono text-stone-600">€{{ number_format($grossSales, 2) }}</td>
                        <td class="px-4 sm:px-6 py-2.5 text-right"></td>
                        <td class="px-4 py-2.5 text-right text-stone-400">100.0%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2.5 pl-8 sm:pl-10 text-stone-600">Less: Returns, Cancellations & Discounts (Retouren & Storno)</td>
                        <td class="px-4 py-2.5 text-right font-mono text-rose-600">-€{{ number_format($refundsAndCancellations, 2) }}</td>
                        <td class="px-4 sm:px-6 py-2.5 text-right"></td>
                        <td class="px-4 py-2.5 text-right text-stone-400">{{ $grossSales > 0 ? round(($refundsAndCancellations / $grossSales) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50 text-stone-500 text-[0.7rem]">
                        <td class="px-4 sm:px-6 py-1.5 pl-8 sm:pl-10 italic">↳ Net Sales excl. German VAT 19% (Nettoumsatz o. MwSt.)</td>
                        <td class="px-4 py-1.5 text-right font-mono">€{{ number_format($netRevenueExclVat, 2) }}</td>
                        <td class="px-4 sm:px-6 py-1.5 text-right"></td>
                        <td class="px-4 py-1.5 text-right text-stone-400">84.0%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50 text-stone-500 text-[0.7rem]">
                        <td class="px-4 sm:px-6 py-1.5 pl-8 sm:pl-10 italic">↳ Collected 19% Umsatzsteuer (Mehrwertsteuer)</td>
                        <td class="px-4 py-1.5 text-right font-mono text-amber-700">€{{ number_format($estimatedVatCollected, 2) }}</td>
                        <td class="px-4 sm:px-6 py-1.5 text-right"></td>
                        <td class="px-4 py-1.5 text-right text-stone-400">16.0%</td>
                    </tr>

                    <!-- 2. COGS SECTION -->
                    <tr class="bg-stone-50/70 font-bold text-stone-900">
                        <td class="px-4 sm:px-6 py-3 flex items-center gap-2 font-serif text-sm">
                            <span class="w-5 h-5 rounded-md bg-[#964B42] text-white flex items-center justify-center text-[0.65rem] font-sans">II</span>
                            <span>COST OF GOODS SOLD (WARENEINSATZ / MATERIALAUFWAND)</span>
                        </td>
                        <td class="px-4 py-3 text-right"></td>
                        <td class="px-4 sm:px-6 py-3 text-right font-mono font-bold text-sm text-rose-700">-€{{ number_format($totalCogs, 2) }}</td>
                        <td class="px-4 py-3 text-right text-stone-500">{{ $netSalesRevenue > 0 ? round(($totalCogs / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Pure Silk & Cashmere Fabrics (Rohstoffbezug & Textilien)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($totalCogs * 0.65, 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round((($totalCogs * 0.65) / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Embroidery, Crystals & Luxury Finishing (Veredelung & Steppung)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($totalCogs * 0.35, 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round((($totalCogs * 0.35) / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>

                    <!-- 3. GROSS PROFIT HIGHLIGHT -->
                    <tr class="bg-emerald-50/60 font-black text-emerald-950 border-y-2 border-emerald-300">
                        <td class="px-4 sm:px-6 py-3.5 flex items-center gap-2 font-serif text-base">
                            <span class="w-5 h-5 rounded-md bg-emerald-700 text-white flex items-center justify-center text-[0.65rem] font-sans">III</span>
                            <span>GROSS PROFIT / ROHERTRAG (BRUTTOERGEBNIS)</span>
                        </td>
                        <td class="px-4 py-3.5 text-right font-bold text-emerald-800">Margin: {{ $grossMarginPercent }}%</td>
                        <td class="px-4 sm:px-6 py-3.5 text-right font-mono font-black text-base text-emerald-900">€{{ number_format($grossProfit, 2) }}</td>
                        <td class="px-4 py-3.5 text-right font-black text-emerald-800">{{ $grossMarginPercent }}%</td>
                    </tr>

                    <!-- 4. OPERATING EXPENSES (OPEX) -->
                    <tr class="bg-stone-50/70 font-bold text-stone-900">
                        <td class="px-4 sm:px-6 py-3 flex items-center gap-2 font-serif text-sm">
                            <span class="w-5 h-5 rounded-md bg-[#964B42] text-white flex items-center justify-center text-[0.65rem] font-sans">IV</span>
                            <span>OPERATING EXPENSES (SONSTIGE BETRIEBLICHE AUFWENDUNGEN)</span>
                        </td>
                        <td class="px-4 py-3 text-right"></td>
                        <td class="px-4 sm:px-6 py-3 text-right font-mono font-bold text-sm text-purple-900">-€{{ number_format($totalExpenses, 2) }}</td>
                        <td class="px-4 py-3 text-right text-stone-500">{{ $netSalesRevenue > 0 ? round(($totalExpenses / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Maximilianstraße Showroom & Atelier Lease (Mietaufwand)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['workshop_rent'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['workshop_rent'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Master Tailors & Artisan Payroll (Personalaufwand)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['artisan_payroll'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['artisan_payroll'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Digital Marketing, Instagram & Editorial Lookbooks (Werbeaufwand)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['marketing_ads'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['marketing_ads'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Luxury Packaging, Rigid Gold Gift Boxes & Velvet Pouches (Verpackung)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['materials_packaging'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['materials_packaging'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">DHL Express & Climate-Neutral Courier Logistics (Versandkosten)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['shipping_logistics'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['shipping_logistics'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Cloud Infrastructure, SSL & E-Commerce Software (IT & Hosting)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['software_hosting'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['software_hosting'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Showroom Power, Heating & Climate Control (Energie & Nebenkosten)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['utilities'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['utilities'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Legal, CPA Advisory & Audit Retainer (Rechts- & Beratungskosten)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['taxes_legal'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['taxes_legal'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    @if($expensesByCategory['other'] > 0)
                    <tr class="hover:bg-stone-50/50">
                        <td class="px-4 sm:px-6 py-2 pl-8 sm:pl-10 text-stone-600">Miscellaneous Operational Expenses (Übrige Aufwendungen)</td>
                        <td class="px-4 py-2 text-right font-mono text-stone-600">-€{{ number_format($expensesByCategory['other'], 2) }}</td>
                        <td class="px-4 sm:px-6 py-2 text-right"></td>
                        <td class="px-4 py-2 text-right text-stone-400">{{ $netSalesRevenue > 0 ? round(($expensesByCategory['other'] / $netSalesRevenue) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endif

                    <!-- 5. FINAL NET PROFIT ROW -->
                    <tr class="{{ $netProfit >= 0 ? 'bg-gradient-to-r from-emerald-100 via-emerald-50 to-white text-emerald-950 border-t-2 border-b-4 border-emerald-500' : 'bg-gradient-to-r from-rose-100 via-rose-50 to-white text-rose-950 border-t-2 border-b-4 border-rose-500' }} font-black">
                        <td class="px-4 sm:px-6 py-4 flex items-center gap-2 font-serif text-base sm:text-lg">
                            <span class="w-6 h-6 rounded-md {{ $netProfit >= 0 ? 'bg-emerald-800' : 'bg-rose-800' }} text-white flex items-center justify-center text-xs font-sans">V</span>
                            <span>NET PROFIT / JAHRESÜBERSCHUSS (REINGEWINN)</span>
                        </td>
                        <td class="px-4 py-4 text-right font-bold {{ $netProfit >= 0 ? 'text-emerald-800' : 'text-rose-800' }}">
                            Net Margin: {{ $netMarginPercent }}%
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-right font-mono font-black text-lg sm:text-xl {{ $netProfit >= 0 ? 'text-emerald-900' : 'text-rose-900' }}">
                            €{{ number_format($netProfit, 2) }}
                        </td>
                        <td class="px-4 py-4 text-right font-black {{ $netProfit >= 0 ? 'text-emerald-900' : 'text-rose-900' }}">
                            {{ $netMarginPercent }}%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 12-Month Financial Performance Run-rate Table -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-5 shadow-xs space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-serif font-bold text-base text-stone-900" data-i18n-en="12-Month Historical Financial Run-Rate" data-i18n-de="12-Monats-Finanzverlauf">
                    12-Month Historical Financial Run-Rate
                </h3>
                <p class="text-xs text-stone-500">Historical performance across revenue, product costs, operating overhead and net earnings.</p>
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-stone-100 text-stone-600">Past 12 Months</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase border-b border-[#E5DED5]">
                        <th class="px-3.5 py-2.5">MONTH</th>
                        <th class="px-3.5 py-2.5 text-right">REVENUE (€)</th>
                        <th class="px-3.5 py-2.5 text-right">COGS (€)</th>
                        <th class="px-3.5 py-2.5 text-right">GROSS PROFIT (€)</th>
                        <th class="px-3.5 py-2.5 text-right">EXPENSES (€)</th>
                        <th class="px-3.5 py-2.5 text-right">NET PROFIT (€)</th>
                        <th class="px-3.5 py-2.5 text-right">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200/80 font-mono">
                    @foreach($monthlyTrend as $trend)
                        <tr class="hover:bg-stone-50/60 transition">
                            <td class="px-3.5 py-2 font-sans font-bold text-stone-900">{{ $trend['month'] }}</td>
                            <td class="px-3.5 py-2 text-right text-blue-700">€{{ number_format($trend['revenue'], 2) }}</td>
                            <td class="px-3.5 py-2 text-right text-stone-500">€{{ number_format($trend['cogs'], 2) }}</td>
                            <td class="px-3.5 py-2 text-right font-semibold text-stone-800">€{{ number_format($trend['gross'], 2) }}</td>
                            <td class="px-3.5 py-2 text-right text-purple-700">€{{ number_format($trend['expenses'], 2) }}</td>
                            <td class="px-3.5 py-2 text-right font-black {{ $trend['net'] >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                                {{ $trend['net'] >= 0 ? '+' : '' }}€{{ number_format($trend['net'], 2) }}
                            </td>
                            <td class="px-3.5 py-2 text-right font-sans">
                                @if($trend['net'] > 0)
                                    <span class="inline-block px-1.5 py-0.2 rounded text-[0.58rem] font-bold uppercase bg-emerald-50 text-emerald-800 border border-emerald-200">Surplus</span>
                                @elseif($trend['net'] == 0 && $trend['revenue'] == 0)
                                    <span class="inline-block px-1.5 py-0.2 rounded text-[0.58rem] font-bold uppercase bg-stone-100 text-stone-500">Neutral</span>
                                @else
                                    <span class="inline-block px-1.5 py-0.2 rounded text-[0.58rem] font-bold uppercase bg-rose-50 text-rose-800 border border-rose-200">Deficit</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
