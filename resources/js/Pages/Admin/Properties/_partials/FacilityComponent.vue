<script setup>
import Tooltip from '@/Components/Tooltip.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import XIcon from '@/Icons/XIcon.vue';
import { useForm } from '@inertiajs/vue3';

defineProps({
    facility: Object,
    direction: String,
})

const dForm = useForm({})

const aForm = useForm({})

const detach = (facility, property) => {
    dForm.put(route('admin.properties.detach.facility', { facility: facility, property: property }))
}
const attach = (facility, property) => {
    aForm.put(route('admin.properties.attach.facility', { facility: facility, property: property }))
}

</script>

<template>
    <div class="flex items-center ">
        <span v-if="direction === 'detach'" id="badge-dismiss-green"
            class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-amazon-800 bg-amazon-100 rounded dark:bg-amazon-900 dark:text-amazon-300">
            {{ __(facility.name) }}
            <Tooltip :text="__('Remove')">
                <button type="button" @click="detach(facility, $page.props.property)"
                    :class="{ 'opacity-25': dForm.processing || dForm.recentlySuccessful }"
                    :disabled="dForm.processing || dForm.recentlySuccessful"
                    class="inline-flex items-center p-1  ms-2 text-sm text-amazon-400 bg-transparent rounded-sm hover:bg-amazon-200 hover:text-amazon-900 dark:hover:bg-amazon-800 dark:hover:text-amazon-300"
                    aria-label="Remove">
                    <XIcon class="w-2 h-2 " v-show="!dForm.processing" />
                    <SpinnerIcon v-show="dForm.processing" class="animate-spin  h-2 w-2 " />
                    <span class="sr-only">{{ __('Remove badge') }}</span>
                </button>
            </Tooltip>
        </span>
        <span v-if="direction === 'attach'" id="badge-dismiss-red"
            class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-bittersweet-800 bg-bittersweet-100 rounded dark:bg-bittersweet-900 dark:text-bittersweet-300">
            {{ __(facility.name) }}
            <Tooltip :text="__('Add')">
                <button type="button" @click="attach(facility, $page.props.property)"
                    :class="{ 'opacity-25': aForm.processing || aForm.recentlySuccessful }"
                    :disabled="aForm.processing || aForm.recentlySuccessful"
                    class="inline-flex items-center p-1  ms-2 text-sm text-bittersweet-400 bg-transparent rounded-sm hover:bg-bittersweet-200 hover:text-bittersweet-900 dark:hover:bg-bittersweet-800 dark:hover:text-bittersweet-300"
                    aria-label="Remove">
                    <XIcon class="w-2 h-2 rotate-45" v-show="!aForm.processing" />
                    <SpinnerIcon v-show="aForm.processing" class="animate-spin  h-2 w-2 " />
                    <span class="sr-only">{{ __('Remove badge') }}</span>
                </button>
            </Tooltip>
        </span>
    </div>
</template>
