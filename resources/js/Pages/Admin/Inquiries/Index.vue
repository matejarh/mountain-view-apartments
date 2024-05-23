<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import InquiriesTable from './_partials/InquiriesTable.vue'

</script>

<template>
    <FullLayout :title="__('Inquiries')">
        <InquiriesTable />

    </FullLayout>
</template>
