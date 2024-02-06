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
            $table->string('nick')->nullable();
            $table->string('email')->unique();
            $table->boolean('admin')->default(false);
            $table->boolean('validated')->default(false);
            $table->timestamp('birth_date')->nullable();
            $table->string('twitter')->nullable();
            $table->string('discord')->nullable();
            $table->string('bio', 150)->nullable();
            $table->integer('points')->default(0);
            $table->string('user_photo')->default('Profile_photos/Default_profile.jpg');
            $table->string('user_header_photo')->nullable();
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
