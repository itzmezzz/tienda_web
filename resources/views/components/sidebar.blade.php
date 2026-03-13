 <!-- Sidebar -->
        <aside class="w-72 bg-admin-sidebar border-r border-slate-700 flex flex-col transition-all duration-300" id="sidebar">
            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-slate-700">
                <div class="w-10 h-10 bg-gradient-to-br from-admin-accent to-pink-600 rounded-xl flex items-center justify-center mr-3 shadow-lg shadow-red-500/20">
                    <i class="fas fa-book-open text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg tracking-tight">MANGA<span class="text-admin-accent">ADMIN</span></h1>
                    <p class="text-xs text-slate-500">Panel de Control</p>
                </div>
            </div>

            <!-- Navigation -->
            <!-- Conversión de .sidebar-link y .sidebar-link.active / :hover -->
            <!-- transition-all duration-300 + hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-6 px-3 space-y-1">
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Principal</p>

                <!-- Enlace activo (clase active aplicada directamente con Tailwind) -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white transition-all duration-300 bg-gradient-to-r from-[rgba(230,57,70,0.15)] to-transparent border-l-[3px] border-admin-accent group">
                    <i class="fas fa-chart-line w-5 text-center text-admin-accent transition-colors"></i>
                    <span class="font-medium">Dashboard</span>
                    <span class="ml-auto bg-admin-accent text-white text-xs px-2 py-0.5 rounded-full">Nuevo</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-shopping-cart w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Pedidos</span>
                    <span class="ml-auto bg-slate-700 text-slate-300 text-xs px-2 py-0.5 rounded-full">24</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-box w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Productos</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-users w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Clientes</span>
                    <span class="ml-auto bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded-full">+12%</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-8 mb-3">Gestión</p>
                <a href="{{ url('/categoria/form') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-tags w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Categorías</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-truck w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Envíos</span>
                </a>
                 <a href="{{ route('producto.lista') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-book w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Mangas</span>
                 </a>
                    
                 <a href="{{ route('editorial.nuevo') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-newspaper w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Añadir Editorial</span>
                    </a>
              <a href="{{ route('serie.nuevo') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-layer-group w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Añadir Serie</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 hover:bg-slate-800 cursor-pointer transition-colors group">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" alt="Admin" class="w-10 h-10 rounded-full border-2 border-admin-accent">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <i class="fas fa-chevron-right text-xs text-slate-500 group-hover:text-white transition-colors"></i>
                </div>
            </div>
        </aside>