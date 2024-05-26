<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';
import { icons } from '@/icons';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';

const props = defineProps({
    gallery: Object
})

const emit = defineEmits(['edit'])

const show = ref(true)

const carouselHeight = ref('h-56')


</script>

<template>

    <!-- <Transition enter-active-class="animate__animated animate__bounceInDown" leave-active-class=""> -->
    <li v-if="show">

        <div
            class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

                <!-- <Carousel v-if="gallery.images.length > 0" :items="gallery.images" class="shadow-lg"
                    :height="carouselHeight" /> -->
                <ActiveCarousel v-if="gallery.images.length > 0" :items="gallery.images" />
                <div class="w-full flex items-center justify-center shadow-lg" :class="carouselHeight" v-else>

                    <icons.ImageIcon class="w-56 h-56 text-gray-300 dark:text-gray-400" />
                </div>
                <!--  <img v-else :src="'https://via.placeholder.com/640x480.png/6d6d6d?text='+__('No%20images')" class="rounded-t-lg w-auto" :class="carouselHeight" /> -->

                <div class="px-4 min-h-[5vh] max-h-44 overflow-y-auto scrollbar-none">

                    <h5
                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white whitespace-nowrap overflow-y-auto scrollbar-thin scrollbar-thumb-gray-100  dark:scrollbar-thumb-gray-700">
                        {{ gallery.name }}
                    </h5>

                    <p v-show="gallery.description != null"
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ gallery.description }}</p>
                </div>
                <PrimaryButton type="button" @click="router.visit(route('admin.galleries.show', gallery))" class="mx-4">
                    <div class="flex items-center">
                        {{ __('Edit Gallery') }}
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </div>
                </PrimaryButton>
            </div>
        </div>
    </li>
    <!-- </Transition> -->

</template>
