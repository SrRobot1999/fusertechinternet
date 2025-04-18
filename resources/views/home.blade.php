<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css') <!-- Incluye el CSS compilado -->
</head>

<body class="flex flex-col min-h-screen font-sans">
    <!-- Navbar arriba -->
    @include('partials.navbar')

    <!-- Contenido debajo del navbar -->
    <div class="flex flex-1">
        @include('partials.sidebar') <!-- Sidebar al costado -->
        <main class="flex-1 p-4">
            <!-- Contenido principal -->
        </main>
    </div>
    <div>
        <!-- Footer al final de la página -->
        @include('partials.footer')
    </div>
</body>


</html>
