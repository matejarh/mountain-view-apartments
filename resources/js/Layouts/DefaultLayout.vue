<script setup>
import { ref, onMounted, computed, onBeforeUnmount} from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

import TopNavigation from './_partials/_default/TopNavigation.vue'
import MobileNavigation from './_partials/_default/MobileNavigation.vue';
import ScrollToTop from '@/Components/_default/ScrollToTop.vue'
import ScrollForward from '@/Components/_default/ScrollForward.vue'
import PageFooter from './_partials/_default/PageFooter.vue';
import ContactDrawer from './_partials/_default/ContactDrawer.vue';

import { useHelperStore } from '@/stores/helpers'
import { useScrollStore } from '@/stores/scroll';
import { useClientStore } from '@/stores/client';
import { usePropertyStore } from '@/stores/property';
import Banner from '@/Components/Banner.vue';

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

const showNav = ref(true)
const wrapper = ref(null)

const defaultBackgroundImage = new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url)

const backgroundImageUrl = computed(() => {
    const setting = page.props?.settings.find(setting => setting.slug === 'site-backgrounds');

    if (setting) {
        const backgroundImage = setting.attributes[page.props?.current_season];
        return backgroundImage !== '' ? backgroundImage.photo_url : defaultBackgroundImage;
    } else {
        return defaultBackgroundImage;
    }
});

const inProduction = computed(() => {
    return import.meta.env.MODE === 'production'
})

const handleScroll = (e) => {
    initScrollData(e.target.scrollTop)
    const parallaxElements = document.querySelectorAll('.bg-parallax');
    // console.log(parallaxElements)
    parallaxElements.forEach((element) => {
        element.style.transform = `translateY(${scroll.scrollPosition * 0.5}px)`;
    });
}

const initScrollData = (scrollTop = 0) => {
    scroll.updateScrollPosition(scrollTop);
    scroll.updateWrapperHeight(wrapper.value?.offsetHeight);
    scroll.updateWindowHeight(window.innerHeight);
}

const routerRemoveEventListener = router.on('success', (event) => {
    initScrollData()
    //console.log(`Starting a visit to ${event.detail.visit.url}`)
})

const properties = usePropertyStore()

const fetchPropertiesListForDropdowns = async () => {
    if (properties.list.length > 0) return
    await axios.get(route('properties.fetch'))
        .then(response => properties.storeList(response.data))


}

/* const handleVisibilityChange = (e) => {
    client.handleVisibilityChange()
} */

const init = () => {
    client.getLocation()
    fetchPropertiesListForDropdowns()
    /* document.addEventListener('visibilitychange', handleVisibilityChange); */
    if (!helpers.pageLoaded) {
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
                initScrollData()
                //return delay(3000);
            });

    }

}

onMounted(() => {
    init()
})
onBeforeUnmount(() => {
    routerRemoveEventListener()
})
</script>

<template>
    <Head :title="title">
        <meta head-key="description" name="description" :content="description" />
        <meta head-key="keywords" name="keywords" :content="keywords" />
        <meta name="robots" content="noindex,nofollow" v-if="noindex || !inProduction">
        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>
    <div class="">


        <Banner />

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
                            <div class="p-0 flex-grow flex flex-col justify-start" ref="wrapper">
                                <slot />
                            </div>
                            <Transition enter-active-class="animate__animated animate__slideInUp"
                                leave-active-class="animate__animated animate__slideOutDown">

                                <PageFooter v-show="helpers.showFooter" class=" pt-4 " />
                            </Transition>
                        </main>
                        <ScrollToTop :scrollTop="scroll.scrollPosition" />
                        <ScrollForward />
                    </div>
                </Transition>
                <ContactDrawer @close="helpers.hideContactDrawer" />
            </div>
        </Transition>

    </div>

</template>

<style>
.grecaptcha-badge {
    display: none;
}
</style>
