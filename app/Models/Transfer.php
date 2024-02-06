<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function team_from()
    {
        return $this->belongsTo(Team::class);
    }

    public function team_to()
    {
        return $this->belongsTo(Team::class);
    }
}
