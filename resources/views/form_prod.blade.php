<form action="{{ route('productos.guardar') }}" method="POST">
    @csrf

    <label>Nombre</label>
    <input type="text" name="nombre" required>

    <label>Descripción</label>
    <textarea name="descripcion"></textarea>

    <label>Precio</label>
    <input type="number" step="0.01" name="precio" required>

    <label>Stock</label>
    <input type="number" name="stock">

    <label>Número de tomo</label>
    <input type="number" name="numero_tomo">

    <label>ISBN</label>
    <input type="text" name="isbn">

    <label>Imagen</label>
    <input type="file" name="imagen">

    <label>Categoría</label>
    <select name="id_categoria">
        <option value="">Seleccionar</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>

    <label>Serie</label>
    <select name="id_serie">
        <option value="">Seleccionar</option>
        @foreach($series as $serie)
            <option value="{{ $serie->id }}">
                {{ $serie->nombre }}
            </option>
        @endforeach
    </select>

    <label>Editorial</label>
    <select name="id_editorial">
        <option value="">Seleccionar</option>
        @foreach($editoriales as $editorial)
            <option value="{{ $editorial->id }}">
                {{ $editorial->nombre }}
            </option>
        @endforeach
    </select>

    <button type="submit">Guardar producto</button>

</form>