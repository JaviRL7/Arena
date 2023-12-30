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

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $players = Player::paginate(5);
        return view('profile.index', [
            'user' => $request->user(),
            'players' => $players,
        ]);
    }
    public function getPlayers(Request $request)
    {
        if ($request->ajax()) {
            $players = Player::query();
            return DataTables::of($players)
                ->addColumn('photo', function ($player) {
                    return '<div style="position:relative;"><img class="player-photo" src="' . asset($player->photo) . '"><img class="team-logo" src="' . asset($player->currentTeam()->logo) . '"><img class="role-logo" src="' . asset($player->role->icono) . '"></div>';
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
        return redirect('/profile');
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
}
