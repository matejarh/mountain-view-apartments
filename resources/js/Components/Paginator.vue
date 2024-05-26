<script setup>
import { computed } from 'vue';

const props = defineProps({
    paginator: Object,
})
const hasPages = computed(() => {
    return props.paginator.current_page != 1 || props.paginator.current_page < props.paginator.last_page
})
const onFirstPage = computed(() => {
    return props.paginator.current_page <= 1
})
const hasMorePages = computed(() => {
    return props.paginator.current_page < props.paginator.last_page
})

const links = computed(() => {
    let links = props.paginator.links
    links.shift()
    links.pop()
    return links
})
</script>

<template>

    <nav role="navigation" v-if="hasPages"
        class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 py-4">
        <div class="flex justify-between flex-1 md:hidden w-full">

            <span v-if="onFirstPage"
                v-html="__('pagination.previous')"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
            </span>

            <inertia-link v-else :href="paginator.prev_page_url"
                v-html="__('pagination.previous')"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-primary-600 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-primary-700 dark:active:bg-gray-700 dark:active:text-gray-300">
            </inertia-link>

            <inertia-link :href="paginator.next_page_url"
                v-html="__('pagination.next')"
                v-if="hasMorePages"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-primary-600 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-primary-700 dark:active:bg-gray-700 dark:active:text-gray-300">
            </inertia-link>

            <span v-else
                v-html="__('pagination.next')"
                class="relative cursor-not-allowed inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
            </span>

        </div>

        <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                {{ __('Showing') }}
                <span class="font-semibold text-gray-900 dark:text-white">
                    <template v-if="paginator.from">
                        {{ paginator.from }}-{{ paginator.to }}
                    </template>
                    <template v-else>
                        {{ paginator.total }}

                    </template>

                </span>
                {{ __('of') }}
                <span class="font-semibold text-gray-900 dark:text-white">{{ paginator.total }}</span>
            </span>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    <!-- Previous Page Link } -->
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>

                            <span
                                v-if="onFirstPage"
                                class="flex cursor-not-allowed items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-300 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600 ">
                                <span class="sr-only" v-html="__('pagination.previous')"></span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>

                            <inertia-link :href="paginator.prev_page_url" rel="prev"
                                v-else
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only" v-html="__('pagination.previous')"></span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </inertia-link>


                        </li>
                        <!-- {{ paginator.links }} -->
                        <template v-for="page, key in links" :key="key">

                            <li v-if="page.url === null">
                             <span
                                class="flex cursor-not-allowed items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 ">
                                {{ page.label }}</span>
                            </li>
                            <template v-else >
                                <span
                                v-if="page.active"
                                    class="flex cursor-not-allowed items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-white bg-primary-600 border border-primary-700 hover:bg-primary-600 hover:text-white dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                    {{ page.label }}</span>
                                <li v-else>

                                    <inertia-link :href="page.url"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        {{ page.label }}
                                    </inertia-link >
                                </li>

                            </template>
                        </template>

                        <li>

                        <inertia-link v-if="hasMorePages" :href="paginator.next_page_url" rel="next"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </inertia-link>
                            <span v-else>
                                <span
                                    class="flex cursor-not-allowed items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-300 bg-white rounded-r-lg border border-gray-300  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600 "
                                    aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        </li>

                    </ul>
                </span>
            </div>
        </div>
    </nav>
</template>
