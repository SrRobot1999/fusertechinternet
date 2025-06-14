<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-blue-600">
                    Fusertech Internet
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#planes" class="text-gray-700 hover:text-blue-600 transition-colors">
                    Planes
                </a>
                <a href="#por-que-elegirnos" class="text-gray-700 hover:text-blue-600 transition-colors">
                    ¿Por qué elegirnos?
                </a>
                <a href="#contacto" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
                    Contacto
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="p-2 rounded-md hover:bg-gray-100">
                    <i data-lucide="menu" class="h-6 w-6"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden bg-white px-4 py-2 shadow-md hidden">
            <div class="flex flex-col space-y-3 pb-3">
                <a href="#planes" class="text-gray-700 hover:text-blue-600 transition-colors py-2 mobile-link">
                    Planes
                </a>
                <a href="#por-que-elegirnos" class="text-gray-700 hover:text-blue-600 transition-colors py-2 mobile-link">
                    ¿Por qué elegirnos?
                </a>
                <a href="#contacto" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors text-center mobile-link">
                    Contacto
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Conexión de alta velocidad para tu hogar y negocio
                    </h1>
                    <p class="text-xl mb-8">
                        Fusertech Internet te ofrece la mejor experiencia de navegación con planes adaptados a tus necesidades.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#planes" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-md font-semibold text-center transition-colors">
                            Ver planes
                        </a>
                        <a href="#contacto" class="border-2 border-white text-white hover:bg-white/10 px-6 py-3 rounded-md font-semibold text-center transition-colors">
                            Contáctanos
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-md h-64 md:h-80 bg-white/10 rounded-lg flex items-center justify-center">
                        <i data-lucide="wifi" class="h-32 w-32 text-white/50"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Plans Section -->
        <section id="planes" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Nuestros Planes de Internet</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Ofrecemos planes flexibles que se adaptan a tus necesidades de conexión, con la mejor relación calidad-precio del mercado.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Plan Básico -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold mb-2">Básico</h3>
                            <div class="mt-4">
                                <span class="text-3xl font-bold">$29.99</span>
                                <span class="text-gray-500"> /mes</span>
                            </div>
                            <div class="mt-2 text-blue-600 font-semibold text-xl">50 Mbps</div>
                        </div>
                        <div class="flex-grow mb-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Ideal para uso personal</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Navegación web</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Redes sociales</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Streaming en calidad estándar</span>
                                </li>
                            </ul>
                        </div>
                        <a href="#contacto" class="w-full bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-md font-semibold text-center transition-colors">
                            Contratar
                        </a>
                    </div>

                    <!-- Plan Estándar -->
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col border-2 border-blue-500 transform scale-105">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold mb-2">Estándar</h3>
                            <div class="mt-4">
                                <span class="text-3xl font-bold">$49.99</span>
                                <span class="text-gray-500"> /mes</span>
                            </div>
                            <div class="mt-2 text-blue-600 font-semibold text-xl">200 Mbps</div>
                        </div>
                        <div class="flex-grow mb-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Ideal para familias</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Múltiples dispositivos</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Streaming en HD</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Videollamadas sin interrupciones</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Juegos en línea</span>
                                </li>
                            </ul>
                        </div>
                        <a href="#contacto" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold text-center transition-colors">
                            Contratar
                        </a>
                    </div>

                    <!-- Plan Premium -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold mb-2">Premium</h3>
                            <div class="mt-4">
                                <span class="text-3xl font-bold">$79.99</span>
                                <span class="text-gray-500"> /mes</span>
                            </div>
                            <div class="mt-2 text-blue-600 font-semibold text-xl">500 Mbps</div>
                        </div>
                        <div class="flex-grow mb-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Ideal para profesionales</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Streaming en 4K</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Descargas ultrarrápidas</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Múltiples usuarios simultáneos</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Juegos en línea competitivos</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5"></i>
                                    <span>Soporte prioritario</span>
                                </li>
                            </ul>
                        </div>
                        <a href="#contacto" class="w-full bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-md font-semibold text-center transition-colors">
                            Contratar
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="por-que-elegirnos" class="py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">¿Por qué elegir Fusertech Internet?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Nos distinguimos por ofrecer un servicio de calidad superior con atención personalizada.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="wifi" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Conexión Estable</h3>
                        <p class="text-gray-600">Nuestra infraestructura garantiza una conexión sin interrupciones las 24 horas del día.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="shield" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Seguridad Garantizada</h3>
                        <p class="text-gray-600">Protegemos tu red con las últimas tecnologías de seguridad para una navegación tranquila.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="clock" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Instalación Rápida</h3>
                        <p class="text-gray-600">Instalamos tu servicio en menos de 48 horas para que comiences a disfrutar de inmediato.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="headphones" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Soporte 24/7</h3>
                        <p class="text-gray-600">Nuestro equipo técnico está disponible todos los días para resolver cualquier incidencia.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="zap" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Velocidad Garantizada</h3>
                        <p class="text-gray-600">Te aseguramos la velocidad contratada sin fluctuaciones ni sorpresas.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4">
                            <i data-lucide="award" class="h-10 w-10 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Sin Permanencia</h3>
                        <p class="text-gray-600">Creemos en la calidad de nuestro servicio, por eso no te atamos con contratos de permanencia.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section id="contacto" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Contáctanos</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        ¿Interesado en nuestros servicios? Completa el formulario y nos pondremos en contacto contigo a la brevedad.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-12">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <div id="success-message" class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-md mb-6 hidden">
                            ¡Gracias por contactarnos! Nos comunicaremos contigo pronto.
                        </div>
                        
                        <div id="error-message" class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-md mb-6 hidden"></div>

                        <form id="contact-form">
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo *</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tu nombre"
                                    />
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico *</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="tu@email.com"
                                    />
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tu número de teléfono"
                                    />
                                </div>

                                <div>
                                    <label for="plan" class="block text-sm font-medium text-gray-700 mb-1">Plan de interés</label>
                                    <select
                                        id="plan"
                                        name="plan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Selecciona un plan</option>
                                        <option value="basico">Básico</option>
                                        <option value="estandar">Estándar</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="¿En qué podemos ayudarte?"
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    id="submit-btn"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold transition-colors disabled:opacity-50"
                                >
                                    Enviar mensaje
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col justify-center">
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i data-lucide="phone" class="h-6 w-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Teléfono</h3>
                                    <p class="text-gray-600">+123 456 7890</p>
                                    <p class="text-gray-600">Lunes a Viernes: 8:00 - 20:00</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i data-lucide="mail" class="h-6 w-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Correo electrónico</h3>
                                    <p class="text-gray-600">info@fusertechinternet.com</p>
                                    <p class="text-gray-600">soporte@fusertechinternet.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i data-lucide="map-pin" class="h-6 w-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Dirección</h3>
                                    <p class="text-gray-600">Av. Principal #123</p>
                                    <p class="text-gray-600">Ciudad Tecnológica, CP 12345</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Fusertech Internet</h3>
                    <p class="text-gray-400 mb-4">
                        Proveedor líder de servicios de internet de alta velocidad, comprometidos con la calidad y la satisfacción del cliente.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i data-lucide="facebook" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i data-lucide="twitter" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i data-lucide="instagram" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i data-lucide="linkedin" class="h-5 w-5"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Enlaces rápidos</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#planes" class="text-gray-400 hover:text-white transition-colors">
                                Planes
                            </a>
                        </li>
                        <li>
                            <a href="#por-que-elegirnos" class="text-gray-400 hover:text-white transition-colors">
                                ¿Por qué elegirnos?
                            </a>
                        </li>
                        <li>
                            <a href="#contacto" class="text-gray-400 hover:text-white transition-colors">
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Servicios</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                Internet residencial
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                Internet empresarial
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                Soporte técnico
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                Instalación
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Contacto</h3>
                    <address class="not-italic text-gray-400">
                        <p class="mb-2">Av. Principal #123</p>
                        <p class="mb-2">Ciudad Tecnológica, CP 12345</p>
                        <p class="mb-2">Teléfono: +123 456 7890</p>
                        <p>Email: info@fusertechinternet.com</p>
                    </address>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 text-center text-gray-500">
                <p>&copy; 2024 Fusertech Internet. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on links
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Contact form functionality
        const contactForm = document.getElementById('contact-form');
        const submitBtn = document.getElementById('submit-btn');
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Hide previous messages
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(contactForm);
            const name = formData.get('name');
            const email = formData.get('email');
            const phone = formData.get('phone');
            
            // Basic validation
            if (!name || !email || !phone) {
                errorMessage.textContent = 'Por favor completa todos los campos obligatorios.';
                errorMessage.classList.remove('hidden');
                return;
            }
            
            // Simulate form submission
            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';
            
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Enviar mensaje';
                
                // Show success message
                successMessage.classList.remove('hidden');
                
                // Reset form
                contactForm.reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 5000);
            }, 1500);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>