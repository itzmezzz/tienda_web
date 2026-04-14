<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaHouse | Catálogo</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data="{ ...carrito(), filtro: 'todos' }" class="bg-[#0a0a0a] font-sans text-white bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply">

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

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <h3 class="text-4xl font-black uppercase italic tracking-tighter">Explorar <span class="text-orange-600">Catálogo</span></h3>
            <div class="h-1 w-20 bg-orange-600 mt-2"></div>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <button 
                @click="filtro = 'todos'" 
                :class="filtro === 'todos' ? 'bg-orange-600 text-black border-orange-600' : 'bg-zinc-900 text-zinc-400 border-zinc-800'"
                class="px-6 py-2 font-black text-sm uppercase tracking-widest transition border hover:border-orange-600 shadow-lg">
                Todos
            </button>
            @foreach($categorias as $cat)
                <button 
                    @click="filtro = '{{ $cat->id }}'" 
                    :class="filtro === '{{ $cat->id }}' ? 'bg-orange-600 text-black border-orange-600' : 'bg-zinc-900 text-zinc-400 border-zinc-800'"
                    class="px-6 py-2 font-black text-sm uppercase tracking-widest transition border hover:border-orange-600 hover:text-orange-600">
                    {{ $cat->nombre }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($productos as $producto)
        <div 
            x-show="filtro === 'todos' || filtro === '{{ $producto->id_categoria }}'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="group bg-zinc-900 border border-zinc-800 rounded-2xl shadow-md hover:border-orange-600 transition duration-300 overflow-hidden flex flex-col"
        >
            <div class="relative w-full h-64 bg-zinc-800 overflow-hidden">
                <img 
                    src="{{ $producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png') }}" 
                    class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                >
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                    <button
                        @click="agregar({
                            id: {{ $producto->id }},
                            nombre: @js($producto->nombre),
                            precio: {{ $producto->precio }},
                            imagen: @js($producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png')),
                            numero_tomo: {{ $producto->numero_tomo }}
                        })"
                        class="w-3/4 bg-orange-600 text-white py-2 rounded-lg font-bold text-sm hover:bg-orange-500 transition shadow-lg uppercase"
                    >
                        AGREGAR
                    </button>
                </div>
            </div>

            <div class="p-4 flex flex-col flex-1">
                <h4 class="font-bold text-base sm:text-lg text-white line-clamp-2">
                    {{ $producto->nombre }}
                </h4>
                <p class="text-zinc-500 text-sm italic">
                    Tomo #{{ $producto->numero_tomo }}
                </p>
                <p class="text-orange-500 font-black text-xl mt-2">
                    ${{ number_format($producto->precio, 2) }}
                </p>

                <button
                    @click="agregar({ id: {{ $producto->id }}, nombre: @js($producto->nombre), precio: {{ $producto->precio }}, imagen: @js($producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png')), numero_tomo: {{ $producto->numero_tomo }} })"
                    class="mt-4 w-full bg-orange-600 text-white py-2 rounded-full font-bold text-xs hover:bg-orange-500 transition sm:hidden"
                >
                    AÑADIR AL CARRO
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/carrito.js') }}"></script>
</body>
</html>