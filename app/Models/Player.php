<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname1',
        'lastname2',
        'nick',
        'country',
        'photo',
        'birth_date',
        'role_id',

    ];
    public function games()
    {
        return $this->belongsToMany(Game::class, 'clasifications')->using(Clasification::class)->withPivot('kills', 'deaths', 'assists', 'champion_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'player_id');
    }
    public function scoresGames()
    {
        return $this->belongsToMany(Game::class, 'scores')->withPivot('user_id', 'note');
    }


    public static function getPlayersWithMostKills()
    {
        $players = Player::withCount(['games as total_kills' => function ($query) {
            $query->select(DB::raw('SUM(kills)'));
        }])
            ->orderBy('total_kills', 'desc')
            ->take(10)
            ->get();

        return $players;
    }
    public static function getPlayersWithMostAssits()
    {
        $players = Player::withCount(['games as total_assits' => function ($query) {
            $query->select(DB::raw('SUM(assists)'));
        }])
            ->orderBy('total_assits', 'desc')
            ->take(10)
            ->get();

        return $players;
    }
    public static function getPlayersWithMostChamionpool()
    {
        $players = Player::withCount(['games as total_championpool' => function ($query) {
            $query->select(DB::raw('COUNT(distinct champion_id)'));
        }])
            ->groupBy('players.id')
            ->orderBy('total_championpool', 'desc')
            ->take(10)
            ->get();

        return $players;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public static function getPlayersWithBestKDA()
    {
        $players = Player::select('players.*', DB::raw('((SUM(clasifications.kills) + SUM(clasifications.assists)) / SUM(clasifications.deaths)) as kda'))
            ->join('clasifications', 'players.id', '=', 'clasifications.player_id')
            ->groupBy('players.id', 'clasifications.player_id')
            ->orderBy('kda', 'desc')
            ->take(10)
            ->get();

        return $players;
    }

    public static function getPlayersWithMostComments()
    {
        $players = Player::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();

        return $players;
    }

    public function champions() {
        return $this->belongsToMany(Champion::class, 'clasifications', 'player_id', 'champion_id');
    }

    public function getMostPlayedChamp() {
        // Asumimos que existe una relación 'champions' en el modelo Player
        $mostPlayedChamp = $this->champions()
                    ->select('champions.name', DB::raw('COUNT(clasifications.champion_id) as played_count'))
                    ->join('clasifications', 'champions.id', '=', 'clasifications.champion_id')
                    ->groupBy('champions.name')
                    ->orderBy('played_count', 'DESC')
                    ->first();

        return $mostPlayedChamp ? $mostPlayedChamp->name : null;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'player_team')->withPivot('player_id', 'team_id', 'contract_expiration_date', 'end_date', 'start_date');
    }
    public function currentTeam()
    {
        $now = \Carbon\Carbon::now();
        return $this->belongsToMany(Team::class, 'player_team')
            ->wherePivot('start_date', '<=', $now)
            ->wherePivot('contract_expiration_date', '>=', $now)
            ->withPivot('start_date', 'contract_expiration_date')
            ->first();
    }
}
