<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import { useForm } from '@inertiajs/vue3';
import EditForm from './EditForm.vue';


const props = defineProps({
    show: Boolean,
})

const emit = defineEmits(['close'])

/* const createForm = useForm({})

const handleAttach = () => {
    emit('close')
    createForm.put(route('admin.pages.store'), {
        errorBag: 'creatingPage',
        onSuccess: () => {
            emit('close')
        }
    })
} */

</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="$emit('close')">
        <template #title>{{ __('Create New Page') }}</template>

        <template #content>
            <EditForm @success="$emit('close')" />
        </template>

    </DialogModal>
</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
