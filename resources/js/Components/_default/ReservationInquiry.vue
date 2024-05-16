<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { onMounted, ref } from 'vue';
import { useHelperStore } from '@/stores/helpers';

const date = ref(null)
const disabledDates = ref([])
const helpers = useHelperStore()
const options = ref({
    minRange: 2,
    maxRange: 7,
    partialRange: false,
    noDisabledRange: true,
})

</script>

<template>
    <form class=" ">
        <div class="">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Subject')
                }}</label>
            <input type="text" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Apple Keynote" required />
        </div>
        <div class="mt-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{
                __('Message')
                }}</label>
            <textarea id="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Write event description..."></textarea>
        </div>

        <div class="relative mt-4 ">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Date (from-to)')}}</label>
            <VueDatePicker v-model="date" :range="options" :min-date="new Date()" prevent-min-max-navigation
                :disabled-dates="disabledDates" :enable-time-picker="false" :locale="$page.props.locale"
                :format="$page.props.date_format_pattern" :dark="helpers.isDark" six-weeks="center"
                :placeholder="__('Select arrival & departure dates') + '...'"></VueDatePicker>

        </div>
        <!-- <div class="mb-4">
            <label for="guests" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Invite
                guests</label>
            <div class="relative">
                <input type="search" id="guests"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Add guest email" required />
                <button type="button"
                    class="absolute inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-primary-700 rounded-lg end-2 bottom-2 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"><svg
                        class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                    </svg>Add</button>
            </div>
        </div> -->
        <!-- <div class="flex mb-4 -space-x-4 rtl:space-x-reverse">
            <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                src="/docs/images/people/profile-picture-5.jpg" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                src="/docs/images/people/profile-picture-2.jpg" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                src="/docs/images/people/profile-picture-3.jpg" alt="">
            <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                src="/docs/images/people/profile-picture-4.jpg" alt="">
        </div> -->

        <button type="submit"
            class="text-white mt-4 justify-center flex items-center bg-primary-700 hover:bg-primary-800 w-full focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><svg
                class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
                <path
                    d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z" />
            </svg> Pošlji</button>
    </form>
</template>
