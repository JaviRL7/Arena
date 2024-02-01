<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Team;
use App\Models\Role;
use App\Models\Champion;
use App\Models\User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//corregir esto

class PlayersController extends Controller
{
    public function rankings(){
        $playersByKills = Player::getPlayersWithMostKills();
        $playersByComments = Player::getPlayersWithMostComments();
        $playersByKDA = Player::getPlayersWithBestKDA();
        $playersByAssits = Player::getPlayersWithMostAssits();
        $playersByChampionpool = Player::getPlayersWithMostChamionpool();
        $playersWithMostFans = Player::getPlayersWithMostFans();
        $mostPlayedChampions = Champion::getMostPlayedChampions(); // Llamada a la nueva función
        $championsWithHighestWinRate = Champion::getChampionsWithHighestWinRate();
        $TeamsWithMostFans = Team::getTeamsWithMostFans();
        $teamsWithMostMatches = Team::getTeamsWithMostMatches();
        $teamsWithBestWinRate = Team::getTeamsWithBestWinRate();
        $usersWithMostComments = User::getUsersWithMostComments();
        $usersWithMostLikes = User::getUsersWithMostLikes();

        return view('players.rankings', [
            'playersByKills' => $playersByKills,
            'playersByComments' => $playersByComments,
            'playersByKDA' => $playersByKDA,
            'playersByAssits' => $playersByAssits,
            'playersByChampionpool' => $playersByChampionpool,
            'playersWithMostFans' => $playersWithMostFans,
            'mostPlayedChampions' => $mostPlayedChampions,
            'championsWithHighestWinRate' => $championsWithHighestWinRate,
            'TeamsWithMostFans' => $TeamsWithMostFans,
            'teamsWithMostMatches' => $teamsWithMostMatches,
            'teamsWithBestWinRate' => $teamsWithBestWinRate,
            'usersWithMostLikes' => $usersWithMostLikes,
            'usersWithMostComments' => $usersWithMostComments
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
        $messages = [
            'img.mimes' => 'El archivo debe ser de tipo: png, jpg, jpeg.',
            'img.max' => 'El tamaño del archivo no debe ser mayor a 3000 kilobytes.',
        ];

        $request->validate([
            'name' => ['required', 'string'],
            'lastname1' => ['required', 'string'],
            'lastname2' => ['nullable','string'],
            'country' => ['required', 'string'],
            'birth_date' => ['nullable', 'date_format:"Y-m-d"'],
            'nick' => ['required', 'string', Rule::unique('players')->ignore($player->id)],
            'photo' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5000'],
            'img' => ['nullable', 'mimes:png,jpg,jpeg', 'max:3000']
        ], $messages);

        $photo = $player->photo;
        $img = $player->img;

        $player->update($request->all());

        if ($request->hasFile('photo')) {
            $photo = 'img-' . $player->name . '.' . $request->file('photo')->getClientOriginalExtension();
            $player->photo = str_replace(
                'public',
                'storage',
                $request->file('photo')->storeAs('public/player', $photo)
            );
        } else {
            $player->photo = $photo;
        }

        if ($request->hasFile('img')) {
            $img = 'img-' . $player->name . '.' . $request->file('img')->getClientOriginalExtension();
            $player->img = str_replace(
                'public',
                'storage',
                $request->file('img')->storeAs('public/player_extra', $img)
            );
        } else {
            $player->img = $img;
        }

        $player->save();

        return redirect()->route('admin.players.index')->with('success', 'Se ha modificado el jugador con éxito.');
    }
public function destroy(Player $player)
{
    $player->delete();
    return redirect()->route('admin.players.index');
}

public function show_players()
{
    $players = Player::all();
    $roles = Role::all();
    return view('players.show_players', ['players' => $players, 'roles' => $roles]);
}


public function profile($id)
{
    $player = Player::find($id);
    $today = Carbon::now();

    // Obtén solo los campeones con los que ha jugado el jugador
    $champions = DB::table('clasifications')
                    ->where('player_id', $player->id)
                    ->join('games', 'clasifications.game_id', '=', 'games.id')
                    ->join('series', 'games.serie_id', '=', 'series.id')
                    ->join('champions', 'clasifications.champion_id', '=', 'champions.id')
                    ->select('champions.*', 'series.date as date')
                    ->get()
                    ->unique('id');

    // Calcula los porcentajes de victoria y derrota para cada campeón
    $playerChampionData = [];
    foreach ($champions as $champion) {
        $playerChampionData[$champion->id] = [
            'name' => $champion->name,
            'image' => $champion->square, // Usa el atributo 'square' para la imagen
            'stats' => $player->getChampionWinLoss($champion->id),
        ];
    }

    return view('players.profile', ['player' => $player, 'today' => $today, 'playerChampionData' => $playerChampionData]);
}
public function create()
{
    $roles = Role::all();
    return view('admin.players.create')->with('roles', $roles);
}

public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string'],
        'lastname1' => ['required', 'string'],
        'lastname2' => ['nullable','string'],
        'country' => ['required', 'string'],
        'birth_date' => ['nullable', 'date_format:"Y-m-d"'],
        'nick' => ['required', 'string', 'unique:players,nick'],
        'photo' => ['nullable', 'image', 'max:3000'],
        'img' => ['nullable', 'image', 'max:3000'], // Añade la validación para 'img'
    ]);

