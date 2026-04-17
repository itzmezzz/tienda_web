<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dirección de Envío | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Estilo para los inputs enfocados */
        .manga-input:focus {
            border-color: #ea580c;
            box-shadow: 0 0 15px rgba(234, 88, 12, 0.3);
            outline: none;
        }
    </style>
</head>

<body class="min-h-screen bg-[#0a0a0a] bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply py-12 px-4 flex items-center justify-center">

    <div class="w-full max-w-2xl">
        {{-- ENCABEZADO --}}
        <div class="mb-8 flex items-center gap-4">
            <div class="h-12 w-2 bg-orange-600 shadow-[0_0_15px_rgba(234,88,12,0.4)]"></div>
            <div>
                <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Configuración</span>
                <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">Información de <span class="text-orange-600">Envío</span></h2>
            </div>
        </div>

        {{-- ALERTAS DE SISTEMA --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-orange-600 text-black font-black uppercase text-xs tracking-widest italic flex items-center gap-3">
                <i class="fas fa-check-circle text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-600/20 border border-red-600 text-red-500 font-bold uppercase text-[10px] tracking-widest">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORMULARIO --}}
        <form action="{{ route('direccion.actualizar', $direccion->id) }}" method="POST" 
              class="bg-black/90 border-2 border-zinc-900 p-8 shadow-[0_0_40px_rgba(0,0,0,0.7)] relative overflow-hidden">
            @csrf
            @method('PUT')
            
            {{-- Detalle estético superior --}}
            <div class="absolute top-0 right-0 w-24 h-1 bg-orange-600"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Calle --}}
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Calle y Número</label>
                    <input type="text" name="calle" value="{{ old('calle', $direccion->calle) }}" required 
                           class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider transition-all">
                </div>

                {{-- CP --}}
                <div>
                    <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Código Postal</label>
                    <input type="text" name="codigo_postal" value="{{ old('codigo_postal', $direccion->codigo_postal) }}" required 
                           class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider transition-all">
                </div>

                {{-- Ciudad --}}
                <div>
                    <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Ciudad</label>
                    <input type="text" name="ciudad" value="{{ old('ciudad', $direccion->ciudad) }}" required 
                           class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider transition-all">
                </div>

                {{-- Estado --}}
                <div>
                    <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Estado / Provincia</label>
                    <input type="text" name="estado" value="{{ old('estado', $direccion->estado) }}" required 
                           class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider transition-all">
                </div>

                {{-- País --}}
                <div>
                    <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">País</label>
                    <input type="text" name="pais" value="{{ old('pais', $direccion->pais) }}" required 
                           class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider transition-all">
                </div>
            </div>

            {{-- Referencia --}}
            <div class="mt-6">
                <label class="block text-[11px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Referencia Visual / Notas</label>
                <textarea name="referencia" rows="3" placeholder="EJ. PORTÓN NEGRO, CERCA DE LA TIENDA..."
                          class="manga-input w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm font-bold uppercase tracking-wider resize-none transition-all">{{ old('referencia', $direccion->referencia) }}</textarea>
            </div>

            {{-- BOTÓN DE ACCIÓN --}}
            <div class="mt-10">
                <button type="submit" 
                        class="w-full bg-orange-600 text-black font-black py-4 uppercase tracking-[0.3em] text-sm hover:bg-white transition-all duration-300 shadow-[0_5px_0_rgb(154,52,18)] active:translate-y-1 active:shadow-none flex items-center justify-center gap-3">
                    <i class="fas fa-save"></i> Actualizar Dirección
                </button>
                
                <a href="{{ url()->previous() }}" 
                   class="block text-center mt-6 text-[10px] font-black text-zinc-500 hover:text-white uppercase tracking-widest transition-colors italic">
                    <i class="fas fa-chevron-left mr-2 text-[8px]"></i> Cancelar y volver
                </a>
            </div>
        </form>

    </div>

</body>
</html>