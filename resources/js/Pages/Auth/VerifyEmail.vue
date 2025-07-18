<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.clearErrors()
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head :title="__('Email Verification')" >
        <meta name="robots" content="noindex,nofollow">
    </Head>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <template #title>
            {{ __('Verify your email') }}
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-100">
            {{__('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')}}
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-amazon-600 p-4 bg-amazon-100 dark:bg-amazon-50 rounded-lg">
            {{__('A new verification link has been sent to the email address you provided in your profile settings.')}}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex flex-col items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{__('Resend Verification Email')}}
                </PrimaryButton>

                <div>
                    <Link
                        :href="route('profile.show')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-700"
                    >
                        {{__('Edit Profile')}}</Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-700 ms-2"
                    >
                        {{__('Log Out')}}
                    </Link>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
