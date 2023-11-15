<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de jugadores</title>
</head>
<body>
    <h1>List of players</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Firts lastname</th>
                <th>Nick</th>
                <th>Country</th>
                <th>id Role</th>
                <th>photo</th>
                <th>Ver</th>
                <th>borrar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
                <tr>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->lastname1 }}</td>
                    <td>{{ $player->lastname2 }}</td>
                    <td>{{ $player->nick }}</td>
                    <td>{{ $player->country }}</td>
                    <td>{{ $player->role_id }}</td>
                    <td>{{ $player->photo }}</td>

                    <td>
                        <form action="{{ route('players.destroy', $player->id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
