<script setup>
import Drawer from '@/Components/Drawer.vue';
import '@vuepic/vue-datepicker/dist/main.css'
import { computed, ref } from 'vue';
import { useHelperStore } from '@/stores/helpers';
import { usePage } from '@inertiajs/vue3';
import ReservationInquiry from '@/Components/_default/ReservationInquiry.vue';

const page = usePage()

const date = ref(null)
const disabledDates = ref([])
const helpers = useHelperStore()

const companyData = computed(() => {
    return page.props?.settings.find(setting => setting.slug === 'company-info')
})

const datepickerRange = page.props?.settings?.find(setting => setting.slug === 'datepicker-range')

const options = ref({
    minRange: datepickerRange.attributes?.min,
    maxRange: datepickerRange.attributes?.max,
    partialRange: false,
    noDisabledRange: true,
})

</script>

<template>
    <Drawer>
        <template #title>
            <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
            </svg>{{ __('Reservation Inquiry') }}
        </template>

        <ReservationInquiry @close="helpers.hideContactDrawer" />

        <template #bottom>
            <div id="dropdown-cta" class="p-4 mt-6 rounded-lg bg-primary-50 dark:bg-primary-900" role="alert">
                <div class="flex items-center mb-3">
                    <span
                        class="bg-bittersweet-100 text-bittersweet-800 text-sm font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-bittersweet-200 dark:text-bittersweet-900">Beta</span>

                </div>
                <h3 class="mb-3 text-lg font-semibold text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.company_name }}
                </h3>
                <p class=" text-sm text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.address }}
                </p>
                <p class=" text-sm text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.city }}
                </p>
                <p class=" text-sm text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.country }}
                </p>
                <p class=" text-sm text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.phone }}
                </p>
                <p class=" text-sm text-primary-800 dark:text-primary-400">
                    {{ companyData.attributes.email }}
                </p>
               <!--  <a class="text-sm text-primary-800 underline font-medium hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300"
                    href="#">Turn new navigation off</a> -->
            </div>
        </template>

    </Drawer>
</template>

<style scoped>
:root {
    --dp-font-family: font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --dp-font-size: 0.875rem;
    --dp-input-padding: 0.625rem;
    --dp-border-radius: 0.5rem;

}

.dp__theme_dark {
    --dp-background-color: rgb(79 79 79);
    --dp-hover-color: #454545;
    --dp-hover-text-color: #fff;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #0093c4;
    --dp-primary-disabled-color: #61a8ea;
    --dp-primary-text-color: #fff;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: rgb(93 93 93);
    --dp-menu-border-color: rgb(93 93 93);
    --dp-border-color-hover: #b0b0b0;
    --dp-disabled-color: #6d6d6d;
    --dp-disabled-color-text: #6d6d6d;
    --dp-scroll-bar-background: rgb(93 93 93);
    ;
    --dp-scroll-bar-color: #4f4f4f;
    --dp-success-color: #2f6c4b;
    --dp-success-color-disabled: #63a47d;
    --dp-icon-color: #848484;
    --dp-danger-color: #e52f1d;
    --dp-marker-color: #e52f1d;
    --dp-tooltip-color: #454545;
    --dp-highlight-color: rgb(0 123 167 / 20%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #454545);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #fff);
    --dp-range-between-border-color: var(--dp-hover-color, #fff);
}

.dp__theme_light {
    --dp-background-color: rgb(246 246 246);
    --dp-text-color: #262626;
    --dp-hover-color: #e7e7e7;
    --dp-hover-text-color: #262626;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #007ba7;
    --dp-primary-disabled-color: #00bbea;
    --dp-primary-text-color: #f6f6f6;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: rgb(176 176 176);
    --dp-menu-border-color: rgb(176 176 176);
    --dp-border-color-hover: #b0b0b0;
    --dp-disabled-color: #e7e7e7;
    --dp-scroll-bar-background: #e7e7e7;
    --dp-scroll-bar-color: #b0b0b0;
    --dp-success-color: #63a47d;
    --dp-success-color-disabled: #bdddc7;
    --dp-icon-color: #848484;
    --dp-danger-color: #ff6f61;
    --dp-marker-color: #ff6f61;
    --dp-tooltip-color: #f6f6f6;
    --dp-disabled-color-text: #848484;
    --dp-highlight-color: rgb(0 123 167 / 10%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #e7e7e7);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #262626);
    --dp-range-between-border-color: var(--dp-hover-color, #e7e7e7);
}
</style>
