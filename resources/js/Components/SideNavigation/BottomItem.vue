<script setup>
defineProps({
    href: String,
    active: String,
    animation: {
        type: String,
        default: 'animate-spin'
    }
})
</script>

<template>
    <inertia-link
        :class="{ 'bg-primary-600 hover:bg-primary-500 text-white dark:bg-primary-800 dark:hover:bg-primary-900 hover:text-white dark:hover:text-white dark:text-white': $page.url.startsWith(active) }"
        :href="href"
        class=" inline-flex justify-center p-2 transition-colors text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">

        <div class="" :class="[`hover:${animation}`,{ animation: $page.url.startsWith(active) }]">
            <slot />
        </div>
    </inertia-link>
</template>
