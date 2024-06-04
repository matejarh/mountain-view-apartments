<script setup>
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';


</script>

<template>
    <section class="bg-primary-700 dark:bg-primary-900 relative">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-50 dark:text-white">
                    {{ __('Special Offers') }}</h2>
                <p class="mb-6 font-light text-gray-300 dark:text-gray-400 md:text-lg">
                    {{ ('10% discount for 6 nights or more') }}
                </p>
                <inertia-link :href="route('offers', $page.props.locale)"
                    class="text-white bg-primary-800 hover:bg-primary-900 focus:ring-4 focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-900 dark:hover:bg-primary-800 focus:outline-none dark:focus:ring-primary-800">
                    {{ __('Check Out Our Special Offer') }}</inertia-link>
            </div>
        </div>
        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 top-0 w-full rotate-180 text-primary-700 dark:text-primary-900 " />
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
    </section>
</template>
