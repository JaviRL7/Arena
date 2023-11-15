<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Jugador</title>
</head>
<body>
    <h1>Editar Jugador</h1>

    <form action="{{ route('players.update', $player->id) }}" method="POST">
        @method('PUT')
        @csrf

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ $player->name }}">

        <label for="lastname1">Primer Apellido:</label>
        <input type="text" id="lastname1" name="lastname1" value="{{ $player->lastname1 }}">

        <label for="lastname2">Segundo Apellido:</label>
        <input type="text" id="lastname2" name="lastname2" value="{{ $player->lastname2 }}">

        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" value="{{ $player->nick }}">

        <label for="country">Pais:</label>
        <input type="text" id="country" name="country" value="{{ $player->country }}">

        <label for="role_id">Rol:</label>
        <select id="role_id" name="role_id">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</body>
</html>
