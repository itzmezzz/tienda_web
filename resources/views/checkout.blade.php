<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4">
        
        <div class="flex items-center space-x-4 mb-10">
            <a href="/" class="text-gray-400 hover:text-black transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-4xl font-black tracking-tighter uppercase italic">Finalizar Pedido</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <form action="{{ route('venta.store') }}" method="POST" id="form-checkout">
                    @csrf
                    
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold flex items-center">
                                <span class="bg-red-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-sm mr-3">1</span>
                                Dirección de Envío
                            </h2>
                            <a href="{{ url('/direcciones') }}" class="text-sm font-bold text-red-600 hover:underline">Gestionar</a>
                        </div>

                        @if($direcciones->isEmpty())
                            <div class="p-4 bg-red-50 border border-red-100 rounded-xl">
                                <p class="text-red-700 text-sm">No tienes direcciones registradas.</p>
                                <a href="{{ url('/direcciones') }}" class="font-bold text-red-600 underline">Agregar una ahora</a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($direcciones as $dir)
                                    <label class="relative flex p-4 border rounded-2xl cursor-pointer hover:bg-gray-50 transition focus-within:ring-2 focus-within:ring-red-500">
                                        <input type="radio" name="id_direccion" value="{{ $dir->id }}" class="mt-1 text-red-600" required {{ $loop->first ? 'checked' : '' }}>
                                        <div class="ml-4">
                                            <span class="block font-bold text-gray-900">{{ $dir->calle }}</span>
                                            <span class="block text-sm text-gray-500">{{ $dir->ciudad }}, {{ $dir->estado }} - CP {{ $dir->codigo_postal }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mt-6">
                        <h2 class="text-xl font-bold flex items-center mb-6">
                            <span class="bg-gray-200 text-gray-700 w-7 h-7 rounded-full flex items-center justify-center text-sm mr-3">2</span>
                            Método de Pago
                        </h2>
                        <p class="text-sm text-gray-500 italic">Serás redirigido a la pasarela segura después de confirmar tu pedido.</p>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-black text-white p-8 rounded-3xl shadow-2xl sticky top-6">
                    <h2 class="text-xl font-bold mb-6 border-b border-gray-800 pb-4">Resumen</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Envío</span>
                            <span class="text-green-400 font-bold">GRATIS</span>
                        </div>
                        <div class="border-t border-gray-800 pt-4 flex justify-between items-end">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-3xl font-black text-red-500">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" form="form-checkout" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black text-lg transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-red-900/20">
                        CONFIRMAR COMPRA
                    </button>

                    <p class="text-[10px] text-gray-500 text-center mt-6 uppercase tracking-widest leading-relaxed">
                        Al confirmar, aceptas los términos y condiciones de MangaHouse.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>