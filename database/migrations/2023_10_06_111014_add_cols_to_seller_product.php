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
        Schema::table('product_sellers', function (Blueprint $table) {
            $table->string('delivery_time', 20)->after('add_vat_to_price')->nullable();
            $table->string('delivery_days', 30)->after('delivery_time')->nullable();
            $table->string('days_off', 255)->after('delivery_days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sellers', function (Blueprint $table) {
            $table->dropColumn(['delivery_time', 'delivery_days', 'days_off']);
        });
    }
};
