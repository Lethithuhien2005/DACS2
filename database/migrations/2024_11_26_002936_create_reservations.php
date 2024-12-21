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
        Schema::create('reservations', function (Blueprint $table) {
            $table->Increments('res_id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('res_date');
            $table->time('res_time');
            $table->string('number_of_people');
            $table->text('note')->nullable();
            $table->string('res_status');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
