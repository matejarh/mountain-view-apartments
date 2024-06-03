<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PriceCard from '@/Components/Properties/PriceCard.vue';
import { icons } from '@/icons';
import { useForm, usePage } from '@inertiajs/vue3';
import { useHelperStore } from '@/stores/helpers';
import { computed, getCurrentInstance, ref } from 'vue';


const props = defineProps({
    show: Boolean,
    property: Object,
})

const emit = defineEmits(['close'])

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const helpers = useHelperStore()

const page = usePage();

const showAddRangeCalendar = ref(false)

const form = useForm({
    from: '',
    to: '',
    range: [],
    prices: {}
})

const price = ref({
    guests: 1,
    price: '0.00'
})

const disabledDates = computed(() => {
    return page.props?.defined_dates
});

const notAvailableMarkers = computed(() => {
    let markers = [];
    page.props?.defined_dates?.forEach(date => {
        markers.push({
            date: new Date(date),
            type: 'line',
            tooltip: [{ text: __('Defined') + '...', color: '#059847' }],
            color: 'bg-primary-900 dark:bg-primary-600',
        })
    });
    return markers
})

const highlightedDates = computed(() => {
    return page.props?.defined_dates
})

const startTime = ref([{ hours: 2, minutes: 0 }, { hours: 2, minutes: 0 }]);

const options = ref({
    range: {
        // minRange: datepickerRange.attributes?.min,
        // maxRange: datepickerRange.attributes?.max,
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

const store = () => {
    //emit('close')
    form.post(route('admin.prices.store', props.property), {
        errorBag: 'creatingPrice',
        onSuccess: () => {
            //  console.log('attachec')
        }
    })
}

</script>

<template>
    <DialogModal max-width="6xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Manage Prices') }}</template>

        <template #content>

            <TransitionGroup name="list" tag="ul" key="daterangeGroup"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-8">
                <PriceCard v-for="price, key in $page.props.property.prices.sort((a, b) => new Date(b.from) - new Date(a.from))" :key="`${price.from}-${price.to}`" :item="price" />
            </TransitionGroup>

            <h4 class="text-base font-bold dark:text-white mt-2 cursor-pointer" @click="showAddRangeCalendar = !showAddRangeCalendar">{{ showAddRangeCalendar ? __('Hide Range Calendar') : __('Add New Range') }}</h4>
            <Transition class="relative" enter-active-class="animate__animated animate__zoomIn" leave-active-class="animate__animated animate__zoomOut">
                <div class="" v-show="showAddRangeCalendar">
                    <div class="flex justify-center w-full mb-2">
                        <div id="rangepicker" ref="rangePickerRef">
                            <VueDatePicker v-model="form.range" :range="options.range" :min-date="new Date('2024-01-01')"
                                :multi-calendars="options.multi" :markers="notAvailableMarkers" :start-time="startTime"
                                :disabled-dates="disabledDates" :highlight="highlightedDates" :enable-time-picker="false"
                                :locale="$page.props?.locale" :format="$page.props?.date_format_pattern" :dark="helpers.isDark"
                                :six-weeks="true" :placeholder="__('Select date range...')" auto-apply inline
                                prevent-min-max-navigation>

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
                        <PrimaryButton type="button" @click="store"
                            :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                            :disabled="form.processing || form.recentlySuccessful || !form.isDirty">

                            <div class="flex items-center">
                                <icons.SpinnerIcon v-show="form.processing"
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                {{ form.processing ? __('Adding') + '...' : form.recentlySuccessful ? __('Added') : __('Add') }}
                            </div>
                        </PrimaryButton>
                    </div>

                </div>
            </Transition>
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
    background-color: #059847;
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
</style>
