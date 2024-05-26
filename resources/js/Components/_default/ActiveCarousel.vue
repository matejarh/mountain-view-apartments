<template>
    <Carousel :itemsToShow="1.95" :autoplay="5000" :wrapAround="true" :transition="500" :breakpoints="breakpoints">
        <Slide v-for="slide, key in items" :key="key">
            <!-- <div class="carousel__item" @click="">
                <img :src="slide.thumb_url" class="w-auto h-full">
            </div> -->
            <ActiveCarouselItem :image-url="slide.thumb_url" />
        </Slide>
        <template #addons>
          <!--   <Pagination /> -->
            <Navigation />
        </template>
    </Carousel>
</template>

<script setup>
import { ref } from 'vue';
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import ActiveCarouselItem from './ActiveCarouselItem.vue'

const props = defineProps({
    items: Array,
    toShow: {
        default: 1.95,
        type: Number,
    },
})

const breakpoints = ref({
      640: {
        itemsToShow: 2.95,
        snapAlign: 'center',
      },
      768: {
        itemsToShow: 2.95,
        snapAlign: 'center',
      },
      1024: {
        itemsToShow: 2.25,
        snapAlign: 'center',
      },
      1280: {
        itemsToShow: 2.75,
        snapAlign: 'center',
      },
    },
)

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
    transform: rotateY(-33deg) scale(0.9);
}

.carousel__slide--active~.carousel__slide {
    transform: rotateY(33deg) scale(0.9);
}

.carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-33deg) scale(0.9);
}

.carousel__slide--next {
    opacity: 1;
    transform: rotateY(33deg) scale(0.9);
}

.carousel__slide--active {
    opacity: 1;
    transform: rotateY(0) scale(1.2);
    border-radius: 0.5rem;
}
</style>
