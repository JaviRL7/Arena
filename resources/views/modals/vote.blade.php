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
                        <p class="series-result"><strong>{{ $game->serie->getResultSerie() }}</strong></p>

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


                    <div class="player-champion-container"
                        style="display: flex; align-items: center; justify-content: space-around; gap: 20px;">
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

            </form>
            <div class="review-question">
                <p>¿Quieres añadir una review a este jugador?</p>
                <button type="button" class="btn btn-boton5 addReviewBtn"
                    id="addReviewBtnGame{{ $game->id }}Player{{ $player_blue->id }}">Add</button>
            </div>

            <!-- Sección de comentarios, inicialmente oculta -->
            <div class="comment-section" id="commentSectionGame{{ $game->id }}Player{{ $player_blue->id }}"
                style="display: none;">
                <x-modal-comment-form :game="$game" :player="$player_blue" :serie="$serie" :teamColor="'blue'" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Escuchar eventos de cambio en los inputs de rating
        const ratingInputs = document.querySelectorAll('.rating input');
        ratingInputs.forEach(input => {
            input.addEventListener('change', function() {
                let rating = this.value;
                let form = this.closest('form');
                let notaInput = form.querySelector('input[name="nota"]');
                notaInput.value = rating;
            });
        });

    });
    $(document).ready(function() {
        // Cuando se hace clic en un botón 'Add', cualquiera que tenga la clase .addReviewBtn
        $('.addReviewBtn').click(function() {
            // Obtén el ID del botón que fue presionado
            var buttonId = $(this).attr('id');
            // Construye el ID de la sección de comentarios correspondiente
            var commentSectionId = 'commentSection' + buttonId.substring('addReviewBtn'.length);
            // Muestra la sección de comentarios correspondiente
            $('#' + commentSectionId).show();
        });
    });
</script>
