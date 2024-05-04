<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import ImageCard from './_partials/ImageCard.vue';
import Tooltip from '@/Components/Tooltip.vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import AttachImagesDialog from './_partials/AttachImagesDialog.vue';
import UploadPhotoDialog from './_partials/UploadPhotoDialog.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import CheckCircleIcon from '@/Icons/CheckCircleIcon.vue';
import TextArea from '@/Components/TextArea.vue';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import FullScreenImagesModal from '../Images/_partials/FullScreenImagesModal.vue';
import CarretLeftIcon from '@/Icons/CarretLeftIcon.vue';

const props = defineProps({
    gallery: Object,
})
const showUploadPhotoDialog = ref(false)
const showImagesDialog = ref(false)
const showDestroyConfirm = ref(false)
const showingImage = ref(null)
const editing = ref(false)

const form = useForm({
    name: props.gallery?.name,
    description: props.gallery?.description
})

const handleClicked = (image) => {
    showingImage.value = image
}

const destroyForm = useForm({})

const update = () => {
    if (form.isDirty) {
        form.put(route('admin.galleries.update', props.gallery), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                editing.value = false
            }
        })
    }
}

const destroy = () => {
    form.delete(route('admin.galleries.destroy', props.gallery), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            showDestroyConfirm.value = false
            router.visit(route('admin.galleries.index'))
        }
    })
}

const updateOnEnter = (e) => {
    if (e.key === 'Enter' && form.isDirty) {
        update();
    }
    if (e.key === 'Escape' && editing.value) {
        editing.value = false
    }
};

onMounted(() => document.addEventListener('keydown', updateOnEnter));

onUnmounted(() => {
    document.removeEventListener('keydown', updateOnEnter);
    document.body.style.overflow = null;
});
</script>

<template>
    <FullLayout :title="__('Gallery')">
        <ActionSection :fullwidth="true">
            <template #title>
                <div v-if="!editing" class="flex items-center space-x-2">
                    <inertia-link :href="route('admin.galleries.index')"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transform hover:scale-105 active:scale-95">
                        <Tooltip :text="__('Back')">
                            <CarretLeftIcon class="w-6 h-6  " />
                        </Tooltip>
                    </inertia-link>
                    <button @click="editing = true">
                        <Tooltip :text="__('Edit')">
                            <EditIcon
                                class=" text-primary-700 dark:text-primary-200 w-6 h-6 transform hover:scale-105 active:scale-95" />
                        </Tooltip>
                    </button>
                    <h2>{{ __(gallery.name) }}</h2>
                </div>
                <div class="flex items-start space-x-2" v-if="editing">
                    <div class="">
                        <button @click="editing = false, form.reset(), form.clearErrors()">
                            <CirclePlusIcon class="rotate-45 text-bittersweet-700 dark:text-bittersweet-300 w-6 h-6" />
                        </button>
                        <button @click="update">
                            <CheckCircleIcon class=" text-amazon-700 dark:text-amazon-300 w-6 h-6" />
                        </button>

                    </div>
                    <div class="w-full space-y-4">

                        <div class="w-full">
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                                autocomplete="name" :has-error="!!form.errors.name"
                                :placeholder="__('Enter name') + '...'" />
                            <InputError :message="form.errors.name" class="mt-2" />

                        </div>
                        <div class="w-full">
                            <TextArea id="description" v-model="form.description" type="text" class="mt-1 block w-full"
                                required autocomplete="description" :has-error="!!form.errors.description"
                                :placeholder="__('Enter description') + '...'" />
                            <InputError :message="form.errors.description" class="mt-2" />

                        </div>
                    </div>
                </div>
            </template>
            <template #description v-if="!editing">
                <div v-if="!editing">{{ __(gallery.description) }}</div>
            </template>
            <template #content>
                <div class="relative" v-if="gallery.images.length > 0">
                    <TransitionGroup name="list" tag="ul"
                        class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                        <li key="0">

                            <figure @click="showImagesDialog = true"
                                class="flex flex-col items-center justify-center text-center select-none hover:scale-105 active:scale-95 rounded-lg min-h-full relative shadow-lg  transition-all duration-300 cursor-pointer overflow-visible">
                                <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32" />
                                <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Upload And Attach Images') }}
                                </p>
                            </figure>
                        </li>

                        <ImageCard v-for="image, key in gallery.images" :key="image.id" :image="image"
                            :has-gallery="true" @clicked="handleClicked" />
                    </TransitionGroup>

                </div>


                <div v-else class="">
                    <div class="w-full text-center cursor-pointer" @click="showImagesDialog = true">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No images yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to add some') }}</p>
                    </div>
                </div>

            </template>

        </ActionSection>
        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-10">
            <Tooltip :text="__('Upload And Attach Images')" location="left">
                <button @click="showImagesDialog = true" class=" drop-shadow-lg active:drop-shadow hover:drop-shadow-xl transition-all ease-in-out duration-150 rounded-full bg-transparent ">
                    <CirclePlusIcon
                        class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180  active:scale-95 transition-all ease-in-out duration-150 " />
                </button>
            </Tooltip>
            <Tooltip :text="__('Remove Gallery')" location="left">
                <button @click="showDestroyConfirm = true" class=" drop-shadow-lg active:drop-shadow hover:drop-shadow-xl transition-all ease-in-out duration-150 rounded-full bg-transparent ">
                    <TrashBinIcon
                        class="w-16 h-16 text-bittersweet-400 hover:scale-105 hover:rotate-3 active:scale-95 transition-all ease-in-out duration-150 " />
                </button>
            </Tooltip>
        </div>
        <AttachImagesDialog :show="showImagesDialog" :gallery="gallery" @close="showImagesDialog = false"
            @show-upload-photo-dialog="showUploadPhotoDialog = true" />

        <UploadPhotoDialog :show="showUploadPhotoDialog" @close="showUploadPhotoDialog = false" />

        <ConfirmationModal :show="showDestroyConfirm" @close="showDestroyConfirm = false" @confirmed="destroy"
            :form="destroyForm" :busy-text="__('Deleting Gallery')" :recently-successful-text="__('Gallery Deleted')">
            <template #icon>
                <TrashBinIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
            </template>
            <template #content>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{ __('This will remove gallery from the server.')}}</p>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-sm">{{ __('Images will not be deleted, and can be attached in other galleries.')}}</p>
            </template>
        </ConfirmationModal>
        <FullScreenImagesModal :show="!!showingImage" @close="showingImage = null" :image="showingImage" />
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
