<script setup>
defineProps({
    href: { type: String, default: null },
    as: {
        default: 'link',
        type: String
    }
})
defineEmits(['click'])
</script>

<template>
    <li v-if="as === 'link'">
        <inertia-link :href="href"
            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
            role="menuitem">
            <div class="inline-flex items-center">
                <slot name="icon" v-if="$slots.icon" />
                <slot />
            </div>
        </inertia-link>
    </li>
    <li v-if="as === 'button'">
        <button @click="$emit('click')"
            class="block w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
            role="menuitem">
            <div class="inline-flex items-center">
                <slot name="icon" v-if="$slots.icon" />
                <slot />
            </div>
        </button>
    </li>
</template>
