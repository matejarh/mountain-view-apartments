<script setup>
import { computed, ref } from 'vue';
import HeroCarousel from '../HeroCarousel.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage()

/* const slides = ref([
    { id: 1, },
    { id: 2, },
    { id: 3, },
]) */
const int = ref(page.props.settings.find(setting => setting.slug === 'intervals'))
const slidesProxy = ref([
    {
        text: page.props?.page.description,
        title: page.props?.page.title,
    },
    {
        text: page.props?.page.extras.bled_text.text,
        title: page.props?.page.extras.bled_text.title,
    },
    {
        text: page.props?.page.extras.nasfield_text.text,
        title: page.props?.page.extras.nasfield_text.title,
    },
    {
        text: page.props?.page.description,
        title: page.props?.page.title,
    },
    {
        text: page.props?.page.extras.bled_text.text,
        title: page.props?.page.extras.bled_text.title,
    },
    {
        text: page.props?.page.extras.nasfield_text.text,
        title: page.props?.page.extras.nasfield_text.title,
    },


])

</script>

<template>

    <HeroCarousel id="home-page-hero-titles-carousel" :slides="slidesProxy" :interval="int.attributes.hero_background_interval * 1000">
        <div v-for="slide, key in slidesProxy" :key="key" :id="`home-page-hero-titles-carousel-item-${key}`"
            class="hidden duration-700 ease-in-out">
            <div class="w-full md:max-w-screen-2xl mx-auto">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    {{ slide?.title[$page.props.locale] }}</h2>

                <div class="mb-8 space-y-2 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48"
                    v-html="slide?.text[$page.props.locale]"></div>

            </div>
        </div>
    </HeroCarousel>
</template>
