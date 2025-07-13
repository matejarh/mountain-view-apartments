<script setup>
import { getFormattedDate } from '@/utils/date';
import { icons } from '@/icons';

const props = defineProps({
    notification: Object,
})

</script>

<template>
    <div
        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600 cursor-pointer">
        <div class="flex-shrink-0">
            <icons.MessageIcon class="w-11 h-11 transform -scale-x-100 text-gray-500  rounded-full" />

        </div>
        <div class="pl-3 w-full">
            <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                <span class="font-semibold text-gray-900 dark:text-white">{{ __(notification.data.title)
                    }}:</span><br>
                "{{ __(notification.data.message) }}"
            </div>
            <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                {{ getFormattedDate(notification.created_at, $page.props.locale) }}
            </div>
        </div>
    </div>
</template>
