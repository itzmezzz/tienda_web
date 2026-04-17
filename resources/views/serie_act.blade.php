<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Serie | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        /* Efecto de enfoque en inputs */
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

        <div class="flex-1 p-6 md:p-10 flex flex-col">
            
            {{-- ENCABEZADO --}}
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
                    <div>
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Content Management</span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Actualizar <span class="text-orange-600 italic">Serie</span>
                        </h1>
                    </div>
                </div>
                
                <a href="{{ route('serie.lista') }}" class="text-[10px] font-black text-zinc-500 uppercase tracking-widest hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                </a>
            </div>

            {{-- CONTENEDOR DEL FORMULARIO --}}
            <div class="bg-black border-2 border-zinc-900 relative p-8 md:p-12 max-w-4xl shadow-2xl">
                {{-- Detalle superior naranja --}}
                <div class="absolute top-0 left-0 w-32 h-1 bg-orange-600"></div>

                <form action="{{ route('serie.actualizar', $serie->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- Nombre de la Serie --}}
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Nombre de la Obra</label>
                            <input type="text" name="nombre" value="{{ $serie->nombre }}" required placeholder="EJ. MY HERO ACADEMIA"
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm transition-all">
                        </div>

                        {{-- Categoría --}}
                        <div class="md:col-span-1">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Categoría / Demografía</label>
                            <div class="relative">
                                <select name="id_categoria" value="{{ $serie->id_categoria }}"  required
                                    class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm appearance-none cursor-pointer transition-all">
                                    <option value="" disabled selected>SELECCIONAR GÉNERO</option>
                                    @foreach($categorias as $fila)
                                        <option value="{{ $fila->id }}" class="bg-zinc-900" {{ $serie->id_categoria == $fila->id ? 'selected' : '' }}>
                                            {{ $fila->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-orange-600 pointer-events-none text-xs"></i>
                            </div>
                        </div>

                        {{-- Indicador de Sistema --}}
                        <div class="md:col-span-1 text-right flex flex-col justify-end">
                            <span class="text-[9px] font-black text-zinc-600 uppercase italic">Asegúrate de que la categoría coincida con el público objetivo.</span>
                        </div>

                        {{-- Descripción --}}
                        <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] block mb-3">Sinopsis del Manga</label>
                         <textarea name="descripcion" rows="5" placeholder="INGRESA EL RESUMEN DE LA HISTORIA..."
                            class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 text-white font-bold uppercase tracking-widest text-sm transition-all resize-none">{{ old('descripcion', $serie->descripcion) }}</textarea>
                                        @error('descripcion')
                            <span class="text-[9px] text-red-600 font-black uppercase mt-1">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    {{-- ACCIONES --}}
                    <div class="mt-12 flex flex-col md:flex-row gap-4 border-t border-zinc-900 pt-8">
                        <button type="submit" 
                            class="bg-orange-600 hover:bg-white text-black font-black px-10 py-4 uppercase tracking-widest text-xs transition-all shadow-[6px_6px_0_rgba(255,255,255,0.1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 flex items-center justify-center gap-3">
                            <i class="fas fa-save"></i> Guardar Registro
                        </button>

                        <a href="{{ route('serie.lista') }}" 
                            class="border border-zinc-800 hover:border-red-600 hover:text-red-600 px-10 py-4 uppercase tracking-widest text-xs font-black transition-all flex items-center justify-center gap-3">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>