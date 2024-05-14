<script setup>
import { ref, onMounted, onBeforeMount, computed, onBeforeUnmount } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import TopNavigation from './_partials/_default/TopNavigation.vue'
import ScrollToTop from '@/Components/_default/ScrollToTop.vue'


import MobileNavigation from './_partials/_default/MobileNavigation.vue';
import PageFooter from './_partials/_default/PageFooter.vue';
import ContactDrawer from './_partials/_default/ContactDrawer.vue';

import { useHelperStore } from '@/stores/helpers'
import { useScrollStore } from '@/stores/scroll';
import { useClientStore } from '@/stores/client';

defineProps({
    title: String,
    description: { type: String, default: 'Description' },
    keywords: { type: String, default: 'keyword, keyword' },
    noindex: { type: Boolean, default: true },
});

const container = ref(null)

const helpers = useHelperStore()
const scroll = useScrollStore()
const client = useClientStore()

const page = usePage()

const showMain = ref(true)
const showNav = ref(true)
const showFooter = ref(true)

const defaultBackgroundImage = new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url)

const backgroundImageUrl = computed(() => {
    let setting = page.props.settings.filter((setting) => {
        return setting.slug === 'site-backgrounds'
    })

    return setting.length > 0 ? (setting[0].attributes[page.props.current_season] !== '' ? setting[0].attributes[page.props.current_season].photo_url : defaultBackgroundImage) : defaultBackgroundImage
})

const handleScroll = (e) => {
    scroll.updateScrollPosition(e.target.scrollTop)
    scroll.scrollPosition = e.target.scrollTop
    // console.log(e.target.scrollTop)
    const parallaxElements =
        document.querySelectorAll('.bg-parallax');
    parallaxElements.forEach(function (element) {
        //let scroll.scrollPosition = e.target.scrollTop;
        element.style.transform =
            'translateY(' + scroll.scrollPosition * 0.5 + 'px)';
    });
}

onMounted(() => {
    client.getLocation()
    if(!helpers.pageLoaded) {
        helpers.delay(600)
            .then(() => {
                helpers.showMain = true;
                return helpers.delay(600);
            })
            .then(() => {
                helpers.showNav = true;
                return helpers.delay(3000);
            })
            .then(() => {
                helpers.showFooter = true;
                helpers.show = true;
                helpers.pageLoaded = true;
                //return delay(3000);
            });

    }
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

            <div id="page" ref="container" v-if="helpers.showMain" class="transition-all ease-in-out duration-1000 relative antialiased text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-900 w-screen min-h-screen overflow-hidden bg-blend-multiply inset-0 bg-no-repeat bg-cover
                    bg-fixed h-screen" :style="`background-image: url(${backgroundImageUrl});`">


                <TopNavigation :show="showNav" :scroll-position="scroll.scrollPosition" class="z-30" />

                <MobileNavigation v-show="showNav" :scroll-position="scroll.scrollPosition" />

                <Transition enter-active-class="animate__animated animate__fadeIn"
                    leave-active-class="animate__animated animate__fadeOut">
                    <div class="" v-if="helpers.show">

                        <main @scroll="handleScroll" id="main"
                            class="flex flex-col justify-between h-screen z-0  overflow-y-auto scrollbar-none scroll-smooth hover:scrollbar-thumb-gray-500 active:scrollbar-thumb-gray-400 scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 scrollbar-track-transparent">
                            <div class="p-0 flex-grow flex flex-col justify-start">
                                <slot />
                            </div>
                            <Transition enter-active-class="animate__animated animate__slideInUp"
                                leave-active-class="animate__animated animate__slideOutDown">

                                <PageFooter v-show="helpers.showFooter" class=" pt-4 " />
                            </Transition>
                        </main>
                        <ScrollToTop :scrollTop="scroll.scrollPosition" />
                    </div>
                </Transition>
                <ContactDrawer @close="helpers.hideContactDrawer" />
            </div>
        </Transition>

    </div>

</template>
