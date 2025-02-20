<!-- DatePicker.vue -->
<template>
    <div class="relative w-full">
        <!-- Input field -->
        <div ref="triggerRef" @click="toggleCalendar"
            class="w-full px-4 py-2 border border-gray-200 rounded-md shadow-sm cursor-pointer hover:border-blue-500 transition-all duration-200 flex items-center justify-between focus-within:ring-2 focus-within:ring-blue-500">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-gray-700" :class="{
                    'text-gray-400': !selectedDate,
                }">
                    {{ selectedDateFormatted || t("selectDate") }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <button v-if="selectedDate" @click.stop="clearDate" type="button"
                    class="p-1 hover:bg-gray-100 rounded-full">
                    <svg class="w-[15px] h-[15px] mr-[3px] text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <svg class="w-[15px] h-[15px] mr-[3px] text-gray-500 transition-transform duration-200"
                    :class="{ 'rotate-180': isOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        <!-- Calendar Popup -->
        <div v-if="isOpen" ref="calendarRef"
            class="absolute mt-2 p-4 bg-white border border-gray-200 rounded-xl shadow-xl z-50 w-80 transform transition-all duration-200"
            @click.stop>
            <!-- Header with language selector -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-gray-700">
                    {{ currentMonthName }} {{ currentYear }}
                </h2>
                <div class="flex items-center gap-2">
                    <button v-for="lang in ['es', 'en']" :key="lang" @click="setLocale(lang)" type="button"
                        class="px-2 py-1 text-sm rounded-md transition-colors" :class="locale === lang
                            ? 'bg-blue-500 text-white'
                            : 'text-gray-500 hover:bg-gray-100'
                            ">
                        {{ lang.toUpperCase() }}
                    </button>
                </div>
            </div>

            <!-- Month Navigation -->
            <div class="flex items-center justify-between mb-4">
                <button @click="changeMonth(-1)" type="button"
                    class="p-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Month/Year Selection -->
                <div class="flex gap-2">
                    <select v-model="currentMonth"
                        class="px-2 pr-7 py-1 border border-gray-200 rounded-lg bg-white text-gray-700 cursor-pointer hover:border-blue-500 focus:outline-none focus:border-blue-500">
                        <option v-for="(month, index) in months" :key="month" :value="index">
                            {{ month }}
                        </option>
                    </select>
                    <select v-model="currentYear"
                        class="px-2 pr-7 py-1 border border-gray-200 rounded-lg bg-white text-gray-700 cursor-pointer hover:border-blue-500 focus:outline-none focus:border-blue-500">
                        <option v-for="year in yearRange" :key="year" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>

                <button @click="changeMonth(1)" type="button"
                    class="p-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Calendar Grid -->
            <div class="mb-2">
                <!-- Days of week -->
                <div class="grid grid-cols-7 mb-1">
                    <div v-for="day in daysOfWeek" :key="day"
                        class="h-8 flex items-center justify-center text-sm font-medium text-gray-500">
                        {{ day }}
                    </div>
                </div>

                <!-- Calendar days -->
                <div class="grid grid-cols-7 gap-1">
                    <div v-for="empty in firstDayOfMonth" :key="`empty-${empty}`" class="h-8"></div>
                    <button v-for="day in daysInMonth" :key="day" @click="selectDate(day)" type="button"
                        class="h-8 w-8 flex items-center justify-center text-sm rounded-lg transition-all duration-200"
                        :class="[
                            isSelected(day)
                                ? 'bg-blue-500 text-white font-medium hover:bg-blue-600'
                                : 'text-gray-700 hover:bg-gray-100',
                            isToday(day)
                                ? 'ring-2 ring-blue-500'
                                : '',
                        ]">
                        {{ day }}
                    </button>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="flex justify-between pt-3 mt-3 border-t border-gray-200">
                <button @click="goToToday" type="button"
                    class="px-3 py-1 text-sm text-blue-500 hover:bg-blue-50 rounded-md transition-colors">
                    {{ t("today") }}
                </button>
                <button @click="isOpen = false" type="button"
                    class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-md transition-colors">
                    {{ t("close") }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
// import { ref, computed } from "vue";
import { ref, computed, onMounted, onUnmounted } from "vue";

interface Props {
    modelValue?: Date;
    yearRange?: [number, number];
}

const props = withDefaults(defineProps<Props>(), {
    modelValue: undefined,
    yearRange: () => [1900, 2100],
});

const emit = defineEmits<{
    (e: "update:modelValue", value: Date | null): void;
}>();

// Estado
const isOpen = ref(false);
const locale = ref<"es" | "en">("es");
const currentDate = ref(new Date());
const selectedDate = ref<Date | null>(
    props.modelValue ? new Date(props.modelValue) : null
);
const calendarRef = ref<HTMLElement | null>(null);
const triggerRef = ref<HTMLElement | null>(null);

// Tipos
type Translations = {
    es: {
        months: string[];
        daysOfWeek: string[];
        selectDate: string;
        today: string;
        close: string;
    };
    en: {
        months: string[];
        daysOfWeek: string[];
        selectDate: string;
        today: string;
        close: string;
    };
};

// Traducciones
const translations: Translations = {
    es: {
        months: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        daysOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        selectDate: "Seleccionar fecha",
        today: "Hoy",
        close: "Cerrar",
    },
    en: {
        months: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ],
        daysOfWeek: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        selectDate: "Select date",
        today: "Today",
        close: "Close",
    },
};

