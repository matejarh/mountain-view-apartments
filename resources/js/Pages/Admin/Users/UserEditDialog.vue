<script setup>
import { onMounted, ref, watchEffect } from 'vue';
import DialogModal from '@/Components/DialogModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { getCodeList } from 'country-list';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
const props = defineProps({
    show: Boolean,
    user: Object
})

const emit = defineEmits(['close'])

const form = useForm({
    name: '',
    email: '',
    first_name: '',
    last_name: '',
    address: '',
    phone: '',
    country: '',
})

watchEffect(() => {
    if (props.show) {
        populateForm()
    }
})

const populateForm = () => {
    form.name = props.user.name
    form.email = props.user.email
    form.first_name = props.user.first_name
    form.last_name = props.user.last_name
    form.address = props.user.address
    form.phone = props.user.phone
    form.country = props.user.country.toLowerCase()

}

const update = () => {
    if (form.isDirty) {
        form.put(route('admin.users.update', props.user), {
            errorBag: 'updateProfileInformation',
            preserveScroll: true,
            onSuccess: () => emit('close'),
        })
    }
}

onMounted(() => {
    //console.log(getCodeList())
})
</script>

<template>
    <DialogModal :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ __('Edit user') }} {{ user.name }}</template>

        <template #content>
            <div class="grid gap-4 grid-cols-2">

                <div class="col-span-2">
                    <InputLabel :has-error="!!form.errors.name" for="name" :value="__('Name')" />
                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                        autocomplete="name" :has-error="!!form.errors.name" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <InputLabel :has-error="!!form.errors.email" for="email" :value="__('Email')" />
                    <TextInput id="email" v-model="form.email" type="text" class="mt-1 block w-full" required
                        autocomplete="email" :has-error="!!form.errors.email" />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <InputLabel :has-error="!!form.errors.phone" for="phone" :value="__('Phone')" />
                    <TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" required
                        autocomplete="phone" :has-error="!!form.errors.phone" />
                    <InputError :message="form.errors.phone" class="mt-2" />

                </div>
                <div class="col-span-2 sm:col-span-1">
                    <InputLabel :has-error="!!form.errors.first_name" for="first_name" :value="__('First Name')" />
                    <TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full" required
                        autocomplete="first_name" :has-error="!!form.errors.first_name" />
                    <InputError :message="form.errors.first_name" class="mt-2" />

                </div>
                <div class="col-span-2 sm:col-span-1">
                    <InputLabel :has-error="!!form.errors.last_name" for="last_name" :value="__('Last Name')" />
                    <TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" required
                        autocomplete="last_name" :has-error="!!form.errors.last_name" />
                    <InputError :message="form.errors.last_name" class="mt-2" />

                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Country') }}</label>
                    <select id="category" v-model="form.country"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-700 dark:focus:border-primary-700">
                        <option disabled>- {{__('select country')}} -</option>
                        <option :value="code" v-for="country, code in getCodeList()"
                            :selected="form.country === code ? 'selected' : ''">{{ country }}</option>

                    </select>
                </div>
                <div class="col-span-2">
                    <label for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                    <textarea id="address" rows="4"
                        v-model="form.address"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-700 dark:focus:border-primary-700"
                        :placeholder="__('Enter your address')"></textarea>
                </div>
            </div>
        </template>

        <template #footer>
            <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing || form.recentlySuccessful }" :disabled="form.processing || form.recentlySuccessful"
                @click="update">
                <div class="flex items-center">
                    <SpinnerIcon v-show="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving')+'...' : form.recentlySuccessful ? __('Saved') : __('Save') }}

                </div>
            </PrimaryButton>
        </template>

    </DialogModal>
</template>
