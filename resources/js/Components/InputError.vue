<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="mt-2 text-sm text-bittersweet-600 dark:text-bittersweet-500">{{ message }}</p>
    </div>
</template>
