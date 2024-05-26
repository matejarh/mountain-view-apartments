<script setup>
import ApplicationLogo from '@/Components/TopNavigation/ApplicationLogo.vue';
import NotificationsDropdown from '@/Components/TopNavigation/NotificationsDropdown.vue';
import ThemeSwitch from '@/Components/TopNavigation/ThemeSwitch.vue';
import ToggleSidebarButton from '@/Components/TopNavigation/ToggleSidebarButton.vue';
import UserDropdown from '@/Components/TopNavigation/UserDropdown.vue';

defineEmits(['toggleSidebar'])
</script>

<template>
    <nav
        class="min-h-24 sm:min-h-16 bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-950 dark:border-gray-950 fixed left-0 right-0 top-0 z-30">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <ToggleSidebarButton @toggle="$emit('toggleSidebar')" />
                <ApplicationLogo />
            </div>
            <div class="flex justify-end items-center lg:order-2">
                <NotificationsDropdown />
                <ThemeSwitch />
                <UserDropdown />
            </div>
        </div>
    </nav>
</template>
