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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $gameId = $request->input('game_id');
        $playerId = $request->input('player_id');
        $note = $request->nota;
        $review = $request->input('review'); // Obtiene el valor de 'review' del formulario
        $user = auth()->user()->id;

        Score::updateOrCreate(
            [
                'game_id' => $gameId,
                'player_id' => $playerId,
                'user_id' => $user
            ],
            [
                'note' => $note,
                'review' => $review, // Actualiza el valor de 'review'
                'updated_at' => now()
            ]
        );

        return redirect()->back();
    }



    public function create_game(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'team_blue_id' => 'required|exists:teams,id',
                'team_red_id' => 'required|exists:teams,id',
                'serie_id' => 'required|exists:series,id',
                'number' => [
                    'required',
                    'integer',
                    Rule::unique('games')->where(function ($query) use ($request) {
                        return $query->where('serie_id', $request->serie_id);
                    }),
                ],
                'players.*.champion' => 'required',
                'players.*.kills' => 'required|integer',
                'players.*.deaths' => 'required|integer',
                'players.*.assists' => 'required|integer',
                // Añadir reglas de validación para los bans y demás datos que necesites
            ]);

            // Crear un nuevo juego con los datos del formulario
            $game = new Game($validatedData);

            // Establecer manualmente los resultados del juego
            $game->team_blue_result = $request->input('resultToggle') === 'on' ? 'L' : 'W';
            $game->team_red_result = $request->input('resultToggle') === 'on' ? 'W' : 'L';

            // Guardar los bans
            for ($i = 1; $i <= 5; $i++) {
                $game->{"ban{$i}_blue"} = $request->input("ban{$i}_blue");
                $game->{"ban{$i}_red"} = $request->input("ban{$i}_red");
            }

            // Asociar el juego con la serie correspondiente
            $serie = Serie::find($validatedData['serie_id']);
            $game->serie()->associate($serie);

            // Guardar el juego
            $game->save();

            // Guardar los datos de los jugadores
            $playersData = $request->input('players', []);
            foreach ($playersData as $playerId => $playerData) {
                $game->players()->attach($playerId, [
                    'champion_id' => $playerData['champion'],
                    'kills' => $playerData['kills'],
                    'deaths' => $playerData['deaths'],
                    'assists' => $playerData['assists'],
                    // Agrega otros campos si es necesario
                ]);
            }

            // Redirige a la serie correspondiente
            return redirect()->route('admin.series.show', ['serie' => $serie->id])->with('success', 'Game created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the game. Please try again.')->withInput();
        }
    }





    public function getAvailableMapNumbers($serieId) {
        $serie = Serie::with('games')->find($serieId);  // Asegúrate de tener una relación games en el modelo Serie
        $existingNumbers = $serie->games->pluck('number')->all(); // Obtén los números de mapa existentes

        $maxMaps = 1; // Por defecto para bo1
        if ($serie->type == 'bo3') {
            $maxMaps = 3;
        } elseif ($serie->type == 'bo5') {
            $maxMaps = 5;
        }

        $availableNumbers = [];
        for ($i = 1; $i <= $maxMaps; $i++) {
            if (!in_array($i, $existingNumbers)) {
                $availableNumbers[] = $i;  // Agrega el número si no está en la lista de existentes
            }
        }

        return $availableNumbers;
    }










    public function storeScore(Request $request)
    {
        $score = Score::create([
            'game_id' => $request->game_id,
            'player_id' => $request->player_id,
            'user_id' => auth()->user()->id,
            'note' => $request->nota,
            'review' => $request->review,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => true, 'score_id' => $score->id]);
    }
    public function updateScore(Request $request, $id)
    {
        $score = Score::find($id);

        if ($score) {
            Log::info('Updating score', ['score_id' => $score->id]);

            $score->note = $request->nota;
            $score->review = $request->review;
            $score->updated_at = now();
            $score->save();

            return response()->json(['success' => true, 'message' => 'Score updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Score not found']);
        }
    }




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
    public function create(Serie $serie)
{
    // Obtén los equipos de la serie
    $team1 = $serie->team_1;
    $team2 = $serie->team_2;
    $champions = Champion::all();
    // Por defecto, el equipo azul es el equipo 1 y el equipo rojo es el equipo 2
    $team_blue = $team1;
    $team_red = $team2;
    $availableNumbers = $this->getAvailableMapNumbers($serie->id);  // Pasa el ID de la serie

    // Obtén los jugadores de los equipos
    $players_blue = $team_blue->players;
    $players_red = $team_red->players;

    return view('admin.games.create', compact('players_blue', 'players_red', 'serie', 'champions', 'availableNumbers'));
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

        return back();
    }
}
