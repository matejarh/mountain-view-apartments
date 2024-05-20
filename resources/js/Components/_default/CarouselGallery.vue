<template>
    <div class="flex flex-col ">
        <Carousel class="w-full" :autoplay="5000" id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
            <Slide v-for="slide, key in items" :key="key">
                <div class="carousel__item relative overflow-hidden w-full pt-[56.25%];" >
                    <img :src="slide.thumb_url" class=" object-cover w-full h-full  top-0 left-0" >

                </div>
            </Slide>
        </Carousel>

        <Carousel id="thumbnails" :items-to-show="4" :wrap-around="true" v-model="currentSlide" ref="carousel">
            <Slide v-for="slide, key in items" :key="key">
                <div class="carousel__item" @click="slideTo(key - 1)">
                    <img :src="slide.thumb_url" class="w-auto h-full" >
                 <!--    {{ slide.thumb_url }} -->
                </div>
            </Slide>
        </Carousel>

    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Carousel, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

const props = defineProps({
    items: Array
})
const currentSlide = ref(0)

const currentItem = ref(props?.items[0])

const slideTo = (val) => {
    currentSlide.value = val
}

</script>

<style scoped>
.carousel__slide {
    padding: 1px;
}
</style>
