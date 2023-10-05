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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('billing_first_name', 255)->after('order_date')->nullable();
            $table->string('billing_address', 255)->after('billing_first_name')->nullable();
            $table->string('billing_house_no', 255)->after('billing_address')->nullable();
            $table->string('billing_region', 255)->after('billing_house_no')->nullable();
            $table->string('billing_province', 255)->after('billing_region')->nullable();
            $table->string('billing_common', 255)->after('billing_province')->nullable();
            $table->string('billing_pincode', 255)->after('billing_common')->nullable();
            $table->string('billing_email', 255)->after('billing_pincode')->nullable();
            $table->string('billing_contact', 255)->after('billing_email')->nullable();
            $table->string('selling_first_name', 255)->after('billing_contact')->nullable();
            $table->string('selling_address', 255)->after('selling_first_name')->nullable();
            $table->string('selling_house_no', 255)->after('selling_address')->nullable();
            $table->string('selling_region', 255)->after('selling_house_no')->nullable();
            $table->string('selling_province', 255)->after('selling_region')->nullable();
            $table->string('selling_common', 255)->after('selling_province')->nullable();
            $table->string('selling_pincode', 255)->after('selling_common')->nullable();
            $table->string('selling_email', 255)->after('selling_pincode')->nullable();
            $table->string('selling_contact', 255)->after('selling_email')->nullable();

            $table->dropColumn(['customer_email', 'customer_contact', 'shipping_address_line_1', 'shipping_address_line_2', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_zip', 'billing_address_line_1', 'billing_address_line_2', 'billing_city', 'billing_state', 'billing_country', 'billing_zip']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['billing_first_name', 'billing_address', 'billing_house_no', 'billing_region', 'billing_province', 'billing_common', 'billing_pincode', 'billing_email', 'billing_contact', 'selling_first_name', 'selling_address', 'selling_house_no', 'selling_region', 'selling_province', 'selling_common', 'selling_pincode', 'selling_email', 'selling_contact']);
        });
    }
};
