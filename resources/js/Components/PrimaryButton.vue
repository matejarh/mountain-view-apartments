<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="select-none hover:scale-105 active:scale-95 transition-all duration-150 ease-out text-white bg-primary-600 hover:bg-primary-700 focus:ring-0 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-800 shadow-lg active:shadow hover:shadow-xl">
        <slot />
    </button>

    <!-- <button :type="type"
        class="inline-flex items-center px-4 py-2 bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button> -->
</template>
