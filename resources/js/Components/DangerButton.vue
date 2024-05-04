<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="hover:scale-105 active:scale-95 inline-flex items-center justify-center px-4 py-2 bg-bittersweet-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-0 active:shadow hover:shadow-xl shadow-lg   transition ease-in-out duration-150">
        <slot />
    </button>
</template>
