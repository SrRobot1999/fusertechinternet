{{-- filepath: c:\xampp\htdocs\fusertechinternet\resources\views\login.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css') <!-- Incluye el CSS compilado -->
    <link rel="stylesheet" href="@fortawesome/fontawesome-free/css/all.min.css"> <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bundles/bootstrap-social/bootstrap-social.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css ') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="https://www.fusertech.com.pe/fusertech/img/Logo_original.png" />
</head>

<body class="p-0 m-0 body-login">
    <!-- <div class="loader"></div> -->
    <!-- <div id="app">
        <div class="row "> -->
    <div class="col-lg-12">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                               
                            </div>
                            <div class="card-body">
                                 @if ($errors->any())
                                <div class="w-100 mb-4 text-red-600 text-sm">
                                    @foreach ($errors->all() as $error)
                                    <div class="text-danger font-14">{{ $error }}</div>
                                    @endforeach
                                </div>
                                @endif
                                <form action="{{ route('login.post') }}" method="POST" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            por favor, ingresa tu correo electrónico
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Contraseña</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    ¿Olvidaste tu contraseña?
                                                </a>
                                            </div>
                                        </div>
                                        <input type="password" id="password" name="password" class="form-control" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            por favor, ingresa tu contraseña
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- </div>
    </div> -->
</body>

</html>