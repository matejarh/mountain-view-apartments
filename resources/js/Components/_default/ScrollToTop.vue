<script setup>
import { useScrollStore } from '@/stores/scroll';
import { icons } from '@/icons';
import Tooltip from '@/Components/_default/Tooltip.vue';

const scroll = useScrollStore()

const scrollToTop = () => {
    const mainElement = document.getElementById('main');
    if (mainElement) {
        mainElement.scrollTo({ top: 0, behavior: 'smooth' });
    }
};
</script>

<template>
    <div class="">
        <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 translate-y-16 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-16 sm:scale-95">
            <div class="absolute bottom-2 right-6 z-30" v-if="scroll.scrollPosition > 200">
                <button @click="scrollToTop"
                    class="inline-flex bg-opacity-20 shadow-lg overflow-visible dark:bg-opacity-20 hover:bg-opacity-70 hover:bg-primary-700 dark:hover:bg-primary-600 hover:dark:bg-opacity-70 justify-center p-0 text-gray-100 rounded-lg cursor-pointer dark:text-gray-200 dark:hover:text-white hover:text-white bg-primary-700 dark:bg-primary-800 transition ease-in-out duration-300 hover:-translate-y-1">
                    <Tooltip :text="__('Scroll To Top')">
                        <icons.ArrowUpIcon class="w-16 h-16 drop-shadow-lg" />
                    </Tooltip>
                </button>
            </div>
        </Transition>
    </div>
</template>
