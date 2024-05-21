<script setup>
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TransparentButton from '@/Components/_default/TransparentButton.vue';
import HeroParallax from '@/Components/_default/HeroParallax.vue';

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
<HeroParallax :images="images" >

        <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-24 xl:pb-56 z-0">
            <div class="">
                <h1  class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    <inertia-link :href="route('properties.show', {lang:$page.props.locale, property:$page.props.property })">
                        {{ $page.props.property.title[$page.props.locale] }}</inertia-link>
                </h1>

                <div class="mb-8 text-lg font-normal text-gray-300 lg:text-xl " v-html="$page.props.property.quote[$page.props.locale]"></div>

                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <PrimaryButton @click="scrollTo('availability')" class="py-3 px-5 " type="button">

                        {{__('Check availability')}}
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </PrimaryButton class="py-3 px-5 ">

                    <TransparentButton type="button" @click="scrollTo('info')">
                        {{__('Learn more')}}
                    </TransparentButton>

                </div>
            </div>
        </div>

</HeroParallax>
</template>
