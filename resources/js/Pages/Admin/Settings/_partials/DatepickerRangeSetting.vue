<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import { computed, ref } from 'vue';
import CreateSetting from './CreateSetting.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import CheckCircleIcon from '@/Icons/CheckCircleIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';


const props = defineProps({
    setting: Object,
})

const newSetting = ref({
    name: 'Datepicker range',
    description: 'Set up min and max days available for booking',
    attributes: {
        min: 2,
        max: 7,
    }
})

const showSelectImageDialog = ref(false)

/* const settings = computed(() => {
    if (props.settings.length <= 0) return []

    return props.settings?.filter((setting) => {
        return setting.slug === 'datepicker-range'
    })[0]
}) */

const form = useForm({
    name: props.setting?.name,
    description: props.setting?.description,
    attributes: props.setting?.attributes,
})

const update = () => {
    form.put(route('admin.settings.update', props.setting), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {

        }
    })
}
const selectedAttribute = ref(null)

const handleSelect = (attribute) => {
    selectedAttribute.value = attribute
    showSelectImageDialog.value = true
}
</script>

<template>
    <div class="sm:col-span-1 md:col-span-1 xl:col-span-1 2xl:col-span-1 4xl:col-span-1">

        <ActionSection>
            <template #title>{{ __(setting?.name) }}</template>
            <template #content>

                <CreateSetting v-if="setting?.length <= 0" :setting="newSettings" />

                <div v-else class="grid grid-cols-1 gap-4">

                    <form>
                        <div class="mt-3" v-for="attribute, key in form?.attributes" :key="key">

                            <InputLabel class="capitalize" :value="__(key)" :for="key" />
                            <TextInput :id="key" v-model="form.attributes[key]" type="number" min="2" max="30" step="1"
                                class="mt-1 block w-full" required :autocomplete="key"
                                :has-error="!!form.errors[`attributes.${key}`]"
                                :placeholder="__('Enter ') + key + '...'" />
                            <InputError :message="form.errors[`attributes.${key}`]" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <PrimaryButton type="button"
                                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                                :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="update">
                                <div class="flex items-center">
                                    <SpinnerIcon v-show="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                    {{ form.processing ? __('Updating') + '...' : form.recentlySuccessful ? __('Updated') :
                                    __('Update') }}

                                </div>
                            </PrimaryButton>

                        </div>
                    </form>
                </div>
            </template>
        </ActionSection>
    </div>
</template>
