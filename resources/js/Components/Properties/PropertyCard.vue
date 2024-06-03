<script setup>
import { getCurrentInstance, ref } from 'vue';
import { router } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';
import { icons } from '@/icons';

const props = defineProps({
    property: Object
})

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const show = ref(true)
const carouselHeight = 'h-56'
const noImages = ref([
    {
        thumb_url: 'https://placehold.co/512x366/6d6d6d/d1d1d1/png?text=' + __('No Images'),
    }
])
</script>

<template>

    <li v-if="show">

        <div
            class="w-full bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex flex-col justify-between pb-4 h-full space-y-4 select-none">

                <ActiveCarousel class="shadow-lg" v-if="property.galleries.length > 0" :items="property.galleries[0].images" />
                <ActiveCarousel class="shadow-lg" v-else :items="noImages" />

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h2 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ __(property.type) }}
                    </h2>
                    <h3
                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white whitespace-pre overflow-x-scroll scrollbar-none">
                        {{ property.title[$page.props?.locale] }}</h3>

                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ property.description[$page.props?.locale] }}</p>
                </div>

                <PrimaryButton type="button" @click="router.visit(route('admin.properties.show', property))"
                    class="mx-4">
                    <div class="flex items-center">
                        {{ __('Edit Property') }}
                        <icons.ArrowRightIcon class="rtl:rotate-180 w-3.5 h-3.5 ms-2" />
                    </div>
                </PrimaryButton>
            </div>
        </div>
    </li>


    <!--     <div class="space-y-4">
        <h2 class="text-lg font-bold">
            {{ property.type }}

        </h2>
        <h3>

            {{ property.name }}
        </h3>
        <p class="h-24 scrollbar-none overflow-y-auto whitespace-pre-wrap">
            {{ property.description }}
        </p>
        <p>
            <a class="flex items-center"
                :href="`https://www.google.com/maps/place/${property.addressForMap}/@${property.coordinates.lat},${property.coordinates.lng},13.25z/data=!4m9!4m8!1m0!1m5!1m1!1s0x477a09798b922fb5:0xf7d971fcde3bcafe!2m2!1d13.3809776!2d46.618689!3e0?entry=ttu`"
                target="_blank">

                {{ property.address }}
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                        clip-rule="evenodd" />
                </svg>

            </a>
        </p>

        <MapCard :property="property" />
    </div> -->
</template>
