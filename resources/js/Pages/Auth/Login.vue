<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.clearErrors()
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head :title="__('Log In')" >
        <meta name="robots" content="noindex,nofollow">
    </Head>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <template #title>
            {{ __('Sign in to your account') }}
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-amazon-600">
            {{ status }}
        </div>

        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <div>
                <InputLabel for="email" :has-error="!!form.errors.email">{{ __('Your email') }}</InputLabel>

                <TextInput type="email" name="email" id="email" v-model="form.email"
                    :has-error="!!form.errors.email"
                    class=""
                    :placeholder="__('name@company.com')" required autofocus />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>


            <div>
                <InputLabel for="password" >{{ __('Password') }}</InputLabel>
                <TextInput type="password" name="password" id="password" v-model="form.password" placeholder="••••••••"
                    class=""
                    required />
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <Checkbox v-model:checked="form.remember" name="remember" id="remember" />

                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-300">{{ __('Remember me') }}</label>
                    </div>
                </div>

                <inertia-link v-if="canResetPassword" :href="route('password.request')"
                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('Forgot your password?') }}</inertia-link>
            </div>
            <PrimaryButton class="w-full text-center" type="submit" :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful">
                <div class="flex items-center justify-center w-full">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Logging in') + '...' : form.recentlySuccessful ? __('Logged in') : __('Log in') }}

                </div>
            </PrimaryButton>
            <!-- <button type="submit"
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                {{ __('Log in') }}</button> -->

            <p v-if="$page.props.canRegister" class="text-sm font-light text-gray-500 dark:text-gray-400">
                {{ __('Don’t have an account yet?') }} <inertia-link :href="route('register')"
                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('Sign up')}}</inertia-link>
            </p>
        </form>
    </AuthenticationCard>

</template>
