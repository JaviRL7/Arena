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

        $table->unsignedBigInteger('team_blue_id');
        $table->unsignedBigInteger('team_red_id');
        $table->date('date');
        $table->integer('number');
        //$table->unsignedBigInteger('competition');
        $table->timestamps();
        $table->foreign('team_blue_id')->references('id')->on('teams');
        $table->foreign('team_red_id')->references('id')->on('teams');
        $table->primary(['team_blue_id', 'team_red_id', 'date']);
        //
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
