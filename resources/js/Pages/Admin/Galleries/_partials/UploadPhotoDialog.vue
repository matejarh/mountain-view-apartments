<script setup>
import { ref, watch } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DropZone from '@/Components/DropZone.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import UploadingPhotoSlot from './UploadingPhotoSlot.vue';

const props = defineProps({
    show: Boolean,
    gallery: {
        default: null,
    }
})

const emit = defineEmits(['close'])

const photoPreview = ref([]);
const photoInput = ref(null);

watch(photoInput, () => {
    updatePhotoPreview(photoInput.value)
})

const updatePhotoPreview = (files) => {
    for (let index = 0; index < files.length; index++) {

        const photo = files[index];

        if (!photo) return;
        if (photoPreview.value.length > 10) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            if (fileExists(e.target.result)) return

            photoPreview.value.push({
                preview: e.target.result,
                file: photo
            });
        };

        reader.readAsDataURL(photo);
    }
};

const fileExists = (otherPhotoPreview) => {
    return photoPreview.value.some(({ preview }) => preview === otherPhotoPreview)
}

const saved = ref(false)
const removeFromPhotoPreview = (value) => {
    saved.value = value.saved

    const index = photoPreview.value.indexOf(value.photo);
    if (index > -1) {
        photoPreview.value.splice(index, 1);
    }
    if (saved.value === true && photoPreview.value.length === 0) {
        setTimeout(() => {

            emit('close')
        }, 500);
    }

    saved.value = false
}


</script>

<template>
    <DialogModal max-width="4xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Upload Images') }}</template>

        <template #content>
            <div class="relative">

                <TransitionGroup v-show="photoPreview" name="list" tag="ul" class="flex flex-col space-y-4 ">
                    <UploadingPhotoSlot v-for="photo in photoPreview" :key="photo.preview" :photo="photo"
                        @remove="removeFromPhotoPreview" />
                </TransitionGroup>
            </div>


            <DropZone v-model="photoInput" />
        </template>

        <template #footer>
            <!--             <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful" @click="createAll">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Uploading') + '...' : form.recentlySuccessful ? __('Uploaded') : __('Upload All') }}

                </div>
            </PrimaryButton> -->
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
    transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
