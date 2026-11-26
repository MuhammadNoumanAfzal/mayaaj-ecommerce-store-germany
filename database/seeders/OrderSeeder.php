<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        if ($products->count() < 2) {
            return;
        }

        $tote = $products->first();
        $watch = $products->skip(1)->first() ?? $tote;
        $scarf = $products->skip(2)->first() ?? $tote;
        $wallet = $products->skip(3)->first() ?? $tote;

        // Order 1: Vorkasse (Prepayment) Pending
        $order1 = Order::updateOrCreate(
            ['order_number' => 'MHJ-2026-8841'],
            [
                'customer_name' => 'Maximilian von Berg',
                'customer_email' => 'm.vonberg@berlin-atelier.de',
                'customer_phone' => '+49 171 8921034',
                'shipping_address' => 'Kurfürstendamm 182, 3. OG',
                'city' => 'Berlin',
                'postal_code' => '10707',
                'country' => 'Deutschland',
                'subtotal' => 1150.00,
                'discount_amount' => 0.00,
                'total_amount' => 1150.00,
                'payment_method' => 'vorkasse',
                'payment_status' => 'pending',
                'status' => 'pending',
                'notes' => 'Kunde bittet um Vorkasse-Rechnung per E-Mail.',
            ]
        );

        OrderItem::firstOrCreate([
            'order_id' => $order1->id,
            'product_name' => $tote->name,
        ], [
            'product_id' => $tote->id,
            'unit_price' => 1150.00,
            'quantity' => 1,
            'subtotal' => 1150.00,
        ]);

        // Order 2: Vorkasse Paid & Receipt Attached, In Processing
        $order2 = Order::updateOrCreate(
            ['order_number' => 'MHJ-2026-8842'],
            [
                'customer_name' => 'Dr. Sophia Lindner',
                'customer_email' => 'sophia.lindner@muenchen-klinik.de',
                'customer_phone' => '+49 89 4510298',
                'shipping_address' => 'Maximilianstraße 42',
                'city' => 'München',
                'postal_code' => '80539',
                'country' => 'Deutschland',
                'subtotal' => 3770.00,
                'discount_amount' => 0.00,
                'total_amount' => 3770.00,
                'payment_method' => 'vorkasse',
                'payment_status' => 'paid',
                'status' => 'processing',
                'payment_receipt_path' => '/storage/receipts/commerzbank_wire_receipt_8842.pdf',
                'notes' => 'Vorkasse-Zahlungseingang per Commerzbank bestätigt.',
            ]
        );

        OrderItem::firstOrCreate([
            'order_id' => $order2->id,
            'product_name' => $watch->name,
        ], [
            'product_id' => $watch->id,
            'unit_price' => 3450.00,
            'quantity' => 1,
            'subtotal' => 3450.00,
        ]);

        // Order 3: Shipped via DHL Express with Live Tracking
        $dhlTracking = '00340434161094042898';
        $order3 = Order::updateOrCreate(
            ['order_number' => 'MHJ-2026-8843'],
            [
                'customer_name' => 'Alexander Hoffmann',
                'customer_email' => 'a.hoffmann@hamburg-shipping.de',
                'customer_phone' => '+49 40 7712390',
                'shipping_address' => 'Elbchaussee 114',
                'city' => 'Hamburg',
                'postal_code' => '22763',
                'country' => 'Deutschland',
                'subtotal' => 290.00,
                'discount_amount' => 0.00,
                'total_amount' => 290.00,
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'status' => 'shipped',
                'courier_name' => 'DHL Express',
                'tracking_number' => $dhlTracking,
                'tracking_url' => Order::buildTrackingUrl('DHL Express', $dhlTracking),
                'dispatched_at' => Carbon::now()->subHours(18),
                'notes' => 'Versendet via DHL Express GoGreen versichert.',
            ]
        );

        OrderItem::firstOrCreate([
            'order_id' => $order3->id,
            'product_name' => $wallet->name,
        ], [
            'product_id' => $wallet->id,
            'unit_price' => 290.00,
            'quantity' => 1,
            'subtotal' => 290.00,
        ]);

        // Order 4: Delivered via Hermes
        $hermesTracking = 'H100239481239';
        $order4 = Order::updateOrCreate(
            ['order_number' => 'MHJ-2026-8844'],
            [
                'customer_name' => 'Katharina von Schlosser',
                'customer_email' => 'k.schlosser@vienna-palace.at',
                'customer_phone' => '+43 1 5123901',
                'shipping_address' => 'Herrengasse 19',
                'city' => 'Wien',
                'postal_code' => '1010',
                'country' => 'Österreich',
                'subtotal' => 380.00,
                'discount_amount' => 0.00,
                'total_amount' => 380.00,
                'payment_method' => 'vorkasse',
                'payment_status' => 'paid',
                'status' => 'delivered',
                'courier_name' => 'Hermes Logistik',
                'tracking_number' => $hermesTracking,
                'tracking_url' => Order::buildTrackingUrl('Hermes', $hermesTracking),
                'dispatched_at' => Carbon::now()->subDays(3),
                'delivered_at' => Carbon::now()->subHours(8),
                'notes' => 'Zustellung an Empfängerin persönlich erfolgt.',
            ]
        );

        OrderItem::firstOrCreate([
            'order_id' => $order4->id,
            'product_name' => $scarf->name,
        ], [
            'product_id' => $scarf->id,
            'unit_price' => 380.00,
            'quantity' => 1,
            'subtotal' => 380.00,
        ]);
    }
}
