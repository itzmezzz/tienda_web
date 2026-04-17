<header class="bg-black text-white shadow-2xl border-b border-orange-600">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <h1 class="text-2xl font-black text-orange-600 tracking-tighter uppercase italic">MangaHouse</h1>
        
        <nav class="flex items-center space-x-8">
            <div class="flex items-center space-x-6 font-bold text-sm uppercase tracking-widest">
                <div class="relative"> <form action="{{ route('producto.buscarus') }}" method="GET" class="hidden md:block">
        <div class="flex items-center bg-zinc-900 border border-zinc-800 rounded-full overflow-hidden focus-within:ring-2 focus-within:ring-orange-500 transition">
            <input 
                type="text"
                id="buscador"
                name="q"
                autocomplete="off" 
                value="{{ $query ?? '' }}"
                placeholder="Buscar manga..."
                class="bg-transparent text-white px-4 py-1.5 w-64 outline-none text-sm"
            >
            <button type="submit" class="bg-zinc-800 px-4 py-1.5 hover:bg-orange-600 transition text-white">
                🔍
            </button>
        </div>
    </form>

    <div id="resultados" 
         class="absolute z-50 w-full mt-2 bg-zinc-900 border border-zinc-700 rounded-xl shadow-2xl overflow-hidden hidden">
    </div>
</div>
                <a href="/" class="text-white hover:text-orange-500 transition">Inicio</a>
                <a href="{{ route('catalogo') }}" class="text-white hover:text-orange-500 transition">Catálogo</a>
                <x-carrito/>
                <a href="{{ route('perfil') }}" class="text-white hover:text-orange-500 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2" />
    </svg>
</a>

                <nav class="flex items-center space-x-4">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-orange-600 px-3 py-1 rounded text-xs hover:bg-orange-700 transition">Cerrar Sesión</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="hover:text-orange-500 transition text-xs">Iniciar Sesión</a>
                    @endguest
                </nav>
            </div>
        </nav>
    </div>
</header>