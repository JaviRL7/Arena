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
        Schema::create('table_history', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');
            $table->date('start_date');
            $table->date('end_date'); //Por defecto para un jugador actual fecha final contrato
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->primary(['player_id', 'team_id', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_history');
    }
};
