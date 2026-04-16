<aside class="w-72 bg-[#0a0a0a] border-r-2 border-zinc-900 flex flex-col shrink-0 relative">
    
    <div class="h-20 flex items-center px-6 border-b-2 border-zinc-900">
        <div class="w-10 h-10 bg-orange-600 flex items-center justify-center mr-3 rotate-3 shadow-[4px_4px_0_rgba(255,255,255,0.1)]">
            <i class="fas fa-book-open text-black text-lg"></i>
        </div>
        <div>
            <h1 class="text-white font-black text-xl tracking-tighter uppercase italic">
                MANGA<span class="text-orange-600">HOUSE</span>
            </h1>
            <div class="h-1 w-full bg-zinc-800 mt-1">
                <div class="h-full bg-orange-600 w-2/3"></div>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto custom-scrollbar py-8 px-4 space-y-2">
        
        <p class="px-4 text-[10px] font-black text-zinc-600 uppercase tracking-[0.4em] mb-4">Principal</p>
        
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 bg-orange-600 text-black font-black italic shadow-[4px_4px_0_rgba(255,255,255,0.1)] group transition-all">
            <i class="fas fa-chart-line w-5 text-center"></i>
            <span class="uppercase tracking-widest text-[11px]">Dashboard</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-white hover:bg-zinc-900 transition-all group border-b border-transparent hover:border-orange-600">
            <i class="fas fa-shopping-cart w-5 text-center group-hover:text-orange-600"></i>
            <span class="font-bold uppercase tracking-widest text-[11px]">Pedidos</span>
        </a>

        <p class="px-4 text-[10px] font-black text-zinc-600 uppercase tracking-[0.4em] mt-10 mb-4">Gestión</p>

        @php
            $links = [
                ['route' => 'categoria.lista', 'icon' => 'fa-tags', 'label' => 'Categorías'],
                ['route' => 'producto.lista', 'icon' => 'fa-book', 'label' => 'Mangas'],
                ['route' => 'editorial.lista', 'icon' => 'fa-newspaper', 'label' => 'Editoriales'],
                ['route' => 'serie.lista', 'icon' => 'fa-layer-group', 'label' => 'Series'],
                ['route' => 'autores.lista', 'icon' => 'fa-user-pen', 'label' => 'Autores'],
            ];
        @endphp

        @foreach($links as $link)
        <a href="{{ route($link['route']) }}" class="flex items-center gap-3 px-4 py-3 text-zinc-500 hover:text-white hover:bg-zinc-900 transition-all group border-b border-transparent hover:border-orange-600">
            <i class="fas {{ $link['icon'] }} w-5 text-center group-hover:text-orange-600"></i>
            <span class="font-bold uppercase tracking-widest text-[11px]">{{ $link['label'] }}</span>
        </a>
        @endforeach

    </nav>

    <div class="p-6 bg-[#050505] border-t-2 border-zinc-900">
        
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 border-2 border-orange-600 p-0.5">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ea580c&color=000" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[11px] font-black text-white truncate uppercase italic">{{ auth()->user()->name }}</p>
                <p class="text-[9px] text-zinc-600 truncate uppercase font-bold tracking-widest">Administrator</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-zinc-900 text-zinc-500 font-black hover:bg-red-600 hover:text-white transition-all uppercase tracking-widest text-[10px] border border-zinc-800">
                <i class="fas fa-power-off"></i>
                <span>Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside>