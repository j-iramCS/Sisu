<template>
    <aside
        class="fixed inset-y-0 left-0 w-16 bg-gray-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
        <!-- Título -->
        <div class="p-4 border-b border-gray-800">
            <div class="flex items-center justify-center">
                <h3 class="text-xl font-bold">S<span class="text-yellow-400">OK</span></h3>
            </div>
        </div>

        <!-- Menú de Navegación -->
        <nav class="p-2">
            <ul class="space-y-2">
                <li>
                    <Link :href="route('taskmaster.index')"
                        :class="{ 'text-yellow-400': route().current('taskmaster.index'), 'text-gray-400': !route().current('taskmaster.index') }"
                        class="flex items-center justify-center p-2 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                        @mouseenter="showTooltip('Home')" @mouseleave="hideTooltip">
                    <Icon icon="ic:baseline-home" class="text-lg" />
                    <span v-if="activeTooltip === 'Home'" class="tooltip">Home</span>
                    </Link>
                </li>
                <li>
                    <Link href="#"
                        class="flex hidden items-center justify-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                        @mouseenter="showTooltip('Dashboard')" @mouseleave="hideTooltip">
                    <Icon icon="ic:baseline-dashboard" class="text-lg" />
                    <span v-if="activeTooltip === 'Dashboard'" class="tooltip">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <a href="#"
                        class="flex hidden items-center justify-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                        @mouseenter="showTooltip('Actividades')" @mouseleave="hideTooltip">
                        <Icon icon="ic:outline-checklist" class="text-lg" />
                        <span v-if="activeTooltip === 'Actividades'" class="tooltip">Actividades</span>
                    </a>
                </li>
                <li>
                    <Link :href="route('taskmaster.index.teams')"
                        :class="{ 'text-yellow-400': route().current('taskmaster.index.teams'), 'text-gray-400': !route().current('taskmaster.index.teams') }"
                        class="flex items-center justify-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                        @mouseenter="showTooltip('Grupos de trabajo')" @mouseleave="hideTooltip">
                    <Icon icon="ic:baseline-group" class="text-lg" />
                    <span v-if="activeTooltip === 'Grupos de trabajo'" class="tooltip">Grupos de trabajo</span>
                    </Link>
                </li>
                <li>
                    <Link href="#"
                        class="flex items-center justify-center p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                        @mouseenter="showTooltip('Configuración')" @mouseleave="hideTooltip">
                    <Icon icon="ic:baseline-settings" class="text-lg" />
                    <span v-if="activeTooltip === 'Configuración'" class="tooltip">Configuración</span>
                    </Link>
                </li>
            </ul>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-2 border-t border-gray-800">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button"
                class="w-full flex items-center justify-center p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800 rounded-lg transition-colors duration-300"
                @mouseenter="showTooltip('Cerrar Sesión')" @mouseleave="hideTooltip">
                <Icon icon="ic:baseline-logout" class="text-lg" />
                <span v-if="activeTooltip === 'Cerrar Sesión'" class="tooltip">Cerrar Sesión</span>
            </ResponsiveNavLink>
        </div>
    </aside>

    <AsideBotton />
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Icon } from '@iconify/vue';
import ResponsiveNavLink from './ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import AsideBotton from './AsideBotton.vue';

const activeTooltip = ref<string | null>(null);

const showTooltip = (tooltip: string) => {
    activeTooltip.value = tooltip;
};

const hideTooltip = () => {
    activeTooltip.value = null;
};
</script>

<style scoped>
.tooltip {
    position: absolute;
    left: 64px;
    background-color: #111827;
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius:  0 2rem 2rem 0;
    white-space: nowrap;
    z-index: 100;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>