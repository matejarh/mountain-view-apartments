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
    rounded: {
        type: String,
        // default: 'rounded-lg'
    }
})

const breakpoints = ref({
      // 700px and up
      640: {
        itemsToShow: 1,
        snapAlign: 'center',
      },
      // 700px and up
      768: {
        itemsToShow: 1.5,
        snapAlign: 'center',
      },
      // 1024 and up
      1024: {
        itemsToShow: 2.5,
        snapAlign: 'start',
      },
      1180: {
        itemsToShow: 1,
        snapAlign: 'start',
      },
      // 1024 and up
      1280: {
        itemsToShow: 1,
        snapAlign: 'start',
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
    <div id="default-carousel" class="flex flex-col">
        <carousel :items-to-show="1"
                    :autoplay="autoplay"
                    :wrap-around="true"
                    :transition="transition"
                    snapAlign="center"
                    :i18n="i18n"
                    :breakpoints="breakpoints"
                    :pause-autoplay-on-hover="true"
                    class="h-full overflow-hidden"
                    :class="[rounded]">

            <slide v-for="slide, key in items" :key="key" class="">
                <div class="overflow-hidden w-full h-full">
                    <img :src="slide.thumb_url" class=" object-cover w-full h-full" :alt="slide.slug">
                </div>
            </slide>

            <template #addons="{ slidesCount }" v-if="hasNavigation || hasPagination">
                <navigation v-if="slidesCount > 1 && hasNavigation" />
                <pagination v-if="slidesCount > 1 && hasPagination" />
            </template>
        </carousel>

    </div>



</template>
