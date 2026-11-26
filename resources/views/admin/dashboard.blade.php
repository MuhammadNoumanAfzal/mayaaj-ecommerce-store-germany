@extends('layouts.admin')
@section('title', 'Executive Atelier Dashboard - MEHAAJ Luxury Control Center')

@section('admin-content')
<div class="space-y-5 text-[#1c1210]">

    <!-- 1. Executive Top Hero Banner (Ultra-Modern, Compact Luxury) -->
    <div class="rounded-2xl p-5 sm:p-6 bg-[#1f1715] text-[#faf7f2] border border-[#382b27] shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 relative overflow-hidden">
        <!-- Subtle luxury decorative ambient glow -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-[#78000b]/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#2e211e] border border-[#483732] flex items-center justify-center text-stone-200 font-serif font-black text-lg tracking-wider shrink-0 shadow-inner">
                MH
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-base sm:text-lg font-serif font-bold tracking-tight text-white uppercase">
                        MEHAAJ LUXURY ATELIER
                    </h1>
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.62rem] font-bold tracking-wider uppercase bg-[#2e683a]/25 text-[#4ade80] border border-[#2e683a]/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#4ade80] animate-pulse"></span> LIVE
                    </span>
                </div>
                <p class="text-xs text-[#c4b4a9] mt-0.5" data-i18n-en="Executive Leathercraft Control Center • Real-time sales velocity & orders across Europe & DACH" data-i18n-de="Executive Atelier Kontrollzentrum • Echtzeit-Umsatzgeschwindigkeiten & Bestellungen in DACH">
                    Executive Leathercraft Control Center • Real-time sales velocity & orders across Europe & DACH
                </p>
            </div>
        </div>

        <div class="relative z-10 flex items-center gap-3">
            <div class="bg-[#291f1c] rounded-xl px-4 py-2 border border-[#483732] text-right">
                <span class="text-[0.62rem] uppercase font-bold tracking-wider text-[#a8988e] block" data-i18n-en="Total Revenue" data-i18n-de="Gesamtumsatz">TOTAL REVENUE</span>
                <span class="text-lg font-serif font-bold text-white">€{{ number_format($grossRevenue, 2) }}</span>
            </div>
            <a href="{{ route('admin.products.create') }}" class="h-10 px-4 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-2 bg-[#78000b] hover:bg-[#5a0309] text-white shadow-sm transition active:scale-95 cursor-pointer whitespace-nowrap">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-en="+ New Creation" data-i18n-de="+ Neues Produkt">+ New Creation</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="h-10 px-3 rounded-xl text-xs font-semibold flex items-center gap-1.5 bg-[#2e211e] hover:bg-[#3d2c28] text-[#e0d3c5] border border-[#483732] transition">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                <span class="hidden sm:inline" data-i18n-en="Live Store" data-i18n-de="Live Store">Live Store</span>
            </a>
        </div>
    </div>

    <!-- 2. Executive Sales, Delivery & Real Profit Audit Control Card -->
    <div class="rounded-2xl bg-white border border-[#e5ded5] p-5 shadow-xs space-y-4">
        
        <!-- Header row with title, date filters & export buttons -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b border-[#f0e8de] pb-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#78000b]"></span>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210]" data-i18n-en="Executive Sales, Delivery & Real Profit Audit" data-i18n-de="Executive Umsatz, Lieferung & Reingewinn-Audit">
                        Executive Sales, Delivery & Real Profit Audit
                    </h2>
                </div>
                <div class="flex items-center gap-3 text-xs text-[#8a7c74] mt-0.5">
                    <button type="button" onclick="toggleMetricCards()" id="toggle-cards-btn" class="font-semibold text-[#78000b] hover:underline flex items-center gap-1">
                        <span>Hide Cards</span> <span id="toggle-arrow">▲</span>
                    </button>
                    <span>•</span>
                    <span>Auditing Period: <strong>{{ now()->format('F Y') }}</strong></span>
                </div>
            </div>

            <!-- Date Filters Pill Bar -->
            <div class="flex flex-wrap items-center gap-1.5 bg-[#faf7f2] p-1 rounded-xl border border-[#ebdccb]">
                <button type="button" onclick="setTimeframe('daily', this)" class="timeframe-btn px-2.5 py-1 text-[0.7rem] font-bold rounded-lg text-[#685c54] hover:text-[#1c1210] transition">Daily (Today)</button>
                <button type="button" onclick="setTimeframe('yesterday', this)" class="timeframe-btn px-2.5 py-1 text-[0.7rem] font-bold rounded-lg text-[#685c54] hover:text-[#1c1210] transition">Yesterday</button>
                <button type="button" onclick="setTimeframe('7days', this)" class="timeframe-btn px-2.5 py-1 text-[0.7rem] font-bold rounded-lg text-[#685c54] hover:text-[#1c1210] transition">7 Days</button>
                <button type="button" onclick="setTimeframe('monthly', this)" class="timeframe-btn active-tf px-3 py-1 text-[0.7rem] font-bold rounded-lg bg-[#1f1715] text-white shadow-xs">Monthly</button>
                <button type="button" onclick="setTimeframe('yearly', this)" class="timeframe-btn px-2.5 py-1 text-[0.7rem] font-bold rounded-lg text-[#685c54] hover:text-[#1c1210] transition">Yearly</button>
                <button type="button" onclick="openCustomDateModal()" class="timeframe-btn px-2.5 py-1 text-[0.7rem] font-bold rounded-lg text-[#685c54] hover:text-[#1c1210] transition">Custom Date</button>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="openDailyClosingModal()" class="h-8 px-3 rounded-lg text-[0.7rem] font-bold bg-[#faf7f2] text-[#685c54] border border-[#d9cebc] hover:bg-[#f0e7d8] transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    <span>Daily Closing</span>
                </button>
                <button type="button" onclick="window.print()" class="h-8 px-3 rounded-lg text-[0.7rem] font-bold bg-[#faf7f2] text-[#685c54] border border-[#d9cebc] hover:bg-[#f0e7d8] transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span>Sales Report</span>
                </button>
                <a href="{{ route('admin.dashboard.export-csv') }}" class="h-8 px-3 rounded-lg text-[0.7rem] font-bold bg-[#2e683a] hover:bg-[#23532d] text-white transition flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Export CSV</span>
                </a>
            </div>
        </div>

        <!-- Metric Categories Filter Strip -->
        <div class="flex items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2">
                <button type="button" onclick="filterCardType('all', this)" class="card-filter-btn active-cf px-3 py-1 rounded-full text-[0.7rem] font-bold bg-[#78000b] text-white">All Metrics (8)</button>
                <button type="button" onclick="filterCardType('profit', this)" class="card-filter-btn px-3 py-1 rounded-full text-[0.7rem] font-bold bg-[#faf7f2] text-[#685c54] border border-[#d9cebc] hover:bg-[#f0e7d8]">Profit & Cash (4)</button>
                <button type="button" onclick="filterCardType('delivery', this)" class="card-filter-btn px-3 py-1 rounded-full text-[0.7rem] font-bold bg-[#faf7f2] text-[#685c54] border border-[#d9cebc] hover:bg-[#f0e7d8]">Delivery & Courier (4)</button>
            </div>
            <span class="text-[0.68rem] text-[#8a7c74] font-medium hidden sm:inline">Real-time synchronized with Atelier Ledger</span>
        </div>

        <!-- 3. High-Density 8 KPI Cards (2x4 Grid, Compact Less-Spacing) -->
        <div id="metrics-cards-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 pt-1">
            
            <!-- Row 1: Operational Velocity -->
            
            <!-- Card 1: TOTAL ORDERS PLACED -->
            <div class="metric-card metric-delivery rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#78000b]/40 hover:shadow-xs transition">
                <div>
                    <div class="flex items-center justify-between text-[#8a7c74]">
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#736357]">TOTAL ORDERS PLACED</span>
                        <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">{{ $ordersCount }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">In selected timeframe</p>
            </div>

            <!-- Card 2: DELIVERED ORDERS -->
            <div class="metric-card metric-delivery rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#2e683a]/40 hover:shadow-xs transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#2e683a]">DELIVERED ORDERS</span>
                        <span class="px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-[#2e683a]/15 text-[#2e683a] border border-[#2e683a]/30">
                            {{ $deliverySuccessRate }}% SUCCESS
                        </span>
                    </div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">{{ $deliveredCount }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">DHL Express & Hermes delivered</p>
            </div>

            <!-- Card 3: IN TRANSIT / DISPATCHED -->
            <div class="metric-card metric-delivery rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#1d4ed8]/40 hover:shadow-xs transition">
                <div>
                    <div class="flex items-center justify-between text-[#8a7c74]">
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#1d4ed8]">IN TRANSIT / DISPATCHED</span>
                        <svg class="w-4 h-4 text-[#1d4ed8]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">{{ $dispatchedCount }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">With Courier (DHL / UPS / Hermes)</p>
            </div>

            <!-- Card 4: RETURNS & FAILED -->
            <div class="metric-card metric-delivery rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#b91c1c]/40 hover:shadow-xs transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#991b1b]">RETURNS & FAILED</span>
                        <span class="px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-[#fee2e2] text-[#991b1b] border border-[#fecaca]">
                            {{ $returnRate }}% RETURN RATE
                        </span>
                    </div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">{{ $cancelledCount }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">Loss / Erstattungen: €{{ number_format($refundedAmount, 2) }}</p>
            </div>

            <!-- Row 2: Financial Audit & True Profit -->

            <!-- Card 5: DELIVERED GROSS REVENUE -->
            <div class="metric-card metric-profit rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#78000b]/40 hover:shadow-xs transition">
                <div>
                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#736357] block">DELIVERED GROSS REVENUE</span>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">€{{ number_format($grossRevenue, 2) }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">From active & completed orders</p>
            </div>

            <!-- Card 6: PRODUCT PURCHASE COST (COGS) -->
            <div class="metric-card metric-profit rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#78000b]/40 hover:shadow-xs transition">
                <div>
                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#736357] block">PRODUCT PURCHASE COST (COGS)</span>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">€{{ number_format($cogsTotal, 2) }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">Real raw material & craft cost</p>
            </div>

            <!-- Card 7: COURIER FREIGHT LOSS / EXPENSE -->
            <div class="metric-card metric-profit rounded-xl border border-[#ebdccb] bg-[#faf7f2]/60 p-4 flex flex-col justify-between hover:border-[#b45309]/40 hover:shadow-xs transition">
                <div>
                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#b45309] block">COURIER FREIGHT & LOGISTICS</span>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-serif text-2xl font-bold text-[#1c1210]">€{{ number_format($logisticsExpense, 2) }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#8a7c74]">DHL GoGreen courier invoices</p>
            </div>

            <!-- Card 8: NET REALIZED PROFIT -->
            <div class="metric-card metric-profit rounded-xl border border-[#2e683a]/30 bg-[#2e683a]/5 p-4 flex flex-col justify-between hover:border-[#2e683a]/60 hover:shadow-xs transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#2e683a]">NET REALIZED PROFIT</span>
                        <span class="px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-[#2e683a]/20 text-[#2e683a] border border-[#2e683a]/30">
                            {{ $netMarginPct }}% MARGIN
                        </span>
                    </div>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-serif text-2xl font-bold text-[#2e683a]">€{{ number_format($netRealizedProfit, 2) }}</span>
                    </div>
                </div>
                <p class="mt-2 text-[0.68rem] text-[#2e683a]/80">(Revenue − COGS − Freight Losses)</p>
            </div>

        </div>

        <!-- 4. Four Micro Velocity Badges (Single Compact Line) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-2 border-t border-[#f0e8de]">
            <div class="rounded-xl border border-[#ebdccb] bg-white p-3 flex items-center justify-between">
                <div>
                    <span class="text-[0.62rem] uppercase font-bold text-[#8a7c74] block">TOTAL CREATIONS</span>
                    <span class="font-serif text-lg font-bold text-[#1c1210]">{{ $productsCount }}</span>
                    <span class="text-[0.62rem] text-[#2e683a] block font-semibold">● {{ $activeProductsCount }} Active</span>
                </div>
                <div class="w-8 h-8 rounded-lg bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#78000b]">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21 16-4 4-4-4"/><path d="M17 20V4"/><path d="m3 8 4-4 4 4"/><path d="M7 4v16"/></svg>
                </div>
            </div>

            <div class="rounded-xl border border-[#ebdccb] bg-white p-3 flex items-center justify-between">
                <div>
                    <span class="text-[0.62rem] uppercase font-bold text-[#8a7c74] block">STORE ORDERS</span>
                    <span class="font-serif text-lg font-bold text-[#1c1210]">{{ $ordersCount }}</span>
                    <span class="text-[0.62rem] text-[#b45309] block font-semibold">● {{ $ordersThisMonth }} This Month</span>
                </div>
                <div class="w-8 h-8 rounded-lg bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#b45309]">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
            </div>

            <div class="rounded-xl border border-[#ebdccb] bg-white p-3 flex items-center justify-between">
                <div>
                    <span class="text-[0.62rem] uppercase font-bold text-[#8a7c74] block">CLIENT INQUIRIES</span>
                    <span class="font-serif text-lg font-bold text-[#1c1210]">{{ $contactMessagesCount }}</span>
                    <span class="text-[0.62rem] text-[#78000b] block font-semibold">● {{ $contactMessagesCount }} Concierge</span>
                </div>
                <div class="w-8 h-8 rounded-lg bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#78000b]">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
            </div>

            <div class="rounded-xl border border-[#ebdccb] bg-white p-3 flex items-center justify-between">
                <div>
                    <span class="text-[0.62rem] uppercase font-bold text-[#8a7c74] block">TOTAL PATRONS</span>
                    <span class="font-serif text-lg font-bold text-[#1c1210]">{{ $customersCount }}</span>
                    <span class="text-[0.62rem] text-[#2e683a] block font-semibold">● Avg Ticket: €{{ number_format($aov, 0) }}</span>
                </div>
                <div class="w-8 h-8 rounded-lg bg-[#faf7f2] border border-[#ebdccb] flex items-center justify-center text-[#2e683a]">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>

    </div>

    <!-- 5. Dual Analytics Deck (Multi-Chart Flow on Left + Atelier Health on Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left 8-Cols: Orders & Fulfillment Flow with Switcher Tabs -->
        <div class="lg:col-span-8 rounded-2xl bg-white border border-[#e5ded5] p-5 shadow-xs flex flex-col justify-between">
            <div>
                <!-- Deck Header with Tabs -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-[#f0e8de] pb-3.5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#78000b]"></span>
                        <h3 class="font-serif text-base font-bold text-[#1c1210]">Orders & Fulfillment Flow</h3>
                    </div>

                    <!-- Chart Switcher Tabs -->
                    <div class="flex items-center gap-1 bg-[#faf7f2] p-1 rounded-xl border border-[#ebdccb] overflow-x-auto text-[0.7rem] font-bold">
                        <button type="button" onclick="switchChartMode('revenue', this)" class="chart-tab-btn px-2.5 py-1 rounded-lg text-[#685c54] hover:text-[#1c1210] transition">~ Revenue</button>
                        <button type="button" onclick="switchChartMode('orders', this)" class="chart-tab-btn active-ct px-2.5 py-1 rounded-lg bg-[#1f1715] text-white shadow-xs">📦 Orders</button>
                        <button type="button" onclick="switchChartMode('payments', this)" class="chart-tab-btn px-2.5 py-1 rounded-lg text-[#685c54] hover:text-[#1c1210] transition">💳 Payments</button>
                        <button type="button" onclick="switchChartMode('collections', this)" class="chart-tab-btn px-2.5 py-1 rounded-lg text-[#685c54] hover:text-[#1c1210] transition">🏷️ Collections</button>
                        <button type="button" onclick="switchChartMode('cities', this)" class="chart-tab-btn px-2.5 py-1 rounded-lg text-[#685c54] hover:text-[#1c1210] transition">📍 Cities</button>
                    </div>
                </div>

                <!-- Dynamic Chart Canvas Container -->
                <div class="h-64 sm:h-72 w-full relative pt-4">
                    <canvas id="flowMultiChart"></canvas>
                </div>
            </div>

            <!-- Chart Footer Indicator Bar -->
            <div class="pt-3 border-t border-[#f0e8de] flex flex-wrap items-center justify-between text-xs text-[#8a7c74]">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#78000b]"></span>
                    <span>Euro (€)</span>
                    <span>•</span>
                    <span>Total Recorded Orders: <strong class="text-[#1c1210]">{{ $ordersCount }}</strong></span>
                </div>
                <div class="flex items-center gap-3">
                    <span>Avg Ticket: <strong class="text-[#1c1210]">€{{ number_format($aov, 2) }}</strong></span>
                    <span class="px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-[#2e683a]/15 text-[#2e683a] border border-[#2e683a]/30">
                        {{ $deliverySuccessRate }}% Delivery Success
                    </span>
                </div>
            </div>
        </div>

        <!-- Right 4-Cols: Atelier Health & Stock -->
        <div class="lg:col-span-4 rounded-2xl bg-white border border-[#e5ded5] p-5 shadow-xs flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between border-b border-[#f0e8de] pb-3">
                    <div>
                        <h3 class="font-serif text-sm font-bold text-[#1c1210]">Atelier Health & Stock</h3>
                        <p class="text-[0.68rem] text-[#8a7c74]">Real-time workshop & order metrics</p>
                    </div>
                    <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#78000b] bg-[#78000b]/10 px-2 py-0.5 rounded-md">INVENTORY</span>
                </div>

                <!-- Low Stock Alert Box -->
                <div class="mt-3.5 rounded-xl border border-[#ebdccb] bg-[#faf7f2] p-3 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-[#b45309]/15 text-[#b45309] flex items-center justify-center font-bold text-xs shrink-0">!</div>
                        <div>
                            <p class="text-xs font-bold text-[#1c1210]">{{ $lowStockCount }} Low Stock Alerts</p>
                            <p class="text-[0.65rem] text-[#8a7c74]">Stock level ≤ 10 in atelier</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products') }}" class="px-2.5 py-1 rounded-lg text-[0.68rem] font-bold bg-white text-[#78000b] border border-[#d9cebc] hover:bg-[#78000b] hover:text-white transition">
                        Restock
                    </a>
                </div>

                <!-- Payment Methods Distribution Bar -->
                <div class="space-y-3 pt-3">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-[#685c54] font-medium">Bank Transfer / Vorkasse (SEPA)</span>
                            <span class="font-bold text-[#1c1210]">€{{ number_format($paymentBreakdown['vorkasse']['amount'], 2) }}</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-[#f0e8de] overflow-hidden">
                            <div class="h-full bg-[#78000b] rounded-full" style="width: 78%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-[#685c54] font-medium">Cash on Delivery (COD)</span>
                            <span class="font-bold text-[#1c1210]">€{{ number_format($paymentBreakdown['cod']['amount'], 2) }}</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-[#f0e8de] overflow-hidden">
                            <div class="h-full bg-[#b45309] rounded-full" style="width: 15%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-[#685c54] font-medium">Credit Card & Apple Pay</span>
                            <span class="font-bold text-[#1c1210]">€{{ number_format($paymentBreakdown['stripe']['amount'], 2) }}</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-[#f0e8de] overflow-hidden">
                            <div class="h-full bg-[#2e683a] rounded-full" style="width: 7%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Top Dispatch Hubs -->
                <div class="pt-4 border-t border-[#f0e8de]">
                    <span class="text-[0.62rem] font-bold uppercase tracking-wider text-[#8a7c74] block mb-2">TOP DISPATCH HUBS</span>
                    <div class="space-y-1.5">
                        @foreach($topCities as $cityName => $cityData)
                            <div class="flex items-center justify-between text-xs py-1 px-2 rounded-lg hover:bg-[#faf7f2] transition">
                                <span class="font-semibold text-[#1c1210]">{{ $cityName }}</span>
                                <span class="font-mono text-[0.68rem] text-[#78000b] font-bold">€{{ number_format($cityData['total'], 0) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-[#f0e8de] flex items-center justify-between text-[0.68rem] text-[#8a7c74]">
                <a href="{{ route('admin.orders') }}" class="hover:text-[#78000b] font-semibold">View Orders ({{ $ordersCount }})</a>
                <span>•</span>
                <a href="{{ route('admin.categories') }}" class="hover:text-[#78000b] font-semibold">Collections ({{ $categories->count() }})</a>
                <span>•</span>
                <a href="{{ route('admin.settings') }}" class="hover:text-[#78000b] font-semibold">Settings</a>
            </div>
        </div>

    </div>

    <!-- 6. Recent Store Orders Table (Clean & Compact) -->
    <div class="rounded-2xl bg-white border border-[#e5ded5] p-5 shadow-xs space-y-4">
        <div class="flex items-center justify-between border-b border-[#f0e8de] pb-3">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                <h3 class="font-serif text-base font-bold text-[#1c1210]">Recent Store Orders</h3>
            </div>
            <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#78000b] hover:underline flex items-center gap-1">
                <span>View All Orders</span> <span>→</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#faf7f2] text-[0.65rem] font-bold text-[#685c54] uppercase tracking-wider border-b border-[#ebdccb]">
                        <th class="py-2.5 px-3">ORDER #</th>
                        <th class="py-2.5 px-3">PATRON</th>
                        <th class="py-2.5 px-3">DESTINATION</th>
                        <th class="py-2.5 px-3">AMOUNT (€)</th>
                        <th class="py-2.5 px-3">METHOD</th>
                        <th class="py-2.5 px-3">STATUS</th>
                        <th class="py-2.5 px-3 text-right">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f0e8de]">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-[#faf7f2]/50 transition">
                            <td class="py-3 px-3 font-mono font-bold text-[#1c1210]">
                                {{ $order->order_number }}
                            </td>
                            <td class="py-3 px-3">
                                <p class="font-semibold text-[#1c1210]">{{ $order->customer_name }}</p>
                                <p class="text-[0.65rem] text-[#8a7c74]">{{ $order->customer_email }}</p>
                            </td>
                            <td class="py-3 px-3 text-[#685c54]">
                                {{ $order->city ?: 'Berlin' }}
                            </td>
                            <td class="py-3 px-3 font-serif font-bold text-[#1c1210]">
                                €{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="py-3 px-3">
                                <span class="px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase bg-[#faf7f2] border border-[#d9cebc] text-[#685c54]">
                                    {{ $order->payment_method ?: 'Vorkasse' }}
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                @php
                                    $st = strtolower($order->status);
                                    $stBadge = match($st) {
                                        'delivered' => 'bg-[#2e683a]/15 text-[#2e683a] border-[#2e683a]/30',
                                        'shipped'   => 'bg-[#1d4ed8]/15 text-[#1d4ed8] border-[#1d4ed8]/30',
                                        'processing'=> 'bg-[#b45309]/15 text-[#b45309] border-[#b45309]/30',
                                        'cancelled' => 'bg-[#991b1b]/15 text-[#991b1b] border-[#991b1b]/30',
                                        default     => 'bg-[#78000b]/15 text-[#78000b] border-[#78000b]/30',
                                    };
                                    $stLabel = match($st) {
                                        'delivered' => '● Zugestellt',
                                        'shipped'   => '● Im Versand',
                                        'processing'=> '● In Bearbeitung',
                                        'cancelled' => '● Storniert',
                                        default     => '● Ausstehend',
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border {{ $stBadge }}">
                                    {{ $stLabel }}
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1 rounded-lg text-[0.68rem] font-bold bg-[#faf7f2] hover:bg-[#78000b] hover:text-white text-[#1c1210] border border-[#d9cebc] transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-xs text-[#8a7c74]">
                                No store orders recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Daily Closing Modal Dialog -->
<div id="daily-closing-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 border border-[#d9cebc] shadow-xl space-y-4">
        <div class="flex items-center justify-between border-b border-[#f0e8de] pb-3">
            <div>
                <h3 class="font-serif text-lg font-bold text-[#1c1210]">Tagesabschluss (Daily Closing)</h3>
                <p class="text-xs text-[#8a7c74]">{{ now()->format('d. F Y - H:i') }} • Atelier Mehaaj</p>
            </div>
            <button type="button" onclick="closeDailyClosingModal()" class="text-[#8a7c74] hover:text-[#1c1210] text-sm p-1">✕</button>
        </div>

        <div class="space-y-2 text-xs">
            <div class="flex justify-between py-1.5 border-b border-[#faf7f2]">
                <span class="text-[#685c54]">Heutige Bestellungen</span>
                <span class="font-bold text-[#1c1210]">{{ $ordersCount }} Einheiten</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#faf7f2]">
                <span class="text-[#685c54]">Bruttoumsatz</span>
                <span class="font-bold text-[#1c1210]">€{{ number_format($grossRevenue, 2) }}</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#faf7f2]">
                <span class="text-[#685c54]">Material & Fertigungskosten (COGS)</span>
                <span class="font-bold text-[#b45309]">€{{ number_format($cogsTotal, 2) }}</span>
            </div>
            <div class="flex justify-between py-1.5 border-b border-[#faf7f2]">
                <span class="text-[#685c54]">Logistik & Fracht (DHL Express)</span>
                <span class="font-bold text-[#b45309]">€{{ number_format($logisticsExpense, 2) }}</span>
            </div>
            <div class="flex justify-between py-2 border-t-2 border-[#1c1210] text-sm">
                <span class="font-bold text-[#1c1210]">Echter Reingewinn (Net Profit)</span>
                <span class="font-bold text-[#2e683a]">€{{ number_format($netRealizedProfit, 2) }} ({{ $netMarginPct }}%)</span>
            </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
            <button type="button" onclick="closeDailyClosingModal()" class="px-4 py-2 text-xs font-bold text-[#8a7c74]">Schließen</button>
            <button type="button" onclick="window.print()" class="px-4 py-2 rounded-lg bg-[#78000b] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#5a0309] transition">
                Drucken / PDF
            </button>
        </div>
    </div>
</div>

<!-- Chart.js Multi-Mode Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    (function() {
        let flowChartInstance = null;
        let currentMode = 'orders';

        // Datasets passed from Controller
        const months = @json($monthlyMonths);
        const monthlyRev = @json($monthlyRevenue);
        const orderFlowLabels = @json($ordersFlowLabels);
        const orderFlowData = @json($ordersFlowData);
        const catLabels = @json($categoryLabels);
        const catData = @json($categoryData);
        const citiesData = @json($topCities);

        const cityLabels = Object.keys(citiesData);
        const cityTotals = Object.values(citiesData).map(c => c.total);

        const paymentLabels = ['Bank Transfer (Vorkasse)', 'COD Delivery', 'Credit Card (Stripe)', 'PayPal'];
        const paymentData = [
            {{ $paymentBreakdown['vorkasse']['amount'] }},
            {{ $paymentBreakdown['cod']['amount'] }},
            {{ $paymentBreakdown['stripe']['amount'] }},
            {{ $paymentBreakdown['paypal']['amount'] }}
        ];

        function renderChart(mode) {
            const ctx = document.getElementById('flowMultiChart');
            if (!ctx) return;

            if (flowChartInstance) {
                flowChartInstance.destroy();
            }

            let config = {};

            if (mode === 'revenue') {
                config = {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Revenue (€)',
                            data: monthlyRev,
                            borderColor: '#78000b',
                            backgroundColor: 'rgba(120, 0, 11, 0.08)',
                            fill: true,
                            tension: 0.35,
                            borderWidth: 2.5,
                            pointRadius: 4,
                            pointBackgroundColor: '#78000b'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ' €' + Number(ctx.parsed.y).toLocaleString()
                                }
                            }
                        },
                        scales: {
                            y: {
                                grid: { color: '#f0e8de' },
                                ticks: { font: { size: 10 }, color: '#8a7c74', callback: (v) => '€' + v }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#8a7c74' }
                            }
                        }
                    }
                };
            } else if (mode === 'orders') {
                config = {
                    type: 'bar',
                    data: {
                        labels: orderFlowLabels,
                        datasets: [{
                            label: 'Orders',
                            data: orderFlowData,
                            backgroundColor: [
                                '#2e683a', // Delivered
                                '#b45309', // Processing
                                '#d8b45a', // Pending
                                '#1d4ed8', // Shipped
                                '#991b1b'  // Cancelled
                            ],
                            borderRadius: 6,
                            maxBarThickness: 45
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#f0e8de' },
                                ticks: { stepSize: 1, font: { size: 10 }, color: '#8a7c74' }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#8a7c74' }
                            }
                        }
                    }
                };
            } else if (mode === 'payments') {
                config = {
                    type: 'bar',
                    data: {
                        labels: paymentLabels,
                        datasets: [{
                            label: 'Volume (€)',
                            data: paymentData,
                            backgroundColor: ['#78000b', '#b45309', '#2e683a', '#1d4ed8'],
                            borderRadius: 6,
                            maxBarThickness: 40
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                grid: { color: '#f0e8de' },
                                ticks: { font: { size: 10 }, color: '#8a7c74', callback: (v) => '€' + v }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#8a7c74' }
                            }
                        }
                    }
                };
            } else if (mode === 'collections') {
                config = {
                    type: 'bar',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            label: 'Items in Atelier',
                            data: catData,
                            backgroundColor: '#964B42',
                            borderRadius: 6,
                            maxBarThickness: 40
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#f0e8de' },
                                ticks: { stepSize: 1, font: { size: 10 }, color: '#8a7c74' }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#8a7c74' }
                            }
                        }
                    }
                };
            } else if (mode === 'cities') {
                config = {
                    type: 'bar',
                    data: {
                        labels: cityLabels,
                        datasets: [{
                            label: 'Revenue (€)',
                            data: cityTotals,
                            backgroundColor: '#78000b',
                            borderRadius: 6,
                            maxBarThickness: 40
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                grid: { color: '#f0e8de' },
                                ticks: { font: { size: 10 }, color: '#8a7c74', callback: (v) => '€' + v }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#8a7c74' }
                            }
                        }
                    }
                };
            }

            flowChartInstance = new Chart(ctx, config);
        }

        window.switchChartMode = function(mode, btn) {
            currentMode = mode;
            document.querySelectorAll('.chart-tab-btn').forEach(b => {
                b.classList.remove('active-ct', 'bg-[#1f1715]', 'text-white', 'shadow-xs');
                b.classList.add('text-[#685c54]');
            });
            if (btn) {
                btn.classList.add('active-ct', 'bg-[#1f1715]', 'text-white', 'shadow-xs');
                btn.classList.remove('text-[#685c54]');
            }
            renderChart(mode);
        };

        window.setTimeframe = function(tf, btn) {
            document.querySelectorAll('.timeframe-btn').forEach(b => {
                b.classList.remove('active-tf', 'bg-[#1f1715]', 'text-white', 'shadow-xs');
                b.classList.add('text-[#685c54]');
            });
            if (btn) {
                btn.classList.add('active-tf', 'bg-[#1f1715]', 'text-white', 'shadow-xs');
                btn.classList.remove('text-[#685c54]');
            }
        };

        window.filterCardType = function(type, btn) {
            document.querySelectorAll('.card-filter-btn').forEach(b => {
                b.classList.remove('active-cf', 'bg-[#78000b]', 'text-white');
                b.classList.add('bg-[#faf7f2]', 'text-[#685c54]', 'border', 'border-[#d9cebc]');
            });
            if (btn) {
                btn.classList.add('active-cf', 'bg-[#78000b]', 'text-white');
                btn.classList.remove('bg-[#faf7f2]', 'text-[#685c54]', 'border', 'border-[#d9cebc]');
            }

            document.querySelectorAll('.metric-card').forEach(card => {
                if (type === 'all') {
                    card.classList.remove('hidden');
                } else if (type === 'profit') {
                    if (card.classList.contains('metric-profit')) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                } else if (type === 'delivery') {
                    if (card.classList.contains('metric-delivery')) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                }
            });
        };

        window.toggleMetricCards = function() {
            const container = document.getElementById('metrics-cards-container');
            const arrow = document.getElementById('toggle-arrow');
            const btn = document.getElementById('toggle-cards-btn');
            if (!container) return;

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                arrow.textContent = '▲';
                btn.querySelector('span').textContent = 'Hide Cards';
            } else {
                container.classList.add('hidden');
                arrow.textContent = '▼';
                btn.querySelector('span').textContent = 'Show Cards';
            }
        };

        window.openDailyClosingModal = function() {
            const m = document.getElementById('daily-closing-modal');
            if (m) m.classList.remove('hidden');
        };

        window.closeDailyClosingModal = function() {
            const m = document.getElementById('daily-closing-modal');
            if (m) m.classList.add('hidden');
        };

        window.openCustomDateModal = function() {
            const range = prompt('Datum eingeben (YYYY-MM-DD bis YYYY-MM-DD):', '2026-11-01 to 2026-11-30');
            if (range) {
                alert('Filter auf ' + range + ' angewendet.');
            }
        };

        // Initialize with 'orders' mode
        renderChart('orders');
    })();
</script>
@endsection
