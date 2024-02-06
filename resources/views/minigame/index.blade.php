@extends('layouts.plantilla')
@section('title', 'Esportle')


{{-- Definir las secciones para las pistas --}}
@section('clue1')
    <div class="card">
        <div class="card-face front">
            <p>Clue 1</p>
        </div>
        <div class="card-face back">
            <div id="clue1"></div>
        </div>
    </div>
@endsection

@section('clue2')
    <div class="card">
        <div class="card-face front">
            <p>Clue 2</p>
        </div>
        <div class="card-face back">
            <div id="clue2"></div>
        </div>
    </div>
@endsection

@section('clue3')
    <div class="card">
        <div class="card-face front">
            <p>Clue 3</p>
        </div>
        <div class="card-face back">
            <div id="clue3"></div>
        </div>
    </div>
@endsection

@section('clue4')
    <div class="card">
        <div class="card-face front">
            <p>Clue 4</p>
        </div>
        <div class="card-face back">
            <div id="clue4"></div>
        </div>
    </div>
@endsection

@section('clue5')
    <div class="card">
        <div class="card-face front">
            <p>Clue 5</p>
        </div>
        <div class="card-face back">
            <div id="clue5"></div>
        </div>
    </div>
@endsection

{{-- Definir la sección para la búsqueda --}}
@section('search')
    <form id="form-suposicion" method="POST" action="/minigame/check-response">
        <a href="#!" class="link-muted" data-bs-toggle="modal" data-bs-target="#instructionsModal">
            <i class="fas fa-info-circle ms-2"></i>
        </a>
        @csrf
        <input type="text" id="suposicion" class="search-minigame slightly-rounded-input" name="try_nick" placeholder="Guess the pro player">
        <button type="submit" id="check" class="btn btn-danger btn-boton5">Check</button>
        <button type="button" id="get-clue" class="btn btn-outline-danger btn-boton6">Get a clue</button>
    </form>
    @include('modals.instructions')
    @include('modals.CorrectGuess')
    @include('modals.WrongGuess')

@endsection


@section('content')
<script>
    var players = @json($players);
</script>
    @include('layouts.grid_minigame')
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/minigame/game.js') }}"></script>
@endsection
@endsection
