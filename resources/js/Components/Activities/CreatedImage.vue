<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Created new image') }}
        {{ __('named') }}

        <inertia-link :href="`/admin/images/${item?.subject?.slug}`"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            <span>{{ item?.subject?.name }}</span>
        </inertia-link>
    </div>
</template>
