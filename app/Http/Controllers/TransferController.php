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
}
