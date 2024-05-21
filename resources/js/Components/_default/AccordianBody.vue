<script setup>
defineProps({
    html:String,
    isLast: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
        <div class="transition-all duration-300 ease-out">
            <div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900" :class="{ 'border-b-0' : !isLast }" v-html="html">

            </div>
        </div>
</template>
