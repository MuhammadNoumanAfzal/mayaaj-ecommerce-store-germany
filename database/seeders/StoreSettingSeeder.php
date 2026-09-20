<?php

namespace Database\Seeders;

use App\Models\StoreSetting;
use Illuminate\Database\Seeder;

class StoreSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'store_name' => 'MEHAAJ Luxury Atelier',
            'store_email' => 'service@mehaaj.de',
            'store_phone' => '+49 30 8910234',
            'address' => 'Kurfürstendamm 182, D-10707 Berlin',
            'currency' => 'EUR (€)',
            'tax_rate' => '19',
            'shipping_cost' => '0.00',
            'vorkasse_bank' => 'Commerzbank Berlin',
            'vorkasse_iban' => 'DE89 3704 0044 0532 0130 00',
            'vorkasse_bic' => 'COBADEFFXXX',
            'ust_id' => 'DE 391 048 291',
        ];

        foreach ($settings as $key => $value) {
            StoreSetting::setByKey($key, $value);
        }
    }
}
