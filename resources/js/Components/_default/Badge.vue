<script setup>
defineProps({
    color: {
        type: String,
        default: 'primary',
    }
})
</script>

<template>
    <span
        :class="`bg-${color}-100 text-${color}-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-${color}-800 dark:text-${color}-300`">
        <slot />
    </span>
</template>
