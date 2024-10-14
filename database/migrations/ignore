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
        Schema::table('user_details_old_data', function (Blueprint $table) {
            $table->string('minor_plant_code')->after('destination_pincode')->nullable();
            $table->string('destination_region')->after('destination_house_no')->nullable();
            $table->string('order_capacity_limits_min', 50)->after('order_capacity_limits')->nullable();
            $table->string('order_capacity_limits_max', 50)->after('order_capacity_limits_min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details_old_data', function (Blueprint $table) {
            $table->dropColumn(['destination_region', 'minor_plant_code', 'order_capacity_limits_min', 'order_capacity_limits_max']);
        });
    }
};
