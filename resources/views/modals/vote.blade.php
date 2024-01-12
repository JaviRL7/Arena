<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        flex-wrap: wrap;
    }

    .rating>input {
        display: none;
    }

    .rating>label {
        cursor: pointer;
        display: inline-block;
        padding: 0 5px;
        font-size: 2em;
        /* Tamaño de las estrellas */
        color: #ccc;
        /* Color de las estrellas vacías */
    }

    .rating>input:checked~label,
    .rating>input:checked+label,
    .rating>label:hover,
    .rating>label:hover~label {
        color: #f90;
        /* Color de las estrellas seleccionadas */
    }

    .rating>input:checked+label {
        color: #f90;
        /* Color de las estrellas seleccionadas */
    }

    .player-champion-container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* Espaciado entre elementos */
        margin-bottom: 20px;
        /* Espacio debajo del contenedor */
    }



    .series-result {
        font-size: 1.5em;
        margin: 0 20px;
        /* Espacio a los lados del resultado de la serie */
    }
</style>

<div class="modal fade" id="voteModalGame{{ $game->id }}Player{{ $player_blue->id }}" tabindex="-1"
    aria-labelledby="voteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voteModalLabel">Player Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('games.store') }}" method="POST" class="bg-white-800 text-black p-6 rounded-md">
                @csrf
                <input type="hidden" name="player_id" value="{{ $player_blue->id }}">
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <div class="modal-body d-flex flex-column align-items-center">

                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset($game->serie->team_1->logo) }}" class="team-logo" alt="Team 1 Logo">
                        <p class="series-result"><strong>{{$game->serie->getResultSerie()}}</strong></p>

                        <img src="{{ asset($game->serie->team_2->logo) }}" class="team-logo" alt="Team 2 Logo">

                        <div style="border-left:1px solid lightgray;height:100px;"></div>

                        <div>
                            <p class="series-result">{{ $game->serie->competition->name }}</p>
                            <p class="series-result">{{ $game->serie->name }}</p>
                            <p class="series-result">Map {{ $game->number }}</p>
                            <p class="series-result">
                                @if ($game->team_blue_result == 'W')
                                    <strong>WIN</strong>
                                @elseif ($game->team_blue_result == 'L')
                                    <strong>LOSE</strong>
                                @endif
                            </p>
                        </div>
                    </div>


                    <div class="player-champion-container" style="display: flex; align-items: center; justify-content: space-around; gap: 20px;">
                        <!-- Foto del jugador -->
                        <img src="{{ asset($player_blue->photo) }}" alt="{{ $player_blue->photo }}"
                            class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">

                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <h4 style="font-weight: bold; margin-bottom: 5px;">{{ $player_blue->nick }}</h4>
                            <p style="color: gray;">
                                {{ $player_blue->name }}
                                {{ $player_blue->lastname1 }}
                                @if ($player_blue->lastname2)
                                    {{ ' ' . $player_blue->lastname2 }}
                                @endif
                            </p>
                        </div>

                        <!-- Imagen del campeón -->
                        <img src="{{ asset($player_blue->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                            alt="{{ $player_blue->games->where('id', $game->id)->first()->pivot->champion->name }}"
                            class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">

                        <!-- KDA y otros detalles -->
                        <div style="margin-left: 20px;">
                            <h5>KDA</h5>
                            <h3>{{ $player_blue->games->where('id', $game->id)->first()->pivot->kills }}
                            /{{ $player_blue->games->where('id', $game->id)->first()->pivot->deaths }}
                            /{{ $player_blue->games->where('id', $game->id)->first()->pivot->assists }}
                            </h3>
                        </div>
                    </div>


                    <div class="rating">
                        @for ($i = 10; $i > 0; $i--)
                            <input type="radio"
                                id="star{{ $game->id }}_{{ $player_blue->id }}_{{ $i }}"
                                name="rating{{ $game->id }}_{{ $player_blue->id }}"
                                value="{{ $i }}" />
                            <label for="star{{ $game->id }}_{{ $player_blue->id }}_{{ $i }}"
                                title="{{ $i }} stars"><i class="fas fa-star"></i></label>
                            @if ($i % 5 == 1)
                                <br />
                            @endif
                        @endfor
                    </div>
                </div>
                <input type="hidden" name="nota" value="">

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInputs = document.querySelectorAll('.rating input');
        ratingInputs.forEach(input => {
            input.addEventListener('change', function() {
                let rating = this.value;
                // Encuentra el input oculto para 'nota' en el mismo formulario que el input de estrellas
                let form = this.closest('form');
                let notaInput = form.querySelector('input[name="nota"]');
                notaInput.value = rating;
            });
        });
    });
</script>
