<script setup>
import { ref, watch } from 'vue';
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import TableHeader from '@/Components/TableHeader.vue';
import ShowInquiryDialog from './ShowInquiryDialog.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import ReplyDialog from './ReplyDialog.vue';
import Checkbox from '@/Components/Checkbox.vue';

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

const filters = ref({
    answered: false,
    notAnswered: false
})

// Watch for changes in the answered checkbox
watch(() => filters.value.answered, (newVal) => {
    if (newVal) {
        filters.value.notAnswered = false;
    }
});

// Watch for changes in the notAnswered checkbox
watch(() => filters.value.notAnswered, (newVal) => {
    if (newVal) {
        filters.value.answered = false;
    }
});

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
                    <FiltersSection id="inquiries-filters" route="admin.inquiries.index" placeholder="Search for inquiries" :filters="filters">
                        <div class="flex flex-col ms-4">
                            <label class="text-gray-500 block" for="answered">
                                <Checkbox class="w-12 h-12" id="answered" v-model:checked="filters.answered" />
                                {{__('Answered')}}
                            </label>
                            <label class="text-gray-500 block" for="not_answered">
                                <Checkbox class="w-12 h-12" id="not_answered" v-model:checked="filters.notAnswered" />
                                {{__('Not Answered')}}
                            </label>
                        </div>

                    </FiltersSection>
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
