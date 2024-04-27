<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import UserTableRow from './UserTableRow.vue'
import UserTableHeader from './UserTableHeader.vue';

const handleEditUser = (user) => {
    console.log(user)
}
</script>

<template>

<ActionSection>
    <template #title>
        {{ __("Users List") }}
    </template>
    <template #content>
        <TableSection :links="$page.props.links">
            <template #header>
                <UserTableHeader />
            </template>

            <template #tablehead>
                <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">{{__('checkbox')}}</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Name')}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{__('Phone')}}
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
            <UserTableRow v-for="user in $page.props.users.data" :key="user.id" :user="user" @edit-user="handleEditUser" />
        </TableSection>

    </template>

</ActionSection>

</template>
