<script setup>
import { useScrollStore } from '@/stores/scroll';
import { computed, ref, watchEffect } from 'vue';

defineProps({
    title: String,
})

const scroll = useScrollStore()

const day = ref(null)

const fromtop = ref(0)

watchEffect(() => {
    scroll.scrollPosition > 1 ? showPosition() : fromtop.value = 150
})

const classes = computed(() => {
    return [
        fromtop.value < 100 ? 'text-md px-4 translate-x-0 bg-transparent py-1 dark:bg-transparent' : 'text-xl translate-x-0 px-4 py-1 md:py-2 bg-primary-600 dark:bg-primary-800'
    ]
})

const showPosition = () => {
    const { top, right, bottom, left } =
        day.value?.getBoundingClientRect()
    fromtop.value = top
}

</script>

<template>
    <h2 ref="day" :class="classes"
        class="transition-all duration-150 sticky top-0 text-center  text-gray-50 dark:text-gray-200 leading-tight font-semibold ">
        {{ title }}
    </h2>
</template>
