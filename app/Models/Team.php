<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function getToplaner()
    {
        // Obtenemos la colección de historias del equipo
        $histories = $this->histories;

        // Recorremos la colección de historias
        foreach ($histories as $history) {

            // Obtenemos el jugador asociado a la historia
            $player = $history->player;

            // Comprobamos si el id_role del jugador es igual a 1
            if ($player->id_role == 1) {

                // Devolvemos el jugador
                return $player;
            }
        }

        // Si no encontramos ningún jugador con id_role = 1, devolvemos null
        return null;
    }
}
