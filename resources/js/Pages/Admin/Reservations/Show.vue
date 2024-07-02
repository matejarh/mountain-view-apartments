<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import UserCard from '@/Components/UserCard.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import Badge from '@/Components/_default/Badge.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { icons } from '@/icons';
import { ref } from 'vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { getFormattedDate } from '@/utils/date';
import InputLabel from '@/Components/InputLabel.vue';
import Alert from '@/Components/Alert.vue';

const page = usePage()
const form = useForm({})

const confirm = () => {
    form.put(route('admin.reservations.confirm', page.props?.reservation), {
        onSuccess: () => {
            form.reset()
        }
    })
}
const approvePayment = () => {
    form.put(route('admin.reservations.approve.payment', page.props?.reservation), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const reject = () => {
    form.put(route('admin.reservations.reject', page.props?.reservation), {
        onSuccess: () => {
            form.reset()
        }
    })
}
const rejectPayment = () => {
    form.put(route('admin.reservations.reject.payment', page.props?.reservation), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.reservations.destroy', page.props?.reservation), {
        onSuccess: () => {
            showDestroyConfirm.value = false
            form.reset()
            router.get(route('admin.reservations.index'))
        }
    })
}
</script>

<template>
    <FullLayout :title="__('Review')">
        <ActionSection :fullwidth="false" :back="true">
            <template #title>
                {{ __('Reservation') }}
                {{ __('for') }}
                {{ $page.props?.reservation.property.title[$page.props?.locale] }}
            </template>
            <template #content>
                <Alert status="info" v-show="$page.props.reservation.confirmed_at === null || $page.props.reservation.payment_received_at === null">
                    <p>Da je rezervacija uspešna in datumi niso več na voljo, mora biti potrjena in plačilo odobreno</p>
                </Alert>
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <UserCard :user="$page.props.reservation.owner" />
                    <div
                        class="w-full max-w-full col-span-2 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class=" flex justify-between items-center">
                            <div class="">
                                <Badge :color="$page.props.reservation.confirmed_at ? 'amazon' : 'bittersweet'">
                                    {{ $page.props.reservation.confirmed_at ? __('Confirmed') : __('Not Confirmed') }}
                                </Badge>
                            </div>
                            <div class="">
                                <Badge :color="$page.props.reservation.payment_received_at ? 'amazon' : 'bittersweet'">
                                    {{ $page.props.reservation.payment_received_at ? __('Payment Received') :
                                        __('Payment Not Received') }}
                                </Badge>
                            </div>

                            <div class="commands space-x-2">
                                <DangerButton @click="reject" v-if="$page.props.reservation.confirmed_at"
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />

                                    {{ __('Reject') }}
                                </DangerButton>
                                <PrimaryButton @click="confirm" v-else
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />
                                    {{ __('Confirm') }}
                                </PrimaryButton>
                                <DangerButton @click="rejectPayment" v-if="$page.props.reservation.payment_received_at"
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />

                                    {{ __('Reject Payment') }}
                                </DangerButton>
                                <PrimaryButton @click="approvePayment" v-else
                                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }"
                                    :disabled="form.processing || form.recentlySuccessful">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-4 w-4 text-white dark:text-white" />
                                    {{ __('Approve Payment') }}
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
                        <div class="text-sm text-gray-500">
                            {{ getFormattedDate($page.props?.reservation.created_at, $page.props?.locale) }}
                        </div>
                        <div class="mt-4">
                            <p><b>{{ __('Arrival') }}:</b> {{ $page.props?.reservation.localized_arrival }}</p>
                            <p><b>{{ __('Departure') }}:</b> {{ $page.props?.reservation.localized_departure }}</p>
                        </div>
                        <div class="mt-4">
                            <div class="">
                                <div class="whitespace-nowrap flex items-center">
                                    <p>
                                        {{ $page.props?.reservation.guests.adults }} {{
                                            __('Adult', $page.props?.reservation.guests.adults)}}
                                    </p>
                                    <icons.UserIcon class="w-6 h-6"
                                        v-for="adult, key in $page.props?.reservation.guests.adults" />
                                </div>
                                <div class="whitespace-nowrap flex items-center">
                                    <p>
                                        {{ $page.props?.reservation.guests.children }} {{
                                            __('Child', $page.props?.reservation.guests.children)}}
                                    </p>
                                    <div class="w-6" v-for="adult, key in $page.props?.reservation.guests.children">
                                        <icons.UserIcon class="w-4 h-4 mx-auto" />

                                    </div>
                                </div>

                            </div>
                            <div class="whitespace-nowrap">
                                <icons.PetsIcon v-if="$page.props?.reservation.guests.pets" class="mx-auto w-5 h-5" />
                                <Badge v-if="$page.props?.reservation.guests.pets"
                                    :color="$page.props?.reservation.guests.pets ? 'amazon' : 'bittersweet'">
                                    {{ __('Pets') }}</Badge>
                            </div>
                        </div>
                        <div class="mt-4">
                            <InputLabel :value="__('Message')" :as="'div'" />
                            <article v-html="$page.props.reservation.message" class="bg-gray-50 p-4 rounded-lg"></article>

                        </div>
                    </div>
                </div>
            </template>
        </ActionSection>
        <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false"
            @confirmed="destroy" :form="form" busy-text="Deleting" recently-successful-text="Reservation deleted"
            button-text="Yes Delete reservation">
            <template #icon>
                <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This will permanently delete reservation from database.') }}</p>
                <div class="p-4">
                    <p>{{ $page.props.reservation.localized_arrival }} </p>
                    <p>{{ $page.props.reservation.localized_departure }} </p>
                    <article v-html="$page.props.reservation.text" />
                </div>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This action is not reversable!') }}</p>
                <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('Are you sure you want to do this?') }}</p>
            </template>

        </ConfirmationModal>
    </FullLayout>
</template>
