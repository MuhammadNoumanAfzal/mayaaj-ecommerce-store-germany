<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $handbagsCat = Category::where('slug', 'leder-handtaschen')->first();
        $briefcaseCat = Category::where('slug', 'business-aktentaschen')->first();
        $walletCat = Category::where('slug', 'geldboersen-etuis')->first();
        $jewelryCat = Category::where('slug', 'schmuck-feine-uhren')->first();
        $travelCat = Category::where('slug', 'reisegepaeck-weekender')->first();
        $beltCat = Category::where('slug', 'guertel-lederaccessoires')->first();
        $golfCat = Category::where('slug', 'golf-sport-kollektion')->first();

        $handbagsSub = Subcategory::where('slug', 'klassische-handtaschen')->first();
        $shopperSub = Subcategory::where('slug', 'shopper-city-totes')->first();
        $clutchSub = Subcategory::where('slug', 'abendtaschen-clutches')->first();
        $briefcaseSub = Subcategory::where('slug', 'diplomaten-aktentaschen')->first();
        $portfolioSub = Subcategory::where('slug', 'leder-dokumentenmappen')->first();
        $bifoldSub = Subcategory::where('slug', 'klassische-bifold-wallets')->first();
        $cardSub = Subcategory::where('slug', 'kartenetuis-magsafe')->first();
        $chronoSub = Subcategory::where('slug', 'chronographen-automatikuhrwerke')->first();
        $braceletsSub = Subcategory::where('slug', 'lederarmbaender-manschetten')->first();
        $weekenderSub = Subcategory::where('slug', 'leder-weekender-duffles')->first();
        $beltsSub = Subcategory::where('slug', 'klassische-herren-lederguertel')->first();
        $golfBagsSub = Subcategory::where('slug', 'leder-stand-cartbags')->first();

        $products = [
            // Handbags
            [
                'name' => 'Maison Leather Tote',
                'sku' => 'MHJ-LT-001',
                'category_id' => $handbagsCat?->id,
                'subcategory_id' => $shopperSub?->id,
                'price' => 1290.00,
                'cost_price' => 520.00,
                'sale_price' => 1150.00,
                'stock' => 15,
                'description' => 'Exquisite Handgefertigte Ledertasche aus feinstem vollnarbigem Kalbsleder aus Florenz.',
                'craftsmanship' => 'Handgenäht nach traditioneller Feinsattler-Kunst mit vergoldeten Messing-Beschlägen.',
                'image' => 'products/aurelia-structured-city-tote.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Aurelia Structured City Tote',
                'sku' => 'MHJ-LT-002',
                'category_id' => $handbagsCat?->id,
                'subcategory_id' => $shopperSub?->id,
                'price' => 1480.00,
                'cost_price' => 590.00,
                'sale_price' => null,
                'stock' => 12,
                'description' => 'Architektonisch geschnittene Business-Tote mit herausnehmbarem Organizer.',
                'craftsmanship' => 'Double-face Lederverarbeitung mit handlackierten Kanten in Atelier-Manier.',
                'image' => 'products/aurelia-structured-city-tote.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Belle Époque Evening Clutch',
                'sku' => 'MHJ-CL-003',
                'category_id' => $handbagsCat?->id,
                'subcategory_id' => $clutchSub?->id,
                'price' => 890.00,
                'cost_price' => 340.00,
                'sale_price' => null,
                'stock' => 8,
                'description' => 'Kompakte Abendclutch mit verdeckter Kettenschulterung und Satinfutter.',
                'craftsmanship' => 'Handpoliertes Kalbsleder mit goldenem Schnappverschluss.',
                'image' => 'products/belle-epoque-evening-clutch.png',
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Verona Soft Pebbled Tote',
                'sku' => 'MHJ-TT-004',
                'category_id' => $handbagsCat?->id,
                'subcategory_id' => $handbagsSub?->id,
                'price' => 1150.00,
                'cost_price' => 450.00,
                'sale_price' => 990.00,
                'stock' => 18,
                'description' => 'Geschmeidiges genarbtes Rindsleder mit luxuriöser Haptik und Magnetverschluss.',
                'craftsmanship' => 'Natürlich getrommeltes Leder mit samtiger Innenausstattung.',
                'image' => 'products/verona-soft-pebbled-tote.png',
                'is_featured' => false,
                'status' => 'active',
            ],

            // Briefcases
            [
                'name' => 'Chancellor Diplomatic Briefcase',
                'sku' => 'MHJ-BC-101',
                'category_id' => $briefcaseCat?->id,
                'subcategory_id' => $briefcaseSub?->id,
                'price' => 2100.00,
                'cost_price' => 820.00,
                'sale_price' => null,
                'stock' => 6,
                'description' => 'Klassischer Hartschalen-Diplomatenkoffer mit doppeltem Messing-Zahlenschloss.',
                'craftsmanship' => 'Holzkern-Konstruktion mit vegetabil gegerbtem Sattelleder überzogen.',
                'image' => 'products/chancellor-diplomatic-briefcase.jpg',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Atelier Leather Zip Portfolio',
                'sku' => 'MHJ-PF-102',
                'category_id' => $briefcaseCat?->id,
                'subcategory_id' => $portfolioSub?->id,
                'price' => 650.00,
                'cost_price' => 240.00,
                'sale_price' => 590.00,
                'stock' => 22,
                'description' => 'Schlanke Dokumentenmappe mit Rundum-Reißverschluss für iPad Pro und A4-Dokumente.',
                'craftsmanship' => 'Extraglatte Schweizer Reißverschlüsse mit Rindsleder-Grip.',
                'image' => 'products/atelier-leather-zip-portfolio.jpg',
                'is_featured' => false,
                'status' => 'active',
            ],

            // Wallets
            [
                'name' => 'Classic Full-Grain Bifold Wallet',
                'sku' => 'MHJ-WL-201',
                'category_id' => $walletCat?->id,
                'subcategory_id' => $bifoldSub?->id,
                'price' => 320.00,
                'cost_price' => 110.00,
                'sale_price' => null,
                'stock' => 35,
                'description' => 'Klassisches Herrenportemonnaie mit 8 Kartensteckplätzen und doppelter Geldscheinfalte.',
                'craftsmanship' => 'Ultradünn ausgeschärfte Lederkanten für schlanken Sitz in der Anzugtasche.',
                'image' => 'products/classic-full-grain-bifold-wallet.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Sovereign Slim Currency Wallet',
                'sku' => 'MHJ-WL-202',
                'category_id' => $walletCat?->id,
                'subcategory_id' => $cardSub?->id,
                'price' => 240.00,
                'cost_price' => 85.00,
                'sale_price' => null,
                'stock' => 28,
                'description' => 'Minimalistisches Scheinetui mit integriertem RFID-Abschirmungsvlies.',
                'craftsmanship' => 'Kontrastnaht in Sattlerstich mit MEHAAJ Prägesiegel.',
                'image' => 'products/sovereign-slim-currency-wallet.png',
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Atelier Zip Card & Coin Purse',
                'sku' => 'MHJ-CP-203',
                'category_id' => $walletCat?->id,
                'subcategory_id' => $cardSub?->id,
                'price' => 195.00,
                'cost_price' => 70.00,
                'sale_price' => null,
                'stock' => 45,
                'description' => 'Kompaktes Münz- und Kartenetui mit goldglänzendem Reißverschluss.',
                'craftsmanship' => 'Feinstes Kalbsleder mit gefüttertem Innenraum.',
                'image' => 'products/atelier-zip-card-coin-purse.png',
                'is_featured' => false,
                'status' => 'active',
            ],

            // Watches & Jewelry
            [
                'name' => 'Royal Gold Chronograph',
                'sku' => 'MHJ-WA-301',
                'category_id' => $jewelryCat?->id,
                'subcategory_id' => $chronoSub?->id,
                'price' => 3450.00,
                'cost_price' => 1400.00,
                'sale_price' => null,
                'stock' => 8,
                'description' => 'Präzisions-Automatikuhr aus 18k vergoldetem Edelstahl mit Saphirglas und Schweizer Uhrwerk.',
                'craftsmanship' => 'Schattenfreies Saphirglas, wasserdicht bis 100m, graviertes MEHAAJ Wappen.',
                'image' => 'products/classic-guilloche-dress-watch.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Solid Gold Cord Tennis Bracelet',
                'sku' => 'MHJ-BR-302',
                'category_id' => $jewelryCat?->id,
                'subcategory_id' => $braceletsSub?->id,
                'price' => 850.00,
                'cost_price' => 320.00,
                'sale_price' => null,
                'stock' => 14,
                'description' => 'Geflochtene Seiden-Lederkordel mit massiven 18k Gelbgold-Zylindern.',
                'craftsmanship' => 'Handgefertigte Endstücke mit verdecktem Klickverschluss.',
                'image' => 'products/solid-gold-cord-tennis-bracelet.png',
                'is_featured' => false,
                'status' => 'active',
            ],

            // Luggage & Travel
            [
                'name' => 'Palais Monogram Weekender Tote',
                'sku' => 'MHJ-WK-401',
                'category_id' => $travelCat?->id,
                'subcategory_id' => $weekenderSub?->id,
                'price' => 1890.00,
                'cost_price' => 740.00,
                'sale_price' => null,
                'stock' => 9,
                'description' => 'Großer Weekender-Duffle aus robustem Rindleder mit abnehmbarem Schultergurt.',
                'craftsmanship' => 'Verstärkter Taschenboden mit Messingfüßen und passendem Kofferanhänger.',
                'image' => 'products/palais-monogram-weekender-tote.png',
                'is_featured' => true,
                'status' => 'active',
            ],

            // Belts & Accessories
            [
                'name' => 'Reversible Box-Calf Leather Belt 35mm',
                'sku' => 'MHJ-BT-501',
                'category_id' => $beltCat?->id,
                'subcategory_id' => $beltsSub?->id,
                'price' => 340.00,
                'cost_price' => 120.00,
                'sale_price' => null,
                'stock' => 30,
                'description' => 'Wendegürtel mit edler Dreh-Schließe: Schwarz Boxcalf auf Cognac Sattelleder.',
                'craftsmanship' => 'Sattlerhandnaht an der Schließe mit langlebigem Drehmechanismus.',
                'image' => 'products/reversible-box-calf-leather-belt-35mm.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Atelier Brass Medallion Leather Fob',
                'sku' => 'MHJ-AC-502',
                'category_id' => $beltCat?->id,
                'subcategory_id' => null,
                'price' => 145.00,
                'cost_price' => 45.00,
                'sale_price' => null,
                'stock' => 50,
                'description' => 'Schwerer Messing-Schlüsselanhänger mit eingefasstem Leder-Inlay.',
                'craftsmanship' => 'Gegossenes und handpoliertes Rohmessing mit MEHAAJ Monogramm.',
                'image' => 'products/atelier-brass-medallion-leather-fob.png',
                'is_featured' => false,
                'status' => 'active',
            ],

            // Golf
            [
                'name' => 'Augusta Tour Pro Leather Golf Bag',
                'sku' => 'MHJ-GF-601',
                'category_id' => $golfCat?->id,
                'subcategory_id' => $golfBagsSub?->id,
                'price' => 3800.00,
                'cost_price' => 1550.00,
                'sale_price' => null,
                'stock' => 4,
                'description' => 'Vollleder-Cartbag mit 14-Fach-Teilung, isoliertem Getränkefach und Samtfutter.',
                'craftsmanship' => 'Wasserabweisend imprägniertes Leder mit handgefertigten Ledergriffen.',
                'image' => 'products/augusta-tour-pro-leather-golf-bag.png',
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Pebble Beach Sunday Walking Bag',
                'sku' => 'MHJ-GF-602',
                'category_id' => $golfCat?->id,
                'subcategory_id' => $golfBagsSub?->id,
                'price' => 2200.00,
                'cost_price' => 880.00,
                'sale_price' => null,
                'stock' => 7,
                'description' => 'Leichtes Tragebag aus Canvas und Rindsleder für entspannte 9-Loch-Runden.',
                'craftsmanship' => 'Gepolsterter Leder-Doppelschultergurt und ausklappbare Titan-Standbeine.',
                'image' => 'products/pebble-beach-sunday-walking-bag.png',
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($products as $item) {
            $item['slug'] = Str::slug($item['name']);
            Product::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
