<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { icons } from '@/icons';
import { useForm, usePage } from '@inertiajs/vue3';
import { useHelperStore } from '@/stores/helpers';
import { computed, getCurrentInstance, ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';


const props = defineProps({
    show: Boolean,
    property: Object,
})

const emit = defineEmits(['close'])

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const helpers = useHelperStore()

const page = usePage();

const form = useForm({
    range: [],
})


const disabledDates = computed(() => {
    return page.props?.booked_days
});

const notAvailableMarkers = computed(() => {
    let markers = [];
    page.props?.disabled_days?.forEach(date => {
        markers.push({
            date: new Date(date),
            type: 'line',
            tooltip: [{ text: __('Not Available') + '...', color: '#d71515' }],
            color: 'bg-primary-900 dark:bg-primary-600',
        })
    });
    return markers
})
const bookedDaysMarkers = computed(() => {
    let markers = [];
    page.props?.booked_days?.forEach(date => {
        markers.push({
            date: new Date(date),
            type: 'line',
            tooltip: [{ text: __('Booked') + '...', color: '#d71515' }],
            color: 'bg-primary-900 dark:bg-primary-600',
        })
    });
    return markers
})

const markers = computed(() => {
    return notAvailableMarkers.value.concat(bookedDaysMarkers.value);
})

const highlightedDates = computed(() => {
    return page.props?.unavailable_dates
})

const startTime = ref([{ hours: 2, minutes: 0 }, { hours: 2, minutes: 0 }]);

const options = ref({
    range: {
        // minRange: 1,
        // maxRange: 30,
        partialRange: false,
        noDisabledRange: true,
    },
    multi: {
        solo: false,
        static: true,
        count: 3,
    },
})

const tomorrow = computed(() => {
    const today = new Date()
    const tomorrow = new Date(today)
    tomorrow.setDate(today.getDate() + 1)
    return tomorrow
})

const enable = () => {
    //emit('close')
    form.put(route('admin.properties.unavailable_dates.enable', props.property), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            emit('close')
            //  console.log('attachec')
        }
    })
}
const disable = () => {
    //emit('close')
    form.put(route('admin.properties.unavailable_dates.disable', props.property), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            emit('close')
            //  console.log('attachec')
        }
    })
}

</script>

<template>
    <DialogModal max-width="6xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Manage Unavailable Dates') }}</template>

        <template #content>
                    <div class="">
                        {{ form.range }}
                    </div>
                    <div class="flex justify-center w-full mb-2">
                        <div id="rangepicker" ref="rangePickerRef">
                            <VueDatePicker v-model="form.range" :range="options.range"
                                :state="false"
                                :min-date="new Date('2024-01-01')" :multi-calendars="options.multi"
                                :markers="markers" :start-time="startTime" :disabled-dates="disabledDates"
                                :highlight="highlightedDates" :enable-time-picker="false" :locale="$page.props?.locale"
                                :format="$page.props?.date_format_pattern" :dark="helpers.isDark" :six-weeks="true"
                                :placeholder="__('Select date range...')" auto-apply inline prevent-min-max-navigation>

                                <template #marker="{ marker, day, date }">
                                    <span class="not-available-marker"></span>
                                </template>

                                <!-- <template #marker-tooltip="{ tooltip, day }">
                                    <div>{{__('This day is booked')}}</div>
                                </template> -->

                            </VueDatePicker>
                            <InputError :message="form.errors.range" />
                            <InputError :message="form.errors.from" />
                            <InputError :message="form.errors.to" />
                        </div>

                    </div>
                    <div class="w-full flex justify-center">
                        <PrimaryButton type="button" @click="enable"
                            :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                            :disabled="form.processing || form.recentlySuccessful || !form.isDirty">

                            <div class="flex items-center">
                                <icons.SpinnerIcon v-show="form.processing"
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                {{ form.processing ? __('Enabling') + '...' : form.recentlySuccessful ? __('Enabled') :
                                __('Enable') }}
                            </div>
                        </PrimaryButton>
                        <DangerButton type="button" @click="disable"
                            :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                            :disabled="form.processing || form.recentlySuccessful || !form.isDirty">

                            <div class="flex items-center">
                                <icons.SpinnerIcon v-show="form.processing"
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                {{ form.processing ? __('Disabling') + '...' : form.recentlySuccessful ? __('Disabled') :
                                __('Disable') }}
                            </div>
                        </DangerButton>
                    </div>



        </template>

        <template #footer>


        </template>

    </DialogModal>
</template>

<style scoped>
.not-available-marker {
    position: absolute;
    top: 0;
    right: 0;
    height: 8px;
    width: 8px;
    border-radius: 100%;
    background-color: #d71515;
}

.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}

:root {
    /*General*/
    --dp-font-family: -apple-system, blinkmacsystemfont, "Segoe UI", roboto, oxygen, ubuntu, cantarell, "Open Sans",
    "Helvetica Neue", sans-serif;
    --dp-border-radius: 4px; /*Configurable border-radius*/
    --dp-cell-border-radius: 4px; /*Specific border radius for the calendar cell*/
    --dp-common-transition: all 0.1s ease-in; /*Generic transition applied on buttons and calendar cells*/

    /*Sizing*/
    --dp-button-height: 35px; /*Size for buttons in overlays*/
    --dp-month-year-row-height: 35px; /*Height of the month-year select row*/
    --dp-month-year-row-button-size: 35px; /*Specific height for the next/previous buttons*/
    --dp-button-icon-height: 20px; /*Icon sizing in buttons*/
    --dp-cell-size: 35px; /*Width and height of calendar cell*/
    --dp-cell-padding: 5px; /*Padding in the cell*/
    --dp-common-padding: 10px; /*Common padding used*/
    --dp-input-icon-padding: 35px; /*Padding on the left side of the input if icon is present*/
    --dp-input-padding: 6px 30px 6px 12px; /*Padding in the input*/
    --dp-menu-min-width: 260px; /*Adjust the min width of the menu*/
    --dp-action-buttons-padding: 2px 5px; /*Adjust padding for the action buttons in action row*/
    --dp-row-margin:  5px 0; /*Adjust the spacing between rows in the calendar*/
    --dp-calendar-header-cell-padding:  0.5rem; /*Adjust padding in calendar header cells*/
    --dp-two-calendars-spacing:  10px; /*Space between multiple calendars*/
    --dp-overlay-col-padding:  3px; /*Padding in the overlay column*/
    --dp-time-inc-dec-button-size:  32px; /*Sizing for arrow buttons in the time picker*/
    --dp-menu-padding: 6px 8px; /*Menu padding*/

    /*Font sizes*/
    --dp-font-size: 1rem; /*Default font-size*/
    --dp-preview-font-size: 0.8rem; /*Font size of the date preview in the action row*/
    --dp-time-font-size: 0.8rem; /*Font size in the time picker*/

    /*Transitions*/
    --dp-animation-duration: 0.1s; /*Transition duration*/
    --dp-menu-appear-transition-timing: cubic-bezier(.4, 0, 1, 1); /*Timing on menu appear animation*/
    --dp-transition-timing: ease-out; /*Timing on slide animations*/
}
</style>
