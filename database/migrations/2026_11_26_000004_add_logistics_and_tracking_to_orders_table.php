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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('courier_name', 50)->nullable()->after('notes');
            $table->string('tracking_number', 100)->nullable()->after('courier_name');
            $table->string('tracking_url', 500)->nullable()->after('tracking_number');
            $table->timestamp('dispatched_at')->nullable()->after('tracking_url');
            $table->timestamp('delivered_at')->nullable()->after('dispatched_at');
            $table->string('payment_receipt_path', 255)->nullable()->after('delivered_at');
            $table->text('order_notes')->nullable()->after('payment_receipt_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'courier_name',
                'tracking_number',
                'tracking_url',
                'dispatched_at',
                'delivered_at',
                'payment_receipt_path',
                'order_notes',
            ]);
        });
    }
};
