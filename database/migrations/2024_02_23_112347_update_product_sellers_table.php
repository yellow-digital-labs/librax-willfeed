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
            $table->float('amount_before_tax', 8, 2)->nullable()->change();
            $table->float('amount_30gg', 8, 2)->nullable()->change();
            $table->float('amount_60gg', 8, 2)->nullable()->change();
            $table->float('amount_90gg', 8, 2)->nullable()->change();
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
