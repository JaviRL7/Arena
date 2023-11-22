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
        Schema::create('clasifications', function (Blueprint $table) {
        $table->unsignedBigInteger('player_id');
        $table->unsignedBigInteger('game_id');
        $table->unsignedBigInteger('champion_id');
        $table->integer('kills');
        $table->integer('deaths');
        $table->integer('assists');
        $table->foreign('player_id')->references('id')->on('players');
        $table->foreign('game_id')->references('id')->on('games');
        $table->foreign('champion_id')->references('id')->on('champions');
        $table->primary(['player_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasifications');
    }
};
