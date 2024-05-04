<script setup>
import { onMounted, onUpdated, ref, watch, watchEffect } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import ImageCard from './ImageCard.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';


const props = defineProps({
    show: Boolean,
    gallery: Object,
})

const emit = defineEmits(['close', 'showUploadPhotoDialog', 'showEditDialog'])

const images = ref([])
const total_count = ref(0)

const busy = ref(false)

watch(props,() => {
    if (props.show === true) {

        // fetch()
    }
})

const fetch = () => {
    busy.value = true
    axios.get(route('admin.images.fetch', props.gallery))
        .then(response => {
            images.value = response.data.images
            total_count.value = response.data.total_count
            busy.value = false
        })
}



</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="$emit('close')">
        <template #title>{{ __('Attach Images To Gallery') }}</template>

        <template #content>
            <Transition
                enter-active-class="animate__animated animate__fadeIn"
                leave-active-class="animate__animated animate__fadeOut absolute"
                >

                <div class="p-6 w-full" v-if="busy">
                    <SpinnerIcon class="w-6 h-6 animate-spin mx-auto" />
                </div>
                <div class="" v-else>
                        {{  }}
                        <TransitionGroup v-if="$page.props.images_not_in_gallery.length > 0" name="list" tag="ul"
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                            <ImageCard :image="image" v-for="image, key in $page.props.images_not_in_gallery" :key="image.id" :has-gallery="false"/>
                            <div key="empty">
                                <div class="w-full text-center cursor-pointer "
                                    @click="$emit('showUploadPhotoDialog')">
                                    <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                                    <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some') }}</p>
                                </div>
                            </div>
                        </TransitionGroup>

                    <div v-else class="">
                        <div class="w-full text-center cursor-pointer " @click="$emit('showUploadPhotoDialog')">
                            <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                            <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ $page.props.total_images_count > 0 ? __('All uploaded images are attached to gallery!') : __('No images uploaded yet!') }}</p>
                            <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some') }}</p>
                        </div>
                    </div>

                </div>
            </Transition>

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
