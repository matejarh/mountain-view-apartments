<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { icons } from '@/icons';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import Tooltip from '@/Components/Tooltip.vue';
import EditImageInfoDialog from '@/Pages/Admin/Galleries/_partials/EditImageInfoDialog.vue';

const props = defineProps({
    image: Object,
    hasGallery: {
        type: Boolean,
        default: false,
    },
    isIndex: {
        default: false,
        type: Boolean,
    },
    imagesCount: {
        default: 0,
        type: Number,
    },
    itemKey: {
        default: null,
        type: Number,
    },
    isBusy: {
        default: false,
        type: Boolean,
    },
})

const emit = defineEmits(['clicked', 'moveUp', 'moveDown'])

const page = usePage()

const detachForm = useForm({})
const attachForm = useForm({})
const destroyForm = useForm({})
const show = ref(true)
const showDetachConfirm = ref(false)
const showAttachConfirm = ref(false)
const showDestroyConfirm = ref(false)
const showEditDialog = ref(false)

const imgsrc = ref(null)
const img = new Image()

onMounted(() => {

    img.src = props.image.thumb_url
    img.onload = () => {
        imgsrc.value = props?.image.thumb_url
    }
})

const detach = () => {
    detachForm.put(route('admin.galleries.detach', { image: props.image, gallery: page.props?.gallery }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            showDetachConfirm.value = false
        }
    })
}

const attach = () => {
    attachForm.put(route('admin.galleries.attach', { image: props.image, gallery: page.props?.gallery }), {
        preserveScroll: true,
        preserveState: true,
        errorBag: 'attachingToGallery',
        onSuccess: () => {
            showAttachConfirm.value = false
        }
    })
}

const destroy = () => {
    destroyForm.delete(route('admin.images.destroy', { image: props.image }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            showDestroyConfirm.value = false
        }
    })
}

</script>

<template>
    <li v-if="show">

        <figure
            class="min-h-[240px] z-0 sm:min-h-[252px] md:min-h-[164px] lg:min-h-[160px] xl:min-h-auto relative shadow-lg active:shadow hover:shadow-xl brightness-90 hover:brightness-105 transition-all ease-out duration-150 cursor-pointer  overflow-visible">
            <div @click="$emit('clicked', { image: image, key: 0 })">
                <img class="rounded-lg" :src="imgsrc" :alt="image.name">
            </div>

            <figcaption id="moveup" v-if="image.pivot && image.pivot.order < imagesCount && itemKey + 1 < imagesCount"
                class="order top-0 bottom-0 right-0 text-gray-50 font-bold text-3xl absolute h-full flex flex-col justify-center items-end ">
                <Tooltip :text="__('Move Back')">
                    <button id="moveupbutton" :disabled="isBusy" @click="$emit('moveDown', itemKey)"
                        :class="{ 'opacity-75': isBusy }" class="hover:translate-x-1 transition">
                        <icons.CarretLeftIcon class="w-8 h-8 -rotate-180" />
                    </button>
                </Tooltip>
            </figcaption>

            <figcaption id="movedown" v-if="image.pivot && image.pivot.order > 1 && itemKey !== 0"
                class="order top-0 bottom-0 left-0 text-gray-50 font-bold text-3xl absolute h-full flex flex-col justify-center items-start ">
                <Tooltip :text="__('Move Forward')">
                    <button id="movedownbutton" :disabled="isBusy" @click="$emit('moveUp', itemKey)" c
                        :class="{ 'opacity-75': isBusy }" class="hover:-translate-x-1 transition">
                        <icons.CarretLeftIcon class="w-8 h-8 " />
                    </button>
                </Tooltip>
            </figcaption>

            <figcaption
                class="absolute flex rounded-t-lg justify-between px-2 py-1 text-md text-gray-700 dark:text-gray-300 top-0 bg-white dark:bg-gray-800  w-full bg-opacity-50 dark:bg-opacity-50 backdrop-blur-lg">
                <div class="left flex justify-start items-center">
                    <button @click="showEditDialog = true"
                        class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Edit image info')">
                            <icons.EditIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>

                </div>
                <div class="right flex justify-end items-center">

                    <button v-if="hasGallery && !isIndex" @click="showDetachConfirm = true"
                        class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Remove image from gallery')">
                            <icons.ArrowUpRightIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>

                    <button v-if="!hasGallery && !isIndex" @click="showAttachConfirm = true"
                        class="hover:text-primary-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Attach to gallery')">
                            <icons.ArrowUpRightIcon class="w-6 h-6 rotate-180" />
                        </Tooltip>
                    </button>

                    <button v-if="image.can['delete-image']" @click="showDestroyConfirm = true"
                        class="hover:text-bittersweet-700 transition-colors ease-out duration-150">
                        <Tooltip :text="__('Delete from server')">
                            <icons.TrashBinIcon class="w-6 h-6" />
                        </Tooltip>
                    </button>
                </div>
            </figcaption>
            <figcaption
                class="absolute px-2 py-1 text-lg rounded-b-lg text-white bottom-0 bg-white dark:bg-gray-800 max-h-16 overflow-y-auto scrollbar-none  w-full bg-opacity-50 dark:bg-opacity-50 backdrop-blur-lg">
                <h3 class="text-gray-700 dark:text-gray-300 whitespace-nowrap overflow-hidden">{{ image.name }}</h3>
                <p class="text-gray-700 dark:text-gray-300 text-sm whitespace-pre-wrap leading-tight">{{
                    image.description }}</p>
            </figcaption>
        </figure>



        <ConfirmationModal :is-danger="true" :show="showDetachConfirm" :form="detachForm"
            :busy-text="__('Detaching from gallery')" :recently-successful-text="__('Detached from gallery')"
            @close="showDetachConfirm = false" @confirmed="detach">
            <template #icon>
                <icons.ArrowUpRightIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
            </template>
            <template #content>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{ __('This will remove image from this gallery.')}}</p>
                <p class="mb-4 text-gray-500 dark:text-gray-300">{{ __('Image will not be deleted.') }}</p>
            </template>
        </ConfirmationModal>

        <ConfirmationModal :is-danger="false" :show="showAttachConfirm" :form="attachForm"
            :busy-text="__('Attaching to gallery')" :recently-successful-text="__('Attached')"
            @close="showAttachConfirm = false" @confirmed="attach">
            <template #icon>
                <icons.ArrowUpRightIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
            </template>
            <template #content>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{ __('This will add image to this gallery.')
                    }}
                </p>
            </template>
        </ConfirmationModal>

        <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" :form="destroyForm"
            :busy-text="__('Deleting Image')" :recently-successful-text="__('Image Deleted')"
            @close="showDestroyConfirm = false" @confirmed="destroy">
            <template #icon>
                <icons.TrashBinIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
            </template>
            <template #content>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{ __('This will delete image and its all files action.')}}</p>
            </template>
        </ConfirmationModal>

        <EditImageInfoDialog :show="showEditDialog" @close="showEditDialog = false" :image="image" />
    </li>
</template>
