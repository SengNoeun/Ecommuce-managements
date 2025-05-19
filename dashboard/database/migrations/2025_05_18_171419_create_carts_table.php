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
       Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->nullable(); // For guest carts
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();

            // Add foreign keys with proper checks
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
