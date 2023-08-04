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
        Schema::create('email_histories', function (Blueprint $table) {
            $table->id();
            $table->string('to')->index();
            $table->string('from')->index();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->string('subject')->index();
            $table->text('html');
            $table->datetime('sent_at')->index();
            $table->text('log')->nullable();
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
        Schema::dropIfExists('email_histories');
    }
};
