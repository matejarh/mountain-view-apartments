<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !!useSlots().actions);
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

        <div class=" mt-5 md:mt-0 md:col-span-2 max-w-screen-xl">

            <form @submit.prevent="$emit('submitted')">
                <div class="space-y-4 px-4 py-5 bg-white dark:bg-gray-900 text-gray-950 dark:text-gray-50 sm:p-6 shadow"
                    :class="hasActions ? 'sm:rounded-tl-lg sm:rounded-tr-lg' : 'sm:rounded-lg'">
                    <h1 class="text-2xl font-bold">
                        <slot name="title" />
                    </h1>
                    <p>
                        <slot name="description" />
                    </p>
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions"
                    class="flex items-center justify-end px-4 py-3 bg-white dark:bg-gray-900 text-gray-950 dark:text-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
