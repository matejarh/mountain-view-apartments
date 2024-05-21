<template>
    <Carousel :itemsToShow="1.95" :autoplay="5000" :wrapAround="true" :transition="500">
        <Slide v-for="slide, key in items" :key="key">
            <div class="carousel__item" @click="">
                <img :src="slide.thumb_url" class="w-auto h-full">
                <!--    {{ slide.thumb_url }} -->
            </div>
        </Slide>
        <template #addons>
          <!--   <Pagination /> -->
            <Navigation />
        </template>
    </Carousel>
</template>

<script setup>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

const props = defineProps({
    items: Array
})

</script>

<style scoped>
.carousel__slide {
    padding: 5px;
}

.carousel__viewport {
    perspective: 2000px;
}

.carousel__track {
    transform-style: preserve-3d;
}

.carousel__slide--sliding {
    transition: 0.5s;
}

.carousel__slide {
    opacity: 0.9;
    transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active~.carousel__slide {
    transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-10deg) scale(0.95);
}

.carousel__slide--next {
    opacity: 1;
    transform: rotateY(10deg) scale(0.95);
}

.carousel__slide--active {
    opacity: 1;
    transform: rotateY(0) scale(1.1);
}
</style>
