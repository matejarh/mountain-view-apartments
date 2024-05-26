<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Has send inquiry about') }}

        <inertia-link :href="route('admin.inquiries.show', item.subject)"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            {{ item?.subject.property_basic_info.title[$page.props?.locale] }}
            <!-- <span>{{ item?.subject?.property.title[$page.props?.locale] }}</span> -->
        </inertia-link>
    </div>
</template>
