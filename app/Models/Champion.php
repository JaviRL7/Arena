<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Champion extends Model
{
    use HasFactory;
    public static function getMostPlayedChampions()
    {
        $mostPlayedChampions = DB::table('clasifications')
            ->join('champions', 'clasifications.champion_id', '=', 'champions.id')
            ->select('champions.id', 'champions.name', 'champions.photo', 'champions.square', DB::raw('count(*) as times_played'))
            ->groupBy('champions.id', 'champions.name', 'champions.photo', 'champions.square')
            ->orderBy('times_played', 'desc')
            ->take(15)
            ->get();

        return $mostPlayedChampions;
    }









    public static function getChampionsWithHighestWinRate()
{
    $championsWinData = DB::table('clasifications as c')
        ->join('games as g', 'g.id', '=', 'c.game_id')
        ->join('series as s', 's.id', '=', 'g.serie_id') // Join con la tabla serie para obtener la fecha del juego
        ->join('champions as ch', 'ch.id', '=', 'c.champion_id')
        ->leftJoin('player_team as pt', function ($join) {
            $join->on('pt.player_id', '=', 'c.player_id')
                ->whereColumn('pt.start_date', '<=', 's.date') // Verificar la fecha de la serie
                ->where(function ($query) {
                    $query->whereColumn('pt.contract_expiration_date', '>=', 's.date')
                          ->orWhereNull('pt.contract_expiration_date');
                });
        })
        ->select('ch.id', 'ch.name', 'ch.photo', 'ch.square',
            DB::raw('COUNT(*) as total_games'),
            DB::raw('SUM(
                CASE WHEN
                    ((pt.team_id = g.team_blue_id AND g.team_blue_result = \'W\') OR
                    (pt.team_id = g.team_red_id AND g.team_red_result = \'W\'))
                    THEN 1 ELSE 0 END
            ) as total_wins'))
        ->groupBy('ch.id', 'ch.name', 'ch.photo', 'ch.square')

        ->get();

    // Calcula las tasas de victoria y derrota para cada campeón
    foreach ($championsWinData as &$championData) {
        $totalGames = $championData->total_games;
        $totalWins = $championData->total_wins;

        // Calcula la tasa de victoria para el campeón
        $winRate = ($totalGames > 0) ? (($totalWins / $totalGames) * 100) : 0;

        // Agrega la tasa de victoria al objeto de datos del campeón
        $championData->win_rate = round($winRate, 2);
    }

    // Ordena los campeones por tasa de victorias
    $championsWinData = $championsWinData->sortByDesc('win_rate');

    return $championsWinData;
}






}
