<script setup>
import SunLogoIcon from '@/Icons/SunLogoIcon.vue';
import LogoIcon from '@/Icons/LogoIcon.vue';
import HribiLogoIcon from '@/Icons/HribiLogoIcon.vue';
import NapisiLogoIcon from '@/Icons/NapisiLogoIcon.vue';
import { computed } from 'vue';

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

const sunSize = computed(() => {
    return 'w-8 h-8 md:w-12 md:h-12'
})

</script>

<template>
    <div class="relative">
        <div class="relative">
            <SunLogoIcon class="absolute animate-spin-slow top-0  drop-shadow transition-all duration-300 ease-out text-yellow-300"
                :class="scrollPosition > 100 ? 'w-8 h-8' : sunSize" />
            <SunLogoIcon class="absolute animate-spin-reverse top-0  drop-shadow transition-all duration-300 ease-out text-yellow-300"
                :class="scrollPosition > 100 ? 'w-8 h-8' : sunSize" />
            <SunLogoIcon class="absolute top-0 animate-ping drop-shadow transition-all duration-300 ease-out text-yellow-300"
                :class="scrollPosition > 100 ? 'w-8 h-8' : sunSize" />

        </div>


        <LogoIcon v-if="showTitle"
            class="dark:text-gray-50 text-gray-950  drop-shadow transition-all duration-300 ease-out "
            :class="scrollPosition > 100 ? 'w-24 h-24' : 'w-24 md:w-32 h-24 md:h-32'" />
        <template v-else>
            <div class="flex items-center">
                <HribiLogoIcon
                    class="dark:text-gray-50 text-gray-950 transform translate-x-4 transition-all duration-300 ease-out "
                    :class="scrollPosition > 100 ? 'w-24 h-10' : 'w-24 md:w-28 h-10 md:h-28'" />
                <NapisiLogoIcon class="dark:text-gray-50 text-gray-950   transition-all duration-300 ease-out translate-y-1"
                    :class="scrollPosition > 100 ? 'w-32 h-10' : 'w-24 md:w-28 h-10 md:h-28'" />

            </div>

        </template>
    </div>
</template>
