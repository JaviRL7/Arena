<div class="col-md-2" style="">
    <h2 class="titulo titulo-serie2" style="margin-top: 50px">Community Feedback </h2>
    <h6 class="subtitular">"Recent activity from our users".</h6>
    @foreach ($activities as $activity)
        <div class="activity-container">
            <!-- Foto y nombre del usuario -->
            <div class="activity-user-info">
                <img class="rounded-circle shadow-1-strong activity-user-photo"
                    src="{{ asset($activity->user->user_photo) }}" alt="User" />
                <div class="">
                    <h6 class="titular">{{ $activity->user->name }}</h6>
                    <h6 class="subtitular">&#64;{{ $activity->user->nick }}</h6>
                </div>
            </div>
            <div class="activity-details">
                @if ($activity instanceof App\Models\Score)
                    @php
                        $clasification = $activity->game->clasifications->where('player_id', $activity->player_id)->first();
                    @endphp
                    @if ($clasification)
                        <div class="activity-score-info">
                            <div class="activity-game-note-info">
                                <p class="activity-game-number comentarios">Game number : {{ $activity->game->number }}
                                </p>
                                <div style="margin: 10px;"></div>
                                <p class="activity-score-note comentarios"> Note : {{ $activity->note }}</p>
                            </div>
                            <hr class="activity-divider" />
                            <div class="activity-player-champion-info">
                                <img class="rounded-circle shadow-1-strong activity-player-photo"
                                    src="{{ asset($activity->player->photo) }}" alt="{{ $activity->player->nick }}" />
                                <img class="rounded-circle shadow-1-strong activity-champion-photo"
                                    src="{{ asset($clasification->champion->square) }}"
                                    alt="{{ $clasification->champion->name }}" />
                                <p class="comentarios">KDA: {{ $clasification->kills }} / {{ $clasification->deaths }}
                                    / {{ $clasification->assists }}</p>
                            </div>
                            @if (!empty($activity->review))
                                <hr class="activity-divider" />
                                <div class="activity-player-champion-info">
                                    <p class="comentarios">"{{ $activity->review }}".</p>
                                </div>
                            @endif

                        </div>
                    @else
                        <p>Clasification information not found.</p>
                    @endif
                @elseif($activity instanceof App\Models\Comment)
                    <div class="activity-comment-info">
                        <p class="comentarios">"{{ $activity->body }}".</p>
                    </div>
                @endif
            </div>
            <hr class="my-0" />
        </div>
    @endforeach
</div>
