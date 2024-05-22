<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import TableHeader from './TableHeader.vue';
import ArrowDownIcon from '@/Icons/ArrowDownIcon.vue';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
/* import ReviewEditDialog from './ReviewEditDialog.vue'; */
import FiltersSection from '@/Components/FiltersSection.vue';

const showReviewEditDialog = ref(false)
const editingReview = ref({})

const handleEditReview = (user) => {
    editingReview.value = user
    showReviewEditDialog.value = true
}

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
                    <FiltersSection id="reviews-filters" route="admin.reviews.index" placeholder="Search for reviews" />
                </template>

                <template #tablehead>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox"
                                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">{{ __('checkbox') }}</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Reviewer') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Apartment') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Score') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Text') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Approved') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Last Update') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Action') }}
                    </th>
                </template>
                <TableRow v-for="review in $page.props?.reviews.data" :key="review.id" :item="review"
                    @edit-review="handleEditReview" />

            </TableSection>

        </template>
    </ActionSection>

    <!-- <UserEditDialog :show="showUserEditDialog" @close="showUserEditDialog = false" :user="editingUser" /> -->
</template>
