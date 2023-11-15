<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del jugador</title>
</head>
<body>
    <h1>Detalles del jugador</h1>

    <table>
        <tbody>
            <tr>
                <th>Nombre</th>
                <td>{{ $player->name }}</td>
            </tr>
            <tr>
                <th>Apellido</th>
                <td>{{ $player->lastname }}</td>
            </tr>
            <tr>
                <th>Nick</th>
                <td>{{ $player->nick }}</td>
            </tr>
            <tr>
                <th>País</th>
                <td>{{ $player->country }}</td>
            </tr>
            <tr>
                <th>Rol</th>
                <td>{{ $player->role }}</td>
            </tr>
        </tbody>
    </table>

    <a href="/players" class="btn btn-primary">Volver a la lista</a>
</body>
</html>
