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
        $table->date('date');
        $table->enum('type', ['bo1','bo3','bo5']);
        $table->integer('number');
        $table->unsignedBigInteger('competition_id');
        $table->foreign('team_blue_id')->references('id')->on('teams');
        $table->foreign('team_red_id')->references('id')->on('teams');
        $table->unique(['team_blue_id', 'team_red_id', 'date', 'number']);
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
