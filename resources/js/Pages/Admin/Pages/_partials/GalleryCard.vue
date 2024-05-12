<script setup>
import Carousel from '@/Components/Carousel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue';

const props = defineProps({
    gallery: Object,
    direction: {
        type: String,
        default: 'attach',
    }
})

const emit = defineEmits(['attach', 'detach'])

const show = ref(true)

const carouselHeight = 'h-56'

</script>

<template>

    <!-- <Transition enter-active-class="animate__animated animate__bounceInDown" leave-active-class=""> -->
    <li v-if="show">

        <div
            class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

                <Carousel v-if="gallery.images.length > 0" :items="gallery.images" rounded="rounded-t-lg" class="shadow-lg"
                    :height="carouselHeight" />
                <div class="w-full flex items-center justify-center shadow-lg" :class="carouselHeight" v-else>

                    <ImageIcon class="w-56 h-56 text-gray-300 dark:text-gray-400" />
                </div>
                <!--  <img v-else :src="'https://via.placeholder.com/640x480.png/6d6d6d?text='+__('No%20images')" class="rounded-t-lg w-auto" :class="carouselHeight" /> -->

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ gallery.name }}
                    </h5>

                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ gallery.description }}</p>
                </div>

                <PrimaryButton type="button" class="mx-4" @click="direction === 'attach' ? $emit('attach', gallery) : $emit('detach', gallery)">
                    <div class="flex items-center">
                        <!-- <SpinnerIcon v-show="attachForm.processing"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" /> -->
                        {{ direction === 'attach' ? __('Attach to page') : __('Detach from page')}}

                    </div>
                </PrimaryButton>


            </div>
        </div>
    </li>
    <!-- </Transition> -->

</template>
