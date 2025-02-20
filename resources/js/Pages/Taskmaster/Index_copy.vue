<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Aside -->
        <Aside />

        <!-- Contenido Principal -->
        <main class="md:ml-64 p-6">
            <div class="max-w-7xl mx-auto">

                <div class="relative h-64 overflow-hidden rounded-lg">
                    <!-- Imagen de fondo -->
                    <img src="/images/banner.webp" alt="Banner de actividad" class="w-full h-full object-cover" />

                    <!-- Capa de superposición y contenido -->
                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                        <div class="text-center text-white">
                            <!-- Texto del banner -->
                            <label class="text-4xl font-bold mb-4 block">
                                Crear una Actividad
                            </label>
                            <!-- Botón -->
                            <PrimaryButton @click="openModal" class="">Nueva Actividad</PrimaryButton>

                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 my-4">
                    <PrimaryButton class="" @click="generateRandomActivities">
                        Actividad Random
                    </PrimaryButton>

                    <PrimaryButton @click="exportJSON">
                        Exportar Actividades
                    </PrimaryButton>

                    <div class="relative">
                        <input type="file" @change="importJSON" accept=".json"
                            class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" />
                        <PrimaryButton class="bg-green-500">
                            Importar Actividades
                        </PrimaryButton>
                    </div>

                    <PrimaryButton @click="clearLocalStorage" class="bg-red-500">
                        Limpiar LocalStorage
                    </PrimaryButton>
                </div>

                <div class="relative overflow-x-auto shadow-lg mt-5 rounded-xl">
                    <table class="w-full text-sm text-left text-gray-600">
                        <tbody>
                            <!-- UNE -->
                            <tr v-for="(une) in unesTable" :key="une.id" class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap  border-slate-300">
                                    {{ une.name }}
                                </th>

                                <table class="w-full text-sm text-left text-gray-600">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                        <!-- Months -->
                                        <tr class="border-l border-r border-slate-300">
                                            <th scope="col" class="px-6 py-3 text-center">Actividad</th>
                                            <th v-for="(month) in mothsTable" :key="month.id" scope="col"
                                                class="px-6 py-3 text-center">
                                                {{ month.monthName }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Activities -->
                                        <template v-for="(activity) in activitiesTable" :key="activity.id">
                                            <tr v-if="une.id == activity.idUne" class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 border-collapse border border-slate-300 text-nowrap">
                                                    {{ activity.name }}
                                                </td>
                                                <!-- Hours -->
                                                <td v-for="(month) in mothsTable" :key="month.id"
                                                    class="px-2 py-4 text-center border-collapse border border-slate-300">
                                                    <template v-for="(hour) in hoursTable" :key="hour.id">
                                                        <template
                                                            v-if="hour.month === month.id && hour.idActivity === activity.id && une.id == hour.une">
                                                            <p
                                                                class="shadow-md px-6 py-1 my-1 rounded-md cursor-pointer bg-blue-50 hover:bg-blue-100 transition duration-300">
                                                                {{ hour.hours }}
                                                            </p>
                                                        </template>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <Modal :show="isModalVisible" maxWidth="2xl" @close="closeModal">
                <template #default>
                    <form @submit.prevent="submit">
                        <div class="p-6">

                            <div class="flex items-center justify-between">
                                <h2 class="text-xl dark:text-white">
                                    Crear una nueva actividad
                                </h2>
                                <button @click="closeModal" type="button" class="rounded-full text-2xl p-2 bg-red-300">
                                    <Icon icon="material-symbols:close" />
                                </button>
                            </div>

                            <br />

                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <InputLabel value="Fecha de inicio de la Actividad"></InputLabel>
                                    <DatePicker v-model="startDate" :year-range="[2000, 2030]" />
                                    <!-- <p v-if="errors.startDate" class="text-red-500">{{ errors.startDate }}</p> -->
                                </div>
                                <div>
                                    <InputLabel value="Fecha final de la Actividad"></InputLabel>
                                    <DatePicker v-model="endDate" :year-range="[2000, 2030]" />
                                    <!-- <p v-if="errors.endDate" class="text-red-500">{{ errors.endDate }}</p> -->
                                </div>
                            </div>

                            <InputLabel value="Unidad de negocio"></InputLabel>
                            <SelectAdvanced :options="unes" v-model="selectUne" />
                            <!-- <p v-if="errors.selectUne" class="text-red-500">{{ errors.selectUne }}</p> -->


                            <InputLabel value="Actividad"></InputLabel>
                            <SelectAdvanced :options="activities" v-model="selectActivity" />
                            <!-- <p v-if="errors.selectActivity" class="text-red-500">{{ errors.selectActivity }}</p> -->

                            <InputLabel value="Descripción"></InputLabel>
                            <textarea rows="3" v-model="inputDescription"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-transparent dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                            <!-- <p v-if="errors.inputDescription" class="text-red-500">{{ errors.inputDescription }}</p> -->

                            <div>
                                <InputLabel value="Número de horas de la actividad"></InputLabel>
                                <Input type="number" v-model="numHours" placeholder="5 Hours" />
                                <!-- <p v-if="errors.numHours" class="text-red-500">{{ errors.numHours }}</p> -->
                            </div>

                            <InputLabel value="Repeticion de la actividad"></InputLabel>
                            <SelectAdvanced :options="repits" v-model="selectRepit" />
                            <!-- <p v-if="errors.selectRepit" class="text-red-500">{{ errors.selectRepit }}</p> -->

                            <!-- btns -->
                            <div class="flex justify-end">
                                <PrimaryButton class="mt-5">Guardar
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </template>
            </Modal>

        </main>
    </div>
</template>

<script setup lang='ts'>
// Composables
import { onMounted, ref } from "vue";
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { Link } from "@inertiajs/vue3";

// Components
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Aside from '@/Components/Aside.vue';
import Modal from "@/Components/Modal.vue";
import SelectAdvanced from "@/Components/SelectAdvanced.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DatePicker from "@/Components/DatePicker.vue";
import Input from "@/Components/Input.vue";

// Variables
const numHours = ref<any>("");
const selectUne = ref<any>(null);
const selectActivity = ref<any>(null);
const selectRepit = ref<any>(null);
const startDate = ref<any>();
const endDate = ref<any>();
const inputDescription = ref<any>("");

// Modal
const isModalVisible = ref(false);
const openModal = () => {
    isModalVisible.value = true;
};
const closeModal = () => {
    isModalVisible.value = false;
};

// Select
const unes = [
    { value: "Unidad de negocio 1", label: "Unidad de negocio 1", icon: "bxs:business" },
    { value: "Unidad de negocio 2", label: "Unidad de negocio 2", icon: "bxs:business" },
    { value: "Unidad de negocio 3", label: "Unidad de negocio 3", icon: "bxs:business" },
    { value: "Unidad de negocio 4", label: "Unidad de negocio 4", icon: "bxs:business" },
    { value: "Unidad de negocio 5", label: "Unidad de negocio 5", icon: "bxs:business" },
];
const activities = [
    { value: "Actividad 1", label: "Actividad 1", icon: "icon-park-solid:sport" },
    { value: "Actividad 2", label: "Actividad 2", icon: "icon-park-solid:sport" },
    { value: "Actividad 3", label: "Actividad 3", icon: "icon-park-solid:sport" },
    { value: "Actividad 4", label: "Actividad 4", icon: "icon-park-solid:sport" },
    { value: "Actividad 5", label: "Actividad 5", icon: "icon-park-solid:sport" },
];
const repits = [
    { value: "0", label: "No se repite", icon: "tabler:cancel" },
    { value: "1", label: "Cada Mes", icon: "cil:loop-circular" },
    { value: "2", label: "Cada 2 Meses", icon: "cil:loop-circular" },
    { value: "3", label: "Cada 3 Meses", icon: "cil:loop-circular" },
    { value: "4", label: "Cada 4 Meses", icon: "cil:loop-circular" },
    { value: "5", label: "Cada 5 Meses", icon: "cil:loop-circular" },
    { value: "6", label: "Cada 6 Meses", icon: "cil:loop-circular" },
    { value: "7", label: "Cada 7 Meses", icon: "cil:loop-circular" },
    { value: "8", label: "Cada 8 Meses", icon: "cil:loop-circular" },
    { value: "9", label: "Cada 9 Meses", icon: "cil:loop-circular" },
    { value: "10", label: "Cada 10 Meses", icon: "cil:loop-circular" },
    { value: "11", label: "Cada 11 Meses", icon: "cil:loop-circular" },
    { value: "12", label: "Cada 12 Meses", icon: "cil:loop-circular" },
];

// DataTable
const columns = [
    { key: "id", label: "ID" },
    { key: "name", label: "Nombre" },
    { key: "email", label: "Email" },
];
const data = [
    { id: 1, name: "Juan", email: "juan@example.com" },
    { id: 2, name: "María", email: "maria@example.com" },
    // ... más datos
];

// Data to create the table of activities
const mothsTable = [
    { id: 1, month: 1, monthName: "Enero" },
    { id: 2, month: 2, monthName: "Febrero" },
    { id: 3, month: 3, monthName: "Marzo" },
    { id: 4, month: 4, monthName: "Abril" },
    { id: 5, month: 5, monthName: "Mayo" },
    { id: 6, month: 6, monthName: "Junio" },
    { id: 7, month: 7, monthName: "Julio" },
    { id: 8, month: 8, monthName: "Agosto" },
    { id: 9, month: 9, monthName: "Septiembre" },
    { id: 10, month: 10, monthName: "Octubre" },
    { id: 11, month: 11, monthName: "Noviembre" },
    { id: 12, month: 12, monthName: "Diciembre" },
];
const hoursTable: any = ref([]);
const activitiesTable: any = ref([]);
const unesTable: any = ref([]);


const submit = () => {
    try {
        const une = selectUne.value;
        const activity = selectActivity.value;

        const numberUne = extractNumber(une);
        const numberActivity = extractNumber(activity);

        if (!numberUne || !numberActivity) {
            toast("No se pudieron procesar los números de UNE o Actividad!", {
                "theme": "dark",
                "type": "error",
                "dangerouslyHTMLString": true
            })
            return;
        }

        const date = new Date(startDate.value);
        const month = date.getMonth() + 1;

        const uneId = Number(numberUne);
        const activityId = Number(numberActivity);

        if (!unesTable.value.some((u: any) => Number(u.id) === uneId)) {
            unesTable.value.push({
                id: uneId,
                name: une
            });
        }

        // Verificar si la actividad existe para esta UNE específica
        const existingActivity = activitiesTable.value.find((a: any) => Number(a.id) === activityId && Number(a.idUne) === uneId);

        if (!existingActivity) {
            // Si la actividad no existe para esta UNE, agregarla
            activitiesTable.value.push({
                id: activityId,
                idUne: uneId,
                name: activity,
                repit: selectRepit.value,
                startDate: startDate.value,
                endDate: endDate.value,
                description: inputDescription.value,
                numHours: numHours.value
            });
        }

        // Verificar si ya existe una entrada para esta actividad en este mes
        const existingHour = hoursTable.value.find(
            (h: any) => Number(h.idActivity) === activityId &&
                Number(h.une) === uneId &&
                Number(h.month) === month
        );

        hoursTable.value.push({
            id: generateUniqueId(), // Nueva función para generar IDs únicos
            idActivity: activityId,
            une: uneId,
            month: month,
            hours: numHours.value
        });
        // if (existingHour) {
        //     // Si ya existe, actualizar las horas
        //     existingHour.hours = numHours.value;
        // } else {
        //     // Si no existe, crear nueva entrada
        //     hoursTable.value.push({
        //         id: generateUniqueId(), // Nueva función para generar IDs únicos
        //         idActivity: activityId,
        //         une: uneId,
        //         month: month,
        //         hours: numHours.value
        //     });
        // }

        clearForm();
        closeModal();
        console.log('Actividad guardada:', hoursTable.value);

        toast("Se creo una nueva actividad", {
            "theme": "dark",
            "type": "success",
            "dangerouslyHTMLString": true
        })
        console.log(unesTable.value);

    } catch (error) {
        console.error('Error al guardar la actividad:', error);
        toast("Hubo un problema al crear la actividad", {
            "theme": "dark",
            "type": "error",
            "dangerouslyHTMLString": true,
        })
        closeModal();
    }
};

// Función auxiliar para extraer números de strings
const extractNumber = (str: any) => {
    const match = str.match(/\d+/);
    return match ? match[0] : null;
};

// Función para generar IDs únicos
const generateUniqueId = () => {
    return Date.now() + Math.floor(Math.random() * 1000);
};

// Función para limpiar el formulario
const clearForm = () => {
    selectUne.value = null;
    selectActivity.value = null;
    selectRepit.value = null;
    startDate.value = null;
    endDate.value = null;
    numHours.value = "";
    inputDescription.value = "";
};

// actividades random
const generateRandomActivities = () => {
    try {
        const randomUne = unes[Math.floor(Math.random() * unes.length)];
        const randomActivity = activities[Math.floor(Math.random() * activities.length)];
        const randomRepit = repits[Math.floor(Math.random() * repits.length)];
        const randomHours = Math.floor(Math.random() * 10) + 1;
        const randomStartDate = new Date(2022, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28) + 1);
        const randomEndDate = new Date(2022, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28) + 1);

        selectUne.value = randomUne.value;
        selectActivity.value = randomActivity.value;
        selectRepit.value = randomRepit.value;
        startDate.value = randomStartDate;
        endDate.value = randomEndDate;
        numHours.value = randomHours;
        inputDescription.value = "Actividad random";

        submit();

    } catch (error) {
        console.error('Error al generar actividades random:', error);
    }
};


