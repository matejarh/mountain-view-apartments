<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import { ref, watch } from 'vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TableHeader from '@/Components/TableHeader.vue';

const headers = ref([
    'Apartment',
    'Score',
    'Text',
    'Status',
    'Posted At',
    // 'Action'
])

</script>

<template>

    <ActionSection :fullwidth="false">
        <template #title>
            {{ __("My Reviews List") }}
        </template>
        <template #content>
            <TableSection :paginator="$page.props?.reviews">
                <template #header>

                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="review in $page.props?.reviews.data" :key="review.id" :item="review" />
            </TableSection>
        </template>
    </ActionSection>
</template>
