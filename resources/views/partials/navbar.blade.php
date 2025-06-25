<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
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
                class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
                <span class="badge headerBadge1">
                    6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="{{ asset('img/users/user-1.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">John
                                Deo</span>
                            <span class="time messege-text">Please check your mail !!</span>
                            <span class="time">2 Min Ago</span>
                        </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="{{ asset('img/users/user-2.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                Smith</span> <span class="time messege-text">Request for leave
                                application</span>
                            <span class="time">5 Min Ago</span>
                        </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="{{ asset('img/users/user-5.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                                Ryan</span> <span class="time messege-text">Your payment invoice is
                                generated.</span> <span class="time">12 Min Ago</span>
                        </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="{{ asset('img/users/user-4.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                                Smith</span> <span class="time messege-text">hii John, I have upload
                                doc
                                related to task.</span> <span class="time">30
                                Min Ago</span>
                        </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="{{ asset('img/users/user-3.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                                Joshi</span> <span class="time messege-text">Please do as specify.
                                Let me
                                know if you have any query.</span> <span class="time">1
                                Days Ago</span>
                        </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="{{ asset('img/users/user-2.png') }}" class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                Smith</span> <span class="time messege-text">Client Requirements</span>
                            <span class="time">2 Days Ago</span>
                        </span>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
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
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('img/user.png') }}"
                    class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">@auth
                    Bienvenido, {{ auth()->user()->name }}

                    @endauth</div>
                <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                    Activities
                </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
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