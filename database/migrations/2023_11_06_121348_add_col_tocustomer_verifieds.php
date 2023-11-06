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
            $table->integer('is_request_by_seller')->after('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_verifieds', function (Blueprint $table) {
            $table->dropColumn(['is_request_by_seller']);
        });
    }
};
