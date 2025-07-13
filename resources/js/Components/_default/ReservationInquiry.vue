<script setup>
import { computed, getCurrentInstance, ref, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useHelperStore } from '@/stores/helpers';
import { useReCaptcha } from 'vue-recaptcha-v3';
import { icons } from '@/icons';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import InputLabel from '../InputLabel.vue';
import TextInput from '../TextInput.vue';
import InputError from '../InputError.vue';
import TextArea from '../TextArea.vue';
import PrimaryButton from '../PrimaryButton.vue';
import ConfirmationModal from '../ConfirmationModal.vue';
import AccomodationsDropdown from './AccomodationsDropdown.vue';

const emit = defineEmits(['close']);

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();
const page = usePage();
const helpers = useHelperStore();
const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const form = useForm({
    name: '',
    email: '',
    phone: '',
    adults: 1,
    children: 0,
    pets: false,
    subject: '',
    message: '',
    date: null,
    captcha_token: '',
});

const datepickerRange = page.props?.settings?.find(setting => setting.slug === 'datepicker-range');
const disabledDates = ref([]);
const options = ref({
    minRange: datepickerRange.attributes?.min,
    maxRange: datepickerRange.attributes?.max,
    partialRange: false,
    noDisabledRange: true,
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
    const today = new Date();
    today.setDate(today.getDate() + 1);
    return today;
});

const yearFromNow = computed(() => {
    const today = new Date();
    today.setDate(today.getDate() + 365);
    return today;
});

const propertyProxy = ref(null);
const showInquiryConfirmationModal = ref(false);

const recaptcha = async () => {
    await recaptchaLoaded();
    form.captcha_token = await executeRecaptcha('login');
    store();
};

const fetchUnavailabelDates = (property) => {
    axios.get(route('properties.unavailable_dates', property.slug))
        .then(response => {
            disabledDates.value = response.data
            propertyProxy.value = property;
        })
        .catch(error => {
            console.error(error)
        })
}

const handleSelected = (accomodation) => {
    fetchUnavailabelDates(accomodation)
};

const store = () => {
    form.clearErrors();
    showInquiryConfirmationModal.value = false;
    form.post(`/send-inquiry/${propertyProxy.value.slug}`, {
        errorBag: 'creatingInquiry',
        onSuccess: () => {
            form.reset();
            propertyProxy.value = null;
            emit('close');
        },
    });
};

</script>

