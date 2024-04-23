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
            $table->float('amount_before_tax', 10, 5)->default(0)->change();
            $table->float('amount_before_tax_old', 10, 5)->default(0)->change();
            $table->float('amount_30gg', 10, 5)->default(0)->change();
            $table->float('amount_60gg', 10, 5)->default(0)->change();
            $table->float('amount_90gg', 10, 5)->default(0)->change();
            $table->float('amount', 10, 5)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
