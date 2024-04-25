<script setup>
import SectionTitle from './SectionTitle.vue';
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

        <div class="mt-5 md:mt-0 md:col-span-2 max-w-screen-xl">
            <div class="space-y-4 px-4 py-5 sm:p-6 bg-white dark:bg-gray-900 text-gray-950 dark:text-gray-50 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold">
                    <slot name="title" />
                </h1>
                <p>
                    <slot name="description" />
                </p>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
