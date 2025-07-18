<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { debounce, mapValues, trim, pickBy } from 'lodash';
import { ref, watch, watchEffect } from 'vue';
import SearchIcon from '@/Icons/SearchIcon.vue';

const props = defineProps({
    id:String,
    route: String,
    placeholder: {
        type: String,
        default: 'Search'
    },
    filters: {
        default: null,
        type: Object,
    },
    preserveState: {
        default: true,
        type: Boolean,
    }
})
const page = usePage()

const form = ref({
    search: page.props?.filters?.search,
    approved: page.props?.filters?.approved,
    notApproved: page.props?.filters?.notApproved,
    answered: page.props?.filters?.answered,
    notAnswered: page.props?.filters?.notAnswered,
    confirmed: page.props?.filters?.confirmed,
    rejected: page.props?.filters?.rejected,
    paymentReceived: page.props?.filters?.paymentReceived,
    paymentNotReceived: page.props?.filters?.paymentNotReceived,
})

const debouncedHandler = debounce(() => {
    form.value.search = trim(form.value.search)
    router.get(route(props.route), pickBy(form.value), {
        preserveState: props.preserveState,
        preserveScroll: true,
    });
}, 500);

watch(form, debouncedHandler, { deep: true });

watch(props, () => {
    if (props.filters) {
        form.value.approved = props.filters?.approved
        form.value.notApproved = props.filters?.notApproved
        form.value.answered = props.filters?.answered
        form.value.notAnswered = props.filters?.notAnswered
        form.value.confirmed = props.filters?.confirmed
        form.value.rejected = props.filters?.rejected
        form.value.paymentReceived = props.filters?.paymentReceived
        form.value.paymentNotReceived = props.filters?.paymentNotReceived
    }
})

const reset = () => {
    form.value = mapValues(form.value, () => null);
};
</script>

<template>
    <div class="w-full flex justify-between">
        <label :for="id" class="sr-only">{{ __('Search') }}</label>
        <div class="relative grow">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <SearchIcon class="w-6 h-6 text-gray-500 dark:text-gray-200" />
            </div>
            <input type="search" @reset="reset" v-model="form.search" autocomplete="off" :id="id"
                class="block w-full p-3 ps-12 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-700"
                :placeholder="__(placeholder) + '...'">
        </div>
        <div class="">
            <slot />
        </div>
    </div>

</template>

<style scoped>
input[type="search"]::-webkit-search-cancel-button {
    color: #6d6d6d;
/*     position:relative;
    right:20px;

    -webkit-appearance: none;
    height: 24px;
    width: 24px;
    border-radius: 100%;
    background: #6d6d6d; */
    /* background-image: url("/resources/images/Icons/CloseCircleIcon.svg"); */
/*     -webkit-appearance: none;
    cursor: pointer;

    height: 24px;
    width: 24px;
    color: #6d6d6d;
    background-color: #6d6d6d;
    background-blend-mode: multiply;
    background-image: url("/resources/images/Icons/CloseCircleIcon.svg");
     */
}
</style>
