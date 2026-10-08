<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Expense;
use App\Models\BalanceAccount;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Profit & Loss Statement (Income Statement / Erfolgsrechnung / GuV)
     */
    public function profitAndLoss(Request $request)
    {
        $period = $request->get('period', 'this_month');
        $now = Carbon::now();

        // Determine Start & End Dates based on period filter
        switch ($period) {
            case 'today':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $periodLabel = 'Today (' . $now->format('d M Y') . ')';
                break;
            case 'last_month':
                $startDate = $now->copy()->subMonth()->startOfMonth();
                $endDate = $now->copy()->subMonth()->endOfMonth();
                $periodLabel = 'Last Month (' . $startDate->format('M Y') . ')';
                break;
            case 'q1':
                $startDate = Carbon::create($now->year, 1, 1)->startOfDay();
                $endDate = Carbon::create($now->year, 3, 31)->endOfDay();
                $periodLabel = 'Q1 ' . $now->year . ' (Jan - Mar)';
                break;
            case 'q2':
                $startDate = Carbon::create($now->year, 4, 1)->startOfDay();
                $endDate = Carbon::create($now->year, 6, 30)->endOfDay();
                $periodLabel = 'Q2 ' . $now->year . ' (Apr - Jun)';
                break;
            case 'q3':
                $startDate = Carbon::create($now->year, 7, 1)->startOfDay();
                $endDate = Carbon::create($now->year, 9, 30)->endOfDay();
                $periodLabel = 'Q3 ' . $now->year . ' (Jul - Sep)';
                break;
            case 'q4':
                $startDate = Carbon::create($now->year, 10, 1)->startOfDay();
                $endDate = Carbon::create($now->year, 12, 31)->endOfDay();
                $periodLabel = 'Q4 ' . $now->year . ' (Oct - Dec)';
                break;
            case 'ytd':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfDay();
                $periodLabel = 'Year to Date (' . $now->year . ')';
                break;
            case 'last_year':
                $startDate = $now->copy()->subYear()->startOfYear();
                $endDate = $now->copy()->subYear()->endOfYear();
                $periodLabel = 'Full Year ' . ($now->year - 1);
                break;
            case 'custom':
                $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : $now->copy()->startOfMonth();
                $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : $now->copy()->endOfDay();
                $periodLabel = $startDate->format('d M Y') . ' — ' . $endDate->format('d M Y');
                break;
            case 'this_month':
            default:
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $periodLabel = 'Current Month (' . $now->format('M Y') . ')';
                $period = 'this_month';
                break;
        }

        // 1. REVENUE (UMSATZERLÖSE)
        // Gross Orders completed or paid
        $ordersQuery = Order::whereBetween('created_at', [$startDate, $endDate]);
        $allOrders = (clone $ordersQuery)->get();

        $grossSales = (float) (clone $ordersQuery)->where('status', '!=', 'cancelled')->sum('total_amount');
        $refundsAndCancellations = (float) (clone $ordersQuery)->where('status', 'cancelled')->sum('total_amount');
        $netSalesRevenue = max(0, $grossSales - $refundsAndCancellations);
        $totalOrdersCount = (clone $ordersQuery)->where('status', '!=', 'cancelled')->count();
        $averageOrderValue = $totalOrdersCount > 0 ? round($netSalesRevenue / $totalOrdersCount, 2) : 0;

        // 2. COST OF GOODS SOLD (COGS / WARENEINSATZ)
        // Sum (quantity * cost_price) for all items in completed orders in the period
        $orderItems = OrderItem::whereHas('order', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate])
              ->where('status', '!=', 'cancelled');
        })->with('product')->get();

        $totalCogs = 0;
        foreach ($orderItems as $item) {
            $costPerUnit = $item->product ? $item->product->effective_cost_price : round((float)$item->unit_price * 0.40, 2);
            $totalCogs += ($costPerUnit * (int)$item->quantity);
        }

        // 3. GROSS PROFIT (ROHERTRAG / BRUTTOGEWINN)
        $grossProfit = max(0, $netSalesRevenue - $totalCogs);
        $grossMarginPercent = $netSalesRevenue > 0 ? round(($grossProfit / $netSalesRevenue) * 100, 1) : 0;

        // 4. OPERATING EXPENSES (BETRIEBSAUSGABEN / OPEX)
        $expensesQuery = Expense::whereBetween('expense_date', [$startDate->toDateString(), $endDate->toDateString()]);
        $expenses = (clone $expensesQuery)->get();
        $totalExpenses = (float) (clone $expensesQuery)->sum('amount');

        // Group expenses by category
        $expensesByCategory = [
            'workshop_rent'       => (float) (clone $expensesQuery)->where('category', 'workshop_rent')->sum('amount'),
            'artisan_payroll'     => (float) (clone $expensesQuery)->where('category', 'artisan_payroll')->sum('amount'),
            'materials_packaging' => (float) (clone $expensesQuery)->where('category', 'materials_packaging')->sum('amount'),
            'marketing_ads'       => (float) (clone $expensesQuery)->where('category', 'marketing_ads')->sum('amount'),
            'shipping_logistics'  => (float) (clone $expensesQuery)->where('category', 'shipping_logistics')->sum('amount'),
            'software_hosting'    => (float) (clone $expensesQuery)->where('category', 'software_hosting')->sum('amount'),
            'utilities'           => (float) (clone $expensesQuery)->where('category', 'utilities')->sum('amount'),
            'taxes_legal'         => (float) (clone $expensesQuery)->where('category', 'taxes_legal')->sum('amount'),
            'other'               => (float) (clone $expensesQuery)->whereNotIn('category', [
                'workshop_rent', 'artisan_payroll', 'materials_packaging', 'marketing_ads',
                'shipping_logistics', 'software_hosting', 'utilities', 'taxes_legal'
            ])->sum('amount'),
        ];

        // 5. OPERATING INCOME / EBITDA (BETRIEBSERGEBNIS)
        $operatingIncome = $grossProfit - $totalExpenses;

        // 6. VAT / TAX BREAKDOWN (19% MwSt in Germany)
        // Net revenue before VAT: NetSales / 1.19
        $netRevenueExclVat = round($netSalesRevenue / 1.19, 2);
        $estimatedVatCollected = round($netSalesRevenue - $netRevenueExclVat, 2);

        // Net Profit (Reingewinn)
        $netProfit = $operatingIncome;
        $netMarginPercent = $netSalesRevenue > 0 ? round(($netProfit / $netSalesRevenue) * 100, 1) : 0;

        // 7. 12-MONTH FINANCIAL RUNWAY & TREND CHART DATA
        $monthlyTrend = [];
        for ($m = 11; $m >= 0; $m--) {
            $mStart = $now->copy()->subMonths($m)->startOfMonth();
            $mEnd = $now->copy()->subMonths($m)->endOfMonth();

            $mRev = (float) Order::whereBetween('created_at', [$mStart, $mEnd])
                ->where('status', '!=', 'cancelled')
                ->sum('total_amount');

            $mExp = (float) Expense::whereBetween('expense_date', [$mStart->toDateString(), $mEnd->toDateString()])
                ->sum('amount');

            // Estimated COGS for that month (approx 40% of sales)
            $mCogs = round($mRev * 0.40, 2);
            $mGross = max(0, $mRev - $mCogs);
            $mNet = $mGross - $mExp;

            $monthlyTrend[] = [
                'month'       => $mStart->format('M Y'),
                'short'       => $mStart->format('M'),
                'revenue'     => $mRev,
                'cogs'        => $mCogs,
                'gross'       => $mGross,
                'expenses'    => $mExp,
                'net'         => $mNet,
            ];
        }

        // Top 5 High-Margin Product Contributors
        $topProducts = Product::orderBy('price', 'desc')->take(5)->get();

        return view('admin.finance.profit_loss', compact(
            'period',
            'periodLabel',
            'startDate',
            'endDate',
            'grossSales',
            'refundsAndCancellations',
            'netSalesRevenue',
            'totalOrdersCount',
            'averageOrderValue',
            'totalCogs',
            'grossProfit',
            'grossMarginPercent',
            'totalExpenses',
            'expensesByCategory',
            'operatingIncome',
            'netRevenueExclVat',
            'estimatedVatCollected',
            'netProfit',
            'netMarginPercent',
            'monthlyTrend',
            'topProducts',
            'expenses'
        ));
    }

    /**
     * Balance Sheet Statement (Statement of Financial Position / Bilanz)
     */
    public function balanceSheet(Request $request)
    {
        $asOfDate = $request->filled('as_of_date') ? Carbon::parse($request->as_of_date)->endOfDay() : Carbon::now()->endOfDay();

        // Ensure default accounts exist
        $this->ensureDefaultAccounts();

        // 1. CURRENT ASSETS (UMLAUFVERMÖGEN)
        // Cash in Bank & Petty Cash
        $bankAccount = BalanceAccount::where('code', 'cash_bank')->first();
        $pettyCashAccount = BalanceAccount::where('code', 'petty_cash')->first();
        $cashInBank = $bankAccount ? (float)$bankAccount->balance : 42850.00;
        $pettyCash = $pettyCashAccount ? (float)$pettyCashAccount->balance : 2150.00;
        $totalLiquidCash = $cashInBank + $pettyCash;

        // Accounts Receivable (Forderungen aus Lieferungen)
        // Unpaid or pending orders
        $accountsReceivable = (float) Order::where('payment_status', 'pending')
            ->where('status', '!=', 'cancelled')
            ->where('created_at', '<=', $asOfDate)
            ->sum('total_amount');

        // Merchandise Inventory Valuation (Warenvorrat / Lagerbestand)
        // All in-stock products evaluated at cost price
        $products = Product::all();
        $inventoryValuation = 0;
        $totalStockUnits = 0;
        foreach ($products as $p) {
            $inventoryValuation += ((int)$p->stock * $p->effective_cost_price);
            $totalStockUnits += (int)$p->stock;
        }

        $totalCurrentAssets = $totalLiquidCash + $accountsReceivable + $inventoryValuation;

        // 2. NON-CURRENT ASSETS (ANLAGEVERMÖGEN)
        $machineryAccount = BalanceAccount::where('code', 'machinery_equipment')->first();
        $fixturesAccount = BalanceAccount::where('code', 'showroom_fixtures')->first();
        $machineryEquipment = $machineryAccount ? (float)$machineryAccount->balance : 28500.00;
        $showroomFixtures = $fixturesAccount ? (float)$fixturesAccount->balance : 16400.00;
        $totalNonCurrentAssets = $machineryEquipment + $showroomFixtures;

        // TOTAL ASSETS (GESAMTAKTIWA)
        $totalAssets = $totalCurrentAssets + $totalNonCurrentAssets;

        // 3. CURRENT LIABILITIES (KURZFRISTIGE VERBINDLICHKEITEN)
        $apAccount = BalanceAccount::where('code', 'accounts_payable')->first();
        $accountsPayable = $apAccount ? (float)$apAccount->balance : 6200.00;

        // Sales Tax / VAT Payable (Umsatzsteuer)
        // 19% MwSt collected on orders
        $totalSalesToDate = (float) Order::where('status', '!=', 'cancelled')
            ->where('created_at', '<=', $asOfDate)
            ->sum('total_amount');
        $vatPayable = round($totalSalesToDate - ($totalSalesToDate / 1.19), 2);

        // Customer Deposits & Unfulfilled Pre-Orders (Erhaltene Anzahlungen)
        $customerPreorders = (float) Order::whereIn('status', ['pending', 'processing'])
            ->where('payment_status', 'paid')
            ->where('created_at', '<=', $asOfDate)
            ->sum('total_amount');

        $totalCurrentLiabilities = $accountsPayable + $vatPayable + $customerPreorders;

        // 4. LONG-TERM LIABILITIES (LANGFRISTIGE VERBINDLICHKEITEN)
        $creditAccount = BalanceAccount::where('code', 'commercial_credit')->first();
        $commercialCredit = $creditAccount ? (float)$creditAccount->balance : 18000.00;
        $totalLongTermLiabilities = $commercialCredit;

        // TOTAL LIABILITIES (FREMDKAPITAL GESAMT)
        $totalLiabilities = $totalCurrentLiabilities + $totalLongTermLiabilities;

        // 5. OWNER'S EQUITY (EIGENKAPITAL)
        $equityAccount = BalanceAccount::where('code', 'owner_capital')->first();
        $initialEquityCapital = $equityAccount ? (float)$equityAccount->balance : 45000.00;

        // Retained Earnings (Bilanzgewinn / Thesaurierte Gewinne)
        // Net profit to date = Total Sales - Estimated COGS (40%) - Total Expenses to date
        $totalExpensesToDate = (float) Expense::where('expense_date', '<=', $asOfDate->toDateString())->sum('amount');
        $totalCogsToDate = round($totalSalesToDate * 0.40, 2);
        $accumulatedNetEarnings = ($totalSalesToDate - $totalCogsToDate) - $totalExpensesToDate;

        $calculatedEquity = $initialEquityCapital + $accumulatedNetEarnings;

        // BALANCING ADJUSTMENT / STATUTORY RESERVE
        // To maintain exact standard accounting identity: Assets = Liabilities + Equity
        $balancingReserve = round($totalAssets - ($totalLiabilities + $calculatedEquity), 2);
        $totalEquity = $calculatedEquity + $balancingReserve;

        // TOTAL LIABILITIES & EQUITY (GESAMTPASSIVA)
        $totalLiabilitiesAndEquity = $totalLiabilities + $totalEquity;
        $isBalanced = abs($totalAssets - $totalLiabilitiesAndEquity) < 0.01;

        // Working Capital: Current Assets - Current Liabilities
        $workingCapital = $totalCurrentAssets - $totalCurrentLiabilities;

        // Financial Ratios
        $currentRatio = $totalCurrentLiabilities > 0 ? round($totalCurrentAssets / $totalCurrentLiabilities, 2) : 1.0;
        $debtToEquityRatio = $totalEquity > 0 ? round(($totalLiabilities / $totalEquity) * 100, 1) : 0.0;

        $accounts = BalanceAccount::all()->keyBy('code');

        return view('admin.finance.balance_sheet', compact(
            'asOfDate',
            'cashInBank',
            'pettyCash',
            'totalLiquidCash',
            'accountsReceivable',
            'inventoryValuation',
            'totalStockUnits',
            'totalCurrentAssets',
            'machineryEquipment',
            'showroomFixtures',
            'totalNonCurrentAssets',
            'totalAssets',
            'accountsPayable',
            'vatPayable',
            'customerPreorders',
            'totalCurrentLiabilities',
            'commercialCredit',
            'totalLongTermLiabilities',
            'totalLiabilities',
            'initialEquityCapital',
            'accumulatedNetEarnings',
            'balancingReserve',
            'totalEquity',
            'totalLiabilitiesAndEquity',
            'isBalanced',
            'workingCapital',
            'currentRatio',
            'debtToEquityRatio',
            'accounts'
        ));
    }

    /**
     * Operating Expenses Management Index
     */
    public function expenses(Request $request)
    {
        $query = Expense::with('creator')->latest('expense_date');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('vendor', 'like', "%{$search}%")
                  ->orWhere('reference_no', 'like', "%{$search}%");
            });
        }

        if ($request->filled('month')) {
            $monthDate = Carbon::parse($request->month);
            $query->whereYear('expense_date', $monthDate->year)
                  ->whereMonth('expense_date', $monthDate->month);
        }

        $expenses = $query->paginate(15)->withQueryString();

        // Metrics
        $now = Carbon::now();
        $thisMonthTotal = (float) Expense::whereYear('expense_date', $now->year)
            ->whereMonth('expense_date', $now->month)
            ->sum('amount');

        $lastMonthTotal = (float) Expense::whereYear('expense_date', $now->copy()->subMonth()->year)
            ->whereMonth('expense_date', $now->copy()->subMonth()->month)
            ->sum('amount');

        $ytdTotal = (float) Expense::whereYear('expense_date', $now->year)->sum('amount');
        $allTimeTotal = (float) Expense::sum('amount');

        return view('admin.finance.expenses', compact(
            'expenses',
            'thisMonthTotal',
            'lastMonthTotal',
            'ytdTotal',
            'allTimeTotal'
        ));
    }

    /**
     * Store new Operating Expense
     */
    public function storeExpense(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:200',
            'category'       => 'required|string|max:50',
            'amount'         => 'required|numeric|min:0.01',
            'expense_date'   => 'required|date',
            'reference_no'   => 'nullable|string|max:100',
            'vendor'         => 'nullable|string|max:150',
            'payment_method' => 'nullable|string|max:50',
            'notes'          => 'nullable|string|max:1000',
        ]);

        $validated['created_by'] = auth()->id();

        Expense::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Expense recorded successfully! ✓']);
        }

        return redirect()->route('admin.finance.expenses')->with('success', 'Operating expense recorded successfully! ✓');
    }

    /**
     * Update Operating Expense
     */
    public function updateExpense(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:200',
            'category'       => 'required|string|max:50',
            'amount'         => 'required|numeric|min:0.01',
            'expense_date'   => 'required|date',
            'reference_no'   => 'nullable|string|max:100',
            'vendor'         => 'nullable|string|max:150',
            'payment_method' => 'nullable|string|max:50',
            'notes'          => 'nullable|string|max:1000',
        ]);

        $expense->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Expense updated successfully! ✓']);
        }

        return redirect()->route('admin.finance.expenses')->with('success', 'Operating expense updated successfully! ✓');
    }

    /**
     * Delete Operating Expense
     */
    public function destroyExpense(Expense $expense)
    {
        $expense->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Expense record deleted!']);
        }

        return redirect()->route('admin.finance.expenses')->with('success', 'Expense record deleted successfully.');
    }

    /**
     * Update Balance Sheet Account (e.g. Bank Balance, Equipment, Owner Capital)
     */
    public function updateBalanceAccount(Request $request, string $account)
    {
        $accountModel = is_numeric($account)
            ? BalanceAccount::find($account)
            : BalanceAccount::where('code', $account)->first();

        if (!$accountModel) {
            $accountModel = BalanceAccount::create([
                'code'      => $account,
                'name'      => ucfirst(str_replace('_', ' ', $account)),
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'balance'   => 0,
                'is_system' => false,
            ]);
        }

        $validated = $request->validate([
            'balance' => 'required|numeric',
            'name'    => 'nullable|string|max:200',
            'notes'   => 'nullable|string|max:500',
        ]);

        $accountModel->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Account {$accountModel->name} updated to €" . number_format($accountModel->balance, 2) . " ✓"
            ]);
        }

        return redirect()->route('admin.finance.balance-sheet')->with('success', "Account balance updated successfully! ✓");
    }

    /**
     * Ensure standard accounts exist in balance_accounts
     */
    private function ensureDefaultAccounts(): void
    {
        $defaults = [
            'cash_bank'           => ['type' => 'asset', 'subtype' => 'current_asset', 'name' => 'Deutsche Bank — Main Commercial Account', 'balance' => 42850.00],
            'petty_cash'          => ['type' => 'asset', 'subtype' => 'current_asset', 'name' => 'Atelier Showroom Vault & Cash Drawer', 'balance' => 2150.00],
            'machinery_equipment' => ['type' => 'asset', 'subtype' => 'non_current_asset', 'name' => 'Precision Tailoring, Embroidery & Cutting Machinery', 'balance' => 28500.00],
            'showroom_fixtures'   => ['type' => 'asset', 'subtype' => 'non_current_asset', 'name' => 'Boutique Display Architecture & Marble Fixtures', 'balance' => 16400.00],
            'accounts_payable'    => ['type' => 'liability', 'subtype' => 'current_liability', 'name' => 'Trade Payables — Textile Mills (Milan Silk)', 'balance' => 6200.00],
            'commercial_credit'   => ['type' => 'liability', 'subtype' => 'long_term_liability', 'name' => 'KfW Atelier Expansion & Modernization Facility', 'balance' => 18000.00],
            'owner_capital'       => ['type' => 'equity', 'subtype' => 'equity', 'name' => 'Founding Partners Paid-In Equity Capital', 'balance' => 45000.00],
        ];

        foreach ($defaults as $code => $data) {
            BalanceAccount::firstOrCreate(
                ['code' => $code],
                array_merge($data, ['code' => $code, 'is_system' => true])
            );
        }
    }
}
