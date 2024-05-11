<script setup>
import { computed } from 'vue';

const props = defineProps({
    active: {
        default: false,
        type: Boolean,
    },
    isDisabled: {
        default: false,
        type: Boolean,
    }
})

const activeClasses = computed(() => {
    return [
        props.active
            ? 'text-primary-600 border-b-2 border-primary-600 rounded-t-lg active dark:text-primary-500 dark:border-primary-500'
            : 'border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'
    ]
})
const disabledClasses = computed(() => {
    return [
        props.isDisabled
            ? 'text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500'
            : 'border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'
    ]
})
</script>

<template>
    <li class="me-2">
        <a href="#" :class="[activeClasses]" class="transition-all ease-out duration-150 inline-flex items-center justify-center p-4  group">
            <slot />
        </a>
    </li>
</template>
