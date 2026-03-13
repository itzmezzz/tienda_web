<link rel="stylesheet" href="{{ asset('src/output.css') }}">
<div class="min-h-screen flex items-center justify-center bg-[#0f172a]">

<div class="bg-white w-[500px] border p-10 text-center rounded-2xl">
<h3 class="text-sm text-gray-600 mb-2">
INICIA SESIÓN EN TU CUENTA
</h3>

<h1 class="text-3xl font-bold text-blue-700 mb-6">
Manga House
</h1>

<form method="POST" action="{{ route('login') }}">
@csrf

<input type="email" name="email" placeholder="Correo electrónico" required
class="w-full border border-gray-300 p-3 mb-4 rounded bg-white text-gray-900">

<input type="password" name="password" placeholder="Contraseña" required
class="w-full border border-gray-300 p-3 mb-4 rounded bg-white text-gray-900">

<button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full mt-2 hover:bg-blue-700">
Iniciar sesión
</button>

</form>

<hr class="my-6 border-gray-300">

<div class="mt-4">
<a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full border border-gray-300 px-4 py-3 rounded hover:bg-gray-100">

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
<path fill="#EA4335" d="M24 9.5c3.4 0 6.4 1.2 8.8 3.2l6.6-6.6C35.7 2.3 30.2 0 24 0 14.6 0 6.6 5.4 2.7 13.3l7.7 6C12.1 13.3 17.6 9.5 24 9.5z"/>
<path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-2.7-.4-3.9H24v7.3h12.7c-.3 1.8-1.7 4.5-4.8 6.3l7.4 5.8c4.3-4 6.8-9.8 6.8-15.5z"/>
<path fill="#FBBC05" d="M10.4 28.6c-.5-1.4-.8-2.9-.8-4.6s.3-3.2.8-4.6l-7.7-6C1 16.7 0 20.2 0 24s1 7.3 2.7 10.6l7.7-6z"/>
<path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.4-5.8c-2 1.4-4.7 2.4-7.8 2.4-6.4 0-11.9-3.8-13.9-9.3l-7.7 6C6.6 42.6 14.6 48 24 48z"/>
</svg>

<span class="font-medium text-gray-700">Google</span>

</a>
</div>

<p class="mt-6 text-sm">
¿No tienes cuenta?
<a>Registrarme</a>
</p>

</div>
</div>