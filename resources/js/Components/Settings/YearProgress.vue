<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage()

const colorClasses = computed(() => {
    switch (page.props.current_season) {
        case 'spring':
            return 'bg-amazon-600 dark:bg-amazon-500'
            break;

        case 'summer':
            return 'bg-bittersweet-600 dark:bg-bittersweet-500'
            break;

        case 'autumn':
            return 'bg-yellow-600 dark:bg-yellow-500'
            break;

        case 'winter':
            return 'bg-primary-600 dark:bg-primary-500'
            break;

        default:
            return 'bg-primary-600 dark:bg-primary-500'
            break;
    }
})

const textClasses = computed(() => {
    switch (page.props.current_season) {
        case 'spring':
            return 'text-amazon-700 dark:text-amazon-500'
            break;

        case 'summer':
            return 'text-bittersweet-700 dark:text-bittersweet-500'
            break;

        case 'autumn':
            return 'text-yellow-700 dark:text-yellow-500'
            break;

        case 'winter':
            return 'text-primary-700 dark:text-primary-500'
            break;

        default:
            return 'text-primary-700 dark:text-primary-500'
            break;
    }
})
const daysInYear = (year) => {
    return ((year % 4 === 0 && year % 100 > 0) || year % 400 === 0) ? 366 : 365;
};

const dayOfTheYear = (date = null) => {
    const now = date ? new Date(date) : new Date();
    const start = new Date(now.getFullYear(), 0, 0);
    const diff = (now - start) + ((start.getTimezoneOffset() - now.getTimezoneOffset()) * 60 * 1000);
    const oneDay = 1000 * 60 * 60 * 24;
    return Math.floor(diff / oneDay);
};

const calculateWidth = () => {
    const year = new Date().getFullYear();
    const allDays = daysInYear(year);
    const dayNum = dayOfTheYear();
    return parseInt((dayNum * 100) / allDays);
};

const width = computed(calculateWidth);
</script>

<template>
    <div class="col-span-full mt-8 relative">
        <div :class="textClasses"
            class="absolute transition -top-6 -translate-x-1/2 mb-1 text-base font-medium capitalize"
            :style="`left: ${width}%`">
            {{ __("It's " + $page.props.current_season)}} </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
            <div :class="colorClasses" class="h-2.5 rounded-full" :style="`width: ${width}%`"></div>
        </div>

    </div>
</template>
