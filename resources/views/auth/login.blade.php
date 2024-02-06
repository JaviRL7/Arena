@extends('layouts.plantilla_sin_navbar')
<script src="js/profile/validation/form-validation.js"></script>

<div style="background: white; box-shadow: 0px 0px 10px rgba(0,0,0,0.5); margin: 10% 40%; position: relative; border-radius: 10px;">
    <!-- Logo -->
    <div
        style="position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
background-color: white; border-radius: 50%; width: 120px; height: 120px;
display: flex; align-items: center; justify-content: center;">
        <img src="icons/logof.png" alt="Logo" style="width: 100px; height: 100px;">
    </div>

    <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded" style="padding-top: 70px;">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" style="font-size: 1.2em;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" style="font-size: 1.2em;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

<!-- Login Button and Forgot Password Link -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
    @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
    @endif
    <!-- Register Link -->
    @if (Route::has('register'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
            {{ __("Don't have an account? Register now.") }}
        </a>
    @endif
</div>
<x-primary-button class="ml-3 mt-4">
    {{ __('Log in') }}
</x-primary-button>
        </div>
    </form>
</div>
