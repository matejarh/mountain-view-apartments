<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { getCurrentInstance, onMounted, ref } from 'vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ArrowUpRightIcon from '@/Icons/ArrowUpRightIcon.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import EditImageInfoDialog from './EditImageInfoDialog.vue';

const props = defineProps({
    image: Object
})

const page= usePage()

const instance = getCurrentInstance()

const detachForm = useForm({})

const detach = () => {
    detachForm.put(route('admin.galleries.detach', { image: props.image, gallery: page.props.gallery }), {
        preserveScroll: true,
        preserveState: true,
    })
}

const destroy = () => {
    detachForm.put(route('admin.images.destroy', { image: props.image }), {
        preserveScroll: true,
        preserveState: true,
    })
}

const show = ref(false)
const showDetachConfirm = ref(false)
const showEditDialog = ref(false)

onMounted(() => {
    setTimeout(() => {
        show.value = true
    }, (instance.vnode.key + 1) * 300);
})
</script>

<template>
    <Transition enter-active-class="animate__animated animate__dropInTop" leave-active-class="animate__animated animate__dropOutTop">

        <figure v-if="show" class="relative shadow-lg  transition-all duration-300 cursor-pointer filter hover:grayscale-0">
            <a href="#">
                <img class="rounded-lg"
                    :src="image.photo_url"
                    :alt="image.name">
            </a>
            <figcaption class="absolute flex rounded-t-lg justify-between px-4 py-1 text-md text-gray-700 dark:text-gray-300 top-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-85 backdrop-blur-lg">
                <button @click="showEditDialog = true">
                    <Tooltip :text="__('Edit image info')">
                        <EditIcon class="w-6 h-6" />
                    </Tooltip>
                </button>
                <button @click="showDetachConfirm = true">
                    <Tooltip :text="__('Remove image from gallery')">
                        <ArrowUpRightIcon class="w-6 h-6" />
                    </Tooltip>
                </button>
            </figcaption>
            <figcaption class="absolute px-4 py-1 text-lg rounded-b-lg text-white bottom-0 bg-gray-50 dark:bg-gray-800  w-full bg-opacity-85 backdrop-blur-lg">
                <h3 class="text-gray-700 dark:text-gray-300">{{ image.name }}</h3>
                <p class="text-gray-700 dark:text-gray-300 text-sm">{{ image.description }}</p>
            </figcaption>
        </figure>
    </Transition>

    <ConfirmationModal :show="showDetachConfirm" @close="showDetachConfirm = false" @confirmed="detach">
        <template #icon>
            <ArrowUpRightIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-gl">This will remove image from this gallery.</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300">Image will not be deleted.</p>
        </template>
        <template #footer>Footer</template>

    </ConfirmationModal>

    <EditImageInfoDialog :show="showEditDialog" @close="showEditDialog = false" :image="image" />
</template>
