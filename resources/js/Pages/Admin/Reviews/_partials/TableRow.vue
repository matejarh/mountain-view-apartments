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

defineEmits(['edit-review'])

const form = useForm({

})
const approve = () => {
    form.put(route('admin.reviews.approve', props.item), {
        onSuccess: () => {
            form.reset()
        }
    })
}

const reject = () => {
    form.put(route('admin.reviews.reject', props.item), {
        onSuccess: () => {
            form.reset()
        }
    })
}
const showDestroyConfirm = ref(false)

const destroy = () => {
    form.delete(route('admin.reviews.destroy', props.item), {
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
                <img class="w-10 h-10 rounded-sm" :src="item?.reviewed_trimed[0].avatar_url"
                    :alt="item?.reviewed_trimed[0]?.title[$page.props?.locale] + 's image'">
                <div class="ps-3">
                    <div class="text-base font-semibold">{{ item?.reviewed_trimed[0]?.title[$page.props?.locale] }}
                    </div>
                    <div class="font-normal text-gray-500 dark:text-gray-300">{{ item?.owner.email }}</div>
                </div>
            </div>
        </td>

        <td class="px-6 py-4">
            <RatingStars :score="item?.score" :without-text="true" />
        </td>
        <td class="px-6 py-4 relative overflow-visible">
            <Popover :key="`reviewContentPopover${item.id}`" :title="__('Review Content')">
                {{ item?.excerpt }}
                <template #content>
                    <div class="" v-html="item?.text"></div>
                </template>
            </Popover>
        </td>
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center justify-center ">
                <Badge :color="item.approved_at ? 'amazon' : 'bittersweet'">
                    {{ item.approved_at ? __('Approved') : __('Not Approved') }}
                </Badge>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            {{ item.created_at_human_readable }}

        </td>
        <td class="sticky right-0 px-6 py-4 bg-white dark:bg-gray-800">
            <div class="flex space-x-2 items-center">
                <Tooltip :key="`showReviewTooltip${item.id}`" :text="__('Show')">
                    <button class="text-primary-700 dark:text-primary-800" @click="$inertia.get(route('admin.reviews.show', item))">
                        <icons.EyeIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`rejectReviewTooltip${item.id}`" :text="__('Reject')" v-if="item.approved_at">
                    <button class="text-bittersweet-700 dark:text-bittersweet-800" @click="reject">
                        <icons.CloseCircleIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`approveReviewTooltip${item.id}`" :text="__('Approve')" v-else>
                    <button class="text-amazon-600 dark:text-amazon-700" @click="approve">
                        <icons.CheckIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
                <Tooltip :key="`deleteReviewTooltip${item.id}`" :text="__('Delete')">
                    <button class="text-bittersweet-700 dark:text-bittersweet-800" @click="showDestroyConfirm = true">
                        <icons.TrashBinIcon class="w-5 h-5" />
                    </button>
                </Tooltip>
            </div>

        </td>
    </TableRow>
    <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false" @confirmed="destroy" :form="form"
        busy-text="Deleting" recently-successful-text="Review deleted" button-text="Yes Delete review">
        <template #icon>
            <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This will permanently delete review from database.')}}</p>
            <div class="p-4">
                <p>{{ item.owner?.name }} {{ __('wrote') }}:</p>
                <article v-html="item.text" />
            </div>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('This action is not reversable!')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                    {{ __('Are you sure you want to do this?')}}</p>
        </template>

    </ConfirmationModal>
</template>
