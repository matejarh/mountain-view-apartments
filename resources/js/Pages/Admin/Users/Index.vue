<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import UserTableRow from './UserTableRow.vue'
import UserTableHeader from './UserTableHeader.vue';
import ArrowDownIcon from '@/Icons/ArrowDownIcon.vue';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserEditDialog from './UserEditDialog.vue';
import FiltersSection from '@/Components/FiltersSection.vue';

const showUserEditDialog = ref(false)
const editingUser = ref({})

const handleEditUser = (user) => {
    editingUser.value = user
    showUserEditDialog.value = true
}

</script>

<template>

<ActionSection>
    <template #title>
        {{ __("Users List") }}
    </template>
    <template #content>
        <TableSection :paginator="$page.props?.users">
            <template #header>
                <!-- <UserTableHeader /> -->
                <FiltersSection id="users-filters" route="admin.users.index" placeholder="Search for users" />
            </template>

            <template #tablehead>
                <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">{{__('checkbox')}}</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 flex space-x-2">
                            <div class="flex items-center cursor-pointer" @click="">
                                {{__('Name')}}
                                <ArrowDownIcon v-if="$page.props?.filters.sortBy === 'name'"
                                :class="{'rotate-180' : $page.props?.filters.sortBy === 'name' && $page.props?.filters.sortDirection === 'desc'}"
                                class="w-4 h-4" />

                            </div>
                            <span>/</span>
                            <div class="flex items-center">
                                {{__('Email')}}
                                <ArrowDownIcon v-if="$page.props?.filters.sortBy === 'email'"
                                :class="{'rotate-180' : $page.props?.filters.sortBy === 'email' && $page.props?.filters.sortDirection === 'desc'}"
                                class="w-4 h-4" />

                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                            {{__('Phone')}}
                            <ArrowDownIcon v-if="$page.props?.filters.sortBy === 'phone'"
                                                :class="{'rotate-180' : $page.props?.filters.sortBy === 'phone' && $page.props?.filters.sortDirection === 'desc'}"
                                                class="w-4 h-4" />
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Address')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Country')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Status')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Action')}}
                        </th>
            </template>
            <UserTableRow v-for="user in $page.props?.users.data" :key="user.id" :user="user" @edit-user="handleEditUser" />

        </TableSection>

    </template>
</ActionSection>

<!-- <UserEditDialog :show="showUserEditDialog" @close="showUserEditDialog = false" :user="editingUser" /> -->
</template>
