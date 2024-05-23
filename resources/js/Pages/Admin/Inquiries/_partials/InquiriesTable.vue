<script setup>
import { ref } from 'vue';
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import TableHeader from '@/Components/TableHeader.vue';
import ShowInquiryDialog from './ShowInquiryDialog.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import ReplyDialog from './ReplyDialog.vue';

const showInquiryDialog = ref(false)
const showReplyDialog = ref(false)
const showingInquiry = ref({})

const handleShowInquiry = (item) => {
    showingInquiry.value = item
    showInquiryDialog.value = true
}

const handleShowReplyDialog = (item) => {
    showingInquiry.value = item
    showReplyDialog.value = true
}

const headers = ref([
    'Guest',
    'Apartment',
    'Subject',
    'Guests',
    'Date',
    'Replied At',
    'Actions'
])

</script>

<template>

    <ActionSection>
        <template #title>
            {{ __("Inquiries List") }}
        </template>

        <template #content>
            <TableSection :paginator="$page.props?.inquiries">
                <template #header>
                    <FiltersSection id="inquiries-filters" route="admin.inquiries.index" placeholder="Search for inquiries" />
                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="inquiry in $page.props?.inquiries.data" :key="inquiry.id" :item="inquiry"
                    @show="handleShowInquiry" @reply="handleShowReplyDialog" />
            </TableSection>
        </template>
    </ActionSection>

    <ShowInquiryDialog :show="showInquiryDialog" @close="showInquiryDialog = false" :item="showingInquiry" @reply="showReplyDialog = true" />
    <ReplyDialog :show="showReplyDialog" @close="showReplyDialog = false" :item="showingInquiry" />
</template>
