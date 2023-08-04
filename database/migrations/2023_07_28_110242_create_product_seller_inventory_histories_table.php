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
        Schema::create('product_seller_inventory_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('product_sellers_id')->index();
            $table->integer('seller_id')->index();
            $table->integer('product_id')->index();
            $table->float('qty', 8, 2);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('product_seller_inventory_histories');
    }
};
