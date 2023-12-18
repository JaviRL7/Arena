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
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('serie_id')->references('id')->on('series');
            $table->unsignedBigInteger('ban1_blue')->nullable();
            $table->unsignedBigInteger('ban2_blue')->nullable();
            $table->unsignedBigInteger('ban3_blue')->nullable();
            $table->unsignedBigInteger('ban4_blue')->nullable();
            $table->unsignedBigInteger('ban5_blue')->nullable();
            $table->unsignedBigInteger('ban1_red')->nullable();
            $table->unsignedBigInteger('ban2_red')->nullable();
            $table->unsignedBigInteger('ban3_red')->nullable();
            $table->unsignedBigInteger('ban4_red')->nullable();
            $table->unsignedBigInteger('ban5_red')->nullable();
            $table->foreign('ban1_blue')->references('id')->on('champions');
            $table->foreign('ban2_blue')->references('id')->on('champions');
            $table->foreign('ban3_blue')->references('id')->on('champions');
            $table->foreign('ban4_blue')->references('id')->on('champions');
            $table->foreign('ban5_blue')->references('id')->on('champions');
            $table->foreign('ban1_red')->references('id')->on('champions');
            $table->foreign('ban2_red')->references('id')->on('champions');
            $table->foreign('ban3_red')->references('id')->on('champions');
            $table->foreign('ban4_red')->references('id')->on('champions');
            $table->foreign('ban5_red')->references('id')->on('champions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
};
