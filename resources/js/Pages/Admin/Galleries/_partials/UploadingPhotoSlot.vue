<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UploadIcon from '@/Icons/UploadIcon.vue';
import { getCurrentInstance } from 'vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import Tooltip from '@/Components/Tooltip.vue';
import ProgressBar from '@/Components/ProgressBar.vue';

const props = defineProps({
    photo: Object,
})
const emit = defineEmits(['remove'])

const instance = getCurrentInstance()

const form = useForm({
    name: '',
    description: '',
    photo: null,
})

const create = () => {
    form.clearErrors()
    form.photo = props.photo.file

    if (form.isDirty) {
        form.post(route('admin.images.store'), {
            preserveScroll: true,
            errorBag: 'creatingImageBag',
            onSuccess: () => {
                emit('remove', { photo: props.photo, saved: true })
            },
        })
    }
}
</script>

<template>
    <li class="border-b-2 dark:border-gray-400 block">

        <div class="sm:flex sm:space-x-4 ">

            <div class="transition overflow-visible relative rounded-lg w-full sm:w-1/2 lg:w-1/3 h-auto mb-4 flex items-center justify-center"
                :class="{ 'border-bittersweet-600 border-2': form.errors.photo }">
                <img :src="photo.preview" class="drop-shadow-lg rounded-lg object-cover h-48 w-96">

                <button
                    class="absolute top-0 right-0 p-2 shadow-lg rounded-tr-lg rounded-bl-lg text-white bg-bittersweet-600 bg-opacity-75 hover:bg-opacity-85 transition hover:scale-105 active:scale-95"
                    @click="$emit('remove', { photo: props.photo, saved: true })">

                    <Tooltip :text="__('Remove')">
                        <TrashBinIcon class="w-6 h-6" />
                    </Tooltip>

                </button>
                <div v-text="form.errors.photo" v-if="!!form.errors.photo"
                    class="absolute w-full bottom-0 leading-tight text-center text-white bg-bittersweet-600 bg-opacity-50" />
            </div>
            <div class="w-full flex flex-col space-y-2">
                <div class="col-span-2">
                    <TextInput :id="'name-' + instance.vnode.key" v-model="form.name" type="text" class=" block w-full"
                        required :autocomplete="'name-' + instance.vnode.key" :has-error="!!form.errors.name"
                        :placeholder="__('Enter name') + '...'" />
                    <InputError :message="form.errors.name" class="mt-0 mb-2" />

                </div>
                <div class="col-span-2">
                    <TextArea :id="'description-' + instance.vnode.key" v-model="form.description" class=" block w-full"
                        :autocomplete="'description-' + instance.vnode.key" :has-error="!!form.errors.description"
                        :placeholder="__('Enter description') + '...'" />
                    <InputError :message="form.errors.description" class="mt-0 mb-2" />

                </div>

            </div>
            <div class="mt-2 sm:mt-0">

                <PrimaryButton type="button" class="w-full"
                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                    :disabled="form.processing || form.recentlySuccessful" @click="create">
                    <div class="mx-auto flex items-center justify-center text-center">
                        <SpinnerIcon v-if="form.processing"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                        <UploadIcon v-else class="-ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                        {{ form.processing ? __('Uploading') + '...' : form.recentlySuccessful ? __('Uploaded') :
                            __('Upload') }}

                    </div>
                </PrimaryButton>


            </div>
        </div>
        <ProgressBar v-if="form.progress" :progress="form.progress.percentage" />

        <!--         <progress v-if="true" :value="50" max="100" class="w-full">
            {{ 100 }}%
        </progress> -->
    </li>
</template>
