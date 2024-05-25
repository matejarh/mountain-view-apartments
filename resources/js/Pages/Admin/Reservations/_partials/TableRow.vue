<script setup>
import TableRow from '@/Components/TableRow.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import Popover from '@/Components/_default/Popover.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Badge from '@/Components/_default/Badge.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { icons } from '@/icons';

const props = defineProps({
    item: Object,
})

defineEmits(['edit-reservation'])

const form = useForm({

})
const approve = () => {
    form.put(route('admin.reservations.approve', props.item), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const reject = () => {
    form.put(route('admin.reservations.reject', props.item), {
        onSuccess: () => {
            form.reset()
        }
    })
}
const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.reservations.destroy', props.item), {
        onSuccess: () => {
            showDestroyConfirm.value = false
            form.reset()
        }
    })
}
</script>

<template>
    <TableRow>
        <td class="w-4 p-4">
            <div class="flex items-center">
                <input :id="`checkbox-${item?.id}`" type="checkbox"
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label :for="`checkbox-${item?.id}`" class="sr-only">{{ __('checkbox') }}</label>
            </div>
        </td>

        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full" :src="item?.owner.profile_photo_url"
                    :alt="item?.owner.name + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ item?.owner.name }}</div>
                    <div class="font-normal text-gray-500 dark:text-gray-300">{{ item?.owner.email }}</div>
                </div>

            </div>
        </th>

        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-sm" :src="item?.property.avatar_url"
                    :alt="item?.property?.title[$page.props?.locale] + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ item?.property?.title[$page.props?.locale] }}
                    </div>
                    <!-- <div class="font-normal text-gray-500 dark:text-gray-300">{{ item?.owner.email }}</div> -->
                </div>
            </div>
        </td>

        <td class="px-6 py-4">
            <p class="whitespace-nowrap">
                {{item.localized_arrival}}
            </p>
            <p class="whitespace-nowrap">
                {{item.localized_departure}}
            </p>

        </td>
        <td class="px-6 py-4">
            <Popover :key="`reservationGuestsPopover${item.id}`" :title="__('Guests')">
                <div class="">
                    <div class="whitespace-nowrap flex">
                        <icons.UserIcon class="w-6 h-6" v-for="adult,key in item.guests.adults" />
                       <!-- {{ item.guests.adults }} {{ __('Adult',item.guests.adults)}} -->
                    </div>
                    <div class="whitespace-nowrap flex">
                        <div class="w-6" v-for="adult,key in item.guests.children">
                            <icons.UserIcon class="w-4 h-4 mx-auto"  />

                        </div>
                      <!--  {{ item.guests.children }} {{ __('Child',item.guests.children)}} -->
                    </div>

                </div>
                <div class="whitespace-nowrap">
                    <icons.PetsIcon v-if="item.guests.pets"  class="mx-auto w-5 h-5" />
                    <!-- <Badge v-if="item.guests.pets" :color="item.guests.pets ? 'amazon' : 'bittersweet'">{{__('Pets')}}</Badge> -->
                </div>
                <template #content>
                    <div class="">
                        <p>{{ item.guests.adults }} {{ __('Adult',item.guests.adults)}}</p>
                        <p>{{ item.guests.children }} {{ __('Child',item.guests.children)}}</p>
                        <Badge v-if="item.guests.pets" :color="item.guests.pets ? 'amazon' : 'bittersweet'">{{__('Pets')}}</Badge>
                    </div>
                </template>
            </Popover>
        </td>
        <td class="px-6 py-4 relative overflow-visible">
            <Popover :key="`reservationMessagePopover${item.id}`" :title="__('Message')">
                {{ item?.excerpt }}
                <template #content>
                    <div class="" v-html="item?.message"></div>
                </template>
            </Popover>
        </td>
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex flex-col items-center justify-center space-y-2 ">
                <Badge :color="item.confirmed_at ? 'amazon' : 'bittersweet'">
                    {{ item.confirmed_at ? __('Confirmed') : __('Not Confirmed') }}
                </Badge>
                <Badge :color="item.payment_received_at ? 'amazon' : 'bittersweet'">
                    {{ item.payment_received_at ? __('Received') : __('Not Received') }}
                </Badge>
            </div>
        </td>
<!--         <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center justify-center ">
                <Badge :color="item.payment_received_at ? 'amazon' : 'bittersweet'">
                    {{ item.payment_received_at ? __('Received') : __('Not Received') }}
                </Badge>
            </div>
        </td> -->

        <td class="px-6 py-4">
            <div class="flex space-x-2 items-center">
                <Tooltip :key="`showReservationTooltip${item.id}`" :text="__('Show')">
                    <button class="text-primary-700 dark:text-primary-800" @click="$inertia.get(route('admin.reservations.show', item))">
                        <icons.EyeIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`rejectReservationTooltip${item.id}`" :text="__('Reject')" v-if="item.confirmed_at">
                    <button class="text-bittersweet-700 dark:text-bittersweet-800" @click="reject">
                        <icons.CloseCircleIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`approveReservationTooltip${item.id}`" :text="__('Approve')" v-else>
                    <button class="text-amazon-600 dark:text-amazon-700" @click="approve">
                        <icons.CheckIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`deleteReservationTooltip${item.id}`" :text="__('Delete')">
                    <button class="text-bittersweet-700 dark:text-bittersweet-800" @click="showDestroyConfirm = true">
                        <icons.TrashBinIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
            </div>

        </td>
    </TableRow>
    <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false" @confirmed="destroy" :form="form"
        busy-text="Deleting" recently-successful-text="Reservation deleted" button-text="Yes Delete reservation">
        <template #icon>
            <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This will permanently delete reservation from database.')}}</p>
            <!-- <div class="p-4">
                <p>{{ item.owner?.name }} {{ __('wrote') }}:</p>
                <article v-html="item.text" />
            </div> -->
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This action is not reversable!')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('Are you sure you want to do this?')}}</p>
        </template>

    </ConfirmationModal>
</template>
