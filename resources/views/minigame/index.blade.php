@extends('layouts.plantilla')
@section('title', 'MINIGAME')

@section('content')
<!-- Vista Blade (cambiarr)-->
<div>

    <form id="form-suposicion" method="POST" action="/minigame/check-response">
        @csrf <!-- Incluye el token CSRF aquí -->
        <div id="clues"></div>
        <input type="text" id="suposicion" name="try_nick" placeholder="Adivina el jugador">

        <button type="button" id="get-clue">Obtener pista</button>
        <button type="submit" id="check">Verificar</button>
    </form>
</div>

<script>
// JavaScript para manejar eventos
$('#get-clue').on('click', function() {
    $.ajax({
        url: '/minigame/get-clue',
        method: 'GET',
        success: function(response) {
            console.log(response); // Añade este console.log para ver la respuesta del servidor
            $('#clues').append($('<div>').text(response.clue));
        },
        error: function(xhr, status, error) {
            console.error(error); // También es útil para capturar y mostrar errores
        }
    });
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
