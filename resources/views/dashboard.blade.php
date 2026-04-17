<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Manga House Terminal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #0a0a0a; color: #d4d4d8; }
        
        .manga-card {
            background: #000000;
            border: 2px solid #18181b;
            position: relative;
            box-shadow: 10px 10px 0px rgba(0,0,0,1);
        }
        .manga-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 40px; height: 2px;
            background: #ea580c;
        }
        .stat-value { text-shadow: 0 0 10px rgba(234, 88, 12, 0.4); }
    </style>
</head>

<body class="min-h-screen">

    <div class="flex">
        {{-- SIDEBAR --}}
        @include('components.sidebar')

        <main class="flex-1 p-6 md:p-10 space-y-8">
            
            {{-- ENCABEZADO DE SISTEMA --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-zinc-900 pb-6">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block"></span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Panel de <span class="text-orange-600 italic">Control</span>
                        </h1>
                    </div>
                </div>
            </div>

            {{-- GRID DE ESTADÍSTICAS REALES --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Total Productos --}}
                <div class="manga-card p-6 border-2 border-zinc-900 transition-transform hover:-translate-y-1">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-1">Títulos en Catálogo</span>
                    <span class="text-3xl font-black text-white italic stat-value">{{ $totalProductos }}</span>
                    <i class="fas fa-book-open absolute bottom-4 right-4 text-zinc-900 text-2xl"></i>
                </div>

                {{-- Stock Total --}}
                <div class="manga-card p-6 border-2 border-zinc-900 transition-transform hover:-translate-y-1">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-1">Volúmenes Totales</span>
                    <span class="text-3xl font-black text-white italic stat-value">{{ $totalStock }}</span>
                    <i class="fas fa-layer-group absolute bottom-4 right-4 text-zinc-900 text-2xl"></i>
                </div>

                {{-- Stock Bajo --}}
                <div class="manga-card p-6 border-2 {{ $stockBajo > 0 ? 'border-orange-900' : 'border-zinc-900' }} transition-transform hover:-translate-y-1">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-1">Alertas de Stock</span>
                    <span class="text-3xl font-black {{ $stockBajo > 0 ? 'text-orange-600' : 'text-white' }} italic stat-value">{{ $stockBajo }}</span>
                    <i class="fas fa-exclamation-triangle absolute bottom-4 right-4 {{ $stockBajo > 0 ? 'text-orange-900' : 'text-zinc-900' }} text-2xl"></i>
                </div>

                {{-- Categorías --}}
                <div class="manga-card p-6 border-2 border-zinc-900 transition-transform hover:-translate-y-1">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block mb-1">Géneros / Demografías</span>
                    <span class="text-3xl font-black text-white italic stat-value">{{ $totalCategorias }}</span>
                    <i class="fas fa-tags absolute bottom-4 right-4 text-zinc-900 text-2xl"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- TABLA DE REGISTROS RECIENTES --}}
                <div class="lg:col-span-2 manga-card overflow-hidden flex flex-col">
                    <div class="p-5 border-b border-zinc-900 flex justify-between items-center bg-zinc-950/50">
                        <h2 class="text-xs font-black text-white uppercase italic tracking-widest">Últimas Entradas</h2>
                        <a href="{{ route('producto.lista') }}" class="text-[11px] font-black text-orange-600 uppercase">Administrar Almacén <i class="fas fa-chevron-right ml-1"></i></a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-zinc-900/50 border-b border-zinc-900">
                                    <th class="p-4 text-[9px] font-black text-orange-600 uppercase tracking-widest">Manga</th>
                                    <th class="p-4 text-[9px] font-black text-orange-600 uppercase tracking-widest text-center">Categoría</th>
                                    <th class="p-4 text-[9px] font-black text-orange-600 uppercase tracking-widest text-right">Precio</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-900/30">
                                @forelse($recientes as $item)
                                <tr class="hover:bg-zinc-900/20 transition-colors group">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-12 bg-zinc-900 border border-zinc-800 overflow-hidden shrink-0">
                                                <img src="{{ $item->imagen ? asset('productos/'.$item->imagen) : 'https://via.placeholder.com/150' }}" 
                                             class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="text-[12px] font-black text-white uppercase italic leading-none">{{ $item->nombre }}</p>
                                                <p class="text-[10px] text-zinc-600 font-bold mt-1 uppercase">Tomo #{{ $item->numero_tomo }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="px-2 py-1 text-[9px] font-black uppercase bg-zinc-900 text-zinc-400 border border-zinc-800">{{ $item->categoria->nombre }}</span>
                                    </td>
                                    <td class="p-4 text-right text-xs font-black text-white italic">${{ number_format($item->precio, 2) }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="p-10 text-center font-black uppercase text-zinc-800 tracking-widest text-xs italic">Terminal vacía - Sin datos</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TOP PRODUCTOS (VALOR) --}}
                <div class="manga-card flex flex-col h-fit">
                    <div class="p-5 border-b border-zinc-900 bg-zinc-950/50">
                        <h2 class="text-xs font-black text-white uppercase italic tracking-widest">Destacados</h2>
                    </div>
                    <div class="p-5 space-y-6">
                        @foreach($topMangas as $top)
                        <div class="flex items-center gap-4 group">
                                     <div class="w-12 h-16 bg-zinc-900 border border-zinc-800 shrink-0 overflow-hidden">
                                                        <img src="{{ $top->imagen ? asset('productos/'.$top->imagen) : 'https://via.placeholder.com/150' }}" 
                                                     class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                                            </div>
                                            <div class="flex-grow">
                                                <p class="text-[12px] font-black text-white uppercase italic leading-tight">{{ $top->nombre }}</p>
                                                <p class="text-[10px] font-bold text-orange-600 uppercase">{{ $top->isbn }}</p>
                                            </div>
                            <div class="text-right">
                                <p class="text-[12px] font-black text-white italic">${{ $top->precio }}</p>
                                <p class="text-[9px] font-bold text-zinc-600 uppercase">Stock: {{ $top->stock }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- BARRA DE DISTRIBUCIÓN POR CATEGORÍA --}}
            <div class="manga-card p-8">
                <h2 class="text-xs font-black text-white uppercase italic mb-8 tracking-[0.2em] text-center">Análisis de Distribución por Género</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-6">
                    @foreach($categoriasStats as $cat)
                    <div>
                        <div class="flex justify-between text-[10px] font-black uppercase mb-2">
                            <span class="text-zinc-400">{{ $cat->nombre }}</span>
                            <span class="text-orange-600">{{ $cat->productos_count }} Obras</span>
                        </div>
                        <div class="w-full h-1.5 bg-zinc-900 overflow-hidden">
                            @php 
                                $porcentaje = $totalProductos > 0 ? ($cat->productos_count / $totalProductos) * 100 : 0;
                            @endphp
                            <div class="h-full bg-orange-600 shadow-[0_0_10px_#ea580c]" style="width: {{ $porcentaje }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </main>
    </div>

</body>
</html>