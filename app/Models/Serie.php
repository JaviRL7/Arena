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
    public function team_2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }
}
