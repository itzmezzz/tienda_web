<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Manga | Manga House</title>
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

        /* Estilizar el input de archivo */
        input[type="file"]::file-selector-button {
            background: #18181b;
            color: #ea580c;
            border: 1px solid #27272a;
            padding: 8px 16px;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 10px;
            margin-right: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        input[type="file"]::file-selector-button:hover {
            background: #ea580c;
            color: black;
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
                        <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Storage Terminal</span>
                        <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Añadir <span class="text-orange-600 italic">Nuevo Manga</span>
                        </h1>
                    </div>
                </div>
                
                <a href="{{ route('producto.lista') }}" class="text-[10px] font-black text-zinc-500 uppercase tracking-widest hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Volver al Almacén
                </a>
            </div>

            {{-- CONTENEDOR DEL FORMULARIO --}}
            <div class="bg-black border-2 border-zinc-900 relative p-8 md:p-12 max-w-5xl shadow-2xl">
                {{-- Detalle decorativo --}}
                <div class="absolute top-0 left-0 w-32 h-1 bg-orange-600"></div>
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i class="fas fa-barcode text-6xl text-white"></i>
                </div>

                <form action="{{ route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Nombre --}}
                        <div class="lg:col-span-2">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Título del Volumen</label>
                            <input type="text" name="nombre" required placeholder="EJ. BERSERK VOL. 1"
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold uppercase tracking-widest text-sm transition-all">
                        </div>

                        {{-- Precio --}}
                        <div class="lg:col-span-1">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Precio (MXN)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-orange-600">$</span>
                                <input type="number" step="0.01" name="precio" required placeholder="0.00"
                                    class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 pl-8 text-white font-bold tracking-widest text-sm transition-all">
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="md:col-span-3">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Detalles / Sinopsis Corta</label>
                            <textarea name="descripcion" rows="3" placeholder="BREVE DESCRIPCIÓN DEL ESTADO O CONTENIDO..."
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold uppercase tracking-widest text-sm transition-all resize-none"></textarea>
                        </div>

                        {{-- Stock --}}
                        <div>
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Stock Disponible</label>
                            <input type="number" name="stock" required placeholder="QTY"
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold tracking-widest text-sm transition-all">
                        </div>

                        {{-- Número de Tomo --}}
                        <div>
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Volumen #</label>
                            <input type="number" name="numero_tomo" required placeholder="0"
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold tracking-widest text-sm transition-all">
                        </div>

                        {{-- ISBN --}}
                        <div>
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Código ISBN</label>
                            <input type="text" name="isbn" required placeholder="978-..."
                                class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold uppercase tracking-widest text-sm transition-all">
                        </div>

                        {{-- Selects --}}
                        @php $selects = [
                            ['name' => 'id_autor', 'label' => 'Mangaka / Autor', 'data' => $autor, 'icon' => 'fa-pen-nib'],
                            ['name' => 'id_categoria', 'label' => 'Categoría', 'data' => $categoria, 'icon' => 'fa-tags'],
                            ['name' => 'id_serie', 'label' => 'Serie Perteneciente', 'data' => $serie, 'icon' => 'fa-layer-group'],
                            ['name' => 'id_editorial', 'label' => 'Sello Editorial', 'data' => $editorial, 'icon' => 'fa-building'],
                        ] @endphp

                        @foreach($selects as $sel)
                        <div class="relative">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">{{ $sel['label'] }}</label>
                            <div class="relative">
                                <select name="{{ $sel['name'] }}" required
                                    class="manga-input w-full bg-zinc-900 border border-zinc-800 p-3 text-white font-bold uppercase tracking-widest text-xs appearance-none cursor-pointer transition-all">
                                    <option value="" disabled selected>SELECCIONAR</option>
                                    @foreach($sel['data'] as $fila)
                                        <option value="{{ $fila->id }}" class="bg-zinc-900">{{ $fila->nombre }}</option>
                                    @endforeach
                                </select>
                                <i class="fas {{ $sel['icon'] }} absolute right-4 top-1/2 -translate-y-1/2 text-zinc-700 text-[10px] pointer-events-none"></i>
                            </div>
                        </div>
                        @endforeach

                        {{-- Imagen --}}
                        <div class="md:col-span-2 lg:col-span-2">
                            <label class="text-[10px] font-black text-orange-600 uppercase tracking-widest block mb-2">Arte de Portada (PNG/JPG)</label>
                            <input type="file" name="imagen" required
                                class="w-full bg-zinc-900 border border-zinc-800 p-2 text-zinc-500 font-bold text-xs transition-all">
                        </div>

                    </div>

                    {{-- ACCIONES --}}
                    <div class="mt-12 flex flex-col md:flex-row gap-4 border-t border-zinc-900 pt-8">
                        <button type="submit" 
                            class="bg-orange-600 hover:bg-white text-black font-black px-10 py-4 uppercase tracking-widest text-xs transition-all shadow-[6px_6px_0_rgba(255,255,255,0.1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 flex items-center justify-center gap-3">
                            <i class="fas fa-save"></i> Registrar en Almacén
                        </button>

                        <a href="{{ route('producto.lista') }}" 
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