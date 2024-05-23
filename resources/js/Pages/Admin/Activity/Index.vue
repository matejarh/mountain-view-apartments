<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import FullLayout from '@/Layouts/FullLayout.vue';
import ArrowDownIcon from '@/Icons/ArrowDownIcon.vue';
import ActivityTableHeader from './ActivityTableHeader.vue';
import ActivityTableRow from './ActivityTableRow.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import ActivityList from './ActivityList.vue';
import Paginator from '@/Components/Paginator.vue';


</script>

<template>
    <FullLayout :title="__('Activities')">
        <ActionSection>
            <template #title>
                {{ __("Activity Log") }}
            </template>

            <template #description>
                <FiltersSection id="activities-filters" route="admin.users.activities.index" :placeholder="'Search for activities'" />
            </template>

            <template #content>
                <ActivityList />
                <Paginator :paginator="$page.props.activities" />
            </template>
        </ActionSection>
    </FullLayout>
</template>
