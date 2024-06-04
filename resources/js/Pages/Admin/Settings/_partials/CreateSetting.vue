<script setup>
import Alert from '@/Components/Alert.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    setting: Object,
})

const form = useForm(props.setting)

const create = () => {
    form.post(route('admin.settings.store'), {
        preserveScroll: true,
        preserveState: true,
        errorBag: 'creatingNewSetting',
        onSuccess: () => {

        }
    })
}
</script>

<template>
    <div class="">
        <Alert v-if="form.hasErrors">
            <span class="font-medium">{{__('Ensure that these requirements are met')}}:</span>
            <ul class="mt-1.5 list-disc list-inside">
                <li v-for="error, key in form.errors" :key="key">{{ error }}</li>
            </ul>
        </Alert>
        <PrimaryButton type="button" :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
            :disabled="form.processing || form.recentlySuccessful" @click="create">
            <div class="flex items-center">
                <SpinnerIcon v-show="form.processing"
                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                {{ form.processing ? __('Creating Site Backgrounds Setting') + '...' : form.recentlySuccessful ?
                    __('Site Backgrounds Setting Created') : __('Create Site Backgrounds Setting') }}

            </div>
        </PrimaryButton>
    </div>
</template>
