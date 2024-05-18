<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import ImageCard from '@/Pages/Admin/Galleries/_partials/ImageCard.vue';
import GridSection from '@/Components/GridSection.vue';
import Tooltip from '@/Components/Tooltip.vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import { ref } from 'vue';
import UploadPhotoDialog from '@/Pages/Admin/Galleries/_partials/UploadPhotoDialog.vue';
import Paginator from '@/Components/Paginator.vue';
import FullScreenImagesModal from './_partials/FullScreenImagesModal.vue';
import FiltersSection from '@/Components/FiltersSection.vue';

const showUploadPhotoDialog = ref(false)
const showFullScreenImageModal = ref(false)
const showingImage = ref(null)

const handleClicked = (image) => {
    console.log(image)
    showingImage.value = image
}
</script>

<template>
    <FullLayout :title="__('Images')">
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __('Images') }}
            </template>

            <template #content>
                <FiltersSection v-show="$page.props.images.data.length > 0" id="images-filters" route="admin.images.index"  placeholder="Search for images" />
                <div class="relative" v-if="$page.props.images.data.length > 0">
                    <TransitionGroup name="list" tag="ul"
                        class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                        <li key="0">

                            <figure @click="showUploadPhotoDialog = true"
                                class="flex flex-col items-center justify-center text-center select-none hover:scale-105 active:scale-95 rounded-lg min-h-full relative shadow-lg active:shadow hover:shadow-xl  transition-all duration-300 cursor-pointer overflow-visible">
                                <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32" />
                                <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to add some') }}
                                </p>
                            </figure>
                        </li>
                        <!-- <img class="rounded-lg" v-for="image, key in $page.props.images.data" :src="image.thumb_url" :alt="image.name"> -->


                        <ImageCard v-for="image, key in $page.props.images.data" :images-count="$page.props.images.total" :key="image.id" :image="image"
                            @clicked="handleClicked" :is-index="true" />


                        <Paginator key="paginator" class="col-span-8" :paginator="$page.props.images" />
                    </TransitionGroup>
                </div>


                <div v-else class="">
                    <div class="w-full text-center cursor-pointer" @click="showUploadPhotoDialog = true">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No images yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to add some') }}</p>
                    </div>
                </div>

            </template>

        </ActionSection>
        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-10">
            <Tooltip :text="__('Upload Images')" location="left">
                <button @click="showUploadPhotoDialog = true" class=" drop-shadow-lg rounded-full bg-transparent ">
                    <CirclePlusIcon
                        class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180 active:scale-95 transition " />
                </button>
            </Tooltip>
        </div>
        <!-- <AttachImagesDialog :show="showImagesDialog"
                            :gallery="$page.props.gallery"
                            @close="showImagesDialog = false"
                            @show-upload-photo-dialog="showUploadPhotoDialog = true" /> -->

        <UploadPhotoDialog :show="showUploadPhotoDialog" @close="showUploadPhotoDialog = false" />

        <FullScreenImagesModal :images="$page.props.images.data" :image="showingImage" :show="!!showingImage"
            @close="showingImage = null" />
    </FullLayout>
</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
