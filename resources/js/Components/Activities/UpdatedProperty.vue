<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Updated property information') }}
        {{ __('for') }}

        <inertia-link :href="`/admin/properties/${item?.subject?.slug}`"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            <span>{{ item?.subject?.title[$page.props?.locale] }}</span>
        </inertia-link>
    </div>
</template>
