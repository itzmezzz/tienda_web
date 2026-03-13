<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>form serie</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-slate-900 min-h-screen p-10 text-white">

<div class="max-w-5xl mx-auto">
 @include('components.sidebar')
<h1 class="text-3xl font-bold mb-8">Crear Serie</h1>

<div class="bg-slate-800 p-8 rounded-xl shadow-lg">

<form action="#" method="POST">

<div class="grid grid-cols-2 gap-6">

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Nombre</label>
<input type="text" name="nombre" required
class="w-full px-4 py-2 rounded bg-slate-700 border border-slate-600 focus:outline-none focus:border-blue-500">
</div>

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Descripción</label>
<textarea name="descripcion" cols="30" rows="5"
class="w-full px-4 py-2 rounded bg-slate-700 border border-slate-600 focus:outline-none focus:border-blue-500"></textarea>
</div>

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Categoría</label>
<select name="id_categoria"
class="w-full px-4 py-2 rounded bg-slate-700 border border-slate-600 focus:outline-none focus:border-blue-500">

<option>Shonen</option>
<option>Seinen</option>
<option>Shojo</option>

</select>
</div>

</div>

<div class="flex justify-center gap-4 mt-8">

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-md text-sm">
Guardar serie
</button>

<a href="#"
class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-md text-sm">
Cancelar
</a>

</div>

</form>

</div>

</div>

</body>
</html>