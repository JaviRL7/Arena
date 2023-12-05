<!DOCTYPE html>
<html>

<head>
    <title>Tu Título Aquí</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#teamId").submit(function(e) {
                e.preventDefault();
                // Borra los formularios existentes
                $("form[id^='playerForm']").remove();
                var team1Id = $("#teamBlueid").val();
                var team2Id = $("#teamRedid").val();
                $.ajax({
                    url: '/admin/games/create/' + team1Id + '/' + team2Id,
                    type: 'GET',
                    success: function(data) {
                        data.team1Players.forEach(function(player) {
                            var form = $('<form>').attr('id', 'playerForm' + player.id);
                            var labelKills = $('<label>').text('Introduce kills para ' +
                                player.nick);
                            var inputKills = $('<input>').attr('type', 'number').attr(
                                'name', 'kills');
                            var labelDeaths = $('<label>').text(
                                'Introduce deaths para ' + player.nick);
                            var inputDeaths = $('<input>').attr('type', 'number').attr(
                                'name', 'deaths');
                            var labelAssists = $('<label>').text(
                                'Introduce assists para ' + player.nick);
                            var inputAssists = $('<input>').attr('type', 'number').attr(
                                'name', 'assists');
                            var labelChampion = $('<label>').text(
                                'Selecciona el campeón para ' + player.nick);
                            var selectChampion = $('<select>').attr('name',
                                'championId');
                            data.champions.forEach(function(champion) {
                                var option = $('<option>').attr('value',
                                    champion.id).text(champion.name);
                                selectChampion.append(option);
                            });
                            form.append(labelKills, inputKills, labelDeaths,
                                inputDeaths, labelAssists, inputAssists,
                                labelChampion, selectChampion);
                            $('body').append(form);
                        });
                        data.team2Players.forEach(function(player) {
                            var form = $('<form>').attr('id', 'playerForm' + player.id);
                            var labelKills = $('<label>').text('Introduce kills para ' +
                                player.nick);
                            var inputKills = $('<input>').attr('type', 'number').attr(
                                'name', 'kills');
                            var labelDeaths = $('<label>').text(
                                'Introduce deaths para ' + player.nick);
                            var inputDeaths = $('<input>').attr('type', 'number').attr(
                                'name', 'deaths');
                            var labelAssists = $('<label>').text(
                                'Introduce assists para ' + player.nick);
                            var inputAssists = $('<input>').attr('type', 'number').attr(
                                'name', 'assists');
                            var labelChampion = $('<label>').text(
                                'Selecciona el campeón para ' + player.nick);
                            var selectChampion = $('<select>').attr('name',
                                'championId');
                                data.champions.forEach(function(champion) {
                                var option = $('<option>').attr('value',
                                    champion.id).text(champion.name);
                                selectChampion.append(option);
                            });
                            // Añade las opciones al select de campeones aquí
                            form.append(labelKills, inputKills, labelDeaths,
                                inputDeaths, labelAssists, inputAssists,
                                labelChampion, selectChampion);
                            $('body').append(form);
                        });
                    }
                });
            });
        });
    </script>
</head>

<body>
    <h1>Formulario teams</h1>
    <form id="teamId">
        <label for="teamBlueid">Elige el equipo azul:</label><br>
        <select id="teamBlueid" name="teamBlueid">
            <option value="" selected>Elige el equipo azul</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select><br>
        <label for="teamRedid">Elige el equipo rojo:</label><br>
        <select id="teamRedid" name="teamRedid">
            <option value="" selected>Elige el equipo rojo</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
