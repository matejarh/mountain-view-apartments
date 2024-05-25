<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ReservationsTable from './_partials/ReservationsTable.vue'


</script>

<template>
    <FullLayout :title="__('Reservations')">
        <ReservationsTable />

    </FullLayout>
</template>
