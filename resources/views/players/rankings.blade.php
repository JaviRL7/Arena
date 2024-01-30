@extends('layouts.plantilla')
@section('title', 'rankings players')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top Kills', 'players' => $playersByKills, 'attribute' => 'total_kills'])
                </div>
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top KDA', 'players' => $playersByKDA, 'attribute' => 'kda'])
                </div>
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top Assists', 'players' => $playersByAssits, 'attribute' => 'total_assits'])
                </div>
                {{-- Agrega más secciones según sea necesario --}}
            </div>
            <div class="row">
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top Comments', 'players' => $playersByComments, 'attribute' => 'comments_count'])
                </div>
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top Champions Pool', 'players' => $playersByChampionpool, 'attribute' => 'total_championpool'])
                </div>
                <div class="col-md-4">
                    @include('components.player-ranking', ['title' => 'Top Fan base', 'players' => $playersWithMostFans, 'attribute' => 'total_fanbase'])
                </div>
                {{-- Agrega más secciones según sea necesario --}}
            </div>

            <div class="row">
                {{-- ...otros rankings... --}}
                <div class="col-md-4">
                    @include('components.champion-ranking', ['title' => 'Most Played Champions', 'champions' => $mostPlayedChampions])
                </div>
                <div class="col-md-4">
                    @include('components.champion-winrate', [
                        'title' => 'Champions with Highest Win Rate',
                        'champions' => $championsWithHighestWinRate
                    ])
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
