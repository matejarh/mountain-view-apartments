<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import { ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import debounce from "lodash/debounce";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import { trim } from 'lodash';
import TableRow from './TableRow.vue'


const page = usePage()

const form = ref({
    search: page.props.filters.search,
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

<ActionSection>
    <template #title>
        {{ __("Users List") }}
    </template>
    <template #content>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 pb-4 bg-white dark:bg-gray-800">
                <div class="relative">
                    <div class="fixed inset-0 z-30 w-screen h-screen" v-show="showActions" @click="showActions=false"></div>
                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                    @click="showActions = !showActions"
                        class="inline-flex items-center text-gray-500 hover:text-white focus:text-white bg-white border border-gray-300 focus:outline-none focus:bg-primary-600 hover:bg-primary-600 focus:none focus:ring-primary-600 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        <span class="sr-only">Action button</span>
                        Action
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAction"
                    v-show="showActions"
                        class="z-40 absolute mt-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                    account</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                User</a>
                        </div>
                    </div>
                </div>
                <label for="table-search-users" class="sr-only">{{__('Search')}}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" @reset="reset" v-model="form.search" autocomplete="off" id="table-search-users"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-700"
                        :placeholder="__('Search for users')">
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">{{__('checkbox')}}</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Name')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Phone')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Address')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Country')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Status')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <TableRow v-for="user in $page.props.users.data" :key="user.id" :user="user" />
                </tbody>
            </table>
            <div class="" v-html="$page.props.links"></div>
        </div>
    </template>

</ActionSection>

</template>
