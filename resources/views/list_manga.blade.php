<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Mangas</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-slate-900 min-h-screen p-10 text-white">

<div class="max-w-7xl mx-auto">

<h1 class="text-3xl font-bold mb-8">Lista de Mangas</h1>

<form action="{{ route('producto.buscar') }}" method="GET" class="relative w-64 mb-6">

    <div class="flex">
        <input 
        type="text"
        id="searchInput"
        name="q"
        placeholder="Buscar manga, autor, serie..."
        class="border rounded-l px-4 py-2 w-full ">

        <button type="submit"
        class="bg-blue-500 text-white px-4 rounded-r">
        Buscar
        </button>
    </div>

    <div id="searchResults"
    class="absolute top-full left-0 w-full bg-white text-black rounded shadow-lg hidden z-50">
    </div>

</form>


<div class="overflow-x-auto bg-slate-800 rounded-xl shadow-lg">

<table class="w-full text-sm text-left">

<thead class="bg-slate-700 text-slate-200 uppercase text-xs">
<tr>
<th class="p-4">Imagen</th>
<th class="p-4">Nombre</th>
<th class="p-4">Descripción</th>
<th class="p-4">Precio</th>
<th class="p-4">Stock</th>
<th class="p-4">Tomo</th>
<th class="p-4">ISBN</th>
<th class="p-4">Autor</th>
<th class="p-4">Categoría</th>
<th class="p-4">Serie</th>
<th class="p-4">Editorial</th>
<th class="p-4 text-center">Acciones</th>
</tr>
</thead>

<tbody class="divide-y divide-slate-700">

@foreach($productos as $fila)

<tr class="hover:bg-slate-700 transition">

<td class="p-4">
<img src="{{ $fila->imagen ? asset('productos/'.$fila->imagen) : 'https://via.placeholder.com/150' }}"
class="w-14 h-20 object-cover rounded">
</td>

<td class="p-4 font-semibold">{{ $fila->nombre }}</td>
<td class="p-4 text-slate-300">{{ $fila->descripcion }}</td>
<td class="p-4">${{ number_format($fila->precio,2) }}</td>
<td class="p-4">{{ $fila->stock }}</td>
<td class="p-4">{{ $fila->numero_tomo }}</td>
<td class="p-4">{{ $fila->isbn }}</td>

<td class="p-4">{{ $fila->autor->nombre ?? 'N/A' }}</td>
<td class="p-4">{{ $fila->categoria->nombre ?? 'N/A' }}</td>
<td class="p-4">{{ $fila->serie->nombre ?? 'N/A' }}</td>
<td class="p-4">{{ $fila->editorial->nombre ?? 'N/A' }}</td>

<td class="p-4">

<div class="flex gap-3 justify-center">

<button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-sm">
Editar
</button>

<button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-sm">
Eliminar
</button>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<script src="{{ asset('js/live-search.js') }}"></script>

</body>
</html>