<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import HeroParallax from '@/Components/_default/HeroParallax.vue';

const page = usePage()

const images = computed(() => {
    const galleries = page.props.page.galleries;

    if (galleries.length <= 0) {
        return [];
    }
    const gallery = galleries.find(g => g.name === page.props.page.name);

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
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    {{ $page.props.page.title[$page.props.locale] }}</h1>

                <p class="mb-8 text-lg font-normal text-gray-300 whitespace-pre-wrap lg:text-xl">{{
                    $page.props.page.description[$page.props.locale] }}</p>

                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <SecondaryButton type="button">
                        {{ __('Learn more') }}
                    </SecondaryButton>
                </div>
            </div>
        </div>
    </HeroParallax>
</template>
