<template>
    <input
        :type="type || 'text'"
        :value="modelValue"
        :placeholder="placeholder"
        :required="required"
        :disabled="disabled"
        :name="name"
        @input="handleInput"
        class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg hover:border-blue-500 focus:border-blue-100 block w-full p-2.5"
    />
</template>

<script setup lang="ts">
const props = defineProps<{
    type?: string;
    modelValue?: string | number;
    placeholder?: string;
    required?: boolean;
    disabled?: boolean;
    name?: string;
}>();

const emit = defineEmits(["update:modelValue"]);

const handleInput = (event: Event) => {
    const target = event.target as HTMLInputElement | null;
    if (target) {
        emit("update:modelValue", target.value);
    }
};
</script>
