<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Dr. Sophia Lindner',
                'email' => 'sophia.lindner@muenchen-klinik.de',
                'phone' => '+49 89 4510298',
                'address' => 'Maximilianstraße 42',
                'city' => 'München',
                'postal_code' => '80539',
                'country' => 'Deutschland',
                'vip_tier' => 'platinum',
                'total_spent' => 8450.00,
                'total_orders' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Maximilian von Berg',
                'email' => 'm.vonberg@berlin-atelier.de',
                'phone' => '+49 171 8921034',
                'address' => 'Kurfürstendamm 182',
                'city' => 'Berlin',
                'postal_code' => '10707',
                'country' => 'Deutschland',
                'vip_tier' => 'gold',
                'total_spent' => 4290.00,
                'total_orders' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'Alexander Hoffmann',
                'email' => 'a.hoffmann@hamburg-shipping.de',
                'phone' => '+49 40 7712390',
                'address' => 'Elbchaussee 114',
                'city' => 'Hamburg',
                'postal_code' => '22763',
                'country' => 'Deutschland',
                'vip_tier' => 'silver',
                'total_spent' => 1850.00,
                'total_orders' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'Clara Schmidt',
                'email' => 'clara.schmidt@frankfurt-law.de',
                'phone' => '+49 69 3302910',
                'address' => 'Goethestraße 15',
                'city' => 'Frankfurt am Main',
                'postal_code' => '60313',
                'country' => 'Deutschland',
                'vip_tier' => 'gold',
                'total_spent' => 3100.00,
                'total_orders' => 4,
                'status' => 'active',
            ],
        ];

        foreach ($customers as $cust) {
            Customer::updateOrCreate(['email' => $cust['email']], $cust);
        }
    }
}
