<script setup>
import SectionTitle from './SectionTitle.vue';

defineProps({
    fullwidth: {
        type: Boolean,
        default: false,
    }
})
</script>

<template>
    <div class="md:grid md:grid-cols-2 md:gap-6">
        <!-- <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle> -->

        <div class="mt-5 md:mt-0 md:col-span-2 " :class="{'max-w-screen-xl' : !fullwidth}">
            <div class="space-y-4 px-4 py-5 sm:p-6 bg-white dark:bg-gray-900 text-gray-950 dark:text-gray-50 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold" v-if="$slots.title">
                    <slot name="title" />
                </h1>
                <p v-if="$slots.description" class="text-gray-500 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 leading-tight p-2 rounded-lg whitespace-pre">
                    <slot name="description" />
                </p>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
