<script setup>
import { onMounted, ref, watch } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useForm, usePage } from '@inertiajs/vue3';
import AccomodationsDropdown from '@/Components/_default/AccomodationsDropdown.vue';
import { useHelperStore } from '@/stores/helpers';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import "/resources/css/datepicker.css"

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

const handleSelected = (accomodation) => {
    form.accomodationId = accomodation.id
}

const options = ref({
    minRange: 2,
    maxRange: 7,
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
                    {{ __('Check Availability') }}</h2>

                <form action="" class="mb-6 w-full h-auto block" @submit.prevent="">
                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                        <AccomodationsDropdown class="w-full" direction="down" @selected="handleSelected" />

                        <VueDatePicker v-model="date"
                                :range="options"
                                :min-date="new Date()"
                                prevent-min-max-navigation
                                :disabled-dates="disabledDates"
                                :enable-time-picker="false"
                                :locale="$page.props.locale"
                                :format="$page.props.date_format_pattern"
                                :dark="helpers.isDark"
                                six-weeks="center"
                                :placeholder="__('Select arrival & departure dates...')"
                                ></VueDatePicker>


                    </div>

                </form>
                <!-- <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg rounded-lg">Try Flowbite Platform for 30
                    days. No credit card required.</p> -->
                <a href="#"
                    class="text-white bg-transparent hover:bg-primaty-700 border border-white focus:ring-4 focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-transparent dark:hover:bg-primary-600 focus:outline-none dark:focus:ring-white">
                    {{ __('Check Availability') }}</a>
            </div>
        </div>
<!--         <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 w-full rotate-180 text-primary-700 dark:text-primary-900 " /> -->
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
    </section>
</template>

