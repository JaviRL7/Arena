<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nick',
        'admin',
        'validated',
        'birth_date',
        'twitter',
        'discord',
        'user_photo',
        'user_header_photo',
        'favorite_player1',
        'favorite_player2',
        'favorite_player3',
        'favorite_player4',
        'favorite_player5',
        'favorite_team'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relacion muchos a muchos para la tabla scores
    public function games(){
        return $this->belongsToMany(Game::class, 'scores')->withPivot('player_id', 'nota');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
