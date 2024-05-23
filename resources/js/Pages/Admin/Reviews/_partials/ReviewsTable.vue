<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import { ref, watch } from 'vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TableHeader from '@/Components/TableHeader.vue';

const showReviewEditDialog = ref(false)
const editingReview = ref({})

const handleEditReview = (user) => {
    editingReview.value = user
    showReviewEditDialog.value = true
}

const filters = ref({
    approved: false,
    notApproved: false
})

// Watch for changes in the approved checkbox
watch(() => filters.value.approved, (newVal) => {
    if (newVal) {
        filters.value.notApproved = false;
    }
});

// Watch for changes in the notApproved checkbox
watch(() => filters.value.notApproved, (newVal) => {
    if (newVal) {
        filters.value.approved = false;
    }
});

const headers = ref([
    'Reviewer',
    'Apartment',
    'Score',
    'Text',
    'Approved',
    'Last Update',
    'Action'
])

</script>

<template>

    <ActionSection>
        <template #title>
            {{ __("Reviews List") }}
        </template>
        <template #content>
            <TableSection :paginator="$page.props?.reviews">
                <template #header>
                    <!-- <TableHeader /> -->
                    <FiltersSection id="reviews-filters" route="admin.reviews.index" :filters="filters"
                        placeholder="Search for reviews">
                        <div class="flex flex-col ms-4">
                            <label class="text-gray-500 block" for="approved">
                                <Checkbox class="w-12 h-12" id="approved" v-model:checked="filters.approved" />
                                Approved
                            </label>
                            <label class="text-gray-500 block" for="not_approved">
                                <Checkbox class="w-12 h-12" id="not_approved" v-model:checked="filters.notApproved" />
                                Not Approved
                            </label>

                        </div>
                    </FiltersSection>
                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="review in $page.props?.reviews.data" :key="review.id" :item="review"
                    @edit-review="handleEditReview" />

            </TableSection>

        </template>
    </ActionSection>
</template>
