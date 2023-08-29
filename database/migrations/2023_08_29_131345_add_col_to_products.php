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
            $table->float('today_price', 7, 2)->after('description')->default(0);
            $table->date('price_updated_at')->after('today_price')->nullable();
            $table->float('old_price', 7, 2)->after('price_updated_at')->default(0);
            $table->date('old_price_updated_at')->after('old_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['today_price', 'price_updated_at', 'old_price', 'old_price_updated_at']);
        });
    }
};
