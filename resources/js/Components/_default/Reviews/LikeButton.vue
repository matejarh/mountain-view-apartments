<script setup>
import HeartIcon from '@/Icons/HeartIcon.vue';

import { computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Tooltip from '../Tooltip.vue';
import { useReCaptcha } from 'vue-recaptcha-v3';
const props = defineProps({
    item: Object,
})

const page = usePage()

const likeButtonText = computed(() => {
    return (!props.item.is_liked ? 'Like ' : 'Unlike ') + props.item?.title[page.props.locale]
})

const likeForm = useForm({
    captcha_token: null
})

const like = () => {
    likeForm.post(route('properties.like', props.item))
}
const { executeRecaptcha, recaptchaLoaded, /* recaptchaInstance */ } = useReCaptcha()

const recaptcha = async () => {
    await recaptchaLoaded()
    likeForm.captcha_token = await executeRecaptcha('login')
    like();
}

const likedClasses = computed(() => {
    return props.item?.is_liked ? 'bg-bittersweet-600 dark:bg-bittersweet-600 hover:text-gray-50 text-white border-white hover:bg-transparent focus:ring-bittersweet-400' : 'hover:text-white text-white border-white hover:bg-bittersweet-600 focus:ring-gray-400'
})
</script>

<template>
    <div class="">

        <button @click="recaptcha" title="" :class="likedClasses"
            class="relative inline-flex justify-center items-center py-3 px-3 sm:ms-4 text-base font-medium text-center  rounded-lg border"
            role="button">
            <div class="">

                <Tooltip :text="__(likeButtonText)">
                    <HeartIcon class="w-8 h-8 " />
                    <!-- {{ item?.is_liked ? __('Liked') : __('Like') }} -->
                </Tooltip>

                <div
                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-bittersweet-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                    {{ item.likes_count }}
                </div>
            </div>
        </button>

    </div>
</template>
