<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function getResultSerie()
{
    $games = $this->games; // asumiendo que tienes una relación 'games' en tu modelo Serie

    // Comprueba si hay juegos antes de continuar
    if ($games->isEmpty()) {
        return "No games found for this series.";
    }

    // Asigna los equipos del primer juego
    $team_blue_id = $games[0]->team_blue_id;
    $team_red_id = $games[0]->team_red_id;

    $team_blue_wins = 0;
    $team_red_wins = 0;

    foreach ($games as $game) {
        if ($game->team_blue_id == $team_blue_id && $game->team_blue_result == 'W') {
            $team_blue_wins++;
        } elseif ($game->team_red_id == $team_red_id && $game->team_red_result == 'W') {
            $team_red_wins++;
        }
    }

    return "$team_blue_wins - $team_red_wins";
}
    public function team_red()
    {
        return $this->belongsTo(Team::class, 'team_red_id');
    }
    public function games()
{
    return $this->hasMany(Game::class);
}
    public function team_blue()
    {
        return $this->belongsTo(Team::class, 'team_blue_id');
    }
}
