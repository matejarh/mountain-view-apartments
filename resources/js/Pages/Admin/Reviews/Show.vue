<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import UserCard from '@/Components/UserCard.vue';
import RatingStars from '@/Components/RatingStars.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import Badge from '@/Components/_default/Badge.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { icons } from '@/icons';
import { ref } from 'vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const page = usePage()
const form = useForm({})

const approve = () => {
    form.put(route('admin.reviews.approve', page.props?.review), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const reject = () => {
    form.put(route('admin.reviews.reject', page.props?.review), {
        onSuccess: () => {
            form.reset()
        }
    })
}
const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.reviews.destroy', page.props?.review), {
        onSuccess: () => {
            showDestroyConfirm.value = false
            form.reset()
            router.get(route('admin.reviews.index'))
        }
    })
}
</script>

<template>
    <FullLayout :title="__('Review')">
        <ActionSection :fullwidth="false" :back="true">
            <template #title>
                {{ __('Review') }}
                {{ __('for') }}
                {{ $page.props?.review.reviewed.title[$page.props?.locale] }}
            </template>
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <UserCard :user="$page.props.review.owner" />
                    <div
                        class="w-full max-w-full col-span-2 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class=" flex justify-between">
                            <RatingStars :score="$page.props.review.score" :without-text="true" />

                            <div class="">
                                <Badge :color="$page.props.review.approved_at ? 'amazon' : 'bittersweet'">
                                    {{ $page.props.review.approved_at ? __('Approved') : __('Not Approved') }}
                                </Badge>
                            </div>

                            <div class="commands space-x-2">
                                <DangerButton @click="reject" v-if="$page.props.review.approved_at"
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />

                                    {{ __('Reject') }}
                                </DangerButton>
                                <PrimaryButton @click="approve" v-else
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />
                                    {{ __('Approve') }}
                                </PrimaryButton>
                                <DangerButton @click="showDestroyConfirm = true"
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />

                                    {{ __('Delete') }}
                                </DangerButton>
                            </div>
                        </div>
                        <div class="text-md text-gray-500">
                            {{ $page.props.review.created_at_human_readable }}
                        </div>
                        <article class="mt-4" v-html="$page.props.review.text"></article>
                    </div>
                </div>
            </template>
        </ActionSection>
        <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false"
            @confirmed="destroy" :form="form" busy-text="Deleting" recently-successful-text="Review deleted"
            button-text="Yes Delete review">
            <template #icon>
                <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This will permanently delete review from database.') }}</p>
                <div class="p-4">
                    <p>{{ $page.props.review.owner?.name }} {{ __('wrote') }}:</p>
                    <article v-html="$page.props.review.text" />
                </div>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This action is not reversable!') }}</p>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('Are you sure you want to do this?') }}</p>
            </template>

        </ConfirmationModal>
    </FullLayout>
</template>
