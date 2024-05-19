<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import FullLayout from '@/Layouts/FullLayout.vue';
import ArrowDownIcon from '@/Icons/ArrowDownIcon.vue';
import ActivityTableHeader from './ActivityTableHeader.vue';
import ActivityTableRow from './ActivityTableRow.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import ActivityList from './ActivityList.vue';


</script>

<template>
    <FullLayout :title="__('Activities')">
        <ActionSection>
            <template #title>
                {{ __("Activity Log") }}
            </template>
            <template #content>

                <ActivityList />
            </template>
        </ActionSection>
        <!--         <ActionSection>

                <TableSection :paginator="$page.props.activities">
                    <template #header>

                        <FiltersSection id="activities-filters" route="admin.users.activities.index" placeholder="Search for activities" />
                    </template>

                    <template #tablehead>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">{{ __('checkbox') }}</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            <div class="flex items-center cursor-pointer" @click="">
                                <div class="flex space-x-2">
                                    <div class="">

                                        {{ __('Date') }}
                                    </div>
                                    <span> / </span>
                                    <div class="">

                                        {{ __('Time') }}
                                    </div>
                                </div>
                                <ArrowDownIcon v-if="$page.props.filters.sortBy === 'created_at'"
                                    :class="{ 'rotate-180': $page.props.filters.sortBy === 'created_at' && $page.props.filters.sortDirection === 'desc' }"
                                    class="w-4 h-4" />

                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 flex space-x-2">
                            <div class="flex items-center cursor-pointer" @click="">
                                {{ __('Name') }}
                                <ArrowDownIcon v-if="$page.props.filters.sortBy === 'owner.name'"
                                    :class="{ 'rotate-180': $page.props.filters.sortBy === 'owner.name' && $page.props.filters.sortDirection === 'desc' }"
                                    class="w-4 h-4" />

                            </div>
                            <span>/</span>
                            <div class="flex items-center">
                                {{ __('Email') }}
                                <ArrowDownIcon v-if="$page.props.filters.sortBy === 'owner.email'"
                                    :class="{ 'rotate-180': $page.props.filters.sortBy === 'owner.email' && $page.props.filters.sortDirection === 'desc' }"
                                    class="w-4 h-4" />

                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                {{ __('Type') }}
                                <ArrowDownIcon v-if="$page.props.filters.sortBy === 'type'"
                                    :class="{ 'rotate-180': $page.props.filters.sortBy === 'type' && $page.props.filters.sortDirection === 'desc' }"
                                    class="w-4 h-4" />
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Device') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Location') }}
                        </th>
                    </template>
                    <ActivityTableRow v-for="activity in $page.props.activities.data" :key="activity.id"
                        :activity="activity" />

                </TableSection>
            </template>
        </ActionSection>
 -->
    </FullLayout>
</template>
