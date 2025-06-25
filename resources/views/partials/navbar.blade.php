<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a>
            </li>
            <li>
                <form class="form-inline mr-auto">
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    Notificaciones
                </div>
                <div class="dropdown-list-content dropdown-list-icons" id="notificationList">
                </div>
            </div>
        </li>

        <li class="dropdown">
            @php
            $nombre = Auth::user()->nombre ?? 'Usuario';
            $partes = explode(' ', trim($nombre));

            // Obtener solo las dos primeras palabras (nombre y apellido)
            $iniciales = '';
            if (count($partes) >= 2) {
            $iniciales = strtoupper(mb_substr($partes[0], 0, 1) . mb_substr($partes[1], 0, 1));
            } elseif (count($partes) === 1) {
            $iniciales = strtoupper(mb_substr($partes[0], 0, 1));
            } else {
            $iniciales = 'U';
            }
            @endphp

            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="user-initials-circle" id="userInitials">{{ $iniciales }}</div>
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello</div>
                <a href="{{ route('perfil') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Perfil
                </a>
                <a href="{{ route('tickets') }}" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Actividades
                </a>
                <!-- <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Configuraciones
                </a> -->
                <div class="dropdown-divider"></div>
                <!-- <a href="" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a> -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        $.ajax({
            url: "/showNotifications",
            method: "GET",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                let lista = "";
                const data = respuesta.data;

                data.forEach(item => {
                    // color clase según estado
                    let colorClass = item.estado == '0' ? 'bg-warning' : 'bg-danger';
                    let estadoTexto = item.estado == '0' ? 'Pendiente' : 'Vencido';

                    lista += `
                <a href="/pagos" class="dropdown-item dropdown-item-unread">
                    <span class="dropdown-item-icon ${colorClass} text-white">
                       <i class="fa-regular fa-money-bill-1"></i>
                    </span>
                    <span class="dropdown-item-desc">
                        ${item.cliente}
                        <span class="time">Pago ${estadoTexto} - ${item.fecha}</span>
                    </span>
                </a>
            `;
                });

                document.getElementById("notificationList").innerHTML = lista;
            }
        });


    });
</script>