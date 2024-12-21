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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->Increments('cart_item_id');
            $table->string('cart_item_name');
            $table->string('cart_item_category');
            $table->string('cart_item_img');
            $table->decimal('price', 10, 2);
            $table->Integer('quantity');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('dish_id');
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->foreign('dish_id')->references('dish_id')->on('dishes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
