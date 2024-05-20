<script setup>
import HeartIcon from '@/Icons/HeartIcon.vue';

import { computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Tooltip from '../Tooltip.vue';
import { useReCaptcha } from 'vue-recaptcha-v3';
import formatNumber from '@/mixins/numberToKilo'

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
    return props.item?.is_liked ? 'bg-bittersweet-600 focus:ring-bittersweet-100 focus:outline-bittersweet-500 text-white dark:focus:ring-bittersweet-700 dark:border-bittersweet-600' : 'text-gray-900  bg-white border-gray-200 hover:bg-bittersweet-600 hover:text-white focus:ring-bittersweet-100 focus:outline-bittersweet-500 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700'
})
</script>

<template>
    <div class="">
        <Tooltip :text="__(likeButtonText)">
            {{ }}
            <button @click="recaptcha" title="" :class="likedClasses"
                class="flex relative items-center justify-center py-2.5 px-5 text-sm font-medium focus:outline-none border focus:z-10 focus:ring-4 rounded-lg "
                role="button">
                <HeartIcon class="w-5 h-5 -ms-2 me-2" />
                {{ item?.is_liked ? __('Liked') : __('Like') }}

                <div
                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-bittersweet-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-50">
                    {{ formatNumber(item.likes_count) }}
                </div>
            </button>
        </Tooltip>

    </div>
</template>
