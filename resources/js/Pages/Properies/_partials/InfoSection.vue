<script setup>
import CalendarIcon from '@/Icons/CalendarIcon.vue';
import CommentDotsIcon from '@/Icons/CommentDotsIcon.vue';
import MapLocationIcon from '@/Icons/MapLocationIcon.vue';
import { ref } from 'vue';
import SocialSharingDialog from './SocialSharingDialog.vue';
import FullScreenImagesModal from '@/Pages/Admin/Images/_partials/FullScreenImagesModal.vue';
import DinamicIcon from '@/Components/DinamicIcon.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import ShareNodesIcon from '@/Icons/ShareNodesIcon.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import TileGallery from '@/Components/_default/TileGallery.vue';
import LikeButton from '@/Components/_default/Properties/LikeButton.vue';
import ReviewCard from '@/Components/_default/Reviews/ReviewCard.vue';
import formatNumber from '@/mixins/numberToKilo';

const showFullScreenImageModal = ref(false)
const showSocialSharingDialog = ref(false)
const imageProxy = ref({})

const handleFullScreenImage = (image) => {
    imageProxy.value = image
    showFullScreenImageModal.value = true
}
</script>

<template>
    <ShapedSection class="py-8 md:py-16" :color="{ light: 'gray-100', dark: 'gray-950' }">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-full lg:max-w-lg mx-auto" v-if="$page.props.property?.galleries.length > 0">

                    <!-- <PhotoGallery class="w-full" @clicked="handleFullScreenImage" /> -->
                    <!-- <FeaturedGallery :images="$page.props.property.galleries[0].images" class="w-full"
                        @clicked="handleFullScreenImage" /> -->
                    <TileGallery :images="$page.props.property?.galleries[0].images" @clicked="handleFullScreenImage" />
                    <!-- <MapCard :property="$page.props.property" class="mt-6" /> -->
                    <!-- <p class="mt-4 font-lg font-semibold">Spread the word</p> -->

                </div>


                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                        {{ $page.props.property?.title[$page.props.locale] }}

                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ __($page.props.property?.type) }}
                        </p>

                        <RatingStars :property="$page.props.property" :size="'normal'" :without-text="false"
                            :on-dark="false" />

                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <div class="flex space-x-2 items-center " v-for="type, key in $page.props.property?.bed_types"
                            :key="key">

                            <DinamicIcon :icon="type.icon" class="w-8 h-8" />
                            <p class="">{{ __(type.title) }}</p>
                            <p class="">{{ __(type.name) }}</p>
                        </div>
                        <!-- {{ $page.props.property.bed_types }} -->
                    </div>

                    <div class="mt-4 ">
                        <a :href="$page.props.property?.google_maps_link" target="_blank"
                            class="text-md font-semibold text-gray-900 sm:text-md dark:text-gray-300 hover:font-bold transition">
                            <div class="flex items-center w-fit">
                                <MapLocationIcon class="w-8 h-5" />
                                <Tooltip :text="__('Get Travel Directions')" key="directions" placement="top">
                                    {{ $page.props.property?.address }}
                                </Tooltip>

                            </div>
                        </a>

                    </div>


                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <LikeButton :item="$page.props.property" />

                        <a href="#availability" title=""
                            class="text-white relative mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            <CalendarIcon class="w-5 h-5 " />
                            <div
                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-primary-700 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-50">
                        {{ formatNumber($page.props.property.reviews_count) }}
                </div>
                            <!-- {{ __('Check availability') }} -->
                        </a>

                        <inertia-link
                            :href="route('reviews.create', { property: $page.props.property, lang: $page.props.locale })"
                            title=""
                            class="text-white mt-4 sm:mt-0 bg-amazon-700 hover:bg-amazon-800 focus:ring-4 focus:ring-amazon-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amazon-600 dark:hover:bg-amazon-700 focus:outline-none dark:focus:ring-amazon-800 flex items-center justify-center"
                            role="button">
                            <CommentDotsIcon class="w-5 h-5 " />

                            <!-- {{ __('Post Review') }} -->
                        </inertia-link>

                        <a href="#" @click="showSocialSharingDialog = true" title=""
                            class="text-white mt-4 sm:mt-0 bg-amazon-700 hover:bg-amazon-800 focus:ring-4 focus:ring-amazon-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amazon-600 dark:hover:bg-amazon-700 focus:outline-none dark:focus:ring-amazon-800 flex items-center justify-center"
                            role="button">
                            <ShareNodesIcon class="w-5 h-5 -ms-2 me-2" />

                            {{ __('Share') }}
                        </a>
                    </div>

                    <!-- <SocialSharing class="mt-2 w-full" /> -->



                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />


                    <div class="mb-6 text-gray-500 dark:text-gray-400 space-y-2 text-justify"
                        v-html="$page.props.property?.long_description[$page.props.locale]"></div>

                    <div class="">
                        <h3 class="text-strong text-lg mb-4">{{ __('Latest reviews from our satisfied customers') }}</h3>
                        <!-- {{ $page.props?.latest_reviews.length }} -->
                        <ReviewCard v-for="review in $page.props?.latest_reviews" :key="review.id" :review="review" />
                    </div>

                </div>
            </div>
        </div>

        <FullScreenImagesModal v-if="$page.props.property?.galleries.length > 0"
            :images="$page.props.property?.galleries[0].images" :image="imageProxy" :show="showFullScreenImageModal"
            @close="showFullScreenImageModal = false" />

        <SocialSharingDialog :show="showSocialSharingDialog" @close="showSocialSharingDialog = false" />
    </ShapedSection>

</template>
