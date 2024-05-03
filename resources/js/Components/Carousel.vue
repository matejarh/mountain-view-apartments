<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import '/resources/css/carousel.css'
import { onMounted, ref } from 'vue';

defineProps({
    items: Array,
})

const i18n = ref({
    ariaNextSlide: "Navigate to next slide",
    ariaPreviousSlide: "Navigate to previous slide",
    ariaNavigateToSlide: "Navigate to slide {slideNumber}",
    ariaGallery: "Gallery",
    itemXofY: "Item {currentSlide} of {slidesCount}",
    iconArrowUp: "Arrow pointing upwards",
    iconArrowDown: "Arrow pointing downwards",
    iconArrowRight: "Arrow pointing to the right",
    iconArrowLeft: "Arrow pointing to the left",
})

</script>

<template>
    <div id="default-carousel" class="relative w-full h-auto md:h-auto">
        <carousel :items-to-show="1" :autoplay="3000" :wrap-around="true" :transition="1200"

            :pause-autoplay-on-hover="true" class="relative  overflow-hidden rounded-t-lg ">
            <slide v-for="slide, key in items" :key="key" class="">
                <div class="h-52 md:h-56">

                    <img :src="slide.thumb_url"
                        class="absolute block h-auto w-full  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </slide>

            <template #addons="{ slidesCount }">
                <navigation v-if="slidesCount > 1" />
                <pagination v-if="slidesCount > 1" />
            </template>
        </carousel>

    </div>



</template>
