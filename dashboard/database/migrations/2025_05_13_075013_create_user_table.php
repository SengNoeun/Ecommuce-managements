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
        Schema::create('user', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // User name
                $table->string('phone');
                $table->boolean('gender')->default(1); // User status (active/inactive)
                $table->string('dob'); 
                $table->string('pass'); 
                $table->string('email'); 
                $table->boolean('status')->default(1); // User status (active/inactive)
                $table->string('image')->nullable(); // Path to image
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
