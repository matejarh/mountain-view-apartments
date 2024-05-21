<script setup>
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css'


</script>

<template>
    <section class="bg-white dark:bg-gray-900 relative">
        <div class="max-w-screen-xl px-4 py-20 mx-auto text-center lg:py-16 lg:pt-24 lg:px-6">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ __('What did our guest say') }}</h2>
            <Carousel :autoplay="5000" :wrap-around="true">
                <Slide v-for="review, key in $page.props?.reviews" :key="key">
                    <div class="carousel__item">

                        <figure class="max-w-screen-md mx-auto">
                            <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                    fill="currentColor" />
                            </svg>
                            <blockquote>
                                <p class="text-2xl font-medium text-gray-900 dark:text-white" v-html="review.text"></p>
                            </blockquote>
                            <figcaption class="flex items-center justify-center mt-6 space-x-3">
                                <img class="w-6 h-6 rounded-full"
                                    :src="review.owner.profile_photo_url"
                                    alt="profile picture">
                                <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                                    <div class="pr-3 font-medium text-gray-900 dark:text-white">{{ review.owner.name }}</div>
                                    <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">{{__('Stayed in')}} {{ review.reviewed.title[$page.props?.locale] }}</div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </Slide>
            </Carousel>

        </div>
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-white dark:text-gray-900 " />
    </section>
</template>
