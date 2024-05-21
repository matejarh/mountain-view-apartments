<script setup>
defineProps({
    showBackgrounds: {
        default: false,
        type: Boolean,
    }
})
</script>
<template>
    <button
        type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-200 hover:text-gray-50 focus:text-white  rounded-lg xl:hidden transition-all backdrop-blur bg-opacity-50"
        :class="{ 'bg-gray-400 dark:bg-gray-700 drop-shadow-lg': showBackgrounds }"
        aria-controls="navbar-language" aria-expanded="false">
        <span class="sr-only">{{__('Open main menu')}}</span>
        <svg class="w-5 h-5 drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
        </svg>
    </button>
</template>
