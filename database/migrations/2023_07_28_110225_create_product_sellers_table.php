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
        Schema::create('product_sellers', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->index();
            $table->string('seller_name');
            $table->integer('product_id')->index();
            $table->string('product_name');
            $table->float('amount_before_tax', 8, 2);
            $table->float('amount_30gg', 8, 2);
            $table->float('amount_60gg', 8, 2);
            $table->float('amount_90gg', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('amount', 8, 2);
            $table->float('current_stock', 8, 2);
            $table->enum('add_vat_to_price', ['yes', 'no'])->default('no')->index();
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
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
        Schema::dropIfExists('product_sellers');
    }
};
