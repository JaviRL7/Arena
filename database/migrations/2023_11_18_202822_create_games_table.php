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
        Schema::create('games', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('team_blue_id');
        $table->unsignedBigInteger('team_red_id');
        $table->unsignedBigInteger('serie_id');
        $table->integer('number');
        $table->enum('team_blue_result', ['L', 'W']);
        $table->enum('team_red_result', ['L', 'W']);
        $table->foreign('team_blue_id')->references('id')->on('teams');
        $table->foreign('team_red_id')->references('id')->on('teams');
        $table->unique(['team_blue_id', 'team_red_id', 'serie_id', 'number']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
