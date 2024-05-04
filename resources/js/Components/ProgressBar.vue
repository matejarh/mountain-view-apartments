<script setup>
defineProps({
    progress: {
        type: Number,
        default: 0,
    }
})
</script>

<template>
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="bg-amazon-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                :style="`width: ${progress}%`"> {{ progress }}%</div>
        </div>
</template>
