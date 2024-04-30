<script setup>
import { computed, onBeforeMount, onBeforeUnmount } from 'vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

const props = defineProps({ status: Number, translations: Object, locale: String, })

const title = computed(() => {
    return {
        503: 'Service Unavailable',
        500: 'Server Error',
        404: 'Something\'s missing',
        403: 'Forbidden',
        405: 'Method Not Allowed',
    }[props.status]
})

const description = computed(() => {
    return {
        503: ['Our administrators are performing scheduled maintenance.'],
        500: ['Whoops, something went wrong on our servers.', 'Our administrators are already looking in to it.'],
        404: ['Sorry, we can\'t find that page. You\'ll find lots to explore on the home page.'],
        403: ['Sorry, you are forbidden from accessing this page.'],
        405: ['Method Not Allowed'],
    }[props.status]
})

const __ = function (key, replace = {}) {
    let translation = props.translations[key]
        ? props.translations[key]
        : key;

    Object.keys(replace).forEach(function (key) {
        translation = translation.replaceAll(':' + key, replace[key])
    });

    return translation
};
const back = () => {
    window.history.back();
}

onBeforeMount(() => {
    window.addEventListener("load", (event) => {
        let isDark = localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)

        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })
})

onBeforeUnmount(() => {
    // window.removeEventListener('load');
})
</script>

<template>

    <Head :title="title" />

    <div
        class="relative flex items-top justify-center min-h-screen w-screen bg-gray-100 dark:bg-gray-950 sm:items-center sm:pt-0 bg-cover bg-blend-multiply bg-image-bled">
        <section
            class="bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-lg bg-opacity-30 dark:bg-opacity-30 backdrop-blur-xl">
            <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
                <!-- Ikona -->
                <svg class="w-28 h-28 mx-auto text-bittersweet-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <h1
                    class="mb-4 mt-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">
                    {{ __(title) }}</h1>
                <p class="font-light text-gray-600 md:text-lg xl:text-xl dark:text-gray-300">{{ __(description[0]) }}<br>{{ __(description[1]) }}</p>
                <a v-if="status !== 503" href="#" @click="back"
                    class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-700 my-4">
                    {{ __('Back') }}
            </a>
            </div>
        </section>

    </div>

    <!-- <div class="w-screen h-screen overflow-hidden">
        <div class="max-w-screen-xl mx-auto flex flex-col justify-center items-center my-auto h-screen">

            <h1>{{ __(title) }}</h1>
            <div>{{ __(description) }}</div>
            <div>{{ __(locale) }}</div>
            <a href="/"
                class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-700 my-4">
                {{ __('Back to Homepage') }}
            </a>
        </div>
    </div> -->


</template>
