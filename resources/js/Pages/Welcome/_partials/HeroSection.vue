<script setup>
import HeroTitlesCarousel from '@/Components/_default/Welcome/HeroTitlesCarousel.vue';
import { usePage } from '@inertiajs/vue3';
import { onMounted, computed } from 'vue';

import TransparentButton from '@/Components/_default/TransparentButton.vue';
import HeroParallax from '@/Components/_default/HeroParallax.vue';
import { icons } from '@/icons';

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
                    <TransparentButton @click="$inertia.get(route('properties.index', { lang: $page.props?.locale }))"
                        class="py-3 px-5 " type="button">

                        {{ __('Check our apartments') }}

                        <icons.ArrowRightIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                    </TransparentButton class="py-3 px-5 ">

                    <TransparentButton type="button" @click="scrollTo('discover')">
                        {{ __('Learn more') }}
                        <icons.InfoIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                    </TransparentButton>

                    <TransparentButton type="button" @click="$inertia.get(route('reservations.create', $page.props.locale))">
                        {{ __('Book Now') }}
                        <icons.CalendarIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                    </TransparentButton>
                </div>
            </div>
        </div>
    </HeroParallax>
</template>
