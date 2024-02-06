<div>
    @foreach ($scores as $score)
        <div class="activity-profile-score-info">
            @php
                $clasification = $score->game->clasifications->where('player_id', $score->player_id)->first();
            @endphp
            @if ($clasification)
                <div class="activity-profile-game-logo-info d-flex align-items-center justify-content-center">
                    <img class="team-logo me-2" src="{{ asset($score->game->serie->team_1->logo) }}"
                        alt="{{ $score->game->serie->team_1->name }}" />
                    <h4 class="activity-profile-game-result titular mx-2">
                        {{ $score->game->serie->getResultSerie() }}</h4>
                    <img class="team-logo ms-2" src="{{ asset($score->game->serie->team_2->logo) }}"
                        alt="{{ $score->game->serie->team_2->name }}" />
                </div>
                <hr class="custom-hr2" />
                <div class="activity-profile-player-champion-info d-flex justify-content-between">
                    <div class="champion-background"
                        style="background-image: url('{{ asset($clasification->champion->photo) }}'); position: relative;">
                        <div class="activity-profile-player-kda-container">
                            <img class="rounded-circle shadow-1-strong activity-profile-player-photo"
                                src="{{ asset($score->player->photo) }}" alt="{{ $score->player->nick }}" />
                            <div>
                                <h1 class="titular">{{ $score->player->nick }}</h1>
                                <h5 class="subtitular">{{ $score->player->name }}
                                    {{ $score->player->lastname1 }}</h5>
                                <hr class="custom-hr2">
                                <h4 class="comentarios">K/D/A: {{ $clasification->kills }} /
                                    {{ $clasification->deaths }} / {{ $clasification->assists }}</h4>
                            </div>
                        </div>
                        <div class="note-container">
                            <div class="note-circle">
                                <h1 class="titular">{{ $score->note }}</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="activity-profile-user-review-container" style="margin-top:10px">
                    <div class="activity-profile-user-info d-flex align-items-center mb-3">
                        <img class="rounded-circle shadow-1-strong me-3 user-photo profile-icon"
                            src="{{ asset($score->user->user_photo) }}" alt="{{ $score->user->name }}" />
                        <div>
                            <h6 class="titular">{{ $score->user->name }}</h6>
                            <h6 class="subtitular">&#64;{{ $score->user->nick }}</h6>
                        </div>
                    </div>

                    @if (!empty($score->review))
                        <div class="activity-profile-review-info">
                            <p class="comentarios" style="margin-left: 30px;">"{{ $score->review }}"</p>
                        </div>
                    @endif
                </div>
                <hr class="custom-hr">
            @else
                <p>Classification information not found.</p>
            @endif
        </div>
    @endforeach
</div>
