<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido | Manga House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .animate-glow {
            animation: glow 2s infinite alternate;
        }
        @keyframes glow {
            from { box-shadow: 0 0 10px -2px #ea580c; }
            to { box-shadow: 0 0 25px 2px #ea580c; }
        }
    </style>
</head>

<body class="min-h-screen bg-[#0a0a0a] py-12 px-4 text-zinc-300" 
      style="background-image: linear-gradient(rgba(10, 10, 10, 0.8), rgba(10, 10, 10, 0.8)), url('{{ asset('src/manga-bg.png') }}'); background-attachment: fixed; background-size: cover;">

    <div class="max-w-5xl mx-auto">
        
        <form action="{{ route('venta.store') }}" method="POST" id="form-checkout">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Columna Izquierda: Datos --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Bloque 1: Dirección --}}
                    <div class="bg-black/80 p-8 border-2 border-zinc-900 shadow-xl backdrop-blur-sm @isset($venta) opacity-50 pointer-events-none @endisset">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold flex items-center text-white uppercase tracking-wider">
                                <span class="bg-orange-600 text-black w-7 h-7 flex items-center justify-center text-sm mr-3 font-black">1</span>
                                Dirección de Envío
                            </h2>
                            @if(!isset($venta))
                                <a href="{{ url('/direcciones') }}" class="text-sm font-bold text-orange-600 hover:underline uppercase tracking-tighter">Gestionar</a>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            @foreach($direcciones as $dir)
                                <label class="relative flex p-4 border-2 border-zinc-900 bg-zinc-900/20 cursor-pointer hover:border-orange-600 transition has-[:checked]:border-orange-600">
                                    <input type="radio" name="id_direccion" value="{{ $dir->id }}" class="mt-1 accent-orange-600" required 
                                        {{ (isset($venta) && $venta->id_direccion == $dir->id) || $loop->first ? 'checked' : '' }}>
                                    <div class="ml-4">
                                        <span class="block font-black text-white uppercase text-sm tracking-wide">{{ $dir->calle }}</span>
                                        <span class="block text-[11px] text-zinc-500 font-bold uppercase tracking-tight">{{ $dir->ciudad }}, {{ $dir->estado }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bloque 2: Método de Pago / Botones Reales --}}
                    <div class="bg-black/80 p-8 border-2 border-zinc-900 shadow-xl backdrop-blur-sm">
                        <h2 class="text-xl font-bold flex items-center mb-6 text-white uppercase tracking-wider">
                            <span class="bg-orange-600 text-black w-7 h-7 flex items-center justify-center text-sm mr-3 font-black">2</span>
                            @isset($venta) Finalizar Pago @else Método de Pago @endisset
                        </h2>
                        
                        @isset($venta)
                            {{-- MODO PAGO ACTIVO --}}
                            <div class="space-y-4 animate-glow p-4 border border-orange-600/30">
                                <p class="text-center text-xs font-black text-orange-600 uppercase tracking-[0.3em] mb-4">Selecciona tu pasarela</p>
                                
                                {{-- Botón Stripe --}}
                                <a href="{{ route('pago.stripe', $venta->id) }}" 
                                   class="flex items-center justify-center w-full bg-white text-black py-4 font-black uppercase text-lg hover:bg-orange-600 hover:text-white transition-all duration-300 transform active:scale-95 shadow-lg">
                                    <i class="fa-solid fa-credit-card mr-3 text-xl"></i> Pagar con Tarjeta
                                </a>

                                <div class="flex items-center gap-4 py-2">
                                    <div class="h-[1px] bg-zinc-800 flex-1"></div>
                                    <span class="text-[10px] font-black text-zinc-600 uppercase italic">O mediante</span>
                                    <div class="h-[1px] bg-zinc-800 flex-1"></div>
                                </div>

                                {{-- Botón PayPal --}}
                                <div id="paypal-button-container" class="relative z-10"></div>
                            </div>
                        @else
                            {{-- MODO SELECCIÓN INICIAL --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="relative flex p-4 border-2 border-zinc-900 bg-zinc-900/20 cursor-pointer hover:border-orange-600 transition has-[:checked]:border-orange-600">
                                    <input type="radio" name="metodo" value="stripe" class="mt-1 accent-orange-600" checked>
                                    <div class="ml-4 flex items-center gap-3">
                                        <i class="fa-solid fa-credit-card text-orange-600"></i>
                                        <span class="block font-black text-white uppercase text-sm">Tarjeta</span>
                                    </div>
                                </label>

                                <label class="relative flex p-4 border-2 border-zinc-900 bg-zinc-900/20 cursor-pointer hover:border-orange-600 transition has-[:checked]:border-orange-600">
                                    <input type="radio" name="metodo" value="paypal" class="mt-1 accent-orange-600">
                                    <div class="ml-4 flex items-center gap-3">
                                        <i class="fa-brands fa-paypal text-blue-500"></i>
                                        <span class="block font-black text-white uppercase text-sm">PayPal</span>
                                    </div>
                                </label>
                            </div>
                        @endisset
                    </div>
                    <a href="{{ url()->previous() }}" class="block text-center mt-6 text-[10px] font-black text-zinc-500 hover:text-white uppercase tracking-widest transition-colors">
            <i class="fas fa-chevron-left mr-2"></i> Volver atrás
        </a>
                </div>

                {{-- Columna Derecha: Resumen --}}
                <div class="lg:col-span-1">
                    <div class="bg-black border-2 border-orange-600 p-8 shadow-2xl sticky top-6">
                        <h2 class="text-xl font-black mb-6 border-b border-zinc-900 pb-4 text-white uppercase italic tracking-widest">Resumen</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-zinc-500 font-bold text-xs uppercase tracking-widest">
                                <span>Subtotal</span>
                                <span class="text-white">${{ number_format($total, 2) }}</span>
                            </div>
                            @isset($venta)
                                <div class="flex justify-between text-orange-600 font-black text-[10px] uppercase tracking-widest">
                                    <span>Orden ID</span>
                                    <span>#{{ $venta->id }}</span>
                                </div>
                            @endisset
                            <div class="border-t border-zinc-900 pt-4 flex justify-between items-end">
                                <span class="text-lg font-black text-white uppercase italic">Total</span>
                                <span class="text-4xl font-black text-orange-600 italic tracking-tighter">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        @if(!isset($venta))
                            <button type="submit" class="w-full bg-orange-600 hover:bg-white hover:text-black text-black py-4 font-black text-lg transition-all duration-300 shadow-lg uppercase tracking-[0.2em]">
                                CONFIRMAR COMPRA
                            </button>
                        @else
                            <div class="text-center p-2 bg-zinc-900 text-[10px] font-black uppercase text-zinc-500 tracking-tighter">
                                <i class="fa-solid fa-lock mr-2 text-orange-600"></i> Transacción Protegida
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Script PayPal (Solo se carga si existe la venta) --}}
    @isset($venta)
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=MXN"></script>
    <script>
        paypal.Buttons({
            
              createOrder: (data, actions) => {
    return actions.order.create({
        purchase_units: [{
            amount: {
                // Forzamos el formato a 2 decimales con punto decimal
                value: parseFloat('{{ $venta->total }}').toFixed(2)
            }
        }]
    });
},
            onApprove: (data, actions) => {
                return actions.order.capture().then(details => {
                    window.location.href = "{{ route('pago.confirmar', $venta->id) }}?metodo=paypal&id_transaccion=" + details.id;
                });
            }
        }).render('#paypal-button-container');
    </script>
    @endisset

</body>
</html>