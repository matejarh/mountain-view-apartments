<script setup>
import Carousel from '@/Components/Carousel.vue';

defineProps({
    accomodation: Object,
})
</script>

<template>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16">
        <div class="flex flex-col justify-center">
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                {{ accomodation.title[$page.props.locale] }}</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                {{ accomodation.description[$page.props.locale] }} </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                <inertia-link :href="route('properties.show', {property:accomodation, lang:$page.props.locale})"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 dark:text-white rounded-lg bg-deep-cerulean-700 hover:bg-deep-cerulean-800 focus:ring-4 focus:ring-deep-cerulean-300 dark:focus:ring-deep-cerulean-900">
                    {{__('Learn more')}}
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </inertia-link>

            </div>
        </div>
        <div v-if="accomodation.galleries.length > 0">
            <Carousel :items="accomodation.galleries[0].images" height="h-64 sm:h-screen md:h-screen-md lg:h-96 xl:h-[27rem]"
                width="" class="shadow-lg" />

        </div>
    </div>
</template>
