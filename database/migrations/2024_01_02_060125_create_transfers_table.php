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
        Schema::create('transfers', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_from_id');
            $table->unsignedBigInteger('team_to_id');
            $table->date('date');
            $table->timestamps();

            $table->primary(['player_id', 'team_from_id', 'team_to_id', 'date']);

            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('team_from_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_to_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
