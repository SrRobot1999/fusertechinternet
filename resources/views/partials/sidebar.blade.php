<!-- filepath: c:\xampp\htdocs\fusertechinternet\resources\views\partials\sidebar.blade.php -->
<aside class="w-52 bg-green-600 text-white p-4 h-screen fixed top-0 left-0 shadow-md">
    <div class="mb-6 text-center font-bold text-lg tracking-wide flex items-center justify-center">
        <img src="images/logofusertech.jpg" alt="Logo" class="mr-2 w-8 h-8 rounded-full">
        FUSERTECH
    </div>

    <ul class="space-y-2">
        <li>
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 p-2 rounded transition 
                      {{ Request::is('home') ? 'bg-white text-green-700 font-semibold shadow-sm' : 'hover:bg-green-700' }}">
                <i class="fas fa-tachometer-alt {{ Request::is('home') ? 'text-green-700' : 'text-white' }}"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('perfil') }}" 
                class="flex items-center gap-3 p-2 rounded transition
                    {{ Request::is('perfil') ? 'bg-white text-green-700 font-semibold shadow-sm' : 'hover:bg-green-700' }}">
                <i class="fas fa-user-circle {{ Request::is('perfil') ? 'text-green-700' : 'text-white' }}"></i>
                Perfil
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                <i class="fas fa-network-wired text-white"></i>
                Equipos
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                <i class="fas fa-address-book text-white"></i>
                Clientes
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                <i class="fas fa-money-bill-wave text-white"></i>
                Pagos
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                <i class="fas fa-server text-white"></i>
                Bases
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                <i class="fas fa-chart-line text-white"></i>
                Reportes
            </a>
        </li>
        <li>
            <!-- Botón de Mantenimiento -->
            <div x-data="{ open: false }">
                <button @click="open = !open" 
                    class="flex items-center justify-between w-full p-2 rounded transition hover:bg-green-700">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-tools text-white"></i>
                        Mantenimiento
                    </div>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-white"></i>
                </button>
                <!-- Submenú desplegable -->
                <ul x-show="open" x-transition class="pl-6 mt-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                            <i class="fas fa-users text-white"></i>
                            Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                            <i class="fas fa-key text-white"></i>
                            Accesos
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-3 p-2 rounded transition hover:bg-green-700">
                    <i class="fas fa-sign-out-alt text-white"></i>
                    Cerrar Sesión
                </button>
            </form>
        </li>
    </ul>
</aside>