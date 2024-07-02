<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import { ref } from 'vue';
import TableHeader from '@/Components/TableHeader.vue';

const headers = ref([
    'Apartment',
    'Arrival/Departure',
    'Guests',
    'Message',
    'Confirmed/Payment',
])

</script>

<template>

    <ActionSection :fullwidth="false">
        <template #title>
            {{ __("My Reservations List") }}
        </template>
        <template #content>
            <TableSection :paginator="$page.props?.reservations">
                <template #header>

                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="reservation in $page.props?.reservations.data" :key="reservation.id" :item="reservation"
                    />
            </TableSection>
        </template>
    </ActionSection>
</template>
