<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TipTapInput from '@/Components/TipTapInput.vue';
import { icons } from '@/icons';
import { useForm } from '@inertiajs/vue3';
import { watchEffect } from 'vue';

const props = defineProps({
    show: Boolean,
    item: Object
})

const emit = defineEmits(['close'])

const form = useForm({
    name: props.item.name,
    email: props.item.email,
    subject: '',
    text: '',
})

watchEffect(() => {
    if (props.show) {
        populateForm()
    }
})

const populateForm = () => {
    form.name = props.item.name
    form.email = props.item.email
    form.subject = ''
}

const reply = () => {
    form.clearErrors()
    form.post(route('admin.inquiries.reply', props.item), {
        onSuccess: () => {
            emit('close')
            form.reset()
        }
    })
}
</script>

<template>
    <DialogModal :show="show" @close="$emit('close')">
        <template #title>{{ __('Reply to inquiry') }}</template>

        <template #content>
            <form action="" @submit.prevent>
                <div class="col-span-2">
                    <InputLabel :has-error="!!form.errors.name" for="to" :value="__('To')" />
                    <TextInput id="to" v-model="form.name" type="text" class="mt-1 block w-full cursor-not-allowed"
                        readonly disabled required autocomplete="to" :has-error="!!form.errors.name" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-2 mt-4">
                    <InputLabel :has-error="!!form.errors.email" for="to" :value="__('Email')" />
                    <TextInput id="to" v-model="form.email" type="text" class="mt-1 block w-full cursor-not-allowed"
                        readonly disabled required autocomplete="to" :has-error="!!form.errors.email" />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="w-full mt-4 ">
                    <InputLabel for="reply_text" :value="__('Reply Message')" />
                    <TipTapInput :is-small="true" v-model="form.text" :has-error="!!form.errors.text" required id="reply_text" />
                    <InputError :message="form.errors.text" class="mt-2" />
                </div>
            </form>
        </template>


        <template #footer>
            <PrimaryButton type="submit"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="reply">
                <div class="flex items-center">
                    <icons.SpinnerIcon v-if="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    <icons.PaperPlane v-else class="rotate-90 -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />

                    {{ form.processing ? __('Sending') + '...' : form.recentlySuccessful ? __('Reply Sent') : __('Reply')
                    }}
                </div>
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
