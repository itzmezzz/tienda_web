<aside>
<nav class="flex-1 overflow-y-auto custom-scrollbar py-6 px-3 space-y-1">

<p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Principal</p>

<a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white transition-all duration-300 bg-gradient-to-r from-[rgba(230,57,70,0.15)] to-transparent border-l-[3px] border-admin-accent group">
    <i class="fas fa-chart-line w-5 text-center text-admin-accent"></i>
    <span class="font-medium">Dashboard</span>
</a>

<a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-shopping-cart w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Pedidos</span>
</a>

<p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-8 mb-3">Gestión</p>

<a href="{{ route('categoria.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-tags w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Categorías</span>
</a>

<a href="{{ route('producto.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-book w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Mangas</span>
</a>

<a href="{{ route('editorial.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-newspaper w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Editoriales</span>
</a>

<a href="{{ route('serie.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-layer-group w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Series</span>
</a>

<a href="{{ route('autores.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
    <i class="fas fa-user-pen w-5 text-center group-hover:text-admin-accent"></i>
    <span class="font-medium">Autores</span>
</a>

</nav>
 <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 hover:bg-slate-800 cursor-pointer transition-colors group">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" alt="Admin" class="w-10 h-10 rounded-full border-2 border-admin-accent">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div><br>
    <div class="bg-slate-800/50 rounded-xl p-3 border border-slate-700 hover:border-red-500/40 transition-all">
        
        <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-3 text-red-400 hover:text-white transition-colors group">
            @csrf
            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/10 group-hover:bg-red-500 transition-all">
                <i class="fas fa-right-from-bracket"></i>
            </div>

            <div class="flex-1 min-w-0">
                <button type="submit">
                    <p class="text-sm font-medium">Cerrar sesión</p>
                </button>
                <p class="text-xs text-slate-500 group-hover:text-slate-300">Salir del sistema</p>
            </div>

        </form>

    </div>
</div>
            </aside>