<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;

class Comment extends Model
{
    protected $fillable = ['body', 'player_id', 'team_id'];

     public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
