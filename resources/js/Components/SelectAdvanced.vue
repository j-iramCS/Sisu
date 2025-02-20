<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Icon } from '@iconify/vue';

const props = defineProps<{
    options: Array<{ value: number; label: string; icon?: string }>;
    modelValue: string | null;
    search?: boolean; // Nueva propiedad para controlar la búsqueda
}>();

const emit = defineEmits(['update:modelValue']);

// Termino de búsqueda y visibilidad del dropdown
const searchTerm = ref('');
const isDropdownOpen = ref(false);

// Referencia al contenedor del componente
const dropdownRef = ref<HTMLElement | null>(null);

// Filtrar las opciones según el término de búsqueda
const filteredOptions = computed(() =>
    props.options.filter(option =>
        option.label.toLowerCase().includes(searchTerm.value.toLowerCase())
    )
);

// Seleccionar una opción
const selectOption = (option: any) => {
    emit('update:modelValue', option.value);
    isDropdownOpen.value = false;
};

// Alternar dropdown
const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

// Cerrar dropdown al hacer clic fuera
const handleClickOutside = (event: MouseEvent) => {
    if (
        dropdownRef.value &&
        !dropdownRef.value.contains(event.target as Node)
    ) {
        isDropdownOpen.value = false;
    }
};

// Montar y desmontar el evento global
onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="relative w-full" ref="dropdownRef">
        <!-- Selector principal -->
        <div @click="toggleDropdown"
            class="flex items-center justify-between w-full px-4 py-2 border rounded-lg cursor-pointer bg-gray-50">
            <span>
                {{
                    props.options.find(option => option.value === props.modelValue)?.label ||
                    'Selecciona una opción'
                }}
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Dropdown -->
        <div v-show="isDropdownOpen"
            class="absolute z-50 w-full mt-2 bg-white border rounded-lg shadow-lg">
            <!-- Barra de búsqueda -->
            <div v-if="props.search" class="p-2">
                <input v-model="searchTerm" type="text"
                    class="w-full px-3 py-2 border rounded-lg"
                    placeholder="Search..." />
            </div>

            <!-- Opciones -->
            <ul class="max-h-48 overflow-y-auto scrollbar-thin scrollbar-track-transparent scrollbar-thumb-gray-300">
                <li v-for="option in filteredOptions" :key="option.value" @click="selectOption(option)"
                    class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 ">
                    <Icon v-if="option.icon" :icon="option.icon" class="mr-2" />
                    <span>{{ option.label }}</span>
                </li>
            </ul>

            <!-- Sin resultados -->
            <p v-if="filteredOptions.length === 0" class="p-4 text-sm text-center text-gray-500 ">
                No results found.
            </p>
        </div>
    </div>
</template>

<style>
.scrollbar-thin {
    scrollbar-width: thin;
}

.scrollbar-track-transparent {
    scrollbar-color: transparent transparent;
}

.scrollbar-thumb-gray-300 {
    scrollbar-color: rgba(107, 114, 128, 0.5) transparent;
}

.scrollbar-thin::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: rgba(107, 114, 128, 0.5);
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background-color: transparent;
}
</style>
