<script setup>
import MoonIcon from '@/Icons/MoonIcon.vue';
import SunIcon from '@/Icons/SunIcon.vue';
import { useHelperStore } from '@/stores/helpers';
import { onMounted } from 'vue';

const helpers = useHelperStore()

const toggle = () => {
    helpers.isDark = !helpers.isDark;

    const colorTheme = localStorage.getItem('color-theme') === 'dark' ? 'light' : 'dark';
    document.documentElement.classList.toggle('dark', helpers.isDark);

    localStorage.setItem('color-theme', colorTheme);
};

const updateColorTheme = () => {
    const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const colorTheme = localStorage.getItem('color-theme') || (prefersDarkMode ? 'dark' : 'light');

    helpers.isDark = colorTheme === 'dark';
    document.documentElement.classList.toggle('dark', colorTheme === 'dark');

    localStorage.setItem('color-theme', colorTheme);
};

onMounted(() => {
    updateColorTheme();
});
</script>

<template>
    <button id="theme-toggle" @click="toggle" type="button"
        class="transition-color ease-out duration-150 text-gray-900 dark:text-bittersweet-50 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm px-2 py-2">
        <div class="relative" v-if="helpers.isDark">
            <SunIcon id="theme-toggle-dark-icon" class="absolute hover:animate-ping w-5 h-5" />
            <SunIcon id="theme-toggle-dark-icon" class="w-5 h-5" />
        </div>
        <div class="relative" v-else>

            <MoonIcon id="theme-toggle-light-icon" class="absolute hover:animate-ping w-5 h-5" />
            <MoonIcon id="theme-toggle-light-icon" class="w-5 h-5" />
        </div>

    </button>
</template>
