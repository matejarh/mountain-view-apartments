<script setup>
import { useScrollStore } from '@/stores/scroll';
import { icons } from '@/icons';
import Tooltip from './Tooltip.vue';

/* defineProps({
    scrollTop: Number,
});
 */
const scroll = useScrollStore()

const scrollForward = () => {
    const mainElement = document.getElementById('main');
    let next = scroll.scrollPosition + scroll.windowHeight
    if (mainElement) {
        mainElement.scrollTo({ top: next, behavior: 'smooth' });
    }
};
</script>

<template>
    <div class="relative">
        <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 translate-y-16 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-16 sm:scale-95">
            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 z-30" v-if="!scroll.isBottom">
                <button @click="scrollForward"
                    class="inline-flex opacity-60 hover:opacity-100 dark:bg-opacity-60 dark:hover:opacity-100  overflow-visible bg-transparent justify-center p-0 text-primary-600 rounded-lg cursor-pointer dark:text-gray-200 dark:hover:text-white hover:text-primary-500  transition-all ease-in-out duration-300 hover:translate-y-1 active:translate-y-2">
                    <Tooltip :text="__('Show more') + '...'">
                    <div class="animate-bounce hover:animate-none">

                            <icons.CarretLeftIcon class="w-16 h-16 drop-shadow  -rotate-90" />
                        </div>
                    </Tooltip>
                </button>
            </div>
        </Transition>
    </div>
</template>
