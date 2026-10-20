<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BalanceAccount;

class FinancialSeeder extends Seeder
{
    /**
     * Run the database seeds for Finance module.
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
                'balance'   => 0.00,
                'notes'     => 'Primary liquid operating account for online payments and merchant settlements.',
                'is_system' => true,
            ],
            [
                'code'      => 'petty_cash',
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'name'      => 'Showroom Vault & Cash Drawer',
                'balance'   => 0.00,
                'notes'     => 'Physical petty cash for showroom logistics and courier payments.',
                'is_system' => false,
            ],
            [
                'code'      => 'machinery_equipment',
                'type'      => 'asset',
                'subtype'   => 'non_current_asset',
                'name'      => 'Precision Tailoring, Machinery & Equipment',
                'balance'   => 0.00,
                'notes'     => 'Tailoring and craft machinery.',
                'is_system' => false,
            ],
            [
                'code'      => 'showroom_fixtures',
                'type'      => 'asset',
                'subtype'   => 'non_current_asset',
                'name'      => 'Boutique Display Architecture & Fixtures',
                'balance'   => 0.00,
                'notes'     => 'Architectural fixtures and display units.',
                'is_system' => false,
            ],
            [
                'code'      => 'accounts_payable',
                'type'      => 'liability',
                'subtype'   => 'current_liability',
                'name'      => 'Trade Payables & Supplier Invoices',
                'balance'   => 0.00,
                'notes'     => 'Supplier trade payables.',
                'is_system' => true,
            ],
            [
                'code'      => 'commercial_credit',
                'type'      => 'liability',
                'subtype'   => 'long_term_liability',
                'name'      => 'Commercial Credit Facility',
                'balance'   => 0.00,
                'notes'     => 'Commercial credit lines.',
                'is_system' => false,
            ],
            [
                'code'      => 'owner_capital',
                'type'      => 'equity',
                'subtype'   => 'equity',
                'name'      => 'Owner & Partner Equity Capital',
                'balance'   => 0.00,
                'notes'     => 'Committed equity capital.',
                'is_system' => true,
            ],
        ];

        foreach ($defaultAccounts as $acc) {
            BalanceAccount::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // Dummy expenses and orders removed.
    }
}
