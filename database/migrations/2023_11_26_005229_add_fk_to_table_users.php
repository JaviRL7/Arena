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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('favorite_player1')->references('id')->on('players');
            $table->foreign('favorite_player2')->references('id')->on('players');
            $table->foreign('favorite_player3')->references('id')->on('players');
            $table->foreign('favorite_player4')->references('id')->on('players');
            $table->foreign('favorite_player5')->references('id')->on('players');
            $table->foreign('favorite_team')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
