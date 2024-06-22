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
            $table->enum('price_type', ['PLATTS', 'NORMAL PRICING'])->after('product_name')->default('NORMAL PRICING');
            $table->float('price_value', 10, 2)->after('price_type')->default(0);
            $table->float('price_value_30gg', 10, 2)->after('price_value')->default(0);
            $table->float('price_value_60gg', 10, 2)->after('price_value_30gg')->default(0);
            $table->float('price_value_90gg', 10, 2)->after('price_value_60gg')->default(0);
            $table->enum('need_to_update', ['1', '0'])->after('price_value_60gg')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sellers', function (Blueprint $table) {
            $table->dropColumn(['price_type', 'price_value', 'price_value_30gg', 'price_value_60gg', 'price_value_90gg']);
        });
    }
};
