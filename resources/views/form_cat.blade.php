<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Categoria</title>
<link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>

<body class="bg-[#0f172a] min-h-screen flex items-center justify-center">

<div class="bg-slate-800 p-12 rounded-xl shadow-2xl w-[420px]">

<form action="{{ route('categoria.guardar') }}" method="POST" class="text-white">
@csrf

<label class="block mb-3 text-lg font-semibold text-center text-slate-200">
Nombre Categoria
</label>

<input type="text" name="nombre"
class="w-full mb-8 px-4 py-3 text-md rounded-lg bg-slate-700 border border-slate-600 focus:outline-none focus:border-green-500 transition">

<div class="flex justify-center gap-6">

<input type="submit" value="Guardar"
class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-lg cursor-pointer font-medium transition">

<a href="/dashboard"
class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg text-white font-medium transition">
Cancelar
</a>

</div>

</form>

</div>

</body>
</html>