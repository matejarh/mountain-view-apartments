<script setup>
import AnimatedLayout from '@/Components/AnimatedLayout.vue';
import Carousel from '@/Components/Carousel.vue';
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import AccomodationCarousel from '@/Components/_default/Welcome/AccomodationsCarousel.vue';


</script>

<template>
    <AnimatedLayout min-height="min-h-[80svh]" :delay="100"
        enter-active-class="animate__animated animate__bounceInUp">
        <section class="relative bg-white dark:bg-gray-900 py-6 md:py-12 ">
            <!-- <AccomodationCarousel  /> -->
            <ShapeBottom
                class="absolute -scale-x-100 inset-y-full z-10 left-0 right-0 top-0 w-full rotate-180 text-white dark:text-gray-900 " />
            <ShapeTop
                class="absolute -scale-x-100 inset-y-full z-0 left-0 right-0 w-full bottom-1/2 text-white dark:text-gray-900 " />
        </section>
    </AnimatedLayout>
</template>
