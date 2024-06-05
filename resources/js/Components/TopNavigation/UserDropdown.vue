<script setup>
import { router, useForm } from '@inertiajs/vue3';
import DropdownItem from './DropdownItem.vue';
import NavDropdown from './NavDropdown.vue';
import { icons } from "@/icons"

const logoutForm = useForm({})
const logout = () => {
    logoutForm.post(route('logout'));
};
</script>

<template>
    <NavDropdown width="64" align="right">
        <template #trigger>
            <span class="sr-only">{{ __('Open user menu') }}</span>
            <img class="w-8 h-8 rounded-full" :src="$page.props?.auth.user.profile_photo_url" alt="user photo" />
        </template>
        <div class="py-3 px-4 flex items-center space-x-2">
            <img class="w-8 h-8 rounded-full" :src="$page.props?.auth.user.profile_photo_url" alt="user photo" />
            <div class="">
                <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $page.props?.auth.user.name
                    }}</span>
                <span class="block text-sm text-gray-400 truncate dark:text-gray-300">{{ $page.props?.auth.user.email
                    }}</span>

            </div>
        </div>
        <ul class="py-1 text-gray-700 dark:text-gray-300">
            <DropdownItem :href="$page.props?.auth.user.is_admin ? route('profile.show') : route('profile.show')">
                <div class="flex items-center">
                    <icons.UserEditIcon class="mr-2 w-5 h-5 " />
                    {{ __("My Profile") }}
                </div>
            </DropdownItem>
            <DropdownItem v-if="$page.props?.auth.user.is_admin" :href="route('admin.dashboard.show')">
                <div class="flex items-center">
                    <icons.AdjustmentsIcon class="mr-2 w-5 h-5 " />
                    {{ __("Administration") }}
                </div>
            </DropdownItem>

        </ul>

        <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <DropdownItem :href="route('reviews.index', $page.props.locale)">
                <div class="flex items-center">
                    <icons.BookOpenIcon class="mr-2 w-5 h-5 " />
                    {{ __('My Reviews') }}
                </div>
            </DropdownItem>

            <DropdownItem :href="route('inquiries.index', $page.props.locale)">
                <div class="flex items-center">
                    <icons.InfoIcon class="mr-2 w-5 h-5 " />
                    {{ __('My Inquiries') }}
                </div>
            </DropdownItem>

            <DropdownItem :href="route('reservations.index', $page.props.locale)">
                <div class="flex items-center">

                    <icons.CalendarIcon class="mr-2 w-5 h-5 " />
                    {{ __('My Reservations') }}
                </div>
            </DropdownItem>
        </ul>

        <ul class="py-1 text-gray-700 dark:text-gray-300 overflow-hidden mb-1">
            <DropdownItem as="button" @clicked="logout">
                {{ __("Sign out") }}
            </DropdownItem>
        </ul>
    </NavDropdown>
</template>
