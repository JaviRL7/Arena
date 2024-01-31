@extends('layouts.plantilla')
@section('title', 'rankings players')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top Kills',
                            'players' => $playersByKills,
                            'attribute' => 'total_kills',
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top KDA',
                            'players' => $playersByKDA,
                            'attribute' => 'kda',
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top Assists',
                            'players' => $playersByAssits,
                            'attribute' => 'total_assits',
                        ])
                    </div>
                    {{-- Agrega más secciones según sea necesario --}}
                </div>
                <div class="row">
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top Comments',
                            'players' => $playersByComments,
                            'attribute' => 'comments_count',
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top Champions Pool',
                            'players' => $playersByChampionpool,
                            'attribute' => 'total_championpool',
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.player-ranking', [
                            'title' => 'Top Fan base',
                            'players' => $playersWithMostFans,
                            'attribute' => 'total_fanbase',
                        ])
                    </div>
                    {{-- Agrega más secciones según sea necesario --}}
                </div>

                <div class="row">
                    {{-- ...otros rankings... --}}
                    <div class="col-md-4">
                        @include('components.champion-ranking', [
                            'title' => 'Most Played Champions',
                            'champions' => $mostPlayedChampions,
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.champion-winrate', [
                            'title' => 'Champions with Highest Win Rate',
                            'champions' => $championsWithHighestWinRate,
                        ])
                    </div>
                    <div class="col-md-4">
                        {{-- Component for Teams with Most Fans --}}
                        @include('components.team-ranking', [
                            'title' => 'Teams with Most Fans',
                            'teams' => $TeamsWithMostFans,
                            'attribute' => 'total_fanbase',
                        ])
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        @include('components.team-ranking', [
                            'title' => 'Teams with Most Matches',
                            'teams' => $teamsWithMostMatches,
                            'attribute' => 'total_matches'
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.team-ranking-rate', [
                            'title' => 'Teams with Best Win Rate',
                            'teams' => $teamsWithBestWinRate,
                            'attribute' => 'total_matches'
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.user-ranking-comments', [
                            'title' => 'Users with Most Comments',
                            'users' => $usersWithMostComments
                        ])
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        @include('components.user-ranking-likes', [
                            'title' => 'Users with Most Likes',
                            'users' => $usersWithMostLikes
                        ])
                    </div>

                </div>
            </div>
        </div>
    @endsection
