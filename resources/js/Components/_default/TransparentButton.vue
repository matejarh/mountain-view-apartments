<script setup>
defineProps({
    as: {
        default: 'button',
        type: String
    }
});
</script>

<template>

    <button v-if="as==='button'"
        class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
        <slot />
    </button>
    <inertia-link v-else-if="as==='link'"
        class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
        <slot />
    </inertia-link>
</template>
