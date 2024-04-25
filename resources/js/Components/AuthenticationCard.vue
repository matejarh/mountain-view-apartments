<script setup>
import { useTranslationsStore } from '@/stores/translations';
import { usePage } from '@inertiajs/vue3';
import { onBeforeMount, onMounted, ref } from 'vue';
import LangSwitch from './SideNavigation/LangSwitch.vue';
import ThemeSwitch from './TopNavigation/ThemeSwitch.vue';

const page = usePage()

const store = useTranslationsStore()

onBeforeMount(() => {
    store.updateTranslations(page.props.translations)
})
</script>
<template>
    <section class="bg-gray-50 dark:bg-gradient-to-tl dark:from-gray-950 dark:via-gray-950 dark:to-gray-900 relative">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 ">
            <div class="absolute top-0 w-full flex justify-between overflow-visible p-4">
                <LangSwitch direction="down" />
                <ThemeSwitch />
            </div>
            <slot name="logo" />

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        <slot name="title" />
                    </h1>
                    <slot />
                </div>
            </div>
        </div>

    </section>
<!--
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div> -->
</template>
