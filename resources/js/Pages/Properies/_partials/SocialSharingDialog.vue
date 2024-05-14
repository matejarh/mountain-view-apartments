<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import SocialSharing from '@/Components/_default/SocialSharing.vue';
import ShareNodesIcon from '@/Icons/ShareNodesIcon.vue';

defineProps({
    show: Boolean
})

defineEmits(['close'])
</script>

<template>
    <DialogModal max-width="xl" :show="show" @close="$emit('close')">
        <template #title>
            <div class="flex items-center space-x-2">
                <ShareNodesIcon />
                <span>

                    {{ __('Share to social media') }}
                </span>

            </div>
        </template>

        <template #content>

                <SocialSharing />


        </template>
    </DialogModal>
</template>
