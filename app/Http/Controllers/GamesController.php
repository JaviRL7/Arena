<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Score;
use App\Models\Comment;
use App\Models\Player;
use App\Models\Serie;
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
        $games = Game::orderBy('id')->paginate(5);
        $series = Serie::orderBy('id')->paginate(5); // Asegúrate de que 'Serie' sea el nombre correcto de tu modelo

        if (auth()->check() && auth()->user()->admin) {
            return view('admin.games.index', [ // Cambia 'admin.index' por la vista que quieras mostrar
                'games' => $games,
                'series' => $series,
            ]);
        } else {
            return view('pages.players', [
                'games' => $games,
                'series' => $series,
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
        $champions = Champion::all();
        return view('admin.game.edit', compact('game', 'champions'));
    }

    public function update(Request $request, $id)
    {

        $game = Game::find($id);

        // Actualizar equipos, resultados, número del juego y bans
        $game->team_blue_id = $request->team_blue_id;
        $game->team_red_id = $request->team_red_id;
        $game->team_blue_result = $request->team_blue_result;
        $game->team_red_result = $request->team_red_result;
        $game->number = $request->number;

        for ($i = 1; $i <= 5; $i++) {
            $game->{"ban{$i}_blue"} = $request->{"ban{$i}_blue"};
            $game->{"ban{$i}_red"} = $request->{"ban{$i}_red"};
        }

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

        return redirect()->route('admin.games.index');
    }
    public function create()
    {
        $teams = Team::all();
        $players = Player::all();
        $champions = Champion::all();

        return view('admin.games.create', compact('teams', 'players', 'champions'));
    }
    public function getPlayers($team1Id, $team2Id)
    {
        $team1Players = Team::find($team1Id)->getPlayers();
        $team2Players = Team::find($team2Id)->getPlayers();
        $champions = Champion::all();

        return response()->json([
            'team1Players' => $team1Players,
            'team2Players' => $team2Players,
            'champions' => $champions
        ]);
    }
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully');
    }
}
