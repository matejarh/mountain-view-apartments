<script setup>
import Carousel from '@/Components/Carousel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';
import PagesIcon from '@/Icons/PagesIcon.vue';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';

const props = defineProps({
    page: Object
})

const emit = defineEmits(['edit'])

const show = ref(true)

const carouselHeight = ref('h-56')
</script>

<template>

    <!-- <Transition enter-active-class="animate__animated animate__bounceInDown" leave-active-class=""> -->
    <li v-if="show">

        <div class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out"
            >
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

               <!--  <Carousel v-if="page.galleries.length > 0" :items="page.galleries[0].images" class="shadow-lg"
                    :height="carouselHeight" /> -->

                <ActiveCarousel v-if="page.galleries.length > 0" :items="page.galleries[0].images" />

                <div class="w-full flex items-center justify-center"  v-else>
                    <PagesIcon class="w-24 h-[8vh] text-gray-300 dark:text-gray-400" />
                </div>
                <!--  <img v-else :src="'https://via.placeholder.com/640x480.png/6d6d6d?text='+__('No%20images')" class="rounded-t-lg w-auto" :class="carouselHeight" /> -->

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __(page.name) }}
                    </h3>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight overflow-y-auto whitespace-nowrap scrollbar-thin text-gray-900 dark:text-white">{{ page.title[$page.props.locale] }}
                    </h2>


                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ page.description[$page.props.locale] }}</p>
                </div>

                <PrimaryButton type="button" @click="router.visit(route('admin.pages.show', page))" class="mx-4">
                    <div class="flex items-center">
                        {{ __('Edit Page') }}
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </div>
                </PrimaryButton>
<!--                 <inertia-link :href="route('admin.pages.show', page)" class="hover:scale-105 active:scale-95 inline-flex items-center justify-center px-4 py-2 bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-0 active:shadow hover:shadow-xl shadow-lg   transition ease-in-out duration-150">
                    <div class="flex items-center">
                        {{ __('Edit Page') }}
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </div>
                </inertia-link> -->
            </div>
        </div>
    </li>
    <!-- </Transition> -->

</template>
