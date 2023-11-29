@extends('layouts.plantilla')
@section('title', 'rankings players')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                  <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
                    <div class="bg-gray-100 py-2 px-4">
                        <h2 class="text-xl font-semibold text-gray-800">Top Kills</h2>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($playersByKills as $player)
                        <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray; {{ $loop->first ? 'background-color: #F13724;' : '' }}">
                          <span class="text-gray-700 text-lg font-medium mr-4 {{ $loop->first ? 'text-xl text-white' : '' }}">
                            {{ $loop->iteration }}
                          </span>
                            <img class="w-16 h-16 rounded-full object-cover mr-4 {{ $loop->first ? 'w-20 h-20' : '' }}" src="{{ $player->photo }}"
                                alt="{{ $player->nick }} photo">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 {{ $loop->first ? 'text-2xl text-white' : '' }}">{{ $player->nick }}</h3>
                                <h3 class="text-sm font-medium text-gray-500 {{ $loop->first ? 'text-lg text-white' : '' }}">{{ $player->name }}
                                    {{ $player->lastname1 }} </h3>
                                <p class="text-gray-600 text-xl font-bold text-center {{ $loop->first ? 'text-2xl text-white' : '' }}">
                                    {{ $player->total_kills }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
                <div class="col-md-4">
                  <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
                      <div class="bg-gray-100 py-2 px-4">
                          <h2 class="text-xl font-semibold text-gray-800">Top KDA</h2>
                      </div>
                      <ul class="divide-y divide-gray-200">
                          @foreach ($playersByKDA as $player)
                          <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray; {{ $loop->first ? 'background-color: #F13724;' : '' }}">
                            <span class="text-gray-700 text-lg font-medium mr-4 {{ $loop->first ? 'text-xl text-white' : '' }}">
                              {{ $loop->iteration }}
                            </span>
                              <img class="w-16 h-16 rounded-full object-cover mr-4 {{ $loop->first ? 'w-20 h-20' : '' }}" src="{{ $player->photo }}"
                                  alt="{{ $player->nick }} photo">
                              <div class="flex-1">
                                  <h3 class="text-lg font-bold text-gray-800 {{ $loop->first ? 'text-2xl text-white' : '' }}">{{ $player->nick }}</h3>
                                  <h3 class="text-sm font-medium text-gray-500 {{ $loop->first ? 'text-lg text-white' : '' }}">{{ $player->name }}
                                      {{ $player->lastname1 }} </h3>
                                  <p class="text-gray-600 text-xl font-bold text-center {{ $loop->first ? 'text-2xl text-white' : '' }}">
                                      {{ $player->kda }}</p>
                              </div>
                          </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
                <div class="col-md-4">
                  <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
                    <div class="bg-gray-100 py-2 px-4">
                        <h2 class="text-xl font-semibold text-gray-800">Top Assits</h2>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($playersByAssits as $player)
                        <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray; {{ $loop->first ? 'background-color: #F13724;' : '' }}">
                          <span class="text-gray-700 text-lg font-medium mr-4 {{ $loop->first ? 'text-xl text-white' : '' }}">
                            {{ $loop->iteration }}
                          </span>
                            <img class="w-16 h-16 rounded-full object-cover mr-4 {{ $loop->first ? 'w-20 h-20' : '' }}" src="{{ $player->photo }}"
                                alt="{{ $player->nick }} photo">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 {{ $loop->first ? 'text-2xl text-white' : '' }}">{{ $player->nick }}</h3>
                                <h3 class="text-sm font-medium text-gray-500 {{ $loop->first ? 'text-lg text-white' : '' }}">{{ $player->name }}
                                    {{ $player->lastname1 }} </h3>
                                <p class="text-gray-600 text-xl font-bold text-center {{ $loop->first ? 'text-2xl text-white' : '' }}">
                                    {{ $player->total_assits}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                  <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
                    <div class="bg-gray-100 py-2 px-4">
                        <h2 class="text-xl font-semibold text-gray-800">Top Comments</h2>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($playersByComments as $player)
                        <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray; {{ $loop->first ? 'background-color: #F13724;' : '' }}">
                          <span class="text-gray-700 text-lg font-medium mr-4 {{ $loop->first ? 'text-xl text-white' : '' }}">
                            {{ $loop->iteration }}
                          </span>
                            <img class="w-16 h-16 rounded-full object-cover mr-4 {{ $loop->first ? 'w-20 h-20' : '' }}" src="{{ $player->photo }}"
                                alt="{{ $player->nick }} photo">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 {{ $loop->first ? 'text-2xl text-white' : '' }}">{{ $player->nick }}</h3>
                                <h3 class="text-sm font-medium text-gray-500 {{ $loop->first ? 'text-lg text-white' : '' }}">{{ $player->name }}
                                    {{ $player->lastname1 }} </h3>
                                <p class="text-gray-600 text-xl font-bold text-center {{ $loop->first ? 'text-2xl text-white' : '' }}">
                                    {{ $player->comments_count}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
                <div class="col-md-4">
                  <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto mt-16">
                    <div class="bg-gray-100 py-2 px-4">
                        <h2 class="text-xl font-semibold text-gray-800">Top Champions pool</h2>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($playersByChampionpool as $player)
                        <li class="flex items-center py-4 px-6" style="border-bottom: 1px solid gray; {{ $loop->first ? 'background-color: #F13724;' : '' }}">
                          <span class="text-gray-700 text-lg font-medium mr-4 {{ $loop->first ? 'text-xl text-white' : '' }}">
                            {{ $loop->iteration }}
                          </span>
                            <img class="w-16 h-16 rounded-full object-cover mr-4 {{ $loop->first ? 'w-20 h-20' : '' }}" src="{{ $player->photo }}"
                                alt="{{ $player->nick }} photo">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 {{ $loop->first ? 'text-2xl text-white' : '' }}">{{ $player->nick }}</h3>
                                <h3 class="text-sm font-medium text-gray-500 {{ $loop->first ? 'text-lg text-white' : '' }}">{{ $player->name }}
                                    {{ $player->lastname1 }} </h3>
                                <p class="text-gray-600 text-xl font-bold text-center {{ $loop->first ? 'text-2xl text-white' : '' }}">
                                    {{ $player->total_championpool }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection