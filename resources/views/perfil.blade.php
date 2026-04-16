<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Scrollbar personalizada Manga House */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #000000;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ea580c;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #ffffff;
        }
    </style>
</head>

<body class="min-h-screen bg-[#0a0a0a] py-12 px-4 flex flex-col items-center font-sans text-zinc-300">

    <div class="w-full max-w-6xl">
        
        {{-- CABECERA SIMPLIFICADA --}}
        <div class="mb-12 flex items-center gap-4">
            <div class="h-10 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
            <div>
                <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Mi Perfil</span>
                <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">Historial de <span class="text-orange-600">Compras</span></h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- MIS DIRECCIONES (Compacto) --}}
            <div class="lg:col-span-1">
                <div class="bg-black/90 border-2 border-zinc-900 p-8 shadow-2xl relative">
                    <div class="absolute top-0 right-0 w-20 h-1 bg-orange-600"></div>
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-[11px] font-black text-orange-600 uppercase tracking-widest italic">Mis Direcciones</h3>
                        <a href="{{ route('direccion.index') }}" class="text-white hover:text-orange-600 transition text-sm">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($direcciones as $dir)
                        <div class="bg-zinc-900/40 border border-zinc-800 p-4 group hover:border-orange-600 transition-all">
                            <p class="text-xs font-bold text-white uppercase">{{ $dir->calle }}</p>
                            <p class="text-[10px] text-zinc-500 font-bold mt-1 tracking-wider">{{ $dir->colonia }}, {{ $dir->ciudad }}</p>
                        </div>
                        @empty
                        <p class="text-[10px] text-zinc-700 font-black uppercase text-center py-2">No hay direcciones</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- LISTADO DE PEDIDOS (Solo Pagados + Scroll) --}}
            <div class="lg:col-span-2">
                <div class="bg-black/90 border-2 border-zinc-900 shadow-2xl relative overflow-hidden flex flex-col h-[500px]">
                    <div class="absolute top-0 left-0 w-24 h-1 bg-orange-600 z-20"></div>
                    
                    <div class="p-6 border-b border-zinc-900 bg-black shrink-0">
                        <h3 class="text-[11px] font-black text-zinc-400 uppercase tracking-widest">Mis Mangas Adquiridos</h3>
                    </div>

                    <div class="overflow-y-auto custom-scrollbar flex-grow bg-black/20">
                        <table class="w-full text-left border-collapse">
                            <thead class="sticky top-0 bg-zinc-900 z-10">
                                <tr>
                                    <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Fecha</th>
                                    <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Productos</th>
                                    <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest text-right">Total Pagado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-900">
                                {{-- Filtramos en la vista para mostrar solo 'pagado' --}}
                                @forelse($pedidos->where('estado', 'pagado') as $pedido)
                                <tr class="hover:bg-zinc-900/40 transition-colors">
                                    <td class="p-5">
                                        <span class="text-xs font-black text-white italic tracking-tighter">
                                            {{ $pedido->created_at->format('d M, Y') }}
                                        </span>
                                    </td>
                                    <td class="p-5">
                                        <div class="space-y-1">
                                            @foreach($pedido->detalles as $det)
                                            <div class="flex items-center gap-2">
                                                <div class="h-1 w-1 bg-orange-600"></div>
                                                <span class="text-xs font-bold text-zinc-300 uppercase">{{ $det->producto->nombre }}</span>
                                                <span class="text-[10px] text-orange-600 font-black">x{{ $det->cantidad }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="p-5 text-right">
                                        <span class="text-sm font-black text-white tracking-tighter">
                                            ${{ number_format($pedido->total, 2) }}
                                        </span>
                                        <span class="block text-[8px] text-green-500 font-black uppercase">Confirmado</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="p-20 text-center">
                                        <p class="text-[10px] font-black text-zinc-700 uppercase tracking-[0.3em]">Aún no tienes compras confirmadas</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('tienda') }}" class="text-[10px] font-black text-zinc-600 hover:text-white uppercase tracking-[0.4em] transition-all">
                        ← Regresar a la Tienda
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>