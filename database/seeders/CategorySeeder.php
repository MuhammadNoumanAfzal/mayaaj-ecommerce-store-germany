<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Leder Handtaschen',
                'slug' => 'leder-handtaschen',
                'description' => 'Exklusive Handtaschen, Shopper & Schultertaschen aus feinstem Vollrindleder.',
                'image' => 'categories/luxury-handbags.png',
                'status' => 'active',
                'order_index' => 1,
                'subcategories' => [
                    ['name' => 'Klassische Handtaschen', 'image' => 'products/aurelia-structured-city-tote.png', 'description' => 'Elegante Damen-Handtaschen mit Echtgold-Beschlägen.'],
                    ['name' => 'Shopper & City Totes', 'image' => 'products/aurelia-structured-city-tote.png', 'description' => 'Geräumige Luxus-Shopper für den stilvollen Alltag.'],
                    ['name' => 'Abendtaschen & Clutches', 'image' => 'products/belle-epoque-evening-clutch.png', 'description' => 'Kompakte Clutches für exklusive Abendanlässe.'],
                    ['name' => 'Crossbody & Saddle Bags', 'image' => 'categories/luxury-handbags.png', 'description' => 'Vielseitige Umhängetaschen aus weichem Kalbsleder.'],
                ]
            ],
            [
                'name' => 'Business & Aktentaschen',
                'slug' => 'business-aktentaschen',
                'description' => 'Repräsentative Aktentaschen, Konferenzmappen und Laptop-Taschen für Führungskräfte.',
                'image' => 'categories/executive-briefcases.jpg',
                'status' => 'active',
                'order_index' => 2,
                'subcategories' => [
                    ['name' => 'Diplomaten-Aktentaschen', 'image' => 'categories/executive-briefcases.jpg', 'description' => 'Strukturierte Hartschalen- und Rahmentaschen mit Zahlenschloss.'],
                    ['name' => 'Leder-Dokumentenmappen', 'image' => 'products/atelier-leather-zip-portfolio.jpg', 'description' => 'Flache Zip-Portfolios für Verträge und iPads.'],
                    ['name' => 'Business-Messenger', 'image' => 'categories/executive-briefcases.jpg', 'description' => 'Moderne Schulter-Aktentaschen mit Laptop-Dämpfung.'],
                ]
            ],
            [
                'name' => 'Geldbörsen & Etuis',
                'slug' => 'geldboersen-etuis',
                'description' => 'Feinste Damen- & Herren-Geldbörsen, Kreditkartenetuis mit RFID-Schutz und Schlüsseltaschen.',
                'image' => 'categories/wallets.png',
                'status' => 'active',
                'order_index' => 3,
                'subcategories' => [
                    ['name' => 'Klassische Bifold Wallets', 'image' => 'categories/wallets.png', 'description' => 'Kompakte Herren-Bifolds aus Boxcalf-Leder.'],
                    ['name' => 'Reißverschluss-Geldbörsen', 'image' => 'products/atelier-zip-card-coin-purse.png', 'description' => 'Große Damen-Portemonnaies mit vielen Fächern.'],
                    ['name' => 'Kartenetuis & MagSafe', 'image' => 'categories/wallets.png', 'description' => 'Schlanke MagSafe- und Visitenkartenetuis.'],
                    ['name' => 'Münzbörsen & Key Pouches', 'image' => 'products/atelier-brass-medallion-leather-fob.png', 'description' => 'Kompakte Etuis für Schlüssel und Kleingeld.'],
                ]
            ],
            [
                'name' => 'Schmuck & Feine Uhren',
                'slug' => 'schmuck-feine-uhren',
                'description' => 'Schweizer Manufaktur-Automatikuhrwerke, handgeflochtene Lederarmbänder & 18k Goldaccessoires.',
                'image' => 'categories/watches-jewelry.png',
                'status' => 'active',
                'order_index' => 4,
                'subcategories' => [
                    ['name' => 'Chronographen & Automatikuhrwerke', 'image' => 'categories/watches-jewelry.png', 'description' => 'Präzisions-Armbanduhren mit Saphirglas.'],
                    ['name' => 'Lederarmbänder & Manschetten', 'image' => 'categories/watches-jewelry.png', 'description' => 'Handgeflochtene Armbänder mit Schließe.'],
                    ['name' => 'Manschettenknöpfe & Broschen', 'image' => 'categories/watches-jewelry.png', 'description' => 'Gold- und Onyx-inlaid Manschettenknöpfe.'],
                ]
            ],
            [
                'name' => 'Reisegepäck & Weekender',
                'slug' => 'reisegepaeck-weekender',
                'description' => 'Klassische Wochenend-Reisetaschen, Kleidersäcke & Kosmetikkoffer aus Rindsleder.',
                'image' => 'categories/travel-luggage.jpg',
                'status' => 'active',
                'order_index' => 5,
                'subcategories' => [
                    ['name' => 'Leder-Weekender & Duffles', 'image' => 'categories/travel-luggage.jpg', 'description' => 'Geräumige Reisetaschen für 2-4 Tage Trips.'],
                    ['name' => 'Kulturbeutel & Waschsets', 'image' => 'categories/travel-luggage.webp', 'description' => 'Wasserabweisend gefütterte Leder-Toiletry Bags.'],
                    ['name' => 'Passhüllen & Kofferanhänger', 'image' => 'products/atelier-brass-medallion-leather-fob.png', 'description' => 'Personalisierte Leder-Reiseaccessoires.'],
                ]
            ],
            [
                'name' => 'Gürtel & Lederaccessoires',
                'slug' => 'guertel-lederaccessoires',
                'description' => 'Wendegürtel aus Saffiano- und Sattelleder, Schlüsselanhänger & Manufaktur-Pflegebalsame.',
                'image' => 'categories/accessories.png',
                'status' => 'active',
                'order_index' => 6,
                'subcategories' => [
                    ['name' => 'Klassische Herren-Ledergürtel', 'image' => 'categories/accessories.png', 'description' => '35mm breite Wendegürtel mit Massivmessingschließe.'],
                    ['name' => 'Luxus-Schlüsselanhänger', 'image' => 'products/atelier-brass-medallion-leather-fob.png', 'description' => 'Geflochtene Lederanhänger mit Schnellverschluss.'],
                    ['name' => 'Lederpflege & Bienenwachs', 'image' => 'categories/accessories.png', 'description' => 'Atelier-Pflegebalsame für langanhaltenden Glanz.'],
                ]
            ],
            [
                'name' => 'Golf & Sport Kollektion',
                'slug' => 'golf-sport-kollektion',
                'description' => 'Exklusive Leder-Golftaschen, Scorekarten-Hüllen und Schlägerhauben für den anspruchsvollen Platz.',
                'image' => 'categories/golf.png',
                'status' => 'active',
                'order_index' => 7,
                'subcategories' => [
                    ['name' => 'Leder Stand- & Cartbags', 'image' => 'products/augusta-tour-pro-leather-golf-bag.png', 'description' => 'Vollleder-Golftaschen für den Court.'],
                    ['name' => 'Scorekarten- & Tees-Etuis', 'image' => 'categories/golf.png', 'description' => 'Handgenähte Lederhüllen für Scorecards.'],
                ]
            ],
            [
                'name' => 'Saisonale Sonderkollektion',
                'slug' => 'saisonale-sonderkollektion',
                'description' => 'Limitierte Capsule-Kollektion für die kommende Saison – aktuell in interner Vorbereitung.',
                'image' => 'categories/travel-luggage.jpg',
                'status' => 'draft',
                'order_index' => 8,
                'subcategories' => [
                    ['name' => 'Winter Capsule 2026', 'image' => 'categories/travel-luggage.jpg', 'description' => 'Exklusive Kombinationen aus Nubuk und Shearling.'],
                ]
            ],
        ];

        // Also clean up old categories if they have obsolete slugs
        $activeSlugs = array_column($categories, 'slug');

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
                        'slug' => Str::slug($subData['name'])
                    ],
                    [
                        'category_id' => $category->id,
                        'name' => $subData['name'],
                        'description' => $subData['description'],
                        'image' => $subData['image'] ?? null,
                        'status' => 'active',
                    ]
                );
            }
        }

        // Also update legacy slugs if they still exist so nothing is broken
        $legacyMap = [
            'leder-taschen' => 'leder-handtaschen',
            'schmuck-uhren' => 'schmuck-feine-uhren',
            'guertel-accessoires' => 'guertel-lederaccessoires',
        ];

        foreach ($legacyMap as $oldSlug => $newSlug) {
            $oldCat = Category::where('slug', $oldSlug)->first();
            $newCat = Category::where('slug', $newSlug)->first();
            if ($oldCat && $newCat && $oldCat->id !== $newCat->id) {
                // Reassign products to the new category and remove obsolete old category
                \App\Models\Product::where('category_id', $oldCat->id)->update(['category_id' => $newCat->id]);
                $oldCat->delete();
            }
        }
    }
}
