<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Reviewed') }}

        <inertia-link :href="`/admin/properties/${item?.subject?.reviewed_trimed[0].slug}`"
            class="font-semibold text-gray-900 dark:text-white hover:underline">
            {{ item?.subject?.name }}
            <span>{{ item?.subject?.reviewed_trimed[0].title[$page.props?.locale] }}</span>
        </inertia-link>
    </div>
</template>
