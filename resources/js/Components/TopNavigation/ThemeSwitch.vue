<script setup>
import { onMounted } from 'vue';
import { useHelperStore } from '@/stores/helpers';
import { icons } from '@/icons';
import NavButton from './NavButton.vue';

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
    <NavButton type="button" @click="toggle">
            <div class="relative" v-if="helpers.isDark">
                <icons.SunIcon id="theme-toggle-dark-icon" class="absolute hover:animate-ping w-6 h-6" />
                <icons.SunIcon id="theme-toggle-dark-icon" class="w-6 h-6" />
            </div>
            <div class="relative" v-else>
                <icons.MoonIcon id="theme-toggle-light-icon" class="absolute hover:animate-ping w-6 h-6" />
                <icons.MoonIcon id="theme-toggle-light-icon" class="w-6 h-6" />
            </div>
    </NavButton>
</template>
