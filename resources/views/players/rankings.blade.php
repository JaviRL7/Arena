@extends('layouts.plantilla')
@section('title', 'rankings players')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        @foreach ($players as $player)
          <div class="flex items-center space-x-4">
              <img class="h-12 w-12 rounded-full" src="{{ $player->photo }}" alt="">
                <div class="flex-shrink-0 h-10 w-auto align-center">
                  <img class="h-10 w-auto" src="{{ $player->teams->first()->logo }}" alt="">
                </div>
              <div class="text-lg font-medium text-gray-900">{{ $player->nick }}</div>
            <div class="text-lg font-medium text-gray-900">{{ $player->total_kills }}</div>
          </div>
        @endforeach
@endsection
