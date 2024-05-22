<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ReviewsTable from './_partials/ReviewsTable.vue'


</script>

<template>
    <FullLayout :title="__('Reviews')">
        <ReviewsTable />

    </FullLayout>
</template>
