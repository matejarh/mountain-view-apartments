<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            {{ __('Delete Account') }}
        </template>

        <template #description>
            {{ __('Permanently delete your account.') }}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-200">
                {{ __(`Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.`)}}
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmUserDeletion">
                    {{ __('Delete Account') }}
                </DangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    {{ __('Delete Account') }}
                </template>

                <template #content>
                    {{ __(`Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.`)}}

                    <div class="mt-4">
                        <TextInput :has-error="!!form.errors.password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4"
                            :placeholder="__('Password')" autocomplete="current-password" @keyup.enter="deleteUser" />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        {{ __('Cancel') }}
                    </SecondaryButton>

                    <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser">
                        <div class="flex items-center">
                            <SpinnerIcon v-show="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                            {{ form.processing ? __('Deleting')+'...' : form.recentlySuccessful ? __('Account Deleted') : __('Delete Account') }}

                        </div>
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
