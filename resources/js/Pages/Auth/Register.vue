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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.clearErrors()
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="__('Register')" >
        <meta name="robots" content="noindex,nofollow">
    </Head>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <template #title>
            {{ __('Register new account') }}
        </template>

        <form @submit.prevent="submit" class="space-y-4 md:space-y-6">
            <div>
                <InputLabel :has-error="!!form.errors.name" for="name" :value="__('Name')" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                    :has-error="!!form.errors.name"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div>
                <InputLabel :has-error="!!form.errors.email" for="email" :value="__('Email')" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                    :has-error="!!form.errors.email"
                />
                <InputError :message="form.errors.email" />
            </div>

            <div>
                <InputLabel :has-error="!!form.errors.password" for="password" :value="__('Password')" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                    :has-error="!!form.errors.password"
                />
                <InputError :message="form.errors.password" />
            </div>

            <div>
                <InputLabel :has-error="!!form.errors.password_confirmation" for="password_confirmation" :value="__('Confirm Password')" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                    :has-error="!!form.errors.password_confirmation"
                />
                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-start" v-if="$page.props?.jetstream.hasTermsAndPrivacyPolicyFeature">
                <div class="flex items-center h-5">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-light text-gray-500 dark:text-gray-300">{{__('I accept the')}} <inertia-link class="font-medium text-primary-600 hover:underline dark:text-primary-500" :href="route('terms.show')">{{__('Terms and Conditions')}}</inertia-link></label>
                </div>
                <InputError :message="form.errors.terms" />
            </div>

            <PrimaryButton class="w-full text-center" type="submit" :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful">
                <div class="flex items-center justify-center w-full">
                    <SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Creating account') + '...' : form.recentlySuccessful ? __('Account created') : __('Create an account') }}

                </div>
            </PrimaryButton>

            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                {{__('Already have an account?')}} <inertia-link :href="route('login')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{__('Login here')}}</inertia-link>
            </p>


            <!-- <div v-if="$page.props?.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ms-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <button type="submit"
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                {{ __('Log in') }}</button>

            </div> -->
        </form>
    </AuthenticationCard>
</template>
