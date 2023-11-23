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
        Schema::create('optimization_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternative_id');
            $table->unsignedBigInteger('criterion_id');
            $table->decimal('value', 5);
            $table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');
            $table->foreign('criterion_id')->references('id')->on('criteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optimization_attributes');
    }
};
