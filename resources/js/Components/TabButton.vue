<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    for: String,
    show: String,
})

defineEmits(['clicked'])

const active = computed(() => {
    return props.for === props.show
})

</script>

<template>
    <li>
        <button type="button"
        @click="$emit('clicked')"
        :class="{ 'bg-primary-600 text-white dark:bg-primary-800 hover:text-white hover:bg-primary-600 dark:hover:bg-primary-700' : active }"
        class="transition-colors ease-out duration-300 inline-flex items-center px-4 py-3 rounded-lg active w-full hover:text-gray-900 bg-gray-100 hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white focus:outline-none dark:focus:outline-none focus:ring-2 focus:ring-primary-600 dark:focus:ring-primary-700 focus:ring-offset-2"
        >
            <span :class="{'text-white dark:text-white': active}"  class="transition-colors ease-out duration-300 w-4 h-4 me-2 text-gray-500 dark:text-gray-400">
                <slot name="icon" />
            </span>

            <slot />
        </button>
    </li>
</template>
