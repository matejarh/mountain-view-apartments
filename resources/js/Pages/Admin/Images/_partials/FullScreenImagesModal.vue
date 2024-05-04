<script setup>
import Modal from '@/Components/Modal.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    image: Object

});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="'screen'" :closeable="true" @close="close" :is-full-screen="true">
        <div class="relative bg-transparent rounded-lg shadow-lg overflow-hidden">
            <img v-if="image" :src="image?.photo_url" class="w-full h-auto">
        </div>

    </Modal>
</template>
