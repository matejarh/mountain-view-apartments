<script setup>
import { ref, computed, watch, watchEffect } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ConfirmsPassword from '@/Components/ConfirmsPassword.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Tooltip from '@/Components/Tooltip.vue';
import GALogo from '/resources/images/branding/google_authenticator-logo.png'
import TwoFactorCodeInput from '@/Components/Authentication/TwoFactorCodeInput.vue';
import SegmentedInput from '@/Components/SegmentedInput.vue';

const props = defineProps({
    requiresConfirmation: Boolean,
});

const page = usePage();
const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: '',
});

const twoFactorEnabled = computed(
    () => !enabling.value && page.props?.auth.user?.two_factor_enabled,
);

watch(twoFactorEnabled, () => {
    if (!twoFactorEnabled.value) {
        confirmationForm.reset();
        confirmationForm.clearErrors();
    }
});

const enableTwoFactorAuthentication = () => {
    enabling.value = true;
    confirmationForm.clearErrors();
    router.post(route('two-factor.enable'), {}, {
        preserveScroll: true,
        onSuccess: () => Promise.all([
            showQrCode(),
            showSetupKey(),
            showRecoveryCodes(),
        ]),
        onFinish: () => {
            enabling.value = false;
            confirming.value = props.requiresConfirmation;
        },
    });
};

const showQrCode = () => {
    return axios.get(route('two-factor.qr-code')).then(response => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return axios.get(route('two-factor.secret-key')).then(response => {
        setupKey.value = response.data.secretKey;
    });
}

const showRecoveryCodes = () => {
    return axios.get(route('two-factor.recovery-codes')).then(response => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirming.value = true;
    confirmationForm.clearErrors();
    confirmationForm.post(route('two-factor.confirm'), {
        errorBag: "confirmTwoFactorAuthentication",
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
        },
        onFinish: () => {
            // codeSplited.value = [];
            confirmationForm.reset()
        },
        onError: () => {
            confirmationForm.code = ''
        }
    });
};

const regenerateRecoveryCodes = () => {
    axios
        .post(route('two-factor.recovery-codes'))
        .then(() => showRecoveryCodes());
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    router.delete(route('two-factor.disable'), {
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
        },
    });
};
</script>

<template>
    <ActionSection>
        <template #title>
            {{ __('Two Factor Authentication') }}
        </template>

        <template #description>
            {{ __('Add additional security to your account using two factor authentication.') }}
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled && !confirming" class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('You have enabled two factor authentication.') }}
            </h3>

            <h3 v-else-if="twoFactorEnabled && confirming" class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Finish enabling two factor authentication.') }}
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('You have not enabled two factor authentication.') }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-200">
                <p>
                    {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.')}}
                </p>

                <div class="flex mt-4">
                    <Tooltip :text="__('Download Google Authenticator')">
                        <div class="mx-auto text-center">

                            <a target="_blank" class="relative text-primary-600"
                                href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&pli=1">
                                    <img :src="GALogo" class="w-16 h-16 mx-auto hover:rotate-180 transform ease-in-out duration-300">
                                    {{ __('Download Google Authenticator') }}
                                </a>
                        </div>
                    </Tooltip>

                </div>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p v-if="confirming" class="font-semibold">
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.')}}
                        </p>

                        <p v-else>
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.')}}
                        </p>
                    </div>

                    <div class="mt-4 p-2 inline-block bg-white" v-html="qrCode" />

                    <div v-if="setupKey" class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Setup Key') }}: <span v-html="setupKey"></span>
                        </p>
                    </div>

                    <div v-if="confirming" class="mt-4">
                        {{confirmationForm.code}}
                        <InputLabel for="code" :value="__('Code')" />

                        <SegmentedInput :digits="6" v-model="confirmationForm.code" :error="confirmationForm.errors.code" @submit="confirmTwoFactorAuthentication" />

                        <InputError :message="confirmationForm.errors.code" class="mt-2" />
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0 && !confirming">
                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-300">
                        <p class="font-semibold">
                            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.')}}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-950 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <ConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                        <PrimaryButton type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            {{ __('Enable') }}
                        </PrimaryButton>
                    </ConfirmsPassword>
                </div>

                <div v-else>
                    <ConfirmsPassword @confirmed="confirmTwoFactorAuthentication">
                        <PrimaryButton v-if="confirming" type="button" class="me-3" :class="{ 'opacity-25': enabling }"
                            :disabled="enabling">
                            {{ __('Confirm') }}
                        </PrimaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="regenerateRecoveryCodes">
                        <SecondaryButton v-if="recoveryCodes.length > 0 && !confirming" class="me-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="showRecoveryCodes">
                        <SecondaryButton v-if="recoveryCodes.length === 0 && !confirming" class="me-3">
                            {{ __('Show Recovery Codes') }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <SecondaryButton v-if="confirming" :class="{ 'opacity-25': disabling }" :disabled="disabling">
                            {{ __('Cancel') }}
                        </SecondaryButton>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <DangerButton v-if="!confirming" :class="{ 'opacity-25': disabling }" :disabled="disabling">
                            {{ __('Disable') }}
                        </DangerButton>
                    </ConfirmsPassword>
                </div>
            </div>
        </template>
    </ActionSection>
</template>
