<script setup>
import ApplicationLogo from '@/Components/TopNavigation/ApplicationLogo.vue';
import AppsDropdown from '@/Components/TopNavigation/AppsDropdown.vue';
import NotificationsDropdown from '@/Components/TopNavigation/NotificationsDropdown.vue';
import SearchForm from '@/Components/TopNavigation/SearchForm.vue';
import ThemeSwitch from '@/Components/TopNavigation/ThemeSwitch.vue';
import ToggleSearchButton from '@/Components/TopNavigation/ToggleSearchButton.vue';
import ToggleSidebarButton from '@/Components/TopNavigation/ToggleSidebarButton.vue';
import UserDropdown from '@/Components/TopNavigation/UserDropdown.vue';
import { onMounted } from 'vue';

defineEmits(['toggleSidebar'])

</script>

<template>
    <nav
        class="min-h-24 sm:min-h-16 bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-950 dark:border-gray-950 fixed left-0 right-0 top-0 z-30">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <ToggleSidebarButton @toggle="$emit('toggleSidebar')" />
                <ApplicationLogo />
                <SearchForm />
            </div>
            <div class="flex justify-end items-center lg:order-2">
                <ToggleSearchButton @show-sidebar="$emit('toggleSidebar')" />
                <NotificationsDropdown />
<!--                 <NotificationsDropdown />
                <AppsDropdown /> -->
                <ThemeSwitch />
                <UserDropdown />
            </div>
        </div>
    </nav>
</template>
