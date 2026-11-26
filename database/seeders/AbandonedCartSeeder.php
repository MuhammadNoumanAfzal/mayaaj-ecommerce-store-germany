<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AbandonedCart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AbandonedCartSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('status', 'active')->take(4)->get();
        if ($products->count() < 2) {
            return;
        }

        $p1 = $products[0];
        $p2 = $products[1];
        $p3 = $products[2] ?? $products[0];

        // Sample 1: High-Value Pending VIP Cart (Dropped off 2 hours ago)
        AbandonedCart::updateOrCreate(
            ['customer_email' => 'dr.kaufmann@art-atelier.de'],
            [
                'session_id' => 'sess_' . Str::random(24),
                'customer_name' => 'Dr. Stefan Kaufmann',
                'customer_email' => 'dr.kaufmann@art-atelier.de',
                'customer_phone' => '+491718923451',
                'cart_items' => [
                    [
                        'id' => $p2->id,
                        'name' => $p2->name,
                        'price' => (float)$p2->price,
                        'qty' => 1,
                        'image' => $p2->image,
                    ]
                ],
                'cart_total' => (float)$p2->price,
                'recovery_token' => Str::random(40),
                'recovery_status' => 'pending',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
            ]
        );

        // Sample 2: Contacted Cart via WhatsApp (Dropped off 1 day ago)
        AbandonedCart::updateOrCreate(
            ['customer_email' => 'claudia.mueller@luxury-living.ch'],
            [
                'session_id' => 'sess_' . Str::random(24),
                'customer_name' => 'Claudia Müller',
                'customer_email' => 'claudia.mueller@luxury-living.ch',
                'customer_phone' => '+41791234567',
                'cart_items' => [
                    [
                        'id' => $p1->id,
                        'name' => $p1->name,
                        'price' => (float)$p1->price,
                        'qty' => 1,
                        'image' => $p1->image,
                    ],
                    [
                        'id' => $p3->id,
                        'name' => $p3->name,
                        'price' => (float)$p3->price,
                        'qty' => 1,
                        'image' => $p3->image,
                    ]
                ],
                'cart_total' => (float)($p1->price + $p3->price),
                'recovery_token' => Str::random(40),
                'recovery_status' => 'contacted',
                'last_contacted_at' => Carbon::now()->subHours(6),
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subHours(6),
            ]
        );

        // Sample 3: Recovered Cart (Successfully checked out!)
        AbandonedCart::updateOrCreate(
            ['customer_email' => 'maximilian.bauer@finance-munich.de'],
            [
                'session_id' => 'sess_' . Str::random(24),
                'customer_name' => 'Maximilian Bauer',
                'customer_email' => 'maximilian.bauer@finance-munich.de',
                'customer_phone' => '+4915123456789',
                'cart_items' => [
                    [
                        'id' => $p1->id,
                        'name' => $p1->name,
                        'price' => (float)$p1->price,
                        'qty' => 1,
                        'image' => $p1->image,
                    ]
                ],
                'cart_total' => (float)$p1->price,
                'recovery_token' => Str::random(40),
                'recovery_status' => 'recovered',
                'recovered_at' => Carbon::now()->subHours(4),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(4),
            ]
        );
    }
}
