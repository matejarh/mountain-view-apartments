<script setup>
import { getCurrentInstance, ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActiveCarousel from '@/Components/_default/ActiveCarousel.vue';

const props = defineProps({
    gallery: Object
})

const emit = defineEmits(['attach'])

const { appContext } = getCurrentInstance();

const __ = appContext.config.globalProperties.__;

const show = ref(true)

const noImages = ref([
    {
        thumb_url: 'https://placehold.co/512x366/6d6d6d/d1d1d1/png?text=' + __('No Images'),
        slug: __('No Images')
    }
])

</script>

<template>
    <li v-if="show">
        <div
            class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex flex-col justify-between pb-4 h-full space-y-4">

                <ActiveCarousel class="shadow-lg" v-if="gallery.images.length > 0" :items="gallery.images" />
                <ActiveCarousel class="shadow-lg" v-else :items="noImages" />

                <div class="px-4 h-full max-h-44 overflow-y-auto scrollbar-none">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ gallery.name }}</h5>

                    <p
                        class="mb-3 font-normal text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 leading-tight whitespace-pre-wrap p-2 rounded-lg h-14 overflow-y-auto scrollbar-none ">
                        {{ gallery.description }}</p>
                </div>

                <PrimaryButton type="button"  class="mx-4"
                    @click="$emit('attach', gallery)">
                    <div class="flex items-center">
                        <!--<icons.SpinnerIcon v-show="attachForm.processing"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" /> -->
                        {{  __('Attach to property') }}

                    </div>
                </PrimaryButton>
            </div>
        </div>
    </li>
</template>
