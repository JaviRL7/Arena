@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide my-carousel">
                    <div class="carousel-indicators">
                        @php $count = 0; @endphp
                        @foreach ($series as $serie)
                            @if ($serie->name == 'Quarterfinals')
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $count }}" @if($count == 0) class="active" aria-current="true" @endif aria-label="Slide {{ $count + 1 }}"></button>
                                @php $count++; @endphp
                            @endif
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @php $count = 0; @endphp
                        @foreach ($series as $serie)
                            @if ($serie->name == 'Quarterfinals')
                                <div class="carousel-item @if($count == 0) active @endif">
                                    <div class="d-flex">
                                        <img src="{{ asset($serie->team_1->team_photo) }}" class="d-block w-50" alt="{{ $serie->team_1->name }}">
                                        <img src="{{ asset($serie->team_2->team_photo) }}" class="d-block w-50" alt="{{ $serie->team_2->name }}">
                                    </div>
                                </div>
                                @php $count++; @endphp
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
