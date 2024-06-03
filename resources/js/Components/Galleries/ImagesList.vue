<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    gallery: Object,
})

const detachForm = useForm({})

const detach = (image) => {
    detachForm.put(route('admin.galleries.detach', { image: image, gallery: props.gallery }), {
        preserveScroll: true,
        preserveState: true,
    })
}
</script>

<template>
    <div v-if="gallery.images.length > 0" class="my-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 lg:grid-cols-6">
        <TransitionGroup enter-active-class="animate__animated animate__zoomIn"
            leave-active-class="animate__animated animate__hinge">

            <span v-for="photo, key in gallery.images" :key="photo.id"
                class="transition relative block rounded-lg shadow-lg  w-20 h-20  bg-cover bg-no-repeat bg-center"
                :style="'background-image: url(\'' + photo.image_path + '\');'">

                <button class="absolute top-0 right-0 text-bittersweet-700" @click="detach(photo)">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>
            </span>
        </TransitionGroup>
    </div>
</template>
