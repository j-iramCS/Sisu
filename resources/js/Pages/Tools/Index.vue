<template>
    <div class="min-h-screen bg-gray-50">

        <!-- Navbar -->
        <Navbar />

        <!-- Sección de Sistemas -->
        <section class="max-w-7xl mx-auto px-6 py-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-blue-900">Nuestros Sistemas</h2>
            <p class="text-center text-lg text-gray-600 mb-12">Explora nuestras soluciones tecnológicas diseñadas para
                optimizar y mejorar tus procesos. Tenemos opciones gratuitas y de pago para adaptarnos a tus
                necesidades.</p>

            <!-- Filtros -->
            <div class="flex justify-center space-x-4 mb-12">
                <button
                    class="bg-blue-900 text-white px-6 py-2 rounded-full hover:bg-blue-800 transition-colors duration-300">Todos</button>
                <button
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition-colors duration-300">Gratuitos</button>
                <button
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition-colors duration-300">De
                    Pago</button>
            </div>

            <!-- Listado de Sistemas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Sistema 1: Gestión de Recursos Humanos -->
                <Link :href="route('taskmaster.index')"
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                <div class="text-blue-600 text-5xl mb-4">
                    <Icon icon="ic:baseline-add-task" />
                </div>
                <h3 class="text-2xl font-bold mb-4 text-blue-900">TaskMaster</h3>
                <p class="text-gray-600 mb-4">Facilitar la creación, organización, asignación y seguimiento de
                    tareas de manera eficiente. </p>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Gratuito</span>
                </Link>

                <!-- Sistema 1: Gestión de Recursos Humanos -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-blue-600 text-5xl mb-4">
                        <Icon icon="ic:baseline-people" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión de Recursos Humanos (HRM)</h3>
                    <p class="text-gray-600 mb-4">Gestiona nómina, asistencia, vacaciones, evaluación de desempeño y
                        más.</p>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Gratuito</span>
                </div>

                <!-- Sistema 2: Gestión de Inventarios -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-purple-600 text-5xl mb-4">
                        <Icon icon="ic:outline-inventory" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión de Inventarios</h3>
                    <p class="text-gray-600 mb-4">Controla el stock de productos, notifica bajos inventarios y gestiona
                        proveedores.</p>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">De Pago</span>
                </div>

                <!-- Sistema 3: Gestión de Proyectos -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-yellow-400 text-5xl mb-4">
                        <Icon icon="ic:baseline-assignment" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión de Proyectos</h3>
                    <p class="text-gray-600 mb-4">Planifica, ejecuta y haz seguimiento de proyectos con asignación de
                        tareas y recursos.</p>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Gratuito</span>
                </div>

                <!-- Sistema 4: Gestión de Clientes (CRM) -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-blue-600 text-5xl mb-4">
                        <Icon icon="ic:baseline-people" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión de Clientes (CRM)</h3>
                    <p class="text-gray-600 mb-4">Mejora la relación con tus clientes y gestiona el ciclo de vida del
                        cliente.</p>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">De Pago</span>
                </div>

                <!-- Sistema 5: Gestión Financiera -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-purple-600 text-5xl mb-4">
                        <Icon icon="ic:baseline-account-balance" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión Financiera</h3>
                    <p class="text-gray-600 mb-4">Controla ingresos, egresos, facturación y genera reportes contables.
                    </p>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Gratuito</span>
                </div>

                <!-- Sistema 6: Gestión de Compras -->
                <div
                    class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 hover:transition-all">
                    <div class="text-yellow-400 text-5xl mb-4">
                        <Icon icon="ic:outline-shopping-cart" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-900">Gestión de Compras</h3>
                    <p class="text-gray-600 mb-4">Gestiona solicitudes de compra, órdenes de compra y pagos a
                        proveedores.</p>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">De Pago</span>
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
import { Head, Link } from '@inertiajs/vue3';

// Components
import Navbar from '@/Components/Navbar.vue';


</script>