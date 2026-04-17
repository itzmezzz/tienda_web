<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Editorial | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .manga-input:focus {
            border-color: #ea580c;
            box-shadow: 0 0 10px rgba(234, 88, 12, 0.2);
            outline: none;
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-zinc-300 min-h-screen">

    <div class="flex">
        {{-- SIDEBAR --}}
        @include('components.sidebar')

        <div class="flex-1 p-6 md:p-10 flex flex-col items-center justify-center">
            
            <div class="w-full max-w-md">
                {{-- ENCABEZADO --}}
                <div class="mb-8 flex items-center gap-4">
                    <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Publishing Sytem</span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Nueva <span class="text-orange-600 italic">Editorial</span>
                        </h1>
                    </div>
                </div>

                {{-- CONTENEDOR DEL FORMULARIO --}}
                <div class="bg-black border-2 border-zinc-900 relative p-8 shadow-2xl">
                    {{-- Detalle superior naranja --}}
                    <div class="absolute top-0 left-0 w-24 h-1 bg-orange-600"></div>

                    <form action="{{ route('editorial.guardar') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Nombre del Sello Editorial</label>
                                <div class="relative">
                                    <input type="text" name="nombre" required placeholder="EJ. PANINI MANGA"
                                        class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm transition-all pl-12">
                                    <i class="fas fa-building absolute left-4 top-1/2 -translate-y-1/2 text-zinc-700 text-sm"></i>
                                </div>
                            </div>

                            {{-- ACCIONES --}}
                            <div class="flex flex-col gap-3 pt-4">
                                <button type="submit" 
                                    class="bg-orange-600 hover:bg-white text-black font-black py-4 uppercase tracking-widest text-xs transition-all shadow-[6px_6px_0_rgba(255,255,255,0.1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 flex items-center justify-center gap-3">
                                    <i class="fas fa-check"></i> Registrar Sello
                                </button>

                                <a href="{{ route('editorial.lista') }}" 
                                    class="border border-zinc-800 hover:border-red-600 hover:text-red-600 py-4 uppercase tracking-widest text-xs font-black transition-all flex items-center justify-center gap-3 text-center">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>