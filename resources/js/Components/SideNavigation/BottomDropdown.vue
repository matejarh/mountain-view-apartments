<script setup>
import { ref } from 'vue';
import ApearDisapearFadeTransition from '@/Transitions/ApearDisapearFadeTransition.vue';

const show = ref(false)
</script>

<template>
    <div class="relative">
        <button type="button" @click="show = !show"
            class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:hover:text-white dark:text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
            <slot name="trigger" />
        </button>


        <div v-show="show" class="fixed inset-0 z-40 w-screen h-screen" @click="show = false" />

        <!-- Dropdown -->
        <ApearDisapearFadeTransition>
            <div v-show="show"
                class="z-50 w-48 absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-7  my-4 text-base list-none bg-white rounded  divide-gray-100 shadow dark:bg-gray-700"
                id="language-dropdown">
                <ul class="py-1" role="none" @click="show = false">
                    <slot />
                </ul>
            </div>
        </ApearDisapearFadeTransition>

    </div>
</template>
