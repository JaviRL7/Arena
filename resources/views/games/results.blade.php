@extends('layouts.plantilla')
@section('title', 'result games')

@section('content')
<div class="flex justify-between">
    <div class="flex justify-between">
        <!-- Tabla 1 -->
        <table class="table-auto">
          </thead>
          <tbody>
            <tr>
              
              <th><img src="{{ asset($game->team_blue->getToplaner->first()->photo) }}" alt="{{ $game->team_blue->getToplaner->first()->photo}}" class="w-36 h-36 object-cover rounded-full"></th>
              <th>{{ $game->team_blue->getToplaner->first()->nick }}<br><span class="text-gray-500">{{ $game->team_blue->getToplaner->first()->name }} {{ $game->team_blue->getToplaner->first()->lastname1 }}</span></th>
            </tr>
            <tr>
              <th><img src="{{ asset($game->team_blue->getJungler->first()->photo) }}" alt="{{ $game->team_blue->getJungler->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
              <th>{{ $game->team_blue->getJungler->first()->nick }}<br><span class="text-gray-500">{{ $game->team_blue->getJungler->first()->name }} {{ $game->team_blue->getJungler->first()->lastname1 }}</span></th>
            </tr>
            <tr>
              <th><img src="{{ asset($game->team_blue->getMidlaner->first()->photo) }}" alt="{{ $game->team_blue->getMidlaner->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
              <th>{{ $game->team_blue->getMidlaner->first()->nick }}<br><span class="text-gray-500">{{ $game->team_blue->getMidlaner->first()->name }} {{ $game->team_blue->getMidlaner->first()->lastname1 }}</span></th>
            </tr>
            <tr>
              <th><img src="{{ asset($game->team_blue->getADC->first()->photo) }}" alt="{{ $game->team_blue->getADC->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
              <th>{{ $game->team_blue->getADC->first()->nick }}<br><span class="text-gray-500">{{ $game->team_blue->getADC->first()->name }} {{ $game->team_blue->getADC->first()->lastname1 }}</span></th>
            </tr>
            <tr>
              <th><img src="{{ asset($game->team_blue->getSupport->first()->photo) }}" alt="{{ $game->team_blue->getSupport->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
              <th>{{ $game->team_blue->getSupport->first()->nick }}<br><span class="text-gray-500">{{ $game->team_blue->getSupport->first()->name }} {{ $game->team_blue->getSupport->first()->lastname1 }}</span></th>
            </tr>
          </tbody>
        </table>
      
        <!-- Tabla 2 -->
        <table class="table-auto">
          <tbody>
            <tr>
              <th>{{ $game->team_red->getToplaner->first()->nick }}<br><span class="text-gray-500">{{ $game->team_red->getToplaner->first()->name }} {{ $game->team_red->getToplaner->first()->lastname1 }}</span></th>
              <th><img src="{{ asset($game->team_red->getToplaner->first()->photo) }}" alt="{{ $game->team_red->getToplaner->first()->photo}}" class="w-36 h-36 object-cover rounded-full"></th>
            </tr>
            <tr>
              <th>{{ $game->team_red->getJungler->first()->nick }}<br><span class="text-gray-500">{{ $game->team_red->getJungler->first()->name }} {{ $game->team_red->getJungler->first()->lastname1 }}</span></th>
              <th><img src="{{ asset($game->team_red->getJungler->first()->photo) }}" alt="{{ $game->team_red->getJungler->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
            </tr>
            <tr>
              <th>{{ $game->team_red->getMidlaner->first()->nick }}<br><span class="text-gray-500">{{ $game->team_red->getMidlaner->first()->name }} {{ $game->team_red->getMidlaner->first()->lastname1 }}</span></th>
              <th><img src="{{ asset($game->team_red->getMidlaner->first()->photo) }}" alt="{{ $game->team_red->getMidlaner->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
            </tr>
            <tr>
              <th>{{ $game->team_red->getADC->first()->nick }}<br><span class="text-gray-500">{{ $game->team_red->getADC->first()->name }} {{ $game->team_red->getADC->first()->lastname1 }}</span></th>
              <th><img src="{{ asset($game->team_red->getADC->first()->photo) }}" alt="{{ $game->team_red->getADC->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
            </tr>
            <tr>
              <th>{{ $game->team_red->getSupport->first()->nick }}<br><span class="text-gray-500">{{ $game->team_red->getSupport->first()->name }} {{ $game->team_red->getSupport->first()->lastname1 }}</span></th>
              <th><img src="{{ asset($game->team_red->getSupport->first()->photo) }}" alt="{{ $game->team_red->getSupport->first()->photo }}" class="w-36 h-36 object-cover rounded-full"></th>
            </tr>
          </tbody>
        </table>
      </div>
  
@endsection