const exportJSON = () => {

    if (activitiesTable.value.length === 0) {
        toast("No hay actividades para exportar", {
            "theme": "dark",
            "type": "error",
            "dangerouslyHTMLString": true
        })
        return;
    }

    const jsonData = JSON.stringify(activitiesTable.value, null, 2);
    const blob = new Blob([jsonData], { type: "application/json" });
    const url = URL.createObjectURL(blob);

    const link = document.createElement("a");
    link.href = url;
    link.download = "actividades.json";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

const importJSON = (event: any) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        const result = e.target?.result;
        if (typeof result === "string") {
            const data = JSON.parse(result);

            // Guardar en localStorage
            localStorage.setItem('activitiesData', JSON.stringify(data));

            data.forEach((actividad: { id: any, idUne: any, name: any, repit: any, startDate: any, endDate: any, description: any, numHours: any }) => {
                try {
                    // insertar una unidad de negocio si no existe
                    if (!unesTable.value.some((u: any) => Number(u.id) === actividad.idUne)) {
                        unesTable.value.push({
                            id: actividad.idUne,
                            name: `Unidad de negocio ${actividad.idUne}`
                        });
                    }

                    selectUne.value = String(actividad.idUne);
                    selectActivity.value = actividad.name;
                    selectRepit.value = actividad.repit;
                    startDate.value = actividad.startDate;
                    endDate.value = actividad.endDate;
                    numHours.value = actividad.numHours;
                    inputDescription.value = `${actividad.description}`;

                    submit();
                } catch (error) {
                    console.error('Error al procesar actividad:', error);
                }
            });

        }
    };
    reader.readAsText(file);
};

