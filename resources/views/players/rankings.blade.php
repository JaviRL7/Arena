@extends('layouts.plantilla')
@section('title', 'rankings players')

@section('content')
    <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
        <div class="bg-gray-100 py-2 px-4">
            <h2 class="text-xl font-semibold text-gray-800">Top Kills</h2>
        </div>
        <ul class="divide-y divide-gray-200">
        @foreach ($players as $player)
            <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray;">
                <span class="text-gray-700 text-lg font-medium mr-4">
                    {{ $loop->iteration }}
                </span>
                <img class="w-16 h-16 rounded-full object-cover mr-4" src="{{ $player->photo }}"
                    alt="{{ $player->nick}} photo">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800">{{ $player->nick }}</h3>
                    <h3 class="text-sm font-medium text-gray-500">{{ $player->name}} {{ $player->lastname1}} </h3>
                    <p class="text-gray-600 text-xl font-bold float-right">{{ $player->total_kills}}</p>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
@endsection