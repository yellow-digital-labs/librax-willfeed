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
            $table->unsignedBigInteger('customer_groups_id')->after('id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_sellers', function (Blueprint $table) {
            $table->dropColumn(['customer_groups_id']);
        });
    }
};
