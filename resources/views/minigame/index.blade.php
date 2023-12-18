@extends('layouts.plantilla')
@section('title', 'MINIGAME')

{{-- Definir las secciones para las pistas --}}
@section('clue1')
    <div id="clue1"></div>
@endsection

@section('clue2')
    <div id="clue2"></div>
@endsection

@section('clue3')
    <div id="clue3"></div>
@endsection

@section('clue4')
    <div id="clue4"></div>
@endsection

@section('clue5')
    <div id="clue5"></div>
@endsection

{{-- Definir la sección para la búsqueda --}}
@section('search')
    <form id="form-suposicion" method="POST" action="/minigame/check-response">
        @csrf <!-- Incluye el token CSRF aquí -->
        <input type="text" id="suposicion" name="try_nick" placeholder="Adivina el jugador">
        <button type="submit" id="check">Verificar</button>
        <button type="button" id="get-clue">Obtener pista</button>

    </form>
@endsection

@section('content')
    {{-- Incluir la plantilla del grid aquí --}}
    @include('layouts.grid_minigame')


    <script>
    // JavaScript para manejar eventos
    let clueIndex = 1;
    $('#get-clue').on('click', function() {
        if (clueIndex <= 5) {
            $.ajax({
                url: '/minigame/get-clue',
                method: 'GET',
                success: function(response) {
                    console.log(response); // Añade este console.log para ver la respuesta del servidor
                    $('#clue' + clueIndex).text(response.clue);
                    clueIndex++;
                },
                error: function(xhr, status, error) {
                    console.error(error); // También es útil para capturar y mostrar errores
                }
            });
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
