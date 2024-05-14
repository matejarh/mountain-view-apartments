<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { reactive, ref, watchEffect } from 'vue';
import FacilityComponent from './FacilityComponent.vue';
import { useForm } from '@inertiajs/vue3';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';

const emit = defineEmits(['close', 'updated'])

const props = defineProps({
    show: Boolean,
    property: Object,
})

const form = useForm({
    name: '',
    text: ''
})
const store = () => {
    form.clearErrors()
    form.post(route('admin.facilities.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}


</script>

<template>
    <DialogModal max-width="7xl" :show="show" @close="$emit('close')">
        <template #title>{{ __('Manage Facilities') }}</template>

        <template #content>
            <div class="grid sm:grid-cols-2 gap-6">
                <div class="order-2 sm:order-1 sm:text-right relative " >
                    <h5 class="font-bold">
                        {{ __('Attached') }}

                    </h5>
                    <TransitionGroup name="list-detach" tag="ul" class="flex flex-wrap sm:justify-end">

                        <li class="right-0 block mb-2" v-for="facility, key in property.facilities" :key="facility.id">

                            <FacilityComponent :key="facility.id" :facility="facility" direction="detach" />
                        </li>
                    </TransitionGroup>
                </div>
                <div class="relative order-1 sm:order-2">
                    <h5 class="font-bold">
                        {{ __('Not attached') }}

                    </h5>
                    <TransitionGroup name="list-attach" tag="ul" class="flex flex-wrap ">
                        <li class="left-0 block mb-2" v-for="facility, key in $page.props.facilities_not_in_property"
                            :key="facility.id">
                            <FacilityComponent :key="facility.id" :facility="facility" direction="attach" />
                        </li>
                    </TransitionGroup>

                    <div class="" v-if="$page.props.facilities_not_in_property.length <= 0">
                        {{ __('All facilities are attached to property') }}
                    </div>

                    <hr class="my-4 md:my-4 border-gray-200 dark:border-gray-800 col-span-full" />

                    <div class="">
                        <InputLabel for="name" :value="`${__('Create New Facility')}`" />
                        <div class="flex">
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                                autocomplete="name" :has-error="!!form.errors.name"
                                :placeholder="__('Enter new facility name') + '...'" />

                                <PrimaryButton type="button"
                                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                                :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="store">
                                <div class="flex items-center">
                                    <SpinnerIcon v-if="form.processing"
                                    class="animate-spin h-5 w-5 text-white dark:text-white" />
                                    <CirclePlusIcon v-else class="h-5 w-5 text-white dark:text-white"  />
                                </div>
                            </PrimaryButton>
                        </div>
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                </div>
            </div>
        </template>



    </DialogModal>
</template>

<style scoped>
.list-attach-move,
/* apply transition to moving elements */
.list-attach-enter-active,
.list-attach-leave-active {
    transition: all 0.5s ease;
}

.list-attach-enter-from,
.list-attach-leave-to {
    opacity: 0;
    transform: translateX(-100px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-attach-leave-active {
    position: absolute;
}


.list-detach-move,
/* apply transition to moving elements */
.list-detach-enter-active,
.list-detach-leave-active {
    transition: all 0.5s ease;
}

.list-detach-enter-from,
.list-detach-leave-to {
    opacity: 0;
    transform: translateX(100px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-detach-leave-active {
    position: absolute;
}
</style>
