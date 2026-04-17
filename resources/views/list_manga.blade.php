<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
       
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;   
            height: 8px;  
            display: block;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0a0a0a;
            border-left: 1px solid #18181b;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ea580c; 
            border-radius: 0px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #ffffff;
        }
        /* Para Firefox */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #ea580c #0a0a0a;
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-zinc-300 min-h-screen overflow-hidden">

    <div class="flex h-screen">
        {{-- SIDEBAR --}}
        @include('components.sidebar')

        <div class="flex-1 p-6 md:p-10 flex flex-col h-full">
            
            {{-- ENCABEZADO --}}
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-2 bg-orange-600"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Admin Panel</span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Inventario <span class="text-orange-600 italic">Manga House</span>
                        </h1>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    {{-- TOTAL DE MANGAS --}}
                    <div class="text-right">
                        <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block">Total Títulos</span>
                        <span class="text-2xl font-black text-white leading-none">{{ count($productos) }}</span>
                    </div>
                    
                    <a href="{{ route('producto.nuevo') }}" class="bg-orange-600 hover:bg-white text-black font-black px-6 py-3 uppercase tracking-widest text-[10px] transition-all shadow-[4px_4px_0_rgba(255,255,255,0.1)]">
                        + Agregar Manga
                    </a>
                </div>
            </div>

            {{-- BUSCADOR --}}
            <div class="mb-6 shrink-0">
                <form action="{{ route('producto.buscar') }}" method="GET" class="flex max-w-md">
                    <div class="relative w-full">
                        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="BUSCAR POR NOMBRE, AUTOR O ISBN..." 
                               class="w-full bg-zinc-900 border-2 border-zinc-800 p-3 pl-10 text-[10px] font-bold text-white focus:border-orange-600 outline-none uppercase tracking-widest">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-zinc-600 text-xs"></i>
                    </div>
                </form>
            </div>

            {{-- CONTENEDOR PRINCIPAL CON SCROLL FORZADO --}}
            <div class="flex-grow bg-black border-2 border-zinc-900 relative overflow-hidden flex flex-col mb-4">
                <div class="absolute top-0 left-0 w-32 h-1 bg-orange-600 z-20"></div>
                
                {{-- SCROLL AREA --}}
                <div class="overflow-x-auto overflow-y-auto custom-scrollbar flex-grow">
                    <table class="w-full text-left min-w-[1200px]"> {{-- min-w fuerza el scroll horizontal --}}
                        <thead class="sticky top-0 bg-zinc-900 z-10 shadow-md">
                            <tr>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Portada</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Información</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest text-center">Stock</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Detalles</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Precio</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900">
                            @foreach($productos as $fila)
                            <tr class="hover:bg-zinc-900/30 transition-colors group">
                                <td class="p-5">
                                    <div class="w-14 h-20 border border-zinc-800 overflow-hidden bg-zinc-900 group-hover:border-orange-600 transition-colors">
                                        <img src="{{ $fila->imagen ? asset('productos/'.$fila->imagen) : 'https://via.placeholder.com/150' }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-5">
                                    <p class="text-sm font-black text-white uppercase italic leading-none">{{ $fila->nombre }}</p>
                                    <p class="text-[10px] text-zinc-500 font-bold uppercase mt-1 tracking-tighter">{{ $fila->autor->nombre ?? 'N/A' }}</p>
                                    <span class="inline-block mt-2 text-[8px] bg-orange-600/10 text-orange-600 px-2 py-0.5 font-black uppercase tracking-widest">
                                        {{ $fila->editorial->nombre ?? 'S/E' }}
                                    </span>
                                </td>
                                <td class="p-5 text-center">
                                    <div class="inline-block">
                                        <p class="text-lg font-black {{ $fila->stock <= 3 ? 'text-red-500' : 'text-white' }} leading-none">
                                            {{ $fila->stock }}
                                        </p>
                                        <p class="text-[8px] font-black text-zinc-600 uppercase">Unidades</p>
                                    </div>
                                </td>
                                <td class="p-5">
                                    <div class="text-[9px] font-bold space-y-1 uppercase tracking-tight">
                                        <p class="text-zinc-500">Tomo: <span class="text-zinc-300">#{{ $fila->numero_tomo }}</span></p>
                                        <p class="text-zinc-500">ISBN: <span class="text-zinc-300">{{ $fila->isbn }}</span></p>
                                        <p class="text-zinc-500 text-[8px] italic text-orange-700">{{ $fila->serie->nombre ?? 'Serie única' }}</p>
                                    </div>
                                </td>
                                <td class="p-5">
                                    <span class="text-sm font-black text-white italic tracking-tighter">
                                        ${{ number_format($fila->precio, 2) }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <div class="flex flex-col gap-1 w-20 mx-auto">
                                        <a href="{{ route('producto.editar', $fila->id) }}" class="bg-zinc-800 hover:bg-white hover:text-black p-2 text-[9px] font-black text-center uppercase transition-all">Editar</a>
                                        <a href="{{ route('producto.eliminar', $fila->id) }}" onclick="return confirm('¿Eliminar?')" class="border border-red-900/40 text-red-600 hover:bg-red-600 hover:text-white p-2 text-[9px] font-black text-center uppercase transition-all">Borrar</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </div>

    <script src="{{ asset('js/live-search.js') }}"></script>
</body>
</html>