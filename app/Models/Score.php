<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = null; // No hay una única clave primaria

    // Asegúrate de que todos los campos que componen la clave primaria compuesta sean asignables
    protected $fillable = ['game_id', 'player_id', 'user_id', 'note', 'review', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
