<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dirección de Envío | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#0a0a0a] bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply py-12 px-4 flex items-center justify-center">

    <div class="w-full max-w-2xl">
        <div class="mb-8 flex items-center gap-4">
            <div class="h-12 w-2 bg-orange-600"></div>
            <div>
                <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase block">Configuración</span>
                <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">Información de <span class="text-orange-600">Envío</span></h2>
            </div>
        </div>

       <form action="{{ route('direccion.guardar') }}" method="POST" class="bg-black/90 border-2 border-zinc-900 p-8 shadow-[0_0_30px_rgba(0,0,0,0.5)] relative overflow-hidden">
    @csrf
    <div class="absolute top-0 right-0 w-24 h-1 bg-orange-600"></div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Calle y Número</label>
            <input type="text" name="calle" value="{{ $direccion->calle ?? '' }}" required class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider">
        </div>

        <div>
            <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Código Postal</label>
            <input type="text" name="codigo_postal" value="{{ $direccion->codigo_postal ?? '' }}" required class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider">
        </div>

        <div>
            <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Ciudad</label>
            <input type="text" name="ciudad" value="{{ $direccion->ciudad ?? '' }}" required class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider">
        </div>

        <div>
            <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Estado</label>
            <input type="text" name="estado" value="{{ $direccion->estado ?? '' }}" required class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider">
        </div>

        <div>
            <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">País</label>
            <input type="text" name="pais" value="{{ $direccion->pais ?? '' }}" required class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider">
        </div>
    </div>

    <div class="mt-6">
        <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Referencia</label>
        <textarea name="referencia" rows="3" class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 font-bold uppercase tracking-wider resize-none">{{ $direccion->referencia ?? '' }}</textarea>
    </div>

    <div class="mt-10">
        <button type="submit" class="w-full bg-orange-600 text-black font-black py-4 uppercase tracking-[0.3em] text-sm hover:bg-white transition-all duration-300 shadow-[0_4px_0_rgb(154,52,18)] active:translate-y-1 active:shadow-none">
            Guardar Dirección
        </button>
        
        <a href="{{ url()->previous() }}" class="block text-center mt-6 text-[10px] font-black text-zinc-500 hover:text-white uppercase tracking-widest transition-colors">
            <i class="fas fa-chevron-left mr-2"></i> Volver atrás
        </a>
    </div>
</form>
    </div>

</body>
</html>