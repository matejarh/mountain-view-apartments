<script setup>
import Modal from '@/Components/Modal.vue';
import Carousel from '@/Components/_default/Carousel.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    image: Object|null,
    images: Array|null

});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="'screen'" :closeable="true" @close="close" :is-full-screen="true">
<!--         <div v-if="image" class="relative bg-transparent rounded-lg shadow-lg overflow-hidden">
            <img v-if="image" :src="image?.photo_url" class="w-full h-auto">
        </div> -->
        <Carousel id="accomodation-gallery-carousel" v-if="images" :slides="images" :image="image" :is-full-screen="true">
            <div v-for="image, key in images" :id="`accomodation-gallery-carousel-item-${key}`" class="hidden duration-700 ease-in-out" >
                <img v-if="image" :src="image?.photo_url" class="w-full h-auto">
            </div>
        </Carousel>


    </Modal>
</template>
