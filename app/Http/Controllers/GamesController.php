<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Score;
use App\Models\Comment;
use App\Models\Player;
use App\Models\Team;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }



    public function result(Game $game)
    {

        $team_blue = $game->team_blue;
        $players_blue = $team_blue->getplayersDate($game->serie->date);

        $team_red = $game->team_red;
        $players_red = $team_red->getplayersDate($game->serie->date);

        return view('games.results', compact('game', 'players_blue', 'players_red'));
    }




    public function store(Request $request)
    {

        $user = auth()->user()->id;


        $playerId = $request->player_id;
        $note = $request->nota;

        $gameId = $request->game_id;

        if ($note === null) {
            Score::where('game_id', $gameId)
                ->where('player_id', $playerId)
                ->where('user_id', $user)
                ->delete();

            return redirect()->back();
        }

        Score::updateOrInsert(
            ['game_id' => $gameId, 'player_id' => $playerId, 'user_id' => $user],
            ['note' => $note]
        );

        return redirect()->back();
    }

///Los de admin

public function indexadmin()
    {
        $games = Game::orderBy('id')->get();
        if (auth()->check() && auth()->user()->admin) {
            return view('admin.games.index', [
                'games' => $games,

            ]);
        } else {
            return view('pages.players', [
                'games' => $games,
            ]);
        }
    }
    public function show(Game $game)
    {
        $team_blue = $game->team_blue;
        $players_blue = $team_blue->getplayersDate($game->serie->date);

        $team_red = $game->team_red;
        $players_red = $team_red->getplayersDate($game->serie->date);

        return view('admin.games.show', compact('game', 'players_blue', 'players_red'));

    }

}
