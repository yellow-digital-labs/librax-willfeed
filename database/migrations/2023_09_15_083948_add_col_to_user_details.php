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
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('order_capacity_limits_min', 50)->after('order_capacity_limits')->nullable();
            $table->string('order_capacity_limits_max', 50)->after('order_capacity_limits_min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn(['order_capacity_limits_min', 'order_capacity_limits_max']);
        });
    }
};
