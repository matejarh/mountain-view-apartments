<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>

    <Head :title="__('Forgot Password')" >
        <meta name="robots" content="noindex,nofollow">
    </Head>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <template #title>
            {{ __('Forgot your password?') }}
        </template>

          <p class="font-light text-gray-500 dark:text-gray-400">{{__('Don\'t fret! Just type in your email and we will send you a code to reset your password!')}}</p>
          <div v-if="status" class="mb-4 font-medium text-sm text-amazon-600">
            {{ status }}
        </div>
          <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" @submit.prevent="submit">
              <div>
                <InputLabel for="email" :has-error="!!form.errors.email" :value="__('Email')" />
                <TextInput id="email" :has-error="!!form.errors.email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus
                    autocomplete="email" :placeholder="__('name@company.com')" />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
              <div class="flex items-start" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                  <div class="flex items-center h-5">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

                  </div>
                  <div class="ml-3 text-sm">
                    <label for="terms" class="font-light text-gray-500 dark:text-gray-300">{{__('I accept the')}} <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">{{__('Terms and Conditions')}}</a></label>
                  </div>
              </div>
              <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('Email Password Reset Link') }}</button>
          </form>
</AuthenticationCard>


<!--     <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <template #title>
            {{ __('Forgot your password?') }}
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')}}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :has-error="!!form.errors.email" :value="__('Email')" />
                <TextInput id="email" :has-error="!!form.errors.email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus
                    autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ __('Email Password Reset Link') }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard> -->
</template>
