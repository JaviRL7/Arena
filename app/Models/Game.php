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
}

