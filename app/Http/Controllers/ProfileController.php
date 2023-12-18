<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    $players = Player::paginate(5);
    if ($request->ajax()) {
        return view('partials.players', ['players' => $players]);
    }
    return view('profile.index', [
        'user' => $request->user(),
        'players' => $players,
    ]);
}



    public function comments()
    {
        $comments = Auth::user()->comments()->with('user')->get();
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
        $photoName = $user->name .'_header'. '.' . $request->file('user_header_photo')->getClientOriginalExtension();
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
    $user->update($validatedData);

    // Redirigir al usuario a su perfil con un mensaje de éxito
    return redirect()->route('profile.index', $user)->with('status', 'Perfil actualizado con éxito!');
}




    /**
     * Delete the user's account.
     */
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
