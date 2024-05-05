<script setup>
import { ref, onMounted, onBeforeMount, computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import TopNavigation from './_partials/_default/TopNavigation.vue'
import ScrollToTop from '@/Components/_default/ScrollToTop.vue'


import MobileNavigation from './_partials/_default/MobileNavigation.vue';
import PageFooter from './_partials/_default/PageFooter.vue';
import ContactDrawer from './_partials/_default/ContactDrawer.vue';

import { useHelperStore } from '@/stores/helpers'

defineProps({
    title: String,
    description: { type: String, default: 'Description' },
    keywords: { type: String, default: 'keyword, keyword' },
    noindex: { type: Boolean, default: true },
});

const scrollPosition = ref(0)

const container = ref(null)

const helpers = useHelperStore()

const showMain = ref(false)
const showNav = ref(false)
const showFooter = ref(false)

const defaultBackgroundImage = new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url)

const backgroundImage = computed(() => {
    return defaultBackgroundImage
})

const handleScroll = (e) => {
    scrollPosition.value = e.target.scrollTop
    // console.log(e.target.scrollTop)
    const parallaxElements =
        document.querySelectorAll('.bg-parallax');
    parallaxElements.forEach(function (element) {
        let scrollPosition = e.target.scrollTop;
        element.style.transform =
            'translateY(' + scrollPosition * 0.5 + 'px)';
    });
}


onMounted(() => {
    setTimeout(() => {
        showMain.value = true
        setTimeout(() => {
            showNav.value = true


            setTimeout(() => {
                showFooter.value = true
                helpers.show = true
            }, 3000);
        }, 600);
    }, 600);
})

</script>

<template>
    <div class="">

        <Head :title="title">
            <meta head-key="description" name="description" :content="description" />
            <meta head-key="keywords" name="keywords" :content="keywords" />
            <meta name="robots" content="noindex,nofollow" v-if="noindex">
            <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
        </Head>
        <Transition enter-active-class="animate__animated animate__fadeIn"
            leave-active-class="animate__animated animate__fadeOut">

            <div id="page" ref="container" v-show="showMain" class="relative antialiased text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-900 w-screen min-h-screen overflow-hidden bg-blend-multiply inset-0 bg-no-repeat bg-cover
                    bg-fixed h-screen" :style="`background-image: url(${backgroundImage});`">


                <TopNavigation :show="showNav" :scroll-position="scrollPosition" class="z-30" />

                <MobileNavigation v-show="showNav" :scroll-position="scrollPosition" />
                <Transition enter-active-class="animate__animated animate__fadeIn"
                    leave-active-class="animate__animated animate__fadeOut">
                    <div class="" v-show="helpers.show">

                        <main @scroll="handleScroll" id="main"
                            class="flex flex-col justify-between h-screen z-0  overflow-y-auto scrollbar-thin scroll-smooth hover:scrollbar-thumb-gray-500 active:scrollbar-thumb-gray-400 scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 scrollbar-track-transparent">
                            <div class="p-0 flex-grow flex flex-col justify-center">
                                <slot />
                            </div>
                            <Transition enter-active-class="animate__animated animate__slideInUp"
                                leave-active-class="animate__animated animate__slideOutDown">

                                <PageFooter v-show="showFooter" class=" pt-4 " />
                            </Transition>
                        </main>
                        <ScrollToTop :scrollTop="scrollPosition" />
                    </div>
                </Transition>
                <ContactDrawer />
            </div>
        </Transition>

    </div>

</template>
