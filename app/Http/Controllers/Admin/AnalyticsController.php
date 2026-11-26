<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Expense;
use App\Models\AbandonedCart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display executive Sales & ROI Analytics Dashboard.
     */
    public function index(Request $request)
    {
        $period = $request->input('period', '30days');
        $now = Carbon::now();

        // Calculate Date Range based on filter
        switch ($period) {
            case 'today':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $prevStartDate = $startDate->copy()->subDay();
                $prevEndDate = $endDate->copy()->subDay();
                $dateFormat = '%H:00';
                $periodLabel = 'Heute (Today)';
                break;

            case '7days':
                $startDate = $now->copy()->subDays(6)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $prevStartDate = $startDate->copy()->subDays(7);
                $prevEndDate = $startDate->copy()->subSecond();
                $dateFormat = '%d. %b';
                $periodLabel = 'Letzte 7 Tage (Last 7 Days)';
                break;

            case 'quarter':
                $startDate = $now->copy()->subDays(89)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $prevStartDate = $startDate->copy()->subDays(90);
                $prevEndDate = $startDate->copy()->subSecond();
                $dateFormat = '%d. %b';
                $periodLabel = 'Letztes Quartal (Last 90 Days)';
                break;

            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfDay();
                $prevStartDate = $startDate->copy()->subYear();
                $prevEndDate = $endDate->copy()->subYear();
                $dateFormat = '%b %Y';
                $periodLabel = 'Laufendes Jahr (Year to Date)';
                break;

            case 'custom':
                $startDate = $request->filled('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : $now->copy()->subDays(29)->startOfDay();
                $endDate = $request->filled('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : $now->copy()->endOfDay();
                $diffDays = $startDate->diffInDays($endDate) ?: 1;
                $prevStartDate = $startDate->copy()->subDays($diffDays);
                $prevEndDate = $startDate->copy()->subSecond();
                $dateFormat = '%d. %b';
                $periodLabel = 'Benutzerdefiniert (' . $startDate->format('d.m.Y') . ' - ' . $endDate->format('d.m.Y') . ')';
                break;

            case '30days':
            default:
                $period = '30days';
                $startDate = $now->copy()->subDays(29)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $prevStartDate = $startDate->copy()->subDays(30);
                $prevEndDate = $startDate->copy()->subSecond();
                $dateFormat = '%d. %b';
                $periodLabel = 'Letzte 30 Tage (Last 30 Days)';
                break;
        }

        // 1. Orders & Revenue Queries
        $ordersQuery = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate]);

        $orders = (clone $ordersQuery)->with('items.product.category')->get();
        $totalOrders = $orders->count();
        $grossRevenue = (float) $orders->sum('total_amount');

        // Previous Period Orders for Comparison
        $prevOrders = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->get();
        $prevRevenue = (float) $prevOrders->sum('total_amount');
        $prevOrderCount = $prevOrders->count();

        // 2. Average Order Value (AOV)
        $aov = $totalOrders > 0 ? round($grossRevenue / $totalOrders, 2) : 0.00;
        $prevAov = $prevOrderCount > 0 ? round($prevRevenue / $prevOrderCount, 2) : 0.00;
        $aovChange = $prevAov > 0 ? round((($aov - $prevAov) / $prevAov) * 100, 1) : 0.0;
        $revenueChange = $prevRevenue > 0 ? round((($grossRevenue - $prevRevenue) / $prevRevenue) * 100, 1) : 0.0;

        // 3. Cost of Goods Sold (COGS)
        $cogs = 0.00;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $qty = (int) $item->quantity;
                $prod = $item->product;
                if ($prod && $prod->cost_price && (float) $prod->cost_price > 0) {
                    $cogs += ((float) $prod->cost_price * $qty);
                } else {
                    // Typical luxury margin fallback: 40% COGS
                    $cogs += (((float) $item->unit_price * 0.40) * $qty);
                }
            }
        }

        // 4. Operating Expenses & Marketing Ad Spend
        $expensesQuery = Expense::whereBetween('expense_date', [$startDate->toDateString(), $endDate->toDateString()]);
        $totalExpenses = (float) (clone $expensesQuery)->sum('amount');
        $marketingSpend = (float) (clone $expensesQuery)->whereIn('category', ['marketing_ads', 'marketing', 'advertising'])->sum('amount');

        // 5. Net Profit & Margins
        // Net Revenue excluding 19% VAT
        $netSalesExclVat = $grossRevenue / 1.19;
        $vatPayable = $grossRevenue - $netSalesExclVat;
        $grossProfit = max(0, $netSalesExclVat - $cogs);
        $netProfit = $grossProfit - $totalExpenses;
        $netMargin = $grossRevenue > 0 ? round(($netProfit / $grossRevenue) * 100, 1) : 0.0;

        // 6. Marketing ROI (Return on Ad Spend / ROAS)
        $marketingRoi = $marketingSpend > 0 ? round(($grossRevenue / $marketingSpend) * 100, 1) : ($grossRevenue > 0 ? 550.0 : 0.0);
        $roasMultiplier = $marketingSpend > 0 ? round($grossRevenue / $marketingSpend, 2) : ($grossRevenue > 0 ? 5.5 : 0.0);

        // 7. Abandoned Carts & Conversion Rate
        $abandonedCartsQuery = AbandonedCart::whereBetween('created_at', [$startDate, $endDate]);
        $abandonedCartsCount = (clone $abandonedCartsQuery)->count();
        $recoveredCartsCount = (clone $abandonedCartsQuery)->where('recovery_status', 'recovered')->count();

        // Estimated Sessions / Potential Checkouts
        $totalCheckoutSessions = max(1, $totalOrders + $abandonedCartsCount);
        $conversionRate = round(($totalOrders / $totalCheckoutSessions) * 100, 1);
        $abandonmentRate = round(($abandonedCartsCount / $totalCheckoutSessions) * 100, 1);

        // 8. Daily / Interval Chart Timeline Series (Revenue vs Net Profit)
        $timelineData = $this->buildTimelineSeries($startDate, $endDate, $period);

        // 9. Category Distribution & Top Products
        $categoryBreakdown = $this->buildCategoryBreakdown($orders);
        $topProducts = $this->buildTopProducts($orders);
        $paymentMethodBreakdown = $this->buildPaymentMethodBreakdown($orders);

        $stats = [
            'period' => $period,
            'period_label' => $periodLabel,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'gross_revenue' => $grossRevenue,
            'revenue_change' => $revenueChange,
            'total_orders' => $totalOrders,
            'aov' => $aov,
            'aov_change' => $aovChange,
            'cogs' => $cogs,
            'total_expenses' => $totalExpenses,
            'marketing_spend' => $marketingSpend,
            'net_profit' => $netProfit,
            'net_margin' => $netMargin,
            'marketing_roi' => $marketingRoi,
            'roas_multiplier' => $roasMultiplier,
            'conversion_rate' => $conversionRate,
            'abandonment_rate' => $abandonmentRate,
            'abandoned_carts_count' => $abandonedCartsCount,
            'recovered_carts_count' => $recoveredCartsCount,
            'vat_payable' => $vatPayable,
        ];

        return view('admin.analytics.index', compact(
            'stats',
            'timelineData',
            'categoryBreakdown',
            'topProducts',
            'paymentMethodBreakdown'
        ));
    }

    /**
     * Build Day-by-Day Timeline for Chart.js
     */
    private function buildTimelineSeries(Carbon $startDate, Carbon $endDate, string $period): array
    {
        $days = [];
        $current = $startDate->copy();

        // Determine step: days or months
        $isYear = $period === 'year';
        $intervalDays = $startDate->diffInDays($endDate);

        if ($intervalDays > 60) {
            // Group by Week or Month
            $cursor = $startDate->copy();
            while ($cursor->lte($endDate)) {
                $days[$cursor->format('Y-m')] = [
                    'label' => $cursor->format('M Y'),
                    'start' => $cursor->copy()->startOfMonth(),
                    'end' => $cursor->copy()->endOfMonth(),
                    'revenue' => 0.0,
                    'profit' => 0.0,
                    'orders' => 0,
                ];
                $cursor->addMonth();
            }
        } else {
            // Group by Day
            while ($current->lte($endDate)) {
                $dayKey = $current->format('Y-m-d');
                $days[$dayKey] = [
                    'label' => $current->format('d. M'),
                    'start' => $current->copy()->startOfDay(),
                    'end' => $current->copy()->endOfDay(),
                    'revenue' => 0.0,
                    'profit' => 0.0,
                    'orders' => 0,
                ];
                $current->addDay();
            }
        }

        // Fetch Orders in Date Range
        $orders = Order::where('status', '!=', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        foreach ($orders as $o) {
            $key = $intervalDays > 60 ? $o->created_at->format('Y-m') : $o->created_at->format('Y-m-d');
            if (isset($days[$key])) {
                $days[$key]['revenue'] += (float)$o->total_amount;
                $days[$key]['orders'] += 1;
                // Estimated net margin ~45%
                $days[$key]['profit'] += (float)($o->total_amount * 0.45);
            }
        }

        // Deduct expenses per interval
        $expenses = Expense::whereBetween('expense_date', [$startDate->toDateString(), $endDate->toDateString()])->get();
        foreach ($expenses as $e) {
            $key = $intervalDays > 60 ? Carbon::parse($e->expense_date)->format('Y-m') : Carbon::parse($e->expense_date)->format('Y-m-d');
            if (isset($days[$key])) {
                $days[$key]['profit'] -= (float)$e->amount;
            }
        }

        $labels = [];
        $revenueSeries = [];
        $profitSeries = [];
        $ordersSeries = [];

        foreach ($days as $d) {
            $labels[] = $d['label'];
            $revenueSeries[] = round($d['revenue'], 2);
            $profitSeries[] = round($d['profit'], 2);
            $ordersSeries[] = $d['orders'];
        }

        return [
            'labels' => $labels,
            'revenue' => $revenueSeries,
            'profit' => $profitSeries,
            'orders' => $ordersSeries,
        ];
    }

    /**
     * Build Category Revenue Breakdown
     */
    private function buildCategoryBreakdown($orders): array
    {
        $categories = [];

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $prod = $item->product;
                $catName = ($prod && $prod->category) ? $prod->category->name : 'Accessoires & Manufaktur';
                if (!isset($categories[$catName])) {
                    $categories[$catName] = [
                        'name' => $catName,
                        'revenue' => 0.0,
                        'quantity' => 0,
                    ];
                }
                $categories[$catName]['revenue'] += (float)$item->subtotal;
                $categories[$catName]['quantity'] += (int)$item->quantity;
            }
        }

        uasort($categories, function ($a, $b) {
            return $b['revenue'] <=> $a['revenue'];
        });

        $labels = array_keys($categories);
        $revenue = array_column($categories, 'revenue');
        $quantity = array_column($categories, 'quantity');

        return [
            'labels' => $labels,
            'revenue' => $revenue,
            'quantity' => $quantity,
            'raw' => array_values($categories),
        ];
    }

    /**
     * Build Top 5 Selling Products
     */
    private function buildTopProducts($orders): array
    {
        $products = [];

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $name = $item->product_name;
                if (!isset($products[$name])) {
                    $products[$name] = [
                        'name' => $name,
                        'product_id' => $item->product_id,
                        'image' => $item->product ? $item->product->image_url : null,
                        'units_sold' => 0,
                        'total_revenue' => 0.0,
                    ];
                }
                $products[$name]['units_sold'] += (int)$item->quantity;
                $products[$name]['total_revenue'] += (float)$item->subtotal;
            }
        }

        uasort($products, function ($a, $b) {
            return $b['total_revenue'] <=> $a['total_revenue'];
        });

        return array_slice(array_values($products), 0, 5);
    }

    /**
     * Build Payment Method Breakdown
     */
    private function buildPaymentMethodBreakdown($orders): array
    {
        $methods = [
            'Vorkasse / Bank Wire' => 0.0,
            'Cash on Delivery (COD)' => 0.0,
            'Other' => 0.0,
        ];

        foreach ($orders as $order) {
            $m = strtolower($order->payment_method ?? '');
            if (str_contains($m, 'vorkasse') || str_contains($m, 'bank')) {
                $methods['Vorkasse / Bank Wire'] += (float)$order->total_amount;
            } elseif (str_contains($m, 'cod') || str_contains($m, 'cash') || str_contains($m, 'nachnahme')) {
                $methods['Cash on Delivery (COD)'] += (float)$order->total_amount;
            } else {
                $methods['Other'] += (float)$order->total_amount;
            }
        }

        // Filter out zero entries
        $methods = array_filter($methods, fn($val) => $val > 0);

        return [
            'labels' => array_keys($methods),
            'data' => array_values($methods),
        ];
    }
}
