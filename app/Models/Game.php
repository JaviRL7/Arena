<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function team_blue() {
        return $this->belongsTo(Team::class, 'team_blue_id');
    }
    public function team_red() {
        return $this->belongsTo(Team::class, 'team_red_id');
    }
}
