<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import TransparentButton from '@/Components/_default/TransparentButton.vue';
import HeroParallax from '@/Components/_default/HeroParallax.vue';
import HeroTitle from '@/Components/_default/HeroTitle.vue';
import { icons } from '@/icons';

const page = usePage()

const images = computed(() => {
    const galleries = page.props?.property.galleries;

    if (galleries.length <= 0) {
        return [];
    }
    const gallery = galleries.find(gallery => gallery.name === page.props?.property.name);

    if (!gallery || !gallery.images || gallery.images.length === 0) {
        return [];
    }

    return gallery.images
})


const scrollTo = (view) => {
    document.getElementById(view).scrollIntoView(false);
}

</script>

<template>
    <HeroParallax :images="images">

        <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-24 xl:pb-56 z-0">
            <div class="">
                <HeroTitle>
                    <inertia-link
                        :href="route('properties.show', { lang: $page.props?.locale, property: $page.props?.property })">
                        {{ $page.props?.property.title[$page.props?.locale] }}</inertia-link>
                </HeroTitle>

                <div class="mb-8 text-lg font-normal text-gray-300 lg:text-xl "
                    v-html="$page.props?.property.quote[$page.props?.locale]"></div>

                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <TransparentButton @click="scrollTo('availability')"  type="button">
                        {{ __('Check availability') }}
                        <icons.ArrowRightIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                    </TransparentButton>

                    <TransparentButton type="button" @click="scrollTo('info')">
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
