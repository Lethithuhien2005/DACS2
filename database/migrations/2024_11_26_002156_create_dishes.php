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
        Schema::create('dishes', function (Blueprint $table) {
            $table->Increments('dish_id');
            $table->string('dish_name', 50);
            $table->text('dish_desc');
            $table->string('dish_price');
            $table->string('dish_img', 100);
            $table->string('dish_status', 50);
            $table->date('dish_dateAdded');         
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
