<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue'

import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageCard from './ImageCard.vue';
import GridSection from '@/Components/GridSection.vue';

const props = defineProps({
    show: Boolean,
    gallery: Object,
})

const emit = defineEmits(['close'])

const images = ref([])

const form = useForm({})

const attach = (image) => {
    if (form.isDirty) {
        form.post(route('admin.galleries.attach', { image: image, gallery: props.gallery }), {
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}

const fetch = () => {
    axios.get(route('admin.images.fetch', props.gallery ))
        .then(response => {
            images.value = response.data
        })
}

onMounted(() => {
    fetch()
})
</script>

<template>
    <DialogModal max-width="4xl" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ __('Attach Images To Gallery') }}</template>

        <template #content>
            <GridSection>

                <figure v-for="image, key in images" :key="image.id"
                    class="relative shadow-lg  transition-all duration-300 cursor-pointer filter hover:grayscale-0">
                    <a href="#">
                        <img class="rounded-lg" :src="image.photo_url" :alt="image.name">
                    </a>
                    <figcaption
                        class="absolute flex rounded-t-lg justify-between px-4 py-1 text-md text-gray-700 dark:text-gray-300 top-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-85 backdrop-blur-lg">


                    </figcaption>
                    <figcaption
                        class="absolute px-4 py-1 text-lg rounded-b-lg text-white bottom-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-85 backdrop-blur-lg">
                        <h3 class="text-gray-700 dark:text-gray-300">{{ image.name }}</h3>
                        <p class="text-gray-700 dark:text-gray-300 text-sm">{{ image.description }}</p>
                    </figcaption>
                </figure>
            </GridSection>


        </template>


    </DialogModal>
</template>
