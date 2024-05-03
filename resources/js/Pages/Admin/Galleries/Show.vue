<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import ImageCard from './_partials/ImageCard.vue';
import GridSection from '@/Components/GridSection.vue';
import Tooltip from '@/Components/Tooltip.vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import { ref } from 'vue';
import AttachImagesDialog from './_partials/AttachImagesDialog.vue';
import UploadPhotoDialog from './_partials/UploadPhotoDialog.vue';

const showUploadPhotoDialog = ref(false)
const showImagesDialog = ref(false)
</script>

<template>
    <FullLayout :title="__('Gallery')">
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __($page.props.gallery.name) }}
            </template>
            <template #description>
                {{ __($page.props.gallery.description) }}
            </template>
            <template #content>
                <GridSection v-if="$page.props.gallery.images.length > 0">

                    <ImageCard v-for="image, key in $page.props.gallery.images" :key="key" :image="image" :has-gallery="true" />
                </GridSection>

                <div v-else class="">
                    <div class="w-full text-center cursor-pointer" @click="showImagesDialog = true">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No images yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{__('Click here to add some')}}</p>
                    </div>
                </div>

            </template>

        </ActionSection>
        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-30">
            <Tooltip :text="__('Upload And Attach Images')" location="left">
                <button @click="showImagesDialog = true"
                    class=" drop-shadow-lg rounded-full bg-transparent ">
                    <CirclePlusIcon
                        class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180 active:scale-95 transition " />
                </button>
            </Tooltip>
        </div>
        <AttachImagesDialog :show="showImagesDialog"
                            :gallery="$page.props.gallery"
                            @close="showImagesDialog = false"
                            @show-upload-photo-dialog="showUploadPhotoDialog = true" />

        <UploadPhotoDialog :show="showUploadPhotoDialog" @close="showUploadPhotoDialog = false" />

    </FullLayout>
</template>
