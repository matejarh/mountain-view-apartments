<script setup>
defineProps({
    to: {
        default: '/',
        type: [String, undefined],
    },
    as: {
        default: 'link',
        type: String
    }
})
</script>

<template>
    <li>
        <inertia-link v-if="as === 'link'" :href="to"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100  dark:text-white  dark:hover:bg-gray-700 dark:hover:text-white dark:border-gray-700"
            :class="{ 'bg-primary-700 text-white hover:bg-primary-600 dark:bg-primary-800 dark:hover:bg-primary-700 shadow-lg': $page.url.startsWith(to) }" aria-current="page">
            <slot />
        </inertia-link>

        <button v-else
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100  dark:text-white  dark:hover:bg-gray-700 dark:hover:text-white dark:border-gray-700"
            >
            <slot />
        </button>
    </li>
</template>
