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
        return $this->belongsToMany(Game::class, 'clasifications');
    }
}
