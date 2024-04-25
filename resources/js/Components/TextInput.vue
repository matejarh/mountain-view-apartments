<script setup>
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: String,
    hasError: {
        default: false,
        type: Boolean,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const classes = computed(() => {
    return [
        props.hasError
        ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
        : 'bg-gray-50 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:focus:bg-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-700 dark:focus:border-primary-700'
    ]
})
</script>

<template>

    <input :value="modelValue"
            ref="input"
            @input="$emit('update:modelValue', $event.target.value)"
            class="sm:text-sm rounded-lg focus:r block w-full p-2.5"
            :class="classes"
    >

</template>
