<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import GalleryCard from '@/Components/Properties/GalleryCard.vue';
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    show: Boolean,
    property: Object,
})

const emit = defineEmits(['close'])

const attachForm = useForm({})

const handleAttach = (gallery) => {
    emit('close')
    attachForm.put(route('admin.properties.attach.gallery', { gallery: gallery, property: props.property }), {
        errorBag: 'attachingToGallery',
        onSuccess: () => {
            //  console.log('attachec')
        }
    })
}

</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="$emit('close')">
        <template #title>{{ __('Manage Galleries') }}</template>

        <template #content>
            <TransitionGroup name="list" tag="ul"
                class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">

                <GalleryCard v-for="gallery in $page.props?.galleries_not_in_property" :gallery="gallery"
                    :key="gallery.id" @attach="handleAttach" />
            </TransitionGroup>

        </template>



    </DialogModal>
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
