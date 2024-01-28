<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function getResultSerie()
{
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
