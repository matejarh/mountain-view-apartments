<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-bittersweet-600">
            {{ message }}
        </p>
    </div>
</template>
