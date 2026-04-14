<div 
  x-data="carrito()" 
  x-init="init()" 
  @agregar-al-carrito.window="carrito = Object.values($event.detail)"
  class="relative"
>
  <button @click="abrir = !abrir" 
          class="relative flex items-center justify-center p-2 rounded-full hover:bg-gray-800 transition group outline-none">
          <span class="text-xl">🛒</span>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <template x-if="cantidadTotal > 0">
        <span x-text="cantidadTotal" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-black"></span>
    </template>
  </button>

  <div x-show="abrir" 
       x-transition
       @click.away="abrir = false"
       class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl p-4 z-50 border border-gray-200"
       style="display: none;">

    <h3 class="text-lg font-black border-b border-gray-100 pb-3 mb-4" style="color: #000000 !important;">Tu Pedido</h3>

    <template x-if="carrito.length === 0">
      <p class="text-center py-8" style="color: #666666 !important;">El carrito está vacío</p>
    </template>

    <div class="max-h-80 overflow-y-auto">
      <template x-for="item in carrito" :key="item.id">
        <div class="flex items-center space-x-4 mb-4 pb-4 border-b border-gray-50 last:border-0">
          
          <img :src="item.imagen" class="w-14 h-18 object-cover rounded border border-gray-100">

          <div class="flex-1 min-w-0">
            <h4 x-text="item.nombre" class="font-bold text-sm leading-tight truncate" style="color: #000000 !important;"></h4>
            <p class="text-[10px] font-bold uppercase" style="color: #4b5563 !important;">Tomo #<span x-text="item.numero_tomo"></span></p>
            <p class="font-black text-sm mt-1" style="color: #dc2626 !important;">$<span x-text="Number(item.precio).toFixed(2)"></span></p>

            <div class="flex items-center space-x-2 mt-2">
              <button @click="disminuir(item.id)" class="bg-gray-200 hover:bg-gray-300 px-2 py-0.5 rounded text-xs font-bold" style="color: #000000 !important;">-</button>
              <span x-text="item.cantidad" class="font-bold text-xs w-4 text-center" style="color: #000000 !important;"></span>
              <button @click="aumentar(item.id)" class="bg-gray-200 hover:bg-gray-300 px-2 py-0.5 rounded text-xs font-bold" style="color: #000000 !important;">+</button>
            </div>
          </div>

          <button @click="eliminar(item.id)" class="hover:text-red-600 transition" style="color: #9ca3af !important;">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
             </svg>
          </button>
        </div>
      </template>
    </div>

    <div x-show="carrito.length > 0" class="mt-4 pt-4 border-t-2 border-gray-50">
      <div class="flex justify-between items-center mb-4">
        <span class="font-bold uppercase text-[10px]" style="color: #6b7280 !important;">Total a pagar</span>
        <span class="text-xl font-black" style="color: #000000 !important;">$<span x-text="total.toFixed(2)"></span></span>
      </div>

      <button 
  @click="irAlCheckout()" 
  class="w-full bg-black text-white py-3 rounded-xl font-bold text-sm hover:bg-red-600 transition shadow-lg"
>
  FINALIZAR COMPRA
</button>

      <button @click="vaciar()" class="w-full text-[10px] mt-3 font-bold hover:text-red-600 uppercase tracking-widest" style="color: #9ca3af !important;">
        Vaciar Carrito
      </button>
    </div>
  </div>
</div>