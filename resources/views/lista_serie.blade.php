<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Series</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-slate-900 min-h-screen p-10 text-white">

<div class="max-w-7xl mx-auto">

<h1 class="text-3xl font-bold mb-8">Lista de Series</h1>

<div class="flex justify-end mb-6">

<a href="{{ route('serie.nuevo') }}"
class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-md text-sm font-medium">
Agregar Serie
</a>

</div>

<div class="overflow-x-auto bg-slate-800 rounded-xl shadow-lg">

<table class="w-full text-sm text-left">

<thead class="bg-slate-700 text-slate-200 uppercase text-xs">
<tr>
<th class="p-4">Nombre</th>
<th class="p-4">Descripción</th>
<th class="p-4">Categoría</th>
<th class="p-4 text-center">Acciones</th>
</tr>
</thead>

<tbody class="divide-y divide-slate-700">
@foreach ($series as $fila)
    

<tr class="hover:bg-slate-700 transition">

<td class="p-4 font-semibold">{{ $fila->nombre }}</td>
<td class="p-4 text-slate-300">{{ $fila->descripcion }}</td>
<td class="p-4">{{ $fila->categoria->nombre ?? 'N/A' }}</td>

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


</tr>

</tbody>

</table>

</div>

</div>

</body>
</html>