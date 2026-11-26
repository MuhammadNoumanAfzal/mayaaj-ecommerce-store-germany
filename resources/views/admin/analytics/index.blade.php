@extends('layouts.admin')
@section('title', 'Sales & ROI Analytics Dashboard - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-5 pb-12">

    <!-- Top Executive Banner & Interactive Date Filters -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-5 sm:p-6 border-t-4 border-t-saltora-terracotta">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-saltora-terracotta">
                        <span class="h-1.5 w-1.5 rounded-full bg-saltora-terracotta"></span>
                        FINANCIAL INTELLIGENCE & PERFORMANCE
                    </span>
                    <span class="rounded bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-1.5 py-0.5 text-[0.58rem] font-extrabold uppercase">ROI Real-time</span>
                </div>
                <h1 class="font-extrabold text-xl sm:text-2xl text-stone-900 tracking-tight mt-1 flex items-center gap-2.5">
                    <span>E-Commerce Sales & ROI Analytics</span>
                </h1>
                <p class="text-xs text-stone-500 font-medium mt-0.5">
                    Umsatzströme, Nettogewinn-Margen, ROAS-Werbeeffizienz und Trichteranalysen im Überblick.
                </p>
            </div>

            <!-- Date Range Selector Pills & Custom Range Form -->
            <div class="flex flex-wrap items-center gap-1.5 bg-stone-50/80 p-1.5 rounded-2xl border border-stone-200/80 text-xs font-semibold">
                <a href="{{ route('admin.analytics', ['period' => 'today']) }}" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === 'today' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }}">
                    Heute
                </a>
                <a href="{{ route('admin.analytics', ['period' => '7days']) }}" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === '7days' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }}">
                    7 Tage
                </a>
                <a href="{{ route('admin.analytics', ['period' => '30days']) }}" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === '30days' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }}">
                    30 Tage
                </a>
                <a href="{{ route('admin.analytics', ['period' => 'quarter']) }}" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === 'quarter' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }}">
                    Quartal
                </a>
                <a href="{{ route('admin.analytics', ['period' => 'year']) }}" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === 'year' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }}">
                    Laufendes Jahr
                </a>
                
                <button type="button" onclick="document.getElementById('custom-date-modal').classList.toggle('hidden')" class="px-3 py-1.5 rounded-xl transition {{ $stats['period'] === 'custom' ? 'bg-saltora-terracotta text-white shadow-2xs font-bold' : 'text-stone-600 hover:text-stone-900 hover:bg-white' }} flex items-center gap-1 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Zeitraum...</span>
                </button>
            </div>
        </div>

        <!-- Collapsible Custom Date Picker Bar -->
        <div id="custom-date-modal" class="{{ $stats['period'] === 'custom' ? 'block' : 'hidden' }} mt-4 pt-4 border-t border-stone-100">
            <form method="GET" action="{{ route('admin.analytics') }}" class="flex flex-wrap items-center gap-3 text-xs">
                <input type="hidden" name="period" value="custom">
                <div class="flex items-center gap-2">
                    <span class="text-stone-500 font-bold">Von:</span>
                    <input type="date" name="start_date" value="{{ $stats['start_date'] }}" class="rounded-xl border border-stone-200 bg-stone-50 px-3 py-1.5 font-bold text-stone-800 focus:outline-none focus:border-saltora-terracotta">
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-stone-500 font-bold">Bis:</span>
                    <input type="date" name="end_date" value="{{ $stats['end_date'] }}" class="rounded-xl border border-stone-200 bg-stone-50 px-3 py-1.5 font-bold text-stone-800 focus:outline-none focus:border-saltora-terracotta">
                </div>
                <button type="submit" class="btn-exec-primary rounded-xl px-4 py-1.5 font-bold text-white shadow-2xs transition">
                    Filter anwenden
                </button>
            </form>
        </div>

        <div class="mt-3 flex items-center justify-between text-[0.68rem] text-stone-400">
            <span>Aktiver Auswertungszeitraum: <b class="text-stone-700">{{ $stats['period_label'] }}</b></span>
            <span>Umsatzsteuer: 19% MwSt. (Deutschland) • Währung: EUR (€)</span>
        </div>
    </div>

    <!-- 6 Executive KPI Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3.5">
        
        <!-- 1. Gross Revenue -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Bruttoumsatz</span>
                <div class="h-8 w-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-xs">
                    💶
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-stone-900 tracking-tight leading-none">
                    EUR {{ number_format($stats['gross_revenue'], 2, ',', '.') }}
                </div>
                <div class="flex items-center gap-1.5 text-[0.62rem] pt-1">
                    @if($stats['revenue_change'] >= 0)
                        <span class="text-emerald-700 font-extrabold flex items-center">↑ +{{ $stats['revenue_change'] }}%</span>
                    @else
                        <span class="text-rose-700 font-extrabold flex items-center">↓ {{ $stats['revenue_change'] }}%</span>
                    @endif
                    <span class="text-stone-400">vs. Vorperiode</span>
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                Netto: {{ number_format($stats['gross_revenue'] / 1.19, 2, ',', '.') }} € (exkl. MwSt.)
            </div>
        </div>

        <!-- 2. Net Profit & Margin -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-emerald-700 uppercase tracking-wider block">Reingewinn (Net)</span>
                <div class="h-8 w-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">
                    📈
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-emerald-800 tracking-tight leading-none">
                    EUR {{ number_format($stats['net_profit'], 2, ',', '.') }}
                </div>
                <div class="flex items-center gap-1.5 text-[0.62rem] pt-1">
                    <span class="rounded bg-emerald-100 text-emerald-800 px-1.5 py-0.2 font-extrabold">{{ $stats['net_margin'] }}% Marge</span>
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                Nach COGS & OpEx-Abzug
            </div>
        </div>

        <!-- 3. Return on Investment (ROAS) -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-purple-700 uppercase tracking-wider block">Marketing ROAS</span>
                <div class="h-8 w-8 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-xs">
                    🎯
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-purple-900 tracking-tight leading-none">
                    {{ $stats['roas_multiplier'] }}x Return
                </div>
                <div class="flex items-center gap-1 text-[0.62rem] pt-1 text-purple-700 font-bold">
                    <span>{{ $stats['marketing_roi'] }}% Werbe-ROI</span>
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                Ads-Spend: {{ number_format($stats['marketing_spend'], 2, ',', '.') }} €
            </div>
        </div>

        <!-- 4. Average Order Value (AOV) -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block">Ø Warenkorb (AOV)</span>
                <div class="h-8 w-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">
                    🛍️
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-stone-900 tracking-tight leading-none">
                    EUR {{ number_format($stats['aov'], 2, ',', '.') }}
                </div>
                <div class="flex items-center gap-1.5 text-[0.62rem] pt-1">
                    @if($stats['aov_change'] >= 0)
                        <span class="text-emerald-700 font-bold">↑ +{{ $stats['aov_change'] }}%</span>
                    @else
                        <span class="text-rose-700 font-bold">↓ {{ $stats['aov_change'] }}%</span>
                    @endif
                    <span class="text-stone-400">vs. Vorperiode</span>
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                Aus {{ $stats['total_orders'] }} Bestellungen
            </div>
        </div>

        <!-- 5. Store Conversion Rate -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-sky-700 uppercase tracking-wider block">Conversion Rate</span>
                <div class="h-8 w-8 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center font-bold text-xs">
                    ⚡
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-sky-900 tracking-tight leading-none">
                    {{ $stats['conversion_rate'] }}%
                </div>
                <div class="text-[0.62rem] text-stone-400 pt-1">
                    {{ $stats['total_orders'] }} Käufe abgeschlossen
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                Checkout-Abschlussrate
            </div>
        </div>

        <!-- 6. Cart Abandonment Rate -->
        <div class="group bg-white rounded-2xl border border-stone-200/90 p-4 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[0.62rem] font-bold text-rose-700 uppercase tracking-wider block">Warenkorbabbruch</span>
                <div class="h-8 w-8 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-xs">
                    ⚠️
                </div>
            </div>
            <div class="mt-2 space-y-0.5">
                <div class="font-extrabold text-xl text-rose-800 tracking-tight leading-none">
                    {{ $stats['abandonment_rate'] }}%
                </div>
                <div class="text-[0.62rem] text-stone-400 pt-1">
                    {{ $stats['abandoned_carts_count'] }} offene Abbrüche
                </div>
            </div>
            <div class="mt-2 pt-2 border-t border-stone-100 text-[0.58rem] text-stone-400">
                {{ $stats['recovered_carts_count'] }} erfolgreich gerettet
            </div>
        </div>

    </div>

    <!-- Main Visual Charts Grid (2 Columns: Timeline + Category Distribution) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left: Sales Revenue & Net Profit Trend Timeline (8 Cols) -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-stone-100 pb-4">
                <div>
                    <h2 class="font-extrabold text-sm text-stone-900">Umsatz & Reingewinn-Trendlinie</h2>
                    <p class="text-[0.68rem] text-stone-400">Tägliche Gegenüberstellung von Bruttoeinnahmen und bereinigtem Reingewinn</p>
                </div>
                
                <div class="flex items-center gap-3 text-xs">
                    <span class="inline-flex items-center gap-1.5 text-[0.68rem] font-bold text-stone-700">
                        <span class="h-2.5 w-2.5 rounded-full bg-saltora-terracotta"></span>
                        Bruttoumsatz
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-[0.68rem] font-bold text-stone-700">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-600"></span>
                        Reingewinn
                    </span>
                </div>
            </div>

            <!-- Canvas Container -->
            <div class="h-72 w-full relative">
                <canvas id="revenueProfitChart"></canvas>
            </div>
        </div>

        <!-- Right: Category Distribution Doughnut (4 Cols) -->
        <div class="lg:col-span-4 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            <div class="border-b border-stone-100 pb-3">
                <h2 class="font-extrabold text-sm text-stone-900">Umsatz nach Warengruppen</h2>
                <p class="text-[0.68rem] text-stone-400">Kollektions-Umsatzverteilung im gewählten Zeitraum</p>
            </div>

            <!-- Canvas Container -->
            <div class="h-56 w-full relative flex items-center justify-center">
                <canvas id="categoryDoughnutChart"></canvas>
            </div>

            <!-- Category Pills List -->
            <div class="space-y-2 pt-2 border-t border-stone-100 text-xs">
                @foreach(array_slice($categoryBreakdown['raw'], 0, 3) as $cat)
                    <div class="flex items-center justify-between text-stone-700">
                        <span class="font-medium truncate max-w-[150px]">{{ $cat['name'] }}</span>
                        <span class="font-bold text-stone-900">EUR {{ number_format($cat['revenue'], 2, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Secondary Grid: Top Products Table + Payment Method Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left: Top Selling Luxury Products (7 Cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                <div>
                    <h2 class="font-extrabold text-sm text-stone-900">Top-Bestseller Produkte</h2>
                    <p class="text-[0.68rem] text-stone-400">Umsatzstärkste Manufaktur-Kreationen im Zeitraum</p>
                </div>
                <span class="text-xs font-bold text-saltora-terracotta">Rangliste nach Umsatz</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-stone-200 bg-stone-50/60 text-stone-500 font-bold uppercase tracking-wider text-[0.62rem]">
                            <th class="py-2.5 px-3">Rang & Produkt</th>
                            <th class="py-2.5 px-3 text-center">Verkäufe</th>
                            <th class="py-2.5 px-3 text-right">Umsatz</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($topProducts as $idx => $prod)
                            <tr class="hover:bg-stone-50/60 transition">
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-3">
                                        <span class="h-6 w-6 rounded-full flex items-center justify-center font-bold text-[0.68rem] {{ $idx === 0 ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-700' }}">
                                            #{{ $idx + 1 }}
                                        </span>
                                        <div>
                                            <div class="font-bold text-stone-900">{{ $prod['name'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center font-bold text-stone-800">
                                    {{ $prod['units_sold'] }} Stück
                                </td>
                                <td class="py-3 px-3 text-right font-extrabold text-saltora-terracotta">
                                    EUR {{ number_format($prod['total_revenue'], 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-stone-400">
                                    Keine Produktverkäufe im gewählten Zeitraum.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Payment Method & Settlement Analysis (5 Cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-200/90 shadow-sm p-6 space-y-4">
            <div class="border-b border-stone-100 pb-3">
                <h2 class="font-extrabold text-sm text-stone-900">Zahlungsmethoden-Mix</h2>
                <p class="text-[0.68rem] text-stone-400">Umsatzanteile Vorkasse vs. Nachnahme (COD)</p>
            </div>

            <!-- Payment Chart Canvas -->
            <div class="h-56 w-full relative flex items-center justify-center">
                <canvas id="paymentMethodChart"></canvas>
            </div>

            <!-- Settlement Note -->
            <div class="rounded-xl border border-stone-200 bg-[#faf7f2] p-3 text-[0.68rem] text-stone-600 space-y-1">
                <b class="text-stone-900">Sicherheitsstruktur im deutschen Markt:</b>
                <p>
                    Vorkasse minimiert Zahlungsausfallrisiken vollständig; Barzahlung bei Kurierübergabe (Nachnahme) sorgt für maximale Conversion bei Neukunden.
                </p>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js 4.4 CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timelineData = @json($timelineData);
        const categoryData = @json($categoryBreakdown);
        const paymentData = @json($paymentMethodBreakdown);

        // 1. Revenue & Profit Trend Timeline Chart (Line/Area)
        const ctxTimeline = document.getElementById('revenueProfitChart')?.getContext('2d');
        if (ctxTimeline) {
            new Chart(ctxTimeline, {
                type: 'line',
                data: {
                    labels: timelineData.labels,
                    datasets: [
                        {
                            label: 'Bruttoumsatz (€)',
                            data: timelineData.revenue,
                            borderColor: '#964B42',
                            backgroundColor: 'rgba(150, 75, 66, 0.08)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#964B42',
                            pointRadius: 3,
                            pointHoverRadius: 6,
                        },
                        {
                            label: 'Reingewinn (€)',
                            data: timelineData.profit,
                            borderColor: '#2e683a',
                            backgroundColor: 'rgba(46, 104, 58, 0.06)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#2e683a',
                            pointRadius: 3,
                            pointHoverRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1c1210',
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 11 },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': EUR ' + Number(context.raw).toLocaleString('de-DE', { minimumFractionDigits: 2 });
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10 }, color: '#8a7c74' }
                        },
                        y: {
                            grid: { color: '#f0e8dc' },
                            ticks: {
                                font: { size: 10 },
                                color: '#8a7c74',
                                callback: function(value) {
                                    return '€' + value.toLocaleString('de-DE');
                                }
                            }
                        }
                    }
                }
            });
        }

        // 2. Category Distribution Doughnut Chart
        const ctxCategory = document.getElementById('categoryDoughnutChart')?.getContext('2d');
        if (ctxCategory && categoryData.labels.length > 0) {
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: categoryData.labels,
                    datasets: [{
                        data: categoryData.revenue,
                        backgroundColor: [
                            '#964B42',
                            '#d4a373',
                            '#588157',
                            '#3d5a80',
                            '#b35e53',
                            '#e07a5f'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1c1210',
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': EUR ' + Number(context.raw).toLocaleString('de-DE', { minimumFractionDigits: 2 });
                                }
                            }
                        }
                    }
                }
            });
        }

        // 3. Payment Method Mix Doughnut Chart
        const ctxPayment = document.getElementById('paymentMethodChart')?.getContext('2d');
        if (ctxPayment && paymentData.labels.length > 0) {
            new Chart(ctxPayment, {
                type: 'doughnut',
                data: {
                    labels: paymentData.labels,
                    datasets: [{
                        data: paymentData.data,
                        backgroundColor: [
                            '#78000b',
                            '#2e683a',
                            '#c5baaa'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 10, weight: 'bold' },
                                color: '#444'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1c1210',
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': EUR ' + Number(context.raw).toLocaleString('de-DE', { minimumFractionDigits: 2 });
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
