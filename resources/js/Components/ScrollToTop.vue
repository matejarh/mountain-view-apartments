<script setup>
import ArrowUpIcon from '@/Icons/ArrowUpIcon.vue';
import Tooltip from './Tooltip.vue';

const props = defineProps({
    scrollTop: Number,
})

const scrollToTop = () => {
    document.getElementById('main').scrollTo(0, 0);
}
</script>

<template>
    <div class="overflow-hidden">
        <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 translate-y-16 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-16 sm:scale-95">
            <div class="absolute bottom-2 right-6" v-show="scrollTop > 200">

                <Tooltip :text="__('Scroll To Top')">

                    <button @click="scrollToTop"
                        class="inline-flex bg-opacity-50 dark:bg-opacity-50 hover:bg-opacity-70 hover:dark:bg-opacity-70 justify-center p-0 text-gray-100 rounded cursor-pointer dark:text-gray-100 dark:hover:text-white hover:text-gray-50 bg-primary-600 dark:bg-gray-600 transition ease-in-out duration-300 hover:-translate-y-1">
                        <ArrowUpIcon class="w-12 h-12" />
                    </button>
                </Tooltip>


            </div>
        </Transition>
    </div>
</template>
