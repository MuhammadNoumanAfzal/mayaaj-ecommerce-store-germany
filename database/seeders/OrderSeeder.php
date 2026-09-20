<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $tote = $products->where('sku', 'MHJ-LT-001')->first();
        $watch = $products->where('sku', 'MHJ-WA-002')->first();
        $scarf = $products->where('sku', 'MHJ-SC-003')->first();
        $wallet = $products->where('sku', 'MHJ-WL-004')->first();

        // Order 1: Vorkasse (Prepayment) Pending
        $order1 = Order::create([
            'order_number' => 'MHJ-2026-8841',
            'customer_name' => 'Maximilian von Berg',
            'customer_email' => 'm.vonberg@berlin-atelier.de',
            'customer_phone' => '+49 171 8921034',
            'shipping_address' => 'Kurfürstendamm 182, 3. OG',
            'city' => 'Berlin',
            'postal_code' => '10707',
            'country' => 'Deutschland',
            'total_amount' => 1150.00,
            'payment_method' => 'vorkasse',
            'payment_status' => 'pending',
            'status' => 'pending',
            'notes' => 'Kunde bittet um Vorkasse-Rechnung per E-Mail.',
        ]);

        if ($tote) {
            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $tote->id,
                'product_name' => $tote->name,
                'unit_price' => 1150.00,
                'quantity' => 1,
                'subtotal' => 1150.00,
            ]);
        }

        // Order 2: Vorkasse Paid & Processing
        $order2 = Order::create([
            'order_number' => 'MHJ-2026-8842',
            'customer_name' => 'Dr. Sophia Lindner',
            'customer_email' => 'sophia.lindner@muenchen-klinik.de',
            'customer_phone' => '+49 89 4510298',
            'shipping_address' => 'Maximilianstraße 42',
            'city' => 'München',
            'postal_code' => '80539',
            'country' => 'Deutschland',
            'total_amount' => 3770.00,
            'payment_method' => 'vorkasse',
            'payment_status' => 'paid',
            'status' => 'processing',
            'notes' => 'Vorkasse-Zahlungseingang per Commerzbank am 20.09.2026 bestätigt.',
        ]);

        if ($watch) {
            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $watch->id,
                'product_name' => $watch->name,
                'unit_price' => 3450.00,
                'quantity' => 1,
                'subtotal' => 3450.00,
            ]);
        }

        if ($scarf) {
            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $scarf->id,
                'product_name' => $scarf->name,
                'unit_price' => 320.00,
                'quantity' => 1,
                'subtotal' => 320.00,
            ]);
        }

        // Order 3: Shipped Credit Card
        $order3 = Order::create([
            'order_number' => 'MHJ-2026-8843',
            'customer_name' => 'Alexander Hoffmann',
            'customer_email' => 'a.hoffmann@hamburg-shipping.de',
            'customer_phone' => '+49 40 7712390',
            'shipping_address' => 'Elbchaussee 114',
            'city' => 'Hamburg',
            'postal_code' => '22763',
            'country' => 'Deutschland',
            'total_amount' => 290.00,
            'payment_method' => 'credit_card',
            'payment_status' => 'paid',
            'status' => 'shipped',
            'notes' => 'Versendet via DHL Express Tracking #DE981023812.',
        ]);

        if ($wallet) {
            OrderItem::create([
                'order_id' => $order3->id,
                'product_id' => $wallet->id,
                'product_name' => $wallet->name,
                'unit_price' => 290.00,
                'quantity' => 1,
                'subtotal' => 290.00,
            ]);
        }
    }
}
