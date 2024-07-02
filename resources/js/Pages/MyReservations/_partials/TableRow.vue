<script setup>
import TableRow from '@/Components/TableRow.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import Popover from '@/Components/_default/Popover.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Badge from '@/Components/_default/Badge.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { icons } from '@/icons';
import { getLocalizedDate } from '@/utils/date';

const props = defineProps({
    item: Object,
})
const formatDate = (date, locale) => {
    return new Date(date).toLocaleDateString(locale)
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

        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center cursor-pointer" @click="$inertia.get(route('properties.show', { lang: $page.props.locale, property: item.property }))">
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

            <div class="whitespace-nowrap flex">
                <icons.UserIcon class="w-6 h-6" v-for="n in parseInt(item.guests.adults)" />
                <!-- {{ item.guests.adults }} {{ __('Adult',item.guests.adults)}} -->
            </div>
            <p>
                {{ item.nights }} {{ __('Nights')}}
            </p>
            <p>
                {{  parseFloat(item.price).toFixed(2).toLocaleString($page.props.locale) }} €
            </p>
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
                    {{ item.payment_received_at ? __('received') : __('Not Received') }}
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
                <!-- <Tooltip :key="`showReservationTooltip${item.id}`" :text="__('Show')">
                    <button class="text-primary-700 dark:text-primary-800" @click="$inertia.get(route('reservations.show', {lang: $page.props.locale, reservation: item}))">
                        <icons.EyeIcon class="w-5 h-5" />
                    </button>
                </Tooltip> -->
            </div>

        </td>
    </TableRow>
</template>
