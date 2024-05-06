<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.clearErrors()
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <FormSection @submitted="updatePassword">
        <template #title>
            {{ __('Update Password') }}
        </template>

        <template #description>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel :has-error="!!form.errors.current_password" for="current_password"
                    :value="__('Current Password')" />
                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                    type="password" class="mt-1 block w-full" autocomplete="current-password"
                    :has-error="!!form.errors.current_password" />
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :has-error="!!form.errors.password" for="password" :value="__('New Password')" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" :has-error="!!form.errors.password" />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :has-error="!!form.errors.password_confirmation" for="password_confirmation"
                    :value="__('Confirm Password')" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" autocomplete="new-password"
                    :has-error="!!form.errors.password_confirmation" />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                {{ __('Saved.') }}
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-3 w-3 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') :
                    __('Save') }}

                </div>
            </PrimaryButton>
        </template>
    </FormSection>
</template>
