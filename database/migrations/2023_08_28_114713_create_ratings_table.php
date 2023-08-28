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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer("review_by_id")->index();
            $table->string("review_by_name")->index();
            $table->integer("review_for_id")->index();
            $table->string("review_for_name")->index();
            $table->float("star", 3, 2)->index();
            $table->text("review_text");
            $table->enum("status", ["pending", "approve", "reject"])->default("pending");
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
        Schema::dropIfExists('ratings');
    }
};
