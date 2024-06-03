<script setup>
import { icons } from '@/icons';
import { computed } from 'vue';

const props = defineProps({
    status: {
        default: 'error',
        type: String
    }
})

const colorsClasses = computed(() => {
    switch (props.status) {
        case 'error':
            return 'text-bittersweet-800 bg-bittersweet-50 dark:bg-gray-800 dark:text-bittersweet-400'
            break;

        case 'success':
            return 'text-amazon-800 bg-amazon-50 dark:bg-gray-800 dark:text-amazon-400'
            break;

        default:
            return 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400'
            break;
    }
})
</script>

<template>
    <div :class="colorsClasses" class="flex p-4 mb-4 text-sm rounded-lg" role="alert">
        <icons.InfoIcon v-if="status === 'success'"  class="flex-shrink-0 inline w-5 h-5 me-3 mt-[2px]" />
        <icons.WarningIcon v-else-if="status === 'error'"  class="flex-shrink-0 inline w-5 h-5 me-3 mt-[2px]" />
        <icons.InfoIcon v-else  class="flex-shrink-0 inline w-5 h-5 me-3 mt-[2px]" />

        <span class="sr-only">{{ __('Danger') }}</span>
        <div class="ms-3 text-sm font-medium">
            <slot />
        </div>
    </div>
</template>
