<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaHouse</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body x-data="carrito()" class="bg-[#0f0f0f] font-sans bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply">

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

//imagen 1
<div x-data="{ s: 1 }" x-init="setInterval(() => s = s === 3 ? 1 : s + 1, 5000)" class="relative w-full h-[300px] md:h-[450px] bg-black overflow-hidden border-b-4 border-orange-600">
    <div x-show="s === 1" x-transition.opacity.duration.1000ms class="absolute inset-0">
        <img src="https://preview.redd.it/anime-one-piece-3840x2160-v0-cmlfumgg6ao61.jpg?width=1080&crop=smart&auto=webp&s=d7743edf474ccda057447fdee270590e2b5a3582" class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 flex flex-col justify-center px-12 md:px-24 bg-gradient-to-r from-black via-transparent">
            <h2 class="text-orange-600 text-4xl md:text-6xl font-black italic uppercase tracking-tighter">Nuevas Entradas</h2>
            <p class="text-white text-lg mt-2 font-bold uppercase tracking-widest">Lo mejor del Seinen aquí</p>
        </div>
    </div>

    //imagen2
    <div x-show="s === 2" x-transition.opacity.duration.1000ms class="absolute inset-0" style="display:none">
        <img src="https://i.redd.it/5zrjbgpiozug1.jpeg" class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 flex flex-col justify-center px-12 md:px-24 bg-gradient-to-r from-black via-transparent">
            <h2 class="text-orange-600 text-4xl md:text-6xl font-black italic uppercase tracking-tighter">Ofertas de Temporada</h2>
            <p class="text-white text-lg mt-2 font-bold uppercase tracking-widest">Hasta 30% de descuento</p>
        </div>
    </div>

    //imagen3
    <div x-show="s === 3" x-transition.opacity.duration.1000ms class="absolute inset-0" style="display:none">
        <img src="https://preview.redd.it/kana-arima-oshi-no-ko-anime-1920x1080-v0-f53ylsoflnkg1.jpg?width=1080&crop=smart&auto=webp&s=e300d987cabfc76903231b2e3002619b13c8d0c2" class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 flex flex-col justify-center px-12 md:px-24 bg-gradient-to-r from-black via-transparent">
            <h2 class="text-orange-600 text-4xl md:text-6xl font-black italic uppercase tracking-tighter">Coleccionables</h2>
            <p class="text-white text-lg mt-2 font-bold uppercase tracking-widest">Ediciones de lujo disponibles</p>
        </div>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <h3 class="text-2xl sm:text-3xl font-bold mb-10 text-center sm:text-left text-white uppercase tracking-tighter border-l-4 border-orange-600 pl-4">
        Mangas disponibles
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
        <div class="group bg-zinc-900 border border-zinc-800 rounded-2xl shadow-md hover:border-orange-600 transition duration-300 overflow-hidden flex flex-col">

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
                    ${{ $producto->precio }}
                </p>

                <button
                    @click="agregar({
                        id: {{ $producto->id }},
                        nombre: @js($producto->nombre),
                        precio: {{ $producto->precio }},
                        imagen: @js($producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png')),
                        numero_tomo: {{ $producto->numero_tomo }}
                    })"
                    class="mt-auto w-full bg-orange-600 text-white py-2 rounded-full font-bold text-xs sm:text-sm hover:bg-orange-500 transition sm:hidden"
                >
                    AGREGAR AL CARRITO
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script src="{{ asset('js/carrito.js') }}"></script>
<script src="{{ asset('js/live-search.js') }}"></script>
</body>
</html>