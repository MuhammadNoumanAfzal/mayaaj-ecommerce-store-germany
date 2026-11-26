<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Step 1 additions
            $table->string('tagline')->nullable()->after('name');
            
            // Step 2: Atelier Craftsmanship & Physical Specs
            $table->string('materials')->nullable()->after('craftsmanship');
            $table->string('lining')->nullable()->after('materials');
            $table->string('hardware')->nullable()->after('lining');
            $table->string('dimensions')->nullable()->after('hardware');
            $table->string('weight')->nullable()->after('dimensions');
            $table->string('strap_drop')->nullable()->after('weight');
            $table->string('origin')->nullable()->default('Handcrafted in Germany')->after('strap_drop');

            // Step 3: Bespoke Made to Order & Personalization
            $table->boolean('is_made_to_order')->default(false)->after('origin');
            $table->integer('lead_time_days')->nullable()->after('is_made_to_order');
            $table->integer('delivery_days_min')->default(2)->after('lead_time_days');
            $table->integer('delivery_days_max')->default(4)->after('delivery_days_min');
            $table->boolean('allow_personalization')->default(false)->after('delivery_days_max');
            $table->json('personalization_types')->nullable()->after('allow_personalization');
            $table->integer('personalization_max_chars')->default(5)->after('personalization_types');
            $table->decimal('personalization_fee', 10, 2)->default(0.00)->after('personalization_max_chars');

            // Step 5: Payment Rules
            $table->json('payment_methods')->nullable()->after('gallery_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'tagline',
                'materials',
                'lining',
                'hardware',
                'dimensions',
                'weight',
                'strap_drop',
                'origin',
                'is_made_to_order',
                'lead_time_days',
                'delivery_days_min',
                'delivery_days_max',
                'allow_personalization',
                'personalization_types',
                'personalization_max_chars',
                'personalization_fee',
                'payment_methods',
            ]);
        });
    }
};
