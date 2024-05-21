<script setup>
import Carousel from '@/Components/Carousel.vue';
import DinamicIcon from '@/Components/DinamicIcon.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import ArrowRightIcon from '@/Icons/ArrowRightIcon.vue';
import { useHelperStore } from '@/stores/helpers';
import { getCurrentInstance, onMounted, ref } from 'vue';
import CarouselGallery from './CarouselGallery.vue';

const props = defineProps({
    property: Object,
})

const helpers = useHelperStore()

const instance = getCurrentInstance()

const show = ref(false)

onMounted(() => {
    helpers.delay(500).then(() => {
        helpers.delay(300 * (instance.vnode.key)).then(() => show.value = true)

    })
})
</script>

<template>
    <li v-if="show">
        <div
            class="bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden p-0 mx-auto max-w-screen-xl grid xl:grid-cols-2 gap-8 xl:gap-16">
            <div class="flex flex-col justify-center p-8">
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    <inertia-link :href="route('properties.show', { property: property, lang: $page.props?.locale })">
                        {{ property.title[$page.props?.locale] }}

                    </inertia-link>
                </h1>
                <div class="mt-0 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ __(property.type) }}
                    </p>

                    <RatingStars :property="property" />

                </div>

                <div class="mt-0 grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="flex space-x-2 items-center" v-for="type, key in property.bed_types" :key="key">

                        <DinamicIcon :icon="type.icon"
                            :class="type.name === '1 queen bed' ? 'w-10 h-6' : (type.name === '2 single beds' ? 'w-4 h-4' : 'w-8 h-8')" />
                        <DinamicIcon v-if="type.name === '2 single beds'" :icon="type.icon" class="w-4 h-4" />
                        <p class="">{{ __(type.title) }}</p>
                        <p class="">{{ __(type.name) }}</p>
                    </div>
                    <!-- {{ $page.props?.property.bed_types }} -->
                </div>

                <div class="mb-8 mt-4 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400"
                    v-html="property.description[$page.props?.locale]"></div>

                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                    <inertia-link :href="route('properties.show', { property: property, lang: $page.props?.locale })"
                        class="inline-flex hover:scale-105 active:scale-95 items-center justify-center px-4 py-2 bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-0 active:shadow hover:shadow-xl shadow-lg   transition ease-in-out duration-150">
                        {{ __('Learn more') }}
                        <ArrowRightIcon class="w-3.5 h-3.5 ms-2" />

                    </inertia-link>

                </div>
            </div>
            <div v-if="property.galleries.length > 0">
                <!-- <Carousel rounded="" :items="property.galleries[0].images"
                    height="h-64 sm:h-[34rem] md:h-[33rem] lg:h-[20rem] xl:h-[27rem]" width="" class="shadow-lg" /> -->
                    <CarouselGallery class=""  :items="property.galleries[0].images" />

            </div>
        </div>

        <!--         <div
            class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

                <Carousel v-if="property.galleries[0]?.images.length > 0" :items="property.galleries[0].images"
                    rounded="rounded-t-lg" class="shadow-lg" :height="carouselHeight" />
                <div class="w-full flex items-center justify-center shadow-lg" :class="carouselHeight" v-else>

                    <ImageIcon class="w-56 h-56 text-gray-300 dark:text-gray-400" />
                </div>

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{
                        property.title[$page.props?.locale] }}
                    </h5>

                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ property.description[$page.props?.locale] }}</p>
                </div>

                <PrimaryButton type="button" class="mx-4" @click="">
                    <div class="flex items-center">
                        {{ __('Show more') }}...
                    </div>
                </PrimaryButton>
            </div>
        </div> -->
    </li>
</template>
