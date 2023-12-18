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
            $validatedData['user_photo'] = $request->file('user_photo')->store('public/user_photos');
        }

        // Si se subió una nueva foto de portada, guardarla en el servidor y actualizar el campo correspondiente
        if ($request->hasFile('user_header_photo')) {
            $validatedData['user_header_photo'] = $request->file('user_header_photo')->store('public/user_header_photos');
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
