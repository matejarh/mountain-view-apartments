<script setup>
import PricingCard from '@/Components/_default/PricingCard.vue';
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';

</script>

<template>
    <section class="bg-primary-700 dark:bg-primary-900 relative">
        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 w-full top-0 rotate-180 text-primary-700 dark:text-primary-900 " />
        <ShapeTop
            class="absolute inset-y-full z-0 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white">{{ __('Pricing') }}</h2>
                <p class="mb-1 font-light  sm:text-xl text-white">
                    {{ __('Enjoy competitive rates and flexible pricing options tailored to your stay.') }}
                </p>
                <p class="mb-1 font-light  sm:text-xl text-white">
                    <span class="font-semibold">{{ $page.props.property.title[$page.props.locale] }}</span>
                    {{ __('offers affordable luxury for any duration.') }}
                </p>
                <p class="mb-5 font-light  sm:text-xl text-white">
                    {{ __('Book now and experience comfort without compromise.') }}
                </p>
            </div>
            <div class="flex justify-center items-center">

                <PricingCard v-for="price, key in $page.props?.current_prices.prices "  :current-prices="$page.props?.current_prices" :price="price" :key="key" />


            </div>
        </div>
    </section>
</template>
