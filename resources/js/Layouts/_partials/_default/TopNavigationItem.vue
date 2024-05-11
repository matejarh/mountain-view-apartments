<script setup>
defineProps({
    to: {
        default: '/',
        type: String,
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
            activeClass="text-white bg-deep-cerulean-700 md:bg-transparent md:text-deep-cerulean-700  md:dark:text-deep-cerulean-500"
            exactActiveClass="text-white bg-deep-cerulean-700 md:bg-transparent md:text-deep-cerulean-700  md:dark:text-deep-cerulean-500"
            class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-deep-cerulean-700 dark:text-white md:dark:hover:text-deep-cerulean-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            aria-current="page">
            <slot />
        </inertia-link>

        <button v-if="as === 'button'"
            class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-deep-cerulean-700 dark:text-white md:dark:hover:text-deep-cerulean-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        >
            <slot />
        </button>
    </li>
</template>
