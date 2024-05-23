<script setup>
defineProps({
    value: String,
    hasError: {
        default: false,
        type: Boolean,
    },
    as: {
        default: 'label',
        type: String
    }
});
</script>

<template>
    <label v-if="as === 'label'" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        :class="hasError ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white'">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </label>
    <div v-else-if="as === 'div'" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        :class="hasError ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white'">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </div>
</template>
