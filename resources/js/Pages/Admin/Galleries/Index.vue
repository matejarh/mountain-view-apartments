<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import Tooltip from '@/Components/Tooltip.vue'
import FullLayout from '@/Layouts/FullLayout.vue';
import GalleryCard from './_partials/GalleryCard.vue';
import CreateGalleryDialog from './_partials/CreateGalleryDialog.vue';
import { ref } from 'vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';

const showCreateDialog = ref(false)
const galleryProxy = ref(null)

const handleEdit = (gallery) => {
    galleryProxy.value = gallery
    showCreateDialog.value = true
}
</script>

<template>
    <FullLayout :title="__('Galleries')">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 gap-4 lg:gap-4">
            <TransitionGroup enter-active-class="animate__animated animate__bounceInDown" leave-active-class="animate__animated animate__bounceOutUp">

                <GalleryCard  v-for="gallery, key in $page.props.galleries.data" :key="key" :gallery="gallery" @edit="handleEdit"/>
            </TransitionGroup>
        </div>


        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-30">

            <Tooltip :text="__('Add New Gallery')" location="bottom">

                <button @click="galleryProxy = null, showCreateDialog = true" class=" drop-shadow-lg rounded-full bg-transparent ">
                <CirclePlusIcon class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180 active:scale-95 transition " />
                </button>
            </Tooltip>
        </div>
        <CreateGalleryDialog @close="showCreateDialog = false" :show="showCreateDialog" :gallery="galleryProxy" />
    </FullLayout>
</template>
