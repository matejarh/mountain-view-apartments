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
                <p class="mb-5 font-light  sm:text-xl text-white">Here at Flowbite we focus on markets where technology,
                    innovation, and capital can unlock long-term value and drive economic growth.</p>
            </div>
            <div class="space-y-8 grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-4 xl:gap-10 sm:space-y-0">

                <PricingCard v-for="price, key in $page.props.property.prices " :rules="$page.props.property.rules" :price="price" :key="key" />

            </div>
        </div>
    </section>
</template>
