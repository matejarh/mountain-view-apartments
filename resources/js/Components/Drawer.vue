<script setup>

import CloseIcon from '@/Icons/CloseIcon.vue';
import { useHelperStore } from '@/stores/helpers';
import { onMounted } from 'vue';

defineEmits(['close'])
const helpers = useHelperStore()
</script>

<template>

    <div
        class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-all duration-300 ease-out -translate-x-full bg-white w-80 dark:bg-gray-800 bg-opacity-85 dark:bg-opacity-85 hover:bg-opacity-100 dark:hover:bg-opacity-100 "
        :class="{ 'translate-x-0' : helpers.contactDrawer}"
        tabindex="-1" aria-labelledby="contact-drawer-form-label">
        <h5 class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
           <slot name="title" />
        </h5>
        <button @click="$emit('close')" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <CloseIcon class="w-3 h-3" />
            <span class="sr-only">{{__('Close menu')}}</span>
        </button>
        <slot />
    </div>

</template>
