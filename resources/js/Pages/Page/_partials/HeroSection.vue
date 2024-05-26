<script setup>
import HeroParallax from '@/Components/_default/HeroParallax.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import HeroTitle from '@/Components/_default/HeroTitle.vue';
import TransparentButton from '@/Components/_default/TransparentButton.vue';
import { icons } from '@/icons';

const page = usePage()

const images = computed(() => {
    const galleries = page.props?.page.galleries;

    if (galleries.length <= 0) {
        return [];
    }
    const gallery = galleries.find(g => g.name === page.props?.page.name);

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
<HeroParallax :images="images" >
    <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-56 lg:pb-56 z-0">
        <div class="">
            <HeroTitle>
                {{ $page.props?.page.title[$page.props?.locale] }}
            </HeroTitle>

            <p class="mb-8 text-lg font-normal text-gray-300 whitespace-pre-wrap lg:text-xl sm:px-16 lg:px-48">{{
                $page.props?.page.description[$page.props?.locale] }}</p>

            <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                <TransparentButton type="button" @click="scrollTo('content-section')">
                    {{__('Learn more')}}
                    <icons.ArrowRightIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                </TransparentButton>
            </div>
        </div>
    </div>

</HeroParallax>

</template>
