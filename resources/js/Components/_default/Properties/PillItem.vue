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
            class="inline-block px-4 py-3 rounded-lg text-xl">
            <div class="flex flex-col leading-5 items-center justify-center">
                {{ __(item.name) }}
                <small v-show="item.line2" class="uppercase">{{ item.line2 }}</small>

            </div>
        </button>
    </li>
</template>
