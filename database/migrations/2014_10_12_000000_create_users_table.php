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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('accountType')->index();
            $table->string("accountTypeName")->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('verification_token')->nullable();
            $table->datetime('varification_valid_till')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->float('subscription_amount', 8, 2)->default(0);
            $table->string('subscription_name')->default('');
            $table->datetime('exp_datetime')->index();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('profile_completed', ['Yes', 'No'])->default('No')->index();
            $table->enum('approved_by_admin', ['Yes', 'No'])->default('No')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
