<script setup>
import CarouselCarretLeftIcon from '@/Icons/CarouselCarretLeftIcon.vue';
import { Carousel } from 'flowbite';
import { onMounted, ref } from 'vue';

const props = defineProps({
    id: String,
    slides: Array,
    interval: {
        default: 3000,
        type: Number,
    }
})

const carousel=ref(null)

const makeItems = () => {
    let items = []
    props.slides?.forEach((slide, index) => {
        items.push({position: index, el: document.getElementById(`carousel-item-${index}`)})
    });
    return items
}
const makeIndicators = () => {
    let items = []
    props.slides?.forEach((slide, index) => {
        items.push({position: index, el: document.getElementById(`carousel-indicator-${index}`)})
    });
    return items
}

onMounted(() => {
    const items = makeItems()
    const indicators = makeIndicators()

    // options with default values
    const options = {
        defaultPosition: 1,
        interval: props.interval,

        indicators: {
            activeClasses: 'bg-primary-700 dark:bg-primary-600',
            inactiveClasses:
                'bg-primary-700 dark:bg-primary-800 hover:bg-primary-600 dark:hover:bg-gray-800',
            items: indicators,
        },

        // callback functions
        onNext: () => {
            console.log('next slider item is shown');
        },
        onPrev: () => {
            console.log('previous slider item is shown');
        },
        onChange: () => {
            console.log('new slider item has been shown');
        },

    };

    // instance options object
    const instanceOptions = {
      id: props.id,
      override: true
    };
    const carouselElement = document.getElementById(props.id);
    carousel.value = new Carousel(carouselElement, items, options, instanceOptions);
})

</script>

<template>
<div :id="id" class="relative w-full">
    <!-- Carousel wrapper -->
    <div
        class="relative h-56 overflow-hidden rounded-lg sm:h-[60vh] xl:h-80 2xl:h-[50vh]"
    >
        <slot />
        <!-- <div v-for="image, key in slides" :id="`carousel-item-${key}`" class="hidden duration-700 ease-in-out" >
            <img
                :src="image.photo_url"
                class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                alt="..."
            />
        </div> -->

    </div>
    <!-- Slider indicators -->
    <div
        class="absolute bottom-0 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse"
    >
        <button
            v-for="item, key in slides"
            :key="key"
            :id="`carousel-indicator-${key}`"
            type="button"
            class="h-3 w-3 rounded-full bg-primary-500 hover:bg-primary-500"
            aria-current="true"
            :aria-label="`Slide ${key}`"
        ></button>
    </div>
    <!-- Slider controls -->
    <button
        @click="carousel.prev()"
        id="data-carousel-prev"
        type="button"
        class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
    >
        <span
            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-500/20 group-hover:bg-primary-600/30 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70"
        >
            <CarouselCarretLeftIcon class="h-4 w-4 text-primary-700 dark:text-primary-600"/>

            <span class="hidden">{{__('Previous')}}</span>
        </span>
    </button>
    <button
        @click="carousel.next()"
        id="data-carousel-next"
        type="button"
        class="group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
    >
        <span
            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-500/20 group-hover:bg-primary-600/30 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70"
        >
            <CarouselCarretLeftIcon class="h-4 w-4 rotate-180 text-primary-700 dark:text-primary-600"/>
            <span class="hidden">{{__('Next')}}</span>
        </span>
    </button>
</div>
</template>
