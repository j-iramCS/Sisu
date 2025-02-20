<template>
    <div class="p-4">
      <!-- Encabezado de los meses -->
      <div class="flex">
        <div
          v-for="month in months"
          :key="month.name"
          class="flex-1 text-center border-b font-bold"
        >
          {{ month.name }}
        </div>
      </div>
  
      <!-- Días del mes -->
      <div class="flex">
        <div
          v-for="day in days"
          :key="day.toISOString()"
          class="flex-1 text-center border-b p-2"
        >
          {{ day.getDate() }}
        </div>
      </div>
  
      <!-- Actividades -->
      <div class="relative h-20 mt-4">
        <div
          v-for="activity in activities"
          :key="activity.id"
          class="absolute bg-blue-200 p-2 rounded-lg shadow-md"
          :style="activityStyle(activity)"
        >
          {{ activity.name }}
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, computed } from "vue";
  
  // Definimos una interfaz para las actividades
  interface Activity {
    id: number;
    name: string;
    startDate: Date;
    endDate: Date;
  }
  
  // Definimos los meses que queremos mostrar
  const months = ref([
    { name: "Enero", days: 31 },
    { name: "Febrero", days: 28 }, // Año no bisiesto
    { name: "Marzo", days: 31 },
    { name: "Abril", days: 30 },
    { name: "Mayo", days: 31 },
  ]);
  
  // Generamos todos los días desde el 1 de enero hasta el 4 de mayo
  const days = ref<Date[]>([]);
  const startDate = new Date(2023, 0, 1); // 1 de enero de 2023
  const endDate = new Date(2023, 4, 4); // 4 de mayo de 2023
  
  for (let d = startDate; d <= endDate; d.setDate(d.getDate() + 1)) {
    days.value.push(new Date(d));
  }
  
  // Definimos las actividades
  const activities = ref<Activity[]>([
    {
      id: 1,
      name: "Actividad 1",
      startDate: new Date(2023, 0, 1), // 1 de enero
      endDate: new Date(2023, 1, 15), // 15 de febrero
    },
    {
      id: 2,
      name: "Actividad 2",
      startDate: new Date(2023, 2, 10), // 10 de marzo
      endDate: new Date(2023, 3, 20), // 20 de abril
    },
    {
      id: 3,
      name: "Actividad 3",
      startDate: new Date(2023, 3, 25), // 25 de abril
      endDate: new Date(2023, 4, 4), // 4 de mayo
    },
  ]);
  
  // Función para calcular el estilo de la actividad
  const activityStyle = (activity: Activity) => {
    const startIndex = days.value.findIndex(
      (day) => day.getTime() === activity.startDate.getTime()
    );
    const endIndex = days.value.findIndex(
      (day) => day.getTime() === activity.endDate.getTime()
    );
  
    const totalDays = days.value.length;
    const left = (startIndex / totalDays) * 100;
    const width = ((endIndex - startIndex + 1) / totalDays) * 100;
  
    return {
      left: `${left}%`,
      width: `${width}%`,
    };
  };
  </script>
  
  <style scoped>
  /* Estilos adicionales para mejorar la visualización */
  .relative {
    height: 100px; /* Altura del contenedor de actividades */
  }
  
  .absolute {
    top: 50%;
    transform: translateY(-50%); /* Centrar verticalmente las actividades */
  }
  </style>