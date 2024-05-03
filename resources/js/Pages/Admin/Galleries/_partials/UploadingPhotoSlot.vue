<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UploadIcon from '@/Icons/UploadIcon.vue';

const props = defineProps({
    photo: Object,
})
const emit = defineEmits(['remove'])

const form = useForm({
    name: '',
    description: '',
    photo: null,
})

const create = () => {
    form.photo = props.photo.file

    if (form.isDirty) {
        form.post(route('admin.images.store'), {
            preserveScroll: true,
            errorBag: 'creatingImageBag',
            onSuccess: () => {
                emit('remove', props.photo)
            },
        })
    }
}
</script>

<template>
    <div class="">

        <div class="flex space-x-4">

            <div class="transition relative block rounded-lg shadow-lg  w-44 h-36  bg-cover bg-no-repeat bg-center"
                :style="'background-image: url(\'' + photo.preview + '\');'">

                <button class="absolute top-0 right-0 text-bittersweet-700" @click="$emit('remove', photo)">
                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>
            </div>
            <div class="w-full">
                <div class="col-span-2">
                    <TextInput id="name" v-model="form.name" type="text" class=" block w-full" required
                        autocomplete="name" :has-error="!!form.errors.name" :placeholder="__('Enter name') + '...'" />
                    <InputError :message="form.errors.name" class="mt-0 mb-2" />

                </div>
                <div class="col-span-2">
                    <TextArea id="description" v-model="form.description" type="text" class=" block w-full" required
                        autocomplete="description" :has-error="!!form.errors.description"
                        :placeholder="__('Enter description') + '...'" />
                    <InputError :message="form.errors.description" class="mt-0 mb-2" />

                </div>
            </div>
            <div class="">
                <PrimaryButton type="button" @click="create">
                    <UploadIcon class="w-6 h-6" />

                </PrimaryButton>
            </div>
        </div>
        <div v-if="form.progress" class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="bg-amazon-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                :style="`width: ${form.progress.percentage}%`"> {{ form.progress.percentage }}%</div>
        </div>
<!--         <progress v-if="true" :value="50" max="100" class="w-full">
            {{ 100 }}%
        </progress> -->
    </div>
</template>
