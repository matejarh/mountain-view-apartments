<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'

defineProps({
    show: Boolean,
    user: Object
})

defineEmits(['close'])
</script>

<template>
    <DialogModal :show="show" @close="$emit('close')">
        <template #title>{{ __('Edit user') }} {{ user.name }}</template>
        <template #content>Form</template>
        <template #footer>Footer</template>
    </DialogModal>
</template>
