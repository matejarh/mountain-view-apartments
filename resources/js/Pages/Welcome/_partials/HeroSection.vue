<script setup>
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import HeroTitlesCarousel from '@/Components/_default/Welcome/HeroTitlesCarousel.vue';
import { usePage } from '@inertiajs/vue3';
import { initCarousels } from 'flowbite';
import _ from 'lodash';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import LogoHero from '@/Components/LogoHero.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const page = usePage()

const bgImage = ref(new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url))

let interval

const initBgImageRotation = () => {
    if (page.props.page.galleries.length <= 0) {
        clearInterval(interval)
        return
    }
    const gallery = page.props.page.galleries.find(gallery => gallery.name === 'Home Page Hero');


    bgImage.value = gallery.images[0].photo_url
    let current = 1

    interval = setInterval(() => {
        bgImage.value = gallery.images[current].photo_url

        if (current + 1 >= gallery.images.length) {
            current = 0
        } else {
            current++
        }
    }, 5000);
}

const scrollTo = (element) => {
    document.getElementById(element).scrollIntoView(false);
}

const stopBgRotation = () => {
    clearInterval(interval)
}

onMounted(() => {
    initCarousels()
    initBgImageRotation()
})

onBeforeUnmount(() => {
    clearInterval(interval)
})
</script>

<template>
    <section
        class="bg-center bg-no-repeat bg-cover bg-fixed min-h-screen flex flex-col justify-center  bg-gray-500 bg-blend-multiply transition-all duration-[2000ms] ease-in-out bg-paralax relative"
        :style="`background-image: url(${bgImage});`">

        <div class="px-4 mx-auto max-w-screen-xl text-center pt-24 md:pt-56 lg:pt-56">
            <div class="flex flex-col min-w-full">
                <div class="flex justify-center mx-auto">

                    <LogoHero />
                </div>
                <!-- <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    {{ page.props?.page.title[$page.props.locale] }}</h1>

                <div class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48"
                    v-html="page.props?.page.description[$page.props.locale]"></div> -->
            </div>
        </div>
        <div class="mx-auto max-w-screen text-center">
            <div class="flex flex-col min-w-full">

                <HeroTitlesCarousel class="w-screen" />
            </div>
        </div>
        <div class="px-4 mx-auto max-w-screen-xl text-center pb-24 md:pb-56 lg:pb-56">
            <div class="flex flex-col min-w-full">
                <div class="mb-8 flex flex-col space-y-4 sm:space-x-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <PrimaryButton @click="scrollTo('booknow')" class="py-3 px-5 " type="button">

                        {{ __('Check Availability') }}
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </PrimaryButton class="py-3 px-5 ">

                    <SecondaryButton type="button" @click="scrollTo('accomodations')">
                        {{ __('Learn more') }}
                    </SecondaryButton>
                    <!-- <a href="#" @click="initBgImageRotation"
                        class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    </a> -->
                    <!-- <a href="#" @click="stopBgRotation"
                        class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Learn more
                    </a> -->

                </div>
                <!--                 <form class="w-full max-w-md mx-auto">
                    <label for="default-email"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Email sign-up</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-x-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path
                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                        </div>
                        <input type="email" id="default-email"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter your email here..." required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                            up</button>
                    </div>
                </form> -->

            </div>
        </div>

        <ShapeBottom
            class="absolute inset-y-full z-10 left-0 right-0 w-full rotate-180 text-primary-700 dark:text-primary-900 " />
        <ShapeTop
            class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
    </section>
</template>
