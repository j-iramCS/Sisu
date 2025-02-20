<template>
    <aside
        class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
        <!-- Título -->
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-end justify-between">
                <h3 class="text-xl font-bold">SIS<span class="text-yellow-400">U</span></h3>
                <Link :href="route('tools.index')" class="text-sm text-gray-400 underline">Inicio</Link>


            </div>
            <div class="flex items-center gap-2 mt-2">
                <Icon icon="ic:baseline-add-task" class="text-blue-400 text-xl" />
                <p class="text-base text-gray-400">TaskMaster</p>
            </div>
        </div>

        <!-- Menú de Navegación -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-dashboard" class="text-lg mr-3" />
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:outline-checklist" class="text-lg mr-3" />
                        <span>Actividades</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-group" class="text-lg mr-3" />
                        <span>Grupos de trabajo</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-settings" class="text-lg mr-3" />
                        <span>Configuración</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-800">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                class="w-full flex items-center p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                <Icon icon="ic:baseline-logout" class="text-lg mr-3" />
                <span>Cerrar Sesión</span>
            </ResponsiveNavLink>
        </div>
    </aside>


    <AsideBotton />


</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue';

import ResponsiveNavLink from './ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import AsideBotton from './AsideBotton.vue';
</script>

<style scoped>
</style>