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
        Schema::table('customer_verifieds', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_group')->after('customer_name')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_verifieds', function (Blueprint $table) {
            $table->dropColumn(['customer_group']);
        });
    }
};
