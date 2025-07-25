<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SegmentedInput from '@/Components/SegmentedInput.vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.clearErrors()
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head :title="__('Two-factor Confirmation')" >
        <meta name="robots" content="noindex,nofollow">
    </Head>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-200">
            <template v-if="! recovery">
                {{__('Please confirm access to your account by entering the authentication code provided by your authenticator application.')}}
            </template>

            <template v-else>
                {{__('Please confirm access to your account by entering one of your emergency recovery codes.')}}
            </template>
        </div>

        <form @submit.prevent="submit">
            <div v-if="! recovery">
                <InputLabel :has-error="form.errors.code" for="code" :value="__('Code')" />

                <SegmentedInput id="code" ref="codeInput" :digits="6" v-model="form.code" :error="form.errors.code" @submit="submit" />
                <!-- <TextInput
                    id="code"
                    ref="codeInput"
                    v-model="form.code"
                    type="text"
                    inputmode="numeric"
                    class="mt-1 block w-full"
                    autofocus
                    autocomplete="one-time-code" :has-error="form.errors.code"
                /> -->
                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            <div v-else>
                <InputLabel :has-error="form.errors.code" for="recovery_code" :value="__('Recovery Code')" />
                <TextInput
                    id="recovery_code"
                    ref="recoveryCodeInput"
                    v-model="form.recovery_code"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="one-time-code" :has-error="form.errors.recovery_code"
                />
                <InputError class="mt-2" :message="form.errors.recovery_code" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100 underline cursor-pointer" @click.prevent="toggleRecovery">
                    <template v-if="! recovery">
                        {{__('Use a recovery code')}}
                    </template>

                    <template v-else>
                        {{__('Use an authentication code')}}
                    </template>
                </button>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{__('Log in')}}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
