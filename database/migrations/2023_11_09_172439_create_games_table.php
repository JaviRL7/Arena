<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('games', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('team_blue_id');
        $table->unsignedBigInteger('team_red_id');
        $table->date('date');
        //$table->unsignedBigInteger('competition');
        $table->timestamps();
        $table->foreign('team_blue_id')->references('id')->on('teams');
        $table->foreign('team_red_id')->references('id')->on('teams');
        //$table->foreign('competition')->references('id')->on('competition');
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