<template>
    <form class="pb-4" @submit.prevent="showInquiryConfirmationModal = true">
        <div>
            <InputLabel :value="__('Your name')" for="name" />
            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                autocomplete="name" :has-error="!!form.errors.name" :placeholder="__('Enter your name') + '...'" />
            <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="mt-4">
            <InputLabel :value="__('Email')" for="email" />
            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                autocomplete="email" :has-error="!!form.errors.email" :placeholder="__('Enter your email') + '...'" />
            <InputError :message="form.errors.email" class="mt-2" />
        </div>

        <div class="mt-4">
            <InputLabel :value="__('Phone')" for="phone" />
            <TextInput id="phone" v-model="form.phone" type="phone" class="mt-1 block w-full" required
                autocomplete="phone" :has-error="!!form.errors.phone" :placeholder="__('Enter your phone number') + '...'" />
            <InputError :message="form.errors.phone" class="mt-2" />
        </div>

        <div class="mt-4">
            <InputLabel :value="__('Subject')" for="subject" />
            <TextInput id="subject" v-model="form.subject" type="text" class="mt-1 block w-full" required
                autocomplete="subject" :has-error="!!form.errors.subject" :placeholder="__('Enter subject') + '...'" />
            <InputError :message="form.errors.subject" class="mt-2" />
        </div>

        <div class="mt-4">
            <InputLabel :value="__('Message')" for="message" />
            <TextArea id="message" v-model="form.message" type="text" class="mt-1 block w-full" required
                autocomplete="message" :has-error="!!form.errors.message" :placeholder="__('Enter message') + '...'" />
            <InputError :message="form.errors.message" class="mt-2" />
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="mt-4">
                <InputLabel :value="__('Guests')" for="guests" />
                <TextInput id="guests" v-model="form.adults" type="number" min="1" max="4" step="1" class="mt-1 block w-full"
                    :has-error="!!form.errors.adults"  />
                <InputError :message="form.errors.adults" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel :value="__('Kids')" for="children" />
                <TextInput id="children" v-model="form.children" type="number" min="0" max="4" step="1" class="mt-1 block w-full"
                    :has-error="!!form.errors.children" />
                <InputError :message="form.errors.children" class="mt-2" />
            </div>
            <!--
            <div class="mt-4">
                <InputLabel class="inline-flex items-center justify-center cursor-pointer w-full">
                    {{ __('Pets') }}
                    <input type="checkbox" value="" class="sr-only peer" v-model.checked="form.pets" />
                    <div class="mx-auto mt-3 relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amazon-600 dark:peer-focus:ring-amazon-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-amazon-600"></div>
                </InputLabel>
            </div> -->
        </div>

        <div class="mt-4">
            <InputLabel :value="__('Apartmant')" as="div" />
            <AccomodationsDropdown id="apartmant" class="w-full" direction="down" :selected-property="propertyProxy" @selected="handleSelected" />
        </div>

        <div class="relative mt-4" v-show="propertyProxy">
            <InputLabel :value="__('Date (from-to)')" as="div" />
            <VueDatePicker
                id="daterangepicker"
                v-model="form.date"
                :range="options"
                :min-date="tomorrow"
                :max-date="yearFromNow"
                prevent-min-max-navigation
                :disabled-dates="disabledDates"
                :markers="notAvailableMarkers"
                :enable-time-picker="false"
                :locale="$page.props?.locale"
                :format="$page.props?.date_format_pattern"
                :dark="helpers.isDark"
                six-weeks="center"
                :placeholder="__('Select arrival & departure dates') + '...'"
            />
            <InputError :message="form.errors.date_range" class="mt-2" />
            <InputError :message="form.errors['date.*']" class="mt-2" />
        </div>

        <div class="mt-4">
            <PrimaryButton
                type="submit"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty || !propertyProxy || !form.date }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty || !propertyProxy || !form.date"
            >
                <div class="flex items-center">
                    <icons.SpinnerIcon v-show="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Submitting') + '...' : form.recentlySuccessful ? __('Submitted') : __('Submit') }}
                </div>
            </PrimaryButton>
        </div>
    </form>

    <ConfirmationModal
        :is-danger="false"
        :show="showInquiryConfirmationModal"
        @close="showInquiryConfirmationModal = false"
        @confirmed="recaptcha"
        :form="form"
        busy-text="Sending inquiry"
        recently-successful-text="Inquiry sent"
        button-text="Send inquiry"
    >
        <template #icon>
            <icons.InfoIcon class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('Please review your inquiry and make sure that you include all needed information.') }}
            </p>
            <ul class="mb-4 text-gray-500 dark:text-gray-300 text-sm bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                <li><span class="font-semibold">{{ __('Name') }}:</span> {{ form.name }}</li>
                <li><span class="font-semibold">{{ __('Email') }}:</span> {{ form.email }}</li>
                <li><span class="font-semibold">{{ __('Subject') }}:</span> {{ form.subject }}</li>
                <li><span class="font-semibold">{{ __('Message') }}:</span> {{ form.message }}</li>
                <li><span class="font-semibold">{{ __('Selected apartment') }}:</span> {{ propertyProxy.title[$page.props?.locale] }}</li>
                <li><span class="font-semibold">{{ __('Number of adults') }}:</span> {{ form.adults }}</li>
                <li><span class="font-semibold">{{ __('Number of kids') }}:</span> {{ form.children }}</li>
                <li><span class="font-semibold">{{ __('Pets') }}:</span> {{ form.pets }}</li>
                <li><span class="font-semibold">{{ __('Date from') }}:</span> {{ form.date[0].toLocaleDateString($page.props?.locale) }}</li>
                <li><span class="font-semibold">{{ __('Date to') }}:</span> {{ form.date[1].toLocaleDateString($page.props?.locale) }}</li>
            </ul>
        </template>
    </ConfirmationModal>
</template>


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
