<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlayersController extends Controller
{
    public function rankings(){
        $playersByKills = Player::getPlayersWithMostKills();
        $playersByComments = Player::getPlayersWithMostComments();
        $playersByKDA = Player::getPlayersWithBestKDA();
        $playersByAssits = Player::getPlayersWithMostAssits();
        $playersByChampionpool = Player::getPlayersWithMostChamionpool();
        return view('players.rankings', [
            'playersByKills' => $playersByKills,
            'playersByComments' => $playersByComments,
            'playersByKDA' => $playersByKDA,
            'playersByAssits' => $playersByAssits,
            'playersByChampionpool' => $playersByChampionpool,
        ]);
    }

    public function index()
    {
        $players = Player::orderBy('id')->get();
        $today = Carbon::now()->format('Y-m-d');
        $currenteam = $player->teams()->where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();


        //Para poner que la ruta actual venia de admin, repasar esto
        //&& strpos(Player::current()->getName(), 'admin') === 0

        if (auth()->check() && auth()->user()->admin) {
            return view('admin.players.index', [
                'players' => $players, 'today' => $today, 'currenteam' => $currenteam,

            ]);
        } else {
            return view('pages.grupos', [
                'players' => $players,
            ]);
        }
    }

}
