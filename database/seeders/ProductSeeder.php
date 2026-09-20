<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leatherCategory = Category::where('slug', 'leder-taschen')->first();
        $jewelryCategory = Category::where('slug', 'schmuck-accessoires')->first();

        $handbagsSub = Subcategory::where('slug', 'handtaschen')->first();
        $watchesSub = Subcategory::where('slug', 'automatische-uhren')->first();

        $products = [
            [
                'name' => 'Maison Leather Tote',
                'sku' => 'MHJ-LT-001',
                'category_id' => $leatherCategory ? $leatherCategory->id : null,
                'subcategory_id' => $handbagsSub ? $handbagsSub->id : null,
                'price' => 1290.00,
                'sale_price' => 1150.00,
                'stock' => 15,
                'description' => 'Exquisite Handgefertigte Ledertasche aus feinstem vollnarbigem Kalbsleder aus italienischen Gerbereien in Florenz.',
                'craftsmanship' => 'Handgenäht nach traditioneller Feinsattler-Kunst mit vergoldeten Messing-Beschlägen.',
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Royal Gold Chronograph',
                'sku' => 'MHJ-WA-002',
                'category_id' => $jewelryCategory ? $jewelryCategory->id : null,
                'subcategory_id' => $watchesSub ? $watchesSub->id : null,
                'price' => 3450.00,
                'sale_price' => null,
                'stock' => 8,
                'description' => 'Präzisions-Automatikuhr aus 18k vergoldetem Edelstahl mit Saphirglas und Schweizer Uhrwerk.',
                'craftsmanship' => 'Schattenfreies Saphirglas, wasserdicht bis 100m, graviertes MEHAAJ Wappen.',
                'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=600&auto=format&fit=crop',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Monogram Silk Scarf',
                'sku' => 'MHJ-SC-003',
                'category_id' => $jewelryCategory ? $jewelryCategory->id : null,
                'subcategory_id' => null,
                'price' => 380.00,
                'sale_price' => 320.00,
                'stock' => 25,
                'description' => 'Reines Seidentuch mit handrollierten Kanten und exklusivem MEHAAJ Monogramm-Muster.',
                'craftsmanship' => '100% Maiglöckchen-Seide, gedruckt mit umweltfreundlichen Bio-Farben.',
                'image' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?q=80&w=600&auto=format&fit=crop',
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Heritage Wallet Cognac',
                'sku' => 'MHJ-WL-004',
                'category_id' => $leatherCategory ? $leatherCategory->id : null,
                'subcategory_id' => null,
                'price' => 290.00,
                'sale_price' => null,
                'stock' => 40,
                'description' => 'Kompaktes Herren-Geldbörsen-Modell mit RFID-Schutz und Fach für 8 Karten.',
                'craftsmanship' => 'Pflanzlich gegerbtes Leder, entwickelt eine edle Patina über die Jahre.',
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?q=80&w=600&auto=format&fit=crop',
                'is_featured' => false,
                'status' => 'active',
            ]
        ];

        foreach ($products as $item) {
            $item['slug'] = Str::slug($item['name']);
            Product::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
