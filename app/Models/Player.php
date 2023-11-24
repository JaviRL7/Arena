<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model
{
    use HasFactory;

    
    public function games(){
        return $this->belongsToMany(Game::class, 'clasifications')->using(Clasification::class)->withPivot('kills' , 'deaths', 'assists', 'champion_id');
    }

    //Relacion muchos a muchos para la tabla scores
    public function scoresGames(){
        return $this->belongsToMany(Game::class, 'scores')->withPivot('user_id', 'note');
    }
    //public static function getPlayersWithMostKills() {
    //    $players = DB::table('players')
      //      ->join('clasifications', 'players.id', '=', 'clasifications.player_id')
        //    ->select('players.*', DB::raw('SUM(clasifications.kills) as total_kills'))
          //  ->groupBy('players.id')
            //->orderBy('total_kills', 'desc')
            //->get();
            //return $players;
    //}
    public static function getPlayersWithMostKills() {
        $players = Player::withCount(['games as total_kills' => function ($query) {
            $query->select(DB::raw('SUM(kills)'));
        }])
        ->orderBy('total_kills', 'desc')
        ->take(10)
        ->get();
    
        return $players;
    }
    public function teams(){
        return $this->belongsToMany(Team::class, 'player_team')->withPivot('player_id', 'team_id', 'end_date', 'start_date');
    }
}
