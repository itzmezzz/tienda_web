<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
            
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0a0a0a;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ea580c;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #ffffff;
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
                    <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block"></span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Lista de <span class="text-orange-600 italic">Editoriales</span>
                        </h1>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="text-right border-r border-zinc-800 pr-6">
                        <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest block">Registros</span>
                        <span class="text-2xl font-black text-white leading-none">{{ count($editoriales) }}</span>
                    </div>
                    
                    <a href="{{ route('editorial.nuevo') }}" class="bg-orange-600 hover:bg-white text-black font-black px-6 py-3 uppercase tracking-widest text-[10px] transition-all shadow-[4px_4px_0_rgba(255,255,255,0.1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                        + Nueva Editorial
                    </a>
                </div>
            </div>

            {{-- CONTENEDOR DE TABLA --}}
            <div class="flex-grow bg-black border-2 border-zinc-900 relative overflow-hidden flex flex-col mb-4">
                {{-- Detalle superior --}}
                <div class="absolute top-0 left-0 w-32 h-1 bg-orange-600 z-20"></div>
                
                <div class="overflow-x-auto overflow-y-auto custom-scrollbar flex-grow">
                    <table class="w-full text-left">
                        <thead class="sticky top-0 bg-zinc-900 z-10 shadow-md">
                            <tr>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest">Sello Editorial</th>
                                <th class="p-5 text-[10px] font-black text-orange-600 uppercase tracking-widest text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900">
                            @foreach ($editoriales as $fila)
                            <tr class="hover:bg-zinc-900/40 transition-colors group">
                                <td class="p-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-zinc-900 border border-zinc-800 flex items-center justify-center group-hover:border-orange-600 transition-colors">
                                            <i class="fas fa-building text-zinc-700 group-hover:text-orange-600"></i>
                                        </div>
                                        <p class="text-sm font-black text-white uppercase italic tracking-widest group-hover:text-orange-600 transition-colors">
                                            {{ $fila->nombre }}
                                        </p>
                                    </div>
                                </td>

                                <td class="p-5">
                                    <div class="flex flex-col gap-1 w-20 mx-auto">
                                        <a href="{{ route('editorial.editar', $fila->id) }}" class="bg-zinc-800 hover:bg-white hover:text-black p-2 text-[9px] font-black text-center uppercase transition-all">Editar</a>
                                        <a href="{{ route('editorial.eliminar', $fila->id) }}" onclick="return confirm('¿Eliminar?')" class="border border-red-900/40 text-red-600 hover:bg-red-600 hover:text-white p-2 text-[9px] font-black text-center uppercase transition-all">Borrar</a>
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

</body>
</html>