<script setup>
import { onMounted, ref, watch, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue'

import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageCard from './ImageCard.vue';
import GridSection from '@/Components/GridSection.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import DropZone from '@/Components/DropZone.vue';
import Tooltip from '@/Components/Tooltip.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import ArrowUpRightIcon from '@/Icons/ArrowUpRightIcon.vue';

const props = defineProps({
    show: Boolean,
    gallery: Object,
})

const emit = defineEmits(['close', 'showUploadPhotoDialog', 'showEditDialog'])

const images = ref([])
const total_count = ref(0)

const busy = ref(false)

const form = useForm({})

const attach = (image) => {
    if (form.isDirty) {
        form.post(route('admin.galleries.attach', { image: image, gallery: props.gallery }), {
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}

watchEffect(() => {
    if (props.show === true) fetch()
})

const fetch = () => {
    busy.value = true
    axios.get(route('admin.images.fetch', props.gallery))
        .then(response => {
            images.value = response.data.images
            total_count.value = response.data.total_count
            busy.value = false
        })
}

onMounted(() => {
    fetch()
})
</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ __('Attach Images To Gallery') }}</template>

        <template #content>
            <div class="" v-if="busy">
                <SpinnerIcon class="w-6 h-6 animate-spin" />
            </div>
            <div class="" v-else>
                <GridSection v-if="images.length > 0">
                    <ImageCard :image="image" v-for="image, key in images" :key="key" :has-gallery="false" />
                    <div>
                        <div class="w-full text-center cursor-pointer animate-pulse"
                            @click="$emit('showUploadPhotoDialog')">
                            <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                            <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some') }}</p>
                        </div>
                    </div>
                </GridSection>
                <div v-else class="">
                    <div class="w-full text-center cursor-pointer animate-pulse" @click="$emit('showUploadPhotoDialog')">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ total_count > 0 ? __('All uploaded images are attached to gallery!') : __('No images uploaded yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some') }}</p>
                    </div>
                </div>

            </div>

        </template>
    </DialogModal>
</template>
