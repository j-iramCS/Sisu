<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <header class="relative bg-gradient-to-r from-blue-600 to-purple-600 text-white py-32 overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://via.placeholder.com/1920x600')] bg-cover opacity-10"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h1 class="text-6xl font-bold mb-6 animate-fade-in">Transforma tu negocio con nuestras herramientas</h1>
                <p class="text-xl mb-8 animate-fade-in delay-100">Soluciones inteligentes para gestionar, crecer y
                    optimizar tu negocio.</p>
                <Link :href="route('tools.index')"
                    class="bg-yellow-400 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors duration-300 animate-fade-in delay-200">
                Explorar
                Herramientas</Link>
            </div>
        </header>

        <!-- Sección de Herramientas -->
        <section class="max-w-7xl mx-auto px-6 py-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-blue-900">Nuestras Herramientas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tarjeta 1 -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-blue-600 text-5xl mb-4 animate-bounce">
                        <Icon icon="ic:baseline-show-chart" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión Financiera</h3>
                    <p class="text-gray-600">Controla tus ingresos, gastos y obtén informes detallados.</p>
                </div>
                <!-- Tarjeta 2 -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-purple-600 text-5xl mb-4 animate-bounce delay-100">
                        <Icon icon="ic:outline-checklist" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Inventario Inteligente</h3>
                    <p class="text-gray-600">Optimiza tu inventario y evita pérdidas.</p>
                </div>
                <!-- Tarjeta 3 -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-yellow-400 text-5xl mb-4 animate-bounce delay-200">
                        <Icon icon="ic:baseline-bar-chart" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Análisis de Mercado</h3>
                    <p class="text-gray-600">Toma decisiones basadas en datos reales.</p>
                </div>
            </div>
        </section>

        <!-- Sección ¿Qué Hacemos? -->
        <section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12 text-white animate-fade-in-down">¿Qué Hacemos?</h2>
                <p class="text-center text-lg text-white mb-8 animate-fade-in-up">Nos especializamos en soluciones
                    tecnológicas que optimizan tus procesos de negocio, brindándote herramientas y soporte para alcanzar
                    el éxito. Además, ofrecemos software gratuito que puedes usar hoy mismo.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Servicio 1: Desarrollo de Software -->
                    <div
                        class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 animate-fade-in-left hover:transition-all">
                        <h3 class="text-xl font-bold text-blue-900 mb-4">Desarrollo de Software</h3>
                        <p class="text-gray-600">Creamos soluciones personalizadas que se ajustan a las necesidades de
                            tu negocio. Optimiza y automatiza tus procesos con nuestras herramientas a medida.</p>
                    </div>
                    <!-- Servicio 2: Soporte Técnico -->
                    <div
                        class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 animate-fade-in-up hover:transition-all">
                        <h3 class="text-xl font-bold text-blue-900 mb-4">Soporte Técnico</h3>
                        <p class="text-gray-600">Nuestro equipo de soporte está disponible para ayudarte a resolver
                            cualquier problema técnico y asegurarse de que tus sistemas funcionen sin interrupciones.
                        </p>
                    </div>
                    <!-- Servicio 3: Consultoría Personalizada -->
                    <div
                        class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 animate-fade-in-right hover:transition-all">
                        <h3 class="text-xl font-bold text-blue-900 mb-4">Consultoría Personalizada</h3>
                        <p class="text-gray-600">Te ayudamos a identificar las mejores soluciones para tus necesidades
                            tecnológicas, aumentando la productividad de tu empresa con un enfoque estratégico y
                            eficiente.</p>
                    </div>
                </div>

                <!-- Software Gratuito -->
                <div class="mt-16 text-center animate-fade-in-up">
                    <div
                        class="relative bg-white/10 backdrop-blur-sm p-8 rounded-2xl shadow-2xl border-2 border-white/20 hover:border-white/40 transition-all duration-500">
                        <div
                            class="absolute inset-0 rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur-md animate-pulse">
                            </div>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-3xl font-bold text-white mb-4 animate-bounce">¡Usa Nuestro Software Gratis!
                            </h3>
                            <p class="text-lg text-white mb-8">Ponemos a tu disposición herramientas que puedes comenzar
                                a usar de inmediato para mejorar la eficiencia de tu negocio. ¡Empieza hoy mismo sin
                                ningún costo!</p>
                            <Link :href="route('tools.index')"
                                class="inline-block bg-gray-900 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-blue-800 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Probar Ahora
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">SIS<span class="text-yellow-400">U</span></h3>
                    <p class="text-gray-400">Soluciones inteligentes para tu negocio.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Inicio</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Herramientas</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Precios</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Contacto</h4>
                    <p class="text-gray-400">Email: sisuinfo@gmail.com</p>
                    <p class="text-gray-400">Teléfono: +52 000 000 0000</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Síguenos</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Facebook</a>
                        <a href="#"
                            class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Twitter</a>
                        <a href="#"
                            class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">LinkedIn</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup lang="ts">
// Composables
import { Icon } from '@iconify/vue';
// Components
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
</script>

<style>
/* Animaciones */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.delay-100 {
    animation-delay: 0.1s;
}

.delay-200 {
    animation-delay: 0.2s;
}

.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}


/* Animaciones 2 */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    0% {
        opacity: 0;
        transform: translateX(-20px);
    }

    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    0% {
        opacity: 0;
        transform: translateX(20px);
    }

    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in-down {
    animation: fadeInDown 1s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 1s ease-out;
}

.animate-fade-in-left {
    animation: fadeInLeft 1s ease-out;
}

.animate-fade-in-right {
    animation: fadeInRight 1s ease-out;
}
</style>