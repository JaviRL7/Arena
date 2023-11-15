<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear jugador</title>
</head>
<body>
    <h1>Crear jugador</h1>

    <form action="/players" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="lastname1">Lastname 1</label>
            <input type="text" class="form-control" id="lastname1" name="lastname1" placeholder="lastname1">
        </div>
        <div class="form-group">
            <label for="lastname2">Lastname 2</label>
            <input type="text" class="form-control" id="lastname2" name="lastname2" placeholder="lastname2">
        </div>
        <div class="form-group">
            <label for="nick">Nick</label>
            <input type="text" class="form-control" id="nick" name="nick" placeholder="Nick">
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="País">
        </div>
        <div class="form-group">
            <label for="role">Role_id</label>
            <input type="number" class="form-control" id="role_id" name="role_id" placeholder="Role_id">
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</body>
</html>
