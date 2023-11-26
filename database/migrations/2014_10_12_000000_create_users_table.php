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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('favorite_player1')->nullable();
            $table->unsignedBigInteger('favorite_player2')->nullable();
            $table->unsignedBigInteger('favorite_player3')->nullable();
            $table->unsignedBigInteger('favorite_player4')->nullable();
            $table->unsignedBigInteger('favorite_player5')->nullable();
            $table->unsignedBigInteger('favorite_team')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
