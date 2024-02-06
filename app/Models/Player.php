<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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















    public function randomTeammate()
    {
        $teams = $this->teams()->pluck('team_id');

        $teammates = Player::whereHas('teams', function ($query) use ($teams) {
            $query->whereIn('team_id', $teams);
        })->where('id', '!=', $this->id)
            ->get();


        return $teammates->random();
    }
    public static function getPlayersWithMostFans()
{
    // Subconsulta para contar fans para cada jugador
    $fansCountSubquery = DB::table('users')
        ->select('favorite_player1 as player_id')
        ->selectRaw('count(*) as total_fans')
        ->groupBy('favorite_player1')
        ->unionAll(
            DB::table('users')->select('favorite_player2 as player_id')->selectRaw('count(*) as total_fans')->groupBy('favorite_player2')
        )
        ->unionAll(
            DB::table('users')->select('favorite_player3 as player_id')->selectRaw('count(*) as total_fans')->groupBy('favorite_player3')
        )
        ->unionAll(
            DB::table('users')->select('favorite_player4 as player_id')->selectRaw('count(*) as total_fans')->groupBy('favorite_player4')
        )
        ->unionAll(
            DB::table('users')->select('favorite_player5 as player_id')->selectRaw('count(*) as total_fans')->groupBy('favorite_player5')
        )
        ->toSql();

    // Obtener jugadores y realizar un LEFT JOIN con la subconsulta
    $players = DB::table('players')
        ->leftJoin(DB::raw("($fansCountSubquery) as fc"), 'players.id', '=', 'fc.player_id')
        ->select('players.*')
        ->selectRaw('COALESCE(SUM(fc.total_fans), 0) as total_fanbase')
        ->groupBy('players.id')
        ->orderByRaw('COALESCE(SUM(fc.total_fans), 0) DESC') // Primero ordena por el número total de fans
        ->orderBy('players.name', 'asc')   // Luego ordena alfabéticamente por el nombre en caso de empate
        ->take(10)
        ->get();

    return $players;
}


public function getFansAttribute()
{
    return \App\Models\User::where('favorite_player1', $this->id)
        ->orWhere('favorite_player2', $this->id)
        ->orWhere('favorite_player3', $this->id)
        ->orWhere('favorite_player4', $this->id)
        ->orWhere('favorite_player5', $this->id)
        ->get();
}






    public function mostPlayedChampion()
{
    return DB::table('games')
        ->join('clasifications', 'games.id', '=', 'clasifications.game_id')
        ->join('champions', 'clasifications.champion_id', '=', 'champions.id')
        ->select('champions.id', 'champions.name', 'champions.square','champions.photo', DB::raw('count(*) as total'))
        ->where('clasifications.player_id', $this->id)
        ->groupBy('champions.id', 'champions.name', 'champions.square')
        ->orderBy('total', 'desc')
        ->first();
}


    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'player_id');
    }

    public function scoresGames()
{
    return $this->belongsToMany(Game::class, 'scores')->withPivot('user_id', 'note');
}
    public function averageScoreForGame($gameId)
    {
        return $this->scoresGames()
                    ->where('game_id', $gameId)
                    ->avg('scores.note'); // Especifica la tabla 'scores' aquí
    }


    public static function getPlayersWithMostKills()
{
    $players = Player::withCount(['games as total_kills' => function ($query) {
        // Usa COALESCE para tratar NULL como 0
        $query->select(DB::raw('COALESCE(SUM(kills), 0)'));
    }])
    ->orderBy('total_kills', 'desc')
    ->take(10)
    ->get();

    return $players;
}

public static function getPlayersWithMostAssits()
{
    $players = Player::withCount(['games as total_assits' => function ($query) {
        // Usa COALESCE para tratar NULL como 0
        $query->select(DB::raw('COALESCE(SUM(assists), 0)'));
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
    public function clasifications()
    {
        return $this->hasMany(Clasification::class);
    }


    public function champions()
    {
        return $this->belongsToMany(Champion::class, 'clasifications', 'player_id', 'champion_id');
    }

    public function getMostPlayedChamp()
    {
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
    public function teamAtEndOf2023()
    {
        $endOf2023 = \Carbon\Carbon::create(2023, 12, 1);
        return $this->belongsToMany(Team::class, 'player_team')
            ->wherePivot('start_date', '<=', $endOf2023)
            ->wherePivot('contract_expiration_date', '>=', $endOf2023)
            ->withPivot('start_date', 'contract_expiration_date')
            ->first();
    }












    public function getChampionWinLoss($championId) {
        $clasifications = $this->clasifications()
            ->where('champion_id', $championId)
            ->join('games', 'clasifications.game_id', '=', 'games.id')
            ->select('clasifications.*', 'games.team_blue_id', 'games.team_red_id', 'games.team_blue_result', 'games.team_red_result')
            ->get();

        $winCount = 0;
        $lossCount = 0;

        // Verifica si el equipo del jugador ganó este juego
        foreach ($clasifications as $clasification) {
            $teams = $this->teams()->where(function ($query) use ($clasification) {
                if ($clasification->date !== null) {
                    $query->wherePivot('start_date', '<=', $clasification->date)
                        ->where(function ($query) use ($clasification) {
                            $query->wherePivot('end_date', '>=', $clasification->date)
                                ->orWhere('end_date', null);
                        });
                }
            })->get();

            foreach ($teams as $team) {
                if (($clasification->team_blue_id == $team->id && $clasification->team_blue_result == 'W') ||
                    ($clasification->team_red_id == $team->id && $clasification->team_red_result == 'W')) {
                    $winCount++;
                } else if (($clasification->team_blue_id == $team->id && $clasification->team_blue_result == 'L') ||
                    ($clasification->team_red_id == $team->id && $clasification->team_red_result == 'L')) {
                    $lossCount++;
                }
            }
        }

        // Calcula los porcentajes de victoria y derrota
        $totalGames = $winCount + $lossCount;
        $winPercentage = $totalGames > 0 ? ($winCount / $totalGames) * 100 : 0;
        $lossPercentage = $totalGames > 0 ? ($lossCount / $totalGames) * 100 : 0;

        // Devuelve los porcentajes
        return [
            'win_percentage' => $winPercentage,
            'loss_percentage' => $lossPercentage,
        ];
    }









    public function getLastTeam()
{
    // Primero, intenta obtener el equipo con la 'end_date' más reciente
    $lastTeam = $this->teams()->where('player_team.end_date', '<=', Carbon::now())->orderBy('player_team.end_date', 'desc')->first();

    // Si 'end_date' es null para todos los equipos, obtén el equipo con la 'contract_expiration_date' más reciente
    if (is_null($lastTeam)) {
        $lastTeam = $this->teams()->orderBy('player_team.contract_expiration_date', 'desc')->first();
    }

    return $lastTeam;
}
public function getTotalKills()
{
    return $this->games()->sum('kills');
}

public function getTotalAssists()
{
    return $this->games()->sum('assists');
}

public function getTotalDeaths()
{
    return $this->games()->sum('deaths');
}

public function getKDA()
{
    $totalKills = $this->getTotalKills();
    $totalAssists = $this->getTotalAssists();
    $totalDeaths = $this->getTotalDeaths();

    if ($totalDeaths == 0) {
        return ($totalKills + $totalAssists);
    } else {
        return ($totalKills + $totalAssists) / $totalDeaths;
    }
}

}
