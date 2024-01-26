<div class="owl-carousel owl-theme" id="owl-carousel-{{ $name }}">
    @foreach ($series as $serie)
        @if ($serie->name == $name)
            <div class="item">
                <div class="d-flex flex-column align-items-center">
                    <div class="d-flex">

                        <div class="container-car">
                            <div class="inner">
                                <img src="{{ asset($serie->team_1->team_photo) }}" alt="{{ $serie->team_1->name }}">
                                <img src="{{ asset($serie->team_2->team_photo) }}" alt="{{ $serie->team_2->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center w-100 mt-3">
                        <div class="d-flex flex-column align-items-center w-50">
                            <img src="{{ asset($serie->team_1->logo) }}" class="team-logo img-fluid"
                                alt="{{ $serie->team_1->name }}">
                        </div>
                        <h3 class="result">{{ $serie->getResultSerie() }}</h3>
                        <div class="d-flex flex-column align-items-center w-50">
                            <img src="{{ asset($serie->team_2->logo) }}" class="team-logo img-fluid"
                                alt="{{ $serie->team_2->name }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
