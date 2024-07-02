<template>
    <ActionSection>
        <template #title>{{ __('Create Reservation') }}</template>
        <template #content>

            <div class="">
                <Alert v-if="errors || form.hasErrors">
                    <span v-if="errors">

                        {{ errors.message }}
                    </span>
                    <ul v-if="form.hasErrors">
                        <li v-for="error,key in form.errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </Alert>
            </div>
            <div class="">
                <InputLabel :value="__('Name')" for="name" />
                <TextInput id="name" class="mt-1 block w-full" type="text" v-model="form.name"
                    :has-error="!!form.errors.name" />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="">
                <InputLabel :value="__('Email')" for="email" />
                <TextInput id="email" class="mt-1 block w-full" type="text" v-model="form.email"
                    :has-error="!!form.errors.email" />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>
            <div class="">
                <InputLabel :value="__('Phone')" for="phone" />
                <TextInput id="phone" class="mt-1 block w-full" type="text" v-model="form.phone"
                    :has-error="!!form.errors.phone" />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>
            <div class="">
                <InputLabel :value="__('Apartment')" for="apartment" />
                <AccomodationsDropdown id="apartment" :selected-property="form.property"
                    @selected="handleSelectedProperty" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-show="form.property" >
                <div id="rangepicker" ref="rangePickerRef">
                    <InputLabel :value="__('Date range')" for="daterange" />
                    <VueDatePicker ref="dateRangePickerRef"
                        v-model="form.date"
                        :range="options.range"
                        :multi-calendars="options.multi"
                        :min-date="tomorrow"
                        :max-date="yearFromNow"
                        prevent-min-max-navigation
                        :markers="notAvailableMarkers"
                        :disabled-dates="disabledDates"
                        :highlight="highlightedDates"
                        :enable-time-picker="false"
                        :locale="$page.props?.locale"
                        :format="$page.props?.date_format_pattern"
                        :dark="helpers.isDark"
                        :six-weeks="true"
                        auto-apply
                        :placeholder="__('Select arrival & departure dates...')">

                        <template #marker="{ marker, day, date }">
                            <span class="not-available-marker"></span>
                        </template>

                        <!-- <template #marker-tooltip="{ tooltip, day }">
                                <div>{{__('This day is booked')}}</div>
                            </template> -->

                    </VueDatePicker>
                </div>
                <div class="">
                    <InputLabel :value="__('Guests')" for="adults" />
                    <TextInput id="adults" v-model="form.guests.adults" type="number" min="1" max="5" step="1"
                        class="mt-1 block w-full" :has-error="!!form.errors.guests?.adults" />
                    <InputError :message="form.errors.guests?.adults" class="mt-2" />
                </div>

                <!-- <div class="">
                    <InputLabel :value="__('Kids')" for="children" />
                    <TextInput id="children" v-model="form.guests.children" type="number" min="0" max="4" step="1"
                        class="mt-1 block w-full" :has-error="!!form.errors.guests?.children" />
                    <InputError :message="form.errors.guests?.children" class="mt-2" />
                </div>
                <div class="">
                    <InputLabel class="inline-flex items-center justify-center cursor-pointer w-full">
                        {{ __('Pets') }}
                        <input type="checkbox" value="" class="sr-only peer" v-model.checked="form.guests.pets" />
                        <div
                            class="mx-auto mt-3 relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amazon-600 dark:peer-focus:ring-amazon-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-amazon-600">
                        </div>
                    </InputLabel>
                </div> -->

            </div>

            <div class="">
                <InputLabel :value="__('Message')" for="message" />
                <TipTapInput v-model="form.message" :is-small="true" id="message" :has-error="!!form.errors.message"/>
                <InputError :message="form.errors.message" class="mt-2" />
            </div>

            <div class="">
                <PrimaryButton
                type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty || !form.property || form.date.length === 0  }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty || !form.property || form.date.length === 0"
                @click="calculate"
            >
                <div class="flex items-center">
                    <icons.SpinnerIcon v-show="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Submitting') + '...' : form.recentlySuccessful ? __('Submitted') : __('Calculate Price') }}
                </div>
            </PrimaryButton>
            </div>
        </template>
    </ActionSection>

    <ConfirmationModal
        :is-danger="false"
        :show="showConfirmationDialog"
        @close="showConfirmationDialog = false"
        @confirmed="recaptcha"
        :form="form"
        busy-text="Making reservation"
        recently-successful-text="Reservation successful"
        button-text="Make reservation"
    >
        <template #icon>
            <icons.InfoIcon class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('Please review your reservation and make sure that you include all needed information.') }}
            </p>
            <ul class="mb-4 text-gray-500 dark:text-gray-300 text-sm bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <li class="text-lg"><span class="font-semibold">{{ __('Selected apartment') }}:</span> {{ form.property.title[$page.props?.locale] }}</li>
                <li><span class="font-semibold">{{ __('Number of guests') }}:</span> {{ form.guests.adults }}</li>
                <li v-if="form.guests.children > 0"><span class="font-semibold">{{ __('Number of kids') }}:</span> {{ form.guests.children }}</li>
                <li v-if="form.guests.pets"><span class="font-semibold">{{ __('Pets') }}</span></li>
                <li><span class="font-semibold">{{ __('Arrival') }}:</span> {{ new Date(form.date[0]).toLocaleDateString($page.props?.locale) }}</li>
                <li><span class="font-semibold">{{ __('Departure') }}:</span> {{ new Date(form.date[1]).toLocaleDateString($page.props?.locale) }}</li>
                <li><span class="font-semibold">{{ __('Nights') }}:</span> {{ nights }}</li>
                <li class="text-lg"><span class="font-semibold">{{ __('Price') }}:</span> {{ parseFloat(price).toFixed(2).toLocaleString($page.props.locale) }} €</li>
                <li><span class="font-semibold">{{ __('Name') }}:</span> {{ form.name }}</li>
                <li><span class="font-semibold">{{ __('Email') }}:</span> {{ form.email }}</li>
                <li><span class="font-semibold">{{ __('Phone') }}:</span> {{ form.phone }}</li>
                <li v-if="form.message"><span class="font-semibold">{{ __('Message') }}:</span> <span v-html="form.message"></span></li>
            </ul>


        </template>
    </ConfirmationModal>
