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

        <SunLogoIcon class="absolute top-2 drop-shadow transition-all duration-300 ease-out"
            :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-12 h-12'" />
        <SunLogoIcon class="absolute top-2 animate-ping drop-shadow transition-all duration-300 ease-out"
            :class="scrollPosition > 100 ? 'w-8 h-8' : 'w-12 h-12'" />


        <LogoIcon v-if="showTitle" class="dark:text-gray-50 text-gray-950  drop-shadow transition-all duration-300 ease-out animate-pulse"
            :class="scrollPosition > 100 ? 'w-24 h-24' : 'w-32 h-32'" />
            <template v-else>
                <div class="flex">
                    <HribiLogoIcon class="dark:text-gray-50 text-gray-950   transition-all duration-300 ease-out animate-pulse"
                    :class="scrollPosition > 100 ? 'w-24 h-24' : 'w-28 h-28'" />
                    <NapisiLogoIcon class="dark:text-gray-50 text-gray-950   transition-all duration-300 ease-out"
                    :class="scrollPosition > 100 ? 'w-32 h-24' : 'w-28 h-28'" />

                </div>

            </template>
    </div>
</template>
