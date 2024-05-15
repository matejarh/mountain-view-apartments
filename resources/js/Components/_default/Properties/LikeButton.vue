<script setup>
import HeartIcon from '@/Icons/HeartIcon.vue';

import { computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Tooltip from '../Tooltip.vue';
const props = defineProps({
    item: Object,
})

const page = usePage()

const likeButtonText = computed(() => {
    return (!props.item.is_liked ? 'Like ' : 'Unlike ') + props.item?.title[page.props.locale]
})

const likeForm = useForm({})

const like = () => {
    likeForm.post(route('properties.like', props.item))
}

</script>

<template>
    <div class="">
        <Tooltip :text="__(likeButtonText)">
            {{  }}
            <button @click="like" title=""
                class="flex relative items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                role="button">
                <HeartIcon class="w-5 h-5 -ms-2 me-2" />
                {{ item?.is_liked ? __('Liked') : __('Like') }}

                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                    {{ item.likes_count }}
                </div>
            </button>
        </Tooltip>

    </div>
</template>
