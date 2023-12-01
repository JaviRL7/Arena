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
    public function index(){
        $games = Game::all();
        return view('games.index', compact('games'));
    }
    public function result(Game $game){
        $today = date('Y-m-d'); // o cualquier fecha que necesites

        $team_blue = $game->team_blue;
        $players_blue = $team_blue->getplayers()->filter(function($player) use ($today) {
            $player->checkForSubstitute($player->role_id, $today);
            return $player->substitute == false;
        });

        $team_red = $game->team_red;
        $players_red = $team_red->getplayers()->filter(function($player) use ($today) {
            $player->checkForSubstitute($player->role_id, $today);
            return $player->substitute == false;
        });

        return view('games.results', compact('game', 'players_blue', 'players_red'));
    }
    public function store(Request $request)
{
    // Obtener el ID del usuario autenticado
    $user = auth()->user()->id;

    // Obtener el ID del jugador y la nota del formulario de solicitud
    $playerId = $request->player_id;
    $note = $request->nota;

    // Obtener el ID del juego
    $gameId = $request->game_id; // Aquí asumimos que $this es la instancia de Game

    // Verificar si se seleccionó la opción para eliminar
    if ($note === null) {
        // Eliminar la puntuación correspondiente
        Score::where('game_id', $gameId)
            ->where('player_id', $playerId)
            ->where('user_id', $user)
            ->delete();

        // Redireccionar de nuevo a la página anterior
        return redirect()->back();
    }

    // Utilizar updateOrInsert para manejar la lógica de inserción o actualización
    Score::updateOrInsert(
        ['game_id' => $gameId, 'player_id' => $playerId, 'user_id' => $user],
        ['note' => $note]
    );

    // Redireccionar de nuevo a la página anterior
    return redirect()->back();
}
}