// Computed
const months = computed(() => translations[locale.value].months);
const daysOfWeek = computed(() => translations[locale.value].daysOfWeek);

const currentYear = computed({
    get: () => currentDate.value.getFullYear(),
    set: (year: number) => {
        currentDate.value = new Date(year, currentDate.value.getMonth(), 1);
    },
});

const currentMonth = computed({
    get: () => currentDate.value.getMonth(),
    set: (month: number) => {
        currentDate.value = new Date(currentDate.value.getFullYear(), month, 1);
    },
});

const currentMonthName = computed(() => months.value[currentMonth.value]);

const yearRange = computed(() => {
    const years: number[] = [];
    for (let year = props.yearRange[0]; year <= props.yearRange[1]; year++) {
        years.push(year);
    }
    return years;
});

const daysInMonth = computed(() => {
    return new Date(currentYear.value, currentMonth.value + 1, 0).getDate();
});

const firstDayOfMonth = computed(() => {
    return new Date(currentYear.value, currentMonth.value, 1).getDay();
});

const selectedDateFormatted = computed(() => {
    if (!selectedDate.value) return "";
    return selectedDate.value.toLocaleDateString(
        locale.value === "es" ? "es-ES" : "en-US",
        {
            day: "2-digit",
            month: "long",
            year: "numeric",
        }
    );
});

// Methods
const t = (key: keyof typeof translations.en) =>
    translations[locale.value][key];

const setLocale = (newLocale: string) => {
    if (newLocale === "es" || newLocale === "en") {
        locale.value = newLocale;
    }
};

const toggleCalendar = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        calculatePosition();
    }
};

const changeMonth = (delta: number) => {
    currentDate.value = new Date(
        currentYear.value,
        currentMonth.value + delta,
        1
    );
};

const isSelected = (day: number): boolean => {
    if (!selectedDate.value) return false;
    return (
        selectedDate.value.getDate() === day &&
        selectedDate.value.getMonth() === currentMonth.value &&
        selectedDate.value.getFullYear() === currentYear.value
    );
};

const isToday = (day: number): boolean => {
    const today = new Date();
    return (
        today.getDate() === day &&
        today.getMonth() === currentMonth.value &&
        today.getFullYear() === currentYear.value
    );
};

const selectDate = (day: number) => {
    const newDate = new Date(currentYear.value, currentMonth.value, day);
    selectedDate.value = newDate;
    emit("update:modelValue", newDate);
    isOpen.value = false;
};

const clearDate = () => {
    selectedDate.value = null;
    emit("update:modelValue", null);
};

const goToToday = () => {
    const today = new Date();
    currentDate.value = new Date(today.getFullYear(), today.getMonth(), 1);
    selectDate(today.getDate());
};

const handleClickOutside = (event: MouseEvent) => {
    const target = event.target as Node;
    if (
        isOpen.value &&
        calendarRef.value &&
        !calendarRef.value.contains(target) &&
        triggerRef.value &&
        !triggerRef.value.contains(target)
    ) {
        isOpen.value = false;
    }
};


// CALCULAR POSICIÓN DEL CALENDARIO
const calculatePosition = () => {
    if (!triggerRef.value || !calendarRef.value) return;

    const triggerRect = triggerRef.value.getBoundingClientRect();
    const calendarRect = calendarRef.value.getBoundingClientRect();

    const spaceBelow = window.innerHeight - triggerRect.bottom;
    const spaceAbove = triggerRect.top;

    if (spaceBelow < calendarRect.height && spaceAbove > calendarRect.height) {
        calendarRef.value.style.top = `-${calendarRect.height + 10}px`;
    } else {
        calendarRef.value.style.top = "100%";
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>
