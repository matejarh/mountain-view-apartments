<script setup>
import { onMounted, ref, watch } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useForm, usePage } from '@inertiajs/vue3';
import AccomodationsDropdown from '@/Components/_default/AccomodationsDropdown.vue';
import { useHelperStore } from '@/stores/helpers';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import "/resources/css/datepicker.css"
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';

const page = usePage()

const helpers = useHelperStore()

const form = useForm({
    accomodationId: null,
    arrival: new Date(),
    departure: '',
})

const date = ref();

const isArrival = ref(true)

const disabledDates = ref(["2024-05-11", "2024-05-12", "2024-05-13", "2024-05-14"]);


const propertyProxy = ref(null)

const handleSelected = (accomodation) => {
    propertyProxy.value = accomodation
}

const datepickerRange = page.props?.settings?.find(setting => setting.slug === 'datepicker-range')

const options = ref({
    minRange: datepickerRange.attributes?.min,
    maxRange: datepickerRange.attributes?.max,
    partialRange: false,
    noDisabledRange: true,
})
watch(disabledDates, () => {
    dateRangePicker.update({
        disabledDates: disabledDates.value
    });
});

</script>

<template>
    <section class="relative z-20 bg-primary-700 dark:bg-primary-900 pt-0 sm:pt-0 md:pt-0">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-xl text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-white dark:text-white">
                    {{ __('Check availability') }}</h2>

                <form action="" class="mb-6 w-full h-auto block" @submit.prevent="">
                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                        <AccomodationsDropdown class="w-full" direction="down" :selected-property="propertyProxy" @selected="handleSelected" />

                        <VueDatePicker v-model="date"
                                :range="options"
                                :min-date="new Date()"
                                prevent-min-max-navigation
                                :disabled-dates="disabledDates"
                                :enable-time-picker="false"
                                :locale="$page.props?.locale"
                                :format="$page.props?.date_format_pattern"
                                :dark="helpers.isDark"
                                six-weeks="center"
                                :placeholder="__('Select arrival & departure dates') + '...'"
                                ></VueDatePicker>


                    </div>

                </form>
                <!-- <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg rounded-lg">Try Flowbite Platform for 30
                    days. No credit card required.</p> -->
                <a href="#"
                    class="text-white bg-transparent hover:bg-primaty-700 border border-white focus:ring-4 focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-transparent dark:hover:bg-primary-600 focus:outline-none dark:focus:ring-white">
                    {{ __('Check availability') }}</a>
            </div>
        </div>
        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 w-full top-0 rotate-180 text-primary-700 dark:text-primary-900 " />
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
    </section>
</template>

<style scoped>
.not-available-marker {
    position: absolute;
    top: 0;
    right: 0;
    height: 8px;
    width: 8px;
    border-radius: 100%;
    background-color: #e52f1d;
}

:root {
    --dp-font-family: font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --dp-font-size: 1.125rem;
    --dp-input-padding: 0.625rem;
    --dp-border-radius: 0.5rem;

}

.dp__theme_dark {
    --dp-background-color: #262626;
    --dp-hover-color: #454545;
    --dp-hover-text-color: #fff;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #0093c4;
    --dp-primary-disabled-color: #61a8ea;
    --dp-primary-text-color: #fff;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: #2d2d2d;
    --dp-menu-border-color: #262626;
    --dp-border-color-hover: #b0b0b0;
    --dp-disabled-color: #6d6d6d;
    --dp-disabled-color-text: #6d6d6d;
    --dp-scroll-bar-background: #262626;
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
    --dp-background-color: #fff;
    --dp-text-color: #262626;
    --dp-hover-color: #e7e7e7;
    --dp-hover-text-color: #262626;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #007ba7;
    --dp-primary-disabled-color: #00bbea;
    --dp-primary-text-color: #f6f6f6;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: #d1d1d1;
    --dp-menu-border-color: #d1d1d1;
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
