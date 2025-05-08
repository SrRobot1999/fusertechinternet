<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">
                <img alt="image" src="{{ asset('images/logofusertech.png') }}" class="header-logo" />
                <span class="logo-name">FUSERTECH</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown  {{ Request::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link">
                    <i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown {{ Request::is('equipos') ? 'active' : '' }}">
                <a href="{{ route('equipos') }}" class="nav-link">
                    <i data-feather="server"></i>
                    <span>Equipos</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="{{ route('perfil') }}" class="nav-link">
                    <i data-feather="users"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="{{ route('perfil') }}" class="nav-link">
                    <i data-feather="dollar-sign"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="{{ route('perfil') }}" class="nav-link">
                    <i data-feather="wifi"></i>
                    <span>Bases</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="{{ route('perfil') }}" class="nav-link">
                    <i data-feather="bar-chart"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li class="dropdown  {{ Request::is('perfil') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="briefcase"></i>
                    <span>Mantenimiento</span>
                </a>
                <ul class="dropdown-menu">
                    <li class=" {{ Request::is('perfil') ? 'active' : '' }}"><a class="nav-link  {{ Request::is('perfil') ? 'toggled' : '' }}" href="{{ route('perfil') }}">Perfil</a></li>
                    <li><a class="nav-link" href="widget-data.html">Usuarios</a></li>
                    <li><a class="nav-link" href="widget-data.html">Accesos</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link">
                        <i data-feather="log-out"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>        
            </li>
        </ul>
    </aside>
</div>