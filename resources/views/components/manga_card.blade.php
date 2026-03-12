<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="bg-gray-100">

<header class="bg-red-600 text-white">

<div class="max-w-7xl mx-auto flex justify-between items-center p-4">

<a href="/" class="text-2xl font-bold">
MangaStore
</a>

<input
type="text"
placeholder="Buscar manga..."
class="px-4 py-2 rounded text-black w-1/3"
>

<a href="#" class="bg-black px-4 py-2 rounded">
Carrito
</a>

</div>

</header>

<main>
@yield('content')
</main>

<footer class="bg-gray-900 text-white text-center p-6 mt-10">
© {{ date('Y') }} MangaStore
</footer>

</body>
</html>