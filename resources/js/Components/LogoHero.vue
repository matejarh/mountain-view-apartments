<script setup>
import SunLogoIcon from '@/Icons/SunLogoIcon.vue';
import LogoIcon from '@/Icons/LogoIcon.vue';
import HribiLogoIcon from '@/Icons/HribiLogoIcon.vue';
import NapisiLogoIcon from '@/Icons/NapisiLogoIcon.vue';

defineProps({
    scrollPosition: {
        default: 0,
        type: Number,
    },
    showTitle: {
        type: Boolean,
        default: true
    },
    isAdministration: {
        type: Boolean,
        default: false,
    }
})

</script>

<template>
    <div class="relative">
        <div class="relative">

            <SunLogoIcon class="absolute -top-2 -left-4 animate-pulse drop-shadow transition-all duration-300 ease-out text-[#ffd657]"
                :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-24 h-24'" />
            <SunLogoIcon class="absolute animate-spin-slow -top-2 -left-4 drop-shadow transition-all duration-300 ease-out text-yellow-300"
                :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-24 h-24'" />
            <SunLogoIcon class="absolute -top-2 -left-4 animate-spin-reverse drop-shadow transition-all duration-300 ease-out text-yellow-300"
                :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-24 h-24'" />
        </div>


        <LogoIcon v-if="showTitle"
            class="dark:text-white text-white  drop-shadow transition-all duration-300 ease-out"
            :class="scrollPosition > 100 ? 'w-24 h-24' : 'w-56 h-56'" />
        <template v-else>
            <div class="flex items-center">
                <HribiLogoIcon
                    class="dark:text-white text-white transform translate-x-4 transition-all duration-300 ease-out animate-pulse"
                    :class="scrollPosition > 100 ? 'w-24 h-10' : 'w-28 h-28'" />
                <NapisiLogoIcon class="dark:text-white text-white   transition-all duration-300 ease-out translate-y-1"
                    :class="scrollPosition > 100 ? 'w-32 h-10' : 'w-28 h-28'" />

            </div>

        </template>
    </div>
</template>
