<script setup>
import { usePage } from '@inertiajs/vue3';
import Carousel from '../Carousel.vue';
import AccomodationCarouselItem from './AccomodationCarouselItem.vue';
import { computed } from 'vue';

const page = usePage()

const accomodations = computed(() => {
    return page.props.accomodations
})
</script>

<template>
    <Carousel id="accomodations-carousel" :slides="accomodations" :interval="7000">
        <div v-for="accomodation, key in accomodations" :id="`accomodations-carousel-item-${key}`" class="hidden duration-700 ease-in-out" >
            <AccomodationCarouselItem :accomodation="accomodation" />
        </div>
    </Carousel>
</template>