</template>

<script setup>
import { ref, onMounted, onBeforeMount, computed, getCurrentInstance } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AccomodationsDropdown from '@/Components/_default/AccomodationsDropdown.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useHelperStore } from '@/stores/helpers';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { icons } from '@/icons';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { useReCaptcha } from 'vue-recaptcha-v3';
import Alert from '@/Components/Alert.vue';
import TipTapInput from '@/Components/TipTapInput.vue';

const page = usePage()

const helpers = useHelperStore()

const form = useForm({
    name: '',
    email: '',
    phone: '',
    guests: {
        adults: 1,
        children: 0,
        pets: false,
    },
    date: [],
    property: null,
    message: '',
})

const errors = ref(null);

const price = ref('0.00')
const nights = ref('0')

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();

const highlightedDates = ref([])

const showConfirmationDialog = ref(false)

const datepickerRange = page.props?.settings?.find(setting => setting.slug === 'datepicker-range')

const options = ref({
    range: {
        minRange: page.props.current_prices?.min_days ?? datepickerRange.min_days,
        maxRange: page.props.current_prices?.max_days ?? datepickerRange.max_days,
        partialRange: false,
        noDisabledRange: true,
    },
    multi: {
        solo: false,
        static: true,
        count: 3,
    },
})

const disabledDates = computed(() => {
    return page.props.selected.property?.unavailable_dates ?? []
});

const notAvailableMarkers = computed(() => {
    let markers = [];
    disabledDates.value.forEach(date => {
        markers.push({
            date: new Date(date),
            type: 'line',
            tooltip: [{ text: __('Not Available') + '...', color: '#e52f1d' }],
            color: 'bg-blue-900 dark:bg-blue-600',
        })
    });
    return markers
})


const tomorrow = computed(() => {
    const today = new Date()
    const tomorrow = new Date(today)
    tomorrow.setDate(today.getDate() + 1)
    return tomorrow
})

const yearFromNow = computed(() => {
    const today = new Date()
    const yearfromnow = new Date(today)
    yearfromnow.setDate(today.getDate() + 356)
    return yearfromnow
})

const populateForm = () => {
    form.name = page.props.auth.user.name ?? ''
    form.email = page.props.auth.user.email ?? ''
    form.phone = page.props.auth.user.phone ?? ''
    form.property = page.props.selected.property ?? null
    form.date = page.props.selected.date ?? []
}

const handleSelectedProperty = (property) => {
    router.get(route('reservations.create', { lang: page.props.locale, property: property.slug }))
}

const calculate = () => {
    errors.value = null
    axios.post(route('reservations.calculate', { lang: page.props.locale }), {propertyId: form.property.id, date: form.date, guests: form.guests})
        .then(response => {
            console.log(response.data)
            price.value = response.data.price
            nights.value = response.data.nights
            showConfirmationDialog.value = true
        })
        .catch(error => {
            errors.value = error.response.data
            if (error.response.data.error) {
                errors.value.message = error.response.data.error
            }
            console.log(error.response.data)
        })
}

const recaptcha = async () => {
    await recaptchaLoaded();
    form.captcha_token = await executeRecaptcha('login');
    showConfirmationDialog.value = false;
    store();
};

const store = () => {
    form.post(route('properties.reservations.store', form.property), {
        onSuccess: () => {

        }
    })
}

onMounted(() => {
    populateForm()
})


</script>

<style scoped>
.not-available-marker {
    position: absolute;
    bottom: 0;
    right: 0;
    height: 4px;
    width: 100%;
    /* border-radius: 100%; */
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
