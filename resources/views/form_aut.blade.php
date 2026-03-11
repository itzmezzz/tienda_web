<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form autores</title>
</head>
<body>
    <form action="{{ route('autores.guardar') }}" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre" required>
        <label for="">Nacionalidad</label>
        <input type="text" name="nacionalidad" required>
        <button type="submit">Guardar autor</button>
    </form>
</body>
</html>