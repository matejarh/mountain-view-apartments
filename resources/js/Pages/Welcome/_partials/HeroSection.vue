<script setup>
import HeroTitlesCarousel from '@/Components/_default/Welcome/HeroTitlesCarousel.vue';
import { router, usePage } from '@inertiajs/vue3';
import { initCarousels } from 'flowbite';
import { onBeforeUnmount, onMounted, ref, computed } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TransparentButton from '@/Components/_default/TransparentButton.vue';
import HeroParallax from '@/Components/_default/HeroParallax.vue';

const page = usePage()

const images = computed(() => {
    const galleries = page.props?.page.galleries;

    if (galleries.length <= 0) {
        return [];
    }
    const gallery = page.props?.page.galleries.find(gallery => gallery.name === 'Home Page Hero');

    if (!gallery || !gallery.images || gallery.images.length === 0) {
        return [];
    }

    return gallery.images
})

const scrollTo = (view) => {

    document.getElementById(view).scrollIntoView(true);

}

onMounted(() => {
    initCarousels()
})

</script>

<template>
    <HeroParallax :images="images">

        <div class="mx-auto max-w-screen text-center  z-0">
            <div class="flex flex-col min-w-full">

                <HeroTitlesCarousel class="w-screen overflow-hidden" />
            </div>
        </div>
        <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-56 lg:pb-56  z-0">
            <div class="flex flex-col min-w-full">
                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <PrimaryButton @click="$inertia.get(route('properties.index', { lang: $page.props?.locale }))"
                        class="py-3 px-5 " type="button">

                        {{ __('Check our apartments') }}

                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </PrimaryButton class="py-3 px-5 ">

                    <TransparentButton type="button" @click="scrollTo('discover')">
                        {{ __('Learn more') }}
                    </TransparentButton>
                </div>
            </div>
        </div>
    </HeroParallax>
</template>
