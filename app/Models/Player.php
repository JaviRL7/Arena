<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function teams(){
        return $this->belongsToMany(Team::class);
    }
    public function games(){
        return $this->belongsToMany(Game::class, 'clasifications')->using(Clasification::class)->withPivot('kills' , 'deaths', 'assists', 'champion_id');
    }

    //Relacion muchos a muchos para la tabla scores
    public function scoresGames(){
        return $this->belongsToMany(Game::class, 'scores')->withPivot('user_id', 'note');
    }
}
