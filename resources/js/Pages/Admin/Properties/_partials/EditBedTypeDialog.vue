<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { reactive, ref, watchEffect } from 'vue';

const emit = defineEmits(['close', 'updated'])

const props = defineProps({
    show: Boolean,
    bedType: Object,
})

watchEffect(() => {
    if (props.show) {
        form.name = props.bedType.name
        form.title = props.bedType.title
        form.icon = props.bedType.icon
    }
})

const form = reactive({
    name: props.bedType?.name,
    title: props.bedType?.title,
    icon: props.bedType?.icon,
})


</script>

<template>
    <DialogModal max-width="xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Edit') }} {{ __(bedType.title) }}</template>

        <template #content>
            <div class="">
                <InputLabel for="title" :value="`${__('Title')}`" />
                <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                    autocomplete="title" :placeholder="__('Enter title') + '...'" />
            </div>
            <div class="mt-2">
                <InputLabel for="name" :value="`${__('Name')}`" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                    autocomplete="name" :placeholder="__('Enter name') + '...'" />
            </div>
            <div class="mt-2">
                <InputLabel for="icon" :value="`${__('Icon')}`" />
                <SelectInput v-model="form.icon" id="icon">
                    <option disabled>- {{ __('select icon') }} -</option>
                    <option value="QueenBedIcon">{{ __('Queen Bed') }}</option>
                    <option value="SofaBedIcon">{{ __('Sofa Bed') }}</option>
                </SelectInput>
            </div>
        </template>

        <template #footer>
            <PrimaryButton type="button" @click="emit('updated', [form, bedType.key]), emit('close')">
                <div class="flex items-center">

                    {{ __('Save') }}

                </div>
            </PrimaryButton>
        </template>

    </DialogModal>
</template>
