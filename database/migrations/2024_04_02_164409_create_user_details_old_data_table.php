<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsOldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details_old_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_detail_id'); 
            $table->string('business_name')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('pec')->nullable();
            $table->string('tax_id_code')->nullable();
            $table->string('administrator_name')->nullable();
            $table->string('main_activity_ids')->nullable();
            $table->string('address')->nullable();
            $table->string('house_no')->nullable();
            $table->string('common')->nullable();
            $table->string('province')->nullable();
            $table->string('pincode')->nullable();
            $table->string('ease_of_access')->nullable();
            $table->string('mobile_unloading')->nullable();
            $table->string('destination_address')->nullable();
            $table->string('destination_house_no')->nullable();
            $table->string('destination_common')->nullable();
            $table->string('destination_province')->nullable();
            $table->string('destination_pincode')->nullable();
            $table->string('payment_extension')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('reference_bank')->nullable();
            $table->string('iban')->nullable();
            $table->string('sdi')->nullable();
            $table->string('cig')->nullable();
            $table->string('cup')->nullable();
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->string('file_3')->nullable();
            $table->string('products')->nullable();
            $table->string('monthly_consumption')->nullable();
            $table->string('is_private_distributer')->nullable();
            $table->string('no_of_distributer')->nullable();
            $table->string('fleet')->nullable();
            $table->string('type_of_flotta')->nullable();
            $table->string('folding_trucks')->nullable();
            $table->string('van_trucks')->nullable();
            $table->string('hundred_trucks')->nullable();
            $table->string('chassis_trucks')->nullable();
            $table->string('fixed_cassone_truck')->nullable();
            $table->string('fridge_truck')->nullable();
            $table->string('truck_with_crane')->nullable();
            $table->string('scarble_truck')->nullable();
            $table->string('bitoniere')->nullable();
            $table->string('comircial_vehicle')->nullable();
            $table->string('semi_trailer')->nullable();
            $table->string('trailers')->nullable();
            $table->string('road_tractors')->nullable();
            $table->string('storage_capacity')->nullable();
            $table->string('order_capacity_limits')->nullable();
            $table->string('available_products')->nullable();
            $table->string('geographical_coverage_regions')->nullable();
            $table->string('geographical_coverage_provinces')->nullable();
            $table->string('time_limit_daily_order')->nullable();
            $table->string('bank_transfer')->nullable();
            $table->string('bank_check')->nullable();
            $table->string('bank')->nullable();
            $table->string('rib')->nullable();
            $table->string('rid')->nullable();
            $table->string('order_capacity_limits_new', 50)->nullable();
            $table->string('destination_address_via', 255)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('destination_address', 50)->nullable()->change();
            $table->enum('admin_approval', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('reject_reason')->nullable();
            $table->string('file_operating_license')->nullable();
            $table->timestamps();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->index('user_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details_old_data');
    }
}
