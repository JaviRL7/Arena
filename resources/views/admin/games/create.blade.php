@extends('layouts.plantilla_create_game')
@section('title', 'Teams index')
@section('script')
  <script>
    $(document).ready(function () {
      $("#teamId").submit(function (e) {
        e.preventDefault();
        // Borra los formularios existentes
        $("form[id^='playerForm']").remove();
        var team1Id = $("#teamBlueid").val();
        var team2Id = $("#teamRedid").val();
        var matchDate = $("#matchDate").val();
        $.ajax({
          url: '/admin/games/create/' + team1Id + '/' + team2Id + '?date=' + matchDate,
          type: 'GET',
          success: function (data) {
            data.team1Players.forEach(function (player) {
              var form = $('<form>').attr('id', 'playerForm' + player.id);
              var labelSelectData = $('<label>').text('Selecciona los datos del jugador (' + player.nick + '):');
              var labelKills = $('<label>').text('Kills:');
              var inputKills = $('<input>').attr('type', 'number').attr('name', 'kills').addClass('form-control col-md-6 mb-3');
              var labelDeaths = $('<label>').text('Deaths:');
              var inputDeaths = $('<input>').attr('type', 'number').attr('name', 'deaths').addClass('form-control col-md-6 mb-3');
              var labelAssists = $('<label>').text('Assists:');
              var inputAssists = $('<input>').attr('type', 'number').attr('name', 'assists').addClass('form-control col-md-6 mb-3');
              var labelChampion = $('<label>').text('Selecciona el campeón:');
              var selectChampion = $('<select>').attr('name', 'championId').addClass('form-control col-md-6 mb-3');
              data.champions.forEach(function (champion) {
                var option = $('<option>').attr('value', champion.id).text(champion.name);
                selectChampion.append(option);
              });
              form.append(labelSelectData, labelKills, inputKills, labelDeaths, inputDeaths, labelAssists, inputAssists, labelChampion, selectChampion);
              $('#teamBlue').append(form);
            });
            data.team2Players.forEach(function (player) {
              var form = $('<form>').attr('id', 'playerForm' + player.id);
              var labelSelectData = $('<label>').text('Selecciona los datos del jugador (' + player.nick + '):');
              var labelKills = $('<label>').text('Kills:');
              var inputKills = $('<input>').attr('type', 'number').attr('name', 'kills').addClass('form-control col-md-6 mb-3');
              var labelDeaths = $('<label>').text('Deaths:');
              var inputDeaths = $('<input>').attr('type', 'number').attr('name', 'deaths').addClass('form-control col-md-6 mb-3');
              var labelAssists = $('<label>').text('Assists:');
              var inputAssists = $('<input>').attr('type', 'number').attr('name', 'assists').addClass('form-control col-md-6 mb-3');
              var labelChampion = $('<label>').text('Selecciona el campeón:');
              var selectChampion = $('<select>').attr('name', 'championId').addClass('form-control col-md-6 mb-3');
              data.champions.forEach(function (champion) {
                var option = $('<option>').attr('value', champion.id).text(champion.name);
                selectChampion.append(option);
              });
              form.append(labelSelectData, labelKills, inputKills, labelDeaths, inputDeaths, labelAssists, inputAssists, labelChampion, selectChampion);
              $('#teamRed').append(form);
            });
          }
        });
      });
    });
  </script>
  @endsection
@section('select_teams')
    <h1>Formulario teams</h1>
    <form id="teamId">
        <label for="teamBlueid">Elige el equipo azul:</label><br>
        <select id="teamBlueid" name="teamBlueid" class="form-control mb-3">
            <option value="" selected>Elige el equipo azul</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select><br>
        <label for="teamRedid">Elige el equipo rojo:</label><br>
        <select id="teamRedid" name="teamRedid" class="form-control mb-3">
            <option value="" selected>Elige el equipo rojo</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select><br>
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
@endsection
@section('team_blue')
    <!-- Team Blue Form Section -->
    <div id="teamBlue">
        <!-- The forms for Team Blue will be appended here -->
    </div>
@endsection

@section('team_red')
    <!-- Team Red Form Section -->
    <div id="teamRed">
        <!-- The forms for Team Red will be appended here -->
    </div>
@endsection
