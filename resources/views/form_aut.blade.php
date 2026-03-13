<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>form autores</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-[#0f172a] min-h-screen flex items-center justify-center p-10">

<div class="bg-slate-800 p-12 rounded-xl shadow-2xl w-[700px]">

<form action="{{ route('autores.guardar') }}" method="POST" class="text-white">
@csrf

<div class="grid grid-cols-2 gap-6">

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Nombre</label>
<input type="text" name="nombre" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

<div class="col-span-2">
<label class="block mb-2 text-slate-200">Nacionalidad</label>
<input type="text" name="nacionalidad" required
class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500">
</div>

</div>

<div class="flex justify-center gap-6 mt-8">

<button type="submit"
class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-lg font-medium transition">
Guardar autor
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