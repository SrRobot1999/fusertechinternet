<nav class="bg-white text-green-600 px-4 py-2 w-[calc(100%-13rem)] fixed top-0 left-52 z-40 shadow-md flex justify-between items-center">
    <!-- Barra de búsqueda con ícono -->
    <div class="flex items-center flex-grow max-w-2xl relative">
        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-green-400"></i>
        <input type="text" placeholder="Buscar..."
            class="w-full pl-10 pr-4 py-1.5 border border-green-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400">
    </div>

    <!-- Iconos y rol -->
    <div class="flex items-center gap-6 ml-6">
        <!-- Rol del usuario -->
        <div class="hidden md:block font-semibold text-sm">
            Rol: <span class="text-green-800">Admin</span>
        </div>

        <!-- Notificaciones -->
        <button class="relative">
            <i class="fas fa-bell text-xl hover:text-green-800 transition"></i>
            <span class="absolute -top-1 -right-2 bg-green-600 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">3</span>
        </button>

        <!-- Botón hamburguesa para tablets/móviles -->
        <button class="md:hidden">
            <i class="fas fa-bars text-2xl hover:text-green-800 transition"></i>
        </button>
    </div>
</nav>
