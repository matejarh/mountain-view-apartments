<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';
import { icons } from '@/icons';
import { getCurrentInstance, ref } from 'vue';

const props = defineProps({
    page: Object
})

const emit = defineEmits(['edit'])

const show = ref(true)

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const noImages = ref([
    {
        thumb_url: 'https://placehold.co/512x366/6d6d6d/d1d1d1/png?text=' + __('No Images'),
    }
])
</script>

<template>

    <!-- <Transition enter-active-class="animate__animated animate__bounceInDown" leave-active-class=""> -->
    <li v-if="show">

        <div class="max-w-sm  bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out"
            >
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

                <ActiveCarousel v-if="page.galleries.length > 0" :items="page.galleries[0].images" />
                <ActiveCarousel v-else :items="noImages" />

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __(page.name) }}
                    </h3>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight overflow-x-scroll whitespace-nowrap scrollbar-thin text-gray-900 dark:text-white">{{ page.title[$page.props?.locale] }}
                    </h2>


                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ page.description[$page.props?.locale] }}</p>
                </div>

                <PrimaryButton type="button" @click="$inertia.get(route('admin.pages.show', page))" class="mx-4">
                    <div class="flex items-center">
                        {{ __('Edit Page') }}
                        <icons.ArrowRightIcon class="rtl:rotate-180 w-3.5 h-3.5 ms-2" />
                    </div>
                </PrimaryButton>
            </div>
        </div>
    </li>
    <!-- </Transition> -->

</template>
