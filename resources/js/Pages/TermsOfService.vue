<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import LangSwitch from '@/Components/SideNavigation/LangSwitch.vue';
import ThemeSwitch from '@/Components/TopNavigation/ThemeSwitch.vue';

defineProps({
    terms: String,
});
</script>

<template>

    <Head :title="__('Terms of Service')" />

    <div class="font-sans text-gray-900 dark:text-gray-50 antialiased">
        <div class="pt-4 bg-gray-100 dark:bg-gray-950">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div class="absolute top-0 w-full flex justify-between overflow-visible p-4">
                    <LangSwitch direction="down" />
                    <ThemeSwitch />
                </div>
                <div>
                    <AuthenticationCardLogo />
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-gray-900 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-headings:text-gray-50 dark:prose-p:text-gray-200"
                    v-html="terms" />
            </div>
        </div>
    </div>
</template>
