<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Role;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    public function index() {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    public function create() {
        return view('players.create');
    }
    public function store() {
        $player = new Player();
        $player->name = request('name');
        $player->lastname1 = request('lastname1');
        $player->lastname2 = request('lastname2');
        $player->nick = request('nick');
        $player->role_id = request('role_id');
        $player->country = request('country');
        $player->save();

        return redirect()->route('players.index');
    }
    public function show($id){
        $player = Player::findOrFail($id);
        return view('players.show', compact('player'));
    }
    public function edit(Player $player){
        $roles = Role::all();
        return view('players.edit', compact('player', 'roles'));
    }
    public function destroy($id){
    // Eliminar el jugador de la base de datos
        Player::findOrFail($id)->delete();
    // Redireccionar al usuario a la lista de jugadores
        return redirect()->route('players.index');
    }
    public function update(Player $player)
    {
        $player->update(request()->all());

        return redirect()->route('players.index');
    }
}
