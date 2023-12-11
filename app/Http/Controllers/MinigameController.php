<?php

namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;

class MinigameController extends Controller
{
    public function index() {
        $player = Player::inRandomOrder()->first();
        session(['id' => $player->id]);
        return view('minigame.index', compact('player'));
    }

    public function getClue(Request $request) {
        // Usamos 'with' para cargar la relación 'role' junto con el jugador
        $player = Player::with('role')->find(session('id'));

        // Accedemos directamente a la propiedad 'name' del rol asociado
        $roleName = $player->role->name ?? 'Rol no encontrado';

        return response()->json(['clue' => $roleName]);
    }

    public function checkresponse(Request $request) {
        $tryId = $request->input('try_id');
        if (session('id') == $tryId) {
            return response()->json(['result' => 'correct']);
        } else {
            return response()->json(['result' => 'incorrect']);
        }
    }
}
