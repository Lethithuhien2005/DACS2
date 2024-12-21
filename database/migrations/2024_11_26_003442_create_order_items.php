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
        Schema::create('order_items', function (Blueprint $table) {
            $table->Increments('order_item_id');
            $table->string('order_item_name');
            $table->string('order_item_img');
            $table->decimal('price', 10, 2);
            $table->Integer('quantity');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('dish_id')->nullable();
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('dish_id')->references('dish_id')->on('dishes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
