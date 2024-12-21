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
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('user_id');
            $table->string('name', 50);
            $table->string('account_name', 30);
            $table->date('date_of_birth');
            $table->string('gender', 10);
            $table->string('address', 100);
            $table->string('phone', 10);
            $table->string('email', 100);
            $table->string('password');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('type_id')->on('type_users')->onDelete('cascade');
            $table->string('remember_token', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
