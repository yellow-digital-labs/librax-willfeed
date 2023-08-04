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
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('user_name');
            $table->integer('subscription_id')->index();
            $table->string('subscription_name');
            $table->float('subscription_amount', 8, 2);
            $table->string('transaction_no')->index();
            $table->text('request_data');
            $table->text('response_data')->nullable();
            $table->datetime('transaction_datetime')->index();
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
        Schema::dropIfExists('subscription_payments');
    }
};
