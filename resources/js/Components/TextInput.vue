<script setup>
import { computed, onMounted, ref, watch, watchEffect } from 'vue';

const props = defineProps({
    modelValue: String | Number,
    hasError: {
        default: false,
        type: Boolean,
    },
    rounded: {
        default: 'rounded-lg',
        type: String,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);
const shake = ref(false)

watchEffect(() => {
    if (props.hasError === true) {
        initiateShake()
    }
})

const initiateShake = () => {
    shake.value = true
    setTimeout(() => {
        shake.value = false
    }, 1500);
}

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const classes = computed(() => {
    return [
        props.hasError
            ? 'bg-bittersweet-50 border border-bittersweet-500 text-bittersweet-900 placeholder-bittersweet-700 focus:ring-bittersweet-500 dark:bg-gray-700 focus:border-bittersweet-500 dark:focus:bg-gray-600 dark:text-bittersweet-500 dark:placeholder-bittersweet-500 dark:border-bittersweet-500'
            : 'bg-gray-50 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:focus:bg-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-700 dark:focus:border-primary-700',
        shake.value ? 'animate-shake' : ''
    ]
})
</script>

<template>
    <input :value="modelValue" ref="input" @input="$emit('update:modelValue', $event.target.value)"
        class="sm:text-sm block p-2.5" :class="[classes, rounded]">

</template>
