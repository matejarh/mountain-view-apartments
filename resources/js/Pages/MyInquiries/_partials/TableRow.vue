<script setup>
import TableRow from '@/Components/TableRow.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import Popover from '@/Components/_default/Popover.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Badge from '@/Components/_default/Badge.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { icons } from '@/icons';

const props = defineProps({
    item: Object,
})


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
            {{ item.date }}
        </td>

        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-sm" :src="item?.property.avatar_url"
                    :alt="item?.property?.title[$page.props?.locale] + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ item?.property?.title[$page.props?.locale] }}
                    </div>

                </div>
            </div>
        </td>

        <td class="px-6 py-4">
            <p class="font-semibold uppercase">{{ item.subject }}</p>
            <span v-html="item.message"></span>
        </td>
        <td class="px-6 py-4 relative overflow-visible">
                <p>
                    {{ item.adults }} {{ __('Adult', item.adults) }}
                </p>
                <p>
                    {{ item.children }} {{ __('Child', item.children) }} & {{ item.pets ? 'Pets' : 'No pets' }}
                </p>
        </td>
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <!-- <div class="flex items-center justify-center ">
                <Badge :color="item.approved_at ? 'amazon' : 'bittersweet'">
                    {{ item.approved_at ? __('Approved') : __('Not Approved') }}
                </Badge>
            </div> -->
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            {{ item.created_at_human_readable }}
        </td>
        <!-- <td class="sticky right-0 px-6 py-4 bg-white dark:bg-gray-800">
            <div class="flex space-x-2 items-center">
                <Tooltip :key="`showReviewTooltip${item.id}`" :text="__('Show')">
                    <button class="text-primary-700 dark:text-primary-800" @click="$inertia.get(route('admin.reviews.show', item))">
                        <icons.EyeIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
            </div>

        </td> -->
    </TableRow>
</template>
