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
            $table->float('credit_limit', 10, 2)->after('customer_since')->default(0)->nullable();
            $table->float('credit_used', 10, 2)->after('credit_limit')->default(0)->nullable();
            $table->float('credit_avail', 10, 2)->after('credit_used')->default(0)->nullable();
            $table->string('seller_name')->after('seller_id')->default("")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_verifieds', function (Blueprint $table) {
            $table->dropColumn(['credit_limit', 'credit_used', 'credit_avail', "seller_name"]);
        });
    }
};
