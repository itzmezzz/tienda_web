<header class="h-16 bg-admin-sidebar/70 backdrop-blur-xl border-b border-white/5 flex items-center justify-between px-6 sticky top-0 z-30">

<div class="flex items-center gap-4">
    <button onclick="toggleSidebar()" class="lg:hidden">
        <i class="fas fa-bars"></i>
    </button>

    <div class="hidden md:flex text-sm text-slate-500">
        <span>Inicio</span>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-white font-medium">Dashboard</span>
    </div>
</div>

<div class="flex items-center gap-3">
    <button onclick="toggleNotifications()" class="relative">
        <i class="fas fa-bell"></i>
    </button>

    <button class="bg-admin-accent p-2 rounded-lg" onclick="openQuickAdd()">
        <i class="fas fa-plus"></i>
    </button>
</div>

</header>