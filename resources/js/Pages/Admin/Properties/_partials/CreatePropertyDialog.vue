<script setup>
import { onMounted, ref, watch, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';


const props = defineProps({
    show: Boolean,
    gallery: {
        default: null,
    }
})

const emit = defineEmits(['close'])

const form = useForm({
    name: props.gallery?.name,
    description: props.gallery?.description,
    photos: null,
})

const create = () => {
    form.clearErrors()
    if (form.isDirty) {
        form.post(route('admin.galleries.store'), {
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}

const update = () => {
    form.clearErrors()
    if (form.isDirty) {
        form.put(route('admin.galleries.update', props.gallery), {
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}

const handleSubmit = () => {
    props.gallery ? update() : create()
}

const photoPreview = ref(null);
const photoInput = ref(null);

watchEffect(() => {
    if (props.gallery !== null) {
        populateForm()
    }
    if (!props.show) {
        setTimeout(() => {
            form.clearErrors()
            form.reset()
        }, 200);
    }
})

const populateForm = () => {
    form.name = props.gallery.name
    form.description = props.gallery.description
}

</script>

<template>
    <DialogModal max-width="2xl" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ gallery ? __('Edit Gallery') : __('Create Gallery') }}</template>

        <template #content>
            <div class="grid gap-4 grid-cols-2">

                <div class="col-span-2">
                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                        autocomplete="name" :has-error="!!form.errors.name" :placeholder="__('Enter name') + '...'" />
                    <InputError :message="form.errors.name" class="mt-2" />

                </div>
                <div class="col-span-2">
                    <TextArea id="description" v-model="form.description" type="text" class="mt-1 block w-full" required
                        autocomplete="description" :has-error="!!form.errors.description"
                        :placeholder="__('Enter description') + '...'" />
                    <InputError :message="form.errors.description" class="mt-2" />

                </div>

            </div>


        </template>

        <template #footer>
            <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful" @click="handleSubmit">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save') }}

                </div>
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