    $player = new Player;
    $player->fill($request->all());

    if ($request->hasFile('photo')) {
        $photo = 'img-' . $player->name . '.' . $request->file('photo')->getClientOriginalExtension();
        $player->photo = str_replace(
            'public',
            'storage',
            $request->file('photo')->storeAs('public/player', $photo)
        );
    }

    if ($request->hasFile('img')) { // Añade este bloque para manejar 'img'
        $img = 'img-' . $player->name . '.' . $request->file('img')->getClientOriginalExtension();
        $player->img = str_replace(
            'public',
            'storage',
            $request->file('img')->storeAs('public/player_extra', $img)
        );
    }

    $player->save();

    return redirect()->route('admin.players.index')->with('success', 'Se ha creado el player con éxito.');
}


public function updateFavorites(Request $request, Player $player)
{
    $user = Auth::user(); // obtén el usuario actualmente autenticado

    // Actualiza los jugadores favoritos del usuario
    $user->favorite_player1 = $request->favorite_player1;
    $user->favorite_player2 = $request->favorite_player2;
    $user->favorite_player3 = $request->favorite_player3;
    $user->favorite_player4 = $request->favorite_player4;
    $user->favorite_player5 = $request->favorite_player5;

    $user->save(); // guarda los cambios en la base de datos

    // Redirige al usuario a la página anterior sin mostrar ningún mensaje
    return response()->json(['success' => true]);
}


public function getFavorites(Player $player)
{
    $user = Auth::user(); // obtén el usuario actualmente autenticado

    // Obtiene los jugadores favoritos del usuario
    $favoriteIds = [
        $user->favorite_player1,
        $user->favorite_player2,
        $user->favorite_player3,
        $user->favorite_player4,
        $user->favorite_player5
    ];

    $favorites = Player::whereIn('id', $favoriteIds)->get();

    // Retorna los jugadores favoritos como una respuesta JSON
    return response()->json($favorites);
}


public function removeFan(Request $request, Player $player)
{
    $user = Auth::user(); // obtén el usuario actualmente autenticado

    // Comprueba si el jugador es uno de los jugadores favoritos del usuario
    if ($user->favorite_player1 == $player->id) {
        $user->favorite_player1 = null;
    } elseif ($user->favorite_player2 == $player->id) {
        $user->favorite_player2 = null;
    } elseif ($user->favorite_player3 == $player->id) {
        $user->favorite_player3 = null;
    } elseif ($user->favorite_player4 == $player->id) {
        $user->favorite_player4 = null;
    } elseif ($user->favorite_player5 == $player->id) {
        $user->favorite_player5 = null;
    }

    // Aquí está la declaración dd()

    $user->save(); // guarda los cambios en la base de datos

    // Redirige al usuario a la página anterior sin mostrar ningún mensaje
    return response()->json(['success' => true]);
}

public function getPlayer($id)
{
    $player = Player::find($id);

    if ($player) {
        return response()->json($player);
    } else {
        return response()->json(['error' => 'Player not found'], 404);
    }
}

public function addFan(Request $request, Player $player)
{
    $user = Auth::user(); // obtén el usuario actualmente autenticado

    // Comprueba si el usuario ya tiene todos los jugadores favoritos
    if ($user->favorite_player1 && $user->favorite_player2 && $user->favorite_player3 && $user->favorite_player4 && $user->favorite_player5) {
        // Retorna una respuesta indicando que ya hay 5 jugadores favoritos
        return response()->json(['maxFavoritesReached' => true, 'playerId' => $player->id]);
    }

    // Agrega el jugador a la primera posición de jugador favorito disponible
    if (!$user->favorite_player1) {
        $user->favorite_player1 = $player->id;
    } elseif (!$user->favorite_player2) {
        $user->favorite_player2 = $player->id;
    } elseif (!$user->favorite_player3) {
        $user->favorite_player3 = $player->id;
    } elseif (!$user->favorite_player4) {
        $user->favorite_player4 = $player->id;
    } else {
        $user->favorite_player5 = $player->id;
    }

    $user->save(); // guarda los cambios en la base de datos

    // Redirige al usuario a la página anterior sin mostrar ningún mensaje
    return response()->json(['success' => true]);
}








}


