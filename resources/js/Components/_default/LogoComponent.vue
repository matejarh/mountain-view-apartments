<script setup>
import SunIcon from './Logo/SunIcon.vue';
import LogoIcon from './Logo/LogoIcon.vue';

defineProps({
    scrollPosition: Number,
})

</script>

<template>
    <div class="relative">

        <SunIcon class="absolute drop-shadow transition-all duration-300 ease-out"
            :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-12 h-12'" />
        <SunIcon class="absolute animate-ping drop-shadow transition-all duration-300 ease-out"
            :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-12 h-12'" />


        <LogoIcon class="dark:text-gray-100 text-gray-900  drop-shadow transition-all duration-300 ease-out animate-pulse"
            :class="scrollPosition > 100 ? 'w-24 h-24' : 'w-32 h-32'" />
    </div>
</template>
