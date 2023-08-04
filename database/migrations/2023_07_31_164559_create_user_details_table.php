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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique()->index();
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
            $table->string('is_private_distributer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
