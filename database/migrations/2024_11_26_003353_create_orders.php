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
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('order_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('res_id')->nullable();
            $table->string('order_status');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('res_id')->references('res_id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
