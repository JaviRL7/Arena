<?php

namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;

class MinigameController extends Controller
{
    public function index() {
        $player = Player::inRandomOrder()->first();
        $players = Player::all('nick');
        session(['id' => $player->id]);
        session(['clue_number' => 1]); // Reiniciamos el contador de pistas aquí
        return view('minigame.index', compact('player', 'players'));
    }

    public function getClue(Request $request) {
        $player = Player::with('role')->find(session('id'));
        $clueNumber = session('clue_number', 1); // Iniciamos en 1 si no existe la sesión

        $clue = '';
        switch ($clueNumber) {
            case 1:
                $clue = $player->role->icono;
                break;
            case 2:
                $clue = $player->mostPlayedChampion()->square; // Asegúrate de que este método esté definido
                break;
            case 3:
                $clue = $player->country;
                break;
            case 4:
                $clue = $player->teamAtEndOf2023()->logo; // Asegúrate de que este método esté definido
                break;
            case 5:
                $clue = $player->randomTeammate()->photo; // Asegúrate de que este método esté definido
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
            // Asegúrate de que tienes una forma de obtener la URL de la foto. Puede ser un campo en tu base de datos o un método en tu modelo Player.
            // Este ejemplo asume que tienes un campo 'photo' en tu modelo Player que contiene la URL de la foto.
            $photoUrl = $player->photo;

            return response()->json([
                'result' => 'correct',
                'photo' => $photoUrl // Devuelve la URL de la foto con la respuesta
            ]);
        } else {
            return response()->json(['result' => 'incorrect']);
        }
    }
}
