<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Created new page') }}
        {{ __('with title') }}

        <inertia-link :href="`/admin/pages/${item?.subject?.slug}`"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            <span>{{ item?.subject?.title[$page.props?.locale] }}</span>
        </inertia-link>
    </div>
</template>
