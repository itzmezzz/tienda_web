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
            <form action="/buscar" method="GET" class="hidden md:block">
                <div class="flex items-center bg-gray-900 border border-gray-700 rounded-full overflow-hidden focus-within:ring-2 focus-within:ring-red-500 transition">
                    <input 
                        type="text"
                        name="q"
                        placeholder="Buscar manga..."
                        class="bg-transparent text-white px-4 py-1.5 w-64 outline-none text-sm"
                    >
                    <button type="submit" class="bg-gray-800 px-4 py-1.5 hover:bg-red-600 transition text-white">
                        🔍
                    </button>
                </div>
            </form>

            <div class="flex items-center space-x-6 font-bold text-sm uppercase tracking-widest">
                <a href="#" class="text-white hover:text-red-500 transition">Inicio</a>
                <a href="#" class="text-white hover:text-red-500 transition">Catálogo</a>
                <a href="#" class="text-white hover:text-red-500 transition">Ofertas</a>
                <x-carrito/>
            </div>

            
        </nav>
    </div>
</header>

    <section class="max-w-7xl mx-auto px-6 py-10">
        <h3 class="text-2xl font-bold mb-8 text-slate-800">Mangas disponibles</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($productos as $producto)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300 overflow-hidden">
                <img 
                    src="{{ $producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png') }}" 
                    class="w-full h-56 object-cover"
                >

                <div class="p-4"> 
                    <h4 class="font-bold text-lg">{{ $producto->nombre }}</h4>
                    <p class="text-sm text-gray-500">Tomo #{{ $producto->numero_tomo }}</p>
                    <p class="text-red-500 font-bold text-lg mt-2">${{ $producto->precio }}</p>

                    <button
                        @click="agregar({
                            id: {{ $producto->id }},
                            nombre: @js($producto->nombre),
                            precio: {{ $producto->precio }},
                            imagen: @js($producto->imagen ? asset('productos/'.$producto->imagen) : asset('src/placeholder.png')),
                            numero_tomo: {{ $producto->numero_tomo }}
                        })"
                        class="mt-3 w-full bg-black text-white py-2 rounded-lg hover:bg-red-500 transition"
                    >
                        Agregar al carrito
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <script>
    function carrito() {
        return {
            abrir: false,
            carrito: [],

            init() {
                this.obtenerCarrito();
            },

            get total() {
                return this.carrito.reduce(
                    (sum, item) => sum + (Number(item.precio) * item.cantidad),
                    0
                );
            },

            get cantidadTotal() {
                return this.carrito.reduce(
                    (sum, item) => sum + Number(item.cantidad),
                    0
                );
            },

            obtenerCarrito() {
                fetch('/carrito')
                    .then(r => r.json())
                    .then(data => {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    })
                    .catch(err => console.error("Error al obtener carrito:", err));
            },

            agregar(producto) {
                fetch(`/carrito/agregar/${producto.id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(producto)
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                })
                .catch(err => console.error("Error al agregar:", err));
            },

            aumentar(id) {
                fetch(`/carrito/agregar/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            disminuir(id) {
                fetch(`/carrito/eliminar-unidad/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            eliminar(id) {
                fetch(`/carrito/eliminar/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            vaciar() {
                fetch('/carrito/vaciar', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = [];
                    }
                });
            }
        }
    }
    </script>
</body>
</html>