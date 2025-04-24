{{-- filepath: c:\xampp\htdocs\fusertechinternet\resources\views\login.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css') <!-- Incluye el CSS compilado -->
    <link rel="stylesheet" href="@fortawesome/fontawesome-free/css/all.min.css"> <!-- Font Awesome -->
</head>

<body class="flex min-h-screen font-sans bg-gray-100">
    <div class="flex w-full">
        <!-- Espacio para el logotipo -->
        <div class="hidden md:flex w-1/2 bg-gray-100 items-center justify-center ">
            <img src="images/logofusertech.jpg" alt="Logotipo" class="max-w-xs rounded shadow-md">
        </div>

        <!-- Formulario de inicio de sesión -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-md p-6 bg-white rounded shadow-md">
                <h1 class="text-2xl font-bold text-center">Iniciar Sesión</h1>

                @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="mt-4">
                    @csrf
                    <!-- Usuario -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Usuario</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-10 pr-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                                required>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                class="w-full pl-10 pr-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                                required>
                        </div>
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center justify-center gap-2 transition-all duration-200 ease-in-out group">
                        <i class="fas fa-sign-in-alt group-hover:translate-x-1 transform transition-transform duration-200 ease-in-out"></i>
                        Iniciar Sesión
                    </button>

                    <!-- Enlace -->
                    <div class="mt-4 text-center">
                        <a href="#" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>