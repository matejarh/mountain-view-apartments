<script setup>
import { onMounted, ref, watch, watchEffect } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
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

const form = useForm({
    name: '',
    description: '',
    photos: null,
})

const create = () => {
    if (form.isDirty) {
        form.post(route('admin.galleries.store'), {
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}


const photoPreview = ref([]);
const photoInput = ref(null);

watch(photoInput, () => {
    updatePhotoPreview(photoInput.value)
})

const updatePhotoPreview = (files) => {
    for (let index = 0; index < files.length; index++) {

        const photo = files[index];

        if (!photo) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            photoPreview.value.push({
                preview: e.target.result,
                file: photo
            });
        };

        reader.readAsDataURL(photo);
    }
};

const removeFromPhotoPreview = (value) => {

    /*     photoPreview.value = photoPreview.value.filter(function(item, key) {
            return key !== value
        }) */
    const index = photoPreview.value.indexOf(value);
    if (index > -1) {
        photoPreview.value.splice(index, 1);
    }

    if (photoPreview.value.length === 0) {
        setTimeout(() => {

            emit('close')
        }, 2000);
    }
}


</script>

<template>
    <DialogModal max-width="4xl" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ __('Upload Photos') }}</template>

        <template #content>
            <div v-show="photoPreview" class="flex flex-col space-y-4 mb-4">
                <TransitionGroup enter-active-class="animate__animated animate__zoomIn"
                    leave-active-class="animate__animated animate__hinge ">
                    <UploadingPhotoSlot v-for="photo in photoPreview" :key="photo.preview"
                        :photo="photo" @remove="removeFromPhotoPreview" />
                </TransitionGroup>
            </div>

            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>

            <DropZone v-model="photoInput" />
        </template>

        <template #footer>
            <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful" @click="create">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save') }}

                </div>
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
