<script setup lang="ts">
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'

interface Option {
    value: string | number
    label: string
}

interface Props {
    modelValue: string | number | null
    options: Option[]
    placeholder?: string
    searchable?: boolean
    disabled?: boolean
    showOtherOption?: boolean // Nueva prop para controlar la opción "Otro"
    otherOptionLabel?: string
    customValue?: string
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: 'Seleccionar...',
    searchable: true,
    disabled: false,
    showOtherOption: false, // Por defecto, la opción "Otro" estará desactivada
    otherOptionLabel: 'Otro (especificar)',
    customValue: ''
})

const emit = defineEmits(['update:modelValue', 'update:customValue'])

const isOpen = ref(false)
const search = ref('')
const containerRef = ref<HTMLElement | null>(null)
const customInputValue = ref(props.customValue)
const isOtherSelected = ref(false)

const OTHER_OPTION_VALUE = 'other'

const allOptions = computed(() => {
    if (props.showOtherOption) {
        return [...props.options, { value: OTHER_OPTION_VALUE, label: props.otherOptionLabel }]
    }
    return props.options
})

const selectedOption = computed(() =>
    allOptions.value.find(option => option.value === props.modelValue)
)

const filteredOptions = computed(() => {
    if (!search.value) return allOptions.value

    const searchLower = search.value.toLowerCase()
    return allOptions.value.filter(option =>
        option.label.toLowerCase().includes(searchLower)
    )
})

const handleSelect = (option: Option) => {
    emit('update:modelValue', option.value)
    isOtherSelected.value = option.value === OTHER_OPTION_VALUE
    if (!isOtherSelected.value) {
        customInputValue.value = ''
        emit('update:customValue', '')
    }
    isOpen.value = false
    search.value = ''
}

const handleCustomInputChange = (event: Event) => {
    const value = (event.target as HTMLInputElement).value
    customInputValue.value = value
    emit('update:customValue', value)
}

const handleClickOutside = (event: MouseEvent) => {
    if (containerRef.value && !containerRef.value.contains(event.target as Node)) {
        isOpen.value = false
    }
}

watch(() => isOpen.value, (newValue) => {
    if (!newValue) {
        search.value = ''
    }
})

watch(() => props.modelValue, (newValue) => {
    isOtherSelected.value = newValue === OTHER_OPTION_VALUE
})

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <div ref="containerRef" class="relative w-full">
        <!-- Select trigger -->
        <div @click="!disabled && (isOpen = !isOpen)"
            class="w-full px-4 py-2 border rounded-lg cursor-pointer flex justify-between items-center hover:border-blue-500" :class="{
                'border-blue-500': isOpen,
                'border-gray-200': !isOpen,
                'bg-gray-100 cursor-not-allowed': disabled
            }">
            <span :class="{ 'text-gray-400': !selectedOption }">
                {{ selectedOption?.label || placeholder }}
            </span>
            <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': isOpen }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        <!-- Custom input for "Other" option -->
        <div v-if="showOtherOption && isOtherSelected" class="mt-2">
            <input v-model="customInputValue" type="text"
                class="w-full px-4 py-2 border-gray-200 rounded-lg outline-none hover:border-blue-500 focus:border-blue-100"
                placeholder="Crear nuevo dato..." @input="handleCustomInputChange" />
        </div>

        <!-- Dropdown -->
        <div v-if="isOpen" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg">
            <!-- Search input -->
            <div v-if="searchable" class="p-2 border-b">
                <input v-model="search" type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md outline-none hover:border-blue-500 focus:border-blue-100"
                    placeholder="Buscar..." @click.stop>
            </div>

            <!-- Options list -->
            <div class="max-h-60 overflow-y-auto">
                <template v-if="filteredOptions.length">
                    <div v-for="option in filteredOptions" :key="option.value" @click="handleSelect(option)"
                        class="px-4 py-2 cursor-pointer hover:bg-blue-50" :class="{
                            'bg-blue-50': option.value === modelValue
                        }">
                        {{ option.label }}
                    </div>
                </template>
                <div v-else class="px-4 py-2 text-gray-500">
                    No se encontraron resultados
                </div>
            </div>
        </div>
    </div>
</template>