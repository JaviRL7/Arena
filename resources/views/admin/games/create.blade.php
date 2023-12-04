@extends('layouts.plantilla')
@section('title','Teamsindex')
@section('content')

<form action="/admin/games/create/getPlayers" method="POST" action="POST">

@csrf

<label for="team_blue_id">Equipo Azul:</label>
<select name="team_blue_id" id="team_blue_id">
@foreach($teams as $team)
<option value="{{$team->id}}">{{$team->name}}</option>
@endforeach
</select>

<!-- Aquí se agregarán los jugadores dinámicamente -->


</form>
<div id="players-container">
    <h2>Jugadores</h2>
    </div>
<script>
    $(document).ready(function(){
        // Cuando se selecciona un equipo, se realiza la solicitud AJAX
        $('#team_blue_id').change(function(){
            var teamBlueId = $('#team_blue_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                url: '/admin/games/create/getPlayers',
                method: 'POST',
                data:{
                    team_blue_id: teamBlueId,
                }
            }).done(function(res){
                // Vacía el contenedor de jugadores
                $('#players-container').empty();

                // Agrega los jugadores al contenedor
                $.each(res.players, function(index, players){
                    $('#players-container').append('<p>' + players.name + '</p>');
                });
            })
        });
    });
    </script>
@endsection
