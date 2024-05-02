<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import '/resources/css/carousel.css'

defineProps({
    items: Array,
})
</script>

<template>
    <div id="default-carousel" class="relative w-full h-52 md:h-56" data-carousel="slide">
        <carousel :items-to-show="1" :autoplay="2000" :wrap-around="true" :transition="600" :pause-autoplay-on-hover="true" class="relative  overflow-hidden rounded-t-lg ">
            <slide v-for="slide, key in items" :key="key" class="">
                <div class="h-48 md:h-52">

                    <img :src="slide.image_path"
                        class="absolute block h-auto  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </slide>

            <template #addons="{ slidesCount }">
                <navigation v-if="slidesCount > 1" />
                <pagination v-if="slidesCount > 1"/>
            </template>
        </carousel>

    </div>



</template>
