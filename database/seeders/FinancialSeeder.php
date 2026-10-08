<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Expense;
use App\Models\BalanceAccount;
use App\Models\User;
use Carbon\Carbon;

class FinancialSeeder extends Seeder
{
    /**
     * Run the database seeds for Finance module.
     */
    public function run(): void
    {
        // 1. Assign realistic cost prices to products if not yet set
        $products = Product::all();
        foreach ($products as $product) {
            if (!$product->cost_price || (float)$product->cost_price <= 0) {
                // High luxury margin: cost price is between 38% and 46% of retail price
                $costRatio = 0.40;
                $product->cost_price = round((float)$product->price * $costRatio, 2);
                $product->save();
            }
        }

        // 2. Seed Default Balance Accounts
        $defaultAccounts = [
            [
                'code'      => 'cash_bank',
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'name'      => 'Deutsche Bank — Main Atelier Commercial Account',
                'balance'   => 42850.00,
                'notes'     => 'Primary liquid operating account for online payments and merchant settlements.',
                'is_system' => true,
            ],
            [
                'code'      => 'petty_cash',
                'type'      => 'asset',
                'subtype'   => 'current_asset',
                'name'      => 'Atelier Showroom Vault & Cash Drawer',
                'balance'   => 2150.00,
                'notes'     => 'Physical petty cash for showroom logistics and courier payments.',
                'is_system' => false,
            ],
            [
                'code'      => 'machinery_equipment',
                'type'      => 'asset',
                'subtype'   => 'non_current_asset',
                'name'      => 'Precision Tailoring, Embroidery & Cutting Machinery',
                'balance'   => 28500.00,
                'notes'     => 'High-end Swiss & Japanese stitching machines and pattern plotters.',
                'is_system' => false,
            ],
            [
                'code'      => 'showroom_fixtures',
                'type'      => 'asset',
                'subtype'   => 'non_current_asset',
                'name'      => 'Boutique Display Architecture, Lighting & Marble Fixtures',
                'balance'   => 16400.00,
                'notes'     => 'Architectural fixtures, brass racks, and studio mirrors.',
                'is_system' => false,
            ],
            [
                'code'      => 'accounts_payable',
                'type'      => 'liability',
                'subtype'   => 'current_liability',
                'name'      => 'Trade Payables — Textile Mills (Milan & Lyon Silk)',
                'balance'   => 6200.00,
                'notes'     => 'Net-30 supplier invoices for raw pure silk and cashmere textiles.',
                'is_system' => true,
            ],
            [
                'code'      => 'commercial_credit',
                'type'      => 'liability',
                'subtype'   => 'long_term_liability',
                'name'      => 'KfW Atelier Expansion & Modernization Facility',
                'balance'   => 18000.00,
                'notes'     => 'Low-interest fixed long-term commercial credit line.',
                'is_system' => false,
            ],
            [
                'code'      => 'owner_capital',
                'type'      => 'equity',
                'subtype'   => 'equity',
                'name'      => 'Founding Partners Paid-In Equity Capital',
                'balance'   => 45000.00,
                'notes'     => 'Initial founding capital committed to MEHAAJ Luxury Atelier.',
                'is_system' => true,
            ],
        ];

        foreach ($defaultAccounts as $acc) {
            BalanceAccount::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // 3. Seed Realistic Atelier Operating Expenses
        if (Expense::count() === 0) {
            $adminUser = User::where('role', 'super_admin')->first();
            $adminId = $adminUser?->id ?? 1;

            $now = Carbon::now();
            $sampleExpenses = [
                // Current Month
                [
                    'title'          => 'Maximilianstraße Atelier Studio & Showroom Lease',
                    'category'       => 'workshop_rent',
                    'amount'         => 3400.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(1)->toDateString(),
                    'reference_no'   => 'RENT-' . $now->format('Ym'),
                    'vendor'         => 'Bavaria Commercial Estates GmbH',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Monthly prime showroom and artisan workshop lease.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Senior Master Artisan & Tailoring Payroll',
                    'category'       => 'artisan_payroll',
                    'amount'         => 4250.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(4)->toDateString(),
                    'reference_no'   => 'PAY-' . $now->format('Ym') . '-01',
                    'vendor'         => 'Atelier Staff Payroll Service',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Salaries for master draper, patternmaker, and hand-embroidery artisans.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Luxury Rigid Gift Boxes, Gold Foil Seals & Silk Ribbons',
                    'category'       => 'materials_packaging',
                    'amount'         => 780.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(6)->toDateString(),
                    'reference_no'   => 'BOX-7721',
                    'vendor'         => 'Luxury Papercraft Florence',
                    'payment_method' => 'credit_card',
                    'notes'          => '500 custom gold-embossed presentation boxes.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Meta Ads & Instagram Editorial Fashion Campaign',
                    'category'       => 'marketing_ads',
                    'amount'         => 1350.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(8)->toDateString(),
                    'reference_no'   => 'FB-AD-992',
                    'vendor'         => 'Meta Platforms Ireland Ltd',
                    'payment_method' => 'credit_card',
                    'notes'          => 'Targeted haute-couture audience campaign in Munich, Frankfurt & Vienna.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'DHL Express Climate-Neutral Luxury Courier Services',
                    'category'       => 'shipping_logistics',
                    'amount'         => 540.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(10)->toDateString(),
                    'reference_no'   => 'DHL-EX-4410',
                    'vendor'         => 'DHL Express Germany',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Insured door-to-door courier deliveries with white-glove option.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Cloud Server, Domain SSL & High-Speed CDN Hosting',
                    'category'       => 'software_hosting',
                    'amount'         => 145.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(2)->toDateString(),
                    'reference_no'   => 'CLOUD-2026',
                    'vendor'         => 'Hetzner Cloud GmbH',
                    'payment_method' => 'credit_card',
                    'notes'          => 'High-concurrency dedicated e-commerce cloud instance.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Showroom Ambient Lighting & Climate Control Utilities',
                    'category'       => 'utilities',
                    'amount'         => 320.00,
                    'expense_date'   => $now->copy()->startOfMonth()->addDays(5)->toDateString(),
                    'reference_no'   => 'SWM-UTIL-03',
                    'vendor'         => 'Stadtwerke München (SWM)',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Eco-electricity and climate control for silk preservation.',
                    'created_by'     => $adminId,
                ],

                // Previous Month
                [
                    'title'          => 'Maximilianstraße Atelier Studio & Showroom Lease',
                    'category'       => 'workshop_rent',
                    'amount'         => 3400.00,
                    'expense_date'   => $now->copy()->subMonth()->startOfMonth()->addDays(1)->toDateString(),
                    'reference_no'   => 'RENT-' . $now->copy()->subMonth()->format('Ym'),
                    'vendor'         => 'Bavaria Commercial Estates GmbH',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Monthly showroom lease.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Senior Master Artisan & Tailoring Payroll',
                    'category'       => 'artisan_payroll',
                    'amount'         => 4250.00,
                    'expense_date'   => $now->copy()->subMonth()->startOfMonth()->addDays(5)->toDateString(),
                    'reference_no'   => 'PAY-' . $now->copy()->subMonth()->format('Ym') . '-01',
                    'vendor'         => 'Atelier Staff Payroll Service',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Artisan payroll.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Haute Couture Editorial Lookbook Photoshoot',
                    'category'       => 'marketing_ads',
                    'amount'         => 1850.00,
                    'expense_date'   => $now->copy()->subMonth()->startOfMonth()->addDays(12)->toDateString(),
                    'reference_no'   => 'PHOTO-LOOK-26',
                    'vendor'         => 'Lumina Studio Munich',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Professional photography, studio lighting, and model styling.',
                    'created_by'     => $adminId,
                ],
                [
                    'title'          => 'Quarterly Corporate Tax & CPA Advisory Retainer',
                    'category'       => 'taxes_legal',
                    'amount'         => 950.00,
                    'expense_date'   => $now->copy()->subMonth()->startOfMonth()->addDays(18)->toDateString(),
                    'reference_no'   => 'TAX-CPA-991',
                    'vendor'         => 'Hofmann & Partner Steuerberater',
                    'payment_method' => 'bank_transfer',
                    'notes'          => 'Financial compliance, GuV review, and USt-Voranmeldung audit.',
                    'created_by'     => $adminId,
                ],
            ];

            foreach ($sampleExpenses as $exp) {
                Expense::create($exp);
            }
        }

        // 4. Seed Realistic Historical Orders if only few exist (to generate rich P&L & Balance Sheet data)
        if (\App\Models\Order::count() < 8 && $products->count() > 0) {
            $customerNames = [
                ['name' => 'Dr. Maximilian von Berg', 'email' => 'm.berg@munich-med.de', 'city' => 'München', 'country' => 'DE'],
                ['name' => 'Claire Delacroix', 'email' => 'claire.delacroix@paris-luxe.fr', 'city' => 'Paris', 'country' => 'FR'],
                ['name' => 'Sophia Lindström', 'email' => 'sophia.l@nordicdesign.se', 'city' => 'Stockholm', 'country' => 'SE'],
                ['name' => 'Freiherr Alexander von Kleist', 'email' => 'kleist.estate@berlin.de', 'city' => 'Berlin', 'country' => 'DE'],
                ['name' => 'Isabella Rossi', 'email' => 'isabella.rossi@milano-moda.it', 'city' => 'Milano', 'country' => 'IT'],
                ['name' => 'Julian H. Vance', 'email' => 'jvance@mayfair-invest.co.uk', 'city' => 'London', 'country' => 'GB'],
                ['name' => 'Beatrice von Habsburg', 'email' => 'beatrice.habsburg@wien.at', 'city' => 'Wien', 'country' => 'AT'],
                ['name' => 'Evelyn Zimmermann', 'email' => 'evelyn.zimmermann@hamburg-art.de', 'city' => 'Hamburg', 'country' => 'DE'],
            ];

            $now = Carbon::now();
            $dates = [
                $now->copy()->subDays(2),
                $now->copy()->subDays(5),
                $now->copy()->subDays(9),
                $now->copy()->subDays(14),
                $now->copy()->subMonths(1)->subDays(3),
                $now->copy()->subMonths(1)->subDays(11),
                $now->copy()->subMonths(1)->subDays(18),
                $now->copy()->subMonths(2)->subDays(7),
                $now->copy()->subMonths(2)->subDays(21),
                $now->copy()->subMonths(3)->subDays(15),
            ];

            foreach ($dates as $idx => $date) {
                $cust = $customerNames[$idx % count($customerNames)];
                // Pick 1 to 3 products
                $sampleProds = $products->random(min(rand(1, 3), $products->count()));
                $orderTotal = 0;

                $order = \App\Models\Order::create([
                    'order_number'     => 'MEH-' . $date->format('Ym') . '-' . str_pad($idx + 101, 4, '0', STR_PAD_LEFT),
                    'customer_name'    => $cust['name'],
                    'customer_email'   => $cust['email'],
                    'customer_phone'   => '+49 89 ' . rand(1000000, 9999999),
                    'shipping_address' => 'Luxury Boulevard ' . rand(10, 88),
                    'city'             => $cust['city'],
                    'postal_code'      => (string)rand(10000, 99999),
                    'country'          => $cust['country'],
                    'total_amount'     => 0, // will update
                    'payment_method'   => $idx % 3 === 0 ? 'vorkasse' : ($idx % 2 === 0 ? 'credit_card' : 'paypal'),
                    'payment_status'   => 'paid',
                    'status'           => 'delivered',
                    'notes'            => 'Signature luxury gift packaging requested.',
                    'created_at'       => $date,
                    'updated_at'       => $date,
                ]);

                foreach ($sampleProds as $prod) {
                    $qty = rand(1, 2);
                    $price = (float)$prod->price;
                    $subtotal = $price * $qty;
                    $orderTotal += $subtotal;

                    \App\Models\OrderItem::create([
                        'order_id'     => $order->id,
                        'product_id'   => $prod->id,
                        'product_name' => $prod->name,
                        'unit_price'   => $price,
                        'quantity'     => $qty,
                        'subtotal'     => $subtotal,
                        'created_at'   => $date,
                        'updated_at'   => $date,
                    ]);
                }

                $order->update(['total_amount' => $orderTotal]);
            }
        }
    }
}
