<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    href:String,
})

//$page.url.startsWith(href)
</script>

<template>
    <li class="sm:pl-2">
        <Link :href="href"
        :class="{'bg-primary-600 hover:bg-primary-500 text-white dark:bg-primary-800 dark:hover:bg-primary-900': $page.url.startsWith(href)}"
            class="flex items-center px-2 py-1 pl-11 w-full text-base font-medium text-gray-900 rounded-l-lg transition-color duration-75 group  hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><slot /></Link>
    </li>
</template>
