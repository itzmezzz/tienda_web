```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Autores</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-slate-900 text-white">

<div class="flex min-h-screen">

{{-- SIDEBAR --}}
@include('components.sidebar')

{{-- CONTENIDO --}}
<div class="flex-1 p-10">

<div class="max-w-7xl mx-auto">

<h1 class="text-3xl font-bold mb-8">Lista de Autores</h1>

<!-- BOTÓN -->
<div class="flex justify-end mb-6">
<a href="{{ route('autores.nuevo') }}"
class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-md text-sm font-medium">
Agregar Autor
</a>
</div>

<!-- TABLA -->
<div class="overflow-x-auto bg-slate-800 rounded-xl shadow-lg">

<table class="w-full text-sm text-left">

<thead class="bg-slate-700 text-slate-200 uppercase text-xs">
<tr>
<th class="p-4">Nombre</th>
<th class="p-4">Nacionalidad</th>
<th class="p-4 text-center">Acciones</th>
</tr>
</thead>

<tbody class="divide-y divide-slate-700">

@foreach ($autores as $fila)

<tr class="hover:bg-slate-700 transition">

<td class="p-4 font-semibold">
{{ $fila->nombre }}
</td>

<td class="p-4 text-slate-300">
{{ $fila->nacionalidad }}
</td>

<td class="p-4">
<div class="flex justify-center gap-3">

<button class="bg-blue-600 hover:bg-blue-700 px-4 py-1 rounded-md text-sm">
Editar
</button>

<button class="bg-red-600 hover:bg-red-700 px-4 py-1 rounded-md text-sm">
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

</div>

</div>

</body>
</html>
```
