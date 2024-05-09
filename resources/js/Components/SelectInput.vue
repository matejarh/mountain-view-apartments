<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: String,
    hasError: {
        default: false,
        type: Boolean,
    }
});


defineEmits(['update:modelValue']);
const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});

defineExpose({ focus: () => select.value.focus() });
</script>

<template>
    <select :value="modelValue" ref="select" @input="$emit('update:modelValue', $event.target.value)"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-700 dark:focus:border-primary-700"
        >
        <slot />
    </select>
</template>
