<script setup>
import ShapedSection from '@/Components/_default/ShapedSection.vue';


</script>

<template>
    <section class="relative " :color="{ light: 'primary-700', dark: 'primary-900' }">
        <div class="py-10 lg:py-24 mx-auto md:max-w-screen-2xl px-4 xl:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-4 xl:gap-8">

                <div v-for="item,key in $page.props?.discover" :key="key"
                    class="max-w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <inertia-link :href="item.link" class="w-full h-full bg-gray-300 dark:bg-gray-500">
                        <img class="rounded-t-lg  mix-blend-multiply transition-all ease-out duration-1000 object-cover w-full h-auto" :src="item.image.thumb_url" :alt="item.image.name  " />
                    </inertia-link>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __(item.title[$page.props?.locale]) }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ item.description[$page.props?.locale] }}
                        </p>
                        <inertia-link :href="item.link"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </inertia-link>
                    </div>

                </div>

            </div>

        </div>
    </section>
</template>
