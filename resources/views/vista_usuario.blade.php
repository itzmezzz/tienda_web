<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaHouse</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data="carrito()" class="bg-slate-100 font-sans bg-[url('/src/manga-bg.png')] bg-fixed bg-cover">

 <header class="bg-black text-white shadow-xl">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <h1 class="text-2xl font-black text-red-600 tracking-tighter">MangaHouse</h1>
        
        <nav class="flex items-center space-x-8">
            

            <div class="flex items-center space-x-6 font-bold text-sm uppercase tracking-widest">
                <form action="/live-search" method="GET" class="hidden md:block">
                <div class="flex items-center bg-gray-900 border border-gray-700 rounded-full overflow-hidden focus-within:ring-2 focus-within:ring-red-500 transition">
                    <input 
                        type="text"
                        name="q"
                        placeholder="Buscar manga..."
                        class=" text-black px-4 py-1.5 w-64 outline-none text-sm"
                    >
                    <button type="submit" class="bg-gray-800 px-4 py-1.5 hover:bg-red-600 transition text-black">
                        🔍
                    </button>
                </div>
            </form>
                <a href="#" class="text-white hover:text-red-500 transition">Inicio</a>
                <a href="#" class="text-white hover:text-red-500 transition">Catálogo</a>
                <a href="#" class="text-white hover:text-red-500 transition">Ofertas</a>
                <x-carrito/>
                <nav>
    @auth
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">Iniciar Sesión</a>
       
    @endguest
</nav>
            </div>

            
        </nav>
    </div>
</header>

 <section class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    
    <h3 class="text-2xl sm:text-3xl font-bold mb-10 text-center sm:text-left text-slate-800">
        Mangas disponibles
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
      @foreach($productos as $producto)
<div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col">

    <div class="relative w-full h-64 bg-gray-100 overflow-hidden">
        
        <img 
            src="{{ $producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png') }}" 
            class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
        >

        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">

            <button
                @click="agregar({
                    id: {{ $producto->id }},
                    nombre: @js($producto->nombre),
                    precio: {{ $producto->precio }},
                    imagen: @js($producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png')),
                    numero_tomo: {{ $producto->numero_tomo }}
                })"
                class="w-3/4 bg-black text-white py-2 rounded-lg font-bold text-sm hover:bg-red-600 transition shadow-lg"
            >
                AGREGAR AL CARRITO
            </button>
        </div>
    </div>

    <div class="p-4 flex flex-col flex-1">
        
        <h4 class="font-bold text-base sm:text-lg text-black line-clamp-2">
            {{ $producto->nombre }}
        </h4>

        <p class="text-gray-500 text-sm">
            Tomo #{{ $producto->numero_tomo }}
        </p>

        <p class="text-red-600 font-bold text-lg mt-2">
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
            class="mt-auto w-full bg-black text-white py-2 rounded-full font-bold text-xs sm:text-sm hover:bg-red-600 transition sm:hidden"
        >
            AGREGAR AL CARRITO
        </button>

    </div>

</div>
@endforeach
    </div>
</section>

    <script src="{{ asset('js/carrito.js') }}"></script>
</body>
</html>