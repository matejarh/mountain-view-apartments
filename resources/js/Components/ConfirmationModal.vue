<script setup>
import CloseIcon from '@/Icons/CloseIcon.vue';
import DangerButton from './DangerButton.vue';
import Modal from './Modal.vue';
import PrimaryButton from './PrimaryButton.vue';
import SecondaryButton from './SecondaryButton.vue';
import CloseModalButton from './CloseModalButton.vue';


const emit = defineEmits(['close', 'confirmed']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    form: {
        type: Object,
    },
    busyText: {
        default: 'Processing',
        type: String,
    },
    recentlySuccessfulText: {
        default: 'Processed',
        type: String,
    },
    buttonText: {
        default: 'Yes, I\'m sure',
        type: String,
    },
    isDanger: {
        type: Boolean,
        default: true,
    }
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">

        <!-- Modal content -->
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 select-none">
            <CloseModalButton @close="close" />
            <slot name="icon" />
            <slot name="content" />

            <div class="flex justify-center items-center space-x-4">
                <SecondaryButton @click="close" type="button" :disabled="form.processing || form.recentlySuccessful"
                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }">
                    {{ __('No, cancel') }}
                </SecondaryButton>
                <DangerButton v-if="isDanger" type="button" @click="$emit('confirmed')"
                    :disabled="form.processing || form.recentlySuccessful"
                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }">
                    {{ form.processing ? __(busyText) + '...' : form.recentlySuccessful ? __(recentlySuccessfulText) :
                        __(buttonText) }}
                </DangerButton>
                <PrimaryButton v-else type="button" @click="$emit('confirmed')"
                    :disabled="form.processing || form.recentlySuccessful"
                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful }">
                    {{ form.processing ? __(busyText) + '...' : form.recentlySuccessful ? __(recentlySuccessfulText) :
                        __(buttonText) }}
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
