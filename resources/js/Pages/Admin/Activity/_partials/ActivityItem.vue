<script setup>
import Tooltip from '@/Components/Tooltip.vue';
import DesktopIcon from '@/Icons/DesktopIcon.vue';
import MobileIcon from '@/Icons/MobileIcon.vue';
import TabletIcon from '@/Icons/TabletIcon.vue';

defineProps({
    item: Object
})
</script>

<template>
    <li class="mb-10 ms-6">
        <span
            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <img class="rounded-full shadow-lg" :src="item.owner.profile_photo_url"
                :alt="`${item.owner.name}s avatar`" />
        </span>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
            <div class="items-center justify-between mb-3 sm:flex">
                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{
                    item.created_at_diff_for_humans }} from {{ item.location.cityName }}, {{ item.location.countryName }}</time>

                <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">
                    {{ item.owner.name }}
                    {{ __(item.type) }}
                    <a href="#" class="font-semibold text-gray-900 dark:text-white hover:underline">
                        {{ item.subject.name }}</a>
                </div>
            </div>
            <div
                class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                <div class="flex items-center  whitespace-nowrap ">
                    <Tooltip text="Desktop" v-if="item.agent.is_desktop">
                        <DesktopIcon class="w-8 h-8 z-0" />
                    </Tooltip>
                    <Tooltip text="Mobile" v-else-if="item.agent.is_mobile">
                        <MobileIcon class="w-8 h-8 z-0" />
                    </Tooltip>
                    <Tooltip text="Tablet" v-else-if="item.agent.is_tablet">
                        <TabletIcon class="w-8 h-8 z-0" />
                    </Tooltip>
                    <Tooltip text="Unknown" v-else>
                        <DesktopIcon class="w-8 h-8 z-0" />
                    </Tooltip>
                    <div class="ps-3 leading-tight">
                        <p class="text-base">

                            {{ item.agent.browser }}
                        </p>
                        <p class="font-normal text-gray-500 dark:text-gray-300">
                            {{ item.agent.platform }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </li>
</template>
