<script setup>
import { computed, ref } from 'vue';
import ApearDisapearFadeTransition from '@/Transitions/ApearDisapearFadeTransition.vue';
import Tooltip from '../Tooltip.vue';

const props = defineProps({
    direction: {
        default: 'up',
        type: String,
    },
    tooltipText: {
        default: '',
        type: String,
    }
})
const show = ref(false)

const directionClasses = computed(() => {
    return [
        props.direction === 'up' ? 'bottom-0 left-1/2 -translate-x-1/2 -translate-y-7' :
            props.direction === 'down' ? 'top-0 left-0 translate-x-0 translate-y-7' :
                '-translate-x-1/2 -translate-y-7 bottom-0 left-1/2'
    ]
})
</script>

<template>
    <div class="relative">
        <Tooltip :text="tooltipText" :location="direction === 'down' ? 'bottom' : 'top'">
            <button type="button" @click="show = !show"
                class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer transition-colors dark:hover:text-white dark:text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                <slot name="trigger" />
            </button>
        </Tooltip>

        <div v-show="show" class="fixed inset-0 z-40 w-screen h-screen" @click="show = false" />

        <!-- Dropdown -->
        <ApearDisapearFadeTransition>
            <div v-show="show" :class="directionClasses"
                class="z-50 w-48 absolute  transform my-4 text-base list-none bg-white rounded  divide-gray-100 shadow dark:bg-gray-700"
                id="language-dropdown">
                <ul class="py-1" role="none" @click="show = false">
                    <slot />
                </ul>
            </div>
        </ApearDisapearFadeTransition>

    </div>
</template>
