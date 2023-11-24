<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    public function rankings(){
        return view('players.rankings', ['players' => Player::getPlayersWithMostKills()->take(10)]);
    }
}
