<script setup>
defineProps({
    href:String,
    as: {
        default: 'link',
        type: String,
    },
    type: {
        default: 'button',
        type: String,
    },

})

defineEmits(['clicked'])
</script>
<template>
    <li>
        <inertia-link v-if="(as === 'link')"
                :href="href"
                class="block py-2 transition-colors px-4 text-sm hover:bg-primary-600 dark:hover:bg-primary-700 hover:text-white dark:text-gray-50 dark:hover:text-white"
                >
            <slot />
        </inertia-link>

        <button v-else-if="(as === 'button' || as === 'submit')"
                :type="type"
                @click="$emit('clicked')"
                class="block animate-colors w-full py-2 px-4 text-sm hover:bg-primary-600 hover:text-white dark:hover:bg-primary-700 dark:text-gray-50 dark:hover:text-white"
                >
            <slot />
        </button>
        <a v-else
                :href="href"
                class="block animate-colors w-full py-2 px-4 text-sm hover:bg-primary-600 hover:text-white dark:hover:bg-primary-700 dark:text-gray-50 dark:hover:text-white"
                >
            <slot />
        </a>
    </li>
</template>
