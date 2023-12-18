<?php

namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;

class MinigameController extends Controller
{
    public function index() {
        $player = Player::inRandomOrder()->first();
        session(['id' => $player->id]);
        session(['clue_number' => 1]); // Reiniciamos el contador de pistas aquí
        return view('minigame.index', compact('player'));
    }

    public function getClue(Request $request) {
        $player = Player::with('role')->find(session('id'));
        $clueNumber = session('clue_number', 1); // Iniciamos en 1 si no existe la sesión

        $clue = '';
        switch ($clueNumber) {
            case 1:
                $clue = $player->role->name ?? 'Rol no encontrado';
                break;
            case 2:
                $clue = $player->mostPlayedChampion()->name; // Asegúrate de que este método esté definido
                break;
            case 3:
                $clue = $player->country ?? 'País no encontrado';
                break;
            case 4:
                $clue = $player->currentTeam()->name; // Asegúrate de que este método esté definido
                break;
            case 5:
                $clue = $player->randomTeammate()->nick; // Asegúrate de que este método esté definido
                break;
            default:
                $clue = 'No hay más pistas';
                break;

        }

        // Incrementamos el número de la pista para la próxima vez
        session(['clue_number' => $clueNumber < 5 ? $clueNumber + 1 : 1]);

        return response()->json(['clue' => $clue]);
    }


    public function checkresponse(Request $request) {
        $tryNick = strtolower($request->input('try_nick'));
        $player = Player::whereRaw('lower(nick) = ?', [$tryNick])->first();

        if ($player && session('id') == $player->id) {
            return response()->json(['result' => 'correct']);
        } else {
            return response()->json(['result' => 'incorrect']);
        }
    }
}
