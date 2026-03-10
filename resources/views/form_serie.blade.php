<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form serie </title>
</head>
<body>
    
    <form action="{{ route('serie.guardar') }}" method="POST">
        @csrf
        <label for="">nombre</label>
        <input type="text" name="nombre" required>
        
        <label for="">descripción</label>
        <textarea name="descripcion" id="" cols="30" rows="10"></textarea>

        <label>Categoría</label>
        <select name="id_categoria">
        @foreach($categorias as $fila)
            <option value="{{ $fila->id}}">{{ $fila->nombre }}</option>
        @endforeach
    </select>

        <button type="submit">Guardar serie</button>
    </form>
</body>
</html>