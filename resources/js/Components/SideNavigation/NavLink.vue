<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href:String
})
</script>

<template>
    <li>
        <Link :href="href"
            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <div v-if="$slots.icon" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                <slot name="icon" />

            </div>

            <span class="ml-3"><slot /></span>
        </Link>
    </li>
</template>
