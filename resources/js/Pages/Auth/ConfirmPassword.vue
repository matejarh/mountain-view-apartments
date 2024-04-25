<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>

    <Head :title="__('Secure Area')" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <template #title>
            {{ __('Confirm password') }}
        </template>

        <div class="font-light text-gray-500 dark:text-gray-400">
            {{ __("This is a secure area of the application. Please confirm your password before continuing.") }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel :has-error="form.errors.password" for="password" :value="__('Password')" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" required autocomplete="current-password" autofocus :has-error="form.errors.password" />
                <InputError :message="form.errors.password" />
            </div>


            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="w-full  mt-4 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{__('Confirm')}}</button>
        </form>
    </AuthenticationCard>
</template>
