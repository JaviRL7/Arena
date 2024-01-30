<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'league_id',
        'country',
        'logo',
        // cualquier otro campo que quieras que sea asignable en masa
    ];
    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot('start_date', 'contract_expiration_date', 'end_date', 'substitute');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'league_id');
    }
    public function getPlayers()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('start_date', '<=', $today)
            ->where('end_date', '=', null)
            ->where('substitute', '=', false)
            ->orderBy('role_id', 'asc')
            ->get();
    }

    public function getPlayersDate($date)
    {
        return $this->players()
            ->where('start_date', '<=', $date)
            ->where('contract_expiration_date', '>=', $date)
            ->where(function ($query) use ($date) {
                $query->where('end_date', '>=', $date)
                    ->orWhereNull('end_date');
            })
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getPlayersFromLastYear()
    {
        $date = \Carbon\Carbon::now()
            ->subYear()
            ->setMonth(12)
            ->setDay(30)
            ->toDateString();
        return $this->getPlayersDate($date);
    }




    public function getChampionWinLoss($championId) {
        // Obtén los ID de los jugadores del equipo
        $playerIds = $this->players()->pluck('id');

        // Obtén todas las clasificaciones donde se jugó el campeón por uno de los jugadores del equipo
        $clasifications = DB::table('clasifications')
                    ->whereIn('player_id', $playerIds)
                    ->where('champion_id', $championId)
                    ->join('games', 'clasifications.game_id', '=', 'games.id')
                    ->join('series', 'games.serie_id', '=', 'series.id')
                    ->select('clasifications.*', 'games.team_blue_id', 'games.team_red_id', 'games.team_blue_result', 'games.team_red_result', 'series.date as date')
                    ->get();

        $winCount = 0;
        $lossCount = 0;

        // Recorre cada clasification y determina si fue una victoria o una derrota
        foreach ($clasifications as $clasification) {
            // Obtén los jugadores del equipo en la fecha del juego
            $players = $this->getPlayersDate($clasification->date)->pluck('id');

            // Verifica si el jugador que jugó el campeón es parte del equipo
            if ($players->contains($clasification->player_id)) {
                if (($clasification->team_blue_id == $this->id && $clasification->team_blue_result == 'W') ||
                    ($clasification->team_red_id == $this->id && $clasification->team_red_result == 'W')) {
                    $winCount++;
                } else {
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






    public function getPlayersByYear($year)
    {
        $startDate = \Carbon\Carbon::create($year, 1, 1);
        $endDate = \Carbon\Carbon::create($year, 12, 31);

        return $this->players()
            ->where('start_date', '<=', $endDate)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('end_date', [$startDate, $endDate]);
                })->orWhere(function ($query) use ($endDate) {
                    $query->whereNull('end_date')
                          ->where('contract_expiration_date', '>=', $endDate);
                });
            })
            ->orderBy('role_id', 'asc')
            ->get();
    }



















    public function getPlayersSubstitute()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where(function ($query) use ($today) {
                $query->where('player_team.end_date', '>=', $today)
                    ->orWhereNull('player_team.end_date');
            })
            ->where('player_team.substitute', true)
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getPastPlayers()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where(function ($query) use ($today) {
                $query->where('player_team.end_date', '<', $today)
                    ->orWhere(function ($query) use ($today) {
                        $query->whereNull('player_team.end_date')
                            ->where('player_team.contract_expiration_date', '<', $today);
                    });
            })
            ->orderBy('player_team.end_date', 'desc')
            ->get();
    }
    public function getPlayersWithSameRole()
    {
        $today = Carbon::now()->format('Y-m-d');
        $roleIds = $this->players()
            ->where(function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->pluck('role_id')
            ->duplicates();

        return $this->players()
            ->whereIn('role_id', $roleIds)
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getToplaner()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 1)
            ->where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->orderBy('start_date', 'desc');
    }

    //Estas aun no estan actualizadas

    public function getJungler()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 2)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getMidlaner()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 3)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getADC()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 4)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getSupport()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 5)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function games()
    {
        return $this->hasMany(Game::class, 'team_blue_id')->orWhere('team_red_id', $this->id);
    }

    public function checksubstitute($date)
    {
        $date = Carbon::parse($date);

        $players = $this->players()->wherePivot('start_date', '<=', $date)
            ->where(function ($query) use ($date) {
                $query->where('end_date', '>=', $date)
                    ->orWhereNull('end_date');
            })->get();

        $grouped = $players->groupBy('role_id');
        foreach ($grouped as $roleId => $players) {

            $notSubstitutes = $players->where('pivot.substitute', false);

            if ($notSubstitutes->count() > 1) {

                $sorted = $notSubstitutes->sortByDesc(function ($player) {
                    return $player->pivot->start_date;
                });

                $latest = $sorted->shift();

                foreach ($sorted as $player) {
                    $player->pivot->substitute = true;
                    $player->pivot->save();
                }
            }
        }
    }
    public function hadFiveRolesLastYear()
    {
        $lastYearPlayers = $this->getPlayersFromLastYear();
        $roles = $lastYearPlayers->pluck('role_id')->unique();

        return count($roles) == 5;
    }



    public static function getTeamsWithMostFans()
{
    // Subconsulta para contar fans para cada equipo
    $fansCountSubquery = DB::table('users')
        ->select('favorite_team as team_id')
        ->selectRaw('count(*) as total_fans')
        ->groupBy('favorite_team')
        ->toSql();

    // Obtener equipos y realizar un LEFT JOIN con la subconsulta
    $teams = DB::table('teams')
        ->leftJoin(DB::raw("($fansCountSubquery) as fc"), 'teams.id', '=', 'fc.team_id')
        ->select('teams.*')
        ->selectRaw('COALESCE(SUM(fc.total_fans), 0) as total_fanbase')
        ->groupBy('teams.id')
        ->orderByRaw('COALESCE(SUM(fc.total_fans), 0) DESC') // Primero ordena por el número total de fans
        ->orderBy('teams.name', 'asc')   // Luego ordena alfabéticamente por el nombre en caso de empate
        ->take(10)
        ->get();

    return $teams;
}
public static function getTeamsWithHighestWinRate()
{
    // Subconsulta para calcular el winrate para cada equipo
    $winRateSubquery = DB::table('matches')
        ->select('team_id')
        ->selectRaw('SUM(case when result = "win" then 1 else 0 end) / COUNT(*) as win_rate')
        ->groupBy('team_id')
        ->toSql();

    // Obtener equipos y realizar un LEFT JOIN con la subconsulta
    $teams = DB::table('teams')
        ->leftJoin(DB::raw("($winRateSubquery) as wr"), 'teams.id', '=', 'wr.team_id')
        ->select('teams.*')
        ->selectRaw('COALESCE(wr.win_rate, 0) as win_rate')
        ->groupBy('teams.id')
        ->orderByRaw('COALESCE(wr.win_rate, 0) DESC') // Ordena por winrate
        ->orderBy('teams.name', 'asc')   // Luego ordena alfabéticamente por el nombre en caso de empate
        ->take(10)
        ->get();

    return $teams;
}



}
