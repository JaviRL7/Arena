<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Team;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

//corregir esto

class PlayersController extends Controller
{
    public function rankings(){
        $playersByKills = Player::getPlayersWithMostKills();
        $playersByComments = Player::getPlayersWithMostComments();
        $playersByKDA = Player::getPlayersWithBestKDA();
        $playersByAssits = Player::getPlayersWithMostAssits();
        $playersByChampionpool = Player::getPlayersWithMostChamionpool();
        return view('players.rankings', [
            'playersByKills' => $playersByKills,
            'playersByComments' => $playersByComments,
            'playersByKDA' => $playersByKDA,
            'playersByAssits' => $playersByAssits,
            'playersByChampionpool' => $playersByChampionpool,
        ]);
    }
    public function show($team1Id, $team2Id)
{
    $team1Players = Team::find($team1Id)->getPlayers();
    $team2Players = Team::find($team2Id)->getPlayers();

    return response()->json([
        'team1Players' => $team1Players,
        'team2Players' => $team2Players
    ]);
}
public function player()
{

    return view('players.player');
}

    public function index()
    {
        $players = Player::orderBy('id')->paginate(5);
        $today = Carbon::now()->format('Y-m-d');
        //Para poner que la ruta actual venia de admin, repasar esto
        //&& strpos(Player::current()->getName(), 'admin') === 0

        if (auth()->check() && auth()->user()->admin) {
            return view('admin.players.index', [
                'players' => $players, 'today' => $today,

            ]);
        } else {
            return view('pages.players', [
                'players' => $players,
            ]);
        }
    }


    public function edit(Player $player)
    {
        $today = Carbon::now()->format('Y-m-d');
        $roles = Role::all();
        $teams = Team::all();
        return view('admin.players.edit', [
            'today' => $today,
            'player' => $player,
            'roles' =>$roles,
            'teams' =>$teams
        ]);
    }



    public function update(Request $request, Player $player)
{
        $request->validate([
        'name' => ['required', 'string'],
        'lastname1' => ['required', 'string'],
        'lastname2' => ['nullable','string'],
        'country' => ['required', 'string'],
        'birth_date' => ['nullable', 'date_format:"Y-m-d"'],
        'nick' => ['required', 'string', Rule::unique('players')->ignore($player->id)],
        'photo' => ['nullable', 'image', 'max:3000'],
    ]);

    $photo = $player->photo;



    $player->update($request->all());

    if ($request->hasFile('photo')) {
        $photo = 'img-' . $player->name . '.' . $request->file('photo')
        ->getClientOriginalExtension();

        $player->photo = str_replace(
            'public',
            'storage',
            $request->file('photo')->storeAs('public/player', $photo)
        );
    } else {
        $player->photo = $photo;
    }

    $player->save();

    return redirect()->route('admin.players.index')->with('success', 'Se ha modificado el player con éxito.');
}
public function destroy(Player $player)
{
    $player->delete();
    return redirect()->route('admin.players.index');
}

}
