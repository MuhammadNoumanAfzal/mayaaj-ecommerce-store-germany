<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::firstOrCreate(
            ['code' => 'MEHAAJ10'],
            [
                'description' => 'Offizieller Willkommens-Gutschein für Neukunden (-10%)',
                'type' => 'percentage',
                'value' => 10.00,
                'min_spend' => 0.00,
                'max_discount' => null,
                'usage_limit' => null,
                'is_active' => true,
            ]
        );

        Coupon::firstOrCreate(
            ['code' => 'WELCOME25'],
            [
                'description' => '25 € Sofort-Rabatt ab 100 € Mindestbestellwert',
                'type' => 'fixed',
                'value' => 25.00,
                'min_spend' => 100.00,
                'max_discount' => null,
                'usage_limit' => 500,
                'is_active' => true,
            ]
        );

        Coupon::firstOrCreate(
            ['code' => 'VIPLUXURY'],
            [
                'description' => 'Exklusiver VIP-Nachlass für Haute Couture & Zeitmesser (-15%)',
                'type' => 'percentage',
                'value' => 15.00,
                'min_spend' => 200.00,
                'max_discount' => 150.00,
                'usage_limit' => 100,
                'is_active' => true,
            ]
        );
    }
}
