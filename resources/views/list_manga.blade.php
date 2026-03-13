<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <title>Document</title>
</head>
<body>
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
<th class="p-4">Categoría</th>
<th class="p-4">Serie</th>
<th class="p-4">Editorial</th>
<th class="p-4 text-center">Acciones</th>
</tr>
</thead>

<tbody class="divide-y divide-slate-700">

<tr class="hover:bg-slate-700 transition">
<td class="p-4">
<img src="https://via.placeholder.com/60" class="w-14 h-20 object-cover rounded">
</td>

<td class="p-4 font-semibold"></td>
<td class="p-4 text-slate-300"></td>
<td class="p-4"></td>
<td class="p-4"></td>
<td class="p-4"></td>
<td class="p-4"></td>
<td class="p-4"></td>
<td class="p-4"></td>
<td class="p-4"></td>

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

</tbody>

</table>

</div>

</div>

</body>
</html>
</body>
</html>