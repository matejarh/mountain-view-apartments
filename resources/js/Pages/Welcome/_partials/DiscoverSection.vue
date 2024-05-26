<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';
import { icons } from '@/icons';


</script>

<template>
    <section class="relative " :color="{ light: 'primary-700', dark: 'primary-900' }">
        <div class="py-10 lg:py-24 mx-auto md:max-w-screen-2xl px-4 lg:px-10 2xl:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-4 xl:gap-10">

                <div v-for="item,key in $page.props?.discover" :key="key"
                    class="max-w-full bg-white border border-gray-200 pt-4 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 ">
                    <ActiveCarousel  :items="item.images" class="w-full h-auto" />

                        <!-- <img class="rounded-t-lg  mix-blend-multiply transition-all ease-out duration-1000 object-cover w-full h-auto" :src="item.image.thumb_url" :alt="item.image.name  " /> -->

                    <div class="p-5">
                        <inertia-link :href="item.link">
                            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __(item.title[$page.props?.locale]) }}</h2>
                        </inertia-link>

                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ item.description[$page.props?.locale] }}
                        </p>
                        <div class="sm:flex sm:justify-between space-y-2 sm:space-y-0">
                            <PrimaryButton class="w-full sm:w-auto" @click="$inertia.get(item.link)">
                                {{ __('Read more') }}
                                <icons.ArrowRightIcon class="rtl:rotate-180 w-3.5 h-3.5 ms-2" />
                            </PrimaryButton>

                            <PrimaryButton class="w-full sm:w-auto" @click="$inertia.get(item.link)">
                                {{ __('Stay in') }} {{ key }}
                                <icons.SingleBedIcon class="rtl:rotate-180 w-3.5 h-3.5 ms-2" />
                            </PrimaryButton>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
</template>
