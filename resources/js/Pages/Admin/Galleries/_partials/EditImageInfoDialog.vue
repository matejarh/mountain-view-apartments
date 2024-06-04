<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ProgressBar from '@/Components/ProgressBar.vue';
import { icons } from '@/icons';


const props = defineProps({
    show: Boolean,
    image: {
        default: null,
    }
})

const emit = defineEmits(['close'])

const form = useForm({
    name: props.image?.name,
    description: props.image?.description,
    photo: null,
})

const photoPreview = ref(null);
const photoInput = ref(null);

const update = () => {
    form.clearErrors()
    if (form.isDirty) {
        if (photoInput.value) {
            form.photo = photoInput.value.files[0];
        }
        form.post(route('admin.images.update', props.image), {
            preserveScroll: true,
            errorBag: 'updateImageInformation',
            onSuccess: () => {
                clearPhotoFileInput()
                emit('close')
            },
        })
    }
}

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);

    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
};

const deletePhoto = () => {
    router.delete(route('admin.images.update', props.image), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
            emit('close')
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

</script>

<template>
    <DialogModal max-width="4xl" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ image ? __('Edit Image') : __('Create Image') }}</template>

        <template #content>
            <div class="" v-show="!photoPreview">
                <Tooltip :text="__('Doubleclick to change photo')">
                    <img :src="image.photo_url" :alt="image.slug" class="w-full h-auto rounded-lg mb-4"
                        @dblclick="selectNewPhoto" />
                </Tooltip>
            </div>
            <div class="" v-show="photoPreview">
                <img :src="photoPreview" @dblclick="selectNewPhoto" :alt="image.slug" class="w-full h-auto rounded-lg mb-4" />
            </div>
            <InputError :message="form.errors.photo" class="mt-2" />

            <ProgressBar v-if="form.progress" :progress="form.progress.percentage" />

            <div class="grid gap-4 grid-cols-2">
                <input id="photo" ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview">
                <div class="col-span-2">
                    <TextInput id="image_name" v-model="form.name" type="text" class="mt-1 block w-full" required
                        autocomplete="image_name" :has-error="!!form.errors.name" :placeholder="__('Enter name') + '...'" />
                    <InputError :message="form.errors.name" class="mt-2" />

                </div>
                <div class="col-span-2">
                    <TextArea id="image_description" v-model="form.description" type="text" class="mt-1 block w-full" required
                        autocomplete="image_description" :has-error="!!form.errors.description"
                        :placeholder="__('Enter description') + '...'" />
                    <InputError :message="form.errors.description" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful" @click="update">
                <div class="flex items-center">
                    <icons.SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save') }}

                </div>
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
