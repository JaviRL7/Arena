<div class="container">
    <div class="regular-split">
        @foreach ($series as $serie)
            @if ($serie->name == 'Regular split')
                <a href="{{ route('series.show', ['serie' => $serie->id]) }}" class="text-decoration-none">
                    <div class="result-item w-100">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <img src="{{ asset($serie->competition->logo) }}" class="team-logo img-fluid mx-3" alt="{{ $serie->competition->name }}">

                            <div class="d-flex align-items-center">
                                <img src="{{ asset($serie->team_1->logo) }}" class="team-logo img-fluid mx-3" alt="{{ $serie->team_1->name }}">
                                <h3 class="result titular mx-3">{{ $serie->getResultSerie() }}</h3>
                                <img src="{{ asset($serie->team_2->logo) }}" class="team-logo img-fluid mx-3" alt="{{ $serie->team_2->name }}">
                            </div>

                            <div class="d-flex flex-column align-items-center text-nowrap">
                                <h5 class="serie-date mb-0">{{ $serie->date }}</h5>
                                <h5 class="serie-type mt-0">{{ $serie->type }}</h5>
                            </div>
                        </div>
                        <hr class="separator" style="margin: 5%">
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>
