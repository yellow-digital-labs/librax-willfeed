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
            $table->integer('stock_in_transit')->after('current_stock')->default(0);
            $table->integer('stock_lifetime')->after('stock_in_transit')->default(0);
            $table->datetime('stock_updated_at')->after('stock_lifetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sellers', function (Blueprint $table) {
            $table->dropColumn(['stock_in_transit', 'stock_lifetime', 'stock_updated_at']);
        });
    }
};
