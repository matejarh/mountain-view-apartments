<script setup>
import { icons } from '@/icons';

defineProps({
    price: Object,
    currentPrices: Object,
})

</script>

<template>
    <!-- Pricing Card -->
    <div
        class="flex flex-col p-6 mb-4 mx-auto max-w-sm text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">



        <h3 class="mb-4 text-2xl font-semibold">{{ price.guests }} {{__('Guest', price.guests)}}</h3>
        <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400 flex justify-center">
            <icons.UserIcon class="w-5 h-5" v-for="n in parseInt(price.guests)" />
        </p>
        <div class="flex justify-center items-baseline my-8">
            <span class="mr-2 text-5xl font-extrabold">{{ price.price }}€</span>
            <span class="text-gray-500 dark:text-gray-400">/{{__('night')}}</span>
        </div>

        <p class="text-sm text-gray-500">{{__('Min')}} {{ currentPrices.min_days }} {{__('night', currentPrices.min_days)}}</p>
        <div class="text-sm mt-2 text-gray-500" v-if="currentPrices.discounts && currentPrices.discounts.length > 0">
            <p v-for="discount,key in currentPrices.discounts" :key="key">
                {{ discount.discount }}
                {{ __('discount') }}
                {{ __('for') }}
                {{ discount.days }}
                {{ __('night', discount.days) }}
                {{ __('or more') }}
            </p>
        </div>

        <inertia-link :href="route('reservations.create', {lang: $page.props.locale, property: $page.props.property.slug})"
        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">{{
            __('Book Now') }}</inertia-link>

</div>
</template>
