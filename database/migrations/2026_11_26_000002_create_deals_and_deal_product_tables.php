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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_de');
            $table->string('slug')->unique()->index();
            $table->text('description_en')->nullable();
            $table->text('description_de')->nullable();
            $table->string('badge_text')->nullable(); // e.g. 'BUNDLE & SAVE 20%', 'CURATED ATELIER DUO'
            $table->enum('discount_type', ['fixed_discount', 'percentage_discount', 'bundle_fixed_price'])->default('percentage_discount');
            $table->decimal('discount_value', 10, 2); // e.g. 20 for 20% or 50.00 for 50€ off or fixed price
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->string('banner_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('deal_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained('deals')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->boolean('is_required')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['deal_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_product');
        Schema::dropIfExists('deals');
    }
};
