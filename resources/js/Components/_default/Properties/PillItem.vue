<script setup>
defineProps({
    item: Object,
    filter: String
})
defineEmits(['clicked'])
</script>

<template>
    <li class="me-2">
        <button type="button" @click="$emit('clicked', item)"
            :class="filter === item.value ? 'text-white bg-primary-600' : 'hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white'"
            class="inline-block px-4 py-3 rounded-lg text-xl  ">
            {{ __(item.name) }}
        </button>
    </li>
</template>
