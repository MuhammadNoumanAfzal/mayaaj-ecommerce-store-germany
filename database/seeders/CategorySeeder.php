<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Leder Taschen',
                'slug' => 'leder-taschen',
                'description' => 'Exklusive Handtaschen, Shopper & Rucksäcke aus feinstem Vollleder aus Düsseldorf.',
                'image' => 'productbag.png',
                'status' => 'active',
                'order_index' => 1,
                'subcategories' => [
                    ['name' => 'Handtaschen', 'description' => 'Elegante Damen-Handtaschen mit Echtgold-Beschlägen.'],
                    ['name' => 'Shopper & Totes', 'description' => 'Geräumige Business-Shopper für den täglichen Luxus.'],
                    ['name' => 'Lederrucksäcke', 'description' => 'Feinsattler-Rucksäcke mit Laptop-Fach.'],
                    ['name' => 'Reisetaschen & Duffles', 'description' => 'Wochenend-Reisetaschen aus Rindsleder.'],
                ]
            ],
            [
                'name' => 'Geldbörsen & Etuis',
                'slug' => 'geldboersen-etuis',
                'description' => 'Kompakte Damen- & Herren-Geldbörsen, Kreditkartenetuis & Schlüsseltaschen.',
                'image' => 'productwallet.png',
                'status' => 'active',
                'order_index' => 2,
                'subcategories' => [
                    ['name' => 'Damen Geldbörsen', 'description' => 'Reißverschluss-Geldbörsen mit RFID-Schutz.'],
                    ['name' => 'Herren Scheineben', 'description' => 'Klassische Herren-Portemonnaies in Schwarz & Braun.'],
                    ['name' => 'Kartenetuis & MagSafe', 'description' => 'Schlanke MagSafe-Lederetuis für Smartphones.'],
                ]
            ],
            [
                'name' => 'Schmuck & Uhren',
                'slug' => 'schmuck-uhren',
                'description' => 'Manufaktur-Automatikuhrwerke, Leder-Armbänder & vergoldete Accessoires.',
                'image' => 'product_watch.png',
                'status' => 'active',
                'order_index' => 3,
                'subcategories' => [
                    ['name' => 'Automatikuhren', 'description' => 'Schweizer Chronographen mit Lederarmband.'],
                    ['name' => 'Lederarmbänder', 'description' => 'Handgeflochtene Leder-Armbänder mit Goldverschluss.'],
                ]
            ],
            [
                'name' => 'Gürtel & Accessoires',
                'slug' => 'guertel-accessoires',
                'description' => 'Wendegürtel aus Saffiano-Leder, Schlüsselanhänger & Lederpflegemittel.',
                'image' => 'productbag.png',
                'status' => 'active',
                'order_index' => 4,
                'subcategories' => [
                    ['name' => 'Herrengürtel', 'description' => 'Maßgeschneiderte Automatikgürtel.'],
                    ['name' => 'Lederpflege & Bienenwachs', 'description' => 'Natürliche Pflegebalsame für Langlebigkeit.'],
                ]
            ],
        ];

        foreach ($categories as $catData) {
            $subcats = $catData['subcategories'] ?? [];
            unset($catData['subcategories']);

            $category = Category::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($subcats as $subData) {
                Subcategory::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'slug' => Str::slug($subData['name'])
                    ],
                    [
                        'name' => $subData['name'],
                        'description' => $subData['description'],
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
