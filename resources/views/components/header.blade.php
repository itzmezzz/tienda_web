<main class="flex-1 flex flex-col overflow-hidden relative">

            <!-- Top Header -->
            <!-- .glass-panel → bg-admin-sidebar/70 backdrop-blur-xl border border-white/5 -->
            <header class="h-16 bg-admin-sidebar/70 backdrop-blur-xl border-b border-white/5 flex items-center justify-between px-6 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="w-10 h-10 rounded-lg hover:bg-slate-700 flex items-center justify-center transition-colors lg:hidden">
                        <i class="fas fa-bars text-slate-400"></i>
                    </button>
                    <button class="w-10 h-10 rounded-lg hover:bg-slate-700 flex items-center justify-center transition-colors hidden lg:flex" onclick="toggleSidebarDesktop()">
                        <i class="fas fa-bars text-slate-400"></i>
                    </button>
                    <div class="hidden md:flex items-center text-sm text-slate-500">
                        <span class="hover:text-slate-300 cursor-pointer">Inicio</span>
                        <i class="fas fa-chevron-right mx-2 text-xs"></i>
                        <span class="text-white font-medium">Dashboard</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Search -->
                    <div class="hidden md:flex items-center bg-slate-800 rounded-lg px-4 py-2 border border-slate-700 focus-within:border-admin-accent transition-colors">
                        <i class="fas fa-search text-slate-500 mr-3"></i>
                        <input type="text" placeholder="Buscar en el panel..." class="bg-transparent border-none outline-none text-sm text-white placeholder-slate-500 w-64">
                        <span class="text-xs text-slate-500 bg-slate-700 px-2 py-1 rounded ml-2">⌘K</span>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button onclick="toggleNotifications()" class="w-10 h-10 rounded-lg hover:bg-slate-700 flex items-center justify-center transition-colors relative">
                            <i class="fas fa-bell text-slate-400"></i>
                            <span class="absolute top-2 right-2 w-2 h-2 bg-admin-accent rounded-full animate-pulse"></span>
                        </button>

                        <!-- Dropdown - convertido de .dropdown-menu + .hidden -->
                        <!-- origin-top-right transition-all duration-200, estado oculto = scale-95 opacity-0 pointer-events-none -->
                        <div id="notifications-dropdown" class="origin-top-right transition-all duration-200 scale-95 opacity-0 pointer-events-none absolute right-0 mt-2 w-80 bg-slate-800 rounded-xl shadow-2xl border border-slate-700 z-50">
                            <div class="p-4 border-b border-slate-700 flex items-center justify-between">
                                <h3 class="font-semibold text-white">Notificaciones</h3>
                                <span class="text-xs bg-admin-accent text-white px-2 py-1 rounded-full">3 nuevas</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto custom-scrollbar">
                                <div class="p-4 hover:bg-slate-700/50 cursor-pointer border-b border-slate-700/50 transition-colors">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-shopping-bag text-green-400 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-white font-medium">Nuevo pedido #1234</p>
                                            <p class="text-xs text-slate-400 mt-1">Jujutsu Kaisen Vol. 18 x2</p>
                                            <p class="text-xs text-slate-500 mt-1">Hace 2 minutos</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-slate-700/50 cursor-pointer border-b border-slate-700/50 transition-colors">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-yellow-400 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-white font-medium">Stock bajo</p>
                                            <p class="text-xs text-slate-400 mt-1">One Piece Vol. 103 (5 unidades)</p>
                                            <p class="text-xs text-slate-500 mt-1">Hace 1 hora</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-slate-700/50 cursor-pointer transition-colors">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-blue-400 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-white font-medium">Nuevo registro</p>
                                            <p class="text-xs text-slate-400 mt-1">María García se ha registrado</p>
                                            <p class="text-xs text-slate-500 mt-1">Hace 3 horas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-slate-700 text-center">
                                <button class="text-sm text-admin-accent hover:text-white transition-colors">Ver todas</button>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <button class="w-10 h-10 rounded-lg bg-admin-accent hover:bg-red-600 flex items-center justify-center transition-colors shadow-lg shadow-red-500/20" onclick="openQuickAdd()">
                        <i class="fas fa-plus text-white"></i>
                    </button>
                </div>
            </header>