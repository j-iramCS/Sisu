<template>
    <Aside />

    <main class="flex-1 ml-16 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Banner de Grupos de Trabajo -->
            <div
                class="w-full h-64 flex flex-col md:flex-row items-center bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-2xl overflow-hidden mb-6">
                <div class="w-full md:w-1/3 p-8 text-center md:text-left">
                    <h2
                        class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                        ¡Explora tus Grupos de Trabajo!
                    </h2>
                    <p class="mt-4 text-gray-600">
                        Gestiona y participa en los grupos de trabajo que te ayudarán a alcanzar tus objetivos.
                    </p>
                    <PrimaryButton @click="openCreateGroupModal" class="mt-6">Crear Grupo</PrimaryButton>
                </div>
                <div class="w-full md:w-2/3 h-64 md:h-auto overflow-hidden">
                    <img src="/images/bannerTeams.webp" alt="Banner Image"
                        class="w-full h-full object-cover transform transition-all hover:scale-110" />
                </div>
            </div>

            <!-- Sección de Grupos de Trabajo -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Grupo 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-blue-600">Grupo de Diseño</h3>
                        <Icon icon="ic:outline-group" class="text-3xl text-blue-500" />
                    </div>
                    <p class="text-gray-600 mb-4">Grupo dedicado al diseño de interfaces y experiencias de usuario.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Miembros: 12</span>
                        <PrimaryButton @click="viewGroupDetails(1)">Ver Detalles</PrimaryButton>
                    </div>
                </div>

                <!-- Grupo 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-green-600">Grupo de Desarrollo</h3>
                        <Icon icon="ic:outline-code" class="text-3xl text-green-500" />
                    </div>
                    <p class="text-gray-600 mb-4">Grupo enfocado en el desarrollo de software y aplicaciones.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Miembros: 8</span>
                        <PrimaryButton @click="viewGroupDetails(2)">Ver Detalles</PrimaryButton>
                    </div>
                </div>

                <!-- Grupo 3 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-purple-600">Grupo de Marketing</h3>
                        <Icon icon="ic:outline-marketing" class="text-3xl text-purple-500" />
                    </div>
                    <p class="text-gray-600 mb-4">Grupo dedicado a estrategias de marketing y publicidad.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Miembros: 15</span>
                        <PrimaryButton @click="viewGroupDetails(3)">Ver Detalles</PrimaryButton>
                    </div>
                </div>
            </div>

            <!-- Modal para Crear Grupo -->
            <Modal :show="isCreateGroupModalVisible" maxWidth="2xl" @close="closeCreateGroupModal">
                <template #title>
                    Crear un Nuevo Grupo
                </template>
                <form @submit.prevent="createGroup" class="p-6">
                    <InputLabel value="Nombre del Grupo"></InputLabel>
                    <Input v-model="groupName" placeholder="Nombre del grupo" />

                    <InputLabel value="Descripción del Grupo"></InputLabel>
                    <textarea v-model="groupDescription" rows="3"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border hover:border-blue-500 border-gray-200 focus:border-blue-100"
                        placeholder="Escribe una descripción para el grupo..."></textarea>

                    <InputLabel value="Seleccionar Miembros"></InputLabel>
                    <Select2 v-model="selectedMembers" :options="membersOptions" :multiple="true"
                        placeholder="Seleccionar miembros" />

                    <div class="flex justify-end mt-6">
                        <PrimaryButton type="submit">Crear Grupo</PrimaryButton>
                    </div>
                </form>
            </Modal>

        </div>
    </main>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import axios from "axios";

// Components
import Aside from '@/Components/Aside.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Input from '@/Components/Input.vue';
import Select2 from '@/Components/Select2.vue';

// Variables
const isCreateGroupModalVisible = ref(false);
const groupName = ref('');
const groupDescription = ref('');
const selectedMembers = ref<any>([]);
const membersOptions = ref([
    { value: 1, label: 'Usuario 1' },
    { value: 2, label: 'Usuario 2' },
    { value: 3, label: 'Usuario 3' },
    // Agrega más opciones según sea necesario
]);

// Methods
const openCreateGroupModal = () => {
    isCreateGroupModalVisible.value = true;
};

const closeCreateGroupModal = () => {
    isCreateGroupModalVisible.value = false;
};

const createGroup = async () => {
    try {
        const response = await axios.post('/api/groups/create', {
            name: groupName.value,
            description: groupDescription.value,
            members: selectedMembers.value
        });

        toast("Grupo creado correctamente", {
            "theme": "dark",
            "type": "success",
            "dangerouslyHTMLString": true
        });

        closeCreateGroupModal();
    } catch (error) {
        console.error(error);
        toast("Ocurrió un error al crear el grupo", {
            "theme": "dark",
            "type": "error",
            "dangerouslyHTMLString": true
        });
    }
};

const viewGroupDetails = (groupId: number) => {
    // Lógica para ver detalles del grupo
    console.log(`Ver detalles del grupo con ID: ${groupId}`);
};
</script>

<style>
/* Estilos adicionales si es necesario */
</style>