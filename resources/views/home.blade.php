<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css') <!-- Incluye el CSS compilado -->
</head>
<body class="flex flex-col min-h-screen font-sans">
    @include('partials.sidebar')
    <div class="flex flex-1 flex-col">
        @include('partials.navbar')
        <header class="bg-gray-800 text-white">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">Mi Sitio</h1>
                <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <nav id="menu" class="hidden lg:flex space-x-4">
                    <a href="#" class="hover:text-gray-300">Inicio</a>
                    <a href="#" class="hover:text-gray-300">Servicios</a>
                    <a href="#" class="hover:text-gray-300">Acerca de</a>
                    <a href="#" class="hover:text-gray-300">Contacto</a>
                </nav>
            </div>
        </header>
        <main class="flex-1 p-4">
            <h1 class="text-2xl font-bold">Bienvenido a la página principal</h1>
            <p class="mt-2 text-gray-700">Este es el contenido principal de la página.</p>
        </main>
    </div>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>