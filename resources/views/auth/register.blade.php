@extends('layouts.plantilla_sin_navbar')
<div style="background: white; box-shadow: 0px 0px 10px rgba(0,0,0,0.5); margin: 10% 20%; position: relative;">
    <!-- Logo -->
    <div style="position: absolute; top: -50px; left: 50%; transform: translateX(-50%);">
        <img src="roles_icons/ADC.png" alt="Logo" style="width: 100px; height: 100px;">
    </div>

    <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded" style="padding-top: 70px;">
        @csrf

        <!-- Name, Email Address, Password, Confirm Password -->
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 48%;">
                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" style="font-size: 1em;" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" style="font-size: 1.2em;" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" style="font-size: 1.2em;" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" style="font-size: 1.2em;" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div style="width: 48%;">
                <!-- Twitter Account -->
                <div class="mt-4">
                    <x-input-label for="twitter" :value="__('Twitter Account')" />
                    <x-text-input id="twitter" class="block mt-1 w-full" type="text" name="twitter"
                        :value="old('twitter')" style="font-size: 1.2em;" />
                    <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                </div>

                <!-- Discord Account -->
                <div class="mt-4">
                    <x-input-label for="discord" :value="__('Discord Account')" />
                    <x-text-input id="discord" class="block mt-1 w-full" type="text" name="discord"
                        :value="old('discord')" style="font-size: 1.2em;" />
                    <x-input-error :messages="$errors->get('discord')" class="mt-2" />
                </div>

                <!-- Birth Date -->
                <div class="mt-4">
                    <x-input-label for="birth_date" :value="__('Birth Date')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                        :value="old('birth_date')" style="font-size: 1.2em;" />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>
                <!-- Country -->
                <div class="mt-4">
                    <x-input-label for="country" :value="__('Country')" />
                    <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                        :value="old('country')" style="font-size: 1.2em;" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Register Button and Already Registered Link -->
        <div style="text-align: center; margin-top: 20px;">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
