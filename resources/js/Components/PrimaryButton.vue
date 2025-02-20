<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    type?: 'button' | 'submit'
}>();

const buttonType = props.type || 'button';
</script>

<template>
    <button :type="buttonType"
        class="bg-blue-500 outline-none font-bold cursor-pointer text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
        <slot />
    </button>
</template>
