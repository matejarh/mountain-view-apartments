<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { getCurrentInstance, onMounted, ref } from 'vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ArrowUpRightIcon from '@/Icons/ArrowUpRightIcon.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import EditImageInfoDialog from './EditImageInfoDialog.vue';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';

const props = defineProps({
    image: Object,
    hasGallery: {
        type: Boolean,
        default: false,
    }
})

const page= usePage()

const instance = getCurrentInstance()

const detachForm = useForm({})
const attachForm = useForm({})
const destroyForm = useForm({})

const detach = () => {
    detachForm.put(route('admin.galleries.detach', { image: props.image, gallery: page.props.gallery }), {
        preserveScroll: true,
        preserveState: true,
    })
}

const attach = () => {
    attachForm.put(route('admin.galleries.attach', { image: props.image, gallery: page.props.gallery }), {
        preserveScroll: true,
        preserveState: true,
    })
}

const destroy = () => {
    destroyForm.delete(route('admin.images.destroy', { image: props.image }), {
        preserveScroll: true,
        preserveState: true,
    })
}

const show = ref(false)
const showDetachConfirm = ref(false)
const showAttachConfirm = ref(false)
const showDestroyConfirm = ref(false)
const showEditDialog = ref(false)

onMounted(() => {
    setTimeout(() => {
        show.value = true
    }, (instance.vnode.key + 1) * 150);
})
</script>

<template>
    <Transition enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">

        <figure v-if="show" class="min-h-[240px] sm:min-h-[252px] md:min-h-[164px] lg:min-h-[160px] xl:min-h-auto relative shadow-lg  transition-all duration-300 cursor-pointer filter hover:grayscale-0 overflow-visible">
            <a href="#">
                <img class="rounded-lg"
                    :src="image.thumb_url"
                    :alt="image.name">
            </a>
            <figcaption class="absolute flex rounded-t-lg justify-between px-4 py-1 text-md text-gray-700 dark:text-gray-300 top-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-75 dark:bg-opacity-75 backdrop-blur-lg">
                <div class="left flex justify-start items-center">
                    <button @click="showEditDialog = true" class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Edit image info')">
                            <EditIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>

                </div>
                <div class="right flex justify-end items-center">

                    <button v-if="hasGallery" @click="showDetachConfirm = true" class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Remove image from gallery')">
                            <ArrowUpRightIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>
                    <button v-if="!hasGallery" @click="showAttachConfirm = true" class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Attach to gallery')">
                            <ArrowUpRightIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>
                    <button v-if="$page.props.can.delete_images" @click="showDestroyConfirm = true" class="hover:text-bittersweet-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Delete from server')">
                            <TrashBinIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>
                </div>
            </figcaption>
            <figcaption class="absolute px-4 py-1 text-lg rounded-b-lg text-white bottom-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-75 dark:bg-opacity-75 backdrop-blur-lg">
                <h3 class="text-gray-700 dark:text-gray-300">{{ image.name }}</h3>
                <p class="text-gray-700 dark:text-gray-300 text-sm">{{ image.description }}</p>
            </figcaption>
        </figure>
    </Transition>

    <ConfirmationModal :show="showDetachConfirm" @close="showDetachConfirm = false" @confirmed="detach" :form="detachForm" :busy-text="__('Detaching from gallery')" :recently-successful-text="__('Detached')">
        <template #icon>
            <ArrowUpRightIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{__('This will remove image from this gallery.')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300">{{__('Image will not be deleted.')}}</p>
        </template>
    </ConfirmationModal>

    <ConfirmationModal :show="showAttachConfirm" @close="showAttachConfirm = false" @confirmed="attach" :form="attachForm" :busy-text="__('Attaching to gallery')" :recently-successful-text="__('Attached')">
        <template #icon>
            <ArrowUpRightIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{__('This will add image to this gallery.')}}</p>
        </template>
    </ConfirmationModal>

    <ConfirmationModal :show="showDestroyConfirm" @close="showDestroyConfirm = false" @confirmed="destroy" :form="destroyForm" :busy-text="__('Deleting Image')" :recently-successful-text="__('Image Deleted')">
        <template #icon>
            <TrashBinIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{__('This will delete image and its all files and thumbs from server.')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-sm">{{__('Image can not be restored after this action.')}}</p>
        </template>
    </ConfirmationModal>

    <EditImageInfoDialog :show="showEditDialog" @close="showEditDialog = false" :image="image" />
</template>
