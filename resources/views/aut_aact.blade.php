<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Mangaka | Manga House</title>
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
            
            <div class="w-full max-w-2xl">
                {{-- ENCABEZADO --}}
                <div class="mb-8 flex items-center gap-4">
                    <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Creator Registry</span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Actualizar <span class="text-orange-600 italic">Mangaka</span>
                        </h1>
                    </div>
                </div>

                {{-- CONTENEDOR DEL FORMULARIO --}}
                <div class="bg-black border-2 border-zinc-900 relative p-8 md:p-10 shadow-2xl">
                    {{-- Detalle superior naranja --}}
                    <div class="absolute top-0 left-0 w-32 h-1 bg-orange-600"></div>

                    <form action="{{ route('autores.actualizar', $autores->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-8">
                            
                            {{-- Nombre del Autor --}}
                            <div>
                                <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Nombre Completo</label>
                                <div class="relative">
                                    <input type="text" name="nombre" value="{{ $autores->nombre }}" required placeholder="EJ. KENTARO MIURA"
                                        class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm transition-all pl-12">
                                    <i class="fas fa-pen-nib absolute left-4 top-1/2 -translate-y-1/2 text-zinc-700 text-sm"></i>
                                </div>
                            </div>

                            {{-- Nacionalidad --}}
                            <div>
                                <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Nacionalidad / Origen</label>
                                <div class="relative">
                                    <input type="text" name="nacionalidad" value="{{ $autores->nacionalidad }}" required placeholder="EJ. JAPONESA"
                                        class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm transition-all pl-12">
                                    <i class="fas fa-globe-asia absolute left-4 top-1/2 -translate-y-1/2 text-zinc-700 text-sm"></i>
                                </div>
                            </div>

                            {{-- ACCIONES --}}
                            <div class="flex flex-col md:flex-row gap-4 pt-6">
                                <button type="submit" 
                                    class="flex-1 bg-orange-600 hover:bg-white text-black font-black py-4 uppercase tracking-widest text-xs transition-all shadow-[6px_6px_0_rgba(255,255,255,0.1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 flex items-center justify-center gap-3">
                                    <i class="fas fa-save"></i> Guardar Autor
                                </button>

                                <a href="{{ route('autores.lista') }}" 
                                    class="flex-1 border border-zinc-800 hover:border-red-600 hover:text-red-600 py-4 uppercase tracking-widest text-xs font-black transition-all flex items-center justify-center gap-3 text-center">
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