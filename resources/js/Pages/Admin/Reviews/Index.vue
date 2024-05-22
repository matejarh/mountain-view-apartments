<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ReviewsTable from './_partials/ReviewsTable.vue'

const props = defineProps({
    users: Object,
    links: String,
    filters: Object,
})
</script>

<template>
    <FullLayout :title="__('Reviews')">
        <ReviewsTable />

    </FullLayout>
</template>
