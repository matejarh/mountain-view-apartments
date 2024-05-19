<script setup>
import StarInput from '@/Components/_default/StarInput.vue';
import Alert from '@/Components/Alert.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TipTapInput from '@/Components/TipTapInput.vue';
import PaperPlane from '@/Icons/PaperPlane.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useReCaptcha  } from "vue-recaptcha-v3";


const form = useForm({
    score: 0,
    text: '',
    captcha_token: null,
})

const page = usePage()

const { executeRecaptcha, recaptchaLoaded, recaptchaInstance } = useReCaptcha()

const hideRecaptchaBadge = () => {
  if (recaptchaInstance.value) {
    recaptchaInstance.value.hideBadge()
  }
}

const recaptcha = async () => {
    await recaptchaLoaded()
    form.captcha_token = await executeRecaptcha('login')
    store();
}

const store = () => {
    form.clearErrors()
    form.post(route('properties.review', page.props.property), {
        errorBag: 'reviewingProperty'
    })
}

onMounted(() => {
  recaptchaLoaded().then(hideRecaptchaBadge)
})


</script>

<template>
    <div size="md" v-if="!$page.props.property.is_reviewed">
        <h2 class="text-4xl font-extrabold text-white dark:text-white">{{ __('Write a review') }}</h2>
        <form method="POST" @submit.prevent="recaptcha">
            <div class="mt-4">
                <StarInput v-model="form.score" class="mx-auto w-full mb-4" />
                <TipTapInput v-model="form.text" :has-error="!!form.errors.text" :has-headings="false" />
                <InputError :message="form.errors.text" />
            </div>
            <div class="mt-4">
                <SecondaryButton type="submit"
                    :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty || !form.text || form.score === 0 | form.text === '' }"
                    :disabled="form.processing || form.recentlySuccessful || !form.isDirty || !form.text || form.score === 0 | form.text === ''">
                    <div class="flex items-center">
                        <SpinnerIcon v-if="form.processing"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-800 dark:text-gray-400"></SpinnerIcon>
                        <PaperPlane v-else="form.processing"
                            class="rotate-90 -ml-1 mr-3 h-5 w-5 text-gray-800 dark:text-gray-400" />
                        {{ form.processing ? __('Submiting') + '...' : form.recentlySuccessful ? __('Submited') :
                            __('Submit')
                        }}

                    </div>
                </SecondaryButton>
            </div>

        </form>
    </div>
    <div class="" v-else>
        <Alert>You have already reviewed {{ $page.props.property.title[$page.props.locale] }}</Alert>
    </div>
</template>
