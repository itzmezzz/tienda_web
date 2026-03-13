<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Admin Dashboard - MangaStore</title>
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
   
  
    <style>
        /* Scrollbar personalizado - no tiene equivalente nativo en Tailwind sin plugin */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1E293B; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #64748B; }
    </style>
</head>
<body class="bg-[#0f172a] text-white font-sans antialiased">
    <div class="flex h-screen">

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
                 <a href="{{ route('producto.nuevo') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
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

                 <a href="{{ route('autores.nuevo') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 transition-all duration-300 hover:bg-gradient-to-r hover:from-[rgba(230,57,70,0.15)] hover:to-transparent hover:border-l-[3px] hover:border-admin-accent hover:text-white group">
                    <i class="fas fa-truck w-5 text-center group-hover:text-admin-accent transition-colors"></i>
                    <span class="font-medium">Autores</span>

                 </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50 hover:bg-slate-800 cursor-pointer transition-colors group">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" alt="Admin" class="w-10 h-10 rounded-full border-2 border-admin-accent">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate"></p>
                        <p class="text-xs text-slate-500 truncate">Admin</p>
                    </div>
                    <i class="fas fa-chevron-right text-xs text-slate-500 group-hover:text-white transition-colors"></i>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
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

            <!-- Dashboard Content -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-6">

                <!-- Welcome Section -->
                <div class="mb-8 animate-fade-in">
                    <h2 class="text-3xl font-bold text-white mb-2">¡Hola! </h2>
                    <p class="text-slate-400"></p>
                </div>

                <!-- Stats Grid -->
                <!-- .stat-card:hover → hover:-translate-y-1 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)] transition-all duration-300 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stat 1 -->
                    <div class="transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)] bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 border border-slate-700 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-admin-accent/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-admin-accent/20 transition-all"></div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-admin-accent/20 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-admin-accent text-xl"></i>
                            </div>
                            <span class="flex items-center gap-1 text-green-400 text-sm font-medium bg-green-400/10 px-2 py-1 rounded-full">
                                <i class="fas fa-arrow-up text-xs"></i> 12.5%
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm mb-1">Ventas Hoy</p>
                        <p class="text-3xl font-bold text-white">$2,845.50</p>
                        <p class="text-xs text-slate-500 mt-2">vs ayer $2,530.00</p>
                    </div>
                    <!-- Stat 2 -->
                    <div class="transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)] bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 border border-slate-700 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-admin-purple/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-admin-purple/20 transition-all"></div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-admin-purple/20 flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-admin-purple text-xl"></i>
                            </div>
                            <span class="flex items-center gap-1 text-green-400 text-sm font-medium bg-green-400/10 px-2 py-1 rounded-full">
                                <i class="fas fa-arrow-up text-xs"></i> 8.2%
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm mb-1">Pedidos</p>
                        <p class="text-3xl font-bold text-white">48</p>
                        <p class="text-xs text-slate-500 mt-2">24 pendientes de envío</p>
                    </div>
                    <!-- Stat 3 -->
                    <div class="transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)] bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 border border-slate-700 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-admin-info/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-admin-info/20 transition-all"></div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-admin-info/20 flex items-center justify-center">
                                <i class="fas fa-users text-admin-info text-xl"></i>
                            </div>
                            <span class="flex items-center gap-1 text-green-400 text-sm font-medium bg-green-400/10 px-2 py-1 rounded-full">
                                <i class="fas fa-arrow-up text-xs"></i> 24%
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm mb-1">Nuevos Clientes</p>
                        <p class="text-3xl font-bold text-white">156</p>
                        <p class="text-xs text-slate-500 mt-2">Este mes</p>
                    </div>
                    <!-- Stat 4 -->
                    <div class="transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)] bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 border border-slate-700 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-admin-warning/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-admin-warning/20 transition-all"></div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-admin-warning/20 flex items-center justify-center">
                                <i class="fas fa-box text-admin-warning text-xl"></i>
                            </div>
                            <span class="flex items-center gap-1 text-red-400 text-sm font-medium bg-red-400/10 px-2 py-1 rounded-full">
                                <i class="fas fa-arrow-down text-xs"></i> 3%
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm mb-1">Stock Bajo</p>
                        <p class="text-3xl font-bold text-white">12</p>
                        <p class="text-xs text-slate-500 mt-2">Productos por reponer</p>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Main Chart -->
                    <div class="lg:col-span-2 bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-white">Ventas vs Pedidos</h3>
                                <p class="text-sm text-slate-400">Últimos 30 días</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 rounded-lg bg-admin-accent text-white text-sm font-medium">Mes</button>
                                <button class="px-3 py-1 rounded-lg hover:bg-slate-700 text-slate-400 text-sm font-medium transition-colors">Semana</button>
                                <button class="px-3 py-1 rounded-lg hover:bg-slate-700 text-slate-400 text-sm font-medium transition-colors">Año</button>
                            </div>
                        </div>
                        <div class="h-80"><canvas id="salesChart"></canvas></div>
                    </div>
                    <!-- Secondary Chart -->
                    <div class="bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-white">Ventas por Categoría</h3>
                            <p class="text-sm text-slate-400">Distribución este mes</p>
                        </div>
                        <div class="h-64 mb-4"><canvas id="categoryChart"></canvas></div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-admin-accent"></div>
                                    <span class="text-sm text-slate-300">Shonen</span>
                                </div>
                                <span class="text-sm font-bold text-white">45%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-admin-purple"></div>
                                    <span class="text-sm text-slate-300">Seinen</span>
                                </div>
                                <span class="text-sm font-bold text-white">30%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-admin-info"></div>
                                    <span class="text-sm text-slate-300">Shojo</span>
                                </div>
                                <span class="text-sm font-bold text-white">25%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders & Top Products -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Orders Table -->
                    <div class="lg:col-span-2 bg-slate-800/50 rounded-2xl border border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-slate-700 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white">Pedidos Recientes</h3>
                                <p class="text-sm text-slate-400">Últimas 24 horas</p>
                            </div>
                            <button class="text-admin-accent hover:text-white text-sm font-medium transition-colors">
                                Ver todos <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-900/50 text-left">
                                    <tr>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Pedido</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Cliente</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Productos</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <!-- .table-row:hover → hover:bg-white/[0.03] -->
                                <tbody class="divide-y divide-slate-700/50">
                                    <tr class="hover:bg-white/[0.03] transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-white font-medium">#1234</span>
                                            <p class="text-xs text-slate-500">Hace 2 min</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold">JL</div>
                                                <div>
                                                    <p class="text-white text-sm font-medium">Juan López</p>
                                                    <p class="text-xs text-slate-500">juan@email.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex -space-x-2">
                                                <img src="https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                                <img src="https://images.unsplash.com/photo-1560972550-aba3456b5564?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                                <div class="w-8 h-10 rounded bg-slate-700 border-2 border-slate-800 flex items-center justify-center text-xs text-white font-medium">+2</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><span class="text-white font-bold">$45.97</span></td>
                                        <td class="px-6 py-4">
                                            <!-- .status-badge → transition-all duration-300 hover:scale-105 -->
                                            <span class="transition-all duration-300 hover:scale-105 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span>
                                                Pendiente
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors" title="Ver detalles"><i class="fas fa-eye text-sm"></i></button>
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-green-400 transition-colors" title="Procesar"><i class="fas fa-check text-sm"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-white/[0.03] transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-white font-medium">#1233</span>
                                            <p class="text-xs text-slate-500">Hace 15 min</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white text-xs font-bold">MR</div>
                                                <div>
                                                    <p class="text-white text-sm font-medium">María Rodríguez</p>
                                                    <p class="text-xs text-slate-500">maria@email.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex -space-x-2">
                                                <img src="https://images.unsplash.com/photo-1613376023733-0a73315d9b06?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><span class="text-white font-bold">$10.99</span></td>
                                        <td class="px-6 py-4">
                                            <span class="transition-all duration-300 hover:scale-105 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                                Completado
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-eye text-sm"></i></button>
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-print text-sm"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-white/[0.03] transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-white font-medium">#1232</span>
                                            <p class="text-xs text-slate-500">Hace 1 hora</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-xs font-bold">AS</div>
                                                <div>
                                                    <p class="text-white text-sm font-medium">Ana Sánchez</p>
                                                    <p class="text-xs text-slate-500">ana@email.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex -space-x-2">
                                                <img src="https://images.unsplash.com/photo-1581833971358-2c8b0fceb0dc?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><span class="text-white font-bold">$36.98</span></td>
                                        <td class="px-6 py-4">
                                            <span class="transition-all duration-300 hover:scale-105 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                                                Enviado
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-eye text-sm"></i></button>
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-truck text-sm"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-white/[0.03] transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-white font-medium">#1231</span>
                                            <p class="text-xs text-slate-500">Hace 3 horas</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white text-xs font-bold">PG</div>
                                                <div>
                                                    <p class="text-white text-sm font-medium">Pedro Gómez</p>
                                                    <p class="text-xs text-slate-500">pedro@email.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex -space-x-2">
                                                <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                                <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&q=80&w=100" class="w-8 h-10 object-cover rounded border-2 border-slate-800" alt="Manga">
                                                <div class="w-8 h-10 rounded bg-slate-700 border-2 border-slate-800 flex items-center justify-center text-xs text-white font-medium">+1</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4"><span class="text-white font-bold">$52.97</span></td>
                                        <td class="px-6 py-4">
                                            <span class="transition-all duration-300 hover:scale-105 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                                Cancelado
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-eye text-sm"></i></button>
                                                <button class="w-8 h-8 rounded-lg hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-colors"><i class="fas fa-redo text-sm"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Top Products -->
                    <div class="bg-slate-800/50 rounded-2xl border border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-slate-700">
                            <h3 class="text-lg font-bold text-white">Top Productos</h3>
                            <p class="text-sm text-slate-400">Más vendidos este mes</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="relative">
                                    <img src="https://tse4.mm.bing.net/th/id/OIP.9xZAL_OYZ56vl7-JcMwDPQHaLR?cb=defcachec2&rs=1&pid=ImgDetMain&o=7&rm=3" class="w-12 h-16 object-cover rounded-lg shadow-lg" alt="Product">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">1</div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-white font-medium text-sm group-hover:text-admin-accent transition-colors">Jujutsu Kaisen Vol. 18</h4>
                                    <p class="text-xs text-slate-400">Shonen • Gege Akutami</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-green-400 text-xs font-medium">234 vendidos</span>
                                        <span class="text-slate-600">•</span>
                                        <span class="text-slate-400 text-xs">$3,042.66</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-white font-bold">$12.99</span>
                                    <div class="flex text-yellow-400 text-xs mt-1 justify-end">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1560972550-aba3456b5564?auto=format&fit=crop&q=80&w=100" class="w-12 h-16 object-cover rounded-lg shadow-lg" alt="Product">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-slate-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">2</div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-white font-medium text-sm group-hover:text-admin-accent transition-colors">One Piece Vol. 103</h4>
                                    <p class="text-xs text-slate-400">Aventura • Eiichiro Oda</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-green-400 text-xs font-medium">198 vendidos</span>
                                        <span class="text-slate-600">•</span>
                                        <span class="text-slate-400 text-xs">$2,374.02</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-white font-bold">$11.99</span>
                                    <div class="flex text-yellow-400 text-xs mt-1 justify-end">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1613376023733-0a73315d9b06?auto=format&fit=crop&q=80&w=100" class="w-12 h-16 object-cover rounded-lg shadow-lg" alt="Product">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-slate-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">3</div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-white font-medium text-sm group-hover:text-admin-accent transition-colors">Spy x Family Vol. 9</h4>
                                    <p class="text-xs text-slate-400">Comedia • Tatsuya Endo</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-green-400 text-xs font-medium">156 vendidos</span>
                                        <span class="text-slate-600">•</span>
                                        <span class="text-slate-400 text-xs">$1,714.44</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-white font-bold">$10.99</span>
                                    <div class="flex text-yellow-400 text-xs mt-1 justify-end">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="relative">
                                    <img src="https://th.bing.com/th/id/OIP.CvpqSudpwZh0WKIJjg2_AQAAAA?w=199&h=313&c=7&r=0&o=7&cb=defcachec2&dpr=1.3&pid=1.7&rm=3" class="w-12 h-16 object-cover rounded-lg shadow-lg" alt="Product">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-slate-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">4</div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-white font-medium text-sm group-hover:text-admin-accent transition-colors">Chainsaw Man Vol. 12</h4>
                                    <p class="text-xs text-slate-400">Acción • Tatsuki Fujimoto</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-green-400 text-xs font-medium">142 vendidos</span>
                                        <span class="text-slate-600">•</span>
                                        <span class="text-slate-400 text-xs">$1,986.58</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-white font-bold">$13.99</span>
                                    <div class="flex text-yellow-400 text-xs mt-1 justify-end">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <button class="w-full py-3 mt-4 border border-slate-600 rounded-xl text-slate-400 hover:text-white hover:border-slate-400 transition-colors text-sm font-medium">
                                Ver reporte completo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Bar -->
                <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-xl border border-slate-700 hover:border-admin-accent hover:bg-slate-800 transition-all group">
                        <div class="w-10 h-10 rounded-lg bg-admin-accent/20 flex items-center justify-center group-hover:bg-admin-accent transition-colors">
                            <i class="fas fa-plus text-admin-accent group-hover:text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-white font-medium text-sm">Nuevo Producto</p>
                            <p class="text-xs text-slate-500">Agregar manga</p>
                        </div>
                    </button>
                    <button class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-xl border border-slate-700 hover:border-admin-purple hover:bg-slate-800 transition-all group">
                        <div class="w-10 h-10 rounded-lg bg-admin-purple/20 flex items-center justify-center group-hover:bg-admin-purple transition-colors">
                            <i class="fas fa-file-invoice text-admin-purple group-hover:text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-white font-medium text-sm">Crear Factura</p>
                            <p class="text-xs text-slate-500">Facturación manual</p>
                        </div>
                    </button>
                    <button class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-xl border border-slate-700 hover:border-admin-info hover:bg-slate-800 transition-all group">
                        <div class="w-10 h-10 rounded-lg bg-admin-info/20 flex items-center justify-center group-hover:bg-admin-info transition-colors">
                            <i class="fas fa-user-plus text-admin-info group-hover:text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-white font-medium text-sm">Nuevo Cliente</p>
                            <p class="text-xs text-slate-500">Registro rápido</p>
                        </div>
                    </button>
                    <button class="flex items-center gap-3 p-4 bg-slate-800/50 rounded-xl border border-slate-700 hover:border-admin-warning hover:bg-slate-800 transition-all group">
                        <div class="w-10 h-10 rounded-lg bg-admin-warning/20 flex items-center justify-center group-hover:bg-admin-warning transition-colors">
                            <i class="fas fa-box-open text-admin-warning group-hover:text-white"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-white font-medium text-sm">Actualizar Stock</p>
                            <p class="text-xs text-slate-500">Inventario masivo</p>
                        </div>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Quick Add Modal -->
    <div id="quick-add-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity" onclick="closeQuickAdd()"></div>
        <div class="absolute right-0 top-0 h-full w-full max-w-lg bg-slate-900 shadow-2xl transform transition-transform translate-x-full flex flex-col" id="quick-add-panel">
            <div class="flex items-center justify-between p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Acción Rápida</h2>
                <button onclick="closeQuickAdd()" class="w-10 h-10 rounded-lg hover:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6 space-y-4 overflow-y-auto flex-1">
                <div class="grid grid-cols-2 gap-4">
                    <button class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-admin-accent hover:bg-slate-700 transition-all text-left group">
                        <i class="fas fa-book text-3xl text-admin-accent mb-3 group-hover:scale-110 transition-transform block"></i>
                        <h3 class="text-white font-bold mb-1">Nuevo Manga</h3>
                        <p class="text-sm text-slate-400">Agregar nuevo volumen al catálogo</p>
                    </button>
                    <button class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-admin-purple hover:bg-slate-700 transition-all text-left group">
                        <i class="fas fa-tags text-3xl text-admin-purple mb-3 group-hover:scale-110 transition-transform block"></i>
                        <h3 class="text-white font-bold mb-1">Categoría</h3>
                        <p class="text-sm text-slate-400">Crear nueva categoría o género</p>
                    </button>
                    <button class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-admin-info hover:bg-slate-700 transition-all text-left group">
                        <i class="fas fa-percent text-3xl text-admin-info mb-3 group-hover:scale-110 transition-transform block"></i>
                        <h3 class="text-white font-bold mb-1">Cupón</h3>
                        <p class="text-sm text-slate-400">Generar código de descuento</p>
                    </button>
                    <button class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-admin-warning hover:bg-slate-700 transition-all text-left group">
                        <i class="fas fa-bullhorn text-3xl text-admin-warning mb-3 group-hover:scale-110 transition-transform block"></i>
                        <h3 class="text-white font-bold mb-1">Anuncio</h3>
                        <p class="text-sm text-slate-400">Publicar noticia o promoción</p>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('fixed');
            sidebar.classList.toggle('inset-y-0');
            sidebar.classList.toggle('left-0');
            sidebar.classList.toggle('z-50');
        }

        // Toggle Sidebar Desktop
        function toggleSidebarDesktop() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('w-72')) {
                sidebar.classList.remove('w-72');
                sidebar.classList.add('w-20');
                sidebar.querySelectorAll('span:not(.bg-admin-accent)').forEach(el => {
                    if (!el.closest('.border-b')) el.classList.add('hidden');
                });
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-72');
                sidebar.querySelectorAll('span').forEach(el => el.classList.remove('hidden'));
            }
        }

        // Toggle Notifications - adaptado al nuevo sistema de clases Tailwind
        function toggleNotifications() {
            const dropdown = document.getElementById('notifications-dropdown');
            const isHidden = dropdown.classList.contains('scale-95');
            if (isHidden) {
                dropdown.classList.remove('scale-95', 'opacity-0', 'pointer-events-none');
                dropdown.classList.add('scale-100', 'opacity-100');
            } else {
                dropdown.classList.remove('scale-100', 'opacity-100');
                dropdown.classList.add('scale-95', 'opacity-0', 'pointer-events-none');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            const notifBtn = document.querySelector('[onclick="toggleNotifications()"]');
            const notifDropdown = document.getElementById('notifications-dropdown');
            if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                notifDropdown.classList.remove('scale-100', 'opacity-100');
                notifDropdown.classList.add('scale-95', 'opacity-0', 'pointer-events-none');
            }
        });

        // Quick Add Modal
        function openQuickAdd() {
            const modal = document.getElementById('quick-add-modal');
            const panel = document.getElementById('quick-add-panel');
            modal.classList.remove('hidden');
            setTimeout(() => { panel.classList.remove('translate-x-full'); }, 10);
        }

        function closeQuickAdd() {
            const modal = document.getElementById('quick-add-modal');
            const panel = document.getElementById('quick-add-panel');
            panel.classList.add('translate-x-full');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['1', '5', '10', '15', '20', '25', '30'],
                    datasets: [{
                        label: 'Ventas ($)',
                        data: [1200, 1900, 1500, 2200, 1800, 2800, 2845],
                        borderColor: '#E63946', backgroundColor: 'rgba(230, 57, 70, 0.1)',
                        borderWidth: 3, tension: 0.4, fill: true,
                        pointBackgroundColor: '#E63946', pointBorderColor: '#fff',
                        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6
                    }, {
                        label: 'Pedidos',
                        data: [15, 25, 20, 35, 28, 42, 48],
                        borderColor: '#8B5CF6', backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 3, tension: 0.4, fill: true,
                        pointBackgroundColor: '#8B5CF6', pointBorderColor: '#fff',
                        pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6, yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: true, labels: { color: '#94a3b8', usePointStyle: true, padding: 20 } },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', titleColor: '#fff',
                            bodyColor: '#cbd5e1', borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1, padding: 12, displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) label += ': ';
                                    label += context.dataset.label === 'Ventas ($)' ? '$' + context.parsed.y : context.parsed.y + ' pedidos';
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: { grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false }, ticks: { color: '#64748b' } },
                        y: { type: 'linear', display: true, position: 'left', grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false }, ticks: { color: '#64748b', callback: v => '$' + v } },
                        y1: { type: 'linear', display: true, position: 'right', grid: { drawOnChartArea: false }, ticks: { color: '#64748b' } }
                    }
                }
            });

            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Shonen', 'Seinen', 'Shojo'],
                    datasets: [{ data: [45, 30, 25], backgroundColor: ['#E63946', '#8B5CF6', '#3B82F6'], borderWidth: 0, hoverOffset: 4 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', titleColor: '#fff',
                            bodyColor: '#cbd5e1', borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1, padding: 12,
                            callbacks: { label: ctx => ctx.label + ': ' + ctx.parsed + '%' }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>