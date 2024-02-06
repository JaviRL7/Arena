<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        'favorite_team',
        'bio'
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
    // Seguidores
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    // Seguidos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }
    public function isFollowing(User $user)
    {
        return $this->followings()->where('followed_id', $user->id)->exists();
    }
    public function getFavoritePlayers()
    {
        $players = [];
        for ($i = 1; $i <= 5; $i++) {
            $playerField = 'favorite_player' . $i;
            if ($this->$playerField) {
                $players[] = $this->$playerField;
            }
        }

        return $players;
    }

    /**
     * Obtiene el equipo favorito del usuario.
     */
    public function getFavoriteTeam()
{
    return Team::find($this->favorite_team);
}


    public function hasMaxFavoritePlayers()
{
    // Verifica si todos los campos de jugadores favoritos están llenos
    return $this->favorite_player1 && $this->favorite_player2 && $this->favorite_player3 && $this->favorite_player4 && $this->favorite_player5;
}
public function hasFavoriteTeamWithLogo()
{
    $favoriteTeam = $this->getFavoriteTeam();

    if ($favoriteTeam && $favoriteTeam->logo) {
        return true;
    }

    return false;
}

public function setFavoritePlayers($playerIds)
{
    $attributes = ['favorite_player1', 'favorite_player2', 'favorite_player3', 'favorite_player4', 'favorite_player5'];

    foreach ($attributes as $index => $attribute) {
        $this->$attribute = $playerIds[$index] ?? null;
    }

    $this->save();
}
public function favoritePlayers()
{
    return $this->hasMany(Player::class, 'id', 'favorite_player1')
        ->union($this->hasMany(Player::class, 'id', 'favorite_player2'))
        ->union($this->hasMany(Player::class, 'id', 'favorite_player3'))
        ->union($this->hasMany(Player::class, 'id', 'favorite_player4'))
        ->union($this->hasMany(Player::class, 'id', 'favorite_player5'));
}
public static function getUsersWithMostComments(){
    // Obtener todos los usuarios
    $users = User::all();

    // Calcular el número total de comentarios para cada usuario
    foreach ($users as $user) {
        $user->total_comments = DB::table('comments')
            ->where('user_id', $user->id)
            ->count();
    }

    // Ordenar los usuarios por el número total de comentarios
    $users = $users->sortByDesc('total_comments');

    return $users->take(10); // Devolver solo los 10 primeros usuarios
}

public static function getUsersWithMostLikes(){
    // Obtener todos los usuarios
    $users = User::all();

    // Calcular el número total de "likes" en los comentarios para cada usuario
    foreach ($users as $user) {
        $user->total_likes = DB::table('comment_user')
            ->where('user_id', $user->id)
            ->count();
    }

    // Ordenar los usuarios por el número total de "likes"
    $users = $users->sortByDesc('total_likes');

    return $users->take(10); // Devolver solo los 10 primeros usuarios
}






public function followersCount()
{
    return DB::table('follows')
        ->where('followed_id', $this->id)
        ->count();
}

public function followingCount()
{
    return DB::table('follows')
        ->where('follower_id', $this->id)
        ->count();
}


public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
