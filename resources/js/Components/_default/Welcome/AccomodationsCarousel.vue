<script setup>
import Carousel from '../Carousel.vue';
import AccomodationCarouselItem from './AccomodationCarouselItem.vue';


</script>

<template>
    <Carousel id="accomodations-carousel" :slides="$page.props.accomodations">
        <div v-for="accomodation, key in $page.props.accomodations" :id="`accomodations-carousel-item-${key}`" class="hidden duration-700 ease-in-out" >
            <AccomodationCarouselItem :accomodation="accomodation" />
        </div>
    </Carousel>
</template>
