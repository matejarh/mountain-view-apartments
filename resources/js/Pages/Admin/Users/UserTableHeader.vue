<script setup>
import { ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import debounce from "lodash/debounce";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import { trim } from 'lodash';

const page = usePage()

const form = ref({
    search: page.props.filters.search,
    sortBy: page.props.filters.sortBy,
    sortDirection: page.props.filters.sortDirection,
})

const debouncedHandler = debounce(() => {
    form.value.search = trim(form.value.search)
    router.get(route('admin.users.index'), pickBy(form.value), {
        preserveState: true,
        preserveScroll: true,
    });
}, 500);

watch(form, debouncedHandler, { deep: true });

const reset = () => {
    form.value = mapValues(form.value, () => null);
};

const showActions = ref(false)
</script>

<template>
    <div class="relative">
        <div class="fixed inset-0 z-30 w-screen h-screen" v-show="showActions" @click="showActions = false"></div>
        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="showActions = !showActions"
            class="inline-flex items-center text-gray-500 hover:text-white focus:text-white bg-white border border-gray-300 focus:outline-none focus:bg-primary-600 hover:bg-primary-600 focus:none focus:ring-primary-600 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
            type="button">
            <span class="sr-only">{{ __('Action button') }}</span>
            {{__('Sort By')}}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownAction" v-show="showActions"
            class="z-40 absolute mt-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">

                <li>
                    <button type="button"
                        @click="form.sortBy = 'name', form.sortDirection = 'asc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Name')}} A-Z</button>
                </li>
                <li>
                    <button type="button"
                        @click="form.sortBy = 'name', form.sortDirection = 'desc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Name')}} Z-A</button>
                </li>
                <li>
                    <button type="button"
                        @click="form.sortBy = 'email', form.sortDirection = 'asc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Email')}} A-Z</button>
                </li>
                <li>
                    <button type="button"
                        @click="form.sortBy = 'email', form.sortDirection = 'desc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Email')}} Z-A</button>
                </li>
                <li>
                    <button type="button"
                        @click="form.sortBy = 'phone', form.sortDirection = 'asc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Phone')}} A-Z</button>
                </li>
                <li>
                    <button type="button"
                        @click="form.sortBy = 'phone', form.sortDirection = 'desc', showActions=false"
                        class="text-left block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap">{{__('Phone')}} Z-A</button>
                </li>

            </ul>
            <div class="py-1">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{__('Delete User')}}</a>
            </div>
        </div>
    </div>
    <label for="table-search-users" class="sr-only">{{ __('Search') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" @reset="reset" v-model="form.search" autocomplete="off" id="table-search-users"
            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-700"
            :placeholder="__('Search for users') + '...'">
    </div>
</template>
