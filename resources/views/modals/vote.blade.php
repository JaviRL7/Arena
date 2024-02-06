
<div class="modal fade" id="voteModalGame{{ $game->id }}Player{{ $player_blue->id }}" tabindex="-1"
    aria-labelledby="voteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voteModalLabel">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('games.store') }}" class="review-form" data-form-id="formGame{{ $game->id }}Player{{ $player_blue->id }}" method="POST" class="bg-white-800 text-black p-6 rounded-md">
                @csrf
                <input type="hidden" name="modal_id" value="game{{ $game->id }}_player{{ $player_blue->id }}">

                <input type="hidden" name="player_id" value="{{ $player_blue->id }}">
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <div class="modal-body d-flex flex-column align-items-center">

                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset($game->serie->team_1->logo) }}" class="team-logo" alt="Team 1 Logo">
                        <p class="series-result"><strong>{{$game->serie->getResultSerie()}}</strong></p>

                        <img src="{{ asset($game->serie->team_2->logo) }}" class="team-logo" alt="Team 2 Logo">

                        <div style="border-left:1px solid lightgray;height:100px;"></div>

                        <div>
                            <p class="series-result titular">{{ $game->serie->competition->name }}</p>
                            <p class="series-result titular">{{ $game->serie->name }}</p>
                            <p class="series-result titular">Map {{ $game->number }}</p>
                            <p class="series-result titular">
                                @if ($game->team_blue_result == 'W')
                                    <strong class="titular">WIN</strong>
                                @elseif ($game->team_blue_result == 'L')
                                    <strong class="titular">LOSE</strong>
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
                            <h4 class="titular">{{ $player_blue->nick }}</h4>
                            <p class="subtitular">
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
                            <h5 class="titular">KDA</h5>
                            <h3 class="comentarios">{{ $player_blue->games->where('id', $game->id)->first()->pivot->kills }}
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
                <input type="hidden" name="nota" value="0">
                <div class="review-question" style="margin: 5%">
                    <p class="comentarios">¿Do you want to add a review?</p>
                    <button type="button" class="btn btn-boton7 addReviewBtn" id="addReviewBtnGame{{ $game->id }}Player{{ $player_blue->id }}">Add</button>
                </div>

                <!-- Sección de comentarios, inicialmente oculta -->
                <div class="comment-section" id="commentSectionGame{{ $game->id }}Player{{ $player_blue->id }}" style="display: none; margin:5%">
                    <div class="form-group" style="margin: 10px;">
                        <div class="d-flex flex-start w-100">
                            <img class="user-photo" src="{{ asset(Auth::user()->user_photo) }}" alt="avatar" />
                            <textarea class="form-control review-textarea" data-form-id="formGame{{ $game->id }}Player{{ $player_blue->id }}" name="review" rows="4" style="background: #fffbfb; width: 100%;" placeholder="Write a review...">{{ trim($reviews[$game->id][$player_blue->id][Auth::user()->id] ?? '') }}</textarea>

                        </div>
                        <div class="d-flex flex-start w-100" style="margin-left: 15%; margin-top: 5%">
                            <p class="titular length-error-message" style="color: #e44445; display: none;" data-form-id="formGame{{ $game->id }}Player{{ $player_blue->id }}">Your review must be less than 150 characters.</p>
                            <p class="titular html-error-message" style="color: #e44445; display: none;" data-form-id="formGame{{ $game->id }}Player{{ $player_blue->id }}">HTML tags are not allowed.</p>
                        </div>
                        <label class="form-label" for="review"></label>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-boton7" id="buttonGame{{ $game->id }}Player{{ $player_blue->id }}">Send</button>
                    <button class="btn btn-boton8" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</div>

