<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Updated profile') }}
        {{ __('for') }}
        <inertia-link :href="`/admin/users/${item?.subject?.slug}`"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            {{ item?.subject?.name }}
            <!-- <span>{{ item?.subject?.liked_trimed[0].title[$page.props?.locale] }}</span> -->
        </inertia-link>
    </div>
</template>
