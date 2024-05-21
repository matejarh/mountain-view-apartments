<script setup>
import HeroParallax from '@/Components/_default/HeroParallax.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

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
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                {{ $page.props?.page.title[$page.props?.locale] }}</h1>

            <p class="mb-8 text-lg font-normal text-gray-300 whitespace-pre-wrap lg:text-xl sm:px-16 lg:px-48">{{
                $page.props?.page.description[$page.props?.locale] }}</p>

            <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                <SecondaryButton type="button" @click="scrollTo('content-section')">
                    {{__('Learn more')}}
                </SecondaryButton>
            </div>
        </div>
    </div>

</HeroParallax>

</template>
