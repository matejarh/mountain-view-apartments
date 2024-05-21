<script setup>
import { ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import debounce from "lodash/debounce";
import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import { trim } from 'lodash';

const page = usePage()

const form = ref({
    search: page.props?.filters.search,
    sortBy: page.props?.filters.sortBy,
    sortDirection: page.props?.filters.sortDirection,
})

const debouncedHandler = debounce(() => {
    form.value.search = trim(form.value.search)
    router.get(route('admin.users.activities.index'), pickBy(form.value), {
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
    <label for="table-search-activities" class="sr-only">{{ __('Search') }}</label>
    <div class="relative">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" @reset="reset" v-model="form.search" autocomplete="off" id="table-search-activities"
            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-700"
            :placeholder="__('Search for activities') + '...'">
    </div>
</template>