onMounted(() => {
    const savedData = localStorage.getItem('activitiesData');
    if (savedData) {
        const data = JSON.parse(savedData);
        data.forEach((actividad: { id: any, idUne: any, name: any, repit: any, startDate: any, endDate: any, description: any, numHours: any }) => {
            try {
                // insertar una unidad de negocio si no existe
                if (!unesTable.value.some((u: any) => Number(u.id) === actividad.idUne)) {
                    unesTable.value.push({
                        id: actividad.idUne,
                        name: `Unidad de negocio ${actividad.idUne}`
                    });
                }

                selectUne.value = String(actividad.idUne);
                selectActivity.value = actividad.name;
                selectRepit.value = actividad.repit;
                startDate.value = actividad.startDate;
                endDate.value = actividad.endDate;
                numHours.value = actividad.numHours;
                inputDescription.value = `${actividad.description}`;

                submit();
            } catch (error) {
                console.error('Error al procesar actividad:', error);
            }
        });
    }
});

const clearLocalStorage = () => {
    localStorage.removeItem('activitiesData');
    activitiesTable.value = []; // Limpiar la tabla de actividades
    unesTable.value = []; // Limpiar la tabla de UNEs
    toast("LocalStorage limpiado", {
        "theme": "dark",
        "type": "success",
        "dangerouslyHTMLString": true
    });
};


</script>

<style></style>