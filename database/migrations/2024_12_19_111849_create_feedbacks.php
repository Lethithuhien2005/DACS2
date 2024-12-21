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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->Increments('fb_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_item_id');
            $table->integer('rating');
            $table->text('comment');
            $table->date('fb_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('fb_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('order_item_id')->references('order_item_id')->on('order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
