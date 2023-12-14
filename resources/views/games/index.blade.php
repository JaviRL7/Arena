
@extends('layouts.plantilla')
@section('title', 'show games')

@section('content')
    <h1>Esto es el show de games</h1>

    <div class="flex flex-wrap justify-center mx-4">
        @foreach($games as $game)
        <div class="flex items-start justify-between p-4 bg-gray-800 text-white shadow rounded-lg mb-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/4 2xl:w-1/5 min-w-[200px] mx-2">
            <div class="flex flex-col items-center">
                <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" class="w-auto h-10">
                <span class="text-lg font-bold">{{ $game->team_blue->name }}</span>
            </div>
            <div>
                <span class="text-2xl font-bold">{{ $game->team_blue_result }} - {{ $game->team_red_result }}</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}" class="w-auto h-10">
                <span class="text-lg font-bold">{{ $game->team_red->name }}</span>
            </div>
        </div>
        <a href="{{ route('games.result', $game) }}">Ver resultado</a>
        @endforeach

    </div>

    </div>


@endsection
