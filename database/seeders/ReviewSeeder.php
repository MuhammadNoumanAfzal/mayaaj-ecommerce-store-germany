<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('status', 'active')->get();
        if ($products->isEmpty()) {
            return;
        }

        $p1 = $products[0];
        $p2 = $products[1] ?? $p1;
        $p3 = $products[2] ?? $p1;

        // 1. Approved 5-Star Luxury Reviews
        Review::updateOrCreate(
            ['customer_email' => 'h.vonkleist@heidelberg-estate.de', 'product_id' => $p1->id],
            [
                'customer_name' => 'Dr. Heinrich von Kleist',
                'customer_email' => 'h.vonkleist@heidelberg-estate.de',
                'location' => 'Heidelberg, Deutschland',
                'rating' => 5,
                'title' => 'Meisterhafte Feinsattler-Qualität und zeitlose Eleganz',
                'comment' => 'Das florentinische Kalbsleder übertrifft die Erwartungen bei Weitem. Die vergoldeten Messingbeschläge und die akkuraten Handnähte zeugen von echter europäischer Manufakturkunst. Wurde standesgemäß im edlen Samt-Staubbeutel geliefert.',
                'is_verified' => true,
                'status' => 'approved',
                'created_at' => Carbon::now()->subDays(6),
            ]
        );

        Review::updateOrCreate(
            ['customer_email' => 'clara.schumann@zurich-patrons.ch', 'product_id' => $p2->id],
            [
                'customer_name' => 'Clara Schumann-Bregenz',
                'customer_email' => 'clara.schumann@zurich-patrons.ch',
                'location' => 'Zürich, Schweiz',
                'rating' => 5,
                'title' => 'Höchste Präzision — eine Uhr für Generationen',
                'comment' => 'Das Schweizer Präzisionswerk und das tiefblaue Zifferblatt mit dem MEHAAJ Wappen sind atemberaubend. Der versicherte DHL Express Kurier hat das Paket innerhalb von 24 Stunden geliefert.',
                'is_verified' => true,
                'status' => 'approved',
                'created_at' => Carbon::now()->subDays(4),
            ]
        );

        Review::updateOrCreate(
            ['customer_email' => 'maximilian.graf@wien-privat.at', 'product_id' => $p3->id],
            [
                'customer_name' => 'Maximilian Graf von Stauffen',
                'customer_email' => 'maximilian.graf@wien-privat.at',
                'location' => 'Wien, Österreich',
                'rating' => 5,
                'title' => 'Reine Seide mit handrollierten Kanten',
                'comment' => 'Ein außergewöhnliches Geschenk für meine Gattin. Der Seidenglanz und das dezente Atelier-Monogramm harmonieren perfekt mit klassischen Abendgarderoben.',
                'is_verified' => true,
                'status' => 'approved',
                'created_at' => Carbon::now()->subDays(2),
            ]
        );

        // 2. Pending Reviews Waiting in Moderation Queue (3 Items)
        Review::updateOrCreate(
            ['customer_email' => 'lukas.weber@berlin-design.de', 'product_id' => $p1->id],
            [
                'customer_name' => 'Lukas Weber',
                'customer_email' => 'lukas.weber@berlin-design.de',
                'location' => 'Berlin, Deutschland',
                'rating' => 4,
                'title' => 'Sehr schönes Leder, minimal dunkler als im Katalog',
                'comment' => 'Die Tasche ist fantastisch verarbeitet. Der Cognac-Farbton ist in Wirklichkeit etwas satter und dunkler als auf den Studiofotos, was mir persönlich sogar besser gefällt.',
                'is_verified' => true,
                'status' => 'pending',
                'created_at' => Carbon::now()->subHours(5),
            ]
        );

        Review::updateOrCreate(
            ['customer_email' => 'elena.fischer@frankfurt-law.de', 'product_id' => $p2->id],
            [
                'customer_name' => 'Elena Fischer LL.M.',
                'customer_email' => 'elena.fischer@frankfurt-law.de',
                'location' => 'Frankfurt am Main, Deutschland',
                'rating' => 5,
                'title' => 'Hervorragender Concierge-Service bei Rückfragen',
                'comment' => 'Ich hatte vor der Bestellung Fragen zur Bandlänge. Der Kundenservice via WhatsApp hat innerhalb von 5 Minuten geantwortet und die Uhr perfekt angepasst geliefert.',
                'is_verified' => true,
                'status' => 'pending',
                'created_at' => Carbon::now()->subHours(2),
            ]
        );

        // 3. Rejected Spam / Inappropriate Review
        Review::updateOrCreate(
            ['customer_email' => 'promo.bot@spamnetwork.xyz', 'product_id' => $p1->id],
            [
                'customer_name' => 'Cheap Discounts Bot',
                'customer_email' => 'promo.bot@spamnetwork.xyz',
                'location' => 'Unknown',
                'rating' => 1,
                'title' => 'Visit my coupon site for 50% discount',
                'comment' => 'Buy cheap replicas and discount coupons at spam-site-url.com',
                'is_verified' => false,
                'status' => 'rejected',
                'created_at' => Carbon::now()->subDays(8),
            ]
        );
    }
}
