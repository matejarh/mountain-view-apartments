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
import SocialSharingDialog from './SocialSharingDialog.vue';
import FullScreenImagesModal from '@/Pages/Admin/Images/_partials/FullScreenImagesModal.vue';
import MapCard from '@/Pages/Admin/Properties/_partials/MapCard.vue';
import FeaturedGallery from '@/Components/_default/FeaturedGallery.vue';
import DinamicIcon from '@/Components/DinamicIcon.vue';

import Popover from '@/Components/_default/Popover.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import ShareNodesIcon from '@/Icons/ShareNodesIcon.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import TileGallery from '@/Components/_default/TileGallery.vue';
import LikeButton from '@/Components/_default/Properties/LikeButton.vue';

const showFullScreenImageModal = ref(false)
const showSocialSharingDialog = ref(false)
const imageProxy = ref({})

const handleFullScreenImage = (image) => {
    imageProxy.value = image
    showFullScreenImageModal.value = true
}
</script>

<template>
    <ShapedSection class="py-8 md:py-16" :color="{ light: 'gray-50', dark: 'gray-900' }">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-full lg:max-w-lg mx-auto">

                    <!-- <PhotoGallery class="w-full" @clicked="handleFullScreenImage" /> -->
                    <!-- <FeaturedGallery :images="$page.props.property.galleries[0].images" class="w-full"
                        @clicked="handleFullScreenImage" /> -->
                        <TileGallery :images="$page.props.property.galleries[0].images" @clicked="handleFullScreenImage" />
                    <!-- <MapCard :property="$page.props.property" class="mt-6" /> -->
                    <!-- <p class="mt-4 font-lg font-semibold">Spread the word</p> -->

                </div>


                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        {{ $page.props.property.title[$page.props.locale] }}

                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ __($page.props.property.type) }}
                        </p>

                        <RatingStars />

                    </div>

                    <div class="mt-4 sm:flex sm:space-x-4">
                        <div class="flex space-x-2 items-center" v-for="type, key in $page.props.property.bed_types"
                            :key="key">

                            <DinamicIcon :icon="type.icon" class="w-8 h-8" />
                            <p class="">{{ __(type.title) }}</p>
                            <p class="">{{ __(type.name) }}</p>
                        </div>
                        <!-- {{ $page.props.property.bed_types }} -->
                    </div>

                    <div class="mt-2">
                        <a :href="$page.props.property.google_maps_link" target="_blank"
                            class="text-md font-semibold text-gray-900 sm:text-md dark:text-gray-300 hover:font-bold transition">
                            <div class="flex items-center w-fit">
                                <MapLocationIcon class="w-8 h-5" />
                                <Tooltip :text="__('Get Travel Directions')" key="directions" placement="top">
                                    {{ $page.props.property.address }}
                                </Tooltip>

                            </div>
                        </a>

                    </div>


                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <LikeButton :item="$page.props.property" />

                        <a href="#availability" title=""
                            class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            <CalendarIcon class="w-5 h-5 -ms-2 me-2" />

                            {{__('Check Availability')}}
                        </a>

                        <a href="#" title=""
                            class="text-white mt-4 sm:mt-0 bg-amazon-700 hover:bg-amazon-800 focus:ring-4 focus:ring-amazon-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amazon-600 dark:hover:bg-amazon-700 focus:outline-none dark:focus:ring-amazon-800 flex items-center justify-center"
                            role="button">
                            <CommentDotsIcon class="w-5 h-5 -ms-2 me-2" />

                            {{__('Post Review')}}
                        </a>

                        <a href="#" @click="showSocialSharingDialog = true" title=""
                            class="text-white mt-4 sm:mt-0 bg-amazon-700 hover:bg-amazon-800 focus:ring-4 focus:ring-amazon-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amazon-600 dark:hover:bg-amazon-700 focus:outline-none dark:focus:ring-amazon-800 flex items-center justify-center"
                            role="button">
                            <ShareNodesIcon class="w-5 h-5 -ms-2 me-2" />

                            {{__('Share')}}
                        </a>
                    </div>

                    <!-- <SocialSharing class="mt-2 w-full" /> -->



                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />


                    <div class="mb-6 text-gray-500 dark:text-gray-400 space-y-2 text-justify"
                        v-html="$page.props.property.long_description[$page.props.locale]"></div>

                </div>
            </div>
        </div>

        <FullScreenImagesModal :images="$page.props.property.galleries[0].images" :image="imageProxy" :show="showFullScreenImageModal"
        @close="showFullScreenImageModal = false" />
        <SocialSharingDialog :show="showSocialSharingDialog"
        @close="showSocialSharingDialog = false" />
    </ShapedSection>

</template>
