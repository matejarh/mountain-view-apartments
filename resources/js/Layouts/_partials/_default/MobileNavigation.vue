<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useHelperStore } from '@/stores/helpers';
import { useScrollStore } from '@/stores/scroll';
import { icons } from '@/icons';
import MobileNavigationItem from '@/Components/_default/MobileNavigation/MobileNavigationItem.vue';
import MobileThemeSwitch from '@/Components/_default/MobileThemeSwitch.vue';
import HamburgerButton from '@/Components/_default/MobileNavigation/HamburgerButton.vue';
import LanguageDropdown from '@/Components/_default/LanguageDropdown.vue';
import ReservationInquiryForm from '@/Components/_default/ReservationInquiry.vue';
import Backdrop from '@/Components/_default/Backdrop.vue';

const helpers = useHelperStore();
const scroll = useScrollStore();

/**
 * Determine if icons backgrounds should be shown
 */
const showBackgrounds = computed(() => {
    if (scroll.windowHeight > 0 && scroll.scrollPosition > 10) {
        return scroll.windowHeight <= scroll.scrollPosition;
    }
    return false;
});

const logoutForm = useForm({});

const logout = () => {
    helpers.hideMobileDrawer();
    logoutForm.post(route('logout'));
};

// Define an array of navigation items
const navItems = [
    {
        key: 'home',
        route: 'home',
        label: 'Home',
        icon: icons.HomeIcon,
        path: (locale) => `/${locale}/home`,
    },
    {
        key: 'accommodations',
        route: 'properties.index',
        label: 'Apartments',
        icon: icons.LandmarkIcon,
        path: (locale) => `/${locale}/accommodations`,
    },
    {
        key: 'exploreBled',
        route: 'explore.bled',
        label: 'Explore Bled',
        icon: icons.LandmarkIcon,
        path: (locale) => `/${locale}/explore/bled`,
    },
    {
        key: 'exploreNassfeld',
        route: 'discover.nassfeld',
        label: 'Discover Nassfeld',
        icon: icons.LandmarkIcon,
        path: (locale) => `/${locale}/discover/nassfeld`,
    },
    {
        key: 'aboutUs',
        route: 'aboutus',
        label: 'About Us',
        icon: icons.LandmarkIcon,
        path: (locale) => `/${locale}/about-us`,
    },
    {
        key: 'contact',
        route: 'contact.show',
        label: 'Contact',
        icon: icons.BookOpenIcon,
        path: (locale) => `/${locale}/contact`,
    },
];
</script>

<template>
    <div class="xl:hidden fixed top-0 left-0 z-50 w-full p-4 bg-transparent flex justify-between">
        <LanguageDropdown class="opacity-50 hover:opacity-100 active:opacity-100" :align="'left'" :no-label="true" />

        <div class="space-x-4">
            <MobileThemeSwitch class="transition-all ease-out backdrop-blur bg-opacity-50 rounded-lg"
                :class="{ 'bg-gray-400 dark:bg-gray-700 drop-shadow-lg': showBackgrounds }" />
            <HamburgerButton v-show="!helpers.mobileDrawer" :show-backgrounds="showBackgrounds"
                @click="helpers.showMobileDrawer" />
        </div>
        <teleport to="body">
            <Backdrop v-show="helpers.mobileDrawer" @close="helpers.hideMobileDrawer" />

            <div id="drawer-mobile"
                class="fixed top-0 right-0 z-50 flex flex-col h-screen transition-transform bg-white w-screen sm:w-80 dark:bg-gray-800"
                :class="helpers.mobileDrawer ? 'translate-x-0' : 'translate-x-full'" tabindex="-1">
                <div class="p-4 flex-grow-0 relative border-b shadow border-gray-200 dark:border-gray-700">
                    <h5 class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">{{ __('Menu') }}</h5>
                    <button @click="helpers.hideMobileDrawer" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <icons.CloseIcon class="w-5 h-5" />
                        <span class="sr-only">{{ __('Close menu') }}</span>
                    </button>
                </div>
                <div class="grow overflow-y-auto scrollbar-thin scrollbar-track-gray-800 dark:scrollbar-track-gray-800 dark:scrollbar-thumb-gray-700 scrollbar-corner-transparent flex flex-col justify-between">
                    <div class="px-4 relative">
                        <div class="">
                            <div class="pb-4 flex flex-col justify-between">
                                <div v-if="$page.props?.auth.user" class="pt-4 mt-4 space-y-2 font-medium">
                                    <div class="flex items-center gap-4">
                                        <img class="w-10 h-10 rounded-full" :src="$page.props?.auth.user.profile_photo_url" alt="">
                                        <div class="font-medium dark:text-white">
                                            <div>{{ $page.props?.auth.user.name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $page.props?.auth.user.email }}</div>
                                        </div>
                                    </div>
                                    <MobileNavigationItem as="div" v-if="$page.props?.auth.user.is_admin" @clicked="helpers.hideMobileDrawer" :active="`/admin/dashboard`" :href="route('admin.dashboard.show')">
                                        <template #icon><icons.AdjustmentsIcon /></template>
                                        {{ __("Administration") }}
                                    </MobileNavigationItem>
                                    <MobileNavigationItem as="div" @clicked="helpers.hideMobileDrawer" :active="`/user/profile`" :href="route('profile.show')">
                                        <template #icon><icons.UserIcon /></template>
                                        {{ __("My Profile") }}
                                    </MobileNavigationItem>
                                    <MobileNavigationItem as="div" :href="null" @clicked="logout">
                                        <template #icon><icons.SignOutIcon /></template>
                                        {{ __("Sign out") }}
                                    </MobileNavigationItem>
                                </div>
                                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                                    <MobileNavigationItem v-for="item in navItems" :key="item.key" @clicked="helpers.hideMobileDrawer" :active="`${item.path($page.props?.locale)}`" :href="route(item.route, $page.props?.locale)">
                                        <template #icon><component :is="item.icon" class="w-5 h-5" /></template>
                                        {{ __(item.label) }}
                                    </MobileNavigationItem>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700 mx-4">
                        <h5 class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                            <icons.CalendarIcon class="w-3.5 h-3.5 me-2.5" />
                            {{ __('Reservation Inquiry') }}
                        </h5>
                        <ReservationInquiryForm @close="helpers.hideMobileDrawer" />
                    </div>
                </div>
            </div>
        </teleport>
    </div>
</template>
