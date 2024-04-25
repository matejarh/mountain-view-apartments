<script setup>
import MoonIcon from '@/Icons/MoonIcon.vue';
import SunIcon from '@/Icons/SunIcon.vue';
import { onMounted, ref } from 'vue';

const isDark = ref(localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches))

const toggle = () => {
    isDark.value = !isDark.value

    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
}

onMounted(() => {
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        isDark.value = true
        document.documentElement.classList.add('dark');
    } else {
        isDark.value = false
        document.documentElement.classList.remove('dark');
    }
})
</script>

<template>
    <button id="theme-toggle" @click="toggle" type="button"
        class="transition-color ease-out duration-150 text-gray-900 dark:text-bittersweet-50 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm px-2 py-2">
        <div class="relative">
            <SunIcon id="theme-toggle-dark-icon" v-show="isDark" class=" absolute hover:animate-ping w-5 h-5" />
            <SunIcon id="theme-toggle-dark-icon" v-show="isDark" class=" w-5 h-5" />
        </div>
        <div class="relative">

            <MoonIcon id="theme-toggle-light-icon" v-show="!isDark" class=" absolute hover:animate-ping w-5 h-5" />
            <MoonIcon id="theme-toggle-light-icon" v-show="!isDark" class=" w-5 h-5" />
        </div>

    </button>
</template>
