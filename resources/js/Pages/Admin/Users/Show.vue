<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import UserProfileCard from '@/Components/Users/UserProfileCard.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import Badge from '@/Components/_default/Badge.vue';

import { router, useForm, usePage } from '@inertiajs/vue3';
import { icons } from '@/icons';
import { ref } from 'vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const page = usePage()
const form = useForm({})


const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.users.destroy', page.props?.user), {
        onSuccess: () => {
            showDestroyConfirm.value = false
            form.reset()
            router.get(route('admin.users.index'))
        }
    })
}
</script>

<template>
    <FullLayout :title="__('Profile')">
        <ActionSection :fullwidth="false" :back="true">
            <template #title>

                {{ $page.props?.user.name }}
            </template>
            <template #content>
                <UserProfileCard />
            </template>
        </ActionSection>
        <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false"
            @confirmed="destroy" :form="form" busy-text="Deleting" recently-successful-text="User deleted"
            button-text="Yes Delete User">
            <template #icon>
                <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This will permanently delete user and all his or hers resources from database.') }}</p>
                <div class="p-4">
                    <p>{{__('Resources to be deleted')}}:</p>
                    <ol>
                        <li>{{__('Reviews')}}</li>
                        <li>{{__('Reservations')}}</li>
                        <li>{{__('Images')}}</li>
                        <li>{{__('Likes')}}</li>
                        <li>{{__('Activity')}}</li>
                        <li>{{__('Logins')}}</li>
                    </ol>

                </div>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This action is not reversable!') }}</p>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('Are you sure you want to do this?') }}</p>
            </template>

        </ConfirmationModal>
    </FullLayout>
</template>
