<script setup>
import YoutubePlayButtonIcon from '@/Icons/YoutubePlayButtonIcon.vue';
import { ref } from 'vue';
const play = ref(false)

const videoCoverImage = ref(new URL('/resources/images/backgrounds/Bled.jpg', import.meta.url))
</script>

<template>
   <section class="bg-gray-50 dark:bg-gray-800 py-6 md:py-12">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16">
            <div class="flex flex-col justify-center">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Take a Virtual Tour</h2>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">With immense natural beauty, Bled, together with its surroundings, ranks among the most beautiful alpine resorts, renowned for its mild, healing climate and thermal lake water. The beauty of the mountains reflected on the lake, the sun, the serenity and the fresh air arouse pleasant feelings in visitors throughout the year, guaranteeing an ideal base or a relaxing break or an active holiday. </p>
                <!-- <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                    <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-deep-cerulean-700 hover:bg-deep-cerulean-800 focus:ring-4 focus:ring-deep-cerulean-300 dark:focus:ring-deep-cerulean-900">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="#" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Learn more
                    </a>
                </div> -->
            </div>
            <div>
                <div @click="play=true" class="youtube relative mx-auto w-full lg:max-w-xl h-64 bg-cover bg-center bg-no-repeat rounded-lg sm:h-96 shadow-xl overflow-hidden" v-if="!play"
                :style="`background-image: url(${videoCoverImage});`">

                    <!-- <img id="Z1kJBdZoUPaj4JBh" src="@/assets/images/Bled.jpg" > -->
                    <div type="button" class="button absolute inset-0 flex-flex-col w-full h-full flex items-center justify-center"><button class="text-red-600">

                        <YoutubePlayButtonIcon class="w-24 h-auto " />
                    </button></div>
                </div>
                <iframe v-else class="mx-auto w-full lg:max-w-xl h-64 rounded-lg sm:h-96 shadow-xl" src="https://www.youtube.com/embed/Qwwfwhg-mG0?si=Z1kJBdZoUPaj4JBh&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>
</template>
