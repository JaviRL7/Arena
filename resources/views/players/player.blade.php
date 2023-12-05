<!DOCTYPE html>
<html>
<head>
    <title>Tu Título Aquí</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#playerForm").submit(function(e){
                e.preventDefault();
                var playerId = $("#playerId").val();
                $.ajax({
                    url: '/show/' + playerId,
                    type: 'GET',
                    success: function(data) {
                        alert(data.nick);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Tu Encabezado Aquí</h1>
    <form id="playerForm">
        <label for="playerId">ID del Jugador:</label><br>
        <input type="number" id="playerId" name="playerId"><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
