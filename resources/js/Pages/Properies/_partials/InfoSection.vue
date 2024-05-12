<script setup>
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import CalendarIcon from '@/Icons/CalendarIcon.vue';
import CommentDotsIcon from '@/Icons/CommentDotsIcon.vue';
import HeartIcon from '@/Icons/HeartIcon.vue';
import MapLocationIcon from '@/Icons/MapLocationIcon.vue';
import PinIcon from '@/Icons/PinIcon.vue';
import FacilityIcon from '@/Pages/Admin/Properties/_partials/FacilityIcon.vue';
import { usePage } from '@inertiajs/vue3';
import _ from 'lodash';
import { computed, ref } from 'vue';
import PhotoGallery from './PhotoGallery.vue';
import FullScreenImagesModal from '@/Pages/Admin/Images/_partials/FullScreenImagesModal.vue';
import MapCard from '@/Pages/Admin/Properties/_partials/MapCard.vue';
import DinamicIcon from '@/Icons/DinamicIcon.vue';

const page = usePage()
const facilitiesWithIcons = computed(() => {
    return _.filter(page.props.property?.facilities, ['has_icon_file', true])
    //.orderBy(props.property.facilities, ['has_icon_file'], ['desc'])
})

const showFullScreenImageModal = ref(false)
const imageProxy = ref(null)

const handleFullScreenImage = (image) => {
    imageProxy.value = image
    showFullScreenImageModal.value = true
}
</script>

<template>
    <section class="relative py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <!-- <img class="w-full dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                    <img class="w-full hidden dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" /> -->
                    <PhotoGallery class="w-full" @clicked="handleFullScreenImage" />
                    <MapCard :property="$page.props.property" class="mt-6" />
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        {{ $page.props.property.title[$page.props.locale] }}

                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ $page.props.property.type }}
                        </p>

                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                (5.0)
                            </p>
                            <a href="#"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                345 Reviews
                            </a>
                        </div>
                    </div>

                    <div class="mt-4 sm:flex sm:space-x-4">
                        <div class="flex space-x-2 items-center" v-for="type,key in $page.props.property.bed_types" :key="key">

                            <DinamicIcon :icon="type.icon" class="w-8 h-8" />
                            <p class="capitalize">{{ type.title }}</p>
                            <p class="capitalize">{{ type.name }}</p>
                        </div>
                        <!-- {{ $page.props.property.bed_types }} -->
                    </div>

                    <div class="mt-2 flex items-center">
                        <MapLocationIcon class="w-8 h-5" />
                        <a :href="$page.props.property.google_maps_link" target="_blank"
                            class="text-md font-semibold text-gray-900 sm:text-md dark:text-white">
                            {{ $page.props.property.address }}
                        </a>

                    </div>


                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <a href="#" title=""
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button">
                            <HeartIcon class="w-5 h-5 -ms-2 me-2" />
                            Like
                        </a>

                        <a href="#" title=""
                            class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            <CalendarIcon class="w-5 h-5 -ms-2 me-2" />

                            Check Availability
                        </a>

                        <a href="#" title=""
                            class="text-white mt-4 sm:mt-0 bg-amazon-700 hover:bg-amazon-800 focus:ring-4 focus:ring-amazon-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amazon-600 dark:hover:bg-amazon-700 focus:outline-none dark:focus:ring-amazon-800 flex items-center justify-center"
                            role="button">
                            <CommentDotsIcon class="w-5 h-5 -ms-2 me-2" />

                            Post Rewiew
                        </a>
                    </div>
                    <div class="grid grid-cols-4 md:grid-cols-6 gap-4 mt-6">

                        <FacilityIcon v-for="facility in facilitiesWithIcons" :facility="facility" :key="facility.id" class="text-center" />

                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />


                    <div class="mb-6 text-gray-500 dark:text-gray-400"
                        v-html="$page.props.property.long_description[$page.props.locale]"></div>

                </div>
            </div>
        </div>

        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 top-0 w-full rotate-180 text-white    dark:text-white " />
        <ShapeTop class="absolute inset-y-full z-0 left-0 right-0 w-full bottom-1/2 text-white   dark:text-white " />
        <FullScreenImagesModal :image="imageProxy" :show="showFullScreenImageModal" @close="showFullScreenImageModal = false" />
    </section>
</template>
