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
       Schema::create('product', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 8, 2);
                $table->decimal('discount', 5, 2)->nullable(); // Percentage or fixed amount
                $table->text('description')->nullable();
                $table->decimal('price_after_discount', 8, 2)->nullable(); // Could be computed
                $table->string('status'); // e.g., 'active', 'inactive'
                $table->string('brand')->nullable();
                $table->string('category')->nullable();
                $table->boolean('slide')->default(false); // e.g., for featured products
                $table->string('od')->nullable(); // Order or display order
                $table->string('name_link')->nullable(); // URL slug or link
                $table->json('image')->nullable(); // Path to image
                $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
