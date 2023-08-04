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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('user_name')->nullable();
            $table->integer('product_id')->index();
            $table->string('product_name')->nullable();
            $table->string('product_amount');
            $table->integer('product_qty');
            $table->float('total_payable_amount', 8, 2)->default(0);
            $table->float('total_paid_amount', 8, 2)->default(0);
            $table->float('total_pending_amount', 8, 2)->default(0);
            $table->integer('order_status_id')->default(1)->index();
            $table->string('order_status')->nullable();
            $table->datetime('order_date')->nullable()->index();
            $table->string('customer_email');
            $table->string('customer_contact');
            $table->string('payment_method_id')->default(1)->index();
            $table->string('payment_method_name')->nullable();
            $table->string('shipping_address_line_1')->nullable();
            $table->string('shipping_address_line_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('billing_address_line_1')->nullable();
            $table->string('billing_address_line_2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_zip')->nullable();
            $table->timestamps();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();

            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
