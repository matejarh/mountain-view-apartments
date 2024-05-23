<script setup>
import { computed } from 'vue';
import NavItems from '@/Components/SideNavigation/NavItems.vue';
import Tooltip from '@/Components/Tooltip.vue';
import BottomItem from '@/Components/SideNavigation/BottomItem.vue';
import LangSwitch from '@/Components/SideNavigation/LangSwitch.vue';
import { icons } from '@/icons';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    show: Boolean,
});

const page = usePage()

defineEmits(['hide']);

const classes = computed(() => {
    return !props.show ? '-translate-x-full' : '-translate-x-0';
});

const navItems = computed(() => [
    {
        type: 'link',
        href: page.props?.auth.user.is_admin ? '/admin/dashboard' : '/dashboard',
        icon: icons.AdjustmentsIcon,
        title: 'Dashboard',
    },
    {
        type: 'dropdown',
        condition: page.props?.auth.user.is_admin,
        icon: icons.MountainCityIcon,
        title: 'Accommodations',
        active: ['/admin/properties', '/admin/reviews', '/admin/reservations', '/admin/inquiries'],
        children: [
            { href: '/admin/properties', title: 'List' },
            { href: '/admin/reviews', title: 'Reviews' },
            { href: '/admin/inquiries', title: 'Inquiries' },
            { href: '/admin/reservations', title: 'Reservations' },
        ],
    },
    {
        type: 'link',
        condition: page.props?.auth.user.is_admin,
        href: '/admin/pages',
        icon: icons.PagesIcon,
        title: 'Pages',
    },
    {
        type: 'dropdown',
        condition: page.props?.auth.user.is_admin,
        icon: icons.ImageIcon,
        title: 'Galleries',
        active: ['/admin/galleries', '/admin/images'],
        children: [
            { href: '/admin/galleries', title: 'Galleries' },
            { href: '/admin/images', title: 'Images' },
        ],
    },
    {
        type: 'dropdown',
        condition: page.props?.auth.user.is_admin,
        icon: icons.UsersIcon,
        title: 'Users',
        active: '/admin/users',
        children: [
            { href: '/admin/users/all', title: 'All Users' },
            { href: '/admin/users/activity-log', title: 'Activity Log' },
        ],
    },
]);

const bottomNavItems = computed(() => [
    {
        type: 'link',
        condition: page.props?.auth.user.is_admin,
        href: route('dashboard.show'),
        icon: icons.AdjustmentsIcon,
        title: 'Docs',
        customIcon: true,
    },
    {
        type: 'link',
        condition: page.props?.auth.user.is_admin,
        href: route('dashboard.show'),
        icon: icons.CogIcon,
        title: 'Help',
        customIcon: true,
    },
]);
</script>

<template>
    <aside :class="classes"
        class="fixed top-0 left-0 z-20 w-64 h-screen pt-24 sm:pt-14 transition-transform bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-900 dark:border-gray-700"
        aria-label="Sidenav" id="sidebar-navigation">
        <div class="overflow-y-auto py-5 px-3 md:pr-0 h-full bg-white dark:bg-gray-900">
            <ul class="space-y-2">
                <NavItems :items="navItems" @hide="$emit('hide')" />
            </ul>
            <ul class="transition-all pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <NavItems :items="bottomNavItems" @hide="$emit('hide')" />
            </ul>
        </div>
        <div
            class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-gray-50 dark:bg-gray-800 z-20">
            <BottomItem v-if="$page.props?.auth.user.is_admin" :href="'/'">
                <icons.AdjustmentsIcon class="w-6 h-6" />
            </BottomItem>

            <Tooltip v-if="$page.props?.auth.user.is_admin" :text="__('Settings Page')">
                <BottomItem :href="route('admin.settings.index')" active="/admin/settings">
                    <icons.CogIcon class="w-6 h-6" />
                </BottomItem>
            </Tooltip>

            <LangSwitch />
        </div>
    </aside>
</template>
