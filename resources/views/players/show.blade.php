@extends('layouts.plantilla')
@section('title','Teamsindex')
@section('content')
<h1>HOLAAA</h1>
<form id="player-form">
    <input type="text" id="player-id" placeholder="Ingresa el ID del jugador">
    <input type="submit" value="Buscar">
</form>

<script>
$('#player-form').on('submit', function(e) {
    e.preventDefault();

    var player_id = $('#player-id').val();

    $.ajax({
        url: '/players/show/' + player_id,
        type: 'GET',
        success: function(response) {
            alert(JSON.stringify(response));
        }
    });
});
</script>
@endsection
