<template>
    <!-- Barra de Navegación Inferior -->
    <div class="fixed inset-x-0 bottom-0 bg-gray-900 text-white z-50 md:hidden">
        <!-- Iconos de Navegación -->
        <div class="flex justify-around p-2">
            <a href="#"
                class="flex items-center p-2 text-gray-400 hover:text-yellow-400 rounded-lg transition-colors duration-300">
                <Icon icon="ic:baseline-dashboard" class="text-lg" />
            </a>
            <a href="#"
                class="flex items-center p-2 text-gray-400 hover:text-yellow-400 rounded-lg transition-colors duration-300">
                <Icon icon="ic:outline-checklist" class="text-lg" />
            </a>
            <a href="#"
                class="flex items-center p-2 text-gray-400 hover:text-yellow-400 rounded-lg transition-colors duration-300">
                <Icon icon="ic:baseline-show-chart" class="text-lg" />
            </a>
            <a href="#"
                class="flex items-center p-2 text-gray-400 hover:text-yellow-400 rounded-lg transition-colors duration-300">
                <Icon icon="ic:baseline-settings" class="text-lg" />
            </a>
            <button @click="toggleMenu"
                class="flex items-center p-2 text-gray-400 hover:text-yellow-400 rounded-lg transition-colors duration-300">
                <Icon :icon="isMenuOpen ? 'ic:baseline-close' : 'ic:baseline-menu'" class="text-lg" />
            </button>
        </div>

        <!-- Menú Expandible -->
        <div v-if="isMenuOpen"
            class="absolute bottom-12 left-0 right-0 bg-gray-900 p-4 shadow-lg max-h-[60vh] overflow-y-auto transition-all duration-300 transform"
            :class="{ 'translate-y-0 opacity-100': isMenuOpen, 'translate-y-4 opacity-0': !isMenuOpen }">
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
                        <span>Tareas</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-show-chart" class="text-lg mr-3" />
                        <span>Reportes</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-settings" class="text-lg mr-3" />
                        <span>Configuración</span>
                    </a>
                </li>
                <!-- Más opciones de ejemplo -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-people" class="text-lg mr-3" />
                        <span>Equipo</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-notifications" class="text-lg mr-3" />
                        <span>Notificaciones</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-help" class="text-lg mr-3" />
                        <span>Ayuda</span>
                    </a>
                </li>
                <li>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                        class="w-full flex items-center p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800 rounded-lg transition-colors duration-300">
                        <Icon icon="ic:baseline-logout" class="text-lg mr-3" />
                        <span>Cerrar Sesión</span>
                    </ResponsiveNavLink>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Icon } from '@iconify/vue';
import ResponsiveNavLink from './ResponsiveNavLink.vue';

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
</script>

<style scoped>
/* Animación de entrada */
.fixed {
    animation: slideIn 0.2s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateY(100%);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Estilos para el scroll */
.max-h-\[60vh\] {
    max-height: 60vh;
}

.overflow-y-auto {
    overflow-y: auto;
}

/* Estilos para la animación del menú */
.transition-all {
    transition: all 0.3s ease;
}

.transform {
    transform: translateY(0);
}

.translate-y-0 {
    transform: translateY(0);
}

.translate-y-4 {
    transform: translateY(1rem);
}

.opacity-100 {
    opacity: 1;
}

.opacity-0 {
    opacity: 0;
}
</style>