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
        Schema::create('slide', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('od')->nullable(); // Stores link path, nullable if optional
            $table->string('image')->nullable(); // Stores image path, nullable if optional
            $table->boolean('status')->default(true); // e.g., true for active, false for inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide');
    }
};
