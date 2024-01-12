@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <style>
        .link-muted {
            color: #aaa;
        }

        .link-muted:hover {
            color: #1266f1;
        }

        .tabla {
            table-layout: fixed;
            width: 100%;
            font-size: 1.6em;
        }

        .tabla-contenedor {
            margin: 20px;
        }

        .tabla-responsive div {
            margin: 10%;
        }

        .tabla-responsive {
            width: 100%;
        }

        .tabla tr {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tabla td {
            margin: 30px 0;
        }

        .tabla td {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .owl-carousel img {
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h5 {
            margin-left: 10px;
            /* Ajusta el margen según tus necesidades */
        }

        .conte {
            display: flex;
            justify-content: space-between;
        }

        .serie-show-table {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .row {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .cell {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
        }

        .team-images {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }


        .team-img {
            width: 900px;
            /* Ajusta el tamaño según tus necesidades */
            height: auto;
            /* Ajusta el tamaño según tus necesidades */
        }

        .team-img:first-child {
            width: 900px;
            /* Ajusta el tamaño según tus necesidades */
            height: auto;
            /* Ajusta el tamaño según tus necesidades */
            border-top-left-radius: 15px;
            /* Ajusta el radio del borde según tus necesidades */
            border-bottom-left-radius: 15px;
            /* Ajusta el radio del borde según tus necesidades */
        }

        .team-img:last-child {
            width: 900px;
            /* Ajusta el tamaño según tus necesidades */
            height: auto;
            /* Ajusta el tamaño según tus necesidades */
            border-top-right-radius: 15px;
            /* Ajusta el radio del borde según tus necesidades */
            border-bottom-right-radius: 15px;
            /* Ajusta el radio del borde según tus necesidades */
        }

        .vs-img {
            position: absolute;
            width: 180px;
            /* Ajusta el tamaño según tus necesidades */
            height: auto;
            /* Ajusta el tamaño según tus necesidades */
        }

        .comments-container {
            width: 50%;
            /* Ocupa la mitad de la pantalla */
            margin: 0 auto;
            /* Centra el div en la pantalla */
            font-size: 1.2em;
        }

        .serie-info {
            margin-left: 430px;
        }

        .header {
            width: 1800px;
            display: block;
            margin: auto;
        }

        .header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <img src="{{ asset('material/headerw3.webp') }}" alt="">
                </div>
                <div class="serie-info">
                    <h1 id="titulo1" class="titulo">
                        {{ $serie->competition->name }} 23
                    </h1>
                    <h3 id="titulo2" class="titulo">
                        {{ $serie->name }}
                    </h3>
                </div>
                <div class="team-images">
                    <img src="{{ asset($serie->team_1->team_photo) }}" class="img-fluid team-img">
                    <img src="{{ asset('recursos/VS.png') }}" class="img-fluid vs-img">
                    <img src="{{ asset($serie->team_2->team_photo) }}" class="img-fluid team-img">
                </div>
                <div class="serie">
                    <div class="team">
                        <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}">
                    </div>
                    <div class="result">
                        <h2>{{ $serie->getResultSerie() }}</h2>
                    </div>
                    <div class="team">
                        <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">




                @foreach ($serie->games as $game)
                    @php
                        $date = $serie->date;
                        $players_blue = $serie->team_1->getPlayersDate($date);
                        $players_red = $serie->team_2->getPlayersDate($date);

                    @endphp
                    @foreach ($players_blue as $player_blue)
                        @include('modals.vote')
                    @endforeach
                    @foreach ($players_red as $player_red)
                        @include('modals.vote2')
                    @endforeach
                @endforeach
                <h1 class="titulo" style="text-align-last: center">Game Data</h1>

                <div class="owl-carousel owl-theme owl-grande">

                    @foreach ($serie->games as $game)
                        @php
                            $team_blue = $game->team_blue;
                            $team_red = $game->team_red;
                            $date = $serie->date;
                            $players_blue = $game->team_blue->getPlayersDate($date);
                            $players_red = $game->team_red->getPlayersDate($date);
                        @endphp

                        <div class="item">
                            <div class="tabla-contenedor">
                                <table class="tabla-responsive">
                                    <tbody>

                                        @for ($i = 0; $i < max(count($players_blue), count($players_red)); $i++)
                                            @include('modals.vote')

                                            <tr class="align-middle">
                                                @if (isset($players_blue[$i]))
                                                    <td>
                                                        <div
                                                            style="hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_blue[$i]->photo) }}"
                                                                alt="{{ $players_blue[$i]->photo }}" class="img-fluid"
                                                                style="width: 100px !important;
                                                height: 100px !important;">




                                                            <button type="button" class="btn btn-primary open-modal"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#voteModalGame{{ $game->id }}Player{{ $players_blue[$i]->id }}">
                                                                Vote
                                                            </button>




                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            {{ $players_blue[$i]->nick }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->kills }}
                                                            /
                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->deaths }}
                                                            /
                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                                                alt="{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                                                class="img-fluid"
                                                                style="width: 50px !important;
                                                height: 50px !important;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="mx-4 w-28 text-2xl font-extrabold text-white bg-blue-500 border-2 border-blue-500 rounded-md p-2">
                                                            {{ number_format($players_blue[$i]->averageScoreForGame($game->id), 2, '.', '') ?? ' - ' }}
                                                        </div>
                                                    </td>
                                                @endif
                                                <td style="font-family: mol">VS</td>
                                                @if (isset($players_red[$i]))
                                                    <td>

                                                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;"
                                                            class="mx-4 w-28 text-2xl font-extrabold text-white bg-red-500 border-2 border-red-500 rounded-md p-2">
                                                            {{ number_format($players_red[$i]->scoresGames->avg('pivot.note'), 2) ?? ' - ' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            <img src="{{ asset($players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                                                alt="{{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                                                class="img-fluid"
                                                                style="width: 50px !important;
                                                height: 50px !important;">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->kills }}
                                                            /
                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->deaths }}
                                                            /
                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            {{ $players_red[$i]->nick }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_red[$i]->photo) }}"
                                                                alt="{{ $players_red[$i]->photo }}" class="img-fluid"
                                                                style="width: 100px !important;
                                                    height: 100px !important;">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#voteModalGame{{ $game->id }}Player{{ $players_red[$i]->id }}">
                                                                Vote
                                                            </button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="ban-container">
                                <h1 class="titulo" style="text-align-last: center">Ban phase</h1>
                                @if ($game->{'ban1_blue'}()->exists())
                                    <div class="serie-show-table">
                                        <!-- Primera fila -->
                                        <div class="row">
                                            @foreach (range(1, 3) as $ban)
                                                @if ($game->{'ban' . $ban . '_blue'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                                @if ($game->{'ban' . $ban . '_red'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            @foreach (range(4, 5) as $ban)
                                                @if ($game->{'ban' . $ban . '_blue'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                                @if ($game->{'ban' . $ban . '_red'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

















            <div class="col-md-2">
                <h1 class="titulo">Actividades Recientes:</h1>
                @foreach ($activities as $activity)
                    <div class="d-flex flex-start mb-4" style="margin-top: 30px;">
                        <img class="rounded-circle shadow-1-strong me-3 user-photo" src="{{ asset($activity->user->user_photo) }}" alt="avatar"/>
                        <div>
                            <h6 class="fw-bold mb-1">&#64;{{ $activity->user->nick }}</h6>
                            <br> <!-- Añade un salto de línea para separar el nombre de usuario del comentario -->
                            @if(isset($activity->body)) <!-- Si es un comentario -->
                                <p class="mb-0">{{ $activity->body }}</p>
                            @elseif(isset($activity->note)) <!-- Si es una calificación -->
                            <div class="d-flex align-items-center">
                                <div class="rounded p-2 bg-primary">
                                    <h5 class="text-white mb-0"><strong>{{ $activity->note }}</strong></h5>
                                </div>
                                <h5 class="mb-0 ms-3"><strong>{{ $activity->player->nick }}</strong></h5>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr class="my-0" />
                @endforeach
            </div>













        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="titulo">Comments:</h1>
                <div class="card-footer py-3 border-0"
                    style="background-color: #ffffff; margin: 0 auto; width: 50%; border: 2px solid #000;">
                    <div class="d-flex flex-start w-100">
                        <img class="user-photo" src="{{ asset(Auth::user()->user_photo) }}" alt="avatar" />
                        <div class="form-outline w-100">
                            <form action="{{ route('comments.store', $serie) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="body" id="body" rows="4"
                                        style="background: #fffbfb; width: 100%;" placeholder="Write a comment..."></textarea>
                                    <label class="form-labe" for="body"></label>
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancelar</button>
                                    <input type="hidden" id="serie" value="{{ $serie->id }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div>

                <div class="comments-container">
                    <h4 class="mb-0">Comments:</h4>
                    <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>

                    @if ($serie->comments->count() > 0)
                        @foreach ($serie->comments as $comment)
                            @include('comments', ['comment' => $comment])
                        @endforeach
                        @include('modals.delete_comment')
                        @include('modals.edit_comment')
                    @else
                        <p>No comments available.</p>
                    @endif
                </div>


            </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteCommentModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var commentId = button.getAttribute('data-comment-id');
                var form = deleteModal.querySelector('form');
                form.action = '/comments/' + commentId;
            });
        });

        function editComment(commentId, commentBody) {
            document.getElementById('editCommentId').value = commentId;
            document.getElementById('editCommentBody').value = commentBody;
            var form = document.getElementById('editForm');
            form.action = '/comments/' + commentId + '/update';
        }
    </script>
    <script>
        var titulo1 = document.getElementById('titulo1');
        var titulo2 = document.getElementById('titulo2');

        if (/\d/.test(titulo1.textContent)) {
            titulo1.style.fontFamily = 'mol';
        }
        if (/\d/.test(titulo2.textContent)) {
            titulo2.style.fontFamily = 'mol';
        }
    </script>
    <script>
        var tributePlayers, tributeTeams;
        var serie = document.getElementById('serie').value;

        // Autocompletar nombres de jugadores
        $.getJSON("/series/" + serie + "/getPlayerNames", function(data) {
            var players = data.map(function(player) {
                return {
                    key: player,
                    value: player
                };
            });

            tributePlayers = new Tribute({
                trigger: '@',
                values: players
            });

            tributePlayers.attach(document.getElementById('body'));
        });

        // Autocompletar nombres de equipos
        $.getJSON("/series/" + serie + "/getTeamNames", function(data) {
            var teams = data.map(function(team) {
                return {
                    key: team,
                    value: team
                };
            });

            tributeTeams = new Tribute({
                trigger: '#',
                values: teams
            });

            tributeTeams.attach(document.getElementById('body'));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.open-modal').click(function() {
                var gameId = $(this).data('game-id');
                var modalId = $(this).data('bs-target');
                // Actualiza el atributo 'data-game-id' de la modal
                $(modalId).attr('data-game-id', gameId);
                // Muestra la modal
                $(modalId).modal('show');
            });

            $('.open-modal').on('shown.bs.modal', function() {
                var modalId = $(this).data('bs-target');
                var gameId = $(modalId).data('game-id');
                console.log('Game ID: ' + gameId);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            console.log("Documento listo");
            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });

            $('.owl-carousel').on('initialized.owl.carousel', function(event) {
                $('.btn-primary').each(function() {
                    var target = $(this).data('bs-target');
                    var modal = new bootstrap.Modal(document.querySelector(target));
                    $(this).click(function() {
                        modal.show();
                    });
                });
            });
        });
    </script>
@endsection
