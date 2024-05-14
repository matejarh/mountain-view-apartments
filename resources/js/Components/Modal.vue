<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';
import Tooltip from './Tooltip.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    isFullScreen: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close']);
const dialog = ref();
const showSlot = ref(props.show);

watch(() => props.show, () => {
    if (props.show) {
        document.body.style.overflow = 'hidden';
        showSlot.value = true;
        dialog.value?.showModal();
    } else {
        document.body.style.overflow = null;
        setTimeout(() => {
            dialog.value?.close();
            showSlot.value = false;
        }, 200);
    }
});

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        'sm': 'sm:max-w-sm',
        'md': 'sm:max-w-md',
        'lg': 'sm:max-w-lg',
        'xl': 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '3xl': 'md:max-w-3xl',
        '4xl': 'md:max-w-4xl',
        '5xl': 'md:max-w-5xl',
        '6xl': 'md:max-w-6xl',
        '7xl': 'md:max-w-7xl',
        'screen': 'max-w-screen',
    }[props.maxWidth];
});

const fullScreenClasses = computed(() => {
    return props.isFullScreen ? 'bg-transparent w-full' : 'bg-white dark:bg-gray-800 overflow-x-visible overflow-y-auto lg:mb-6 w-full sm:w-full sm:mx-4'
})
</script>

<template>
    <teleport to="body">
        <dialog class="z-50 m-0 min-h-full min-w-full bg-transparent backdrop:bg-transparent backdrop-blur-sm" ref="dialog">
            <div class="fixed inset-0 flex flex-col justify-center items-center px-0 py-6 sm:px-4 z-50" scroll-region>
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0"
                    enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-950 opacity-75" />
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                    <div v-if="show && isFullScreen"
                        class="absolute top-2 right-2 sm:top-6 sm:right-6 lg:top-10 lg:right-10 z-50">
                        <Tooltip :text="__('Close')" location="bottom">
                            <button type="button" @click="close"
                                class="transition hover:scale-105 active:scale-95 hover:rotate-180 shadow-lg text-white bg-white bg-opacity-50 opacity-50 p-4 lg:p-6 rounded-full text-xl ms-auto inline-flex justify-center items-center"
                                data-modal-toggle="crud-modal">
                                <svg class="w-4 h-4 md:w-6 md:h-6 lg:w-8 lg:h-8 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">{{ __('Close modal') }}</span>
                            </button>
                        </Tooltip>
                    </div>
                </transition>


                <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                    <div v-show="show" :class="[maxWidthClass,fullScreenClasses]"
                        class="  text-gray-700 dark:text-gray-200 rounded-lg shadow-xl  scrollbar-thin transform transition-all  ">
                        <slot v-if="showSlot" />
                    </div>
                </transition>
            </div>
        </dialog>
    </teleport>
</template>
