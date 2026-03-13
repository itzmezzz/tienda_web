<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producto</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-[#0f172a] min-h-screen flex items-center justify-center p-10">

<div class="bg-slate-800 p-12 rounded-xl shadow-2xl w-[900px]">

<form action="{{ route('producto.guardar') }}" method="POST" enctype="multipart/form-data" class="text-white">
@csrf

<div class="grid grid-cols-2 gap-6">

<div>
<label class="block mb-2 text-slate-200">Nombre</label>
<input type="text" name="nombre" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div>
<label class="block mb-2 text-slate-200">Precio</label>
<input type="number" step="0.01" name="precio" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Descripción</label>
<textarea name="descripcion"
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500"></textarea>
</div>

<div>
<label class="block mb-2 text-slate-200">Stock</label>
<input type="number" name="stock" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div>
<label class="block mb-2 text-slate-200">Número de tomo</label>
<input type="number" name="numero_tomo" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div>
<label class="block mb-2 text-slate-200">ISBN</label>
<input type="text" name="isbn" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div>
<label class="block mb-2 text-slate-200">Autor</label>
<select name="id_autor" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
<option value="">Seleccionar</option>
@foreach($autor as $fila)
<option value="{{ $fila->id }}">
{{ $fila->nombre }}
</option>
@endforeach
</select>
</div>

<div>
<label class="block mb-2 text-slate-200">Categoría</label>
<select name="id_categoria" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
<option value="">Seleccionar</option>
@foreach($categoria as $fila)
<option value="{{ $fila->id }}">
{{ $fila->nombre }}
</option>
@endforeach
</select>
</div>

<div>
<label class="block mb-2 text-slate-200">Serie</label>
<select name="id_serie" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
<option value="">Seleccionar</option>
@foreach($serie as $fila)
<option value="{{ $fila->id }}">
{{ $fila->nombre }}
</option>
@endforeach
</select>
</div>

<div>
<label class="block mb-2 text-slate-200">Editorial</label>
<select name="id_editorial" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
<option value="">Seleccionar</option>
@foreach($editorial as $fila)
<option value="{{ $fila->id }}">
{{ $fila->nombre }}
</option>
@endforeach
</select>
</div>

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Imagen</label>
<input type="file" name="imagen" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white">
</div>

</div>

<div class="flex justify-center gap-6 mt-8">

<button type="submit"
class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-lg font-medium transition">
Guardar producto
</button>

<a href="/dashboard"
class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg text-white font-medium transition">
Cancelar
</a>

</div>

</form>

</div>

</body>
</html>