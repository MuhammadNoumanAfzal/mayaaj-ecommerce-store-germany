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
        Schema::create('balance_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type'); // asset, liability, equity
            $table->string('subtype')->default('current_asset'); // current_asset, non_current_asset, current_liability, long_term_liability, equity
            $table->string('name');
            $table->decimal('balance', 12, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->boolean('is_system')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_accounts');
    }
};
