<div class="regular-split">
    @foreach ($series as $serie)
        @if ($serie->name == 'Regular split')
            <a href="{{ route('series.show', ['serie' => $serie->id]) }}">
                <div class="result-item">
                    <div class="result-content d-flex align-items-center">
                        <img src="{{ asset($serie->competition->logo) }}" class="team-logo img-fluid" alt="{{ $serie->competition->name }}">
                        <img src="{{ asset($serie->team_1->logo) }}" class="team-logo img-fluid" alt="{{ $serie->team_1->name }}">
                        <h3 class="result">{{ $serie->getResultSerie() }}</h3>
                        <img src="{{ asset($serie->team_2->logo) }}" class="team-logo img-fluid" alt="{{ $serie->team_2->name }}">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="serie-date">{{ $serie->date }}</h5>
                            <h5 class="serie-type">{{ $serie->type }}</h5>
                        </div>
                    </div>
                    <hr class="separator">
                </div>
            </a>
        @endif
    @endforeach
</div>
