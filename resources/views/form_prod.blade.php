<form action="{{ route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nombre</label>
    <input type="text" name="nombre" required>

    <label>Descripción</label>
    <textarea name="descripcion"></textarea>

    <label>Precio</label>
    <input type="number" step="0.01" name="precio" required>

    <label>Stock</label>
    <input type="number" name="stock" required>

    <label>Número de tomo</label>
    <input type="number" name="numero_tomo" required>

    <label>ISBN</label>
    <input type="text" name="isbn" required>

    <label>Autor</label>
    <select name="id_autor" required>
        <option value="" >Seleccionar</option>
        @foreach($autor as $fila)
            <option value="{{ $fila->id }}">
                {{ $fila->nombre }}
            </option>
        @endforeach
    </select>

    <label>Categoría</label>
    <select name="id_categoria" required>
        <option value="" >Seleccionar</option>
        @foreach($categoria as $fila)
            <option value="{{ $fila->id }}">
                {{ $fila->nombre }}
            </option>
        @endforeach
    </select>

    <label>Serie</label>
    <select name="id_serie" required>
        <option value="">Seleccionar</option>
        @foreach($serie as $fila)
            <option value="{{ $fila->id }}">
                {{ $fila->nombre }}
            </option>
        @endforeach
    </select>

    <label>Editorial</label>
    <select name="id_editorial" required>
        <option value="">Seleccionar</option>
        @foreach($editorial as $fila)
            <option value="{{ $fila->id }}">
                {{ $fila->nombre }}
            </option>
        @endforeach
    </select>
    <label>Imagen</label>
    <input type="file" name="imagen" required>

    <button type="submit">Guardar producto</button>

</form>