<script setup>
import { icons } from '@/icons';
import Tooltip from './Tooltip.vue';

defineProps({
    fullwidth: {
        type: Boolean,
        default: false,
    },
    back: {
        default: false,
    }
})

const goBack = () => {
    window.history.back()
}
</script>

<template>
    <div class="md:grid md:grid-cols-2 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2 " :class="{'md:max-w-screen-xl lg:max-w-screen-2xl' : !fullwidth}">
            <div class="space-y-4 px-4 py-5 sm:p-6 bg-white dark:bg-gray-900 text-gray-950 dark:text-gray-50 shadow sm:rounded-lg">
                <div class="flex items-center">
                    <button v-if="back" @click="goBack">
                        <Tooltip :text="__('Back')">
                            <icons.CarretLeftIcon class="w-6 h-6  " />
                        </Tooltip>
                    </button>
                    <h1 class="text-2xl font-bold w-full" v-if="$slots.title">
                        <slot name="title" />
                    </h1>

                </div>
                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                <p v-if="$slots.description" class="text-gray-500 dark:text-gray-300 leading-tight whitespace-pre">
                    <slot name="description" />
                </p>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
