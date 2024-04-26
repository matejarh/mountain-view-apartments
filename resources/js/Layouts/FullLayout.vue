<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import SideNavigation from './_partials/SideNavigation.vue';
import TopNavigation from './_partials/TopNavigation.vue';
import ScrollToTop from '@/Components/ScrollToTop.vue';
import Banner from '@/Components/Banner.vue';
import { useTranslationsStore } from '@/stores/translations';

defineProps({
    title: String,
});

const page = usePage()

const store = useTranslationsStore()


const scrollPosition = ref(0)

const handleScroll = (e) => {
    scrollPosition.value = e.target.scrollTop
}

const headerClasses = computed(() => {
    return [
        scrollPosition.value > 100 ? 'text-md px-4 py-1' : 'text-xl px-4 py-2 md:py-4'
    ]
})

const showSidebar = ref(false)

onMounted(() => {
    store.updateTranslations(page.props.translations)
})
</script>

<template>
    <div class="">
        <Head :title="title" />

        <Banner />

        <div id="page" class="relative antialiased bg-gradient-to-br from-white to-gray-100 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-950 w-screen overflow-hidden">
            <div v-show="showSidebar" class="fixed inset-0 z-10 w-screen h-screen" @click="showSidebar = false" />

            <TopNavigation @toggle-sidebar="showSidebar = !showSidebar" />

            <SideNavigation :show="showSidebar" @hide="showSidebar = false" />
            <main @scroll="handleScroll" id="main"
                class="lg:ml-64 h-screen pt-24 sm:pt-16 overflow-y-auto scrollbar scroll-smooth hover:scrollbar-thumb-gray-500 active:scrollbar-thumb-gray-400 scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 scrollbar-track-transparent">

                <div class="page-header bg-primary-600 text-white dark:bg-primary-800 sticky top-0" v-if="$slots.header">
                    <h2 class="font-semibold  text-gray-50 dark:text-gray-200 leading-tight transition-all ease-in-out duration-300" :class="headerClasses">
                        <slot name="header" />

                    </h2>
                </div>
                <div class="p-1 sm:p-2 md:p-4">
                    <slot />

                </div>
            </main>

            <ScrollToTop :scrollTop="scrollPosition" />
        </div>
    </div>
</template>
