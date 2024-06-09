<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import { ref, watch } from 'vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TableHeader from '@/Components/TableHeader.vue';

const showInquiryEditDialog = ref(false)
const editingInquiry = ref({})

const handleEditInquiry = (user) => {
    editingInquiry.value = user
    showInquiryEditDialog.value = true
}

const filters = ref({

})


const headers = ref([
    'Date',
    'Apartment',
    'Message',
    'Text',
    'Status',
    'Posted At',
    // 'Action'
])

</script>

<template>

    <ActionSection :fullwidth="false">
        <template #title>
            {{ __("My Inquiries List") }}
        </template>
        <template #content>
            <TableSection :paginator="$page.props?.inquiries">
                <template #header>

                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="inquiry in $page.props?.inquiries.data" :key="inquiry.id" :item="inquiry"
                    @edit-inquiry="handleEditInquiry" />
            </TableSection>
        </template>
    </ActionSection>
</template>
