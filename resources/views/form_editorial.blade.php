<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form editorial</title>
</head>
<body>
    <form action="{{ route('editorial.guardar') }}" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre" required>
        <button type="submit">Guardar editorial</button>
    </form>
</body>
</html>