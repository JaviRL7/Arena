@extends('layouts.plantilla')
@section('title', 'MINIGAME')

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
    <form id="form-suposicion"  method="POST" action="/minigame/check-response">
        @csrf
        <input type="text" id="suposicion" class="search-minigame" name="try_nick" placeholder="Adivina el jugador">

        <button type="submit" id="check" class="btn btn-danger text-white">Check</button>
        <button type="button" id="get-clue" class="btn btn-outline-danger text-danger">Get a clue</button>

    </form>
@endsection

@section('content')
    {{-- Incluir la plantilla del grid aquí --}}
    @include('layouts.grid_minigame')


    <script>
// JavaScript para manejar eventos
// JavaScript para manejar eventos
let clueIndex = 1;
$('.card').on('click', function() {
    $(this).toggleClass('flipped');
    if (!$(this).hasClass('flipped')) {
        return;
    }
    $.ajax({
        url: '/minigame/get-clue',
        method: 'GET',
        success: function(response) {
            console.log(response); // Añade este console.log para ver la respuesta del servidor
            var clue = response.clue;
            if (clue.endsWith('.jpg') || clue.endsWith('.png') || clue.endsWith('.webp')) {
                // Si la pista termina con una extensión de archivo de imagen, la tratamos como una imagen
                $('#clue' + clueIndex).html('<img src="' + clue + '" alt="Pista">');
            } else {
                // Si la pista no termina con una extensión de archivo de imagen, la tratamos como texto
                $('#clue' + clueIndex).text(clue);
            }
            clueIndex++;
        },
        error: function(xhr, status, error) {
            console.error(error); // También es útil para capturar y mostrar errores
        }
    });
});

$('#get-clue').on('click', function() {
    if (clueIndex <= 5) {
        $('.card').eq(clueIndex - 1).click();
    } else {
        alert('No hay más pistas disponibles.');
    }
});

$('#form-suposicion').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize(); // Esto incluirá el token CSRF y el try_id
    $.ajax({
        url: '/minigame/check-response',
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.result === 'correct') {
                alert('¡Has adivinado correctamente!');
            } else {
                alert('Inténtalo de nuevo.');
            }
        }
    });
});

    </script>
@endsection
