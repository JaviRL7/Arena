<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nick' => ['required', 'string', 'max:15', 'unique:' . User::class], // Añadido el campo 'nick'
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'twitter' => ['nullable', 'string', 'max:255'],
        'discord' => ['nullable', 'string', 'max:255'],
        'birth_date' => ['nullable', 'date'],
        'user_photo' => ['string', 'max:255'],
    ]);

    $user = User::create([
        'nick' => $request->nick, // Añadido el campo 'nick'
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'twitter' => $request->twitter,
        'discord' => $request->discord,
        'birth_date' => $request->birth_date,
        'user_photo' => $request->user_photo ?? 'Profile_photos/Default_profile.jpg',
    ]);

    event(new Registered($user));

    Auth::login($user);

    return back()->withInput();
}
}
