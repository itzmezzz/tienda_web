<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos | Manga House Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

       
        ::-webkit-scrollbar {
            width: 8px;   
            height: 8px;   
        }
        ::-webkit-scrollbar-track {
            background: #0a0a0a;
            border-left: 1px solid #18181b;
        }
        ::-webkit-scrollbar-thumb {
            background: #ea580c; 
            border-radius: 0px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ffffff;
        }

        
        * {
            scrollbar-width: thin;
            scrollbar-color: #ea580c #0a0a0a;
            font-family: 'Inter', sans-serif;
        }

        .manga-border-glow {
            box-shadow: 0 0 20px rgba(234, 88, 12, 0.1);
        }
    </style>
</head>
<body class="bg-[#0a0a0a] text-zinc-300 min-h-screen"> 

    <div class="flex min-h-screen">
        
    
        @include('components.sidebar')

       
        <main class="flex-1 p-6 lg:p-12">
            
            {{-- HEADER DE LA SECCIÓN --}}
            <header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-2 bg-orange-600 shadow-[0_0_20px_rgba(234,88,12,0.5)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-600 tracking-[0.5em] uppercase block mb-1">Logística de Ventas</span>
                        <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">
                            Panel de <span class="text-orange-600">Pedidos</span>
                        </h1>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="bg-zinc-900/50 border border-zinc-800 p-4 rounded-sm">
                        <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest">Total Pedidos</p>
                        <p class="text-xl font-black text-white italic">{{ $pedidos->count() }}</p>
                    </div>
                </div>
            </header>

            {{-- MENSAJES DE ESTADO --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-orange-600 text-black font-black uppercase text-xs tracking-widest italic flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLA DE DATOS --}}
            <section class="bg-black border-2 border-zinc-900 relative shadow-2xl manga-border-glow">
                <div class="absolute top-0 right-0 w-40 h-1 bg-orange-600"></div>

                {{-- El contenedor de la tabla debe tener overflow-x-auto para el scroll horizontal --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-950/80 text-[10px] font-black text-zinc-500 uppercase tracking-[0.2em] border-b border-zinc-900">
                                <th class="p-6">Referencia / Fecha</th>
                                <th class="p-6">Cliente</th>
                                <th class="p-6">Manga(s) / Cantidad</th>
                                <th class="p-6">Total</th>
                                <th class="p-6 text-center">Estado de Pago</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900">
                            @forelse($pedidos as $pedido)
                            <tr class="hover:bg-zinc-900/40 transition-all group">
                                <td class="p-6">
                                    <span class="text-white font-black italic block text-base mb-1">#ORDER-{{ $pedido->id }}</span>
                                    <span class="text-[10px] text-zinc-600 font-bold uppercase tracking-tighter">
                                        <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($pedido->fecha)->format('d M, Y') }}
                                    </span>
                                </td>

                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-orange-600 text-black flex items-center justify-center font-black text-sm italic shadow-[4px_4px_0_rgba(234,88,12,0.2)]">
                                            {{ substr($pedido->usuario->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-black text-white uppercase leading-none mb-1">{{ $pedido->usuario->name }}</p>
                                            <p class="text-[10px] text-zinc-500 font-medium tracking-tight">{{ $pedido->usuario->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-6">
                                    <div class="space-y-2">
                                        @foreach($pedido->detalles as $detalle)
                                            <div class="flex items-center gap-2">
                                                <span class="bg-zinc-800 text-orange-600 text-[9px] font-black px-1.5 py-0.5 rounded-sm">
                                                    {{ $detalle->cantidad }}X
                                                </span>
                                                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wide">
                                                    {{ $detalle->producto->nombre }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="p-6 text-white font-black italic">
                                    ${{ number_format($pedido->total, 2) }}
                                </td>

                                <td class="p-6 text-center">
                                    @if($pedido->estado == 'pagado')
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-500/10 border border-green-500/20 text-green-500 text-[10px] font-black uppercase tracking-widest rounded-sm italic">
                                            <i class="fas fa-check-circle text-[8px]"></i> Pagado
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-500/10 border border-orange-500/20 text-orange-500 text-[10px] font-black uppercase tracking-widest rounded-sm italic">
                                            <i class="fas fa-clock text-[8px]"></i> Pendiente
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <i class="fas fa-box-open text-4xl text-zinc-800 mb-4 block"></i>
                                    <p class="text-xs font-black text-zinc-600 uppercase tracking-[0.3em]">No hay pedidos registrados</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="mt-8">
                {{ $pedidos->links() }}
            </div>
        </main>
    </div>
</body>
</html>