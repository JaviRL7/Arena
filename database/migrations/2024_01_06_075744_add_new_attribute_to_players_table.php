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
    Schema::table('players', function (Blueprint $table) {
        $table->string('img')->default('ruta/por/defecto');  // Añade el nuevo atributo con un valor por defecto
    });
}

public function down()
{
    Schema::table('players', function (Blueprint $table) {
        $table->dropColumn('img');  // Elimina el nuevo atributo
    });
}
};
