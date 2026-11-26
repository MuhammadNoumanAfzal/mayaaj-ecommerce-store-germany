<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'code'          => 'EUR',
                'symbol'        => '€',
                'name'          => 'Euro',
                'exchange_rate' => 1.0000,
                'is_default'    => true,
                'is_active'     => true,
            ],
            [
                'code'          => 'USD',
                'symbol'        => '$',
                'name'          => 'US Dollar',
                'exchange_rate' => 1.0800,
                'is_default'    => false,
                'is_active'     => true,
            ],
            [
                'code'          => 'GBP',
                'symbol'        => '£',
                'name'          => 'British Pound',
                'exchange_rate' => 0.8600,
                'is_default'    => false,
                'is_active'     => true,
            ],
            [
                'code'          => 'CHF',
                'symbol'        => 'CHF',
                'name'          => 'Swiss Franc',
                'exchange_rate' => 0.9600,
                'is_default'    => false,
                'is_active'     => true,
            ],
        ];

        foreach ($currencies as $curr) {
            Currency::updateOrCreate(['code' => $curr['code']], $curr);
        }

        // Seed sample wishlist item for testing
        $firstProduct = Product::where('status', 'active')->first();
        if ($firstProduct) {
            Wishlist::firstOrCreate(
                ['session_id' => 'demo_patron_session', 'product_id' => $firstProduct->id],
                ['customer_id' => null]
            );
        }
    }
}
