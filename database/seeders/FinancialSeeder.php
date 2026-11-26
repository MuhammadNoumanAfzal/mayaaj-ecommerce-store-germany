<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BalanceAccount;
use App\Models\Expense;
use Carbon\Carbon;

class FinancialSeeder extends Seeder
{
    /**
     * Run the database seeds for Finance & Analytics module.
     */
    public function run(): void
    {
        // 1. Seed Default Balance Accounts
        $defaultAccounts = [
            [
                'code'      => 'cash_bank',
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'name'      => 'Main Atelier Operating Account',
                'balance'   => 28500.00,
                'notes'     => 'Primary liquid operating account for online payments and merchant settlements.',
                'is_system' => true,
            ],
            [
                'code'      => 'petty_cash',
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'name'      => 'Showroom Vault & Cash Drawer',
                'balance'   => 1200.00,
                'notes'     => 'Physical petty cash for showroom logistics and courier payments.',
                'is_system' => false,
            ],
            [
                'code'      => 'accounts_payable',
                'type'      => 'liability',
                'subtype'   => 'current_liability',
                'name'      => 'Trade Payables & Supplier Invoices',
                'balance'   => 3400.00,
                'notes'     => 'Supplier trade payables.',
                'is_system' => true,
            ],
            [
                'code'      => 'owner_capital',
                'type'      => 'equity',
                'subtype'   => 'equity',
                'name'      => 'Owner & Partner Equity Capital',
                'balance'   => 50000.00,
                'notes'     => 'Committed equity capital.',
                'is_system' => true,
            ],
        ];

        foreach ($defaultAccounts as $acc) {
            BalanceAccount::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // 2. Seed Operational & Digital Marketing Expenses
        $expenses = [
            [
                'title' => 'Google Search & Shopping Ads — Luxury Leather Campaign',
                'category' => 'marketing_ads',
                'amount' => 850.00,
                'expense_date' => Carbon::now()->subDays(12)->toDateString(),
                'vendor' => 'Google Ireland Limited',
                'reference_no' => 'GGL-2026-98124',
                'payment_method' => 'credit_card',
                'notes' => 'High-intent search keywords for Handtaschen & Lederwaren in DACH region.',
            ],
            [
                'title' => 'Meta Instagram Retargeting — Haute Couture Collection',
                'category' => 'marketing_ads',
                'amount' => 620.00,
                'expense_date' => Carbon::now()->subDays(5)->toDateString(),
                'vendor' => 'Meta Platforms Ireland',
                'reference_no' => 'FB-ADS-2026-4410',
                'payment_method' => 'credit_card',
                'notes' => 'Dynamic cart recovery & VIP audience retargeting ads.',
            ],
            [
                'title' => 'DHL Express GoGreen Parcel Logistics Settlement',
                'category' => 'shipping_logistics',
                'amount' => 340.00,
                'expense_date' => Carbon::now()->subDays(8)->toDateString(),
                'vendor' => 'Deutsche Post DHL Group',
                'reference_no' => 'DHL-INV-2026-08',
                'payment_method' => 'bank_transfer',
                'notes' => 'Insured courier dispatches across Germany, Austria & Switzerland.',
            ],
            [
                'title' => 'Custom Embossed Velvet Dust Bags & Wax Seal Packaging',
                'category' => 'materials_packaging',
                'amount' => 480.00,
                'expense_date' => Carbon::now()->subDays(15)->toDateString(),
                'vendor' => 'Manufactura Florentina Packaging',
                'reference_no' => 'MFP-99201',
                'payment_method' => 'bank_transfer',
                'notes' => 'Atelier white-glove unboxing presentation boxes and certificates.',
            ],
            [
                'title' => 'High-Availability Cloud Hosting & SSL Security Architecture',
                'category' => 'software_hosting',
                'amount' => 149.00,
                'expense_date' => Carbon::now()->subDays(20)->toDateString(),
                'vendor' => 'Hetzner Online GmbH',
                'reference_no' => 'HTZ-88192',
                'payment_method' => 'bank_transfer',
                'notes' => 'Dedicated server instance and 256-bit encryption certificate.',
            ],
        ];

        foreach ($expenses as $item) {
            Expense::updateOrCreate(
                ['reference_no' => $item['reference_no']],
                $item
            );
        }
    }
}
