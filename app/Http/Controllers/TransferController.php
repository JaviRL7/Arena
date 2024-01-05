<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Player;
use App\Models\Team;
use App\Models\Competition;

use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
        $transfers = Transfer::all();
        $players = Player::all();
        $teams = Team::all()->filter->hadFiveRolesLastYear();

        return view('transfers.index', compact('transfers', 'players', 'teams', 'competitions'));
    }
    public function index2()
    {

        $transfers = Transfer::all();

        return view('transfers.index2', compact('transfers'));
    }
    public function index13()
    {



        return view('equipos.index');
    }
}
