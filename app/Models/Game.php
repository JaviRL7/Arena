<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Model
{
    use HasFactory;

    public function team_blue() {
        return $this->belongsTo(Team::class, 'team_blue_id');
    }
    public function team_red() {
        return $this->belongsTo(Team::class, 'team_red_id');
    }

    public function players(){
        return $this->belongsToMany(Player::class, 'clasifications')->withPivots('kills' , 'deaths', 'assists', 'champion_id');
    }

    public function getPlayerStats(Player $player) {
        return $this->players()->where('player_id', $player->id)->first()->pivot->only(['kill', 'deaths', 'assists']);
    }
    public function champion(){
        return $this->belongsTo(Champion::class, 'champion_id');
    }
    public function attachPlayers($results_blue, $results_red) {
        $team_blue_id = $this->team_blue_id;
        $team_red_id = $this->team_red_id;

        $players_team_blue = Player::whereHas('teams', function ($query) use ($team_blue_id) {
            $query->where('id', $team_blue_id);
        })->orderBy('role_id', 'asc')->get();

        $players_team_red = Player::whereHas('teams', function ($query) use ($team_red_id) {
            $query->where('id', $team_red_id);
        })->orderBy('role_id', 'asc')->get();

        foreach ($players_team_blue as $index => $player) {
            $champion_name = strtolower($results_blue[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $results_blue[$index]['champion_id'] = $champion->id;
            }
            unset($results_blue[$index]['champion_name']);
            $player->games()->attach($this->id, $results_blue[$index]);
        }

        foreach ($players_team_red as $index => $player) {
            $champion_name = strtolower($results_red[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $results_red[$index]['champion_id'] = $champion->id;
            }
            unset($results_red[$index]['champion_name']);
            $player->games()->attach($this->id, $results_red[$index]);
        }
    }

    //Relacion muchos a muchos para la tabla scores
    public function users(){
        return $this->belongsToMany(User::class, 'scores')->withPivot('player_id', 'nota');
    }
}

