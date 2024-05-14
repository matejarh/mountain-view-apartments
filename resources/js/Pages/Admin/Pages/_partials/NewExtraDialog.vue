<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';


const props = defineProps({
    show: Boolean,
})

const page = usePage()

const extra = computed(() => {
    let e = {
        [form.name]: {}
    }
    page.props.supported_locales.forEach(locale => {
        e[form.name][locale] = ""
    });
    return e
})

const form = useForm({
    name: '',
})
const emit = defineEmits(['close', 'create'])

</script>

<template>
    <DialogModal max-width="xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Create New Extra') }}</template>

        <template #content>
            {{ extra }}
            <div class="col-span-full mt-4">
                <InputLabel :for="`extra_key`" :value="__('Extra key')" />
                <TextInput :id="`new_extra_key`" v-model="form.name" type="text" class="mt-1 block w-full" required
                    autocomplete="new_extra_key" :has-error="!!form.errors.name"
                    :placeholder="__('Enter title') + '...'" />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
        </template>

        <template #footer>
            <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="$emit('create', extra)">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Adding') + '...' : form.recentlySuccessful ? __('Added') : __('Add')
                    }}

                </div>
            </PrimaryButton>
        </template>

    </DialogModal>
</template>
