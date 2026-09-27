@extends('layouts.admin')
@section('title', 'MEHAAJ Admin Analytics & Overview')

@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-6">

    <!-- Top Dashboard Header Block (Matching Screenshot Header) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pt-1">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                <span data-i18n-de="eCommerce Analytics & Store Overview" data-i18n-en="eCommerce Analytics & Store Overview">eCommerce Analytics & Store Overview</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1" data-i18n-de="Echtzeit-Shop-Performance, Bestellkennzahlen und Katalog-Inventar." data-i18n-en="Real-time store performance, order metrics, and catalog inventory.">
                Real-time store performance, order metrics, and catalog inventory.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-bold bg-[#e6f4ea] text-[#137333] border border-[#ceead6]">
                <span class="h-2 w-2 rounded-full bg-[#137333] animate-pulse"></span>
                <span data-i18n-de="Live Store Operational" data-i18n-en="Live Store Operational">Live Store Operational</span>
            </span>
        </div>
    </div>

    <!-- 4 Stat Metric Cards (Exact Palette & Icon Badges matching Screenshot) -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        
        <!-- Card 1: TOTAL PRODUCTS -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-300">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-extrabold uppercase tracking-wider text-slate-400" data-i18n-de="TOTAL PRODUCTS" data-i18n-en="TOTAL PRODUCTS">TOTAL PRODUCTS</span>
                    <div class="h-10 w-10 rounded-xl bg-[#fff7ed] text-[#ea580c] flex items-center justify-center shadow-2xs">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $productsCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-bold text-emerald-700">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                <span>{{ $productsThisMonth }} Active in Store</span>
            </div>
        </div>

        <!-- Card 2: STORE ORDERS -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-300">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-extrabold uppercase tracking-wider text-slate-400" data-i18n-de="STORE ORDERS" data-i18n-en="STORE ORDERS">STORE ORDERS</span>
                    <div class="h-10 w-10 rounded-xl bg-[#fefce8] text-[#ca8a04] flex items-center justify-center shadow-2xs">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $ordersCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-bold text-amber-700">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                <span>{{ $ordersThisMonth }} Pending Processing</span>
            </div>
        </div>

        <!-- Card 3: CUSTOMER MESSAGES -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-300">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-extrabold uppercase tracking-wider text-slate-400" data-i18n-de="CUSTOMER MESSAGES" data-i18n-en="CUSTOMER MESSAGES">CUSTOMER MESSAGES</span>
                    <div class="h-10 w-10 rounded-xl bg-[#fff1f2] text-[#e11d48] flex items-center justify-center shadow-2xs">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $contactMessagesCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-bold text-rose-700">
                <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                <span>{{ $contactMessagesThisMonth }} Unread Messages</span>
            </div>
        </div>

        <!-- Card 4: VIP CUSTOMERS -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-300">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[0.68rem] font-extrabold uppercase tracking-wider text-slate-400" data-i18n-de="VIP CUSTOMERS" data-i18n-en="VIP CUSTOMERS">VIP CUSTOMERS</span>
                    <div class="h-10 w-10 rounded-xl bg-[#ecfdf5] text-[#059669] flex items-center justify-center shadow-2xs">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $customersCount }}</p>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-[0.72rem] font-bold text-emerald-700">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                <span>Live Registered Accounts</span>
            </div>
        </div>

    </div>

    <!-- Middle Grid Section (Analytics Charts) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left 8-Cols: Monthly Export Volume & Orders Chart -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                <div>
                    <h2 class="font-serif text-base font-bold text-slate-900 tracking-tight" data-i18n-de="Monthly Sales Volume & Orders" data-i18n-en="Monthly Sales Volume & Orders">Monthly Sales Volume & Orders</h2>
                    <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Monthly order volume vs total store inquiries" data-i18n-en="Monthly order volume vs total store inquiries">Monthly order volume vs total store inquiries</p>
                </div>

                <div class="flex items-center gap-4 text-[0.68rem] font-extrabold uppercase">
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 rounded-xs bg-[#e05638]"></span>
                        <span class="text-slate-600">Store Orders</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 rounded-xs bg-[#0f172a]"></span>
                        <span class="text-slate-600">Inquiries Trend</span>
                    </div>
                    <span class="rounded-md bg-slate-100 px-2.5 py-1 text-[0.65rem] font-mono text-slate-500 font-bold">2026 YTD</span>
                </div>
            </div>

            <!-- Canvas Chart Area -->
            <div class="h-64 relative">
                <canvas id="monthlyVolumeChart"></canvas>
            </div>
        </div>

        <!-- Right 4-Cols: Category Demand Share Donut Chart -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="font-serif text-base font-bold text-slate-900 tracking-tight" data-i18n-de="Category Demand Share" data-i18n-en="Category Demand Share">Category Demand Share</h2>
                        <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Distribution by product category" data-i18n-en="Distribution by product category">Distribution by product category</p>
                    </div>
                    <span class="text-[0.68rem] font-bold text-[#e05638]" data-i18n-de="By Volume" data-i18n-en="By Volume">By Volume</span>
                </div>

                <!-- Donut Chart Container -->
                <div class="relative my-6 flex items-center justify-center">
                    <div class="h-48 w-48 relative">
                        <canvas id="categoryShareChart"></canvas>
                        <!-- Center Label -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-2xl font-black text-slate-900">100%</span>
                            <span class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-wider">Catalog Share</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#e05638]"></span>
                    <span class="text-slate-700">Premium Leather Goods</span>
                </div>
                <span class="text-slate-900 font-black">100%</span>
            </div>
        </div>

    </div>

    <!-- Bottom Grid Section (Recent Store Orders Table & Top Categories) -->
    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Left 8-Cols: Recent Store Orders Table -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="font-serif text-base font-bold text-slate-900 tracking-tight" data-i18n-de="Recent Store Orders" data-i18n-en="Recent Store Orders">Recent Store Orders</h2>
                    <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Latest order inquiries placed by buyers" data-i18n-en="Latest order inquiries placed by buyers">Latest order inquiries placed by buyers</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#e05638] hover:underline" data-i18n-de="View All Orders →" data-i18n-en="View All Orders →">View All Orders →</a>
            </div>

            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 uppercase tracking-wider font-extrabold text-[0.68rem] border-b border-slate-100">
                            <th class="p-3.5">ORDER REF #</th>
                            <th class="p-3.5">CUSTOMER COMPANY</th>
                            <th class="p-3.5">DESTINATION</th>
                            <th class="p-3.5">STATUS</th>
                            <th class="p-3.5 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-3.5 font-mono font-bold text-[#e05638]">{{ $order->order_number }}</td>
                            <td class="p-3.5 font-bold text-slate-900">
                                <div>{{ $order->customer_name }}</div>
                                <div class="text-[0.68rem] font-normal text-slate-400">{{ $order->customer_email ?? 'Direct Customer' }}</div>
                            </td>
                            <td class="p-3.5 text-slate-600">
                                <span class="inline-flex items-center gap-1.5">
                                    <span>🇩🇪 Germany</span>
                                </span>
                            </td>
                            <td class="p-3.5">
                                @if($order->status === 'pending')
                                    <span class="rounded-full bg-[#e0f2fe] text-[#0369a1] border border-[#bae6fd] px-3 py-1 text-[0.65rem] font-bold uppercase">Processing</span>
                                @elseif($order->status === 'delivered' || $order->payment_status === 'paid')
                                    <span class="rounded-full bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0] px-3 py-1 text-[0.65rem] font-bold uppercase">Completed</span>
                                @else
                                    <span class="rounded-full bg-slate-100 text-slate-700 border border-slate-200 px-3 py-1 text-[0.65rem] font-bold uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right">
                                <a href="{{ route('admin.orders') }}" class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-slate-100 text-slate-600 hover:bg-[#e05638] hover:text-white transition">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">
                                <p class="text-xs text-slate-500 font-bold" data-i18n-de="Noch keine Bestellungen im System" data-i18n-en="No orders in the system yet">No orders in the system yet</p>
                                <p class="text-[0.7rem] text-slate-400 mt-0.5" data-i18n-de="Neue Kundenbestellungen werden hier automatisch in Echtzeit angezeigt." data-i18n-en="New customer orders will automatically appear here in real-time.">New customer orders will automatically appear here in real-time.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right 4-Cols: Top Selling Categories -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <h2 class="font-serif text-base font-bold text-slate-900 tracking-tight" data-i18n-de="Top Product Categories" data-i18n-en="Top Product Categories">Top Product Categories</h2>
                <p class="text-xs text-slate-400 mt-0.5" data-i18n-de="Leading catalog performance" data-i18n-en="Leading catalog performance">Leading catalog performance</p>

                <div class="mt-6 space-y-4">
                    <!-- Progress Item 1 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">Wallets & Small Leather</span>
                            <span class="text-slate-900">45%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#e05638] w-[45%] shadow-2xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 2 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">Bags & Briefcases</span>
                            <span class="text-slate-900">30%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#ea580c] w-[30%] shadow-2xs"></div>
                        </div>
                    </div>

                    <!-- Progress Item 3 -->
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                            <span class="text-slate-700">Belts & Accessories</span>
                            <span class="text-slate-900">25%</span>
                        </div>
                        <div class="h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full bg-[#f59e0b] w-[25%] shadow-2xs"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Settings Card -->
            <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                <div>
                    <p class="font-bold text-xs text-slate-800" data-i18n-de="Store Configuration" data-i18n-en="Store Configuration">Store Configuration</p>
                    <p class="text-[0.68rem] text-slate-400 font-medium" data-i18n-de="Configure payment IBAN & settings" data-i18n-en="Configure payment IBAN & settings">Configure payment IBAN & settings</p>
                </div>
                <a href="{{ route('admin.settings') }}" class="rounded-full bg-[#0f172a] hover:bg-slate-800 text-white px-3.5 py-1.5 text-xs font-bold transition shadow-2xs" data-i18n-de="Open" data-i18n-en="Open">Open</a>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js Render Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Monthly Volume & Orders Bar/Line Chart
        const ctxVolume = document.getElementById('monthlyVolumeChart');
        if (ctxVolume) {
            new Chart(ctxVolume, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            type: 'line',
                            label: 'Inquiries Trend',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
                            borderColor: '#0f172a',
                            borderWidth: 2.5,
                            tension: 0.4,
                            pointBackgroundColor: '#0f172a',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            order: 1
                        },
                        {
                            type: 'bar',
                            label: 'Store Orders',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, {{ max(1, $ordersCount) }}, 0, 0, 0],
                            backgroundColor: '#e05638',
                            borderRadius: 6,
                            barThickness: 28,
                            order: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } }
                        },
                        y: {
                            grid: { color: '#f1f5f9' },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' }, stepSize: 5 }
                        }
                    }
                }
            });
        }

        // 2. Category Share Donut Chart
        const ctxShare = document.getElementById('categoryShareChart');
        if (ctxShare) {
            new Chart(ctxShare, {
                type: 'doughnut',
                data: {
                    labels: ['Premium Leather Goods'],
                    datasets: [{
                        data: [100],
                        backgroundColor: ['#e05638'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '78%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });
        }
    });
</script>
@endsection
