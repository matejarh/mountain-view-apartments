<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { icons } from '@/icons';
import { getLocalizedDate } from '@/utils/date';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, watchEffect } from 'vue';

const props = defineProps({
    show: Boolean,
    item: Object
})

const page = usePage()

const emit = defineEmits(['close', 'reply'])

const form = useForm({

})

const formatdDate = (date) => {
    return new Date(date).toLocaleDateString(page.props?.locale)
}


watchEffect(() => {
    if (props.show) {
        // populateForm()
    }
})
</script>

<template>
    <DialogModal :show="show" @close="$emit('close')">
        <template #title>{{ __('Showing Iquiry From ') }} {{ item.name }}</template>
        <template #content>
            <div class="">
                <p>
                    <b>{{ item.name }}</b> is interested in renting <b>{{ item.property.title[$page.props.locale]
                        }}</b><br> from {{ formatdDate(item.date[0]) }} to {{ formatdDate(item.date[1]) }}

                </p>
                <p class="mt-0">
                    for {{ item.adults }} {{ __('Adult', item.adults) }}
                    <span v-if="item.children > 0">
                        , {{ item.children }} {{ __('Child', item.children) }}
                    </span>
                    <span v-if="item.pets">
                        and a pet or pets
                    </span>
                </p>
                <p class="mt-4 font-semibold">{{ __('Subject') }}</p>
                <p>{{ item.subject }}</p>
                <p class="mt-4 font-semibold">{{ __('Message') }}</p>
                <p>{{ item.message }}</p>
            </div>
        </template>
        <template #footer>
            <PrimaryButton type="button"
                 @click="emit('reply')">
                <div class="flex items-center">

                    <icons.PaperPlane class="rotate-90 -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />

                    {{  __('Reply') }}
                </div>
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
