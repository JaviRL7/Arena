<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Score;
use App\Models\Comment;
use App\Models\Player;
use App\Models\Team;
use App\Models\Champion;

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
        $champions = Champion::all();
        $teams = Team::all();

        $team_blue = $game->team_blue;
        $players_blue = $team_blue->getplayersDate($game->serie->date);

        $team_red = $game->team_red;
        $players_red = $team_red->getplayersDate($game->serie->date);

        return view('admin.games.show', compact('game', 'players_blue', 'players_red', 'champions', 'teams'));

    }
    public function edit_result(Game $game, Player $player)
    {
        return view('admin.games.edit_result', compact('game', 'player'));
    }

    public function edit($id)
{
    $game = Game::find($id);
    $champions = Champion::all(); // Asegúrate de tener todos los campeones disponibles para la selección
    return view('admin.game.edit', compact('game', 'champions'));
}

public function update(Request $request, $id)
{
    $game = Game::find($id);

    // Actualizar equipos y resultados
    $game->team_blue_id = $request->team_blue_id;
    $game->team_red_id = $request->team_red_id;
    $game->team_blue_result = $request->team_blue_result;
    $game->team_red_result = $request->team_red_result;
    $game->save();


    foreach ($request->players as $player_id => $player_data) {
        $player = Player::find($player_id);

        $player->games()->syncWithoutDetaching([
            $game->id => [
                'champion_id' => $player_data['champion'],
                'kills' => $player_data['kills'],
                'deaths' => $player_data['deaths'],
                'assists' => $player_data['assists']
            ]
        ]);
    }

    return redirect()->route('admin.games.show', $game->id);
}
public function create()
{
    $teams = Team::all();
    $players = Player::all();
    $champions = Champion::all();

    return view('admin.games.create', compact('teams', 'players', 'champions'));
}


}
