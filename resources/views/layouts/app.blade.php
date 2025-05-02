<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fusertech - Panel</title>
    @vite('resources/css/app.css') <!-- Incluye el CSS compilado -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    @include('partials.sidebar') <!-- Para tu menú lateral, si quieres -->
    @include('partials.navbar') <!-- Para tu encabezado, si quieres -->

    <main class="flex-1 p-4 mt-14 ml-52">
        @yield('content')
    </main>

    @include('partials.footer') <!-- Para tu footer, si quieres -->
    
</body>

</html>