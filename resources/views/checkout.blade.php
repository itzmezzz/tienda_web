<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#0a0a0a] bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply py-12 px-4">

    <div class="max-w-5xl mx-auto">
        
        <div class="flex items-center space-x-4 mb-10">
            <a href="/" class="text-zinc-500 hover:text-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-4xl font-black tracking-tighter uppercase italic text-white">Finalizar <span class="text-orange-600">Pedido</span></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <form action="{{ route('venta.store') }}" method="POST" id="form-checkout">
                    @csrf
                    
                    <div class="bg-black/80 p-8 border-2 border-zinc-900 shadow-xl backdrop-blur-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold flex items-center text-white uppercase tracking-wider">
                                <span class="bg-orange-600 text-black w-7 h-7 flex items-center justify-center text-sm mr-3 font-black">1</span>
                                Dirección de Envío
                            </h2>
                            <a href="{{ url('/direcciones') }}" class="text-sm font-bold text-orange-600 hover:underline uppercase tracking-tighter">Gestionar</a>
                        </div>

                        @if($direcciones->isEmpty())
                            <div class="p-4 bg-orange-900/10 border border-orange-900/50">
                                <p class="text-orange-500 text-sm font-bold">No tienes direcciones registradas.</p>
                                <a href="{{ url('/direcciones') }}" class="font-bold text-orange-600 underline uppercase text-xs">Agregar una ahora</a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($direcciones as $dir)
                                    <label class="relative flex p-4 border-2 border-zinc-900 bg-zinc-900/20 cursor-pointer hover:border-orange-600 transition focus-within:ring-1 focus-within:ring-orange-600">
                                        <input type="radio" name="id_direccion" value="{{ $dir->id }}" class="mt-1 accent-orange-600" required {{ $loop->first ? 'checked' : '' }}>
                                        <div class="ml-4">
                                            <span class="block font-black text-white uppercase text-sm tracking-wide">{{ $dir->calle }}</span>
                                            <span class="block text-[11px] text-zinc-500 font-bold uppercase tracking-tight">{{ $dir->ciudad }}, {{ $dir->estado }} - CP {{ $dir->codigo_postal }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="bg-black/80 p-8 border-2 border-zinc-900 shadow-xl backdrop-blur-sm mt-6">
                        <h2 class="text-xl font-bold flex items-center mb-6 text-white uppercase tracking-wider">
                            <span class="bg-zinc-800 text-zinc-500 w-7 h-7 flex items-center justify-center text-sm mr-3 font-black">2</span>
                            Método de Pago
                        </h2>
                        <p class="text-xs text-zinc-500 italic uppercase tracking-tighter font-bold">Serás redirigido a la pasarela segura después de confirmar tu pedido.</p>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-black border-2 border-orange-600 p-8 shadow-2xl sticky top-6">
                    <h2 class="text-xl font-black mb-6 border-b border-zinc-900 pb-4 text-white uppercase italic tracking-widest">Resumen</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-zinc-500 font-bold text-xs uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-500 font-bold text-xs uppercase tracking-widest">
                            <span>Envío</span>
                            <span class="text-green-500 font-black">GRATIS</span>
                        </div>
                        <div class="border-t border-zinc-900 pt-4 flex justify-between items-end">
                            <span class="text-lg font-black text-white uppercase italic">Total</span>
                            <span class="text-4xl font-black text-orange-600 italic tracking-tighter">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" form="form-checkout" class="w-full bg-orange-600 hover:bg-white hover:text-black text-black py-4 font-black text-lg transition-all duration-300 shadow-lg uppercase tracking-[0.2em] active:scale-95">
                        CONFIRMAR COMPRA
                    </button>

                    <p class="text-[9px] text-zinc-600 text-center mt-6 uppercase font-black tracking-[0.1em] leading-relaxed">
                        Al confirmar, aceptas los términos y condiciones de MangaHouse.
                    </p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>