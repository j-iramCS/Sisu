<style>
/* Mejorar el scroll en x e y */
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

<template>
    <Aside />

    <main class="md:ml-64 p-6">
        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-3"> <!-- Boxes -->
                <!-- Cuadro 1 -->
                <div class="col-span-1 mb-4">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Actividades Completadas</p>
                                <p class="text-3xl font-bold">{{ completedActivities }}</p>
                            </div>
                            <Icon icon="ic:baseline-add-task" class="text-4xl text-blue-500" />
                        </div>
                    </div>
                </div>
                <!-- Cuadro 2 -->
                <div class="col-span-1 mb-4">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Actividades Pendientes</p>
                                <p class="text-3xl font-bold">{{ pendingActivities }}</p>
                            </div>
                            <Icon icon="ic:baseline-access-time" class="text-4xl text-blue-500" />
                        </div>
                    </div>
                </div>
                <!-- Cuadro 3 -->
                <div class="col-span-1 mb-4">
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Actividades Canceladas</p>
                                <p class="text-3xl font-bold">{{ cancelledActivities }}</p>
                            </div>
                            <Icon icon="ic:outline-cancel" class="text-4xl text-blue-500" />
                        </div>
                    </div>
                </div>
                <!-- totales -->
                <div class="col-span-1 mb-4">
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Total de Actividades</p>
                                <p class="text-3xl font-bold">{{ totalActivities }}</p>
                            </div>
                            <Icon icon="ic:baseline-all-inbox" class="text-4xl text-blue-500" />
                        </div>
                    </div>
                </div>

            </div>


            <!-- Banner -->
            <div
                class="w-full h-72 flex flex-col md:flex-row items-center bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-2xl overflow-hidden">
                <div class="w-full md:w-1/3 p-8 text-center md:text-left">
                    <h2
                        class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                        ¡Crear una Actividad!
                    </h2>
                    <p class="mt-4 text-gray-600">
                        Explora nuestras nuevas actividades y vive experiencias únicas que te inspirarán.
                    </p>
                    <PrimaryButton @click="openModal" class="mt-6">Nueva Actividad</PrimaryButton>
                </div>
                <div class="w-full md:w-2/3 h-64 md:h-auto overflow-hidden">
                    <img src="/images/banner.webp" alt="Banner Image"
                        class="w-full h-full object-cover transform transition-all hover:scale-110" />
                </div>
            </div>
            <div v-if="activitiesGrouped.length != 0" class="flex gap-2 items-center">
                <PrimaryButton @click="randAct" class="mt-6">Act random</PrimaryButton>
                <PrimaryButton class="mt-6 bg-orange-500 hover:bg-orange-600">Asignar Actividades</PrimaryButton>
                <PrimaryButton class="mt-6 bg-green-500 hover:bg-green-600">Excel</PrimaryButton>
            </div>

            <div
                class="overflow-x-auto rounded-lg shadow-lg mt-6 scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-blue-100 mb-72">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead>
                        <tr v-for="(activities, nombreUtr) in activitiesGrouped" :key="nombreUtr">
                            <td
                                class="px-6 py-4 border-b bg-[#eff5ff] text-blue-700 font-bold text-lg uppercase tracking-wider border-r last:border-r-0">
                                {{ nombreUtr }}
                            </td>
                            <td class="w-full">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-gray-100 to-gray-200">
                                            <th
                                                class="px-6 py-3 min-w-52 max-w-52 font-semibold text-xs uppercase tracking-wider border-r border-gray-300 last:border-r-0">
                                                Actividad
                                            </th>
                                            <th v-for="(month, index) in arrMonths" :key="index"
                                                class="min-w-28 max-w-28 px-6 py-3 font-semibold text-xs text-center uppercase tracking-wider border-r border-gray-300 last:border-r-0">
                                                {{ month.label }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(activity1, nombreActivity) in activities" :key="nombreActivity"
                                            class="hover:bg-gray-50 transition-all">
                                            <td
                                                class="px-6 min-w-52 max-w-52 border-b border-gray-200 font-medium text-gray-700">
                                                {{ nombreActivity }}
                                            </td>
                                            <template v-for="(month, index) in arrMonths" :key="index">

                                                <td class="border-b border-gray-200 border-l align-top max-h-2 pt-[5px]">

                                                    <div v-for="(block, index) in activity1[0].maxBlocks" :key="index"
                                                        class="min-h-5 max-h-5 mb-1">
                                                        <!-- {{ block }} -->

                                                        <template v-for="(activity2, index) in activity1" :key="index">
                                                            <!-- {{ activity2.id }} -->
                                                            <template v-if="block == activity2.bloque">
                                                                <button v-if="buttonsCondition(activity2, month)"
                                                                    @click="openModalActivity(activity2)"
                                                                    :id="'hoverAct-' + activity2.id"
                                                                    @mouseenter="hoverAct(activity2.id, 1)"
                                                                    @mouseleave="hoverAct(activity2.id, 0)"
                                                                    class="bg-blue-100 w-full text-blue-700 mx-auto px-3 border-none outline-none flex items-center justify-center text-sm transition-all duration-200">
                                                                    {{ getDisplayText(activity2, month) }}
                                                                </button>
                                                            </template>

                                                        </template>
                                                    </div>
                                                </td>

                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Modal's -->
            <Modal :show="isModalVisible" maxWidth="2xl" @close="closeModal"> <!-- Modal Crear Actividad -->
                <template #title>
                    Crear una Actividad
                </template>
                <form @submit.prevent="submit" class="p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <InputLabel value="Plazo Inicial de la Actividad"></InputLabel>
                            <DatePicker v-model="startDate" :year-range="[1980, 2040]" />
                        </div>
                        <div>
                            <InputLabel value="Plazo Final de la Actividad"></InputLabel>
                            <DatePicker v-model="endDate" :year-range="[1980, 2040]" />
                        </div>
                    </div>
                    <InputLabel value="Unidad de trabajo"></InputLabel>
                    <Select2 v-model="idUtr" v-model:customValue="otherIdUtr" :options="array_cat_utrs"
                        :showOtherOption="true" placeholder="Seleccionar una Unidad de trabajo" :searchable="true" />

                    <InputLabel value="Nombre de la Actividad"></InputLabel>
                    <Select2 v-model="idActivity" v-model:customValue="otherIdActivity" :options="array_cat_actividades"
                        :showOtherOption="true" placeholder="Seleccionar Actividad" :searchable="true" />

                    <InputLabel value="Descripción de la Actividad"></InputLabel>
                    <textarea rows="3" v-model="activityDescription"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border hover:border-blue-500 border-gray-200 focus:border-blue-100"
                        placeholder="Escribre una descripción para esta actividad..."></textarea>

                    <InputLabel value="Número de horas de la Actividad"></InputLabel>
                    <Input type="number" v-model="activityHours"
                        placeholder="Número de horas que va tomar esta actividad"></Input>



                    <!-- btns -->
                    <div class="flex justify-end">
                        <PrimaryButton class="mt-5" type="submit">Guardar
                        </PrimaryButton>
                    </div>

                </form>
            </Modal>

            <Modal :show="modalActivity" maxWidth="2xl" @close="closeModalActivity"> <!-- Modal Actividad -->
                <template #title>
                    Actividad
                </template>

                <div class="p-6">
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <InputLabel value="Plazo Inicial de la Actividad"></InputLabel>
                            <DatePicker v-model="UPstartDate" :year-range="[1980, 2040]" />
                            <div class="flex gap-2 mt-3">
                                <p class="m-0 p-0">Del</p>
                                <p class="m-0 p-0 ml-1 bg-blue-100 rounded-xl px-5 text-blue-700">
                                    {{ SHdateA ?? '...' }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <InputLabel value="Plazo Final de la Actividad"></InputLabel>
                            <DatePicker v-model="UPendDate" :year-range="[1980, 2040]" />
                            <div class="flex gap-2 mt-3">
                                <p class="m-0 p-0">Al</p>
                                <p class="m-0 p-0 ml-1 bg-red-100 rounded-xl px-5 text-red-700">
                                    {{ SHdateB ?? '...' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <InputLabel value="Unidad de trabajo"></InputLabel>
                    <Select2 v-model="UPidUtr" v-model:customValue="UPotherIdUtr" :options="array_cat_utrs"
                        :showOtherOption="true" placeholder="Seleccionar una Unidad de trabajo" :searchable="true" />

                    <InputLabel value="Nombre de la Actividad"></InputLabel>
                    <Select2 v-model="UPidActivity" v-model:customValue="UPotherIdActivity"
                        :options="array_cat_actividades" :showOtherOption="true" placeholder="Seleccionar Actividad"
                        :searchable="true" />

                    <InputLabel value="Descripción de la Actividad"></InputLabel>
                    <textarea rows="3" v-model="UPactivityDescription"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border hover:border-blue-500 border-gray-200 focus:border-blue-100"
                        placeholder="Escribre una descripción para esta actividad..."></textarea>

                    <InputLabel value="Número de horas de la Actividad"></InputLabel>
                    <Input type="number" v-model="UPactivityHours"
                        placeholder="Número de horas que va tomar esta actividad"></Input>

                    <!-- btns -->
                    <div class="flex justify-end gap-2">
                        <PrimaryButton class="mt-5 bg-red-500 hover:bg-red-600">Eliminar</PrimaryButton>
                        <PrimaryButton class="mt-5">Guardar</PrimaryButton>
                    </div>

                </div>

            </Modal>

        </div>
    </main>

</template>

<script setup lang='ts'>
// Composables
import { ref, defineProps, onMounted } from 'vue';
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import axios from "axios";

// Conponents
import { Link } from "@inertiajs/vue3";
import Aside from '@/Components/Aside.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import DatePicker from '@/Components/DatePicker.vue';
import Select2 from '@/Components/Select2.vue';
import Input from '@/Components/Input.vue';
import Index from '../Tools/Index.vue';

// Props
const props = defineProps({
    totalActivities: { type: Number, default: 0 },
    cancelledActivities: { type: Number, default: 0 },
    pendingActivities: { type: Number, default: 0 },
    completedActivities: { type: Number, default: 0 },

    cat_utrs: {
        type: Array,
        default: () => []
    },
    cat_actividades: {
        type: Array,
        default: () => []
    },
    activitiesGrouped: {
        type: Object,
        default: () => []
    },
    arrMonths: {
        type: Array,
        default: () => []
    },
});

const array_cat_utrs = ref(props.cat_utrs.map((utr: any) => ({
    value: utr.id,
    label: utr.nombre
})));
const array_cat_actividades = ref(props.cat_actividades.map((actividad: any) => ({
    value: actividad.id,
    label: actividad.nombre
})));

// Variables
const isModalVisible = ref(false);
const modalActivity = ref(false);

const startDate = ref<any>(null);
const endDate = ref<any>(null);
const idUtr = ref<any>(null);
const otherIdUtr = ref<any>(null);
const idActivity = ref<any>(null);
const otherIdActivity = ref<any>(null);
const activityDescription = ref<any>(null);
const activitiesGrouped = ref<any>(props.activitiesGrouped);
const activityHours = ref<any>(null);

const UPstartDate = ref<any>(null);
const UPendDate = ref<any>(null);
const UPidUtr = ref<any>(null);
const UPotherIdUtr = ref<any>(null);
const UPidActivity = ref<any>(null);
const UPotherIdActivity = ref<any>(null);
const UPactivityDescription = ref<any>(null);
const UPactivityHours = ref<any>(null);
const SHdateA = ref<any>(null);
const SHdateB = ref<any>(null);

const totalActivities = ref<any>(props.totalActivities);
const cancelledActivities = ref<any>(props.cancelledActivities);
const pendingActivities = ref<any>(props.pendingActivities);
const completedActivities = ref<any>(props.completedActivities);

const arrMonths = ref<any>(props.arrMonths);

// Methods
const openModal = () => {
    isModalVisible.value = true;
}
const closeModal = () => {
    isModalVisible.value = false;
}

const openModalActivity = (activity: any) => {
    console.log(activity);
    SHdateA.value = new Date(new Date(activity.plazo_inicial).setDate(new Date(activity.plazo_inicial).getDate() + 1)).toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
    SHdateB.value = new Date(new Date(activity.plazo_final).setDate(new Date(activity.plazo_final).getDate() + 1)).toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
    UPidUtr.value = activity.id_utr || null;
    UPidActivity.value = activity.id_actividad || null;
    UPactivityDescription.value = activity.descripcion || '';
    UPactivityHours.value = activity.numero_horas || 0;
    modalActivity.value = true;
};

const closeModalActivity = () => {
    modalActivity.value = false;
}

const randAct = () => {
    startDate.value = new Date(2023, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28) + 1);
    endDate.value = new Date(2023, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28) + 1);
    idUtr.value = array_cat_utrs.value[Math.floor(Math.random() * array_cat_utrs.value.length)].value;
    idActivity.value = array_cat_actividades.value[Math.floor(Math.random() * array_cat_actividades.value.length)].value;
    activityDescription.value = "Descripción de actividad random";
    submit();
}

const submit = async () => {

    try {
        const response = await axios.post(route('taskmaster.create'), {
            initialDate: startDate.value,
            finalDate: endDate.value,
            idUtr: idUtr.value,
            otherIdUtr: otherIdUtr.value,
            idActivity: idActivity.value,
            otherIdActivity: otherIdActivity.value,
            activityDescription: activityDescription.value,
            activityHours: activityHours.value
        });

        activitiesGrouped.value = response.data.data;

        toast("Actividad creada correctamente", {
            "theme": "dark",
            "type": "success",
            "dangerouslyHTMLString": true
        })
        isModalVisible.value = false;


    } catch (error) {
        console.log(error);
        toast("Ocurrio un error al crear la actividad", {
            "theme": "dark",
            "type": "error",
            "dangerouslyHTMLString": true
        })
        isModalVisible.value = false;
    }
}

function hoverAct(id: number, opt: number) {
    const hoverAct = document.querySelectorAll(`#hoverAct-${id}`);
    if (opt == 1) {
        hoverAct.forEach((act) => {
            act.classList.add('bg-blue-500');
            act.classList.add('text-white');
        });
    } else {
        hoverAct.forEach((act) => {
            act.classList.remove('bg-blue-500');
            act.classList.remove('text-white');
        });
    }
}

function buttonsCondition(activity2: any, month: any): boolean {
    return (
        month.id === activity2.plazoInicialMes ||
        month.id === activity2.plazoFinalMes ||
        (activity2.plazoInicialMes < month.id && activity2.plazoFinalMes > month.id)
    );
}
function getDisplayText(activity2: any, month: any): string {
    if (month.id === activity2.plazoInicialMes && month.id === activity2.plazoFinalMes) {
        // Si el mes es el mismo para el inicio y el fin, muestra ambos días.
        return `${activity2.plazoInicialDia} | ${activity2.plazoFinalDia}`;
    } else if (month.id === activity2.plazoInicialMes) {
        // Si es el mes inicial, muestra el día inicial.
        return `${activity2.plazoInicialDia}`;
    } else if (month.id === activity2.plazoFinalMes) {
        // Si es el mes final, muestra el día final.
        return `${activity2.plazoFinalDia}`;
    } else if (activity2.plazoInicialMes < month.id && activity2.plazoFinalMes > month.id) {
        // Si el mes está entre el inicio y el fin, muestra puntos suspensivos.
        return '...';
    }
    return '';
}

</script>