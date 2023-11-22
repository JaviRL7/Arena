<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Game;

class GamesController extends Controller
{
    public function index(){
        $games = Game::all();
        return view('games.index', compact('games'));
    }
    public function result(Game $game){
        
        return view('games.results', compact('game'));
    }
}
