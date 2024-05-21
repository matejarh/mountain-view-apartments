<script setup>
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';

const props = defineProps({
    images: { type: Array, default: [] },
})
const page = usePage()

const bgImage = ref(new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url))

let interval;

const int = ref(page.props?.settings.find(setting => setting.slug === 'intervals'))

const initBgImageRotation = () => {

    if (props.images.length <= 0) {
        clearInterval(interval);
        return;
    }

    let current = 0;

    bgImage.value = props.images[current].photo_url;

    interval = setInterval(() => {
        current = (current + 1) % props.images.length;
        bgImage.value = props.images[current].photo_url;
    }, int.value.attributes.hero_background_interval * 1000);
};

const stopBgRotation = () => {
    clearInterval(interval.value)
}

onMounted(() => {
    initBgImageRotation()
})

const scrollTo = (view) => {
    document.getElementById(view).scrollIntoView(true);
}

onBeforeUnmount(() => {
    clearInterval(interval)
})
</script>

<template>
    <section class="min-h-screen flex flex-col justify-center overflow-hidden relative">

        <div class="bg-parallax absolute top-0 left-0 z-0 h-full w-full ">
            <div class="bg-center bg-no-repeat bg-cover bg-fixed h-full w-full bg-gray-500 dark:bg-gray-800 bg-blend-multiply transition-all duration-[2000ms] ease-in-out"
                :style="`background-image: url(${bgImage});`"></div>
        </div>
        <div class="px-4 mx-auto max-w-screen-xl text-center pt-24 md:pt-24 xl:pt-56  z-0">
            <LogoHero />
        </div>
        <slot />
        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 w-full rotate-180 text-primary-700 dark:text-primary-900 " />
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
    </section>
</template>
