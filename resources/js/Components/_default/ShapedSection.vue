<script setup>
import ShapeBottom from './ShapeBottom.vue';
import ShapeTop from './ShapeTop.vue';

defineProps({
    color: {
        type: Object,
        default: {
            dark: 'white',
            light: 'white'
        }
    },
    background: {
        default: null,
        type: String,
    }
})

</script>

<template>
    <section :class="`bg-${color.light} dark:bg-${color.dark} relative antialiased`">
        <ShapeBottom
            :class="`absolute inset-y-full z-10 left-0 right-0 w-full top-0 rotate-180 text-${color.light} dark:text-${color.dark}` " />
        <ShapeTop
            :class="`absolute inset-y-full z-0 left-0 right-0 w-full bottom-1/2 text-${color.light} dark:text-${color.dark}` " />
        <slot />
    </section>
</template>
