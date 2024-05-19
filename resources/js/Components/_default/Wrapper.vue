<script setup>
defineProps({
    size: {
        default: 'xl',
        type: String,
    }
})
</script>
<template>
    <section class="relative">
        <div :class="`py-8 lg:py-16 mx-auto max-w-screen-${size} px-4`">
            <slot />
        </div>
    </section>
</template>
