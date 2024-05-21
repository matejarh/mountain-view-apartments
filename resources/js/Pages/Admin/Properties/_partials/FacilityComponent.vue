<script setup>
import Tooltip from '@/Components/Tooltip.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import CloseXIcon from '@/Icons/CloseXIcon.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { ref } from 'vue';

const props = defineProps({
    facility: Object,
    direction: String,
})

const page = usePage()

const detachForm = useForm({})

const attachForm = useForm({})

const destroyForm = useForm({})

const showDestroyConfirm = ref(false)

const detach = () => {
    detachForm.put(route('admin.properties.detach.facility', { facility: props.facility, property: page.props?.property }))
}
const attach = () => {
    attachForm.put(route('admin.properties.attach.facility', { facility: props.facility, property: page.props?.property }))
}

const destroy = () => {
    destroyForm.delete(route('admin.facilities.destroy', props.facility))
}

</script>

<template>
    <div class="flex items-center ">
        <span v-if="direction === 'detach'" id="badge-dismiss-green"
            class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-amazon-800 bg-amazon-100 rounded dark:bg-amazon-900 dark:text-amazon-300">
            {{ __(facility.name) }}
            <Tooltip :text="__('Remove')">
                <button type="button" @click="detach"
                    :class="{ 'opacity-25': detachForm.processing || detachForm.recentlySuccessful }"
                    :disabled="detachForm.processing || detachForm.recentlySuccessful"
                    class="inline-flex items-center p-1  ms-2 text-sm text-amazon-400 bg-transparent rounded-sm hover:bg-amazon-200 hover:text-amazon-900 dark:hover:bg-amazon-800 dark:hover:text-amazon-300"
                    aria-label="Remove">
                    <CloseXIcon class="w-2 h-2 " v-show="!detachForm.processing" />
                    <SpinnerIcon v-show="detachForm.processing" class="animate-spin  h-2 w-2 " />
                    <span class="sr-only">{{ __('Remove') }}</span>
                </button>
            </Tooltip>
        </span>
        <span v-if="direction === 'attach'" id="badge-dismiss-red"
            class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-bittersweet-800 bg-bittersweet-100 rounded dark:bg-bittersweet-900 dark:text-bittersweet-300">
            {{ __(facility.name) }}
            <Tooltip :text="__('Attach')">
                <button type="button" @click="attach"
                    :class="{ 'opacity-25': attachForm.processing || attachForm.recentlySuccessful }"
                    :disabled="attachForm.processing || attachForm.recentlySuccessful"
                    class="inline-flex items-center p-1  ms-2 text-sm text-bittersweet-400 bg-transparent rounded-sm hover:bg-bittersweet-200 hover:text-bittersweet-900 dark:hover:bg-bittersweet-800 dark:hover:text-bittersweet-300"
                    aria-label="Attach">
                    <CloseXIcon class="w-2 h-2 rotate-45" v-show="!attachForm.processing" />
                    <SpinnerIcon v-show="attachForm.processing" class="animate-spin  h-2 w-2 " />
                    <span class="sr-only">{{ __('Add') }}</span>
                </button>
            </Tooltip>
            <Tooltip :text="__('Delete')">
                <button type="button" @click="showDestroyConfirm = true"
                    :class="{ 'opacity-25': destroyForm.processing || destroyForm.recentlySuccessful }"
                    :disabled="destroyForm.processing || destroyForm.recentlySuccessful"
                    class="inline-flex items-center p-0  ms-2 text-sm text-bittersweet-400 bg-transparent rounded-sm hover:bg-bittersweet-200 hover:text-bittersweet-900 dark:hover:bg-bittersweet-800 dark:hover:text-bittersweet-300"
                    aria-label="Destroy">

                    <TrashBinIcon class="w-2.5 h-2.5 " v-show="!destroyForm.processing" />
                    <SpinnerIcon v-show="destroyForm.processing" class="animate-spin  h-2 w-2 " />
                    <span class="sr-only">{{ __('Destroy') }}</span>
                </button>
            </Tooltip>
        </span>
    </div>
    <ConfirmationModal :show="showDestroyConfirm" @close="showDestroyConfirm = false" @confirmed="destroy"
        :form="destroyForm" :busy-text="__('Deleting Facility')" :recently-successful-text="__('Facility Deleted')">
        <template #icon>
            <TrashBinIcon class=" text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">{{ __('This will remove facility from the server.')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-sm">{{ __('This facility will also be removed from all other properties!')}}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-sm">{{ __('Are you sure you want to do this?')}}</p>
        </template>
    </ConfirmationModal>
</template>
