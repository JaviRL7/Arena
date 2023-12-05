<!DOCTYPE html>
<html>

<head>
    <title>Tu Título Aquí</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#teamId").submit(function(e) {
                e.preventDefault();
                var team1Id = $("#teamBlueid").val();
                var team2Id = $("#teamRedid").val();
                $.ajax({
                    url: '/show/' + team1Id + '/' + team2Id,
                    type: 'GET',
                    success: function(data) {
                        data.team1Players.forEach(function(player) {
                            var form = $('<form>').attr('id', 'playerForm' + player.id);
                            var label = $('<label>').text(
                                'Escribe el nuevo nombre para ' + player.name);
                            var input = $('<input>').attr('type', 'text').attr('name',
                                'newName');
                            form.append(label, input);
                            $('body').append(form);
                        });
                        data.team2Players.forEach(function(player) {
                            var form = $('<form>').attr('id', 'playerForm' + player.id);
                            var label = $('<label>').text(
                                'Escribe el nuevo nombre para ' + player.name);
                            var input = $('<input>').attr('type', 'text').attr('name',
                                'newName');
                            form.append(label, input);
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
        <label for="teamBlueid">ID del team blue:</label><br>
        <input type="number" id="teamBlueid" name="teamBlueid"><br>
        <label for="teamRedid">ID del team red:</label><br>
        <input type="number" id="teamRedid" name="teamRedid"><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
