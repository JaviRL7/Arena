<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function getResultSerie()
{
    // Si la serie aún no se ha jugado
    if ($this->date > now()) {
        return "Not played yet";
    }

    $games = $this->games;

    if ($games->isEmpty()) {
        return "No games found for this series.";
    }

    $team_1 = $this->team_1;
    $team_2 = $this->team_2;

    $team_1_wins = 0;
    $team_2_wins = 0;

    foreach ($games as $game) {
        if (($game->team_blue_id == $team_1->id && $game->team_blue_result == 'W') || ($game->team_red_id == $team_1->id && $game->team_red_result == 'W')) {
            $team_1_wins++;
        } elseif (($game->team_blue_id == $team_2->id && $game->team_blue_result == 'W') || ($game->team_red_id == $team_2->id && $game->team_red_result == 'W')) {
            $team_2_wins++;
        }
    }

    return "$team_1_wins - $team_2_wins";
}
    public function team_1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }
    public function games()
{
    return $this->hasMany(Game::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}




public function canAddGame() {
    // Obtén el número de juegos ganados por cada equipo
    $team_1_wins = Game::where('serie_id', $this->id)
        ->where(function ($query) {
            $query->where('team_blue_id', $this->team_1->id)->where('team_blue_result', 'W')
                  ->orWhere('team_red_id', $this->team_1->id)->where('team_red_result', 'W');
        })->count();

    $team_2_wins = Game::where('serie_id', $this->id)
        ->where(function ($query) {
            $query->where('team_blue_id', $this->team_2->id)->where('team_blue_result', 'W')
                  ->orWhere('team_red_id', $this->team_2->id)->where('team_red_result', 'W');
        })->count();

    // Si la serie es de tipo bo1
    if ($this->type == 'bo1') {
        // Si ya hay 1 juego, no se puede añadir un nuevo juego
        if ($this->games->count() >= 1) {
            return false;
        }
    }
    // Si la serie es de tipo bo3
    else if ($this->type == 'bo3') {
        // Si alguno de los equipos ha ganado 2 veces, no se puede añadir un nuevo juego
        if ($team_1_wins >= 2 || $team_2_wins >= 2) {
            return false;
        }
        // Si ya hay 3 juegos, no se puede añadir un nuevo juego
        if ($this->games->count() >= 3) {
            return false;
        }
    }
    // Si la serie es de tipo bo5
    else if ($this->type == 'bo5') {
        // Si alguno de los equipos ha ganado 3 veces, no se puede añadir un nuevo juego
        if ($team_1_wins >= 3 || $team_2_wins >= 3) {
            return false;
        }
        // Si ya hay 5 juegos, no se puede añadir un nuevo juego
        if ($this->games->count() >= 5) {
            return false;
        }
    }

    // En cualquier otro caso, se puede añadir un nuevo juego
    return true;
}

public function getAvailableMapNumbers($serieId) {
    $serie = Serie::with('games')->find($serieId);  // Asegúrate de tener una relación games en el modelo Serie
    $existingNumbers = $serie->games->pluck('number')->all(); // Obtén los números de mapa existentes

    $maxMaps = 1; // Por defecto para bo1
    if ($serie->type == 'bo3') {
        $maxMaps = 3;
    } elseif ($serie->type == 'bo5') {
        $maxMaps = 5;
    }

    $availableNumbers = [];
    for ($i = 1; $i <= $maxMaps; $i++) {
        if (!in_array($i, $existingNumbers)) {
            $availableNumbers[] = $i;  // Agrega el número si no está en la lista de existentes
        }
    }

    return $availableNumbers;
}







public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
    public function team_2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }
    public function recentActivities($limit = 5)
    {
        // Obtener comentarios
        $comments = $this->comments()->with('user')->latest()->get();

        // Obtener puntuaciones (scores)
        $scores = Score::whereHas('game', function ($query) {
            $query->where('serie_id', $this->id);
        })->with(['user', 'player', 'game', 'game.champion'])->latest()->get();

        // Combinar y ordenar por fecha
        $activities = $comments->concat($scores)->sortByDesc('created_at')->take($limit);

        return $activities;
    }
}
