<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Player;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(User $user): View
    {


        $reviews = $user->scores;
        $followings= $user->followings;
        $followers = $user->followers;
        // Obtiene las actividades de los usuarios seguidos
        $activities = collect();

        foreach ($followings as $followingUser) {
            // Añade scores de los usuarios seguidos
            // Asegúrate de tener el método scores() definido en el modelo User
            $activities = $activities->concat($followingUser->scores()->with(['game', 'game.champion'])->latest()->get());

            // Añade comentarios de los usuarios seguidos
            // Asegúrate de tener el método comments() definido en el modelo User
            $activities = $activities->concat($followingUser->comments()->with('user')->latest()->get());
        }

        // Ordena todas las actividades por fecha de creación
        $activities = $activities->sortByDesc('created_at');

        $players = Player::paginate(5);

        return view('profile.index', [
            'user' => $user,
            'players' => $players,
            'activities' => $activities,
            'reviews' => $reviews,
            'followings' => $followings,
            'followers' => $followers,
        ]);
    }








public function getPlayers(Request $request)
{
    if ($request->ajax()) {
        $players = Player::query();
        return DataTables::of($players)
            ->addColumn('photo', function ($player) {
                $photoHtml = '<div style="position:relative;"><img class="player-photo" src="' . asset($player->photo) . '">';

                if ($player->currentTeam()) {
                    $photoHtml .= '<img class="team-logo" src="' . asset($player->currentTeam()->logo) . '">';
                } else {
                    $photoHtml .= '<h5 style="font-weight:bold;">LFT</h5>'; // LFT en negrita cuando currentTeam es null
                }

                if ($player->role) {
                    $photoHtml .= '<img class="role-logo" src="' . asset($player->role->icono) . '">';
                }

                $photoHtml .= '</div>';
                return $photoHtml;
            })
            ->addColumn('nick', function ($player) {
                return '<div class="player-name"><h1>' . $player->nick . '</h1><p style="font-size: 0.8em; color: gray;">' . $player->name . ' ' . $player->lastname1 . '</p></div>';
            })
            ->rawColumns(['photo', 'nick'])
            ->make(true);
    }

    $players = Player::paginate(5);
    return view('profile.index', [
        'user' => $request->user(),
        'players' => $players,
    ]);
}




















    public function getFavorite()
    {
        $user = Auth::user();
        $favoritePlayers = Player::whereIn('id', [
            $user->favorite_player1,
            $user->favorite_player2,
            $user->favorite_player3,
            $user->favorite_player4,
            $user->favorite_player5,
        ])->get();
        return response()->json($favoritePlayers);
    }
    public function favorite(Request $request)
    {
        // Obtén el usuario actualmente autenticado
        $user = Auth::user();

        // Actualiza los jugadores favoritos del usuario
        $user->favorite_player1 = $request->input('favorite_player1');
        $user->favorite_player2 = $request->input('favorite_player2');
        $user->favorite_player3 = $request->input('favorite_player3');
        $user->favorite_player4 = $request->input('favorite_player4');
        $user->favorite_player5 = $request->input('favorite_player5');

        // Guarda los cambios en la base de datos
        /** @var \App\Models\User $user */

        $user->save();

        // Redirige al usuario a donde quieras que vaya después
        return redirect()->route('profile.index', ['user' => $user->id]);
    }

    public function comments()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \Illuminate\Database\Eloquent\Collection $comments */
        $comments = $user->comments()->with('user')->get();

        return response()->json($comments);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }








    public function followings(User $user)
    {
        $followings = $user->followings()->get()->map(function ($following) use ($user) {
            // Asume que tienes métodos para obtener los datos de jugadores y equipos favoritos
            $favoritePlayers = $following->getFavoritePlayers();
            $favoriteTeam = $following->getFavoriteTeam();

            return [
                'id' => $following->id,
                'photo' => asset($following->user_photo), // Usa asset() para obtener la URL completa
                'nick' => $following->nick,
                'name' => $following->name,
                'favoritePlayers' => $favoritePlayers, // Asegúrate de que incluyan la foto de cada jugador
                'favoriteTeam' => $favoriteTeam, // Incluye el logo del equipo
                'isMutual' => $following->followers->contains($user->id)
            ];
        });

        return response()->json($followings);
    }





    public function addFan(Request $request, Player $player)
    {
        $user = Auth::user(); // obtén el usuario actualmente autenticado

        // Comprueba si el usuario ya tiene todos los jugadores favoritos
        if ($user->favorite_player1 && $user->favorite_player2 && $user->favorite_player3 && $user->favorite_player4 && $user->favorite_player5) {
            return response()->json(['message' => 'Ya tienes todos los jugadores favoritos.'], 400);
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

        return response()->json(['message' => 'Te has convertido en fan del jugador.']);
    }



    public function updateFavorites(Request $request)
    {
        $user = Auth::user(); // obtén el usuario actualmente autenticado

        // Actualiza los jugadores favoritos del usuario
        $user->favorite_player1 = $request->favorite_player1;
        $user->favorite_player2 = $request->favorite_player2;
        $user->favorite_player3 = $request->favorite_player3;
        $user->favorite_player4 = $request->favorite_player4;
        $user->favorite_player5 = $request->favorite_player5;

        $user->save(); // guarda los cambios en la base de datos

        return response()->json(['message' => 'Jugadores favoritos actualizados con éxito.']);
    }






    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar los datos del formulario
        $data = $request->only([
            'name', 'nick', 'email', 'admin', 'validated', 'birth_date', 'twitter', 'discord',
            'user_photo', 'user_header_photo', 'favorite_player1', 'favorite_player2',
            'favorite_player3', 'favorite_player4', 'favorite_player5', 'favorite_team'
        ]);
        $validatedData = $request->validate([
            'name' => 'required',
            'nick' => 'nullable',
            'birth_date' => 'nullable|date',
            'twitter' => 'nullable',
            'discord' => 'nullable',
            'favorite_player1' => 'nullable',
            'favorite_player2' => 'nullable',
            'favorite_player3' => 'nullable',
            'favorite_player4' => 'nullable',
            'favorite_player5' => 'nullable',
            'favorite_team' => 'nullable',
        ]);

        // Si se subió una nueva foto de perfil, guardarla en el servidor y actualizar el campo correspondiente
        if ($request->hasFile('user_photo')) {
            $photoName = $user->name . '.' . $request->file('user_photo')->getClientOriginalExtension();
            $request->file('user_photo')->move(public_path('Profile_photos'), $photoName);
            $user->user_photo = 'Profile_photos/' . $photoName;
        }

        // Si se subió una nueva foto de portada, guardarla en el servidor y actualizar el campo correspondiente
        if ($request->hasFile('user_header_photo')) {
            $photoName = $user->name . '_header' . '.' . $request->file('user_header_photo')->getClientOriginalExtension();
            $request->file('user_header_photo')->move(public_path('Profile_photos'), $photoName);
            $user->user_header_photo = 'Profile_photos/' . $photoName;
        }
        foreach ($validatedData as $field => $value) {
            if ($value === '') {
                $validatedData[$field] = null;
            }
        }

        // Si el usuario envió un valor vacío para el campo birth_date, establecer ese campo en null
        if ($request->has('remove_birth_date')) {
            $validatedData['birth_date'] = null;
        } else if ($request->input('birth_date') != '') {
            $validatedData['birth_date'] = $request->input('birth_date');
        } else {
            $validatedData['birth_date'] = $user->birth_date;
        }
        if ($request->input('remove_header_photo') == '1') {
            $validatedData['user_header_photo'] = null;
        }

        // Actualizar los campos del usuario
        /** @var \App\Models\User $user */

        $user->update($validatedData);

        // Redirigir al usuario a su perfil con un mensaje de éxito
        return redirect()->route('profile.index', $user)->with('status', 'Perfil actualizado con éxito!');
    }
    /**
     * Delete the user's account.
     */
    public function configure(Request $request)
{
    $user = Auth::user();

    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
        }

        if ($request->filled('email')) {
            $request->validate(['email' => 'required|email|unique:users,email,' . Auth::id()]);
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|min:8']);
            $user->password = Hash::make($request->password);
        }
        /** @var \App\Models\User $user */

        $user->save();

        return back()->with('success', 'Los cambios se han guardado con éxito');
    }

    return back()->withErrors(['current_password' => 'Debes ingresar tu contraseña actual para hacer cambios']);
}




    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function admin_index() {
        $users = User::orderBy('id')->paginate(5);

        if (auth()->check() && auth()->user()->admin) {
            return view('admin.users.index', [
                'users' => $users,
            ]);
        } else {
            return view('pages.users', [
                'users' => $users,
            ]);
        }
    }




    public function admin_validateProfile(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->validated = true;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function admin_destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }
    public function admin_invalidateProfile(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->validated = false;
        $user->save();

        return redirect()->route('admin.users.index');
    }
}

