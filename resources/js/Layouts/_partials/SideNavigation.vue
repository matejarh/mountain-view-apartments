<script setup>
import SearchForm from '@/Components/SideNavigation/SearchForm.vue';
import { computed, onMounted } from 'vue';
import NavLink from '@/Components/SideNavigation/NavLink.vue';
import NavDropdown from '@/Components/SideNavigation/NavDropdown.vue';
import DropdownItem from '@/Components/SideNavigation/DropdownItem.vue';
import Tooltip from '@/Components/Tooltip.vue';
import BottomItem from '@/Components/SideNavigation/BottomItem.vue';
import LangSwitch from '@/Components/SideNavigation/LangSwitch.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import UsersIcon from '@/Icons/UsersIcon.vue';
import CogIcon from '@/Icons/CogIcon.vue';
import MountainCityIcon from '@/Icons/MountainCityIcon.vue';
import AdjustmentsIcon from '@/Icons/AdjustmentsIcon.vue';
import PagesIcon from '@/Icons/PagesIcon.vue';

const props = defineProps({
    show: Boolean,
})

defineEmits(['hide'])

const classes = computed(() => {
    return !props.show ? '-translate-x-full' : '-translate-x-0'
})
</script>

<template>
    <aside :class="classes"
        class="fixed top-0 left-0 z-20 w-64 h-screen pt-24 sm:pt-14 transition-transform bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-900 dark:border-gray-700"
        aria-label="Sidenav" id="sidebar-navigation">
        <div class="overflow-y-auto py-5 px-3 md:pr-0 h-full bg-white dark:bg-gray-900">
            <ul class="space-y-2">
                <NavLink :href="$page.props.auth.user.is_admin ? '/admin/dashboard': '/dashboard'" @click="$emit('hide')">
                    <template #icon>
                        <AdjustmentsIcon class="" />
                    </template>
                    {{ __("Dashboard") }}
                </NavLink>

                <NavDropdown v-if="$page.props.auth.user.is_admin" key="properties-dropdown" href="/admin/properties">
                    <template #icon>
                        <MountainCityIcon />
                    </template>
                    <template #title>{{ __("Accomodations") }}</template>
                    <DropdownItem href="/admin/properties" @click="$emit('hide')">{{ __('List') }}</DropdownItem>
                    <DropdownItem href="/admin/properties/reviews" @click="$emit('hide')">{{ __('Reviews') }}</DropdownItem>
                    <DropdownItem href="/admin/properties/reservations" @click="$emit('hide')">{{ __('Reservations') }}</DropdownItem>
                </NavDropdown>

                <NavLink v-if="$page.props.auth.user.is_admin" href="/admin/pages" @click="$emit('hide')">
                    <template #icon>
                        <PagesIcon />
                    </template>
                    {{ __("Pages") }}
                </NavLink>

                <NavDropdown v-if="$page.props.auth.user.is_admin" key="galleries-dropdown" href="/admin/galleries">
                    <template #icon>
                        <ImageIcon />
                    </template>
                    <template #title>{{ __('Galleries') }}</template>
                    <DropdownItem :href="'/admin/galleries'" @click="$emit('hide')">{{ __('Galleries') }}</DropdownItem>
                    <DropdownItem :href="'/admin/images'" @click="$emit('hide')">{{ __('Images') }}</DropdownItem>
                    <!-- <DropdownItem :href="'/admin/galeries/create'" @click="$emit('hide')">Create</DropdownItem> -->

                </NavDropdown>
                <NavDropdown v-if="$page.props.auth.user.is_admin" key="users-dropdown" href="/admin/users">
                    <template #icon>
                        <UsersIcon />
                    </template>
                    <template #title>{{ __("Users") }}</template>
                    <DropdownItem href="/admin/users/all" @click="$emit('hide')">{{ __('All Users') }}</DropdownItem>
                    <DropdownItem href="/admin/users/activity-log" @click="$emit('hide')">{{ __('Activity Log') }}</DropdownItem>

                </NavDropdown>
            </ul>
            <ul class="transition-all pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <NavLink v-if="$page.props.auth.user.is_admin" :href="route('dashboard.show')">
                    <template #icon>
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </template>
                    Docs
                </NavLink>
<!--                 <NavLink v-if="$page.props.auth.user.is_admin" :href="route('dashboard.show')">
                    <template #icon>
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </template>
                    Components
                </NavLink> -->
                <NavLink v-if="$page.props.auth.user.is_admin" :href="route('dashboard.show')">
                    <template #icon>
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </template>
                    Help
                </NavLink>
            </ul>
        </div>
        <div
            class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-gray-50 dark:bg-gray-800 z-20">
            <BottomItem v-if="$page.props.auth.user.is_admin" :href="'/'">
                <AdjustmentsIcon class="w-6 h-6" />
            </BottomItem>

            <Tooltip v-if="$page.props.auth.user.is_admin" :text="__('Settings Page')">
                <BottomItem :href="route('admin.settings.index')" active="/admin/settings">
                    <CogIcon class="w-6 h-6" />
                </BottomItem>
            </Tooltip>

            <LangSwitch />
        </div>
    </aside>
</template>
