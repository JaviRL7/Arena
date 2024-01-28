<div class="col-md-2" style="">
    <h2 class="titulo titulo-serie2">Community Feedback</h2>
    @foreach ($activities as $activity)
    @php
        $gamePivot = null;
        if ($activity->player && $activity->player->games) {
            $game = $activity->player->games->where('id', $activity->game->id)->first();
            if ($game) {
                $gamePivot = $game->pivot;
            }
        }
    @endphp
        <div class="d-flex flex-start mb-4" style="margin-top: 30px;">
            <img class="rounded-circle shadow-1-strong me-3 user-photo" src="{{ asset($activity->user->user_photo) }}" alt="avatar" />
            <div>
                <h6 class="fw-bold mb-1 titular">{{ $activity->user->name }}</h6>
                <h6 class="fw-bold mb-1 subtitular">&#64;{{ $activity->user->nick }}</h6>
                <x-activity-note :note="$activity->note" :player-nick="$activity->player->nick ?? ''" :champion-photo="$gamePivot->champion->square ?? null" :kda="$gamePivot ? 'KDA: ' . $gamePivot->kills . ' / ' . $gamePivot->deaths . ' / ' . $gamePivot->assists : null" />                <br>
                <x-activity-body :body="$activity->body" />
            </div>
        </div>
        <hr class="my-0" />
    @endforeach
</div>
