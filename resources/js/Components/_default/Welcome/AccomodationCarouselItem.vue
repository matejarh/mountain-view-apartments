<script setup>
import Carousel from '@/Components/Carousel.vue';
import DinamicIcon from '@/Components/DinamicIcon.vue';
import RatingStars from '../Properties/RatingStars.vue';

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
                <div class="mt-0 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ __(accomodation.type) }}
                        </p>

                        <RatingStars :property="accomodation" />

                    </div>

                    <div class="mt-0 grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="flex space-x-2 items-center" v-for="type, key in accomodation.bed_types"
                            :key="key">

                            <DinamicIcon :icon="type.icon"   :class="type.name === '1 queen bed' ? 'w-10 h-6' : (type.name === '2 single beds' ? 'w-4 h-4' : 'w-8 h-8')"/>
                            <DinamicIcon v-if="type.name === '2 single beds'" :icon="type.icon"  class="w-4 h-4"/>
                            <p class="">{{ __(type.title) }}</p>
                            <p class="">{{ __(type.name) }}</p>
                        </div>
                        <!-- {{ $page.props.property.bed_types }} -->
                    </div>
            <div class="mb-8 mt-4 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400" v-html="accomodation.description[$page.props.locale]"></div>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                <inertia-link :href="route('properties.show', {property:accomodation, lang:$page.props.locale})"
                    class="inline-flex hover:scale-105 active:scale-95 items-center justify-center px-4 py-2 bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-0 active:shadow hover:shadow-xl shadow-lg   transition ease-in-out duration-150">
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
            <Carousel rounded="rounded-lg" :items="accomodation.galleries[0].images" height="h-64 sm:h-[34rem] md:h-[33rem] lg:h-[20rem] xl:h-[27rem]"
                width="" class="shadow-lg" />

        </div>
    </div>
</template>
