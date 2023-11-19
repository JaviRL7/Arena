@extends('layouts.plantilla')
@section('title', 'show games')
    
@section('content')
    <h1>Esto es el show de games</h1>
    
    @foreach($games as $game)
    <div class="flex items-center justify-between p-4 bg-white shadow rounded-lg">
        <div class="flex items-center">
            <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" class="w-10 h-10 rounded-full">            <span class="ml-4 text-lg font-bold">{{ $game->team_blue->name }}</span>
        </div>
        <div>
            <span class="text-2xl font-bold">{{ $game->team_blue_score }} - {{ $game->team_red_score }}</span>
        </div>
        <div class="flex items-center">
            <span class="mr-4 text-lg font-bold">{{ $game->team_red->name }}</span>
            <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}" class="w-10 h-10 rounded-full">
        </div>
    </div>
@endforeach
@endsection