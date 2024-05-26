<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import HeroParallax from '@/Components/_default/HeroParallax.vue';
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

const gotoBookNow = () => {
    document.getElementById("booknow").scrollIntoView();
}

</script>

<template>
    <HeroParallax :images="images">
        <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-24 xl:pb-56  z-0">
            <div class="">
                <HeroTitle>
                    {{ $page.props?.page.title[$page.props?.locale] }}
                </HeroTitle>

                <p class="mb-8 text-lg font-normal text-gray-300 whitespace-pre-wrap lg:text-xl">{{
                    $page.props?.page.description[$page.props?.locale] }}</p>

                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <TransparentButton type="button">
                        {{ __('Learn more') }}
                        <icons.InfoIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                    </TransparentButton>
                </div>
            </div>
        </div>
    </HeroParallax>
</template>
