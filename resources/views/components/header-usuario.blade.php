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
                <a href="#" class="text-white hover:text-orange-500 transition">Inicio</a>
                <a href="#" class="text-white hover:text-orange-500 transition">Catálogo</a>
                <a href="#" class="text-white hover:text-orange-500 transition">Ofertas</a>
                
                <x-carrito/>

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