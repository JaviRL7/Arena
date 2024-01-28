<h1 class="titulo titulo-serie">Prediction</h1>

<div class="prediction-section">
    <div class="team-section">
        <img src="{{ asset($serie->team_1->logo) }}" class="team-logo">
        @if (!$static)
            <form action="{{ route('predictions.store') }}" method="POST" class="prediction-form">
                @csrf
                <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                <button type="submit" name="team_1_win" value="1" class="btn btn-boton7 vote-button"
                    data-team-name="{{ $serie->team_1->name }}">
                    Win {{ $serie->team_1->name }}
                </button>
            </form>
        @endif
    </div>

    <div class="progress-bar-container">
        <div class="progress" style="height: 30px;">
            <div class="progress-bar bg-primary" role="progressbar"
                style="width: {{ $percentageTeam1 }}%;" aria-valuenow="{{ $percentageTeam1 }}"
                aria-valuemin="0" aria-valuemax="100">
                <span class="titular">{{ number_format($percentageTeam1, 0) }}%</span>
            </div>
            <div class="progress-bar bg-danger" role="progressbar"
                style="width: {{ $percentageTeam2 }}%;" aria-valuenow="{{ $percentageTeam2 }}"
                aria-valuemin="0" aria-valuemax="100">
                <span class="titular">{{ number_format($percentageTeam2, 0) }}%</span>
            </div>
        </div>
    </div>

    <div class="team-section">
        <img src="{{ asset($serie->team_2->logo) }}" class="team-logo">
        @if (!$static)
            <form action="{{ route('predictions.store') }}" method="POST" class="prediction-form">
                @csrf
                <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                <button type="submit" name="team_1_win" value="0" class="btn btn-boton8 vote-button"
                    data-team-name="{{ $serie->team_2->name }}">
                    Win {{ $serie->team_2->name }}
                </button>
            </form>
        @endif
    </div>
</div>

@if ($hasVoted && !$static)
    <div class="vote-change-message">
        <span id="voteMessage" class="titular">
            You have already voted for #{{ $votedForTeam }}_win. Do you want to change your vote?
        </span>
    </div>
@endif

@if (!$static)
    <script type="text/javascript" src="{{ asset('/js/serie/predictions.js') }}"></script>
@endif
