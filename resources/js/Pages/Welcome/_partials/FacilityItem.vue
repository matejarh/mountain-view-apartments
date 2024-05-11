<script setup>

</script>

<template>
    <div class="max-w-full   border-0 text-white border-gray-200 rounded-lg dark:border-gray-700 bg-opacity-50 dark:bg-opacity-50">
        <span class="w-full flex flex-col justify-center items-center text-center leading-tight ">
            <slot name="image" />
            <slot />
        </span>
    </div>
</template>
