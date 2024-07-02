<script setup>
import TableRow from '@/Components/TableRow.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import Popover from '@/Components/_default/Popover.vue';

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { getFormattedDate } from '@/utils/date';
import Checkbox from '@/Components/Checkbox.vue';
/* import InquiryEditDialog from './InquiryEditDialog.vue'; */
import { icons } from '@/icons';

const props = defineProps({
    item: Object,
})

defineEmits(['show', 'reply'])

const form = useForm({})

const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.inquiries.destroy', props.item), {
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
                <Checkbox id="checkbox-all" :id="`checkbox-${item?.id}`" />

                <label :for="`checkbox-${item?.id}`" class="sr-only">{{ __('checkbox') }}</label>
            </div>
        </td>

        <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full" :src="item.owner ? item.owner.profile_photo_url : item.avatar_url"
                    :alt="item.owner ? item.owner.name : item.name + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold flex space-x-2">
                        <p>

                            {{ item.name }}
                        </p>
                        <span class="flex items-center">
                            <icons.MobileIcon class="w-4 h-4" />
                            <i><small>
                                    {{ item.phone }}
                                </small></i>
                        </span>
                    </div>
                    <div class="font-normal text-gray-500 dark:text-gray-300">{{ item?.email }}</div>
                </div>
            </div>
        </th>

        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-lg" :src="item.property?.avatar_url"
                    :alt="item.property?.name + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ item.property?.title[$page.props?.locale] }}</div>

                </div>
            </div>
        </td>

        <td class="px-6 py-4">
            <Popover :key="`inquiryMessagePopover${item.id}`" :title="__('Inquiry Message')">
                {{ item?.subject }}
                <template #content>
                    <div class="" v-html="item?.message"></div>

                </template>
            </Popover>
        </td>
        <td class="px-6 py-4 ">
            <div class="flex flex-col">
                <div class="flex">
                    <p class="whitespace-nowrap">{{ item.adults }} {{ __('Adult', item.adults) }}</p>,
                    <p class="whitespace-nowrap" v-if="item.children > 0">{{ item.children }} {{ __('Child',
                        item.children)
                        }}
                    </p>

                </div>
                <p class="whitespace-nowrap" v-if="item.pets">{{ __('Pet') }}</p>
            </div>
        </td>
        <td class="px-4 py-2  text-gray-900 whitespace-nowrap dark:text-white">
            <time :datetime="item.created_at">
                {{ getFormattedDate(item.created_at, $page.props.locale) }}
            </time>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <time :datetime="item.created_at">
                {{ getFormattedDate(item.read_at, $page.props.locale) }}
            </time>
        </td>
        <!--         <td class="px-6 py-4 whitespace-nowrap">
            <time :datetime="item.updated_at">
                {{ getFormattedDate(item.updated_at, $page.props.locale) }}
            </time>
        </td> -->
        <td class="px-6 py-4 sticky right-0 bg-white dark:bg-gray-700">
            <div class="flex space-x-2 items-center">

                <Tooltip :key="`showInquiryTooltip${item.id}`" :text="__('Show')">
                    <button class="text-primary-700 dark:text-primary-600" @click="$emit('show', item)">
                        <icons.EyeIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`deleteInquiryTooltip${item.id}`" :text="__('Reply')">
                    <button class="text-amazon-500 dark:text-amazon-400" @click="$emit('reply', item)">
                        <icons.ReplyIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`deleteInquiryTooltip${item.id}`" :text="__('Delete')">
                    <button class="text-bittersweet-700 dark:text-bittersweet-600" @click="showDestroyConfirm = true">
                        <icons.TrashBinIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
            </div>

        </td>
    </TableRow>

    <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false"
        @confirmed="destroy" :form="form" busy-text="Deleting" recently-successful-text="Inquiry deleted"
        button-text="Yes Delete Inquiry">

        <template #icon>

            <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />

        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('This will permanently delete inquiry from database.') }}</p>

            <div class="p-4">
                <p class="italic text-lg font-bold">{{ item.name }} {{ __('wrote') }}:</p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mt-4">
                    <p class="font-semibold text-lg">{{ item.subject }}</p>
                    <article v-html="item.message"></article>
                </div>
            </div>

            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('This action is not reversable!') }}</p>

            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('Are you sure you want to do this?') }}</p>

        </template>


    </ConfirmationModal>
    <!-- <InquiryEditDialog :show="showInquiryEditDialog" @close="showInquiryEditDialog = false" :user="user" /> -->
</template>
