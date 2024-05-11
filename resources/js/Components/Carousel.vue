<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import '/resources/css/carousel.css'
import { onMounted, ref } from 'vue';

defineProps({
    items: Array,
    height: {
        type: String,
        default: 'h-40'
    },
    width: {
        type: String,
        default: 'w-auto'
    },
    transition: {
        type: Number,
        default: 1200
    },
    autoplay: {
        type: Number,
        default: 7000
    },
    hasNavigation: {
        type: Boolean,
        default: true
    },
    hasPagination: {
        type: Boolean,
        default: true
    },
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
    <div id="default-carousel" class="relative">
        <carousel :items-to-show="1"
                    :autoplay="autoplay"
                    :wrap-around="true"
                    :transition="transition"
                    :i18n="i18n"
                    :pause-autoplay-on-hover="true"
                    class="relative  overflow-hidden rounded-lg "
                    :class="height">

            <slide v-for="slide, key in items" :key="key" class="">
                <div :class="[height, width]">

                    <img :src="slide.thumb_url"
                    :class="height"
                        class="absolute block  w-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" :alt="slide.slug">
                </div>
            </slide>

            <template #addons="{ slidesCount }" v-if="hasNavigation || hasPagination">
                <navigation v-if="slidesCount > 1 && hasNavigation" />
                <pagination v-if="slidesCount > 1 && hasPagination" />
            </template>
        </carousel>

    </div>



</template>
