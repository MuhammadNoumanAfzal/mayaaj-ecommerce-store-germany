<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deal;
use App\Models\Product;
use Carbon\Carbon;

class DealSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('status', 'active')->take(4)->get();
        if ($products->count() < 2) {
            $products = Product::take(4)->get();
        }

        if ($products->count() >= 2) {
            // Deal 1: The Executive Atelier Duo (20% off)
            $p1 = $products[0];
            $p2 = $products[1];

            $deal1 = Deal::updateOrCreate(
                ['slug' => 'executive-atelier-duo'],
                [
                    'title_en' => 'The Executive Atelier Duo',
                    'title_de' => 'Das Exekutive Atelier-Duo',
                    'badge_text' => 'BUNDLE & SAVE 20%',
                    'discount_type' => 'percentage_discount',
                    'discount_value' => 20.00,
                    'starts_at' => Carbon::now()->subDay(),
                    'ends_at' => Carbon::now()->addDays(14),
                    'is_active' => true,
                    'banner_image' => $p1->featured_image ?? null,
                ]
            );

            $deal1->products()->syncWithoutDetaching([
                $p1->id => ['is_required' => true, 'sort_order' => 1],
                $p2->id => ['is_required' => true, 'sort_order' => 2],
            ]);
        }

        if ($products->count() >= 4) {
            // Deal 2: Flash Weekend Trio (Fixed Discount 50 EUR)
            $p3 = $products[2];
            $p4 = $products[3];

            $deal2 = Deal::updateOrCreate(
                ['slug' => 'weekend-luxury-trio'],
                [
                    'title_en' => 'Weekend Luxury Heritage Set',
                    'title_de' => 'Wochenend-Luxus-Heritage-Set',
                    'badge_text' => 'FLASH DEAL - 50€ RABATT',
                    'discount_type' => 'fixed_discount',
                    'discount_value' => 50.00,
                    'starts_at' => Carbon::now()->subHours(2),
                    'ends_at' => Carbon::now()->addHours(48),
                    'is_active' => true,
                    'banner_image' => $p3->featured_image ?? null,
                ]
            );

            $deal2->products()->syncWithoutDetaching([
                $p3->id => ['is_required' => true, 'sort_order' => 1],
                $p4->id => ['is_required' => true, 'sort_order' => 2],
            ]);
        }
    }
}
