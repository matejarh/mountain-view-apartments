<script setup>
import { onMounted, ref, watch, computed } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useForm, usePage } from '@inertiajs/vue3';
import { useHelperStore } from '@/stores/helpers';
import InfoIcon from '@/Icons/InfoIcon.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';

const page = usePage()

const helpers = useHelperStore()

const form = useForm({
    accomodationId: null,
    arrival: new Date(),
    departure: '',
})

const date = ref([]);

const disabledDates = ref(["2024-06-11", "2024-06-12", "2024-06-13", "2024-06-14", "2024-06-31"]);

const addDays = (date, days) => {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}


const handleSelected = (accomodation) => {
    form.accomodationId = accomodation.id
}


const notAvailableMarkers = computed(() => {
    let markers = [];
    disabledDates.value.forEach(date => {
        markers.push({
            date: new Date(date),
            type: 'line',
            tooltip: [{ text: 'Booked...', color: '#e52f1d' }],
            color: 'bg-blue-900 dark:bg-blue-600',
        })
    });
    return markers
})

const highlightedDates = ref(["2024-05-11", "2024-05-12", "2024-05-13", "2024-05-14"])

const options = ref({
    range: {
        minRange: 1,
        maxRange: 7,
        partialRange: false,
        noDisabledRange: true,
    },
    multi: {
        solo: false,
        static: true,
        count: 3,
    },
})
watch(disabledDates, () => {
    dateRangePicker.update({
        disabledDates: disabledDates.value,
        markers: notAvailableMarkers,
        highlight: highlightedDates.value,
    });
});

const book = () => {
    let picker = document.getElementById('rangepicker')

    if (date.value.length > 0) {
        picker.classList.remove('animate-shake')
        alert('You selected from ' + date.value[0].toLocaleDateString(page.props.locale) + ' to ' + date.value[1].toLocaleDateString(page.props.locale));
    } else {
        picker.classList.add('animate-shake')

        helpers.delay(1000)
            .then(() => { picker.classList.remove('animate-shake') })
    }
}

</script>

<template>
    <ShapedSection class="pt-8 sm:pt-4 md:pt-0" :color="{ light: 'primary-700', dark: 'primary-900' }">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-xl text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-white dark:text-white">
                    {{ __('Availability Calendar') }}</h2>

                <div class="flex justify-center w-full mb-2">
                    <div id="rangepicker">
                        <VueDatePicker v-model="date" :range="options.range" :multi-calendars="options.multi"
                            :min-date="new Date()" prevent-min-max-navigation :markers="notAvailableMarkers"
                            :disabled-dates="disabledDates" :highlight="highlightedDates" :enable-time-picker="false"
                            :locale="$page.props.locale" :format="$page.props.date_format_pattern"
                            :dark="helpers.isDark" :six-weeks="false" inline auto-apply
                            :placeholder="__('Select arrival & departure dates...')">

                            <template #marker="{ marker, day, date }">
                                <span class="not-available-marker"></span>
                            </template>

                            <!-- <template #marker-tooltip="{ tooltip, day }">
                                <div>{{__('This day is booked')}}</div>
                            </template> -->

                        </VueDatePicker>
                    </div>

                </div>

                <p class="flex mb-6 font-light text-gray-100 dark:text-gray-300 md:text-lg rounded-lg">
                    <span class="mx-auto flex items-center">
                        <InfoIcon class="w-6 h-6 me-2" />
                        {{ __('Availabiliti calendar for') }} {{ $page.props.property?.title[$page.props.locale] }}

                    </span>
                </p>
                <a @click="book" href="#"
                    class="text-white bg-transparent hover:bg-primaty-700 border border-white focus:ring-4 focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-transparent dark:hover:bg-primary-600 focus:outline-none dark:focus:ring-white">
                    {{ __('Check Availability') }}</a>
            </div>
        </div>
    </ShapedSection>
</template>

<style>
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
