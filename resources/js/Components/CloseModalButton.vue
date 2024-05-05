<script setup>
import CloseModalIcon from '@/Icons/CloseModalIcon.vue';
defineEmits(['close'])
</script>

<template>
    <button type="button" @click="$emit('close')"
        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <CloseModalIcon class="w-5 h-5" />

        <span class="sr-only">{{ __('Close modal') }}</span>
    </button>
</template>
